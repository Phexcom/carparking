<?php

class Account extends CI_Controller {

    public function index()
	{
		$this->load->view('account/index');
	}

	public function login()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user');

		// validation rules
		$this->form_validation->set_rules(
			'email', 
			'Email',
			['trim','required', 'valid_email']
		);

		$this->form_validation->set_rules(
			'password',
			'password',
			['trim','required','min_length[8]']
		);

			if ($this->input->method(TRUE) === "POST") {
			if ($this->form_validation->run() == TRUE) {
				$user = new User();
				$user->setName($this->input->post('email'));
				$user->setBillingAddress($this->input->post('password'));
				$this->user->create($user);
				$this->session->set_flashdata('message','Login Succesfull');
				return redirect('/account/login/');
			}
		}
		$this->load->view('layout/header',['title' => "Car Park | Login"]);
		$this->load->view('account/login');
		$this->load->view('layout/footer');
	}


	public function register()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user');

		// validation rules
		$this->form_validation->set_rules(
			'name', 
			'Full Name',
			['trim','required']
		);
		$this->form_validation->set_rules(
			'address',
			'Billing address',
			['trim','required']
		);
		$this->form_validation->set_rules(
			'card',
			'Credit card no.',
			['trim','required','is_natural',
			function($string){
				$sum = 0;
			    $alt = false;
			    for($i = strlen($string) - 1; $i >= 0; $i--) 
			    {
			        if($alt)
			        {
			           $temp = $string[$i];
			           $temp *= 2;
			           $string[$i] = ($temp > 9) ? $temp = $temp - 9 : $temp;
			        }
			        $sum += $string[$i];
			        $alt = !$alt;
			    }
			    $this->form_validation->set_message('card', 'The credit invalid');
			    return $sum % 10 == 0;
				
			}]
		);
		$this->form_validation->set_rules(
			'email',
			'Email',
			['trim','required','valid_email','is_unique[user.email]'],
			['is_unique' => "Email address is already registered."]
		);
		$this->form_validation->set_rules(
			'password',
			'password',
			['trim','required','min_length[8]']
		);
		$this->form_validation->set_rules(
			'password_confirm',
			'password confirmation',
			['trim','matches[password]']
		);

		if ($this->input->method(TRUE) === "POST") {
			if ($this->form_validation->run() == TRUE) {
				$user = new User();
				$user->setName($this->input->post('name'));
				$user->setBillingAddress($this->input->post('address'));
				$user->setCardNo($this->input->post('card'));
				$user->setEmail($this->input->post('email'));
				$user->setPassword($this->input->post('password'));
				$this->user->create($user);
				$this->session->set_flashdata('message','Registration Succesfull');
				return redirect('/account/login/');
			}
		}
		$this->load->view('layout/header',['title' => "Car Park | Register"]);
		$this->load->view('account/register');
		$this->load->view('layout/footer');
	}
}