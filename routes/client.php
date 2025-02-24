<?php

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('test', function () {
    return session()->get(\App\Models\Locale::ACTIVE_LOCALE);
});

Route::get('/changes/companies/{companyId}/edit', function ($companyId) {
    $company = \App\Models\Company::find($companyId);
    return view('ajax.modal.edit-company-content', compact('company'));
});

Route::post('/changes/companies/{companyId}/update', [App\Http\Controllers\ChangesController::class, 'update'])->name("change-company");

// /changes/locales/create
Route::get('/changes/locales/create', function () {
    return view('ajax.modal.create-locale-content');
});

Route::get('/modal/edit-locale-content', function () {
    return view('ajax.modal.edit-locale-content');
});

/**
 * Save locale user by axios
 */
Route::post('/changes/locales/store', [App\Http\Controllers\ChangesController::class, 'storeLocale'])->name("changes.locales.store");

/**
 * Set lcoale active when it's called by the browser.
 */
Route::get('/locales/{locale}/set-active', [App\Http\Controllers\ActiveLocaleController::class, 'setActive'])
    ->name('locales.set-active');
/**
 * This is when the user use the axios to set active it get json.
 */
Route::get('/locales/{locale}/set-active-json', [App\Http\Controllers\ActiveLocaleController::class, 'setActiveJson'])
    ->name('locales.set-active-json');

/**
 * Delete locale form
 * fetched by the axios
 * 
 */
Route::get('/changes/locales/{id}/destroy-form', function (Request $request, $id) {
    $locale = \App\Models\Locale::find($id);
    return view('ajax.modal.delete-locale-content', compact('locale'));
});

/**
 * If the delete form is sent by browser
 */
Route::delete('/changes/locales/{id}/destroy', [App\Http\Controllers\ChangesController::class, 'destroyLocale'])
    ->name("changes.locales.destroy");

/**
 * Edit locale 
 */
Route::get('/changes/locales/{id}/edit-form', function ($id) {
    $locale = \App\Models\Locale::find($id);
    return view('ajax.modal.edit-locale-content', compact('locale'));
});

Route::put('/changes/locales/{id}/update', [App\Http\Controllers\ChangesController::class, 'updateLocale'])
    ->name("changes.locales.update");

# ---- BOOKING
Route::get('booking', function () {
    return view('booking.index');
})->name('booking.index');

# ---- STAFF
Route::get('staff', function () {
    return view('staff.index');
})->name('staff.index');
# ---- SERVICE
Route::get('service', function () {
    return view('service.index');
})->name('service.index');

# >>---- CLIENT
Route::get('client', [App\Http\Controllers\PersonController::class, 'index'])->name('client.index');
Route::post('client', [App\Http\Controllers\PersonController::class, 'store'])->name('client.store');
Route::delete('client', [App\Http\Controllers\PersonController::class, 'destroy'])->name('client.destroy');
Route::put('client', [App\Http\Controllers\PersonController::class, 'update'])->name('client.update');
