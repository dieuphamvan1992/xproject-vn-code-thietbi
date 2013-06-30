<?php
class Mloaithietbi extends CI_Model{
    var $table = "loai_thiet_bi";

    public function __construct(){
        parent::__construct();
        $this->load->database();

    }
  public function _getAllData(){
      $this->db->select("id,ten");
      $this->db->order_by("ten");
      $query=$this->db->get($this->table);
      return $query->result_array();
    }

}