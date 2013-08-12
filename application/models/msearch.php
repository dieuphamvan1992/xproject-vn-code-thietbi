<?php
class Msearch extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function getAllKhuNha(){
        $this->db->select('id, ten');
        $result = $this->db->get('dm_khu_nha');
        
        return $result->result_array();
    }
    
    public function getAllDonVi(){
        $this->db->select('id, ten');
        $result = $this->db->get('dm_don_vi');
        
        return $result->result_array();
    }
    
    public function searchItem($data){
        
        if (isset($data['id']) && ($data['id'] !== '')){
            $this->db->where('thiet_bi_su_dung.id', $data['id']);
        }
        if (isset($data['ma_thiet_bi']) && ($data['ma_thiet_bi'] !== '')){
            $this->db->where('thiet_bi_su_dung.ma_thiet_bi', $data['ma_thiet_bi']);
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
            $this->db->where('dm_ten_thiet_bi.id_loai_thiet_bi', $data['id_loai_thiet_bi']);
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
        /* Search ngày của Điều
        if (isset($data['tu_nam']) && isset($data['den_nam']) && ($data['tu_nam'] !== '') && ($data['den_nam'] != '')){
            $this->db->where("YEAR(ngay_su_dung) BETWEEN '".$data['tu_nam']."' AND '".$data['den_nam']."'");
        }
        */

        //Search ngày của Trường Kobe
        if (isset($data['tu_nam']) && ($data['tu_nam'] !== ''))
        {
            $this->db->where('YEAR(ngay_su_dung) >='.$data['tu_nam']);
        }
        if (isset($data['den_nam']) && ($data['den_nam'] !== ''))
        {
            $this->db->where('YEAR(ngay_su_dung) <='.$data['den_nam']);
        }
        //Kết thúc search ngày của Trường Kobe
        
        $this->db->join('dm_ten_thiet_bi', 'thiet_bi_su_dung.id_ten_thiet_bi = dm_ten_thiet_bi.id', 'LEFT');
        $this->db->join('dm_don_vi', 'dm_don_vi.id = thiet_bi_su_dung.id_don_vi_quan_ly', 'LEFT');
        $this->db->join('dm_khu_nha', 'dm_khu_nha.id = thiet_bi_su_dung.id_khu_nha', 'LEFT');
        
        $this->db->select('thiet_bi_su_dung.ma_thiet_bi, thiet_bi_su_dung.ngay_su_dung, thiet_bi_su_dung.phong, 
        dm_don_vi.ten as don_vi, dm_khu_nha.ten as khu_nha, dm_ten_thiet_bi.ten, thiet_bi_su_dung.id');
        $result = $this->db->get('thiet_bi_su_dung');
        
        return $result->result_array();
    }
    
    public function getIdTenThietBi($ten){
        $this->db->select('id');
        $this->db->like('ten', $ten);
        $this->db->limit(1);
        
        $result = $this->db->get('dm_ten_thiet_bi');
        return $result->row_array();
    }
    
    public function getIdXuat($xuat){
        $this->db->select('id');
        $this->db->like('so_hoa_don', $xuat);
        
        $result = $this->db->get('xuat');
        return $result->result_array();
    }
    
    public function getListIdChiTietXuat($xuat){
        $ls = $this->getIdXuat($xuat);
        $temp = array();
        foreach ($ls as $item){
            $temp[] = $item['id'];
        }
        $this->db->where_in('id_xuat', $temp);
        $this->db->select('id');
        $result = $this->db->get('chi_tiet_xuat');
        return $result->result_array();
    }
    
    public function getIdNhap($nhap){
        $this->db->select('id');
        $this->db->like('so_hoa_don', $nhap);
        
        $result = $this->db->get('nhap');
        return $result->result_array();
    }
    
    public function getListIdChiTietNhap($nhap){
        $ls = $this->getIdNhap($nhap);
        $temp = array();
        foreach ($ls as $item){
            $temp[] = $item['id'];
        }
        $this->db->where_in('id_nhap', $temp);
        $this->db->select('id');
        $result = $this->db->get('chi_tiet_nhap');
        return $result->result_array();
    }
    
    public function getXuatNhap($nhap){
        $ls = $this->getListIdChiTietNhap($nhap);
        foreach ($ls as $item){
            $temp[] = $item['id'];
        }
        $this->db->select('id');
        $this->db->where_in('id_chi_tiet_nhap', $temp);
        $result = $this->db->get('chi_tiet_xuat');
        
        return $result->result_array();
    }
    
    public function getAllTenThietBi(){
        $this->db->select('id, ten, id_loai_thiet_bi');
        $result = $this->db->get('dm_ten_thiet_bi');
        
        return $result->result_array();
    }
    
    public function getAllLoaiThietBi(){
        $this->db->select('id, ten');
        $result = $this->db->get('dm_loai_thiet_bi');
        
        return $result->result_array();
    }
    
    public function searchBatch($data){
        $chi_tiet_xuat_shdn = array();
        $active = 0;
        if (isset($data['shdn']) && ($data['shdn'] !== '')){
            $chi_tiet_xuat_shdn = $this->getXuatNhap($data['shdn']);
            $active = 1;
        }
        if (isset($data['shdx']) && ($data['shdx']) !== ''){
            $chi_tiet_xuat = $this->getListIdChiTietXuat($data['shdx']);
            if (count($chi_tiet_xuat) > 0){                              
                $temp = array();
                foreach ($chi_tiet_xuat as $item){
                    $temp[] = $item['id'];
                }
                $this->db->where_in('id_chi_tiet_xuat', $temp);
            }else{
                return array();
            }
        }
        if ($active == 1){
            if (count($chi_tiet_xuat_shdn) > 0){
                $temp = array();
                foreach ($chi_tiet_xuat_shdn as $item){
                    $temp[] = $item['id'];
                }
                $this->db->where_in('id_chi_tiet_xuat', $temp);
            }else{
                return array();
            }
        }
        if (isset($data['phong']) && ($data['phong'] !== '')){
            $this->db->like('thiet_bi_su_dung.phong', $data['phong']);
        }

        /* Search ngày của Điều
        if (isset($data['tu_nam']) && isset($data['den_nam']) && ($data['tu_nam'] !== '') && ($data['den_nam'] != '')){
            $this->db->where("YEAR(ngay_su_dung) BETWEEN '".$data['tu_nam']."' AND '".$data['den_nam']."'");
        }
        */

        //Search ngày của Trường Kobe
        if (isset($data['tu_nam']) && ($data['tu_nam'] !== ''))
        {
            $this->db->where('YEAR(ngay_su_dung) >='.$data['tu_nam']);
        }
        if (isset($data['den_nam']) && ($data['den_nam'] !== ''))
        {
            $this->db->where('YEAR(ngay_su_dung) <='.$data['den_nam']);
        }
        //Kết thúc search ngày của Trường Kobe

        if (isset($data['id_khu_nha']) && ($data['id_khu_nha'] !== '')){
            $this->db->where('thiet_bi_su_dung.id_khu_nha', $data['id_khu_nha']);
        }
        if (isset($data['id_don_vi_quan_ly']) && ($data['id_don_vi_quan_ly']) !==''){
            $this->db->where('id_don_vi_quan_ly', $data['id_don_vi_quan_ly']);
        }
        if (isset($data['trang_thai']) && ($data['trang_thai'] !== '')){
            $this->db->where('thiet_bi_su_dung.trang_thai', $data['trang_thai']);
        }
        if (isset($data['id_loai_thiet_bi']) && ($data['id_loai_thiet_bi'] !== '')){
            $this->db->where('dm_ten_thiet_bi.id_loai_thiet_bi', $data['id_loai_thiet_bi']);
        }
        if (isset($data['id_ten_thiet_bi']) && ($data['id_ten_thiet_bi'] !== '')){
            $this->db->where('id_ten_thiet_bi', $data['id_ten_thiet_bi']);
        }
        
        $this->db->join('dm_ten_thiet_bi', 'thiet_bi_su_dung.id_ten_thiet_bi = dm_ten_thiet_bi.id', 'LEFT');
        $this->db->join('dm_loai_thiet_bi', 'dm_loai_thiet_bi.id = dm_ten_thiet_bi.id_loai_thiet_bi', 'LEFT');
        $this->db->join('dm_don_vi', 'dm_don_vi.id = thiet_bi_su_dung.id_don_vi_quan_ly', 'LEFT');
        $this->db->join('chi_tiet_xuat', 'chi_tiet_xuat.id = thiet_bi_su_dung.id_chi_tiet_xuat', 'LEFT');
        $this->db->join('xuat', 'chi_tiet_xuat.id_xuat = xuat.id', 'LEFT');
        $this->db->group_by('id_chi_tiet_xuat');
        $this->db->select('COUNT(thiet_bi_su_dung.id),dm_ten_thiet_bi.ten as ten, dm_ten_thiet_bi.id, 
            dm_don_vi.ten as don_vi, dm_loai_thiet_bi.ten as loai, id_chi_tiet_xuat, xuat.so_hoa_don, 
            MAX(thiet_bi_su_dung.ma_thiet_bi), MIN(thiet_bi_su_dung.ma_thiet_bi)');
        
        $result = $this->db->get('thiet_bi_su_dung');
        // echo $this->db->last_query(); 
        // die();
        return $result->result_array();
    }
    
    public function getThietBiByIdChiTietXuat($id_chi_tiet_xuat){
        
        $this->db->where('thiet_bi_su_dung.id_chi_tiet_xuat', $id_chi_tiet_xuat);
        $this->db->join('dm_ten_thiet_bi', 'thiet_bi_su_dung.id_ten_thiet_bi = dm_ten_thiet_bi.id', 'LEFT');
        $this->db->join('dm_don_vi', 'dm_don_vi.id = thiet_bi_su_dung.id_don_vi_quan_ly', 'LEFT');
        $this->db->join('dm_khu_nha', 'dm_khu_nha.id = thiet_bi_su_dung.id_khu_nha', 'LEFT');
        
        $this->db->select('thiet_bi_su_dung.id, thiet_bi_su_dung.ngay_su_dung, thiet_bi_su_dung.phong, 
        dm_don_vi.ten as don_vi, dm_khu_nha.ten as khu_nha, dm_ten_thiet_bi.ten, thiet_bi_su_dung.trang_thai, 
        thiet_bi_su_dung.ma_thiet_bi');
        $result = $this->db->get('thiet_bi_su_dung');
        
        return $result->result_array();
    }
    
    public function getSoHoaDonByChiTiet($id_chi_tiet_xuat){
        $this->db->where('id', $id_chi_tiet_xuat);
        $this->db->limit(1);
        $this->db->select('id_xuat');
        $temp = $this->db->get('chi_tiet_xuat');
        
        $xuat = $temp->row_array();
        $id_xuat = $xuat['id_xuat'];
        
        $this->db->where('id', $id_xuat);
        $this->db->limit(1);
        $this->db->select('so_hoa_don');
        $result = $this->db->get('xuat');
        
        return $result->row_array();
    }
    
    public function getThietBiSuDung($id){
        $this->db->where('sd.id', $id);
        $this->db->join('dm_ten_thiet_bi', 'sd.id_ten_thiet_bi = dm_ten_thiet_bi.id', 'LEFT');
        $this->db->join('dm_don_vi', 'dm_don_vi.id = sd.id_don_vi_quan_ly', 'LEFT');
        $this->db->join('dm_khu_nha', 'dm_khu_nha.id = sd.id_khu_nha', 'LEFT');
        $this->db->join('dm_loai_thiet_bi', 'dm_loai_thiet_bi.id = dm_ten_thiet_bi.id_loai_thiet_bi', 'LEFT');
        
        $this->db->select('sd.id, ngay_su_dung, sd.trang_thai, phong, sd.mo_ta, 
        dm_ten_thiet_bi.ten, dm_loai_thiet_bi.ten as loai, dm_don_vi.ten as don_vi, 
        dm_khu_nha.ten as khu_nha, tinh_trang, id_chi_tiet_xuat, sd.ma_thiet_bi');
        
        $result = $this->db->get('thiet_bi_su_dung as sd');
        return $result->row_array();
    }
    
    public function updateThietBi($data){
        if (is_numeric($data['id'])){
            $this->db->where('id', $data['id']);
            $result = $this->db->update('thiet_bi_su_dung', $data);
            return $result;
        }else{
            return false;
        }
    }
    
    public function getAllHoaDonNhap(){
        $this->db->select('so_hoa_don');
        $this->db->distinct();
        $result = $this->db->get('nhap');
        
        return $result->result_array();
    }
    
    public function getAllHoaDonXuat(){
        $this->db->select('so_hoa_don');
        $this->db->distinct();
        $result = $this->db->get('xuat');
        
        return $result->result_array();
    }
}

        