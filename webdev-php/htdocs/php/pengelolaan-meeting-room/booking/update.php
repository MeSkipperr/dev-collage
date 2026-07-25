<?php

include '../auth_check.php';
include '../koneksi.php';

$booking_id = $_POST['booking_id'];
$room_id = $_POST['room_id'];
$meeting_title = $_POST['meeting_title'];
$organizer = $_POST['organizer'];
$meeting_date = $_POST['meeting_date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$participant_count = $_POST['participant_count'];
$status = $_POST['status'];

mysqli_query($conn,"
UPDATE booking SET
room_id='$room_id',
meeting_title='$meeting_title',
organizer='$organizer',
meeting_date='$meeting_date',
start_time='$start_time',
end_time='$end_time',
participant_count='$participant_count',
status='$status'
WHERE booking_id='$booking_id'
");

header("location:index.php");

?>