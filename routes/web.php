<?php

use App\Http\Controllers\Admin\dashboard\AccountsController;
use App\Http\Controllers\Admin\dashboard\AdminController;
use App\Http\Controllers\MPDO\MpdoController;
use App\Http\Controllers\Applicant\ApplicantController;
use App\Http\Controllers\BFP\BfpController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

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


// MPDO Routes
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


// BFP Routes
Route::group(['middleware' => ['auth', 'ifBFP'], 'prefix' => 'bfp'], function () {
  Route::get('/dashboard', [BfpController::class, 'index'])->name('bfp.dashboard');
});


// Applicant Routes
Route::group(['middleware' => ['auth', 'ifUsers'], 'prefix' => 'users'], function () {
  Route::get('/dashboard', [ApplicantController::class, 'index'])->name('applicant.dashboard');
});
