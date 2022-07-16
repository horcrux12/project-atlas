<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data_barang extends CI_Model {

    public function __construct(){
        parent::__construct();
        // $this->load->helper('guzzle_request_helper');
    }

    public function get_data_barang(){
        $query = 'SELECT * FROM barang
        WHERE deleted = false';

        $res = $this->db->query($query);
        if($res->num_rows() > 0) {
            return $res->result_array();
        }
        return false;
        // return $q->result_array();
    }

    public function get_barang($id) {
        $query = 'SELECT * FROM barang
        WHERE id = ? AND deleted = false';

        $res = $this->db->query($query, array($id));
        if($res->num_rows() > 0) {
            return $res->row_array();
        }
        return '';
    }

    public function update_user($where, $data) {
        $this->db->where($where);
        $this->db->update('user', $data);
    }

    public function get_detail_transaksi_stok($id) {
        $query = 'SELECT dtb.*, b.nama_barang 
        FROM detail_transaksi_barang AS dtb
        INNER JOIN transaksi_barang AS tb ON dtb.id_transaksi = tb.id 
        INNER JOIN barang AS b ON dtb.id_barang = b.id
        WHERE tb.id = ? ';

        $res = $this->db->query($query, array($id));
        if($res->num_rows() > 0) {
            return $res->result_array();
        }
        return [];
    }
}
