<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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

/* POST Methods */
Route::post('/login',  [AuthController::class, 'login'])->name('login');

/*
/---------------------------------------------------------------------------
/ PRIVATE ROUTES
/---------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth']], function () {
    /* GET Methods */
    Route::get('/dashboard',  [DashboardController::class, 'show'])->name('show.dashboard');

    /* POST Methods */
    Route::get('/logout',   [AuthController::class, 'logout'])->name('logout');

});