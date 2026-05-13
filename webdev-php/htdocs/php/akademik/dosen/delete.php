<?php
    // koneksi database
    include '../koneksi.php';

    // menangkap data nidn dari URL
    $nidn = $_GET['nidn'];

    // menghapus data dari database
    mysqli_query($koneksi, "DELETE FROM dosen WHERE nidn='$nidn'");

    // redirect ke halaman list
    header("Location: ./index.php");
    exit;
?>