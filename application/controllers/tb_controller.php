<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tb_controller extends CI_Controller {
	public $isview = false;
	public $isupdate = false;
	public $role = 0;
	public $donvi = "";

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		   //$this->session->set_userdata('idcanbo','1');
		if (!$this->session->userdata('isLogin'))
		{
			redirect("users/login");
		}
		if ($this->session->userdata('isview'))
		{
			if ($this->session->userdata('isview') ==1)
			{
				$this->isview = true;
			}
		}
		if ($this->session->userdata('isupdate'))
		{
			if ($this->session->userdata('isupdate') ==1)
			{
				$this->isupdate = true;
			}
		}
		if ($this->session->userdata('role'))
		{
			$this->role = $this->session->userdata('role');
		}
		if ($this->session->userdata('donvi'))
		{
			$this->donvi = $this->session->userdata('donvi');
		}


	}

	public function index()
	{

	}

}
