<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data_barang extends CI_Model {

    public function __construct(){
        parent::__construct();
        // $this->load->helper('guzzle_request_helper');
    }

    public function get_data_barang(){
        $query = 'SELECT * FROM barang';

        $res = $this->db->query($query);
        if($res->num_rows() > 0) {
            return $res->result_array();
        }
        return false;
        // return $q->result_array();
    }

    public function update_user($where, $data) {
        $this->db->where($where);
        $this->db->update('user', $data);
    }
}
