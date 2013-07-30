<?php
class Mnhapthang extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function getAllNhaCungCap(){
        $this->db->select('ten, id');
        $result = $this->db->get('dm_nha_cung_cap');
        
        return $result->result_array();
    }
    
    public function getAllTenThietBi(){
        $this->db->select('ten, id');
        $result = $this->db->get('dm_ten_thiet_bi');
        
        return $result->result_array();
    }
    
    public function getAllLoaiThietBi(){
        $this->db->select('id, ten');
        $result = $this->db->get('dm_loai_thiet_bi');
        
        return $result->result_array();
    }
    
    public function getAllQuocGia(){
        $this->db->select('ma_qg, qg');
        $result = $this->db->get('dm_qg');
        return $result->result_array();
    }
    
    public function getAllDonVi(){
        $this->db->select('id, ten');
        $result = $this->db->get('dm_don_vi');
        
        return $result->result_array();
    }
    
    public function getAllKhuNha(){
        $this->db->select('id, ten, trang_thai');
        $result = $this->db->get('dm_khu_nha');
        
        return $result->result_array();
    }
    
    public function getAllNguonVon(){
        $this->db->select('id, ten');
        $result = $this->db->get('dm_nguon_von');
        
        return $result->result_array();
    }
    
    public function getAllCanBo(){
        
    }
    
    public function insertNhap($data){
        $this->db->insert('nhap', $data);
        
        return $this->db->insert_id();
    }
    
    public function insertChiTietNhap($data){
        $this->db->insert('chi_tiet_nhap', $data);
        
        return $this->db->insert_id();
    }
    
    public function insertXuat($data){
        $this->db->insert('xuat', $data);
        
        return $this->db->insert_id();
    }
    
    public function insertChiTietXuat($data){
        $this->db->insert('chi_tiet_xuat', $data);
        
        return $this->db->insert_id();
    }
    
    public function insertThietBiSuDung($data){
        $this->db->insert('thiet_bi_su_dung', $data);
        
        return $this->db->insert_id();
    }
}