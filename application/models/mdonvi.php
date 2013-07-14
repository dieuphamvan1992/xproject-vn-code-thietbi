<?php
class Mdonvi extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();	
	}

	public function selectAllDonvi()
	{
		$query=$this->db->get("dm_don_vi");
        return $query->result_array();
	}

	public function addDonvi($data){
		$this->db->insert("dm_don_vi", $data);
	}

	public function updateDonvi($data, $id)
	{
		$this->db->where("id", $id);
		$this->db->update("dm_don_vi", $data);
	}

	public function deleteDonvi($id)
	{	
		//echo "test";
		$this->db->where("id", $id);
		$this->db->delete("dm_don_vi");
	}

	public function getDonviById($id)
	{
		$this->db->select();
		$this->db->where("id",$id);
		$query = $this->db->get("dm_don_vi");
		$row = $query->row();
		return $row;
	}
}
?>