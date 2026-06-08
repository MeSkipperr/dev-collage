<?php

session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {

    header("Location: login.php?pesan=belum_login");
    exit();
}

$username = $_SESSION['username'];
$status   = $_SESSION['status'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
</head>

<body>

    <h2>
        Selamat Datang <?php echo $username; ?>,
        anda berhasil login
    </h2>

    <h3>Menu Utama</h3>

    <br>

    <a href="listmahasiswa.php">
        Data Mahasiswa
    </a>

    <br><br>

    <a href="listdosen.php">
        Data Dosen
    </a>

    <br><br>

    <form method="post" action="logout.php">
        <input
            type="submit"
            name="tbsubmit"
            value="LOGOUT"
        >
    </form>

</body>
</html>