<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;

use App\Repositories\SystemRepository;
use App\Repositories\Location\ProvinceRepository;

use App\Services\Customer\CustomerService;

use Illuminate\Http\Request;
use App\Http\Requests\Customer\UpdateCustomerRequest;


use Illuminate\Support\Facades\Auth;

class CustomerController extends FrontendController
{   
    protected $customerService;
    protected $provinceRepository;

    public function __construct(
        SystemRepository $systemRepository, 
        CustomerService $customerService, 
        ProvinceRepository $provinceRepository,
        ) {
        parent::__construct($systemRepository);
        $this->customerService = $customerService;
        $this->provinceRepository = $provinceRepository;
    }

    public function profile() {
        if (Auth::guard('customer')->check()) {
            $template = 'frontend.customer.profile';
            $extra = [
                'template' => $template
            ];
            return view('frontend.homepage.layout', $this->prepareViewData($extra));
        } else {
            return redirect()->route('home.index');
        }
    }

    public function orderHistory() {
        if (Auth::guard('customer')->check()) {
            $template = 'frontend.customer.orders';
            $extra = [
                'template' => $template
            ];
            return view('frontend.homepage.layout', $this->prepareViewData($extra));
        } else {
            return redirect()->route('home.index');
        }
    }

    public function update(UpdateCustomerRequest $request, $id) {
        $customer = $this->customerService->update($request, $id, false);
        if ($customer) {
            return back()->with([
                'success' => 'Cập nhật thông tin thành công!'
            ]);
        } else {
            return back()->with([
                'error' => 'Có lỗi xảy ra. Vui lòng thử lại sau.'
            ]);
        }
    }
    
    protected function prepareViewData(array $extra = []) {
        $config = $this->config();
        $systems = $this->getSystem();
        $provinces = $this->provinceRepository->all();

        $seo = [
            'meta_title' => $systems['seo_meta_title'] ?? '',
            'meta_keyword' => $systems['seo_meta_keyword'] ?? '',
            'meta_description' => $systems['seo_meta_description'] ?? '',
            'meta_image' => $systems['seo_meta_image'] ?? '',
            'canonical' => config('app.url')
        ];
        
        $base = compact('config', 'systems', 'seo', 'provinces');

        return array_merge($base, $extra);
    }

    private function config() {
        return [
            'language' => $this->language,
            'js' => [
                'frontend/js/pages/auths.js',
                'backend/js/library.js',
                'backend/js/location.js',
                'frontend/js/library.js',
                'frontend/js/pages/orders.js',
            ],
        ];
    }
}