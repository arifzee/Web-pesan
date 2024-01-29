<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "buku_tamu";

$koneksi = mysqli_connect($hostname, $username, $password, $database_name);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>