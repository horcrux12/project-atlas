<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data_pelanggan extends CI_Model {

    public function __construct(){
        parent::__construct();
        // $this->load->helper('guzzle_request_helper');
    }

    public function get_data_pelanggan(){
        $query = 'SELECT 
            u.id, u.username, dp.nama_pelanggan, dp.alamat, u.status
        FROM user as u
        INNER JOIN data_pelanggan as dp ON u.id_pelanggan = dp.id
        WHERE u.level = ? ';

        $q = $this->db->query($query, array(2));
        if($q->num_rows() > 0) {
            return $q->result_array();
        }
        return false;
        // return $q->result_array();
    }

    public function update_user($where, $data) {
        $this->db->where($where);
        $this->db->update('user', $data);
    }
}
