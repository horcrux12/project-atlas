<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

    public function __construct(){
        parent::__construct();
        // $this->load->helper('guzzle_request_helper');
    }

    public function get_grafik_admin($date) {
        $query = 'SELECT MONTH(tb.tanggal_transaksi) AS bulan , SUM(dtb.jumlah) AS jumlah
        FROM transaksi_barang AS tb
        LEFT JOIN detail_transaksi_barang AS dtb ON tb.id = dtb.id_transaksi
        WHERE tb.tanggal_transaksi >= ?
        GROUP BY MONTH(tb.tanggal_transaksi)';

        $res = $this->db->query($query, array($date));
        if($res->num_rows() > 0) {
            return $res->result_array();
        }
        return [];
    }

    
}
