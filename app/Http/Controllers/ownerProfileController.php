<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ownerProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $users = User::where('role', '!=', 'owner')->get();
        return view('owner.profile', compact('user', 'users'));
    }

    public function update(Request $request){
        $request->validate([
            'email' => 'required|string|email|unique:users,email,'.Auth::id(),
            'password' => 'nullable|string|min:5|confirmed',
        ]);

        $user = Auth::user();
        $user->email = $request->email;

        if($request->filled('password')){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('owner.profile')->with('status', 'Profile updated successfully!');

    }
}
