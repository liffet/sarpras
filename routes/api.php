<?php

use App\Http\Controllers\Api\KategoriApiController;
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
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']); // admin only (optional)
});

// ============================
// 📦 BARANG
// ============================

Route::prefix('barang')->group(function () {
    Route::get('/', [BarangApiController::class, 'index']);
    Route::get('/{id}', [BarangApiController::class, 'show']);
    
    // Barang hanya untuk admin (bisa dibungkus role:admin)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [BarangApiController::class, 'store']);
        Route::put('/{id}', [BarangApiController::class, 'update']);
        Route::delete('/{id}', [BarangApiController::class, 'destroy']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/admin/barang', [BarangApiController::class, 'apiStore']); // opsional
});



// routes/api.php
Route::apiResource('kategori', KategoriApiController::class);
    
    // Atau jika ingin manual:
    // Route::get('kategori', [KategoriApiController::class, 'index']);
    // Route::post('kategori', [KategoriApiController::class, 'store']);
    // Route::get('kategori/{id}', [KategoriApiController::class, 'show']);
    // Route::put('kategori/{id}', [KategoriApiController::class, 'update']);
    // Route::delete('kategori/{id}', [KategoriApiController::class, 'destroy']);

// ============================
// 📥 PEMINJAMAN
// ============================
Route::middleware('auth:sanctum')->get('/riwayat-peminjaman', [PeminjamanController::class, 'riwayatPeminjaman']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('peminjaman')->group(function () {
        // Gunakan indexApi untuk Flutter

        Route::post('/', [PeminjamanController::class, 'store']); // user: ajukan peminjaman
    });

    // ADMIN routes - bisa ditambahkan middleware role:admin
    Route::prefix('admin/peminjaman')->group(function () {
        Route::get('/', [PeminjamanController::class, 'index']); // admin: lihat semua peminjaman
        Route::put('/{id}/status/{status}', [PeminjamanController::class, 'apiUpdateStatus'])->name('peminjaman.updateStatus');
        Route::put('/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
        Route::put('/{id}/reject', [PeminjamanController::class, 'ditolak'])->name('peminjaman.reject');
    });
});

// ============================
// 🔁 PENGEMBALIAN
// ============================

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('pengembalian')->group(function () {
        Route::post('/{id}', [PengembalianController::class, 'store']); // user: ajukan pengembalian (dengan foto)
        Route::get('/{id}', [PengembalianController::class, 'show']);   // user/admin: lihat detail pengembalian
        Route::get('/', [PengembalianController::class, 'index']); // user: lihat riwayat pengembalian
    });
    
    // ADMIN pengembalian routes
    Route::prefix('admin/pengembalian')->group(function () {
        Route::get('/', [PengembalianController::class, 'adminIndex']); // admin: lihat semua pengembalian
        Route::put('/{id}/approve', [PengembalianController::class, 'approve']); // admin: setujui pengembalian
    });
});