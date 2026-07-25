<?php
include '../auth_check.php';
include '../koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM facility WHERE facility_id='$id'");
header("Location: index.php");
?>
