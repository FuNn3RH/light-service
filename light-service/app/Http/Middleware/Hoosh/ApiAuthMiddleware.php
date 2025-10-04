<?php

namespace App\Http\Middleware\Hoosh;

use App\Models\Hoosh\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $username = $request->header('username');
        $password = $request->header('password');

        $user = User::where('username',  $username)->first();

        if (!$user) {
            return response()->json([
                'error' => 'Unauthorized: Invalid username or password'
            ], 401);
        } elseif (!Hash::check($password, $user->password)) {
            return response()->json([
                'error' => 'Unauthorized: Invalid username or password'
            ], 401);
        }

        return $next($request);
    }
}
