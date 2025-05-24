<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendataan - SISFO SARPRAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .table-hover tr:hover {
            background-color: rgba(14, 165, 233, 0.05);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen font-sans">

<!-- Container -->
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-primary-800 to-primary-900 text-white flex flex-col shadow-xl">
        <div class="p-5 border-b border-primary-700 flex items-center justify-between">
            <h1 class="text-2xl font-bold tracking-wide flex items-center space-x-2">
                <i class="fas fa-tools text-primary-300"></i>
                <span>SISFO <span class="text-primary-300">SARPRAS</span></span>
            </h1>
        </div>
        
        <div class="p-4 border-b border-primary-700 flex items-center space-x-3">
            <div class="w-10 h-10 rounded-full bg-primary-600 flex items-center justify-center">
                <i class="fas fa-user text-primary-100"></i>
            </div>
            <div>
                <p class="font-medium">{{ auth()->user()->name }}</p>
                <p class="text-xs text-primary-300">Administrator</p>
            </div>
        </div>
        
        <nav class="flex flex-col p-4 space-y-1 flex-grow">
            <p class="text-xs text-primary-400 uppercase font-bold px-3 pt-4 pb-2 tracking-wider">Menu Utama</p>
            <a href="{{ route('admin') }}" class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200">
                <i class="fas fa-chart-pie w-5 mr-2 text-primary-200"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('pengguna.index') }}" class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200">
                <i class="fas fa-users w-5 mr-2 text-primary-200"></i>
                <span>Pengguna</span>
            </a>
            <a href="{{ route('admin.pendataan') }}" class="flex items-center px-3 py-2.5 rounded-lg bg-primary-700 text-white font-medium">
                <i class="fas fa-clipboard-check w-5 mr-2 text-primary-200"></i>
                <span>Pendataan</span>
            </a>
            <a href="{{ route('peminjaman.index') }}" class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200">
                <i class="fas fa-hand-holding w-5 mr-2 text-primary-200"></i>
                <span>Peminjaman</span>
            </a>
            <a href="{{ route('pengembalians.index') }}"
               class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200">
                <i class="fas fa-exchange-alt w-5 mr-2 text-primary-200"></i>
                <span>Pengembalian</span>
            </a>
            <a href="#" class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200">
                <i class="fas fa-file-chart-line w-5 mr-2 text-primary-200"></i>
                <span>Laporan</span>
            </a>
        </nav>
        
        <div class="p-4 mt-auto border-t border-primary-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="flex items-center text-sm text-primary-300 hover:text-white w-full px-3 py-2 rounded-lg hover:bg-primary-700 transition-all duration-200">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="bg-white shadow-sm px-6 py-3 flex justify-between items-center sticky top-0 z-10">
            <div class="flex items-center space-x-4">
                <button class="text-gray-500 hover:text-primary-600 focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
                <h2 class="text-xl font-semibold text-gray-700">Pendataan</h2>
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="space-x-3 flex items-center">
                    <a href="{{ route('kategori-barang.create') }}" class="bg-primary-600 text-white hover:bg-primary-700 px-4 py-2 rounded-lg shadow hover:shadow-md transition-all flex items-center">
                        <i class="fas fa-folder-plus mr-2"></i>
                        <span>Tambah Kategori</span>
                    </a>
                    <a href="{{ route('barang.create') }}" class="bg-primary-600 text-white hover:bg-primary-700 px-4 py-2 rounded-lg shadow hover:shadow-md transition-all flex items-center">
                        <i class="fas fa-box-open mr-2"></i>
                        <span>Tambah Barang</span>
                    </a>
                </div>
                <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center">
                    <i class="fas fa-user text-primary-600"></i>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 p-6 overflow-auto bg-gray-100">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md flex items-center shadow-sm">
                    <i class="fas fa-check-circle mr-3 text-green-500"></i>
                    <span>{{ session('success') }}</span>
                    <button class="ml-auto text-green-500 hover:text-green-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <div class="flex items-center justify-between mb-8">
                <p class="text-sm text-gray-600 bg-white px-4 py-2 rounded-full shadow-sm">
                    <i class="fas fa-info-circle mr-2 text-primary-500"></i>
                    Kelola data kategori barang, barang, peminjaman, dan pengembalian di sini.
                </p>
                <div class="text-sm text-gray-600 bg-white px-4 py-2 rounded-full shadow-sm">
                    <i class="fas fa-calendar-alt mr-2 text-primary-500"></i>
                    {{ date('d M Y') }}
                </div>
            </div>

            <!-- Kategori Barang -->
            <section class="mb-12">
                <div class="flex items-center mb-4">
                    <div class="bg-primary-100 p-2 rounded-lg shadow-sm mr-3">
                        <i class="fas fa-folder text-primary-700"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-primary-800">Kategori Barang</h3>
                </div>
                
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm table-hover">
                            <thead>
                                <tr class="bg-gradient-to-r from-primary-100 to-primary-50 text-primary-800">
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Nama Kategori</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($kategori as $item)
                                    <tr class="transition-all hover:bg-primary-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="bg-primary-100 text-primary-800 text-xs font-medium py-1 px-2 rounded-full">{{ $loop->iteration }}</span>
                                        </td>
                                        <td class="px-6 py-4 font-medium">{{ $item->nama_kategori }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-2">
                                                <a href="{{ route('kategori-barang.edit', $item->id) }}" class="bg-amber-100 hover:bg-amber-200 text-amber-700 px-3 py-1 rounded-md text-xs font-medium flex items-center transition-all">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>
                                                <form action="{{ route('kategori-barang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus kategori ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-md text-xs font-medium flex items-center transition-all">
                                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center">
                                            <div class="flex flex-col items-center py-6 text-gray-500">
                                                <i class="fas fa-folder-open text-3xl mb-2 text-gray-400"></i>
                                                <p class="text-sm font-medium">Belum ada kategori</p>
                                                <a href="{{ route('kategori-barang.create') }}" class="mt-2 text-primary-600 hover:text-primary-800 text-xs flex items-center">
                                                    <i class="fas fa-plus-circle mr-1"></i> Tambah Kategori Baru
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Barang -->
            <section>
                <div class="flex items-center mb-4">
                    <div class="bg-primary-100 p-2 rounded-lg shadow-sm mr-3">
                        <i class="fas fa-box-open text-primary-700"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-primary-800">Barang</h3>
                </div>
                
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm table-hover">
                            <thead>
                                <tr class="bg-gradient-to-r from-primary-100 to-primary-50 text-primary-800">
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Nama Barang</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Stok</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Foto</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($barangs as $barang)
                                    <tr class="transition-all hover:bg-primary-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="bg-primary-100 text-primary-800 text-xs font-medium py-1 px-2 rounded-full">{{ $loop->iteration }}</span>
                                        </td>
                                        <td class="px-6 py-4 font-medium">{{ $barang->nama_barang }}</td>
                                        <td class="px-6 py-4">
                                            <span class="bg-primary-50 text-primary-700 text-xs py-1 px-2 rounded-md">
                                                {{ $barang->kategori->nama_kategori }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($barang->stok > 10)
                                                <span class="bg-green-50 text-green-700 text-xs py-1 px-2 rounded-md flex items-center w-fit">
                                                    <i class="fas fa-check-circle mr-1"></i> {{ $barang->stok }}
                                                </span>
                                            @elseif($barang->stok > 0)
                                                <span class="bg-yellow-50 text-yellow-700 text-xs py-1 px-2 rounded-md flex items-center w-fit">
                                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $barang->stok }}
                                                </span>
                                            @else
                                                <span class="bg-red-50 text-red-700 text-xs py-1 px-2 rounded-md flex items-center w-fit">
                                                    <i class="fas fa-times-circle mr-1"></i> {{ $barang->stok }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($barang->foto)
                                                <div class="relative group">
                                                    <img src="{{ asset('storage/' . $barang->foto) }}" alt="foto" class="w-14 h-14 object-cover rounded-lg shadow-sm group-hover:shadow-md transition-all">
                                                    <div class="absolute inset-0 bg-primary-500 bg-opacity-0 group-hover:bg-opacity-20 rounded-lg transition-all flex items-center justify-center">
                                                        <i class="fas fa-search-plus text-white opacity-0 group-hover:opacity-100 transition-all"></i>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-gray-400 flex items-center">
                                                    <i class="fas fa-image mr-1"></i> Tidak ada foto
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-2">
                                                <a href="{{ route('barang.edit', $barang->id) }}" class="bg-amber-100 hover:bg-amber-200 text-amber-700 px-3 py-1 rounded-md text-xs font-medium flex items-center transition-all">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>
                                                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" onsubmit="return confirm('Yakin hapus barang ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-md text-xs font-medium flex items-center transition-all">
                                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center">
                                            <div class="flex flex-col items-center py-6 text-gray-500">
                                                <i class="fas fa-box-open text-3xl mb-2 text-gray-400"></i>
                                                <p class="text-sm font-medium">Belum ada barang</p>
                                                <a href="{{ route('barang.create') }}" class="mt-2 text-primary-600 hover:text-primary-800 text-xs flex items-center">
                                                    <i class="fas fa-plus-circle mr-1"></i> Tambah Barang Baru
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>
</body>
</html>