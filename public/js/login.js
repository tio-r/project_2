// login.js

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
  
    const usernameError = document.getElementById('usernameError');
    const passwordError = document.getElementById('passwordError');
  
    form.addEventListener('submit', function(e) {
      e.preventDefault(); // Mencegah form submit default
  
      // Reset pesan error
      usernameError.textContent = '';
      passwordError.textContent = '';
  
      // Validasi sederhana
      let valid = true;
  
      if (usernameInput.value.trim() === '') {
        usernameError.textContent = 'Nama pengguna wajib diisi.';
        valid = false;
      }
  
      if (passwordInput.value.trim() === '') {
        passwordError.textContent = 'Kata sandi wajib diisi.';
        valid = false;
      }
  
      if (!valid) {
        return;
      }
  
      // Jika valid, kirim data ke server (misal via fetch)
      const data = {
        username: usernameInput.value.trim(),
        password: passwordInput.value.trim()
      };
  
      fetch('/api/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      })
      .then(response => response.json())
      .then(result => {
        if (result.success) {
          // Redirect ke halaman utama atau dashboard
          window.location.href = '/dashboard';
        } else {
          // Tampilkan pesan error dari server
          alert(result.message || 'Login gagal. Periksa kembali username dan password.');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan. Silakan coba lagi.');
      });
    });
  });