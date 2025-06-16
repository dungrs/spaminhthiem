<?php

namespace App\Http\Controllers\Backend\Post;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\Post\PostCatalogueService;

use App\Classes\Nestedsetbie;

class PostCatalogueController extends BackendController
{   
    protected $postCatalogueService;
    protected $nestedSet;
    protected $languageId;

    public function __construct(PostCatalogueService $postCatalogueService) {
        $this->postCatalogueService = $postCatalogueService;
        $this->middleware(function($request, $next) {
            $this->languageId = session('currentLanguage')->id;
            $this->initialize();
            return $next($request);
        });
        $this->initialize();
    }

    public function index(Request $request) {
        $this->authorize('modules', 'post.catalogue.index');
        $template = 'backend.post.catalogue.index';
        $configs = $this->configs();
        $configs['seo'] = __('messages.post_catalogue');
        $configs['method'] = 'index';
        return view('backend.dashboard.layout', compact(
            'template',
            'configs'
        ));
    }

    private function prepareConfigs($method) {
        $configs = $this->configs();
        $configs['seo'] = __('messages.post_catalogue');
        $configs['method'] = $method;
        
        $additionalJs = [
            'backend/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js',
            'backend/libs/ckfinder/ckfinder.js',
            'backend/js/ckfinder.js',
            'backend/js/ckeditor.js',
            'backend/js/seo.js',
        ];

        $configs['js'] = array_merge($configs['js'], $additionalJs);
        
        return $configs;
    }

    public function create() {
        $this->authorize('modules', 'post.catalogue.create');
        $template = 'backend.post.catalogue.store';
        $dropdown = $this->nestedSet->Dropdown();
        $configs = $this->prepareConfigs('create');
        
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
            'dropdown'
        ));
    }

    public function edit($id, $languageId) {
        $this->authorize('modules', 'post.catalogue.update');
        $template = 'backend.post.catalogue.store';
        $this->languageId = $languageId;
        $this->initialize();
        $dropdown = $this->nestedSet->Dropdown();
        $postCatalogue = $this->postCatalogueService->getPostCatalogueDetails($id, $languageId);
        
        $configs = $this->prepareConfigs('edit');

        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
            'dropdown', 
            'postCatalogue'
        ));
    }

    
    public function configs() {
        return [
            'js' => [
                'backend/js/library.js',
                'backend/js/pages/post_catalogues.js'
            ],
            'model' => 'PostCatalogue',
            'modelParent' => 'Post'
        ];
    }

    private function initialize() {
        $this->nestedSet = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' => $this->languageId,
        ]);
    }
}
