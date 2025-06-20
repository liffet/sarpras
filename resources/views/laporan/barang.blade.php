<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Barang - SISFO SARPRAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
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
<body class="bg-gray-100 text-gray-800 min-h-screen font-sans">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-8 border-b border-gray-200 pb-4">
                    <div>
                        <a href="{{ route('admin') }}" class="flex items-center text-primary-600 hover:text-primary-800 mb-2">
                            <i class="fas fa-arrow-left mr-2"></i>
                            <span class="text-sm">Kembali ke Dashboard</span>
                        </a>
                        <h2 class="text-3xl font-bold text-primary-700">
                            <i class="fas fa-boxes mr-3"></i>
                            Laporan Barang
                        </h2>
                        <p class="text-gray-600 mt-1">Daftar lengkap barang dan stok tersedia</p>
                    </div>
                    <div class="flex flex-col items-end gap-3">
                        <div class="text-sm text-gray-600 bg-gray-100 px-4 py-2 rounded-full">
                            <i class="fas fa-calendar-alt mr-2 text-primary-500"></i>
                            {{ date('d M Y') }}
                        </div>
                        <button onclick="downloadExcel()" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition duration-300 flex items-center shadow-lg hover:shadow-xl">
                            <i class="fas fa-download mr-2"></i>
                            Download Excel
                        </button>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto shadow-lg rounded-lg">
                    <table class="min-w-full text-sm bg-white">
                        <thead>
                            <tr class="bg-gradient-to-r from-primary-100 to-primary-50 text-primary-800">
                                <th class="px-6 py-4 text-left font-semibold tracking-wider">No</th>
                                <th class="px-6 py-4 text-left font-semibold tracking-wider">Nama Barang</th>
                                <th class="px-6 py-4 text-left font-semibold tracking-wider">Kategori</th>
                                <th class="px-6 py-4 text-left font-semibold tracking-wider">Stok</th>
                              
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($barang as $item)
                            <tr class="hover:bg-primary-50 transition-all">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="bg-primary-100 text-primary-800 text-sm font-semibold py-2 px-3 rounded-full">{{ $loop->iteration }}</span>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900">{{ $item->nama_barang }}</td>
                                <td class="px-6 py-4">
                                    <span class="bg-primary-50 text-primary-700 text-xs py-1 px-3 rounded-full font-medium">
                                        {{ $item->kategori ? $item->kategori->nama_kategori : '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($item->stok > 10)
                                        <span class="bg-green-50 text-green-700 text-xs py-1 px-3 rounded-full flex items-center w-fit font-medium">
                                            <i class="fas fa-check-circle mr-1"></i> {{ $item->stok }}
                                        </span>
                                    @elseif($item->stok > 0)
                                        <span class="bg-yellow-50 text-yellow-700 text-xs py-1 px-3 rounded-full flex items-center w-fit font-medium">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $item->stok }}
                                        </span>
                                    @else
                                        <span class="bg-red-50 text-red-700 text-xs py-1 px-3 rounded-full flex items-center w-fit font-medium">
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
                <div class="mt-8 pt-6 border-t border-gray-200 text-sm text-gray-500 flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle mr-2 text-primary-500"></i>
                            Total Barang: <span class="font-semibold ml-1">{{ count($barang) }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-chart-bar mr-2 text-primary-500"></i>
                            Total Stok: <span class="font-semibold ml-1">{{ $barang->sum('stok') }}</span>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-print mr-2 text-primary-500"></i>
                        Dicetak pada: <span class="font-semibold ml-1">{{ date('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Script JS untuk download Excel dan notifikasi -->
  <script>
        function downloadExcel() {
           
            const excelData = [
                ['No', 'Nama Barang', 'Kategori', 'Stok']
            ];

            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                const cells = row.querySelectorAll('td');
                const no = index + 1;
                const namaBarang = cells[1].textContent.trim();
                const kategori = cells[2].textContent.trim();
                const stok = cells[3].textContent.trim().match(/\d+/)[0]; // Extract number from stok
           
                
                excelData.push([no, namaBarang, kategori, parseInt(stok)]);
            });

            
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet(excelData);

            const range = XLSX.utils.decode_range(ws['!ref']);
            
           
            for (let col = range.s.c; col <= range.e.c; col++) {
                const headerCell = ws[XLSX.utils.encode_cell({r: 0, c: col})];
                if (headerCell) {
                    headerCell.s = {
                        font: { bold: true, color: { rgb: "FFFFFF" } },
                        fill: { fgColor: { rgb: "0ea5e9" } },
                        alignment: { horizontal: "center", vertical: "center" },
                        border: {
                            top: { style: "thin", color: { rgb: "000000" } },
                            bottom: { style: "thin", color: { rgb: "000000" } },
                            left: { style: "thin", color: { rgb: "000000" } },
                            right: { style: "thin", color: { rgb: "000000" } }
                        }
                    };
                }
            }

            // Auto-size columns
            const colWidths = [];
            for (let col = range.s.c; col <= range.e.c; col++) {
                let maxWidth = 12;
                for (let row = range.s.r; row <= range.e.r; row++) {
                    const cell = ws[XLSX.utils.encode_cell({r: row, c: col})];
                    if (cell && cell.v) {
                        const cellWidth = cell.v.toString().length;
                        if (cellWidth > maxWidth) {
                            maxWidth = cellWidth;
                        }
                    }
                }
                colWidths.push({ wch: Math.min(maxWidth + 3, 50) });
            }
            ws['!cols'] = colWidths;

            
            XLSX.utils.book_append_sheet(wb, ws, 'Data Barang');

           
            const now = new Date();
            const dateString = now.toISOString().split('T')[0];
            const filename = `Laporan_Barang_${dateString}.xlsx`;

            XLSX.writeFile(wb, filename);

            showNotification(`File ${filename} berhasil diunduh!`, 'success');
        }

        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 transition-all duration-300 transform translate-x-full max-w-sm`;
            
            if (type === 'success') {
                notification.className += ' bg-green-500 text-white';
                notification.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-xl"></i>
                        <div>
                            <p class="font-semibold">Berhasil!</p>
                            <p class="text-sm">${message}</p>
                        </div>
                    </div>
                `;
            } else {
                notification.className += ' bg-blue-500 text-white';
                notification.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-info-circle mr-3 text-xl"></i>
                        <div>
                            <p class="font-semibold">Info</p>
                            <p class="text-sm">${message}</p>
                        </div>
                    </div>
                `;
            }

            document.body.appendChild(notification);

          
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

     
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, 4000);
        }
    </script>
</body>
</html>
