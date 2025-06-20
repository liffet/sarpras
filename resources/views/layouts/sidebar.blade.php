<!-- Sidebar -->
<aside class="w-64 bg-gradient-to-b from-primary-800 to-primary-900 text-white flex flex-col shadow-xl">
    <div class="p-5 border-b border-primary-700 flex items-center justify-between">
        <h1 class="text-2xl font-bold tracking-wide flex items-center space-x-2">
            <span>SISFO <span class="text-primary-300">SARPRAS</span></span>
        </h1>
    </div>

    <div class="p-4 border-b border-primary-700 flex items-center space-x-3">
        <div class="w-10 h-10 rounded-full bg-primary-600 flex items-center justify-center">
            <i class="fas fa-user text-primary-100"></i>
        </div>
        <div>
            <p class="font-medium">{{ auth()->user()?->name ?? 'Guest' }}</p>
            <p class="text-xs text-primary-300">Administrator</p>
        </div>
    </div>

    <nav class="flex flex-col p-4 space-y-1 flex-grow">
        <p class="text-xs text-primary-400 uppercase font-bold px-3 pt-4 pb-2 tracking-wider">Menu Utama</p>
        <a href="{{ route('admin') }}"
            class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200 {{ request()->routeIs('admin') ? 'bg-primary-700 text-white font-medium' : '' }}">
            <i class="fas fa-chart-pie w-5 mr-2 text-primary-200"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('pengguna.index') }}"
            class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200 {{ request()->routeIs('pengguna.*') ? 'bg-primary-700 text-white font-medium' : '' }}">
            <i class="fas fa-users w-5 mr-2 text-primary-200"></i>
            <span>Pengguna</span>
        </a>
        <a href="{{ route('admin.pendataan') }}"
            class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200 {{ request()->routeIs('admin.pendataan') ? 'bg-primary-700 text-white font-medium' : '' }}">
            <i class="fas fa-clipboard-check w-5 mr-2 text-primary-200"></i>
            <span>Pendataan</span>
        </a>
        <a href="{{ route('peminjaman.index') }}"
            class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200 {{ request()->routeIs('peminjaman.*') ? 'bg-primary-700 text-white font-medium' : '' }}">
            <i class="fas fa-hand-holding w-5 mr-2 text-primary-200"></i>
            <span>Peminjaman</span>
        </a>
        <a href="{{ route('pengembalians.index') }}"
            class="flex items-center px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200 {{ request()->routeIs('pengembalians.*') ? 'bg-primary-700 text-white font-medium' : '' }}">
            <i class="fas fa-exchange-alt w-5 mr-2 text-primary-200"></i>
            <span>Pengembalian</span>
        </a>
        <div x-data="{ laporanOpen: false }" class="flex flex-col">
            <button @click="laporanOpen = !laporanOpen"
                class="flex items-center justify-between w-full px-3 py-2.5 rounded-lg hover:bg-primary-700 transition-all duration-200 hover:shadow-md text-left">
                <div class="flex items-center">
                    <i class="fas fa-file-chart-line w-5 mr-2 text-primary-200"></i>
                    <span>Laporan</span>
                </div>
                <i :class="laporanOpen ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-primary-200"></i>
            </button>
            <div x-show="laporanOpen"
                class="mt-1 pl-8 flex flex-col space-y-1 overflow-hidden transition-all duration-300"
                style="display: none;">
                <a href="{{ route('laporan.barang') }}"
                    class="px-3 py-2 rounded-lg hover:bg-primary-700 transition-all duration-200 {{ request()->routeIs('laporan.barang') ? 'bg-primary-700 text-white font-medium' : '' }}">
                    Laporan Barang
                </a>
                <a href="{{ route('laporan.peminjaman') }}"
                    class="px-3 py-2 rounded-lg hover:bg-primary-700 transition-all duration-200 {{ request()->routeIs('laporan.peminjaman') ? 'bg-primary-700 text-white font-medium' : '' }}">
                    Laporan Peminjaman
                </a>
                <a href="{{ route('laporan.pengembalian') }}"
                    class="px-3 py-2 rounded-lg hover:bg-primary-700 transition-all duration-200 {{ request()->routeIs('laporan.pengembalian') ? 'bg-primary-700 text-white font-medium' : '' }}">
                    Laporan Pengembalian
                </a>
            </div>
        </div>
    </nav>

    <div class="p-4 mt-auto border-t border-primary-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                class="flex items-center text-sm text-primary-300 hover:text-white w-full px-3 py-2 rounded-lg hover:bg-primary-700 transition-all duration-200">
                <i class="fas fa-sign-out-alt mr-2"></i>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>