<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan & Alamat</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f4f7f6; padding: 40px; }
        .container { max-width: 1000px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); }
        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        h2 { color: #333333; font-size: 24px; }
        .btn-tambah { background-color: #4a90e2; color: white; padding: 10px 18px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 600; }
        .btn-tambah:hover { background-color: #357abd; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eaeaea; font-size: 14px; vertical-align: top; }
        th { background-color: #f8f9fa; color: #333333; font-weight: 600; }
        .btn-delete { background: none; border: none; color: #d9534f; cursor: pointer; font-weight: 500; font-size: 14px; }
        .btn-delete:hover { text-decoration: underline; }
        .empty-data { text-align: center; padding: 20px; color: #777; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header-flex">
            <h2>Data Pelanggan & Alamat</h2>
            <a href="{{ route('pelanggan.create') }}" class="btn-tambah">+ Tambah Pelanggan</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama & Email</th>
                    <th>No. HP</th>
                    <th>Alamat Pengiriman</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pelanggan as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $p->name }}</strong><br>
                            <small style="color: #666;">{{ $p->email }}</small>
                        </td>
                        <td>{{ $p->phone_number ?? '-' }}</td>
                        <td>
                            @if($p->addresses->count() > 0)
                                @foreach($p->addresses as $addr)
                                    <p style="margin-bottom: 4px;">{{ $addr->full_address }}</p>
                                @endforeach
                            @else
                                <span style="color: #999;">Belum ada alamat</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-data">Belum ada data pelanggan & alamat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>