<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kktaisan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->library('excel');
		$this->load->library('session');
	}

	public function index()
	{	
		$this->load->Model('Mdv');
		$info = $this->Mdv->selectDonviLevel(1);

		$temp['template'] = 'exportdata/kktaisan';
		$temp['data']['listDVLevel'] = $info;

		$this->load->view('layout',$temp);
	}

	public function export()
	{	
		//analysis data
		$madv = $this->input->post('madv');
		$year = $this->input->post('year');
		if($year == 0)
			$year = date('Y');
		
		$this->load->Model('Mdv');
		$donvi = $this->Mdv->getDonvibyId($madv);
		$macha = $donvi->cha;
		$donvicha = $this->Mdv->getDonvibyId($macha);

		$listable = "thiet_bi_su_dung 
					LEFT JOIN chi_tiet_xuat ON thiet_bi_su_dung.id_chi_tiet_xuat = chi_tiet_xuat.id
					LEFT JOIN xuat ON chi_tiet_xuat.id_xuat = xuat.id
					LEFT JOIN dm_nguon_von ON xuat.id_nguon_von = dm_nguon_von.id
					LEFT JOIN chi_tiet_nhap ON chi_tiet_xuat.id_chi_tiet_nhap = chi_tiet_nhap.id
					LEFT JOIN nhap ON chi_tiet_nhap.id_nhap = nhap.id
					LEFT JOIN dm_nha_cung_cap ON nhap.id_nha_cung_cap = dm_nha_cung_cap.id
					LEFT JOIN dm_qg ON dm_nha_cung_cap.id_quoc_gia = dm_qg.ma_qg
					LEFT JOIN dm_ten_thiet_bi ON thiet_bi_su_dung.id_ten_thiet_bi = dm_ten_thiet_bi.id";

		$select = "dm_ten_thiet_bi.ten as tentb, COUNT(thiet_bi_su_dung.id) as sl, COUNT(thiet_bi_su_dung.id) as somay, dm_qg.qg as qg, thiet_bi_su_dung.ngay_su_dung as ngaynhap, chi_tiet_xuat.don_gia as dongia, COUNT(thiet_bi_su_dung.id)*chi_tiet_xuat.don_gia as tong, dm_ten_thiet_bi.trang_thai as tt, dm_nguon_von.ten as tennv";
		$where = 'thiet_bi_su_dung.id_don_vi_quan_ly = '.$donvi->ma_dv;

		$query = "SELECT " .$select. " FROM " .$listable. " WHERE " .$where. " GROUP BY thiet_bi_su_dung.id_ten_thiet_bi";
		
		//header
		$arrayHeader = array(
			'1' => 'TT',
			'2' => 'Tên thiết bị và chỉ tiêu kỹ thuật chính',
			'3' => 'Số lượng',
			'4' => 'Số máy',
			'5' => 'Nước SX',
			'6' => 'Ngày nhập',
			'7' => 'Đơn giá (1000đ)',
			'8' => 'Thành tiền (1000đ)',
			'9' => 'Tình trạng',
			'10' => 'Nguồn tiền',
			'11' => 'Số tài sản'
			);

	//create new PHPExcel object
		$objPHPExcel = new Excel();

	//set properties
		$objPHPExcel->getProperties()->setCreator("Trường Kobe");
		$objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
		$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");

	//add required data
		$objPHPExcel->setActiveSheetIndex();
		//set style
			//style of title
		$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray(array(
			'font' => array(
				'name' => 'Verdana',
				'bold' => true,
				'size' => 18
				),

			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		        'wrap' => true
				)
			));

			//style of header
		$styleHeader = array(
				'font' => array(
					'name' => 'Times New Roman',
					'bold' => true,
					'italic' =>true,
					'size' => 12
					),

				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        	'vertical' => 
		        		PHPExcel_Style_Alignment::VERTICAL_CENTER,
		        	'wrap' => true
					)
			);

			//style of border
		$styleBorder = array(
		            'borders' => array(
		                'allborders' => array(
		                    'style' => PHPExcel_Style_Border::BORDER_THIN
		                )
		            )
		        );

			//style of data
		$styleData = array(
				'font' => array(
					'name' => 'Times new Roman',
					'size' => 12
					),
				
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		        	'wrap' => true
		        )
			);

		//end set style
		//merge cell
		$objPHPExcel->setActiveSheetIndex()->mergeCells('A2:L2');
		$objPHPExcel->setActiveSheetIndex()->mergeCells('C3:F3');
		$objPHPExcel->setActiveSheetIndex()->mergeCells('H3:L3');
		$objPHPExcel->setActiveSheetIndex()->mergeCells('A4:L5');
		$objPHPExcel->setActiveSheetIndex()->mergeCells('I6:J6');

		//end merge cell

		//set cell value
		$objPHPExcel->setActiveSheetIndex()->setCellValue('A2','KIỂM KÊ TÀI SẢN NĂM '.$year);

		$objPHPExcel->setActiveSheetIndex()->setCellValue('B3','Đơn vị:');
		$objPHPExcel->getActiveSheet()->getStyle('B3')->applyFromArray($styleData);
		$objPHPExcel->getActiveSheet()->getStyle('B3')->applyFromArray(array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
				)
			)
		);

		$objPHPExcel->setActiveSheetIndex()->setCellValue('C3',$donvi->dv);
		$objPHPExcel->getActiveSheet()->getStyle('C3')->applyFromArray($styleHeader);
		$objPHPExcel->getActiveSheet()->getStyle('C3')->applyFromArray(array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
				)
			)
		);

		$objPHPExcel->setActiveSheetIndex()->setCellValue('G3','Thuộc:');
		$objPHPExcel->getActiveSheet()->getStyle('G3')->applyFromArray($styleData);
		$objPHPExcel->getActiveSheet()->getStyle('G3')->applyFromArray(array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
				)
			)
		);


		$objPHPExcel->setActiveSheetIndex()->setCellValue('H3',$donvicha->dv);
		$objPHPExcel->getActiveSheet()->getStyle('H3')->applyFromArray($styleHeader);
		$objPHPExcel->getActiveSheet()->getStyle('H3')->applyFromArray(array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
				)
			)
		);

		$objPHPExcel->setActiveSheetIndex()->setCellValue('A4', 'Tính đến 0 giờ 00 ngày 1 tháng 1 năm '.$year);
		$objPHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray($styleData);
		$objPHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray(array(
			'font' => array(
				'italic' => true,
				'size' => 14
				)
			)
			);

		$rowHeader = 6;
		$columnHeader = array('A','B','C','D','E','F','G','H','I','K','L');
		$i=0;
		foreach ($arrayHeader as $key => $value) {
			$objPHPExcel->getActiveSheet()->setCellValue($columnHeader[$i].$rowHeader, $value);
			$objPHPExcel->getActiveSheet()->getStyle($columnHeader[$i].$rowHeader)->applyFromArray($styleHeader);
			$objPHPExcel->getActiveSheet()->getStyle($columnHeader[$i].$rowHeader)->applyFromArray($styleBorder
				);
			$columnHeader++;
			$i++;
		}
		$objPHPExcel->getActiveSheet()->getStyle('J6')->applyFromArray($styleBorder);

		$executeQuery = $this->db->query($query);
		$number = $executeQuery->num_rows();
		$infomation = $executeQuery->result_array();
		$rowData = 6;
		$i=1;	
			foreach ($infomation as $key => $value) {
				$rowData++;
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$rowData, $i);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$rowData, $value['tentb']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$rowData, $value['sl']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$rowData, $value['somay']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$rowData, $value['qg']);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$rowData, $value['ngaynhap']);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$rowData, $value['dongia']);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$rowData, $value['tong']);
				if($value['tt'])
					$objPHPExcel->getActiveSheet()->setCellValue('J'.$rowData, $value['tt']);
				else
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$rowData, 'Bình thường');	
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$rowData, $value['tennv']);
				$i++;		
			}
			
		$objPHPExcel->getActiveSheet()->getStyle('A7:L'.$rowData)->applyFromArray($styleData);
		$objPHPExcel->getActiveSheet()->getStyle('A7:L'.$rowData)->applyFromArray($styleBorder);

		$rowData = $rowData+2;
		$objPHPExcel->setActiveSheetIndex()->mergeCells('A'.$rowData.':C'.$rowData);
		$objPHPExcel->setActiveSheetIndex()->mergeCells('D'.$rowData.':G'.$rowData);
		$objPHPExcel->setActiveSheetIndex()->mergeCells('H'.$rowData.':L'.$rowData);

		$objPHPExcel->getActiveSheet()->setCellValue('A'.$rowData,'Viện trưởng');
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$rowData,'Trưởng Bộ môn/PTN');
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$rowData,'Cán bộ quản lý tài sản Bộ môn/PTN');

		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowData.':L'.$rowData)->applyFromArray($styleHeader);
		//end set

		//set row height
		$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight('7');
		$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight('40');
		$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight('20');
		$objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight('20');
		$objPHPExcel->getActiveSheet()->getRowDimension('6')->setRowHeight('32');
		//end set row height

		//set column width
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(7);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(13);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(13);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(9);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(9);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(14);
		//end set column width
	//end add data

	//save and download
		$objPHPExcel->getActiveSheet()->setTitle('Kiểm kê tài sản');
		$objPHPExcel->createSheet();
        header('Content-Type: application/vnd.ms-excel');
		        header('Content-Disposition: attachment;filename="Kiểm kê tài sản năm' . $year . '.xls"');
		        header('Cache-Control: max-age=0');
		        
		        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		        $objWriter->save('php://output');

	
	}
}
?>