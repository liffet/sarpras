<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pengembalian - SISFO SARPRAS</title>
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
                    <h2 class="text-xl font-semibold text-gray-700">Pengembalian</h2>
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
                    <h3 class="text-2xl font-bold text-gray-800">Daftar Pengembalian</h3>
                    <p class="text-gray-600">Kelola dan proses pengembalian barang.</p>
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

                <!-- Pengembalian Table -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="bg-gradient-to-r from-primary-100 to-primary-50 text-primary-800">
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Peminjam</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Tanggal Pengembalian</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Catatan</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Foto</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left font-medium tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($pengembalians as $pengembalian)
                                <tr class="hover:bg-primary-50 transition-all">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="bg-primary-100 text-primary-800 text-xs font-medium py-1 px-2 rounded-full">{{ $pengembalian->id }}</span>
                                    </td>
                                    <td class="px-6 py-4 font-medium">
                                        {{ $pengembalian->peminjaman->user->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $pengembalian->tanggal_pengembalian }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $pengembalian->keterangan ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($pengembalian->foto)
                                            <a href="{{ asset('storage/' . $pengembalian->foto) }}" target="_blank" class="text-primary-600 hover:text-primary-800">
                                                <i class="fas fa-image mr-1"></i> Lihat
                                            </a>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($pengembalian->status == 'diproses')
                                            <span class="text-yellow-600 font-semibold">Diproses</span>
                                        @elseif($pengembalian->status == 'diterima')
                                            <span class="text-green-600 font-semibold">Diterima</span>
                                        @elseif($pengembalian->status == 'ditolak')
                                            <span class="text-red-600 font-semibold">Ditolak</span>
                                        @else
                                            <span>{{ $pengembalian->status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 space-x-2">
                                        @if($pengembalian->status == 'diproses')
                                            <form method="POST" action="{{ route('pengembalian.setujui', $pengembalian->id) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-800 font-semibold" onclick="return confirm('Setujui pengembalian ini?')">
                                                    <i class="fas fa-check-circle mr-1"></i> Setujui
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('pengembalian.tolak', $pengembalian->id) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold" onclick="return confirm('Tolak pengembalian ini?')">
                                                    <i class="fas fa-times-circle mr-1"></i> Tolak
                                                </button>
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

    <script>
        // Close flash messages
       document.querySelectorAll('.bg-green-100 button, .bg-red-100 button').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('div').style.display = 'none';
            });
        });
    </script>
</body>
</html>