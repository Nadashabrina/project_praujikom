@extends('layouts.siswa')

@section('content')

<!-- Header -->
<div class="mb-8 rounded-lg p-8 shadow-lg" style="background-color: #CDEDEA;">
    <h1 class="text-4xl font-bold drop-shadow-md" style="color: #374151;">
        Halo, {{ auth()->user()->name }}! 👋
    </h1>
    <p class="mt-2 drop-shadow-sm" style="color: #374151;">
        Selamat datang di sistem Inventaris
    </p>
</div>

<!-- Statistik -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    <!-- Peminjaman Aktif -->
    <div class="rounded-lg shadow-lg p-6" style="background-color: #FFF1E6;">
        <p class="text-sm font-semibold">📦 Peminjaman Aktif</p>
        <p class="text-3xl font-bold mt-2">
            {{ \App\Models\Loan::where('user_id', auth()->id())
                ->whereNull('tanggal_kembali')
                ->count() }}
        </p>
    </div>

    <!-- Total Peminjaman -->
    <div class="rounded-lg shadow-lg p-6" style="background-color: #FFF1E6;">
        <p class="text-sm font-semibold">📊 Total Peminjaman</p>
        <p class="text-3xl font-bold mt-2">
            {{ \App\Models\Loan::where('user_id', auth()->id())->count() }}
        </p>
    </div>

    <!-- Sudah Dikembalikan -->
    <div class="rounded-lg shadow-lg p-6" style="background-color: #FFF1E6;">
        <p class="text-sm font-semibold">✅ Sudah Dikembalikan</p>
        <p class="text-3xl font-bold mt-2">
            {{ \App\Models\Loan::where('user_id', auth()->id())
                ->whereNotNull('tanggal_kembali')
                ->count() }}
        </p>
    </div>

</div>

<!-- PEMINJAMAN SAYA -->
<div class="rounded-lg shadow-lg p-6 mb-8" style="background-color: #DCEBFA;">
    <h2 class="text-2xl font-bold mb-4">📋 Peminjaman Saya</h2>

    @php
        $myLoans = \App\Models\Loan::where('user_id', auth()->id())
            ->whereNull('tanggal_kembali')
            ->with('tool')
            ->orderBy('tanggal_pinjam', 'desc')
            ->get();
    @endphp

    @if($myLoans->count())
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead style="background-color: #CDEDEA;">
                    <tr>
                        <th class="px-4 py-2 text-left">Alat</th>
                        <th class="px-4 py-2 text-left">Jumlah</th>
                        <th class="px-4 py-2 text-left">Tanggal Pinjam</th>
                        <th class="px-4 py-2 text-left">Tanggal Kembali</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($myLoans as $loan)
                    <tr class="border-b" style="background-color: #FFF7E6;">
                        
                        <td class="px-4 py-2">{{ $loan->tool->nama_alat ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $loan->jumlah }}</td>
                        <td class="px-4 py-2">{{ $loan->tanggal_pinjam }}</td>
                        <td class="px-4 py-2">{{ $loan->tanggal_kembali_target }}</td>

                       

                        <!-- STATUS -->
                        <td class="px-4 py-2">
                            @if($loan->status == 'dipinjam')
                                <span class="text-green-600 font-semibold">Dipinjam</span>
                            @elseif($loan->status == 'rejected')
                                <span class="text-red-600 font-semibold">Ditolak</span>
                            @else
                                <span class="text-yellow-600 font-semibold">Menunggu</span>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-8">
            <p>Tidak ada peminjaman aktif</p>
        </div>
    @endif
</div>

<!-- RIWAYAT PEMINJAMAN -->
<div class="rounded-lg shadow-lg p-6" style="background-color: #DCEBFA;">
    <h2 class="text-2xl font-bold mb-4">📚 Riwayat Peminjaman</h2>

    @php
        $historyLoans = \App\Models\Loan::where('user_id', auth()->id())
            ->whereNotNull('tanggal_kembali')
            ->with('tool')
            ->orderBy('tanggal_kembali', 'desc')
            ->get();
    @endphp

    @if($historyLoans->count())
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead style="background-color: #CDEDEA;">
                    <tr>
                        <th class="px-4 py-2 text-left">Alat</th>
                        <th class="px-4 py-2 text-left">Jumlah</th>
                        <th class="px-4 py-2 text-left">Tanggal Pinjam</th>
                        <th class="px-4 py-2 text-left">Tanggal Kembali</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historyLoans as $loan)
                    <tr class="border-b" style="background-color: #FFF7E6;">
                        <td class="px-4 py-2">{{ $loan->tool->nama_alat ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $loan->jumlah }}</td>
                        <td class="px-4 py-2">{{ $loan->tanggal_pinjam }}</td>
                        <td class="px-4 py-2">{{ $loan->tanggal_kembali }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-8">
            <p>Belum ada riwayat peminjaman</p>
        </div>
    @endif
</div>

@endsection