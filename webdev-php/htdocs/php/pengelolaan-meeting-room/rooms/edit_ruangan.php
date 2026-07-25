<?php
include '../auth_check.php';
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM room WHERE room_id='$id'"));
$buildings = mysqli_query($conn, "SELECT * FROM building");

if (isset($_POST['update'])) {
    $building = $_POST['building_id'];
    $nama = $_POST['room_name'];
    $lantai = $_POST['floor'];
    $kapasitas = $_POST['capacity'];
    $status = $_POST['status'];
    mysqli_query($conn, "UPDATE room SET building_id='$building', room_name='$nama', floor='$lantai', capacity='$kapasitas', status='$status' WHERE room_id='$id'");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ruangan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../style/base.css">
    <link rel="stylesheet" href="../style/form.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo"><h3><i class="fas fa-building"></i> MeetingRoom</h3></div>
        <nav>
            <a href="../index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="../building/index.php"><i class="fas fa-building"></i> Gedung</a>
            <a href="../rooms/index.php" class="active"><i class="fas fa-door-open"></i> Ruangan</a>
            <a href="../facility/index.php"><i class="fas fa-tools"></i> Fasilitas</a>
            <a href="../booking/index.php"><i class="fas fa-calendar-check"></i> Booking</a>
            <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>
    </div>
    <div class="main">
        <h2><i class="fas fa-edit"></i> Edit Ruangan</h2>

        <form method="POST">
            <div class="form-group">
                <label><i class="fas fa-building"></i> Gedung</label>
                <select name="building_id" required>
                    <?php while ($b = mysqli_fetch_assoc($buildings)) { ?>
                        <option value="<?php echo $b['building_id']; ?>" <?php if ($b['building_id'] == $data['building_id']) echo 'selected'; ?>><?php echo $b['building_name']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label><i class="fas fa-door-open"></i> Nama Ruangan</label>
                <input type="text" name="room_name" value="<?php echo $data['room_name']; ?>" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-layer-group"></i> Lantai</label>
                <input type="number" name="floor" value="<?php echo $data['floor']; ?>" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-users"></i> Kapasitas</label>
                <input type="number" name="capacity" value="<?php echo $data['capacity']; ?>" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-info-circle"></i> Status</label>
                <select name="status">
                    <option value="Available" <?php if ($data['status'] == 'Available') echo 'selected'; ?>>Available</option>
                    <option value="Maintenance" <?php if ($data['status'] == 'Maintenance') echo 'selected'; ?>>Maintenance</option>
                </select>
            </div>

            <button type="submit" name="update" class="btn btn-primary"><i class="fas fa-sync"></i> Update</button>
            <a href="index.php" class="btn btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
        </form>
    </div>
</body>
</html>
