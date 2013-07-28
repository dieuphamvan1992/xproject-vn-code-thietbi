<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dmkhunha extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->Model("Mkhunha");
	}

	public function index()
	{
            $temp['data']['success'] = 0;
            $temp['data']['warning'] = 0;

            $temp['title']="Danh mục Khu nhà";
            $temp['template']='dmkhunha/index';
            $temp['data']['title'] = "DANH MỤC KHU NHÀ";

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
	        	$this->Mloaitb->addKhunha($dulieu);
	        	$temp['data']['success'] = 1;
	        }
	        else if($this->input->post('submit') == "Cập nhật")
	        {
	        	$id = $this->input->post('id');
	        	$this->Mloaitb->updateKhunha($dulieu, $id);
	        	$temp['data']['success'] = 1;
	        }
	    }

            $temp['data']['datas'] = $this->Mkhunha->selectAllKhunha();
            //$temp['data']['test'] = $id;
		
            $this->load->view('thietbi/layout',$temp);
	}

	public function add()
	{
		$temp['template']='dmkhunha/add';
        $temp['data']['title']='BỔ SUNG KHU NHÀ';
        $this->load->view('layout',$temp);
	}

	public function edit($id){
		$temp['template']='dmkhunha/edit';
		$temp['data']['title']='CẬP NHẬT THÔNG TIN';
		
		$temp['data']['datas'] = $this->Mkhunha->getKhunhaById($id);

		$this->load->view('layout',$temp);
	}

	public function delete($id)
	{
		if($id)
		{
			$this->Mkhunha->deleteKhunha($id);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */