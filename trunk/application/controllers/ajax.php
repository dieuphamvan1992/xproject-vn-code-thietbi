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

    public function getListChiTietNhapByIDTen($id_ten) {
        $this->load->Model("Mhoadonnhap");
        $listsanpham = $this->session->userdata('listsanpham');
        if (empty($listsanpham[$id_ten])) {


            $list_chi_tiet_nhaps = $this->Mhoadonnhap->getListChiTietNhapByIDTen($id_ten);
         //   print_r($list_chi_tiet_nhaps);
            $list = array();
            foreach ($list_chi_tiet_nhaps as $an) {
                $id = $an['id'];
                $list[$id] = $an;
            }

            $listsanpham[$id_ten] = $list;
            $this->session->set_userdata('listsanpham', $listsanpham);
        }
        $listsanpham = $this->session->userdata('listsanpham');
       // var_dump($listsanpham);
        $list_chi_tiet_nhap = $listsanpham[$id_ten];
        //  var_dump($list_chi_tiet_nhap);

        if (!empty($list_chi_tiet_nhap)) {
            ?>
            <select name="hoa_don_nhap" >
            <?php
            foreach ($list_chi_tiet_nhap as $item) {

                if (intval($item['so_luong_con']) > 0)
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