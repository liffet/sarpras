<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function create()
    {
        $kategori = KategoriBarang::all();
        return view('barang.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_barang_id' => 'required|exists:kategori_barang,id',
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('barang', 'public');
        }

        Barang::create([
            'kategori_barang_id' => $request->kategori_barang_id,
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'foto' => $foto,
        ]);

        return redirect()->route('admin.pendataan')->with('success', 'Barang berhasil ditambahkan.');
    }
    public function edit($id)
{
    $barang = Barang::findOrFail($id);
    $kategori = KategoriBarang::all();
    return view('barang.edit', compact('barang', 'kategori'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_barang' => 'required',
        'kategori_barang_id' => 'required|exists:kategori_barang,id',
        'stok' => 'required|integer|min:0',
        'deskripsi' => 'nullable|string',
        'foto' => 'nullable|image|max:2048',
    ]);

    $barang = Barang::findOrFail($id);

    $data = $request->only('nama_barang', 'kategori_barang_id', 'stok', 'deskripsi');

    if ($request->hasFile('foto')) {
        $data['foto'] = $request->file('foto')->store('barangs', 'public');
    }

    $barang->update($data);

    return redirect()->route('admin.pendataan')->with('success', 'Barang berhasil diperbarui.');
}
public function destroy($id)
{
    $barang = Barang::findOrFail($id);
    $barang->delete();
    return redirect()->route('admin.pendataan')->with('success', 'Barang berhasil dihapus.');
}
    public function index()
{
    $barang = DB::select("CALL listBarang()");
    return view('barang.index', compact('barang'));
}
    public function show($id)
    {               
        $barang = Barang::with('kategori')->findOrFail($id);
        return view('barang.show', compact('barang'));
    }

    
    
}
