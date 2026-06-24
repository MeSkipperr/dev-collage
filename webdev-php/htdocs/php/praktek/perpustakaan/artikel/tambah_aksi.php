<?php
// koneksi database
include '../koneksi.php';

// menangkap data dari form
$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$noIsbn = $_POST['noIsbn'];
$jumlahHalaman = $_POST['jumlahHalaman'];

// query insert
mysqli_query($koneksi, "INSERT INTO artikel VALUES (NULL, '$judul', '$penulis', '$penerbit','$noIsbn',$jumlahHalaman)");

// redirect ke halaman list
header("Location: index.php");
exit;
?>