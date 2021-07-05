<?php

use App\Http\Controllers\ContributionController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\MissionLineController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

# Socialite URLs

// La page où on présente les liens de redirection vers les providers
Route::get("login-register", [SocialiteController::class, 'loginRegister']);

// La redirection vers le provider
Route::get("redirect/{provider}", [SocialiteController::class, 'redirect'])->name('socialite.redirect');

// Le callback du provider
Route::get("callback/{provider}", [SocialiteController::class, 'callback'])->name('socialite.callback');

Route::resource('organisations', OrganisationController::class);

Route::resource('contribution', ContributionController::class);
Route::resource('missions', MissionController::class);
// Route::get('missions/{organisation_id}', MissionController::class);

Route::resource('mission_lines', MissionLineController::class);
// Route::resource('organisation', OrganisationController::class)->except(['create']);
Route::resource('transaction', TransactionController::class);
