<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\PlnMemberController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\PresenceDetailController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

//Admin
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // PERBAIKAN: Ubah rute notifikasi menjadi API endpoint
    Route::get('/api/notifications', [App\Http\Controllers\HomeController::class, 'notifications'])->name('api.notifications'); // Tambahkan nama rute jika diperlukan
    
    Route::get('/calendar-data', [HomeController::class, 'calendarData'])->name('calendar.data');

    // Rute untuk Profil
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [App\Http\Controllers\UserController::class, 'editProfile'])->name('profile.edit'); // Ubah ke editProfile
    Route::put('/profile', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update'); // Ubah ke updateProfile
    Route::put('/profile/password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('profile.password.update');

    Route::resource('users', App\Http\Controllers\UserController::class)->except(['show']); // Biarkan ini tetap seperti ini
    
    Route::resource('presence', PresenceController::class);
    Route::delete('presence-detail/{id}', [PresenceDetailController::class, 'destroy'])->name('presence-detail.destroy');
    Route::get('presence-detail/export-pdf/{id}', [PresenceDetailController::class, 'exportPdf'])->name('presence-detail.export-pdf');
    Route::get('presence-detail/export-excel/{id}', [PresenceDetailController::class, 'exportExcel'])->name('presence-detail.export-excel');

    // Data Pegawai PLN
    Route::resource('pln-members', PlnMemberController::class)->except(['show']);
    Route::get('pln-members/template', [PlnMemberController::class, 'downloadTemplate'])->name('pln-members.template');
    Route::post('pln-members/import-ajax', [PlnMemberController::class, 'importAjax'])->name('pln-members.import-ajax');
});


//Publik
Route::get('absen/{slug}', [AbsenController::class, 'index'])->name('absen.index');
Route::post('absen/save/{id}', [AbsenController::class, 'save'])->name('absen.save');


Auth::routes();