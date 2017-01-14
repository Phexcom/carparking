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
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('location');

        // validation rules
        $this->form_validation->set_rules(
            'code',
            'location code',
             ['trim','required','exact_length[3]','is_unique[location.code]']
        );
        $this->form_validation->set_rules(
            'name',
            'location name',
            ['trim','required','max_length[50]']
        );
        $this->form_validation->set_rules(
            'price',
            'location price',
            ['trim','required','max_length[12]','numeric']
        );
        $this->form_validation->set_rules(
            'vat',
            'location value added tax',
            ['trim','required','max_length[12]','numeric']
        );

        if ($this->input->method(true) === "POST") {
            if ($this->form_validation->run() == TRUE) {
                $location = new Location();
                $location->setCode($this->input->post('code'));
                $location->setName($this->input->post('name'));
                $location->setPrice($this->input->post('price'));
                $location->setVat($this->input->post('vat'));
                if ($this->location->create($location)) {
                    $this->session->set_flashdata(
                        'message', 
                        'Location added successfully.'
                    );
                    return redirect('/admin/');
                } else {
                    $this->session->set_flashdata(
                        'message', 
                        'Location could not be added. Try again!'
                    );
                }
            }
        }

        $this->load->view('layout/header', ['title' => "Car Park | Add Location"]);
        $this->load->view('admin/addLocation');
        $this->load->view('layout/footer');
    }
}
