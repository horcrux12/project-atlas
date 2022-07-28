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
			<link rel="stylesheet" href="'.base_url().'assets/vendors/dropzone/dropzone.css">
			<link rel="stylesheet" href="'.base_url().'assets/vendors/dropify/dropify.min.css">
			<link rel="stylesheet" href="'.base_url().'assets/vendors/jquery-file-upload/uploadfile.css">
			<link rel="stylesheet" href="'.base_url().'assets/vendors/lightgallery/css/lightgallery.css">
		';
		$page_content["js"] = '
			<script src="'.base_url().'assets/vendors/datatables.net/jquery.dataTables.js"></script>
			<script src="'.base_url().'assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
			<script src="'.base_url().'assets/vendors/sweetalert/sweetalert.min.js"></script>
			<script src="'.base_url().'assets/js/dataPelanggan.js"></script>
			<script src="'.base_url().'assets/js/data-table.js"></script>
			<script src="'.base_url().'assets/vendors/dropify/dropify.min.js"></script>
			<script src="'.base_url().'assets/vendors/jquery-file-upload/jquery.uploadfile.min.js"></script>
			<script src="'.base_url().'assets/vendors/dropzone/dropzone.js"></script>
			<script src="'.base_url().'assets/js/dropify.js"></script>
			<script src="'.base_url().'assets/js/dropzone.js"></script>
			<script src="'.base_url().'assets/js/jquery-file-upload.js"></script>
			<script src="'.base_url().'assets/js/custom-js/table-pembelian.js"></script>
			<script src="'.base_url().'assets/vendors/lightgallery/js/lightgallery-all.min.js"></script>
			<script src="'.base_url().'assets/js/light-gallery.js"></script>
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
		$page_content['css'] = '
			<link rel="stylesheet" href="'.base_url().'assets/vendors/select2/select2.min.css">
			<link rel="stylesheet" href="'.base_url().'assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
		';
		$page_content['js'] = '
			<script src="'.base_url().'assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
			<script src="'.base_url().'assets/vendors/select2/select2.min.js"></script>
			<script src="'.base_url().'assets/js/file-upload.js"></script>
			<script src="'.base_url().'assets/js/typeahead.js"></script>
			<script src="'.base_url().'assets/js/select2.js"></script>
			<script src="'.base_url().'assets/vendors/jquery-validation/jquery.validate.min.js"></script>
			<script src="'.base_url().'assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
			<script src="'.base_url().'assets/vendors/sweetalert/sweetalert.min.js"></script>
  			<script src="'.base_url().'assets/js/modal-demo.js"></script>
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
				'id_barang' => $input[$i]['id_barang'],
				'id_pembelian' => $idPembelian,
				'jumlah_pembelian' => $input[$i]['jumlah_pembelian']
			));
		}

		$this->m_dinamic->store_batch('keranjang_pembelian', $dataKeranjang);

		$pesan = 'Pembelian dari '.$this->session->userdata('nama');
		$dataAdmin = $this->m_dinamic->getWhere('user', 'level', 1)->result_array();
		for ($i=0; $i < count($dataAdmin); $i++) { 
			$dataNotifikasi = array(
				'notif_from' 	=> $this->session->userdata('id_login'),
				'notif_to' 		=> $dataAdmin[$i]['id_user'],
				'id_pembelian' 	=> $idPembelian,
				'pesan' 		=> $pesan
			);
			$this->m_dinamic->input_data($dataNotifikasi, 'notif');
		}
		

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

		$this->m_dinamic->update_data('id_pembelian', $input['id_pembelian'], $dataPembelian, 'data_pembelian');

		if($input['status'] == "Menunggu Pembayaran"){
			
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
				$this->m_dinamic->update_data('id_keranjang', $input['id'][$i], $dataKeranjang, 'keranjang_pembelian');
				$this->m_dinamic->update_data('id_barang', $dataBarang['id_barang'], $dataBarangAfter, 'barang');
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

	public function store_bukti_pembayaran($id){
		
		$input 				= $_FILES;
		$dataPembelian 		= $this->m_dinamic->getWhere ('data_pembelian','id_pembelian', $id)->row_array();

		$nama_gambar = $_FILES['bukti_pembayaran']['name'];

		$config['upload_path']          = './assets/images/uploads/bukti-pembayaran/';
		$config['allowed_types'] 		= '*';
		$config['file_name']            = $nama_gambar;
		$config['overwrite']			= false;

		$this->load->library('upload', $config);

		$this->upload->initialize($config);
		if ($this->upload->do_upload("bukti_pembayaran")) {
			$gambar = $this->upload->data("file_name");
		}else{
			echo "<script>
			alert('".$this->upload->display_errors()."');
			</script>";
		}
		
		$data_pembelian = array(
			'bukti_pembayaran'	=> $gambar,
			'status' => 'Menunggu Konfirmasi Pembayaran'
		);

		$save_pembelian		= $this->m_dinamic->update_data('id_pembelian', $id, $data_pembelian, 'data_pembelian');

		if ($save_pembelian) {
			echo "<script>
			alert('Data Berhasil ditambah');
			window.location.href='".base_url('data-pembelian')."';
			</script>";
		}else{
			echo "<script>
			alert('Data Gagal ditambah');
			window.history.back();
			</script>";
		}
	}

	public function acc_pembelian($id){
		$data_pembelian = array(
			'status' => 'Selesai'
		);
		$save_pembelian		= $this->m_dinamic->update_data('id_pembelian', $id, $data_pembelian, 'data_pembelian');
		if ($save_pembelian) {
			echo "<script>
			alert('Data Berhasil dikonfirmasi');
			window.location.href='".base_url('data-pembelian')."';
			</script>";
		}else{
			echo "<script>
			alert('Data Gagal ditambah');
			window.history.back();
			</script>";
		}
	}
}
