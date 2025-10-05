<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class MainAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        session(['from' => Route::currentRouteName()]);

        if (!Auth::guard('hoosh')->check() && !Auth::guard('main')->check()) {
            return redirect()->route('login.index');
        }

        return $next($request);
    }
}
