<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\BarangApiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;

// ============================
// 🔐 AUTH
// ============================

Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('/logout', [AuthApiController::class, 'logoutApi']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// ============================
// 👤 USER LIST (opsional admin)
// ============================
Route::get('/users', [UserController::class, 'index']); // admin only (optional)

// ============================
// 📦 BARANG
// ============================

Route::prefix('barang')->group(function () {
    Route::get('/', [BarangApiController::class, 'index']);
    Route::get('/{id}', [BarangApiController::class, 'show']);
    
    // Barang hanya untuk admin (bisa dibungkus role:admin)
    Route::post('/', [BarangApiController::class, 'store']);
    Route::put('/{id}', [BarangApiController::class, 'update']);
    Route::delete('/{id}', [BarangApiController::class, 'destroy']);
});
Route::post('/admin/barang', [BarangApiController::class, 'apiStore']); // opsional

// ============================
// 📥 PEMINJAMAN
// ============================

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('peminjaman')->group(function () {
        Route::get('/', [PeminjamanController::class, 'index']); // user: lihat peminjaman miliknya
        Route::post('/', [PeminjamanController::class, 'store']); // user: ajukan peminjaman

    });

    // ADMIN update status peminjaman (gunakan role:admin jika punya middleware)
    Route::put('/admin/peminjaman/{id}/status/{status}', [PeminjamanController::class, 'apiUpdateStatus'])->name('peminjaman.updateStatus');
});

// ============================
// 🔁 PENGEMBALIAN
// ============================

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('pengembalian')->group(function () {
        Route::post('/{id}', [PengembalianController::class, 'store']); // user: ajukan pengembalian (dengan foto)
        Route::get('/{id}', [PengembalianController::class, 'show']);   // user/admin: lihat detail pengembalian
    });
});
