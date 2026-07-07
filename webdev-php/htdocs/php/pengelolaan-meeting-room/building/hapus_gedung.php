<?php
include '../koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM building WHERE building_id='$id'");
header("Location: gedung.php");
?>