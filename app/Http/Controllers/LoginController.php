<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class LoginController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        if (Auth::check())  return redirect()->route('dashboard');   

        return view('backend/login');
    }

    public function submitLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard')
                ->withSuccess('Signed in');
        }

        return redirect()->route('login')->with(['message' => 'Login details are not valid', 'alert-class' => 'alert-danger']);
    }

    public function forgetPassword()
    {
        if (Auth::check())  return redirect()->route('dashboard');   
        return view('backend/forget');
    }

    public function logout() {
        Session::flush();
        Auth::logout();
  
        return redirect()->route('login');
    }
}
