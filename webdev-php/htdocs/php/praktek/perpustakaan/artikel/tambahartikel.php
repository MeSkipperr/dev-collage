<!DOCTYPE html>
<html>
<head>
    <title>CRUD Artikel</title>
</head>
<body>

    <h2>CRUD DATA Artikel</h2>

    <a href="index.php">KEMBALI</a>
    <br><br>

    <h3>TAMBAH DATA MAHASISWA</h3>

    <form method="post" action="tambah_aksi.php">
        <table>
            <tr>
                <td>Judul</td>
                <td><input type="text" name="judul" required></td>
            </tr>
            <tr>
                <td>Penulis</td>
                <td><input type="text" name="penulis" required></td>
            </tr>
            <tr>
                <td>Penerbit</td>
                <td><input type="text" name="penerbit" required></td>
            </tr>
            <tr>
                <td>No ISBN</td>
                <td><input type="text" name="noIsbn" required></td>
            </tr>
            <tr>
                <td>Jumlah Halaman</td>
                <td><input type="number" name="jumlahHalaman" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="SIMPAN"></td>
            </tr>
        </table>
    </form>

</body>
</html>