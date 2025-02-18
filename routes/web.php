<?php

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

Route::get('test', function () {
  return session()->get(\App\Models\Locale::ACTIVE_LOCALE);
});

Route::get('/changes/companies/{companyId}/edit', function ($companyId) {
  $company = Company::find($companyId);
  return view('ajax.modal.edit-company-content', compact('company'));
});

Route::post('/changes/companies/{companyId}/update', function (Request $request, $companyId) {

  $validator = Validator::make($request->all(), [
    'name' => 'required|string',
    'category' => 'required|string',
  ]);

  if ($validator->fails()) {
    return response()->json([
      'success' => false,
      'errors' => $validator->errors(), // Return validation errors
    ], 422); // Use 422 Unprocessable Entity for validation errors
  }

  $company = Company::findOrFail($companyId);
  $company->update([
    'name' => $request->input('name'),
    'category' => $request->input('category'),
  ]);

  Session::flash('success', 'Le salon a été mis à jour avec succès');

  return response()->json(
    [
      "success" => true,
      "message" => "Le salon a été mis à jour avec succès"
    ]
  );
})->name("change-company");


Route::get('/modal/edit-locale-content', function () {
  return view('ajax.modal.edit-locale-content');
});

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
    // Route::get('/users/{user}', [App\Http\Controllers\AdminUserController::class, 'show'])
    //   ->name('users.show');
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
    // Route::get('/locales/{locale}', [App\Http\Controllers\AdminLocaleController::class, 'show'])
    //   ->name('locales.show');
    Route::get('/locales/{locale}/edit', [App\Http\Controllers\AdminLocaleController::class, 'edit'])
      ->name('locales.edit');
    Route::put('/locales/{locale}', [App\Http\Controllers\AdminLocaleController::class, 'update'])
      ->name('locales.update');
    Route::delete('/locales/{locale}', [App\Http\Controllers\AdminLocaleController::class, 'destroy'])
      ->name('locales.destroy');

    // set Active locale 
    Route::get('/locales/{locale}/set-active', [App\Http\Controllers\ActiveLocaleController::class, 'setActive'])
      ->name('locales.set-active');
  });
