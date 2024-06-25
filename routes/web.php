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
    

    Route::middleware(['auth', 'role:Admin'])->group(function () {
    
        Route::get('/rahasia', function () {
            return 'You are authenticated and can access this secret page.';
        });
        Route::resource('/AddUser', AuthManager::class);        
        Route::resource('AddBeasiswa', BeasiswaController::class);
        Route::resource('/AddProdi', AddProdiController::class);
        Route::resource('/AddFakultas', AddFakultasController::class);
        
    });


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

        Route::middleware(['auth', 'role:Prodi'])->group(function () {
            
            // Route::resource('prodi/approve', BeasiswaDetailController::class);
        });

        Route::middleware(['auth', 'role:Mahasiswa'])->group(function () {
            Route::get('/students/timeline', [StudentController::class, 'timeline'])->name('student.timeline');
            
            // Route::get('/students/daftar/{id_periode}/{id_beasiswa}/{nrp}/edit', [StudentController::class, 'edit'])->name('student.edit');
            // Route::delete('/students/daftar/{id_periode}/{id_beasiswa}/{nrp}', [StudentController::class, 'destroy'])->name('student.destroy');
            Route::post('/students/pendaftaran/{id_periode}/{id_beasiswa}/{nrp}', [StudentController::class, 'indexPendaftaran'])->name('student.indexPendaftaran');
            Route::post('/students/pendaftaran/{id_periode}/{id_beasiswa}/{nrp}/daftar', [StudentController::class, 'storePendaftaran'])->name('daftar.store');
            
            Route::get('/students/history', [BeasiswaDetailController::class, 'indexStudent']);
            

            Route::resource('/profil', ProfilController::class);
        });
    });


    // Route::get('/Students/Timeline', [StudentController::class, 'indexTimeline']);

    
    // Route::get('/admin', function () {
    //     return ('hanya admin yang bisa lihat');
    // })->middleware('role:Admin');

    // Route::get('/fakultas', function () {
    //     return ('hanya admin yang bisa lihat');
    // })->middleware('role:Fakultas');

    // Route::get('/prodi', function () {
    //     return ('hanya admin yang bisa lihat');
    // })->middleware('role:Prodi');

    // Route::get('/mahasiswa', function () {
    //     return ('hanya admin yang bisa lihat');
    // })->middleware('role:Mahasiswa');
});    






// Route::post('/AddUser', [AddUserController::class, 'store'])->name('user.store');
// Route::delete('/Adduser/{nrp}', [AddUserController::class, 'destroy'])->name('user.destroy');

// Route::get('/AddUser', [AddUserController::class, 'index'])->name('AddUser.index');
// Route::post('/AddUser/{nrp}', [AddUserController::class, 'update'])->name('user.update');
// Route::delete('/AddUser/{nrp}', [AddUserController::class, 'destroy'])->name('user.destroy');
// Route::put('/AddUser/{nrp}', [AddUserController::class, 'update'])->name('user.update');

// Route::get('/AddFakultas', [AddFakultasController::class, 'index'])->name('fakultas.index');
// Route::post('/AddFakultas', [AddFakultasController::class, 'store'])->name('fakultas.store');
// Route::put('/AddFakultas/{id}', [AddFakultasController::class, 'update'])->name('fakultas.update');
// Route::delete('/AddFakultas/{id}', [AddFakultasController::class, 'destroy'])->name('fakultas.destroy');

// Route::get('/Prodi', [ProdiController::class, 'index'])->name('prodi.index');
// Route::post('/AddProdi', [ProdiController::class, 'store'])->name('prodi.store');
// Route::put('/AddProdi/{id}', [ProdiController::class, 'update'])->name('prodi.update');
// Route::delete('/AddProdi/{id}', [ProdiController::class, 'destroy'])->name('prodi.destroy');

// Route::resource('AddBeasiswa', BeasiswaController::class)->except(['show']);
// Route::get('/AddBeasiswa', [BeasiswaController::class, 'index'])->name('beasiswa.index');
// Route::delete('/AddBeasiswa/{id}', [BeasiswaController::class, 'destroy'])->name('beasiswa.destroy');

// Route::get('/students/daftar/{id_periode}/{id_beasiswa}/{id_mahasiswa}', [StudentController::class, 'indexPendaftaran'])->name('student.daftar');
