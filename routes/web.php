<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanDowntimeController;
use App\Http\Controllers\LaporanHarianController;
use App\Http\Controllers\LaporanKerusakanController;
use App\Http\Controllers\MasterMappingController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\PermintaanHakAksesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('test');
});

// ==========================================
// RUTE PUBLIK (Bisa diakses tanpa Login)
// ==========================================
Route::get('permintaan-hak-akses', [PermintaanHakAksesController::class, 'create'])->name('hak-akses.create');
Route::post('hak-akses', [PermintaanHakAksesController::class, 'store'])->name('hak-akses.store');

// Jika Anda ingin seluruh fungsi Resource (create, store, show, dll) bisa diakses publik:
// Route::resource('hak-akses', PermintaanHakAksesController::class);

Route::get('/form-perubahan', [PermintaanController::class, 'create']);
Route::post('/form-permintaan/store', [PermintaanController::class, 'store']);

// 1. Rute Autentikasi (Dibuat otomatis oleh Laravel UI)
Auth::routes(['register' => false]);

// ==========================================
// RUTE TERLINDUNGI (Hanya untuk yang sudah Login)
// ==========================================
Route::middleware(['auth'])->group(function () {

    // Redirect user setelah login ke dashboard
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Route Kumpulan Manajemen Aset
    Route::get('/asset', [AssetController::class, 'index']);
    Route::get('/asset/create', [AssetController::class, 'create']);
    Route::post('/asset/store', [AssetController::class, 'store']);
    Route::get('/asset/{id}/edit', [AssetController::class, 'edit']);
    Route::put('/asset/{id}', [AssetController::class, 'update']);
    Route::delete('/asset/{id}', [AssetController::class, 'destroy']);

    // Route Laporan
    Route::get('/laporan', [LaporanHarianController::class, 'index']);
    Route::get('/laporan/create', [LaporanHarianController::class, 'create']);
    Route::post('/laporan/store', [LaporanHarianController::class, 'store']);
    Route::get('/laporan/{id}/edit', [LaporanHarianController::class, 'edit']);
    Route::put('/laporan/{id}', [LaporanHarianController::class, 'update']);
    Route::delete('/laporan/{id}', [LaporanHarianController::class, 'destroy']);
    Route::get('/laporan-handover', [LaporanHarianController::class, 'handover']);
    Route::get('/laporan-kpi', [LaporanHarianController::class, 'kpi']);
    Route::get('/form-permintaan-index', [PermintaanController::class, 'index']);
    Route::post('/form-permintaan/approve/{id}', [PermintaanController::class, 'approve']);
    Route::get('/form-permintaan/cetak/{id}', [PermintaanController::class, 'cetakPdf']);
    Route::delete('/form-permintaan/{id}', [PermintaanController::class, 'destroy'])->name('form-permintaan.destroy');

    // Catatan: Jika ingin hak-akses khusus admin/yang login saja, biarkan di sini. 
    // Tapi jika ingin publik, pindahkan ke luar middleware auth seperti di atas.
    Route::get('hak-akses', [PermintaanHakAksesController::class, 'index'])->name('hak-akses.index');
    Route::get('hak-akses/{id}/edit', [PermintaanHakAksesController::class, 'edit'])->name('hak-akses.edit');
    Route::put('hak-akses/{id}', [PermintaanHakAksesController::class, 'update'])->name('hak-akses.update');
    Route::delete('hak-akses/{id}', [PermintaanHakAksesController::class, 'destroy'])->name('hak-akses.destroy');
    Route::get('hak-akses/{id}', [PermintaanHakAksesController::class, 'show'])->name('hak-akses.show');
    Route::get('hak-akses/export/{id}', [PermintaanHakAksesController::class, 'cetakPdf'])->name('hak-akses.export');

    Route::get('/laporan/export', [LaporanHarianController::class, 'export'])->name('laporan.export');
    Route::get('/laporan/export-pdf', [App\Http\Controllers\LaporanHarianController::class, 'exportPdf'])->name('laporan.export.pdf');
    Route::resource('laporan-downtime', LaporanDowntimeController::class);
    Route::resource('laporan-kerusakan', LaporanKerusakanController::class);
    Route::get('laporan-kerusakan/{id}/pdf', [LaporanKerusakanController::class, 'cetakPdf'])->name('laporan-kerusakan.pdf');
    Route::get('laporan-kerusakan/{id}/edit', [LaporanKerusakanController::class, 'edit'])->name('laporan-kerusakan.edit');
    Route::put('laporan-kerusakan/{id}', [LaporanKerusakanController::class, 'update'])->name('laporan-kerusakan.update');
    Route::delete('laporan-kerusakan/{id}', [LaporanKerusakanController::class, 'destroy'])->name('laporan-kerusakan.destroy');

    // Route Master Mapping Konfigurasi
    Route::get('/master-mapping', [MasterMappingController::class, 'index']);
    Route::post('/master-mapping/{type}', [MasterMappingController::class, 'store']);
    Route::delete('/master-mapping/{id}', [MasterMappingController::class, 'destroy']);

    // Rute Manajemen User
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
    Route::post('/users/store', [App\Http\Controllers\UserController::class, 'store']);
    Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy']);

    Route::get('/schedules', [App\Http\Controllers\ScheduleController::class, 'index']);
    Route::get('/schedules/create', [App\Http\Controllers\ScheduleController::class, 'create']);
    Route::post('/schedules/store', [App\Http\Controllers\ScheduleController::class, 'store']);
    Route::get('/schedules/export', [App\Http\Controllers\ScheduleController::class, 'export']);
});
