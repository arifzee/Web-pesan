<?php
session_start();
// Koneksi ke database dan ambil pesan terbaru
include "database.php";
$sesi = $_SESSION['username'];
$sql = "SELECT * FROM messages ORDER BY timestamp ASC";
$koneksi_db = $koneksi->query($sql);


while ($row = $koneksi_db->fetch_assoc()) {
  $id = $row['id'];
  $pengirim = $row['sender_name'];
  $pesan = $row['message_text'];
  $time_send = $row['timestamp'];
  $hapus_button = $row['hapus_button'];

  include "template_pesan.php";
}




$koneksi->close();
