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
        $this->load->model('parking');
        $active_parkings = $this->parking->getAll();
        $overtime_parkings = $this->parking->getOvertimeParkings();

        $data['active_parkings'] = $active_parkings;
        $data['overtime'] = $overtime_parkings;

        $this->load->view(
            'layout/header',
            ['title' => "Car Park"]
        );
        $this->load->view('admin/index', $data);
        $this->load->view('layout/footer');
    }

    public function addLocation()
    {

    }

}
