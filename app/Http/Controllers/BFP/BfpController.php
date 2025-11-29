<?php

namespace App\Http\Controllers\BFP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PermitApplication;
use App\Models\PermitIssue;
use App\Models\BfpInspections;
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
        $bfpInspectors = User::whereIn('role', [
            'bfp_inspector',
            'bfp_inspector_I',
            'bfp_inspector_II',
            'bfp_inspector_III',
            'bfp_inspector_IV',
            'bfp_inspector_V'
        ])->count();

        $inspectors = User::whereIn('role', [
            'bfp_inspector',
            'bfp_inspector_I',
            'bfp_inspector_II',
            'bfp_inspector_III',
            'bfp_inspector_IV',
            'bfp_inspector_V'
        ])->get();

        $bfpInspections = BfpInspections::all()->count();
        $issueFlags = PermitIssue::where('permit_id', '!=', null)->count();
        $approveApplications = PermitApplication::where('status', 'approved')->count();
        return view(
            'bfp.dashboard.index',
            compact(
                'currentUser',
                'totalApplicants',
                'pendingPermits',
                'underReviewPermits',
                'approveApplications',
                'bfpInspectors',
                'inspectors',
                'issueFlags',
                'bfpInspections'
            )
        );
    }

    // For BFP Accounts
    public function viewAccountsIndex()
    {
        $accounts = Auth::user();
        $bfprole = User::whereIn('role', [
            'bfp_inspector',
            'bfp_inspector_I',
            'bfp_inspector_II',
            'bfp_inspector_III',
            'bfp_inspector_IV',
            'bfp_inspector_V'
        ])->get();
        return view('bfp.accounts.bfp-view-accounts', compact('accounts', 'bfprole'), [
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

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    // For BFP View Permits
    public function viewPermitsIndex()
    {
        $currentUser = Auth::user();
        $Permits = PermitApplication::where('status', 'pending')->count();
        $underReview = PermitApplication::where('status', 'under_review')->count();
        $statuses = PermitApplication::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');
        $totalPermits = $statuses->sum();
        $pendingPermits = PermitApplication::whereIn(
            'status',
            [
                'pending',
                'under_review',
                'approved',
                'rejected'
            ]
        )
            ->select(
                'id',
                'user_id',
                'project_name',
                'location',
                'status',
                'reviewed_by',
                'documents',
                'created_at',
                'description'
            )
            ->paginate(10);

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

        return view(
            'BFP.total-permits.index',
            compact(
                'pendingPermits',
                'currentUser',
                'statuses',
                'totalPermits',
                'Permits',
                'underReview'
            ),
            [
                'ActiveTab' => 'bfp-permits',
                'SubActiveTab' => 'view-permits',
                'linkActiveTab' => 'bfp-permits',
            ]
        );
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
        $Permits = PermitApplication::where('status', 'pending')->count();
        $statuses = PermitApplication::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');
        $totalPermitsAll = $statuses->sum();
        $pendingPermits = PermitApplication::where('status', 'pending')
            ->select(
                'id',
                'user_id',
                'project_name',
                'location',
                'status',
                'reviewed_by',
                'description',
                'documents',
                'created_at'
            )
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

        return view('BFP.total-permits.pending-permit', compact('pendingPermits', 'currentUser', 'underReview', 'Permits', 'totalPermitsAll'), [
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
            ->select(
                'id',
                'user_id',
                'project_name',
                'location',
                'status',
                'reviewed_by',
                'description',
                'documents',
                'created_at'
            )
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

        return view(
            'BFP.total-permits.approve-permits',
            compact(
                'approveApplications',
                'currentUser',
                'underReview'
            ),
            [
                'ActiveTab' => 'bfp-permits',
                'SubActiveTab' => 'view-approve-permits',
                'linkActiveTab' => 'bfp-permits',
            ]
        );
    }

    public function rejectedPermitsIndex()
    {
        $currentUser = Auth::user();
        $underReview = PermitApplication::where('status', 'under_review')->count();
        $rejectedPermits = PermitApplication::where('status', 'rejected')
            ->select(
                'id',
                'user_id',
                'project_name',
                'location',
                'status',
                'reviewed_by',
                'description',
                'documents',
                'created_at'
            )
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

        return view(
            'BFP.total-permits.rejected-permits',
            compact(
                'rejectedPermits',
                'currentUser',
                'underReview'
            ),
            [
                'ActiveTab' => 'bfp-permits',
                'SubActiveTab' => 'view-rejected-permits',
                'linkActiveTab' => 'bfp-permits',
            ]
        );
    }

    public function totalPermitsIndex()
    {
        $currentUser = Auth::user();

        // Count under review permits only
        $underReview = PermitApplication::where('status', 'under_review')->count();
        $statuses = PermitApplication::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');
        $totalPermitsAll = $statuses->sum();

        $Permits = PermitApplication::where('status', 'pending')->count();
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
        )
            ->where('status', 'under_review') // 👈 only under_review
            ->get();

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

        return view(
            'BFP.total-permits.total-permits',
            compact(
                'totalPermits',
                'currentUser',
                'underReview',
                'statuses',
                'totalPermitsAll',
                'Permits'
            ),
            [
                'ActiveTab' => 'bfp-permits',
                'SubActiveTab' => 'view-total-permits',
                'linkActiveTab' => 'bfp-permits-under-review',
            ]
        );
    }

    public function bfpInspectorsIndex()
    {

        $currentUser = Auth::user();
        $inspectors = User::whereIn('role', [
            'bfp_inspector',
            'bfp_inspector_I',
            'bfp_inspector_II',
            'bfp_inspector_III',
            'bfp_inspector_IV',
            'bfp_inspector_V'
        ])->get();

        // dd($inspectors->pluck('id', 'role'));

        return view('BFP.inspector.bfp-inspector', compact('inspectors', 'currentUser'), [
            'ActiveTab' => 'bfp-accounts',
            'SubActiveTab' => 'view-inspectors',
        ]);
    }

    public function updateInspectorRoleStore(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:bfp_inspector,bfp_inspector_I,bfp_inspector_II,bfp_inspector_III,bfp_inspector_IV,bfp_inspector_V',
        ]);
        $user = User::find($validated['user_id']);
        $user->role = $validated['role'];
        $user->save();

        return redirect()->route('bfp.inspectors.view-inspectors')
            ->with('success', 'Inspector role updated successfully.');
    }

    public function issueFlagsIndex()
    {
        $currentUser = Auth::user();
        $issueFlags = PermitIssue::where('permit_id', '!=', null)
            ->with('permitApplication', 'reportedBy')
            ->get();

        return view('BFP.inspector.issue-flags', compact('issueFlags', 'currentUser'), [
            'ActiveTab' => 'bfp-issue-flags',
            'SubActiveTab' => 'view-issue-flags',
        ]);
    }

    public function issueFlagsStore(Request $request)
    {
        $validated = $request->validate([
            'permit_id' => 'required|exists:permit_applications,id',
            'issues' => 'required|array|min:1',
        ]);

        $currentUser = Auth::user();

        foreach ($validated['issues'] as $desc) {
            $issue = new PermitIssue();
            $issue->permit_id = $validated['permit_id'];
            $issue->issue = $desc;
            $issue->user_id = $currentUser->id;
            $issue->save();
        }

        return redirect()->route('bfp.permits.view-permits')
            ->with('success', 'Issue(s) reported successfully.');
    }
}
