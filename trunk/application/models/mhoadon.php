<?php

class Mhoadon extends CI_Model {

    var $table = "xuat";

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAllHoaDonNhap() {
        $this->db->select("a.*, b.ten as nha_cung_cap");
        $this->db->order_by("ngay_thuc_hien","DESC");
        $this->db->where("a.trang_thai","0");
        $this->db->join("dm_nha_cung_cap as b"," a.id_nha_cung_cap = b.id","left");
        $query = $this->db->get("nhap as a");
        return $query->result_array();
    }


    public function getHoaDonNhapX($id)
    {
        $this->db->select("a.*, b.ten as nha_cung_cap");
        $this->db->where("a.id",$id);
        $this->db->join("dm_nha_cung_cap as b"," a.id_nha_cung_cap = b.id","left");
        $query = $this->db->get("nhap as a");
        return $query->row();
    }
    public function getChiTietNhapX($id)
    {
        $this->db->select("a.*, b.ten as ten_thiet_bi");
        $this->db->where("a.id_nhap",$id);
        $this->db->join("dm_ten_thiet_bi as b"," a.id_ten_thiet_bi = b.id","left");
        $query = $this->db->get("chi_tiet_nhap as a");
        return $query->result_array();
    }



     public function getAllHoaDonXuat() {
        $this->db->select("a.*, b.ten as nguonvon");
        $this->db->order_by("ngay_duyet");
        $this->db->join("dm_nguon_von as b"," a.id_nguon_von = b.id","left");

        $query = $this->db->get("xuat as a");
        return $query->result_array();
    }


    public function getListNhap()
    {
        $sql="SELECT *
            FROM nhap, (

            SELECT DISTINCT id_nhap
            FROM `chi_tiet_nhap`
            WHERE so_luong_con >0
            ) AS listnhap
            WHERE nhap.id = listnhap.id_nhap and nhap.trang_thai = 1
            ORDER BY ngay_thuc_hien DESC";
       $query=$this->db->query($sql);
        return $query->result_array();
    }

    public function getListChiTietHoaDonNhap($id)
    {
        $this->db->select("a.*, b.ten as ten_thiet_bi");
        $this->db->where("a.id_nhap",$id);
        $this->db->order_by("ten_thiet_bi");
        $this->db->join("dm_ten_thiet_bi as b"," a.id_ten_thiet_bi = b.id","left");
        $query = $this->db->get("chi_tiet_nhap as a");
        return $query->result_array();
    }

}