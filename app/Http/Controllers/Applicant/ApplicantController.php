<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\DraftPermit;
use App\Models\PermitApplication;
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
        $user = Auth::user();
        return view('applicant.permits.applicants-apply-permits', compact('user'), [
            'ActiveTab' => 'permits',
            'SubActiveTab' => 'application-form'
        ]);
    }


    public function storePermitApplication(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'description' => 'required|string',
            'documents.*' => 'required|file|mimes:pdf,jpg,png|max:2048'
        ]);

        // Store uploaded documents
        $documentPaths = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('documents', 'public');
                $documentPaths[] = $path;
            }
        }

        // Save to database
        $application = new PermitApplication();
        $application->user_id = Auth::id();
        $application->project_name = $validated['project_name'];
        $application->location = $validated['location'];
        $application->latitude = $request->latitude;
        $application->longitude = $request->longitude;
        $application->description = $validated['description'];
        $application->documents = json_encode($documentPaths);
        $application->save();

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }

    public function draftPermitApplication(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'description' => 'required|string',
            'documents.*' => 'nullable|file|mimes:pdf,jpg,png|max:2048'
        ]);

        $documentPaths = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('documents', 'public');
                $documentPaths[] = $path;
            }
        }

        DraftPermit::create([
            'user_id' => auth()->id(),
            'project_name' => $validated['project_name'],
            'location' => $validated['location'],
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'description' => $validated['description'],
            'documents' => json_encode($documentPaths),
            'status' => 'draft',
        ]);

        return redirect()->back()->with('success', 'Permit saved as draft successfully!');
    }

    public function draftIndex()
    {
        $currentUser = Auth::user();

        // Get the draft permits for the current user
        $draftPermits = DraftPermit::with('user')
            ->select('id', 'project_name', 'location', 'user_id', 'created_at', 'latitude', 'longitude')
            ->where('user_id', $currentUser->id)
            ->where('status', 'draft')
            ->get();

        // Transform data for map use (only location and name)
        $locations = $draftPermits->map(function ($draft) {
            return [
                'id' => $draft->id,
                'name' => $draft->project_name, // for popup
                'location' => $draft->location ?? null,
                'latitude' => $draft->latitude ?? null,
                'longitude' => $draft->longitude ?? null
            ];
        });

        return view('applicant.drafts.index-draft', compact('draftPermits', 'currentUser', 'locations'));
    }
}
