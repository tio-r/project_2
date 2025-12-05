<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Obat</title>
<link rel="stylesheet" href="{{ asset('css/obat.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>

    <div class="header">
        <i class="fa-solid fa-arrow-left" id="backIcon" style="cursor:pointer;" onclick="window.location='/etalase-obat'"></i>
        <h1>{{ $categoryName }}</h1>
        <div class="ikonKanan">
            <i class="fa-solid fa-cart-plus" onclick="window.location='/keranjang'"></i>
            <i class="fas fa-home" style="cursor:pointer;" onclick="window.location='/dashboard'"></i>
        </div>
    </div>
    
    <div class="obat-list">
        @if(count($obats) >= 12)
            <div class="cards-grid">
                @for($i = 0; $i < 12; $i++)
                    @php
                        $obat = $obats[$i];
                    @endphp
                    <div class="card" onclick="window.location='/detail?id={{ $obat['id'] }}'" style="cursor:pointer;">
                        <div class="card-image">
                            <img src="{{ asset($obat['image']) }}" alt="{{ $obat['name'] }}">
                        </div>
                        <div class="card-content">
                            <h4 class="obat-name">{{ $obat['name'] }}</h4>
                            <p class="price">Rp {{ number_format($obat['price'], 0, ',', '.') }}</p>
                            <p class="rating">
                                <i class="fa-solid fa-star"></i> {{ $obat['rating'] ?? 'N/A' }} 
                                | Stok : {{ $obat['stock'] ?? '0' }}
                            </p>
                        </div>
                    </div>
                @endfor
            </div>
        @else
            <p>Obat untuk kategori ini belum tersedia.</p>
        @endif
    </div>

</body>
</html>