<?php
class Mdv extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();	
	}

	public function selectDonviLevel($cap)
	{
		$this->db->select();
		$this->db->where('cap',$cap);
		$this->db->order_by('ma_dv');
		$query = $this->db->get('dm_dv');

        return $query->result_array();
	}

	public function getCha($cap, $cha)
	{
		$this->db->select();
		$this->db->where('cap', $cap);
		$this->db->where('cha', $cha);
		$this->db->order_by('ma_dv');
		$query = $this->db->get('dm_dv');

		return $query->result_array();
	}

	public function getDonvibyId($id)
	{
		$this->db->select();
		$this->db->where('ma_dv',$id);
		$query = $this->db->get('dm_dv');
		$row = $query->row();
		return $row;
	}
}
?>