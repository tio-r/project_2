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
    <!-- Bagian kiri: gambar background -->
    <div class="left-side"></div>
    
    <!-- Bagian kanan: isi -->
    <div class="right-side">
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
            <h1 class="card-title">Daftar</h1>
            <form id="registerForm">
                <div class="form-group">
                    <label for="username">Nama Pengguna</label>
                    <input type="text" id="username" name="username" required />
                    <span class="error-message" id="usernameError"></span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required />
                    <span class="error-message" id="emailError"></span>
                </div>
                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="tel" id="phone" name="phone" required />
                    <span class="error-message" id="phoneError"></span>
                </div>
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" required />
                    <span class="error-message" id="passwordError"></span>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Konfirmasi Sandi</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required />
                    <span class="error-message" id="confirmPasswordError"></span>
                </div>
                <button type="submit" class="submit-btn">Daftar</button>
            </form>
            <div class="login-link">
                <p>Sudah Punya Akun? <a href="/login">Login</a></p>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/daftar.js') }}"></script>
</body>
</html>