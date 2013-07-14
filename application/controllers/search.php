<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

class Search extends Tb_controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Msearch');
    }
    
    public function index(){
        $data['title'] = "Tìm kiếm thiết bị";
        $data['template'] = "search/index";
        $data['data'] = array();
        
        $don_vi = $this->Msearch->getAllDonVi();
        $khu_nha = $this->Msearch->getAllKhuNha();
        $ten_thiet_bi = $this->Msearch->getAllTenThietBi();
        $loai_thiet_bi = $this->Msearch->getAllLoaiThietBi();
        
        $data['data']['list_don_vi'] =  $don_vi;
        $data['data']['list_khu_nha'] = $khu_nha;
        $data['data']['list_ten_thiet_bi'] = $ten_thiet_bi;
        $data['data']['list_loai_thiet_bi'] = $loai_thiet_bi;
        if (isset($_POST['submit'])){
            $data_form['id'] = $this->change_string($this->input->post('ma', TRUE));
            $data_form['trang_thai'] = $this->input->post('tt', TRUE);
            $data_form['id_ten_thiet_bi'] = $this->input->post('ten', TRUE);
            $data_form['id_loai_thiet_bi'] = $this->input->post('loai_thiet_bi');
            $data_form['id_don_vi_quan_ly'] = $this->input->post('don_vi', TRUE);
            $data_form['id_khu_nha'] = $this->input->post('khu_nha', TRUE);
            $data_form['tu_nam'] = $this->input->post('tu', TRUE);
            $data_form['den_nam'] = $this->input->post('den', TRUE);
            $data_form['phong'] = $this->change_string($this->input->post('phong', TRUE));
            
            $result = $this->Msearch->searchItem($data_form);
            $data['data']['list_thiet_bi'] = $result;
            
            $this->load->view('thietbi/layout', $data);
        }else{
            $data['data']['is_first'] = true;
            $this->load->view('thietbi/layout', $data);
        }
    }
    
    public function change_string($str){
        return preg_replace('/\s+/', ' ', trim($str));
    }
}