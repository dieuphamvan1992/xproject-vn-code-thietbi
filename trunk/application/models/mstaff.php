<?php

class Mstaff extends CI_Model {

    var $table = "xuat";

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getListDonVi() {
        $this->canbo = $this->load->database('staff',TRUE); // Khi sử dụng thì thay $this->db bằng $this->uc .
        $this->canbo->select("a.*");
        $query = $this->canbo->get("dm_dv as a");
        return $query->result_array();
    }
}