<?php

class Location extends CI_Model
{
    protected $id;

    protected $code;

    protected $name;

    protected $price;

    protected $vat;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getId() {
        return $this->id;
    }

    public function getCode() {
        return $this->code;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getVat() {
        return $this->vat;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setVat($vat) {
        $this->vat = $vat;
    }

    public function create(Location $location) {

    }

    public function getAll() {
        $location = $this->db->get('location');
        $result_array = [];
        foreach ($location->result_array() as $row ) {
            $result_array[] = $this->loadObject($row);
        }
        return $result_array;
    }

    public function get($id) {
        $this->db->where('id', $id);
        $location = $this->db->get('location');
        return $this->loadObject($location->row_array());
    }

    public function update(Location $location) {

    }

    public function loadObject(array $result) {
        $location = new Location();
        $location->setId($result['id']);
        $location->setCode($result['code']);
        $location->setName($result['name']);
        $location->setPrice($result['price']);
        $location->setVat($result['vat']);
        return $location;
    }
    

}