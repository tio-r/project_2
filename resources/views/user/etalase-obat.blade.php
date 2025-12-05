<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Etalase Obat</title>
<link rel="stylesheet" href="{{ asset('css/etalase.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
<!-- Loading overlay -->
<div id="loading" class="loading-overlay">
    <div class="loading-spinner"></div>
    <br>
    <p>Memuat...</p>
</div>

<div class="header">
    <i class="fa-solid fa-arrow-left" id="backIcon" style="cursor:pointer;" onclick="window.location='/dashboard'"></i>
    <h1>Etalase Obat</h1>
    <div class="ikonKanan">
    <i class="fa-solid fa-cart-plus" onclick="window.location='/keranjang'"></i>
    <i class="fas fa-home" style="cursor:pointer;" onclick="window.location='/dashboard'"></i>
    </div>
</div>

<div class="cards-scroll">
<div class="cards-container">
    <!-- Kategori 1 -->
    <div class="custom-card" style="cursor:pointer;" onclick="window.location='/obat?id=1'">
        <div class="icon-container">
            <img src="https://storage.googleapis.com/rxstorage/Category/Icons/29---obat-intravena.png" alt="Obat Intervensi dan Larutan Steril" />
        </div>
        <div class="card-title">Obat Intervensi dan Larutan Steril</div>
    </div>
    <!-- Kategori 2 -->
    <div class="custom-card" style="cursor:pointer;" onclick="window.location='/obat?id=2'">
        <div class="icon-container">
            <img src="https://storage.googleapis.com/rxstorage/Category/Icons/02%20-%20Obat%20Resep/01%20-%20Diabetes.png" alt="Diabetes" />
        </div>
        <div class="card-title">Diabetes</div>
    </div>
    <!-- Kategori 3 -->
    <div class="custom-card" style="cursor:pointer;" onclick="window.location='/obat?id=3'">
        <div class="icon-container">
            <img src="https://storage.googleapis.com/rxstorage/Category/Icons/02%20-%20Obat%20Resep/02%20-%20Darah%20Tinggi.png" alt="Darah Tinggi" />
        </div>
        <div class="card-title">Darah Tinggi</div>
    </div>
    <!-- Kategori 4 -->
    <div class="custom-card" style="cursor:pointer;" onclick="window.location='/obat?id=4'">
        <div class="icon-container">
            <img src="https://storage.googleapis.com/rxstorage/Category/Icons/02%20-%20Obat%20Resep/03%20-%20Kolesterol.png" alt="Kolestrol" />
        </div>
        <div class="card-title">Kolestrol</div>
    </div>
    <!-- Kategori 5 -->
    <div class="custom-card" style="cursor:pointer;" onclick="window.location='/obat?id=5'">
        <div class="icon-container">
            <img src="https://storage.googleapis.com/rxstorage/Category/Icons/02%20-%20Obat%20Resep/04%20-%20Jantung.png" alt="Jantung" />
        </div>
        <div class="card-title">Jantung</div>
    </div>
    <!-- Kategori 6 -->
    <div class="custom-card" style="cursor:pointer;" onclick="window.location='/obat?id=6'">
        <div class="icon-container">
            <img src="https://storage.googleapis.com/rxstorage/Category/Icons/02%20-%20Obat%20Resep/05%20-%20Asam%20Urat.png" alt="Asam Urat" />
        </div>
        <div class="card-title">Asam Urat</div>
    </div>
    <!-- Kategori 7 -->
    <div class="custom-card" style="cursor:pointer;" onclick="window.location='/obat?id=7'">
        <div class="icon-container">
            <img src="https://storage.googleapis.com/rxstorage/Category/Icons/02%20-%20Obat%20Resep/06%20-%20Disfungsi%20Ereksi.png" alt="Disfungsi Ereksi" />
        </div>
        <div class="card-title">Disfungsi Ereksi</div>
    </div>
    <!-- Kategori 8 -->
    <div class="custom-card" style="cursor:pointer;" onclick="window.location='/obat?id=8'">
        <div class="icon-container">
            <img src="https://storage.googleapis.com/rxstorage/Category/Icons/02%20-%20Obat%20Resep/07%20-%20Flu%20_%20Demam.png" alt="Flu, Pusing dan Demam" />
        </div>
        <div class="card-title">Flu, Pusing dan Demam</div>
    </div>
    <!-- Kategori 9 -->
    <div class="custom-card" style="cursor:pointer;" onclick="window.location='/obat?id=9'">
        <div class="icon-container">
            <img src="https://storage.googleapis.com/rxstorage/Category/Icons/02%20-%20Obat%20Resep/23%20-%20Anti%20Infeksi.png" alt="Anti Infeksi" />
        </div>
        <div class="card-title">Anti Infeksi</div>
    </div>
    <!-- Kategori 10 -->
    <div class="custom-card" style="cursor:pointer;" onclick="window.location='/obat?id=10'">
        <div class="icon-container">
            <img src="https://storage.googleapis.com/rxstorage/Category/Icons/02%20-%20Obat%20Resep/10%20-%20Alergi.png" alt="Alergi" />
        </div>
        <div class="card-title">Alergi</div>
    </div>
    <!-- Kategori 11 -->
    <div class="custom-card" style="cursor:pointer;" onclick="window.location='/obat?id=11'">
        <div class="icon-container">
            <img src="https://storage.googleapis.com/rxstorage/Category/Icons/02%20-%20Obat%20Resep/09%20-%20Pencernaan.png" alt="Gangguan Pencernaan" />
        </div>
        <div class="card-title">Gangguan Pencernaan</div>
    </div>
    <!-- Kategori 12 -->
    <div class="custom-card" style="cursor:pointer;" onclick="window.location='/obat?id=12'">
        <div class="icon-container">
            <img src="https://storage.googleapis.com/rxstorage/Category/Icons/02%20-%20Obat%20Resep/12%20-%20Mata.png" alt="Mata" />
        </div>
        <div class="card-title">Mata</div>
    </div>
</div>
</div>
<script src="{{ asset('js/loading.js') }}" defer></script>
</body>
</html>