<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengembalian</title>
</head>
<body>
        <a href="{{ route('admin') }}">

            <h2>Laporan Pengembalian</h2>
        </a>

    <form method="GET">
        <label>Dari Tanggal: <input type="date" name="start_date" value="{{ request('start_date') }}"></label>
        <label>Sampai Tanggal: <input type="date" name="end_date" value="{{ request('end_date') }}"></label>
        <button type="submit">Filter</button>
    </form>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Barang</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengembalian as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->peminjaman->user->name }}</td>
                <td>{{ $item->peminjaman->barang->nama_barang }}</td>
                <td>{{ $item->tanggal_pengembalian }}</td>
                <td>{{ $item->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
