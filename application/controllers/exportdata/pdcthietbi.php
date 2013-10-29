<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/tb_controller.php');

Class Pdcthietbi extends Tb_controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->library('excel');
    }
    
    public function index(){
        $objPHPExcel = new Excel();
        
        $objPHPExcel->getProperties()->setCreator("Trường Kobe");
		$objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
		$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
        
        $objPHPExcel->setActiveSheetIndex();

/**
 * Bat dau dinh dang kieu chu
 */
        
        $title1_style = array(
            'font' => array(
				'name' => 'Times New Roman',
				'size' => 13
				),

			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				)
        );
        
        $title2_style = array(
            'font' => array(
				'name' => 'Times New Roman',
				'bold' => true,
				'size' => 13
				),

			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				)
        );
        
        $title3_style = array(
            'font' => array(
				'name' => 'Times New Roman',
				'bold' => 'true',
                'underline' => true,
				'size' => 13
				),

			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				)
        );
        
        $title4_style = array(
            'font' => array(
				'name' => 'Times New Roman',
				'bold' => true,
				'size' => 17
				),

			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				)
        );
        
        $title5_style = array(
            'font' => array(
				'name' => 'Times New Roman',
				'size' => 12
				),

			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				)
        );
        
        $head_style = array(
            'font' => array(
				'name' => 'Times New Roman',
				'bold' => true,
				'size' => 12
				),

			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        	'wrap' => true
				)
        );
        
        $data_style = array(
            'font' => array(
				'name' => 'Times New Roman',
				'size' => 12
				),

			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        	'wrap' => true
				)
        );
        
        $name1_style = array(
            'font' => array(
				'name' => 'Times New Roman',
				'bold' => true,
				'size' => 12
				),

			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				)
        );
        
        $name2_style = array(
            'font' => array(
				'name' => 'Times New Roman',
				'italic' => 'true',
				'size' => 11
				),

			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				)
        );
        $styleBorder = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
/** 
 * Ket thuc dinh dang
 */

/**
 * Bat dau tron o
 */ 
        $objPHPExcel->getActiveSheet()->mergeCells('B3:F3');
        $objPHPExcel->getActiveSheet()->mergeCells('H3:M3');
        $objPHPExcel->getActiveSheet()->mergeCells('B4:F4');
        $objPHPExcel->getActiveSheet()->mergeCells('H4:M4');
        $objPHPExcel->getActiveSheet()->mergeCells('D7:K7');
        $objPHPExcel->getActiveSheet()->mergeCells('B9:M9');
        $objPHPExcel->getActiveSheet()->mergeCells('C11:D11');
        
/**
 * Gop cot cho cac ban ghi thuoc truong "Ten thiet bi va thong so ky thuat chinh"
 * $n la so ban ghi co trong bang
 */        
        $n = 9;
        for ($i = 0; $i < $n; $i++){
            $index = 12 + $i;
            $mergeCells = 'C'.$index.':'.'D'.$index;
            $objPHPExcel->getActiveSheet()->mergeCells($mergeCells);
        }
        
        $h1 = 11 + $n + 3;
        $h2 = $h1 + 1;
        
        $objPHPExcel->getActiveSheet()->mergeCells('B'.$h1.':'.'D'.$h1);
        $objPHPExcel->getActiveSheet()->mergeCells('E'.$h1.':'.'G'.$h1);
        $objPHPExcel->getActiveSheet()->mergeCells('H'.$h1.':'.'J'.$h1);
        $objPHPExcel->getActiveSheet()->mergeCells('K'.$h1.':'.'M'.$h1);
        $objPHPExcel->getActiveSheet()->mergeCells('B'.$h2.':'.'D'.$h2);
        $objPHPExcel->getActiveSheet()->mergeCells('E'.$h2.':'.'G'.$h2);
        $objPHPExcel->getActiveSheet()->mergeCells('H'.$h2.':'.'J'.$h2);
        $objPHPExcel->getActiveSheet()->mergeCells('K'.$h2.':'.'M'.$h2);
/**
 * Ket thuc trong o
 */
 
/**
 * Bat dau chen du lieu vao bang
 */
        
        $objPHPExcel->getActiveSheet()->setCellValue('B3', 'TRƯỜNG ĐẠI HỌC BÁCH KHOA HÀ NỘI');
        $objPHPExcel->getActiveSheet()->setCellValue('H3', 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM');
        $objPHPExcel->getActiveSheet()->setCellValue('B4', 'VIỆN.............................................');
        $objPHPExcel->getActiveSheet()->setCellValue('H4', 'Độc lập - Tự do - Hạnh phúc');
        $objPHPExcel->getActiveSheet()->setCellValue('D7', 'PHIẾU ĐIỀU CHUYỂN THIẾT BỊ');
        $objPHPExcel->getActiveSheet()->setCellValue('B9', 'Theo Quyết định số………/QĐ-……ngày……tháng…….năm……..của Viện trưởng Viện………………');
        $objPHPExcel->getActiveSheet()->setCellValue('B11', 'TT');
        $objPHPExcel->getActiveSheet()->setCellValue('C11', 'Tên thiết bị và thông số kỹ thuật chính');
        $objPHPExcel->getActiveSheet()->setCellValue('E11', 'Số lượng');
        $objPHPExcel->getActiveSheet()->setCellValue('F11', 'Nước sản xuất');
        $objPHPExcel->getActiveSheet()->setCellValue('G11', 'Ngày nhập');
        $objPHPExcel->getActiveSheet()->setCellValue('H11', 'Đơn giá (đồng)');
        $objPHPExcel->getActiveSheet()->setCellValue('I11', 'Thành tiền (đồng)');
        $objPHPExcel->getActiveSheet()->setCellValue('J11', 'Tình trạng thiết bị');
        $objPHPExcel->getActiveSheet()->setCellValue('K11', 'Nguồn tiền');
        $objPHPExcel->getActiveSheet()->setCellValue('L11', 'Số ký hiệu cũ');
        $objPHPExcel->getActiveSheet()->setCellValue('M11', 'Số ký hiệu mới');
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$h1, 'Viện trưởng');
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$h1, 'Cán bộ QLTS Viện');
        $objPHPExcel->getActiveSheet()->setCellValue('H'.$h1, 'Trưởng Bộ môn/PTN giao');
        $objPHPExcel->getActiveSheet()->setCellValue('K'.$h1, 'Trưởng Bộ môn/PTN nhận');
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$h2, '(Ký, họ tên)');
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$h2, '(Ký, họ tên)');
        $objPHPExcel->getActiveSheet()->setCellValue('H'.$h2, '(Ký, họ tên)');
        $objPHPExcel->getActiveSheet()->setCellValue('K'.$h2, '(Ký, họ tên)');
        
        for ($i = 0; $i < $n ; $i++){
            
            $index = 12 + $i;
            
            if ($i != 0) continue;
            
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$index, $i + 1);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$index, 'Ten thiet bi');
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$index, '33');
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$index, 'Viet Nam');
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$index, '12-12-2012');
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$index, '3 000 000');
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$index, '12 000 000');
            $objPHPExcel->getActiveSheet()->setCellValue('J'.$index, 'Binh thuong');
            $objPHPExcel->getActiveSheet()->setCellValue('K'.$index, 'Truong');
            $objPHPExcel->getActiveSheet()->setCellValue('L'.$index, 'BG 243');
            $objPHPExcel->getActiveSheet()->setCellValue('M'.$index, 'KJ 675');
        }
        
/**
 * Ket thuc chen du lieu vao bang
 */
    
        $objPHPExcel->getActiveSheet()->getStyle('B3:F3')->applyFromArray($title1_style);
        $objPHPExcel->getActiveSheet()->getStyle('H3:M3')->applyFromArray($title2_style);
        $objPHPExcel->getActiveSheet()->getStyle('B4:F4')->applyFromArray($title3_style);
        $objPHPExcel->getActiveSheet()->getStyle('H4:M4')->applyFromArray($title3_style);
        $objPHPExcel->getActiveSheet()->getStyle('D7:K7')->applyFromArray($title4_style);
        $objPHPExcel->getActiveSheet()->getStyle('B9:M9')->applyFromArray($title5_style);
        $objPHPExcel->getActiveSheet()->getStyle('B11:M11')->applyFromArray($head_style);
        $objPHPExcel->getActiveSheet()->getStyle('B12:M'.(11 + $n))->applyFromArray($data_style);
        $objPHPExcel->getActiveSheet()->getStyle('B'.(14 + $n).':M'.(14 + $n))->applyFromArray($name1_style);
        $objPHPExcel->getActiveSheet()->getStyle('B'.(15 + $n).':M'.(15 + $n))->applyFromArray($name2_style);
        $objPHPExcel->getActiveSheet()->getStyle('B11:M'.(11 + $n))->applyFromArray($styleBorder);
/**
 * Bat dau dinh dang width va height cho cell
 */
        
        
/**
 * Ket thuc dinh dang
 */
        $objPHPExcel->getActiveSheet()->setTitle('Phiếu điều chuyển thiết bị');
		$objPHPExcel->createSheet();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Phiếu điều chuyển thiết bị' . '' . '.xls"');
        header('Cache-Control: max-age=0');
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
}