<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

class Upload extends Tb_controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->helper('number');
    }
    
    public function index(){
        $this->load->view("upload/index", array("error" => ''));
    }
    
    public function do_upload(){
        $config['upload_path'] = APPPATH . "../upload/img/";
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '5000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
        $config['overwrite'] = TRUE;
        
        $this->load->model('Mtentb');
        $temp = $this->Mtentb->getNewId();
        $new_id = $temp['MAX(id)'] + 1;
        $config["file_name"] = "img_tb_" . $new_id;
        
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload/index', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
            $this->session->set_userdata('img', "upload/img/".$config['file_name']);
			$this->load->view('upload/success', $data);
		}
    }
    
    public function remove(){
        $this->session->unset_userdata('img');
        redirect('upload');
    }
}