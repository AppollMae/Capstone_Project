<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TreasurerController extends Controller
{
    public function index()
    {
        return view('treasurer.dashboard.index');
    }


    public function viewAccountsIndex()
    {
        $accounts = Auth::user();
        return view('treasurer.accounts.view-accounts', compact('accounts'), [
            'ActiveTab' => 'treasurer',
            'SubActiveTab' => 'accounts'
        ]);
    }

    public function updateAccountsIndex()
    {
        $accounts = Auth::user();
        return view('treasurer.accounts.update-accounts', compact('accounts'), [
            'ActiveTab' => 'treasurer',
            'SubActiveTab' => 'accounts'
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
