<?php
class Mnguonvon extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function selectAllNguonvon()
	{
		$query=$this->db->get("dm_nguon_von");
		return $query->result_array();
	}

	public function addNguonvon($data){
		$this->db->insert("dm_nguon_von", $data);
	}

	public function updateNguonvon($data, $id)
	{
		$this->db->where("id", $id);
		$this->db->update("dm_nguon_von", $data);
	}

	public function deleteNguonvon($id)
	{
		//echo "test";
		$this->db->where("id", $id);
		$this->db->delete("dm_nguon_von");
	}

	public function getNguonvonById($id)
	{
		$this->db->select();
		$this->db->where("id",$id);
		$query = $this->db->get("dm_nguon_von");
		$row = $query->row();
		return $row;
	}

	public function getListNguonVon()
	{
		$this->db->select("id,ten");
		$this->db->order_by("ten");
		$query=$this->db->get("dm_nguon_von");
		return $query->result_array();
	}
}
?>