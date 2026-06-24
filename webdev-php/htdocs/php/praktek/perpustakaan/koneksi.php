<?php
$koneksi = mysqli_connect("webdev-php-mysql", "root", "root", "perpustakaan");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>