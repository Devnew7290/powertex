<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // if (Auth::guard('member')->attempt($credentials, $request->remember)) {
        //     return redirect()->intended('/');
        // }

        if (Auth::guard('member')->attempt($credentials, $request->remember)) {
            $redirect = $request->input('redirect', '/');
            return redirect()->to($redirect);
        }

        return back()->withErrors(['email' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('member')->logout();
        return redirect('/');
    }
}
