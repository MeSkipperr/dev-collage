<?php

// Menentukan waktu expired cookie (10 detik)
$expire = time() + 10;

// Membuat cookie
setcookie('kunjungan', '1', $expire);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Cookies</title>
</head>

<body>

    <?php

    // Mengecek apakah cookie sudah ada
    if (isset($_COOKIE['kunjungan'])) {

        echo "Selamat Datang Kembali";

    } else {

        echo "Selamat Datang, Ini Kunjungan Anda Pertama Kalinya";
    }

    ?>

</body>
</html>