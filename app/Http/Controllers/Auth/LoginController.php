<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6'
        ]);
        if(Auth::attempt($validated))
        {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }
        else
        {
            return back()->with('error','Invalid Email or Password');
        }
    }
    public function logout(){
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('login')->with('success','Logged out successfully');
    }
}
