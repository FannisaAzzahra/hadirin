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

Route::get('/', function () {
    return redirect()->route('home');
});

//Admin
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // API endpoints
    Route::get('/api/notifications', [App\Http\Controllers\HomeController::class, 'notifications'])->name('api.notifications');
    Route::get('/calendar-data', [HomeController::class, 'calendarData'])->name('calendar.data');

    // Profile routes
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [App\Http\Controllers\UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('profile.password.update');

    // User management
    Route::resource('users', App\Http\Controllers\UserController::class)->except(['show']);
    
    // Presence management
    Route::resource('presence', PresenceController::class);
    
    // Presence Detail routes - IMPORTANT: Order matters!
    Route::get('presence-detail/export-pdf/{id}', [PresenceDetailController::class, 'exportPdf'])->name('presence-detail.export-pdf');
    Route::get('presence-detail/export-excel/{id}', [PresenceDetailController::class, 'exportExcel'])->name('presence-detail.export-excel');
    Route::delete('presence-detail/{id}', [PresenceDetailController::class, 'destroy'])->name('presence-detail.destroy');

    // PLN Members management
    Route::resource('pln-members', PlnMemberController::class)->except(['show']);
    Route::get('pln-members/template', [PlnMemberController::class, 'downloadTemplate'])->name('pln-members.template');
    Route::post('pln-members/import-ajax', [PlnMemberController::class, 'importAjax'])->name('pln-members.import-ajax');

    // Companies management
    Route::resource('companies', CompanyController::class);
    Route::patch('companies/{company}/toggle-status', [CompanyController::class, 'toggleStatus'])->name('companies.toggle-status');
    Route::get('/api/companies-with-units', [CompanyController::class, 'getCompaniesWithUnits'])->name('api.companies-with-units');

    // Company Units management
    Route::resource('company-units', CompanyUnitController::class);
    Route::patch('company-units/{companyUnit}/toggle-status', [CompanyUnitController::class, 'toggleStatus'])->name('company-units.toggle-status');
    Route::get('/api/units-by-company', [CompanyUnitController::class, 'getUnitsByCompany'])->name('api.units-by-company');
});

//Public routes
Route::get('absen/{slug}', [AbsenController::class, 'index'])->name('absen.index');
Route::post('absen/save/{id}', [AbsenController::class, 'save'])->name('absen.save');
Route::get('/api/units-by-company-public', [AbsenController::class, 'getUnitsByCompany'])->name('api.units-by-company-public');

Auth::routes();