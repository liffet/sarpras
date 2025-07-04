<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
{
    // Hanya tampilkan peminjaman dengan status pending dan disetujui (yang belum selesai)
    $peminjaman = Peminjaman::with(['user', 'barang'])
        ->whereIn('status', ['pending', 'disetujui'])
        ->latest()
        ->get();
        
    return view('peminjaman.index', compact('peminjaman'));
}
public function riwayatPeminjaman(Request $request)
{
    try {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak terautentikasi',
            ], 401);
        }

        $peminjaman = Peminjaman::with(['barang', 'pengembalian'])
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Riwayat peminjaman berhasil diambil.',
            'data' => $peminjaman,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi error: ' . $e->getMessage(),
        ], 500);
    }
}

    // API method for Flutter app

    public function approve($id)
    {
        $peminjaman = Peminjaman::with('barang')->findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return redirect()->route('peminjaman.index')->with('error', 'Peminjaman sudah diproses.');
        }

        if ($peminjaman->barang->stok < $peminjaman->jumlah) {
            return redirect()->route('peminjaman.index')->with('error', 'Stok barang "' . $peminjaman->barang->nama_barang . '" tidak mencukupi.');
        }


// $peminjaman->barang->decrement('stok', $peminjaman->jumlah);




        $peminjaman->update([
            'status' => 'disetujui',
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil disetujui.');
    }

    public function ditolak($id)
{
    $peminjaman = Peminjaman::findOrFail($id);

    if ($peminjaman->status !== 'pending') {
        return redirect()->route('peminjaman.index')->with('error', 'Peminjaman sudah diproses.');
    }

    $peminjaman->update([
        'status' => 'ditolak',
    ]);

    return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditolak.');
}

    public function store(Request $request)
{
    $validated = $request->validate([
        'barang_id' => 'required|exists:barang,id',
        'jumlah' => 'required|integer|min:1',
        'tanggal_kembali' => 'required|date',
    ]);

    $peminjaman = Peminjaman::create([
        'user_id' => auth()->id(),
        'barang_id' => $validated['barang_id'],
        'jumlah' => $validated['jumlah'],
        'tanggal_pinjam' => now(),
        'tanggal_kembali' => $validated['tanggal_kembali'],
        'status' => 'pending',
    ]);

    return response()->json([
        'message' => 'Peminjaman berhasil dibuat',
        'data' => $peminjaman->load('barang'),
    ], 201);
}


    public function apiUpdateStatus($id, $status)
    {
        if (!in_array($status, ['disetujui', 'ditolak'])) {
            return response()->json(['message' => 'Status tidak valid.'], 400);
        }

        $peminjaman = Peminjaman::with('barang')->findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return response()->json(['message' => 'Peminjaman sudah diproses.'], 400);
        }

        if ($status === 'disetujui') {
            if ($peminjaman->barang->stok < $peminjaman->jumlah) {
                return response()->json(['message' => 'Stok barang "' . $peminjaman->barang->nama_barang . '" tidak mencukupi.'], 400);
            }

            $peminjaman->barang->decrement('stok', $peminjaman->jumlah);
        }

        $peminjaman->update(['status' => $status]);

        return response()->json([
            'message' => 'Status berhasil diubah menjadi ' . $status,
            'data' => $peminjaman
        ]);
    }
}