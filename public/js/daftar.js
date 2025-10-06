document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    
    // Validasi form saat submit
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Reset pesan error sebelumnya
        clearErrorMessages();
        
        // Validasi setiap field
        const isValid = validateForm();
        
        if (isValid) {
            // Jika valid, kirim data (simulasi)
            submitForm();
        }
    });
    
    // Validasi real-time untuk setiap field
    const inputs = form.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });
        
        input.addEventListener('input', function() {
            // Hapus pesan error saat user mulai mengetik
            const errorElement = document.getElementById(this.id + 'Error');
            if (errorElement) {
                errorElement.textContent = '';
            }
        });
    });
    
    function validateForm() {
        let isValid = true;
        
        // Validasi setiap field
        isValid = validateField(document.getElementById('username')) && isValid;
        isValid = validateField(document.getElementById('email')) && isValid;
        isValid = validateField(document.getElementById('phone')) && isValid;
        isValid = validateField(document.getElementById('password')) && isValid;
        isValid = validateField(document.getElementById('confirmPassword')) && isValid;
        
        return isValid;
    }
    
    function validateField(field) {
        const value = field.value.trim();
        const errorElement = document.getElementById(field.id + 'Error');
        let isValid = true;
        let errorMessage = '';
        
        switch(field.id) {
            case 'username':
                if (value === '') {
                    errorMessage = 'Nama pengguna harus diisi';
                    isValid = false;
                } else if (value.length < 3) {
                    errorMessage = 'Nama pengguna minimal 3 karakter';
                    isValid = false;
                }
                break;
                
            case 'email':
                if (value === '') {
                    errorMessage = 'Email harus diisi';
                    isValid = false;
                } else if (!isValidEmail(value)) {
                    errorMessage = 'Format email tidak valid';
                    isValid = false;
                }
                break;
                
            case 'phone':
                if (value === '') {
                    errorMessage = 'Nomor telepon harus diisi';
                    isValid = false;
                } else if (!isValidPhone(value)) {
                    errorMessage = 'Format nomor telepon tidak valid';
                    isValid = false;
                }
                break;
                
            case 'password':
                if (value === '') {
                    errorMessage = 'Kata sandi harus diisi';
                    isValid = false;
                } else if (value.length < 6) {
                    errorMessage = 'Kata sandi minimal 6 karakter';
                    isValid = false;
                }
                break;
                
            case 'confirmPassword':
                const password = document.getElementById('password').value;
                if (value === '') {
                    errorMessage = 'Konfirmasi kata sandi harus diisi';
                    isValid = false;
                } else if (value !== password) {
                    errorMessage = 'Konfirmasi kata sandi tidak cocok';
                    isValid = false;
                }
                break;
        }
        
        if (errorMessage) {
            errorElement.textContent = errorMessage;
            field.style.borderColor = '#e74c3c';
        } else {
            field.style.borderColor = '#2ecc71';
        }
        
        return isValid;
    }
    
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function isValidPhone(phone) {
        // Validasi nomor telepon (minimal 10 digit, hanya angka)
        const phoneRegex = /^[0-9]{10,}$/;
        return phoneRegex.test(phone.replace(/\D/g, ''));
    }
    
    function clearErrorMessages() {
        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(error => {
            error.textContent = '';
        });
        
        const inputs = form.querySelectorAll('input');
        inputs.forEach(input => {
            input.style.borderColor = '#ddd';
        });
    }
    
    function submitForm() {
        // Simulasi pengiriman data
        const submitBtn = document.querySelector('.submit-btn');
        const originalText = submitBtn.textContent;
        
        // Tampilkan loading state
        submitBtn.textContent = 'Mendaftar...';
        submitBtn.disabled = true;
        
        // Simulasi request API
        setTimeout(() => {
            // Reset button state
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
            
            // Tampilkan pesan sukses (bisa diganti dengan redirect)
            alert('Pendaftaran berhasil! Silakan login dengan akun Anda.');
            form.reset();
            
            // Reset border colors
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => {
                input.style.borderColor = '#ddd';
            });
        }, 1500);
    }
});