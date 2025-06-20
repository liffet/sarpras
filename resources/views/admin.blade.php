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
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen font-sans">

    <!-- Container -->
    <div class="flex min-h-screen">
        @include('layouts.sidebar')

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
                            <i class="fas fa-user text-primary-600"></i>
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