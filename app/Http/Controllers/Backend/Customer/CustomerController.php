<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\Customer\CustomerService;

use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\CustomerCatalogueRepository;
use App\Repositories\Location\ProvinceRepository;

class CustomerController extends BackendController
{   
    protected $customerService;
    protected $customerRepository;
    protected $customerCatalogueRepository;
    protected $provinceRepository;

    public function __construct(
        CustomerService $customerService, 
        CustomerRepository $customerRepository, 
        CustomerCatalogueRepository $customerCatalogueRepository, 
        ProvinceRepository $provinceRepository
    ) 
    {
        $this->customerService = $customerService;
        $this->customerRepository = $customerRepository;
        $this->customerCatalogueRepository = $customerCatalogueRepository;
        $this->provinceRepository = $provinceRepository;
    }

    public function index(Request $request) {
        $this->authorize('modules', 'customer.index');
        $template = 'backend.customer.customer.index';
        $customerCatalogues = $this->customerCatalogueRepository->all();
        $configs = $this->configs();
        $configs['seo'] = __('messages.customer');
        $configs['method'] = 'index';
        $provinces = $this->provinceRepository->all();
        return view('backend.dashboard.layout', compact(
            'template',
            'configs',
            'customerCatalogues',
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
                'backend/js/pages/customers.js',
            ],
            'css' => [
                'backend/libs/flatpickr/flatpickr.min.css'
            ],
            'model' => 'Customer',
            'modelParent' => 'Customer'
        ];
    }
}
