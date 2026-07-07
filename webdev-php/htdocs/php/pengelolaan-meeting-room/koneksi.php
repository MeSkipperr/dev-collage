<?php
$host = "webdev-php-mysql";
$user = "root";       
$pass = "root";           
$db = "meeting_room_booking";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
    
?>