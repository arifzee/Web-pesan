<?php
include "database.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender_name = $_SESSION['username'];
    $message_text = $_POST['sqlQueryKirim'];

    $query = "INSERT INTO messages (sender_name, message_text) VALUES (?, ?)";
    $stmt = $koneksi->prepare($query);

    // Memeriksa apakah prepare berhasil
    if ($stmt) {
        $stmt->bind_param("ss", $sender_name, $message_text);
        $stmt->execute();

        $stmt->close();
    } else {
        echo "Gagal menyiapkan pernyataan SQL.";
        error_log("Error in preparing SQL statement: " . $koneksi->error, 0); // Log pesan kesalahan
    }
}

$koneksi->close();
?>
