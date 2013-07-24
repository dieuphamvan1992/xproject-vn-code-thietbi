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

        public function getId($tenCot, $tenBang, $value, $allowInsert) {
        $this->db->select("id");
        $this->db->where($tenCot, $value);
        $this->db->limit(1, 0);
        $query = $this->db->get($tenBang);
        $row = $query->row(); 
        $id = $row->id;
        
        if(!$id) {
            if($allowInsert) {
                $this->db->set($tenCot,$value);
                $this->db->insert($tenBang);
                $id = $this->db->insert_id();
            }           
        }
        return $id;
    }
    
    public function getIdNhaCungCap($ten, $allowInsertNhaCungCap) {
        return $this->getId("ten", "dm_nha_cung_cap", $ten, $allowInsertNhaCungCap);
    }
    
    public function getIdDonVi($ten) {
        return $this->getId("ten", "dm_don_vi", $ten);
    }
    
    public function getIdKhuNha($ten, $allowInsertKhuNha) {
        return $this->getId("ten", "dm_khu_nha", $ten, $allowInsertKhuNha);
    }
    
    public function getIdNguonVon($ten, $allowInsertNguonVon) {
        return $this->getId("ten", "dm_nguon_von", $ten, $allowInsertNguonVon);
    }
    
    public function getIdTenThietBi($ten, $allowInsertTenThietBi) {
        return $this->getId("ten", "dm_ten_thiet_bi", $ten, $allowInsertTenThietBi);
    }
    
    public function getIdQuocGia($ten, $allowInsertQuocGia) {
        $this->db->select("ma_qg");
        $this->db->where("qg", $ten);
        $this->db->limit(1, 0);
        $query = $this->db->get("dm_qg");
        $row = $query->row();
        $ma_qg = $row->ma_qg;
        if(!$ma_qg) {
            if($allowInsertQuocGia) {
                $this->db->set("qg",$ten);
                $this->db->insert("dm_qg");
                $ma_qg = $this->db->insert_id();
            }
        }
        return $ma_qg;
    }
}

?>
