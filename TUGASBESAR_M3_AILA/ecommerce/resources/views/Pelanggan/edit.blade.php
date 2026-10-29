<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<h1>Edit Pelanggan</h1>

@if ($errors->any())
    <ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
@endif

<form action="{{ route('pelanggan.update', $pelanggan) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ old('name', $pelanggan->name) }}"><br>
    <input type="email" name="email" value="{{ old('email', $pelanggan->email) }}"><br>
    <input type="text" name="phone_number" value="{{ old('phone_number', $pelanggan->profile->phone_number ?? '') }}"><br>
    <button type="submit">Update</button>
</form>