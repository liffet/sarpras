<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\Storage;

class PengembalianController extends Controller
{
    // API: Simpan pengembalian (via Postman, user bisa kirim pengembalian)
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'tanggal_pengembalian' => 'required|date',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengembalians', 'public');
        }

        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $request->peminjaman_id,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'keterangan' => $request->keterangan,
            'foto' => $fotoPath,
            'status' => 'diproses',
        ]);

        return response()->json([
            'message' => 'Pengembalian berhasil diajukan',
            'data' => $pengembalian,
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
