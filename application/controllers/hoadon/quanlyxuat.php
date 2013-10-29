<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

class Quanlyxuat extends Tb_controller {

	public function __construct() {
		parent::__construct();
		if (($this->role < 0) || ($this->role > 3))
		{
			redirect("/");
			exit;
		}
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->Model("Mnhacungcap");
		$this->load->Model("Mloaithietbi");
		$this->load->Model("Mtenthietbi");
		$temp = array();
		$this->temp['data']['today'] = date("d-m-Y");
		$this->temp['data']['list_nhacungcap'] = $this->Mnhacungcap->_getAllData();
		$this->temp['data']['list_loaithietbi'] = $this->Mloaithietbi->_getAllData();
		$this->temp['data']['list_tenthietbi'] = $this->Mtenthietbi->_getAllData();

	}
	public function index()
	{
		$this->load->Model("Mhoadon");
		$this->temp['data']['list_hoadonxuat'] = $this->Mhoadon->getAllHoaDonXuat();

		$this->temp['title'] = "Quản lý hoá đơn nhập";
		$this->temp['template'] = 'hoadon/xuat';

		$this->load->view("thietbi/layout", $this->temp);
	}
}