<?php

class Parking extends CI_Model
{
    public $reg_num;
    public $date_time;
    public $location_id;
    public $is_parked;
    public $no_hour;
    public $id;
    public $checkout;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getRegNum()
    {
        return $this->reg_num;
    }
    public function getDateTime()
    {
        return $this->date_time;
    }
    public function getLocationId()
    {
        return $this->location_id;
    }
    public function getIsParked()
    {
        return $this->is_parked;
    }
    public function getNoHour()
    {
        return $this->no_hour;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getCheckout()
    {
        return $this->checkout;
    }

    public function setRegNum($reg_num)
    {
         $this->reg_num = $reg_num;
    }
    public function setDateTime($date_time)
    {
         $this->date_time = $date_time;
    }
    public function setLocationId($location_id)
    {
         $this->location_id = $location_id;
    }

    public function setIsParked($is_parked)
    {
            $this->is_parked = $is_parked;
    }
    public function setNoHour($no_hour)
    {
         $this->no_hour = $no_hour;
    }
    public function setId($id)
    {
         $this->id = $id;
    }

    public function setCheckout($checkout)
    {
         $this->checkout = $checkout;
    }

    public function create(Parking $parking)
    {
        unset($parking->is_parked);
        unset($parking->checkout);
        return $this->db->insert('parking', $parking);
    }

    public function getAll()
    {
        $this->db->select(
            'parking.id, parking.reg_num, parking.date_time, parking.no_hour,'.
            'location.name, payment.amount'
        );
        $this->db->from('parking');
        $this->db->where('parking.is_parked', 1);
        $this->db->join('location', 'parking.location_id = location.id');
        $this->db->join('payment', 'payment.parking_id = parking.id');

        $parkings = $this->db->get();
        return $parkings->result();
    }

    public function getOvertimeParkings()
    {
        $this->db->select(
            'parking.id, parking.reg_num, parking.date_time, parking.no_hour,'.
            'location.name, payment.amount, parking.checkout'
        );
        $this->db->from('parking');
        $this->db->where('parking.checkout > DATE_ADD(parking.date_time, INTERVAL parking.no_hour HOUR)');
        $this->db->join('location', 'parking.location_id = location.id');
        $this->db->join('payment', 'payment.parking_id = parking.id');
        $parkings = $this->db->get();
        return $parkings->result();
    }

    public function getById($parking_id)
    {
        $this->db->where('id', $parking_id);
        $park = $this->db->get('parking');
        if (!$park->row_array()) {
            return false;
        }
        return $this->loadObject($park->row_array());
    }

    public function get($reg_num)
    {
        $this->db->where('reg_num', $reg_num);
        $park = $this->db->get('parking');
        return $this->loadObject($park->row_array());
    }

    public function checkout(Parking $parking)
    {
        $this->db->where('id', $parking->getId());
        $this->db->set('is_parked', 0);
        $this->db->set('checkout', date('Y-m-d H:i:s'));
        $this->db->update('parking');
    }

    public function checkParked($car_reg_num)
    {
        $this->db->where('reg_num', $car_reg_num);
        $this->db->where('is_parked', 1);
        $park = $this->db->get('parking');
        $result_array = [];
        foreach ($park->result_array() as $row) {
            $result_array[] = $this->loadObject($row);
        }
        return $result_array;
    }

    public function loadObject(array $result)
    {
        $park = new Parking();
        $park->setRegNum($result['reg_num']);
        $park->setDateTime($result['date_time']);
        $park->setLocationId($result['location_id']);
        $park->setIsParked($result['is_parked']);
        $park->setId($result['id']);
        $park->setNoHour($result['no_hour']);
        $park->setCheckout($result['checkout']);
        return $park;
    }
}
