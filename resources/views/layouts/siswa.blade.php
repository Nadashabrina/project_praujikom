<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Siswa - UKK Alat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR SISWA -->
    <aside class="w-64 bg-white border-r shadow-xl flex flex-col">

        <!-- LOGO -->
        <div class="px-6 py-5 border-b bg-gradient-to-r from-emerald-500 to-teal-400 text-white">
            <h1 class="text-xl font-bold tracking-wide flex items-center gap-2">
                🎒 <span>UKK Alat</span>
            </h1>
            <p class="text-xs opacity-80">Sistem Peminjaman Alat</p>
        </div>

        <!-- USER INFO -->
        <div class="p-5 border-b bg-slate-50">
            <div class="text-sm text-gray-500">Login sebagai</div>
            <div class="font-semibold text-gray-800 text-base">
                {{ auth()->user()->name }}
            </div>
            <span class="inline-block mt-2 px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-700">
                {{ auth()->user()->role }}
            </span>
        </div>

        <!-- MENU -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto text-sm">

            <!-- DASHBOARD -->
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('dashboard') ? 'bg-emerald-500 text-white shadow' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-600' }}">
                🏠 Dashboard
            </a>

            <!-- MENU SISWA -->
            <p class="pt-4 text-xs font-bold text-gray-400 uppercase">Menu Siswa</p>

            <a href="{{ route('siswa.tools') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('tools*') ? 'bg-emerald-500 text-white shadow' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-600' }}">
                📦 Daftar Alat
            </a>

            <a href="{{ route('siswa.loans.create') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('siswa/loans/create*') ? 'bg-emerald-500 text-white shadow' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-600' }}">
                ➕ Ajukan Pinjaman
            </a>

            <a href="{{ route('siswa.loans.index') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('siswa/loans*') && !request()->is('siswa/loans/create*') ? 'bg-emerald-500 text-white shadow' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-600' }}">
                ↩️ Kembalikan Alat
            </a>

            <a href="{{ route('siswa.riwayat-peminjaman') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('siswa/riwayat-peminjaman*') ? 'bg-emerald-500 text-white shadow' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-600' }}">
                📚 Riwayat Peminjaman
            </a>

            <a href="{{ route('siswa.denda-payments.index') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('siswa/denda-payments*') ? 'bg-emerald-500 text-white shadow' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-600' }}">
                💰 Pembayaran Denda
            </a>
        </nav>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}" class="p-4 border-t">
            @csrf
            <button class="w-full py-2 rounded-lg bg-red-500 text-white font-semibold hover:bg-red-600 transition">
                🚪 Logout
            </button>
        </form>

    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-8 overflow-x-auto">
        @yield('content')
    </main>

</div>

</body>
</html>
