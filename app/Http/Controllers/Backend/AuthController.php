<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;

class AuthController extends BackendController
{
    public function __construct() {

    }

    public function index() {
        $configs = $this->config();
        if (Auth::id() > 0) {
            return redirect()->route('dashboard.index');
        }

        return view('backend.auth.login', compact(
            'configs'
        ));
    }

    public function login(AuthRequest $request) {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'publish' => 2,
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard.index')->with('success', 'Đăng nhập thành công!');
        } else {
            return redirect()->route('auth.admin')->with('error', "Email hoặc Mật khẩu không chính xác");
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.admin');
    }

    public function config() {
        return [
            'js' => [
                'backend/js/password_visiable.js'
            ]
        ];
    }
}
