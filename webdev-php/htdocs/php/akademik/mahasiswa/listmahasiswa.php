<!DOCTYPE html>
<html>
<head>
    <title>CRUD PHP dan MySQLi</title>
</head>
<body>

    <h2>CRUD DATA MAHASISWA</h2>

    <a href="tambahmahasiswa.php">+ TAMBAH MAHASISWA</a>
    <br><br>

    <?php 
    include '../koneksi.php';
    ?>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>NO</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Alamat</th>
            <th>OPSI</th>
        </tr>

        <?php 
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM mahasiswa");

        while ($d = mysqli_fetch_array($data)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $d['nama']; ?></td>
            <td><?php echo $d['nim']; ?></td>
            <td><?php echo $d['alamat']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $d['id']; ?>">EDIT</a> |
                <a href="hapus.php?id=<?php echo $d['id']; ?>">HAPUS</a>
            </td>
        </tr>
        <?php 
        }
        ?>
    </table>

</body>
</html>