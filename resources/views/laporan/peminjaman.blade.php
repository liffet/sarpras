<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>
</head>
<body>
        <a href="{{ route('admin') }}">

                <h2>Laporan Peminjaman</h2>
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
                <th>Tanggal Pinjam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->barang->nama_barang }}</td>
                <td>{{ $item->tanggal_pinjam }}</td>
                <td>{{ $item->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
