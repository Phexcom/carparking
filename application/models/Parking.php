<?php 

class Parking extends CI_Model
{
	protected $regNum;
	protected $dateTime;
	protected $locationId;
	protected $isParked;
	protected $noHour;
	protected $id;
	protected $checkout;

	public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getRegNum()
    {
    	return $this->regNum;
    }
     public function getDateTime()
    {
    	return $this->dateTime;
    }
     public function getLocationId()
    {
    	return $this->locationId;
    }
     public function getIsParked()
    {
    	return $this->isParked;
    }
     public function getNoHour()
    {
    	return $this->noHour;
    }
     public function getId()
    {
    	return $this->id;
    }
     public function getCheckout()
    {
    	return $this->checkout;
    }

    public function setRegNum($regNum)
    {
    	 $this->regNum = $regNum;
    }
    public function setDateTime($dateTime)
    {
    	 $this->dateTime = $dateTime;
    }
    public function setLocationId($locationId)
    {
    	 $this->locationId = $locationId;
    }

    public function setIsParked($isParked)
    {
    	 $this->isParked = $isParked;
    }
    public function setNoHour($noHour)
    {
    	 $this->noHour = $noHour;
    }
    public function setId($id)
    {
    	 $this->id = $id;
    }

    public function setCheckout($checkout)
    {
    	 $this->checkout = $checkout;
    }

    public function create(Parking $car) {

    }

	public function getAll() {
	    $park = $this->db->get('parking');
	    $result_array = [];
	    foreach ($park->result_array() as $row ) {
	        $result_array[] = $this->loadObject($row);
	    }
	    return $result_array;
    }

    public function get($regId) {
        $this->db->where('reg_id', $regId);
        $park = $this->db->get('parking');
        return $this->loadObject($park->row_array());
    }

    public function update(Parking $park) {

    }

     public function loadObject(array $result) {
        $park = new Park();
        $park->setRegNum($result['reg_num']);
        $park->setDateTime($result['date_time']);
        $park->setLocationId($result['location_id']);
        $park->setIsParked($result['is_parked']);
        $park->setId($result['id']);
        $park->setCheckout($result['checkout']);
        return $park;
    }




}