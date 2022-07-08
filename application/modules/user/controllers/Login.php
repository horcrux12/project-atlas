<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {


    public function __construct(){
        parent::__construct();
        $this->load->model('user/m_login_super');
    }

	public function index()
	{
        if (isset($this->session->userdata['logged'])) {
            redirect('dashboard');
        }
        $this->load->view('view_login');
    }
    
    public function authentication()
    {
        $username = $this->input->post('username');
        $level = $this->input->post('level');
        $password_raw = $this->input->post('password');
        $password = md5($password_raw);

        $response = $this->m_login_super->authentication($username,$password,$level);
        if ($response != '') {
            if($response[0]['status'] == "Aktif"){
                $data_session = [
                    'id_login' => $response[0]['id'],
                    'nama' => $response[0]['nama'],
                    'level' => $response[0]['level'],
                    'logged' => 1
                ];
                
                $this->session->set_userdata($data_session);
                redirect('dashboard');  
            }else{
                echo "<script>
                alert('Oopss! User belum aktif');
                window.history.back();
                </script>";
                // echo
            }
            
        }else{
            echo "<script>
            alert('Oopss! Kombinasi salah');
            window.location.href='".base_url('login')."';
            </script>";
        }

    }
    
    public function logout()
    {
        $this->session->sess_destroy();
		redirect('login');
    }

    public function register(){
        $this->load->view('view_login');
    }
}
