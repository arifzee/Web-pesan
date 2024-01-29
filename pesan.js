
window.onload = function () {
    chatContainer.scrollTop = chatContainer.scrollHeight;
};
// Fungsi untuk memperbarui pesan
    function fetchData() {
        var xhr = new XMLHttpRequest();
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Tangkap data dari server
                var newData = xhr.responseText;
                var chatContainer = document.getElementById('chatContainer');

                // Tentukan apakah pengguna sedang berada di bagian bawah
                var isAtBottom = (chatContainer.scrollTop + chatContainer.clientHeight === chatContainer.scrollHeight);

                // Update konten di dalam dataContainer
                chatContainer.innerHTML = newData;

                // Jika pengguna sedang berada di bagian bawah, auto scroll ke bawah
                if (isAtBottom) {
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                }
            }
        };

        // Kirim permintaan AJAX ke server (contoh URL)
        xhr.open('GET', 'get_messages.php', true);
        xhr.send();
    }

    // Panggil fungsi fetchData secara periodik (setiap 3 detik)
    setInterval(fetchData, 6000);

    // Pertama kali, panggil fetchData untuk menampilkan data awal
    fetchData();