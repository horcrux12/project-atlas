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
        LEFT JOIN detail_transaksi_barang AS dtb ON tb.id_transaksi = dtb.id_transaksi
        WHERE tb.tanggal_transaksi >= ?
        GROUP BY MONTH(tb.tanggal_transaksi)';

        $res = $this->db->query($query, array($date));
        if($res->num_rows() > 0) {
            return $res->result_array();
        }
        return [];
    }

    public function get_grafik_user($date) {
        $query = 'SELECT MONTH(dp.tanggal_pembelian) AS bulan , SUM(kp.jumlah_disetujui) AS jumlah
        FROM data_pembelian AS dp
        LEFT JOIN keranjang_pembelian AS kp ON dp.id_pembelian = kp.id_pembelian
        WHERE dp.tanggal_pembelian >= ? AND dp.id_user = ?
        GROUP BY MONTH(dp.tanggal_pembelian)';

        $res = $this->db->query($query, array($date, $this->session->userdata('id_login')));
        if($res->num_rows() > 0) {
            return $res->result_array();
        }
        return [];
    }

    
}
