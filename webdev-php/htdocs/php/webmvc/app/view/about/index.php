<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman About</title>
</head>
<body>
    <div class="container ">
        <img width="200" height="200" src="<?= BASEURL ?>/public/img/patrick.jpeg" alt="patrick image">
        <h1>About Me</h1>
        <p>Hallo, nama saya <?=  $data["nama"]; ?> seorang <?=  $data["pekerjaan"]; ?>, Umur saya <?=  $data["umur"]; ?> tahun</p>
    </div>
</body>
</html>