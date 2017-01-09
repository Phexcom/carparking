<?php


class User extends CI_Model
{
	protected $id;
	protected $name;
	protected $billingAddress;
	protected $cardNo;
	protected $email;
	protected $isAdmin;
    protected $password;

	public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getId()
    {
    	return $this->id;
    }

    public function getName()
    {
    	return $this->name;
    }

    public function getBillingAddress()
    {
    	return $this->billingAddress;
    }

    public function getCardNo()
    {
    	return $this->cardNo;
    }

    public function getEmail()
    {
    	return $this->email;
    }

    public function getIsAdmin()
    {
    	return $this->isAdmin;
    }

    public function getPassword()
    {
    	return $this->password;
    }


    public function setId($id)
    {
    	 $this->id = $id;
    }
     public function setName($name)
    {
    	 $this->name = $name;
    }
     public function setBillingAddress($billingAddress)
    {
    	 $this->billingAddress = $billingAddress;
    }
     public function setCardNo($cardNo)
    {
    	 $this->cardNo = $cardNo;
    }
     public function setEmail($email)
    {
    	 $this->email = $email;
    }
     public function setIsAdmin($isAdmin)
    {
    	 $this->isAdmin = $isAdmin;
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function create(User $user) {

    }

    public function getAll() {
	   $user = $this->db->get('user');
	    $result_array = [];
	    foreach ($user->result_array() as $row ) {
	        $result_array[] = $this->loadObject($row);
	    }
	    return $result_array;
    }

    public function get($regId) {
        $this->db->where('id', $regId);
       $user = $this->db->get('user');
        return $this->loadObject($park->row_array());
    }

    public function update(Parking$user) {

    }

     public function loadObject(array $result) {
       $user = new Park();
       $user->setId($result['id']);
       $user->setName($result['name']);
       $user->setBillingAddress($result['billing_address']);
       $user->setCardNo($result['card_no']);
       $user->setEmail($result['email']);
       $user->setIsAdmin($result['isAdmin']);
        return$user;
    }




}