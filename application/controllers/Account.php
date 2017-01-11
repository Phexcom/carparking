<?php

class Account extends CI_Controller
{

    public function index()
    {
        if (!$this->session->has_userdata('id')) {
            return redirect('/account/login');
        }
        if ($this->session->is_admin) {
            return redirect('/account');
        }

        $this->load->model(
            ['car']
        );
        $cars = $this->car->getAllByUserId(
            $this->session->userdata('id')
        );
        $parking = $this->car->getUserParkedCars(
            $this->session->userdata('id')
        );
        
        $this->load->view(
            'layout/header',
            ['title' => "Car Park"]
        );
        $this->load->view('account/index', [
            'name' => $this->session->userdata('name'),
            'email' => $this->session->userdata('email'),
            'address' => $this->session->userdata('billing_address'),
            'cars' => $cars,
            'parkings'  => $parkings,
        ]);
        $this->load->view('layout/footer');
    }

    public function addcar()
    {
        if ($this->session->is_admin) {
            return redirect('/account/');
        }

        if (!$this->session->has_userdata('id')) {
            return redirect('/account/login');
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('car');
        
        // validation rules
        $this->form_validation->set_rules(
            'reg_id',
            'Registration Id',
            ['trim','required','max_length[11]','is_unique[car.reg_id]'],
            ['is_unique' => "Vehicle is already registered."]
        );

        $this->form_validation->set_rules(
            'color',
            'Car color',
            ['trim','required', 'max_length[20]']
        );

        $this->form_validation->set_rules(
            'make',
            'Car make',
            ['trim','required','max_length[50]']
        );

        $this->form_validation->set_rules(
            'brand',
            'Car Brand',
            ['trim','required', 'max_length[50]']
        );

        if ($this->input->method(true) === "POST") {
            if ($this->form_validation->run() == true) {
                $car = new Car();
                $car->setRegId($this->input->post('reg_id'));
                $car->setColor($this->input->post('color'));
                $car->setMake($this->input->post('make'));
                $car->setBrand($this->input->post('brand'));
                $car->setOwner($this->session->id);
                if ($this->car->create($car)) {
                    $this->session->set_flashdata(
                        'message', 'Car added successfully!'
                    );
                    return redirect('/account/');
                } else {
                    $this->session->set_flashdata(
                        'message', 'Car could not be added. Try again!'
                    );
                }
            }
        }

        $this->load->view(
            'layout/header',
            ['title' => "Car Park | Add Car"]
        );
        $this->load->view('account/addcar');
        $this->load->view('layout/footer');
    }

    public function parkcar()
    {
        if ($this->session->is_admin) {
            return redirect('/account/');
        }
        if (!$this->session->has_userdata('id')) {
            return redirect('/account/login');
        }

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model(
            ['parking', 'car', 'location','payment']
        );

        $cars = $this->car->getAllByUserId($this->session->userdata('id'));
        if (empty($cars)) {
            $this->session->set_flashdata('message', 'You do not have any car added!');
            return redirect('/account');
        }
        $locations = $this->location->getAll();


        /* Field validations */
        // Get all user's cars reg number as array
        $car_array = [];
        foreach ($cars as $car) {
            $car_array[] = $car->getRegId();
        }
        $this->form_validation->set_rules(
            'reg_num',
            'Registration Number',
            ['trim','required','in_list['.implode(',', $car_array).']'],
            [
                "required" => "You must select a car.",
                "in_list" => "You can only park your registered cars"
            ]
        );

        // Get all location id as array
        $location_array = [];
        foreach ($locations as $location) {
            $location_array[] = $location->getId();
        }
        $this->form_validation->set_rules(
            'location',
            'Location',
            ['trim','required','in_list['.implode(',', $location_array).']'],
            [
                "required"  => "You must select a location",
                "in_list"   => "You can only select one of the locations above"
            ]
        );

        $this->form_validation->set_rules(
            'no_hour',
            'No of Hours',
            ['trim','required', 'is_natural_no_zero'],
            [
                "is_natural_no_zero" =>
                    "parking hours can only be postive integers, starting from one",
                "required" => "You must supply the number of hours"
            ]
        );

        if ($this->input->method(true) === "POST") {
            if ($this->form_validation->run()) {
                // load database, start transaction
                $this->load->database();
                $this->db->trans_begin();
                // Create new Park Object
                $park = new Parking();
                $park->setRegNum($this->input->post('reg_num'));
                $park->setLocationId($this->input->post('location'));
                $park->setNoHour($this->input->post('no_hour'));
                $park->setDateTime(date("Y-m-d H:i:s"));

                // If save is not successful, roll-back transaction
                if (!$this->parking->create($park)) {
                    $this->db->trans_rollback();
                    $this->session->set_flashdata(
                        'error',
                        'There was a problem while processing. Please try again.'
                    );
                } else {
                    // Create a new Payment Object
                    $payment = new Payment();
                    $payment->setParkingId($this->db->insert_id());
                    $payment->setAmount(
                        (function ($location_id, $hours) use ($locations) {
                            foreach ($locations as $location) {
                                if ($location->getId() == $location_id) {
                                    $tax = $location->getVat() * $hours;
                                    $price = $location->getPrice() * $hours;
                                    return $price + $tax;
                                }
                            }
                            throw new Exception("Location id invalid!");
                        }) ($park->getLocationId(),$park->getNoHour())
                    );
                    if (!$this->payment->create($payment)) {
                        $this->db->trans_rollback();
                        $this->session->set_flashdata(
                            'error',
                            'There was a problem while processing. Please try again.'
                        );
                    } else {
                        $this->db->trans_commit();
                        $this->session->set_flashdata('message', 'Car Parked successfully');
                        return redirect('/account/');
                    }
                }
            }
        }

        $this->load->view(
            'layout/header',
            ['title' => "Car Park | Park Car"]
        );
        $this->load->view(
            'account/parkcar',
            [
                'locations' => $locations,
                'cars'      => $cars
            ]
        );
        $this->load->view('layout/footer');
    }

    //Handling User Login
    public function login()
    {
        if ($this->session->has_userdata('id')) {
            return redirect('/account');
        }

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

        if ($this->input->method(true) === "POST") {
            if ($this->form_validation->run() == true) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $user = new User();
                $user = $user->getByEmail($email);
                // if email is found
                if ($user && password_verify($password, $user->getPassword())) {
                    if ($user->getIsActivated()) {
                        $this->session->set_userdata(
                            [
                                'id'                => $user->getId(),
                                'name'              => $user->getName(),
                                'email'             => $user->getEmail(),
                                'billing_address'   => $user->getBillingAddress(),
                                'is_admin'          => $user->getIsAdmin()
                            ]
                        );
                        return redirect('/account/');
                    } else {
                        $data['error'] =
                            "Account not activated. Please check your email for activation link";
                    }
                } else {
                    $data['error'] = "Invalid email OR password";
                }
            }
        }
        $this->load->view('layout/header', ['title' => "Car Park | Login"]);
        $this->load->view('account/login', $data);
        $this->load->view('layout/footer');
    }

    //Handling User registeration
    public function register()
    {
        if ($this->session->has_userdata('id')) {
            return redirect('/account/');
        }

        $this->load->helper('form');
        $this->load->library(['form_validation']);
        $this->load->model(['user','activation']);

        // validation rules
        $this->form_validation->set_rules(
            'name',
            'Full Name',
            ['trim','required','max_lenght[100]']
        );

        $this->form_validation->set_rules(
            'address',
            'Billing address',
            ['trim','required', 'max_length[250]']
        );

        $this->form_validation->set_rules(
            'card',
            'Credit card no.',
            ['trim','required','is_natural',
            [
                'valid_card',
                function ($string) {
                    $sum = 0;
                    $alt = false;
                    for ($i = strlen($string) - 1; $i >= 0; $i--) {
                        if ($alt) {
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
            ['trim','required','valid_email', 'max_length[100]','is_unique[user.email]'],
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

        if ($this->input->method(true) === "POST") {
            if ($this->form_validation->run() == true) {
                $this->load->database();
                $this->db->trans_begin();
                $user = new User();
                $user->setName($this->input->post('name'));
                $user->setBillingAddress($this->input->post('address'));
                $user->setCardNo($this->input->post('card'));
                $user->setEmail($this->input->post('email'));
                $user->setPassword($this->input->post('password'));
                if (!$this->user->create($user)) {
                    $this->db->trans_rollback();
                }
                // store token and send email
                $last_id = $this->db->insert_id();
                $random = $this->__generateToken();
                $activation = new Activation();
                $activation->setAccountId($last_id);
                $activation->setToken($random);
                if (!$this->activation->create($activation)) {
                    $this->db->trans_rollback();
                }
                $this->db->trans_commit();
                // Send email
                $token = $random . $last_id;
                $this->__sendMail($user, $token);
                $this->session->set_flashdata('message', 'Registration Successful. Check your email for activation link');
                return redirect('/account/login/');
            }
        }

        $this->load->view('layout/header', ['title' => "Car Park | Register"]);
        $this->load->view('account/register');
        $this->load->view('layout/footer');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        return redirect('/account/login');
    }

    // Activating User account
    public function activate($token)
    {
        if (strlen($token) < 21) {
            return redirect('/');
        }
        $token_string = substr($token, 0, 20);
        $id = str_replace($token_string, '', $token);
        if (!ctype_digit($id)) {
            return redirect('/');
        }
        $this->load->model(['activation','user']);
        $activation = $this->activation->get($id, $token_string);
        if (!$activation) {
            $this->session->set_flashdata('message', 'Account Activation Failed');
            return redirect('/');
        }
        $this->activation->delete($id, $token_string);
        // Activate user in User table
        $this->user->activate($id);
        $this->session->set_flashdata('message', 'Activation successful.
		 Login below');
        return redirect('/account/login');
    }

    //Sending Activation Email
    private function __sendMail($user, $token)
    {
        $this->load->library('email');
        $link = site_url('/account/activate/'.$token.'/');
        $this->email->from('carphex@gmail.com', 'Carphex');
        $this->email->to($user->getEmail());
        $this->email->subject('Verification Email from Car Parking');
        $this->email->message('<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Email Verification</title></head><body><p>Hello '.$user->getName().' </p><p>	Thank you for Registering on Car Parking.</p><br><br><p>Click the link below to activate your account.</p><p><a href="'.$link.'">Activate</a></p><br><br><p>After Activation you will be able to login with your account Username: '.$user->getName().' with the password you created</p></body></html>');
        $this->email->send();
    }

    private function __generateToken($length = 20)
    {
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }
}
