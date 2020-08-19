<?php

     if(isset($_POST['t'])){
		if($_POST['t'] == 'addcontitem'){
                     $reng=$_POST['newrow'];
                     $qrysel = "SELECT tcid, tcdesc FROM tipocontacto ORDER BY tcdesc ";
                     $vdatac='';    
                     $vcont='<select name="vtcid-'.$reng.'" id="vtcid-'.$reng.'" class ="select2" style="width:150px;font-size:14px;">';
                     $vcont.='<option value="0">TIPO CONTACTO</option>';
                     $resqry = $db->ObjectBuilder()->rawQuery ($qrysel);
                     foreach ($resqry as $xkey => $xvalue) 
                     {
                      $vcont.='<option value="'.$xvalue->tcid.'">'.$xvalue->tcdesc.'</option>';
                     }
                     $vcont.='</select>';
                   
                     $vresu='<td id="dtddel-'.$reng.'"><a href="javascript:void(0)" onclick="showpdelalert(0,'.$reng.')"><i class="fa fa-trash-o" aria-hidden="true" style="font-size:20px;color:#FF0000"></i></a></td>
                              <td id="conttdtc-'.$reng.'">'.$vcont.'</td>
                              <td id="conttddes-'.$reng.'"><input class="form-control" style="width:400px;" name="contnom-'.$reng.'" id="contnom-'.$reng.'" type="text"  value=""></td>
                              <td></td>';
                     $result_array = array('resu'=>$vresu);
                     //printf(json_encode($result_array));
                     echo json_encode($result_array);
                     return;
                     exit(0);
        }             
		if($_POST['t'] == 'delcontitem'){
                        $provid=$_POST["provid"];
                        $contid=$_POST["contid"];
                        $db->ObjectBuilder()->rawQuery ("DELETE FROM contacto WHERE provid = ".$provid." AND contactoid = ".$contid." ");
                        $result_array=array("stat"=>"OK");
                        echo json_encode($result_array);
                     return;
                     exit(0);
        }             
		if($_POST['t'] == 'savenewprov'){
                     $nombreprov=$_POST['nombreprov'];
                     $cuitprov=$_POST['cuitprov'];
                     $condiva=$_POST['condiva'];
                     $domcalle=$_POST['domcalle'];
                     $domid=$_POST['domid'];
                     $locid=$_POST['locid'];
                     $dataitem=$_POST['dataitem'];
                     if(strlen(trim($domcalle))<> 0){
                         $datdom = Array ("domcalle" => $domcalle,
                                             "locid" => $locid
                                         );
                         $domid = $db->insert ('domicilio', $datdom);
                     }
                     $dataprov = Array ("nombreprov" => $nombreprov,
                                        "cuitprov" => $cuitprov,
                                        "condiva" => $condiva,
                                        "domid" => $domid
                                       );
                     $provid = $db->insert ('proveedores', $dataprov);

                     if(strlen(trim($dataitem))<> 0){
                         $contitem=explode('|',$dataitem);
                         for($i=0;$i<count($contitem)-1;$i++){
                            if(strlen(trim($contitem[$i]))<>0)
                            {
                             $infitem=explode('-',$contitem[$i]);   
                             $datai = Array ("provid" => $provid,
                                             "tcid" => $infitem[0],
                                             "contactodetalle" => $infitem[1]
                                            );
                             $wid = $db->insert ('contacto', $datai);
                            }
                         }
                     }

                     $result_array = array('provid'=>$provid);
                     //printf(json_encode($result_array));
                     echo json_encode($result_array);
                     return;
                     exit(0);
        }             
		if($_POST['t'] == 'saveupdprov'){
                     $provid=$_POST['provid'];
                     $nombreprov=$_POST['nombreprov'];
                     $cuitprov=$_POST['cuitprov'];
                     $condiva=$_POST['condiva'];
                     $domcalle=$_POST['domcalle'];
                     $domid=$_POST['domid'];
                     $locid=$_POST['locid'];
                     $dataitem=$_POST['dataitem'];

                     $dataprov = Array ("nombreprov" => $nombreprov,
                                        "cuitprov" => $cuitprov,
                                        "condiva" => $condiva,
                                        "domid" => $domid
                                       );
                     $db->where ('provid', $provid);
                     $db->update ('proveedores', $dataprov);
                     $datdom = Array ("domcalle" => $domcalle,
                                         "locid" => $locid
                                     );
                     $db->where ('domid', $domid);
                     $db->update ('domicilio', $datdom);
                     $db->ObjectBuilder()->rawQuery ("DELETE FROM contacto WHERE provid = ".$provid." ");
                     if(strlen(trim($dataitem))<> 0){
                         $contitem=explode('|',$dataitem);
                         for($i=0;$i<count($contitem)-1;$i++){
                            if(strlen(trim($contitem[$i]))<>0)
                            {
                             $infitem=explode('-',$contitem[$i]);   
                             $datai = Array ("provid" => $provid,
                                             "tcid" => $infitem[0],
                                             "contactodetalle" => $infitem[1]
                                            );
                             $wid = $db->insert ('contacto', $datai);
                            }
                         }
                     }
                     $result_array = array('rval'=>'OK');
                     echo json_encode($result_array);
                     return;
                     exit(0);
        }             
		if($_POST['t'] == 'editprov'){
			$provid=$_POST["provid"];
                        $provqry="SELECT p.provid,p.condiva,p.nombreprov,p.apellprov,p.cuitprov,d.domid,d.domcalle,l.locid,
                                        l.locnom,a.pcianombre,b.paisnombre
                                   FROM proveedores AS p 
                                   LEFT JOIN domicilio AS d ON p.domid = d.domid
                                   LEFT JOIN localidad AS l ON d.locid = l.locid
                                   LEFT JOIN provincia AS a ON l.pciaid = a.pciaid
                                   LEFT JOIN paises AS b ON a.paisid = b.paisid 
                                  WHERE p.provid =".$provid." 
                                 ";
                        $provtres = $db->ObjectBuilder()->rawQuery ($provqry);
                        foreach ($provtres as $rkey => $rvalue) 
                        {
                            $provid = $rvalue->provid;
                            $condiva = $rvalue->condiva;
                            $nombreprov = $rvalue->nombreprov;
                            $cuitprov = $rvalue->cuitprov;
                            $domid = $rvalue->domid;
                            $domcalle = $rvalue->domcalle;
                            $locid = $rvalue->locid;
                            $pcianombre = $rvalue->pcianombre;
                            $paisnombre = $rvalue->paisnombre;
                        }
                        $qrysel = "SELECT condiva, desccond FROM condiva ORDER BY desccond ";
                        $vdatac='';    
                        $vcondiva='<select name="vcondiva" id="vcondiva" class ="select2" style="width:300px;font-size:14px;">';
                        $vcondiva.='<option value="0">CONDICION IVA</option>';
                        $resqry = $db->ObjectBuilder()->rawQuery ($qrysel);
                        foreach ($resqry as $xkey => $xvalue) 
                        {
                          if($xvalue->condiva == $condiva){$vdatac=' selected="selected"';}
                          $vcondiva.='<option value="'.$xvalue->condiva.'"'.$vdatac.'>'.$xvalue->desccond.'</option>';
                          $vdatac=''; 
                        }
                        $vcondiva.='</select>';
                        $vdatac='';    
                        $vloc='<select name="vlocid" id="vlocid" class ="select2" style="width:250px;font-size:14px;" onchange="selloc(this.value)"><option value="0">Localidad</option>';
                        $qryloc = "SELECT locid, CONCAT(loccp,' - ',locnom) AS Localcp FROM localidad ORDER BY loccp ";
                        $resloc = $db->ObjectBuilder()->rawQuery ($qryloc);
                        foreach ($resloc as $lkey => $lvalue) 
                        {
                          if($lvalue->locid == $locid){$vdatac=' selected="selected"';}
                          $vloc.='<option value="'.$lvalue->locid.'"'.$vdatac.'>'.$lvalue->Localcp.'</option>';
                          $vdatac='';    
                        }
                        $vloc.='</select>';

//SELECT provid, contactoid, tcid, contactodetalle FROM contacto WHERE 1
                        $qrycont = "SELECT provid, contactoid, tcid, contactodetalle 
                                      FROM contacto 
                                     WHERE provid = ".$provid." 
                                     ORDER BY contactoid ";
                        $rescont = $db->ObjectBuilder()->rawQuery ($qrycont);
                        $vrow = 1;
                        $vresu='';
                        foreach ($rescont as $ckey => $cvalue) 
                        {
                             $reng = $cvalue->contactoid;
                             $qrytc = "SELECT tcid, tcdesc FROM tipocontacto ORDER BY tcdesc ";
                             $vdatac='';    
                             $vcont='<select name="vtcid-'.$reng.'" id="vtcid-'.$reng.'" class ="select2" style="width:150px;font-size:14px;">';
                             $vcont.='<option value="0">TIPO CONTACTO</option>';
                             $restc = $db->ObjectBuilder()->rawQuery ($qrytc);
                             foreach ($restc as $tckey => $tcvalue) 
                             {
                                if($tcvalue->tcid == $cvalue->tcid){$vdatac=' selected="selected"';}
                                $vcont.='<option value="'.$tcvalue->tcid.'"'.$vdatac.'>'.$tcvalue->tcdesc.'</option>';
                                $vdatac='';    
                             }
                             $vcont.='</select>';
                           
                             $vresu.='<tr id="conttr-'.$reng.'" class="conttritems">
                                       <td id="dtddel-'.$reng.'"><a href="javascript:void(0)" onclick="showpdelalert('.$provid.','.$reng.')"><i class="fa fa-trash-o" aria-hidden="true" style="font-size:20px;color:#FF0000"></i></a></td>
                                       <td id="conttdtc-'.$reng.'">'.$vcont.'</td>
                                       <td id="conttddes-'.$reng.'"><input class="form-control" style="width:400px;" name="contnom-'.$reng.'" id="contnom-'.$reng.'" type="text"  value="'.$cvalue->contactodetalle.'"></td>
                                       <td></td></tr>
                                       <script>$("#vtcid-'.$reng.'").select2();</script>';
                        }
			            $result_array=array("provid"=>$provid,
                                            "vcondiva"=>$vcondiva,
                                            "nombreprov"=>$nombreprov,
                                            "cuitprov"=>$cuitprov,
                                            "vcondiva"=>$vcondiva,
                                            "domid"=>$domid,
                                            "domcalle"=>$domcalle,
                                            "vloc"=>$vloc,
                                            "pcianombre"=>$pcianombre,
                                            "paisnombre"=>$paisnombre,
                                            "vresu"=>$vresu
                                           );
			echo json_encode($result_array);
                     return;
                     exit(0);
        }             
		if($_POST['t'] == 'selloc'){
                        $locid=$_POST["locid"];
                        $qryloc = "SELECT a.locid,a.loccp,a.locnom,b.pcianombre,c.paisnombre
                                     FROM localidad AS a
                                    INNER JOIN provincia AS b ON a.pciaid = b.pciaid
                                    INNER JOIN paises AS c ON b.paisid = c.paisid 
                                    WHERE a.locid = ".$locid."
                                   ";
                        $resqry = $db->ObjectBuilder()->rawQuery ($qryloc);
                        foreach ($resqry as $xkey => $xvalue) 
                        {
                          $vnomprov = $xvalue->pcianombre;
                          $vnompais = $xvalue->paisnombre;
                        }
                        $result_array=array("stat"=>"OK","vnomprov"=>$vnomprov,"vnompais"=>$vnompais);
                        echo json_encode($result_array);
                     return;
                     exit(0);
        }             
   }             
?>
