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
        $ppud = array();
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
                          r.ord_shaddr2,r.ord_shcity,r.ord_shstate,r.ord_shzip, a.ordaw_image_small_jpg AS smallaw, r.ord_ctrlcode,
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
            $totit=20;
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
                $ppud[$i] = '';
                $adj[$i] = '';
                $reta[$i] = '';
                $amount[$i] = '';
                $imgart[$i] = '';
                $arturl[$i] = '';
        }  
        $i = 1;
        $ind=0;
        $vppud=0;
        foreach ($getrfq as $xkey => $xvalue) {
                $vppud = 0;
                $ordcli = $xvalue->ord_orderclient;
               
                $cust_name = $xvalue->cust_name;
                $cust_company = $xvalue->cust_company;  
                $cust_billaddress = $xvalue->cust_billaddress;
                $cust_billaddr2 = $xvalue->cust_billaddr2;
                $cust_city = $xvalue->cust_city;
                $cust_state = $xvalue->cust_state;
                $cust_zip = $xvalue->cust_zip;
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
                $vppud=$xvalue->ord_uprice - (round((($xvalue->ord_uprice*$xvalue->ord_disc)/100),2));
                $ppud[$ind] = '$'.number_format($vppud,2);
                $adj[$ind] = '%'.$xvalue->ord_adj;
                $reta[$ind] = $xvalue->eta.' (%'.$xvalue->ord_eta.')';
                $amount[$ind] = '$'.$xvalue->ord_amount;
                $imgart[$ind] = $xvalue->smallaw;
                $arturl[$ind] = $xvalue->artimage;
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
        <td style="vertical-align:top;color: #FFFFFF;background-color:#2FB1D8; background-image: url(../images/fondo5.png); background-position: left top; background-repeat: none; no-repeat: solid 0px #000000; height: 1118px; width: 248px">
                <span style="margin-left:50px;margin-top:40px; text-align:center;font-weight: bold; font-size: 30pt;">It&#39;s almost done.</span><br>
                <span style="margin-left:50px;margin-top:10px; text-align:left;font-family: helvetica; font-weight: normal; font-size: 12px;">Your order is just a signature away</span><br>
                <br>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <table style="border: solid 0px #000000; width:100%"  cellspacing="0">
              <tr>
                <td style="width: 5%"></td>
                <td style="width: 90%"><span style="margin-top:10px; text-align:left;font-family: helvetica; font-weight: normal; font-size: 8px;">Please Note: We are printing in 4 color process digital (CYMK). We will match dened colors as closely as possible but 100% matching of dened colors (Pantone) is not always possible, PDF proofs are not accurate for color.</span></td>
                <td style="width: 5%"></td>
              </tr>
               <tr>
                <td style="width: 5%"></td>
                <td style="width: 90%"><span style="margin-top:10px; text-align:left;font-family: helvetica; font-weight: normal; font-size: 8px;">By accepting this proof and/or quote you assume all responsibility of imprint information (spelling, size, and colors) along with billing charges. PLEASE BE CAREFUL AND MAKE SURE ALL INFORMATION IS ACCURATE WHEN ACCEPTING PROOFS. We strongly suggest that you do not use mobile devices to accept proofs.</span></td>
                <td style="width: 5%"></td>
              </tr>
               <tr>
                <td style="width: 5%"></td>
                <td style="width: 90%"><span style="margin-top:10px; text-align:left;font-family: helvetica; color:#FF0000; font-weight: normal; font-size: 8px;">This order will be scheduled for delivery on the "In hands date" of the Order Pricing, please ensure it is within the expected time.</span></td>
                <td style="width: 5%"></td>
              </tr>
            </table>
        </td>
        <td style="vertical-align:top;border: solid 0px #000000; width: 500px">
           <table style="border: solid 0px #000000; width:100%"  cellspacing="0">
              <tr>
                <td style="height: 1000px; width: 100%">
                   <table style="border: solid 0px #000000; width:100%"  cellspacing="0">
                      <tr>
                        <td style="width: 2%"></td>
                        <td style="padding-bottom:5px;border-bottom: solid 0px #7B7979;margin-top:35px; color:#7B7979; text-align:right;width: 99%">
                              <img src="../images/onlogo.jpg" style="margin-top:20px;margin-right:0px;float:right;;width: 200px">
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 2%"></td>
                        <td style="padding-bottom:2px;border-bottom: solid 1px #7B7979;margin-top:35px; color:#7B7979; text-align:left;font-weight: bold; font-size: 25pt; width: 99%"><br>PO #: <?php echo $ordcli;?></td>
                      </tr>
                      <tr>
                        <td style="width: 2%"></td>
                        <td style="padding-bottom:2px;margin-top:3px; color:#7B7979; text-align:right;font-weight: bold; font-size: 12px; width: 99%">
                           <table style="width: 100%"  cellspacing="5">
                             <tr>
                                <td style="vertical-align:middle;width: 20%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;">Order Date</td>
                                <td style="vertical-align:middle;width: 30%; text-align:left; background-color:#CECDCA;font-size: 10px;height:15px;padding:3px;"><?php echo $daterec;?></td>
                                <td style="vertical-align:middle;width: 20%; text-align:right;font-size: 10px; color:#FF0000;padding:3px;"><span style="margin-top:10px; text-align:right;font-family: helvetica; color:#FF0000; font-weight: bold; ">In hands date</span><br><span style="margin-top:10px; text-align:right;font-family: helvetica; color:#FF0000; font-weight: normal; font-size: 6px;">Shipping, delivery and costs may vary if not paid before 2:00 pm today.</span></td>
                                <td style="vertical-align:middle;width: 30%; text-align:left; color:#FF0000; background-color:#CECDCA; font-size: 10px;height:15px;padding:3px;"><?php echo $reqdate;?></td>
                             </tr>
                           </table>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 2%"></td>
                        <td style="padding-bottom:2px;border-bottom: solid 1px #7B7979;margin-top:35px; color:#7B7979; text-align:left;font-weight: bold; font-size: 25pt; width: 99%"></td>
                      </tr>
                      <tr>
                        <td style="width: 2%"></td>
                        <td style="padding-bottom:2px;margin-top:3px; color:#7B7979; text-align:right;font-weight: bold; font-size: 12px; width: 99%">
                           <table style="width: 100%"  cellspacing="2">
                             <tr>
                               <td colspan=2 style="background:#444444;color:#fff;font-size:15px;height:20px;text-align:center;font-weight: bold;vertical-align:middle;">BILLING INFORMATION</td>
                               <td colspan=2 style="background:#444444;color:#fff;font-size:15px;height:20px;text-align:center;font-weight: bold;vertical-align:middle;">SHIPPING INFORMATION</td>
                             </tr>
                             <tr>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:1px;">Contact</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left; background-color:#CECDCA;font-size: 10px;height:12px;padding:1px;"><?php echo $cust_name;?></td>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:1px;">Contact</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left;background-color:#CECDCA;font-size: 10px;height:12px;padding:1px;"><?php echo $ord_contact;?></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:1px;">Company</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left; background-color:#CECDCA;font-size: 10px;height:12px;padding:1px;"><?php echo $cust_company;?></td>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:1px;">Company</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left;background-color:#CECDCA;font-size: 10px;height:12px;padding:1px;"><?php echo $ord_company;?></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:1px;">Address</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left; background-color:#CECDCA;font-size: 10px;height:12px;padding:1px;"><?php echo $cust_billaddress;?></td>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:1px;">Address</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left;background-color:#CECDCA;font-size: 10px;height:12px;padding:1px;"><?php echo $ord_shaddress;?></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:1px;">Bld. / Apt.</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left; background-color:#CECDCA;font-size: 10px;height:12px;padding:1px;"><?php echo $cust_billaddr2;?></td>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:1px;">Bld. / Apt.</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left;background-color:#CECDCA;font-size: 10px;height:12px;padding:1px;"><?php echo $ord_shaddr2;?></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:1px;">City</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left; background-color:#CECDCA;font-size: 10px;height:12px;padding:1px;"><?php echo $cust_city;?></td>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:1px;">City</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left;background-color:#CECDCA;font-size: 10px;height:12px;padding:1px;"><?php echo $ord_shcity;?></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:1px;">State</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left; background-color:#CECDCA;font-size: 10px;height:12px;padding:1px;"><?php echo $cust_state;?></td>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:1px;">State</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left;background-color:#CECDCA;font-size: 10px;height:12px;padding:1px;"><?php echo $ord_shstate;?></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:1px;">ZIP</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left; background-color:#CECDCA;font-size: 10px;height:12px;padding:1px;"><?php echo $cust_zip;?></td>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:1px;">ZIP</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left;background-color:#CECDCA;font-size: 10px;height:12px;padding:1px;"><?php echo $ord_shzip;?></td>
                             </tr>
                           </table>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 2%"></td>
                        <td style="padding-bottom:2px;margin-top:3px; color:#7B7979; text-align:right;font-weight: bold; font-size: 12px; width: 99%;">
                           <table style="width: 100%;"  cellspacing="2">
                             <tr>
                               <td style="width: 50%;background:#444444;color:#fff;font-size:15px;height:20px;text-align:center;font-weight: bold;vertical-align:middle;">PRODUCT INFORMATION</td>
                               <td style="width: 50%;background:#444444;color:#fff;font-size:15px;height:20px;text-align:center;font-weight: bold;vertical-align:middle;">CLICK IMAGE TO ENLARGE</td>
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
                                        <td style="vertical-align:bottom; text-align:right;font-size: 9px; color:#7B7979;padding:3px;">Price per unit</td>
                                        <td style="vertical-align:bottom; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;"><?php echo trim($priuni[$i]);?></td>
                                     </tr>
                                     <tr>
                                        <td style="vertical-align:bottom; text-align:right;font-size: 9px; color:#7B7979;padding:3px;">Quantity</td>
                                        <td style="vertical-align:bottom; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;"><?php echo trim($qty[$i]);?></td>
                                     </tr>
                                     <tr>
                                        <td style="vertical-align:bottom; text-align:right;font-size: 9px; color:#7B7979;padding:3px;">% Disc.Qty / New price</td>
                                        <td style="vertical-align:bottom; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;"><?php echo trim($dqty[$i]).' / '.trim($ppud[$ind]);?></td>
                                     </tr>
                                     <tr>
                                        <td style="vertical-align:bottom; text-align:right;font-size: 9px; color:#7B7979;padding:3px;">% Estimated Arrival Time</td>
                                        <td style="vertical-align:bottom; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;"><?php echo trim($reta[$i]);?></td>
                                     </tr>
                                     <tr>
                                        <td style="vertical-align:bottom; text-align:right;font-size: 9px; color:#7B7979;padding:3px;">% Adjustment</td>
                                        <td style="vertical-align:bottom; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;"><?php echo trim($adj[$i]);?></td>
                                     </tr>
                                     <tr>
                                        <td style="vertical-align:bottom; text-align:right;font-size: 9px; color:#7B7979;padding:3px;font-weight: bold;">Amount</td>
                                        <td style="vertical-align:bottom; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;font-weight: bold;"><?php echo trim($amount[$i]);?></td>
                                     </tr>
                                </table>
                               </td>
                               <td style="width: 240px;vertical-align:bottom;middle;solid 1px #7B7979;" align="center">
                                <a href="<?php echo trim($arturl[$i]);?>" style="text-decoration:none;" target="_blank"><img src="<?php echo trim($imgart[$i]);?>" border="0"></a>
                               </td>
                             </tr>
                              <tr>
                                <td colspan="2"  style="padding-bottom:2px;border-bottom: solid 1px #7B7979;margin-top:35px; color:#7B7979; text-align:left;font-weight: bold; font-size: 25pt;"></td>
                              </tr>
<?php }} ?>
                           </table>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 2%"></td>
                        <td style="padding-bottom:2px;margin-top:3px; color:#7B7979; text-align:right;font-weight: bold; font-size: 12px; width: 99%">
<?php if($maxpage > $npage){  ?>
                           <table style="width: 100%"  cellspacing="2">
                             <tr>
                                <td></td>
                             </tr>
                             <tr>
                                <td></td>
                             </tr>
                             <tr>
                                <td></td>
                             </tr>
                             <tr>
                                <td></td>
                             </tr>
                             <tr>
                                <td></td>
                             </tr>
                             <tr>
                                <td></td>
                             </tr>
                           </table>
<?php } else { ?>
                           <table style="width: 100%"  cellspacing="2">
                             <tr>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px; color:#7B7979;padding:3px;font-weight: bold;">Sub-Total</td>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;font-weight: bold;"><?php echo $subtotal;?></td>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px; color:#7B7979;padding:3px;font-weight: bold;">ZIP</td>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;font-weight: bold;"><?php echo $zipcode;?></td>
                             </tr>
                             <tr>
                                <td colspan=3 style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px; color:#7B7979;padding:3px;font-weight: bold;">State</td>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;font-weight: bold;"><?php echo $state;?></td>
                             </tr>
                             <tr>
                                <td colspan=3 style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px; color:#7B7979;padding:3px;font-weight: bold;">Shipping Method</td>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;font-weight: bold;"><?php echo $shdesc;?></td>
                             </tr>
                             <tr>
                                <td colspan=3 style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px; color:#7B7979;padding:3px;font-weight: bold;">Shipping Price</td>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;font-weight: bold;"><?php echo $ord_shipping;?></td>
                             </tr>
                             <tr>
                                <td colspan=4 style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px; color:#7B7979;padding:3px;font-weight: bold;"><br></td>
                             </tr>
                             <tr>
                                <td colspan=3 style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px; color:#7B7979;padding:3px;font-weight: bold;">TOTAL</td>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;font-weight: bold;"><?php echo $ord_total;?></td>
                             </tr>
                           </table>
<?php } ?>
                        </td>
                      </tr>
                   </table>
                </td>
              </tr>
              <tr>
                <td style="width: 100%"> 
<?php if($maxpage > $npage){  ?>
                    <table style="width: 100%;"  cellspacing="2">
                      <tr>
                       <td style="width: 30%;"></td>
                       <td style="width: 20%;"></td>
                       <td style="width: 30%;"></td>
                       <td style="width: 20%;"></td>
                      </tr>
                    </table>
<?php } else { ?>
                    <table style="width: 100%;"  cellspacing="2">
                      <tr>
                       <td style="width: 30%;"></td>
                       <td style="width: 20%;color:#fff;font-size:15px;height:20px;text-align:center;font-weight: bold;vertical-align:middle;"><a href="<?php echo $defurl;?>/rfqctrl.php?rfqid=<?php echo $rfqid;?>&opt=r&cc=<?php echo $ord_ctrlcode;?>" style="color:#fff;text-decoration:none;" target="_blank"><img src="<?php echo $defurl;?>/images/change.jpg" border="0" width="100"></a></td>
                       <td style="width: 30%;color:#fff;font-size:15px;height:20px;text-align:center;font-weight: bold;vertical-align:middle;"><a href="<?php echo $defurl;?>/rfqctrl.php?rfqid=<?php echo $rfqid;?>&opt=a&cc=<?php echo $ord_ctrlcode;?>" style="color:#fff;text-decoration:none;" target="_blank"><img src="<?php echo $defurl;?>/images/confirm.jpg" border="0" width="100"></a></td>
                       <td style="width: 20%;"></td>
                     </tr>
                   </table>
<?php } ?>
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
