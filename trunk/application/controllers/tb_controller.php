<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tb_controller extends CI_Controller {
	 public function __construct(){
		   parent::__construct();
		   $this->load->library('session');
		   $this->load->helper('url');
		   $this->load->helper('form');

	 }

	public function index()
	{

	}

}
