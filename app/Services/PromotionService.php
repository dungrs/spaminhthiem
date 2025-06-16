<?php 

namespace App\Services;

use App\Services\Interfaces\PromotionServiceInterface;
use App\Services\BaseService;

use App\Repositories\PromotionRepository;
use App\Repositories\RouterRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Classes\PromotionEnum;

class PromotionService extends BaseService implements PromotionServiceInterface {
    protected $promotionRepository;

    public function __construct(PromotionRepository $promotionRepository) {
        $this->promotionRepository = $promotionRepository;
    }

    public function paginate($request) {
        $perpage = $request->input('perpage');
        $page = $request->integer('page');
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish'),
        ];
        $extend['path'] = '/promotion/index';
        $extend['fieldSearch'] = ['name'];

        $promotions = $this->promotionRepository->paginate(
            $this->paginateSelect(),
            $condition,
            $perpage,
            $page,
            $extend,
        );

        if ($promotions) {
            return response()->json([
                'status' => 'success',
                'data' => $promotions,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "Lấy dữ liệu không thành công!"
            ], 500);
        }
    }

    public function getPromotionConditionValue($request) {
        try {
            $get = $request->input();
            switch ($get['value']) {
                case 'staff_take_care_customer':
                    $class = resolveInstance('User', 'User', 'Repositories', 'Repository');
                    $objects = $class->all()->toArray();
                    break;
                case 'customer_group':
                    $class = resolveInstance('CustomerCatalogue', 'Customer', 'Repositories', 'Repository');
                    $objects = $class->all()->toArray();
                    break;
                case 'customer_gender':
                    $objects = __('module.gender');
                    break;
                case 'customer_birthday':
                    $objects = __('module.day');
                    break;
            }

            $temp = [];
            if (!is_null($objects) && count($objects) > 0) {
                foreach ($objects as $key => $val) {
                    $temp[] = [
                        'id' => $val['id'],
                        'name' => $val['name']
                    ];
                }
            }

            return response()->json([
                'data' => $temp,
                'error' => false,
                'selectValue' => $get['value']
            ]);

        } catch(\Exception $e) {
            return response()->json([
                'messages' => $e->getMessage(),
                'error' => true,
            ]);
        }  
    }

    public function getPromotionValue() {
        $types = [
            'staff_take_care_customer' => [
                'model' => 'User',
                'modelParent' => 'User',
            ],
            'customer_group' => [
                'model' => 'CustomerCatalogue',
                'modelParent' => 'Customer',
            ],
            'customer_gender' => __('module.gender'),
            'customer_birthday' => __('module.day'),
        ];
    
        $result = [];
    
        foreach ($types as $key => $type) {
            $objects = [];
    
            if (is_array($type) && isset($type['model'], $type['modelParent'])) {
                $class = resolveInstance($type['model'], $type['modelParent'], 'Repositories', 'Repository');
    
                if (method_exists($class, 'all')) {
                    $objects = $class->all()->toArray();
                }
            } elseif (is_array($type)) {
                $objects = $type;
            }
    
            if (empty($objects)) {
                $result[$key] = [];
                continue;
            }
    
            foreach ($objects as $keyObj => $val) {
                $result[$key][] = [
                    'id' => is_array($val) ? ($val['id'] ?? $keyObj) : $keyObj,
                    'name' => is_array($val) ? ($val['name'] ?? '') : $val,
                ];
            }
        }
    
        return $result;
    }

    public function create($request) {
        DB::beginTransaction();

        try {
            $payload = $this->payload($request);
            $promotion = $this->handlePromotionMethod($payload, $request);
            if ($promotion) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.create_success'),
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

    public function update($request, $id) {
        DB::beginTransaction();

        try {
            $payload = $this->payload($request);
            $promotion = $this->handlePromotionMethod($payload, $request, $id);
            if ($promotion) {
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
            $this->promotionRepository->delete($id);
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

    public function getPromotionDetails($id) {
        return $this->promotionRepository->findById($id);
    }

    public function getInputProductAndQuantity($promotion) {
        return [
            'discountValue' => $promotion->discountValue,
            'discountType' => $promotion->discountType,
            'maxDiscountValue' => $promotion->maxDiscountValue,
        ];
    }

    // FRONTEND SERVICE
    public function applyPromotionToProduct(&$product, $tableChild) {
        $bestPromotions = $this->getBestPromotion($tableChild, [$product->id]);
        if ($promotion = $bestPromotions->firstWhere('product_id', $product->id)) {
            $product->promotion = $promotion;
        }
    }

    public function getBestPromotion($tableChild, $itemIdPromotions, $extend = []) {
        $condition = [
            ['promotions.publish', '=', 2],
            ["{$tableChild}s.publish", '=', 2],
            ["{$tableChild}s.id", 'IN', $itemIdPromotions],
            ['promotions.end_date', '>', now()],
            ['promotions.start_date', '<', now()],
        ];

        if (!empty($extend) && isset($extend['condition'])) {
            $condition[] = $extend['condition'];
        }

        $joins = [
            [
                'table' => "promotion_{$tableChild}_variants as ppv",
                'on' => [["ppv.promotion_id", "promotions.id"]]
            ],
            [
                'table' => "{$tableChild}s",
                'on' => [["{$tableChild}s.id", "ppv.{$tableChild}_id"]]
            ],
            [
                'table' => "{$tableChild}_variants",
                'on' => [["{$tableChild}_variants.uuid", "ppv.variant_uuid"]]
            ]
        ];

        $select = [
            DB::raw("
                CASE 
                    WHEN promotions.discountType = 'cash' THEN promotions.discountValue 
                    WHEN promotions.discountType = 'percent' THEN 
                        LEAST(
                            {$tableChild}_variants.price * promotions.discountValue / 100,
                            CASE 
                                WHEN promotions.maxDiscountValue > 0 THEN promotions.maxDiscountValue 
                                ELSE 1e9 
                            END
                        )
                    ELSE 0 
                END AS finalDiscount
            "),
            "{$tableChild}s.id AS product_id",
            "{$tableChild}_variants.price AS product_price",
            "{$tableChild}_variants.uuid AS variant_uuid",
            "promotions.discountType",
            "promotions.discountValue",
            "promotions.maxDiscountValue"
        ];

        $groupBy = [
            "{$tableChild}s.id",
            "{$tableChild}_variants.price",
            'promotions.discountType',
            'promotions.discountValue',
            'promotions.maxDiscountValue',
            "{$tableChild}_variants.uuid"
        ];

        $promotion = $this->promotionRepository->findByCondition(
            $condition,
            true,
            $joins,
            ["{$tableChild}s.id" => 'ASC'],
            $select,
            [],
            null,
            $groupBy,
        );

        $bestPromotions = collect($promotion)
            ->groupBy("{$tableChild}_id")
            ->map(fn($group) => $group->sortByDesc('finalDiscount')->first())
            ->values();

        return $bestPromotions;
    }

    public function applyPromotionToProductCollection($productCollection, $productSource, $tableChild) {
        $itemIdPromotions = $productSource->pluck('id')->unique();
        $bestPromotions = $this->getBestPromotion($tableChild, $itemIdPromotions);
    
        return $productCollection->map(function ($product) use ($bestPromotions) {
            if ($promotion = $bestPromotions->firstWhere('product_id', $product->id)) {
                $product->promotion = $promotion;
            }
            return $product;
        });
    }

    public function getPromotionForProduct($tableChild, $productId) {
        $promotions = $this->promotionRepository->findByCondition(
            [
                ['promotions.publish', '=', 2],
                ["{$tableChild}s.publish", '=', 2],
                ["{$tableChild}s.id", '=', $productId],
                ['promotions.end_date', '>', now()],
                ['promotions.start_date', '<', now()],
            ],
            true,
            [
                [
                    'table' => "promotion_{$tableChild}_variants as ppv",
                    'type' => 'inner',
                    'on' => [
                        ['ppv.promotion_id', 'promotions.id']
                    ]
                ],
                [
                    'table' => "{$tableChild}s",
                    'type' => 'inner',
                    'on' => [
                        ["{$tableChild}s.id", "ppv.{$tableChild}_id"]
                    ]
                ],
                [
                    'table' => "{$tableChild}_variants",
                    'type' => 'inner',
                    'on' => [
                        ["{$tableChild}_variants.uuid", "ppv.variant_uuid"]
                    ]
                ],
            ],
            ["{$tableChild}s.id" => 'ASC'],
            [
                DB::raw("CASE 
                    WHEN promotions.discountType = 'cash' THEN promotions.discountValue 
                    WHEN promotions.discountType = 'percent' THEN ({$tableChild}_variants.price * promotions.discountValue / 100) 
                    ELSE 0 
                END AS finalDiscount"),
                "{$tableChild}s.id AS {$tableChild}_id",
                "{$tableChild}_variants.uuid AS variant_uuid",
                "{$tableChild}_variants.price AS variant_price",
                "promotions.discountType",
                "promotions.discountValue",
                "promotions.maxDiscountValue"
            ],
            [],
            null,
            [
                "{$tableChild}s.id",
                "{$tableChild}_variants.uuid",
                "{$tableChild}_variants.price",
                'promotions.discountType',
                'promotions.discountValue',
                'promotions.maxDiscountValue'
            ],
            8
        );

        return collect($promotions)->map(function ($promotion) {
            $finalDiscount = $promotion->discountType == 'cash'
                ? $promotion->discountValue
                : ($promotion->variant_price * $promotion->discountValue / 100);

            return [
                'discountType' => $promotion->discountType,
                'discountValue' => $promotion->discountValue,
                'variant_uuid' => $promotion->variant_uuid,
                'finalDiscount' => $finalDiscount,
                'product_price' => $promotion->variant_price,
                'finalPrice' => $promotion->variant_price - $finalDiscount
            ];
        });
    }

    public function getPromotionForProductVariant($product_id, $productVariant) {
        $productList = [$product_id];
        $extend['condition'] =  ['ppv.variant_uuid', '=', $productVariant->uuid];
        $bestPromotion = $this->getBestPromotion("product", $productList, $extend);
        return $bestPromotion;
    }

    private function handlePromotionMethod($payload, $request, $id = null) {
        $promotion = null;
        
        switch ($payload['method']) {
            case PromotionEnum::ORDER_AMOUNT_RANGE:
                $payload['discount_information'] = $this->orderByRange($request);
                $payload['discountType'] = '';
                $promotion = $this->handlePromotionCreateOrUpdate($id, $payload);
                break;
            case PromotionEnum::PRODUCT_AND_QUANTITY:
                $payload['quantity'] = parseValue($request->input('product_and_quantity.quantity'));
                $payload['discountValue'] = parseValue($request->input('product_and_quantity.discountValue'));
                $payload['maxDiscountValue'] = parseValue($request->input('product_and_quantity.maxDiscountValue'));
                $payload['discountType'] = $request->input('product_and_quantity.discountType');
                $payload['discount_information'] = $this->productAndQuantity($request);

                $promotion = $this->handlePromotionCreateOrUpdate($id, $payload);
                $this->createPromotionProduct($promotion, $request);
                break;
        }
    
        return $promotion;
    }

    private function orderByRange($request) {
        $data['info'] = $request->input('promotion_order_amount_range');
        return $data + $this->handleSourceAndCondition($request);
    }

    private function createPromotionProduct($promotion, $request) {
        $model = $request->input('select-product-and-quantity');
        $object = $request->input('object');
    
        if (!in_array($model, ['Product', 'ProductCatalogue']) || empty($object['name'])) {
            return;
        }
    
        $payloadRepository = array_map(function ($key) use ($object, $promotion, $model) {
            $payload = [
                'promotion_id' => $promotion->id,
                'model' => $model,
            ];
    
            if ($model === 'Product') {
                $payload['product_id'] = $object['product_id'][$key] ?? null;
                $payload['variant_uuid'] = $object['variant_uuid'][$key] ?? null;
            } else {
                $payload['product_catalogue_id'] = $object['product_catalogue_id'][$key] ?? null;
            }
    
            return $payload;
        }, array_keys($object['name']));
    
        if ($model === 'Product') {
            $promotion->products()->sync($payloadRepository);
        } else {
            $promotion->product_catalogues()->sync($payloadRepository);
        }
    }
    
    private function handlePromotionCreateOrUpdate($id, $payload) {
        if ($id) {
            $promotion = $this->promotionRepository->update($id, $payload);
            $promotion = $this->promotionRepository->findById($id);
        } else {
            $promotion = $this->promotionRepository->create($payload);
        }
        
        return $promotion;
    }

    private function productAndQuantity($request) {
        $data['info']['model'] = $request->input('select-product-and-quantity');
        $data['info']['object'] = $request->input('object');
        
        return $data + $this->handleSourceAndCondition($request);
    }

    private function handleSourceAndCondition($request) {
        $data = [
            'source' => [
                'status' => $request->input('source'),
                'data' => $request->input('sourceValue')
            ],
            'apply' => [
                'status' => $request->input('apply'),
                'data' => $request->input('applyValue')
            ]
        ];

        if (!is_null($data['apply']['data'])) {
            foreach($data['apply']['data'] as $key => $val) {
                $data['apply']['condition'][$val] = $request->input($val);
            }
        }

        return $data;
    }

    private function payload($request) {
        $payload = $request->only(
            'name',
            'code',
            'description',
            'method',
            'start_date',
            'end_date',
            'never_end_date'
        );

        $payload['start_date'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $payload['start_date']);
        if (isset($payload['end_date'])) {
            $payload['end_date'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $payload['end_date']);
        }

        $payload['code'] = (empty($payload['code'])) ? time() : $payload['code'];

        return $payload;
    }


    private function paginateSelect() {
        return [
            '*'
        ];
    }
}