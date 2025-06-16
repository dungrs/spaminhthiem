<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Services\SlideService;
use App\Services\WidgetService;

use App\Services\Post\PostService;

use App\Repositories\SystemRepository;

use App\Classes\SlideEnum;

class HomeController extends FrontendController
{   
    protected $slideService;
    protected $postService;
    protected $widgetService;

    public function __construct(
        SlideService $slideService,
        WidgetService $widgetService,
        PostService $postService,
        SystemRepository $systemRepository,
    ) {
        parent::__construct($systemRepository);
        $this->slideService = $slideService;
        $this->postService = $postService;
        $this->widgetService = $widgetService;
    }

    public function index() {
        $config = $this->config();
        $systems = $this->getSystem();
        $languageId = $this->language;
        $template = 'frontend.homepage.home.index';
        $seo = [
            'meta_title' => $systems['seo_meta_title'],
            'meta_keyword' => $systems['seo_meta_keyword'],
            'meta_description' => $systems['seo_meta_description'],
            'meta_image' => $systems['seo_meta_image'],
            'canonical' => config('app.url')
        ];
        $keywords = [
            'best-seller' => ['keyword' => 'best-seller', 'options' => ['object' => false, 'promotion' => true]],
            'product-most-viewed' => ['keyword' => 'product-most-viewed', 'options' => ['object' => false, 'promotion' => true]],
            'post-hl' => ['keyword' => 'post-hl', 'options' => ['object' => false]],
            'summer-deal-hunt' => ['keyword' => 'summer-deal-hunt', 'options' => ['object' => false]],
        ];

        $slides = $this->slideService->getSlideFrontend([SlideEnum::MAIN]);
        $widgets = $this->widgetService->getWidget($keywords, 1);
        return view('frontend.homepage.layout', compact(
            'template',
            'config',
            'systems',
            'languageId',
            'seo',
            'slides',
            'widgets',
        ));
    }

    private function config() {
        return [
            'language' => $this->language,
            'js' => [
                'frontend/js/pages/products.js',
            ]
        ];
    }
}
