<?php

// Mengaktifkan session PHP
session_start();

// Menghubungkan dengan koneksi database
include '../koneksi.php';

// Menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query(
    $koneksi,
    "SELECT * FROM admin 
     WHERE username='$username' 
     AND password='$password'"
);

// Menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

// Cek apakah username dan password ditemukan
if ($cek > 0) {

    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";

    header("Location: login.php?pesan=login");
    exit();

} else {

    header("Location: login.php?pesan=gagal");
    exit();
}

?>