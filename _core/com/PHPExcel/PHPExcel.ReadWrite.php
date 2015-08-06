<?
	require_once 'PHPExcel.php';

	/*
	// 엑셀 셀에 대한 처리 상세 설명 페이지
	// https://github.com/PHPOffice/PHPExcel/blob/develop/Documentation/markdown/Overview/07-Accessing-Cells.md
	// excel file read sample & get cell values three ways
	// ================================================== //
	$inputFileName = '01simple.xlsx';	// 01simple.xls
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
	$objWorksheet = $objPHPExcel->getActiveSheet();

	// 1. all sheet read
	$sheetData = $objWorksheet->toArray(null,true,true,true);
	foreach($sheetData as $row){
		echo $row['A'].'<br/>';
	}

	// 2. using iterators
	foreach($objWorksheet->getRowIterator() as $row){
		$cellIterator = $row->getCellIterator();
		foreach($cellIterator as $col){
			echo $col->getValue().' | ';
		}
		echo '<br/>';
	}

	// 3. cells using indexes
	$cntRow = $objWorksheet->getHighestRow();
	$cntCol = PHPExcel_Cell::columnIndexFromString($objWorksheet->getHighestColumn());
	for ($row=1; $row<=$cntRow; $row++) {
		$rdCol = null;
		for ($col=0; $col<=$cntCol; $col++) {
			echo $objWorksheet->getCellByColumnAndRow($col, $row)->getValue().' | ';
		}
		echo '<br/>';
	}
	*/
	function readExcel($file){
		$objPHPExcel = PHPExcel_IOFactory::load($file);
		$objWorksheet = $objPHPExcel->getActiveSheet();

		$cntRow = $objWorksheet->getHighestRow();
		$cntCol = PHPExcel_Cell::columnIndexFromString($objWorksheet->getHighestColumn());
		for ($row=1; $row<=$cntRow; $row++) {
			$rdCol = null;
			for ($col=0; $col<=$cntCol; $col++) {
				$rdCol[] =  $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
			}
			$rdRow[] = $rdCol;
		}

		return $rdRow;
	}
//	$excel = readExcel('./files/_etc/cms/01simple.xlsx');
//	foreach($excel as $R){
//		for($i=0;$i<count($R);$i++)
//			echo $R[$i].' ';
//		echo '<br/>';
//	}
	
	
	/*
	// excel file write sample & set cell values a ways
	// ================================================== //
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->setActiveSheetIndex(0);
	$objWorksheet = $objPHPExcel->getActiveSheet();

	// 1. Setting a cell value by coordinate
	$objWorksheet->setCellValue('A1', 'PHPExcel');		// Set cell A1 with a string value
	$objWorksheet->setCellValue('A2', 12345.6789);		// Set cell A2 with a numeric value
	$objWorksheet->setCellValue('A3', TRUE);			// Set cell A3 with a boolean value
	$objWorksheet->setCellValue(
		'A4', 
		'=IF(A3, CONCATENATE(A1, " ", A2), CONCATENATE(A2, " ", A1))'
	);																	// Set cell A4 with a formula
	
	// 2. Setting a range of cells from an array
	$data = NULL;
	$data[] = array('a1','b1','c1','d1','e1','f1');
	$data[] = array('a2','b2','c2','d2','e2','f2');
	$objWorksheet->fromArray($data,NULL,'A1');
	*/

	function writeExcel($file,$data){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$objWorksheet = $objPHPExcel->getActiveSheet();

		$objWorksheet->fromArray($data,NULL,'A1');

		$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
		$objWriter->save($file);
	}
//	$data = NULL;
//	$data[] = array('a1','b1','c1','d1','e1','f1');
//	$data[] = array('a2','b2','c2','d2','e2','f2');
//	writeExcel("./files/_etc/cms/02simple.xls",$data);
?>
