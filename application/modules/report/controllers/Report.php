<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Mpdf\Mpdf;

class Report extends MY_Controller {

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
		if ($this->session->userdata('level') != 1){
			redirect('dashboard');
		}
    }
	
	public function index(){
		
		$page_content["css"] = '
			<link rel="stylesheet" href="'.base_url().'assets/vendors/select2/select2.min.css">
			<link rel="stylesheet" href="'.base_url().'assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
			<link rel="stylesheet" href="'.base_url().'assets/vendors/jquery-bar-rating/examples.css">
			<link rel="stylesheet" href="'.base_url().'assets/vendors/font-awesome/css/font-awesome.min.css">
			<link rel="stylesheet" href="'.base_url().'assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
		';
		$page_content["js"] = '
			<script src="'.base_url().'assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
			<script src="'.base_url().'assets/vendors/select2/select2.min.js"></script>
			<script src="'.base_url().'assets/js/file-upload.js"></script>
			<script src="'.base_url().'assets/js/typeahead.js"></script>
			<script src="'.base_url().'assets/js/select2.js"></script>
			<script src="'.base_url().'assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
			<script src="'.base_url().'assets/vendors/sweetalert/sweetalert.min.js"></script>
			<script src="'.base_url().'assets/js/bt-maxLength.js"></script>
			<script src="'.base_url().'assets/js/formpickers.js"></script>
		';
		$page_content["title"]	= "Report Pembelian";
		$page_content["data"] 	= [];
		$page_content["page"]	= 'report/request_report';
		
		$this->templates->pageTemplates($page_content);
	}

	public function get_report_pdf(){
		$input = $this->input->post();
		
		$input['tanggal_awal'] 	= date('Y-m-d H:i:s', strtotime($input['tanggal_awal']));
		$input['tanggal_akhir'] = date('Y-m-d H:i:s', strtotime($input['tanggal_akhir']));
		
		$dataPembelian = $this->m_data_pembelian->get_report_pembelian($input);

		$data["data_pembelian"] = $dataPembelian;
		$data["tanggal_report"] = $input;

		// print_r($dataPembelian);
        $html_isi = $this->load->view('report/main_report', $data, TRUE);
        // // $mpdf->Output();
		
		$mpdf = new \Mpdf\Mpdf([
			'setAutoTopMargin' 		=> 'stretch',
			'setAutoBottomMargin' 	=> 'pad',
			'autoMarginPadding' 	=> 5,
			'mode' 					=> 'utf-8', 
			'format' 				=> 'A4-L'
		]);
		
		// LOAD a stylesheet
		$stylesheet = file_get_contents(base_url().'assets/vendors/bootstrap-for-mpdf/kv-mpdf-bootstrap.css');
		$mpdf->WriteHTML($stylesheet, 1);
		
		$mpdf->text_input_as_HTML = true;
		// Define the Header/Footer before writing anything so they appear on the first page
		// $mpdf->SetHTMLHeader($html_header);
		$mpdf->SetHTMLFooter('
		<table width="100%">
			<tr>
				<td width="33%">{DATE j-m-Y}</td>
				<td width="33%" align="center">{PAGENO}/{nbpg}</td>
				<td width="33%" style="text-align: right;">Report penjualan</td>
			</tr>
		</table>');
		$mpdf->WriteHTML($html_isi);
		$mpdf->SetTitle("Report data");

		$mpdf->Output('yourFileName.pdf', 'I'); 
	}
}
