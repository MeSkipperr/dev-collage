<?php
include '../auth_check.php';
include '../koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM booking WHERE room_id='$id'");
mysqli_query($conn, "DELETE FROM room WHERE room_id='$id'");
header("Location: index.php");
?>
