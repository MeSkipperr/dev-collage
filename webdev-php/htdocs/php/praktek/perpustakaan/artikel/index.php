<!DOCTYPE html>
<html>
<head>
    <title>CRUD Artikel</title>
</head>
<body>

    <h2>CRUD data artikel</h2>

    <a href="tambahartikel.php">+ TAMBAH Artikel</a>
    <br><br>

    <?php 
    include '../koneksi.php';
    ?>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>No ISBN</th>
            <th>Jumlah Halaman</th>
            <th>Action</th>
        </tr>

        <?php 
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM artikel");

        while ($d = mysqli_fetch_array($data)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $d['kode']; ?></td>
            <td><?php echo $d['judul']; ?></td>
            <td><?php echo $d['penulis']; ?></td>
            <td><?php echo $d['penerbit']; ?></td>
            <td><?php echo $d['no_isbn']; ?></td>
            <td><?php echo $d['jumlah_halaman']; ?></td>
            <td>
                <a href="edit.php?kode=<?php echo $d['kode']; ?>">EDIT</a> |
                <a href="hapus.php?kode=<?php echo $d['kode']; ?>">HAPUS</a>
            </td>
        </tr>
        <?php 
        }
        ?>
    </table>

</body>
</html>