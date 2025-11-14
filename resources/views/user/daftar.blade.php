<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Daftar Akun</title>
<link rel="stylesheet" href="{{ asset('css/daftar.css') }}" />
</head>
<body>
<div class="container">
    <div class="left-side"></div>
    <div class="right-side">
        <div class="header">
            <div class="logo-container">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo-img" />
                <div class="header-text">
                    <h2>Selamat Datang di</h2>
                    <h1>Apotek Naura Farma</h1>
                </div>
            </div>
        </div>
        <div class="card">
            <h1 class="card-title">Daftar</h1>

            @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif

            <form method="POST" action="{{ route('daftar') }}">
                @csrf
                <div class="form-group">
                    <label for="username">Nama Pengguna</label>
                    <input type="text" id="username" name="username" required value="{{ old('username') }}" />
                    @error('username')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required value="{{ old('email') }}" />
                    @error('email')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="tel" id="phone" name="phone" required value="{{ old('phone') }}" />
                    @error('phone')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" required />
                    @error('password')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Konfirmasi Sandi</label>
                    <input type="password" id="confirmPassword" name="password_confirmation" required />
                </div>
                <button type="submit" class="submit-btn">Daftar</button>
            </form>
            <div class="login-link">
                <p>Sudah Punya Akun? <a href="/login">Login</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>