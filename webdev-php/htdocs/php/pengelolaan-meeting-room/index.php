<?php
include 'koneksi.php';

$total_gedung = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM building"))['total'];
$total_ruangan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM room"))['total'];
$ruangan_tersedia = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM room WHERE status='Available'"))['total'];
$total_booking = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM booking"))['total'];
$booking_scheduled = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM booking WHERE status='Scheduled'"))['total'];
$booking_completed = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM booking WHERE status='Completed'"))['total'];
$booking_cancelled = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM booking WHERE status='Cancelled'"))['total'];

$bookings = mysqli_query($conn, "SELECT b.*, r.room_name FROM booking b JOIN room r ON b.room_id = r.room_id ORDER BY b.meeting_date DESC, b.start_time DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Meeting Room</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style/base.css">
</head>
<body>
    <div class="sidebar">
        <nav>
            <a href="index.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="building/index.php"><i class="fas fa-building"></i> Gedung</a>
            <a href="rooms/index.php"><i class="fas fa-door-open"></i> Ruangan</a>
            <a href="facility/index.php"><i class="fas fa-tools"></i> Fasilitas</a>
            <a href="booking/index.php"><i class="fas fa-calendar-check"></i> Booking</a>
        </nav>
    </div>
    <div class="main">
        <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
        <div class="stats">
            <div class="card">
                <i class="fas fa-building"></i>
                <h3><?php echo $total_gedung; ?></h3>
                <p>Total Gedung</p>
            </div>
            <div class="card">
                <i class="fas fa-door-open"></i>
                <h3><?php echo $total_ruangan; ?></h3>
                <p>Total Ruangan</p>
            </div>
            <div class="card">
                <i class="fas fa-check-circle"></i>
                <h3><?php echo $ruangan_tersedia; ?></h3>
                <p>Ruangan Tersedia</p>
            </div>
            <div class="card">
                <i class="fas fa-calendar-check"></i>
                <h3><?php echo $total_booking; ?></h3>
                <p>Total Booking</p>
            </div>
            <div class="card">
                <i class="fas fa-clock"></i>
                <h3><?php echo $booking_scheduled; ?></h3>
                <p>Scheduled</p>
            </div>
            <div class="card">
                <i class="fas fa-check-double"></i>
                <h3><?php echo $booking_completed; ?></h3>
                <p>Completed</p>
            </div>
            <div class="card">
                <i class="fas fa-times-circle"></i>
                <h3><?php echo $booking_cancelled; ?></h3>
                <p>Cancelled</p>
            </div>
        </div>

        <h3><i class="fas fa-calendar-alt"></i> Daftar Booking</h3>
        <table>
            <tr>
                <th><i class="fas fa-hashtag"></i> ID</th>
                <th><i class="fas fa-door-open"></i> Ruangan</th>
                <th><i class="fas fa-heading"></i> Judul</th>
                <th><i class="fas fa-user"></i> Organizer</th>
                <th><i class="fas fa-calendar"></i> Tanggal</th>
                <th><i class="fas fa-clock"></i> Jam</th>
                <th><i class="fas fa-users"></i> Peserta</th>
                <th><i class="fas fa-info-circle"></i> Status</th>
            </tr>
            <?php
            while ($d = mysqli_fetch_assoc($bookings)) {
                $statusClass = '';
                if ($d['status'] == 'Scheduled') $statusClass = 'status-scheduled';
                elseif ($d['status'] == 'Completed') $statusClass = 'status-completed';
                elseif ($d['status'] == 'Cancelled') $statusClass = 'status-cancelled';
                echo "<tr>
                    <td>{$d['booking_id']}</td>
                    <td>{$d['room_name']}</td>
                    <td>{$d['meeting_title']}</td>
                    <td>{$d['organizer']}</td>
                    <td>{$d['meeting_date']}</td>
                    <td>{$d['start_time']} - {$d['end_time']}</td>
                    <td>{$d['participant_count']}</td>
                    <td><span class='badge {$statusClass}'>{$d['status']}</span></td>
                </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
