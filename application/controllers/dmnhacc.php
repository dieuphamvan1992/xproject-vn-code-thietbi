<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dmnhacc extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->Model("Mnhacc");
	}

	public function index()
	{
		$temp['data']['success'] = 0;
		$temp['data']['warning'] = 0;

		$temp['title']="Danh mục Nhà cung cấp";
        $temp['template']='dmnhacc/index';
        $temp['data']['title'] = "DANH MỤC NHÀ CUNG CẤP";

        if($this->input->post('submit'))
        {
	        $ten = $this->input->post('ten');
	        $sdt = $this->input->post('so_dien_thoai');
	        $email = $this->input->post('email');
	        $diachi = $this->input->post('dia_chi');
	        $idquocgia = $this->input->post('id_quoc_gia');
	        $trangthai = $this->input->post('trang_thai');
	        $mota = $this->input->post('mo_ta');

	       	$dulieu = array(
	        		"ten" => $ten,
	        		"so_dien_thoai"	=> $sdt,
	        		"email"	=> $email,
	        		"dia_chi" => $diachi,
	        		"id_quoc_gia" => $idquocgia,
	        		"trang_thai" => $trangthai,
	        		"mo_ta" => $mota
	        );
	        if($this->input->post('submit') == 'Thêm')
	        {
	        	$this->Mnhacc->addNhacc($dulieu);
	        	$temp['data']['success'] = 1;
	        }
	        else if($this->input->post('submit') == "Cập nhật")
	        {
	        	$id = $this->input->post('id');
	        	$this->Mnhacc->updateNhacc($dulieu, $id);
	        	$temp['data']['success'] = 1;
	        }
	    }

		$temp['data']['datas'] = $this->Mnhacc->selectAllNhacc();
		//$temp['data']['test'] = $id;
		
		$this->load->view('thietbi/layout',$temp);
	}

	public function add()
	{
		$temp['template']='dmnhacc/add';
        $temp['data']['title']='BỔ SUNG DỮ LIỆU';
        $this->load->view('layout',$temp);
	}

	public function edit($id){
		$temp['template']='dmnhacc/edit';
		$temp['data']['title']='CẬP NHẬT THÔNG TIN';
		
		$temp['data']['datas'] = $this->Mnhacc->getNhaccById($id);

		$this->load->view('layout',$temp);
	}

	public function delete($id)
	{
		if($id)
		{
			$this->Mnhacc->deleteNhacc($id);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */