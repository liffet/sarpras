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
        'tanggal_pengembalian' => 'required|date', // ✅ User wajib isi tanggal kembali
        'keterangan' => 'nullable|string|max:500',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $peminjaman = Peminjaman::find($id);
    if (!$peminjaman) {
        return response()->json([
            'success' => false,
            'message' => 'Peminjaman tidak ditemukan',
            'data' => null,
        ], 404);
    }

    $existingPengembalian = Pengembalian::where('peminjaman_id', $id)
        ->where('status', '!=', 'ditolak')
        ->first();

    if ($existingPengembalian) {
        return response()->json([
            'success' => false,
            'message' => 'Peminjaman ini sudah dikembalikan sebelumnya',
            'data' => null,
        ], 400);
    }

    if ($peminjaman->status === 'selesai') {
        return response()->json([
            'success' => false,
            'message' => 'Peminjaman ini sudah selesai',
            'data' => null,
        ], 400);
    }

    $fotoPath = null;
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('pengembalians', 'public');
    }

    $pengembalian = Pengembalian::create([
        'peminjaman_id' => $id,
        'tanggal_pengembalian' => $request->tanggal_pengembalian, // ✅ diisi dari input user
        'keterangan' => $request->keterangan,
        'foto' => $fotoPath,
        'status' => 'diproses',
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Pengembalian berhasil disubmit',
        'data' => [
            'keterangan' => $pengembalian->keterangan,
            'foto' => $pengembalian->foto ? asset('storage/' . $pengembalian->foto) : null,
            'tanggal_pengembalian' => $pengembalian->tanggal_pengembalian,
            'status' => $pengembalian->status,
        ],
    ], 201);
}

    // WEB: Tampilkan semua pengembalian (admin)
   public function index() 
{
    // Hanya tampilkan pengembalian dengan status diproses
    $pengembalians = Pengembalian::with('peminjaman.barang', 'peminjaman.user')
        ->where('status', 'diproses')
        ->latest()
        ->get();
        
    return view('pengembalian.index', compact('pengembalians'));
}

public function setujui($id)
{
    $pengembalian = Pengembalian::with('peminjaman.barang')->findOrFail($id);
    
    if ($pengembalian->status != 'diproses') {
        return redirect()->back()->with('error', 'Pengembalian sudah diproses sebelumnya.');
    }

    $pengembalian->status = 'diterima';
    $pengembalian->save();

    // Kembalikan stok barang
    // HAPUS bagian ini:
// $barang->stok += $pengembalian->peminjaman->jumlah;
// $barang->save();

    // Update status peminjaman
    $pengembalian->peminjaman->status = 'selesai';
    $pengembalian->peminjaman->save();

    return redirect()->back()->with('success', 'Pengembalian disetujui.');
}

public function tolak($id)
{
    $pengembalian = Pengembalian::findOrFail($id);
    $pengembalian->status = 'ditolak';
    $pengembalian->save();

    return redirect()->back()->with('success', 'Pengembalian ditolak.');
}
}