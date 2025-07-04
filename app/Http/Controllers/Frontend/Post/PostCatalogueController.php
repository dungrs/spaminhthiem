<?php

namespace App\Http\Controllers\Frontend\Post;

use App\Http\Controllers\FrontendController;
use App\Repositories\SystemRepository;
use App\Repositories\Post\PostCatalogueRepository;
use App\Services\Post\PostCatalogueService;
use App\Services\Post\PostService;
use App\Services\WidgetService;

class PostCatalogueController extends FrontendController
{   
    protected $postCatalogueRepository;
    protected $postCatalogueService;
    protected $postService;
    protected $widgetService;

    public function __construct(    
        PostCatalogueRepository $postCatalogueRepository,
        PostCatalogueService $postCatalogueService,
        PostService $postService,
        WidgetService $widgetService,
        SystemRepository $systemRepository,
    ) {
        parent::__construct($systemRepository);
        $this->postCatalogueRepository = $postCatalogueRepository;
        $this->postCatalogueService    = $postCatalogueService;
        $this->postService             = $postService;
        $this->widgetService           = $widgetService;
    }

    public function index($request, $page, $id)
    {
        $config     = $this->config();
        $systems    = $this->getSystem();
        $template   = 'frontend.post.catalogue.index';
        $languageId = $this->language;

        // Lấy thông tin danh mục
        $postCatalogue      = $this->postCatalogueService->getPostCatalogueDetails($id, $languageId);
        $postCatalogueById  = $this->postCatalogueService->getPostCatalogueDetails($id, $languageId);

        // SEO & breadcrumb
        $seo        = seo($postCatalogue, $page);
        $breadcrumb = $this->postCatalogueService->breadcrumb(
            "PostCatalogue", 
            "Post", 
            $postCatalogue, 
            $languageId
        );

        // Lấy danh sách danh mục
        $postCatalogues = $this->postCatalogueRepository->findByCondition(
            [
                ['pcl.language_id', '=', $languageId],
                ['post_catalogues.publish', '=', 2],
            ],
            true,
            [
                [
                    'table' => 'post_catalogue_languages as pcl',
                    'on' => [['pcl.post_catalogue_id', 'post_catalogues.id']],
                ]
            ],
            ['post_catalogues.id' => 'DESC'],
            [
                'post_catalogues.*',
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

        // Widget liên quan
        $keywords = [
            'post-hl' => ['keyword' => 'post-hl', 'options' => ['object' => false]],
        ];
        $widgets = $this->widgetService->getWidget($keywords, 1);

        return view('frontend.homepage.layout', compact(
            'template',
            'config',
            'systems',
            'languageId',
            'seo',
            'breadcrumb',
            'postCatalogues',
            'postCatalogue',
            'postCatalogueById',
            'widgets',
        ));
    }

    public function config()
    {
        return [
            'language' => $this->language,
            'js' => [
                'backend/js/library.js',
                'frontend/js/pages/posts.js',
            ],
        ];
    }
}