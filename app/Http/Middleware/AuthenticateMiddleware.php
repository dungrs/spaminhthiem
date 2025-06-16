<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\User\UserRepository;

class AuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function handle(Request $request, Closure $next)
    {   
        if (Auth::id() == null) {
            return redirect()->route('auth.admin')->with('error', 'Bạn phải đăng nhập để sử dụng chức năng này.');
        } else {
            $adminInfo = $this->userRepository->findById(Auth::id());
            view()->share('adminInfo', $adminInfo);
        }
        return $next($request);
    }
}
