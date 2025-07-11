<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\DocumentationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use Filament\Facades\Filament;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\AgendaController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/structure', [StructureController::class, 'index'])->name('struktur');

Route::get('/dokumentasi', [DocumentationController::class, 'index'])->name('documentation.index');
Route::get('/dokumentasi/kategori/{id}', [DocumentationController::class, 'filterByKategori'])->name('dokumentasi.kategori');
Route::get('/dokumentasi/{id}', [DocumentationController::class, 'show'])->name('documentation.show');


Route::post('/aspirasi', [AspirationController::class, 'store'])->name('aspirasi.store');
Route::get('/aspirasi/{kode}', [AspirationController::class, 'show'])->name('aspirasi.show');
Route::get('/aspirasi', [AspirationController::class, 'index'])->name('aspirasi.index');
Route::get('/aspirations/cek', [AspirationController::class, 'cek'])->name('aspirasi.cek');
Route::get('/aspirasi/download/{kode}', [AspirationController::class, 'download'])->name('aspirasi.download');
Route::post('/aspirasi/{kode}/balas', [AspirationController::class, 'balas'])->name('aspirasi.balas');

Route::resource('users', UserController::class);

Route::post('/invitations/store', [InvitationController::class, 'store'])->name('invitations.store');
Route::get('/invitations/{kode}', [InvitationController::class, 'showByKode'])->name('invitations.show');
Route::post('/invitations/{id}/konfirmasi', [InvitationController::class, 'konfirmasi'])->name('invitations.konfirmasi');

Route::get('/struktur/bagian/{bagian}', [StructureController::class, 'showByBagian'])->name('struktur.bagian');
Route::get('/struktur', [StructureController::class, 'index'])->name('struktur.index');
Route::get('/struktur/periode', [StructureController::class, 'filterPeriode'])->name('struktur.periode');

Route::get('/komisi', [KomisiController::class, 'index'])->name('komisi.index');

Route::get('/debug-invitation-route', function () {
    return route('filament.admin.resources.invitations.index');
});

Route::get('/agenda/events', [AgendaController::class, 'index'])->name('agenda.events');




