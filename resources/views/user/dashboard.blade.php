<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>
</head>
<body>
    <!-- Navbar atas -->
    <header class="navbar-top">
        <div class="logo">
            <img src="img/logo.png" alt="Logo" />
            <div class="teks">
                <h2>Naura Farma</h2>
                <h4>User</h4>
            </div>
        </div>
        <div class="icons">
            <i class="fas fa-bell"></i>
            <i class="fas fa-comments"></i>
        </div>
    </header>

    <!-- Konten utama -->
    <div class="content-container">
        <!-- Jadwal dan tombol -->
        <div class="schedule-bg">
            <section class="schedule-section">
                <div class="schedule-header">
                    <h3>Jadwal Minum Obat</h3>
                    <button id="btn-lihat-jadwal"><a href="{{ route('kalender') }}" class="btn"><i class="fa-solid fa-calendar-days"></i> Lihat Jadwal</a></button>
                  </div>
              <hr>
              <br>
              <p class="schedule-date">Senin, 1 Januari</p>
              <p class="no-schedule">Tidak ada jadwal hari ini</p>
            </section>
          </div>
        
        <!-- Main menu -->
        <section class="main-menu">
            <h3>MyHealth</h3>
            <p>Gunakan menu ini untuk melihat informasi dan mengelola kesehatan anda.</p>
            <div class="menu-icons">
                <div class="menu-item" style="cursor:pointer;" onclick="window.location='/chat'">
                    <i class="fas fa-comment-medical"></i>
                    <span>Chat Apoteker</span>
                </div>
                <div class="menu-item" style="cursor:pointer;" onclick="window.location='/etalase-obat'">
                    <i class="fa-solid fa-pills"></i>
                    <span>Etalase Obat</span>
                </div>
                <div class="menu-item">
                    <i class="fas fa-wheelchair"></i>
                    <span>Alat Kesehatan</span>
                </div>
                <div class="menu-item">
                    <i class="fa-solid fa-cart-plus"></i>
                    <span>Keranjang Sehat</span>
                </div>
                <div class="menu-item">
                    <i class="fas fa-file-alt"></i>
                    <span>Riwayat Saya</span>
                </div>
            </div>
            <div class="feature-filters" style="display: flex; gap: 10px; margin-bottom: 20px;">
                <div class="feature-box jko">
                    <img src="img/jko.png" /> 
                    <div class="text-container">
                    <h2>JKO</h2>
                    <h4>Jadwal</h4>
                    <h4>Konsumsi</h4>
                    <h4>Obat</h4>
                    </div>
                </div>
                <div class="feature-box voucher">
                    <img src="img/voucher.png" /> 
                    <div class="text-container">
                    <h2>Voucher</h2>
                    <h4>Penukaran</h4>
                    <h4>Voucher</h4>
                    <h4>Member</h4>
                </div>
            </div>
        </section>
    
        <!-- Artikel dan Tips Kesehatan -->
        <section class="articles-section">
            <h3>Artikel dan Tips Kesehatan</h3>
            <p>Dapatkan informasi dari dunia kesehatan di sini!</p>
            <br>
            <div class="articles-container">
                <!-- Artikel 1 -->
                <div class="article-card">
                    <a href="https://www.halodoc.com/artikel/mental-breakdown-kenali-gejala-dan-cara-atasinya">
                    <img src="https://d1vbn70lmn1nqe.cloudfront.net/prod/wp-content/uploads/2025/07/10034203/mental-breakdown.jpg" alt="Artikel 1" />
                    </a>
                    <h4>Mental Breakdown? Kenali Gejala dan Cara Atasinya</h4>
                </div>
                <!-- Artikel 2 -->
                <div class="article-card">
                    <a href="https://kemkes.go.id/id/serangan-jantung-di-usia-muda">
                    <img src="https://kemkes.go.id/app_asset/image_content/1753319401688187e9aa8d52.39820818.png" alt="Artikel 2" />
                    </a>
                    <h4>Serangan Jantung di Usia Muda</h4>
                </div>
                <!-- Artikel 3 -->
                <div class="article-card">
                    <a href="https://kemkes.go.id/id/gas-pol-penuhi-alat-kesehatan-di-rumah-sakit">
                    <img src="https://kemkes.go.id/app_asset/image_content/167403209263c7b3dcd560b4.32908808.jpg" alt="Artikel 3" />
                    </a>
                    <h4>Gas Pol Penuhi Alat Kesehatan di Rumah Sakit</h4>    
                </div>
                <div class="article-card">
                    <a href="https://www.halodoc.com/artikel/mental-breakdown-kenali-gejala-dan-cara-atasinya">
                    <img src="https://d1vbn70lmn1nqe.cloudfront.net/prod/wp-content/uploads/2025/07/10034203/mental-breakdown.jpg" alt="Artikel 1" />
                    </a>
                    <h4>Mental Breakdown? Kenali Gejala dan Cara Atasinya</h4>
                </div>
                <!-- Artikel 2 -->
                <div class="article-card">
                    <a href="https://kemkes.go.id/id/serangan-jantung-di-usia-muda">
                    <img src="https://kemkes.go.id/app_asset/image_content/1753319401688187e9aa8d52.39820818.png" alt="Artikel 2" />
                    </a>
                    <h4>Serangan Jantung di Usia Muda</h4>
                </div>
                <!-- Artikel 3 -->
                <div class="article-card">
                    <a href="https://kemkes.go.id/id/gas-pol-penuhi-alat-kesehatan-di-rumah-sakit">
                    <img src="https://kemkes.go.id/app_asset/image_content/167403209263c7b3dcd560b4.32908808.jpg" alt="Artikel 3" />
                    </a>
                    <h4>Gas Pol Penuhi Alat Kesehatan di Rumah Sakit</h4>    
                </div>
            </div>
        </section>
    </div>

    <!-- Navbar bawah -->
    <footer class="navbar-bottom">
        <div class="nav-item active">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </div>
        <div class="nav-item">
            <i class="fas fa-user"></i>
            <span>Profile</span>
        </div>
        <div class="nav-item">
            <i class="fas fa-tools"></i>
            <span>Pengaturan</span>
        </div>
    </footer>
</body>
</html>