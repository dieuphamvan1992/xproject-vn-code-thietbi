<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bbgntaisan extends CI_Controller {

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
		//analysis data
		//end analysis data

		//header

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
			$styleTitle = array(
				'font' => array(
					'name' => 'Verdana',
					'bold' => 'true',
					'size' => 16
					),

				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		        	'wrap' => true
					)
				);

			//style of data
			$styleData = array(
				'font' => array(
					'name' => 'Times new Roman',
					'size' => 11
					),
				
				'alignment' => array(
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'wrap' => true
		        )
			);

			//style of data table
			$styleTable = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
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
		//end set style
		//merge cell
		$objPHPExcel->getActiveSheet()->mergeCells('A4:L4');
		$objPHPExcel->getActiveSheet()->mergeCells('A2:L2');
		$objPHPExcel->getActiveSheet()->mergeCells('A3:L3');	
		$objPHPExcel->getActiveSheet()->mergeCells('C5:J5');
		$objPHPExcel->getActiveSheet()->mergeCells('K5:L5');
		$objPHPExcel->getActiveSheet()->mergeCells('C6:J6');
		$objPHPExcel->getActiveSheet()->mergeCells('K6:L6');
		$objPHPExcel->getActiveSheet()->mergeCells('C7:J7');
		$objPHPExcel->getActiveSheet()->mergeCells('K7:L7');
		$objPHPExcel->getActiveSheet()->mergeCells('A8:L8');
		$objPHPExcel->getActiveSheet()->mergeCells('A15:L15');
		$objPHPExcel->getActiveSheet()->mergeCells('A16:L16');
		//end merge cell

		//set cell value
		$objPHPExcel->setActiveSheetIndex()->setCellValue('A2','Đơn vị: ');
		$objPHPExcel->setActiveSheetIndex()->setCellValue('A3','Bộ phận: ');
		$objPHPExcel->setActiveSheetIndex()->setCellValue('A4','Mã đơn vị SDNS: ');
		$objPHPExcel->getActiveSheet()->setCellValue('C5','BIÊN BẢN GIAO NHẬN TÀI SẢN ');
		$objPHPExcel->getActiveSheet()->setCellValue('C6','(Toàn bộ tài sản khi phân cấp) ');

		$today = date('d-m-Y');
		$today = explode("-", $today);
		$d = $today[0];
		$m = $today[1];
		$y = $today[2];

		$objPHPExcel->getActiveSheet()->setCellValue('C7','Ngày '.$d.' tháng '.$m.' năm '.$y.' ');
		$objPHPExcel->getActiveSheet()->setCellValue('K5','Số:... ');
		$objPHPExcel->getActiveSheet()->setCellValue('K6','Nợ... ');
		$objPHPExcel->getActiveSheet()->setCellValue('K7','Có... ');
		$objPHPExcel->getActiveSheet()->setCellValue('A8','Căn cứ Quyết định số 2425 ngày 15/10/2012 của Hiệu trưởng về việc phân cấp quản lý cho các Học viện, Viện nghiên cứu và các Trung tâm nghiên cứu (thuộc Trường).');
		$objPHPExcel->getActiveSheet()->setCellValue('A9', 'Ban giao nhận TSCĐ gồm: ');
		
		$row = 9;
		for($i=1 ;$i<=6; $i++){
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':D'.$row);
			$objPHPExcel->getActiveSheet()->mergeCells('E'.$row.':H'.$row);
			$objPHPExcel->getActiveSheet()->mergeCells('I'.$row.':L'.$row);
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row,'- Ông/Bà: ');
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row,'Chức vụ: ');
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$row,'Đại diện: ');
			$row++;
		}

		$objPHPExcel->getActiveSheet()->setCellValue('A15','Địa điểm giao nhận TSCĐ: ');
		$objPHPExcel->getActiveSheet()->setCellValue('A16','Xác nhận việc giao nhận TSCĐ như sau: ');

		$objPHPExcel->getActiveSheet()->mergeCells('A17:A18')->setCellValue('A17', 'STT');
		$objPHPExcel->getActiveSheet()->mergeCells('B17:B18')->setCellValue('B17', 'Tên, ký hiệu quy cách (cấp hạng TSCĐ)');
		$objPHPExcel->getActiveSheet()->mergeCells('C17:C18')->setCellValue('C17', 'Số tài sản');
		$objPHPExcel->getActiveSheet()->mergeCells('D17:D18')->setCellValue('D17', 'Nước sản xuất (XD)');
		$objPHPExcel->getActiveSheet()->mergeCells('E17:E18')->setCellValue('E17', 'Năm sản xuất');
		$objPHPExcel->getActiveSheet()->mergeCells('F17:F18')->setCellValue('F17', 'Năm đưa vào sử dụng');
		$objPHPExcel->getActiveSheet()->mergeCells('G17:K17')->setCellValue('G17','Tính nguyên giá tài sản cố định');
		$objPHPExcel->getActiveSheet()->setCellValue('G18', 'Giá mua (ZSX)');
		$objPHPExcel->getActiveSheet()->setCellValue('H18', 'Chi phí vận chuyển');
		$objPHPExcel->getActiveSheet()->setCellValue('I18', 'Chi phí chạy thử');
		$objPHPExcel->getActiveSheet()->setCellValue('J18', 'Số lượng');
		$objPHPExcel->getActiveSheet()->setCellValue('K18', 'Nguyên giá TSCĐ (1000 đồng)');
		$objPHPExcel->getActiveSheet()->mergeCells('L17:L18')->setCellValue('L17', 'Ghi chú');

		$objPHPExcel->getActiveSheet()->getStyle('A2:L4')->applyFromArray($styleData);
		$objPHPExcel->getActiveSheet()->getStyle('C5:J6')->applyFromArray($styleTitle);
		$objPHPExcel->getActiveSheet()->getStyle('C7:J7')->applyFromArray($styleData);
		$objPHPExcel->getActiveSheet()->getStyle('C7:J7')->applyFromArray($styleTable);
		$objPHPExcel->getActiveSheet()->getStyle('K5:L7')->applyFromArray($styleData);
		$objPHPExcel->getActiveSheet()->getStyle('A8:L16')->applyFromArray($styleData);
		$objPHPExcel->getActiveSheet()->getStyle('A17:L18')->applyFromArray($styleData);
		$objPHPExcel->getActiveSheet()->getStyle('A17:L18')->applyFromArray($styleBorder);
		$objPHPExcel->getActiveSheet()->getStyle('A17:L18')->applyFromArray($styleTable);
		//end set

		//set row height
		$objPHPExcel->getActiveSheet()->getRowDimension('8')->setRowHeight(30);
		//end set row height

		//set column width
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(27);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(9);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(11);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(9);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(9);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(19);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(9);
		//end set column width
	//end add data

	//save and download
		$objPHPExcel->getActiveSheet()->setTitle('Biên bản giao nhận tài sản');
		$objPHPExcel->createSheet();
        header('Content-Type: application/vnd.ms-excel');
		        header('Content-Disposition: attachment;filename="Biên bản giao nhận tài sản' . '' . '.xls"');
		        header('Cache-Control: max-age=0');
		        
		        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		        $objWriter->save('php://output');
	}

}	