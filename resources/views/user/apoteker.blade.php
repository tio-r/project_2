<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Apoteker</title>
<link rel="stylesheet" href="{{ asset('css/chat.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>

<div class="header">
    <i class="fa-solid fa-arrow-left" id="backIcon" style="cursor:pointer; font-size:24px; margin-right:10px;"></i>
    <h1>Chat User</h1>
</div>

<div class="apoteker-chat">
    <div class="user-list">
        <h3>Daftar User</h3>
        <ul id="user-list">
            @foreach($users as $u)
                <li data-id="{{ $u->id_user }}" data-name="{{ $u->nama_user }}">{{ $u->nama_user }}</li>
            @endforeach
        </ul>
    </div>

    <div class="chat-area">
        <div id="chat-box" class="chat-box"></div>
        <div class="input-area">
            <input type="text" id="message-input" placeholder="ketik pesan...">
            <button id="send-btn">Kirim</button>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script>
const id_apoteker = {{ $id_apoteker }};
const nama_apoteker = "{{ $nama_apoteker }}";
let activeUser = null;
let activeUserName = null;

document.querySelectorAll('#user-list li').forEach(li => {
    li.addEventListener('click', () => {
        activeUser = li.dataset.id;
        activeUserName = li.dataset.name;
        document.getElementById('chat-box').innerHTML = '';
    });
});

// Listen ke semua user channel
@foreach($users as $u)
Echo.private(`chat.${$id_apoteker}.${$u->id_user}`)
    .listen('MessageSent', (e) => {
        if (e.chat.id_user == activeUser) {
            const chatBox = document.getElementById('chat-box');
            const msg = document.createElement('div');
            msg.className = 'message user';
            msg.innerHTML = `<div>${e.chat.pesan}</div><div class="time">${e.chat.waktu}</div>`;
            chatBox.appendChild(msg);
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    });
@endforeach

function sendMessage() {
    const input = document.getElementById('message-input');
    if (!activeUser) return alert("Pilih user dulu!");
    if (input.value.trim() === '') return;

    fetch("{{ route('chat.send') }}", {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            id_user: activeUser,
            nama_user: activeUserName,
            id_apoteker, nama_apoteker,
            pesan: input.value
        })
    });

    const chatBox = document.getElementById('chat-box');
    const msg = document.createElement('div');
    msg.className = 'message apoteker';
    msg.innerHTML = `<div>${input.value}</div><div class="time">${new Date().toLocaleTimeString()}</div>`;
    chatBox.appendChild(msg);
    chatBox.scrollTop = chatBox.scrollHeight;
    input.value = '';
}

document.getElementById('send-btn').onclick = sendMessage;
</script>

</body>
</html>