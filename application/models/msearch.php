<?php
class Msearch extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function getAllKhuNha(){
        $this->db->select('id, ten');
        $result = $this->db->get('khu_nha');
        
        return $result->result_array();
    }
    
    public function getAllDonVi(){
        $this->db->select('id, ten');
        $result = $this->db->get('don_vi');
        
        return $result->result_array();
    }
    
    public function searchItem($data){
        
        if (isset($data['id']) && ($data['id'] !== '')){
            $this->db->where('thiet_bi_su_dung.id', $data['id']);
        }
        if (isset($data['id_chi_tiet_xuat']) && ($data['id_chi_tiet_xuat'] !== '')){
            $this->db->where('id_chi_tiet_xuat', $data['id_chi_tiet_xuat']);
        }
        if (isset($data['id_don_vi_quan_ly']) && ($data['id_don_vi_quan_ly']) !==''){
            $this->db->where('id_don_vi_quan_ly', $data['id_don_vi_quan_ly']);
        }
        if (isset($data['id_ten_thiet_bi']) && ($data['id_ten_thiet_bi'] !== '')){
            $this->db->where('id_ten_thiet_bi', $data['id_ten_thiet_bi']);
        }
        if (isset($data['ten_thiet_bi']) && ($data['ten_thiet_bi'] !== '')){
            $thiet_bi = $this->getIdTenThietBi($data['ten_thiet_bi']);
            if (isset($thiet_bi['id'])){
                $this->db->where('id_ten_thiet_bi', $thiet_bi['id']);
            }else{
                $this->db->where('id_ten_thiet_bi', 0);
            }
        }
        if (isset($data['id_loai_thiet_bi']) && ($data['id_loai_thiet_bi'] !== '')){
            $this->db->where('ten_thiet_bi.id_loai_thiet_bi', $data['id_loai_thiet_bi']);
        }
        if (isset($data['ngay_su_dung']) && ($data['ngay_su_dung'] !== '')){
            $this->db->where('ngay_su_dung', $data['ngay_su_dung']);
        }
        if (isset($data['trang_thai']) && ($data['trang_thai'] !== '')){
            $this->db->where('thiet_bi_su_dung.trang_thai', $data['trang_thai']);
        }
        if (isset($data['id_khu_nha']) && ($data['id_khu_nha'] !== '')){
            $this->db->where('id_khu_nha', $data['id_khu_nha']);
        }
        if (isset($data['phong']) && ($data['phong'] !== '')){
            $this->db->like('phong', $data['phong']);
        }
        if (isset($data['tu_nam']) && isset($data['den_nam']) && ($data['tu_nam'] !== '') && ($data['den_nam'] != '')){
            $this->db->where("YEAR(ngay_su_dung) BETWEEN '".$data['tu_nam']."' AND '".$data['den_nam']."'");
        }
        
        $this->db->join('ten_thiet_bi', 'thiet_bi_su_dung.id_ten_thiet_bi = ten_thiet_bi.id', 'LEFT');
        $this->db->join('don_vi', 'don_vi.id = thiet_bi_su_dung.id_don_vi_quan_ly', 'LEFT');
        $this->db->join('khu_nha', 'khu_nha.id = thiet_bi_su_dung.id_khu_nha', 'LEFT');
        
        $this->db->select('thiet_bi_su_dung.id, thiet_bi_su_dung.ngay_su_dung, thiet_bi_su_dung.phong, 
        don_vi.ten as don_vi, khu_nha.ten as khu_nha, ten_thiet_bi.ten');
        $result = $this->db->get('thiet_bi_su_dung');
        
        return $result->result_array();
    }
    
    public function getIdTenThietBi($ten){
        $this->db->select('id');
        $this->db->like('ten', $ten);
        $this->db->limit(1);
        
        $result = $this->db->get('ten_thiet_bi');
        return $result->row_array();
    }
    
    public function getAllTenThietBi(){
        $this->db->select('id, ten, id_loai_thiet_bi');
        $result = $this->db->get('ten_thiet_bi');
        
        return $result->result_array();
    }
    
    public function getAllLoaiThietBi(){
        $this->db->select('id, ten');
        $result = $this->db->get('loai_thiet_bi');
        
        return $result->result_array();
    }
}