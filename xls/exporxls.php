<?php
ini_set('max_execution_time', 33000);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	$servername = "localhost";
	$username = "root";
	$password = "root";
	//$password = "xlwZjNAuhaBg";
	$dbname = "overnight";
	//$dbname = "overnight11";
	$conn = mysqli_connect($servername, $username, $password, $dbname);

        $defurl='http://127.0.0.1/devovernight';
        $defpath='/var/www/devovernight';
/*
        $defurl='http://dev.spearsportswear.com/devovernight';
        $defpath='/var/www/html/devovernight';
/*
        $defurl='http://erp.overnighttablecovers.com';
        $defpath='/var/www/html/overnight1.1';
*/


$unique_id = time();     
$vfilename="xls/".trim($unique_id).".xlsx";

    $qrysel = "SELECT ord_id, ord_orderclient, part_code, partdescr, ord_qty, date_cont, usr_name, type_cont, desc_cont 
                 FROM vordcont 
                 order by date_cont 
            ";
//var_dump($qrysel); die();
		$resqry = mysqli_query($conn, $qrysel);

/** Incluir la ruta **/
set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');
require_once('PHPExcel.php');
include 'PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1',"WO-ID");
$objPHPExcel->getActiveSheet()->setCellValue('B1',"Order Client");
$objPHPExcel->getActiveSheet()->setCellValue('C1',"Part Code");
$objPHPExcel->getActiveSheet()->setCellValue('D1',"Part Descr.");
$objPHPExcel->getActiveSheet()->setCellValue('E1',"Quantity");
$objPHPExcel->getActiveSheet()->setCellValue('F1',"Cont.Date");
$objPHPExcel->getActiveSheet()->setCellValue('G1',"Cont.User");
$objPHPExcel->getActiveSheet()->setCellValue('H1',"Cont.Type");
$objPHPExcel->getActiveSheet()->setCellValue('I1',"Cont.Descr.");

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);

     $vrow=1;
     while ($row = mysqli_fetch_array($resqry))
     {
        $vrow=$vrow+1;
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$vrow,   $row["ord_id"]);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$vrow,   $row["ord_orderclient"]);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$vrow,   $row["part_code"]);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$vrow,   $row["partdescr"]);
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$vrow,   $row["ord_qty"]);
        $objPHPExcel->getActiveSheet()->setCellValue('F'.$vrow,   $row["date_cont"]);
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$vrow,   $row["usr_name"]);
        $objPHPExcel->getActiveSheet()->setCellValue('H'.$vrow,   $row["type_cont"]);
        $objPHPExcel->getActiveSheet()->setCellValue('I'.$vrow,   $row["desc_cont"]);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('C'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('F'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('G'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('H'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('I'.$vrow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    }

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save($vfilename);
$vhost=$_SERVER["HTTP_HOST"];
header("Location: ".$defurl."/xls/".$vfilename);
//header("Location: http://".$vhost."/zazzle/xls/".$vfilename);
    
     
?>
