<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan & Alamat</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; }
        .card { background: #ffffff; padding: 35px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); width: 100%; max-width: 500px; }
        h2 { margin-bottom: 20px; color: #333333; font-size: 22px; text-align: center; }
        .alert-error { background-color: #ffe6e6; color: #d9534f; padding: 12px; border-radius: 6px; margin-bottom: 20px; font-size: 13px; border-left: 4px solid #d9534f; }
        .alert-error ul { margin-left: 15px; }
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; margin-bottom: 6px; color: #555; font-size: 14px; font-weight: 500; }
        .form-control { width: 100%; padding: 10px 14px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; }
        .form-control:focus { border-color: #4a90e2; outline: none; box-shadow: 0 0 5px rgba(74, 144, 226, 0.3); }
        textarea.form-control { resize: vertical; height: 80px; }
        
        .btn-submit { background-color: #4a90e2; color: white; padding: 12px; border: none; border-radius: 6px; cursor: pointer; width: 100%; font-size: 16px; font-weight: 600; margin-top: 10px; transition: background-color 0.3s; }
        .btn-submit:hover { background-color: #357abd; }
    </style>
</head>
<body>

    <div class="card">
        <h2>Tambah Pelanggan & Alamat</h2>

        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pelanggan.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nama pembeli">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email aktif">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter">
            </div>

            <div class="form-group">
                <label>No. HP</label>
                <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" placeholder="Nomor handphone">
            </div>

            <div class="form-group">
                <label>Alamat Pengiriman</label>
                <textarea name="full_address" class="form-control" placeholder="Masukkan alamat lengkap (Jalan, Kota, Kode Pos)">{{ old('full_address') }}</textarea>
            </div>

            <button type="submit" class="btn-submit">Simpan Data</button>
        </form>
    </div>

</body>
</html>