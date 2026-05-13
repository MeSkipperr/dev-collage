<?php
// koneksi database
include '../koneksi.php';

// menangkap data dari form
$nidn    = $_POST['nidn'];
$name   = $_POST['name'];
$alamat = $_POST['alamat'];
$umur    = $_POST['umur'];
$noTelp    = $_POST['no_telp'];

// query insert
mysqli_query($koneksi, "INSERT INTO dosen VALUES ('$nidn', '$name', '$alamat', $umur, '$noTelp')");

// redirect ke halaman list
header("Location: index.php");
exit;
?>