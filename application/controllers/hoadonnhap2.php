<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

class Hoadonnhap2 extends Tb_controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	public function index() {
		$listsanpham = $this->session->unset_userdata('listsanpham');
		$this->load->Model("Mnhacungcap");
		$this->load->Model("Mloaithietbi");
		$this->load->Model("Mtenthietbi");
		$temp['data']['list_nhacungcap'] = $this->Mnhacungcap->_getAllData();
		$temp['data']['list_loaithietbi'] = $this->Mloaithietbi->_getAllData();
		$temp['data']['list_tenthietbi'] = $this->Mtenthietbi->_getAllData();


		$temp['title'] = "Hoá đơn nhập";
		$temp['template'] = 'hoadonnhap/index';


		$temp['today'] = date("d-m-Y");
		if ($this->session->userdata('nhap')) {
			$cart = $this->session->userdata('nhap');
			$temp['data']['nhap'] = $cart;
		}
		$this->load->view("thietbi/layout", $temp);




	}
	public function doAdd()
	{
		$this->load->Model("Mnhacungcap");
		$this->load->Model("Mloaithietbi");
		$this->load->Model("Mtenthietbi");
		$temp['data']['list_nhacungcap'] = $this->Mnhacungcap->_getAllData();
		$temp['data']['list_loaithietbi'] = $this->Mloaithietbi->_getAllData();
		$temp['data']['list_tenthietbi'] = $this->Mtenthietbi->_getAllData();


		$temp['title'] = "Hoá đơn nhập";
		$temp['template'] = 'hoadonnhap/create';


		if ($this->input->post('btnThemThietBiNhap')) {
			$this->form_validation->set_rules('so_luong', 'Số lượng', 'required');
			$this->form_validation->set_rules('don_gia', 'Đơn giá', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view("layout", $temp);
			} else {

				$id_thiet_bi = $this->input->post('ten_thiet_bi');
				$so_luong = $this->input->post('so_luong');
				$don_gia = $this->input->post('don_gia');
				//$don_vi_tinh = $this->input->post('don_vi_tinh');
				$thoi_gian_bao_hanh = $this->input->post('thoi_gian_bao_hanh');
				$ten_thiet_bi = "";
				if ($id_thiet_bi) {
					$ten = $this->Mtenthietbi->getTenThietBi($id_thiet_bi);
					$ten_thiet_bi = $ten;
				}

				$cart = $this->session->userdata('nhap');
				$new_item = array();
				$new_item[0] = $id_thiet_bi;
				$new_item[1] = $ten_thiet_bi;
				$new_item[2] = $so_luong;
				$new_item[3] = $don_gia;
			//	$new_item[4] = $don_vi_tinh;
				$new_item[5] = $thoi_gian_bao_hanh;
				$cart[] = $new_item;
				$this->session->set_userdata('nhap', $cart);
				redirect("hoadonnhap2","refresh");
			}

		}
	}

}