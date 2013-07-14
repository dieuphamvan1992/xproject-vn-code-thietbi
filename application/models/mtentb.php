<?php
class Mtentb extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();	
	}

	public function selectAllTentb()
	{
		$query=$this->db->get("dm_ten_thiet_bi");
        return $query->result_array();
	}

	public function addTentb($data){
		$this->db->insert("dm_ten_thiet_bi", $data);
	}

	public function updateTentb($data, $id)
	{
		$this->db->where("id", $id);
		$this->db->update("dm_ten_thiet_bi", $data);
	}

	public function deleteTentb($id)
	{	
		//echo "test";
		$this->db->where("id", $id);
		$this->db->delete("dm_ten_thiet_bi");
	}

	public function getTentbById($id)
	{
		$this->db->select();
		$this->db->where("id",$id);
		$query = $this->db->get("dm_ten_thiet_bi");
		$row = $query->row();
		return $row;
	}
}
?>