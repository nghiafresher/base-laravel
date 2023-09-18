<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }
    public function authenticate(AuthRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        if(Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard')
                ->with('message', 'You have successfully logged in!');
        }

        return back()->with('error', 'Your provided credentials do not match in our records.')->onlyInput('email');
    }

    public function logout()
    {
        if(auth()->check()) {
            auth()->logout();
            return redirect()->route('admin.login')->with('Logout success');
        }
        return redirect()->back()->with('Logout false');
    }
}
