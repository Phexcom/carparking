<?php 

class Car extends CI_Model
{

	protected $regId;

    protected $color;

    protected $make;

    protected $brand;

    protected $owner;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getRegId() {
        return $this->regId;
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

    public function setRegId($regId) {
        $this->regId = $regId;
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

    }

	public function getAll() {
	    $car = $this->db->get('car');
	    $result_array = [];
	    foreach ($car->result_array() as $row ) {
	        $result_array[] = $this->loadObject($row);
	    }
	    return $result_array;
    }

    public function get($regId) {
        $this->db->where('reg_id', $regId);
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