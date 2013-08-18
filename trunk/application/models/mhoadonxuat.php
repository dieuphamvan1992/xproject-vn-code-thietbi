<?php

class Mhoadonxuat extends CI_Model {

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
    public function getTenHoaDonNhap($id_chi_tiet_nhap) {
        $this->db->select("b.so_hoa_don");
        $this->db->where('a.id', $id_chi_tiet_nhap);

        $this->db->join('nhap as b', 'b.id = a.id_nhap');
        $query = $this->db->get("chi_tiet_nhap as a");
        $row = $query->row();
        return $row->so_hoa_don;
    }
    public function _getMaxIdHoaDonXuat() {
        $this->db->select("MAX(id) as max");
        $query = $this->db->get("xuat");
        $row = $query->row();
        return $row->max;
    }

    public function _insertXuat($id_xuat) {
        $this->db->set("id", $id_xuat);
        $this->db->insert("xuat");
    }

    public function _getMaxIdChiTietXuat() {
        $this->db->select("MAX(id) as max");
        $query = $this->db->get("chi_tiet_xuat");
        $row = $query->row();
        return $row->max;
    }

    public function _insertChiTietXuat($id_chi_tiet_xuat, $id_xuat, $id_chi_tiet_nhap, $chi_phi_lap_dat, $chi_phi_chay_thu, $chi_phi_van_chuyen, $so_luong) {
        $this->db->set("id", $id_chi_tiet_xuat);
        $this->db->set("id_xuat", $id_xuat);
        $this->db->set("id_chi_tiet_nhap", $id_chi_tiet_nhap);
        $this->db->set("chi_phi_lap_dat", $chi_phi_lap_dat);
        $this->db->set("chi_phi_van_chuyen", $chi_phi_van_chuyen);
        $this->db->set("chi_phi_chay_thu", $chi_phi_chay_thu);
        $this->db->set("so_luong", $so_luong);
        $this->db->insert("chi_tiet_xuat");
    }
    public function _insertThietBiSuDung($id_chi_tiet_xuat,$id_don_vi_quan_ly,$id_thiet_bi,$ngay_su_dung,$id_khu_nha,$phong)
    {
        $this->db->set("id_chi_tiet_xuat", $id_chi_tiet_xuat);
        $this->db->set("id_don_vi_quan_ly", $id_don_vi_quan_ly);
        $this->db->set("id_ten_thiet_bi", $id_thiet_bi);
        $this->db->set("ngay_su_dung", $ngay_su_dung);
        $this->db->set("id_khu_nha", $id_khu_nha);
        $this->db->set("phong", $phong);
        $this->db->insert("thiet_bi_su_dung");
    }


    public function getHoaDonXuatById($idHoaDonXuat)
    {
        $this->db->select("a.*, b.id as idchitietxuat,  b.`id_xuat`, b.`id_chi_tiet_nhap`, b.`don_gia`, b.`chi_phi_lap_dat`, b.`chi_phi_van_chuyen`, b.`chi_phi_chay_thu`, b.`khau_hao`, b.`gia_tri_con`, b.`tinh_trang`, b.`so_luong`, b.`cho_muon`, b.`trang_thai` ");
        $this->db->join("chi_tiet_xuat as b", "a.id = b.id_xuat", "left");
        $this->db->where ("a.id",$idHoaDonXuat);
        $query = $this->db->get("xuat as a");
        return $query->result_array();
    }



    public function getListChiTietXuatByIdXuat($idHoaDonXuat)
    {
        $this->db->select("*");
        $this->db->where("id_xuat",$idHoaDonXuat);
        $query = $this->db->get("chi_tiet_xuat as a");
        return $query->result_array();
    }




    public function insertXuat($so_hoa_don, $ngay_thuc_hien, $id_can_bo_thuc_hien, $don_vi_nhan, $khu_nha, $phong, $nguon_von)
    {
            $this->db->set("so_hoa_don", $so_hoa_don);
            $this->db->set("id_nguon_von", $nguon_von);
            $this->db->set("id_don_vi_nhan", $don_vi_nhan);
            $this->db->set("id_khu_nha", $khu_nha);
            $this->db->set("phong", $phong);
            $this->db->set("ngay_thuc_hien", $ngay_thuc_hien);
            $this->db->set("id_can_bo_thuc_hien", $id_can_bo_thuc_hien);

            $this->db->insert("xuat");
           return $this->db->insert_id();

    }
    public function inserChiTietXuat($id_xuat, $id_chi_tiet_nhap, $id_thiet_bi, $don_gia, $so_luong, $chi_phi_lap_dat, $chi_phi_chay_thu, $chi_phi_van_chuyen)
    {
            $this->db->set("id_xuat", $id_xuat);
            $this->db->set("id_chi_tiet_nhap", $id_chi_tiet_nhap);
            $this->db->set("don_gia", $don_gia);
            $this->db->set("so_luong", $so_luong);
            $this->db->set("chi_phi_lap_dat", $chi_phi_lap_dat);
            $this->db->set("chi_phi_chay_thu", $chi_phi_chay_thu);
            $this->db->set("chi_phi_van_chuyen", $chi_phi_van_chuyen);

            $this->db->insert("chi_tiet_xuat");


    }

    public function updateSoLuongCon($id_chi_tiet_nhap, $so_luong_con, $so_luong)
    {
        $this->db->set("so_luong_con", $so_luong_con - $so_luong);
        $this->db->where("id", $id_chi_tiet_nhap);
        $this->db->update("chi_tiet_nhap");
    }

}