<?php
include "database.php";
if (isset($_POST['cari_pesan'])) {
    $sql = "SELECT * FROM messages WHERE message_text=?";
    $cari_isi_pesan = $_POST['cari_isi_pesan'];

    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $cari_isi_pesan);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo "<div class='flex-row text-normal py-2 sm:text-lg'>" . "<div class='border rounded-t-2xl rounded-br-xl'>" . "<div class='flex rounded-t-xl px-2 py-1 bg-white'>" . "<strong>" . $row['sender_name'] . ":</strong>" . "<p class='px-2'>" . $row['message_text'] . "</p>" . "</div class='rounded-br-2xl'>" . "<p class='flex justify-end bg-white px-2 rounded-br-2xl font-thin sm:font-extralight text-xs items-center'>" . $row['timestamp'] . "</p>" . "</div>" . "</div>";
    }
    $stmt->close();
}
$koneksi->close();

?>
