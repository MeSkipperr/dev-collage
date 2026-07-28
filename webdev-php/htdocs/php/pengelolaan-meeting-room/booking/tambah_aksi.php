<?php

include '../auth_check.php';
include '../koneksi.php';

$room_id = $_POST['room_id'];
$meeting_title = $_POST['meeting_title'];
$organizer = $_POST['organizer'];
$meeting_date = $_POST['meeting_date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$participant_count = $_POST['participant_count'];
$status = $_POST['status'];

mysqli_query($conn,"INSERT INTO booking
(room_id, meeting_title, organizer, meeting_date, start_time, end_time, participant_count, status)
VALUES(
'$room_id',
'$meeting_title',
'$organizer',
'$meeting_date',
'$start_time',
'$end_time',
'$participant_count',
'$status'
)");

header("location:index.php");

?>