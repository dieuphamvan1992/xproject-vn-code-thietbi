<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

class Xuat extends Tb_controller {

	public function __construct() {
		parent::__construct();
		if (($this->role < 0) || ($this->role > 3))
		{
			redirect("/");
			exit;
		}
		$this->load->helper('form');
		$this->load->library('form_validation');
		$temp = array();
		$this->temp['data']['today'] = date("d-m-Y");

	}

	public function index()
	{
		redirect("hoadon/xuat/create");
	}
	public function create()
	{
		$this->load->Model("Mhoadon");
		$this->temp['data']['list_hoadonnhap'] = $this->Mhoadon->getListNhap();
		$this->temp['title'] = "Tạo hoá đơn xuất";
		$this->temp['template'] = 'hoadon/list_nhap';
		$this->load->view("thietbi/layout", $this->temp);
	}
	public function create2($id_hoa_don_xuat)
	{
		$this->load->Model("Mhoadon");
		$this->load->Model("Mstaff");
		$this->load->Model("Mnguonvon");

		$this->temp['data']['list_chitietnhap'] = $this->Mhoadon->getListChiTietHoaDonNhap($id_hoa_don_xuat);
		$this->temp['data']['list_donvi'] = $this->Mstaff->getListDonVi();
		$this->temp['data']['list_nguonvon'] = $this->Mnguonvon->getListNguonVon();

		$this->temp['title'] = "Tạo hoá đơn xuất";
		$this->temp['template'] = 'hoadonxuat/ttchung';
		$this->load->view("thietbi/layout", $this->temp);
	}

	public function doCreate()
	{
		$this->load->Model("Mhoadonxuat");
		if ($this->input->post('btnOK'))
		{
			$so_hoa_don = $this->input->post('so_hoa_don');
			$ngay_thuc_hien = convertDate2($this->input->post('ngay_thuc_hien'));
			$id_can_bo_thuc_hien = $this->input->post('id_can_bo_thuc_hien');
			$don_vi_nhan = $this->input->post('don_vi_nhan');
			$khu_nha = $this->input->post('khu_nha');
			$phong = $this->input->post('phong');
			$nguon_von = $this->input->post('nguon_von');
			$ten_thiet_bis = $this->input->post('ten_thiet_bis');
			$don_gias = $this->input->post('don_gias');
			$id_thiet_bis = $this->input->post('id_thiet_bis');
			$so_luong_cons = $this->input->post('so_luong_cons');
			$so_luongs = $this->input->post('so_luong_xuats');
			$so_luong_xuats = $this->input->post('so_luong_xuats');
			$lap_dats = $this->input->post('lap_dats');
			$van_chuyens = $this->input->post('van_chuyens');
			$chay_thus = $this->input->post('chay_thus');

			$id_xuat = $this->Mhoadonxuat->insertXuat($so_hoa_don, $ngay_thuc_hien, $id_can_bo_thuc_hien, $don_vi_nhan, $khu_nha, $phong, $nguon_von);


			foreach ($ten_thiet_bis as $key => $value)
			{
				$id_chi_tiet_nhap = $key;
				$id_thiet_bi = $id_thiet_bis[$key];
				$don_gia = $don_gias[$key];
				$so_luong = $so_luongs[$key];
				$chi_phi_lap_dat = $lap_dats[$key];
				$chi_phi_van_chuyen = $van_chuyens[$key];
				$chi_phi_chay_thu = $chay_thus[$key];
				$so_luong_con = $so_luong_cons[$key];
				//echo $so_luong_con;
				if (($so_luong_con >= $so_luong) && ($so_luong > 0))
				{
				 $this->Mhoadonxuat->inserChiTietXuat($id_xuat, $id_chi_tiet_nhap, $id_thiet_bi, $don_gia, $so_luong, $chi_phi_lap_dat, $chi_phi_chay_thu, $chi_phi_van_chuyen);

				 $this->Mhoadonxuat->updateSoLuongCon($id_chi_tiet_nhap, $so_luong_con, $so_luong);
				}


			}
			redirect("hoadon/xuat/");
		}
	}
}
