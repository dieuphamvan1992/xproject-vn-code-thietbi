<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

class Quanlynhap extends Tb_controller {

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
		$this->temp['data']['list_hoadonnhap'] = $this->Mhoadon->getAllHoaDonNhap();

		$this->temp['title'] = "Quản lý hoá đơn nhập";
		$this->temp['template'] = 'hoadon/nhap';

		$this->load->view("thietbi/layout", $this->temp);
	}
	public function edit($id)
	{
		$this->session->set_userdata('idHoaDonSua',$id);
		$this->load->Model("Mhoadon");
		$ttchung = $this->Mhoadon->getHoaDonNhapX($id);
		//var_dump($ttchung);
		$chiTiets = $this->Mhoadon->getChiTietNhapX($id);
		//var_dump($chiTiets);
		$nhaps = array();
		foreach ($chiTiets as $item)
		{
			$arr = array();
			$arr['ten'] = $item['ten_thiet_bi'];
			$arr['soLuong'] = $item['so_luong'];
			$arr['donGia'] = $item['don_gia'];
			$arr['baoHanh'] = $item['so_thang_bao_hanh'];
			$arr['id'] = $item['id_ten_thiet_bi'];
			$nhaps[] = $arr;
		}
		$this->session->set_userdata('nhaps',$nhaps);
		$this->temp['title'] = "Quản lý hoá đơn nhập";
		$this->temp['template'] = 'hoadonnhap/ttchitiet';

		$thongTinChungNhap = array();
		$thongTinChungNhap['soHoaDon'] = $ttchung->so_hoa_don;
		$thongTinChungNhap['ngayThucHien'] = convertDate($ttchung->ngay_thuc_hien);
		$thongTinChungNhap['nhaCungCap'] = $ttchung->id_nha_cung_cap;
		$thongTinChungNhap['canBoThucHien'] = $ttchung->id_can_bo_thuc_hien;
		$thongTinChungNhap['tenCanBoThucHien'] = $ttchung->username;
		$thongTinChungNhap['moTa'] = $ttchung->mo_ta;

		$this->temp['data']['nhaps'] = $this->session->userdata('nhaps');
		if ($this->session->userdata('thongTinChungNhap'))
			$this->session->unset_userdata('thongTinChungNhap');
		$this->session->set_userdata('thongTinChungNhap',$thongTinChungNhap);
		$this->temp['data']['thongTinChungNhap'] = $this->session->userdata('thongTinChungNhap');
		$this->load->view("thietbi/layout", $this->temp);
		//var_dump($this->temp['data']['thongTinchung']);

	}
	public function duyet($id)
	{
		$this->load->Model("Mhoadon");
		$ttchung = $this->Mhoadon->getHoaDonNhapX($id);
		$idcanbo = $this->session->userdata('idcanbo');
		if ($idcanbo == $ttchung->id_can_bo_thuc_hien)
		{
			$this->session->set_flashdata('error', 'Không được duyệt hoá đơn do cán bộ tự tạo!');
			redirect("hoadon/quanlynhap/");
			exit;
		}
		$this->Mhoadon->duyetHoaDonNhap($id,$idcanbo);
		$this->session->set_flashdata('success', 'Đã duyệt hoá đơn thành công!');
		redirect("hoadon/quanlynhap/");
		exit;
	}
}