<?php
class Mlog_nhapthang extends CI_Model{

    protected $_table = 'log_nhapthang';

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function addItem($data){
        $result = $this->db->insert($this->_table, $data);
        return $result;
    }

    public function getAllItems(){
        $this->db->join('nhap', 'nhap.id = '.$this->_table.'.id_nhap', 'LEFT');
        $this->db->join('acl_user', 'acl_user.id = '.$this->_table.'.id_user', 'LEFT');
        $this->db->select($this->_table.'.id, nhap.so_hoa_don, acl_user.ho_ten, '.$this->_table.'.ngay');
        $result = $this->db->get($this->_table);
        return $result->result_array();
    }

    public function deleteItem($id){
        $id = (int) $id;
        $this->db->where('id', $id);
        $result = $this->db->delete($this->_table);

        return $result;
    }

    public function getItem($id){
        $this->db->where('id', $id);
        $result = $this->db->get($this->_table);
        return $result->row_array();
    }

    public function backup($id){
        $id = (int) $id;
        $log = $this->getItem($id);

        if (count($log) > 0){
            $chi_tiet_xuat = $this->getAllChiTietXuat($log['id_xuat']);
            if (count($chi_tiet_xuat) > 0){
                $temp = array();
                foreach ($chi_tiet_xuat as $item){
                    $temp[] = $item['id'];
                }
                $this->deleteThietBi($temp);
            }
            $this->deleteChiTietXuat($log['id_xuat']);
            $this->deleteChiTietNhap($log['id_nhap']);
            $this->deleteXuat($log['id_xuat']);
            $this->deleteNhap($log['id_nhap']);
        }
        return  $this->deleteItem($id);
    }

    private function getAllChiTietXuat($id_xuat){
        $this->db->where('id_xuat', $id_xuat);
        $this->db->select('id');
        $result = $this->db->get('chi_tiet_xuat');
        return $result->result_array();
    }

    private function deleteThietBi($chi_tiet_xuat){
        $this->db->where_in('id_chi_tiet_xuat', $chi_tiet_xuat);
        $result = $this->db->delete('thiet_bi_su_dung');
        return $result;
    }

    private function deleteChiTietXuat($id_xuat){
        $this->db->where('id_xuat', $id_xuat);
        $result = $this->db->delete('chi_tiet_xuat');
        return $result;
    }

    private function deleteXuat($id){
        $this->db->where('id', $id);
        $result = $this->db->delete('xuat');
        return $result;
    }

    private function deleteChiTietNhap($id_nhap){
        $this->db->where('id_nhap', $id_nhap);
        $result = $this->db->delete('chi_tiet_nhap');
        return $result;
    }

    private function deleteNhap($id){
        $this->db->where('id', $id);
        $result = $this->db->delete('nhap');
        return $result;
    }
}