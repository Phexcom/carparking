<?php

class Home extends CI_Controller {

    public function index()
	{
		$data['some_data'] = "model_data";
		$this->load->view('layout/header', ['title' => "Car Park"]);
		$this->load->view('home/index',$data);
		$this->load->view('layout/footer');
	}
}