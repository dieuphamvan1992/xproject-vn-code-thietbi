<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

class Ajax extends Tb_controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Musers');
		//$this->load->model('Mstaff');

	}

	public function getUserType()
	{
		$id = $this->input->post('id',0);
		$donvi = "";
		$isview = 0;
		$isupdate = 0;
		$role = $this->Musers->getUserRole($id);
		if (!empty($role))
		{
			$isview = $role->isview;
			$isupdate = $role->isupdate;
		}
		if (($id <=3) && ($id>0))
			$donvi = "0";
		$arr= array(
			"donvi" => "$donvi",
			"isview" => $isview,
			"isupdate" => $isupdate,
			);
		echo json_encode($arr);
	}
}
