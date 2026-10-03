<div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <h3 class="display-7">Daftar Mahassiwa</h3>
            <?php foreach ($data["mhs"] as $mhs) : ?>
                <ul>
                    <li><?= $mhs['nama'] ?></li>
                    <li><?= $mhs['nim'] ?></li>
                    <li><?= $mhs['kelas'] ?></li>
                </ul>
            <?php endforeach ?>
        </div>
    </div>
</div>