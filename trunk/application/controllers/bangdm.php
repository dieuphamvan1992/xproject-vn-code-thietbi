<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bangdm extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
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