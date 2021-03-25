<?php
$server   = "pratoza.com";
$username = "u8961758_jeri";
$password = "jerijeri";
$database = "u8961758_pengiriman";

$db = mysqli_connect($server, $username, $password, $database);

// cek koneksi
if (!$db) {
    die('Koneksi Database Gagal : ' . mysqli_connect_error());
}
?>