<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function loginView()
    {
        return view('website.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->guard('client')->attempt($credentials)) {
            return redirect()->route('website.page');
        }

        return redirect()->route('website.login')->withErrors([
            'email' => __('language.login_failed'),
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('website.page');
    }
}
