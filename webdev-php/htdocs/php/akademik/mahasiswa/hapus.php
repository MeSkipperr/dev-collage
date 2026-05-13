<?php
    // koneksi database
    include '../koneksi.php';

    // menangkap data id dari URL
    $id = $_GET['id'];

    // menghapus data dari database
    mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id='$id'");

    // redirect ke halaman list
    header("Location: listmahasiswa.php");
    exit;
?>