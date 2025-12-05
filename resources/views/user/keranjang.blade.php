<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Keranjang Pesanan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/keranjang.css') }}" />
</head>
<body>
<!-- Loading overlay -->
    <div id="loading" class="loading-overlay">
        <div class="loading-spinner"></div>
        <br>
        <p>Memuat...</p>
    </div>

<div class="header">
    <i class="fa-solid fa-arrow-left" id="backIcon" onclick="window.location='/etalase-obat'"></i>
    <h1>Keranjang Pesanan</h1>
    <div class="ikonKanan">
        <i class="fa-solid fa-cart-plus" onclick="window.location='/keranjang'"></i>
        <i class="fas fa-home" onclick="window.location='/dashboard'"></i>
    </div>
</div>

<div class="container">
    <!-- TAMPILKAN ALAMAT YANG TERSIMPAN -->
    @if($alamatTersimpan)
    <div class="saved-address">
        <div class="address-header">
            <i class="fas fa-map-marker-alt"></i>
            <h3>Alamat Pengiriman Tersimpan</h3>
            <button class="btn-change-address" onclick="window.location='/alamat'">
                <i class="fas fa-edit"></i> Ubah
            </button>
        </div>
        <div class="address-details">
            <p><strong>{{ $alamatTersimpan->nama_user }}</strong></p>
            <p>{{ $alamatTersimpan->alamat }}</p>
            @if($alamatTersimpan->alamat_lengkap)
                <p><small>{{ $alamatTersimpan->alamat_lengkap }}</small></p>
            @endif
            <p class="coordinates">
                <i class="fas fa-crosshairs"></i>
                {{ $alamatTersimpan->koordinat_lat }}, {{ $alamatTersimpan->koordinat_long }}
            </p>
        </div>
    </div>
    @else
    <!-- Alert Alamat (hanya tampil jika belum ada alamat tersimpan) -->
    <div class="address-alert">
        <div class="alert-content">
            <i class="fas fa-exclamation-circle"></i>
            <div class="alert-text">
                <p>Mohon lengkapi alamat pengiriman terlebih dahulu sebelum melakukan pembelian</p>
            </div>
        </div>
        <button class="btn-add-address" onclick="window.location='/alamat'">
            <i class="fas fa-plus"></i> Tambah Alamat Pengiriman
        </button>
    </div>
    @endif

    <!-- Pilih Semua -->
    <div class="select-all">
        <label class="checkbox-container">
            <input type="checkbox" id="selectAll">
            <span class="checkmark"></span>
            Pilih Semua
        </label>
    </div>
    
    <!-- Daftar Item Keranjang -->
    <div class="cart-items">
        @foreach($cartItems as $item)
        <div class="cart-item" data-item-id="{{ $item['id'] }}">
            <div class="item-header">
                <label class="checkbox-container">
                    <input type="checkbox" class="item-checkbox" data-price="{{ $item['price'] }}" data-quantity="{{ $item['quantity'] }}">
                    <span class="checkmark"></span>
                </label>
                
                <!-- Gambar Produk -->
                <div class="item-image">
                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" />
                </div>

                <div class="item-info">
                    <h3 class="item-name">{{ $item['name'] }}</h3>
                    <p class="item-stock">Stok Sisa {{ $item['stock'] }}</p>
                    
                    <!-- Harga dipindah ke sini (di bawah stok) -->
                    <div class="price-section">
                        <span class="current-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                        <span class="original-price">Rp {{ number_format($item['original_price'], 0, ',', '.') }}</span>
                        <span class="discount">{{ $item['discount'] }}%</span>
                    </div>
                </div>

                <!-- Quantity Control dipindah ke sini (tetap di kanan) -->
                <div class="quantity-control">
                    <button class="qty-btn minus" onclick="updateQuantity({{ $item['id'] }}, -1)">
                        <i class="fas fa-minus"></i>
                    </button>
                    <span class="quantity">{{ $item['quantity'] }}</span>
                    <button class="qty-btn plus" onclick="updateQuantity({{ $item['id'] }}, 1)">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>

            <!-- Catatan -->
            <div class="item-note">
                <div class="note-header">
                    <i class="fas fa-edit"></i>
                    <span>Tulis Catatan</span>
                </div>
                <textarea class="note-textarea" placeholder="Tambah catatan untuk produk ini..." 
                          onchange="updateNote({{ $item['id'] }}, this.value)">{{ $item['note'] }}</textarea>
            </div>

            <!-- Aksi Item -->
            <div class="item-actions">
                <button class="btn-delete" onclick="removeItem({{ $item['id'] }})">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </div>

            <div class="divider"></div>
        </div>
        @endforeach
    </div>

    <!-- Total dan Checkout -->
    <div class="checkout-section">
        <div class="checkout-left">
            <div class="total-label">Total Pemesanan</div>
            <div class="total-amount">Rp {{ number_format($total, 0, ',', '.') }}</div>
        </div>
        <div class="checkout-right">
            <button class="btn-checkout" onclick="checkout()" {{ !$alamatTersimpan ? 'disabled' : '' }}>
                Check out
                @if(!$alamatTersimpan)
                <small style="display: block; font-size: 10px; color: #ff6b6b;">Lengkapi alamat dulu</small>
                @endif
            </button>
        </div>
    </div>
</div>

<script>
// Fungsi untuk update quantity
function updateQuantity(itemId, change) {
    const quantityElement = document.querySelector(`.cart-item[data-item-id="${itemId}"] .quantity`);
    let quantity = parseInt(quantityElement.textContent);
    quantity += change;
    
    if (quantity < 1) quantity = 1;
    
    quantityElement.textContent = quantity;
    
    // Update dataset quantity untuk perhitungan total
    const checkbox = document.querySelector(`.cart-item[data-item-id="${itemId}"] .item-checkbox`);
    checkbox.dataset.quantity = quantity;
    
    // Update total harga
    updateTotal();
    
    // Kirim request ke server
    fetch('/update-cart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            item_id: itemId,
            quantity: quantity
        })
    });
}

// Fungsi untuk update catatan
function updateNote(itemId, note) {
    fetch('/update-note', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            item_id: itemId,
            note: note
        })
    });
}

// Fungsi untuk hapus item
function removeItem(itemId) {
    if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
        document.querySelector(`.cart-item[data-item-id="${itemId}"]`).remove();
        updateTotal();
        
        fetch('/remove-from-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                item_id: itemId
            })
        });
    }
}

// Fungsi untuk update total
function updateTotal() {
    let total = 0;
    document.querySelectorAll('.item-checkbox:checked').forEach(checkbox => {
        const price = parseInt(checkbox.dataset.price);
        const quantity = parseInt(checkbox.dataset.quantity);
        total += price * quantity;
    });
    
    document.querySelector('.total-amount').textContent = 'Rp ' + total.toLocaleString('id-ID');
}

// Fungsi checkout
function checkout() {
    const selectedItems = document.querySelectorAll('.item-checkbox:checked');
    if (selectedItems.length === 0) {
        alert('Pilih minimal satu produk untuk checkout');
        return;
    }
    
    // Cek apakah ada alamat tersimpan
    const hasAddress = document.querySelector('.saved-address') !== null;
    if (!hasAddress) {
        alert('Mohon lengkapi alamat pengiriman terlebih dahulu');
        window.location.href = '/alamat';
        return;
    }
    
    window.location.href = '/checkout';
}

// Select all functionality
document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.item-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    updateTotal();
});

// Update total ketika checkbox diubah
document.querySelectorAll('.item-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', updateTotal);
});

// Initialize total on load
document.addEventListener('DOMContentLoaded', function() {
    updateTotal();
});
</script>
<script src="{{ asset('js/loading.js') }}" defer></script>
</body>
</html>