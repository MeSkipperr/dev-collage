<!DOCTYPE html>
<html>

<head>
    <title>CRUD PHP dan MySQL</title>
</head>

<body>

    <h2>CRUD DATA DOSEN</h2>

    <a href="index.php">KEMBALI</a>
    <br><br>

    <h3>EDIT DATA MAHASISWA</h3>

    <?php
    include '../koneksi.php';

    $nidn = $_GET['nidn'];
    $data = mysqli_query($koneksi, "SELECT * FROM dosen WHERE nidn='$nidn'");

    while ($d = mysqli_fetch_array($data)) {
        ?>

        <form method="post" action="edit-data.php">
            <table>
                <input type="hidden" name="nidn" value="<?php echo $d['nidn']; ?>">
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="name" value="<?php echo $d['name']; ?>" required></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><input type="text" name="alamat" value="<?php echo $d['alamat']; ?>" required></td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td><input type="number" name="umur" value="<?php echo $d['umur']; ?>" required></td>
                </tr>
                <tr>
                    <td>Nomer TELP </td>
                    <td><input type="text" name="no_telp" value="<?php echo $d['no_telp']; ?>" required></td>
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