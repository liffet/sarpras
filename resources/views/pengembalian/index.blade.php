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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                <a href="{{ route('admin') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200">
                    <i class="fas fa-chart-pie w-5 mr-2 text-primary-200"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('pengguna.index') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200">
                    <i class="fas fa-users w-5 mr-2 text-primary-200"></i>
                    <span>Pengguna</span>
                </a>
                <a href="{{ route('admin.pendataan') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200">
                    <i class="fas fa-clipboard-check w-5 mr-2 text-primary-200"></i>
                    <span>Pendataan</span>
                </a>
                <a href="{{ route('peminjaman.index') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200">
                    <i class="fas fa-hand-holding w-5 mr-2 text-primary-200"></i>
                    <span>Peminjaman</span>
                </a>
                <a href="{{ route('pengembalians.index') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg bg-primary-700 text-white font-medium">
                    <i class="fas fa-exchange-alt w-5 mr-2 text-primary-200"></i>
                    <span>Pengembalian</span>
                </a>
                <a href="#"
                    class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200">
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
        document.querySelectorAll('[class*="bg-"] button').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('div').style.display = 'none';
            });
        });
    </script>
</body>
</html>