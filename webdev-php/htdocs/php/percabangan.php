<?php
// input nilai (bisa diubah-ubah)
$nilai = 75;

// =======================
// IF - ELSE IF
// =======================
echo "<h3>Contoh IF - ELSE IF</h3>";

if ($nilai >= 90) {
    echo "Grade A<br>";
} else if ($nilai >= 80) {
    echo "Grade B<br>";
} else if ($nilai >= 70) {
    echo "Grade C<br>";
} else {
    echo "Grade D<br>";
}

// =======================
// SWITCH
// =======================
echo "<h3>Contoh SWITCH</h3>";

// contoh hari
$hari = "Senin";

switch ($hari) {
    case "Senin":
        echo "Hari kerja dimulai<br>";
        break;
    case "Selasa":
        echo "Masih semangat kerja<br>";
        break;
    case "Rabu":
        echo "Pertengahan minggu<br>";
        break;
    case "Kamis":
        echo "Hampir weekend<br>";
        break;
    case "Jumat":
        echo "Hari terakhir kerja<br>";
        break;
    default:
        echo "Hari libur<br>";
        break;
}
?>