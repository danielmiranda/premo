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
/*
        $defurl='http://dev.spearsportswear.com/devovernight';
        $defpath='/var/www/html/devovernight';
*/
        $defurl='http://erp.overnighttablecovers.com/v2.0/';
        $defpath='/var/www/html/overnight1.1/v2.0/';


$vlview = $_GET['lview'];
$vsdate = $_GET['sdate'];
$vedate = $_GET['edate'];
$vlogdpt = $_GET['logdpt'];

$curdate = date('Y-m-d');
$newdate = strtotime ( '-30 day' , strtotime ( $curdate ) ) ;
$newdate = date ( 'Y-m-d' , $newdate );
$dataview='';
$logwhere="";
if(strlen(trim($vlview))>0 and $vlview == 0){$dataview="vlogord  ";}
if(strlen(trim($vlview))>0 and $vlview == 1){$dataview="vlogordres  ";}
if(strlen(trim($vsdate))>0){$logwhere.=" AND ldate >= '".trim($vsdate)."' ";}
if(strlen(trim($vedate))>0){$logwhere.=" AND ldate <= '".trim($vedate)."' ";}
if(strlen(trim($vlogdpt))>0){$logwhere.=" AND proc_desc LIKE '%".trim($vlogdpt)."%' ";}
$unique_id = time();     
$vfilename="xls/".trim($unique_id).".xlsx";

        $qrysel="SELECT ldate, contime, pcstime, ord_id, ord_det, wo_id, proc_desc, wo_idx, proc_descx, pcs_made, 
                        ord_qty, diffdate, diffdatex, end_date, log_date, shed_date, incont 
                  FROM ".$dataview."
                  WHERE 1 = 1
                  ".$logwhere."
                  ORDER BY log_date, ord_id, ord_det
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
        $objPHPExcel->getActiveSheet()->setCellValue('A1',"Date");
        $objPHPExcel->getActiveSheet()->setCellValue('B1',"WO-id");
        $objPHPExcel->getActiveSheet()->setCellValue('C1',"Units");
        $objPHPExcel->getActiveSheet()->setCellValue('D1',"Dept");
        $objPHPExcel->getActiveSheet()->setCellValue('E1',"Cont.Time");
        $objPHPExcel->getActiveSheet()->setCellValue('F1',"Pcs.Time");
        $objPHPExcel->getActiveSheet()->setCellValue('G1',"Diff.Time");
        $objPHPExcel->getActiveSheet()->setCellValue('H1',"Pcs.Made");
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
     $vrow=1;
     while ($row = mysqli_fetch_array($resqry))
     {
        $vrow=$vrow+1;
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$vrow,   $row["ldate"]);
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$vrow,   $row["wo_idx"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$vrow,   $row["ord_qty"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$vrow,   $row["proc_descx"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$vrow,   $row["contime"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$vrow,   $row["pcstime"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$vrow,   $row["diffdatex"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$vrow,   $row["pcs_made"]);
                if($row["pcs_made"]==0 or $row["incont"]=='Y' or $row["shed_date"]<$row["end_date"]){
                   $objPHPExcel->getActiveSheet()->getStyle('A'.$vrow)->getFill()->applyFromArray(array('type'=> PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FF0000'))); 
                   $objPHPExcel->getActiveSheet()->getStyle('B'.$vrow)->getFill()->applyFromArray(array('type'=> PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FF0000'))); 
                   $objPHPExcel->getActiveSheet()->getStyle('C'.$vrow)->getFill()->applyFromArray(array('type'=> PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FF0000'))); 
                   $objPHPExcel->getActiveSheet()->getStyle('D'.$vrow)->getFill()->applyFromArray(array('type'=> PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FF0000'))); 
                   $objPHPExcel->getActiveSheet()->getStyle('E'.$vrow)->getFill()->applyFromArray(array('type'=> PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FF0000'))); 
                   $objPHPExcel->getActiveSheet()->getStyle('F'.$vrow)->getFill()->applyFromArray(array('type'=> PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FF0000'))); 
                   $objPHPExcel->getActiveSheet()->getStyle('G'.$vrow)->getFill()->applyFromArray(array('type'=> PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FF0000'))); 
                   $objPHPExcel->getActiveSheet()->getStyle('H'.$vrow)->getFill()->applyFromArray(array('type'=> PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FF0000'))); 
                }
                
     }

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save($vfilename);
$vhost=$_SERVER["HTTP_HOST"];
header("Location: ".$defurl."/xls/".$vfilename);
//header("Location: http://".$vhost."/zazzle/xls/".$vfilename);
    
     
?>
