$(document).ready(function() {
    function loadMessages() {
        $.get("{{ route('chat.load') }}", function(data) {
            $('#messages').empty();
            let lastDate = '';
            data.forEach(function(msg) {
                const messageDate = new Date(msg.waktu).toLocaleDateString();
                if (messageDate !== lastDate) {
                    $('#messages').append('<div class="date-label">' + messageDate + '</div>');
                    lastDate = messageDate;
                }
                if (msg.id_user === {{ auth()->user()->id_user }}) {
                    // Pesan dari user
                    $('#messages').append('<div class="message-user">' + msg.pesan + '</div>');
                } else {
                    // Pesan dari apoteker
                    $('#messages').append('<div class="message-apoteker">' + msg.pesan + '</div>');
                }
            });
            $('#chatBox').scrollTop($('#chatBox')[0].scrollHeight);
        });
    }

    $('#chatForm').submit(function(e) {
        e.preventDefault();
        var pesan = $('#pesan').val();
        $.post("{{ route('chat.send') }}", {
            pesan: pesan,
            _token: '{{ csrf_token() }}'
        }, function(data) {
            if(data.success) {
                $('#pesan').val('');
                loadMessages();
            }
        });
    });

    // Auto reload
    setInterval(loadMessages, 3000);
    loadMessages();
});