<?php
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$jabatan = $_POST['jabatan'];
$gaji = $_POST['gaji_pokok'];
$hari = $_POST['hari'];

if ($jabatan == "Manager") {
    $um = $hari * 50000;
    $tj = 1500000;
} elseif ($jabatan == "Supervisor") {
    $um = $hari * 30000;
    $tj = 500000;
} else {
    $um = $hari * 25000;
    $tj = 150000;
}

$total = $um + $tj + $gaji;

echo "Nama : $nama<br>";
echo "Alamat: $alamat<br>";
echo "Jabatan : $jabatan<br>";
echo "Gaji Pokok : $gaji<br>";
echo "Jumlah Hari Kerja : $hari<br>";
echo "Uang Makan = $hari X " . ($um / $hari) . " = $um<br>";
echo "Tunjangan Jabatan = $tj<br>";
echo "Total Gaji = $um + $tj + $gaji = $total";
?>