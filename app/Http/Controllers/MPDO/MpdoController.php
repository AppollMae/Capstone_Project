<?php

namespace App\Http\Controllers\MPDO;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MpdoController extends Controller
{
    public function index()
    {
        return view('MPDO.dashboard.index');
    }


    public function viewAccountsIndex()
    {
        $accounts = Auth::user();
        return view('MPDO.accounts.mpdo-view-accounts', compact('accounts'), [
            'ActiveTabMenu' => 'accounts',
            'SubActiveTabMenu' => 'mpdo-view-accounts'
        ]);
    }


    public function updateAccountsIndex($id)
    {
        $account = User::findOrFail($id);
        return view('MPDO.accounts.mpdo-update-accounts', compact('account'), [
            'ActiveTabMenu' => 'accounts',
            'SubActiveTabMenu' => 'mpdo-update-accounts'
        ]);
    }

    public function updateAccounts(Request $request)
    {
        $user = Auth::user();

        // Ensure user is a valid model instance
        if (!($user instanceof User)) {
            $user = User::findOrFail(Auth::id());
        }

        // Validate input
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update basic info
        $user->name  = $request->name;
        $user->email = $request->email;

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        // Redirect back to the MPDO account edit page with success message
        return redirect()
            ->route('mpdo.accounts.mpdo-edit-accounts', ['id' => $user->id])
            ->with('success', 'Your profile has been updated successfully!');
    }
}
