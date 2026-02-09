@extends('layouts.admin')

@section('content')

<div class="bg-white rounded-2xl shadow-lg p-6">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6 border-b pb-3">
        <h1 class="text-2xl font-bold text-gray-800">
            Log Aktivitas Sistem
        </h1>

        <div class="text-sm text-gray-500">
            Total Log : <span class="font-semibold text-gray-700">{{ $logs->count() }}</span>
        </div>
    </div>


    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-gray-700">
            
            <!-- Table Head -->
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3 text-center w-16">No</th>
                    <th class="px-4 py-3 text-left">User</th>
                    <th class="px-4 py-3 text-center w-40">Aksi</th>
                    <th class="px-4 py-3 text-left">Keterangan</th>
                    <th class="px-4 py-3 text-center w-48">Waktu</th>
                </tr>
            </thead>

            <!-- Table Body -->
            <tbody class="divide-y">

                @forelse($logs as $index => $log)

                @php
                    $action = strtolower($log->action);

                    $badge = 'bg-gray-200 text-gray-700';

                    if(str_contains($action,'tambah') || str_contains($action,'create'))
                        $badge = 'bg-green-100 text-green-700';

                    elseif(str_contains($action,'edit') || str_contains($action,'update'))
                        $badge = 'bg-yellow-100 text-yellow-700';

                    elseif(str_contains($action,'hapus') || str_contains($action,'delete'))
                        $badge = 'bg-red-100 text-red-700';

                    elseif(str_contains($action,'login'))
                        $badge = 'bg-blue-100 text-blue-700';

                    elseif(str_contains($action,'logout'))
                        $badge = 'bg-purple-100 text-purple-700';
                @endphp

                <tr class="hover:bg-gray-50 transition">

                    <td class="px-4 py-3 text-center font-semibold text-gray-500">
                        {{ $index + 1 }}
                    </td>

                    <td class="px-4 py-3 font-medium text-gray-800">
                        {{ $log->user->name ?? 'User Dihapus' }}
                    </td>

                    <td class="px-4 py-3 text-center">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badge }}">
                            {{ ucfirst($log->action) }}
                        </span>
                    </td>

                    <td class="px-4 py-3 text-gray-600">
                        {{ $log->description ?? '-' }}
                    </td>

                    <td class="px-4 py-3 text-center text-gray-500 text-xs">
                        {{ $log->created_at->format('d M Y - H:i') }}
                    </td>

                </tr>

                @empty

                <!-- Empty State -->
                <tr>
                    <td colspan="5" class="py-12 text-center">

                        <div class="flex flex-col items-center gap-2 text-gray-400">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 17v-2m6 2v-6m2 10H7a2 2 0 01-2-2V7a2 2 0 012-2h3l2-2 2 2h3a2 2 0 012 2v12a2 2 0 01-2 2z" />
                            </svg>

                            <p class="text-lg font-semibold">Belum ada aktivitas</p>
                            <p class="text-sm">Semua aktivitas user akan muncul di sini</p>

                        </div>

                    </td>
                </tr>

                @endforelse

            </tbody>
        </table>
    </div>

</div>

@endsection
