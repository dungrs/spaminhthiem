<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\User\UserCatalogueService;
use App\Repositories\User\UserCatalogueRepository;
use App\Repositories\PermissionRepository;

class UserCatalogueController extends BackendController
{   
    protected $userCatalogueService;
    protected $userCatalogueRepository;
    protected $permissionRepository;

    public function __construct(
        UserCatalogueService $userCatalogueService, 
        UserCatalogueRepository $userCatalogueRepository,
        PermissionRepository $permissionRepository,
        ) {
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository = $userCatalogueRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index(Request $request) {
        $this->authorize('modules', 'user.catalogue.index');
        $template = 'backend.user.catalogue.index';
        $configs = $this->configs();
        $configs['seo'] = __('messages.user_catalogue');
        $configs['method'] = 'index';
        return view('backend.dashboard.layout', compact(
            'template',
            'configs'
        ));
    }

    public function permission() {
        $this->authorize('modules', 'permission.index');
        $userCatalogues = $this->userCatalogueRepository->all(['permissions']);
        $permissions = $this->permissionRepository->all();
        $template = 'backend.user.catalogue.permission';
        $configs['seo'] = __('messages.user_catalogue');
        $configs['method'] = 'permission';
        return view('backend.dashboard.layout', compact(
            'template',
            'userCatalogues',
            'permissions',
            'configs'
        ));
    }

    public function updatePermission(Request $request) {
        if ($this->userCatalogueService->setPermission($request)) {
            return redirect()->route('user.catalogue.index')->with("success", "Cập nhật quyền thành công");
        } else {
            return redirect()->route('user.catalogue.index')->with("error", "Có vấn đề xảy ra xin vui lòng thử lại");
        }
    }

    public function configs() {
        return [
            'js' => [
                'backend/js/library.js',
                'backend/js/pages/user_catalogues.js'
            ],
            'model' => 'UserCatalogue',
            'modelParent' => 'User'
        ];
    }
}
