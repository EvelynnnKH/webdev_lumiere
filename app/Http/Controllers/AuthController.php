<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login_auth(Request $request){
        $credentials = $request->validate([
            'email'=>'required|email:dns',
            'password'=>'required',
        ]);
        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            // dd('Logged in as:', Auth::user());
            return redirect()->intended('/home'); 
        }

        return back()->with([
            'error'=>'The provided credentials do not match our records.'
        ]);
    }

    public function show(){
        return view('auth.login');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
