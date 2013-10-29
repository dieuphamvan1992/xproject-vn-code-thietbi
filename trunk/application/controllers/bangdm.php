<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');
class Bangdm extends Tb_controller {

	public function __construct()
	{
		parent::__construct();
		if (($this->role < 0) || ($this->role > 3))
		{
			redirect("/");
			exit;
		}
		$this->load->helper('url');
	}

	public function index()
	{
		$temp['title'] = "Bảng Danh mục";
		$temp['template'] = 'bangdm';
		$temp['data']['title'] = "DANH SÁCH BẢNG DANH MỤC";
		$this->load->view('thietbi/layout',$temp);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */