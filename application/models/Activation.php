<?php

class Activation extends CI_Model
{

	protected $account_id;

    protected $token;

     public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAccountId()
    {
    	return $this->account_id;
    }

    public function getToken()
    {
    	return $this->token;
    }

    public function setAccountId($account_id)
    {
    	$this->account_id = $account_id;
    }

    public function setToken($token)
    {
    	$this->account_id = $token;
    }


	public function getAll() {
	    $activate = $this->db->get('activation');
	    $result_array = [];
	    foreach ($activate->result_array() as $row ) {
	        $result_array[] = $this->loadObject($row);
	    }
	    return $result_array;
    }

    public function get($account_id) {
        $this->db->where('account_id', $account_id);
        $activate = $this->db->get('activation');
        return $this->loadObject($activate->row_array());
    }

    public function update(Car $activate) {

    }

     public function loadObject(array $result) {
        $activate = new Activation();
        $activate->setAccountId($result['account_id']);
        $activate->setToken($result['token']);
        
        return $activate;
    }


 }