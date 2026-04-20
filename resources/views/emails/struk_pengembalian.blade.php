<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Struk Pengembalian</title>
</head>
<body>
    <h2>Struk Pengembalian</h2>

    <p>Halo, {{ $loan->user->name }}</p>

    <p>Berikut detail pengembalian alat:</p>

    <ul>
        <li>Nama Alat: {{ $loan->tool->nama_alat }}</li>
        <li>Jumlah: {{ $loan->jumlah }}</li>
        <li>Tanggal Pinjam: {{ $loan->tanggal_pinjam }}</li>
        <li>Tanggal Kembali: {{ $loan->tanggal_kembali }}</li>
        <li>Status Alat: {{ $loan->status_alat ?? 'Belum diisi' }}</li>
        <li>Denda: Rp {{ number_format($loan->denda, 0, ',', '.') }}</li>
    </ul>

    <p>Terima kasih 🙏</p>
</body>
</html>