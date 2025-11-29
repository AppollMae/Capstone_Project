<?php

namespace App\Http\Controllers\MPDO;

use App\Http\Controllers\Controller;
use App\Models\PermitApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class MpdoController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();

        // --- Overall statistics ---
        $totalApplicants = User::where('role', 'user')->count();
        $approvePermits = PermitApplication::where('status', 'approved')->count();
        $ongoingProjects = PermitApplication::whereIn('status', ['pending', 'under_review', 'approved', 'rejected'])->count();
        $underReviewCountsPermits = PermitApplication::where('status', 'under_review')->count();

        // --- Status counts for chart ---
        $approvedCount = PermitApplication::where('status', 'approved')->count();
        $underReviewCount = PermitApplication::where('status', 'under_review')->count();
        $pendingCount = PermitApplication::where('status', 'pending')->count();
        $rejectedCount = PermitApplication::where('status', 'rejected')->count();

        $chartData = [
            'labels' => ['Pending', 'Under Review', 'Approved', 'Rejected'],
            'datasets' => [
                [
                    'label' => 'Permit Applications',
                    'data' => [$pendingCount, $underReviewCount, $approvedCount, $rejectedCount],
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 0.2)', // Approved - Green
                        'rgba(255, 206, 86, 0.2)', // Under Review - Yellow
                        'rgba(54, 162, 235, 0.2)', // Pending - Blue
                        'rgba(255, 99, 132, 0.2)', // Rejected - Red
                    ],
                    'borderColor' => [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    'borderWidth' => 4,
                    'borderRadius' => 6,
                ],
            ],
        ];

        // --- Monthly uploads chart ---
        $monthlyUploads = DB::table('permit_applications')
            ->selectRaw('MONTH(created_at) as month_number, MONTHNAME(created_at) as month_name, COUNT(*) as total')
            ->groupBy('month_number', 'month_name')
            ->orderBy('month_number')
            ->get();

        // Extract labels and totals
        $months = $monthlyUploads->pluck('month_name');
        $totals = $monthlyUploads->pluck('total');

        // Define distinct colors for each month
        $colors = [
            'rgba(255, 99, 132, 0.6)',   // January - Red
            'rgba(255, 159, 64, 0.6)',   // February - Orange
            'rgba(255, 205, 86, 0.6)',   // March - Yellow
            'rgba(75, 192, 192, 0.6)',   // April - Teal
            'rgba(54, 162, 235, 0.6)',   // May - Blue
            'rgba(153, 102, 255, 0.6)',  // June - Purple
            'rgba(255, 99, 255, 0.6)',   // July - Pink
            'rgba(100, 181, 246, 0.6)',  // August - Light Blue
            'rgba(139, 195, 74, 0.6)',   // September - Green
            'rgba(255, 87, 34, 0.6)',    // October - Deep Orange
            'rgba(96, 125, 139, 0.6)',   // November - Grey
            'rgba(233, 30, 99, 0.6)',    // December - Magenta
        ];

        // Trim the color array to match number of months retrieved
        $backgroundColors = array_slice($colors, 0, count($months));

        // Build the dataset for Chart.js
        $monthChartData = [
            'labels' => $months,
            'datasets' => [[
                'label' => 'Monthly Permit Uploads',
                'data' => $totals,
                'backgroundColor' => $backgroundColors,
                'borderColor' => array_map(fn($color) => str_replace('0.6', '1', $color), $backgroundColors),
                'borderWidth' => 1,
                'borderRadius' => 5,
            ]],
        ];
        return view('MPDO.dashboard.index', compact(
            'currentUser',
            'totalApplicants',
            'approvePermits',
            'ongoingProjects',
            'underReviewCountsPermits',
            'chartData',
            'monthChartData'
        ), [
            'ActiveTabMenu' => 'dashboard',
            'SubActiveTabMenu' => 'mpdo-dashboard'
        ]);
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

    public function permitApplicantIndex()
    {
        $currentUser = Auth::user();
        $permitApplications = PermitApplication::whereIn('status', ['pending', 'under_review', 'approved', 'rejected'])
            ->select('id', 'user_id', 'project_name', 'location', 'description', 'documents', 'status', 'reviewed_by', 'created_at')
            ->get();

        $permitApplications->transform(function ($permit) {
            if ($permit->documents) {
                $docs = json_decode($permit->documents, true);

                if (is_array($docs)) {
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

        return view('mpdo.permit-applicants.index', compact('currentUser', 'permitApplications'), [
            'ActiveTab' => 'Permit-Applicants',
            'SubActiveTab' => 'view-applicant'
        ]);
    }

    public function markUnderReviewIndex($id)
    {
        $currentUser = Auth::user();
        $permit = PermitApplication::find($id);
        $permit->status = 'under_review';
        if ($currentUser->role === 'mpdo') {
            // Additional logic for MPDO role
            $permit->reviewed_by = $currentUser->id;
        }
        $permit->save();
        return redirect()->back()->with('success', 'Permit marked as Under Review.');
    }

    public function ongoingProjectsIndex()
    {
        $currentUser = Auth::user();
        $ongoingProjects = PermitApplication::whereIn('status', ['pending', 'under_review', 'approved', 'rejected'])
            ->select('id', 'user_id', 'project_name', 'location', 'description', 'documents', 'status', 'reviewed_by', 'created_at')
            ->get();

        $ongoingProjects->transform(function ($permit) {
            if ($permit->documents) {
                $docs = json_decode($permit->documents, true);

                if (is_array($docs)) {
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

        return view('MPDO.permit-applicants.ongoing-projects', compact('currentUser', 'ongoingProjects'), [
            'ActiveTab' => 'Permit-Applicants',
            'SubActiveTab' => 'view-applicants'
        ]);
    }

    public function markApprovedIndex($id)
    {
        $currentUser = Auth::user();
        $permit = PermitApplication::find($id);
        $permit->status = 'approved';
        if ($currentUser->role === 'mpdo') {
            // Additional logic for MPDO role
            $permit->reviewed_by = $currentUser->id;
        }
        $permit->save();
        return redirect()->back()->with('success', 'Permit marked as Approved.');
    }
}
