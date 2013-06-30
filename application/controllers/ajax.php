<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

class Ajax extends Tb_controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
    }

    public function getListThietBiByIDLoai($id_loai) {
        $this->load->Model("Mtenthietbi");
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->Mtenthietbi->_ajaxGetThietBiByIDLoai($id_loai)));
    }

    public function getListChiTietNhapByIDTen($id_ten = "") {
        $this->load->Model("Mhoadonnhap");

        $listsanpham = $this->session->userdata('listsanpham');
        if (isset($listsanpham[$id_ten])) {
            
            $list_chi_tiet_nhap = $this->Mhoadonnhap->getListChiTietNhapByIDTen($id_ten);
            $listsanpham[$id_ten] = $list_chi_tiet_nhap;
            $this->session->set_userdata('listsanpham', $listsanpham);
            
        }


        if (!empty($list_chi_tiet_nhap)) {
            ?>
            <select name="hoa_don_nhap" >
            <?php
            foreach ($list_chi_tiet_nhap as $item) {
                echo '<option value="' . $item['id'] . '-' . $item['so_luong_con'] . '">' . 'Số hoá đơn: ' . $item['so_hoa_don'] . ' - Số lượng: ' . $item['so_luong_con'] . ' </option>    ';
            }
            ?>
            </select>
                <?php
            } else {
                ?>
            <select name="hoa_don_nhap" > </select>

            <?php
        }
    }

}