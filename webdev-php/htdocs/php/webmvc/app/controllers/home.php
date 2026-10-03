<?php

class Home extends Controller
{
    public function index(): void
    {
        $data['judul'] = 'Home';
        $data['name'] = $this-> model('user_models') -> getUser();
        $this->view('templates/header', data: $data);
        $this->view('home/index', data: $data);
        $this->view('templates/footer');
    }
}
