<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Repositories\SystemRepository;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends FrontendController
{   
    protected $orderService;

    public function __construct(    
        SystemRepository $systemRepository,
        OrderService $orderService
    ) {
        parent::__construct($systemRepository);
        $this->orderService = $orderService;
    }

    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $systems = $this->getSystem();
        $orderId = $request->orderId;

        $seo = [
            'meta_title' => 'Thông tin thanh toán đơn hàng #' . $orderId,
            'meta_keyword' => '',
            'meta_description' => '',
            'meta_image' => '',
            'canonical' => writeUrl('cart/success', true, true)
        ];

        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        $condition = [['orders.code', '=', $orderId]];
        $order = $this->orderService->getOrder($condition);

        if ($order->isEmpty()) {
            abort(404, 'Đơn hàng không tồn tại.');
        }

        $payload = [
            'payment' => (isset($response['status']) && $response['status'] == "COMPLETED") ? 'paid' : 'failed',
            // 'confirm' => 'confirm',
        ];
        $this->orderService->updatePaymentOnline($payload, $order->first());

        $order = $this->orderService->getOrder($condition);

        $this->mail($order->first()->code, [
            'order' => $order,
            'template' => 'frontend.cart.success'
        ]);

        return view('frontend.homepage.layout', [
            'seo' => $seo,
            'systems' => $systems,
            'data' => ['order' => $order],
            'template' => 'frontend.cart.success'
        ]);
    }

    public function cancel(Request $request)
    {
        echo 'Hủy thanh toán thành công'; die();
    }
}