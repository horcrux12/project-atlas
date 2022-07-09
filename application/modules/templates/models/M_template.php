<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_template extends CI_Model {

    public function __construct(){
        parent::__construct();
        // $this->load->helper('guzzle_request_helper');
    }

    public function getNotification(){
        $query = 'SELECT 
            n.*, u.nama  
        FROM notif AS n
        LEFT JOIN user AS u ON n.notif_to = u.id
        WHERE n.status = ? AND notif_to = ?';

        $res = $this->db->query($query, array("Unread", $this->session->userdata('id_login')));
        if($res->num_rows() > 0) {
            return $res->result_array();
        }
        return [];
        // return $q->result_array();
    }
}
