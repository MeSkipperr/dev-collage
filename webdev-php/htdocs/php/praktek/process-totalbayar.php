<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Total Bayar</title>
</head>

<body>
    <?php

    $KP = $_POST["kode-pembeli"] ?? "";
    $NP = $_POST["nama-pembeli"] ?? "";
    $JP = $_POST["jenis-pembeli"] ?? "";
    $NB = $_POST["nama-barang"] ?? "";
    $HB = $_POST["harga-barang"] ?? "";
    $JB = $_POST["jumlah-beli"] ?? "";
    $DT = $_POST["diskon-tambahan"] ?? "";


    function fDiskon($jenisPembeli, $hargaBarang, $jumlahBeli, $diskonTambahan)
    {
        $totalHarga = $hargaBarang * $jumlahBeli;

        switch ($jenisPembeli) {
            case 'member':
                $diskon = 0.20;
                break;
            case 'vip':
                $diskon = 0.30;
                break;
            default:
                $diskon = 0.10;
                break;
        }
        return $totalHarga - ($totalHarga * $diskon) - $diskonTambahan;
    }

    $totalBayar = fDiskon($JP,$HB,$JB,$DT);
    ?>

    
    <table border>
        <tr>
            <th>Kode Pembeli</th>
            <th><?php echo $KP ?></th>
        </tr>
        <tr>
            <th>Nama Pembeli</th>
            <th><?php echo $NP ?></th>
        </tr>
        <tr>
            <th>Jenis Pembeli</th>
            <th><?php echo $JP ?></th>
        </tr>
        <tr>
            <th>Nama Barang</th>
            <th><?php echo $NB ?></th>
        </tr>
        <tr>
            <th>Harga Barang</th>
            <th><?php echo $HB ?></th>
        </tr>
        <tr>
            <th>Jumlah Barang</th>
            <th><?php echo $JB  ?></th>
        </tr>
        <tr>
            <th>Diskon Tambahan</th>
            <th><?php echo $DT ?></th>
        </tr>

        <tr>
            <th>Total Bayar</th>
            <th><?php echo $totalBayar ?></th>
        </tr>
    </table>
</body>

</html>