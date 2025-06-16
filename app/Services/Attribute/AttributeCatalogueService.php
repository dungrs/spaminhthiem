<?php 

namespace App\Services\Attribute;
use App\Classes\Nestedsetbie;

use App\Services\Interfaces\Attribute\AttributeCatalogueServiceInterface;
use App\Services\BaseService;

use App\Repositories\Attribute\AttributeCatalogueRepository;
use App\Repositories\RouterRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AttributeCatalogueService extends BaseService implements AttributeCatalogueServiceInterface {
    protected $attributeCatalogueRepository;
    protected $routerRepository;
    protected $nestedSet;

    public function __construct(AttributeCatalogueRepository $attributeCatalogueRepository, RouterRepository $routerRepository) {
        $this->attributeCatalogueRepository = $attributeCatalogueRepository;
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
                ['acl.language_id', '=',  $languageId]
            ]
        ];
        $extend['path'] = '/attribute/catalogue/index';
        $extend['fieldSearch'] = ['name'];
        $join = [
            [
                'table' => 'attribute_catalogue_languages as acl', 
                'on' => [['acl.attribute_catalogue_id', 'attribute_catalogues.id']]
            ]
        ];
        $attributeCatalogues = $this->attributeCatalogueRepository->paginate(
            $this->paginateSelect(),
            $condition,
            $perpage,
            $page,
            $extend,
            ['attribute_catalogues.lft', 'ASC'],
            $join,
            ['languages']
        );

        if ($attributeCatalogues) {
            return response()->json([
                'status' => 'success',
                'data' => $attributeCatalogues,
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
            $attributeCatalogue = $this->createAttributeCatalogue($request);
            if ($attributeCatalogue->id > 0) {
                $languageId =  session('currentLanguage')->id;
                $controllerName = $this->getControllerMappings();

                $this->updateLanguageForAttributeCatalogue($request, $attributeCatalogue, $languageId);
                $this->createRouter($request, $attributeCatalogue, $controllerName, $languageId);
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
            $attributeCatalogue = $this->attributeCatalogueRepository->findById($id);
            $flag = $this->updateAttributeCatalogue($request, $id);
            if ($flag) {
                $this->updateLanguageForAttributeCatalogue($request, $attributeCatalogue, $languageId);
                $this->updateRouter($request, $attributeCatalogue, $controllerName, $languageId);
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
            $this->attributeCatalogueRepository->delete($id);
            $this->routerRepository->deleteByCondition([
                ['module_id', '=', $id],
                ['controllers' , '=', 'App\Http\Controllers\Frontend\Attribute\AttributeCatalogueController']
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

    public function getAttributeCatalogues($conditions, $multiple = false) {
        return $this->attributeCatalogueRepository->findByCondition(
            $conditions,
            $multiple,
            [
                [
                    'table' => 'attribute_catalogue_languages as acl',
                    'on' => [['acl.attribute_catalogue_id', 'attribute_catalogues.id']]
                ]
            ],
            ['attribute_catalogues.id' => 'DESC'],
            [
                'attribute_catalogues.*',
                'acl.name', 
                'acl.description', 
                'acl.content', 
                'acl.meta_title', 
                'acl.meta_keyword', 
                'acl.meta_description', 
                'acl.canonical', 
                'acl.language_id',
            ]
        );
    }
    
    public function getAttributeCatalogueDetails($id, $languageId) {
        return $this->getAttributeCatalogues([
            ['acl.language_id', '=', $languageId],
            ['attribute_catalogues.id', '=', $id]
        ]);
    }
    
    public function getAttributeCatalogueOtherLanguages($id, $languageId) {
        return $this->getAttributeCatalogues([
            ['acl.language_id', '!=', $languageId],
            ['attribute_catalogues.id', '=', $id]
        ], true);
    }
    
    public function getAttributeCatalogueLanguages($languageId = 0) {
        return $this->getAttributeCatalogues([
            ['acl.language_id', '=', $languageId == 0 ? session('currentLanguage')->id : $languageId]
        ], true);
    }

    // FRONTEND SERVICE
    public function getAttributeCatalogueFrontEnd($attributeCatalogueId, $languageId) {
        $attributeCatalogues = $this->attributeCatalogueRepository->findByCondition(
            [
                ['attribute_catalogue_languages.language_id', '=', $languageId],
                ['attribute_catalogues.id', 'IN', $attributeCatalogueId],
                ['publish', '=', 2]
            ],
            true,
            [
                [
                    'table' => 'attribute_catalogue_languages', 
                    'on' => [['attribute_catalogue_languages.attribute_catalogue_id', 'attribute_catalogues.id']]
                ]
            ],
            
            ['attribute_catalogues.id' => 'ASC'],
            [
                'attribute_catalogues.id', 
                'attribute_catalogue_languages.*', 
            ]
        );
        return $attributeCatalogues;
    }

    private function createAttributeCatalogue($request) {
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        return $this->attributeCatalogueRepository->create($payload);
    }

    private function updateAttributeCatalogue($request, $id) {
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        return $this->attributeCatalogueRepository->update($id, $payload);
    }

    private function updateLanguageForAttributeCatalogue($request, $attributeCatalogue, $languageId) {
        $payload = $this->formatLanguagePayload($request, $attributeCatalogue->id, $languageId);
        $attributeCatalogue->languages()->detach($languageId, $attributeCatalogue->id);
        return $this->attributeCatalogueRepository->createPivot($attributeCatalogue, $payload, 'languages');
    }

    private function payload() {
        return ['parent_id', 'follow', 'publish', 'image'];
    }

    private function payloadLanguage() {
        return ['name', 'description', 'content', 'meta_title', 'meta_keyword', 'meta_description', 'canonical'];
    }

    private function formatLanguagePayload($request, $id, $languageId) {
        $payload = $request->only($this->payloadLanguage());
        $payload['attribute_catalogue_id'] = $id;
        $payload['canonical'] = Str::slug($payload['canonical']);
        $payload['language_id'] = $languageId;
        return $payload;
    }

    private function getControllerMappings() {
        return [
            'parent' => 'Attribute',
            'child' => 'AttributeCatalogue'
        ];
    }

    private function initialize($languageId) {
        $this->nestedSet = new Nestedsetbie([
            'table' => 'attribute_catalogues',
            'foreignkey' => 'attribute_catalogue_id',
            'language_id' => $languageId,
        ]);
    }

    private function paginateSelect() {
        return [
            'attribute_catalogues.id',
            'attribute_catalogues.parent_id',
            'attribute_catalogues.publish', 
            'attribute_catalogues.image', 
            'attribute_catalogues.level', 
            'attribute_catalogues.follow', 
            'acl.name', 
            'acl.canonical',
            'acl.language_id'
        ];
    }
}