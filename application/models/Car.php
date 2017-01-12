<?php 

class Car extends CI_Model
{

	public $reg_id;

    public $color;

    public $make;

    public $brand;

    public $owner;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getRegId() {
        return $this->reg_id;
    }
     public function getColor() {
        return $this->color;
    }
     public function getMake() {
        return $this->make;
    }
     public function getBrand() {
        return $this->brand;
    }
     public function getOwner() {
        return $this->owner;
    }

    public function setRegId($reg_id) {
        $this->reg_id = $reg_id;
    }
    public function setColor($color) {
        $this->color = $color;
    }
    public function setMake($make) {
        $this->make = $make;
    }
    public function setBrand($brand) {
        $this->brand = $brand;
    }
    public function setOwner($owner) {
        $this->owner = $owner;
    }

    public function create(Car $car) {
        return $this->db->insert('car', $car);
    }

	public function getAllByUserId($id) {
        $this->db->where('owner', $id);
	    $car = $this->db->get('car');
	    $result_array = [];
	    foreach ($car->result_array() as $row ) {
	        $result_array[] = $this->loadObject($row);
	    }
	    return $result_array;
    }

    // public function getAllUserUnpacked($id) {
    //     $this->db->select('car.*');
    //     $this->db->where('owner', $id);
    //     $this->db->where('is_parked', 0);
    //     $this->db->join('parking', 'parking.reg_num = car.reg_id', 'left');
    //     $car = $this->db->get('car');
    //     $result_array = [];
    //     foreach ($car->result_array() as $row ) {
    //         $result_array[] = $this->loadObject($row);
    //     }
    //     return $result_array;
    // }

    public function getUserParkedCars($user_id)
    {
        $this->db->select(
            'car.reg_id, parking.date_time, parking.no_hour,'.
            'location.name, payment.amount, parking.id'
        );
        $this->db->from('car');
        $this->db->where('car.owner', $user_id);
        $this->db->where('parking.is_parked', 1);
        $this->db->join('parking', 'parking.reg_num = car.reg_id');
        $this->db->join('payment', 'payment.parking_id = parking.id');
        $this->db->join('location', 'parking.location_id = location.id');
        $parkings = $this->db->get();

        return $parkings->result();
    }

    public function get($reg_id) {
        $this->db->where('reg_id', $reg_id);
        $car = $this->db->get('car');
        return $this->loadObject($car->row_array());
    }

    public function update(Car $car) {

    }

     public function loadObject(array $result) {
        $car = new Car();
        $car->setRegId($result['reg_id']);
        $car->setColor($result['color']);
        $car->setMake($result['make']);
        $car->setBrand($result['brand']);
        $car->setOwner($result['owner']);
        return $car;
    }

}