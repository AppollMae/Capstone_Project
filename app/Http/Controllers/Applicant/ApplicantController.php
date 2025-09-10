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
        $currentUser = Auth::user();

        // Count only this user's draft permits
        $draftpermitcount = DraftPermit::where('user_id', $currentUser->id)
            ->where('status', 'draft')
            ->count();

        // Pending permits for this user
        $pendingCounts = PermitApplication::where('user_id', $currentUser->id)
            ->where('status', 'pending')
            ->count();

        // Under review permits for this user
        $underReviewCount = PermitApplication::where('user_id', $currentUser->id)
            ->where('status', 'under_review')
            ->count();

        return view('applicant.dashboard.index', compact(
            'draftpermitcount',
            'pendingCounts',
            'underReviewCount'
        ));
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $accounts->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update basic fields
        $accounts->name = $request->name;
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
            ->select('id', 'project_name', 'location', 'user_id', 'created_at', 'latitude', 'longitude', 'documents')
            ->where('user_id', $currentUser->id)
            ->where('status', 'draft')
            ->get();

        // Map permits and add full document URL
        $draftPermits->transform(function ($draft) {
            if ($draft->documents) {
                // Decode JSON safely
                $docs = json_decode($draft->documents, true);

                if (is_array($docs)) {
                    $fileName = $docs[0]; // get first document
                } else {
                    $fileName = $draft->documents;
                }

                // Clean file name
                $fileName = basename($fileName);

                // Build final URL (public/documents/)
                $draft->document_url = asset('storage/documents/' . $fileName);
            } else {
                $draft->document_url = null;
            }

            return $draft;
        });

        // Transform data for map use
        $locations = $draftPermits->map(function ($draft) {
            return [
                'id' => $draft->id,
                'name' => $draft->project_name, // for popup
                'location' => $draft->location ?? null,
                'latitude' => $draft->latitude ?? null,
                'longitude' => $draft->longitude ?? null,
            ];
        });

        return view('applicant.drafts.index-draft', [
            'draftPermits' => $draftPermits,
            'currentUser' => $currentUser,
            'locations' => $locations,
            'ActiveTab' => 'draft',
            'SubActivetab' => 'view',
        ]);
    }


    // public function updateDraft(Request $request)
    // {
    //     $validated = $request->validate([
    //         'id' => 'required|exists:draft_permits,id',
    //         'project_name' => 'required|string|max:255',
    //         'location' => 'required|string|max:255',
    //         'latitude' => 'nullable|numeric',
    //         'longitude' => 'nullable|numeric',
    //         'description' => 'required|string',
    //         'documents.*' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
    //         'status' => 'required|string|in:draft,pending'
    //     ]);

    //     $draft = DraftPermit::find($validated['id']);
    //     if (!$draft) {
    //         return redirect()->back()->withErrors(['error' => 'Draft not found']);
    //     }

    //     // Update fields
    //     $draft->project_name = $validated['project_name'];
    //     $draft->location = $validated['location'];
    //     $draft->latitude = $validated['latitude'];
    //     $draft->longitude = $validated['longitude'];
    //     $draft->description = $validated['description'];
    //     $draft->status = $validated['status']; // allow status change to pending

    //     // Handle documents if uploaded
    //     if ($request->hasFile('documents')) {
    //         $documentPaths = [];
    //         foreach ($request->file('documents') as $file) {
    //             $path = $file->store('documents', 'public');
    //             $documentPaths[] = $path;
    //         }
    //         $draft->documents = json_encode($documentPaths);
    //     }

    //     // Save draft
    //     $draft->save();

    //     return redirect()->back()->with('success', 'Draft updated successfully!');
    // }

    public function deleteDraft($id)
    {
        $draft = DraftPermit::findOrFail($id);
        $draft->delete();

        return redirect()->back()->with('success', 'Draft deleted successfully!');
    }

    public function pendingDraft()
    {
        $currentUser = Auth::user();
        $pendingDrafts = PermitApplication::where('user_id', $currentUser->id)
            ->where('status', 'pending')
            ->get();


        return view('applicant.drafts.pending-permit', compact('pendingDrafts', 'currentUser'), [
            'ActiveTab' => 'pending',
            'SubActiveTab' => 'permit'
        ]);
    }


    public function underReviewIndex()
    {
        $currentUser = Auth::user();

        // Get permits that are under review
        $underReviewPermits = PermitApplication::with('reviewer')
            ->where('user_id', $currentUser->id) // restrict to current user
            ->where('status', 'under_review')
            ->select('id', 'user_id', 'project_name', 'location', 'status', 'documents', 'created_at', 'reviewed_by')
            ->get();

        // Optionally map document URLs like in totalPermitsIndex
        $underReviewPermits->transform(function ($permit) {
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

        $underReviewCount = $underReviewPermits->count();

        return view('Applicant.under-review.under-review', [
            'underReviewPermits' => $underReviewPermits,
            'underReviewCount' => $underReviewCount,
            'ActiveTab' => 'under-review',
            'SubActiveTab' => 'view-under-review'
        ], compact('currentUser'));
    }
}
