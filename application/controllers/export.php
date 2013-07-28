<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require_once 'APPPATH./phpexcel/PHPExcel.php';;

class Export extends CI_Controller {

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
		$info = array(
			'thiet_bi_su_dung.id_ten_thiet_bi as tentb' => 'Tên thiết bị',
			'dm_loai_thiet_bi.ten as tenltb' => 'Loại thiết bị',
			'thiet_bi_su_dung.id_don_vi_quan_ly as dvql' => 'Đơn vị quản lý',
			'thiet_bi_su_dung.id_khu_nha as kn' => 'Khu nhà',
			'thiet_bi_su_dung.ngay_su_dung as ngaysd' => 'Ngày sử dụng',
			'thiet_bi_su_dung.trang_thai as trangthai' => 'Trạng thái',
			'thiet_bi_su_dung.phong as phong' => 'Phòng',			
			);

		$temp['title'] = "Xuất dữ liệu thiết bị";
		$temp['template'] = 'export/index';
		$temp['data']['title'] = "TRÍCH XUẤT THÔNG TIN VỀ THIẾT BỊ";
		$temp['data']['listexport'] = $info;

		$this->load->view('layout',$temp);
	}

	public function batch()
	{
		$infoBatch = array(
			'nhap.id_nha_cung_cap as ncc' => 'Nhà cung cấp',
			'nhap.so_hoa_don as shdn' => 'Số HĐ nhập',
			'xuat.so_hoa_don as shdx' => 'Số HĐ xuất',
			'chi_tiet_nhap.id_ten_thiet_bi as tentb' => 'Tên thiết bị',
			'dm_loai_thiet_bi.ten as tenltb' => 'Loại thiết bị',
			'chi_tiet_nhap.id_quoc_gia as qg' => 'Quốc gia',
			'chi_tiet_nhap.don_gia as dg' => 'Đơn giá',
			'chi_tiet_nhap.so_luong as sln' => 'Số lượng nhập',
			'chi_tiet_nhap.so_luong_con as slc' => 'Số lượng còn',
			'chi_tiet_nhap.so_thang_bao_hanh as stbh' => 'Số tháng bảo hành',
			'chi_tiet_xuat.id_don_vi_nhan as dvn' => 'Đơn vị nhận',
			'chi_tiet_xuat.id_nguon_von as ngv' => 'Nguồn vốn',
			'chi_tiet_xuat.chi_phi_lap_dat as cpld' => 'Chi phí lắp đặt',
			'chi_tiet_xuat.chi_phi_van_chuyen as cpvc' => 'Chi phí vận chuyển',
			'chi_tiet_xuat.chi_phi_chay_thu as cpct' => 'Chi phí chạy thử',
			'chi_tiet_xuat.khau_hao as kh' => 'Khấu hao',
			'chi_tiet_xuat.so_luong as slx' => 'Số lượng xuất',
			'thiet_bi_su_dung.phong as phong' => 'Phòng',
			'thiet_bi_su_dung.id_khu_nha as kn' => 'Khu nhà',
			'thiet_bi_su_dung.id_don_vi_quan_ly as dvql' => 'Đơn vị quản lý',
			);

		$temp['title'] = 'Xuất dữ liệu theo lô';
		$temp['template'] = 'export/batch';
		$temp['data']['title'] = "TRÍCH XUẤT THÔNG TIN THEO LÔ";
		$temp['data']['list_batch'] = $infoBatch;

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

		//dm_loai_thiet_bi.ten
		if(!(strpos($listoexport, "dm_loai_thiet_bi.ten")===false))
		{
			$listtable .= " LEFT JOIN dm_loai_thiet_bi ON dm_loai_thiet_bi.id = dm_ten_thiet_bi.id_loai_thiet_bi";
		}

	/* Kết thúc xử lý các trường dữ liệu lấy ra */

	/* Bắt đầu xử lý where */
		$where = "1=1 ";
		
		//thiet_bi_su_dung.id
		$wherecause = $this->session->userdata('id');
		if($wherecause != '')
		{
			$where .= " AND thiet_bi_su_dung.id = ".$wherecause;
		}

		//thiet_bi_su_dung.id_don_vi_quan_ly
		$wherecause = $this->session->userdata('id_don_vi_quan_ly');
		if($wherecause != '')
		{
			$where .= " AND thiet_bi_su_dung.id_don_vi_quan_ly = ".$wherecause;
		}

		//thiet_bi_su_dung.id_ten_thiet_bi
		$wherecause = $this->session->userdata('id_ten_thiet_bi');
		if($wherecause != '')
		{
			$where .= " AND thiet_bi_su_dung.id_ten_thiet_bi = ".$wherecause;
		}

		//dm_ten_thiet_bi.id_loai_thiet_bi
		$wherecause = $this->session->userdata('id_loai_thiet_bi');
		if($wherecause != '')
		{
			$where .= " AND dm_ten_thiet_bi.id_loai_thiet_bi = ".$wherecause;
		}

		//thiet_bi_su_dung.id_khu_nha
		$wherecause = $this->session->userdata('id_khu_nha');
		if($wherecause != '')
		{
			$where .= " AND thiet_bi_su_dung.id_khu_nha = ".$wherecause;
		}

		//thiet_bi_su_dung.phong
		$wherecause = $this->session->userdata('phong');
		if($wherecause != '')
		{
			$where .= " AND thiet_bi_su_dung.phong LIKE '%". $wherecause . "%'";
		}

		//thiet_bi_su_dung.ngay_su_dung
		$wherecause = $this->session->userdata('tu_nam');
		if($wherecause != '')
		{
			$where .= " AND YEAR(thiet_bi_su_dung.ngay_su_dung) >= ". $wherecause;
		}
		$wherecause = $this->session->userdata('den_nam');
		if($wherecause != '')
		{
			$where .= " AND YEAR(thiet_bi_su_dung.ngay_su_dung) <= ". $wherecause;
		}
	/* Kết thúc xử lý where */


		$sql = "SELECT ". $listoexport. " FROM ". $listtable . " WHERE " .$where;
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

	public function exportBatch()
	{
		$listoexport = $this->input->post('listoexport');
		$listoexport = substr(trim($listoexport), 0, strlen(trim($listoexport)) - 1);

		$listtable = "thiet_bi_su_dung 
					LEFT JOIN chi_tiet_xuat ON thiet_bi_su_dung.id_chi_tiet_xuat = chi_tiet_xuat.id
					LEFT JOIN xuat ON chi_tiet_xuat.id_xuat = xuat.id
					LEFT JOIN chi_tiet_nhap ON chi_tiet_xuat.id_chi_tiet_nhap = chi_tiet_nhap.id
					LEFT JOIN nhap ON chi_tiet_nhap.id_nhap = nhap.id
					";

	/* Bắt đầu xử lý các trường dữ liệu */

		//nhap.id_nha_cung_cap
		if(!(strpos($listoexport, "nhap.id_nha_cung_cap")===false))
		{
			$listoexport = str_replace("nhap.id_nha_cung_cap", "dm_nha_cung_cap.ten", $listoexport);
			$listtable .= " LEFT JOIN dm_nha_cung_cap ON nhap.id_nha_cung_cap = dm_nha_cung_cap.id";
		}

		//chi_tiet_nhap.id_ten_thiet_bi
		if(!(strpos($listoexport, "chi_tiet_nhap.id_ten_thiet_bi")===false))
		{
			$listoexport = str_replace("chi_tiet_nhap.id_ten_thiet_bi", "dm_ten_thiet_bi.ten", $listoexport);
			$listtable .= " LEFT JOIN dm_ten_thiet_bi ON chi_tiet_nhap.id_ten_thiet_bi = dm_ten_thiet_bi.id";
		}

		//chi_tiet_nhap.id_quoc_gia
		if(!(strpos($listoexport, "chi_tiet_nhap.id_quoc_gia")===false))
		{
			$listoexport = str_replace("chi_tiet_nhap.id_quoc_gia", "dm_qg.qg", $listoexport);
			$listtable .= " LEFT JOIN dm_qg ON chi_tiet_nhap.id_quoc_gia = dm_qg.ma_qg";
		}

		//chi_tiet_xuat.id_nguon_von
		if(!(strpos($listoexport, "chi_tiet_xuat.id_nguon_von")===false))
		{
			$listoexport = str_replace("chi_tiet_xuat.id_nguon_von", "dm_nguon_von.ten", $listoexport);
			$listtable .= " LEFT JOIN dm_nguon_von ON chi_tiet_xuat.id_nguon_von = dm_nguon_von.id";
		}

		//chi_tiet_xuat.id_don_vi_nhan
		if(!(strpos($listoexport, "chi_tiet_xuat.id_don_vi_nhan")===false))
		{
			$listoexport = str_replace("chi_tiet_xuat.id_don_vi_nhan", "dvnhan.ten", $listoexport);
			$listtable .= " LEFT JOIN dm_don_vi as dvnhan ON chi_tiet_xuat.id_don_vi_nhan = dvnhan.id";
		}

		//thiet_bi_su_dung.id_don_vi_quan_ly
		if(!(strpos($listoexport, "thiet_bi_su_dung.id_don_vi_quan_ly")===false))
		{
			$listoexport = str_replace("thiet_bi_su_dung.id_don_vi_quan_ly", "dvql.ten", $listoexport);
			$listtable .= " LEFT JOIN dm_don_vi dvql ON thiet_bi_su_dung.id_don_vi_quan_ly = dvql.id";
		}

		//thiet_bi_su_dung.id_khu_nha
		if(!(strpos($listoexport, "thiet_bi_su_dung.id_khu_nha")===false))
		{
			$listoexport = str_replace("thiet_bi_su_dung.id_khu_nha", "kntb.ten", $listoexport);
			$listtable .= " LEFT JOIN dm_khu_nha kntb ON thiet_bi_su_dung.id_khu_nha = kntb.id";
		}

		//dm_loai_thiet_bi.ten
		if(!(strpos($listoexport, "dm_loai_thiet_bi.ten")===false))
		{
			$listtable .= " LEFT JOIN dm_loai_thiet_bi ON dm_loai_thiet_bi.id = dm_ten_thiet_bi.id_loai_thiet_bi";
		}

	/* Kết thúc xử lý các trường dữ liệu */

	/* Bắt đầu xử lý where */
		$where = "1=1 ";
		
		//shdn vs shdx
		$wherecause = $this->session->userdata('shdn');
		if($wherecause != '')
		{
			$where .= " AND nhap.so_hoa_don LIKE '%". $wherecause ."%'";
		}

		$wherecause = $this->session->userdata('shdx');
		if($wherecause != '')
		{
			$where .= " AND xuat.so_hoa_don LIKE '%". $wherecause ."%'";
		}

		//thiet_bi_su_dung.id_don_vi_quan_ly
        $wherecause = $this->session->userdata('id_don_vi_quan_ly');
        if($wherecause != '')
        {
            $where .= " AND thiet_bi_su_dung.id_don_vi_quan_ly = ".$wherecause;
        }

        //dm_ten_thiet_bi.id_loai_thiet_bi
        $wherecause = $this->session->userdata('id_loai_thiet_bi');
        if($wherecause != '')
        {
            $where .= " AND dm_ten_thiet_bi.id_loai_thiet_bi = ".$wherecause;
        }

        //thiet_bi_su_dung.ngay_su_dung
        $wherecause = $this->session->userdata('tu_nam');
        if($wherecause != '')
        {
            $where .= " AND YEAR(thiet_bi_su_dung.ngay_su_dung) >= ". $wherecause;
        }

        $wherecause = $this->session->userdata('den_nam');
        if($wherecause != '')
        {
            $where .= " AND YEAR(thiet_bi_su_dung.ngay_su_dung) <= ". $wherecause;
        }

	/* Kết thúc xử lý where */

		$select = "CONCAT(MIN(thiet_bi_su_dung.id) ,' -> ', MAX(thiet_bi_su_dung.id)) as ltb, COUNT(thiet_bi_su_dung.id) as sltb, ";
		$sql = "SELECT ". $select ."". $listoexport ." FROM ". $listtable . " WHERE ".$where. " GROUP BY id_chi_tiet_xuat";
		// echo $sql;
		// die();

	/*Bắt đầu xử lý excel */
	
		$result = mysql_query($sql);

		$objPHPExcel = new Excel();
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getProperties()->setCreator("tiêu đề cho file xuất")->setLastModifiedBy("Maarten Balliauw")->setTitle("Office 2007 XLSX Test Document")->setSubject("Office 2007 XLSX Test Document")->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")->setKeywords("office 2007 openxml php")->setCategory("Test result file");

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
		        header('Content-Disposition: attachment;filename="trích xuất lô_' . '_' . '.xls"');
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

			case 'kn':
				return "Khu nhà";
				break;

			case 'ngaysd':
				return "Ngày sử dụng";
				break;
			
			case 'phong':
				return "Phòng";
				break;

			case 'trangthai':
				return "Trạng thái";
				break;

			case 'tenltb':
				return "Loại thiết bị";
				break;

			case 'ltb':
				return "List TB";
				break;

			case 'sltb':
				return "Số lượng TB";
				break;	

			case 'ncc':
				return "Nhà cung cấp";
				break;

			case 'shdn':
				return "SHĐ Nhập";
				break;	

			case 'shdx':
				return "SHĐ Xuất";
				break;	

			case 'qg':
				return "Quốc gia";
				break;	

			case 'dg':
				return "Đơn giá";
				break;

			case 'sln':
				return "SL Nhập";
				break;	

			case 'slc':
				return "SL Còn";
				break;

			case 'stbh':
				return "Số tháng BH";
				break;	

			case 'dvn':
				return "Đơn vị nhận";
				break;

			case 'ngv':
				return "Nguồn vốn";
				break;	

			case 'cpld':
				return "Chi phí lắp đặt";
				break;

			case 'cpvc':
				return "Chi phí vận chuyển";
				break;

			case 'cpct':
				return "Chi phí chạy thử";
				break;

			case 'kh':
				return "Khấu hao";
				break;

			case 'slx':
				return "SL Xuất";
				break;
			default:
				return $header;
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */