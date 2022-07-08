<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pelanggan extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
        parent::__construct();
        $this->load->model('data_pelanggan/m_data_pelanggan');
		access_user(1, 'dashboard');

		// if ($this->session->userdata('level') != 1){
		// 	redirect('dashboard');
		// }
    }
	
	public function index(){
		
		$page_content["css"] = '
			<link rel="stylesheet" href="'.base_url().'assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
		';
		$page_content["js"] = '
			<script src="'.base_url().'assets/vendors/datatables.net/jquery.dataTables.js"></script>
			<script src="'.base_url().'assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
			<script src="'.base_url().'assets/vendors/sweetalert/sweetalert.min.js"></script>
			<script src="'.base_url().'assets/js/dataPelanggan.js"></script>
			<script src="'.base_url().'assets/js/data-table.js"></script>
		';
		$page_content["title"] = "Data Pelanggan";
		$page_content["data"]["data_pelanggan"] = $this->m_data_pelanggan->get_data_pelanggan();
		$page_content["page"] = 'data_pelanggan/table';
		
		$this->templates->pageTemplates($page_content);
	}

	public function activate_user(){
		$input = json_decode(file_get_contents('php://input'),true);
		
		$where = array(
			'id' => $input['id']
		);

		$data = array(
			'status' => $input['status']
		);

		if ($this->m_data_pelanggan->update_user($where, $data)){
			echo json_encode(array('status' => "gagal"));
		}else {
			echo json_encode(array('status' => "sukses"));
		}
	}
}
