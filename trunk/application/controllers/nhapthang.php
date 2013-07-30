<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

class NhapThang extends Tb_controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Mnhapthang');
    }
    
    public function index(){
        $data['title'] = 'nhập thẳng thiết bị';
        $data['template'] = 'nhapthang/index';
        $data['data'] = array();
        
        $data['data']['ds_nha_cung_cap'] = $this->Mnhapthang->getAllNhaCungCap();
        $data['data']['ds_ten_thiet_bi'] = $this->Mnhapthang->getAllTenThietBi();
        $data['data']['ds_quoc_gia'] = $this->Mnhapthang->getAllQuocGia();
        $data['data']['ds_don_vi'] = $this->Mnhapthang->getAllDonVi();
        $data['data']['ds_khu_nha'] = $this->Mnhapthang->getAllKhuNha();
        $data['data']['ds_nguon_von'] = $this->Mnhapthang->getAllNguonVon();
        $data['data']['list_loai_thiet_bi'] = $this->Mnhapthang->getAllLoaiThietBi();
        
        $this->load->view('thietbi/layout', $data);
    }
    
    public function add(){
        if (!isset($_POST['submit'])){
            redirect('nhapthang/');
        }else{
            $temp1 = array();
            $temp1['id_nha_cung_cap'] = $this->input->post('nha_cung_cap', true);
            $temp1['so_hoa_don'] = $this->input->post('so_hd', true);
            $id_nhap = $this->addNhap($temp1);
            
            $temp2 = array();
            $temp2['so_hoa_don'] = $this->input->post('so_hd', true);
            $id_xuat = $this->addXuat($temp2);
            
            $temp3 = array();
            $temp3['id_nhap'] = $id_nhap;
            
            $temp4 = array();
            $temp4['id_xuat'] = $id_xuat;
            $temp4['id_don_vi_nhan'] = $this->input->post('don_vi_nhan', true);
            $temp4['id_khu_nha'] = $this->input->post('khu_nha', true);
            $temp4['id_nguon_von'] = $this->input->post('nguon_von', true);
            $temp4['cho_muon'] = $this->input->post('cho_muon', true);
            if (isset($_POST['phong'])){
                $temp4['phong'] = $this->input->post('phong', true);
            }else{
                $temp4['phong'] = "";
            }
            
            $temp5 = array();
            $temp5['id_don_vi_quan_ly'] = $this->input->post('don_vi_nhan', true);
            $temp5['id_khu_nha'] = $this->input->post('khu_nha', true);
            if (isset($_POST['phong'])){
                $temp5['phong'] = $this->input->post('phong', true);
            }else{
                $temp5['phong'] = "";
            }
            
            $ds = json_decode($_POST['thietbi'], true);
            foreach  ($ds as $item){
                $temp3['id_ten_thiet_bi'] = $item['ten'];
                $temp3['id_quoc_gia'] = $item['qg'];
                $temp3['so_luong'] = $item['sl'];
                $temp3['so_thang_bao_hanh'] = $item['stbh'];
                $temp3['don_gia'] = $item['dg'];
                
                $id_chi_tiet_nhap = $this->addChiTietNhap($temp3);
                
                $temp4['id_chi_tiet_nhap'] = $id_chi_tiet_nhap;
                $temp4['chi_phi_lap_dat'] = $item['cpld'];
                $temp4['chi_phi_van_chuyen'] = $item['cpvc'];
                $temp4['chi_phi_chay_thu'] = $item['cpct'];
                $temp4['so_luong'] = (int)$item['sl'];
                $temp4['don_gia'] = $item['dg'];
                $temp4['khau_hao'] = $item['kh'];
                
                $id_chi_thiet_xuat = $this->addChiTietXuat($temp4);
                $temp5['id_chi_tiet_xuat'] = $id_chi_thiet_xuat;
                $temp5['id_ten_thiet_bi'] = $item['ten'];
                
                for ($i = 0; $i < $temp4['so_luong']; $i++){
                    $this->addThietBiSuDung($temp5);
                }
            }
            echo "Nhập dữ liệu thành công!";
            /**
             * Lưu dữ liệu để back up
             * id_user = $this->session->user_data("user")
             */
            $id_user = 0;
            $this->addLog($id_nhap, $id_xuat, $id_user, date('Y-m-d'));
        }
    }
    
    public function addNhap($temp){
        $data = array();
        $data['id_nha_cung_cap'] = $temp['id_nha_cung_cap'];
        $data['so_hoa_don'] = $temp['so_hoa_don'];
        $data['trang_thai'] = null;
        $data['ngay_thuc_hien'] = date("Y-m-d");
        $data['ngay_duyet'] = null;
        $data['id_can_bo_thuc_hien'] = null;
        $data['id_can_bo_duyet'] = null;
        
        $result = $this->Mnhapthang->insertNhap($data);
        return $result;
    }
    
    public function addChiTietNhap($temp){
        $data = array();
        $data['id_nhap'] = $temp['id_nhap'];
        $data['id_ten_thiet_bi'] = $temp['id_ten_thiet_bi'];
        $data['id_quoc_gia'] = $temp['id_quoc_gia'];
        $data['don_gia'] = $temp['don_gia'];
        $data['so_luong'] = $temp['so_luong'];
        $data['so_luong_con'] = 0;
        $data['so_thang_bao_hanh'] = $temp['so_thang_bao_hanh'];
        $data['ngay_cap_nhat'] = date('Y-m-d');
        $data['trang_thai'] = null;
        
        $result = $this->Mnhapthang->insertChiTietNhap($data);
        return $result;
    }
    
    public function addXuat($temp){
        $data = array();
        $data['so_hoa_don'] = $temp['so_hoa_don'];
        $data['trang_thai'] = null;
        $data['ngay_thuc_hien'] = date('Y-m-d');
        $data['ngay_duyet'] = null;
        $data['id_can_bo_thuc_hien'] = null;
        $data['id_can_bo_duyet'] = null;
        
        $result = $this->Mnhapthang->insertXuat($data);
        return $result;
    }
    
    public function addChiTietXuat($temp){
        $data = array();
        $data['id_xuat'] = $temp['id_xuat'];
        $data['id_don_vi_nhan'] = $temp['id_don_vi_nhan'];
        $data['id_khu_nha'] = $temp['id_khu_nha'];
        $data['id_nguon_von'] = $temp['id_nguon_von'];
        $data['phong'] = $temp['phong'];
        $data['id_chi_tiet_nhap'] = $temp['id_chi_tiet_nhap'];
        $data['chi_phi_lap_dat'] = $temp['chi_phi_lap_dat'];
        $data['chi_phi_van_chuyen'] = $temp['chi_phi_van_chuyen'];
        $data['chi_phi_chay_thu'] = $temp['chi_phi_chay_thu'];
        $data['don_gia'] = $temp['don_gia'];
        $data['khau_hao'] = $temp['khau_hao'];
        $data['gia_tri_con'] = null;
        $data['tinh_trang'] = null;
        $data['so_luong'] = $temp['so_luong'];
        $data['ngay_thuc_hien'] = date('Y-m-d');
        $data['id_can_bo_thuc_hien'] = null;
        $data['cho_muon'] = $temp['cho_muon'];
        $data['trang_thai'] = null;
        
        $result = $this->Mnhapthang->insertChiTietXuat($data);
        return $result;
    }
    
    public function addThietBiSuDung($temp){
        $data = array();
        $data['id_chi_tiet_xuat'] = $temp['id_chi_tiet_xuat'];
        $data['id_don_vi_quan_ly'] = $temp['id_don_vi_quan_ly'];
        $data['id_ten_thiet_bi'] = $temp['id_ten_thiet_bi'];
        $data['ngay_su_dung'] = date('Y-m-d');
        $data['trang_thai'] = null;
        $data['id_khu_nha'] = $temp['id_khu_nha'];
        $data['phong'] = $temp['phong'];
        $data['tinh_trang'] = null;
        
        $result = $this->Mnhapthang->insertThietBiSuDung($data);
        return $result;
    }
    
    public function backup($id){
        $this->load->model('Mlog_nhapthang');
        $log = new Mlog_nhapthang();
        $log->backup($id);
        redirect('nhapthang/viewLog/');
    }
    
    public function viewLog(){
        $this->load->model('Mlog_nhapthang');
        $log = new Mlog_nhapthang();
        
        $list = $log->getAllItems();
        $data['title'] = 'back up dữ liệu nhập thẳng';
        $data['template'] = 'nhapthang/viewlog';
        $data['data']['list'] = $list;
        
        $this->load->view('thietbi/layout', $data);
    }
    
    protected function addLog($id_nhap, $id_xuat, $id_user, $ngay){
        $this->load->model('Mlog_nhapthang');
        $log = new Mlog_nhapthang();
        
        $data = array(
            'id_user' => $id_user,
            'id_nhap' => $id_nhap,
            'id_xuat' => $id_xuat,
            'ngay' => $ngay,
        );
        $result = $log->addItem($data);
        return $result;
    }
    
    public function deleteLog($id){
        $this->load->model('Mlog_nhapthang');
        $log = new Mlog_nhapthang();
        $log->deleteItem($id);
        redirect('nhapthang/viewLog/');
    }
    
    public function addTenThietBi(){
        if (!isset($_POST['new_ten'])){
            redirect('nhapthang/');
        }else{
            $ten = $this->input->post('ten_thiet_bi');
            $don_vi_tinh = $this->input->post('don_vi_tinh');
            $loai = $this->input->post('loai');
            $loai_moi = $this->input->post('loai_moi');
            
            $this->load->model('Mtentb');
            $this->load->model('Mloaitb');
            
            $data = array(
                "ten" => $ten,
                "don_vi_tinh" => $don_vi_tinh
            );
            
            if ($loai != ""){
                $loai = (int) $loai;
                $temp = $this->Mloaitb->getLoaitbById($loai);
                if (count($temp) >0){
                    $data['id_loai_thiet_bi'] = $loai;
                }
            }else if ($loai_moi != ""){
                $temp = $this->Mloaitb->getLoaiThietBiByTen($loai_moi);
                if (isset($temp['id'])){
                    $data['id_loai_thiet_bi'] = $temp['id'];
                }else{
                    $input['ten'] = preg_replace('/\s+/', ' ', trim($loai_moi));
                    $result = $this->Mloaitb->addLoaitb($input);
                    if (is_numeric($result)){
                        $data['id_loai_thiet_bi'] = $result;
                    }
                }
            }
            $id_ten_thiet_bi = $this->Mtentb->addTentb($data);
            $id_loai_thiet_bi = '';
            if (isset($data['id_loai_thiet_bi'])){
                $id_loai_thiet_bi = $data['id_loai_thiet_bi'];
            }
            echo '{"id_ten" : '.$id_ten_thiet_bi.', "id_loai" : '.$id_loai_thiet_bi.'}';
        }
    }
}