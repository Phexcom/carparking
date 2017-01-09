<?php


class User extends CI_Model
{
    public $id;
    public $name;
    public $billing_address;
    public $card_no;
    public $email;
    public $is_admin;
    public $password;
    public $is_activated;

    public function __construct()
    {
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
        return $this->billing_address;
    }

    public function getCardNo()
    {
        return $this->card_no;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getIsAdmin()
    {
        return $this->is_admin;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getIsActivated()
    {
        return $this->$is_activated;
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
        $this->billing_address = $billingAddress;
    }
    public function setCardNo($cardNo)
    {
        $this->card_no = $cardNo;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setIsAdmin($isAdmin)
    {
        $this->is_admin = $isAdmin;
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function setIsActivated($isActivated)
    {
        $this->$is_activated = $isActivated;
    }

    public static function create(User $user)
    {
        unset($user->is_admin);
        unset($user->is_activated);
        return $this->db->insert('user', $user);
    }

    public static function getAll()
    {
        $user = $this->db->get('user');
        $result_array = [];
        foreach ($user->result_array() as $row) {
            $result_array[] = $this->loadObject($row);
        }
        return $result_array;
    }

    public static function get($regId)
    {
        $this->db->where('id', $regId);
        $user = $this->db->get('user');
        return $this->loadObject($park->row_array());
    }

    public static function update(Parking$user)
    {
    }

    private function loadObject(array $result)
    {
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
