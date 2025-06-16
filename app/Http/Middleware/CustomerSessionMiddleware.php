<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class CustomerSessionMiddleware
{
    public function handle($request, Closure $next)
    {
        Config::set('session.cookie', 'customer_session');

        return $next($request);
    }
}
