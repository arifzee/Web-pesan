<?php
include "database.php";
session_start();
if (isset($_SESSION['username']) && isset($_POST['hapus_akun'])) {
    $username = $_SESSION['username'];

    // Menggunakan prepared statement untuk mencegah SQL injection
    $sql = "DELETE FROM users WHERE username = ?";
    $stmt = $koneksi->prepare($sql);

    // Bind parameter
    $stmt->bind_param("s", $username);

    // Eksekusi query
    if ($stmt->execute()) {
        // Hapus sesi dan arahkan ke halaman login setelah menghapus akun
        session_destroy();
        header("location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $stmt->error;
    }

    // Tutup statement
    $stmt->close();
} else {
    // Tindakan jika kondisi tidak terpenuhi
    echo "Tidak dapat menghapus akun.";
}

// Tutup koneksi
$koneksi->close();
?>