<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\BarangApiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

//  Auth & User
Route::post('/login', [AuthApiController::class, 'login']);
Route::middleware('auth:sanctum')->delete('/logout', [AuthApiController::class, 'logoutApi']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users', [UserController::class, 'index']);

//  Barang
Route::prefix('barang')->group(function () {
    Route::get('/', [BarangApiController::class, 'index']);
    Route::get('/{id}', [BarangApiController::class, 'show']);
    Route::post('/', [BarangApiController::class, 'store']);
    Route::put('/{id}', [BarangApiController::class, 'update']);
    Route::delete('/{id}', [BarangApiController::class, 'destroy']);
});
Route::post('/admin/barang', [BarangApiController::class, 'apiStore']); // Optional: bisa dipindah ke group admin

//  Peminjaman
Route::prefix('peminjaman')->group(function () {
    Route::get('/', [PeminjamanController::class, 'index']);
    Route::get('/create', [PeminjamanController::class, 'create']);
    Route::get('/{id}', [PeminjamanController::class, 'show']);
    Route::get('/{id}/edit', [PeminjamanController::class, 'edit']);
    Route::post('/', [PeminjamanController::class, 'store']);
    Route::put('/{id}', [PeminjamanController::class, 'update']);
    Route::delete('/{id}', [PeminjamanController::class, 'destroy']);
});

//Update status peminjaman (gunakan hanya satu method!)
Route::put('/admin/peminjaman/{id}/{status}', [PeminjamanController::class, 'apiUpdateStatus']);

//  Pengembalian


// Update status peminjaman: menunggu -> disetujui / ditolak / selesai
Route::put('/admin/peminjaman/{id}/status/{status}', [PeminjamanController::class, 'apiUpdateStatus'])
    ->name('peminjaman.updateStatus');



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/pengembalian', [PengembalianController::class, 'store']);
    Route::get('/pengembalian/{id}', [PengembalianController::class, 'show']);
});
