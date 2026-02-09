<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - UKK Alat</title>

    <!-- Sama seperti petugas -->
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
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('dashboard') ? 'bg-blue-500 text-white shadow' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                🏠 Dashboard
            </a>

            <!-- MASTER DATA -->
            <p class="pt-4 text-xs font-bold text-gray-400 uppercase">Master Data</p>

            <a href="{{ route('tools.index') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('tools*') ? 'bg-blue-500 text-white shadow' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                📦 Data Alat
            </a>

            <a href="{{ route('categories.index') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('categories*') ? 'bg-blue-500 text-white shadow' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                🏷️ Kategori
            </a>

            <!-- TRANSAKSI -->
            <p class="pt-4 text-xs font-bold text-gray-400 uppercase">Transaksi</p>

            <a href="{{ route('loans.index') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('loans*') ? 'bg-blue-500 text-white shadow' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                🔄 Data Peminjaman
            </a>

            <a href="{{ route('returns.index') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('returns*') ? 'bg-blue-500 text-white shadow' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                ↩️ Pengembalian
            </a>

            <!-- ADMIN -->
            <p class="pt-4 text-xs font-bold text-gray-400 uppercase">Administrator</p>

            <a href="{{ route('users.index') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('users*') ? 'bg-blue-500 text-white shadow' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                👥 Manajemen User
            </a>

            <a href="{{ route('activity-logs.index') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
               {{ request()->is('activity-logs*') ? 'bg-blue-500 text-white shadow' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                📊 Log Aktivitas
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
        <div class="max-w-7xl mx-auto">
            @yield('content')
        </div>
    </main>

</div>

</body>
</html>
