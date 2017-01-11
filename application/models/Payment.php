<?php 

class Payment extends CI_Model
{
	public $id;
	public $parking_id;
	public $amount;

	public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getId()
    {
    	return $this->id;
    }
     public function getParkingId()
    {
    	return $this->parking_id;
    }
     public function getAmount()
    {
    	return $this->amount;
    }

     public function setId($id)
    {
    	$this->id = $id;
    }
     public function setParkingId($parking_id)
    {
    	$this->parking_id = $parking_id;
    }
     public function setAmount($amount)
    {
    	$this->amount = $amount;
    }

    public function create(Payment $payment) {
        return $this->db->insert('payment', $payment);
    }

	public function getAll() {
	    $pay= $this->db->get('payment');
	    $result_array = [];
	    foreach ($pay->result_array() as $row ) {
	        $result_array[] = $this->loadObject($row);
	    }
	    return $result_array;
    }

    public function get($id) {
        $this->db->where('id', $id);
        $pay= $this->db->get('payment');
        return $this->loadObject($pay->row_array());
    }

    public function update(Parking $pay) {

    }

     public function loadObject(array $result) {
        $pay = new Park();
        $pay->setId($result['id']);
        $pay->setParkingId($result['parking_id']);
        $pay->setAmount($result['amount']);
        return $pay;
    }


}