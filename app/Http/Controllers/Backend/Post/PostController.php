<?php

namespace App\Http\Controllers\Backend\Post;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\Post\PostService;

use App\Classes\Nestedsetbie;

class PostController extends BackendController
{   
    protected $postService;
    protected $nestedSet;
    protected $languageId;

    public function __construct(PostService $postService) {
        $this->postService = $postService;
        $this->middleware(function($request, $next) {
            $this->languageId = session('currentLanguage')->id;
            $this->initialize();
            return $next($request);
        });
        $this->initialize();
    }

    public function index(Request $request) {
        $this->authorize('modules', 'post.index');
        $template = 'backend.post.post.index';
        $dropdown = $this->nestedSet->Dropdown();
        $configs = $this->configs();
        $configs['seo'] = __('messages.post');
        $configs['method'] = 'index';
        return view('backend.dashboard.layout', compact(
            'template',
            'configs',
            'dropdown'
        ));
    }

    public function create() {
        $this->authorize('modules', 'post.create');
        $template = 'backend.post.post.store';
        $dropdown = $this->nestedSet->Dropdown();
        $configs = $this->prepareConfigs('create');
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
            'dropdown'
        ));
    }

    public function edit($id, $languageId) {
        $this->authorize('modules', 'post.update');
        $template = 'backend.post.post.store';
        $this->languageId = $languageId;
        $this->initialize();
        $dropdown = $this->nestedSet->Dropdown();
        $post = $this->postService->getPostDetails($id, $languageId);
        $configs = $this->prepareConfigs('edit');
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
            'dropdown', 
            'post'
        ));
    }
    
    public function configs() {
        return [
            'js' => [
                'backend/js/library.js',
                'backend/js/pages/posts.js'
            ],
            'model' => 'Post',
            'modelParent' => 'Post'
        ];
    }
    
    private function prepareConfigs($method) {
        $configs = $this->configs();
        $configs['seo'] = __('messages.post');
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

    private function initialize() {
        $this->nestedSet = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' => $this->languageId,
        ]);
    }
}
