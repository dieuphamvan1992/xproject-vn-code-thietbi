<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');
class import extends Tb_controller{
     
    public function __construct() {
        parent::__construct();
        $this->load->model('Mimport');
    }
    
    public function index(){
               
        $allowInsertNhaCungCap = FALSE; 
        $allowInsertKhuNha = FALSE;
        $allowInsertNguonVon = FALSE;
        $allowInsertLoaiThietBi = FALSE;
        $allowInsertTenThietBi = FALSE;
        $allowInsertQuocGia = FaLSE;
        $data['title'] = 'import thiet bi';
        $data['template'] = 'import/index';
        $data['data'] = array();
        $arrayImportFail = array();
        if(isset($_POST['btnsubmit'])) {
            $target = "file/";
            if(is_dir($target) == FALSE) {
                mkdir($target);
            }
            $time = date("Y_m_d_H_i_s");
            $target = $target.$time.$_FILES['myfile']['name'];
            if(is_file($target) == TRUE) {
                //echo "file da ton tai";
                
            } else {
                if(move_uploaded_file($_FILES['myfile']['tmp_name'], $target) == TRUE) {
                    //echo $target;
                }
            }
            
            $allowInsertNhaCungCap = $this->input->post('checkNhaCungCap', true);
            $allowInsertKhuNha = $this->input->post('checkKhuNha', true);
            $allowInsertNguonVon = $this->input->post('checkNguonVon', true);
            $allowInsertLoaiThietBi = $this->input->post('checkLoaiThietBi', true);
            $allowInsertTenThietBi = $this->input->post('checkTenThietBi', true);
            $allowInsertQuocGia = $this->input->post('checkQuocGia', true);
            $arrayImportFail = $this->doImport($target, $allowInsertNhaCungCap, $allowInsertKhuNha, $allowInsertNguonVon, $allowInsertLoaiThietBi, $allowInsertTenThietBi, $allowInsertQuocGia);
            //unlink($target);
            $data['data']['arrayImportFail'] = $arrayImportFail;
        }
        $this->load->view('thietbi/layout', $data);
    }
    
    public function doImport($fileName, $allowInsertNhaCungCap, $allowInsertKhuNha, $allowInsertNguonVon, $allowInsertLoaiThietBi, $allowInsertTenThietBi, $allowInsertQuocGia) {
        require_once 'import/excel_reader.php';
        $dataExcel = new Spreadsheet_Excel_Reader($fileName, TRUE, "UTF-8");
        $rowsnum = $dataExcel->rowcount($sheet_index=0) + 1; // Số hàng của sheet
        //$colsnum =  $dataExcel->colcount($sheet_index=0);  //Số cột của sheet
        $arrayImportFail = array();
        $arrayIndex = -1;
        
        //<editor-fold defaultstate="collapsed" desc="Ghi Log">
        $idNhaCungCapString = "";
        $idKhuNhaString ="";
        $idNguonVonString = "";
        $idLoaiThietBiString = "";
        $idTenThietBiString = "";
        $idQuocGiaString = "";
        $idNhapString = "";
        $idChiTietNhapString = "";
        $idXuatString = "";
        $idChiTietXuatString = "";
        // </editor-fold>
        for($i = 2; $i<$rowsnum; $i++) {
            $idNhap = 0;
            $idChiTietNhap = 0;
            $idXuat = 0;
            $idChiTietXuat = 0;
            $result = 1;
            $soHoaDon = $dataExcel->val($i, 1);
            $nhaCungCap = $dataExcel->val($i, 2);
            $donViNhan = $dataExcel->val($i, 3);
            $khuNha = $dataExcel->val($i, 4);
            $nguonVon = $dataExcel->val($i, 5);
            $choMuon = $dataExcel->val($i, 6);
            $tenThietBi = $dataExcel->val($i, 7);
            $loaiThieBi = $dataExcel->val($i, 8);
            $quocGia = $dataExcel->val($i, 9);
            $soLuong = $dataExcel->val($i, 10);
            $soThangBaoHanh = $dataExcel->val($i, 11);
            $chiPhiLapDat = $dataExcel->val($i, 12);
            $chiPhiVanChuyen = $dataExcel->val($i, 13);
            $chiPhiChayThu = $dataExcel->val($i, 14);
            $soNamKhauHao = $dataExcel->val($i, 15);
            $donGia = $dataExcel->val($i, 16);
            $phong = $dataExcel->val($i, 17);
            
            // <editor-fold defaultstate="collapsed" desc="Nha cung cap">
            $idNhaCungCap = $this->Mimport->getIdNhaCungCap($nhaCungCap);
            if(!$idNhaCungCap && $allowInsertNhaCungCap) {
                $idNhaCungCap = $this->Mimport->insertTenNhaCungCap($nhaCungCap);
                if($idNhaCungCap) {
                    $idNhaCungCapString .= $idNhaCungCap.",";
                }
            }
            if(!$idNhaCungCap) {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Nha cung cap Fail";
                continue;
            }
            // </editor-fold>
            
            // <editor-fold defaultstate="collapsed" desc="Don vi nhan">
            $idDonViNhan = $this->Mimport->getIdDonVi($donViNhan);
            if(!$idDonViNhan) {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Don vi nhan Fail";
                continue;
            }
            // </editor-fold>
            
            // <editor-fold defaultstate="collapsed" desc="Khu Nha">
            $idKhuNha = $this->Mimport->getIdKhuNha($khuNha);
            if(!$idKhuNha && $allowInsertKhuNha) {
                $idKhuNha = $this->Mimport->insertTenKhuNha($khuNha);
                if($idKhuNha) {
                    $idKhuNhaString .= $idKhuNha.",";
                }
            }
            if(!$idKhuNha) {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Khu nha Fail";
                continue;
            }
            // </editor-fold>
            
            // <editor-fold defaultstate="collapsed" desc="Nguon von">
            $idNguonVon = $this->Mimport->getIdNguonVon($nguonVon);
            if(!$idNguonVon && $allowInsertNguonVon) {
                $idNguonVon = $this->Mimport->insertTenNguonVon($nguonVon);
                if($idNguonVon) {
                    $idNguonVonString .= $idNguonVon.",";
                }
            }
            if(!$idNguonVon) {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Nguon von Fail";
                continue;
            }
            // </editor-fold>
            
            // <editor-fold defaultstate="collapsed" desc="Loai thiet bi">
            $idLoaiThietBi = $this->Mimport->getIdLoaiThietBi($loaiThieBi);
            if(!$idLoaiThietBi && $allowInsertLoaiThietBi) {
                $idLoaiThietBi = $this->Mimport->insertTenLoaiThietBi($loaiThieBi);
                if($idLoaiThietBi) {
                    $idLoaiThietBiString .= $idLoaiThietBi.",";
                }
            }
            if(!$idLoaiThietBi) {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Loai thiet bi Fail";
                continue;
            }
            // </editor-fold>
            
            // <editor-fold defaultstate="collapsed" desc="Ten thiet bi">
            $idTenThietBi = $this->Mimport->getIdTenThietBi($tenThietBi, $idLoaiThietBi);
            if(!$idTenThietBi && $allowInsertTenThietBi) {
                $idTenThietBi = $this->Mimport->insertTenThietBi($tenThietBi, $idLoaiThietBi);
                if($idTenThietBi) {
                    $idTenThietBiString .= $idTenThietBi.",";
                }
            }
            if(!$idTenThietBi) {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Ten thiet bi Fail ".$tenThietBi. " ".$idLoaiThietBi;
                continue;
            }
            // </editor-fold>
            
            // <editor-fold defaultstate="collapsed" desc="Quoc gia">
            $idQuocGia = $this->Mimport->getIdQuocGia($quocGia);
            if(!$idQuocGia && $allowInsertQuocGia) {
                $idQuocGia = $this->Mimport->insertTenQuocGia($quocGia);
                if($idQuocGia) {
                    $idQuocGiaString .= $idQuocGia.",";
                }
            }
            if(!$idQuocGia) {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Quoc gia Fail";
                continue;
            }
            // </editor-fold>
            
            $nhapObj = array();
            $nhapObj['id_nha_cung_cap'] = $idNhaCungCap;
            $nhapObj['so_hoa_don'] = $soHoaDon;
            $idNhap = $this->doImportToNhap($nhapObj);
            
            if($idNhap) {
                $idNhapString .= $idNhap.",";
                $chiTietNhapObj = array();
                $chiTietNhapObj['so_hoa_don'] = $soHoaDon;
                $chiTietNhapObj['id_nhap'] = $idNhap;
                $chiTietNhapObj['id_ten_thiet_bi'] = $idTenThietBi;
                $chiTietNhapObj['id_quoc_gia'] = $idQuocGia;
                $chiTietNhapObj['so_luong'] = $soLuong;
                $chiTietNhapObj['so_thang_bao_hanh'] = $soThangBaoHanh;
                $chiTietNhapObj['don_gia'] = $donGia;
                $idChiTietNhap = $this->doImportToChiTietNhap($chiTietNhapObj);
            } else {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Hoa don Nhap Fail";
                continue;
            }
            
            if($idChiTietNhap) {
                $idChiTietNhapString .= $idChiTietNhap.",";
                $xuatObj = array();
                $xuatObj['so_hoa_don'] = $soHoaDon;
                $idXuat = $this->doImportToXuat($xuatObj);
            } else {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Hoa don Chi tiet nhap Fail";
                continue;
            }
            
            if($idXuat) {
                $idXuatString .= $idXuat.",";
                $chiTietXuatObj = array();
                $chiTietXuatObj['id_xuat'] = $idXuat;
                $chiTietXuatObj['id_chi_tiet_nhap'] = $idChiTietNhap;
                $chiTietXuatObj['id_don_vi_nhan'] = $idDonViNhan;
                $chiTietXuatObj['id_khu_nha'] = $idKhuNha;         
                $chiTietXuatObj['phong'] = $phong;
                $chiTietXuatObj['cho_muon'] = $choMuon;
                $chiTietXuatObj['id_nguon_von'] = $idNguonVon;  
                $chiTietXuatObj['chi_phi_lap_dat'] = $chiPhiLapDat;
                $chiTietXuatObj['chi_phi_van_chuyen'] = $chiPhiVanChuyen;
                $chiTietXuatObj['chi_phi_chay_thu'] = $chiPhiChayThu;
                $chiTietXuatObj['so_luong'] = $soLuong;
                $chiTietXuatObj['don_gia'] = $donGia;
                $chiTietXuatObj['khau_hao'] = $soNamKhauHao;
                $idChiTietXuat = $this->doImportToChiTietXuat($chiTietXuatObj);
            } else {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Hoa don Xuat Fail";
                continue;
            }
            
            if($idChiTietXuat) {
                $idChiTietXuatString .= $idChiTietXuat.",";
                $resultTBSuDung = TRUE;
                $thietBiSuDungObj = array();
                $thietBiSuDungObj['id_don_vi_quan_ly'] = $idDonViNhan;
                $thietBiSuDungObj['id_khu_nha'] = $idKhuNha;
                $thietBiSuDungObj['phong'] = $phong;
                $thietBiSuDungObj['id_chi_tiet_xuat'] = $idChiTietXuat;
                $thietBiSuDungObj['id_ten_thiet_bi'] = $idTenThietBi;
                for ($j=0; $j<$soLuong; $j++) {
                    $idThietBiSuDung = 0;
                    $idThietBiSuDung = $this->doImportToThietBiSuDung($thietBiSuDungObj);
                    if(!$idThietBiSuDung) $resultTBSuDung = FALSE;
                }
            } else {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Hoa don Chi tiet xuat Fail";
                continue;
            }
            if(!$resultTBSuDung) {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Dua vao Thiet bi su dung Fail";
                continue;
            }                         
        }
        $this->doInsertToLogImport($idNhapString, $idChiTietNhapString, $idXuatString, $idChiTietXuatString, $idNhaCungCapString, $idKhuNhaString, $idNguonVonString, $idLoaiThietBiString, $idTenThietBiString, $idQuocGiaString,$rowsnum-2, $arrayIndex, $fileName); 
        return $arrayImportFail;
    }
    
    public function doImportToNhap($nhapObj) {
        $data = array();
        $data['id_nha_cung_cap'] = $nhapObj['id_nha_cung_cap'];
        $data['so_hoa_don'] = $nhapObj['so_hoa_don'];
        $data['trang_thai'] = null;
        $data['ngay_thuc_hien'] = date("Y-m-d");
        $data['ngay_duyet'] = null;
        $data['id_can_bo_thuc_hien'] = null;
        $data['id_can_bo_duyet'] = null;
        
        $result = $this->Mimport->insertNhap($data);
        return $result;
    }
    
    public function doImportToChiTietNhap($chiTietNhapObj) {
        $data = array();
        $data['id_nhap'] = $chiTietNhapObj['id_nhap'];
        $data['id_ten_thiet_bi'] = $chiTietNhapObj['id_ten_thiet_bi'];
        $data['id_quoc_gia'] = $chiTietNhapObj['id_quoc_gia'];
        $data['don_gia'] = $chiTietNhapObj['don_gia'];
        $data['so_luong'] = $chiTietNhapObj['so_luong'];
        $data['so_luong_con'] = 0;
        $data['so_thang_bao_hanh'] = $chiTietNhapObj['so_thang_bao_hanh'];
        $data['ngay_cap_nhat'] = date('Y-m-d');
        $data['trang_thai'] = null;
        
        $result = $this->Mimport->insertChiTietNhap($data);
        return $result;
    }
        
    public function doImportToXuat($xuatObj) {
        $data = array();
        $data['so_hoa_don'] = $xuatObj['so_hoa_don'];
        $data['trang_thai'] = null;
        $data['ngay_thuc_hien'] = date('Y-m-d');
        $data['ngay_duyet'] = null;
        $data['id_can_bo_thuc_hien'] = null;
        $data['id_can_bo_duyet'] = null;
        
        $result = $this->Mimport->insertXuat($data);
        return $result;
    }
    
    public function doImportToChiTietXuat($chiTietXuatObj) {
        $data = array();
        $data['id_xuat'] = $chiTietXuatObj['id_xuat'];
        $data['id_don_vi_nhan'] = $chiTietXuatObj['id_don_vi_nhan'];
        $data['id_khu_nha'] = $chiTietXuatObj['id_khu_nha'];
        $data['id_nguon_von'] = $chiTietXuatObj['id_nguon_von'];
        $data['phong'] = $chiTietXuatObj['phong'];
        $data['id_chi_tiet_nhap'] = $chiTietXuatObj['id_chi_tiet_nhap'];
        $data['chi_phi_lap_dat'] = $chiTietXuatObj['chi_phi_lap_dat'];
        $data['chi_phi_van_chuyen'] = $chiTietXuatObj['chi_phi_van_chuyen'];
        $data['chi_phi_chay_thu'] = $chiTietXuatObj['chi_phi_chay_thu'];
        $data['don_gia'] = $chiTietXuatObj['don_gia'];
        $data['khau_hao'] = $chiTietXuatObj['khau_hao'];
        $data['gia_tri_con'] = null;
        $data['tinh_trang'] = null;
        $data['so_luong'] = $chiTietXuatObj['so_luong'];
        $data['ngay_thuc_hien'] = date('Y-m-d');
        $data['id_can_bo_thuc_hien'] = null;
        $data['cho_muon'] = $chiTietXuatObj['cho_muon'];
        $data['trang_thai'] = null;
        
        $result = $this->Mimport->insertChiTietXuat($data);
        return $result;
    }
    
    public function doImportToThietBiSuDung($thietBiSuDungObj) {
        $data = array();
        $data['id_chi_tiet_xuat'] = $thietBiSuDungObj['id_chi_tiet_xuat'];
        $data['id_don_vi_quan_ly'] = $thietBiSuDungObj['id_don_vi_quan_ly'];
        $data['id_ten_thiet_bi'] = $thietBiSuDungObj['id_ten_thiet_bi'];
        $data['ngay_su_dung'] = date('Y-m-d');
        $data['trang_thai'] = null;
        $data['id_khu_nha'] = $thietBiSuDungObj['id_khu_nha'];
        $data['phong'] = $thietBiSuDungObj['phong'];
        $data['tinh_trang'] = null;
        
        $result = $this->Mimport->insertThietBiSuDung($data);
        return $result;
    }
    
    // <editor-fold defaultstate="collapsed" desc="Log">
    public function doInsertToLogImport($idNhapString, $idChiTietNhapString, $idXuatString, $idChiTietXuatString, $idNhaCungCapString, $idKhuNhaString, $idNguonVonString, $idLoaiThietBiString, $idTenThietBiString, $idQuocGiaString, $total, $failTotal, $fileName) {
        $data = array();
        $data['id_nhap'] = $idNhapString;
        $data['id_chi_tiet_nhap'] = $idChiTietNhapString;
        $data['id_xuat'] = $idXuatString;
        $data['id_chi_tiet_xuat'] = $idChiTietXuatString;
        $data['id_nha_cung_cap'] = $idNhaCungCapString;
        $data['id_khu_nha'] = $idKhuNhaString;
        $data['id_nguon_von'] = $idNguonVonString;
        $data['id_loai_thiet_bi'] = $idLoaiThietBiString;
        $data['id_ten_thiet_bi'] = $idTenThietBiString;
        $data['id_quoc_gia'] = $idQuocGiaString;
        $data['thoi_gian'] = date("Y-m-d H:i:s");
        $data['total'] = $total;
        $data['total_fail'] = $failTotal;
        $data['tinh_trang'] = 1;
        $data['file'] = $fileName;
        
        $result = $this->Mimport->insertLogImport($data);
        return $result;
    }
    // </editor-fold>
}

?>
