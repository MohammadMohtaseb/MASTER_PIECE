<?php

namespace App\Http\Controllers\Parent\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.parent.login');

    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('parent')->attempt($credentials)) {
            return redirect()->route('parent.home');
        }
        return back()->withErrors(['email' => 'Invalid credentials.']);

    }

    public function logout(Request $request)
    {
        Auth::guard('parent')->logout();
        return redirect()->route('parent.login');
    }
}
