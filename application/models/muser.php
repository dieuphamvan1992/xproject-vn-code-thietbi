<?php
class Muser extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function login($username, $password){
        $this->db->select('*');
        $this->db->from('acl_user');
        $this->db->where('ten_dang_nhap', $username);
        $this->db->where('mat_khau', md5($password));
        $this->db->limit(1);
        
        $result = $this->db->get();
        if ($result->num_rows() == 1){
            return $result->row_array();
        }
        return false;
    }
}