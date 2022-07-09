<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_barang extends MY_Controller {

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
        $this->load->model('barang/m_data_barang');
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
		';
		$page_content["title"] = "Data Barang";
		$page_content["data"]["data_barang"] = $this->m_data_barang->get_data_barang();
		$page_content["page"] = 'barang/table';
		
		$this->templates->pageTemplates($page_content);
	}

	public function update_stock ($id) {
		$input = $this->input->post();
		$barang_on_db = [];

		$resultWhere = $this->m_dinamic->getWhere('barang', 'id', $id);
		if ($resultWhere->num_rows() > 0) {
			$barang_on_db = $resultWhere->row_array();
		}else{
			echo "<script>
			alert('Oopss! data tidak ditemukan');
			window.history.back();
			</script>";
		}

		$data_barang = array(
			'stok' => $barang_on_db['stok'] + $input['tambah_stok']
		);

		if ($this->m_dinamic->update_data('id', $id,  $data_barang, 'barang')){
			redirect('data-barang');
		}else {
			echo "<script>
			alert('Oopss! penambahan stok data gagal');
			window.history.back();
			</script>";
		}
	}

	public function tambah_barang () {
		$input = $this->input->post();
		$data_barang = array(
			'nama_barang' => $input['nama_barang'],
			'harga' => $input['harga']
		);

		$ids = $this->m_dinamic->input_data($data_barang, 'barang');

		if ($ids > 0){
			redirect('data-barang');
		}else {
			echo "<script>
			alert('Oopss! penambahan data barang gagal');
			window.history.back();
			</script>";
		}
	}
}
