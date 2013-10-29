<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

class Manage extends Tb_controller {

	public function __construct() {
		parent::__construct();
		if (($this->role < 0) || ($this->role > 3))
		{
			redirect("/");
			exit;
		}
		$this->load->helper('form');
		//$this->load->helper('url');
		$this->load->model('Musers');
		$this->load->model('Mstaff');

	}

	function index() {

		$temp['title'] = "Quản trị người dùng";
		$temp['data']['list_user'] = $this->Musers->getListUser();
		$temp['data']['list_donvi'] = $this->Mstaff->getListDonVi();
		$temp['data']['list_role'] = $this->Musers->getListRole();
		$temp['template'] ="users/manage";
		$this->load->view('thietbi/layout', $temp);
	}
	function edit($id)
	{
		$temp['title'] = "Quản trị người dùng";
		$temp['data']['list_user'] = $this->Musers->getListUser();
		$temp['data']['list_donvi'] = $this->Mstaff->getListDonVi();
		$temp['data']['list_role'] = $this->Musers->getListRole();
		$temp['data']['edit'] = $this->Musers->getInfoUser($id);
		$temp['template'] ="users/manage";
		$this->load->view('thietbi/layout', $temp);
	}

	function add()
	{
		if ($this->input->post('username'))
		{
			$username = $this->input->post('username');
			$name = $this->input->post('name');
			$pass = md5($this->input->post('pass1'));
			$role = $this->input->post('role');
			$donvi = $_POST['donvis'];
			//var_dump($_POST);

			$isview = $this->input->post('isview');
			$isupdate = $this->input->post('isupdate');
			$status = $this->input->post('status');

			$check = $this->Musers->checkExist($username);
			if ($check->num == 0)
			{
				$dv = "";
			//	var_dump($donvi);
				foreach ($donvi as $item)
				{

					if (strlen($dv)==0) {$dv .= $item;}
					else $dv .= ";".$item;

				}
				$this->Musers->insertUser($username, $pass, $name, $role, $isview, $isupdate, $dv, $status);
				$this->session->set_flashdata('success','Đã thêm tài khoản thành công!');
				redirect("users/manage/");
			}
			else {
				$this->session->set_flashdata('error','Tên tài khoản đã tồn tại!');
				redirect("users/manage/");
			}
		}
	}

	function doEdit()
	{
		if ($this->input->post('username'))
		{
			$id = $this->input->post('id_cu');
			$username = $this->input->post('username');
			$name = $this->input->post('name');
			$pass1 = $this->input->post('pass1');
			$pass2 = $this->input->post('pass2');
			$role = $this->input->post('role');
			$donvi = $this->input->post('donvis');
			//var_dump($_POST);

			$isview = $this->input->post('isview');
			$isupdate = $this->input->post('isupdate');
			$status = $this->input->post('status');

			$check = $this->Musers->checkExist($username,$id);
			if ($check->num == 0)
			{
				$dv = "";
				foreach ($donvi as $item)
				{

					if (strlen($dv)==0) {$dv .= $item;}
					else $dv .= ";".$item;

				}
				$this->Musers->updateUser($username, $pass1, $name, $role, $isview, $isupdate, $dv, $status, $id);
				$this->session->set_flashdata('success','Đã cập nhật tài khoản thành công!');
				redirect("users/manage/");
			}
			else {
				$this->session->set_flashdata('error','Tên tài khoản đã tồn tại!');
				redirect("users/manage/");
			}
		}
	}

}
