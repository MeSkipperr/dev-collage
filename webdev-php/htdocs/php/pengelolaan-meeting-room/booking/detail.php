<?php include '../auth_check.php'; ?>
<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../style/base.css">
    <link rel="stylesheet" href="../style/booking.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo"><h3><i class="fas fa-building"></i> MeetingRoom</h3></div>
        <nav>
            <a href="../index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="../building/index.php"><i class="fas fa-building"></i> Gedung</a>
            <a href="../rooms/index.php"><i class="fas fa-door-open"></i> Ruangan</a>
            <a href="../facility/index.php"><i class="fas fa-tools"></i> Fasilitas</a>
            <a href="../booking/index.php" class="active"><i class="fas fa-calendar-check"></i> Booking</a>
            <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>
    </div>
    <div class="main">
        <h2><i class="fas fa-eye"></i> Detail Booking</h2>

        <?php
        $id = $_GET['id'];
        $data = mysqli_query($conn, "
            SELECT booking.*, room.room_name, building.building_name
            FROM booking
            JOIN room ON booking.room_id=room.room_id
            JOIN building ON room.building_id=building.building_id
            WHERE booking_id='$id'
        ");
        $d = mysqli_fetch_assoc($data);

        $statusClass = '';
        if ($d['status'] == 'Scheduled') $statusClass = 'status-scheduled';
        elseif ($d['status'] == 'Completed') $statusClass = 'status-completed';
        elseif ($d['status'] == 'Cancelled') $statusClass = 'status-cancelled';
        ?>

        <div class="detail-card">
            <div class="detail-row">
                <div class="detail-label"><i class="fas fa-heading"></i> Meeting</div>
                <div class="detail-value"><?php echo $d['meeting_title']; ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label"><i class="fas fa-user"></i> Organizer</div>
                <div class="detail-value"><?php echo $d['organizer']; ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label"><i class="fas fa-door-open"></i> Room</div>
                <div class="detail-value"><?php echo $d['room_name']; ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label"><i class="fas fa-building"></i> Building</div>
                <div class="detail-value"><?php echo $d['building_name']; ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label"><i class="fas fa-calendar"></i> Tanggal</div>
                <div class="detail-value"><?php echo $d['meeting_date']; ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label"><i class="fas fa-clock"></i> Jam</div>
                <div class="detail-value"><?php echo $d['start_time']; ?> - <?php echo $d['end_time']; ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label"><i class="fas fa-users"></i> Peserta</div>
                <div class="detail-value"><?php echo $d['participant_count']; ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label"><i class="fas fa-info-circle"></i> Status</div>
                <div class="detail-value"><span class="badge <?php echo $statusClass; ?>"><?php echo $d['status']; ?></span></div>
            </div>
        </div>

        <br>
        <a href="index.php" class="btn btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
        <a href="edit.php?id=<?php echo $d['booking_id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
    </div>
</body>
</html>
