<<<<<<< .mine
<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

class Hoadonnhap extends Tb_controller {

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
		$temp['template'] = 'hoadonnhap/create';


		$temp['today'] = date("Y-m-d");
		if ($this->session->userdata('nhap')) {
			$cart = $this->session->userdata('nhap');
			$temp['data']['nhap'] = $cart;
		}
		$this->load->view("layout", $temp);




	}
	public function loadview1() {
		$temp['title'] = "Hoá đơn nhập";
		$temp['template'] = 'hoadonnhap/ttchung';$temp['data'] = "Hoá đơn nhập";
		$this->load->view("thietbi/layout", $temp);
	}
	public function loadview2() {
		$temp['title'] = "Hoá đơn nhập";
		$temp['template'] = 'hoadonnhap/ttchitiet';$temp['data'] = "Hoá đơn nhập";
		$this->load->view("thietbi/layout", $temp);
	}

	public function luuThongTinChung()
	{
		$this->load->Model("Mnhacungcap");
		$this->load->Model("Mloaithietbi");
		$this->load->Model("Mtenthietbi");
		$temp['data']['list_nhacungcap'] = $this->Mnhacungcap->_getAllData();
		$temp['data']['list_loaithietbi'] = $this->Mloaithietbi->_getAllData();
		$temp['data']['list_tenthietbi'] = $this->Mtenthietbi->_getAllData();


		$temp['title'] = "Hoá đơn nhập";
		$temp['template'] = 'hoadonnhap/create';
		if ($this->session->userdata('nhap')) {
			$cart = $this->session->userdata('nhap');
			$temp['data']['nhap'] = $cart;
		}




		if ($this->input->post('btnSave')) {
			$this->form_validation->set_rules('soHoaDon', 'Số hoá đơn', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view("layout", $temp);
			} else {
				$info = array();

				$soHoaDon= $this->input->post('soHoaDon');
				$nhaCungCap= $this->input->post('nhaCungCap');
				$ngayThucHien= $this->input->post('ngayThucHien');
				$canBoThucHien= $this->input->post('canBoThucHien');
				$moTa= $this->input->post('moTa');

				$info['soHoaDon'] = $soHoaDon;
				$info['nhaCungCap'] = $nhaCungCap;
				$info['ngayThucHien'] = $ngayThucHien;
				$info['canBoThucHien'] = $canBoThucHien;
				$info['moTa'] = $moTa;

				$this->session->set_userdata('ThongTinChung', $info);
				redirect("hoadonnhap","refresh");
			}
		}
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
				redirect("hoadonnhap","refresh");
			}

		}
	}



	public function edit($id)
	{
		$this->load->Model("Mnhacungcap");
		$this->load->Model("Mloaithietbi");
		$this->load->Model("Mtenthietbi");
		$temp['data']['list_nhacungcap'] = $this->Mnhacungcap->_getAllData();
		$temp['data']['list_loaithietbi'] = $this->Mloaithietbi->_getAllData();
		$temp['data']['list_tenthietbi'] = $this->Mtenthietbi->_getAllData();


		$temp['title'] = "Hoá đơn nhập";
		$temp['template'] = 'hoadonnhap/create';

		if ($this->session->userdata('nhap')) {
			$cart = $this->session->userdata('nhap');
			$temp['data']['nhap'] = $cart;
		}

		$nhap =  $this->session->userdata('nhap');
		if (empty($nhap[$id]))
			redirect('hoadonnhap', 'refresh');
		$edit = $nhap[$id];
		$temp['data']['edit'] = $edit;
		$temp['data']['id_edit'] = $id;
		$this->load->view("layout", $temp);

	}
	public function resetNhap()
	{
		$this->session->unset_userdata('nhap');
		redirect("hoadonnhap","refresh");
	}


	public function taoHoaDon()
	{
		$thongTinChung = $this->session->userdata("ThongTinChung");
		$soHoaDon = $thongTinChung['soHoaDon'];
		//echo $soHoaDon;
		$nhaCungCap = $thongTinChung['nhaCungCap'];
		$ngayThucHien = $thongTinChung['ngayThucHien'];
		$canBoThucHien = $thongTinChung['canBoThucHien'];
		$moTa = $thongTinChung['moTa'];
		$this->load->Model("Mhoadonnhap");
		if ($this->input->post('btnCreateHoaDonNhap')) {
			$id_thiet_bis = $this->input->post('id_thiet_bis');
			$ten_thiet_bis = $this->input->post('ten_thiet_bis');
			$so_luongs = $this->input->post('so_luongs');
			$don_gias = $this->input->post('don_gias');
			$bao_hanhs = $this->input->post('bao_hanhs');
			$id_nhap = $this->Mhoadonnhap->_insertNhap($soHoaDon, $ngayThucHien, $nhaCungCap, $canBoThucHien, $moTa);
			//echo $id_nhap;
			foreach ($ten_thiet_bis as $key => $value) {
				$thiet_bi = $id_thiet_bis[$key];
				$so_luong = $so_luongs[$key];
				$don_gia = $don_gias[$key];
				$bao_hanh = $bao_hanhs[$key];

				$this->Mhoadonnhap->_insetChiTietNhap($id_nhap, $thiet_bi, $don_gia, $so_luong, $bao_hanh);
				$myarray = array();
				$this->session->unset_userdata('ThongTinChung');
				$this->session->unset_userdata('nhap');
				redirect('hoadonnhap');
			}
		}

	}


	public function doEdit($id)
	{
		$this->load->Model("Mtenthietbi");
		$ten_thiet_bi = $this->input->post('ten_thiet_bi');
		$so_luong = $this->input->post('so_luong');
		$don_gia = $this->input->post('don_gia');
		$thoi_gian_bao_hanh = $this->input->post('thoi_gian_bao_hanh');
		$ten = $this->Mtenthietbi->getTenThietBi($ten_thiet_bi);
		$nhap =  $this->session->userdata('nhap');
		$cart = $nhap[$id];
	//	echo $ten_thiet_bi;
		//$cart[0] = $id;
		$cart[0] = $ten_thiet_bi;
		$cart[1] = $ten;
		$cart[2] = $so_luong;
		$cart[3] = $don_gia;
		$cart[5] = $thoi_gian_bao_hanh;
		$nhap[$id] = $cart;
		$this->session->set_userdata("nhap",$nhap);
		redirect('hoadonnhap');

	}

	public function del($id)
	{

	}
=======
<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

class Hoadonnhap extends Tb_controller {

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
		$temp['template'] = 'hoadonnhap/create';


		$temp['today'] = date("d-m-Y");
		if ($this->session->userdata('nhap')) {
			$cart = $this->session->userdata('nhap');
			$temp['data']['nhap'] = $cart;
		}
		$this->load->view("thietbi/layout", $temp);




	}

	public function luuThongTinChung()
	{
		$this->load->Model("Mnhacungcap");
		$this->load->Model("Mloaithietbi");
		$this->load->Model("Mtenthietbi");
		$temp['data']['list_nhacungcap'] = $this->Mnhacungcap->_getAllData();
		$temp['data']['list_loaithietbi'] = $this->Mloaithietbi->_getAllData();
		$temp['data']['list_tenthietbi'] = $this->Mtenthietbi->_getAllData();
$temp['today'] = date("d-m-Y");

		$temp['title'] = "Hoá đơn nhập";
		$temp['template'] = 'hoadonnhap/create';
		if ($this->session->userdata('nhap')) {
			$cart = $this->session->userdata('nhap');
			$temp['data']['nhap'] = $cart;
		}




		if ($this->input->post('btnSave')) {
			$this->form_validation->set_rules('soHoaDon', 'Số hoá đơn', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view("layout", $temp);
			} else {
				$info = array();

				$soHoaDon= $this->input->post('soHoaDon');
				$nhaCungCap= $this->input->post('nhaCungCap');
				$ngayThucHien= $this->input->post('ngayThucHien');
				$canBoThucHien= $this->input->post('canBoThucHien');
				$moTa= $this->input->post('moTa');

				$info['soHoaDon'] = $soHoaDon;
				$info['nhaCungCap'] = $nhaCungCap;
				$info['ngayThucHien'] = $ngayThucHien;
				$info['canBoThucHien'] = $canBoThucHien;
				$info['moTa'] = $moTa;

				$this->session->set_userdata('ThongTinChung', $info);
				redirect("hoadonnhap","refresh");
			}
		}
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
				redirect("hoadonnhap","refresh");
			}

		}
	}



	public function edit($id)
	{
		$this->load->Model("Mnhacungcap");
		$this->load->Model("Mloaithietbi");
		$this->load->Model("Mtenthietbi");
		$temp['data']['list_nhacungcap'] = $this->Mnhacungcap->_getAllData();
		$temp['data']['list_loaithietbi'] = $this->Mloaithietbi->_getAllData();
		$temp['data']['list_tenthietbi'] = $this->Mtenthietbi->_getAllData();


		$temp['title'] = "Hoá đơn nhập";
		$temp['template'] = 'hoadonnhap/create';

		if ($this->session->userdata('nhap')) {
			$cart = $this->session->userdata('nhap');
			$temp['data']['nhap'] = $cart;
		}

		$nhap =  $this->session->userdata('nhap');
		if (empty($nhap[$id]))
			redirect('hoadonnhap', 'refresh');
		$edit = $nhap[$id];
		$temp['data']['edit'] = $edit;
		$temp['data']['id_edit'] = $id;
		$this->load->view("layout", $temp);

	}
	public function resetNhap()
	{
		$this->session->unset_userdata('nhap');
		redirect("hoadonnhap","refresh");
	}


	public function taoHoaDon()
	{
		$thongTinChung = $this->session->userdata("ThongTinChung");
		$soHoaDon = $thongTinChung['soHoaDon'];
		//echo $soHoaDon;
		$nhaCungCap = $thongTinChung['nhaCungCap'];
		$ngayThucHien = $thongTinChung['ngayThucHien'];
		$canBoThucHien = $thongTinChung['canBoThucHien'];
		$moTa = $thongTinChung['moTa'];
		$this->load->Model("Mhoadonnhap");
		if ($this->input->post('btnCreateHoaDonNhap')) {
			$id_thiet_bis = $this->input->post('id_thiet_bis');
			$ten_thiet_bis = $this->input->post('ten_thiet_bis');
			$so_luongs = $this->input->post('so_luongs');
			$don_gias = $this->input->post('don_gias');
			$bao_hanhs = $this->input->post('bao_hanhs');
			$id_nhap = $this->Mhoadonnhap->_insertNhap($soHoaDon, $ngayThucHien, $nhaCungCap, $canBoThucHien, $moTa);
			//echo $id_nhap;
			foreach ($ten_thiet_bis as $key => $value) {
				$thiet_bi = $id_thiet_bis[$key];
				$so_luong = $so_luongs[$key];
				$don_gia = $don_gias[$key];
				$bao_hanh = $bao_hanhs[$key];

				$this->Mhoadonnhap->_insetChiTietNhap($id_nhap, $thiet_bi, $don_gia, $so_luong, $bao_hanh);
				$myarray = array();
				$this->session->unset_userdata('ThongTinChung');
				$this->session->unset_userdata('nhap');
				redirect('hoadonnhap');
			}
		}

	}


	public function doEdit($id)
	{
		$this->load->Model("Mtenthietbi");
		$ten_thiet_bi = $this->input->post('ten_thiet_bi');
		$so_luong = $this->input->post('so_luong');
		$don_gia = $this->input->post('don_gia');
		$thoi_gian_bao_hanh = $this->input->post('thoi_gian_bao_hanh');
		$ten = $this->Mtenthietbi->getTenThietBi($ten_thiet_bi);
		$nhap =  $this->session->userdata('nhap');
		$cart = $nhap[$id];
	//	echo $ten_thiet_bi;
		//$cart[0] = $id;
		$cart[0] = $ten_thiet_bi;
		$cart[1] = $ten;
		$cart[2] = $so_luong;
		$cart[3] = $don_gia;
		$cart[5] = $thoi_gian_bao_hanh;
		$nhap[$id] = $cart;
		$this->session->set_userdata("nhap",$nhap);
		redirect('hoadonnhap');

	}

	public function del($id)
	{

	}
>>>>>>> .r113
}