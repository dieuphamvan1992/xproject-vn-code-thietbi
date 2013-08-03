<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

class Hoadonxuat extends Tb_controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->Model("Mnhacungcap");
        $this->load->Model("Mloaithietbi");
        $this->load->Model("Mtenthietbi");
         $this->load->Model("Mnguonvon");
        $temp['data']['list_nhacungcap'] = $this->Mnhacungcap->_getAllData();
        $temp['data']['list_loaithietbi'] = $this->Mloaithietbi->_getAllData();
        $temp['data']['list_tenthietbi'] = $this->Mtenthietbi->_getAllData();
        $temp['data']['list_nguonvon'] = $this->Mnguonvon->getListNguonVon();

        $temp['title'] = "Hoá đơn xuất";
        $temp['template'] = 'hoadonxuat/create';
        if ($this->session->userdata('xuat')) {
            $cart = $this->session->userdata('xuat');
            $temp['data']['xuat'] = $cart;
        }

        $temp['today'] = date("Y-m-d");


        
        $this->load->view("thietbi/layout", $temp);
    }

    public function luuThongTinChung()
    {
        $this->load->Model("Mnhacungcap");
        $this->load->Model("Mloaithietbi");
        $this->load->Model("Mtenthietbi");
        $this->load->Model("Mhoadonnhap");
        if ($this->session->userdata('xuat')) {
            $cart = $this->session->userdata('xuat');
            $temp['data']['xuat'] = $cart;
        }
        $temp['data']['list_nhacungcap'] = $this->Mnhacungcap->_getAllData();
        $temp['data']['list_loaithietbi'] = $this->Mloaithietbi->_getAllData();
        $temp['data']['list_tenthietbi'] = $this->Mtenthietbi->_getAllData();


        $temp['title'] = "Hoá đơn xuất";
        $temp['template'] = 'hoadonxuat/create';
        if ($this->input->post('btnSave')) {
            $this->form_validation->set_rules('soHoaDon', 'Số hoá đơn', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view("thietbi/layout", $temp);
            } else {
                $info = array();
                $soHoaDon= $this->input->post('soHoaDon');
                $canBoThucHien= $this->input->post('canBoThucHien');
                $ngayThucHien= $this->input->post('ngayThucHien');
                $nguonVon= $this->input->post('nguonVon');
                $phong= $this->input->post('phong');
                $donViNhan= $this->input->post('donViNhan');
                $info['soHoaDon'] = $soHoaDon;
                $info['canBoThucHien'] = $canBoThucHien;
                $info['ngayThucHien'] = $ngayThucHien;
                $info['nguonVon'] = $nguonVon;
                $info['phong'] = $phong;
                $info['donViNhan'] = $donViNhan;

                $this->session->set_userdata('ThongTinChung', $info);
                redirect("hoadonxuat","refresh");
            }
        }
    }

    public function doAdd() {
        $this->load->Model("Mnhacungcap");
        $this->load->Model("Mloaithietbi");
        $this->load->Model("Mtenthietbi");
        $this->load->Model("Mhoadonnhap");
        if ($this->session->userdata('xuat')) {
            $cart = $this->session->userdata('xuat');
            $temp['data']['xuat'] = $cart;
        }
        $temp['data']['list_nhacungcap'] = $this->Mnhacungcap->_getAllData();
        $temp['data']['list_loaithietbi'] = $this->Mloaithietbi->_getAllData();
        $temp['data']['list_tenthietbi'] = $this->Mtenthietbi->_getAllData();


        $temp['title'] = "Hoá đơn xuất";
        $temp['template'] = 'hoadonxuat/create';
        if ($this->input->post('btnThemThietBiXuat')) {
            $this->form_validation->set_rules('so_luong', 'Số lượng xuất', 'required');
            $this->form_validation->set_rules('chi_phi_lap_dat', 'Chi phí lắp đặt', 'required');
            $this->form_validation->set_rules('chi_phi_van_chuyen', 'Chi phí vận chuyển', 'required');
            $this->form_validation->set_rules('chi_phi_chay_thu', 'Chi phí chạy thử', 'required');

            if ($this->form_validation->run() == FALSE)
            {
             $this->load->view("thietbi/layout", $temp);
         } else {


            $id_thiet_bi = $this->input->post('ten_thiet_bi');
            $so_luong_con = 0;

            $ten_thiet_bi = "";
            if ($id_thiet_bi) {
                $ten = $this->Mtenthietbi->getTenThietBi($id_thiet_bi);
                $ten_thiet_bi = $ten;
            }

            $hoa_don = $this->input->post('hoa_don_nhap');
            if (empty($hoa_don)) {
                redirect('hoadonxuat');
            }
            $hoa_dons = explode('-', $hoa_don);
            $id_hoa_don_nhap = $hoa_dons[0];
            $so_luong_con = $hoa_dons[1];
            $so_luong = $this->input->post('so_luong');
            // echo $so_luong_con;

            $chi_phi_lap_dat = $this->input->post('chi_phi_lap_dat');
            $chi_phi_van_chuyen = $this->input->post('chi_phi_van_chuyen');
            $chi_phi_chay_thu = $this->input->post('chi_phi_chay_thu');
            if ($so_luong_con < $so_luong) {
                redirect('hoadonxuat');
            } else {
                $listsanpham = $this->session->userdata('listsanpham');

                $aItem = $listsanpham[$id_thiet_bi];
                $anItem = $aItem[$id_hoa_don_nhap];

                $so_luong_tru = $so_luong_con - $so_luong;
                unset($anItem["so_luong_con"]);
                $anItem['so_luong_con'] = $so_luong_tru;

                $aItem[$id_hoa_don_nhap] = $anItem;
                $listsanpham[$id_thiet_bi] = $aItem;

                $this->session->set_userdata('listsanpham', $listsanpham);
            }
            $so_hoa_don = $this->Mhoadonnhap->getTenHoaDonNhap($id_hoa_don_nhap);
            if (!$this->session->userdata('xuat')) {
                $myarr = array();
                $this->session->set_userdata('xuat', $myarr);
            }
            $xuat = $this->session->userdata('xuat');
            $stt = count($xuat);

            $new_xuat = array();

            $new_xuat[0] = $id_hoa_don_nhap;
            $new_xuat[1] = $id_thiet_bi;
            $new_xuat[2] = $ten_thiet_bi;
            $new_xuat[3] = $so_luong;
            $new_xuat[4] = $so_luong_con;
            $new_xuat[5] = $chi_phi_lap_dat;
            $new_xuat[6] = $chi_phi_van_chuyen;
            $new_xuat[7] = $chi_phi_chay_thu;
            $new_xuat[8] = $so_hoa_don;
            $new_xuat[9] = $stt;
            //$tt = $this->dem;
            $xuat[$stt] = $new_xuat;
            // echo $tt;
            //  $this->dem = $tt + 1;;
            $this->session->set_userdata('xuat', $xuat);
            redirect('hoadonxuat', 'refresh');
        }

    }
}

public function resetXuat() {
    $this->session->unset_userdata('xuat');
    $this->session->unset_userdata('listsanpham');
    redirect('hoadonxuat', 'refresh');
}


public function edit($id="")
{
    $this->load->Model("Mnhacungcap");
    $this->load->Model("Mloaithietbi");
    $this->load->Model("Mtenthietbi");
    $temp['data']['list_nhacungcap'] = $this->Mnhacungcap->_getAllData();
    $temp['data']['list_loaithietbi'] = $this->Mloaithietbi->_getAllData();
    $temp['data']['list_tenthietbi'] = $this->Mtenthietbi->_getAllData();


    $temp['title'] = "Hoá đơn xuất";
    $temp['template'] = 'hoadonxuat/create';
    if ($this->session->userdata('xuat')) {
        $cart = $this->session->userdata('xuat');
        $temp['data']['xuat'] = $cart;
    }

    if ($id == "")
       redirect('hoadonxuat', 'refresh');


   $xuat =  $this->session->userdata('xuat');
   if (empty($xuat[$id]))
     redirect('hoadonxuat', 'refresh');
    $edit = $xuat[$id];
    $temp['data']['edit'] = $edit;
     $temp['data']['id_edit'] = $id;
    $this->load->view("layout", $temp);
}


public function doEdit($id)
{
    $so_luong_xuat = $this->input->post('so_luong');
    $chi_phi_lap_dat = $this->input->post('chi_phi_lap_dat');
    $chi_phi_van_chuyen = $this->input->post('chi_phi_van_chuyen');
    $chi_phi_chay_thu = $this->input->post('chi_phi_chay_thu');

    $id_thiet_bi = $this->input->post('thiet_bi_id');
    $so_luong_cu = $this->input->post('so_luong_cu');
    $hoadon_id = $this->input->post('hoadon_id');

    $xuat =  $this->session->userdata('xuat');
    $edit = $xuat[$id];

    $list_san_pham = $this->session->userdata('listsanpham');
    $so_luong_tong = $list_san_pham[$id_thiet_bi][$hoadon_id]['so_luong_con'];
       //  echo $hoadon_id;
         //print_r($so_luong_tong);

    if ($so_luong_xuat > ($so_luong_cu + $so_luong_tong))
    {
     redirect('hoadonxuat', 'refresh');
 }
 if ($so_luong_xuat <= $so_luong_cu+ $so_luong_tong)
 {
     $so_luong_tong = $so_luong_cu+ $so_luong_tong - $so_luong_xuat;
     $list_san_pham[$id_thiet_bi][$hoadon_id]['so_luong_con'] = $so_luong_tong;
     $this->session->set_userdata('listsanpham', $list_san_pham);
 }
 $edit[3] = $so_luong_xuat;
  // $edit[4] = $so_luong_cu + $so_luong_tong - $so_luong_xuat;
 $edit[5] = $chi_phi_lap_dat;
 $edit[6] = $chi_phi_van_chuyen;
 $edit[7] = $chi_phi_chay_thu;
 $xuat[$id] = $edit;

 $this->session->set_userdata('xuat',$xuat);
 redirect('hoadonxuat', 'refresh');
}

public function taoHoaDon()
{
    $thongTinChung = $this->session->userdata("ThongTinChung");
    $soHoaDon = $thongTinChung['soHoaDon'];
    $canBoThucHien = $thongTinChung['canBoThucHien'];
    $ngayThucHien = $thongTinChung['ngayThucHien'];
    $nguonVon = $thongTinChung['nguonVon'];
    $phong = $thongTinChung['phong'];
    $donViNhan = $thongTinChung['donViNhan'];

    $this->load->Model("Mhoadonnhap");
    if ($this->input->post('btnCreateHoaDonXuat')) {
        $ngaythuchien = $this->input->post('ngaythuchien');
        $id_xuat = $this->Mhoadonnhap->_getMaxIdHoaDonXuat() + 1;
            //echo $id_xuat;
        $id_don_vi_quan_ly = "";
        $id_khu_nha = "";
        $ngay_su_dung = "";
        $phong = "";
        $id_chi_tiet_nhaps = $this->input->post('id_chi_tiet_nhaps');
        $ten_thiet_bis = $this->input->post('ten_thiet_bis');
        $id_thiet_bis = $this->input->post('id_thiet_bis');
        $hoa_don_nhaps = $this->input->post('hoa_don_nhaps');
        $so_luong_cons = $this->input->post('so_luong_cons');
        $so_luongs = $this->input->post('so_luongs');
        $chi_phi_lap_dats = $this->input->post('chi_phi_lap_dats');
        $chi_phi_van_chuyens = $this->input->post('chi_phi_van_chuyens');
        $chi_phi_chay_thus = $this->input->post('chi_phi_chay_thus');

        foreach ($so_luong_cons as $key => $value) {
            if ($value < $so_luongs[$key]) {
                redirect('hoadonxuat/', 'refresh');
            }
        }

        $id_xuat = $this->Mhoadonnhap->_insertXuat($soHoaDon, $canBoThucHien, $ngayThucHien, $nguonVon, $phong, $donViNhan);
        foreach ($id_chi_tiet_nhaps as $key => $value) {
            //$id_chi_tiet_xuat = $this->Mhoadonnhap->_getMaxIdChiTietXuat() + 1;
            $id_chi_tiet_nhap = $id_chi_tiet_nhaps[$key];
            $id_thiet_bi = $id_thiet_bis[$key];
            $so_luong = $so_luongs[$key];
            $chi_phi_lap_dat = $chi_phi_lap_dats[$key];
            $chi_phi_van_chuyen = $chi_phi_van_chuyens[$key];
            $chi_phi_chay_thu = $chi_phi_chay_thus[$key];
            $ten_thiet_bi = $ten_thiet_bis[$key];


            $id_chi_tiet_xuat  = $this->Mhoadonnhap->_insertChiTietXuat($id_xuat, $id_chi_tiet_nhap, $chi_phi_lap_dat, $chi_phi_chay_thu, $chi_phi_van_chuyen, $so_luong);

            for ($i = 0; $i < $so_luong; $i++) {
                $this->Mhoadonnhap->_insertThietBiSuDung($id_chi_tiet_xuat, $id_don_vi_quan_ly, $id_thiet_bi, $ngay_su_dung, $id_khu_nha, $phong);
            }
        }
        $this->session->unset_userdata('ThongTinChung');
        $this->session->unset_userdata('xuat');
        $this->session->unset_userdata('listsanpham');
        redirect('hoadonxuat/', 'refresh');
    }
}
}