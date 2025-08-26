<?php

namespace App\Http\Controllers\Admin\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountsController extends Controller
{
    // Show list of all accounts
    public function ViewAccountsIndex()
    {
        $accounts = Auth::user();
        return view('admin.accounts.view-accounts', compact('accounts'), [
            'ActiveTab' => 'view-accounts',
            'SubActiveTab' => 'account-details'
        ]);
    }

    public function updateAccountsIndex($id)
    {
        $user = User::findOrFail($id); // Fetch the user from DB
        return view('admin.accounts.update-accounts', compact('user'), [
            'ActiveTab' => 'update-accounts',
            'SubActiveTab' => 'account-details'
        ]);
    }


    public function updateAccounts(Request $request)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Ensure $user is an instance of App\Models\User
        if (!($user instanceof User)) {
            $user = User::findOrFail(Auth::id());
        }

        // Validate request data
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update basic fields
        $user->name  = $request->name;
        $user->email = $request->email;

        // Handle avatar if uploaded
        if ($request->hasFile('avatar')) {
            // Store in /storage/app/public/avatars
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
