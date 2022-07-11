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
			<script src="'.base_url().'assets/js/custom-js/table-pembelian.js"></script>
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
		$page_content['css'] = '
			<style>
				@media print {
					body * {
						visibility: hidden;
					}
					#section-to-print, #section-to-print * {
						visibility: visible;
					}
					#section-to-print {
						position: absolute;
						left: 0;
						top: 0;
					}
				}
			</style>
		';
		$page_content['js'] = '';
		$page_content['title'] = 'Detail Pembelian';
		$page_content['page'] = 'data_pembelian/detail_pembelian';
		$page_content['data']['data_pembelian'] = $this->m_data_pembelian->get_detail_pembelian($id);
		$page_content['data']['data_keranjang'] = $this->m_data_pembelian->get_data_keranjang($id);
		
		// print_r($page_content);
		$this->templates->pageTemplates($page_content); 
	}

	public function tambah_pembelian(){
		$page_content['css'] = '';
		$page_content['js'] = '
			<script src="'.base_url().'assets/vendors/jquery-validation/jquery.validate.min.js"></script>
			<script src="'.base_url().'assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
			<script src="'.base_url().'assets/vendors/sweetalert/sweetalert.min.js"></script>
			<script src="'.base_url().'assets/js/bt-maxLength.js"></script>
			<script src="'.base_url().'assets/js/custom-js/tambah-pembelian.js"></script>
		';
		$page_content['title'] = 'Tambah Pembelian';
		$page_content['page'] = 'data_pembelian/tambah_pembelian';
		$page_content['data']['barang'] = $this->m_data_barang->get_data_barang();

		$this->templates->pageTemplates($page_content); 
	}

	public function proses_pembelian($id){
		$page_content['css'] = '';
		$page_content['js'] = '
			<script src="'.base_url().'assets/vendors/jquery-validation/jquery.validate.min.js"></script>
			<script src="'.base_url().'assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
			<script src="'.base_url().'assets/vendors/sweetalert/sweetalert.min.js"></script>
			<script src="'.base_url().'assets/js/bt-maxLength.js"></script>
			<script src="'.base_url().'assets/js/custom-js/proses-pembelian.js"></script>
		';
		$page_content['title'] = 'Proses Pembelian';
		$page_content['page'] = 'data_pembelian/proses_pembelian';
		$page_content['data']['data_pembelian'] = $this->m_data_pembelian->get_detail_pembelian($id);
		$page_content['data']['data_keranjang'] = $this->m_data_pembelian->get_data_keranjang($id);
		
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

		$pesan = 'Pembelian dari '.$this->session->userdata('nama');
		$dataAdmin = $this->m_dinamic->getWhere('user', 'level', 1)->row_array();
		$dataNotifikasi = array(
			'notif_from' => $this->session->userdata('id_login'),
			'notif_to' => $dataAdmin['id'],
			'id_pembelian' => $idPembelian,
			'pesan' => $pesan
		);
		$this->m_dinamic->input_data($dataNotifikasi, 'notif');

		echo json_encode(array('status' => "sukses"));
	}

	public function hapus_pembelian ($id) {
		// $this->m_dinamic->delete_data('data_pembelian', 'id', $id);

		$data['data'] = '
		<script src="'.base_url().'assets/vendors/sweetalert/sweetalert.min.js"></script>
		<script>
			swal("Berhasil menghapus pembelian", {
                icon: "success",
            }).
			then(() => {
				window.location.href = "'.base_url().'data-pembelian"
			})
		</script>';
		$this->load->view('data_pembelian/kosong', $data);
	}

	public function store_proses_pembelian() {
		$input = $this->input->post();
		$dataKeranjang = array();
		
		$dataPembelian = array(
			'status' => $input['status'],
			'pesan' => $input['pesan'],
			'tanggal_persetujuan' => date('Y-m-d H:i:s')
		);

		$this->m_dinamic->update_data('id', $input['id_pembelian'], $dataPembelian, 'data_pembelian');

		if($input['status'] == "Disetujui"){
			for ($i=0; $i < count($input['id']); $i++) { 
				$dataBarang = $this->m_data_pembelian->get_barang_from_keranjang($input['id'][$i]);
				if (isset($dataBarang['stok'])) {
					$sisaBarang = $dataBarang['stok'] - $input['jumlah_disetujui'][$i];
					if($sisaBarang < 0){
						alert_error('Stok tidak tersedia', 'data-pembelian');
					}
				}else {
					alert_error('Data barang tidak ditemukan', 'data-pembelian');
				}

				$dataKeranjang = array(
					'jumlah_disetujui' => $input['jumlah_disetujui'][$i]
				);

				$dataBarangAfter = array(
					'stok' => $sisaBarang
				);
				$this->m_dinamic->update_data('id', $input['id'][$i], $dataKeranjang, 'keranjang_pembelian');
				$this->m_dinamic->update_data('id', $dataBarang['id'], $dataBarangAfter, 'barang');
			}
		}

		$pesan = "Pembelian ".$input['status'];
		$dataNotifikasi = array(
			'notif_from' => $this->session->userdata('id_login'),
			'notif_to' => $input['id_user'],
			'id_pembelian' => $input['id_pembelian'],
			'pesan' => $pesan
		);
		$this->m_dinamic->input_data($dataNotifikasi, 'notif');

		$data['data'] = '
		<script src="'.base_url().'assets/vendors/sweetalert/sweetalert.min.js"></script>
		<script>
			swal("Berhasil memproses pembelian", {
                icon: "success",
            }).
			then(() => {
				window.location.href = "'.base_url().'data-pembelian"
			})
		</script>';
		$this->load->view('data_pembelian/kosong', $data);
	}

	public function print_pembelian($id){
		$page_content['css'] = '';
		$page_content['js'] = '';
		$page_content['title'] = 'Detail Pembelian';
		$page_content['page'] = 'data_pembelian/detail_pembelian';
		$page_content['data']['data_pembelian'] = $this->m_data_pembelian->get_detail_pembelian($id);
		$page_content['data']['data_keranjang'] = $this->m_data_pembelian->get_data_keranjang($id);
		
		// print_r($page_content);
		$this->templates->pageTemplates($page_content); 
	}
}
