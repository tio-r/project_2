<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Login Akun</title>
<link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>
<body>
<div class="container">
    <!-- Bagian kiri: gambar background -->
    <div class="left-side">
        <div class="header">
            <div class="logo-container">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo-img" />
                <div class="header-text">
                    <h2>Selamat Datang di</h2>
                    <h1>Apotek Naura Farma</h1>
                </div>
            </div>
        <!-- Card box untuk form -->
        <div class="card">
            <h1 class="card-title">Login</h1>
            <form id="loginForm">
                <div class="form-group">
                    <label for="username">Nama Pengguna</label>
                    <input type="text" id="username" name="username" required />
                    <span class="error-message" id="usernameError"></span>
                </div>
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" required />
                    <span class="error-message" id="passwordError"></span>
                </div>
                <button type="submit" class="submit-btn">Login</button>
            </form>
            <div class="daftar-link">
                <p>Belum Punya Akun? <a href="/daftar">Daftar</a></p>
            </div>
        </div>
    </div>
</div>
    <!-- Bagian kanan: isi -->
    <div class="right-side">
        
    </div>
<script src="{{ asset('js/login.js') }}"></script>
</body>
</html>