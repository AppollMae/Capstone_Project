<?php

namespace App\Http\Controllers\OBO\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PermitApplication;
use App\Models\PermitActionHistory;

class OboController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();

        // All under review (seen + unseen)
        $underReviewCount = PermitApplication::where('status', 'under_review')->count();

        // Only unseen under review (for notifications)
        $unseenUnderReviewCount = PermitApplication::where('status', 'under_review')
            ->where('seen', false)
            ->count();

        $pendingCount = PermitApplication::where('status', 'pending')->count();
        $approveCount = PermitApplication::where('status', 'approved')->count();
        $totalApplications = PermitApplication::count();

        return view("OBO-Processing-Team.dashboard.index", compact(
            'currentUser',
            'underReviewCount',
            'unseenUnderReviewCount',
            'pendingCount',
            'approveCount',
            'totalApplications'
        ));
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

    public function underReviewIndex()
    {
        $underReview = PermitApplication::where('status', 'under_review')->count();
        $pendingCounts = PermitApplication::where('status', 'pending')->count();
        $underReviewPermits = PermitApplication::with('reviewer')
            ->where('status', 'under_review')
            ->select('id', 'user_id', 'project_name', 'location', 'status', 'documents', 'created_at', 'reviewed_by')
            ->get();


        // Map permits and add full document URL
        $underReviewPermits->transform(function ($permit) {
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

        $underReviewCount = $underReviewPermits->count();
        $currentUser = Auth::user();

        return view("OBO-Processing-Team.total-permits.under-review", [
            'underReviewPermits' => $underReviewPermits,
            'underReviewCount' => $underReviewCount,
            'currentUser' => $currentUser,
            'ActiveTab' => 'total-permits',
            'SubActiveTab' => 'obo-under-review',
            'underReview' => $underReview,
            'pendingCounts' => $pendingCounts,
        ]);
    }

    public function markAsUnderReview($id)
    {
        $permit = PermitApplication::findOrFail($id);
        $permit->status = 'under_review';
        $permit->reviewed_by = Auth::id();
        $permit->save();

        PermitActionHistory::create([
            'permit_id' => $permit->id,
            'user_id' => Auth::id(),
            'action' => 'under_review',
            'remarks' => 'Permit is under review.',
        ]);

        return back()->with('info', "Permit marked as Under Review by " . Auth::user()->name . ' Office of the Building Official Department!');
    }

    public function approvePermit($id)
    {
        $permit = PermitApplication::findOrFail($id);
        $permit->status = 'approved';
        $permit->approved_by = Auth::id();
        $permit->save();

        PermitActionHistory::create([
            'permit_id' => $permit->id,
            'user_id' => Auth::id(),
            'action' => 'approved',
            'remarks' => 'Permit has been approved.',
        ]);

        return back()->with('success', "Permit approved successfully by " . Auth::user()->name . ' Office of the Building Official Department!');
    }

    public function rejectPermit($id)
    {
        $permit = PermitApplication::findOrFail($id);
        $permit->status = 'rejected';
        $permit->rejected_by = Auth::id();
        $permit->save();

        PermitActionHistory::create([
            'permit_id' => $permit->id,
            'user_id' => Auth::id(),
            'action' => 'rejected',
            'remarks' => 'Permit has been rejected.',
        ]);

        return back()->with('error', "Permit rejected by " . Auth::user()->name . ' Office of the Building Official Department!');
    }

    public function tempDeletePermit($id)
    {
        $permit = PermitApplication::findOrFail($id);
        $permit->status = 'temporarily deleted';
        $permit->deleted_by = Auth::id();
        $permit->save();

        PermitActionHistory::create([
            'permit_id' => $permit->id,
            'user_id' => Auth::id(),
            'action' => 'temporarily deleted',
            'remarks' => 'Permit has been temporarily deleted.',
        ]);

        return back()->with('warning', "Permit temporarily deleted by " . Auth::user()->name . ' Office of the Building Official Department!');
    }

    public function permitApplicationsIndex()
    {
        $permitApplications = PermitApplication::where('status', 'pending')
            ->select('id', 'user_id', 'project_name', 'location', 'status', 'documents', 'created_at')
            ->get();

        // Map permits and add full document URL
        $permitApplications->transform(function ($permit) {
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

        $applicationCount = $permitApplications->count();
        $currentUser = Auth::user();

        return view("OBO-Processing-Team.permit-applications.index", [
            'permitApplications' => $permitApplications,
            'applicationCount' => $applicationCount,
            'currentUser' => $currentUser,
            'ActiveTab' => 'permit-applications',
            'SubActiveTab' => 'obo-permit-applications',
        ]);
    }


    public function permitApplicationsUnderReview()
    {
        $currentUser = Auth::user();

        // Mark all unseen under-review applications as seen
        PermitApplication::where('status', 'under_review')
            ->where('seen', false)
            ->update(['seen' => true]);

        // Fetch applications (now all are seen)
        $underReviewApplications = PermitApplication::with('user')
            ->where('status', 'under_review')
            ->select('id', 'user_id', 'project_name', 'location', 'status', 'documents', 'created_at')
            ->get();

        // Map permits and add full document URL
        $underReviewApplications->transform(function ($permit) {
            if ($permit->documents) {
                $docs = json_decode($permit->documents, true);

                if (is_array($docs) && count($docs) > 0) {
                    $fileName = $docs[0];
                } else {
                    $fileName = $permit->documents;
                }

                $fileName = basename($fileName);
                $permit->document_url = asset('storage/documents/' . $fileName);
            } else {
                $permit->document_url = null;
            }

            return $permit;
        });

        // Recount unseen under-review applications (should now be 0)
        $underReviewCount = PermitApplication::where('status', 'under_review')
            ->where('seen', false)
            ->count();

        return view("OBO-Processing-Team.permit-applications.under-review", [
            'currentUser' => $currentUser,
            'underReviewApplications' => $underReviewApplications,
            'underReviewCount' => $underReviewCount,
            'ActiveTab' => 'permit-applications',
            'SubActiveTab' => 'obo-permit-applications-under-review',
        ]);
    }

    public function pendingPermitsIndex()
    {
        $underReview = PermitApplication::where('status', 'under_review')->count();
        $pendingPermits = PermitApplication::where('status', 'pending')
            ->select('id', 'user_id', 'project_name', 'location', 'status', 'documents', 'created_at', 'description')
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

        $pendingCount = $pendingPermits->count();
        $currentUser = Auth::user();

        return view("OBO-Processing-Team.total-permits.pending-permits", [
            'pendingPermits' => $pendingPermits,
            'pendingCount' => $pendingCount,
            'currentUser' => $currentUser,
            'underReview' => $underReview,
            'ActiveTab' => 'permit-applications',
            'SubActiveTab' => 'obo-pending-permits',
        ]);
    }

    public function approvePermitsIndex()
    {
        $underReview = PermitApplication::where('status', 'under_review')->count();
        $pendingPermits = PermitApplication::where('status', 'pending')->count();
        $approvePermits = PermitApplication::where('status', 'approved')
            ->select('id', 'user_id', 'project_name', 'location', 'status', 'documents', 'created_at', 'description')
            ->get();

        // Map permits and add full document URL
        $approvePermits->transform(function ($permit) {
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

        $approveCount = $approvePermits->count();
        $currentUser = Auth::user();

        return view("OBO-Processing-Team.total-permits.approve-permits", [
            'approvePermits' => $approvePermits,
            'approveCount' => $approveCount,
            'currentUser' => $currentUser,
            'underReview' => $underReview,
            'ActiveTab' => 'total-permits',
            'SubActiveTab' => 'obo-approve-permits',
            'pendingPermits' => $pendingPermits,
        ]);
    }

    public function rejectedPermitsIndex()
    {
        $underReview = PermitApplication::where('status', 'under_review')->count();
        $pendingPermits = PermitApplication::where('status', 'pending')->count();
        $rejectedPermits = PermitApplication::where('status', 'rejected')
            ->select('id', 'user_id', 'project_name', 'location', 'status', 'documents', 'created_at', 'description')
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

        $rejectedCount = $rejectedPermits->count();
        $currentUser = Auth::user();

        return view("OBO-Processing-Team.total-permits.rejected-permits", [
            'rejectedPermits' => $rejectedPermits,
            'rejectedCount' => $rejectedCount,
            'currentUser' => $currentUser,
            'underReview' => $underReview,
            'ActiveTab' => 'total-permits',
            'SubActiveTab' => 'obo-rejected-permits',
            'pendingPermits' => $pendingPermits,
        ]);
    }
}
