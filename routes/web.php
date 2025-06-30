<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\DocumentationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/structure', [StructureController::class, 'index'])->name('struktur');


Route::get('/dokumentasi', [DocumentationController::class, 'index'])->name('documentation.index');
Route::get('/dokumentasi/kategori/{id}', [DocumentationController::class, 'filterByKategori'])->name('dokumentasi.kategori');
Route::get('/dokumentasi/{id}', [DocumentationController::class, 'show'])->name('documentation.show');


Route::post('/aspirasi', [AspirationController::class, 'store'])->name('aspirasi.store');
Route::get('/aspirasi/{kode}', [AspirationController::class, 'show'])->name('aspirasi.show');
Route::get('/aspirasi', [AspirationController::class, 'index'])->name('aspirasi.index');
Route::get('/aspirations/cek', [AspirationController::class, 'cek'])->name('aspirasi.cek');

Route::resource('users', UserController::class);
