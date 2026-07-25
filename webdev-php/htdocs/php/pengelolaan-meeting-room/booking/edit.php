<?php include '../auth_check.php'; ?>
<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
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
        <h2><i class="fas fa-edit"></i> Edit Booking</h2>

        <?php
        $id = $_GET['id'];
        $data = mysqli_query($conn, "SELECT * FROM booking WHERE booking_id='$id'");
        $d = mysqli_fetch_assoc($data);
        ?>

        <form method="post" action="update.php">
            <input type="hidden" name="booking_id" value="<?php echo $d['booking_id']; ?>">

            <div class="form-group">
                <label><i class="fas fa-heading"></i> Meeting Title</label>
                <input type="text" name="meeting_title" value="<?php echo $d['meeting_title']; ?>" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-user"></i> Organizer</label>
                <input type="text" name="organizer" value="<?php echo $d['organizer']; ?>" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-door-open"></i> Room</label>
                <select name="room_id">
                    <?php
                    $room = mysqli_query($conn, "SELECT * FROM room");
                    while ($r = mysqli_fetch_assoc($room)) {
                        $selected = ($d['room_id'] == $r['room_id']) ? 'selected' : '';
                        echo "<option value='{$r['room_id']}' {$selected}>{$r['room_name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label><i class="fas fa-calendar"></i> Tanggal</label>
                <input type="date" name="meeting_date" value="<?php echo $d['meeting_date']; ?>" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-clock"></i> Jam Mulai</label>
                <input type="time" name="start_time" value="<?php echo $d['start_time']; ?>" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-clock"></i> Jam Selesai</label>
                <input type="time" name="end_time" value="<?php echo $d['end_time']; ?>" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-users"></i> Jumlah Peserta</label>
                <input type="number" name="participant_count" value="<?php echo $d['participant_count']; ?>" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-info-circle"></i> Status</label>
                <select name="status">
                    <option value="Scheduled" <?php if ($d['status'] == 'Scheduled') echo 'selected'; ?>>Scheduled</option>
                    <option value="Completed" <?php if ($d['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                    <option value="Cancelled" <?php if ($d['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="index.php" class="btn btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>

        </form>
    </div>
</body>
</html>
