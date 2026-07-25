<?php

include '../auth_check.php';
include '../koneksi.php';

mysqli_query($conn,"INSERT INTO booking
VALUES(
'',
'$_POST[room_id]',
'$_POST[meeting_title]',
'$_POST[organizer]',
'$_POST[meeting_date]',
'$_POST[start_time]',
'$_POST[end_time]',
'$_POST[participant_count]',
'$_POST[status]'
)");

header("location:index.php");

?>