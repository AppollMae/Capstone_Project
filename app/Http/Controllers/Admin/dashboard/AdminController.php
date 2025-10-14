<?php

namespace App\Http\Controllers\Admin\dashboard;

use App\Http\Controllers\Controller;
use App\Models\BfpInspector;
use App\Models\PermitApplication;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PermitIssue;

class AdminController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();

        // Fetch all users except admin
        $users = User::whereIn('role', ['MPDO', 'BFP', 'Treasurer', 'OBO', 'bfp_inspector', 'bfp_inspector_I'])->get();
        $TotalUsers = PermitApplication::whereIn('status', ['pending', 'under_review', 'approved', 'rejected'])->count();
        $pendingApplications = PermitApplication::where('status', 'pending')->count();
        $underReviewApplications = PermitApplication::where('status', 'under_review')->count();
        $approvedApplications = PermitApplication::where('status', 'approved')->count();
        $rejectedApplications = PermitApplication::where('status', 'rejected')->count();
        $underReviewCounts = PermitApplication::where('status', 'under_review')->count();

        return view('admin.dashboard.dashboard', [
            'currentUser' => $currentUser,
            'users' => $users,
            'TotalUsers' => $TotalUsers,
            'pendingApplications' => $pendingApplications,
            'underReviewApplications' => $underReviewApplications,
            'approvedApplications' => $approvedApplications,
            'rejectedApplications' => $rejectedApplications,
            'underReviewCounts' => $underReviewCounts,
        ]);
    }

    public function userManagementIndex()
    {
        $currentUser = Auth::user();
        $users = User::whereIn('role', ['MPDO', 'BFP', 'Treasurer', 'OBO', 'bfp_inspector', 'bfp_inspector_I'])->get();
        return view('admin.user_management.user-list', compact('users'), [
            'ActiveMenu' => 'user_management',
            'SubActive' => 'Staff/Inspector',
            'currentUser' => $currentUser
        ]);
    }

    public function showUser($id)
    {

        $user = User::findOrFail($id);
        return view('admin.user_management.user-management', compact('user'));
    }

    public function updateUserRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:user,admin,mpdo,bfp,treasurer,obo,bfp_inspector',
        ]);

        $user = User::findOrFail($id);
        $oldRole = $user->role;

        // Update role
        $user->role = $request->role;
        $user->save();

        // If the currently logged-in user's role was downgraded to 'user', log them out
        if (Auth::id() == $user->id && $user->role === 'user') {
            Auth::logout();
            return redirect()->route('login')
                ->with('status', 'Your role has been changed to "user". Please log in again.');
        }

        return redirect()->back()->with('success', 'User role updated successfully!');
    }



    public function applicantUserList()
    {
        $CurrentUsers = Auth::user();
        $users = User::where('role', 'user')->get();
        return view('admin.user_management.applicant-user-list', compact('users', 'CurrentUsers'), [
            'ActiveMenu' => 'user_management',
            'SubActive' => 'Applicants'
        ]);
    }

    public function totalPermitsIndex()
    {
        $currentUser = Auth::user();
        $totalPermitsAll = PermitApplication::where('status', ['pending', 'under_review', 'approved', 'rejected'])->count();
        $statuses = PermitApplication::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');
        $TotalPermitsAll = $statuses->sum();
        $totalPermits = PermitApplication::whereIn(
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
            'admin.permits_applicants.total_permits_issued',
            compact('currentUser', 'totalPermitsAll', 'totalPermits', 'TotalPermitsAll'),
            [
                'ActiveMenu' => 'total_permits',
                'SubActiveMenu' => 'total_view',
                'linkTabMenu' => 'link_tab_view'
            ]
        );
    }

    public function isseudFlagsStored(Request $request)
    {
        $currentUser = Auth::user();
        $validated = $request->validate([
            'permit_id' => 'required|exists:permit_applications, id',
            'issues' => 'required|array|min:1'
        ]);

        foreach ($validated['issues'] as $desc) {
            $issue = new PermitIssue();
            $issue->permit_id = $validated['permit_id'];
            $issue->issue = $desc;
            $issue->user_id = $currentUser->id;
            $issue->save();
        }

        return redirect()->back()->with('success', 'Issue(s) reported successfully.');
    }

    public function pendingPermitsIndex()
    {
        $currentUser = Auth::user();

        // Count pending permits
        $pendingPermitsCounts = PermitApplication::where('status', 'pending')->count();

        // ✅ FIX: use whereIn() to count all types of permits
        $totalPermitsAll = PermitApplication::whereIn('status', ['pending', 'under_review', 'approved', 'rejected'])->count();
        $underReview = PermitApplication::where('status', 'under_review')->count();
        $approvedCount = PermitApplication::where('status', 'approved')->count();
        $rejectedCount = PermitApplication::where('status', 'rejected')->count();

        // Get all pending permits
        $pendingPermits = PermitApplication::where('status', 'pending')
            ->select('id', 'user_id', 'project_name', 'location', 'status', 'reviewed_by', 'documents', 'created_at', 'description')
            ->get();

        // Process document URLs
        $pendingPermits->transform(function ($permit) {
            if ($permit->documents) {
                $docs = json_decode($permit->documents, true);
                $fileName = is_array($docs) ? $docs[0] : $permit->documents;
                $fileName = basename($fileName);
                $permit->document_url = asset('storage/documents/' . $fileName);
            } else {
                $permit->document_url = null;
            }
            return $permit;
        });

        // Return to view
        return view(
            'admin.permits_applicants.pending_applicants',
            compact(
                'currentUser',
                'pendingPermitsCounts',
                'pendingPermits',
                'totalPermitsAll',
                'underReview',
                'approvedCount',
                'rejectedCount'
            ),
            [
                'ActiveTabMenu' => 'pending_tab',
                'SubActiveTabMenu' => 'pending_tab_view',
                'linkTabMenu' => 'link_tab'
            ]
        );
    }
}
