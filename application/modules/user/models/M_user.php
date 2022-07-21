<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    public function __construct(){
        parent::__construct();
        // $this->load->helper('guzzle_request_helper');
    }

    function register_user($data){
        $this->db->insert('user', $data);
    }

    function register_pelanggan($data){
        $this->db->insert('data_pelanggan', $data);
        $inserted_id = $this->db->insert_id();
        return $inserted_id;
    }
}
