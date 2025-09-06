<?php

namespace App\Http\Controllers\OBO\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PermitApplication;

class OboController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();
        return view("OBO-Processing-Team.dashboard.index", compact('currentUser'));
    }

    public function viewAccountsIndex()
    {
        $accounts = Auth::user();
        return view("OBO-Processing-Team.accounts.obo-view-accounts", compact('accounts'), [
            'ActiveTab' => 'view-accounts',
            'SubActiveTab' => 'obo-view-accounts'
        ]);
    }

    public function updateAccountsIndex()
    {
        $accounts = Auth::user();
        return view("OBO-Processing-Team.accounts.obo-update-accounts", compact('accounts'), [
            'ActiveTab' => 'update-accounts',
            'SubActiveTab' => 'obo-update-accounts'
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update basic fields
        $user->name = $request->name;
        $user->email = $request->email;

        // Handle avatar if uploaded
        if ($request->hasFile('avatar')) {
            // Store in /storage/app/public/avatars
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()
            ->route('obo.accounts.edit-accounts', Auth::user()->id)
            ->with('success', 'Profile updated successfully!');
    }

    public function totalPermitsIndex()
    {
        $pendingPermits = PermitApplication::where('status', 'pending')->get();
        $pendingCount = $pendingPermits->count();
        $currentUser = Auth::user();

        return view("OBO-Processing-Team.total-permits.index", [
            'pendingPermits' => $pendingPermits,
            'pendingCount' => $pendingCount,
            'currentUser' => $currentUser,
            'ActiveTab' => 'total-permits',
            'SubActiveTab' => 'obo-total-permits',
        ]);
    }
}
