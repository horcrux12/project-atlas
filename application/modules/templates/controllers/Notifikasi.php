<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends MY_Controller {

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
        // $this->load->helper('guzzle_request_helper');
        $this->load->model('templates/m_template');
    }

	public function readNotifikasi()
	{
		$input = json_decode(file_get_contents('php://input'),true);
		$data = array(
			'status' => $input['status']
		);

		$this->m_dinamic->update_data('id', $input['id'], $data, 'notif');

		echo json_encode($input);
	}
}
