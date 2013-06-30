<?php

class Mhoadonnhap extends CI_Model {

    var $table = "nhap";

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function _getAllData() {
        $this->db->select("id,ten");
        $this->db->order_by("ten");
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function _getMaxIdHoaDonNhap() {
        $this->db->select("MAX(id) as max");
        $query = $this->db->get("nhap");
        $row = $query->row();
        return $row->max;
    }

    public function _insertNhap($id_nhap,$so_hoa_don, $ngay_thuc_hien, $nha_cung_cap, $id_can_bo_thuc_hien, $mo_ta) {
        $this->db->set("id", $id_nhap);
        $this->db->set("so_hoa_don", $so_hoa_don);
        $this->db->set("id_nha_cung_cap", $nha_cung_cap);
        $this->db->set("id_can_bo_thuc_hien", $id_can_bo_thuc_hien);
        $this->db->set("ngay_thuc_hien", $ngay_thuc_hien);
        $this->db->set("mo_ta", $mo_ta);
        
        $this->db->insert($this->table);
    }

    public function _insetChiTietNhap($id_nhap,$thiet_bi,$don_gia,$so_luong,$quoc_gia) {
        $this->db->set("id_nhap", $id_nhap);
        $this->db->set("id_ten_thiet_bi", $thiet_bi);
        $this->db->set("don_gia", $don_gia);
        $this->db->set("so_luong", $so_luong);
        $this->db->set("so_luong_con", $so_luong);
        $this->db->set("id_quoc_gia", $quoc_gia);
        $this->db->insert("chi_tiet_nhap");
    }
    
    
    public function getListChiTietNhapByIDTen($id_ten)
    {
        $this->db->select("a.id, a.so_luong_con, b.so_hoa_don");
        $this->db->where('a.id_ten_thiet_bi',$id_ten);
        $this->db->where('a.so_luong_con >',0);
        $this->db->join('nhap as b', 'b.id = a.id_nhap');
        $query = $this->db->get("chi_tiet_nhap as a");
        return $query->result_array();
    }
}