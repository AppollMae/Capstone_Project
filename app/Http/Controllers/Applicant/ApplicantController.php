<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ApplicantController extends Controller
{
    public function index()
    {
        return view('applicant.dashboard.index');
    }

    public function applicantsIndex()
    {
        $accounts = Auth::user();
        return view('applicant.accounts.applicant-view-accounts', compact('accounts'), [
            'ActiveTab' => 'applicants',
            'SubActiveTab' => 'View-accounts'
        ]);
    }

    public function updateAccountsIndex()
    {
        $account = Auth::user();
        return view('applicant.accounts.applicant-update-accounts', compact('account'), [
            'ActiveTab' => 'applicants',
            'SubActiveTab' => 'Update-accounts'
        ]);
    }

    public function updateAccounts(Request $request)
    {
        $accounts = Auth::user();

        // Ensure $accounts is an instance of App\Models\User
        if (!($accounts instanceof User)) {
            $accounts = User::findOrFail(Auth::id());
        }

        // Validate request data
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255|unique:users,email,' . $accounts->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update basic fields
        $accounts->name  = $request->name;
        $accounts->email = $request->email;

        // Handle avatar if uploaded
        if ($request->hasFile('avatar')) {
            // Store in /storage/app/public/avatars
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $accounts->avatar = $avatarPath;
        }

        $accounts->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }


    public function permitsIndex()
    {
        return view('applicant.permit.applicant-view-permits', [
            'ActiveTab' => 'applicants',
            'SubActiveTab' => 'View-permits'
        ]);
    }

    // ApplicantController.php
    public function applyForPermit()
    {
        return view('applicant.permits.applicants-apply-permits');
    }
}
