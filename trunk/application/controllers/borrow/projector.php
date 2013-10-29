<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

class Projector extends Tb_controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$temp = array();
		
	}
	public function index(){
		$this->temp['data'] = array();
		$this->temp['title'] = "Hoá đơn nhập";
		$this->temp['template'] = 'borrow/index';
		$this->load->view("thietbi/layout", $this->temp);
	}
}