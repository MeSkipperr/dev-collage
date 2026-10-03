<?php

class Mahasiswa extends Controller
{
    public function index(): void
    {
        $data['judul'] = 'Daftar Mahasiswa';
        $data['mhs'] = $this->model(model: 'mahasiswa_models')->getAllMahasiswa();
        $this->view('templates/header', data: $data);
        $this->view('mahasiswa/index', data: $data);
        $this->view('templates/footer');
    }
}
