<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $attribute = $request->validate([
            'email' => 'required|email|',
            'password' => 'required|min:5'
        ]);

        if (! Auth::attempt($attribute)){
            throw ValidationException::withMessages([
                'email' => 'credientials didnt match'
            ]) ;
        }

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('home');
    }
}
