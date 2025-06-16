<?php 

namespace App\Services\Product;
use App\Classes\Nestedsetbie;

use App\Services\Interfaces\Product\ProductCatalogueServiceInterface;
use App\Services\BaseService;

use App\Repositories\Product\ProductCatalogueRepository;
use App\Repositories\Product\ProductVariantRepository;
use App\Repositories\Product\ProductVariantAttributeRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\RouterRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductCatalogueService extends BaseService implements ProductCatalogueServiceInterface {
    protected $productCatalogueRepository;
    protected $productVariantRepository;
    protected $productVariantAttributeRepository;

    protected $productRepository;
    protected $routerRepository;
    protected $nestedSet;

    public function __construct(
        ProductCatalogueRepository $productCatalogueRepository,
        ProductVariantRepository $productVariantRepository, 
        ProductVariantAttributeRepository $productVariantAttributeRepository, 
        ProductRepository $productRepository, 
        RouterRepository $routerRepository,
        ) {
        $this->productCatalogueRepository = $productCatalogueRepository;
        $this->productVariantRepository = $productVariantRepository;
        $this->productVariantAttributeRepository = $productVariantAttributeRepository;
        $this->productRepository = $productRepository;
        $this->routerRepository = $routerRepository;
    }

    public function paginate($request) {
        $perpage = $request->input('perpage') ?? 10;
        $page = $request->integer('page');
        $languageId = $request->integer('language_id') ?? session('currentLanguage')->id;
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish'),
            'where' => [
                ['pcl.language_id', '=',  $languageId]
            ]
        ];
        $extend['path'] = '/product/catalogue/index';
        $extend['fieldSearch'] = ['name'];
        $join = [
            [
                'table' => 'product_catalogue_languages as pcl', 
                'on' => [['pcl.product_catalogue_id', 'product_catalogues.id']]
            ]
        ];
        $productCatalogues = $this->productCatalogueRepository->paginate(
            $this->paginateSelect(),
            $condition,
            $perpage,
            $page,
            $extend,
            ['product_catalogues.lft', 'ASC'],
            $join,
            ['languages']
        );

        if ($productCatalogues) {
            return response()->json([
                'status' => 'success',
                'data' => $productCatalogues,
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
            $productCatalogue = $this->createProductCatalogue($request);
            if ($productCatalogue->id > 0) {
                $languageId =  session('currentLanguage')->id;
                $controllerName = $this->getControllerMappings();

                $this->updateLanguageForProductCatalogue($request, $productCatalogue, $languageId);
                $this->createRouter($request, $productCatalogue, $controllerName, $languageId);
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
            $productCatalogue = $this->productCatalogueRepository->findById($id);
            $flag = $this->updateProductCatalogue($request, $id);
            if ($flag) {
                $this->updateLanguageForProductCatalogue($request, $productCatalogue, $languageId);
                $this->updateRouter($request, $productCatalogue, $controllerName, $languageId);
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
            $this->productCatalogueRepository->delete($id);
            $this->routerRepository->deleteByCondition([
                ['module_id', '=', $id],
                ['controllers' , '=', 'App\Http\Controllers\Frontend\Product\ProductCatalogueController']
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

    public function getProductCatalogue($conditions, $multiple = false) {
        return $this->productCatalogueRepository->findByCondition(
            $conditions,
            $multiple,
            [
                [
                    'table' => 'product_catalogue_languages as pcl',
                    'on' => [['pcl.product_catalogue_id', 'product_catalogues.id']]
                ]
            ],
            ['product_catalogues.id' => 'DESC'],
            [
                'product_catalogues.*',
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
    
    public function getProductCatalogueDetails($id, $languageId) {
        return $this->getProductCatalogue([
            ['pcl.language_id', '=', $languageId],
            ['product_catalogues.id', '=', $id]
        ]);
    }
    
    public function getProductCatalogueOtherLanguages($id, $languageId) {
        return $this->getProductCatalogue([
            ['pcl.language_id', '!=', $languageId],
            ['product_catalogues.id', '=', $id]
        ], true);
    }

    
    public function setAttribute($product, $languageId) {
        $attribute = $product->attribute;
        $catalogueIds = $this->productCatalogueRepository->recursveCategoryGetParentAChild($product->product_catalogue_id, 'product');
        $productList = [];
        foreach ($catalogueIds as $id) {
            $productCatalogueItem = $this->getProductCatalogueDetails($id, $languageId);
            $productIds = $productCatalogueItem->products->pluck('id');
            $productItems = $this->productRepository->findByCondition(
                [   
                    ['pl.language_id', '=', $languageId],
                    ['products.id', 'IN', $productIds],
                    ['products.publish', '=', 2],
                ],
                true,
                [   
                    [
                        'table' => 'product_languages as pl',
                        'on' => [['pl.product_id', 'products.id']]
                    ]
                ],
                ['products.id' => 'ASC'],
                [
                    'pl.*',
                ]
            );

            $productList[$id] = $productItems;
        }

        if (!is_array($attribute)) {
            $decodedAttribute = json_decode($attribute, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $attribute = $decodedAttribute;
            } else {
                $attribute = []; 
            }
        }

        foreach ($productList as $idCatalogue => $value) {
            $productCatalogueInfo = $this->productCatalogueRepository->findById($idCatalogue);

            $attributeArray = json_decode($productCatalogueInfo->attribute, true);
            if (!is_array($attributeArray)) {
                $payload['attribute'] = $attribute;
            } else {
                $mergeArray = $attributeArray;
                foreach ($attribute as $key => $val) {
                    if (!isset($mergeArray[$key])) {
                        $mergeArray[$key] = $val;
                    } else {
                        $mergeArray[$key] = array_values(array_unique(array_merge($mergeArray[$key], $val)));
                    }
                }
                $payload['attribute'] = $mergeArray;
            }
            
            $attributeList = [];
            foreach ($productList as $key => $val) {
                $attributesForProduct = [];
                foreach ($val as $product) {
                    $variants = $this->productVariantRepository->findByCondition(
                        [
                            ['pvl.language_id', '=', $languageId],
                            ['product_variants.product_id', '=', $product->product_id],
                        ],
                        true,
                        [   
                            [
                                'table' => 'product_variant_languages as pvl',
                                'on' => [['pvl.product_variant_id', 'product_variants.id']]
                            ]
                        ],
                        ['product_variants.id' => 'ASC'],
                        ['pvl.*']
                    );
    
                    foreach ($variants as $variant) {
                        $attributeId = $this->productVariantAttributeRepository->findByCondition(
                            [
                                ['product_variant_attributes.product_variant_id', '=', $variant->product_variant_id],
                            ],
                            true,
                            [],
                            [],
                            ['product_variant_attributes.attribute_id']
                        )->toArray();
                        $attributeId = array_map(function ($item) {
                            return $item['attribute_id'];
                        }, $attributeId);
                        $attributesForProduct = array_merge($attributesForProduct, $attributeId);
                    }
    
                }
                $attributeList[$key] = array_unique($attributesForProduct);
            }
    
            foreach ($payload['attribute'] as $key => $val) {
                foreach($attributeList as $validKey => $validValues) {
                    $payload['attribute'][$key] = array_filter($val, function ($value) use ($validValues) {
                        return in_array($value, $validValues);
                    });
            
                    $payload['attribute'][$key] = array_values($payload['attribute'][$key]);
                    $this->productCatalogueRepository->update($idCatalogue, $payload);
                }
            }
        }
        
        return $this->productCatalogueRepository->findByCondition(
            [
                ['product_catalogues.id', '=', $product->product_catalogue_id],
            ],
            true
        );
    }

    private function createProductCatalogue($request) {
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        return $this->productCatalogueRepository->create($payload);
    }

    private function updateProductCatalogue($request, $id) {
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        return $this->productCatalogueRepository->update($id, $payload);
    }

    private function updateLanguageForProductCatalogue($request, $productCatalogue, $languageId) {
        $payload = $this->formatLanguagePayload($request, $productCatalogue->id, $languageId);
        $productCatalogue->languages()->detach($languageId, $productCatalogue->id);
        return $this->productCatalogueRepository->createPivot($productCatalogue, $payload, 'languages');
    }

    private function payload() {
        return ['parent_id', 'follow', 'publish', 'image'];
    }

    private function payloadLanguage() {
        return ['name', 'description', 'content', 'meta_title', 'meta_keyword', 'meta_description', 'canonical'];
    }

    private function formatLanguagePayload($request, $id, $languageId) {
        $payload = $request->only($this->payloadLanguage());
        $payload['product_catalogue_id'] = $id;
        $payload['canonical'] = Str::slug($payload['canonical']);
        $payload['language_id'] = $languageId;
        return $payload;
    }

    private function getControllerMappings() {
        return [
            'parent' => 'Product',
            'child' => 'ProductCatalogue'
        ];
    }

    private function initialize($languageId) {
        $this->nestedSet = new Nestedsetbie([
            'table' => 'product_catalogues',
            'foreignkey' => 'product_catalogue_id',
            'language_id' => $languageId,
        ]);
    }

    private function paginateSelect() {
        return [
            'product_catalogues.id',
            'product_catalogues.parent_id',
            'product_catalogues.publish', 
            'product_catalogues.image', 
            'product_catalogues.level', 
            'product_catalogues.follow', 
            'pcl.name', 
            'pcl.canonical',
            'pcl.language_id'
        ];
    }
}