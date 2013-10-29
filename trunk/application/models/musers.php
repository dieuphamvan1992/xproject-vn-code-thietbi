<?php
class Musers extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function checkUserLogin($user, $pass){
		$this->db->select('COUNT(id) as num,username, role, isview, isupdate, donvi, id');
		$this->db->where("username", $user);
		$this->db->where("password", $pass);
		$this->db->where("status", 0);
		$query = $this->db->get("user");
		$row = $query->row();
		return $row;
	}

	public function getListUser()
	{
		$this->db->select('a.id, username, name, role, a.isupdate, a.isview, donvi, status, b.role_name');
		$this->db->order_by('username');
		$this->db->join('user_role as b','b.role_id = a.role','left');
		$query=$this->db->get("user as a");
        return $query->result_array();

	}

	public function getListRole()
	{
		$this->db->select('*');
		$query=$this->db->get("user_role as a");
        return $query->result_array();

	}

	public function getUserRole($id)
	{
		$this->db->select('*');
		$this->db->where('role_id', $id);
		$query=$this->db->get("user_role as a");
		$row = $query->row();
		return $row;
	}
	public function checkExist($username, $id="")
	{
		$this->db->select('COUNT(*) as num');
		$this->db->where('username',$username);
		if ($id != "")
		{
			$this->db->where('id !=',$id);
		}
		$query = $this->db->get("user");
		$row = $query->row();
		return $row;
	}

	public function insertUser($username, $pass, $name, $role, $isview, $isupdate, $dv, $status)
	{
		$this->db->set("username", $username);
		$this->db->set("password", $pass);
		$this->db->set("name", $name);
		$this->db->set("role", $role);
		$this->db->set("isview", $isview);
		$this->db->set("isupdate", $isupdate);
		$this->db->set("donvi", $dv);
		$this->db->set("status", $status);
        $this->db->insert("user");
	}
	public function getInfoUser($id)
	{
		$this->db->select('a.id, username, name, role, a.isupdate, a.isview, donvi, status, b.role_name');
		$this->db->order_by('username');
		$this->db->join('user_role as b','b.role_id = a.role','left');
		$this->db->where('id',$id);
		$query=$this->db->get("user as a");
        $row = $query->row();
		return $row;
	}

	public function updateUser($username, $pass1, $name, $role, $isview, $isupdate, $dv, $status, $id)
	{

		$this->db->set("username", $username);
		if (strlen($pass1)>0)
		{
			$this->db->set("password", md5($pass1));
		}
		$this->db->set("name", $name);
		$this->db->set("role", $role);
		$this->db->set("isview", $isview);
		$this->db->set("isupdate", $isupdate);
		$this->db->set("donvi", $dv);
		$this->db->set("status", $status);
		$this->db->where('id',$id);
		$this->db->update("user");
	}
}
?>