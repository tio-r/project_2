<!-- resources/views/detail.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Detail Obat</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
<link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
</head>
<body>
<!-- Loading overlay -->
<div id="loading" class="loading-overlay">
  <div class="loading-spinner"></div>
  <br>
  <p>Memuat...</p>
</div>

<div class="header">
  <i class="fa-solid fa-arrow-left" id="backIcon" onclick="window.location='/obat?id={{ $obat['category_id'] }}'"></i>
  <h1>{{ $obat['category_name'] ?? 'Detail Obat' }}</h1>
  <div class="ikonKanan">
    <i class="fa-solid fa-cart-plus" onclick="window.location='/keranjang'"></i>
    <i class="fas fa-home" onclick="window.location='/dashboard'"></i>
  </div>
</div>

<div class="container">
  <div class="product-image">
    <img src="{{ asset($obat['image']) }}" alt="{{ $obat['name'] }}" />
  </div>
  
  <div class="product-info">
    <br>
    <h2 class="product-name">{{ $obat['name'] }}</h2>
    <div class="price">Rp {{ number_format($obat['price'], 0, ',', '.') }}</div>
    
    <div class="product-meta">
      <span class="stock">Stok Tersedia {{ $obat['stock'] }}</span>
      <span class="sold">{{ $obat['terjual'] ?? '0' }} Terjual</span>
      <span class="rating">★ {{ $obat['rating'] ?? 'N/A' }}</span>
    </div>
  </div>
  <div class="divider"></div>

  <div class="product-details">
    <h3>Informasi Produk</h3>
    <div class="detail-item">
      <span class="detail-label">Kategori</span>
      <span class="detail-value">{{ $obat['category_name'] ?? 'Tidak tersedia' }}</span>
    </div>
    <div class="detail-item">
      <span class="detail-label">Golongan</span>
      <span class="detail-value">{{ $obat['golongan'] ?? 'Tidak tersedia' }}</span>
    </div>
    <div class="detail-item">
      <span class="detail-label">Bentuk Sediaan</span>
      <span class="detail-value">{{ $obat['bentuk_sediaan'] ?? 'Tidak tersedia' }}</span>
    </div>
    <div class="detail-item">
      <span class="detail-label">Kemasan</span>
      <span class="detail-value">{{ $obat['kemasan'] ?? 'Tidak tersedia' }}</span>
    </div>
    <div class="detail-item">
      <span class="detail-label">Batas Pengiriman</span>
      <span class="detail-value">{{ $obat['batas_pengiriman'] ?? 'Tidak tersedia' }}</span>
    </div>
  </div>

  <div class="divider"></div>

  <div class="buttons">
    <button class="btn btn-konsultasi" onclick="window.location='/chat'">
      <i class="fas fa-comment-dots"></i> Konsultasi Apoteker
    </button>
    <button class="btn btn-tambah" onclick="addToCart({{ $obat['id'] }})">
      <i class="fas fa-plus"></i> Tambah Keranjang
    </button>
  </div>
</div>

<script>
  function addToCart(obatId) {
      fetch('/add-to-cart', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
              obat_id: obatId,
              quantity: 1
          })
      }).then(response => {
          if (response.ok) {
              // Tampilkan konfirmasi sebelum redirect
              if (confirm('Produk berhasil ditambahkan ke keranjang! Lihat keranjang?')) {
                  window.location.href = '/keranjang';
              }
          } else {
              alert('Gagal menambahkan produk ke keranjang');
          }
      }).catch(error => {
          console.error('Error:', error);
          alert('Terjadi kesalahan saat menambahkan ke keranjang');
      });
  }
  </script>
  <script src="{{ asset('js/loading.js') }}" defer></script>
</body>
</html>