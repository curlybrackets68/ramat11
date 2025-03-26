<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MatchesController;

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

Route::get('/', [LoginController::class, 'index'])->name('user.show.login-page');
Route::post('login', [LoginController::class, 'login'])->name('user.login');
Route::get('dashboard', [LoginController::class, 'dashboard'])->name('user.dashboard');
Route::get('matches', [MatchesController::class, 'index'])->name('user.matches');
Route::get('contests', [MatchesController::class, 'contestsDetails'])->name('user.contests');
Route::post('add-update-match', [MatchesController::class, 'addUpdate'])->name('user.add-update-match');
Route::get('match-details/{id}', [MatchesController::class, 'matchDetails'])->name('user.match-details');
Route::get('join-match/{id}', [MatchesController::class, 'joinMatch'])->name('user.join-match');

Route::post('save-playing11', [MatchesController::class, 'savePlaying11'])->name('user.save-playing11');
