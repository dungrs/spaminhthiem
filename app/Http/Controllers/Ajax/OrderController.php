<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\BackendController;
use App\Services\OrderService;

use Illuminate\Http\Request;

class OrderController extends BackendController
{   
    protected $orderService; 

    public function __construct(OrderService $orderService) {
        $this->orderService = $orderService;
    }

    public function filter(Request $request) {
        $orders = $this->orderService->paginate($request);
        return $orders;
    } 
    
    public function update(Request $request, $id) {
        $response = $this->orderService->update($request, $id);
        return $response;
    }

    public function chart(Request $request) {
        $response = $this->orderService->ajaxOrderChart($request);
        return $response;
    }

    public function donutChart(Request $request) {
        $response = $this->orderService->ajaxDonutOrderChart($request);
        return $response;
    }
}
