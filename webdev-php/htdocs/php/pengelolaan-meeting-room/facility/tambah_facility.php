<?php
include '../koneksi.php';
if (isset($_POST['submit'])) {
    $nama = $_POST['facility_name'];
    $desc = $_POST['description'];
    mysqli_query($conn, "INSERT INTO facility (facility_name, description) VALUES ('$nama', '$desc')");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Fasilitas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../style/base.css">
    <link rel="stylesheet" href="../style/form.css">
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
        <h2><i class="fas fa-plus-circle"></i> Tambah Fasilitas</h2>

        <form method="POST">
            <div class="form-group">
                <label><i class="fas fa-tools"></i> Nama Fasilitas</label>
                <input type="text" name="facility_name" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-align-left"></i> Deskripsi</label>
                <input type="text" name="description">
            </div>

            <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="index.php" class="btn btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
        </form>
    </div>
</body>
</html>
