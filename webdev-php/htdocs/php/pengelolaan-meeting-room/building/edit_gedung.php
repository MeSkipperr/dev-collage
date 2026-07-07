<?php
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM building WHERE building_id='$id'"));

if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE building SET building_name='{$_POST['name']}', address='{$_POST['address']}', total_floor='{$_POST['floor']}' WHERE building_id='$id'");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gedung</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../style/base.css">
    <link rel="stylesheet" href="../style/form.css">
</head>
<body>
    <div class="sidebar">
        <nav>
            <a href="../index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="../building/index.php" class="active"><i class="fas fa-building"></i> Gedung</a>
            <a href="../rooms/index.php"><i class="fas fa-door-open"></i> Ruangan</a>
            <a href="../facility/index.php"><i class="fas fa-tools"></i> Fasilitas</a>
            <a href="../booking/index.php"><i class="fas fa-calendar-check"></i> Booking</a>
        </nav>
    </div>
    <div class="main">
        <h2><i class="fas fa-edit"></i> Edit Gedung</h2>

        <form method="POST">
            <div class="form-group">
                <label><i class="fas fa-building"></i> Nama Gedung</label>
                <input type="text" name="name" value="<?php echo $data['building_name']; ?>" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-map-marker-alt"></i> Alamat</label>
                <input type="text" name="address" value="<?php echo $data['address']; ?>">
            </div>

            <div class="form-group">
                <label><i class="fas fa-layer-group"></i> Total Lantai</label>
                <input type="number" name="floor" value="<?php echo $data['total_floor']; ?>" required>
            </div>

            <button type="submit" name="update" class="btn btn-primary"><i class="fas fa-sync"></i> Update</button>
            <a href="index.php" class="btn btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
        </form>
    </div>
</body>
</html>
