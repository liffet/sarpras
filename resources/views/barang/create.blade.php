<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-blue-100 min-h-screen flex items-center justify-center text-gray-800">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl">
        <h2 class="text-2xl font-bold mb-6 text-blue-600 text-center">Tambah Barang</h2>

        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="kategori_barang_id" class="block text-sm font-medium">Kategori</label>
                <select name="kategori_barang_id" required
                        class="w-full mt-1 px-4 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="nama_barang" class="block text-sm font-medium">Nama Barang</label>
                <input type="text" name="nama_barang" required
                       class="w-full mt-1 px-4 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium">Deskripsi</label>
                <textarea name="deskripsi" rows="3"
                          class="w-full mt-1 px-4 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div>
                <label for="stok" class="block text-sm font-medium">Stok</label>
                <input type="number" name="stok" min="0" required
                       class="w-full mt-1 px-4 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="foto" class="block text-sm font-medium">Foto (opsional)</label>
                <input type="file" name="foto" class="text-gray-700">
            </div>

            <div class="text-right">
                <a href="{{ route('admin.pendataan') }}" class="text-sm text-gray-500 hover:text-blue-600 mr-4">← Kembali</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded font-semibold shadow">
                    Simpan
                </button>
            </div>
        </form>
    </div>

</body>
</html>
