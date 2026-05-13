<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Proses Pemrosesan Nilai</title>
</head>

<body>
    <?php
    $NIM = $_POST["nim"] ?? "";
    $NAMA = $_POST["nama"] ?? "";
    $MATA_KULIAH = $_POST["mata_kuliah"] ?? "";
    $Jenis_matakulaih = $_POST["jenis"] ?? "";
    $Nilai_teori = $_POST["nilai_teori"] ?? 0;
    $Nilai_praktek = $_POST["nilai_praktek"] ?? 0;
    $Nilai_lain = $_POST["nilai_lain"] ?? 0;

    function fNilai($Jenis, $Teori, $Praktek, $Lain)
    {
        $Nilai_akhir = 0;

        if ($Jenis == "Teori") {
            $Nilai_akhir = ($Teori * 0.7) + ($Lain * 0.3);
        } else if ($Jenis == "Teori Praktek") {
            $Nilai_akhir = ($Teori * 0.2) + ($Praktek * 0.7) + ($Lain * 0.1);
        } else if ($Jenis == "Praktek") {

            $Nilai_akhir = ($Praktek * 0.8) + ($Lain * 0.2);
        }

        return $Nilai_akhir;
    }

    $Total_nilai = fNilai($Jenis_matakulaih, $Nilai_teori, $Nilai_praktek, $Nilai_lain);

    echo "<h3>Hasil Penilaian:</h3>";
    echo "NIM : $NIM <br>";
    echo "Nama : $NAMA <br>";
    echo "Mata Kuliah : $MATA_KULIAH <br>";
    echo "Jenis Mata Kuliah : $Jenis_matakulaih <br>";
    echo "Nilai Teori : $Nilai_teori <br>";
    echo "Nilai Praktek : $Nilai_praktek <br>";
    echo "Nilai Lainnya : $Nilai_lain <br>";
    echo "<strong>Total Nilai Akhir : $Total_nilai </strong>";
    ?>
</body>

</html>