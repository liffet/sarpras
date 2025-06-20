<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Peminjaman - SISFO SARPRAS</title>
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
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen font-sans">

    <!-- Container -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
      @include('layouts.sidebar')
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm px-6 py-3 flex justify-between items-center sticky top-0 z-10">
                <div class="flex items-center space-x-4">
                    <button class="text-gray-500 hover:text-primary-600 focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h2 class="text-xl font-semibold text-gray-700">Peminjaman</h2>
                </div>

                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center">
                        <i class="fas fa-user text-primary-600"></i>
                    </div>
                    <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6 overflow-auto bg-gray-100">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Daftar Peminjaman</h3>
                    <p class="text-gray-600">Kelola dan proses permintaan peminjaman.</p>
                </div>

                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md flex items-center shadow-sm">
                        <i class="fas fa-check-circle mr-3 text-green-500"></i>
                        <span>{{ session('success') }}</span>
                        <button class="ml-auto text-green-500 hover:text-green-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @elseif(session('error'))
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md flex items-center shadow-sm">
                        <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                        <span>{{ session('error') }}</span>
                        <button class="ml-auto text-red-500 hover:text-red-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                <!-- Peminjaman Table -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="bg-gradient-to-r from-primary-100 to-primary-50 text-primary-800">
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">ID Peminjaman</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">User</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Tanggal Pinjam</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Tanggal Kembali</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Jumlah Dipinjam</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($peminjaman as $item)
                                    <tr class="hover:bg-primary-50 transition-all">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="bg-primary-100 text-primary-800 text-xs font-medium py-1 px-2 rounded-full">{{ $item->id }}</span>
                                        </td>
                                        <td class="px-6 py-4 font-medium">{{ $item->user->name }}</td>
                                        <td class="px-6 py-4">{{ $item->tanggal_pinjam }}</td>
                                        <td class="px-6 py-4">{{ $item->tanggal_kembali }}</td>
                                        <td class="px-6 py-4"> {{ $item->jumlah }} item</td>
                                        <td class="px-6 py-4">
                                            @if($item->status == 'pending')
                                                <span class="text-yellow-600 font-semibold">Menunggu</span>
                                            @elseif($item->status == 'disetujui')
                                                <span class="text-green-600 font-semibold">Disetujui</span>
                                            @elseif($item->status == 'ditolak')
                                                <span class="text-red-600 font-semibold">Ditolak</span>
                                            @elseif($item->status == 'selesai')
                                                <span class="text-gray-600 font-semibold">Selesai</span>
                                            @else
                                                <span>{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 space-x-2">
                                            @if($item->status == 'pending')
                                                <form method="POST" action="{{ route('peminjaman.approve', $item->id) }}"
                                                    class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="text-green-600 hover:text-green-800 font-semibold"
                                                        onclick="return confirm('Setujui peminjaman ini?')">Setujui</button>
                                                </form>
                                                <form method="POST" action="{{ route('peminjaman.ditolak', $item->id) }}"
                                                    class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold"
                                                        onclick="return confirm('Tolak peminjaman ini?')">Tolak</button>
                                                </form>
                                            @else
                                                <span class="text-gray-500 italic">Tidak ada aksi</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>