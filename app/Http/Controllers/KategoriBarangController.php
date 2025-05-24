<?php
namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use App\Models\Barang;
class KategoriBarangController extends Controller
{
    public function barang()
{
    return $this->hasMany(Barang::class);
}

    public function create()
    {
        return view('kategori-barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        KategoriBarang::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('admin')->with('success', 'Kategori berhasil ditambahkan!');
    }
    public function edit($id)
{
    $kategori = KategoriBarang::findOrFail($id);
    return view('kategori-barang.edit', compact('kategori'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_kategori' => 'required|string|max:255',
    ]);

    $kategori = KategoriBarang::findOrFail($id);
    $kategori->update(['nama_kategori' => $request->nama_kategori]);

    return redirect()->route('admin.pendataan')->with('success', 'Kategori berhasil diperbarui.');
}

public function destroy($id)
{
    // Mencari kategori berdasarkan ID
    $kategori = KategoriBarang::findOrFail($id);

    // Menghapus kategori yang ditemukan
    $kategori->delete();

    // Redirect kembali dengan pesan sukses
    return redirect()->route('admin.pendataan')->with('success', 'Kategori berhasil dihapus.');
}

}
