<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Storage;


/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
*/

// Halaman utama diarahkan ke login
Route::get('/', function () {
    return view('login');

});




Route::get('/gambar/{folder}/{filename}', function ($folder, $filename) {
    $path = "barang/{$filename}";

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $file = Storage::disk('public')->get($path);
    $mime = Storage::disk('public')->mimeType($path);

    return response($file, 200)->header('Content-Type', $mime);
});



// Auth routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess']);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk halaman pendataan (jika ingin diakses tanpa login)
Route::get('/admin/pendataan', function () {
    $kategori = KategoriBarang::all();
    $barangs = Barang::with('kategori')->get();
    return view('pendataan', compact('kategori', 'barangs'));
})->name('admin.pendataan');



Route::prefix('laporan')->group(function () {
    Route::get('/barang', [LaporanController::class, 'barang'])->name('laporan.barang');
    Route::get('/peminjaman', [LaporanController::class, 'peminjaman'])->name('laporan.peminjaman');
    Route::get('/pengembalian', [LaporanController::class, 'pengembalian'])->name('laporan.pengembalian');
});

// Group untuk route yang memerlukan login
Route::middleware(['auth'])->prefix('admin')->group(function () {

    // Dashboard admin
    Route::get('/', [AuthController::class, 'adminDashboard'])->name('admin');

    
    // Peminjaman
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::put('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::put('/peminjaman/{id}/ditolak', [PeminjamanController::class, 'ditolak'])->name('peminjaman.ditolak');
    Route::put('/peminjaman/{id}/status/{status}', [PeminjamanController::class, 'updateStatus'])->name('peminjaman.updateStatus');
    Route::put('/peminjaman/kembalikan/{id}', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');

    // Barang
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    // Kategori Barang
    Route::get('/kategori-barang/create', [KategoriBarangController::class, 'create'])->name('kategori-barang.create');
    Route::post('/kategori-barang', [KategoriBarangController::class, 'store'])->name('kategori-barang.store');
    Route::get('/kategori-barang/{id}/edit', [KategoriBarangController::class, 'edit'])->name('kategori-barang.edit');
    Route::put('/kategori-barang/{id}', [KategoriBarangController::class, 'update'])->name('kategori-barang.update');
    Route::delete('/kategori-barang/{id}', [KategoriBarangController::class, 'destroy'])->name('kategori-barang.destroy');

    // Pengguna
    Route::resource('/pengguna', PenggunaController::class);


    Route::middleware(['auth'])->group(function () {
    // Pengembalian routes for admin
    Route::prefix('pengembalian')->group(function () {
        Route::get('/', [PengembalianController::class, 'index'])->name('pengembalians.index');
        Route::post('/{id}/setujui', [PengembalianController::class, 'setujui'])->name('pengembalian.setujui');
        
        Route::post('/{id}/tolak', [PengembalianController::class, 'tolak'])->name('pengembalian.tolak');
    });
});
});
