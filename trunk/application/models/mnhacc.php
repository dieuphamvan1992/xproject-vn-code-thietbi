<?php
class Mnhacc extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();	
	}

	public function selectAllNhacc()
	{
		$query=$this->db->get("dm_nha_cung_cap");
        return $query->result_array();
	}

	public function addNhacc($data){
		$this->db->insert("dm_nha_cung_cap", $data);
	}

	public function updateNhacc($data, $id)
	{
		$this->db->where("id", $id);
		$this->db->update("dm_nha_cung_cap", $data);
	}

	public function deleteNhacc($id)
	{	
		//echo "test";
		$this->db->where("id", $id);
		$this->db->delete("dm_nha_cung_cap");
	}

	public function getNhaccById($id)
	{
		$this->db->select();
		$this->db->where("id",$id);
		$query = $this->db->get("dm_nha_cung_cap");
		$row = $query->row();
		return $row;
	}

	public function getAllQuocGia()
	{
		$query=$this->db->get("dm_qg");
        return $query->result_array();
	}
}
?>