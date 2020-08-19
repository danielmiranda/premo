<?php

     if(isset($_POST['t'])){
		if($_POST['t'] == 'showinvin'){
            $vid = $_POST['artid'];
            $vio = $_POST['io'];
            $tit = 'ENTRADA';
            $curdate = date('Y-m-d');
            $qryart = "SELECT a.codartid, a.descrartic, a.stockart, b.un_nom
                        FROM articulos AS a
                       INNER JOIN unidades AS b ON a.stk_unid = b.un_id
                       WHERE a.codartid = ".$vid."
                       ";
            $resqry = $db->ObjectBuilder()->rawQuery ($qryart);
            foreach ($resqry as $xkey => $xvalue) 
            {
                $vartcode = $xvalue->codartid;
                $vartdesc = $xvalue->descrartic;
                $vartqty = $xvalue->stockart;
                $vunit =  $xvalue->un_nom;
            }
            if($vio == 1){$tit = 'SALIDA';}
            $pohtml='<table class="display table table-bordered table-striped" id="poschedlist" style="font-size:15px;color: #7a7676;">
                                <tr>
                                    <td style="margin-left: auto;margin-right: auto;width:100%;text-align: center;"><h2>Inventario '.$tit.'</h2></td>
                                </tr> 
                                <tr>
                                    <td style="margin-left: auto;margin-right: auto;width:100%;">
                                     <table style="width: 100%;">
                                      <tr>
                                       <td style="font-size:15px;margin-left: auto;margin-right: auto;width:16%;"><b>Codigo:</b></td>
                                       <td style="font-size:15px;margin-left: auto;margin-right: auto;width:90%;"><b>'.$vartcode.'</b></td>
                                      </tr>
                                      <tr>
                                       <td style="font-size:15px;margin-left: auto;margin-right: auto;width:16%;"><b>Descr:</b></td>
                                       <td style="font-size:15px;margin-left: auto;margin-right: auto;width:90%;"><b>'.$vartdesc.'</b></td>
                                      </tr>
                                      <tr>
                                       <td style="font-size:15px;margin-left: auto;margin-right: auto;width:16%;"><b>Fecha:</b></td>
                                       <td style="margin-left: auto;margin-right: auto;width:90%;">
                                          <input class="form-control default-date-picker textinput" style="width:25%;" placeholder="Date" id="inv_date" name="inv_date" type="text" value="'.$curdate.'" aria-invalid="false">
                                       </td>
                                      </tr>
                                      <tr>
                                       <td style="margin-left: auto;margin-right: auto;width:100%;padding: 0;" colspan=2>
                                        <table style="width: 100%;">
                                         <tr>
                                           <td style="font-size:15px;margin-left: auto;margin-right: auto;width:16%;"><b>Cantidad:</b></td>
                                           <td style="margin-left: auto;margin-right: auto;width:23%;padding-left: 0;">
                                              <input type="hidden" name="old_qty" id="old_qty" value='.$vartqty.'>
                                              <span style="font-size:15px;float:right;margin-right: 30px;"><b>'.$vunit.'</b></span><span style="float:left;"><input type="text" id="ioqty" value="" size="10" class="form-control" style="width:70px;"></span>
                                           </td>
                                           <td style="margin-left: auto;margin-right: auto;width:12%;">
                                              <span style="float:right;margin-right: 10px;"><input type="checkbox" name="invadj" id="invadj" value=1></span><span style="font-size:15px;loat:left;"><b>Ajuste:</b></span>
                                           </td>
                                           <td style="margin-left: auto;margin-right: auto;width:30%;">                                       
                                             <textarea class="form-control" rows="2" placeholder="Reference" id="invref" name="invref" cols="10"></textarea>
                                           </td>
                                         </tr>
                                        </table>
                                       </td>
                                      </tr>
                                     </table>
                                    </td>
                                </tr> 
                                <tr>
                                    <td style=""margin-left: auto;margin-right: auto;width:100%;">
                                             <button type="button" class="btn btn-primary btn-sm" id="addPcsMadeBtn" onclick="saveinvinout('.$vid.','.$vio.')" style="margin:0 auto; display:block">Save</button>
                                    </td>
                                </tr> 
                            ';
            $pohtml.='</table>
                    <script>
                        $("#inv_date").datepicker({format: "yyyy-mm-dd", daysOfWeekDisabled: [0,6], todayBtn: true, todayHighlight: true}).on("changeDate", function (ev) {
                           $(this).datepicker("hide");
                           $(document.activeElement).trigger("blur");
                        });
                    </script>
            ';
            $rval =  $pohtml;
            $result_array = array('rval' => $rval);
            echo json_encode($result_array);

    }
    if($_POST['t'] == 'saveinvinout'){
            $vid = $_POST['artid'];
            $vio = $_POST['io'];
            $vidate = $_POST['idate'];
            $vioqty = $_POST['ioqty'];
            $vadj = $_POST['vadj'];
            $vref = $_POST['vref'];
            $rval = 'ok';
            $qryart = "SELECT a.codartid, a.descrartic, a.stockart, b.un_nom
                        FROM articulos AS a
                       INNER JOIN unidades AS b ON a.stk_unid = b.un_id
                       WHERE a.codartid = ".$vid."
                       ";
            $resqry = $db->ObjectBuilder()->rawQuery ($qryart);
            foreach ($resqry as $xkey => $xvalue) 
            {
                $vartqty = $xvalue->stockart;
            }
/*
            if($vio == 0){
               $vstockqty=$vartqty+$vioqty;
            } else {
               $vstockqty=$vartqty-$vioqty;
            }
*/
            $curdate = date('Y-m-d');
            if(strlen(trim($vidate)) > 0 and trim($vidate) > '2020-07-01' and trim($vidate) <> $curdate)
              {
                  $curdate = trim($vidate);
              }
            if(strlen(trim($vidate)) == 0 and trim($vidate) > '2020-07-01' and trim($vidate) < $curdate)
              {
                  $curdate = trim($vidate);
              }
            if(strlen(trim($vidate)) > 0 and trim($vidate) <= '2020-07-01')
              {
                $rval = 'nok';
              }
            if($rval == 'ok'){
              $invio['art_id'] = $vid;
              $invio['inv_datetime'] = $curdate;
              $invio['inv_inout'] = $vio;
              $invio['inv_userid'] = $_SESSION['uid_session'];
              if($vadj == 0)
              {
                    $invio['inv_appadj'] = '-';
              } else {
                    $invio['inv_appadj'] = 'S';
              }
              if($vio == 0){
                    $vstockqty=$vartqty+$vioqty;
                    $invio['inv_qty'] = $vioqty;
                    $invio['inv_saldin'] = $vioqty;
                    $invio['inv_artqty'] = $vstockqty;
                    $invio['inv_adj'] = $vadj;
                    $invio['inv_ref'] = $vref;
                    $wid = $db->insert ('inventory_io', $invio);
              } else {
                    $vstockqty=$vartqty-$vioqty;
                    $vstockart=$vartqty;
                    $invio['inv_adj'] = $vadj;
                    $invio['inv_ref'] = $vref;

                    $viosalqty = $vioqty;
                    $qryinv = "SELECT art_id, inv_datetime, inv_id, inv_saldin
                                 FROM inventory_io 
                                WHERE art_id = ".$vid."
                                  AND inv_inout = 0 
                                  AND inv_saldin > 0 
                                ORDER by art_id, inv_datetime, inv_id
                              ";
                    $resinv = $db->ObjectBuilder()->rawQuery ($qryinv);
                    foreach ($resinv as $ikey => $ivalue) 
                    {
                      $saldin=$ivalue->inv_saldin;
                      if($saldin >= $viosalqty)
                      {
                        $saldin = $saldin-$viosalqty;
                        $vstockart=$vstockart-$viosalqty;
                        $invio['inv_qty'] = $viosalqty;
                        $invio['inv_artqty'] = $vstockart;
                        $invio['inv_adj'] = $vadj;
                        $invio['inv_ref'] = $vref;
                        $invio['art_fk_id'] = $ivalue->art_id;
                        $invio['inv_fk_datetime'] = $ivalue->inv_datetime;
                        $invio['inv_fk_id'] = $ivalue->inv_id;
                        $wid = $db->insert ('inventory_io', $invio);

                        $datinv = Array ("inv_saldin" => $saldin);
                        $db->where ('art_id', $ivalue->art_id);
                        $db->where ('inv_datetime', $ivalue->inv_datetime);
                        $db->where ('inv_id', $ivalue->inv_id);
                        $db->update ('inventory_io', $datinv);

                        break 1;
                      } else {
                        $viosalqty = $viosalqty - $saldin;
                        $vstockart = $vstockart - $saldin;
                        $invio['inv_qty'] = $saldin;
                        $invio['inv_artqty'] = $vstockart;
                        $invio['inv_adj'] = $vadj;
                        $invio['inv_ref'] = $vref;
                        $invio['art_fk_id'] = $ivalue->art_id;
                        $invio['inv_fk_datetime'] = $ivalue->inv_datetime;
                        $invio['inv_fk_id'] = $ivalue->inv_id;
                        $wid = $db->insert ('inventory_io', $invio);

                        $datinv = Array ("inv_saldin" => 0);
                        $db->where ('art_id', $ivalue->art_id);
                        $db->where ('inv_datetime', $ivalue->inv_datetime);
                        $db->where ('inv_id', $ivalue->inv_id);
                        $db->update ('inventory_io', $datinv);
                        
                    }
                }
            }
            $artiodate = "'".date('Y-m-d H:i:s')."'";
            $datart = Array ("stockart" => $vstockqty,"art_ult_io" => $artiodate   );
            $db->where ('codartid', $vid);
            $upda = $db->update ('articulos', $datart);

        }
            $result_array = array('rval' => $rval);
            echo json_encode($result_array);

    }


    if($_POST['t'] == 'showinviolist'){
            $vid = $_POST['artid'];

            $qryart = "SELECT a.codartid, a.descrartic, a.stockart, b.un_nom
                        FROM articulos AS a
                       INNER JOIN unidades AS b ON a.stk_unid = b.un_id
                       WHERE a.codartid = ".$vid."
                       ";
            $resqry = $db->ObjectBuilder()->rawQuery ($qryart);
            foreach ($resqry as $xkey => $xvalue) 
            {
                $vartcode = $xvalue->codartid;
                $vartdesc = $xvalue->descrartic;
                $vartqty = $xvalue->stockart;
                $vunit =  $xvalue->un_nom;
            }

        $pohtml='<table id="poschedlist" style="color: #7a7676;width: 100%;">
                            <tr>
                                <td style="margin-left: auto;margin-right: auto;width:100%;text-align: center;"><h2>'.$vartcode.' - '.$vartdesc.'</h2></td>
                            </tr> 
                            <tr>
                                <td style="margin-left: auto;margin-right: auto;width:100%;text-align: center;"><span style="float:right;"><a href="Inventory/getinvioxls/'.$vid.'" target="_BLANK" >XLS</a></span><span style="float:left;width:100%"><h2>Actual Stock: '.$vartqty.' - '.$vunit.'</h2></span></td>
                            </tr> 
                            <tr>
                                <td style="margin-left: auto;margin-right: auto;width:100%;">
                                 <table class="display table table-bordered table-striped" style="width: 100%;">
                                  <tr>
                                   <td style="margin-left: auto;margin-right: auto;width:13%;"><b>Date</b></td>
                                   <td style="margin-left: auto;margin-right: auto;width:10%;"><b>Usuario</b></td>
                                   <td style="margin-left: auto;margin-right: auto;width:2%;text-align:center;"><b>Aj.</b></td>
                                   <td style="margin-left: auto;margin-right: auto;width:20%;"><b>Referencia</b></td>
                                   <td style="margin-left: auto;margin-right: auto;width:20%;"><b>Referencia Salida</b></td>
                                   <td style="margin-left: auto;margin-right: auto;width:10%;text-align:right;"><b>ENT</b></td>
                                   <td style="margin-left: auto;margin-right: auto;width:10%;text-align:right;"><b>SAL</b></td>
                                   <td style="margin-left: auto;margin-right: auto;width:10%;text-align:right;"><b>Stock Prev.</b></td>
                                  </tr>
                             ';
        $qryinv = "SELECT io.inv_datetime,u.`name`,rm.partnumber,rm.description,io.inv_adj,io.inv_ref,io.inv_inout,io.inv_qty,io.inv_rmqty
                     FROM inventory_io AS io
                     LEFT JOIN rawmaterial AS rm ON io.rm_id = rm.id
                     LEFT JOIN `user` AS u ON io.inv_userid = u.id
                    WHERE io.rm_id = ".$vid."
                    ORDER BY io.inv_datetime DESC, io.inv_id DESC 
                   ";
                   
        $qryinv = "SELECT a.inv_datetime, c.usr_name, a.inv_adj, a.inv_appadj, a.inv_ref, a.inv_inout, 
                          a.inv_qty, a.inv_artqty, a.art_fk_id, a.inv_fk_datetime, a.inv_fk_id
                     FROM inventory_io AS a
                    INNER JOIN articulos AS b ON a.art_id = b.codartid
                    INNER JOIN users AS c ON a.inv_userid = c.usr_id
                    WHERE a.art_id = ".$vid."
                    ORDER BY a.inv_datetime DESC, a.inv_id DESC 
                    ";                  

                   
        $invrec = $db->ObjectBuilder()->rawQuery ($qryinv);
        foreach ($invrec as $ikey => $ival) {
            $dateFormat = date('Y-m-d', strtotime($ival->inv_datetime));
            $vadj = '';
            $invin = '';
            $invout = '';
            $refout = '';
            if($ival->inv_adj == 1){$vadj = 'Y';}
            if($ival->inv_inout == 0){
                $invin = $ival->inv_qty;
            }else{
                $invout = $ival->inv_qty;
                $qryout = "SELECT a.inv_datetime, a.inv_adj, a.inv_appadj, a.inv_ref, a.inv_inout, 
                                  a.inv_qty, a.inv_artqty
                             FROM inventory_io AS a
                            WHERE a.art_id = ".$ival->art_fk_id." 
                              AND a.inv_datetime = '".$ival->inv_fk_datetime."' 
                              AND a.inv_id = ".$ival->inv_fk_id." 
                            ";                  
                           
                $outrec = $db->ObjectBuilder()->rawQuery ($qryout);
                foreach ($outrec as $okey => $oval) {
                    $refout = $oval->inv_ref;
                }
            }
            $pohtml.='<tr>
                       <td style="margin-left: auto;margin-right: auto;">'.$dateFormat.'</td>
                       <td style="margin-left: auto;margin-right: auto;">'.$ival->usr_name.'</td>
                       <td style="margin-left: auto;margin-right: auto;text-align:center;"><b>'.$vadj.'</b></td>
                       <td style="margin-left: auto;margin-right: auto;">'.$ival->inv_ref.'</td>
                       <td style="margin-left: auto;margin-right: auto;">'.$refout.'</td>
                       <td style="margin-left: auto;margin-right: auto;text-align:right;">'.$invin.'</td>
                       <td style="margin-left: auto;margin-right: auto;text-align:right;">'.$invout.'</td>
                       <td style="margin-left: auto;margin-right: auto;text-align:right;">'.$ival->inv_artqty.'</td>
                      </tr>
                 ';
        }
        $pohtml.='</table>
                  </td>
                </tr> 
            </table>';
        $rval =  $pohtml;
        $result_array = array('rval' => $rval);
        echo json_encode($result_array);
    }

   }             
?>
