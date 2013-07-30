<?php
class Mnhacungcap extends CI_Model{
    var $table = "dm_nha_cung_cap";
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