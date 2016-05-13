<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";
//require_once APPPATH."/third_party/PHPExcel/Writer/Excel2007.php"; 
 
class Excel extends PHPExcel { 
    public function __construct() { 
        parent::__construct(); 
    } 

    public function export($arr, $filename) {
    	// HEADER 
    	$arr_header = $arr[0]; //Take first array key for header...
		$header_col = 0;
		foreach($arr_header as $key=>$header) {	
			$this->getActiveSheet()->setCellValueByColumnAndRow($header_col++, 1, $key);
		}
		// Freeze First Column
		$this->getActiveSheet()->freezePane('B2');

		//CONTENT
		foreach($arr as $rowKey=>$ar) {
			$col = 0; $row = $rowKey + 2;
			foreach($ar as $a) {
				$this->getActiveSheet()->setCellValueByColumnAndRow($col++, $row, $a);
			}
		}

		//COLUMN ADJUSTMENT FROM A TO Z 
		for($col = 'A'; $col !== 'Z'; $col++) {
		    $this->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
	  // 		$this->getActiveSheet()->getStyle($col.'1')->getFont()->setSize(12);
			// $this->getActiveSheet()->getStyle($col.'1')->getFont()->setBold(true);
		}

		header('Content-Type: application/vnd.ms-excel'); //mime type FOR #XCEL 2003
		// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type FOR #XCEL 2007
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		             
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this, 'Excel5');  
		//$objWriter = PHPExcel_IOFactory::createWriter($this, 'Excel2007');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');

    }
}