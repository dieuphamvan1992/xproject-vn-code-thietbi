<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dmtentb extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->Model("Mtentb");
		$this->load->Model("Mloaitb");
	}

	public function index()
	{
		$temp['data']['success'] = 0;
		$temp['data']['warning'] = 0;

		$temp['title']="Danh mục Thiết bị";
        $temp['template']='dmtentb/index';
        $temp['data']['title'] = "DANH MỤC THIẾT BỊ";

        if($this->input->post('submit'))
        {
	        $ten = $this->input->post('ten');
	        $anh = $this->input->post('anh');
	        $idloaitb = $this->input->post('id_loai_thiet_bi');
	        $donvitinh = $this->input->post('don_vi_tinh');
	        $trangthai = $this->input->post('trang_thai');
	        $mota = $this->input->post('mo_ta');

	       	$dulieu = array(
	        		"ten" => $ten,
	        		"anh"	=> $anh,
	        		"id_loai_thiet_bi"	=> $idloaitb,
	        		"don_vi_tinh" => $donvitinh,
	        		"trang_thai" => $trangthai,
	        		"mo_ta" => $mota
	        );
	        if($this->input->post('submit') == 'Thêm')
	        {
	        	$this->Mtentb->addTentb($dulieu);
	        	$temp['data']['success'] = 1;
	        }
	        else if($this->input->post('submit') == "Cập nhật")
	        {
	        	$id = $this->input->post('id');
	        	$this->Mtentb->updateTentb($dulieu, $id);
	        	$temp['data']['success'] = 1;
	        }
	    }

		$temp['data']['datas'] = $this->Mtentb->selectAllTentb();
		$temp['data']['listtb'] = $this->Mloaitb->selectAllLoaitb();
		//$temp['data']['test'] = $id;
		
		$this->load->view('layout',$temp);
	}

	public function add()
	{
		$temp['template']='dmtentb/add';
        $temp['data']['title']='BỔ SUNG THIẾT BỊ';
        $temp['data']['listtb'] = $this->Mloaitb->selectAllLoaitb();
        $this->load->view('layout',$temp);
	}

	public function edit($id){
		$temp['template']='dmtentb/edit';
		$temp['data']['title']='CẬP NHẬT THÔNG TIN';
		
		$temp['data']['datas'] = $this->Mtentb->getTentbById($id);
		$temp['data']['listtb'] = $this->Mloaitb->selectAllLoaitb();

		$this->load->view('layout',$temp);
	}

	public function delete($id)
	{
		if($id)
		{
			$this->Mtentb->deleteTentb($id);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */