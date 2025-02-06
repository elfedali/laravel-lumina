<?php

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

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])
  ->middleware('auth')
  ->name('dashboard');

Route::middleware('auth')
  ->prefix('admin')
  ->group(function () {
    // users
    Route::get('/users', [App\Http\Controllers\AdminUserController::class, 'index'])
      ->name('users.index');
    Route::get('/users/create', [App\Http\Controllers\AdminUserController::class, 'create'])
      ->name('users.create');
    Route::post('/users', [App\Http\Controllers\AdminUserController::class, 'store'])
      ->name('users.store');
    Route::get('/users/{user}', [App\Http\Controllers\AdminUserController::class, 'show'])
      ->name('users.show');
    Route::get('/users/{user}/edit', [App\Http\Controllers\AdminUserController::class, 'edit'])
      ->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\AdminUserController::class, 'update'])
      ->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\AdminUserController::class, 'destroy'])
      ->name('users.destroy');

    // locales
    Route::get('/locales', [App\Http\Controllers\AdminLocaleController::class, 'index'])
      ->name('locales.index');
    Route::get('/locales/create', [App\Http\Controllers\AdminLocaleController::class, 'create'])
      ->name('locales.create');
    Route::post('/locales', [App\Http\Controllers\AdminLocaleController::class, 'store'])
      ->name('locales.store');
    Route::get('/locales/{locale}', [App\Http\Controllers\AdminLocaleController::class, 'show'])
      ->name('locales.show');
    Route::get('/locales/{locale}/edit', [App\Http\Controllers\AdminLocaleController::class, 'edit'])
      ->name('locales.edit');
    Route::put('/locales/{locale}', [App\Http\Controllers\AdminLocaleController::class, 'update'])
      ->name('locales.update');
    Route::delete('/locales/{locale}', [App\Http\Controllers\AdminLocaleController::class, 'destroy'])
      ->name('locales.destroy');
  });
