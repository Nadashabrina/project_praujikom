@extends('layouts.admin')

@section('content')

<div class="p-6">

    <!-- TITLE + BUTTON -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-700">
            Data Peminjaman
        </h1>

        <a href="{{ route('loans.create') }}"
           class="px-5 py-2.5 bg-teal-400 hover:bg-teal-500 text-white font-semibold rounded-lg shadow transition">
            + Pinjam Alat
        </a>
    </div>


    <!-- CARD TABLE -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-center">
                
                <!-- HEAD -->
                <thead class="bg-sky-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Alat</th>
                        <th class="px-6 py-4">Jumlah</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="divide-y">

                    @foreach($loans as $loan)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4 font-semibold text-gray-700">
                            {{ $loan->nama_peminjam }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $loan->tool->nama_alat }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $loan->jumlah }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $loan->tanggal_pinjam }}
                        </td>

                        <!-- STATUS -->
                        <td class="px-6 py-4">
                            @if($loan->tanggal_kembali)
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                    Sudah dikembalikan
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                    Dipinjam
                                </span>
                            @endif
                        </td>

                        <!-- AKSI -->
                        <td class="px-6 py-4">
                            @if(!$loan->tanggal_kembali)
                                <button
                                    onclick="openReturnModal({{ $loan->id }}, '{{ $loan->nama_peminjam }}')"
                                    class="px-4 py-2 bg-amber-400 hover:bg-amber-500 text-white font-semibold rounded-lg shadow transition">
                                    Kembalikan
                                </button>
                            @endif
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- MODAL RETURN -->
<div id="returnModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 border-t-4 border-teal-400">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-700">
                Konfirmasi Pengembalian
            </h2>

            <button onclick="closeReturnModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                &times;
            </button>
        </div>

        <p class="text-gray-600 mb-6">
            Kembalikan alat yang dipinjam oleh
            <span class="font-semibold text-gray-800" id="loanName"></span> ?
        </p>

        <div class="flex gap-3">

            <form id="returnForm" method="POST" class="w-full">
                @csrf
                <button type="submit"
                    class="w-full py-2 bg-teal-400 hover:bg-teal-500 text-white font-semibold rounded-lg transition">
                    Kembalikan
                </button>
            </form>

            <button onclick="closeReturnModal()"
                class="w-full py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition">
                Batal
            </button>

        </div>
    </div>
</div>


<script>
    function openReturnModal(id, name) {
        document.getElementById('loanName').textContent = name;
        document.getElementById('returnForm').action = `/loans/${id}/return`;
        document.getElementById('returnModal').classList.remove('hidden');
    }

    function closeReturnModal() {
        document.getElementById('returnModal').classList.add('hidden');
    }

    // klik luar modal
    document.getElementById('returnModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeReturnModal();
        }
    });
</script>

@endsection
