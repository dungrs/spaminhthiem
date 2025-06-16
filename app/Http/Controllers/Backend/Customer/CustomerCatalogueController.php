<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\Customer\CustomerCatalogueService;
use App\Repositories\Customer\CustomerCatalogueRepository;
use App\Repositories\PermissionRepository;

class CustomerCatalogueController extends BackendController
{   
    protected $customerCatalogueService;
    protected $customerCatalogueRepository;
    protected $permissionRepository;

    public function __construct(
        CustomerCatalogueService $customerCatalogueService, 
        CustomerCatalogueRepository $customerCatalogueRepository,
        PermissionRepository $permissionRepository,
        ) {
        $this->customerCatalogueService = $customerCatalogueService;
        $this->customerCatalogueRepository = $customerCatalogueRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index(Request $request) {
        $this->authorize('modules', 'customer.catalogue.index');
        $template = 'backend.customer.catalogue.index';
        $configs = $this->configs();
        $configs['seo'] = __('messages.customer_catalogue');
        $configs['method'] = 'index';
        return view('backend.dashboard.layout', compact(
            'template',
            'configs'
        ));
    }

    public function permission() {
        $this->authorize('modules', 'permission.index');
        $customerCatalogues = $this->customerCatalogueRepository->all(['permissions']);
        $permissions = $this->permissionRepository->all();
        $template = 'backend.customer.catalogue.permission';
        $configs['seo'] = __('messages.customer_catalogue');
        $configs['method'] = 'permission';
        return view('backend.dashboard.layout', compact(
            'template',
            'customerCatalogues',
            'permissions',
            'configs'
        ));
    }

    public function configs() {
        return [
            'js' => [
                'backend/js/library.js',
                'backend/js/pages/customer_catalogues.js'
            ],
            'model' => 'CustomerCatalogue',
            'modelParent' => 'Customer'
        ];
    }
}
