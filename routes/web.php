<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProprietorController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\SubscriptionController;

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

Route::get('/', function () {
    return view('pages.home', ['title' => 'Home']);
});

/*
/---------------------------------------------------------------------------
/ PUBLIC ROUTES
/---------------------------------------------------------------------------
*/

/* GET Methods */
Route::get('/login', [AuthController::class, 'show'])->name('show.login');
Route::get('/create-account', [AccountController::class, 'show'])->name('show.create-account');
Route::get('/account-success', function () {
    return view('pages.success', ['title' => 'Success']);
});


/* POST Methods */
Route::post('/login',  [AuthController::class, 'login'])->name('login');
Route::post('/create-account', [AccountController::class, 'create'])->name('create-account');

/*
/---------------------------------------------------------------------------
/ PRIVATE ROUTES
/---------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'auth.admin']], function () {
    /* GET Methods */
    Route::get('/logout',   [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard',  [DashboardController::class, 'show'])->name('show.dashboard');
    Route::get('/contributions',  [ContributionController::class, 'show'])->name('show.contributions');
    Route::get('/proprietors',  [ProprietorController::class, 'show'])->name('show.proprietors');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile');

    /* POST Methods */
    Route::post('/create-proprietor', [ProprietorController::class, 'create'])->name('create-proprietor');
    Route::post('/update-proprietor', [ProprietorController::class, 'update'])->name('update-proprietor');
    Route::post('/create-contribution', [ContributionController::class, 'create'])->name('create-contribution');

    Route::post('/proprietors/delete-proprietor/{proprietorId}',
        [ProprietorController::class, 'delete'])->name('delete-proprietor');

});

Route::group(['middleware' => ['auth', 'auth.admin']], function () {
    /* GET Methods */
    Route::get('/customers',  [CustomerController::class, 'show'])->name('show.customers');
    Route::get('/subscriptions',  [SubscriptionController::class, 'show'])->name('show.subscriptions');
});