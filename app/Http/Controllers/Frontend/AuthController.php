<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;

use App\Repositories\SystemRepository;

use App\Services\Customer\CustomerService;

use Illuminate\Http\Request;
use App\Http\Requests\Customer\StoreCustomerRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

use Gloudemans\Shoppingcart\Facades\Cart;

class AuthController extends FrontendController
{   
    protected $customerService;

    public function __construct(SystemRepository $systemRepository, CustomerService $customerService) {
        parent::__construct($systemRepository);
        $this->customerService = $customerService;
    }

    public function showLogin() {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('home.index');
        }
        $template = 'frontend.auth.form';
        $extra = [
            'login' => 'active',
            'template' => $template
        ];
        return view('frontend.homepage.layout', $this->prepareViewData($extra));
    }
    
    public function showRegister() {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('home.index');
        }
        $template = 'frontend.auth.form';
        $extra = [
            'register' => 'active',
            'template' => $template
        ];
        return view('frontend.homepage.layout', $this->prepareViewData($extra));
    }

    public function login(Request $request) {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'publish' => 2,
        ];
    
        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->route('home.index')->with([
                'success' => 'Chào mừng bạn quay trở lại!'
            ]);
        }
    
        return back()->with([
            'error' => 'Email hoặc mật khẩu không đúng. Vui lòng kiểm tra lại.'
        ]);
    }
    
    public function logout() {
        if (Auth::guard('customer')->check()) {
            Auth::guard('customer')->logout();
            Cart::instance('shopping')->destroy();
    
            Session::forget('customer_data');
            Cookie::queue(Cookie::forget('customer_data'));
        }
    
        return redirect()->route('home.index')->with([
            'success' => 'Bạn đã đăng xuất thành công.'
        ]);
    }
    
    public function register(StoreCustomerRequest $request) {
        $customer = $this->customerService->create($request, false);
        if ($customer) {
            return redirect()->route('customer.showLogin')->with([
                'success' => 'Đăng ký thành công! Vui lòng đăng nhập để tiếp tục.'
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

        $seo = [
            'meta_title' => $systems['seo_meta_title'] ?? '',
            'meta_keyword' => $systems['seo_meta_keyword'] ?? '',
            'meta_description' => $systems['seo_meta_description'] ?? '',
            'meta_image' => $systems['seo_meta_image'] ?? '',
            'canonical' => config('app.url')
        ];
        
        $base = compact('config', 'systems', 'seo');

        return array_merge($base, $extra);
    }

    private function config()
    {
        return [
            'language' => $this->language,
            'js' => [
                'frontend/js/pages/auths.js',
            ],
        ];
    }
}