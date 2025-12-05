<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Alamat</title>
    
    <!-- Leaflet CSS & JS (CDN) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <!-- Leaflet Geocoder (untuk search) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    
    <!-- Font Awesome untuk icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/alamat.css') }}" />
</head>
<body>
    <!-- Header dengan Search -->
    <div class="header">
                <i class="fa-solid fa-arrow-left" id="backIcon"></i>
                <h1>Alamat</h1>
            <div class="ikonKanan">
                <i class="fa-solid fa-cart-plus" onclick="window.location='/keranjang'"></i>
                <i class="fas fa-home" style="cursor:pointer;" onclick="window.location='/dashboard'"></i>
            </div>
    </div>

    <div class="search-container">
        <div class="search-box">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="searchInput" 
                   placeholder="Cari alamat, tempat, atau kota di Indonesia...">
        </div>
        <button class="search-btn" id="searchButton">
            <i class="fas fa-search"></i> Cari Lokasi
        </button>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="map-card-container">
            <!-- Map Card di Tengah -->
            <div class="map-card">
                <div id="map"></div>
                
                <!-- Map Controls -->
                <div class="map-controls">
                    <button class="control-btn" id="locateBtn" title="Lokasi Saya">
                        <i class="fas fa-location-crosshairs"></i>
                    </button>
                    <button class="control-btn" id="zoomInBtn" title="Zoom In">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button class="control-btn" id="zoomOutBtn" title="Zoom Out">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                
                <!-- Layer Control -->
                <div class="layer-control">
                    <button class="layer-btn active" data-layer="street">
                        <i class="fas fa-map"></i> Peta
                    </button>
                    <button class="layer-btn" data-layer="satellite">
                        <i class="fas fa-satellite"></i> Satelit
                    </button>
                </div>
            </div>
            
            <!-- Informasi Lokasi (di bawah card map) -->
            <div class="location-info-card">
                <div class="info-header">
                    <i class="fas fa-info-circle"></i>
                    <h2>Informasi Lokasi Terpilih</h2>
                </div>
                
                <div class="info-grid">
                    <!-- Koordinat Section -->
                    <div class="info-section">
                        <div class="info-title">
                            <i class="fas fa-crosshairs"></i>
                            <h3>Koordinat</h3>
                        </div>
                        <div class="coordinates-display">
                            <input type="text" id="latitude" class="coord-input" 
                                   placeholder="Latitude" readonly>
                            <input type="text" id="longitude" class="coord-input" 
                                   placeholder="Longitude" readonly>
                        </div>
                    </div>
                    
                    <!-- Alamat Section -->
                    <div class="info-section">
                        <div class="info-title">
                            <i class="fas fa-map-pin"></i>
                            <h3>Alamat Lengkap</h3>
                        </div>
                        <div class="address-display" id="selectedAddress">
                            <div style="text-align: center; padding: 30px; color: #7f8c8d;">
                                <i class="fas fa-hand-point-up" style="font-size: 40px; margin-bottom: 15px;"></i>
                                <p>Klik pada peta untuk memilih lokasi</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons (di bawah alamat lengkap) -->
                <div class="action-buttons">
                    <button class="primary-btn" id="saveBtn">
                        <i class="fas fa-save"></i> Simpan Alamat Ini
                    </button>
                    <button class="secondary-btn" id="resetBtn">
                        <i class="fas fa-redo"></i> Reset Pilihan
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Loading Overlay -->
    <div class="loading" id="loading">
        <div class="spinner"></div>
        <p>Memuat data...</p>
    </div>

    <script>
        // Inisialisasi variabel
        let map;
        let marker;
        let selectedLocation = null;
        let currentLayer = 'street';
        
        // Layer definitions
        const layers = {
            street: L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19
            }),
            satellite: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 19
            })
        };
        
        // Inisialisasi peta
        function initMap() {
            // Center ke Indonesia (Jakarta)
            map = L.map('map').setView([-6.2088, 106.8456], 10);
            
            // Tambahkan default layer (street)
            layers.street.addTo(map);
            currentLayer = 'street';
            
            // Setup layer control
            setupLayerControl();
            
            // Event klik pada peta
            map.on('click', onMapClick);
            
            // Setup control buttons
            setupControls();
            
            // Coba dapatkan lokasi user
            setTimeout(getUserLocation, 1000);
            
            // Tambahkan marker contoh
            addSampleMarkers();
        }
        
        // Setup layer control
        function setupLayerControl() {
            const layerButtons = document.querySelectorAll('.layer-btn');
            layerButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const layerType = this.dataset.layer;
                    
                    // Update active button
                    layerButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Switch layer
                    switchLayer(layerType);
                });
            });
        }
        
        // Switch between map layers
        function switchLayer(layerType) {
            if (layerType === currentLayer) return;
            
            // Remove current layer
            map.removeLayer(layers[currentLayer]);
            
            // Add new layer
            layers[layerType].addTo(map);
            currentLayer = layerType;
        }
        
        // Handle klik pada peta
        function onMapClick(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;
            
            updateSelectedLocation(lat, lng);
        }
        
        // Update lokasi yang dipilih
        function updateSelectedLocation(lat, lng) {
            // Update koordinat
            document.getElementById('latitude').value = lat.toFixed(6);
            document.getElementById('longitude').value = lng.toFixed(6);
            
            // Hapus marker lama
            if (marker) {
                map.removeLayer(marker);
            }
            
            // Tambahkan marker baru dengan icon custom
            marker = L.marker([lat, lng], {
                icon: L.divIcon({
                    className: 'custom-marker',
                    iconSize: [35, 35],
                    html: '<i class="fas fa-map-pin" style="color: white; font-size: 22px; margin-top: 6px;"></i>'
                })
            })
            .addTo(map)
            .bindPopup(`
                <div style="text-align: center; padding: 10px;">
                    <strong><i class="fas fa-map-pin"></i> Lokasi Dipilih</strong><br>
                    <small>Lat: ${lat.toFixed(6)}<br>Lng: ${lng.toFixed(6)}</small>
                </div>
            `)
            .openPopup();
            
            // Dapatkan alamat dari koordinat
            getAddressFromCoordinates(lat, lng);
            
            // Simpan data lokasi
            selectedLocation = {
                latitude: lat,
                longitude: lng,
                address: ''
            };
            
            // Zoom ke lokasi
            map.setView([lat, lng], 15);
        }
        
        // Dapatkan alamat dari koordinat menggunakan Nominatim
        function getAddressFromCoordinates(lat, lng) {
            showLoading(true);
            
            // Update status
            document.getElementById('selectedAddress').innerHTML = 
                '<div style="text-align: center; padding: 30px;"><i class="fas fa-spinner fa-spin fa-2x"></i><br><br>Mencari alamat...</div>';
            
            // Nominatim API (OpenStreetMap) - GRATIS
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1&accept-language=id`)
                .then(response => {
                    if (!response.ok) throw new Error('Network error');
                    return response.json();
                })
                .then(data => {
                    if (data && data.display_name) {
                        const address = formatAddress(data);
                        document.getElementById('selectedAddress').innerHTML = 
                            `<div style="margin-bottom: 15px;">
                                <strong style="color: #2c3e50; font-size: 18px;">
                                    <i class="fas fa-map-marker-alt"></i> ${address.place || 'Lokasi Terpilih'}
                                </strong>
                            </div>
                            <div style="margin-bottom: 20px; line-height: 1.7;">
                                ${address.full || data.display_name}
                            </div>
                            <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; font-size: 14px; color: #555;">
                                <i class="fas fa-globe"></i> 
                                <strong>Koordinat:</strong> ${lat.toFixed(6)}, ${lng.toFixed(6)}
                            </div>`;
                        
                        if (selectedLocation) {
                            selectedLocation.address = address.full || data.display_name;
                            selectedLocation.place = address.place;
                        }
                    } else {
                        document.getElementById('selectedAddress').innerHTML = 
                            `<div style="text-align: center; padding: 30px;">
                                <strong><i class="fas fa-globe fa-2x"></i></strong><br><br>
                                <strong>Koordinat:</strong><br>
                                ${lat.toFixed(6)}, ${lng.toFixed(6)}<br><br>
                                <small style="color: #7f8c8d;">Detail alamat tidak tersedia</small>
                            </div>`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('selectedAddress').innerHTML = 
                        `<div style="text-align: center; padding: 30px;">
                            <strong><i class="fas fa-exclamation-triangle fa-2x" style="color: #e74c3c;"></i></strong><br><br>
                            <strong>Koordinat:</strong> ${lat.toFixed(6)}, ${lng.toFixed(6)}<br><br>
                            <div style="color: #e74c3c; background: #fff5f5; padding: 12px; border-radius: 8px; font-size: 14px;">
                                <i class="fas fa-exclamation-circle"></i>
                                Gagal memuat detail alamat
                            </div>
                        </div>`;
                })
                .finally(() => {
                    showLoading(false);
                });
        }
        
        // Format alamat menjadi lebih rapi
        function formatAddress(data) {
            const address = data.address || {};
            let place = '';
            let full = data.display_name;
            
            // Coba buat nama tempat yang lebih singkat
            if (address.road && address.city) {
                place = `${address.road}, ${address.city}`;
            } else if (address.village && address.county) {
                place = `${address.village}, ${address.county}`;
            } else if (address.municipality) {
                place = address.municipality;
            } else if (address.state) {
                place = address.state;
            }
            
            return { place, full };
        }
        
        // Cari lokasi berdasarkan alamat
        function searchLocation(query) {
            if (!query.trim()) {
                alert('Masukkan alamat untuk dicari');
                return;
            }
            
            showLoading(true);
            document.getElementById('selectedAddress').innerHTML = 
                '<div style="text-align: center; padding: 30px;"><i class="fas fa-spinner fa-spin fa-2x"></i><br><br>Mencari lokasi...</div>';
            
            // Nominatim Search API
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=1&countrycodes=id&viewbox=95.0,-11.0,141.0,6.0&bounded=1`)
                .then(response => {
                    if (!response.ok) throw new Error('Network error');
                    return response.json();
                })
                .then(data => {
                    if (data && data.length > 0) {
                        const lat = parseFloat(data[0].lat);
                        const lng = parseFloat(data[0].lon);
                        
                        // Update lokasi
                        updateSelectedLocation(lat, lng);
                    } else {
                        showLoading(false);
                        alert('Lokasi tidak ditemukan. Coba dengan kata kunci lain.');
                        document.getElementById('selectedAddress').innerHTML = 
                            '<div style="text-align: center; padding: 30px;">' +
                            '<i class="fas fa-search fa-2x" style="color: #7f8c8d;"></i><br><br>' +
                            '<strong>Lokasi tidak ditemukan</strong><br>' +
                            '<small style="color: #7f8c8d;">Klik peta untuk memilih lokasi</small>' +
                            '</div>';
                    }
                })
                .catch(error => {
                    console.error('Search error:', error);
                    showLoading(false);
                    alert('Terjadi kesalahan saat pencarian. Coba lagi.');
                });
        }
        
        // Dapatkan lokasi user
        function getUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        
                        // Tambahkan marker lokasi user
                        L.marker([lat, lng], {
                            icon: L.divIcon({
                                className: 'user-location',
                                iconSize: [30, 30],
                                html: '<i class="fas fa-user" style="color: #3498db; font-size: 20px;"></i>'
                            })
                        })
                        .addTo(map)
                        .bindPopup('<strong><i class="fas fa-user"></i> Lokasi Anda Saat Ini</strong>')
                        .openPopup();
                        
                        // Zoom ke area sekitar user
                        map.setView([lat, lng], 13);
                    },
                    (error) => {
                        console.log('Geolocation tidak diizinkan atau error:', error);
                        // Tidak apa-apa, lanjut dengan default location
                    }
                );
            }
        }
        
        // Setup control buttons
        function setupControls() {
            // Locate button
            document.getElementById('locateBtn').addEventListener('click', getUserLocation);
            
            // Zoom in
            document.getElementById('zoomInBtn').addEventListener('click', () => {
                map.zoomIn();
            });
            
            // Zoom out
            document.getElementById('zoomOutBtn').addEventListener('click', () => {
                map.zoomOut();
            });
            
            // Search button
            document.getElementById('searchButton').addEventListener('click', () => {
                const query = document.getElementById('searchInput').value;
                searchLocation(query);
            });
            
            // Enter key in search
            document.getElementById('searchInput').addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    const query = document.getElementById('searchInput').value;
                    searchLocation(query);
                }
            });
            
            // Save button
            document.getElementById('saveBtn').addEventListener('click', saveLocation);
            
            // Reset button
            document.getElementById('resetBtn').addEventListener('click', resetSelection);
        }
        
        // Simpan lokasi ke server
        function saveLocation() {
            if (!selectedLocation) {
                alert('Silakan pilih lokasi terlebih dahulu dengan mengklik peta');
                return;
            }
            
            const addressText = document.getElementById('selectedAddress').textContent;
            
            showLoading(true);
            
            // Kirim data ke Laravel backend (contoh)
            fetch('{{ route("user.simpan") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    address: addressText,
                    latitude: selectedLocation.latitude,
                    longitude: selectedLocation.longitude,
                    place_name: selectedLocation.place || '',
                    current_location: 'Dipilih via OpenStreetMap',
                    map_layer: currentLayer
                })
            })
            .then(response => {
                if (!response.ok) throw new Error('Network error');
                return response.json();
            })
            .then(data => {
                showLoading(false);
                
                // Tampilkan notifikasi sukses
                alert('Alamat berhasil disimpan!\n\n' + 
                      `Lokasi: ${selectedLocation.place || 'Lokasi terpilih'}\n` +
                      `Koordinat: ${selectedLocation.latitude.toFixed(6)}, ${selectedLocation.longitude.toFixed(6)}`);
                
                console.log('Data tersimpan:', data);
            })
            .catch(error => {
                console.error('Save error:', error);
                showLoading(false);
                alert('Gagal menyimpan alamat. Periksa koneksi internet Anda.');
            });
        }
        
        // Reset pilihan
        function resetSelection() {
            if (marker) {
                map.removeLayer(marker);
                marker = null;
            }
            
            selectedLocation = null;
            
            document.getElementById('latitude').value = '';
            document.getElementById('longitude').value = '';
            document.getElementById('selectedAddress').innerHTML = 
                '<div style="text-align: center; padding: 30px; color: #7f8c8d;">' +
                '<i class="fas fa-hand-point-up" style="font-size: 40px; margin-bottom: 15px;"></i>' +
                '<p>Klik pada peta untuk memilih lokasi</p>' +
                '</div>';
            document.getElementById('searchInput').value = '';
            
            // Kembali ke view awal
            map.setView([-6.2088, 106.8456], 10);
        }
        
        // Tampilkan/sembunyikan loading
        function showLoading(show) {
            const loadingEl = document.getElementById('loading');
            loadingEl.style.display = show ? 'flex' : 'none';
        }
        
        // Tambahkan marker contoh
        function addSampleMarkers() {
            // Contoh: beberapa kota di Indonesia
            const cities = [
                { name: "Jakarta", lat: -6.2088, lng: 106.8456 },
                { name: "Surabaya", lat: -7.2575, lng: 112.7521 },
                { name: "Bandung", lat: -6.9175, lng: 107.6191 },
                { name: "Medan", lat: 3.5952, lng: 98.6722 },
                { name: "Makassar", lat: -5.1477, lng: 119.4327 }
            ];
            
            cities.forEach(city => {
                L.marker([city.lat, city.lng])
                    .addTo(map)
                    .bindPopup(`<strong><i class="fas fa-city"></i> ${city.name}</strong>`);
            });
        }
        
        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', initMap);
    </script>
</body>
</html>