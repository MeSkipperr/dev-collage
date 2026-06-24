<?php
// koneksi database
include '../koneksi.php';

// menangkap data dari form
$kode = $_POST['kode'];
$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$noIsbn = $_POST['noIsbn'];
$jumlahHalaman = $_POST['jumlahHalaman'];


mysqli_query($koneksi, "UPDATE artikel 
SET judul='$judul', penulis='$penulis', penerbit='$penerbit', no_isbn='$noIsbn',jumlah_halaman='$jumlahHalaman'
WHERE kode='$kode'");

// redirect ke halaman list
header("Location: index.php");
exit;
?>