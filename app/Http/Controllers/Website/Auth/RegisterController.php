<?php

namespace App\Http\Controllers\Website\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Client;


class RegisterController extends Controller
{

    public function registerView()
    {
        return view('website.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        Client::create($validated);
        return redirect()->route('website.login')->with('message','registed successfully');
    }

}