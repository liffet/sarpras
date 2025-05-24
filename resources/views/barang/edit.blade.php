<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-300 min-h-screen flex items-center justify-center text-gray-800">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl">
        <h2 class="text-2xl font-bold mb-6 text-green-600 text-center">Edit Barang</h2>

        <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 text-sm font-medium">Nama Barang</label>
                <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}"
                       class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium">Kategori</label>
                <select name="kategori_barang_id"
                        class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id }}" {{ $barang->kategori_barang_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium">Deskripsi</label>
                <textarea name="deskripsi" rows="3"
                          class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium">Stok</label>
                <input type="number" name="stok" min="0" value="{{ old('stok', $barang->stok) }}"
                       class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium">Ganti Foto (opsional)</label>
                <input type="file" name="foto" class="text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-green-600 file:text-white hover:file:bg-green-700 transition">
                @if ($barang->foto)
                    <p class="text-sm text-gray-500 mt-1">Foto saat ini:</p>
                    <img src="{{ asset('storage/' . $barang->foto) }}" alt="foto" class="w-20 mt-2 rounded shadow border">
                @endif
            </div>

            <div class="text-right">
                <a href="{{ route('admin.pendataan') }}" class="text-sm text-gray-500 hover:text-green-600 mr-4">← Kembali</a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded font-semibold shadow">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</body>
</html>
