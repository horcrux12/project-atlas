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
  			<script src="'.base_url().'assets/js/custom-js/table-barang.js"></script>
		';
		$page_content["title"] 					= "Data Barang";
		$page_content["data"]["data_barang"] 	= $this->m_data_barang->get_data_barang();
		$page_content["page"] 					= 'barang/table';
		
		$this->templates->pageTemplates($page_content);
	}

	public function tambah_pembelian_barang(){
		$page_content['css'] = '
			<link rel="stylesheet" href="'.base_url().'assets/vendors/select2/select2.min.css">
			<link rel="stylesheet" href="'.base_url().'assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
			<link rel="stylesheet" href="'.base_url().'assets/vendors/jquery-bar-rating/examples.css">
			<link rel="stylesheet" href="'.base_url().'assets/vendors/font-awesome/css/font-awesome.min.css">
  			<link rel="stylesheet" href="'.base_url().'assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
		';
		$page_content['js'] = '
			<script src="'.base_url().'assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
			<script src="'.base_url().'assets/vendors/select2/select2.min.js"></script>
			<script src="'.base_url().'assets/js/file-upload.js"></script>
			<script src="'.base_url().'assets/js/typeahead.js"></script>
			<script src="'.base_url().'assets/js/select2.js"></script>
			<script src="'.base_url().'assets/vendors/sweetalert/sweetalert.min.js"></script>
			<script src="'.base_url().'assets/js/bt-maxLength.js"></script>
			<script src="'.base_url().'assets/js/formpickers.js"></script>
			<script src="'.base_url().'assets/js/custom-js/tambah-transasksi-barang.js"></script>
		';
		$page_content['title'] 			= 'Tambah Transaksi Stok';
		$page_content['page'] 			= 'barang/tambah_barang';
		$page_content['data']['barang'] = $this->m_data_barang->get_data_barang();

		$this->templates->pageTemplates($page_content); 
	}

	public function table_transaksi_stok(){
		$page_content["css"] = '
			<link rel="stylesheet" href="'.base_url().'assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
		';
		$page_content['js'] = '
			<script src="'.base_url().'assets/vendors/datatables.net/jquery.dataTables.js"></script>
			<script src="'.base_url().'assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
			<script src="'.base_url().'assets/vendors/sweetalert/sweetalert.min.js"></script>
			<script src="'.base_url().'assets/js/dataPelanggan.js"></script>
			<script src="'.base_url().'assets/js/data-table.js"></script>
			<script src="'.base_url().'assets/js/modal-demo.js"></script>
		';
		$page_content['title'] 						= 'Table Transaksi Stok';
		$page_content['page'] 						= 'barang/table_transaksi_stok';
		$page_content['data']['transaksi_stok'] 	= $this->m_dinamic->getData('transaksi_barang')->result_array();

		$this->templates->pageTemplates($page_content); 
	}

	public function detail_transaksi($id){
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
		$page_content['title'] = 'Detail Transaksi Stok';
		$page_content['page'] = 'barang/detail_transaksi';
		$page_content['data']['data_transaksi'] = $this->m_dinamic->getWhere('transaksi_barang', 'id',$id)->row_array();
		$page_content['data']['data_detail_transaksi'] = $this->m_data_barang->get_detail_transaksi_stok($id);
		
		// print_r($page_content);
		$this->templates->pageTemplates($page_content); 
	}

	// Process
	public function kurangi_stock ($id) {
		$input 			= $this->input->post();
		$barang_on_db 	= [];
		$resultWhere 	= $this->m_dinamic->getWhere('barang', 'id', $id);
		
		if ($resultWhere->num_rows() > 0) {
			$barang_on_db = $resultWhere->row_array();
		}else{
			echo "<script>
			alert('Oopss! data tidak ditemukan');
			window.history.back();
			</script>";
		}

		$data_barang = array(
			'stok' => $barang_on_db['stok'] - $input['kurangi_stok']
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
		$input 			= $this->input->post();
		$data_barang 	= array(
			'nama_barang' => $input['nama_barang'],
			'harga' => $input['harga']
		);

		$ids 			= $this->m_dinamic->input_data($data_barang, 'barang');

		if ($ids > 0){
			redirect('data-barang');
		}else {
			echo "<script>
			alert('Oopss! penambahan data barang gagal');
			window.history.back();
			</script>";
		}
	}

	public function hapus_stock ($id) {
		$barang_on_db 	= [];
		$resultWhere 	= $this->m_dinamic->getWhere('barang', 'id', $id);
		if ($resultWhere->num_rows() > 0) {
			$barang_on_db = $resultWhere->row_array();
		}else{
			echo "<script>
			alert('Oopss! data tidak ditemukan');
			window.history.back();
			</script>";
		}

		$data_barang = array(
			'deleted' => true
		);

		if ($this->m_dinamic->update_data('id', $id,  $data_barang, 'barang')){
			$data['data'] = '
			<script src="'.base_url().'assets/vendors/sweetalert/sweetalert.min.js"></script>
			<script>
				swal("Berhasil menghapus barang", {
					icon: "success",
				}).
				then(() => {
					window.location.href = "'.base_url().'data-barang"
				})
			</script>';
			$this->load->view('templates/kosong', $data);
		}else {
			echo "<script>
			alert('Oopss! penambahan stok data gagal');
			window.history.back();
			</script>";
		}
	}

	public function store_transaksi_stok(){
		$input = json_decode(file_get_contents('php://input'),true);
		$dataTransaksiStok = array(
			'nama_pengirim' 	=> $input['nama_pengirim'],
			'nomor_polisi' 		=> $input['nomor_polisi'],
			'nomor_do' 			=> $input['nomor_do'],
			'nomor_so_sa' 		=> $input['nomor_so_sa'],
			'nomor_shipment' 	=> $input['nomor_shipment'],
			'tanggal_transaksi' => date('Y-m-d H:i:s', strtotime($input['tanggal_transaksi'])),
			'status_transaksi' 	=> 'Penambahan'
		);
		$dataDetailTransaksi 	= array();
		$idTransaksiStok 		= $this->m_dinamic->input_data($dataTransaksiStok, 'transaksi_barang');
		
		if($idTransaksiStok < 1) {
			show_error('Gagal menambahkan data pembelian');
		}

		foreach ($input['data_barang'] as $value) {
			$dataBarang = $this->m_data_barang->get_barang($value['id']);
			
			if (isset($dataBarang['stok'])) {
				$totalBarang = $dataBarang['stok'] + $value['jumlah_pembelian'];
			}else {
				show_error('Data barang tidak ditemukan');
			}
			
			array_push($dataDetailTransaksi, array(
				'id_barang' 	=> $value['id'],
				'id_transaksi' 	=> $idTransaksiStok,
				'jumlah' 		=> $value['jumlah_pembelian']
			));

			$updated_barang = array(
				'stok' => $totalBarang
			);

			$this->m_dinamic->update_data('id',$dataBarang['id'],$updated_barang,'barang');
		}

		$this->m_dinamic->store_batch('detail_transaksi_barang', $dataDetailTransaksi);

		echo json_encode(array('status' => "sukses"));
	}
}
