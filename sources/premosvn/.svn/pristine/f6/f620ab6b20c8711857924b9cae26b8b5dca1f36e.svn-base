<?php 
	date_default_timezone_set('America/Mexico_City');
        $rfqid = $_GET['ordid'];
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
        for ($i=1; $i<=3; $i++) {
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
        }  
        $i = 1;
        $rfqqry = "SELECT r.ord_date,r.ord_reqdate,r.ord_orderclient,r.ord_amount AS ord_subtotal,r.ord_shipping,r.ord_total,sm.shdesc,zc.zipcode,zc.state,
                          d.ord_det,p.part_code,p.part_name,p.part_desc,d.ord_uprice,d.ord_qty,d.ord_disc,e.eta,d.ord_eta,d.ord_adj,d.ord_amount,c.cust_name,
                          c.cust_company,c.cust_billaddress,c.cust_billaddr2,c.cust_city,c.cust_state,c.cust_zip,r.ord_contact,r.ord_company,r.ord_shaddress,
                          r.ord_shaddr2,r.ord_shcity,r.ord_shstate,r.ord_shzip,
                          (CASE 
                             WHEN  LENGTH(TRIM(COALESCE(a.ordaw_image_ai_to_jpg,''))) > 0 THEN a.ordaw_image_ai_to_jpg 
                             WHEN  LENGTH(TRIM(COALESCE(a.ordaw_file_path,''))) > 0 THEN a.ordaw_file_path
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
                $imgart[$ind] = str_replace($defurl,'',$xvalue->artimage);
                $arturl[$ind] = $xvalue->artimage;
                $zipcode = $xvalue->zipcode;
                $state = $xvalue->state;
                $shdesc = $xvalue->shdesc;
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
<page style="font-size: 14px">
   <table style="border: solid 0px #000000; height:100%; width:  100%"  cellspacing="0">
      <tr>
        <td style="vertical-align:top;color: #FFFFFF;background-color:#2FB1D8; background-image: url(../images/fondo5.png); background-position: left top; background-repeat: none; no-repeat: solid 0px #000000; height: 1118px; width: 248px">
                <span style="margin-left:50px;margin-top:40px; text-align:center;font-weight: bold; font-size: 30pt;">It&#39;s allmost done.</span><br>
                <span style="margin-left:50px;margin-top:10px; text-align:left;font-family: helvetica; font-weight: normal; font-size: 12px;">Your order is just a signature away</span><br>
                <br>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </td>
        <td style="vertical-align:top;border: solid 0px #000000; width: 500px">
           <table style="border: solid 0px #000000; width:100%"  cellspacing="0">
              <tr>
                <td style="height: 1000px; width: 100%">
                   <table style="border: solid 0px #000000; width:100%"  cellspacing="0">
                      <tr>
                        <td style="width: 2%"></td>
                        <td style="padding-bottom:5px;border-bottom: solid 0px #7B7979;margin-top:35px; color:#7B7979; text-align:right;font-weight: bold; font-size: 25pt; width: 99%">
                              <img src="../images/onlogo.jpg" style="margin-top:20px;margin-right:0px;float:right;;width: 200px">
                                </td>
                      </tr>
                      <tr>
                        <td style="width: 2%"></td>
                        <td style="padding-bottom:5px;border-bottom: solid 1px #7B7979;margin-top:35px; color:#7B7979; text-align:left;font-weight: bold; font-size: 25pt; width: 99%"><br>PO #: <?php echo $ordcli;?></td>
                      </tr>
                      <tr>
                        <td style="width: 2%"></td>
                        <td style="padding-bottom:5px;margin-top:50px; color:#7B7979; text-align:right;font-weight: bold; font-size: 12px; width: 99%"><br>
                           <table style="width: 100%"  cellspacing="5">
                             <tr>
                                <td style="vertical-align:middle;width: 20%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;">Order Date</td>
                                <td style="vertical-align:middle;width: 30%; text-align:left; background-color:#CECDCA;font-size: 10px;height:15px;padding:3px;"><?php echo $daterec;?></td>
                                <td style="vertical-align:middle;width: 20%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;">In hands date</td>
                                <td style="vertical-align:middle;width: 30%; text-align:left;background-color:#CECDCA;font-size: 10px;height:15px;padding:3px;"><?php echo $reqdate;?></td>
                             </tr>
                           </table>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 2%"></td>
                        <td style="padding-bottom:5px;border-bottom: solid 1px #7B7979;margin-top:35px; color:#7B7979; text-align:left;font-weight: bold; font-size: 25pt; width: 99%"></td>
                      </tr>
                      <tr>
                        <td style="width: 2%"></td>
                        <td style="padding-bottom:5px;margin-top:10px; color:#7B7979; text-align:right;font-weight: bold; font-size: 12px; width: 99%"><br>
                           <table style="width: 100%"  cellspacing="2">
                             <tr>
                               <td colspan=2 style="background:#444444;color:#fff;font-size:15px;height:20px;text-align:center;font-weight: bold;vertical-align:middle;">BILLING INFORMATION</td>
                               <td colspan=2 style="background:#444444;color:#fff;font-size:15px;height:20px;text-align:center;font-weight: bold;vertical-align:middle;">SHIPPING INFORMATION</td>
                             </tr>
                             <tr>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;">Contact</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left; background-color:#CECDCA;font-size: 10px;height:15px;padding:3px;"><?php echo $cust_name;?></td>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;">Contact</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left;background-color:#CECDCA;font-size: 10px;height:15px;padding:3px;"><?php echo $ord_contact;?></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;">Company</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left; background-color:#CECDCA;font-size: 10px;height:15px;padding:3px;"><?php echo $cust_company;?></td>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;">Company</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left;background-color:#CECDCA;font-size: 10px;height:15px;padding:3px;"><?php echo $ord_company;?></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;">Address</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left; background-color:#CECDCA;font-size: 10px;height:15px;padding:3px;"><?php echo $cust_billaddress;?></td>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;">Address</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left;background-color:#CECDCA;font-size: 10px;height:15px;padding:3px;"><?php echo $ord_shaddress;?></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;">Bld. / Apt.</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left; background-color:#CECDCA;font-size: 10px;height:15px;padding:3px;"><?php echo $cust_billaddr2;?></td>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;">Bld. / Apt.</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left;background-color:#CECDCA;font-size: 10px;height:15px;padding:3px;"><?php echo $ord_shaddr2;?></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;">City</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left; background-color:#CECDCA;font-size: 10px;height:15px;padding:3px;"><?php echo $cust_city;?></td>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;">City</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left;background-color:#CECDCA;font-size: 10px;height:15px;padding:3px;"><?php echo $ord_shcity;?></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;">State</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left; background-color:#CECDCA;font-size: 10px;height:15px;padding:3px;"><?php echo $cust_state;?></td>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;">State</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left;background-color:#CECDCA;font-size: 10px;height:15px;padding:3px;"><?php echo $ord_shstate;?></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;">ZIP</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left; background-color:#CECDCA;font-size: 10px;height:15px;padding:3px;"><?php echo $cust_zip;?></td>
                                <td style="vertical-align:middle;width: 25%; text-align:right;font-size: 10px; color:#7B7979;padding:3px;">ZIP</td>
                                <td style="vertical-align:middle;width: 25%; text-align:left;background-color:#CECDCA;font-size: 10px;height:15px;padding:3px;"><?php echo $ord_shzip;?></td>
                             </tr>
                           </table>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 2%"></td>
                        <td style="padding-bottom:5px;border-bottom: solid 1px #7B7979;margin-top:35px; color:#7B7979; text-align:left;font-weight: bold; font-size: 25pt; width: 99%"></td>
                      </tr>
                      <tr>
                        <td style="width: 2%"></td>
                        <td style="padding-bottom:5px;margin-top:10px; color:#7B7979; text-align:right;font-weight: bold; font-size: 12px; width: 99%"><br>
                           <table style="width: 100%"  cellspacing="2">
                             <tr>
                               <td colspan="2" style="background:#444444;color:#fff;font-size:15px;height:20px;text-align:center;font-weight: bold;vertical-align:middle;">PRINT COLOR</td>
                               <td colspan="2" style="background:#444444;color:#fff;font-size:15px;height:20px;text-align:center;font-weight: bold;vertical-align:middle;">CUSTOMER SIGNATURE</td>
                             </tr>
<?php for ($i=1; $i<=3; $i++) { 
        if(strlen(trim($arturl[$i])) > 0){?>
                             <tr>
                                <td style="vertical-align:bottom; text-align:right;font-size: 9px; color:#7B7979;padding:3px;">Part number</td>
                                <td style="vertical-align:middle; text-align:left;font-size: 9px;background-color:#CECDCA;padding:3px;"><?php echo trim($parnum[$i]);?></td>
                                <td colspan="2" rowspan="8" style="vertical-align:bottom; text-align:left;font-size: 9px;background-color:#CECDCA;padding:3px;"><img src="<?php echo trim($arturl[$i]);?>" style="margin-top:00px;margin-right:0px;float:right;width: 200px;"></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:top;width: 25%; text-align:right;font-size: 9px; color:#7B7979;padding:3px;">Description</td>
                                <td style="vertical-align:top;width: 25%; text-align:left;font-size: 9px;background-color:#CECDCA;padding:3px;"><?php echo trim($descr[$i]);?></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px; color:#7B7979;padding:3px;">Price per unit</td>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;"><?php echo trim($priuni[$i]);?></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px; color:#7B7979;padding:3px;">Quantity</td>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;"><?php echo trim($qty[$i]);?></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px; color:#7B7979;padding:3px;">% Disc.Qty</td>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;"><?php echo trim($dqty[$i]);?></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px; color:#7B7979;padding:3px;">% Estimated Arrival Time</td>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;"><?php echo trim($reta[$i]);?></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px; color:#7B7979;padding:3px;">% Adjustment</td>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;"><?php echo trim($adj[$i]);?></td>
                             </tr>
                             <tr>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px; color:#7B7979;padding:3px;font-weight: bold;">Amount</td>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;font-weight: bold;"><?php echo trim($amount[$i]);?></td>
                             </tr>


                              <tr>
                                <td colspan="4"  style="padding-bottom:5px;border-bottom: solid 1px #7B7979;margin-top:35px; color:#7B7979; text-align:left;font-weight: bold; font-size: 25pt;"></td>
                              </tr>
<?php }} ?>
                           </table>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 2%"></td>
                        <td style="padding-bottom:5px;border-bottom: solid 1px #7B7979;margin-top:35px; color:#7B7979; text-align:left;font-weight: bold; font-size: 25pt; width: 99%"></td>
                      </tr>
                      <tr>
                        <td style="width: 2%"></td>
                        <td style="padding-bottom:5px;margin-top:10px; color:#7B7979; text-align:right;font-weight: bold; font-size: 12px; width: 99%"><br>
                           <table style="width: 100%"  cellspacing="2">
                             <tr>
                               <td colspan=2 style="background:#444444;color:#fff;font-size:15px;height:20px;text-align:center;font-weight: bold;vertical-align:middle;">PRINT COLOR</td>
                               <td colspan=2 style="background:#444444;color:#fff;font-size:15px;height:20px;text-align:center;font-weight: bold;vertical-align:middle;">CUSTOMER SIGNATURE</td>
                             </tr>
                             <tr>
                                <td colspan=3 style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px; color:#7B7979;padding:3px;font-weight: bold;">Sub-Total</td>
                                <td style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px;background-color:#CECDCA;padding:3px;font-weight: bold;"><?php echo $subtotal;?></td>
                             </tr>
                             <tr>
                                <td colspan=4 style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px; color:#7B7979;padding:3px;font-weight: bold;"><br></td>
                             </tr>
                             <tr>
                                <td colspan=3 style="vertical-align:bottom;width: 25%; text-align:right;font-size: 9px; color:#7B7979;padding:3px;font-weight: bold;">ZIP</td>
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
                        </td>
                      </tr>
                   </table>
                </td>
              </tr>
              <tr>
                <td style="width: 100%"> 
                <span style="margin-left:175px;margin-top:15px;text-align:left; font-size: 10px;">Production, shipping and delivery times and costs,</span><br>
                <span style="margin-left:175px;margin-top:15px;text-align:left; font-size: 10px;">listed on this quote are valid for 48 hours.</span><br>
                <span style="margin-left:100px;margin-top:15px;text-align:left; font-size: 12px;"></span><br>
                <span style="margin-left:100px;margin-top:15px;text-align:left; font-size: 12px;float:right;"><img src="../images/onlogo.jpg" width=230 style="float:right;"></span>
                </td>
              </tr>
           </table>
        </td>
      </tr>
    </table>
</page>
