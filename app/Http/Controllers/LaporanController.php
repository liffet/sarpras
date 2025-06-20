<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\KategoriBarang;

class LaporanController extends Controller
{
    public function barang()
    {
        $barang = Barang::with('kategori')->get();
        return view('laporan.barang', compact('barang'));
    }
    
   public function peminjaman(Request $request)
{
    $peminjaman = Peminjaman::with('user', 'barang')
        ->whereIn('status', ['ditolak', 'selesai']) // Hanya tampilkan yang ditolak/selesai
        ->when($request->start_date, fn($q) => $q->whereDate('tanggal_pinjam', '>=', $request->start_date))
        ->when($request->end_date, fn($q) => $q->whereDate('tanggal_pinjam', '<=', $request->end_date))
        ->get();

    return view('laporan.peminjaman', compact('peminjaman'));
}

public function pengembalian(Request $request)
{
    $pengembalian = Pengembalian::with('peminjaman.user', 'peminjaman.barang')
        ->whereIn('status', ['diterima', 'ditolak']) // Hanya tampilkan yang diterima/ditolak
        ->when($request->start_date, fn($q) => $q->whereDate('created_at', '>=', $request->start_date))
        ->when($request->end_date, fn($q) => $q->whereDate('created_at', '<=', $request->end_date))
        ->get();

    return view('laporan.pengembalian', compact('pengembalian'));
}
}