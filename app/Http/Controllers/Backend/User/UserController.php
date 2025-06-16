<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\User\UserService;

use App\Repositories\User\UserRepository;
use App\Repositories\User\UserCatalogueRepository;
use App\Repositories\Location\ProvinceRepository;

class UserController extends BackendController
{   
    protected $userService;
    protected $userRepository;
    protected $userCatalogueRepository;
    protected $provinceRepository;

    public function __construct(
        UserService $userService, 
        UserRepository $userRepository, 
        UserCatalogueRepository $userCatalogueRepository, 
        ProvinceRepository $provinceRepository
    ) 
    {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->userCatalogueRepository = $userCatalogueRepository;
        $this->provinceRepository = $provinceRepository;
    }

    public function index(Request $request) {
        $this->authorize('modules', 'user.index');
        $template = 'backend.user.user.index';
        $userCatalogues = $this->userCatalogueRepository->all();
        $configs = $this->configs();
        $configs['seo'] = __('messages.user');
        $configs['method'] = 'index';
        $provinces = $this->provinceRepository->all();
        return view('backend.dashboard.layout', compact(
            'template',
            'configs',
            'userCatalogues',
            'provinces'
        ));
    }

    public function configs() {
        return [
            'js' => [
                'backend/libs/flatpickr/flatpickr.min.js',
                'backend/libs/%40simonwep/pickr/pickr.min.js',
                'backend/libs/ckfinder/ckfinder.js',
                'backend/js/password_visiable.js',
                'backend/js/ckfinder.js',
                'backend/js/location.js',
                'backend/js/library.js',
                'backend/js/pages/users.js',
            ],
            'css' => [
                'backend/libs/flatpickr/flatpickr.min.css'
            ],
            'model' => 'User',
            'modelParent' => 'User'
        ];
    }
}
