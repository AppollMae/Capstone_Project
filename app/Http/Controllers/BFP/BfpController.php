<?php

namespace App\Http\Controllers\BFP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PermitApplication;
use Illuminate\Support\Facades\DB;

class BfpController extends Controller
{
    // For BFP Dashboard
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

    // For BFP Accounts
    public function viewAccountsIndex()
    {
        $accounts = Auth::user();
        return view('bfp.accounts.bfp-view-accounts', compact('accounts'), [
            'ActiveTab' => 'bfp-accounts',
            'SubActiveTab' => 'view-accounts'
        ]);
    }

    // For BFP Update Accounts
    public function updateAccountsIndex()
    {
        $accounts = Auth::user();
        return view('bfp.accounts.bfp-update-accounts', compact('accounts'), [
            'ActiveTab' => 'bfp-accounts',
            'SubActiveTab' => 'edit-accounts'
        ]);
    }

    // Handle the account update logic
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

    // For BFP View Permits
    public function viewPermitsIndex()
    {
        $currentUser = Auth::user();
        $underReview = PermitApplication::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');
        $pendingPermits = PermitApplication::whereIn('status', ['pending', 'under_review', 'approved', 'rejected'])
            ->select('id', 'user_id', 'project_name', 'location', 'status', 'reviewed_by', 'documents', 'created_at', 'description')
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

        return view('BFP.total-permits.index', compact('pendingPermits', 'currentUser', 'underReview'), [
            'ActiveTab' => 'bfp-permits',
            'SubActiveTab' => 'view-permits',
            'linkActiveTab' => 'bfp-permits',
        ]);
    }

    // Mark permit as Under Review
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

    // For BFP Pending Permits dashboard
    public function pendingPermitsIndex()
    {
        $currentUser = Auth::user();
        $underReview = PermitApplication::where('status', 'under_review')->count();
        $pendingPermits = PermitApplication::where('status', 'pending')
            ->select('id', 'user_id', 'project_name', 'location', 'status', 'reviewed_by', 'description', 'documents', 'created_at')
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

        return view('BFP.total-permits.pending-permit', compact('pendingPermits', 'currentUser'), [
            'ActiveTab' => 'bfp-permits',
            'SubActiveTab' => 'view-pending-permits',
            'linkActiveTab' => 'bfp-permits',
        ]);
    }

    // For BFP Approved Permits dashboard
    public function approvePermitsIndex()
    {
        $currentUser = Auth::user();
        $underReview = PermitApplication::where('status', 'under_review')->count();
        $approveApplications = PermitApplication::where('status', 'approved')
            ->select('id', 'user_id', 'project_name', 'location', 'status', 'reviewed_by', 'description', 'documents', 'created_at')
            ->get();

        // Map permits and add full document URL
        $approveApplications->transform(function ($permit) {
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

        return view('BFP.total-permits.approve-permits', compact('approveApplications', 'currentUser', 'underReview'), [
            'ActiveTab' => 'bfp-permits',
            'SubActiveTab' => 'view-approve-permits',
            'linkActiveTab' => 'bfp-permits',
        ]);
    }

    public function rejectedPermitsIndex()
    {
        $currentUser = Auth::user();
        $underReview = PermitApplication::where('status', 'under_review')->count();
        $rejectedPermits = PermitApplication::where('status', 'rejected')
            ->select('id', 'user_id', 'project_name', 'location', 'status', 'reviewed_by', 'description', 'documents', 'created_at')
            ->get();

        // Map permits and add full document URL
        $rejectedPermits->transform(function ($permit) {
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

        return view('BFP.total-permits.rejected-permits', compact('rejectedPermits', 'currentUser', 'underReview'), [
            'ActiveTab' => 'bfp-permits',
            'SubActiveTab' => 'view-rejected-permits',
            'linkActiveTab' => 'bfp-permits',
        ]);
    }

    public function totalPermitsIndex()
    {
        $currentUser = Auth::user();

        // Count under review permits only
        $underReview = PermitApplication::where('status', 'under_review')->count();
        $totalPermitsCounts = PermitApplication::count();


        // Get ALL permits without filtering status
        $totalPermits = PermitApplication::select(
            'id',
            'user_id',
            'project_name',
            'location',
            'status',
            'reviewed_by',
            'description',
            'documents',
            'created_at'
        )->get();

        // Map permits and add full document URL
        $totalPermits->transform(function ($permit) {
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

        return view('BFP.total-permits.total-permits', compact('totalPermits', 'currentUser', 'underReview', 'totalPermitsCounts'), [
            'ActiveTab' => 'bfp-permits',
            'SubActiveTab' => 'view-total-permits',
            'linkActiveTab' => 'bfp-permits-under-review',
        ]);
    }
}
