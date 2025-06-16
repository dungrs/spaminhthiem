<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\LanguageService;

use App\Repositories\LanguageRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class LanguageController extends BackendController
{   
    protected $languageService;
    protected $languageRepository;
    protected $userRepository;

    public function __construct(
        LanguageService $languageService, 
        LanguageRepository $languageRepository, 
        UserRepository $userRepository, 
    ) 
    {
        $this->languageService = $languageService;
        $this->languageRepository = $languageRepository;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request) {
        $template = 'backend.language.index';
        $languages = $this->languageRepository->all();
        $configs = $this->configs();
        $configs['seo'] = __('messages.language');
        $configs['method'] = 'index';
        return view('backend.dashboard.layout', compact(
            'template',
            'configs',
            'languages',
        ));
    }

    public function switchBackendLanguage($id) {
        $language = $this->languageRepository->findById($id);
        $user = $this->userRepository->findById(Auth::id());
        $user->languageable()->associate($language);
        $user->save();
        $locale = session('backend_locale');
        if (!$locale) {
            $locale = $user->language ? $user->language->canonical : 'vn';
            session(['backend_locale' => $locale]);
        }

        App::setLocale('vn'); 
        return back();
    }

    public function translate($id = 0, $languageId = 1, $modelParent = '', $model = '') {
        $repositoryInstance = resolveInstance($model, $modelParent);
        $languageInstance = resolveInstance('Language');
        $methodLanguage = "get{$model}Details";
        $methodOtherLanguage = "get{$model}OtherLanguages";

        $object = $repositoryInstance->{$methodLanguage}($id, $languageId);
        $objectTranslate = $repositoryInstance->{$methodOtherLanguage}($id, $languageId);
        $languageOther = $languageInstance->getLanguageOtherSelect($languageId);

        $option = [
            'id' => $id,
            'languageId' => $languageId,
            'modelParent' => $modelParent,
            'model' => $model,
        ];

        $template = 'backend.language.translate';
        $configs = [
            'js' => [
                'backend/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js',
                'backend/js/library.js',
                'backend/libs/ckfinder/ckfinder.js',
                'backend/js/ckfinder.js',
                'backend/js/ckeditor.js',
                'backend/js/seo.js',
                'backend/js/translate.js'
            ],
            'seo' => __('messages.language'),
            'method' => 'translate'
        ];
        return view('backend.dashboard.layout', compact(
            'template',
            'configs',
            'object',
            'objectTranslate',
            'languageOther',
            'option'
        ));
    }

    public function configs() {
        return [
            'js' => [
                'backend/libs/flatpickr/flatpickr.min.js',
                'backend/libs/%40simonwep/pickr/pickr.min.js',
                'backend/libs/ckfinder/ckfinder.js',
                'backend/js/ckfinder.js',
                'backend/js/library.js',
                'backend/js/pages/languages.js',
            ],
            'css' => [
                'backend/libs/flatpickr/flatpickr.min.css'
            ],
            'model' => 'Language',
            'modelParent' => ''
        ];
    }
}
