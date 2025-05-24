<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori Barang - SISFO SARPRAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-300 min-h-screen flex items-center justify-center text-gray-800">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-blue-600 text-center">Tambah Kategori Barang</h2>

        <form action="{{ route('kategori-barang.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="nama_kategori" class="block text-sm font-medium">Nama Kategori:</label>
                <input type="text" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori') }}"
                       class="w-full mt-1 px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('nama_kategori')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
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
