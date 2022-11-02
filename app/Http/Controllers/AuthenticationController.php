<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function login(){
        return view('login');
    }
    public function UserLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect("mail")
            ->withSuccess('You have Successfully loggedin');
        }else{
            return redirect("/")->withSuccess('Oppes! You have entered invalid credentials');
        }
    }
    public function Logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
