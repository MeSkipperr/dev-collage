<!DOCTYPE html>
<html>
<head>
    <title>CRUD PHP dan MySQL</title>
</head>
<body>

    <h2>CRUD DATA DOSEN</h2>

    <a href="add.php">+ TAMBAH DOSEN</a>
    <br><br>

    <?php 
    include '../koneksi.php';
    ?>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>NO</th>
            <th>NIDN</th>
            <th>Name</th>
            <th>Alamat</th>
            <th>Umur</th>
            <th>No Telp</th>
            <th>Option</th>
        </tr>

        <?php 
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM dosen");

        while ($d = mysqli_fetch_array($data)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $d['nidn']; ?></td>
            <td><?php echo $d['name']; ?></td>
            <td><?php echo $d['alamat']; ?></td>
            <td><?php echo $d['umur']; ?></td>
            <td><?php echo $d['no_telp']; ?></td>
            <td>
                <a href="edit.php?nidn=<?php echo $d['nidn']; ?>">EDIT</a> |
                <a href="delete.php?nidn=<?php echo $d['nidn']; ?>">HAPUS</a>
            </td>
        </tr>
        <?php 
        }
        ?>
    </table>

</body>
</html>