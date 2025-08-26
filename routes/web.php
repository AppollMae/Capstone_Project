<?php

use App\Http\Controllers\Admin\dashboard\AccountsController;
use App\Http\Controllers\Admin\dashboard\AdminController;
use App\Http\Controllers\MPDO\MpdoController;
use App\Http\Controllers\Applicant\ApplicantController;
use App\Http\Controllers\BFP\BfpController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Routes
Route::group(['middleware' => ['auth', 'ifAdmin'], 'prefix' => 'admin'], function () {
  // Admin Main Dashboard
  Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

  // User Management
  Route::prefix('user_management')->name('admin.user_management.')->group(function () {
    Route::get('/', [AdminController::class, 'userManagementIndex'])->name('user-list');
    Route::get('/{id}', [AdminController::class, 'showUser'])->name('user-show');
  });

  // Admin Accounts
  Route::prefix('accounts')->name('admin.accounts.')->group(function () {
    // View all accounts
    Route::get('/', [AccountsController::class, 'viewAccountsIndex'])
      ->name('view-accounts');

    // Show edit form
    Route::get('/update-accounts/{id}/edit', [AccountsController::class, 'updateAccountsIndex'])
      ->name('edit-account');

    // Update account (PUT request)
    Route::put('/update-accounts', [AccountsController::class, 'updateAccounts'])
      ->name('update-account');
  });
});


// MPDO Routes
Route::group(['middleware' => ['auth', 'ifMPDO'], 'prefix' => 'mpdo'], function () {
  Route::get('/dashboard', [MpdoController::class, 'index'])->name('mpdo.dashboard');
});


// BFP Routes
Route::group(['middleware' => ['auth', 'ifBFP'], 'prefix' => 'bfp'], function () {
  Route::get('/dashboard', [BfpController::class, 'index'])->name('bfp.dashboard');
});


// Applicant Routes
Route::group(['middleware' => ['auth', 'ifUsers'], 'prefix' => 'users'], function () {
  Route::get('/dashboard', [ApplicantController::class, 'index'])->name('applicant.dashboard');
});
