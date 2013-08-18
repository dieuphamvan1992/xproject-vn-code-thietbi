<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

class Nhap extends Tb_controller {

	public function __construct() {
		parent::__construct();
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

	public function index() {
		if ($this->session->userdata('idHoaDonSua'))
		{
			$this->session->unset_userdata('idHoaDonSua');

		}

		if ($this->session->userdata('nhaps'))
		{
			$this->session->unset_userdata('nhaps');

		}
		if ($this->session->userdata('thongTinChungNhap'))
		{
			$this->session->unset_userdata('thongTinChungNhap');

		}

		$arr = array();
		$this->session->set_userdata('nhaps',$arr);
		redirect('hoadon/nhap/create');

	}
	public function create() {
		$this->temp['title'] = "Hoá đơn nhập";
		$this->temp['template'] = 'hoadonnhap/ttchung';
		$this->load->view("thietbi/layout", $this->temp);
	}
	public function addTTC()
	{

		if ($this->input->post('btnOK'))
		{
			$this->form_validation->set_rules('soHoaDon', 'Số hoá đơn', 'required');
			$this->form_validation->set_rules('ngayThucHien', 'Ngày thực hiện', 'required');
			$this->form_validation->set_rules('nhaCungCap', 'Nhà cung cấp', 'callback_nhaCungCap_check');
			if ($this->form_validation->run() == FALSE)
			{
				$this->temp['title'] = "Hoá đơn nhập";
				$this->temp['template'] = 'hoadonnhap/ttchung';
				$this->load->view("thietbi/layout", $this->temp);
			} else {
				//echo 1;
				$soHoaDon = $this->input->post('soHoaDon');
				$ngayThucHien = $this->input->post('ngayThucHien');
				$nhaCungCap = $this->input->post('nhaCungCap');
				$canBoThucHien = $this->input->post('canBoThucHien');
				$moTa = $this->input->post('moTa');


				$thongTinChungNhap = array();
				$thongTinChungNhap['soHoaDon'] = $soHoaDon;
				$thongTinChungNhap['ngayThucHien'] = $ngayThucHien;
				$thongTinChungNhap['nhaCungCap'] = $nhaCungCap;
				$thongTinChungNhap['canBoThucHien'] = $canBoThucHien;
				$thongTinChungNhap['moTa'] = $moTa;

				$this->session->set_userdata('thongTinChungNhap',$thongTinChungNhap);
				redirect('hoadon/nhap/chiTietNhap');
			}
		}
	}


	public function chiTietNhap() {
		$this->temp['title'] = "Hoá đơn nhập";
		$this->temp['template'] = 'hoadonnhap/ttchitiet';
		$this->temp['data']['thongTinChungNhap'] = $this->session->userdata('thongTinChungNhap');
		$this->temp['data']['nhaps'] = $this->session->userdata('nhaps');
		$this->load->view("thietbi/layout", $this->temp);
	}


		//echo convertDate2($date); //hàm được định nghĩa trong application/helpers/thietbi_helper (DangNH viet)

	public function nhaCungCap_check($str)
	{
		if ($str == '')
		{
			$this->form_validation->set_message('nhaCungCap_check', 'Chưa chọn %s.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}



	public function addThietBi()
	{
		$this->load->Model("Mtenthietbi");
		if ($this->input->post('btnThemThietBiNhap'))
		{
			$this->form_validation->set_rules('so_luong', 'Số lượng', 'required');
			$this->form_validation->set_rules('don_gia', 'Đơn giá', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->temp['title'] = "Hoá đơn nhập";
				$this->temp['template'] = 'hoadonnhap/ttchitiet';
				$this->temp['data']['thongTinChungNhap'] = $this->session->userdata('thongTinChungNhap');
				$this->temp['data']['nhaps'] = $this->session->userdata('nhaps');
				$this->load->view("thietbi/layout", $this->temp);
			} else {
				$idThietBi = $this->input->post('ten_thiet_bi');
				$soLuong = $this->input->post('so_luong');
				$donGia = $this->input->post('don_gia');
				$thoiGianBaoHanh = $this->input->post('thoi_gian_bao_hanh');
				$ten_thiet_bi = "";
				if ($idThietBi) {
					$ten = $this->Mtenthietbi->getTenThietBi($idThietBi);
					$ten_thiet_bi = $ten;
				}
				$arr  = array();
				$arr['id'] = $idThietBi;
				$arr['ten'] = $ten_thiet_bi;
				$arr['soLuong'] = $soLuong;
				$arr['donGia'] = $donGia;
				$arr['baoHanh'] = $thoiGianBaoHanh;

				$nhaps = $this->session->userdata('nhaps');
				$nhaps[]  = $arr;
				$this->session->set_userdata('nhaps',$nhaps);
				redirect('hoadon/nhap/chiTietNhap');
			}
		}
	}

	public function doCreate()
	{
		$thongTinChungNhap = $this->session->userdata('thongTinChungNhap');
		$soHoaDonX = $thongTinChungNhap['soHoaDon'];
		$ngayThucHienX = $thongTinChungNhap['ngayThucHien'];

		$ngayThucHienX = convertDate2($ngayThucHienX);

		$nhaCungCapX = $thongTinChungNhap['nhaCungCap'];
		$canBoThucHienX = $thongTinChungNhap['canBoThucHien'];
		$moTaX = $thongTinChungNhap['moTa'];
		$this->load->Model("Mhoadonnhap");

		$id_nhap = $this->Mhoadonnhap->_insertNhap($soHoaDonX, $ngayThucHienX, $nhaCungCapX, $canBoThucHienX, $moTaX);


		if ($this->input->post('btnOK'))
		{
			$id_thiet_bis = $this->input->post('id_thiet_bis');
			$ten_thiet_bis = $this->input->post('ten_thiet_bis');
			$so_luongs = $this->input->post('so_luongs');
			$don_gias = $this->input->post('don_gias');
			$bao_hanhs = $this->input->post('bao_hanhs');



			foreach ($ten_thiet_bis as $key => $value) {
				$thiet_bi = $id_thiet_bis[$key];
				$so_luong = $so_luongs[$key];
				$don_gia = $don_gias[$key];
				$bao_hanh = $bao_hanhs[$key];
				$this->Mhoadonnhap->_insetChiTietNhap($id_nhap, $thiet_bi, $don_gia, $so_luong, $bao_hanh);
				$myarray = array();

			}
			$this->session->unset_userdata('thongTinChungNhap');
			$this->session->unset_userdata('nhaps');
			redirect('hoadon/nhap/create');
		}
	}


	public function doUpdate($id)
	{
		$thongTinChungNhap = $this->session->userdata('thongTinChungNhap');
		$soHoaDonX = $thongTinChungNhap['soHoaDon'];
		$ngayThucHienX = $thongTinChungNhap['ngayThucHien'];

		$ngayThucHienX = convertDate2($ngayThucHienX);

		$nhaCungCapX = $thongTinChungNhap['nhaCungCap'];
		$canBoThucHienX = $thongTinChungNhap['canBoThucHien'];
		$moTaX = $thongTinChungNhap['moTa'];

		$this->load->Model("Mhoadonnhap");

		if ($this->input->post('btnOK'))
		{
			$id_thiet_bis = $this->input->post('id_thiet_bis');
			$ten_thiet_bis = $this->input->post('ten_thiet_bis');
			$so_luongs = $this->input->post('so_luongs');
			$don_gias = $this->input->post('don_gias');
			$bao_hanhs = $this->input->post('bao_hanhs');

			$this->Mhoadonnhap->_updateNhap($id, $soHoaDonX, $ngayThucHienX, $nhaCungCapX, $canBoThucHienX, $moTaX);
			$this->Mhoadonnhap->_deleteChiTietNhap($id);
			foreach ($ten_thiet_bis as $key => $value) {
				$thiet_bi = $id_thiet_bis[$key];
				$so_luong = $so_luongs[$key];
				$don_gia = $don_gias[$key];
				$bao_hanh = $bao_hanhs[$key];
				$this->Mhoadonnhap->_insetChiTietNhap($id, $thiet_bi, $don_gia, $so_luong, $bao_hanh);
				$myarray = array();

			}
			$this->session->unset_userdata('thongTinChungNhap');
			$this->session->unset_userdata('nhaps');
			$this->session->unset_userdata('idHoaDonSua');
			redirect('hoadon/nhap/');
		}
	}
	public function edit($id)
	{
		$this->temp['title'] = "Hoá đơn nhập";
		$this->temp['template'] = 'hoadonnhap/ttchitiet_sua';

		$this->temp['data']['thongTinChungNhap'] = $this->session->userdata('thongTinChungNhap');

		$nhaps = $this->session->userdata('nhaps');
		$this->temp['data']['nhaps']  = $nhaps;
		$this->temp['data']['edit'] = $nhaps[$id];
		$this->temp['data']['idSua'] = $id;

		$this->load->view("thietbi/layout", $this->temp);
	}

	public function editThietBi()
	{
		$this->load->Model("Mtenthietbi");
		if ($this->input->post('btnThemThietBiNhap'))
		{
			$idSua = $this->input->post('idSua');
			$this->form_validation->set_rules('so_luong', 'Số lượng', 'required');
			$this->form_validation->set_rules('don_gia', 'Đơn giá', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->temp['title'] = "Hoá đơn nhập";
				$this->temp['template'] = 'hoadonnhap/ttchitiet_sua';
				$this->temp['data']['thongTinChungNhap'] = $this->session->userdata('thongTinChungNhap');
				$this->temp['data']['nhaps'] = $this->session->userdata('nhaps');
				$nhaps = $this->session->userdata('nhaps');
				$this->temp['data']['nhaps']  = $nhaps;
				$this->temp['data']['edit'] = $nhaps[$idSua];
				$this->temp['data']['idSua'] = $idSua;

				$this->load->view("thietbi/layout", $this->temp);
			} else {


				$idThietBi = $this->input->post('ten_thiet_bi');
				$soLuong = $this->input->post('so_luong');
				$donGia = $this->input->post('don_gia');
				$thoiGianBaoHanh = $this->input->post('thoi_gian_bao_hanh');
				$ten_thiet_bi = "";
				if ($idThietBi) {
					$ten = $this->Mtenthietbi->getTenThietBi($idThietBi);
					$ten_thiet_bi = $ten;
				}
				$nhaps = $this->session->userdata('nhaps');
				$arr  = $nhaps[$idSua];
				$arr['id'] = $idThietBi;
				$arr['ten'] = $ten_thiet_bi;
				$arr['soLuong'] = $soLuong;
				$arr['donGia'] = $donGia;
				$arr['baoHanh'] = $thoiGianBaoHanh;

				$nhaps[$idSua]  = $arr;
				$this->session->set_userdata('nhaps',$nhaps);
				redirect('hoadon/nhap/chiTietNhap');
			}
		}
	}


	public function del($id){
		$nhaps = $this->session->userdata('nhaps');
		$nhaps[$id] = array();
		$this->session->set_userdata('nhaps',$nhaps);
		redirect('hoadon/nhap/chiTietNhap');
	}
}