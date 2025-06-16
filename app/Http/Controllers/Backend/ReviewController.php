<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\ReviewService;

class ReviewController extends BackendController
{   
    protected $reviewService;

    public function __construct(
        ReviewService $reviewService, 
    ) 
    {
        $this->reviewService = $reviewService;
    }

    public function index(Request $request) {
        $this->authorize('modules', 'review.index');
        $template = 'backend.review.index';
        $configs = $this->configs();
        $configs['seo'] = __('messages.review');
        $configs['method'] = 'index';
        return view('backend.dashboard.layout', compact(
            'template',
            'configs',
        ));
    }

    public function configs() {
        return [
            'js' => [
                'backend/js/library.js',
                'backend/js/pages/reviews.js',
            ],
            'css' => [

            ],
            'model' => 'Review',
            'modelParent' => ''
        ];
    }
}
