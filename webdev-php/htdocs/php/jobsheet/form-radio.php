<html>
<head>
<title>Form Input Radio</title>
</head>
<body>

<p>Jenjang Terakhir Pendidikan Anda ?</p>

<form id="form_radio" name="form_radio" method="POST" action="proces-radio.php">
    <p>
        <input type="radio" name="pendidikan" value="SD" /> SD
        <input type="radio" name="pendidikan" value="SMP" /> SMP
        <input type="radio" name="pendidikan" value="SMA|SMK" /> SMA|SMK
        <input type="radio" name="pendidikan" value="D3" /> D3
        <input type="radio" name="pendidikan" value="S1" /> S1
        <input type="radio" name="pendidikan" value="S2" /> S2
        <input type="radio" name="pendidikan" value="S3" /> S3
    </p>
    <p>
        <input type="submit" name="button" value="Proses"/>
    </p>
</form>

</body>
</html>