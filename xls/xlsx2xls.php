<?php
ini_set('max_execution_time', 33000);
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);

/** Incluir la ruta **/
set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');
require_once('PHPExcel.php');
include 'PHPExcel/IOFactory.php';

//require_once 'phpexcel/Classes/PHPExcel.php';
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objReader->setReadDataOnly(true);

$objPHPExcel = $objReader->load("xls/input.xlsx");
$objWorksheet = $objPHPExcel->getActiveSheet();

$highestRow = $objWorksheet->getHighestRow(); 
$highestColumn = $objWorksheet->getHighestColumn(); 

$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 

echo '<table border="1">' . "\n";
for ($row = 1; $row <= $highestRow; ++$row) {
  echo '<tr>' . "\n";

  for ($col = 0; $col <= $highestColumnIndex; ++$col) {
    echo '<td>' . $objWorksheet->getCellByColumnAndRow($col, $row)->getValue() . '</td>' . "\n";
  }

  echo '</tr>' . "\n";
}
echo '</table>' . "\n";

$unique_id = time();     
$vfilename="xls/".trim($unique_id).".xlsx";

//var_dump($qrysel); die();

$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', "OrderID");
$objPHPExcel->getActiveSheet()->setCellValue('B1', "Date");
$objPHPExcel->getActiveSheet()->setCellValue('C1', "Reg.Date");
$objPHPExcel->getActiveSheet()->setCellValue('D1',"Status");
$objPHPExcel->getActiveSheet()->setCellValue('E1',"Address");
$objPHPExcel->getActiveSheet()->setCellValue('F1',"Product Desc.");
$objPHPExcel->getActiveSheet()->setCellValue('G1',"Size");
$objPHPExcel->getActiveSheet()->setCellValue('H1',"Quantity");
$objPHPExcel->getActiveSheet()->setCellValue('I1',"WO");
$objPHPExcel->getActiveSheet()->setCellValue('J1',"Layout QC");
$objPHPExcel->getActiveSheet()->setCellValue('K1',"Export No");

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(60);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);

if($vtyp=='compl'){
   $objPHPExcel->getActiveSheet()->setCellValue('L1',"IMG Preview");
   $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
}

     $vrow=1;
     while ($row = mysqli_fetch_array($resqry))
     {
        $vrow=$vrow+1;
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$vrow,   "'".$row["orderId"]."'");
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$vrow,   $row["orderdate"]);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$vrow,   $row["regdate"]);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$vrow,   $row["status"]);
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$vrow,   $row["address"]);
        $objPHPExcel->getActiveSheet()->setCellValue('F'.$vrow,   $row["description"]);
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$vrow,   $row["ordersize"]);
        $objPHPExcel->getActiveSheet()->setCellValue('H'.$vrow,   $row["Quantity"]);
        $objPHPExcel->getActiveSheet()->setCellValue('I'.$vrow,   $row["woid"]);
        $objPHPExcel->getActiveSheet()->setCellValue('J'.$vrow,   $row["qclayout"]);
        $objPHPExcel->getActiveSheet()->setCellValue('K'.$vrow,   $row["expno"]);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('C'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('F'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('G'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('H'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('I'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('J'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('K'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      if($vtyp=='compl'){
        $image_p = imagecreatetruecolor(130, 130);
		$gdImage = imagecreatefromjpeg($row["Url"]);
        list($width_orig, $height_orig) = getimagesize($gdImage);
		imagecopyresampled($image_p, $gdImage, 0, 0, 0, 0, 130, 130, $width_orig, $height_orig);
		// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
		$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
		$objDrawing->setName('Sample image');
		$objDrawing->setDescription('Sample image');
		$objDrawing->setImageResource($gdImage);
		$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
		$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
		$objDrawing->setHeight(150);
		$objDrawing->setCoordinates('L'.$vrow);
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
        $objPHPExcel->getActiveSheet()->getRowDimension($vrow)->setRowHeight(130);
      }
    }

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save($vfilename);
$vhost=$_SERVER["HTTP_HOST"];
header("Location: http://".$vhost."/zazzle2.0/xls/".$vfilename);
//header("Location: http://".$vhost."/zazzle/xls/".$vfilename);
    
     
?>
