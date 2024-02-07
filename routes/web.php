<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProprietorController;
use App\Http\Controllers\ContributionController;
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
    return view('pages.home');
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
    return view('pages.success');
});


/* POST Methods */
Route::post('/login',  [AuthController::class, 'login'])->name('login');
Route::post('/create-account', [AccountController::class, 'create'])->name('create-account');

/*
/---------------------------------------------------------------------------
/ PRIVATE ROUTES
/---------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth']], function () {
    /* GET Methods */
    Route::get('/logout',   [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard',  [DashboardController::class, 'show'])->name('show.dashboard');
    Route::get('/contributions',  [ContributionController::class, 'show'])->name('show.contributions');
    Route::get('/proprietors',  [ProprietorController::class, 'show'])->name('show.proprietors');


    
    /* POST Methods */
    Route::post('/create-proprietor', [ProprietorController::class, 'create'])->name('create-proprietor');
    Route::post('/create-contribution', [ContributionController::class, 'create'])->name('create-contribution');
    

});