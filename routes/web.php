<?php

use App\Http\Controllers\AddUserController;
use App\Http\Controllers\AddBeasiswaController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\AddFakultasController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Login;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PeriodeBeasiswaController;
use App\Http\Controllers\AddProdiController;
use App\Http\Controllers\BeasiswaController;
use App\Http\Controllers\BeasiswaDetailController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/login', [Login::class, 'index'])->name('loginpage');


// Inject jika tidak ada
// Route::resource('/AddUser', AuthManager::class);

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::post('/logout', [AuthManager::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboardadmin');


    Route::middleware(['auth', 'role:Fakultas,Prodi,Mahasiswa'])->group(function () {
        Route::get('/approve', [BeasiswaDetailController::class, 'index'])->name('fakultas.approve.index');
        Route::post('/approve/{id_periode}/{id_beasiswa}/{nrp}/{role}/{condition}', [BeasiswaDetailController::class, 'storee'])->name('fakultas.approve.store');

        Route::middleware(['auth', 'role:Fakultas'])->group(function () {
            
            // Route::get('/Fakultas', [FakultasController::class, 'index']);
            Route::resource('/fakultas/periode', PeriodeController::class);
            Route::get('fakultas/periode_beasiswa/{id_periode}/{id_beasiswa}/edit', [PeriodeBeasiswaController::class, 'edit'])->name('periode_beasiswa.edit');
            Route::delete('fakultas/periode_beasiswa/{id_periode}/{id_beasiswa}', [PeriodeBeasiswaController::class, 'destroy'])->name('periode_beasiswa.destroy');
            Route::resource('fakultas/periode_beasiswa', PeriodeBeasiswaController::class)->except(['edit', 'destroy']);
        
            // Route::resource('fakultas/approve', BeasiswaDetailController::class);
            // Route::resource('fakultas/approve', BeasiswaDetailController::class);

        });

});    

