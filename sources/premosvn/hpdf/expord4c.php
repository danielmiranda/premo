<?php 
	date_default_timezone_set('America/Mexico_City');
        if(isset($_GET['ordid'])){
           $rfqid = $_GET['ordid'];
        } else {
           $rfqid = $argv[1];
        }
        $parnum = array();
        $descr = array();
        $priuni = array();
        $qty = array();
        $dqty = array();
        $adj = array();
        $reta = array();
        $amount = array();
        $ordcli = '';
        $emailcli = '';
        $daterec = '';
        $reqdate = '';
        $subtotal = '';
        $zipcode = '';
        $state = '';
        $shdesc = '';
        $rfq_shipping = '';
        $rfq_total = '';
        $rfqqry = "SELECT r.ord_date,r.ord_reqdate,r.ord_orderclient,r.ord_amount AS ord_subtotal,r.ord_shipping,r.ord_total,sm.shdesc,zc.zipcode,zc.state,
                          d.ord_det,p.part_code,p.part_name,p.part_desc,d.ord_uprice,d.ord_qty,d.ord_disc,e.eta,d.ord_eta,d.ord_adj,d.ord_amount,c.cust_name,
                          c.cust_company,c.cust_billaddress,c.cust_billaddr2,c.cust_city,c.cust_state,c.cust_zip,r.ord_contact,r.ord_company,r.ord_shaddress,
                          r.ord_shaddr2,r.ord_shcity,r.ord_shstate,r.ord_shzip, a.ordaw_image_small_jpg AS smallaw, r.ord_ctrlcode, d.ord_bkgpms, d.ord_instr,
                          (CASE 
                             WHEN  LENGTH(TRIM(COALESCE(c.cust_logo,''))) > 0 THEN c.cust_logo  
                             ELSE 'http://erp.overnighttablecovers.com/files/custlogos/baselogo.jpg' 
                          END) AS cust_logo,
                          (CASE 
                             WHEN  LENGTH(TRIM(COALESCE(a.ordaw_file_path,''))) > 0 THEN a.ordaw_file_path
                             WHEN  LENGTH(TRIM(COALESCE(a.ordaw_image_ai_to_jpg,''))) > 0 THEN a.ordaw_image_ai_to_jpg 
                             ELSE '' 
                          END) AS artimage                          
                     FROM orders AS r
                    INNER JOIN ord_details AS d ON r.ord_id = d.ord_id
                     LEFT JOIN ord_artwork AS a ON d.ord_id = a.ord_id AND d.ord_det = a.ord_det AND a.ordaw_status = 1
                    INNER JOIN customers AS c ON r.ord_custid = c.cust_id
                    INNER JOIN partnumber AS p ON d.ord_partid = p.part_id
                    INNER JOIN eta AS e ON d.ord_etaid = e.eta_id
                     LEFT JOIN shipmeth AS sm ON r.ord_shmt = sm.shid
                     LEFT JOIN zipcodes AS zc ON r.ord_zip = zc.zipcode
                    WHERE r.ord_id = ".$rfqid."
                 ";
        $getrfq = $db->ObjectBuilder()->rawQuery ($rfqqry);
        $totit=count($getrfq);
        if($totit >= 19 and $totit <= 21)
        {   
            $totit=2;
            $maxpage=7;
        }
        if($totit >= 16 and $totit <= 18)
        {   
            $totit=18;
            $maxpage=6;
        }
        if($totit >= 13 and $totit <= 15)
        {   
            $totit=15;
            $maxpage=5;
        }
        if($totit >= 10 and $totit <= 12)
        {   
            $totit=12;
            $maxpage=4;
        }
        if($totit >= 7 and $totit <= 9)
        {
            $totit=9;
            $maxpage=3;
        }
        if($totit >= 4 and $totit <= 6)
        {
            $totit=6;
            $maxpage=2;
        }
        if($totit >= 1 and $totit <= 3)
        {
            $totit=3;
            $maxpage=1;
        }
//        if($totit > 3){$totit=6;} else {$totit=3;}
//        for ($i=1; $i<=3; $i++) {
        for ($i=1; $i<=$totit; $i++) {
                $ordcli = '';
                $emailcli = '';
                $daterec = '';
                $reqdate = '';
                $parnum[$i] = '';
                $descr[$i] = '';
                $priuni[$i] = '';
                $qty[$i] = '';
                $dqty[$i] = '';
                $adj[$i] = '';
                $reta[$i] = '';
                $amount[$i] = '';
                $imgart[$i] = '';
                $arturl[$i] = '';
                $ord_bkgpms[$i] = '';
                $ord_instr[$i] = '';

        }  
        $i = 1;
        $ind=0;
        foreach ($getrfq as $xkey => $xvalue) {
                $ordcli = $xvalue->ord_orderclient;
                //$emailcli = $xvalue->cust_email;
                
                $cust_name = $xvalue->cust_name;
                $cust_company = $xvalue->cust_company;  
                $cust_billaddress = $xvalue->cust_billaddress;
                $cust_billaddr2 = $xvalue->cust_billaddr2;
                $cust_city = $xvalue->cust_city;
                $cust_state = $xvalue->cust_state;
                $cust_zip = $xvalue->cust_zip;
                $cust_logo = $xvalue->cust_logo;
                $ord_contact = $xvalue->ord_contact;  
                $ord_company = $xvalue->ord_company; 
                $ord_shaddress = $xvalue->ord_shaddress;  
                $ord_shaddr2 = $xvalue->ord_shaddr2;
                $ord_shcity = $xvalue->ord_shcity;
                $ord_shstate = $xvalue->ord_shstate;    
                $ord_shzip = $xvalue->ord_shzip;    
                $daterec = date("F d, Y", strtotime($xvalue->ord_date));
                $reqdate = date("F d, Y", strtotime($xvalue->ord_reqdate));
                $subtotal = '$'.$xvalue->ord_subtotal;
                $ind = $xvalue->ord_det;
                $parnum[$ind] = $xvalue->part_code;
                $descr[$ind] = $xvalue->part_name.' '.$xvalue->part_desc;
                $priuni[$ind] = '$'.$xvalue->ord_uprice;
                $qty[$ind] = $xvalue->ord_qty;
                $dqty[$ind] = '%'.$xvalue->ord_disc;
                $adj[$ind] = '%'.$xvalue->ord_adj;
                $reta[$ind] = $xvalue->eta.' (%'.$xvalue->ord_eta.')';
                $amount[$ind] = '$'.$xvalue->ord_amount;
                $imgart[$ind] = $xvalue->smallaw;
                $arturl[$ind] = $xvalue->artimage;
                $ord_bkgpms[$ind] = $xvalue->ord_bkgpms;
                $ord_instr[$ind] = $xvalue->ord_instr;
                $zipcode = $xvalue->zipcode;
                $state = $xvalue->state;
                $shdesc = $xvalue->shdesc;
                $ord_ctrlcode = $xvalue->ord_ctrlcode;
                $ord_shipping = '$'.$xvalue->ord_shipping;
                $ord_total = '$'.$xvalue->ord_total;
        }  


?>
<style type="text/css">
<!--
table	{ vertical-align: top; }
tr		{ vertical-align: top; }
td		{ vertical-align: top; }
}
-->
</style>
<?php 
$npage=1;
//$maxpage=1;
$j=0;
$n=1;
//if($totit > 3){$maxpage=2;}
for ($npage=1; $npage<=$maxpage; $npage++) {
$j=$j+3;
?>
<page style="font-size: 14px">
   <table style="border: solid 0px #000000; height:100%; width:  100%"  cellspacing="0">
      <tr>
        <td style="vertical-align:top;border: solid 0px #000000; width: 100%">
           <table style="border: solid 0px #000000; width:100%"  cellspacing="0">
              <tr>
                <td style="height: 1000px; width: 100%">
                   <table style="border: solid 0px #000000; width:100%"  cellspacing="0">
                      <tr>
                        <td style="padding-bottom:2px;border-bottom: solid 0px #7B7979;margin-top:5px; color:#FFFFFF; background-image: url(../images/barrab.png); background-position: left top; background-repeat: no-repeat; text-align:left;font-weight: bold; font-size: 12px; width: 100%">
                           <table style="width: 100%"  cellspacing="5">
                             <tr>
                                <td style="vertical-align:middle;width: 35%; text-align:left; font-size: 10px;height:125px;padding:3px;"><img src="<?php echo trim($cust_logo);?>" border="0" style="margin-top:55px;margin-right:5px;float:right; width: 100px"></td>
                                <td style="padding-bottom:5px;border-bottom: solid 0px #7B7979;margin-top:45px; color:#FFFFFF; text-align:right;font-weight: bold; font-size: 25pt;width: 65%">
                                </td>
                             </tr>
                           </table>
                         </td>
                      </tr>
                      <tr>
                        <td style="padding-bottom:2px;border-bottom: solid 0px #7B7979;margin-top:35px; color:#7B7979; text-align:left;font-weight: bold; font-size: 12px; width: 99%">

                           <table style="width: 100%"  cellspacing="5">
                             <tr>
                                <td style="vertical-align:middle;width: 5%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;"></td>
                                <td style="vertical-align:middle;width: 90%; text-align:left; font-size: 10px; padding:3px;border: solid 1px #7B7979;">
                                  <table style="width: 100%"  cellspacing="5">
                                      <tr>
                                         <td style="padding-bottom:2px;border-bottom: solid 1px #7B7979;margin-top:35px; color:#7B7979; text-align:left;font-weight: bold; font-size: 12px; width: 100%">
                                           <table style="width: 100%"  cellspacing="5">
                                             <tr>
                                                <td style="vertical-align:middle;width: 20%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;"></td>
                                                <td style="vertical-align:middle;width: 30%; text-align:left; font-size: 10px;height:15px;padding:3px;"></td>
                                                <td style="vertical-align:middle;width: 20%; text-align:right;font-size: 16px; color:#7B7979;padding:3px;">ORDER #:</td>
                                                <td style="vertical-align:middle;width: 30%; text-align:left;background-color:#CECDCA;font-size: 10px;height:15px;padding:3px;"><?php echo $ordcli;?></td>
                                             </tr>
                                           </table>
                                         </td>
                                      </tr>
                                      <tr>
                                        <td style="padding-bottom:2px;border-bottom: solid 0px #7B7979;margin-top:35px; color:#7B7979; text-align:left;font-weight: bold; font-size: 25pt; width: 99%"></td>
                                      </tr>
                                      <tr>
                                        <td style="padding-bottom:2px;margin-top:3px; color:#7B7979; text-align:right;font-weight: bold; font-size: 12px; width: 99%;">
                                           <table style="width: 100%;"  cellspacing="2">
                                             <tr>
                                               <td style="width: 50%;background:#444444;color:#fff;font-size:15px;height:20px;text-align:center;font-weight: bold;vertical-align:middle;">PRODUCT INFORMATION</td>
                                               <td style="width: 50%;background:#444444;color:#fff;font-size:15px;height:20px;text-align:center;font-weight: bold;vertical-align:middle;"> </td>
                                             </tr>
                <?php for ($i=$n; $i<=$j; $i++) { 
                        if(strlen(trim($arturl[$i])) > 0){?>
                                             <tr>
                                               <td style="width: 220px;">
                                                <table  cellspacing="2">
                                                     <tr>
                                                        <td style="width: 110px;vertical-align:bottom; text-align:right;font-size: 9px; color:#7B7979;padding:3px;">Part number</td>
                                                        <td style="width: 110px;vertical-align:middle; text-align:left;font-size: 9px;background-color:#CECDCA;padding:3px;"><?php echo trim($parnum[$i]);?></td>
                                                     </tr>
                                                     <tr>
                                                        <td style="width: 110px;vertical-align:top; text-align:right;font-size: 9px; color:#7B7979;padding:3px;">Description</td>
                                                        <td style="width: 110px;vertical-align:top;text-align:left;font-size: 9px;background-color:#CECDCA;padding:3px;"><?php echo trim($descr[$i]);?></td>
                                                     </tr>
                                                     <tr>
                                                        <td style="width: 110px;vertical-align:bottom; text-align:right;font-size: 9px; color:#7B7979;padding:3px;">BKGGRND PMS</td>
                                                        <td style="width: 110px;vertical-align:bottom; text-align:left;font-size: 9px;background-color:#CECDCA;padding:3px;"><?php echo trim($ord_bkgpms[$i]);?></td>
                                                     </tr>
                                                     <tr>
                                                        <td colspan="2" style="vertical-align:bottom; text-align:center;font-size: 9px; color:#7B7979;padding:3px;"></td>
                                                     </tr>
                                                </table>
                                               </td>
                                               <td style="width: 240px;vertical-align:bottom;middle;solid 1px #7B7979;" align="center">
                                                <a href="<?php echo trim($arturl[$i]);?>" style="text-decoration:none;" target="_blank"><img src="<?php echo trim($imgart[$i]);?>" border="0"></a><br><a href="<?php echo trim($arturl[$i]);?>" style="color:#FF0000;text-decoration:none;" target="_blank"><b>Click to Enlarge</b></a>
                                               </td>
                                             </tr>
                                              <tr>
                                                <td colspan="2"  style="padding-bottom:2px;border-bottom: solid 1px #7B7979;margin-top:35px; color:#7B7979; text-align:left;font-weight: bold; font-size: 25pt;"></td>
                                              </tr>
                <?php }} ?>
                                           </table>
                                        </td>
                                      </tr>
                                   </table>
                                </td>
                                <td style="vertical-align:middle;width: 5%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;"></td>

                              </tr>
                           </table>

                        </td>
                      </tr>
                   </table>
                </td>
              </tr>
              <tr>
                <td style="width: 100%"> 
                    <table style="border: solid 0px #000000; width:100%"  cellspacing="0">
                      <tr>
                        <td style="width: 10%"></td>
                        <td style="width: 80%"><span style="margin-top:10px; text-align:center;font-family: helvetica; font-weight: normal; font-size: 10px;">Please Note: We are printing in 4 color process digital (CYMK). We will match dened colors as closely as possible but 100% matching of dened colors (Pantone) is not always possible, PDF proofs are not accurate for color.</span></td>
                        <td style="width: 10%"></td>
                      </tr>
                       <tr>
                        <td style="width: 10%"></td>
                        <td style="width: 80%"><span style="margin-top:10px; text-align:center;font-family: helvetica; font-weight: normal; font-size: 10px;">By accepting this proof and/or quote you assume all responsibility of imprint information (spelling, size, and colors) along with billing charges. PLEASE BE CAREFUL AND MAKE SURE ALL INFORMATION IS ACCURATE WHEN ACCEPTING PROOFS. We strongly suggest that you do not use mobile devices to accept proofs.</span></td>
                        <td style="width: 10%"></td>
                      </tr>
                       <tr>
                        <td style="width: 10%"></td>
                        <td style="width: 80%"><span style="margin-top:10px; text-align:center;font-family: helvetica; font-weight: normal; font-size: 10px;">This order will be scheduled for delivery on the "In hands date" of the Order Pricing, please ensure it is within the expected time.</span></td>
                        <td style="width: 10%"></td>
                      </tr>
                    </table>
                </td>
              </tr>
           </table>
        </td>
      </tr>
    </table>
</page>
<?php 
    if($npage==1){$n=4;}
    if($npage==2){$n=7;}
    if($npage==3){$n=10;}
    if($npage==4){$n=13;}
    if($npage==5){$n=16;}
    if($npage==6){$n=19;}
    if($npage==7){$n=21;}
 }
?>
