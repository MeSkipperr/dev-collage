<?php
class About extends Controller
{
    public function index($nama = 'I Kadek Yola Andika', $pekerjaan = "Mahasiswa", $umur = '19')
    {
        $data['judul'] = 'ABout Me';

        $data['nama'] = $nama;
        $data['pekerjaan'] = $pekerjaan;
        $data['umur'] = $umur;
        $this->view('templates/header',data: $data);
        $this->view('about/index', data: $data);
        $this->view('templates/footer');
    }
    public function page(): void
    {
        $data['judul'] = 'Pages';
        
        $this->view('templates/header',data: $data);
        $this->view('about/page');
        $this->view('templates/footer');
    }
}
