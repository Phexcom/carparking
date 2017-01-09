<?php

class Activation extends CI_Model
{

    public $account_id;

    public $token;

    public function __construct()
    {
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

    public function create(Activation $activation) {
        return $this->db->insert('activation', $activation);
    }

    public function get($account_id, $token)
    {
        $this->db->where('account_id', $account_id);
        $activate = $this->db->get('activation');
        return $this->loadObject($activate->row_array());
    }

    public function loadObject(array $result = null)
    {
        if (!$result) {
            return false;
        }
        $activate = new Activation();
        $activate->setAccountId($result['account_id']);
        $activate->setToken($result['token']);
        return $activate;
    }
}
