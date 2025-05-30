<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Storage;

class PengembalianController extends Controller
{
    // API: Simpan pengembalian (via Postman, user bisa kirim pengembalian)
  public function store(Request $request, $id)
{
    $request->validate([
        'keterangan' => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Cari data peminjaman berdasarkan ID dari URL
    $peminjaman = Peminjaman::find($id);
    if (!$peminjaman) {
        return response()->json([
            'message' => 'Peminjaman tidak ditemukan',
            'data' => null,
        ], 404);
    }

    // Cek apakah sudah dikembalikan sebelumnya
    $existingPengembalian = Pengembalian::where('peminjaman_id', $id)
        ->where('status', '!=', 'ditolak')
        ->first();

    if ($existingPengembalian) {
        return response()->json([
            'message' => 'Peminjaman ini sudah dikembalikan sebelumnya',
            'data' => null,
        ], 400);
    }

    // Cek jika peminjaman sudah selesai
    if ($peminjaman->status === 'selesai') {
        return response()->json([
            'message' => 'Peminjaman ini sudah selesai',
            'data' => null,
        ], 400);
    }

    // Upload foto jika ada
    $fotoPath = null;
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('pengembalians', 'public');
    }

    // Simpan pengembalian
    $pengembalian = Pengembalian::create([
        'peminjaman_id' => $id,
        'tanggal_pengembalian' => now(),
        'keterangan' => $request->keterangan,
        'foto' => $fotoPath,
        'status' => 'diproses',
    ]);

    // Kembalikan hanya field yang diminta
    return response()->json([
        'keterangan' => $pengembalian->keterangan,
        'foto' => $pengembalian->foto ? asset('storage/' . $pengembalian->foto) : null,
        'status' => $pengembalian->status,
    ], 201);
}


    // WEB: Tampilkan semua pengembalian (admin)
    public function index() 
    {
        $pengembalians = Pengembalian::with('peminjaman.barang', 'peminjaman.user')->latest()->get();
        return view('pengembalian.index', compact('pengembalians'));
    }

    // WEB: Setujui pengembalian dan kembalikan stok barang
    public function setujui($id)
    {
        $pengembalian = Pengembalian::with('peminjaman.barang')->findOrFail($id);
        
        // Validasi: hanya bisa disetujui jika status masih 'diproses'
        if ($pengembalian->status != 'diproses') {
            return redirect()->back()->with('error', 'Pengembalian sudah diproses sebelumnya.');
        }

        $pengembalian->status = 'diterima';
        $pengembalian->save();

        // Kembalikan stok barang
        $barang = $pengembalian->peminjaman->barang;
        $barang->stok += $pengembalian->peminjaman->jumlah;
        $barang->save();

        // Update status peminjaman
        $pengembalian->peminjaman->status = 'selesai';
        $pengembalian->peminjaman->save();

        return redirect()->back()->with('success', 'Pengembalian disetujui.');
    }

    // WEB: Tolak pengembalian
    public function tolak($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->status = 'ditolak';
        $pengembalian->save();

        return redirect()->back()->with('success', 'Pengembalian ditolak.');
    }
}