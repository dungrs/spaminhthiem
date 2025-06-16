<?php 

namespace App\Services;
use App\Services\Interfaces\LanguageServiceInterface;
use App\Services\BaseService;

use App\Repositories\LanguageRepository;
use App\Repositories\RouterRepository;

use Illuminate\Support\Facades\DB;

class LanguageService extends BaseService implements LanguageServiceInterface {

    protected $languageRepository;
    protected $routerRepository;

    public function __construct(LanguageRepository $languageRepository, RouterRepository $routerRepository) {
        $this->languageRepository = $languageRepository;
        $this->routerRepository = $routerRepository;
    }

    public function paginate($request) {
        $perpage = $request->input('perpage') ?? 1;
        $page = $request->integer('page');
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
        ];
        $extend['path'] = '/language/index';
        $extend['fieldSearch'] = ['name', 'description', 'canonical'];
        $languages = $this->languageRepository->paginate(
            $this->paginateSelect(),
            $condition,
            $perpage,
            $page,
            $extend,
            ['id', 'DESC'],
            [],
        );
        return $languages;
    }

    public function create($request) {
        DB::beginTransaction();

        try {
            $payload = $request->except('_token');
            $languages = $this->languageRepository->create($payload);
            if ($languages) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => ('messages.notifications.create_success'),
                    'data' => $languages,
                ], 200);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.create_error')
            ], 500);
        }
    }

    public function update($request, $id) {
        DB::beginTransaction();

        try {
            $payload = $request->except('_token');
            $languages = $this->languageRepository->update($id, $payload);
            if ($languages) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.update_success'),
                    'data' => $languages,
                ], 200);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.update_error')
            ], 500);
        }
    }

    public function delete($id) {
        DB::beginTransaction();
    
        try {
            $language = $this->languageRepository->findById($id);
            if ($language && $language->users()->count() > 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('messages.notifications.delete_error_users_exist')
                ], 400);
            }
    
            $languages = $this->languageRepository->delete($id);
    
            if ($languages) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.delete_success'),
                ], 200);
            }
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.delete_error')
            ], 500);
        }
    }

    public function getLanguageDetailsAjax($id) {
        $language = $this->languageRepository->findById($id);
        if ($language) {
            return response()->json([
                'status' => 'success',
                'data' => $language,
            ], 200);
        }
    }

    public function getLanguageDetails($id) {
        $language = $this->languageRepository->findById($id);
        return $language;
    }

    public function getLanguageOtherSelect($languageId) {
        $languages = $this->languageRepository->findByCondition(
            [
                ['languages.id', '!=', $languageId]
            ],
            true
        );

        return $languages;
    }

    public function saveTranslate($option, $request) {
        DB::beginTransaction();
    
        try {
            $payload = [
                'name' => $request->input("name_trans"),
                'description' => $request->input("description_trans"),
                'content' => $request->input("content_trans"),
                'meta_title' => $request->input("meta_title_trans"),
                'meta_keyword' => $request->input("meta_keyword_trans"),
                'meta_description' => $request->input("meta_description_trans"),
                'canonical' => $request->input("canonical_trans"),
                convertModelToField($option['model']) => $option['id'],
                'language_id' => $request->input('language_id')
            ];

            $repositoryInstance = resolveInstance($option['model'], $option['modelParent'], 'Repositories', 'Repository');
            $model = $repositoryInstance->findById($option['id']);
            $languageDetails = $this->languageRepository->findById($payload['language_id']);
            $model->languages()->detach([$payload['language_id'], $model->id]);
            $repositoryInstance->createPivot($model, $payload, 'languages');

            $this->routerRepository->deleteByCondition([
                ['module_id', '=', $option['id']],
                ['controllers' , '=', "App\\Http\\Controllers\Frontend\\$option[modelParent]\\$option[model]Controller"],
                ['language_id' , '=', $payload['language_id']]
            ]);

            $router = [
                'canonical' => $payload['canonical'],
                'module_id' => $option['id'],
                'language_id' => $payload['language_id'],
                'controllers' => "App\\Http\\Controllers\Frontend\\$option[modelParent]\\$option[model]Controller"
            ];
            
            $this->routerRepository->create($router);
            DB::commit(); 
            return response()->json([
                'status' => 'success',
                'message' => __('messages.notifications.translation_saved_successfully'),
                'data' => $languageDetails,
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.error_saving_translation'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    private function paginateSelect() {
        return [
            'id',
            'name',
            'description',
            'image',
            'publish',
            'canonical',
        ];
    }
}