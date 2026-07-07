<?php

include '../koneksi.php';

$id=$_GET['id'];

mysqli_query($conn,"DELETE FROM booking WHERE booking_id='$id'");

header("location:index.php");

?>