<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../style/base.css">
</head>
<body>
    <div class="sidebar">
        <nav>
            <a href="../index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="../building/index.php"><i class="fas fa-building"></i> Gedung</a>
            <a href="../rooms/index.php"><i class="fas fa-door-open"></i> Ruangan</a>
            <a href="../facility/index.php" class="active"><i class="fas fa-tools"></i> Fasilitas</a>
            <a href="../booking/index.php"><i class="fas fa-calendar-check"></i> Booking</a>
        </nav>
    </div>
    <div class="main">
        <h2><i class="fas fa-tools"></i> Manajemen Data Fasilitas</h2>
        <a href="tambah_facility.php"><i class="fas fa-plus"></i> Tambah Fasilitas</a>
        <table>
            <tr>
                <th><i class="fas fa-hashtag"></i> ID</th>
                <th><i class="fas fa-tools"></i> Nama Fasilitas</th>
                <th><i class="fas fa-align-left"></i> Deskripsi</th>
                <th><i class="fas fa-cog"></i> Aksi</th>
            </tr>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM facility");
            while ($d = mysqli_fetch_assoc($query)) {
                echo "<tr>
                    <td>{$d['facility_id']}</td>
                    <td>{$d['facility_name']}</td>
                    <td>{$d['description']}</td>
                    <td>
                        <a href='edit_facility.php?id={$d['facility_id']}'><i class='fas fa-edit'></i> Ubah</a> | 
                        <a href='hapus_facility.php?id={$d['facility_id']}' onclick='return confirm(\"Hapus data?\")'><i class='fas fa-trash'></i> Hapus</a>
                    </td>
                </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
