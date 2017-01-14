<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->is_admin) {
            return redirect('/account/');
        }
    }

    public function index()
    {
        $this->load->view(
            'layout/header',
            ['title' => "Car Park"]
        );
        $this->load->view('admin/index');
        $this->load->view('layout/footer');
    }

}
