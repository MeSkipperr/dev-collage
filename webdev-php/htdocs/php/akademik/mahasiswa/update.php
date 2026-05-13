<?php
// koneksi database
include '../koneksi.php';

// menangkap data dari form
$id     = $_POST['id'];
$nama   = $_POST['nama'];
$nim    = $_POST['nim'];
$alamat = $_POST['alamat'];

// update data ke database
mysqli_query($koneksi, "UPDATE mahasiswa 
SET nama='$nama', nim='$nim', alamat='$alamat' 
WHERE id='$id'");

// redirect ke halaman list
header("Location: listmahasiswa.php");
exit;
?>