<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-300 min-h-screen flex items-center justify-center text-gray-800">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-blue-700 text-center">Edit Kategori</h2>

        <form action="{{ route('kategori-barang.update', $kategori->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori"
                       value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                       class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       required>
            </div>

            <div class="text-right">
                <a href="{{ route('admin.pendataan') }}" class="text-sm text-gray-500 hover:text-blue-600 mr-4">← Kembali</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded font-semibold shadow">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</body>
</html>
