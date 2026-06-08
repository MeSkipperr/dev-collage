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
    include '../../koneksi.php';

    $no = 1;

    // Langkah 1: Tentukan batas, cek halaman & posisi data
    $batas = 5;
    $halaman = @$_GET['halaman'];

    if (empty($halaman)) {
        $posisi = 0;
        $halaman = 1;
    } else {
        $posisi = ($halaman - 1) * $batas;
    }

    // Langkah 2: Hitung total data dan jumlah halaman
    $query2 = mysqli_query($koneksi, "SELECT * FROM dosen");

    $jmldata = mysqli_num_rows($query2);
    $jmlhalaman = ceil($jmldata / $batas);

    echo "Halaman : ";

    for ($i = 1; $i <= $jmlhalaman; $i++) {

        if ($i != $halaman) {
            echo "<a href='index.php?halaman=$i'>$i</a> | ";
        } else {
            echo "<b>$i</b> | ";
        }
    }

    echo "<p>Total dosen : <b>$jmldata</b> orang</p>";

    // Langkah 3: Query dengan LIMIT
    $query = "SELECT * FROM dosen LIMIT $posisi, $batas";

    $data = mysqli_query($koneksi, $query);
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
                    <a href="edit.php?nidn=<?php echo $d['nidn']; ?>">
                        EDIT
                    </a> |

                    <a href="delete.php?nidn=<?php echo $d['nidn']; ?>">
                        HAPUS
                    </a>
                </td>
            </tr>

        <?php
        }
        ?>

    </table>

</body>
</html>