<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - SISFO SARPRAS</title>
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

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<body class="bg-gray-50 text-gray-800 min-h-screen font-sans">

    <!-- Container -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-primary-800 to-primary-900 text-white flex flex-col shadow-xl transition-all duration-300 transform hover:shadow-2xl">
            <div class="p-5 border-b border-primary-700 flex items-center justify-between">
                <h1 class="text-2xl font-bold tracking-wide flex items-center space-x-2">
                    <i class="fas fa-tools text-primary-300"></i>
                    <span>SISFO <span class="text-primary-300">SARPRAS</span></span>
                </h1>
            </div>

            <div class="p-4 border-b border-primary-700 flex items-center space-x-3 hover:bg-primary-700 transition-colors duration-200">
                <div class="w-10 h-10 rounded-full bg-primary-600 flex items-center justify-center shadow-md">
                    <i class="fas fa-user text-primary-100"></i>
                </div>
                <div>
                    <p class="font-medium">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-primary-300">Administrator</p>
                </div>
            </div>

            <aside class="w-64 bg-gradient-to-b from-primary-800 to-primary-900 text-white flex flex-col shadow-xl transition-all duration-300 transform hover:shadow-2xl">
            
            <nav class="flex flex-col p-4 space-y-1 flex-grow">
                <p class="text-xs text-primary-400 uppercase font-bold px-3 pt-4 pb-2 tracking-wider">Menu Utama</p>
                <a href="#"
                    class="flex items-center px-3 py-2.5 rounded-lg bg-primary-700 text-white font-medium transition-all duration-200 hover:bg-primary-600 hover:shadow-md">
                    <i class="fas fa-chart-pie w-5 mr-2 text-primary-200"></i>
                    <span>Dashboard</span>
                    
                </a>
                <a href="{{ route('pengguna.index') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200 hover:shadow-md">
                    <i class="fas fa-users w-5 mr-2 text-primary-200"></i>
                    <span>Pengguna</span>
                </a>
                <a href="{{ route('admin.pendataan') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200 hover:shadow-md">
                    <i class="fas fa-clipboard-check w-5 mr-2 text-primary-200"></i>
                    <span>Pendataan</span>
                </a>
                <a href="{{ route('peminjaman.index') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200 hover:shadow-md">
                    <i class="fas fa-hand-holding w-5 mr-2 text-primary-200"></i>
                    <span>Peminjaman</span>
                    
                </a>
                <a href="{{ route('pengembalians.index') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200 hover:shadow-md">
                    <i class="fas fa-exchange-alt w-5 mr-2 text-primary-200"></i>
                    <span>Pengembalian</span>
                </a>
             <!-- Sidebar -->
      <div x-data="{ laporanOpen: false }" class="flex flex-col">
            <button
                @click="laporanOpen = !laporanOpen"
                class="flex items-center justify-between w-full px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200 hover:shadow-md text-left"
            >
                <div class="flex items-center">
                    <i class="fas fa-file-chart-line w-5 mr-2 text-primary-200"></i>
                    <span>Laporan</span>
                </div>
                <i
                    :class="laporanOpen ? 'fas fa-chevron-up' : 'fas fa-chevron-down'"
                    class="text-primary-200"
                ></i>
            </button>
            <div
                x-show="laporanOpen"
                class="mt-1 pl-8 flex flex-col space-y-1 overflow-hidden transition-all duration-300"
                style="display: none;"
            >
                <a
                    href="{{ route('laporan.barang') }}"
                    class="px-3 py-2 rounded-lg hover:bg-primary-700 transition-all duration-200 hover:shadow-md"
                >
                    Laporan Barang
                </a>
                <a
                    href="{{ route('laporan.peminjaman') }}"
                    class="px-3 py-2 rounded-lg hover:bg-primary-700 transition-all duration-200 hover:shadow-md"
                >
                    Laporan Peminjaman
                </a>
                <a
                    href="{{ route('laporan.pengembalian') }}"
                    class="px-3 py-2 rounded-lg hover:bg-primary-700 transition-all duration-200 hover:shadow-md"
                >
                    Laporan Pengembalian
                </a>
            </div>
        </div>

    
</aside>

            </nav>

            <div class="p-4 mt-auto border-t border-primary-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="flex items-center text-sm text-primary-300 hover:text-white w-full px-3 py-2 rounded-lg hover:bg-primary-700 transition-all duration-200 group">
                        <i class="fas fa-sign-out-alt mr-2 transform group-hover:translate-x-1 transition-transform"></i>
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
                    <h2 class="text-xl font-semibold text-gray-700">Dashboard Admin</h2>
                </div>

                <div class="flex items-center space-x-4"> 
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center">
                           
                        </div>
                        <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6 overflow-auto bg-gray-100">
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-800">Selamat datang di SISFO SARPRAS!</h3>
                    <p class="text-gray-600">Berikut adalah ringkasan informasi sistem Anda.</p>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Card Total Pengguna -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Pengguna</p>
                            <h3 class="text-2xl font-bold">{{ $totalUsers }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Card Total Barang -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Barang</p>
                            <h3 class="text-2xl font-bold">{{ $totalItems }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Card Peminjaman Aktif -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-orange-100 text-orange-600 mr-4">
                            <i class="fas fa-hand-holding"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Peminjaman Aktif</p>
                            <h3 class="text-2xl font-bold">{{ $activeLoans }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Card Pengembalian Hari Ini -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Pengembalian Hari Ini</p>
                            <h3 class="text-2xl font-bold">{{ $todayReturns }}</h3>
                        </div>
                    </div>
                </div>
            </div>
                <!-- Recent Activity and Peminjaman -->
                
                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Aksi Cepat</h3>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-6">
                        <a href="{{ route('pengguna.index') }}" class="flex flex-col items-center p-4 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <div class="p-3 rounded-full bg-primary-100 text-primary-600 mb-2">
                                <i class="fas fa-user-plus text-xl"></i>
                            </div>
                            <span class="text-sm font-medium text-center">Tambah Pengguna</span>
                        </a>
                        <a href="{{ route('admin.pendataan') }}" class="flex flex-col items-center p-4 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <div class="p-3 rounded-full bg-green-100 text-green-600 mb-2">
                                <i class="fas fa-box-open text-xl"></i>
                            </div>
                            <span class="text-sm font-medium text-center">Tambah Barang</span>
                        </a>
                        <a href="{{ route('peminjaman.index') }}" class="flex flex-col items-center p-4 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <div class="p-3 rounded-full bg-orange-100 text-orange-600 mb-2">
                                <i class="fas fa-hand-holding text-xl"></i>
                            </div>
                            <span class="text-sm font-medium text-center">Peminjaman</span>
                        </a>
                        <a href="#" class="flex flex-col items-center p-4 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600 mb-2">
                                <i class="fas fa-file-export text-xl"></i>
                            </div>
                            <span class="text-sm font-medium text-center">Ekspor Laporan</span>
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>

</body>

</html>