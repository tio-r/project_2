function showLoading() {
    document.getElementById('loading').style.display = 'flex';
    document.getElementById('content').classList.add('hidden');
}

// Fungsi untuk menyembunyikan loading
function hideLoading() {
    document.getElementById('loading').style.display = 'none';
    document.getElementById('content').classList.remove('hidden');
}

// Tampilkan loading saat halaman pertama kali dimuat
window.addEventListener('load', function() {
    // Simulasikan loading selama 1 detik
    setTimeout(function() {
        hideLoading();
    }, 1500);
});


// Fallback: sembunyikan loading jika halaman terlalu lama
setTimeout(function() {
    hideLoading();
}, 3000);