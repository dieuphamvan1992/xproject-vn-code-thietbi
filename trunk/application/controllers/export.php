<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require_once 'APPPATH./phpexcel/PHPExcel.php';;
//kobe

class Export extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->library('excel');
	}

	public function index()
	{
		$info = array(
			'thiet_bi_su_dung.id_ten_thiet_bi as tentb' => 'Tên thiết bị',
			'thiet_bi_su_dung.id_don_vi_quan_ly as dvql' => 'Đơn vị quản lý',
			'thiet_bi_su_dung.id_khu_nha as kntbsd' => 'Khu nhà TBSD',
			'thiet_bi_su_dung.ngay_su_dung as ngaysd' => 'Ngày sử dụng',
			'thiet_bi_su_dung.trang_thai as trangthai' => 'Trạng thái',
			'thiet_bi_su_dung.phong as phongtbsd' => 'Phòng TBSD',

			'chi_tiet_xuat.id_don_vi_nhan as dvnhan' => 'Đơn vị nhận',
			'chi_tiet_xuat.id_khu_nha as knctx' => 'Khu nhà CTX',
			'chi_tiet_xuat.phong as phongctx' => 'Phòng CTX', 
			'chi_tiet_xuat.id_nguon_von as nguonvon' => 'Nguồn vốn',
			'chi_tiet_xuat.don_gia as dongia' => 'Đơn giá',
			'chi_tiet_xuat.chi_phi_lap_dat as chiphilapdat' => 'Chi phí lắp đặt', 
			'chi_tiet_xuat.chi_phi_van_chuyen as chiphivanchuyen' => 'Chi phí vận chuyển',
			'chi_tiet_xuat.chi_phi_chay_thu as chiphichaythu' => 'Chi phí chạy thử',
			'chi_tiet_xuat.khau_hao as khauhao' => 'Khấu hao',
			'chi_tiet_xuat.gia_tri_con as giatricon' => 'Giá trị còn',
			'chi_tiet_xuat.tinh_trang as tinhtrang' => 'Tình trạng', 
			'chi_tiet_xuat.so_luong as soluong' => 'Số lượng',
			'chi_tiet_xuat.ngay_thuc_hien as ngayth' => 'Ngày thực hiện',
			'chi_tiet_xuat.id_can_bo_thuc_hien as cbthuchien' => 'Cán bộ thực hiện', 
			'chi_tiet_xuat.cho_muon as chomuon' => 'Cho mượn'
			
			);

		$temp['title'] = "Xuất dữ liệu thiết bị";
		$temp['template'] = 'export/index';
		$temp['data']['title'] = "TRÍCH XUẤT THÔNG TIN VỀ THIẾT BỊ";
		$temp['data']['listexport'] = $info;

		$this->load->view('layout',$temp);
	}

	public function exportoexel()
	{
		$listoexport = $this->input->post('listoexport');
		$listoexport = substr(trim($listoexport), 0, strlen(trim($listoexport))-1);
		$listtable = "thiet_bi_su_dung LEFT JOIN chi_tiet_xuat ON thiet_bi_su_dung.id_chi_tiet_xuat = chi_tiet_xuat.id";
		
		/* Xử lý các trường dữ liệu */
		//thiet_bi_su_dung.id_don_vi_quan_ly
		if(!(strpos($listoexport, "thiet_bi_su_dung.id_don_vi_quan_ly")===false))
		{
			$listoexport = str_replace("thiet_bi_su_dung.id_don_vi_quan_ly", "dvql.ten", $listoexport);
			$listtable .= " LEFT JOIN dm_don_vi dvql ON thiet_bi_su_dung.id_don_vi_quan_ly = dvql.id";
		}

		//thiet_bi_su_dung.id_ten_thiet_bi
		if(!(strpos($listoexport, "thiet_bi_su_dung.id_ten_thiet_bi")===false))
		{
			$listoexport = str_replace("thiet_bi_su_dung.id_ten_thiet_bi", "dm_ten_thiet_bi.ten", $listoexport);
			$listtable .= " LEFT JOIN dm_ten_thiet_bi ON thiet_bi_su_dung.id_ten_thiet_bi = dm_ten_thiet_bi.id";
		}

		//thiet_bi_su_dung.id_khu_nha
		if(!(strpos($listoexport, "thiet_bi_su_dung.id_khu_nha")===false))
		{
			$listoexport = str_replace("thiet_bi_su_dung.id_khu_nha", "kntb.ten", $listoexport);
			$listtable .= " LEFT JOIN dm_khu_nha kntb ON thiet_bi_su_dung.id_khu_nha = kntb.id";
		}

		//chi_tiet_xuat.id_don_vi_nhan
		if(!(strpos($listoexport, "chi_tiet_xuat.id_don_vi_nhan")===false))
		{
			$listoexport = str_replace("chi_tiet_xuat.id_don_vi_nhan", "dvn.ten", $listoexport);
			$listtable .= " LEFT JOIN dm_don_vi dvn ON chi_tiet_xuat.id_don_vi_nhan = dvn.id";
		}

		//chi_tiet_xuat.id_khu_nha
		if(!(strpos($listoexport, "chi_tiet_xuat.id_khu_nha")===false))
		{
			$listoexport = str_replace("chi_tiet_xuat.id_khu_nha", "knctx.ten", $listoexport);
			$listtable .= " LEFT JOIN dm_khu_nha knctx ON chi_tiet_xuat.id_khu_nha = knctx.id";
		}

		//chi_tiet_xuat.id_nguon_von
		if(!(strpos($listoexport, "chi_tiet_xuat.id_nguon_von")===false))
		{
			$listoexport = str_replace("chi_tiet_xuat.id_nguon_von", "dm_nguon_von.ten", $listoexport);
			$listtable .= " LEFT JOIN dm_nguon_von ON chi_tiet_xuat.id_nguon_von = dm_nguon_von.id";
		}


		$sql = "SELECT ". $listoexport. " FROM ". $listtable;
		//echo $sql;
		$result = mysql_query($sql);

		$objPHPExcel = new Excel();
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getProperties()->setCreator("tiêu đề cho file xuất")->setLastModifiedBy("Maarten Balliauw")->setTitle("Office 2007 XLSX Test Document")->setSubject("Office 2007 XLSX Test Document")->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")->setKeywords("office 2007 openxml php")->setCategory("Test result file");

		/*$row = 1; // 1-based index
		while($row_data = mysql_fetch_assoc($result)) {
		    $col = 0;
		    foreach($row_data as $key=>$value) {
		        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
		        $col++;
		    }
		    $row++;
		}*/

		//khởi tạo số dòng file Exel
		$rowCount = 1;  

		//bắt đầu in tên cột như tên các trường 

		 $column = 'A';

		for ($i = 0; $i < mysql_num_fields($result); $i++)  

		{
			$objPHPExcel->getActiveSheet()->getColumnDimension( $column )->setWidth( 20 );
		    $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $this->getheader(mysql_field_name($result,$i)));
		    $column++;
		}

		//kết thúc in tên cột

		//vòng lặp lấy dữ liệu
		$rowCount = 2;  

		while($row = mysql_fetch_row($result))  

		{  
		    $column = 'A';

		   for($j=0; $j<mysql_num_fields($result);$j++)  
		    {  
		        if(!isset($row[$j]))  

		            $value = NULL;  

		        elseif ($row[$j] != "")  

		            $value = strip_tags($row[$j]);  

		        else  

		            $value = "";  

		        $objPHPExcel->getActiveSheet()->getColumnDimension( $column )->setWidth( 20 );
		        $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $value);
		        $column++;
		    }  

		    $rowCount++;
		} 

        $objPHPExcel->createSheet();
        header('Content-Type: application/vnd.ms-excel');
		        header('Content-Disposition: attachment;filename="trích xuất_' . '_' . '.xls"');
		        header('Cache-Control: max-age=0');
		        
		        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		        $objWriter->save('php://output');
       
	}

	function getheader($header)
	{
		switch ($header) {
			case 'tentb':
				return "Tên thiết bị";
				break;
			
			case 'dvql':
				return "Đơn vị quản lý";
				break;

			case 'kntbsd':
				return "Khu nhà TBSD";
				break;

			case 'ngaysd':
				return "Ngày sử dụng";
				break;
			
			case 'phongtbsd':
				return "Phòng TBSD";
				break;

			case 'dvnhan':
				return "Đơn vị nhận";
				break;

			case 'knctx':
				return "Khu nhà CTX";
				break;
			
			case 'phongctx':
				return "Phòng CTX";
				break;

			case 'nguonvon':
				return "Nguồn vốn";
				break;

			case 'dongia':
				return "Đơn giá";
				break;
			
			case 'chiphilapdat':
				return "Chi phí lắp đặt";
				break;

			case 'chiphivanchuyen':
				return "Chi phí vận chuyển";
				break;

			case 'chiphichaythu':
				return "Chi phí chạy thử";
				break;
			
			case 'khauhao':
				return "Khấu hao";
				break;

			case 'giatricon':
				return "Giá trị còn";
				break;

			case 'tinhtrang':
				return "Tình trạng";
				break;
			
			case 'soluong':
				return "Số lượng";
				break;

			case 'ngayth':
				return "Ngày thực hiện";
				break;

			case 'cbthuchien':
				return "Cán bộ thực hiện";
				break;

			case 'chomuon':
				return "Cho mượn";
				break;

			default:
				return $header;
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */