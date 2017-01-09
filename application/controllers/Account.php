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
		$data = [];

		// validation rules
		$this->form_validation->set_rules(
			'email', 
			'Email',
			['trim','required', 'valid_email']
		);

		$this->form_validation->set_rules(
			'password',
			'password',
			['trim','required']
		);

		if ($this->input->method(TRUE) === "POST") {
			if ($this->form_validation->run() == TRUE) {
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$user = new User();
				$user = $user->getByEmail($email);
				// if email is found
				if ($user && password_verify($password, $user->getPassword())) {
					if ($user->getIsActivated()) {
						$this->session->set_userdata(
							[
								'id' 		=> $user->getId(),
								'name'		=> $user->getName(),
								'email'		=> $user->getEmail(),
								'is_admin'	=> $user->getIsAdmin()
							]
						);
						return redirect('/account/');	
					} else {
						$data['error'] = "Account not activated";
					}	
				} else {
					$data['error'] = "Invalid email/password";
				}
			}
		}
		$this->load->view('layout/header',['title' => "Car Park | Login"]);
		$this->load->view('account/login',$data);
		$this->load->view('layout/footer');
	}

	public function register()
	{
		$this->load->helper('form');
		$this->load->library(['form_validation','encryption']);
		$this->load->model(['user','activation']);

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
			[
				'valid_card',
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
				$result = $sum % 10 == 0;
				if (!$result) {
					$this->form_validation->set_message('valid_card', 'The credit card is invalid');
				}
			    return $result;
				}
			]
			]
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
				// store token and send email
				$this->load->database();
				$last_id = $this->db-insert_id();
				$random = $this->encryption->create_key(20);
				$token = $random . $last_id;
				// $activation = new Activation();
				// $activation->create($last_id,$random);
				$this->session->set_flashdata('message','Registration Successful');
				return redirect('/account/login/');
			}
		}
		$this->load->view('layout/header',['title' => "Car Park | Register"]);
		$this->load->view('account/register');
		$this->load->view('layout/footer');
	}

	public function activate($token)
	{
		if (!$token || count($token) > 21) {
			return redirect('/');
		}
		$this->load->library('encryption');
		var_dump($this->encryption->encrypt('somemail@mail.me'));

	}
}