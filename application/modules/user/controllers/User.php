<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {


    public function __construct(){
        parent::__construct();
        $this->load->model('user/m_user');
    }

	public function index()
	{
        $page_content["css"] = '
			<link rel="stylesheet" href="'.base_url().'assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
		';
		$page_content["js"] = '
			<script src="'.base_url().'assets/vendors/datatables.net/jquery.dataTables.js"></script>
			<script src="'.base_url().'assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
			<script src="'.base_url().'assets/vendors/sweetalert/sweetalert.min.js"></script>
			<script src="'.base_url().'assets/js/data-table.js"></script>
            <script src="'.base_url().'assets/js/custom-js/table-user.js"></script>
		';
		$page_content["title"] = "Data User";
		$page_content["data"]["data_user"] = $this->m_dinamic->getWhere('user', 'level', 1)->result_array();
		$page_content["page"] = 'user/tables';
		
		$this->templates->pageTemplates($page_content);
    }

    public function tambah_user()
    {
        $page_content["css"] = '
            <link rel="stylesheet" href="'.base_url().'assets/vendors/select2/select2.min.css">
            <link rel="stylesheet" href="'.base_url().'assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
		';
		$page_content["js"] = '
            <script src="'.base_url().'assets/vendors/jquery-validation/jquery.validate.min.js"></script>
            <script src="'.base_url().'assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
			<script src="'.base_url().'assets/vendors/sweetalert/sweetalert.min.js"></script>
            <script src="'.base_url().'assets/js/custom-js/form-validation-user.js"></script>
            <script src="'.base_url().'assets/js/bt-maxLength.js"></script>
		';
		$page_content["title"] = "Tambah User";
		$page_content["data"]["data_user"] = $this->m_dinamic->getWhere('user', 'level', 1)->result_array();
		$page_content["page"] = 'user/tambah_user';
		
		$this->templates->pageTemplates($page_content);
    }

    public function ubah_user($id)
    {
        $page_content["css"] = '
            <link rel="stylesheet" href="'.base_url().'assets/vendors/select2/select2.min.css">
            <link rel="stylesheet" href="'.base_url().'assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
		';
		$page_content["js"] = '
            <script src="'.base_url().'assets/vendors/jquery-validation/jquery.validate.min.js"></script>
            <script src="'.base_url().'assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
			<script src="'.base_url().'assets/vendors/sweetalert/sweetalert.min.js"></script>
            <script src="'.base_url().'assets/js/custom-js/form-validation-edit-user.js"></script>
            <script src="'.base_url().'assets/js/bt-maxLength.js"></script>
		';
		$page_content["title"] = "Edit User";
		$page_content["data"]["data_user"] = $this->m_dinamic->getWhere('user', 'id', $id)->row_array();
		$page_content["page"] = 'user/edit_user';
		
		$this->templates->pageTemplates($page_content);
    }
    
    public function register_user()
    {
        $input = $this->input->post();
        $password = md5($input['password']);

        $dataUser = array(
            'username' => $input['username'],
            'password' => $password,
            'nama' => $input['nama'],
            'level' => 1,
            'status' => 'Aktif'
        );

        $this->m_user->register_user($dataUser);

        echo "<script>
            alert('Registrasi Berhasil');
            window.location.href='".base_url('user')."';
            </script>";
    }

    public function delete_user($id) {
        $this->m_dinamic->delete_data('user', 'id', $id);
        echo "<script>
            alert('Hapus Data Berhasil');
            window.location.href='".base_url('user')."';
            </script>";
    }

    public function edit_user($id) {
        $input = $this->input->post();
        $password = md5($input['password']);

        $dataUser = array(
            'username' => $input['username'],
            'password' => $password,
            'nama' => $input['nama'],
        );

        $this->m_dinamic->update_data('id', $id, $dataUser, 'user');

        echo "<script>
            alert('Registrasi Berhasil');
            window.location.href='".base_url('user')."';
            </script>";
    }
}
?>