<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Pengguna - SISFO SARPRAS</title>
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
                    <h2 class="text-xl font-semibold text-gray-700">Manajemen Pengguna</h2>
                </div>

                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center">
                        <i class="fas fa-user text-primary-600"></i>
                    </div>
                    <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 overflow-auto bg-gray-100">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-6 flex items-center shadow-sm">
                        <i class="fas fa-check-circle mr-3 text-green-500"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Form Tambah -->
                    <div class="lg:col-span-1">
                        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                            <h2 class="text-xl font-bold mb-5 text-gray-800 flex items-center">
                                <i class="fas fa-user-plus mr-2 text-primary-600"></i>
                                Tambah Pengguna
                            </h2>
                            <form action="{{ route('pengguna.store') }}" method="POST">
                                @csrf
                                <div class="mb-5">
                                    <label class="block mb-2 font-medium text-gray-700">Nama</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="fas fa-user text-gray-400"></i>
                                        </div>
                                        <input type="text" name="name" required class="w-full pl-10 border rounded-lg p-2.5 focus:ring-2 focus:ring-primary-500 border-gray-300">
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label class="block mb-2 font-medium text-gray-700">Email</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="fas fa-envelope text-gray-400"></i>
                                        </div>
                                        <input type="email" name="email" required class="w-full pl-10 border rounded-lg p-2.5 focus:ring-2 focus:ring-primary-500 border-gray-300">
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-2 font-medium text-gray-700">Password</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="fas fa-lock text-gray-400"></i>
                                        </div>
                                        <input type="password" name="password" required class="w-full pl-10 border rounded-lg p-2.5 focus:ring-2 focus:ring-primary-500 border-gray-300">
                                    </div>
                                </div>
                                <button type="submit" class="w-full bg-primary-600 text-white py-3 rounded-lg hover:bg-primary-700 font-medium flex items-center justify-center transition-colors duration-200">
                                    <i class="fas fa-plus-circle mr-2"></i> Tambah Pengguna
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- List Pengguna -->
                    <div class="lg:col-span-2">
                        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                            <h2 class="text-xl font-bold mb-5 text-gray-800 flex items-center">
                                <i class="fas fa-users mr-2 text-primary-600"></i>
                                Daftar Pengguna
                            </h2>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr class="bg-gradient-to-r from-primary-100 to-primary-50 text-primary-800">
                                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($users as $user)
                                            <tr class="hover:bg-primary-50 transition-all">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="h-8 w-8 bg-primary-100 rounded-full flex items-center justify-center text-primary-600">
                                                            <span class="font-medium">{{ substr($user->name, 0, 1) }}</span>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-center text-sm text-gray-500 py-4">Belum ada data pengguna</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>