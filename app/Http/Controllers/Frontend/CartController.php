<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;

use App\Repositories\SystemRepository;
use App\Repositories\Location\ProvinceRepository;

use App\Http\Requests\Cart\StoreCartRequest;

use App\Services\CartService;
use App\Services\OrderService;

use App\Classes\Vnpay;
use App\Classes\Momo;
use App\Classes\Paypal;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CartController extends FrontendController
{   
    protected $orderService;
    protected $cartService;
    protected $provinceRepository;
    protected $orderRepository;
    protected $vnpay;
    protected $momo;
    protected $paypal;

    public function __construct(
        SystemRepository $systemRepository,
        ProvinceRepository $provinceRepository,
        CartService $cartService,
        OrderService $orderService,
        Vnpay $vnpay,
        Momo $momo,
        Paypal $paypal,
    ) {
        parent::__construct($systemRepository);
        $this->provinceRepository = $provinceRepository;
        $this->cartService = $cartService;
        $this->orderService = $orderService;
        $this->vnpay = $vnpay;
        $this->momo = $momo;
        $this->paypal = $paypal;
    }

    public function cart() {
        if (Auth::guard('customer')->check()) {
            $carts = Cart::instance('shopping')->content();
            $reCalculateCart = $this->cartService->reCalculate('shopping');
            $cartPromotion = $this->cartService->cartPromotion($reCalculateCart['cartTotal']);
            $carts = $this->cartService->remakeCart($carts);
            $seo = [
                'meta_title' => 'Trang thanh toán đơn hàng',
                'meta_keyword' => '',
                'meta_description' => '',
                'meta_image' => '',
                'canonical' => writeUrl('gio-hang', true, true)
            ];

            $template = 'frontend.cart.cart';
            $extra = [
                'template' => $template,
                'seo' => $seo,
                'carts' => $carts,
                'reCalculateCart' => $reCalculateCart,
                'cartPromotion' => $cartPromotion
            ];
            return view('frontend.homepage.layout', $this->prepareViewData($extra));
        } else {
            return redirect()->route('home.index');
        }
    }

    public function checkout(Request $request) {
        if (Auth::guard('customer')->check()) {
            $checkoutMode = $request->input('action_type') ?? 'shopping';
            $carts = Cart::instance($checkoutMode)->content();
            $reCalculateCart = $this->cartService->reCalculate($checkoutMode);
            $cartPromotion = $this->cartService->cartPromotion($reCalculateCart['cartTotal']);
            $carts = $this->cartService->remakeCart($carts);
            $seo = [
                'meta_title' => 'Trang thanh toán đơn hàng',
                'meta_keyword' => '',
                'meta_description' => '',
                'meta_image' => '',
                'canonical' => writeUrl('thanh-toan', true, true)
            ];

            $template = 'frontend.cart.checkout';
            $extra = [
                'template' => $template,
                'seo' => $seo,
                'carts' => $carts,
                'reCalculateCart' => $reCalculateCart,
                'cartPromotion' => $cartPromotion,
                'checkoutMode' => $checkoutMode,
            ];

            return view('frontend.homepage.layout', $this->prepareViewData($extra));
        } else {
            return redirect()->route('home.index');
        }
    }

    public function store(StoreCartRequest $request) {
        $checkoutMode = $request->input('action_type') ?? 'shopping';
        $order = $this->cartService->order($request, $checkoutMode);
        if ($order['status']) {
            if ($order['order']->method === 'cod') {
                return redirect()->route('cart.success', ['code' => $order['order']->code])->with('success', 'Đặt hàng thành công');
            } else {
                $response = $this->paymentOnline($order);
                if ($response['resultCode'] === 0) {
                    return redirect()->away($response['url']);
                }
            }
        }
        return redirect()->route('checkout')->with('error', 'Đặt hàng không thành công. Hãy thử lại');
    }

    public function success($code) {
        if (Auth::guard('customer')->check()) {
            $condition = [
                ['orders.code', '=', $code]
            ];
            $order = $this->orderService->getOrder($condition);
            $seo = [
                'meta_title' => 'Trang thanh toán đơn hàng',
                'meta_keyword' => '',
                'meta_description' => '',
                'meta_image' => '',
                'canonical' => writeUrl('tinh-trang-thanh-toan', true, true)
            ];

            $template = 'frontend.cart.success';
            $data = [
                'order' => $order,
            ];
            $extra = [
                'template' => $template,
                'seo' => $seo,
                'data' => $data,
            ];
            return view('frontend.homepage.layout', $this->prepareViewData($extra));
        } else {
            return redirect()->route('home.index');
        }
    }

    public function paymentOnline($order = null) {
        $class = $order['order']->method;
        return $this->{$class}->payment($order['order']);
    }

    protected function prepareViewData(array $extra = []) {
        $config = $this->config();
        $systems = $this->getSystem();
        $provinces = $this->provinceRepository->all();
        
        $base = compact('config', 'provinces', 'systems');

        return array_merge($base, $extra);
    }

    private function config() {
        return [
            'language' => $this->language,
            'js' => [
                'backend/js/library.js',
                'backend/js/location.js',
                'frontend/js/pages/auths.js',
                'frontend/js/pages/carts.js',
            ],
        ];
    }
}
