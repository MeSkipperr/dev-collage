<?php
include '../koneksi.php';
if (isset($_POST['submit'])) {
    $building = $_POST['building_id'];
    $nama = $_POST['room_name'];
    $lantai = $_POST['floor'];
    $kapasitas = $_POST['capacity'];
    $status = $_POST['status'];
    mysqli_query($conn, "INSERT INTO room (building_id, room_name, floor, capacity, status) VALUES ('$building', '$nama', '$lantai', '$kapasitas', '$status')");
    header("Location: index.php");
}
$buildings = mysqli_query($conn, "SELECT * FROM building");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ruangan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../style/base.css">
    <link rel="stylesheet" href="../style/form.css">
</head>
<body>
    <div class="sidebar">
        <nav>
            <a href="../index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="../building/index.php"><i class="fas fa-building"></i> Gedung</a>
            <a href="../rooms/index.php" class="active"><i class="fas fa-door-open"></i> Ruangan</a>
            <a href="../facility/index.php"><i class="fas fa-tools"></i> Fasilitas</a>
            <a href="../booking/index.php"><i class="fas fa-calendar-check"></i> Booking</a>
        </nav>
    </div>
    <div class="main">
        <h2><i class="fas fa-plus-circle"></i> Tambah Ruangan</h2>

        <form method="POST">
            <div class="form-group">
                <label><i class="fas fa-building"></i> Gedung</label>
                <select name="building_id" required>
                    <option value="">-- Pilih Gedung --</option>
                    <?php while ($b = mysqli_fetch_assoc($buildings)) { ?>
                        <option value="<?php echo $b['building_id']; ?>"><?php echo $b['building_name']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label><i class="fas fa-door-open"></i> Nama Ruangan</label>
                <input type="text" name="room_name" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-layer-group"></i> Lantai</label>
                <input type="number" name="floor" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-users"></i> Kapasitas</label>
                <input type="number" name="capacity" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-info-circle"></i> Status</label>
                <select name="status">
                    <option value="Available">Available</option>
                    <option value="Maintenance">Maintenance</option>
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="index.php" class="btn btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
        </form>
    </div>
</body>
</html>
