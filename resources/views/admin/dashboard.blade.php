@extends('layouts.admin')

@section('content')

<!-- Welcome Banner -->
<div class="mb-8 bg-gradient-to-r from-sky-500 to-cyan-500 rounded-2xl p-8 shadow-xl text-black">
    <h1 class="text-3xl font-bold">
        Halo, {{ auth()->user()->name }} 👋
    </h1>
    <p class="mt-2 opacity-90">
        Selamat datang di Sistem Inventaris. Kelola alat, peminjaman, dan pengguna dengan mudah hari ini.
    </p>
</div>


<!-- STATISTICS -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

    <!-- Total Alat -->
    <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-blue-500 hover:shadow-xl transition">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Total Alat</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">
                    {{ \App\Models\Tool::count() }}
                </h2>
            </div>
            <div class="text-4xl">📦</div>
        </div>
    </div>

    <!-- Total Peminjaman -->
    <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-green-500 hover:shadow-xl transition">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Total Peminjaman</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">
                    {{ \App\Models\Loan::count() }}
                </h2>
            </div>
            <div class="text-4xl">📊</div>
        </div>
    </div>

    <!-- Sedang Dipinjam -->
    <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-yellow-500 hover:shadow-xl transition">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Sedang Dipinjam</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">
                    {{ \App\Models\Loan::whereNull('tanggal_kembali')->count() }}
                </h2>
            </div>
            <div class="text-4xl">⏳</div>
        </div>
    </div>

    <!-- Total User -->
    <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-purple-500 hover:shadow-xl transition">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Total Pengguna</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">
                    {{ \App\Models\User::count() }}
                </h2>
            </div>
            <div class="text-4xl">👥</div>
        </div>
    </div>

</div>


<!-- CONTENT -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-3">

    <!-- Peminjaman Terbaru -->
    <div class="bg-white rounded-2xl shadow-lg p-6">

        <div class="flex justify-between items-center mb-5">
            <h2 class="text-lg font-bold text-gray-800">
                Peminjaman Terbaru
            </h2>
        </div>

        @php
            $loans = \App\Models\Loan::latest()->take(10)->get();
        @endphp

        <div class="space-y-3 max-h-[320px] overflow-y-auto pr-2">

            @forelse($loans as $loan)
            <div class="flex justify-between items-center p-3 rounded-xl border hover:bg-gray-50 transition">

                <div>
                    <p class="font-semibold text-gray-800">
                        {{ $loan->user->name ?? 'User' }}
                    </p>
                    <p class="text-sm text-gray-500">
                        {{ $loan->tool->nama_alat ?? 'Alat' }}
                    </p>
                </div>

                @if($loan->tanggal_kembali)
                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-green-100 text-green-700">
                        Dikembalikan
                    </span>
                @else
                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">
                        Dipinjam
                    </span>
                @endif

            </div>
            @empty
                <p class="text-center text-gray-400 py-6">
                    Belum ada peminjaman
                </p>
            @endforelse

        </div>

    </div>


    <!-- Alat Tersedia -->
    <div class="bg-white rounded-2xl shadow-lg p-6">

        <div class="flex justify-between items-center mb-5">
            <h2 class="text-lg font-bold text-gray-800">
                Alat Tersedia
            </h2>
        </div>

        @php
            $tools = \App\Models\Tool::where('stok', '>', 0)->take(10)->get();
        @endphp

        <div class="space-y-3 max-h-[320px] overflow-y-auto pr-2">

            @forelse($tools as $tool)
            <div class="flex justify-between items-center p-3 rounded-xl border hover:bg-gray-50 transition">

                <div>
                    <p class="font-semibold text-gray-800">
                        {{ $tool->nama_alat }}
                    </p>
                    <p class="text-sm text-gray-500">
                        Stok: {{ $tool->stok }}
                    </p>
                </div>

                <span class="text-xs font-semibold px-3 py-1 rounded-full bg-blue-100 text-blue-700">
                    Tersedia
                </span>

            </div>
            @empty
                <p class="text-center text-gray-400 py-6">
                    Tidak ada alat tersedia
                </p>
            @endforelse

        </div>

    </div>

</div>

@endsection
