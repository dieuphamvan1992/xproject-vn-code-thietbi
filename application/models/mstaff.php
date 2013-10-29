<?php

class Mstaff extends CI_Model {

    var $table = "xuat";

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getListDonVi($arr="") {

        $this->canbo = $this->load->database('staff',TRUE); // Khi sử dụng thì thay $this->db bằng $this->uc .
        $this->canbo->select("a.*");
        //$this->canbo->where();
        if ($arr!="")
        {
            $donvis = explode(';', $arr);
            foreach ($donvis as $item)
            {
                $this->canbo->or_where('left(ma_dv, (length("'.$item.'"))) = ' ,$item);
            }
        }
         $this->canbo->order_by('ma_dv');
        $query = $this->canbo->get("dm_dv as a");
        return $query->result_array();
    }

}