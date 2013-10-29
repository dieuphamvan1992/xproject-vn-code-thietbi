<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');
class Dmloaitb extends Tb_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->Model("Mloaitb");
	}

	public function index()
	{
		$temp['data']['success'] = 0;
		$temp['data']['warning'] = 0;

		$temp['title']="Danh mục Loại Thiết bị";
        $temp['template']='dmloaitb/index';
        $temp['data']['title'] = "DANH MỤC LOẠI THIẾT BỊ";

        if($this->input->post('submit'))
        {
	        $ten = $this->input->post('ten');
	        $trangthai = $this->input->post('trang_thai');
	        $mota = $this->input->post('mo_ta');
	       	$dulieu = array(
	        		"ten" => $ten,
	        		"trang_thai" => $trangthai,
	        		"mo_ta" => $mota
	        );
	        if($this->input->post('submit') == 'Thêm')
	        {
	        	$this->Mloaitb->addLoaitb($dulieu);
	        	$temp['data']['success'] = 1;
	        }
	        else if($this->input->post('submit') == "Cập nhật")
	        {
	        	$id = $this->input->post('id');
	        	$this->Mloaitb->updateLoaitb($dulieu, $id);
	        	$temp['data']['success'] = 1;
	        }
	    }

		$temp['data']['datas'] = $this->Mloaitb->selectAllLoaitb();
		//$temp['data']['test'] = $id;
		
		$this->load->view('thietbi/layout',$temp);
	}

	public function add()
	{
		$temp['template']='dmloaitb/add';
        $temp['data']['title']='BỔ SUNG LOẠI THIẾT BỊ';
        $this->load->view('layout',$temp);
	}

	public function edit($id){
		$temp['template']='dmloaitb/edit';
		$temp['data']['title']='CẬP NHẬT THÔNG TIN';
		
		$temp['data']['datas'] = $this->Mloaitb->getLoaitbById($id);

		$this->load->view('layout',$temp);
	}

	public function delete($id)
	{
		if($id)
		{
			$this->Mloaitb->deleteLoaitb($id);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */