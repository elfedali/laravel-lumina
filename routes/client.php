<?php

use Illuminate\Support\Facades\Route;


Route::middleware('auth')
    ->group(function () {

        # ---- LOCATIONS (management page)
        Route::get('/locations', [App\Http\Controllers\ChangesController::class, 'indexLocales'])->name('locations.index');

        Route::get('/settings/company/edit', [App\Http\Controllers\ChangesController::class, 'editCompany'])
            ->name('settings.company.edit');
        Route::put('/settings/company', [App\Http\Controllers\ChangesController::class, 'updateCompany'])
            ->name('settings.company.update');

        Route::get('/settings/locales/create', [App\Http\Controllers\ChangesController::class, 'createLocale'])
            ->name('settings.locales.create');
        Route::get('/settings/locales/{locale}/edit', [App\Http\Controllers\ChangesController::class, 'editLocale'])
            ->name('settings.locales.edit');

        /**
         * Save locale user by axios
         */
        Route::post('/settings/locales', [App\Http\Controllers\ChangesController::class, 'storeLocale'])
            ->name('settings.locales.store');

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
         * If the delete form is sent by browser
         */
        Route::delete('/settings/locales/{locale}', [App\Http\Controllers\ChangesController::class, 'destroyLocale'])
            ->name('settings.locales.destroy');
        Route::put('/settings/locales/{locale}', [App\Http\Controllers\ChangesController::class, 'updateLocale'])
            ->name('settings.locales.update');

        # ---- BOOKING
        Route::get('booking', [App\Http\Controllers\BookingController::class, 'index'])->name('booking.index');
        Route::get('booking/create', [App\Http\Controllers\BookingController::class, 'create'])->name('booking.create');
        Route::post('booking', [App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');
        Route::get('booking/{booking}/edit', [App\Http\Controllers\BookingController::class, 'edit'])->name('booking.edit');
        Route::put('booking/{booking}', [App\Http\Controllers\BookingController::class, 'update'])->name('booking.update');
        Route::patch('booking/{booking}/status', [App\Http\Controllers\BookingController::class, 'updateStatus'])->name('booking.status');
        Route::delete('booking/{booking}', [App\Http\Controllers\BookingController::class, 'destroy'])->name('booking.destroy');

        # ---- STAFF
        Route::get('staff', [App\Http\Controllers\StaffController::class, 'index'])->name('staff.index');
        Route::get('staff/create', [App\Http\Controllers\StaffController::class, 'create'])->name('staff.create');
        Route::post('staff', [App\Http\Controllers\StaffController::class, 'store'])->name('staff.store');
        Route::get('staff/{staff}/edit', [App\Http\Controllers\StaffController::class, 'edit'])->name('staff.edit');
        Route::put('staff/{staff}', [App\Http\Controllers\StaffController::class, 'update'])->name('staff.update');
        Route::delete('staff/{staff}', [App\Http\Controllers\StaffController::class, 'destroy'])->name('staff.destroy');

        # ---- STAFF FUNCTIONS
        Route::get('staff-functions', [App\Http\Controllers\StaffFunctionController::class, 'index'])->name('staff.function');
        Route::get('staff-functions/create', [App\Http\Controllers\StaffFunctionController::class, 'create'])->name('staff.function.create');
        Route::post('staff-functions', [App\Http\Controllers\StaffFunctionController::class, 'store'])->name('staff.function.store');
        Route::get('staff-functions/{staffFunction}/edit', [App\Http\Controllers\StaffFunctionController::class, 'edit'])->name('staff.function.edit');
        Route::put('staff-functions/{staffFunction}', [App\Http\Controllers\StaffFunctionController::class, 'update'])->name('staff.function.update');
        Route::delete('staff-functions/{staffFunction}', [App\Http\Controllers\StaffFunctionController::class, 'destroy'])->name('staff.function.destroy');

        # ---- MENU ITEMS (service = menu in food context)
        Route::get('service', [App\Http\Controllers\MenuItemController::class, 'index'])->name('service.index');
        Route::get('service/create', [App\Http\Controllers\MenuItemController::class, 'create'])->name('service.create');
        Route::post('service', [App\Http\Controllers\MenuItemController::class, 'store'])->name('service.store');
        Route::get('service/{menuItem}/edit', [App\Http\Controllers\MenuItemController::class, 'edit'])->name('service.edit');
        Route::put('service/{menuItem}', [App\Http\Controllers\MenuItemController::class, 'update'])->name('service.update');
        Route::patch('service/{menuItem}/toggle', [App\Http\Controllers\MenuItemController::class, 'toggleActive'])->name('service.toggle');
        Route::delete('service/{menuItem}', [App\Http\Controllers\MenuItemController::class, 'destroy'])->name('service.destroy');

        # ---- MENU SECTIONS
        Route::post('menu-sections', [App\Http\Controllers\MenuSectionController::class, 'store'])->name('menu.sections.store');
        Route::put('menu-sections/{menuSection}', [App\Http\Controllers\MenuSectionController::class, 'update'])->name('menu.sections.update');
        Route::delete('menu-sections/{menuSection}', [App\Http\Controllers\MenuSectionController::class, 'destroy'])->name('menu.sections.destroy');

        # >>---- CLIENT
        Route::get('client', [App\Http\Controllers\PersonController::class, 'index'])->name('client.index');
        Route::get('client/create', [App\Http\Controllers\PersonController::class, 'create'])->name('client.create');
        Route::post('client', [App\Http\Controllers\PersonController::class, 'store'])->name('client.store');
        Route::get('client/{person}/edit', [App\Http\Controllers\PersonController::class, 'edit'])->name('client.edit');
        Route::put('client/{person}', [App\Http\Controllers\PersonController::class, 'update'])->name('client.update');
        Route::delete('client/{person}', [App\Http\Controllers\PersonController::class, 'destroy'])->name('client.destroy');

        Route::get('account/edit', [App\Http\Controllers\AccountController::class, 'edit'])
            ->name('account.edit');
        Route::put('account', [App\Http\Controllers\AccountController::class, 'update'])
            ->name('account.update');
    });
