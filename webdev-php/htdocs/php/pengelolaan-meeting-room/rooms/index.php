<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruangan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../style/base.css">
    <link rel="stylesheet" href="../style/rooms.css">
</head>
<body>
    <div class="sidebar">
        <nav>
            <a href="../index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="../building/index.php"><i class="fas fa-building"></i> Gedung</a>
            <a href="../rooms/index.php" class="active"><i class="fas fa-door-open"></i> Ruangan</a>
            <a href="../facility/index.php"><i class="fas fa-tools"></i> Fasilitas</a>
            <a href="../booking/index.php"><i class="fas fa-calendar-check"></i> Booking</a>
        </nav>
    </div>
    <div class="main">
        <h2><i class="fas fa-door-open"></i> Manajemen Data Ruangan</h2>
        <a href="tambah_ruangan.php"><i class="fas fa-plus"></i> Tambah Ruangan</a>
        <table>
            <tr>
                <th><i class="fas fa-hashtag"></i> ID</th>
                <th><i class="fas fa-building"></i> Gedung</th>
                <th><i class="fas fa-door-open"></i> Nama Ruangan</th>
                <th><i class="fas fa-layer-group"></i> Lantai</th>
                <th><i class="fas fa-users"></i> Kapasitas</th>
                <th><i class="fas fa-info-circle"></i> Status</th>
                <th><i class="fas fa-tools"></i> Fasilitas</th>
                <th><i class="fas fa-cog"></i> Aksi</th>
            </tr>
            <?php
            $query = mysqli_query($conn, "SELECT r.*, b.building_name FROM room r JOIN building b ON r.building_id = b.building_id");
            while ($d = mysqli_fetch_assoc($query)) {
                $countQ = mysqli_query($conn, "SELECT COUNT(*) as total FROM room_facility WHERE room_id='{$d['room_id']}'");
                $count = mysqli_fetch_assoc($countQ)['total'];
                echo "<tr>
                    <td>{$d['room_id']}</td>
                    <td>{$d['building_name']}</td>
                    <td>{$d['room_name']}</td>
                    <td>{$d['floor']}</td>
                    <td>{$d['capacity']}</td>
                    <td>{$d['status']}</td>
                    <td><button class='btn-facility' onclick='openFacility({$d['room_id']}, \"{$d['room_name']}\")'><i class='fas fa-eye'></i> ({$count})</button></td>
                    <td>
                        <a href='edit_ruangan.php?id={$d['room_id']}'><i class='fas fa-edit'></i> Ubah</a> | 
                        <a href='hapus_ruangan.php?id={$d['room_id']}' onclick='return confirm(\"Hapus data?\")'><i class='fas fa-trash'></i> Hapus</a>
                    </td>
                </tr>";
            }
            ?>
        </table>

        <div id="facilityModal" class="modal" style="display:none;">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modalTitle"></h3>
                    <button class="modal-close" onclick="closeFacility()"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body" id="modalBody"></div>
            </div>
        </div>

        <script>
        function openFacility(roomId, roomName) {
            document.getElementById('modalTitle').innerText = 'Fasilitas - ' + roomName;
            document.getElementById('facilityModal').style.display = 'flex';
            loadFacility(roomId);
        }
        function closeFacility() {
            document.getElementById('facilityModal').style.display = 'none';
        }
        function loadFacility(roomId) {
            fetch('facility.php?room_id=' + roomId)
                .then(r => r.text())
                .then(html => {
                    document.getElementById('modalBody').innerHTML = html;
                    bindButtons(roomId);
                });
        }
        function bindButtons(roomId) {
            document.querySelectorAll('.btn-add-facility').forEach(btn => {
                btn.onclick = function() {
                    var fid = this.dataset.fid;
                    fetch('facility.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                        body: 'action=add&room_id=' + roomId + '&facility_id=' + fid
                    }).then(() => loadFacility(roomId));
                };
            });
            document.querySelectorAll('.btn-del-facility').forEach(btn => {
                btn.onclick = function() {
                    var fid = this.dataset.fid;
                    if (confirm('Hapus fasilitas ini?')) {
                        fetch('facility.php', {
                            method: 'POST',
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                            body: 'action=delete&room_id=' + roomId + '&facility_id=' + fid
                        }).then(() => loadFacility(roomId));
                    }
                };
            });
            document.getElementById('btnCloseModal').onclick = closeFacility;
        }
        </script>
    </div>
</body>
</html>
