<?php

use App\Http\Controllers\Admin\dashboard\AccountsController;
use App\Http\Controllers\Admin\dashboard\AdminController;
use App\Http\Controllers\MPDO\MpdoController;
use App\Http\Controllers\Applicant\ApplicantController;
use App\Http\Controllers\BFP\BfpController;
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
});


// Treasurer Routes
Route::group(['middleware' => ['auth', 'iftreasurer'], 'prefix' => 'treasurer'], function(){
  Route::get('/', [TreasurerController::class, 'index'])->name('treasurer.dashboard');

  // Accounts Routes
  Route::prefix('accounts')->name('accounts.treasurer.')->group(function () {
    Route::get('/', [TreasurerController::class, 'viewAccountsIndex'])->name('view-accounts');
    Route::get('/update-accounts/{id}/edit', [TreasurerController::class, 'updateAccountsIndex'])->name('edit-accounts');
    Route::put('/update-accounts', [TreasurerController::class, 'updateAccounts'])->name('update-accounts');
  });
});