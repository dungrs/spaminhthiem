<?php 

namespace App\Services\Product;
use App\Services\Interfaces\Product\ProductServiceInterface;
use App\Services\BaseService;

use App\Services\Product\ProductCatalogueService;
use App\Services\Product\ProductVariantService;
use App\Services\Attribute\AttributeService;

use App\Services\PromotionService;

use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductCatalogueRepository;
use App\Repositories\Product\ProductVariantAttributeRepository;
use App\Repositories\Product\ProductVariantLanguageRepository;

use App\Repositories\RouterRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use Ramsey\Uuid\Guid\Guid;

class ProductService extends BaseService implements ProductServiceInterface {
    protected $productRepository;
    protected $productCatalogueRepository;
    protected $productVariantLanguageRepository;
    protected $productVariantAttributeRepository;
    protected $routerRepository;
    protected $productCatalogueService;
    protected $productVariantService;
    protected $promotionService;
    protected $attributeService;
    
    public function __construct(
        ProductRepository $productRepository,
        ProductCatalogueRepository $productCatalogueRepository,
        RouterRepository $routerRepository,
        ProductVariantLanguageRepository $productVariantLanguageRepository,
        ProductVariantAttributeRepository $productVariantAttributeRepository,
        ProductCatalogueService $productCatalogueService,
        ProductVariantService $productVariantService,
        PromotionService $promotionService,
        AttributeService $attributeService,
        ) {
        $this->productRepository = $productRepository;
        $this->productCatalogueRepository = $productCatalogueRepository;
        $this->routerRepository = $routerRepository;
        $this->productVariantLanguageRepository = $productVariantLanguageRepository;
        $this->productVariantAttributeRepository = $productVariantAttributeRepository;
        $this->productCatalogueService = $productCatalogueService;
        $this->productVariantService = $productVariantService;
        $this->promotionService = $promotionService;
        $this->attributeService = $attributeService;
    }

    public function paginate($request) {
        $perpage = $request->input('perpage') ?? 10;
        $page = $request->integer('page');
        $languageId = $request->integer('language_id') ?? session('currentLanguage')->id;
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish'),
            'where' => [
                ['pl.language_id', '=',  $languageId]
            ]
        ];
        $extend['path'] = '/product/index';
        $extend['fieldSearch'] = ['name'];
        $join = [
            [
                'table' => 'product_languages as pl', 
                'on' => [['pl.product_id', 'products.id']]
            ],
        ];
        $products = $this->productRepository->paginate(
            $this->paginateSelect(),
            $condition,
            $perpage,
            $page,
            $extend,
            ['products.id', 'DESC'],
            $join,
            ['languages', 'product_catalogues'],
        );

        if ($products) {
            return response()->json([
                'status' => $products ? 'success' : 'error',
                'data' => $products ?: null,
                'message' => $products ? null : 'Lấy dữ liệu không thành công!'
            ], $products ? 200 : 500);
        }

        return $products;
    }

    public function paginateUser($request, $isJsonResponse = true) {
        $perPage = $request->input('perpage', 12);
        $page = $request->input('page', 1);
        $languageId = $request->input('language_id', session('currentLanguage')->id);
        $productCatalogueId = $request->input('product_catalogue_id');
        $attributeArray = $request->input('attributes', []);
        $priceMax = $request->input('price_max', null);
        $priceMin = $request->input('price_min', null);
        $rating = $request->input('score', null);
        $productCatalogue = $this->productCatalogueService->getProductCatalogueDetails($productCatalogueId, $languageId);

        $extend['fieldSearch'] = ['pl.name'];
        $condition = [
            'publish' => $request->input('publish'),
            'where' => [
                ['pl.language_id', '=', $languageId],
                ['pl.name', 'LIKE', "%{$request->input('keyword', null)}%"]
            ],
            'whereIn' => [],
        ];
        $rawQuery = [];
    
        if ($productCatalogue) {
            $productCatalogueIds = $productCatalogue::where('lft', '>=', $productCatalogue->lft)
                                                    ->where('rgt', '<=', $productCatalogue->rgt)
                                                    ->whereNull('deleted_at')
                                                    ->pluck('id')
                                                    ->toArray();
    
            if (!empty($productCatalogueIds)) {
                $condition['whereIn'][] = ['products.product_catalogue_id', $productCatalogueIds];
            }
        }

        
        if ($priceMax) {
            $priceMax = (int) str_replace(['.', 'đ'], '', $priceMax);
            $priceMin = (int) str_replace(['.', 'đ'], '', $priceMin);
        }

        if (!empty($attributeArray)) {
            $attributeIds = array_values($attributeArray);
            
            foreach ($attributeIds as $attrId) {
                $rawQuery['whereRaw'][] = "FIND_IN_SET('$attrId', REPLACE(pv.code, ' ', ''))";
            }
        }
        
        $basePath = $productCatalogue 
            ? '/' . $productCatalogue->canonical . config('apps.general.suffix')
            : 'product/index';
    
        $extend = [
            'path' => $basePath,
            'groupBy' => [
                'products.id',
                'products.product_catalogue_id',
                'products.publish',
                'products.image',
                'products.follow',
                'pl.name',
                'pl.canonical',
                'pl.language_id'
            ],
            'fieldSearch' => ['name']
        ];
    
        $join = [
            [
                'table' => 'product_languages as pl', 
                'on' => [['pl.product_id', 'products.id']]
            ],
            [   
                'type' => 'left',
                'table' => 'product_variants as pv', 
                'on' => [['pv.product_id', 'products.id']]
            ],
            [   
                'type' => 'left',
                'table' => 'product_variant_languages as pvl', 
                'on' => [['pvl.product_variant_id', 'pv.id']]
            ],
            [   
                'table' => 'product_variant_attributes as pva', 
                'on' => [['pva.product_variant_id', 'pv.id']]
            ],
            [   
                'type' => 'left',
                'table' => 'reviews', 
                'on' => [['reviews.reviewable_id', 'products.id'], ['reviews.reviewable_type', 'App\\Models\\Product']]
            ],
        ];
    
        $products = $this->productRepository->paginate(
            $this->paginateSelect(true),
            $condition,
            $perPage,
            $page,
            $extend,
            ['products.id', 'DESC'],
            $join,
            ['languages', 'product_catalogues', 'reviews', 'product_variants'],
            $rawQuery
        );

        $productIds = $products->pluck('id')->toArray();
        $bestPromotions = $this->promotionService->getBestPromotion("product", $productIds);
    
        foreach ($products->items() as $product) {
            if ($promotion = $bestPromotions->firstWhere('product_id', $product->id)) {
                $product->promotion = $promotion;
            }
        }

        $filteredProducts = $products->filter(function($product) use ($priceMin, $priceMax, $rating, $bestPromotions) {
            if ($bestPromotions->firstWhere('product_id', $product->id)) {
                $discountedPrice = $product->promotion->product_price - $product->promotion->finalDiscount; // Giảm giá theo tỷ lệ phần trăm
                $product->price = $discountedPrice;
            } else {
                $product->price = $product->product_variants->first()->price;
            }
        
            if (isset($priceMin) && $product->price <= $priceMin) {
                return false;
            }
        
            if (isset($priceMax) && $product->price >= $priceMax) {
                return false;
            }

            if (!is_null($rating)) {
                if ($product->average_rating >= $rating) {
                    return true;
                }
                return false;
            }
        
            return true;
        });

        if ($isJsonResponse) {
            return response()->json([
                'status' => $filteredProducts ? 'success' : 'error',
                'data' => $filteredProducts ?: null,
                'message' => $filteredProducts ? null : 'Lấy dữ liệu không thành công!'
            ], $products ? 200 : 500);
        }

        return $filteredProducts;
    }

    public function loadProductAnimation($request) {
        $get = $request->input();
        $model = $get['model'];
        $languageId = session('currentLanguage')->id;
        if ($model == 'Product') {
            $page = $request->integer('page');
            $condition = [
                'keyword' => addslashes($request->input('keyword')),
                'products.publish' => 2,
                'where' => [
                    ['tb2.language_id', '=',  $languageId]
                ]
            ];
            $extend['path'] = '/product/index';
            $extend['fieldSearch'] = ['tb2.name', 'tb3.sku'];
            $join = [
                [
                    'table' => 'product_languages as tb2', 
                    'on' => [['tb2.product_id', 'products.id']]
                ],
                [   
                    'type' => 'left',
                    'table' => 'product_variants as tb3',
                    'on' => [['products.id', 'tb3.product_id']]
                ],
                [   
                    'type' => 'left',
                    'table' => 'product_variant_languages as tb4',
                    'on' => [['tb3.id', 'tb4.product_variant_id']]
                ],
            ];
            $objects = $this->productRepository->paginate(
                [
                    'products.id', 
                    'products.image',
                    'products.publish',
                    'tb3.price',
                    'tb3.uuid as variant_uuid',
                    'tb3.quantity',
                    'tb3.sku',
                    'tb2.name',
                    'tb3.id as product_variant_id', 
                    DB::raw('CONCAT(tb2.name, " - ", COALESCE(tb4.name, " Default")) as variant_name'),
                ],
                $condition,
                10,
                $page,
                $extend,
                ['products.id', 'ASC'],
                $join,
            );
        } else {
            $page = $request->integer('page');
            $condition = [
                'keyword' => addslashes($request->input('keyword')),
                'product_catalogues.publish' => 2,
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
            $objects = $this->productCatalogueRepository->paginate(
                [
                    'product_catalogues.id', 
                    'product_catalogues.publish', 
                    'pcl.name',
                ],
                $condition,
                10,
                $page,
                $extend,
                ['product_catalogues.lft', 'ASC'],
                $join,
            );
        }

        if ($objects) {
            return response()->json([
                'status' => 'success',
                'model' => $get['model'],
                'data' => $objects,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "Lấy dữ liệu không thành công!"
            ], 500);
        }
    }

    public function loadVariant($request) {
        $get = $request->input();
        $attributeId = $get['attribute_id'];
        $attributeString = sortAttributeId($attributeId);

        $productVariant = $this->productVariantService->getProductVariant($get, $get['language_id'], $attributeString);
        $bestPromotion = $this->promotionService->getPromotionForProductVariant($get['product_id'], $productVariant);
        $productVariant->promotion = $bestPromotion;

        if ($productVariant) {
            return response()->json([
                'status' => 'success',
                'data' => $productVariant,
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
            $product = $this->createProduct($request);
            if ($product->id > 0) {
                $languageId = session('currentLanguage')->id;
                $controllerName = $this->getControllerMappings();
                $this->updateLanguageForProduct($request, $product, $languageId);
                $this->uploadCatalogueForProduct($product, $request);
                $this->createRouter($request, $product, $controllerName, $languageId);
                
                $product->product_variants()->delete();
                $this->createVariant($product, $request, $languageId);
                $this->productCatalogueService->setAttribute($product, $languageId);
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
            $product = $this->updateProduct($request, $id);
            if ($product) {
                $this->updateLanguageForProduct($request, $product, $languageId);
                $this->uploadCatalogueForProduct($product, $request);
                $this->updateRouter($request, $product, $controllerName, $languageId);
                
                $product->product_variants()->each(function($variant) {
                    $variant->languages()->detach();
                    $variant->attributes()->detach();
                    $variant->delete();
                });
                
                $this->createVariant($product, $request, $languageId);
                $this->productCatalogueService->setAttribute($product, $languageId);

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
            $this->productRepository->delete($id);
            $this->routerRepository->deleteByCondition([
                ['module_id', '=', $id],
                ['controllers' , '=', 'App\Http\Controllers\Frontend\Product\ProductController']
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

    protected function baseProductQuery(array $conditions, bool $multiple = true) {
        return $this->productRepository->findByCondition(
            $conditions,
            $multiple,
            [
                [
                    'table' => 'product_languages as pl',
                    'on' => [['pl.product_id', 'products.id']]
                ]
            ],
            ['products.id' => 'DESC'],
            [
                'products.*',
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

    public function getProductDetails($id, $languageId) {
        $conditions = [
            ['pl.language_id', '=', $languageId],
            ['products.id', '=', $id],
        ];
        return $this->baseProductQuery($conditions, false);
    }

    public function getProductOtherLanguages($id, $languageId) {
        $conditions = [
            ['pl.language_id', '!=', $languageId],
            ['products.id', '=', $id],
        ];
        return $this->baseProductQuery($conditions);
    }
    
    // FRONTEND SERVICE
    public function prepareFrontendProductData($id, $languageId, $isJsonResponse = true) {
        $product = $this->getProductDetails($id, $languageId);
        $productCatalogue = $this->productCatalogueService->getProductCatalogueDetails($product->product_catalogue_id, $languageId);
        $product->promotions = $this->promotionService->getPromotionForProduct('product', $id);
        $product->attributes = $this->attributeService->getAttributeFrontEnd($product, $languageId);
        $seo = seo($product);
    
        if ($isJsonResponse) {
            $productArray = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'content' => $product->content,
                'image' => $product->image,
                'promotions' => $product->promotions,
                'attributes' => $product->attributes,
            ];
    
            return response()->json([
                'status' => 'success',
                'data' => [
                    'product' => $productArray,
                    'seo' => $seo,
                ]
            ], 200, [], JSON_PARTIAL_OUTPUT_ON_ERROR);
        }
    
        return [
            'product' => $product,
            'productCatalogue' => $productCatalogue,
            'seo' => $seo,
        ];
    }

    public function getRelatedProductsByCategory($productCatalogueId, $productId, $languageId) {
        $conditions = [
            ['pl.language_id', '=', $languageId],
            ['products.product_catalogue_id', '=', $productCatalogueId],
            ['products.id', '!=', $productId],
        ];
        $productRelateds = $this->baseProductQuery($conditions);
        foreach ($productRelateds as $product) {
            $this->promotionService->applyPromotionToProduct($product, 'product');
        }

        return $productRelateds;
    }

    private function createVariant($product, $request, $languageId) {
        $payload = $request->only(['variant', 'productVariant', 'attribute']);
        $variant = $this->createVariantArray($payload, $product);
        $createVariants = $product->product_variants()->createMany($variant);
        $variantId = $createVariants->pluck('id');

        $productVariantLanguages = [];
        $productVariantAttributes = [];
        $attributes = $this->combineAttributes(array_values($payload['attribute']));
        if (count($variantId)) {
            foreach($variantId as $key => $val) {
                $productVariantLanguages[] = [
                    'product_variant_id' => $val,
                    'language_id' => $languageId,
                    'name' => $payload['productVariant']['name'][$key]
                ];

                if (count($attributes)) {
                    foreach($attributes[$key] as $attributeId) {
                        $productVariantAttributes[] = [
                            'product_variant_id' => $val,
                            'attribute_id' => $attributeId, 
                        ];
                    }
                }
            }
        }

        $this->productVariantAttributeRepository->createBatch($productVariantAttributes);
        $this->productVariantLanguageRepository->createBatch($productVariantLanguages);
    }

    private function createVariantArray($payload, $product) {
        $variant = [];
        if (isset($payload['variant']['sku']) && count($payload['variant']['sku'])) {
            foreach ($payload['variant']['sku'] as $key => $val) {
                $uuId = Guid::uuid5(Guid::NAMESPACE_DNS, sprintf('%s, %s', $product->id, $payload['productVariant']['id'][$key]));
                $vId = $payload['productVariant']['id'][$key] ?? '';
                $productVariantId = sortString($vId);
                $variant[] = [
                    'uuid' => $uuId,
                    'code' => $productVariantId,
                    'quantity' =>  isset($payload['variant']['quantity'][$key]) ? parseValue($payload['variant']['quantity'][$key]) : 0,
                    'sku' => $val,
                    'price' => isset($payload['variant']['price'][$key]) ? parseValue($payload['variant']['price'][$key]) : 0,
                    'barcode' => ($payload['variant']['barcode'][$key]) ?? '',
                    'file_name' => ($payload['variant']['file_name'][$key]) ?? '',
                    'file_url' => ($payload['variant']['file_url'][$key]) ?? '',
                    'album' => ($payload['variant']['album'][$key]) ?? '',
                    'user_id' => Auth::id(),
                ];
            }
        }

        return $variant;
    }

    private function combineAttributes($attributes = [], $index = 0) {
        if ($index === count($attributes)) return [[]];
        $subCombines = $this->combineAttributes($attributes, $index + 1);
        $combines = [];
        foreach ($attributes[$index] as $val) {
            foreach($subCombines as $valSub) {
                $combines[] = array_merge([$val], $valSub);
            }
        }

        return $combines;
    }

    private function buildProductPayload($request) {
        $payload = $request->only($this->payload());
        $payload['album'] = $this->formatJson($request, 'album');
        $payload['attributeCatalogue'] = $this->formatJson($request, 'attributeCatalogue');
        $payload['attribute'] = $this->formatJson($request, 'attribute');
        $payload['variant'] = $this->formatJson($request, 'variant');
        $payload['user_id'] = Auth::id();
        return $payload;
    }
    
    private function createProduct($request) {
        $payload = $this->buildProductPayload($request);
        return $this->productRepository->create($payload);
    }
    
    private function updateProduct($request, $id) {
        $payload = $this->buildProductPayload($request);
        return $this->productRepository->updateAndGetData($id, $payload);
    }

    private function updateLanguageForProduct($request, $product, $languageId) {
        $payload = $this->formatLanguagePayload($request, $product->id, $languageId);
        $product->languages()->detach($languageId, $product->id);
        return $this->productRepository->createPivot($product, $payload, 'languages');
    }

    private function uploadCatalogueForProduct($product, $request) {
        $product->product_catalogues()->sync($this->catalogue($request));
    }

    private function catalogue($request) {
        if ($request->input('catalogue') != null) {
            return array_unique(
                array_merge(
                    $request->input('catalogue'),
                    [$request->product_catalogue_id]
                )
            );
        }

        return [$request->product_catalogue_id];
    }

    private function payload() {
        return [
            'follow', 
            'publish',
            'made_in', 
            'image', 
            'album', 
            'product_catalogue_id', 
            'attributeCatalogue', 
            'attribute', 
            'variant'
        ];
    }

    private function payloadLanguage() {
        return ['name', 'description', 'content', 'meta_title', 'meta_keyword', 'meta_description', 'canonical'];
    }

    private function formatLanguagePayload($request, $id, $languageId) {
        $payload = $request->only($this->payloadLanguage());
        $payload['product_id'] = $id;
        $payload['language_id'] = $languageId;
        return $payload;
    }

    private function getControllerMappings() {
        return [
            'parent' => 'Product',
            'child' => 'Product'
        ];
    }

    private function paginateSelect($isFrontend = false) {
        $select = [
            'products.id',
            'products.product_catalogue_id',
            'products.publish', 
            'products.image', 
            'products.follow', 
            'pl.name', 
            'pl.canonical',
            'pl.language_id',
        ];
    
        if ($isFrontend) {
            $select[] = DB::raw('AVG(reviews.score) as average_rating');
        }
    
        return $select;
    }
}