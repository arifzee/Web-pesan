function scrollToBottom() {
    var scrollableDiv = document.getElementById('chatContainer');
    scrollableDiv.scrollTop = scrollableDiv.scrollHeight;
}
window.onload = function () {
    scrollToBottom();
};
// Fungsi untuk memperbarui pesan
function updateChat() {
    var chatContainer = document.getElementById('chatContainer');
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Sukses, update konten pesan
                var newData = xhr.responseText;
                chatContainer.innerHTML = newData;

                var isAtBottom = (chatContainer.scrollTop + chatContainer.clientHeight === chatContainer.scrollHeight);
                // Auto-scroll ke bawah
                if (isAtBottom) {
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                }
                chatContainer.scrollTop = chatContainer.scrollHeight;
            } else {
                // Handle kesalahan jika ada
                console.error('Gagal memperbarui pesan. Status: ' + xhr.status);
            }
        }
    };

    // Kirim permintaan ke server untuk mendapatkan pesan terbaru
    xhr.open('GET', 'get_messages.php', true);
    xhr.send();
}

// Fungsi untuk memperbarui pesan setiap 3 detik
setInterval(updateChat, 1000);

// Panggil fungsi untuk pertama kali
updateChat();