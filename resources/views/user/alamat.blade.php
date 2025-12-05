<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Alamat Pengiriman</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/alamat.css') }}" />
</head>
<body>

    <div class="header">
        <i class="fa-solid fa-arrow-left" id="backIcon" onclick="window.location='/keranjang'"></i>
        <h1>Alamat Pengiriman</h1>
        <div class="ikonKanan">
            <i class="fas fa-home" onclick="window.location='/dashboard'"></i>
        </div>
    </div>
    
    <div class="container">
        <!-- Search Bar -->
        <div class="search-section">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Cari alamat, tempat, atau lokasi...">
                <button class="btn-current-location" onclick="getCurrentLocation()" title="Gunakan lokasi saat ini">
                    <i class="fas fa-crosshairs"></i>
                </button>
            </div>
        </div>
    
        <!-- Map Container -->
        <div class="map-container">
            <div id="map">
                <div class="map-placeholder">
                    <i class="fas fa-map-marked-alt"></i>
                    <p>Memuat peta...</p>
                    <small>Sedang memuat Google Maps</small>
                </div>
            </div>
            <div class="map-marker">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="map-overlay">
                <div class="map-instruction">
                    <i class="fas fa-hand-pointer"></i>
                    Klik atau geser peta untuk memilih lokasi
                </div>
            </div>
        </div>
    
        <!-- Selected Location Details -->
        <div class="selected-location">
            <div class="location-header">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Lokasi yang Dipilih</h3>
            </div>
            
            <div class="location-details">
                <div class="location-street" id="selectedStreet">Pilih lokasi pada peta</div>
                <div class="location-full" id="selectedFullAddress">Klik peta untuk memilih alamat pengiriman</div>
                <div class="location-coordinates" id="selectedCoordinates"></div>
            </div>
    
            <div class="location-actions">
                <button class="btn-use-location" onclick="gunakanLokasiTerpilih()" id="btnUseLocation" disabled>
                    <i class="fas fa-check-circle"></i> Gunakan Lokasi Ini
                </button>
                <button class="btn-clear-location" onclick="clearSelectedLocation()">
                    <i class="fas fa-times"></i> Hapus
                </button>
            </div>
        </div>
    
        <!-- Current Location -->
        <div class="current-location">
            <div class="location-header">
                <i class="fas fa-crosshairs"></i>
                <h3>Lokasi Saya Saat Ini</h3>
            </div>
            
            <div class="location-details">
                <div class="location-street" id="currentStreet">Menunggu deteksi lokasi...</div>
                <div class="location-full" id="currentFullAddress">Tekan tombol target untuk mendeteksi lokasi GPS</div>
            </div>
    
            <button class="btn-use-current-location" onclick="gunakanLokasiSaatIni()" id="btnUseCurrent" disabled>
                <i class="fas fa-location-arrow"></i> Gunakan Lokasi Saat Ini
            </button>
        </div>
    
        <!-- Tombol Tambah Alamat -->
        <div class="add-address-section">
            <button class="btn-add-new-address" onclick="tambahAlamatBaru()">
                <i class="fas fa-plus-circle"></i> Simpan Alamat Ini
            </button>
        </div>
    </div>
    
    <script>
        // Variabel global
        let map;
        let geocoder;
        let selectedMarker;
        let currentLocationMarker;
        let selectedLatLng = null;
    
        // Load Google Maps dengan error handling yang lebih baik
        function loadGoogleMaps() {
            const apiKey = '{{ env("GOOGLE_MAPS_API_KEY", "AIzaSyBYykX2ZvBwKWG_X5TmKIiyJta6cQiT_iQ") }}';
            
            console.log('Loading Google Maps with API Key:', apiKey ? 'Key exists' : 'No key');
            
            if (!apiKey || apiKey === '' || apiKey === 'AIzaSyBYykX2ZvBwKWG_X5TmKIiyJta6cQiT_iQ') {
                showApiKeyError();
                return;
            }
            
            const script = document.createElement('script');
            script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}&libraries=places&callback=initMap`;
            script.async = true;
            script.defer = true;
            script.onerror = function() {
                console.error('Failed to load Google Maps API');
                showDetailedMapError();
            };
            document.head.appendChild(script);
        }
        
        function initMap() {
            try {
                console.log('Initializing Google Maps...');
                
                // Default location (Jakarta)
                const defaultLocation = { lat: -6.2088, lng: 106.8456 };
                
                // Buat peta
                map = new google.maps.Map(document.getElementById('map'), {
                    center: defaultLocation,
                    zoom: 12,
                    mapTypeControl: false,
                    streetViewControl: false,
                    fullscreenControl: true,
                    zoomControl: true,
                    gestureHandling: 'greedy'
                });
    
                // Inisialisasi geocoder
                geocoder = new google.maps.Geocoder();
                
                // Setup event listener untuk klik peta
                map.addListener('click', function(event) {
                    selectLocation(event.latLng);
                });
    
                // Setup autocomplete
                initAutocomplete();
                
                console.log('Google Maps loaded successfully');
                
            } catch (error) {
                console.error('Error initializing Google Maps:', error);
                showDetailedMapError();
            }
        }
    
        function initAutocomplete() {
            try {
                const input = document.getElementById('searchInput');
                const searchBox = new google.maps.places.SearchBox(input);
                
                map.addListener('bounds_changed', function() {
                    searchBox.setBounds(map.getBounds());
                });
                
                searchBox.addListener('places_changed', function() {
                    const places = searchBox.getPlaces();
                    if (places.length === 0) return;
                    
                    const place = places[0];
                    if (!place.geometry) return;
                    
                    // Pindah peta ke lokasi yang dicari
                    map.setCenter(place.geometry.location);
                    map.setZoom(16);
                    
                    // Pilih lokasi tersebut
                    selectLocation(place.geometry.location, place.formatted_address);
                });
            } catch (error) {
                console.error('Error initializing autocomplete:', error);
            }
        }
    
        function selectLocation(latLng, formattedAddress = null) {
            selectedLatLng = latLng;
            
            // Hapus marker sebelumnya jika ada
            if (selectedMarker) {
                selectedMarker.setMap(null);
            }
            
            // Buat marker baru
            selectedMarker = new google.maps.Marker({
                position: latLng,
                map: map,
                animation: google.maps.Animation.DROP,
                title: 'Lokasi Terpilih'
            });
            
            // Dapatkan alamat dari koordinat
            geocoder.geocode({ location: latLng }, function(results, status) {
                if (status === 'OK' && results[0]) {
                    updateSelectedLocation(results[0], latLng);
                } else {
                    console.error('Geocode failed:', status);
                    updateSelectedLocationWithCoords(latLng);
                }
            });
            
            // Enable tombol gunakan lokasi
            document.getElementById('btnUseLocation').disabled = false;
        }
    
        function updateSelectedLocation(place, latLng) {
            const street = document.getElementById('selectedStreet');
            const fullAddress = document.getElementById('selectedFullAddress');
            const coordinates = document.getElementById('selectedCoordinates');
            
            street.textContent = place.formatted_address.split(',')[0];
            fullAddress.textContent = place.formatted_address;
            coordinates.textContent = `Lat: ${latLng.lat().toFixed(6)}, Lng: ${latLng.lng().toFixed(6)}`;
        }
    
        function updateSelectedLocationWithCoords(latLng) {
            const street = document.getElementById('selectedStreet');
            const fullAddress = document.getElementById('selectedFullAddress');
            const coordinates = document.getElementById('selectedCoordinates');
            
            street.textContent = 'Lokasi dipilih';
            fullAddress.textContent = 'Alamat detail tidak tersedia';
            coordinates.textContent = `Lat: ${latLng.lat().toFixed(6)}, Lng: ${latLng.lng().toFixed(6)}`;
        }
    
        function getCurrentLocation() {
            const currentStreet = document.getElementById('currentStreet');
            const currentFullAddress = document.getElementById('currentFullAddress');
            const btnUseCurrent = document.getElementById('btnUseCurrent');
            
            // Tampilkan loading
            currentStreet.innerHTML = '<span class="loading"></span> Mendeteksi lokasi...';
            currentFullAddress.textContent = 'Sedang mengambil data GPS...';
            
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        
                        // Update current location display
                        if (geocoder) {
                            geocoder.geocode({ location: pos }, function(results, status) {
                                if (status === 'OK' && results[0]) {
                                    currentStreet.textContent = results[0].formatted_address.split(',')[0];
                                    currentFullAddress.textContent = results[0].formatted_address;
                                } else {
                                    currentStreet.textContent = 'Lokasi saat ini';
                                    currentFullAddress.textContent = `Koordinat: ${pos.lat.toFixed(6)}, ${pos.lng.toFixed(6)}`;
                                }
                                btnUseCurrent.disabled = false;
                            });
                        } else {
                            currentStreet.textContent = 'Lokasi saat ini';
                            currentFullAddress.textContent = `Koordinat: ${pos.lat.toFixed(6)}, ${pos.lng.toFixed(6)}`;
                            btnUseCurrent.disabled = false;
                        }
                        
                        // Tambahkan marker lokasi saat ini
                        if (currentLocationMarker) {
                            currentLocationMarker.setMap(null);
                        }
                        
                        if (map) {
                            currentLocationMarker = new google.maps.Marker({
                                position: pos,
                                map: map,
                                title: 'Lokasi Anda Saat Ini'
                            });
                            
                            // Pindah peta ke lokasi saat ini
                            map.setCenter(pos);
                            map.setZoom(16);
                        }
                        
                    },
                    function(error) {
                        console.error('Error getting current location:', error);
                        currentStreet.textContent = 'Gagal mendeteksi lokasi';
                        currentFullAddress.textContent = 'Pastikan GPS diaktifkan dan izin lokasi diberikan';
                        btnUseCurrent.disabled = true;
                        
                        let errorMessage = 'Tidak dapat mendapatkan lokasi saat ini. ';
                        switch(error.code) {
                            case error.PERMISSION_DENIED:
                                errorMessage += 'Izin lokasi ditolak.';
                                break;
                            case error.POSITION_UNAVAILABLE:
                                errorMessage += 'Informasi lokasi tidak tersedia.';
                                break;
                            case error.TIMEOUT:
                                errorMessage += 'Permintaan lokasi timeout.';
                                break;
                            default:
                                errorMessage += 'Error tidak diketahui.';
                        }
                        alert(errorMessage);
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 60000
                    }
                );
            } else {
                currentStreet.textContent = 'Browser tidak mendukung';
                currentFullAddress.textContent = 'Browser Anda tidak mendukung geolocation API';
                alert('Browser tidak mendukung geolocation.');
            }
        }
    
        function gunakanLokasiTerpilih() {
            const street = document.getElementById('selectedStreet').textContent;
            const fullAddress = document.getElementById('selectedFullAddress').textContent;
            
            if (street === 'Pilih lokasi pada peta' || !selectedLatLng) {
                alert('Silakan pilih lokasi terlebih dahulu pada peta.');
                return;
            }
            
            // Kirim data ke server
            fetch('/alamat/simpan-peta', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    latitude: selectedLatLng.lat(),
                    longitude: selectedLatLng.lng(),
                    alamat: fullAddress,
                    jalan: street
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Lokasi berhasil dipilih: ' + street);
                    window.location.href = '/keranjang';
                } else {
                    alert('Gagal menyimpan lokasi');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan lokasi');
            });
        }
    
        function gunakanLokasiSaatIni() {
            const street = document.getElementById('currentStreet').textContent;
            const fullAddress = document.getElementById('currentFullAddress').textContent;
            
            if (street === 'Menunggu deteksi lokasi...' || street.includes('Mendeteksi')) {
                alert('Silakan deteksi lokasi terlebih dahulu.');
                return;
            }
            
            // Kirim data ke server
            fetch('/alamat/gunakan-lokasi', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    jalan: street,
                    detail: fullAddress
                })
            })
            .then(response => {
                if (response.ok) {
                    window.location.href = '/keranjang';
                } else {
                    alert('Gagal menggunakan lokasi saat ini');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menggunakan lokasi');
            });
        }
    
        function clearSelectedLocation() {
            if (selectedMarker) {
                selectedMarker.setMap(null);
                selectedMarker = null;
            }
            
            selectedLatLng = null;
            
            document.getElementById('selectedStreet').textContent = 'Pilih lokasi pada peta';
            document.getElementById('selectedFullAddress').textContent = 'Klik peta untuk memilih alamat pengiriman';
            document.getElementById('selectedCoordinates').textContent = '';
            document.getElementById('btnUseLocation').disabled = true;
        }
    
        function tambahAlamatBaru() {
            const street = document.getElementById('selectedStreet').textContent;
            const fullAddress = document.getElementById('selectedFullAddress').textContent;
            
            if (street === 'Pilih lokasi pada peta' || !selectedLatLng) {
                alert('Silakan pilih lokasi terlebih dahulu pada peta.');
                return;
            }
            
            // Simpan data sementara dan redirect ke form tambah alamat
            sessionStorage.setItem('newAddressData', JSON.stringify({
                jalan: street,
                detail: fullAddress,
                latitude: selectedLatLng.lat(),
                longitude: selectedLatLng.lng()
            }));
            
            window.location.href = '/alamat/tambah';
        }
    
        function showApiKeyError() {
            document.getElementById('map').innerHTML = `
                <div class="map-placeholder error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h4>API Key Google Maps Tidak Valid</h4>
                    <p>API Key yang digunakan adalah default key atau tidak valid.</p>
                    <p>Silakan buat API Key baru di <a href="https://console.cloud.google.com/" target="_blank">Google Cloud Console</a></p>
                    <p>Pastikan untuk mengaktifkan:</p>
                    <ul>
                        <li>Maps JavaScript API</li>
                        <li>Geocoding API</li>
                        <li>Places API</li>
                    </ul>
                </div>
            `;
        }
    
        function showDetailedMapError() {
            document.getElementById('map').innerHTML = `
                <div class="map-placeholder error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h4>Google Maps Gagal Dimuat</h4>
                    <p>Pastikan:</p>
                    <ol>
                        <li>API Key valid dan aktif</li>
                        <li>Maps JavaScript API sudah diaktifkan</li>
                        <li>Koneksi internet stabil</li>
                    </ol>
                    <button onclick="location.reload()" class="btn-retry">
                        <i class="fas fa-redo"></i> Coba Muat Ulang
                    </button>
                </div>
            `;
        }
    
        // Load Google Maps ketika halaman siap
        document.addEventListener('DOMContentLoaded', function() {
            loadGoogleMaps();
        });
    </script>
    </body>
    </html>