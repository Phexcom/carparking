<?php

class Home extends CI_Controller {

    public function index()
	{
		$this->load->view(
			'layout/header', 
			['title' => "Car Park"]
		);
		$this->load->view('home/index');
		$this->load->view('layout/footer');
	}
}