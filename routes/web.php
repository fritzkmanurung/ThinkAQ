<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('home'); // Arahkan "/" ke login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard'); // Ganti sesuai dengan view dashboard Anda
})->middleware('auth')->name('dashboard');

use App\Http\Controllers\TeksBacaanController;
use App\Http\Controllers\PasanganQaController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PembelajaranController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('home');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Teks Bacaan
Route::get('/teks-bacaan', [TeksBacaanController::class, 'index'])->middleware('auth')->name('teks-bacaan.index');
Route::get('/teks-bacaan/create', [TeksBacaanController::class, 'create'])->name('teks-bacaan.create');
Route::post('/teks-bacaan', [TeksBacaanController::class, 'store'])->name('teks-bacaan.store');
Route::get('/teks-bacaan/{text_id}/detail', [TeksBacaanController::class, 'detail'])->name('teks-bacaan.detail');
Route::get('/teks-bacaan/{id}/edit', [TeksBacaanController::class, 'edit'])->name('teks-bacaan.edit');
Route::put('/teks-bacaan/{id}', [TeksBacaanController::class, 'update'])->name('teks-bacaan.update');
Route::delete('/teks-bacaan/{id}', [TeksBacaanController::class, 'destroy'])->name('teks-bacaan.destroy');
Route::post('/pasangan-qa', [PasanganQaController::class, 'store'])->name('pasangan-qa.store');
// Nilai


Route::get('/pembelajaran', [PembelajaranController::class, 'index'])->name('pembelajaran.index');
Route::get('/teks-bacaan/{text_id}', [PembelajaranController::class, 'show'])->name('teks-bacaan.show');
Route::post('/jawaban', [PembelajaranController::class, 'store'])->name('jawaban.store');

Route::get('/nilai/{text_id}/{user_id}', [NilaiController::class, 'show'])->name('nilai.show');
Route::post('/nilai/{text_id}/{user_id}', [NilaiController::class, 'store'])->name('nilai.store');