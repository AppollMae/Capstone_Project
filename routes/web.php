<?php

use App\Http\Controllers\Admin\dashboard\AccountsController;
use App\Http\Controllers\Admin\dashboard\AdminController;
use App\Http\Controllers\MPDO\MpdoController;
use App\Http\Controllers\Applicant\ApplicantController;
use App\Http\Controllers\BFP\BfpController;
use App\Http\Controllers\Auth\InspectorAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OBO\dashboard\OboController;
use App\Http\Controllers\Treasurer\TreasurerController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
  return view('welcome');
})->name('welcome');

Route::get('/', function () {
  return view('welcome');
});

Auth::routes();

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Admin Routes
Route::group(['middleware' => ['auth', 'ifAdmin'], 'prefix' => 'admin'], function () {
  // Admin Main Dashboard
  Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

  // Admin User Management Routes
  Route::prefix('user-management')->name('admin.user_management.')->group(function () {
    Route::get('/', [AdminController::class, 'userManagementIndex'])->name('user-list');
    Route::get('/applicant-user-list', [AdminController::class, 'applicantUserList'])->name('applicant-user-list');
    Route::get('/{id}', [AdminController::class, 'showUser'])->name('user-show');
    Route::put('/{id}/role', [AdminController::class, 'updateUserRole'])->name('user-update-role');
  });



  // Admin Accounts
  Route::prefix('accounts')->name('admin.accounts.')->group(function () {
    Route::get('/', [AccountsController::class, 'viewAccountsIndex'])
      ->name('view-accounts');
    Route::get('/update-accounts/{id}/edit', [AccountsController::class, 'updateAccountsIndex'])
      ->name('edit-account');
    Route::put('/update-accounts', [AccountsController::class, 'updateAccounts'])
      ->name('update-account');
  });

  // Admin Adding A Inspector
  Route::prefix('inspector')->name('admin.inspectors.')->group(function () {
    Route::get('/', [AdminController::class, 'addInspectorIndex'])->name('add-inspector');
    Route::post('/store-inspector', [AdminController::class, 'storeInspector'])->name('store-inspector');
  });
});


// MPDO (Municipal Planning and Development Office) Routes
Route::group(['middleware' => ['auth', 'ifMPDO'], 'prefix' => 'mpdo'], function () {
  Route::get('/dashboard', [MpdoController::class, 'index'])->name('mpdo.dashboard');

  Route::prefix('accounts')->name('mpdo.accounts.')->group(function () {
    Route::get('/', [MpdoController::class, 'viewAccountsIndex'])
      ->name('mpdo-view-accounts');
    Route::get('/update-accounts/{id}/edit', [MpdoController::class, 'updateAccountsIndex'])
      ->name('mpdo-edit-accounts');
    Route::put('/update-accounts', [MpdoController::class, 'updateAccounts'])
      ->name('mpdo-update-accounts');
  });

  Route::prefix('permit-applicants')->name('mpdo.permit-applicants.')->group(function () {
    Route::get('/', [MpdoController::class, 'permitApplicantIndex'])->name('view');
    Route::post('/{id}/under-review', [MpdoController::class, 'markUnderReviewIndex'])->name('mark-under-review');
    Route::get('/ongoing-projects', [MpdoController::class, 'ongoingProjectsIndex'])->name('view-ongoing-projects');
    Route::post('/{id}/approved', [MpdoController::class, 'markApprovedIndex'])->name('mark-approved');
  });
});


// BFP (Bureau of Fire Protection) Routes
Route::group(['middleware' => ['auth', 'ifBFP'], 'prefix' => 'bfp'], function () {
  Route::get('/dashboard', [BfpController::class, 'index'])->name('bfp.dashboard');

  // BFP Accounts
  Route::prefix('accounts')->name('bfp.accounts.')->group(function () {
    Route::get('/', [BfpController::class, 'viewAccountsIndex'])->name('view-accounts');
    Route::get('/update-accounts/{id?}/edit', [BfpController::class, 'updateAccountsIndex'])->name('edit-accounts');
    Route::put('/update-accounts', [BfpController::class, 'updateAccounts'])->name('update-accounts');
  });

  // BFP Permits
  Route::prefix('permits')->name('bfp.permits.')->group(function () {
    Route::get('/', [BfpController::class, 'viewPermitsIndex'])->name('view-permits');
    Route::post('{id}/under-review', [BfpController::class, 'markUnderReviewIndex'])->name('mark-under-review');
    Route::get('/pending-permits', [BfpController::class, 'pendingPermitsIndex'])->name('view-pending-permits');
    Route::get('/approve-permits', [BfpController::class, 'approvePermitsIndex'])->name('view-approve-permits');
    Route::get('/rejected-permits', [BfpController::class, 'rejectedPermitsIndex'])->name('view-rejected-permits');
    Route::get('/total-permits', [BfpController::class, 'totalPermitsIndex'])->name('view-total-permits');
    Route::post('/issue-flags-store', [BfpController::class, 'issueFlagsStore'])->name('issue-flags-store');
  });

  // BFP Inspectors
  Route::prefix('inspectors')->name('bfp.inspectors.')->group(function () {
    Route::get('/', [BfpController::class, 'bfpInspectorsIndex'])->name('view-inspectors');
    Route::put('/update-role', [BfpController::class, 'updateInspectorRoleStore'])->name('update-role');
    Route::get('/issue-flags', [BfpController::class, 'issueFlagsIndex'])->name('issue-flags');
  });
});


// Applicant Routes
Route::group(['middleware' => ['auth', 'ifUsers'], 'prefix' => 'users'], function () {
  Route::get('/dashboard', [ApplicantController::class, 'index'])->name('applicant.dashboard');

  // Applicants Routes
  Route::prefix('applicants')->name('applicants.accounts.')->group(function () {
    Route::get('/', [ApplicantController::class, 'applicantsIndex'])->name('applicants-view-accounts');
    Route::get('/update-accounts/{id}/edit', [ApplicantController::class, 'updateAccountsIndex'])->name('applicants-edit-accounts');
    Route::put('/update-accounts', [ApplicantController::class, 'updateAccounts'])->name('applicants-update-accounts');
  });

  // Permits Routes
  Route::prefix('permits')->name('applicants.permits.')->group(function () {
    Route::get('/', [ApplicantController::class, 'permitsIndex'])->name('view-permits');
    Route::get('/apply', [ApplicantController::class, 'applyForPermit'])->name('apply-permit');
    Route::post('/store', [ApplicantController::class, 'storePermitApplication'])->name('store-permit');
    Route::post('/draft', [ApplicantController::class, 'draftPermitApplication'])->name('draft-permit');
  });

  Route::prefix('draft')->name('applicants.drafts.')->group(function () {
    Route::get('/', [ApplicantController::class, 'draftIndex'])->name('view-drafts');
    Route::get('/showmap', [ApplicantController::class, 'showMap'])->name('show-map');
    Route::delete('/delete/{id}', [ApplicantController::class, 'deleteDraft'])->name('delete-draft');
    Route::get('/pending', [ApplicantController::class, 'pendingDraft'])->name('pending-draft');
  });


  Route::prefix('under-review')->name('applicants.under-reviews.')->group(function () {
    Route::get('/', [ApplicantController::class, 'underReviewIndex'])->name('view-under-review');
    Route::post('/mark-as-under-review/{id}', [ApplicantController::class, 'markAsUnderReview'])->name('mark-as-under-review');
  });
});


// OBO (Office of the Building Official) Routes
Route::group(['middleware' => ['auth', 'ifOBO'], 'prefix' => 'obo'], function () {
  Route::get('/', [OboController::class, 'index'])->name('obo.dashboard');

  // Accounts OBO (Office of the Building Official) Routes
  Route::prefix('accounts')->name('obo.accounts.')->group(function () {
    Route::get('/', [OboController::class, 'viewAccountsIndex'])->name('view-accounts');
    Route::get('/update-accounts/{id}/edit', [OboController::class, 'updateAccountsIndex'])->name('edit-accounts');
    Route::put('/update-accounts', [OboController::class, 'updateAccounts'])->name('update-accounts');
  });

  // Total Permits OBO (Office of the Building Official) Routes
  Route::prefix('total-permits')->name('obo.total-permits.')->group(function () {
    Route::get('/', [OboController::class, 'totalPermitsIndex'])->name('view');
    Route::get('/under-review', [OboController::class, 'underReviewIndex'])->name('under-review');
    Route::post('/under-review/{id}/under-review', [OboController::class, 'markAsUnderReview'])->name('mark-under-review');
    Route::post('/approve/{id}/approve', [OboController::class, 'approvePermit'])->name('approve');
    Route::post('/reject/{id}/reject', [OboController::class, ' rejectPermit'])->name('reject');
    Route::post('/temp-delete/{id}/temp-delete', [OboController::class, 'tempDeletePermit'])->name('temp-delete');
  });

  // Permit Application History OBO (Office of the Building Official) Routes
  Route::prefix('permit-applications')->name('obo.permit-applications.')->group(function () {
    Route::get('/', [OboController::class, 'permitApplicationsIndex'])->name('view');
    Route::get('/under-review', [OboController::class, 'permitApplicationsUnderReview'])->name('under-review');
    Route::get('/pending-permits', [OboController::class, 'pendingPermitsIndex'])->name('pending-permits');
    Route::get('/approve-permits', [OboController::class, 'approvePermitsIndex'])->name('approve-permits');
    Route::get('/rejected-permits', [OboController::class, 'rejectedPermitsIndex'])->name('rejected-permits');
  });
});


// Treasurer Routes
Route::group(['middleware' => ['auth', 'iftreasurer'], 'prefix' => 'treasurer'], function () {
  Route::get('/', [TreasurerController::class, 'index'])->name('treasurer.dashboard');

  // Accounts Routes
  Route::prefix('accounts')->name('accounts.treasurer.')->group(function () {
    Route::get('/', [TreasurerController::class, 'viewAccountsIndex'])->name('view-accounts');
    Route::get('/update-accounts/{id}/edit', [TreasurerController::class, 'updateAccountsIndex'])->name('edit-accounts');
    Route::put('/update-accounts', [TreasurerController::class, 'updateAccounts'])->name('update-accounts');
  });
});
