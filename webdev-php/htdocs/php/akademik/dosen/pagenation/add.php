<!DOCTYPE html>
<html>
<head>
    <title>CRUD PHP dan MySQL</title>
</head>
<body>

    <h2>CRUD DATA DOSEN</h2>

    <a href="index.php">KEMBALI</a>
    <br><br>

    <h3>TAMBAH DATA DOSEN</h3>

    <form method="post" action="add-data.php">
        <table>
            <tr>
                <td>NIDN</td>
                <td><input type="text" name="nidn" required></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="name" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" required></td>
            </tr>
            <tr>
                <td>Umur</td>
                <td><input type="number" name="umur" required></td>
            </tr>
            <tr>
                <td>Nomer TELP </td>
                <td><input type="text" name="no_telp" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="SIMPAN"></td>
            </tr>
        </table>
    </form>

</body>
</html>