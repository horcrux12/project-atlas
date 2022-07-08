<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data_pembelian extends CI_Model {

    public function __construct(){
        parent::__construct();
        // $this->load->helper('guzzle_request_helper');
    }

    public function get_data_pembelian_for_admin(){
        $query = 'SELECT 
            dp.id, u.id AS id_user, u.nama,
            dp.status, dp.tanggal_pembelian,
            dp.tanggal_persetujuan  
        FROM data_pembelian AS dp
        LEFT JOIN user AS u ON dp.id_user = u.id';

        $res = $this->db->query($query);
        if($res->num_rows() > 0) {
            return $res->result_array();
        }
        return [];
        // return $q->result_array();
    }

    public function get_data_pembelian_for_user(){
        $query = 'SELECT 
            dp.id, u.id AS id_user, u.nama,
            dp.status, dp.tanggal_pembelian,
            dp.tanggal_persetujuan  
        FROM data_pembelian AS dp
        LEFT JOIN user AS u ON dp.id_user = u.id
        WHERE u.id = ? ';

        $res = $this->db->query($query, array($this->session->userdata('id_login')));
        if($res->num_rows() > 0) {
            return $res->result_array();
        }
        return [];
    }

    public function update_user($where, $data) {
        $this->db->where($where);
        $this->db->update('user', $data);
    }
}
