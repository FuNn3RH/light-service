<?php

namespace App\Http\Controllers\Hoosh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $user = Auth::guard('hoosh')->user();

        if (!Auth::guard('hoosh')->check()) {
            return redirect()->route('hoosh.login');
        }

        return redirect()->route(
            $user->role === 'admin' ? 'hoosh.admin.dashboard' : 'hoosh.users.dashboard'
        );
    }
}
