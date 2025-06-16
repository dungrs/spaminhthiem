<?php 

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

class DashboardController extends BackendController {

    public function __construct() {

    }

    public function orderStatistic(Request $request) {
        
    }

    public function changeStatus(Request $request, $id) {
        $post = $request->input();
        $serviceClass = resolveInstance($post['model'], $post['modelParent'] ?? '');
        $response = $serviceClass->updateStatus($post, $id);
        return $response;
    }

    public function changeStatusAll(Request $request) {
        $post = $request->input();
        $serviceClass = resolveInstance($post['model'], $post['modelParent'] ?? '');
        $response = $serviceClass->updateStatusAll($post);
        return $response;
    }
}
