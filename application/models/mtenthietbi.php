<?php

class Mtenthietbi extends CI_Model {

    var $table = "ten_thiet_bi";

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function _getAllData() {
        $this->db->select("id,ten");
        $this->db->order_by("ten");
        //$this->db->where();
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function _getThietBiX($id) {
        $this->db->select("ten_thiet_bi.*, b.ten as ten_loai");
        $this->db->where("ten_thiet_bi.id", $id);
        $this->db->limit(1, 0);
        $this->db->join('loai_thiet_bi as b', 'ten_thiet_bi.id_loai_thiet_bi = b.id', 'left');
        $query = $this->db->get($this->table);
        $row = $query->row();
        return $row;
    }

    public function getTenThietBi($id) {
        $this->db->select("ten");
        $this->db->where("id", $id);
        $this->db->limit(1, 0);
        $query = $this->db->get($this->table);
        $row = $query->row();
       // var_dump($row);
        return $row->ten;
    }

    public function _ajaxGetThietBiByIDLoai($id_loai_thiet_bi) {
        $this->db->select("id, ten");
        $this->db->where("id_loai_thiet_bi", $id_loai_thiet_bi);
        $query = $this->db->get($this->table);
        // return $query->result_array();
        $list_thietbi = array();

        if ($query->result()) {
            foreach ($query->result() as $thietbi) {
                $list_thietbi[$thietbi->id] = $thietbi->ten;
            }
            return $list_thietbi;
        } else {
            return FALSE;
        }
    }

}