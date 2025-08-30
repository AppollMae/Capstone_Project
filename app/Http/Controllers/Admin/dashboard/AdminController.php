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
        $currentUser = Auth::user();

        // Fetch all users except admin
        $users = User::whereIn('role', ['MPDO', 'BFP', 'Treasurer', 'OBO'])->get();

        return view('admin.dashboard.dashboard', [
            'currentUser' => $currentUser,
            'users' => $users,
        ]);
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

    public function updateUserRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:user,admin,mpdo,bfp,treasurer,obo',
        ]);

        $user = User::findOrFail($id);
        $oldRole = $user->role;

        // Update role
        $user->role = $request->role;
        $user->save();

        // If the currently logged-in user's role was downgraded to 'user', log them out
        if (Auth::id() == $user->id && $user->role === 'user') {
            Auth::logout();
            return redirect()->route('login')
                ->with('status', 'Your role has been changed to "user". Please log in again.');
        }

        return redirect()->back()->with('success', 'User role updated successfully!');
    }



    public function applicantUserList()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.user_management.applicant-user-list', compact('users'), [
            'ActiveMenu' => 'user_management',
            'SubActive' => 'Applicants'
        ]);
    }
}
