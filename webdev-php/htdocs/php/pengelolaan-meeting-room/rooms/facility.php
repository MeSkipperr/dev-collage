<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $room_id = $_POST['room_id'];
    $facility_id = $_POST['facility_id'];
    if ($action === 'add') {
        mysqli_query($conn, "INSERT IGNORE INTO room_facility (room_id, facility_id) VALUES ('$room_id', '$facility_id')");
    } elseif ($action === 'delete') {
        mysqli_query($conn, "DELETE FROM room_facility WHERE room_id='$room_id' AND facility_id='$facility_id'");
    }
    exit;
}

$room_id = $_GET['room_id'];
$current = mysqli_query($conn, "SELECT f.facility_id, f.facility_name, f.description FROM room_facility rf JOIN facility f ON rf.facility_id = f.facility_id WHERE rf.room_id='$room_id'");
$currentIds = [];
echo '<table><tr><th>Nama</th><th>Deskripsi</th><th>Aksi</th></tr>';
while ($row = mysqli_fetch_assoc($current)) {
    $currentIds[] = $row['facility_id'];
    echo "<tr>
        <td>{$row['facility_name']}</td>
        <td>{$row['description']}</td>
        <td><button class='btn-del-facility' data-fid='{$row['facility_id']}'><i class='fas fa-trash'></i> Hapus</button></td>
    </tr>";
}
echo '</table>';

$all = mysqli_query($conn, "SELECT * FROM facility WHERE facility_id NOT IN (" . (count($currentIds) > 0 ? implode(',', $currentIds) : '0') . ")");
echo '<div class="add-facility"><strong><i class="fas fa-plus-circle"></i> Tambah Fasilitas:</strong><br>';
while ($row = mysqli_fetch_assoc($all)) {
    echo "<button class='btn-add-facility' data-fid='{$row['facility_id']}'><i class='fas fa-plus'></i> {$row['facility_name']}</button> ";
}
echo '</div>';
echo '<button id="btnCloseModal" class="btn-close"><i class="fas fa-times"></i> Tutup</button>';
?>
