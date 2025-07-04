<?php 

namespace App\Services\Post;
use App\Services\Interfaces\Post\PostServiceInterface;
use App\Services\BaseService;

use App\Repositories\Post\PostRepository;
use App\Repositories\RouterRepository;

use App\Services\Post\PostCatalogueService;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostService extends BaseService implements PostServiceInterface {
    protected $postRepository;
    protected $routerRepository;
    protected $postCatalogueService;


    public function __construct(
        PostRepository $postRepository, 
        RouterRepository $routerRepository,
        PostCatalogueService $postCatalogueService
        ) {
        $this->postRepository = $postRepository;
        $this->routerRepository = $routerRepository;
        $this->postCatalogueService = $postCatalogueService;
    }

    public function paginate($request) {
        $perpage = $request->input('perpage') ?? 6;
        $page = $request->input('page');
        $languageId = $request->input('language_id') ?? session('currentLanguage')->id ?? 1;
        $postCatalogueId = $request->input('post_catalogue_id') ?? null;

        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->input('publish') ?? 2,
            'where'   => [
                ['pl.language_id', '=', $languageId],
            ],
        ];

        if (!is_null($postCatalogueId)) {
            $condition['where'][] = ['pcp.post_catalogue_id', '=', $postCatalogueId];
        }

        $extend = [
            'path'        => '/post/index',
            'fieldSearch' => ['name'],
        ];

        $join = [
            [
                'table' => 'post_languages as pl',
                'on'    => [['pl.post_id', 'posts.id']],
            ],
        ];

        if (!is_null($postCatalogueId)) {
            $join[] = [
                'table' => 'post_catalogue_post as pcp',
                'on'    => [['posts.id', 'pcp.post_id']],
            ];
        }

        $posts = $this->postRepository->paginate(
            $this->paginateSelect(),
            $condition,
            $perpage,
            $page,
            $extend,
            ['posts.id', 'ASC'],
            $join,
            ['languages', 'post_catalogues'],
        );

        if ($posts) {
            return response()->json([
                'status' => 'success',
                'data'   => $posts,
            ], 200);
        } else {
            return response()->json([
                'status'  => 'error',
                'message' => 'Lấy dữ liệu không thành công!',
            ], 500);
        }
    }

    public function create($request) {
        DB::beginTransaction();

        try {
            $post = $this->createPost($request);
            if ($post->id > 0) {
                $languageId =  session('currentLanguage')->id;
                $controllerName = $this->getControllerMappings();
                $this->updateLanguageForPost($request, $post, $languageId);
                $this->uploadCatalogueForPost($post, $request);
                $this->createRouter($request, $post, $controllerName, $languageId);
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
            $post = $this->postRepository->findById($id);
            $flag = $this->updatePost($request, $id);
            if ($flag) {
                $this->updateLanguageForPost($request, $post, $languageId);
                $this->uploadCatalogueForPost($post, $request);
                $this->updateRouter($request, $post, $controllerName, $languageId);
                
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
            $this->postRepository->delete($id);
            $this->routerRepository->deleteByCondition([
                ['module_id', '=', $id],
                ['controllers' , '=', 'App\Http\Controllers\Frontend\Post\PostController']
            ]);

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

    public function getPosts($conditions, $multiple = false) {
        return $this->postRepository->findByCondition(
            $conditions,
            $multiple,
            [
                [
                    'table' => 'post_languages as pl',
                    'on' => [['pl.post_id', 'posts.id']]
                ]
            ],
            ['posts.id' => 'DESC'],
            [
                'posts.*',
                'pl.name', 
                'pl.description', 
                'pl.content', 
                'pl.meta_title', 
                'pl.meta_keyword', 
                'pl.meta_description', 
                'pl.canonical', 
                'pl.language_id',
            ]
        );
    }
    
    public function getPostDetails($id, $languageId) {
        return $this->getPosts([
            ['pl.language_id', '=', $languageId],
            ['posts.id', '=', $id]
        ]);
    }
    
    public function getPostOtherLanguages($id, $languageId) {
        return $this->getPosts([
            ['pl.language_id', '!=', $languageId],
            ['posts.id', '=', $id]
        ], true);
    }

    // FRONTEND SERVICE
    public function prepareFrontendPostData($id, $languageId, $isJsonResponse = true) {
        $post = $this->getPostDetails($id, $languageId);
        $postCatalogue = $this->postCatalogueService->getPostCatalogueDetails($post->post_catalogue_id, $languageId);
        $seo = seo($post);
    
        if ($isJsonResponse) {
            $postArray = [
                'id' => $post->id,
                'name' => $post->name,
                'description' => $post->description,
                'content' => $post->content,
                'image' => $post->image,
                'promotions' => $post->promotions,
                'attributes' => $post->attributes,
            ];
    
            return response()->json([
                'status' => 'success',
                'data' => [
                    'post' => $postArray,
                    'seo' => $seo,
                ]
            ], 200, [], JSON_PARTIAL_OUTPUT_ON_ERROR);
        }
    
        return [
            'post' => $post,
            'postCatalogue' => $postCatalogue,
            'seo' => $seo,
        ];
    }

    public function getRelatedPostsByCategory($postCatalogueId, $postId, $languageId) {
        $conditions = [
            ['pl.language_id', '=', $languageId],
            ['posts.post_catalogue_id', '=', $postCatalogueId],
            ['posts.id', '!=', $postId],
        ];
        $postRelateds = $this->basePostQuery($conditions);
        return $postRelateds;
    }

    protected function basePostQuery(array $conditions, bool $multiple = true) {
        return $this->postRepository->findByCondition(
            $conditions,
            $multiple,
            [
                [
                    'table' => 'post_languages as pl',
                    'on' => [['pl.post_id', 'posts.id']]
                ]
            ],
            ['posts.id' => 'DESC'],
            [
                'posts.*',
                'pl.name',
                'pl.description',
                'pl.content',
                'pl.meta_title',
                'pl.meta_keyword',
                'pl.meta_description',
                'pl.canonical',
                'pl.language_id',
            ]
        );
    }

    private function createPost($request) {
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        return $this->postRepository->create($payload);
    }

    private function updatePost($request, $id) {
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        return $this->postRepository->update($id, $payload);
    }

    private function updateLanguageForPost($request, $post, $languageId) {
        $payload = $this->formatLanguagePayload($request, $post->id, $languageId);
        $post->languages()->detach($languageId, $post->id);
        return $this->postRepository->createPivot($post, $payload, 'languages');
    }

    private function uploadCatalogueForPost($post, $request) {
        $post->post_catalogues()->sync($this->catalogue($request));
    }

    private function catalogue($request) {
        if ($request->input('catalogue') != null) {
            return array_unique(
                array_merge(
                    $request->input('catalogue'),
                    [$request->post_catalogue_id]
                )
            );
        }

        return [$request->post_catalogue_id];
    }

    private function payload() {
        return ['post_catalogue_id', 'follow', 'publish', 'image'];
    }

    private function payloadLanguage() {
        return ['name', 'description', 'content', 'meta_title', 'meta_keyword', 'meta_description', 'canonical'];
    }

    private function formatLanguagePayload($request, $id, $languageId) {
        $payload = $request->only($this->payloadLanguage());
        $payload['post_id'] = $id;
        $payload['language_id'] = $languageId;
        return $payload;
    }

    private function getControllerMappings() {
        return [
            'parent' => 'Post',
            'child' => 'Post'
        ];
    }

    private function paginateSelect() {
        return [
            'posts.id',
            'posts.post_catalogue_id',
            'posts.publish', 
            'posts.image', 
            'posts.follow', 
            'posts.created_at', 
            'pl.name', 
            'pl.canonical',
            'pl.language_id',
            'pl.meta_description',
        ];
    }
}