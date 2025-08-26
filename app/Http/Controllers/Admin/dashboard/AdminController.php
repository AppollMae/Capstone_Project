<?php

namespace App\Http\Controllers\Admin\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        return view('admin.dashboard.dashboard', compact('users'));
    }

    public function userManagementIndex()
    {
        $users = User::all();
        return view('admin.user_management.user-list', compact('users'), [
            'ActiveMenu' => 'user_management',
            'SubActive' => 'Staff/Inspector'
        ]);
    }

    public function showUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user_management.user-management', compact('user'));
    }


    public function updateUserManagement(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:user,admin,mpdo',
        ]);

        $user = User::findOrFail($id);
        $oldRole = $user->role;

        $user->role = $request->role;
        $user->save();

        // If the currently logged-in user's role was downgraded to user
        if (Auth::id() == $user->id && $user->role === 'user') {
            Auth::logout();
            return redirect()->route('login')->with('status', 'Your role was changed. Please log in again.');
        }

        return back()->with('status', 'Role updated successfully!');
    }

    
}
