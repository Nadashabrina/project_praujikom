<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Petugas - UKK Alat</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r shadow-xl flex flex-col">

        <!-- LOGO -->
        <div class="px-6 py-5 border-b bg-gradient-to-r from-blue-500 to-cyan-400 text-white">
            <h1 class="text-xl font-bold tracking-wide flex items-center gap-2">
                📚 <span>UKK Alat</span>
            </h1>
            <p class="text-xs opacity-80">Sistem Peminjaman Alat</p>
        </div>

        <!-- USER INFO -->
        <div class="p-5 border-b bg-slate-50">
            <div class="text-sm text-gray-500">Login sebagai</div>
            <div class="font-semibold text-gray-800 text-base">
                {{ auth()->user()->name }}
            </div>
            <span class="inline-block mt-2 px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                {{ auth()->user()->role }}
            </span>
        </div>

        <!-- MENU -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto text-sm">

            <!-- DASHBOARD -->
            <a href="{{ route('petugas.dashboard') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('petugas/dashboard') ? 'bg-blue-500 text-white shadow' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                🏠 Dashboard
            </a>

            <!-- TRANSAKSI -->
            <p class="pt-4 text-xs font-bold text-gray-400 uppercase">Transaksi</p>

            <a href="{{ route('petugas.tools') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('petugas/tools*') ? 'bg-blue-500 text-white shadow' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                📦 Daftar Alat
            </a>

            <a href="{{ route('petugas.approve-loans') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('petugas/approve-loans*') ? 'bg-blue-500 text-white shadow' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                ✅ Setujui Peminjaman
            </a>

            <a href="{{ route('petugas.validate-returns') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('petugas/validate-returns*') ? 'bg-blue-500 text-white shadow' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                ✔️ Validasi Pengembalian
            </a>

            <!-- LAPORAN -->
            <p class="pt-4 text-xs font-bold text-gray-400 uppercase">Laporan</p>

            <a href="{{ route('petugas.reports') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('petugas/reports*') ? 'bg-blue-500 text-white shadow' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                📊 Laporan
            </a>

            <a href="{{ route('petugas.laporan-peminjaman') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('petugas/laporan-peminjaman*') ? 'bg-blue-500 text-white shadow' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                📚 Laporan Peminjaman
            </a>

            <a href="{{ route('petugas.verify-denda-payments') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('petugas/verify-denda-payments*') ? 'bg-blue-500 text-white shadow' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                💰 Verifikasi Denda
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
