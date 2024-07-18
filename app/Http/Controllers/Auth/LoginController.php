<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    
    public function loginAuth(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required','email'],
        'password' => ['required'],
    ]);

    try {
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'admin') {
                Log::info('Admin logged in.', ['email' => $credentials['email']]);
                return redirect()->route('admin.dashboard');
            } else if (Auth::user()->role == 'approver') {
                Log::info('Approver logged in.', ['email' => $credentials['email']]);
              return redirect()->route('approver.dashboard');
            }
        } else {
            Log::warning('Login failed.', ['email' => $credentials['email']]);
        }
    } catch (\Exception $e) {
        Log::error('Error login.', ['error' => $e->getMessage()]);
    }

    return back()->withErrors([
        'email' => 'Email atau Password salah...',
    ])->onlyInput('email');
}

    public function logout(Request $request){
        try {
            Log::info('User logged out.', ['email' => Auth::user()->email]);
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login');
        } catch (\Exception $e) {
            Log::error('Error logout.', ['error' => $e->getMessage()]);
        }
    }
}
