<?php
class Mkhunha extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();	
	}

	public function selectAllKhunha()
	{
		$query=$this->db->get("dm_khu_nha");
        return $query->result_array();
	}

	public function addKhunha($data){
		$this->db->insert("dm_khu_nha", $data);
	}

	public function updateKhunha($data, $id)
	{
		$this->db->where("id", $id);
		$this->db->update("dm_khu_nha", $data);
	}

	public function deleteKhunha($id)
	{	
		//echo "test";
		$this->db->where("id", $id);
		$this->db->delete("dm_khu_nha");
	}

	public function getKhunhaById($id)
	{
		$this->db->select();
		$this->db->where("id",$id);
		$query = $this->db->get("dm_khu_nha");
		$row = $query->row();
		return $row;
	}
}
?>