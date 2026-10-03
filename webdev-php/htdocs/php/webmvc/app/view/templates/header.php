<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= BASEURL ?>/node_modules/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <title>Halaman <?= $data['judul'] ?> </title>
</head>

<body>
    <nav class="navbar navbar-expand-lg border-bottom">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="<?= BASEURL ?>public/home">WEB MVC</a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= BASEURL ?>public/home">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEURL ?>public/about">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEURL ?>public/mahasiswa">Mahasiswa</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>