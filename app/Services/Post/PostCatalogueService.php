<?php 

namespace App\Services\Post;
use App\Classes\Nestedsetbie;

use App\Services\Interfaces\Post\PostCatalogueServiceInterface;
use App\Services\BaseService;

use App\Repositories\Post\PostCatalogueRepository;
use App\Repositories\RouterRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostCatalogueService extends BaseService implements PostCatalogueServiceInterface {
    protected $postCatalogueRepository;
    protected $routerRepository;
    protected $nestedSet;

    public function __construct(PostCatalogueRepository $postCatalogueRepository, RouterRepository $routerRepository) {
        $this->postCatalogueRepository = $postCatalogueRepository;
        $this->routerRepository = $routerRepository;
    }

    public function paginate($request) {
        $perpage = $request->input('perpage');
        $page = $request->integer('page');
        $languageId = $request->integer('language_id') ?? session('currentLanguage')->id;
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish'),
            'where' => [
                ['pcl.language_id', '=',  $languageId]
            ]
        ];
        $extend['path'] = '/post/catalogue/index';
        $extend['fieldSearch'] = ['name'];
        $join = [
            [
                'table' => 'post_catalogue_languages as pcl', 
                'on' => [['pcl.post_catalogue_id', 'post_catalogues.id']]
            ]
        ];
        $postCatalogues = $this->postCatalogueRepository->paginate(
            $this->paginateSelect(),
            $condition,
            $perpage,
            $page,
            $extend,
            ['post_catalogues.lft', 'ASC'],
            $join,
            ['languages']
        );

        if ($postCatalogues) {
            return response()->json([
                'status' => 'success',
                'data' => $postCatalogues,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "Lấy dữ liệu không thành công!"
            ], 500);
        }
    }

    public function create($request) {
        DB::beginTransaction();

        try {
            $postCatalogue = $this->createPostCatalogue($request);
            if ($postCatalogue->id > 0) {
                $languageId = session('currentLanguage')->id;
                $controllerName = $this->getControllerMappings();

                $this->updateLanguageForPostCatalogue($request, $postCatalogue, $languageId);
                $this->createRouter($request, $postCatalogue, $controllerName, $languageId);
                $this->initialize($languageId);
                $this->nestedSet();
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => __('messages.notifications.create_success'),
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.create_error')
            ], 500);
        }
    }

    public function update($request, $id, $languageId) {
        DB::beginTransaction();

        try {
            $controllerName = $this->getControllerMappings();
            $postCatalogue = $this->postCatalogueRepository->findById($id);
            $flag = $this->updatePostCatalogue($request, $id);
            if ($flag) {
                $this->updateLanguageForPostCatalogue($request, $postCatalogue, $languageId);
                $this->updateRouter($request, $postCatalogue, $controllerName, $languageId);
                $this->initialize($languageId);
                $this->nestedSet();
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.update_success'),
                ], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.update_error')
            ], 500);
        }
    }

    public function delete($id) {
        DB::beginTransaction();
    
        try {
            $this->postCatalogueRepository->delete($id);
            $this->routerRepository->deleteByCondition([
                ['module_id', '=', $id],
                ['controllers' , '=', 'App\Http\Controllers\Frontend\Post\PostCatalogueController']
            ]);
            $this->initialize(session('currentLanguage')->id);
            $this->nestedSet->Get();
            $this->nestedSet->Recursive(0, $this->nestedSet->Set());
            $this->nestedSet->Action();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => __('messages.notifications.delete_success'),
            ], 200);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.delete_error')
            ], 500);
        }
    }

    public function getPostCatalogues($conditions, $multiple = false) {
        return $this->postCatalogueRepository->findByCondition(
            $conditions,
            $multiple,
            [
                [
                    'table' => 'post_catalogue_languages as pcl',
                    'on' => [['pcl.post_catalogue_id', 'post_catalogues.id']]
                ]
            ],
            ['post_catalogues.id' => 'DESC'],
            [
                'post_catalogues.*',
                'pcl.name', 
                'pcl.description', 
                'pcl.content', 
                'pcl.meta_title', 
                'pcl.meta_keyword', 
                'pcl.meta_description', 
                'pcl.canonical', 
                'pcl.language_id',
            ]
        );
    }
    
    public function getPostCatalogueDetails($id, $languageId) {
        return $this->getPostCatalogues([
            ['pcl.language_id', '=', $languageId],
            ['post_catalogues.id', '=', $id]
        ]);
    }
    
    public function getPostCatalogueOtherLanguages($id, $languageId) {
        return $this->getPostCatalogues([
            ['pcl.language_id', '!=', $languageId],
            ['post_catalogues.id', '=', $id]
        ], true);
    }

    private function createPostCatalogue($request) {
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        return $this->postCatalogueRepository->create($payload);
    }

    private function updatePostCatalogue($request, $id) {
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        return $this->postCatalogueRepository->update($id, $payload);
    }

    private function updateLanguageForPostCatalogue($request, $postCatalogue, $languageId) {
        $payload = $this->formatLanguagePayload($request, $postCatalogue->id, $languageId);
        $postCatalogue->languages()->detach($languageId, $postCatalogue->id);
        return $this->postCatalogueRepository->createPivot($postCatalogue, $payload, 'languages');
    }

    private function payload() {
        return ['parent_id', 'follow', 'publish', 'image'];
    }

    private function payloadLanguage() {
        return ['name', 'description', 'content', 'meta_title', 'meta_keyword', 'meta_description', 'canonical'];
    }

    private function formatLanguagePayload($request, $id, $languageId) {
        $payload = $request->only($this->payloadLanguage());
        $payload['post_catalogue_id'] = $id;
        $payload['canonical'] = Str::slug($payload['canonical']);
        $payload['language_id'] = $languageId;
        return $payload;
    }

    private function getControllerMappings() {
        return [
            'parent' => 'Post',
            'child' => 'PostCatalogue'
        ];
    }

    private function initialize($languageId) {
        $this->nestedSet = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' => $languageId,
        ]);
    }

    private function paginateSelect() {
        return [
            'post_catalogues.id',
            'post_catalogues.parent_id',
            'post_catalogues.publish', 
            'post_catalogues.image', 
            'post_catalogues.level', 
            'post_catalogues.follow', 
            'pcl.name', 
            'pcl.canonical',
            'pcl.language_id'
        ];
    }
}