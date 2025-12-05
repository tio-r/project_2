<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Chat Apoteker</title>
<link rel="stylesheet" href="{{ asset('css/chat.css') }}" />
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
    <i class="fa-solid fa-arrow-left" id="backIcon" style="cursor:pointer; font-size:24px; margin-right:10px;"></i>
    <h1>Chat Apoteker</h1>
</div>
<div class="profile">
    <img src="img/chat.png" alt="Apoteker"/>
    <div class="teks">Naura Farma Apoteker</div>
</div>

<div class="chat-box" id="chat-box">
    <div class="tanggal">
        <div class="teks">
            {{ \Carbon\Carbon::now()->format('d M Y') }}
        </div>
    </div>
    @foreach($messages as $msg)
    <div class="message-container {{ $msg['sender'] }}">
        <div class="message {{ $msg['sender'] }}">
            {{ $msg['message'] }}
            @if($msg['sender'] == 'user')
             <img src="img/read.svg" class="read-icon" alt="Read">
            @endif
        </div>
        <div class="time">{{ $msg['time'] }}</div>
    </div>
@endforeach
</div>

<div class="input-area">
    <div class="input-container">
        <input type="text" placeholder="ketik di sini" id="message-input"/>
        <i class="fas fa-paperclip icon-sisip" title="Sisipkan file" id="attach-btn"></i>
        <input type="file" id="file-input" accept="image/*,application/pdf" />
      </div>
    <button id="send-btn"><i class="fas fa-paper-plane"></i></button>
</div>

<script src="{{ asset('js/loading.js') }}" defer></script>
<script>
      document.getElementById("backIcon").addEventListener("click", () => {
         window.location.href = "/dashboard";
        });
    // Tambahkan fitur pengiriman pesan (optional)
    document.getElementById('send-btn').onclick = function() {
    var input = document.getElementById('message-input');
    if (input.value.trim() !== "") {
        var chatBox = document.getElementById('chat-box');

        // Mendapatkan waktu saat ini dalam format HH:MM
        var now = new Date();
        var hours = now.getHours().toString().padStart(2, '0');
        var minutes = now.getMinutes().toString().padStart(2, '0');
        var currentTime = hours + ':' + minutes;

        // Membuat elemen pesan baru
        var newMsg = document.createElement('div');
        newMsg.className = 'message-container user';

        // Isi pesan yang akan ditampilkan
        newMsg.innerHTML = `
            <div class="message user">
                ${input.value}
                <img src="img/read.svg" class="read-icon" alt="Read">
            </div>
            <div class="time">${currentTime}</div>
        `;

        chatBox.appendChild(newMsg);
        input.value = '';
        chatBox.scrollTop = chatBox.scrollHeight;
    }
    }

    const attachBtn = document.getElementById('attach-btn');
  const fileInput = document.getElementById('file-input');

  // Klik ikon akan membuka dialog file
  attachBtn.addEventListener('click', () => {
    fileInput.click();
  });

  // Setelah file dipilih
  fileInput.addEventListener('change', () => {
    const file = fileInput.files[0];
    if (file) {
      alert(`File yang dipilih: ${file.name}`);
      // Di sini bisa proses upload file jika diperlukan
    }
    // Reset input file agar bisa dipilih lagi jika ingin
    fileInput.value = '';
  });
</script>


</body>
</html>