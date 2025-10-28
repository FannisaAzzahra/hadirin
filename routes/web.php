<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\PlnMemberController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\PresenceDetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyUnitController;
use Illuminate\Support\Facades\Auth;
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

// Root redirect
Route::get('/', function () {
    return Auth::check() ? redirect()->route('home') : redirect()->route('login');
})->name('root');

// Authentication Routes
Auth::routes([
    'register' => false, // Menonaktifkan registrasi
    'reset' => true,    // Memastikan reset password tetap aktif
]);

/*
|--------------------------------------------------------------------------
| Public Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/

// Public attendance routes
Route::prefix('absen')->name('absen.')->group(function () {
    Route::get('/{slug}', [AbsenController::class, 'index'])->name('index');
    Route::post('/save/{id}', [AbsenController::class, 'save'])->name('save');
});

// Public signature image route (works even if storage symlink is missing)
Route::get('/signature/{id}', [PresenceDetailController::class, 'showSignature'])
    ->name('public.signature');

// Public API routes
Route::prefix('api/public')->name('api.public.')->group(function () {
    Route::get('/units-by-company', [AbsenController::class, 'getUnitsByCompany'])->name('units-by-company');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Require Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    
    // Dashboard/Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    /*
    |--------------------------------------------------------------------------
    | API Routes (Authenticated)
    |--------------------------------------------------------------------------
    */
    Route::prefix('api')->name('api.')->middleware(['auth'])->group(function () {
        // Notifications API - Fixed to prevent redirect loops
        Route::get('/notifications', [HomeController::class, 'notifications'])
              ->name('notifications')
              ->middleware('throttle:60,1'); // Rate limiting for API calls
        
        // Calendar data API
        Route::get('/calendar-data', [HomeController::class, 'calendarData'])
              ->name('calendar-data')
              ->middleware('throttle:60,1');
        
        // Companies with units API
        Route::get('/companies-with-units', [CompanyController::class, 'getCompaniesWithUnits'])
              ->name('companies-with-units');
        
        // Units by company API
        Route::get('/units-by-company', [CompanyUnitController::class, 'getUnitsByCompany'])
              ->name('units-by-company');
    });

    // Alternative route for calendar data (backward compatibility)
    Route::get('/calendar-data', [HomeController::class, 'calendarData'])->name('calendar.data');

    /*
    |--------------------------------------------------------------------------
    | User Profile Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'profile'])->name('index');
        Route::get('/edit', [App\Http\Controllers\UserController::class, 'editProfile'])->name('edit');
        Route::put('/update', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('update');
        Route::put('/password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('password.update');
    });

    // Backward compatibility for profile route
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');

    /*
    |--------------------------------------------------------------------------
    | User Management Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('users', App\Http\Controllers\UserController::class)->except(['show']);

    /*
    |--------------------------------------------------------------------------
    | Presence Management Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('presence')->name('presence.')->group(function () {
        // Special routes that need to come before resource routes
        Route::get('/barcode/{slug}', [PresenceController::class, 'barcode'])->name('barcode');
        Route::get('/barcode-details/{slug}', [PresenceController::class, 'getBarcodeDetails'])->name('barcode-details');
    });
    
    // Resource route for presence
    Route::resource('presence', PresenceController::class);

    /*
    |--------------------------------------------------------------------------
    | Presence Detail Routes
    |--------------------------------------------------------------------------
    | IMPORTANT: Specific routes must come before general resource routes
    */
    Route::prefix('presence-detail')->name('presence-detail.')->group(function () {
        Route::get('/export-pdf/{id}', [PresenceDetailController::class, 'exportPdf'])->name('export-pdf');
        Route::get('/export-excel/{id}', [PresenceDetailController::class, 'exportExcel'])->name('export-excel');
        Route::get('/export-word/{id}', [PresenceDetailController::class, 'exportWord'])->name('export-word');
        Route::delete('/{id}', [PresenceDetailController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | PLN Members Management Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('pln-members')->name('pln-members.')->group(function () {
        // Special routes
        Route::get('/template', [PlnMemberController::class, 'downloadTemplate'])->name('template');
        Route::post('/import-ajax', [PlnMemberController::class, 'importAjax'])->name('import-ajax');
    });
    
    // Resource route for PLN members
    Route::get('pln-members/export-excel', [PlnMemberController::class, 'exportExcel'])->name('pln-members.export-excel');
    Route::resource('pln-members', PlnMemberController::class)->except(['show']);

    /*
    |--------------------------------------------------------------------------
    | Company Management Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('companies')->name('companies.')->group(function () {
        // Special routes
        Route::patch('/{company}/toggle-status', [CompanyController::class, 'toggleStatus'])->name('toggle-status');
    });
    
    // Resource route for companies
    Route::resource('companies', CompanyController::class);

    /*
    |--------------------------------------------------------------------------
    | Company Units Management Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('company-units')->name('company-units.')->group(function () {
        // Special routes
        Route::patch('/{companyUnit}/toggle-status', [CompanyUnitController::class, 'toggleStatus'])->name('toggle-status');
    });
    
    // Resource route for company units
    Route::resource('company-units', CompanyUnitController::class);
});

/*
|--------------------------------------------------------------------------
| Fallback Routes
|--------------------------------------------------------------------------
*/

// Handle 404 errors gracefully
Route::fallback(function () {
    if (request()->expectsJson()) {
        return response()->json(['error' => 'Route not found'], 404);
    }
    
    return Auth::check() 
        ? redirect()->route('home')->with('error', 'Halaman yang Anda cari tidak ditemukan.')
        : redirect()->route('login')->with('error', 'Halaman yang Anda cari tidak ditemukan.');
});



