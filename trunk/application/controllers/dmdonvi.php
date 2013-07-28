<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dmdonvi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->Model("Mdonvi");
	}

	public function index()
	{
		$temp['data']['success'] = 0;
		$temp['data']['warning'] = 0;

		$temp['title']="Danh mục Đơn vị";
        $temp['template']='dmdonvi/index';
        $temp['data']['title'] = "DANH MỤC ĐƠN VỊ";

        if($this->input->post('submit'))
        {
	        $ma = $this->input->post('ma');
	        $ten = $this->input->post('ten');
	        $idlanhdao = $this->input->post('id_lanh_dao');
	        $trangthai = $this->input->post('trang_thai');
	        $mota = $this->input->post('mo_ta');

	        if($ma != "")
	        {
	        	if(trim($ma) != "")
	        	{
	        		$dulieu = array(
	        				"ma" => $ma,
	        				"ten" => $ten,
	        				"id_lanh_dao" => $idlanhdao,
	        				"trang_thai" => $trangthai,
	        				"mo_ta" => $mota
	        			);
	        		if($this->input->post('submit') == 'Thêm')
	        		{
	        			$this->Mdonvi->addDonvi($dulieu);
	        			$temp['data']['success'] = 1;
	        		}
	        		else if($this->input->post('submit') == "Cập nhật")
	        		{
	        			$id = $this->input->post('id');
	        			$this->Mdonvi->updateDonvi($dulieu, $id);
	        			$temp['data']['success'] = 1;
	        		}
	        	}
	        }
	        else
	        {
	        	$temp['data']['warning'] = 1;
	        }
	    }

		$temp['data']['datas'] = $this->Mdonvi->selectAllDonvi();
		//$temp['data']['test'] = $id;
		
		$this->load->view('thietbi/layout',$temp);
	}

	public function add()
	{
        $temp['template']='dmdonvi/add';
        $temp['data']['title']='BỔ SUNG ĐƠN VỊ';
        $this->load->view('layout',$temp);
	}

	public function edit($id){
		$temp['template']='dmdonvi/edit';
		$temp['data']['title']='CẬP NHẬT THÔNG TIN';
		
		$temp['data']['datas'] = $this->Mdonvi->getDonviById($id);

		$this->load->view('layout',$temp);
	}

	public function delete($id)
	{
		if($id)
		{
			$this->Mdonvi->deleteDonvi($id);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */