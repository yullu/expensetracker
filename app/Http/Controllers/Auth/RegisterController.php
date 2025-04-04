<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        $record = new User();
        $record->name = $request->name;
        $record->email = $request->email;
        $record->password = Hash::make($request->password);
        $record->save();
        return redirect('/register')->with('success', 'Registration Successful!, You can now login using your credentials.');

    }
}
