<?php

namespace App\Http\Controllers\Frontend\Post;

use App\Http\Controllers\FrontendController;
use App\Repositories\SystemRepository;
use App\Repositories\Post\PostCatalogueRepository;
use App\Services\Post\PostCatalogueService;
use App\Services\Post\PostService;

class PostController extends FrontendController
{   
    protected $postCatalogueRepository;
    protected $postCatalogueService;
    protected $postService;

    public function __construct(    
        SystemRepository $systemRepository,
        PostCatalogueRepository $postCatalogueRepository,
        PostCatalogueService $postCatalogueService,
        PostService $postService,
    ) {
        parent::__construct($systemRepository);
        $this->postCatalogueRepository = $postCatalogueRepository;
        $this->postCatalogueService   = $postCatalogueService;
        $this->postService            = $postService;
    }

    public function index($request, $canonical, $id)
    {
        $config     = $this->config();
        $template   = 'frontend.post.post.index';
        $systems    = $this->getSystem();
        $languageId = $this->language;

        $data            = $this->postService->prepareFrontendPostData($id, $languageId, false);
        $post            = $data['post'];
        $postCatalogue   = $data['postCatalogue'];
        $seo             = $data['seo'];

        $postRelateds = $this->postService->getRelatedPostsByCategory(
            $postCatalogue->id, 
            $id, 
            $languageId
        );

        $postCatalogues = $this->postCatalogueRepository->findByCondition(
            [
                ['pcl.language_id', '=', $languageId],
                ['post_catalogues.publish', '=', 2]
            ],
            true,
            [
                [
                    'table' => 'post_catalogue_languages as pcl',
                    'on' => [['pcl.post_catalogue_id', 'post_catalogues.id']]
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

        $breadcrumb = $this->postCatalogueService->breadcrumb(
            "PostCatalogue", 
            "Post",
            $postCatalogue, 
            $languageId
        );

        // Render view
        return view('frontend.homepage.layout', compact(
            'template',
            'config',
            'systems',
            'languageId',
            'postCatalogue',
            'postCatalogues',
            'post',
            'postRelateds',
            'seo',
            'breadcrumb',
        ));
    }

    public function config()
    {
        return [
            'language' => $this->language,
            'js' => [
                'frontend/js/pages/posts.js',
                'frontend/js/pages/reviews.js',
            ]
        ];
    }
}