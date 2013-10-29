<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('session');
		   $this->load->helper('url');
		   $this->load->helper('form');

	}

	function index() {
		$this->load->view('login');
	}
	function doLogin(){
		$this->load->library('form_validation');

		if ($this->input->post('btnOK'))
		{
			$this->form_validation->set_rules('username', 'Tên đăng nhập', 'required|min_length[4]');
			$this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('login');
			}
			else
			{
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$this->load->model('Musers');
				$check = $this->Musers->checkUserLogin($username, md5($password));
				if ($check->num == 0)
				{
					$this->session->set_flashdata('error','Thông tin không hợp lệ. Vui lòng thử lại');
					redirect('users/login/');
				}
				else
				{
					$user_id = $check->id;
					$role = $check->role;
					$isview = $check->isview;
					$isupdate = $check->isupdate;
					$user = $check->username;
					$donvi = $check->donvi;
					$this->session->set_userdata('isLogin',1);
					$this->session->set_userdata('idcanbo', $user_id);
					$this->session->set_userdata('username', $user);
					$this->session->set_userdata('role', $role);
					$this->session->set_userdata('isview', $isview);
					$this->session->set_userdata('isupdate' , $isupdate);
					$this->session->set_userdata('donvi' , $donvi);
					redirect("/");
				}

			}

		}

	}
	function logOut()
	{
		$this->session->userdata = array();
		$this->session->sess_destroy();
		redirect('/', 'refresh');
	}
}
