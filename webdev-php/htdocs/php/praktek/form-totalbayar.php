<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Total Bayar</title>
</head>

<body>
    <form id="" name="" method="POST" action="process-totalbayar.php">
        Kode: <input type="text" name="kode-pembeli"><br>
        Nama: <input type="text" name="nama-pembeli"><br>
        <select name="jenis-pembeli">
            <option value="member">Member</option>
            <option value="non-member">Non Member</option>
            <option value="vip">VIP</option>
        </select><br>
        Nama Barang: <input type="text" name="nama-barang"><br>
        Harga Barang: <input type="number" name="harga-barang"><br>
        Jumlah Beli: <input type="number" name="jumlah-beli"><br>
        Diskon Tambahan: <input type="number" name="diskon-tambahan"><br>

        <p>
            <input type="submit" name="button" value="Tampil" />
        </p>
    </form>
</body>

</html>