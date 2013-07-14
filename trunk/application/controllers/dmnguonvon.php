<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dmnguonvon extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->Model("Mnguonvon");
	}

	public function index()
	{
		$temp['data']['success'] = 0;
		$temp['data']['warning'] = 0;

		$temp['title']="Danh mục Nguồn vốn";
        $temp['template']='dmnguonvon/index';
        $temp['data']['title'] = "DANH MỤC NGUỒN VỐN";

        if($this->input->post('submit'))
        {
	        $ma = $this->input->post('ma');
	        $ten = $this->input->post('ten');
	        $trangthai = $this->input->post('trang_thai');
	        $mota = $this->input->post('mo_ta');

	        if($ma != "")
	        {
	        	if(trim($ma) != "")
	        	{
	        		$dulieu = array(
	        				"ma" => $ma,
	        				"ten" => $ten,
	        				"trang_thai" => $trangthai,
	        				"mo_ta" => $mota
	        			);
	        		if($this->input->post('submit') == 'Thêm')
	        		{
	        			$this->Mnguonvon->addNguonvon($dulieu);
	        			$temp['data']['success'] = 1;
	        		}
	        		else if($this->input->post('submit') == "Cập nhật")
	        		{
	        			$id = $this->input->post('id');
	        			$this->Mnguonvon->updateNguonvon($dulieu, $id);
	        			$temp['data']['success'] = 1;
	        		}
	        	}
	        }
	        else
	        {
	        	$temp['data']['warning'] = 1;
	        }
	    }

		$temp['data']['datas'] = $this->Mnguonvon->selectAllNguonvon();
		//$temp['data']['test'] = $id;
		
		$this->load->view('layout',$temp);
	}

	public function add()
	{
		$temp['template']='dmnguonvon/add';
        $temp['data']['title']='BỔ SUNG NGUỒN VỐN';
        $this->load->view('layout',$temp);
	}

	public function edit($id){
		$temp['template']='dmnguonvon/edit';
		$temp['data']['title']='CẬP NHẬT THÔNG TIN';
		
		$temp['data']['datas'] = $this->Mnguonvon->getNguonvonById($id);

		$this->load->view('layout',$temp);
	}

	public function delete($id)
	{
		if($id)
		{
			$this->Mnguonvon->deleteNguonvon($id);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */