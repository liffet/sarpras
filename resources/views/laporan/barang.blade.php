<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Barang - SISFO SARPRAS</title>
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
<body class="bg-gray-50 text-gray-800 min-h-screen font-sans p-8">

    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8 border-b border-gray-200 pb-4">
            <div>
                <a href="{{ route('admin') }}" class="flex items-center text-primary-600 hover:text-primary-800">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <h2 class="text-2xl font-bold">Laporan Barang</h2>
                </a>
                <p class="text-gray-600 mt-1">Daftar lengkap barang dan stok tersedia</p>
            </div>
            <div class="text-sm text-gray-600 bg-gray-100 px-4 py-2 rounded-full">
                <i class="fas fa-calendar-alt mr-2 text-primary-500"></i>
                {{ date('d M Y') }}
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-primary-100 to-primary-50 text-primary-800">
                        <th class="px-6 py-3 text-left font-medium tracking-wider">No</th>
                        <th class="px-6 py-3 text-left font-medium tracking-wider">Nama Barang</th>
                        <th class="px-6 py-3 text-left font-medium tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left font-medium tracking-wider">Stok</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($barang as $item)
                    <tr class="hover:bg-primary-50 transition-all">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="bg-primary-100 text-primary-800 text-xs font-medium py-1 px-2 rounded-full">{{ $loop->iteration }}</span>
                        </td>
                        <td class="px-6 py-4 font-medium">{{ $item->nama_barang }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-primary-50 text-primary-700 text-xs py-1 px-2 rounded-md">
                                {{ $item->kategori ? $item->kategori->nama_kategori : '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($item->stok > 10)
                                <span class="bg-green-50 text-green-700 text-xs py-1 px-2 rounded-md flex items-center w-fit">
                                    <i class="fas fa-check-circle mr-1"></i> {{ $item->stok }}
                                </span>
                            @elseif($item->stok > 0)
                                <span class="bg-yellow-50 text-yellow-700 text-xs py-1 px-2 rounded-md flex items-center w-fit">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $item->stok }}
                                </span>
                            @else
                                <span class="bg-red-50 text-red-700 text-xs py-1 px-2 rounded-md flex items-center w-fit">
                                    <i class="fas fa-times-circle mr-1"></i> {{ $item->stok }}
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="mt-8 pt-4 border-t border-gray-200 text-sm text-gray-500 flex justify-between items-center">
            <div>
                <i class="fas fa-info-circle mr-1 text-primary-500"></i>
                Total Barang: {{ count($barang) }}
            </div>
            <div>
                Dicetak pada: {{ date('d/m/Y H:i') }}
            </div>
        </div>
    </div>

    <script>
        // Print functionality can be added here if needed
        window.onload = function() {
            // window.print(); // Uncomment to auto-print
        }
    </script>
</body>
</html>