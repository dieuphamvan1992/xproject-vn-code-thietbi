<?php
class mimport extends CI_Model {
    
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
    
    public function insertLogImport($data){
        $this->db->insert('log_import', $data);
        return $this->db->insert_id();
    }

    //<editor-fold defaultstate="collapsed" desc="Get Id">
    public function getId($tenCot, $tenBang, $value) {
        $this->db->select("id");
        $this->db->where($tenCot, $value);
        $this->db->limit(1, 0);
        $query = $this->db->get($tenBang);
        $row = $query->row(); 
        if($row) {
            $id = $row->id; 
        } else {
            $id = 0;
        }          
        return $id;
    }
    
    public function getIdNhaCungCap($ten) {
        return $this->getId("ten", "dm_nha_cung_cap", $ten);
    }
    
//    public function getIdDonVi($ten) {
//        return $this->getId("ten", "dm_don_vi", $ten);
//    }
    
    public function getIdDonVi($ten) {
        $this->canbo = $this->load->database('staff',TRUE); 
        $this->canbo->select("ma_dv");
        $this->canbo->where("dv", $ten);
        $this->canbo->limit(1, 0);
        $query = $this->canbo->get("dm_dv");
        $row = $query->row(); 
        if($row) {
            $id = $row->ma_dv; 
        } else {
            $id = -1;
        }          
        return $id;
    }
    
    public function getIdKhuNha($ten) {
        return $this->getId("ten", "dm_khu_nha", $ten);
    }
    
    public function getIdNguonVon($ten) {
        return $this->getId("ten", "dm_nguon_von", $ten);
    }
    
    public function getIdLoaiThietBi($ten) {
        return $this->getId("ten", "dm_loai_thiet_bi", $ten);
    }

    public function getIdTenThietBi($ten, $idLoaiThietBi) {
        $this->db->select("id");
        $this->db->where("ten", $ten);
        $this->db->where("id_loai_thiet_bi", $idLoaiThietBi);
        $this->db->limit(1, 0);
        $query = $this->db->get("dm_ten_thiet_bi");
        $row = $query->row(); 
        if($row) {
            $id = $row->id;  
        } else {
            $id = 0;
        }    
        return $id;       
    }
    
    public function getIdQuocGia($ten) {
        $this->db->select("ma_qg");
        $this->db->where("qg", $ten);
        $this->db->limit(1, 0);
        $query = $this->db->get("dm_qg");
        $row = $query->row();
        if($row) {
            $ma_qg = $row->ma_qg;
        } else {
            $ma_qg = 0;
        }       
        return $ma_qg;
    }
    // </editor-fold>
    
    //<editor-fold defaultstate="collapsed" desc="Insert Ten">
    public function insertTen($tenCot, $tenBang, $value) {
        $this->db->set($tenCot,$value);
        $this->db->insert($tenBang);
        $id = $this->db->insert_id();
        return $id;
    }
    
    public function insertTenNhaCungCap($ten) {
        return $this->insertTen("ten", "dm_nha_cung_cap", $ten);
    }
    
    public function insertTenKhuNha($ten) {
        return $this->insertTen("ten", "dm_khu_nha", $ten);
    }
    
    public function insertTenNguonVon($ten) {
        return $this->insertTen("ten", "dm_nguon_von", $ten);
    }
    
    public function insertTenLoaiThietBi($ten) {
        return $this->insertTen("ten", "dm_loai_thiet_bi", $ten);
    }
    
    public function insertTenThietBi($ten, $idLoaiThietBi) {
        $this->db->set("ten",$ten);
        $this->db->set("id_loai_thiet_bi",$idLoaiThietBi);
        $this->db->insert("dm_ten_thiet_bi");
        $id = $this->db->insert_id();
        return $id;
    }
    
    public function insertTenQuocGia($ten) {
        return $this->insertTen("qg", "dm_quoc_gia", $ten);
    }
    // </editor-fold>
    
    public function getAllLog() {
        $this->db->select('id, thoi_gian, id_nhap, id_chi_tiet_nhap, id_xuat, id_chi_tiet_xuat, id_nha_cung_cap, id_khu_nha, id_nguon_von, id_loai_thiet_bi, id_ten_thiet_bi, id_quoc_gia, total, total_fail, tinh_trang, file, user_id, username');
        $result = $this->db->get('log_import');
        
        return $result->result_array();
    }
}

?>
