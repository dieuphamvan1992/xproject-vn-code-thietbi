<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

class Hoadon extends Tb_controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {



        $this->session->set_userdata('mycart');
        $this->session->set_userdata('myprice');
        $this->load->Model("Mnhacungcap");


        $temp['title'] = "Quản lý Thiết bị";
        $temp['template'] = 'thietbi/v_hoadonnhap';
        $temp['data']['title'] = "Hóa đơn nhập";
        $temp['data']['list_nhacungcap'] = $this->Mnhacungcap->_getAllData();

        $this->load->view("thietbi/layout", $temp);
    }

    public function createHoaDonNhap() {

        $this->load->Model("Mnhacungcap");
        $this->load->Model("Mloaithietbi");
        $this->load->Model("Mtenthietbi");
        $temp['title'] = "Quản lý Thiết bị";
        $temp['template'] = 'thietbi/v_hoadonnhap';
        $temp['data']['title'] = "Hóa đơn nhập";
        $temp['data']['list_nhacungcap'] = $this->Mnhacungcap->_getAllData();
        $temp['data']['list_loaithietbi'] = $this->Mloaithietbi->_getAllData();
        $temp['data']['list_tenthietbi'] = $this->Mtenthietbi->_getAllData();
        $temp['data']['list_dachon'] = array();
        if ($this->session->userdata('mycart')) {
            $cart = $this->session->userdata('mycart');
            $temp['data']['mycart'] = $cart;
//            foreach ($cart as $key => $value) {
//                $thongtin = $this->Mtenthietbi->_getThietBiX($key);
//                if ($thongtin) {
//
//                    $temp['data']['list_dachon'][] = "<td><input type='text' name='thiet_bi_da_chon[$key]' value='" . $thongtin->ten . "' readonly/></td> " .
//                            "<td><input type='text' name='loai_thiet_bi_da_chon[$key]' readonly value='" . $thongtin->ten_loai . "' /></td> " .
//                            "<td><input type='text' name='so_luong_da_chon[$key]' value='" . $value . "' /></td>" .
//                            "<td><input type='text' name='don_gia_da_chon[$key]' value='" . $price[$key] . "' /></td>" .
//                            "<td><a  href='" . site_url("hoadon/editThietBi/$key") . "'><i class='icon-pencil'></i></a></td>" . "<td><a  href=''><i class='icon-trash'></i></a>" . "</td> ";
//                }
//            }
        }
        $this->load->view("thietbi/layout", $temp);
    }

    public function doAddThietBi() {
        $this->load->Model("Mtenthietbi");
        if ($this->input->post('btnThemThietBi')) {
            //   $loai_thiet_bi = $this->input->post('loai_thiet_bi');
            $id_thiet_bi = $this->input->post('ten_thiet_bi');
            $so_luong = $this->input->post('so_luong');
            $don_gia = $this->input->post('don_gia');

            $quoc_gia = "";
            $ten_thiet_bi = "";
            if ($id_thiet_bi) {
                $ten = $this->Mtenthietbi->getTenThietBi($id_thiet_bi);
                $ten_thiet_bi = $ten;
            }


            $cart = $this->session->userdata('mycart');
            $new_item = array();
            $new_item[0] = $id_thiet_bi;
            $new_item[1] = $ten_thiet_bi;
            $new_item[2] = $so_luong;
            $new_item[3] = $don_gia;

            $new_item[4] = $quoc_gia;

            $cart[] = $new_item;



            $this->session->set_userdata('mycart', $cart);


            $this->session->set_flashdata('ketqua', 'Đã thêm sản phẩm thành công.');
            redirect('hoadon/createHoaDonNhap', 'refresh');
        }
    }

    public function editThietBi($id) {
        $cart = $this->session->userdata('mycart');
        $this->session->set_flashdata('editThietBiID', $id);
        if (isset($cart[$id])) {
            $this->session->set_flashdata('editThietBiSoLuong', $cart[$id]);
        }
        redirect('hoadon/createHoaDonNhap');
    }

    public function doCreateHoaDonNhap() {
        $this->load->Model("Mhoadonnhap");
        if ($this->input->post('btnCreateHoaDon')) {
            $so_hoa_don = $this->input->post('sohoadon');
            $ngay_thuc_hien = $this->input->post('ngaythuchien');
            $nha_cung_cap = $this->input->post('nha_cung_cap');
            // $so_hoa_don = $this->input->post('sohoadon');
            $id_can_bo_thuc_hien = $this->input->post('id_can_bo_thuc_hien');
            $mo_ta = $this->input->post('mota');
            $id_nhap = $this->Mhoadonnhap->_getMaxIdHoaDonNhap() + 1;
            //insert đoạn trên vào bảng nhap
            $this->Mhoadonnhap->_insertNhap($id_nhap, $so_hoa_don, $ngay_thuc_hien, $nha_cung_cap, $id_can_bo_thuc_hien, $mo_ta);

            // tìm id lớn nhất trong bảng nhập rồi + 1;

            $so_luongs = $this->input->post('so_luongs');
            $don_gias = $this->input->post('don_gias');
            $quoc_gias = $this->input->post('quoc_gias');
            foreach ($this->input->post('ten_thiet_bis') as $key => $value) {
                $thiet_bi = $key;
                $so_luong = $so_luongs[$key];
                $don_gia = $don_gias[$key];
                $quoc_gia = $quoc_gias[$key];

                $this->Mhoadonnhap->_insetChiTietNhap($id_nhap, $thiet_bi, $don_gia, $so_luong, $quoc_gia);
            }
            $myarray = array();
            $this->session->set_userdata('mycart', $myarray);
            $this->session->set_userdata('myprice', $myarray);
            redirect('hoadon/createHoaDonNhap');
        }
    }

    public function createHoaDonXuat() {
        $this->load->Model("Mnhacungcap");
        $this->load->Model("Mloaithietbi");
        $this->load->Model("Mtenthietbi");
        $temp['title'] = "Quản lý Thiết bị";
        $temp['template'] = 'thietbi/v_hoadonxuat';
        $temp['data']['title'] = "Hóa đơn xuất";
        $temp['data']['list_nhacungcap'] = $this->Mnhacungcap->_getAllData();
        $temp['data']['list_loaithietbi'] = $this->Mloaithietbi->_getAllData();
        $temp['data']['list_tenthietbi'] = $this->Mtenthietbi->_getAllData();
        $temp['data']['list_dachon'] = array();
        if ($this->session->userdata('mycart')) {
            $cart = $this->session->userdata('mycart');
            $temp['data']['mycart'] = $cart;
        }
        $this->load->view("thietbi/layout", $temp);
    }

    public function doAddThietBiXuat() {

        $this->load->Model("Mtenthietbi");
        if ($this->input->post('btnThemThietBiXuat')) {
            // var_dump($this->input->post());
            $id_thiet_bi = $this->input->post('ten_thiet_bi');
            $so_luong_con = 0;

            $ten_thiet_bi = "";
            if ($id_thiet_bi) {
                $ten = $this->Mtenthietbi->getTenThietBi($id_thiet_bi);
                $ten_thiet_bi = $ten;
            }

            $hoa_don = $this->input->post('hoa_don_nhap');
            if (empty($hoa_don)) {
                redirect('hoadon/createHoaDonXuat');
            }
            $hoa_dons = explode('-', $hoa_don);
            $id_hoa_don_nhap = $hoa_dons[0];
            $so_luong_con = $hoa_dons[1];
            $so_luong = $this->input->post('so_luong');
            // echo $so_luong_con;
            $don_vi_nhan = $this->input->post('don_vi_nhan');
            $khu_nha = $this->input->post('khu_nha');
            $nguon_von = $this->input->post('nguon_von');
            $phong = $this->input->post('phong');
            $chi_phi_lap_dat = $this->input->post('chi_phi_lap_dat');
            $chi_phi_van_chuyen = $this->input->post('chi_phi_van_chuyen');
            $chi_phi_chay_thu = $this->input->post('chi_phi_chay_thu');
            if ($so_luong_con < $so_luong)
            {
                 redirect('hoadon/createHoaDonXuat');
            }
            else 
            {
                 $listsanpham = $this->session->userdata('listsanpham');
              //    var_dump($listsanpham);
               //   echo "<Br>";
                 $aItem = $listsanpham[$id_thiet_bi];
                 $anItem = $aItem[$id_hoa_don_nhap];
                // echo $aItem['so_luong_con'];
             //   print_r($anItem);
              //  echo "<Br>";
                $so_luong_tru = $so_luong_con-$so_luong;
                unset ($anItem["so_luong_con"]);
                $anItem['so_luong_con'] = $so_luong_tru;
               // print_r($anItem);
                // unset($listsanpham[$id_thiet_bi]);
                $aItem[$id_hoa_don_nhap] = $anItem;
                 $listsanpham[$id_thiet_bi] = $aItem;
                 print_r($listsanpham);
                 $this->session->set_userdata('listsanpham',$listsanpham);
                 
            }
            $xuat = $this->session->userdata('xuat');
            $new_xuat = array();
            $new_xuat[0] = $id_thiet_bi;
            $new_xuat[1] = $ten_thiet_bi;
            $new_xuat[2] = $id_hoa_don_nhap;
            $new_xuat[3] = $so_luong;
            $new_xuat[4] = $so_luong_con;
            $new_xuat[5] = $don_vi_nhan;
            $new_xuat[6] = $khu_nha;
            $new_xuat[7] = $nguon_von;
            $new_xuat[8] = $phong;
            $new_xuat[9] = $chi_phi_lap_dat;
            $new_xuat[10] = $chi_phi_van_chuyen;
            $new_xuat[11] = $chi_phi_chay_thu;
            
            $xuat[] = $new_xuat;
            
            $this->session->set_userdata('xuat',$xuat);
        }
    }

}