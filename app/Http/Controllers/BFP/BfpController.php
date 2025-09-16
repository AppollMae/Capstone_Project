<?php

namespace App\Http\Controllers\BFP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PermitApplication;

class BfpController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();
        $totalApplicants = User::where('role', 'user')->count();
        $pendingPermits = PermitApplication::where('status', 'pending')->count();
        $underReviewPermits = PermitApplication::where('status', 'under_review')->count();
        $approveApplications = PermitApplication::where('status', 'approved')->count();
        return view(
            'bfp.dashboard.index',
            compact(
                'currentUser',
                'totalApplicants',
                'pendingPermits',
                'underReviewPermits',
                'approveApplications'
            )
        );
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

    public function viewPermitsIndex()
    {
        $currentUser = Auth::user();
        $pendingPermits = PermitApplication::whereIn('status', ['pending', 'under_review', 'approved', 'rejected'])
            ->select('id', 'user_id', 'project_name', 'location', 'status', 'reviewed_by', 'documents', 'created_at')
            ->get();

        // Map permits and add full document URL
        $pendingPermits->transform(function ($permit) {
            if ($permit->documents) {
                // Decode JSON safely
                $docs = json_decode($permit->documents, true);

                if (is_array($docs)) {
                    $fileName = $docs[0]; // get first element
                } else {
                    $fileName = $permit->documents;
                }

                // Remove unwanted paths like "documents//" or "documents/"
                $fileName = basename($fileName);

                // Build final URL (public/documents/)
                $permit->document_url = asset('storage/documents/' . $fileName);
            } else {
                $permit->document_url = null;
            }

            return $permit;
        });

        return view('BFP.total-permits.index', compact('pendingPermits', 'currentUser'), [
            'ActiveTab' => 'bfp-permits',
            'SubActiveTab' => 'view-permits'
        ]);
    }

    public function markUnderReviewIndex($id)
    {
        $currentUser = Auth::user();
        $permit = PermitApplication::find($id);
        $permit->status = 'under_review';
        if ($currentUser->role === 'bfp') {
            // Additional logic for BFP role
            $permit->reviewed_by = $currentUser->id;
        }
        $permit->save();

        return redirect()->back()->with('success', 'Permit marked as Under Review.');
    }
}
