<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function promote(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,librarian',
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'User promoted to ' . $request->role . '.');
    }


    public function demote(User $user)
    {
        $user->role = 'user';
        $user->save();

        return redirect()->back()->with('success', 'User demoted to user.');
    }

}
