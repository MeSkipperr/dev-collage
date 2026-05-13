<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Akhir</title>
</head>
<body>
    <H1>MASUKKAN DATA ANDA</H1>
    <form method="POST" action="praktek-1.php">
        <p>NIM : <input type="number" name="nim" required></p>
        <p>NAMA : <input type="text" name="nama" required></p>    
        <p>MATA KULIAH : <input type="text" name="mata_kuliah"></p>
        <h3>JENIS MATAKULIAH</h3>
        <input type="radio" name="jenis" value="Teori">Teori<br>
        <input type="radio" name="jenis" value="Teori Praktek" >Teori Praktek<br>
        <input type="radio" name="jenis" value="Praktek">Praktek
        <p>NILAI TEORI : <input type="number" name="nilai_teori"></p>
        <p>NILAI PRAKTEK : <input type="number" name="nilai_praktek"></p>
        <p>NILAI LAINNYA : <input type="number" name="nilai_lain"></p> <br>
        <input type="submit" name="proses">
    </form>
</body>
</html>