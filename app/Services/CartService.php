<?php

namespace App\Services;
use App\Services\Interfaces\CartServiceInterface;

use App\Services\Product\ProductVariantService;
use App\Services\Product\ProductService;
use App\Services\Attribute\AttributeService;
use App\Services\Attribute\AttributeCatalogueService;
use App\Services\BaseService;
use App\Services\PromotionService;
use App\Services\OrderService;

use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductVariantRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PromotionRepository;

use Exception;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;

/**
 * Class CartService
 * @package App\Services
 */
class CartService extends BaseService implements CartServiceInterface
{   
    protected $orderRepository;
    protected $orderService;
    protected $productRepository;
    protected $productService;
    protected $promotionRepository;
    protected $productVariantRepository;
    protected $productVariantService;
    protected $promotionService;
    protected $attributeService;
    protected $attributeCatalogueService;

    public function __construct(
        OrderRepository $orderRepository,
        OrderService $orderService,
        ProductRepository $productRepository,
        ProductVariantRepository $productVariantRepository,
        ProductVariantService $productVariantService,
        ProductService $productService,
        PromotionRepository $promotionRepository,
        PromotionService $promotionService,
        AttributeService $attributeService,
        AttributeCatalogueService $attributeCatalogueService,
        ) {
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
        $this->productVariantService = $productVariantService;
        $this->productService = $productService;
        $this->promotionRepository = $promotionRepository;
        $this->promotionService = $promotionService;
        $this->attributeService = $attributeService;
        $this->attributeCatalogueService = $attributeCatalogueService;
    }

    public function create($request, $languageId = 1)
    {
        DB::beginTransaction();
    
        try {
            $payload = $request->input();
            $productId = $payload['product_id'] ?? null;
            $quantity = $payload['quantity'] ?? 1;
    
            $product = $this->productService->getProductDetails($productId, $languageId);

            $data = [
                'id'     => $product->id,
                'name'   => $product->name,
                'qty'    => $quantity,
                'price'  => $product->price ?? 0,
                'weight' => 0,
            ];
    
            if (!empty($payload['attribute_id'])) {
                $attributeId = $payload['attribute_id'];
                $attributeString = sortAttributeId($attributeId);
                $attributes = $this->attributeService->getAttributeIn($attributeId, $languageId);
            
                $attributeData = [];
                foreach ($attributes as $attribute) {
                    $attributeData[] = [
                        'attribute_catalogue_id' => $attribute->attribute_catalogue_id,
                        'attribute_catalogue_name' => $this->attributeCatalogueService
                            ->getAttributeCatalogueDetails($attribute->attribute_catalogue_id, $languageId)->name,
                        'attribute_id' => $attribute->id,
                        'attribute_name' => $attribute->name,
                    ];
                }
            
                $productVariant = $this->productVariantService->getProductVariant($payload, $languageId, $attributeString);
                
                if ($productVariant) {
                    $data['id'] = $product->id . '_' . $productVariant->uuid;
                    $data['name'] = $product->name . ' ' . ($productVariant->name ?? '');
                    $data['price'] = $productVariant->price ?? 0;
                    $data['options'] = [
                        'attributes' => $attributeData,
                        'image' => $product->image ?? null
                    ];
            
                    $promotion = $this->promotionService->getPromotionForProductVariant($productId, $productVariant)->first();
                    if ($promotion) {
                        $data['price'] = $promotion->product_price - $promotion->finalDiscount;
                    }
                }
            }

            Cart::instance('shopping')->add($data);
            DB::commit();
    
            return response()->json([
                'status'  => 'success',
                'cart'    => Cart::instance('shopping')->content(),
                'message' => 'Sản phẩm đã được thêm vào giỏ hàng thành công!',
            ], 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status'  => 'error',
                'message' => 'Đã xảy ra lỗi khi thêm sản phẩm vào giỏ hàng.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function remakeCart($carts) {
        $cartId = $carts->pluck('id')->all();
        $temp = [];
        $objects = [];

        if(count($cartId)) {
            foreach($cartId as $key => $val) {
                $extract = explode('_', $val);
                if (count($extract) > 1) {
                    $temp['variants'][] = $extract[1];
                } else {
                    $temp['products'][] = $extract[0];
                }
            }
        }

        if (isset($temp['variants']) && count($temp['variants'])) {
            $objects['variants'] = $this->productVariantRepository->findByCondition(
                [
                    ['product_variants.uuid', 'IN', $temp['variants']],
                ],
                true,
                [],
                ['id' => 'DESC']
            )->keyBy('uuid');
        }
    
        if (isset($temp['products']) && count($temp['products'])) {
            $objects['products'] = $this->productRepository->findByCondition(
                [
                    ['products.id', 'IN', $temp['products']],
                ],
                true,
                [],
                ['id' => 'DESC']
            )->keyBy('id');
        }

        foreach ($carts as $cart) {
            $explode = explode('_', $cart->id);
            $objectId = $explode[1] ?? $explode[0];
        
            if (isset($objects['variants'][$objectId])) {
                $variantItem = $objects['variants'][$objectId];
                $albumImages = explode(',', $variantItem->album);
                $variantImage = !empty($albumImages[0]) ? $albumImages[0] : ($cart->options['image'] ?? null);
        
                $cart->image = $variantImage;
                $cart->priceOriginal = $variantItem->price;
            } elseif (isset($objects['products'][$objectId])) {
                $productItem = $objects['products'][$objectId];
                $cart->image = $cart->options['image'] ?? null;
                $cart->priceOriginal = $productItem->price;
            }
        }

        return $carts;
    }

    public function reCalculate() {
        $carts = Cart::instance('shopping')->content();
        $total = 0;
        $totalItem = 0;
        foreach($carts as $cart) {
            $total += $cart->price * $cart->qty;
            $totalItem += $cart->qty;
        }

        return [
            'flag' => true,
            'cartTotal' => $total,
            'cartTotalItems' => $totalItem,
        ];
    }

    public function cartPromotion($cartTotal) {
        $maxDiscount = 0;
        $promotions = $this->promotionRepository->getPromotionByCartTotal();
        $selectedPromotion = null;

        if (!is_null($promotions)) {
            foreach ($promotions as $promotion) {
                $discount = $promotion->discount_information['info'];
                $amountFrom = $discount['amountFrom'] ?? [];
                $amountTo = $discount['amountTo'] ?? [];
                $amountValue = $discount['amountValue'] ?? [];
                $amountType = $discount['amountType'] ?? [];
    
                if (!empty($amountFrom) && count($amountFrom) == count($amountTo) && count($amountTo) == count($amountValue)) {
                    for ($i = 0; $i < count($amountFrom); $i++) {
                        $currentAmountFrom = convert_price($amountFrom[$i], true);
                        $currentAmountTo = convert_price($amountTo[$i], true);
                        $currentAmountValue = convert_price($amountValue[$i], true);
                        $currentAmountType = $amountType[$i];
    
                        if (($cartTotal > $currentAmountFrom && $cartTotal <= $currentAmountTo) || $cartTotal > $currentAmountTo) {
                            if ($currentAmountType == 'cash') {
                                $maxDiscount = max($maxDiscount, $currentAmountValue);
                            } elseif ($currentAmountType == 'percent') {
                                $discountValue = ($currentAmountValue / 100) * $cartTotal;
                                $maxDiscount = max($maxDiscount, $discountValue);
                            }

                            $selectedPromotion = $promotion;
                        }
                    }
                }
            }
        }
    
        return [
            'discount' => $maxDiscount,
            'selectedPromotion' => $selectedPromotion,
        ];
    }

    public function update($request) {
        DB::beginTransaction();    
        try {
            $payload = $request->input();

            [$productId, $variantId] = explode('_', $payload['id']);

            $productVariant = $this->productVariantRepository->findByCondition([
                ['uuid', '=', $variantId]
            ]);

            if (!$productVariant) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Không tìm thấy biến thể sản phẩm.',
                ], 404);
            }

            $totalQtyVariant = $productVariant->quantity;

            if ((int) $payload['qty'] > $totalQtyVariant) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Số lượng yêu cầu vượt quá số lượng còn lại trong kho. Số lượng tối đa có thể đặt là ' . $totalQtyVariant,
                    'max_qty' => $totalQtyVariant // Thêm thông tin số lượng tối đa
                ], 200);
            }

            $cart = Cart::instance('shopping')->update($payload['rowId'], $payload['qty']);
            $cartItem = Cart::instance('shopping')->get($payload['rowId']);
            $cartRecaculate = $this->cartAndPromotion();

            $cartRecaculate['cartItemSubTotal'] = $cartItem->qty * $cartItem->price;

            DB::commit();

            $data = [
                'cart'           => $cart,
                'cartRecaculate' => $cartRecaculate
            ];

            return response()->json([
                'status'  => 'success',
                'data'    => $data,
                'message' => 'Số lượng sản phẩm trong giỏ hàng đã được cập nhật.',
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'  => 'error',
                'message' => 'Đã xảy ra lỗi khi cập nhật sản phẩm trong giỏ hàng.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function delete($request) {
        DB::beginTransaction();
    
        try {
            $payload = $request->input();
            $cart = Cart::instance('shopping')->remove($payload['rowId']);
            $cartRecaculate = $this->cartAndPromotion();
            
            $data = [
                'cart' => $cart,
                'cartRecaculate' => $cartRecaculate
            ];
    
            return response()->json([
                'status'  => 'success',
                'data'    => $data,
                'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng.',
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'  => 'error',
                'message' => 'Đã xảy ra lỗi khi xóa sản phẩm khỏi giỏ hàng.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function deleteAll() {
        DB::beginTransaction();
    
        try {
            Cart::instance('shopping')->destroy();
            $cartRecaculate = $this->cartAndPromotion();
    
            DB::commit();
            return response()->json([
                'status'  => 'success',
                'message' => 'Tất cả sản phẩm đã được xoá khỏi giỏ hàng.',
                'data'    => [
                    'cartRecaculate' => $cartRecaculate
                ]
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'  => 'error',
                'message' => 'Đã xảy ra lỗi khi xoá toàn bộ giỏ hàng.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function order($request) {
        DB::beginTransaction();
    
        try {
            $payload = $this->request($request);
            $order = $this->orderRepository->create($payload);
            if ($order && $order->id > 0) {
                $this->createOrderProduct($payload, $order);
                Cart::instance('shopping')->destroy();
            }
            DB::commit();
            return [
                'order' => $order,
                'status' => true,
            ];
    
        } catch (Exception $e) {
            DB::rollBack();
            return [
                'order' => null,
                'status' => false,
            ];
        }
    }
    
    private function cartAndPromotion() {
        $cartRecaculate = $this->reCalculate();
        $cartPromotion = $this->cartPromotion($cartRecaculate['cartTotal']);
        $cartRecaculate['cartTotal'] = $cartRecaculate['cartTotal'] - $cartPromotion['discount'];
        $cartRecaculate['cartDiscount'] = $cartPromotion['discount'];

        return $cartRecaculate;
    }

    private function createOrderProduct($payload, $order) {
        $temp = [];
        if (!is_null($payload['cart']['details'])) {
            foreach ($payload['cart']['details'] as $key => $val) {
                $extract = explode('_', $val->id);
                $temp[] = [
                    'product_id' => $extract[0],
                    'uuid' => ($extract[1]) ?? null,
                    'name' => $val->name,
                    'qty' => $val->qty,
                    'price' => $val->price,
                    'price_original' => $val->priceOriginal,
                    'option' => json_encode($val->options),
                ];
            }

            $order->products()->sync($temp);
        }
    }

    private function request($request) {
        $carts = Cart::instance('shopping')->content();
        $carts = $this->remakeCart($carts);
        $reCalculateCart = $this->reCalculate();
        $cartPromotion = $this->cartPromotion($reCalculateCart['cartTotal']);
        
        $payload = $request->except(['_token', 'voucher', 'create']);
        $payload['code'] = time();
        $payload['cart'] = $reCalculateCart;
        $payload['cart']['details'] = $carts;
        $payload['promotion']['discount'] = $cartPromotion['discount'] ?? null;
        $payload['promotion']['code'] = $cartPromotion['selectedPromotion']->code ?? 'NO_CODE';
        $payload['promotion']['name'] = $cartPromotion['selectedPromotion']->name ?? 'Không có khuyến mãi';
        $payload['promotion']['start_date'] = $cartPromotion['selectedPromotion']->start_date ?? null;
        $payload['promotion']['end_date'] = $cartPromotion['selectedPromotion']->end_date ?? null;
        $payload['confirm'] = 'pending';
        $payload['delivery'] = 'pending';
        $payload['payment'] = 'unpaid';

        return $payload;
    }
}
