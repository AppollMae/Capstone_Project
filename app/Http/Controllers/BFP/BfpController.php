<?php

namespace App\Http\Controllers\BFP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BfpController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();
        return view('bfp.dashboard.index', compact('currentUser'));
    }

    public function viewAccountsIndex()
    {
        $accounts = Auth::user();
        return view('bfp.accounts.bfp-view-accounts', compact('accounts'), [
            'ActiveTab' => 'bfp-accounts',
            'SubActiveTab' => 'view-accounts'
        ]);
    }

    public function updateAccountsIndex()
    {
        $accounts = Auth::user();
        return view('bfp.accounts.bfp-update-accounts', compact('accounts'), [
            'ActiveTab' => 'bfp-accounts',
            'SubActiveTab' => 'edit-accounts'
        ]);
    }

    public function updateAccounts(Request $request)
    {
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
