<?php

namespace App\Http\Controllers\MPDO;

use App\Http\Controllers\Controller;
use App\Models\PermitApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\select;

class MpdoController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();
        $totalApplicants = User::whereIn('role', ['user'])->count();
        $approvePermits = PermitApplication::where('status', 'approved')->count();
        $ongoingProjects = PermitApplication::whereIn('status', ['pending','under_review','approved','rejected'])->count();

        return view('MPDO.dashboard.index', compact('currentUser', 'totalApplicants', 'approvePermits', 'ongoingProjects'));
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

    public function ongoingProjectsIndex(){
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
