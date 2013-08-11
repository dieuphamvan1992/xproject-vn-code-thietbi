<?php
class Mnewtb extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function getMaxMa($id_don_vi){
        $id_don_vi = (int) $id_don_vi;
        $this->db->where("id_don_vi_quan_ly", $id_don_vi);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $this->db->select("ma_thiet_bi");
        $result = $this->db->get("thiet_bi_su_dung");
        
        return $result->row_array();
    }
    
    public function creatMa($str){
        $str = (string) $str;
        $n = strlen($str);
        $temp = "";
        for ($i = 0; $i < 6 - $n; $i++){
            $temp = $temp . "0";
        }
        $str = substr($str, 0, 6);
        return $temp.$str;
    }
    
    public function newMaThietBi($id_don_vi){
        $id_don_vi = (int) $id_don_vi;
        $temp = $this->getMaxMa($id_don_vi);
        
        $max_ma = "";
        if ($temp['ma_thiet_bi'] !== null){
            $ar = explode(".", $temp['ma_thiet_bi']);
            $max_ma = $ar[1];
        }
        
        if ($max_ma === ""){
            return $this->creatPreMa($id_don_vi).".000001";
        }else{
            $max_ma = (int)$max_ma;
            $ma = $max_ma + 1;
            $pre = $this->creatPreMa($id_don_vi);
            
            return $pre. "." . $this->creatMa($ma);
        }
    }
    
    public function creatPreMa($id_don_vi){
        $id_don_vi = (string) $id_don_vi;
        $n = strlen($id_don_vi);
        $temp = "";
        for ($i = 0; $i < 6 - $n; $i++){
            $temp = $temp . "0";
        }
        $str = substr($id_don_vi, 0, 6);
        return $temp.$str;
    }
}