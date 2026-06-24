<!DOCTYPE html>
<html>

<head>
    <title>CRUD Artikel</title>
</head>

<body>

    <h2>CRUD DATA Artikel</h2>

    <a href="index.php">KEMBALI</a>
    <br><br>

    <h3>EDIT DATA MAHASISWA</h3>

    <?php
    include '../koneksi.php';

    $id = $_GET['kode'];
    $data = mysqli_query($koneksi, "SELECT * FROM artikel WHERE kode='$id'");

    while ($d = mysqli_fetch_array($data)) {
        ?>

        <form method="post" action="update.php">
            <table>
                <tr>
                    <input type="hidden" name="kode" value="<?php echo $d['kode']; ?>">
                    <td>Judul</td>
                    <td><input type="text" name="judul" required value="<?php echo $d['judul']; ?>"></td>
                </tr>
                <tr>
                    <td>Penulis</td>
                    <td><input type="text" name="penulis" required value="<?php echo $d['penulis']; ?>"></td>
                </tr>
                <tr>
                    <td>Penerbit</td>
                    <td><input type="text" name="penerbit" required value="<?php echo $d['penerbit']; ?>"></td>
                </tr>
                <tr>
                    <td>No ISBN</td>
                    <td><input type="text" name="noIsbn" required value="<?php echo $d['no_isbn']; ?>"></td>
                </tr>
                <tr>
                    <td>Jumlah Halaman</td>
                    <td><input type="number" name="jumlahHalaman" required value="<?php echo $d['jumlah_halaman']; ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="SIMPAN"></td>
                </tr>
            </table>
        </form>

        <?php
    }
    ?>
</body>

</html>