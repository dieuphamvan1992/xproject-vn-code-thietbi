<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

class Thietbi extends Tb_controller {

    public function __construct() {
        parent::__construct();
    }
    public function index()
    {
        $this->load->Model("Mnhacungcap");


        $temp['title']="Quản lý Thiết bị";
        $temp['template']='thietbi/v_hoadonnhap';
        $temp['data']['title'] = "Hóa đơn nhập";
        $temp['data']['list_nhacungcap'] = $this->Mnhacungcap->_getAllData();

        $this->load->view("thietbi/layout",$temp);
    }

}