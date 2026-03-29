<?php

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

Auth::routes();

// Onboarding — shown once after registration, before accessing the app
Route::middleware('auth')->group(function () {
    Route::get('/onboarding', [App\Http\Controllers\OnboardingController::class, 'show'])->name('onboarding.show');
    Route::post('/onboarding', [App\Http\Controllers\OnboardingController::class, 'store'])->name('onboarding.store');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
  ->middleware('auth')
  ->name('dashboard.index');

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])
  ->middleware('auth')
  ->name('dashboard');


require __DIR__ . '/admin.php';

require __DIR__ . '/client.php';
