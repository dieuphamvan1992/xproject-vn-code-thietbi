<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');
class import extends Tb_controller{
     
    public function __construct() {
        parent::__construct();
        if (($this->role < 0) || ($this->role > 3))
        {
            redirect("/");
            exit;
        }
        $this->load->model('Mimport');
        $this->load->library('excel');
        $this->load->library('session');
    }
    
    public function index(){
               
        $data['title'] = 'import thiet bi';
        $data['template'] = 'import/index';
        $data['data'] = array();
        $this->load->view('thietbi/layout', $data);
    }
    
    public function importAction(){
               
        $allowInsertNhaCungCap = FALSE; 
        $allowInsertKhuNha = FALSE;
        $allowInsertNguonVon = FALSE;
        $allowInsertLoaiThietBi = FALSE;
        $allowInsertTenThietBi = FALSE;
        $allowInsertQuocGia = FaLSE;
        $data['title'] = 'ket qua import thiet bi';
        $data['template'] = 'import/import_result';
        $data['data'] = array();
        $result = array();
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
            $result = $this->doImport($target, $allowInsertNhaCungCap, $allowInsertKhuNha, $allowInsertNguonVon, $allowInsertLoaiThietBi, $allowInsertTenThietBi, $allowInsertQuocGia);
            //unlink($target);
//            $data['data']['array_import_fail'] = $result['array_import_fail'];
//            $data['total'] = $result['total'];
            $data['data']['array_import_fail'] = $result;
            $this->session->set_userdata('result',$result);
        }
        
        if($this->input->post('submit') == 'Xuất')
        {
            $import = $this->session->userdata('result');
            $objPHPExcel = new Excel();
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getProperties()->setCreator("tiêu đề cho file xuất")->setLastModifiedBy("Maarten Balliauw")->setTitle("Office 2007 XLSX Test Document")->setSubject("Office 2007 XLSX Test Document")->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")->setKeywords("office 2007 openxml php")->setCategory("Test result file");
                
                $header = array(
                    "1" => "STT",
                    "2" => "Dòng",
                    "3" => "Số hóa đơn",
                    "4" => "Nhà cung cấp",
                    "5" => "Đơn vị nhận",
                    "6" => "Khu nhà",
                    "7" => "Nguồn vốn",
                    "8" => "Cho mượn",
                    "9" => "Tên thiết bị",
                    "10" => "Loại thiết bị",
                    "11" => "Quốc gia",
                    "12" => "Số lượng",
                    "13" => "Bảo hành",
                    "14" => "Chi phí lắp đặt",
                    "15" => "Chi phí vận chuyển",
                    "16" => "Chi phí chạy thử",
                    "17" => "Số năm khấu hao",
                    "18" => "Đơn giá",
                    "19" => "Phòng",
                    "20" => "Lỗi",
                );
                
		$rowCount = 1;  

		//bắt đầu in tên cột như tên các trường 

		 $column = 'A';

		foreach($header as $key=>$value)

		{
			$objPHPExcel->getActiveSheet()->getColumnDimension( $column )->setWidth( 20 );
		    $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $value);
		    $column++;
		}

		//kết thúc in tên cột

		//vòng lặp lấy dữ liệu
		$rowCount = 2;  
                
                $count = count($import);

		if($count)

		{  

		   for($i=0; $i<$count; $i++)
		    {  
                        $objPHPExcel->getActiveSheet()->setCellValue("A".$rowCount, $i);
                        $objPHPExcel->getActiveSheet()->setCellValue("B".$rowCount, $import[$i]['id']);
                        $objPHPExcel->getActiveSheet()->setCellValue("C".$rowCount, $import[$i]['data']['so_hoa_don']);
                        $objPHPExcel->getActiveSheet()->setCellValue("D".$rowCount, $import[$i]['data']['nha_cung_cap']);
                        $objPHPExcel->getActiveSheet()->setCellValue("E".$rowCount, $import[$i]['data']['don_vi_nhan']);
                        $objPHPExcel->getActiveSheet()->setCellValue("F".$rowCount, $import[$i]['data']['khu_nha']);
                        $objPHPExcel->getActiveSheet()->setCellValue("G".$rowCount, $import[$i]['data']['nguon_von']);
                        $objPHPExcel->getActiveSheet()->setCellValue("H".$rowCount, $import[$i]['data']['cho_muon']);
                        $objPHPExcel->getActiveSheet()->setCellValue("I".$rowCount, $import[$i]['data']['ten_thiet_bi']);
                        $objPHPExcel->getActiveSheet()->setCellValue("J".$rowCount, $import[$i]['data']['loai_thiet_bi']);
                        $objPHPExcel->getActiveSheet()->setCellValue("K".$rowCount, $import[$i]['data']['quoc_gia']);
                        $objPHPExcel->getActiveSheet()->setCellValue("L".$rowCount, $import[$i]['data']['so_luong']);
                        $objPHPExcel->getActiveSheet()->setCellValue("M".$rowCount, $import[$i]['data']['so_thang_bao_hanh']);
                        $objPHPExcel->getActiveSheet()->setCellValue("N".$rowCount, $import[$i]['data']['chi_phi_lap_dat']);
                        $objPHPExcel->getActiveSheet()->setCellValue("O".$rowCount, $import[$i]['data']['chi_phi_van_chuyen']);
                        $objPHPExcel->getActiveSheet()->setCellValue("P".$rowCount, $import[$i]['data']['chi_phi_chay_thu']);
                        $objPHPExcel->getActiveSheet()->setCellValue("Q".$rowCount, $import[$i]['data']['so_nam_khau_hao']);
                        $objPHPExcel->getActiveSheet()->setCellValue("R".$rowCount, $import[$i]['data']['don_gia']);
                        $objPHPExcel->getActiveSheet()->setCellValue("S".$rowCount, $import[$i]['data']['phong']);
                        $objPHPExcel->getActiveSheet()->setCellValue("T".$rowCount, $import[$i]['fail']);
                        $rowCount++;   
		    }  		    
		} 

        $objPHPExcel->createSheet();
        header('Content-Type: application/vnd.ms-excel');
		        header('Content-Disposition: attachment;filename="ban ghi chua import_' . '_' . '.xls"');
		        header('Cache-Control: max-age=0');
		        
		        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		        $objWriter->save('php://output');
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
            
            //Can bo thuc hien
            $idCanBoThucHien = $this->session->userdata('idcanbo');
            $tenCanBoThucHien = $this->session->userdata('username');
            $line['so_hoa_don'] = $dataExcel->val($i, 1);
            $line['nha_cung_cap'] = $dataExcel->val($i, 2);
            $line['don_vi_nhan'] = $dataExcel->val($i, 3);
            $line['khu_nha'] = $dataExcel->val($i, 4);
            $line['nguon_von'] = $dataExcel->val($i, 5);
            $line['cho_muon'] = $dataExcel->val($i, 6);
            $line['ten_thiet_bi'] = $dataExcel->val($i, 7);
            $line['loai_thiet_bi'] = $dataExcel->val($i, 8);
            $line['quoc_gia'] = $dataExcel->val($i, 9);
            $line['so_luong'] = $dataExcel->val($i, 10);
            $line['so_thang_bao_hanh'] = $dataExcel->val($i, 11);
            $line['chi_phi_lap_dat'] = $dataExcel->val($i, 12);
            $line['chi_phi_van_chuyen'] = $dataExcel->val($i, 13);
            $line['chi_phi_chay_thu'] = $dataExcel->val($i, 14);
            $line['so_nam_khau_hao'] = $dataExcel->val($i, 15);
            $line['don_gia'] = $dataExcel->val($i, 16);
            $line['phong'] = $dataExcel->val($i, 17); 
            
            // <editor-fold defaultstate="collapsed" desc="Nha cung cap">
            $idNhaCungCap = $this->Mimport->getIdNhaCungCap($line['nha_cung_cap']);
            if(!$idNhaCungCap && $allowInsertNhaCungCap) {
                $idNhaCungCap = $this->Mimport->insertTenNhaCungCap($line['nha_cung_cap']);
                if($idNhaCungCap) {
                    $idNhaCungCapString .= $idNhaCungCap.",";
                }
            }
            if(!$idNhaCungCap) {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Nha cung cap";
                $arrayImportFail[$arrayIndex]["data"] = $line;
                continue;
            }
            // </editor-fold>
            
            // <editor-fold defaultstate="collapsed" desc="Don vi nhan">
            $idDonViNhan = $this->Mimport->getIdDonVi($line['don_vi_nhan']);
            if($idDonViNhan == -1) {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Don vi nhan";
                $arrayImportFail[$arrayIndex]["data"] = $line;
                continue;
            }
            // </editor-fold>
            
            // <editor-fold defaultstate="collapsed" desc="Khu Nha">
            $idKhuNha = $this->Mimport->getIdKhuNha($line['khu_nha']);
            if(!$idKhuNha && $allowInsertKhuNha) {
                $idKhuNha = $this->Mimport->insertTenKhuNha($line['khu_nha']);
                if($idKhuNha) {
                    $idKhuNhaString .= $idKhuNha.",";
                }
            }
            if(!$idKhuNha) {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Khu nha";
                $arrayImportFail[$arrayIndex]["data"] = $line;
                continue;
            }
            // </editor-fold>
            
            // <editor-fold defaultstate="collapsed" desc="Nguon von">
            $idNguonVon = $this->Mimport->getIdNguonVon($line['nguon_von']);
            if(!$idNguonVon && $allowInsertNguonVon) {
                $idNguonVon = $this->Mimport->insertTenNguonVon($line['nguon_von']);
                if($idNguonVon) {
                    $idNguonVonString .= $idNguonVon.",";
                }
            }
            if(!$idNguonVon) {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Nguon von";
                $arrayImportFail[$arrayIndex]["data"] = $line;
                continue;
            }
            // </editor-fold>
            
            // <editor-fold defaultstate="collapsed" desc="Loai thiet bi">
            $idLoaiThietBi = $this->Mimport->getIdLoaiThietBi($line['loai_thiet_bi']);
            if(!$idLoaiThietBi && $allowInsertLoaiThietBi) {
                $idLoaiThietBi = $this->Mimport->insertTenLoaiThietBi($line['loai_thiet_bi']);
                if($idLoaiThietBi) {
                    $idLoaiThietBiString .= $idLoaiThietBi.",";
                }
            }
            if(!$idLoaiThietBi) {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Loai thiet bi";
                $arrayImportFail[$arrayIndex]["data"] = $line;
                continue;
            }
            // </editor-fold>
            
            // <editor-fold defaultstate="collapsed" desc="Ten thiet bi">
            $idTenThietBi = $this->Mimport->getIdTenThietBi($line['ten_thiet_bi'], $idLoaiThietBi);
            if(!$idTenThietBi && $allowInsertTenThietBi) {
                $idTenThietBi = $this->Mimport->insertTenThietBi($line['ten_thiet_bi'], $idLoaiThietBi);
                if($idTenThietBi) {
                    $idTenThietBiString .= $idTenThietBi.",";
                }
            }
            if(!$idTenThietBi) {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Ten thiet bi";
                $arrayImportFail[$arrayIndex]["data"] = $line;
                continue;
            }
            // </editor-fold>
            
            // <editor-fold defaultstate="collapsed" desc="Quoc gia">
            $idQuocGia = $this->Mimport->getIdQuocGia($line['quoc_gia']);
            if(!$idQuocGia && $allowInsertQuocGia) {
                $idQuocGia = $this->Mimport->insertTenQuocGia($line['quoc_gia']);
                if($idQuocGia) {
                    $idQuocGiaString .= $idQuocGia.",";
                }
            }
            if(!$idQuocGia) {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Quoc gia";
                $arrayImportFail[$arrayIndex]["data"] = $line;
                continue;
            }
            // </editor-fold>
            
            $nhapObj = array();
            $nhapObj['id_nha_cung_cap'] = $idNhaCungCap;
            $nhapObj['so_hoa_don'] = $line['so_hoa_don'];
            $nhapObj['id_can_bo_thuc_hien'] = $idCanBoThucHien;
            $idNhap = $this->doImportToNhap($nhapObj);
            
            if($idNhap) {
                $idNhapString .= $idNhap.",";
                $chiTietNhapObj = array();
                $chiTietNhapObj['so_hoa_don'] = $line['so_hoa_don'];
                $chiTietNhapObj['id_nhap'] = $idNhap;
                $chiTietNhapObj['id_ten_thiet_bi'] = $idTenThietBi;
                $chiTietNhapObj['id_quoc_gia'] = $idQuocGia;
                $chiTietNhapObj['so_luong'] = $line['so_luong'];
                $chiTietNhapObj['so_thang_bao_hanh'] = $line['so_thang_bao_hanh'];
                $chiTietNhapObj['don_gia'] = $line['don_gia'];
                $idChiTietNhap = $this->doImportToChiTietNhap($chiTietNhapObj);
            } else {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Hoa don Nhap";
                $arrayImportFail[$arrayIndex]["data"] = $line;
                continue;
            }
            
            if($idChiTietNhap) {
                $idChiTietNhapString .= $idChiTietNhap.",";
                $xuatObj = array();
                $xuatObj['so_hoa_don'] = $line['so_hoa_don'];
                $xuatObj['id_don_vi_nhan'] = $idDonViNhan;
                $xuatObj['id_khu_nha'] = $idKhuNha; 
                $xuatObj['phong'] = $line['phong'];
                $xuatObj['id_nguon_von'] = $idNguonVon; 
                $xuatObj['id_can_bo_thuc_hien'] = $idCanBoThucHien; 
                $idXuat = $this->doImportToXuat($xuatObj);
            } else {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Hoa don Chi tiet nhap";
                $arrayImportFail[$arrayIndex]["data"] = $line;
                continue;
            }
            
            if($idXuat) {
                $idXuatString .= $idXuat.",";
                $chiTietXuatObj = array();
                $chiTietXuatObj['id_xuat'] = $idXuat;
                $chiTietXuatObj['id_chi_tiet_nhap'] = $idChiTietNhap;         
                $chiTietXuatObj['cho_muon'] = $line['cho_muon'];
                $chiTietXuatObj['chi_phi_lap_dat'] = $line['chi_phi_lap_dat'];
                $chiTietXuatObj['chi_phi_van_chuyen'] = $line['chi_phi_van_chuyen'];
                $chiTietXuatObj['chi_phi_chay_thu'] = $line['chi_phi_chay_thu'];
                $chiTietXuatObj['so_luong'] = $line['so_luong'];
                $chiTietXuatObj['don_gia'] = $line['don_gia'];
                $chiTietXuatObj['khau_hao'] = $line['so_nam_khau_hao'];
                $idChiTietXuat = $this->doImportToChiTietXuat($chiTietXuatObj);
            } else {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Hoa don Xuat";
                $arrayImportFail[$arrayIndex]["data"] = $line;
                continue;
            }
            
            if($idChiTietXuat) {
                $idChiTietXuatString .= $idChiTietXuat.",";
                $resultTBSuDung = TRUE;
                $thietBiSuDungObj = array();
                $thietBiSuDungObj['id_don_vi_quan_ly'] = $idDonViNhan;
                $thietBiSuDungObj['id_khu_nha'] = $idKhuNha;
                $thietBiSuDungObj['phong'] = $line['phong'];
                $thietBiSuDungObj['id_chi_tiet_xuat'] = $idChiTietXuat;
                $thietBiSuDungObj['id_ten_thiet_bi'] = $idTenThietBi;
                for ($j=0; $j<$line['so_luong']; $j++) {
                    $idThietBiSuDung = 0;
                    $idThietBiSuDung = $this->doImportToThietBiSuDung($thietBiSuDungObj);
                    if(!$idThietBiSuDung) $resultTBSuDung = FALSE;
                }
            } else {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Hoa don Chi tiet xuat";
                $arrayImportFail[$arrayIndex]["data"] = $line;
                continue;
            }
            if(!$resultTBSuDung) {
                $arrayIndex++;
                $arrayImportFail[$arrayIndex]["id"] = $i; 
                $arrayImportFail[$arrayIndex]["fail"] = "Dua vao Thiet bi su dung";
                $arrayImportFail[$arrayIndex]["data"] = $line;
                continue;
            }                         
        }
        $this->doInsertToLogImport($idNhapString, $idChiTietNhapString, $idXuatString, $idChiTietXuatString, $idNhaCungCapString, $idKhuNhaString, $idNguonVonString, $idLoaiThietBiString, $idTenThietBiString, $idQuocGiaString,$rowsnum-2, $arrayIndex + 1, $fileName, $idCanBoThucHien, $tenCanBoThucHien); 
//        $result['total'] = $rowsnum -2;
//        $result['array_import_fail'] = $arrayImportFail;
//        return $result;
        return $arrayImportFail;;
    }
    
    public function doImportToNhap($nhapObj) {
        $data = array();
        $data['id_nha_cung_cap'] = $nhapObj['id_nha_cung_cap'];
        $data['so_hoa_don'] = $nhapObj['so_hoa_don'];
        $data['trang_thai'] = null;
        $data['ngay_thuc_hien'] = date("Y-m-d");
        $data['ngay_duyet'] = null;
        $data['id_can_bo_thuc_hien'] = $nhapObj['id_can_bo_thuc_hien'];
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
        $data['id_don_vi_nhan'] = $xuatObj['id_don_vi_nhan'];
        $data['id_khu_nha'] = $xuatObj['id_khu_nha'];
        $data['phong'] = $xuatObj['phong'];
        $data['id_nguon_von'] = $xuatObj['id_nguon_von'];
        $data['trang_thai'] = null;
        $data['ngay_thuc_hien'] = date('Y-m-d');
        $data['ngay_duyet'] = null;
        $data['id_can_bo_thuc_hien'] = $xuatObj['id_can_bo_thuc_hien'];
        $data['id_can_bo_duyet'] = null;
        
        $result = $this->Mimport->insertXuat($data);
        return $result;
    }
    
    public function doImportToChiTietXuat($chiTietXuatObj) {
        $data = array();
        $data['id_xuat'] = $chiTietXuatObj['id_xuat'];
        $data['id_chi_tiet_nhap'] = $chiTietXuatObj['id_chi_tiet_nhap'];
        $data['chi_phi_lap_dat'] = $chiTietXuatObj['chi_phi_lap_dat'];
        $data['chi_phi_van_chuyen'] = $chiTietXuatObj['chi_phi_van_chuyen'];
        $data['chi_phi_chay_thu'] = $chiTietXuatObj['chi_phi_chay_thu'];
        $data['don_gia'] = $chiTietXuatObj['don_gia'];
        $data['khau_hao'] = $chiTietXuatObj['khau_hao'];
        $data['gia_tri_con'] = null;
        $data['tinh_trang'] = null;
        $data['so_luong'] = $chiTietXuatObj['so_luong'];
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
    public function doInsertToLogImport($idNhapString, $idChiTietNhapString, $idXuatString, $idChiTietXuatString, $idNhaCungCapString, $idKhuNhaString, $idNguonVonString, $idLoaiThietBiString, $idTenThietBiString, $idQuocGiaString, $total, $failTotal, $fileName, $idCanBoThucHien, $tenCanBoThucHien) {
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
        $data['user_id'] = $idCanBoThucHien;
        $data['username'] = $tenCanBoThucHien;
        
        $result = $this->Mimport->insertLogImport($data);
        return $result;
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="ViewLog">
    public function viewLogImport() {
       // $this->load->model('Mlog_nhapthang');
        $list = $this->Mimport->getAllLog();
        
       // $list = $log->getAllItems();
        $data['title'] = 'back up dữ liệu nhập thẳng';
        $data['template'] = 'import/viewlog';
        $data['data']['list'] = $list;
        
        $this->load->view('thietbi/layout', $data);
    }
    // </editor-fold>
}

?>
