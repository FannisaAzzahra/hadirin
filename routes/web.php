<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\PlnMemberController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\PresenceDetailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
})->name('home');

//Admin
Route::resource('presence', PresenceController::class);
Route::delete('presence-detail/{id}', [PresenceDetailController::class, 'destroy'])->name('presence-detail.destroy');
Route::get('presence-detail/export-pdf/{id}', [PresenceDetailController::class, 'exportPdf'])->name('presence-detail.export-pdf');
Route::get('presence-detail/export-excel/{id}', [PresenceDetailController::class, 'exportExcel'])->name('presence-detail.export-excel');

//Publik
Route::get('absen/{slug}', [AbsenController::class, 'index'])->name('absen.index');
Route::post('absen/save/{id}', [AbsenController::class, 'save'])->name('absen.save');

// Data Pegawai PLN
Route::resource('pln-members', PlnMemberController::class);
