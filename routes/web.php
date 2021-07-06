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

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');


Route::get('/', [OrganisationController::class, 'index'])->name('welcome')->middleware('auth');

# Socialite URLs

// La page où on présente les liens de redirection vers les providers
Route::get("login", [SocialiteController::class, 'loginRegister'])->name('login');


// La redirection vers le provider
Route::get("redirect/{provider}", [SocialiteController::class, 'redirect'])->name('socialite.redirect');

// Le callback du provider
Route::get("callback/{provider}", [SocialiteController::class, 'callback'])->name('socialite.callback');

Route::resource('organisations', OrganisationController::class)->middleware('auth');

Route::resource('contribution', ContributionController::class)->middleware('auth');
Route::resource('missions', MissionController::class)->middleware('auth');

Route::resource('mission_lines', MissionLineController::class)->middleware('auth');
Route::resource('transactions', TransactionController::class)->middleware('auth');

Route::get('/mission/{mission}/pdf', [MissionController::class, 'createPDF'])->middleware('auth');
