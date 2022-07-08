<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MX_Controller {


    public function __construct(){
        parent::__construct();
        $this->load->model('user/m_login_super');
    }

	public function index()
	{
        $this->load->view('view_register');
    }
    
    public function register_user()
    {
        $input = $this->input->post();
        $password = md5($input['password']);
        $dataPelanggan = array(
            'nama_pelanggan' => $input['nama'],
            'alamat' => $input['alamat'],
        );

        $idPelanggan = $this->m_login_super->register_pelanggan($dataPelanggan);

        $dataUser = array(
            'username' => $input['username'],
            'password' => $password,
            'nama' => $input['nama'],
            'level' => 2,
            'id_pelanggan' => $idPelanggan
        );

        $this->m_login_super->register_user($dataUser);

        echo "<script>
            alert('Registrasi Berhasil, Silahkan tunggu konfirmasi admin untuk melakukan login');
            window.location.href='".base_url('login')."';
            </script>";
    }
}
