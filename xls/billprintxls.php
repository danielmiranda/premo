<?php
ini_set('max_execution_time', 33000);

	$servername = "localhost";
	$username = "root";
	$password = "root";
	$password = "xlwZjNAuhaBg";
	$dbname = "zazzle2";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
    $vbillid = $_GET['billid'];

	$vstat='';
	if($vopt == 'pend')
	{$vstat=" AND (a.Status = 'ACCEPTED' OR a.Status = 'ASSIGNED') ";}
	else
	{$vstat=" AND a.Status = 'Sent' ";}

$unique_id = time();     
$vfilename="xls/".trim($unique_id).".xlsx";

    $qrybill1 = "SELECT billid, billno, billdate FROM billing WHERE billid=".$vbillid." ";
    $resbill1 = mysqli_query($conn, $qrybill1);
    while ($rowb1 = mysqli_fetch_array($resbill1))
    {
		$vbillno = $rowb1['billno'];
		$vbilldate = $rowb1['billdate'];
	}


/** Incluir la ruta **/
set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');
require_once('PHPExcel.php');
include 'PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', "Bill Nunmber");
$objPHPExcel->getActiveSheet()->setCellValue('B1', $vbillno);
$objPHPExcel->getActiveSheet()->setCellValue('C1', "       ");
$objPHPExcel->getActiveSheet()->setCellValue('D1',"Date");
$objPHPExcel->getActiveSheet()->setCellValue('E1',$vbilldate);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->setCellValue('A3', "Export Number");
$objPHPExcel->getActiveSheet()->setCellValue('B3', "Exp.Date");
$objPHPExcel->getActiveSheet()->setCellValue('C3', "Small");
$objPHPExcel->getActiveSheet()->setCellValue('D3', "Medium");
$objPHPExcel->getActiveSheet()->setCellValue('E3', "Large");
$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);

    $qrybill2 = "SELECT expid, expno, expnodata, expdate, small, medium, large, billno, billdate FROM vbillorders WHERE billid='".$vbillid."' ";
    $resbill2 = mysqli_query($conn, $qrybill2);
    $vtots = 0;
    $vtotm = 0;
    $vtotl = 0;
    $vrow=3;
    while ($rowb2 = mysqli_fetch_array($resbill2))
    {
        $vrow=$vrow+1;
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$vrow,   $rowb2["expnodata"]);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$vrow,   $rowb2["expdate"]);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$vrow,   $rowb2["small"]);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$vrow,   $rowb2["medium"]);
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$vrow,   $rowb2["large"]);
		$vtots = $vtots + $rowb2["small"];
		$vtotm = $vtotm + $rowb2["medium"];
		$vtotl = $vtotl + $rowb2["large"];
    }
	$vrow=$vrow+1;
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$vrow,   "");
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$vrow,   "TOTAL:");
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$vrow,   $vtots);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$vrow,   $vtotm);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$vrow,   $vtotl);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$vrow)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('B'.$vrow)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('C'.$vrow)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('D'.$vrow)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('E'.$vrow)->getFont()->setBold(true);
	$vrow=$vrow+2;


	$qrysel = "SELECT b.billno, e.expno, d.OrderId, d.OrderDate, i.Description, i.orderSize, i.Quantity 
			 FROM billing AS b
			INNER JOIN export AS e ON b.billid = e.billid
			INNER JOIN item AS i ON e.expid = i.expid
			INNER JOIN orderhistory AS d ON i.orderId = d.OrderId
			WHERE b.billid = ".$vbillid."
			ORDER BY i.orderId ASC, i.orderSize ASC
		";
	//var_dump($qrysel); die();
	$resqry = mysqli_query($conn, $qrysel);

	$objPHPExcel->getActiveSheet()->setCellValue('A'.$vrow, "Order Id");
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$vrow, "Order Date");
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$vrow, "Product Desc.");
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$vrow, "Size");
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$vrow, "Quantity");
	$objPHPExcel->getActiveSheet()->getStyle('A'.$vrow)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('B'.$vrow)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('C'.$vrow)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('D'.$vrow)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('E'.$vrow)->getFont()->setBold(true);

     while ($row = mysqli_fetch_array($resqry))
     {
        $vrow=$vrow+1;
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$vrow,   "'".$row["OrderId"]."'");
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$vrow,   $row["OrderDate"]);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$vrow,   $row["Description"]);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$vrow,   $row["orderSize"]);
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$vrow,   $row["Quantity"]);
    }

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save($vfilename);
$vhost=$_SERVER["HTTP_HOST"];
header("Location: http://".$vhost."/zazzle2.0/xls/".$vfilename);
//header("Location: http://".$vhost."/zazzle/xls/".$vfilename);
    
     
?>
