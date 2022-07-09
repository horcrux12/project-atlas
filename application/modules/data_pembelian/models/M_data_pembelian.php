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

    public function get_detail_pembelian ($idPembelian){
        $query = 'SELECT 
            dp.id, u.id AS id_user, u.nama,
            dp.status, dp.tanggal_pembelian,
            dp.tanggal_persetujuan, dpl.alamat,
            dp.pesan
        FROM data_pembelian AS dp
        LEFT JOIN user AS u ON dp.id_user = u.id
        LEFT JOIN data_pelanggan AS dpl ON u.id = dpl.id 
        WHERE dp.id = ? ';

        $params = array($idPembelian);

        if ($this->session->userdata('level') != 1) {
            $query .= ' AND u.id = ? ';
            array_push($params, $this->session->userdata('id_login'));
        }

        $res = $this->db->query($query, $params);
        if($res->num_rows() > 0) {
            return $res->row_array();
        }
        return [];
    }

    public function get_data_keranjang ($idPembelian) {
        $query = 'SELECT
            kp.*, b.nama_barang, b.harga, b.stok
        FROM keranjang_pembelian AS kp
        LEFT JOIN barang AS b ON kp.id_barang = b.id
        INNER JOIN data_pembelian AS dp ON kp.id_pembelian = dp.id
        LEFT JOIN user AS u ON dp.id_user = u.id
        WHERE dp.id = ? ';

        $params = array($idPembelian);

        if ($this->session->userdata('level') != 1) {
            $query .= ' AND u.id = ? ';
            array_push($params, $this->session->userdata('id_login'));
        }

        $res = $this->db->query($query, $params);
        if($res->num_rows() > 0) {
            return $res->result_array();
        }
        return [];
    }

    public function update_user($where, $data) {
        $this->db->where($where);
        $this->db->update('user', $data);
    }

    public function get_barang_from_keranjang($id) {
        $query = 'SELECT 
            b.*
        FROM keranjang_pembelian AS kp
        INNER JOIN barang AS b ON kp.id_barang = b.id 
        WHERE kp.id = ? ';
        
        $res = $this->db->query($query, array($id));
        if($res->num_rows() > 0) {
            return $res->row_array();
        }
        return [];
    }
}
