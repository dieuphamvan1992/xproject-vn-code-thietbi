<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

class Quanlyhoadonxuat extends Tb_controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->Model("Mhoadon");
        $temp['data']['list_hoadonxuat'] = $this->Mhoadon->getAllHoaDonXuat();

        $temp['title'] = "Quản lý hoá đơn xuất";
        $temp['template'] = 'hoadon/xuat';

        $this->load->view("thietbi/layout", $temp);

    }

    public function edit($id)
    {
        $this->load->Model("Mnhacungcap");
        $this->load->Model("Mloaithietbi");
        $this->load->Model("Mtenthietbi");
        $this->load->Model("Mnguonvon");
        $this->load->Model("Mhoadonxuat");
        $temp['data']['list_nhacungcap'] = $this->Mnhacungcap->_getAllData();
        $temp['data']['list_loaithietbi'] = $this->Mloaithietbi->_getAllData();
        $temp['data']['list_tenthietbi'] = $this->Mtenthietbi->_getAllData();
        $temp['data']['list_nguonvon'] = $this->Mnguonvon->getListNguonVon();
        $temp['data']['editXuat'] = $this->Mhoadonxuat->getHoaDonXuatById($id);
        $chiTietXuats = $this->Mhoadonxuat->getListChiTietXuatByIdXuat($id);
        //print_r($chiTietXuats);
        $xuat = array();
        foreach ($chiTietXuats as $item)
        {
            $xuat[] = $item;
        }
        $temp['data']['chiTietXuats'] = $xuat;
        $temp['title'] = "Hoá đơn xuất";
        $temp['template'] = 'hoadon/editxuat';
        if ($this->session->userdata('xuat')) {
            $cart = $this->session->userdata('xuat');
            $temp['data']['xuat'] = $cart;
        }

        $temp['today'] = date("Y-m-d");



        $this->load->view("thietbi/layout", $temp);
    }
}
