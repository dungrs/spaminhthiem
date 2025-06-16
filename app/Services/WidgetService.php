<?php 

namespace App\Services;
use App\Services\Interfaces\WidgetServiceInterface;
use App\Services\BaseService;

use App\Repositories\WidgetRepository;
use App\Repositories\LanguageRepository;

use App\Services\PromotionService;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WidgetService extends BaseService implements WidgetServiceInterface {

    protected $widgetRepository;
    protected $languageRepository;
    protected $promotionService;

    public function __construct(
        WidgetRepository $widgetRepository, 
        LanguageRepository $languageRepository,
        PromotionService $promotionService,
        ) {
        $this->widgetRepository = $widgetRepository;
        $this->languageRepository = $languageRepository;
        $this->promotionService = $promotionService;
    }

    public function paginate($request) {
        $perpage = $request->input('perpage');
        $page = $request->integer('page');
        $languageId = $request->integer('language_id') ?? session('currentLanguage')->id;
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish'),
            'where' => [
                ['wl.language_id', '=',  $languageId]
            ]
        ];
        $extend['path'] = '/widget/index';
        $extend['fieldSearch'] = ['name'];
        $join = [
            [
                'table' => 'widget_languages as wl', 
                'on' => [['wl.widget_id', 'widgets.id']]
            ]
        ];
        $widget = $this->widgetRepository->paginate(
            $this->paginateSelect(),
            $condition,
            $perpage,
            $page,
            $extend,
            ['widgets.id', 'DESC'],
            $join,
            ['languages']
        );

        if ($widget) {
            return response()->json([
                'status' => 'success',
                'data' => $widget,
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
            $payload = $this->payload($request);
            $languageId = session('currentLanguage')->id;
            $widgets = $this->widgetRepository->create($payload);
            if ($widgets) {
                $this->updateLanguageForWidget($request, $widgets, $languageId);
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.create_success'),
                    'data' => $widgets,
                ], 200);
            }
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
            $payload = $this->payload($request);
            $flag = $this->widgetRepository->update($id, $payload);
            $widget = $this->widgetRepository->findById($id);
            if ($flag) {
                $this->updateLanguageForWidget($request, $widget, $languageId);
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.update_success'),
                    'data' => $flag,
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
            $widgets = $this->widgetRepository->delete($id);
            if ($widgets) {
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

    public function findModelObject($request) {
        $payload = $request->input();
        $model = Str::snake($payload['model']);
        $languageId = session('currentLanguage')->id;
        $repositoryInstance = resolveInstance($payload['model'], $payload['modelParent'], 'Repositories', 'Repository');
        $data = $repositoryInstance->findByCondition(
            [
                ['tbl.language_id', '=', $languageId],
            ],
            true,
            [
                [
                    'table' => "{$model}_languages as tbl", 
                    "on" => [["tbl.{$model}_id", "{$model}s.id"]]
                ]
            ],
            ["{$model}s.id" => "DESC"],
            [
                "{$model}s.id",
                "{$model}s.image",
                "tbl.name", 
                "tbl.canonical", 
                "tbl.language_id", 
            ]
        );

        if ($data) {
            return response()->json([
                'status' => 'success',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "Lấy dữ liệu không thành công!"
            ], 500);
        }
    }

    public function getWidgets($conditions, $multiple = false) {
        return $this->widgetRepository->findByCondition(
            $conditions,
            $multiple,
            [
                [
                    'table' => 'widget_languages as wl',
                    'on' => [['wl.widget_id', 'widgets.id']]
                ]
            ],
            ['widgets.id' => 'DESC'],
            [
                'widgets.*',
                'wl.name', 
                'wl.description', 
                'wl.keyword', 
                'wl.language_id', 
            ]
        );
    }
    
    public function getWidgetDetails($id, $languageId) {
        return $this->getWidgets([
            ['wl.language_id', '=', $languageId],
            ['widgets.id', '=', $id]
        ]);
    }
    
    public function getWidgetOtherLanguages($id, $languageId) {
        return $this->getWidgets([
            ['wl.language_id', '!=', $languageId],
            ['widgets.id', '=', $id]
        ], true);
    }

    public function getWidgetItem($widget, $model_id = [], $languageId = 1, $params = []) {
        $modelName = $widget->model;
        $model = Str::snake($modelName);
        $tableName = "{$model}s";

        $repositoryInstance = resolveInstance($widget->model, $widget->modelParent, 'Repositories', 'Repository');
        $condition = [
            ["{$model}_languages.language_id", '=', $languageId],
            ["{$model}_languages.{$model}_id", 'IN', $model_id]
        ];
        $join = [
            [
                'table' => "{$model}_languages",
                'on' => [["{$model}_languages.{$model}_id", "{$tableName}.id"]]
            ]
        ];
        $columns = [
            "{$model}s.id", 
            "{$model}s.image", 
            "{$model}s.album",
            "{$model}s.created_at",
            "{$model}_languages.name",
            "{$model}_languages.canonical",
            "{$model}_languages.meta_description",
        ];
        
        if (isset($params['object']) && $params['object'] === true) {
            $columns[] = "{$model}s.lft";
            $columns[] = "{$model}s.rgt";
        }
        
        $widgetItemData = $repositoryInstance->findByCondition(
            $condition,
            true,
            $join,
            ["{$model}s.id" => 'ASC'],
            $columns,
        );

        $fields = ['id', 'canonical', 'image', 'name', 'created_at', 'meta_description'];
        if (isset($params['object'])) {
            return $widgetItemData;
        }
    
        $widgetItem = convertArray($fields, $widgetItemData);
        return $widgetItem;
    }

    public function saveTranslate($option, $request) {
        DB::beginTransaction();
    
        try {
            $payload = [
                'widget_id' => $option['id'],
                'name' => $request->input("name_trans"),
                'description' => $request->input("description_trans"),
                'keyword' => $request->input("keyword_trans"),
                'language_id' => $request->input('language_id')
            ];

            $widget = $this->widgetRepository->findById($option['id']);
            $languageDetails = $this->languageRepository->findById($payload['language_id']);
            $widget->languages()->detach([$payload['language_id'], $widget->id]);
            $this->widgetRepository->createPivot($widget, $payload, 'languages');

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

    // FRONTEND SERVICE
    public function getWidget(array $conditionKeyword = [], int $languageId = 1) {
        $widget = collect($conditionKeyword)->mapWithKeys(function ($item, $key) use ($languageId) {
            return [$key => $this->findWidgetByKeyword($item['keyword'], $languageId, $item['options'])];
        })->toArray();

        return $widget;
    }

    public function findWidgetByKeyword(string $keyword = '', int $language, $params = []) {
        $widget = $this->getWidgets([
            ['wl.language_id', '=', $language],
            ['wl.keyword', '=', $keyword],
            ['publish', '=', 2]
        ]);
    
        $widgetItems = $this->getWidgetItem($widget, $widget->model_id, $language, $params);
        $model = $widget->model;
        $tableName = Str::snake($model);
        $tableChild = explode('_', $tableName)[0]; 
        
        foreach ($widgetItems as $val) {
            $processedProductIds = [];
            if ($model === 'Product' && isset($params['promotion'])) {
                $this->promotionService->applyPromotionToProduct($val, $tableChild);
            }
    
            if (isset($params['children']) && $params['children'] === true) {
                $parentAndChildID = $this->widgetRepository->recursveCategory($val->id, $tableChild);
                $childObjectCatalogue = $this->getWidgetItem($widget, $parentAndChildID, $language, $params);
    
                foreach ($childObjectCatalogue as $childVal) {
                    $childItems = $this->getItemsByParent($widget, $tableName, $tableChild, $language, $childVal->id)
                        ->filter(function ($item) use (&$processedProductIds) {
                            if (!in_array($item->id, $processedProductIds)) {
                                $processedProductIds[] = $item->id;
                                return true;
                            }
                            return false;
                        });
    
                    if (isset($params['promotion']) && !empty($childVal->products) && $childVal->products->isNotEmpty()) {
                        $childItems = $this->promotionService->applyPromotionToProductCollection($childItems, $childVal->products, $tableChild);
                    }
    
                    $childVal->productLists = $childItems;
                }

                $val->product_count = count($processedProductIds);
                $val->children = $childObjectCatalogue;
            }
        }
    
        $widget->object = $widgetItems;
        return $widget;
    }

    private function updateLanguageForWidget($request, $widget, $languageId) {
        $payload = $this->formatLanguagePayload($request, $widget->id, $languageId);
        $widget->languages()->detach($languageId, $widget->id);
        return $this->widgetRepository->createPivot($widget, $payload, 'languages');
    }

    private function formatLanguagePayload($request, $id, $languageId) {
        $payload = $request->only($this->payloadLanguage());
        $payload['widget_id'] = $id;
        $payload['language_id'] = $languageId;
        return $payload;
    }

    private function payloadLanguage() {
        return [
            'name',
            'description',
            'keyword'
        ];
    }

    private function payload($request) {
        $payload = $request->only('short_code', 'album', 'model', 'modelParent');
        $payload['model_id'] = $request->input('modelItem.id');
        return $payload;
    }

    private function paginateSelect() {
        return [
            'wl.name',
            'wl.keyword',
            'wl.description',
            'wl.language_id',
            'widgets.id',
            'widgets.model',
            'widgets.publish',
        ];
    }
}