<?php
// koneksi database
include '../koneksi.php';

// menangkap data dari form
$nama   = $_POST['nama'];
$nim    = $_POST['nim'];
$alamat = $_POST['alamat'];

// query insert
mysqli_query($koneksi, "INSERT INTO mahasiswa VALUES (NULL, '$nama', '$nim', '$alamat')");

// redirect ke halaman list
header("Location: listmahasiswa.php");
exit;
?>