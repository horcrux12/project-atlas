<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pembelian extends MY_Controller {

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
        $this->load->model('data_pembelian/m_data_pembelian');
        $this->load->model('barang/m_data_barang');
		// access_user(1, 'dashboard');
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
		$page_content["title"] = "Data Pembelian";
		if($this->session->userdata('level') == 1){
			$page_content["data"]["data_pembelian"] = $this->m_data_pembelian->get_data_pembelian_for_admin();
		}else{
			$page_content["data"]["data_pembelian"] = $this->m_data_pembelian->get_data_pembelian_for_user();
		}
		$page_content["page"] = 'data_pembelian/table';
		
		$this->templates->pageTemplates($page_content); 
	}

	public function detail_pembelian($id){
		$page_content['css'] = '';
		$page_content['js'] = '';
		$page_content['title'] = 'Detail Pembelian';
		$page_content['page'] = '';
		$page_content['data'] = '';
	}

	public function tambah_pembelian(){
		$page_content['css'] = '';
		$page_content['js'] = '
			<script src="'.base_url().'assets/vendors/jquery-validation/jquery.validate.min.js"></script>
			<script src="'.base_url().'assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
			<script src="'.base_url().'assets/js/bt-maxLength.js"></script>
			<script src="'.base_url().'assets/js/custom-js/tambah-pembelian.js"></script>
		';
		$page_content['title'] = 'Tambah Pembelian';
		$page_content['page'] = 'data_pembelian/tambah_pembelian';
		$page_content['data']['barang'] = $this->m_data_barang->get_data_barang();

		$this->templates->pageTemplates($page_content); 
	}

	public function store_pembelian(){
		$input = json_decode(file_get_contents('php://input'),true);
		$dataKeranjang = array();
		$dataPembelian = array(
			'id_user' => $this->session->userdata('id_login'),
			'tanggal_pembelian' => date('Y-m-d H:i:s')
		);

		$idPembelian = $this->m_dinamic->input_data($dataPembelian, 'data_pembelian');
		if($idPembelian < 1) {
			show_error('Gagal menambahkan data pembelian');
		}

		for ($i=0; $i < count($input); $i++) { 
			array_push($dataKeranjang, array(
				'id_barang' => $input[$i]['id'],
				'id_pembelian' => $idPembelian,
				'jumlah_pembelian' => $input[$i]['jumlah_pembelian']
			));
		}

		$this->m_dinamic->store_batch('keranjang_pembelian', $dataKeranjang);

		echo json_encode(array('status' => "sukses"));
	}
}
