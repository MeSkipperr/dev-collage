<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Belajar Menggunakan Operator di PHP</title>
</head>
<body>

    <h2><b>OPERATOR PHP</b></h2>

    <?php
        define("A", 4);
        define("B", 3);

        // operasi aritmatika
        $tambah = A + B;
        $kurang = A - B;
        $kali   = A * B;
        $bagi   = A / B;

        echo "Nilai A : " . A . "<br>";
        echo "Nilai B : " . B . "<br><br>";

        echo "Hasil Penambahan : $tambah <br>";
        echo "Hasil Pengurangan : $kurang <br>";
        echo "Hasil Perkalian : $kali <br>";
        echo "Hasil Pembagian : $bagi <br>";
    ?>
    
</body>
</html>