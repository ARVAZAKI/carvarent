<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    
    public function loginAuth(Request $request){
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);
        if(Auth::attempt($credentials)){
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin.dashboard');
            }else if(Auth::user()->role == 'approver'){
                dd('hai');
            }
        }
        return back()->withErrors([
            'email' => 'Email atau Password salah...',
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
