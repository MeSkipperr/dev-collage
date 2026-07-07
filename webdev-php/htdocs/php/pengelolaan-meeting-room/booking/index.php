<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../style/base.css">
    <link rel="stylesheet" href="../style/booking.css">
</head>
<body>
    <div class="sidebar">
        <nav>
            <a href="../index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="../building/index.php"><i class="fas fa-building"></i> Gedung</a>
            <a href="../rooms/index.php"><i class="fas fa-door-open"></i> Ruangan</a>
            <a href="../facility/index.php"><i class="fas fa-tools"></i> Fasilitas</a>
            <a href="../booking/index.php" class="active"><i class="fas fa-calendar-check"></i> Booking</a>
        </nav>
    </div>
    <div class="main">
        <h2><i class="fas fa-calendar-check"></i> Manajemen Data Booking</h2>
        <a href="tambahbooking.php" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Booking</a>

        <br><br>

        <table>
            <tr>
                <th><i class="fas fa-hashtag"></i> ID</th>
                <th><i class="fas fa-heading"></i> Meeting</th>
                <th><i class="fas fa-user"></i> Organizer</th>
                <th><i class="fas fa-door-open"></i> Room</th>
                <th><i class="fas fa-calendar"></i> Tanggal</th>
                <th><i class="fas fa-info-circle"></i> Status</th>
                <th><i class="fas fa-cog"></i> Opsi</th>
            </tr>
            <?php
            $data = mysqli_query($conn, "
                SELECT booking.*, room.room_name
                FROM booking
                JOIN room ON booking.room_id=room.room_id
            ");

            while ($d = mysqli_fetch_assoc($data)) {
                $statusClass = '';
                if ($d['status'] == 'Scheduled') $statusClass = 'status-scheduled';
                elseif ($d['status'] == 'Completed') $statusClass = 'status-completed';
                elseif ($d['status'] == 'Cancelled') $statusClass = 'status-cancelled';

                echo "<tr>
                    <td>{$d['booking_id']}</td>
                    <td>{$d['meeting_title']}</td>
                    <td>{$d['organizer']}</td>
                    <td>{$d['room_name']}</td>
                    <td>{$d['meeting_date']}</td>
                    <td><span class='badge {$statusClass}'>{$d['status']}</span></td>
                    <td class='table-actions'>
                        <a href='detail.php?id={$d['booking_id']}'><i class='fas fa-eye'></i> Detail</a>
                        <a href='edit.php?id={$d['booking_id']}'><i class='fas fa-edit'></i> Edit</a>
                        <a href='hapus.php?id={$d['booking_id']}' onclick='return confirm(\"Hapus data?\")'><i class='fas fa-trash'></i> Hapus</a>
                    </td>
                </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
