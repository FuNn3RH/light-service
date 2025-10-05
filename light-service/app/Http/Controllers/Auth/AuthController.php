<?php

namespace App\Http\Controllers\Auth;

use App\Models\MainUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    public function index()
    {

        if (Auth::guard('hoosh')->check() || Auth::guard('main')->check()) {
            if (session()->has('from')) {
                $from = session()->get('from');

                if (in_array($from, ['login.index', 'login.login'])) {
                    return redirect()->route('share.index');
                }

                return redirect()->route(session()->get('from'));
            }
        }

        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = MainUser::whereUsername($request->username)->first();
        if ($user && $user->password === $request->password) {
            Auth::guard('main')->login($user, true);

            if (session()->has('from')) {
                return redirect()->route(session()->get('from'));
            }

            return redirect()->route('share.index');
        }

        return redirect()->route('login.index')->withErrors(['username' => "نام کاربری یا رمز عبور نادرست است"]);
    }
}
