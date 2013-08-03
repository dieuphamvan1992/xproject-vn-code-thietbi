<?php

class Mhoadon extends CI_Model {

    var $table = "nhap";
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
     public function getAllHoaDonXuat() {
        $this->db->select("*");
        $this->db->order_by("ngay_duyet");
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    
}