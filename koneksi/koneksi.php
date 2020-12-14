<?php
$server   = "localhost";
$username = "root";
$password = "";
$database = "pengiriman";

$db = mysqli_connect($server, $username, $password, $database);

// cek koneksi
if (!$db) {
    die('Koneksi Database Gagal : ' . mysqli_connect_error());
}
?>