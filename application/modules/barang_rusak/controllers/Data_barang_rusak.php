<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_barang_rusak extends MY_Controller {

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
        $this->load->model('barang_rusak/m_data_barang_rusak');
		if ($this->session->userdata('level') != 1){
			redirect('dashboard');
		}
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
  			<script src="'.base_url().'assets/js/modal-demo.js"></script>
  			<script src="'.base_url().'assets/js/custom-js/table-barang-rusak.js"></script>
		';
		$page_content["title"] 					= "Data Barang Rusak";
		$page_content["data"]["data_barang_rusak"] 	= $this->m_data_barang_rusak->get_data_barang_rusak();
		$page_content["page"] 					= 'barang_rusak/table';
		
		$this->templates->pageTemplates($page_content);
	}

	public function tambah_barang_rusak(){
		$page_content['css'] = '
			<link rel="stylesheet" href="'.base_url().'assets/vendors/select2/select2.min.css">
			<link rel="stylesheet" href="'.base_url().'assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
			<link rel="stylesheet" href="'.base_url().'assets/vendors/jquery-bar-rating/examples.css">
			<link rel="stylesheet" href="'.base_url().'assets/vendors/font-awesome/css/font-awesome.min.css">
  			<link rel="stylesheet" href="'.base_url().'assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
		';
		$page_content['js'] = '
			<script src="'.base_url().'assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
			<script src="'.base_url().'assets/js/typeahead.js"></script>
			<script src="'.base_url().'assets/vendors/sweetalert/sweetalert.min.js"></script>
			<script src="'.base_url().'assets/js/custom-js/tambah-barang-rusak.js"></script>
		';
		$page_content['title'] 			= 'Tambah Barang Rusak';
		$page_content['page'] 			= 'barang_rusak/tambah_barang';
		$page_content['data']['barang'] = $this->m_dinamic->getData('barang')->result_array();

		$this->templates->pageTemplates($page_content); 
	}

	// Process
	public function hapus_barang_rusak ($id) {
		$resultWhere 	= $this->m_dinamic->getWhere('barang_rusak', 'id_barang_rusak', $id);
		
		if ($resultWhere->num_rows() > 0) {
			$barang_on_db = $resultWhere->row_array();
		}else{
			echo "<script>
			alert('Oopss! data tidak ditemukan');
			window.history.back();
			</script>";
		}

		if ($this->m_dinamic->delete_data('barang_rusak', 'id_barang_rusak', $id)){
			redirect('barang-rusak');
		}else {
			echo "<script>
			alert('Oopss! penambahan stok data gagal');
			window.history.back();
			</script>";
		}
	}

	public function store_barang_rusak () {
		$input 			= $this->input->post();
		$data_barang 	= array(
			'id_barang' 			=> $input['barang'],
			'jumlah' 				=> $input['jumlah'],
			'tanggal_penempatan' 	=> date('Y-m-d H:i:s')
		);

		$ids 			= $this->m_dinamic->input_data($data_barang, 'barang_rusak');

		if ($ids > 0){
			redirect('barang-rusak');
		}else {
			echo "<script>
			alert('Oopss! penambahan data barang gagal');
			window.history.back();
			</script>";
		}
	}
}
