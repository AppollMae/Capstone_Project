<?php

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
  Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
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
Route::group(['middleware' => ['auth', 'ifUsers'], 'prefix' => 'users'], function (){
  Route::get('/dashboard', [ApplicantController::class, 'index'])->name('applicant.dashboard');
});