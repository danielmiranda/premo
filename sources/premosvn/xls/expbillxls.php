<?php
ini_set('max_execution_time', 33000);

	$servername = "localhost";
	$username = "root";
	$password = "root";
	$password = "xlwZjNAuhaBg";
	$dbname = "zazzle";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
    $vbillid = $_GET['billid'];

	$vstat='';
	if($vopt == 'pend')
	{$vstat=" AND (a.Status = 'ACCEPTED' OR a.Status = 'ASSIGNED') ";}
	else
	{$vstat=" AND a.Status = 'Sent' ";}

$unique_id = time();     
$vfilename="xls/".trim($unique_id).".xlsx";


    $qrysel = "SELECT DISTINCT a.orderId as orderId,a.OrderDate as orderdate,a.Status as status,
                               b.ProductId as productid,CONCAT(a.Name,'<br>',a.Address1,'<br>',a.City,' ',a.State,' ',a.Zip) as address, 
                               b.Description as description,b.orderSize as ordersize,b.Quantity,p.Url
				FROM dailyorders AS a
				INNER JOIN item AS b ON a.OrderId = b.orderId
				INNER JOIN printfiles AS p ON b.orderId = p.orderId AND b.ProductId = p.ProductId AND p.Description = 'front'
            ";

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

/** Incluir la ruta **/
set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');
require_once('PHPExcel.php');
include 'PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', "Bill Nunmber");
$objPHPExcel->getActiveSheet()->setCellValue('B1', "Exp. Number");
$objPHPExcel->getActiveSheet()->setCellValue('C1', "Order Id");
$objPHPExcel->getActiveSheet()->setCellValue('D1',"Order Date");
$objPHPExcel->getActiveSheet()->setCellValue('E1',"Product Desc.");
$objPHPExcel->getActiveSheet()->setCellValue('F1',"Size");
$objPHPExcel->getActiveSheet()->setCellValue('G1',"Quantity");

     $vrow=1;
     while ($row = mysqli_fetch_array($resqry))
     {
        $vrow=$vrow+1;
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$vrow,   $row["billno"]);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$vrow,   $row["expno"]);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$vrow,   "'".$row["OrderId"]."'");
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$vrow,   $row["OrderDate"]);
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$vrow,   $row["Description"]);
        $objPHPExcel->getActiveSheet()->setCellValue('F'.$vrow,   $row["orderSize"]);
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$vrow,   $row["Quantity"]);
    }

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save($vfilename);
$vhost=$_SERVER["HTTP_HOST"];
header("Location: http://".$vhost."/zazzle2.0/xls/".$vfilename);
//header("Location: http://".$vhost."/zazzle/xls/".$vfilename);
    
     
?>
