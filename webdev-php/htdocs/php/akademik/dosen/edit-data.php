<?php
// koneksi database
include '../koneksi.php';

// menangkap data dari form
$nidn    = $_POST['nidn'];
$name   = $_POST['name'];
$alamat = $_POST['alamat'];
$umur    = $_POST['umur'];
$noTelp    = $_POST['no_telp'];

// update data ke database
mysqli_query(
    $koneksi,
    "UPDATE dosen SET
        name='$name',
        alamat='$alamat',
        umur=$umur,
        no_telp='$noTelp'
    WHERE nidn='$nidn'"
);


// redirect ke halaman list
header("Location: ./index.php");
exit;
?>