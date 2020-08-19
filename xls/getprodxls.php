<?php
session_start();
        ini_set('max_execution_time', 33000);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	$servername = "localhost";
	$username = "root";
	$password = "root";
	$password = "xlwZjNAuhaBg";
	//$dbname = "overnight";
	$dbname = "overnight11";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
/*
        $defurl='http://127.0.0.1/devovernight';
        $defpath='/var/www/devovernight';

        $defurl='http://dev.spearsportswear.com/devovernight';
        $defpath='/var/www/html/devovernight';
*/
        $defurl='http://erp.overnighttablecovers.com/v2.0';
        $defpath='/var/www/html/overnight1.1/v2.0';


$vsdate = $_GET['sdate'];
$vedate = $_GET['edate'];

$curdate = date('Y-m-d');
$newdate = strtotime ( '-30 day' , strtotime ( $curdate ) ) ;
$newdate = date ( 'Y-m-d' , $newdate );

$unique_id = time();     
$vfilename="xls/".trim($unique_id).".xlsx";

    $qrysel = "SELECT o.ord_orderclient, p.part_code, od.ord_qty,od.ord_uprice,(od.ord_qty*od.ord_uprice) as price, 
                      od.ord_disc,od.ord_eta,od.ord_adj,od.ord_amount,
                      DATE_FORMAT(os.Ordered,'%Y-%m-%d') AS Ordered, 
                      DATE_FORMAT(os.Export,'%Y-%m-%d') AS Export,
                      DATE_FORMAT(o.ord_reqdate,'%Y-%m-%d') AS Reqdate,
                      o.ord_transday AS transday, 
                      DATE_FORMAT(o.ord_shippdate,'%Y-%m-%d') AS Shippdate, 
                      DATE_FORMAT(fgetendate(od.ord_id, od.ord_det, 10),'%Y-%m-%d') AS 'RealShippdate',  
                      c.cust_name,c.cust_email
                 FROM orders AS o
                INNER JOIN ord_details AS od ON o.ord_id = od.ord_id
                INNER JOIN orderstatus AS os ON od.ord_id = os.ord_id AND od.ord_det = os.ord_det
                INNER JOIN partnumber AS p ON od.ord_partid = p.part_id
                INNER JOIN customers AS c ON o.ord_custid = c.cust_id
                WHERE DATE_FORMAT(os.Ordered,'%Y-%m-%d') >= '".$vsdate."' 
                  AND DATE_FORMAT(os.Ordered,'%Y-%m-%d') <= '".$vedate."'
                ORDER BY os.Ordered, od.ord_id
            ";
//var_dump($qrysel); die();
//echo "<pre>"; print_r($GLOBALS); echo "</pre>"; die();
		$resqry = mysqli_query($conn, $qrysel);

/** Incluir la ruta **/
set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');
require_once('PHPExcel.php');
include 'PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0);
if($_SESSION['uid_session'] == 3 or $_SESSION['uid_session'] == 5 or $_SESSION['uid_session'] == 6 or $_SESSION['uid_session'] == 2)
{
        $objPHPExcel->getActiveSheet()->setCellValue('A1',"Order Client");
        $objPHPExcel->getActiveSheet()->setCellValue('B1',"Cust. Name");
        $objPHPExcel->getActiveSheet()->setCellValue('C1',"Cust. Email");
        $objPHPExcel->getActiveSheet()->setCellValue('D1',"Part Code");
        $objPHPExcel->getActiveSheet()->setCellValue('E1',"Quantity");
        $objPHPExcel->getActiveSheet()->setCellValue('F1',"Unit price");
        $objPHPExcel->getActiveSheet()->setCellValue('G1',"Price");
        $objPHPExcel->getActiveSheet()->setCellValue('H1',"Discount");
        $objPHPExcel->getActiveSheet()->setCellValue('I1',"ETA");
        $objPHPExcel->getActiveSheet()->setCellValue('J1',"Adj.");
        $objPHPExcel->getActiveSheet()->setCellValue('L1',"Amount");
        $objPHPExcel->getActiveSheet()->setCellValue('M1',"Date Ordered");
        $objPHPExcel->getActiveSheet()->setCellValue('N1',"Date Exported");
        $objPHPExcel->getActiveSheet()->setCellValue('O1',"Date Shipped");
        $objPHPExcel->getActiveSheet()->setCellValue('P1',"Days in Trans.");
        $objPHPExcel->getActiveSheet()->setCellValue('Q1',"In Hands Date");
        $objPHPExcel->getActiveSheet()->setCellValue('R1',"Real Date Shipped");
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
} else {
        $objPHPExcel->getActiveSheet()->setCellValue('A1',"Order Client");
        $objPHPExcel->getActiveSheet()->setCellValue('B1',"Part Code");
        $objPHPExcel->getActiveSheet()->setCellValue('C1',"Quantity");
        $objPHPExcel->getActiveSheet()->setCellValue('D1',"Date Ordered");
        $objPHPExcel->getActiveSheet()->setCellValue('E1',"Date Exported");
        $objPHPExcel->getActiveSheet()->setCellValue('F1',"Date Shipped");
        $objPHPExcel->getActiveSheet()->setCellValue('G1',"Days in Trans.");
        $objPHPExcel->getActiveSheet()->setCellValue('H1',"In Hands Date");
        $objPHPExcel->getActiveSheet()->setCellValue('I1',"Real Date Shipped");
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
}
     $vrow=1;
     while ($row = mysqli_fetch_array($resqry))
     {
        $vrow=$vrow+1;
        if($_SESSION['uid_session'] == 3 or $_SESSION['uid_session'] == 5 or $_SESSION['uid_session'] == 6 or $_SESSION['uid_session'] == 2)
        {
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$vrow,   $row["ord_orderclient"]);
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$vrow,   $row["cust_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$vrow,   $row["cust_email"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$vrow,   $row["part_code"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$vrow,   $row["ord_qty"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$vrow,   $row["ord_uprice"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$vrow,   $row["price"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$vrow,   $row["ord_disc"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$vrow,   $row["ord_eta"]);
                $objPHPExcel->getActiveSheet()->setCellValue('J'.$vrow,   $row["ord_adj"]);
                $objPHPExcel->getActiveSheet()->setCellValue('L'.$vrow,   $row["ord_amount"]);
                $objPHPExcel->getActiveSheet()->setCellValue('M'.$vrow,   $row["Ordered"]);
                $objPHPExcel->getActiveSheet()->setCellValue('N'.$vrow,   $row["Export"]);
                $objPHPExcel->getActiveSheet()->setCellValue('O'.$vrow,   $row["Shippdate"]);
                $objPHPExcel->getActiveSheet()->setCellValue('P'.$vrow,   $row["transday"]);
                $objPHPExcel->getActiveSheet()->setCellValue('Q'.$vrow,   $row["Reqdate"]);
                $objPHPExcel->getActiveSheet()->setCellValue('R'.$vrow,   $row["RealShippdate"]);
        } else {
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$vrow,   $row["ord_orderclient"]);
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$vrow,   $row["part_code"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$vrow,   $row["ord_qty"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$vrow,   $row["Ordered"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$vrow,   $row["Export"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$vrow,   $row["Shippdate"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$vrow,   $row["transday"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$vrow,   $row["Reqdate"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$vrow,   $row["RealShippdate"]);
        }
     }

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save($vfilename);
$vhost=$_SERVER["HTTP_HOST"];
header("Location: ".$defurl."/xls/".$vfilename);
//header("Location: http://".$vhost."/zazzle/xls/".$vfilename);
    
     
?>
