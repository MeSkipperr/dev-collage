<?php
    // koneksi database
    include '../koneksi.php';

    // menangkap data id dari URL
    $kode = $_GET['kode'];

    // menghapus data dari database
    mysqli_query($koneksi, "DELETE FROM artikel WHERE kode='$kode'");

    // redirect ke halaman list
    header("Location: index.php");
    exit;
?>