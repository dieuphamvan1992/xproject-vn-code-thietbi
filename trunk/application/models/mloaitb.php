<?php
class Mloaitb extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();	
	}

	public function selectAllLoaitb()
	{
		$query=$this->db->get("dm_loai_thiet_bi");
        return $query->result_array();
	}

	public function addLoaitb($data){
		$this->db->insert("dm_loai_thiet_bi", $data);
        return $this->db->insert_id();
	}

	public function updateLoaitb($data, $id)
	{
		$this->db->where("id", $id);
		$this->db->update("dm_loai_thiet_bi", $data);
	}

	public function deleteLoaitb($id)
	{	
		//echo "test";
		$this->db->where("id", $id);
		$this->db->delete("dm_loai_thiet_bi");
	}

	public function getLoaitbById($id)
	{
		$this->db->select();
		$this->db->where("id",$id);
		$query = $this->db->get("dm_loai_thiet_bi");
		$row = $query->row();
		return $row;
	}
    
    public function getLoaiThietBiByTen($ten){
        $this->db->select('id');
        $this->db->where("ten", $ten);
        $result = $this->db->get('dm_loai_thiet_bi');
        
        return $result->row_array();
    }
}
?>