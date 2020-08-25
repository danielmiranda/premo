<?php

     if(isset($_POST['t'])){
		if($_POST['t'] == 'savenewart'){
                     $descrartic=$_POST['descrartic'];
                     $stockmin= isset($_POST['stockmin']) ? $_POST['stockmin'] : 0; //DMI 20200824
                     $codprov=$_POST['codprov'];
                     $codarticulo=$_POST['codarticulo'];
                     $icateg=$_POST['icateg'];
                     $isubcat=$_POST['isubcat'];
                     $iunidcpra=$_POST['iunidcpra'];
                     $iconscapt=$_POST['iconscapt'];
                     $iunideq=$_POST['iunideq'];
                     $istkunid=$_POST['istkunid'];
                     $diasrecu=$_POST['diasrecu'];
                     $recumarg=$_POST['recumarg'];
                     $iprecart=$_POST['iprecart'];

                     if( $codarticulo == ''){
                      $codarticulo = 0;
                     }
                     
                     $datartic = Array ("descrartic" => $descrartic,
                                        "stockmin" => $stockmin,
                                        "art_cod_prov" => $codprov,
                                        "codarticulo" => $codarticulo,
                                        "categid" => $icateg,
                                        "sctid" => $isubcat,
                                        "art_cons_capt" => $iconscapt,
                                        "art_unid" => $iunidcpra,
                                        "art_equiv" => $iunideq,
                                        "stk_unid" => $istkunid,
                                        "art_dias_recup" => $diasrecu,
                                        "art_recup_marg" => $recumarg,
                                        "precart" => $iprecart
                                       );
                     $artid = $db->insert ('articulos', $datartic);

                     $result_array = array('artid'=>$artid);
                     echo json_encode($result_array);
                     return;
                     exit(0);
        }             
		if($_POST['t'] == 'saveupdart'){
                     $codartid=$_POST['codartid'];
                     $descrartic=$_POST['descrartic'];
                     $stockmin= isset($_POST['stockmin']) ? $_POST['stockmin'] : 0; //DMI 20200824
                     $codprov=$_POST['codprov'];
                     $codarticulo=$_POST['codarticulo'];
                     $icateg=$_POST['icateg'];
                     $isubcat=$_POST['isubcat'];
                     $iunidcpra=$_POST['iunidcpra'];
                     $iconscapt=$_POST['iconscapt'];
                     $iunideq=$_POST['iunideq'];
                     $istkunid=$_POST['istkunid'];
                     $diasrecu=$_POST['diasrecu'];
                     $recumarg=$_POST['recumarg'];
                     $iprecart=$_POST['iprecart'];
                     $datartic = Array ("descrartic" => $descrartic,
                                        "stockmin" => $stockmin,
                                        "art_cod_prov" => $codprov,
                                        "codarticulo" => $codarticulo,
                                        "categid" => $icateg,
                                        "sctid" => $isubcat,
                                        "art_cons_capt" => $iconscapt,
                                        "art_unid" => $iunidcpra,
                                        "art_equiv" => $iunideq,
                                        "stk_unid" => $istkunid,
                                        "art_dias_recup" => $diasrecu,
                                        "art_recup_marg" => $recumarg,
                                        "precart" => $iprecart
                                       );
                     $db->where ('codartid', $codartid);
                     $upda = $db->update ('articulos', $datartic);
                     $result_array = array('codartid'=>$codartid);
                     echo json_encode($result_array);
                     return;
                     exit(0);
        }             
		if($_POST['t'] == 'editart'){
			$codartid=$_POST["codartid"];
            $vcatdel = '';
            $vscdel = '';
            $vrow = 1;
                        $artqry="SELECT codartid, categid, sctid, descrartic, precart, stockart, stockmin, art_unid, art_equiv, stk_unid, 
                                        art_cons_capt, art_dias_recup, art_recup_marg, art_cod_prov , codarticulo
                                   FROM articulos 
                                  WHERE codartid =".$codartid." 
                                 ";
                        $arttres = $db->ObjectBuilder()->rawQuery ($artqry);
                        foreach ($arttres as $rkey => $rvalue) 
                        {
                            $categid = $rvalue->categid;
                            $sctid = $rvalue->sctid;
                            $descrartic = $rvalue->descrartic;
                            $precart = $rvalue->precart;
                            $stockart = $rvalue->stockart;
                            $stockmin = $rvalue->stockmin;
                            $art_unid = $rvalue->art_unid;
                            $art_equiv = $rvalue->art_equiv;
                            $stk_unid = $rvalue->stk_unid;
                            $art_cons_capt = $rvalue->art_cons_capt;
                            $art_dias_recup =$rvalue->art_dias_recup;
                            $art_recup_marg =$rvalue->art_recup_marg;
                            $art_cod_prov =$rvalue->art_cod_prov;
                            $codarticulo =$rvalue->codarticulo;
                        }

                        $qrysel = "SELECT categid, categdescr FROM categorias ORDER BY categdescr ";
                        $vdatac='';    
                        $vicateg='<select name="icateg" id="icateg" class ="select2" style="width:200px" onchange="selicateg(this.value)">';
                        $vicateg.='<option value="0">Categorias</option>';
                        $resqry = $db->ObjectBuilder()->rawQuery ($qrysel);
                        foreach ($resqry as $ckey => $cvalue) 
                        {
                          $vdatac='';    
                          if($cvalue->categid == $categid){$vdatac=' selected="selected" ';}    
                          $vicateg.='<option value="'.$cvalue->categid.'"'.$vdatac.'>'.$cvalue->categdescr.'</option>';
                        }
                        $vicateg.='</select>';

                        $qryscat = "SELECT categid, sctid, scdescr FROM subcateg WHERE categid = ".$categid." ";
                        $vsubcat='<select name="isubcat" id="isubcat" class ="select2" style="width:200px">';
                        $vsubcat.='<option value="0">Sub-Categorias</option>';
                        $resscat = $db->ObjectBuilder()->rawQuery ($qryscat);
                        foreach ($resscat as $skey => $svalue) 
                        {
                          $vdatac='';    
                          if($svalue->sctid == $sctid){$vdatac=' selected="selected" ';}    
                          $vsubcat.='<option value="'.$svalue->sctid.'"'.$vdatac.'>'.$svalue->scdescr.'</option>';
                        }
                        $vsubcat.='</select>';

                        $qryuni = "SELECT un_id, un_nom FROM unidades  ORDER BY un_nom ";
                        $viunidcpra='<select name="iunidcpra" id="iunidcpra" class ="select2" style="width:130px"><option value="0">Seleccione</option>';
                        $vistkunid='<select name="istkunid" id="istkunid" class ="select2" style="width:130px"><option value="0">Seleccione</option>';
                        $resuni = $db->ObjectBuilder()->rawQuery ($qryuni);
                        foreach ($resuni as $ukey => $uvalue) 
                        {
                          $vdatac='';    
                          if($uvalue->un_id == $art_unid){$vdatac=' selected="selected" ';}    
                          $viunidcpra.='<option value="'.$uvalue->un_id.'"'.$vdatac.'>'.$uvalue->un_nom.'</option>';
                          $vdatac='';    
                          if($uvalue->un_id == $stk_unid){$vdatac=' selected="selected" ';}    
                          $vistkunid.='<option value="'.$uvalue->un_id.'"'.$vdatac.'>'.$uvalue->un_nom.'</option>';
                        }
                        $viunidcpra.='</select>';
                        $vistkunid.='</select>';
                        $qrymin = "SELECT fgetinvavgdry(".$codartid.") AS consprom ";
                        $resmin = $db->ObjectBuilder()->rawQuery ($qrymin);
                        foreach ($resmin as $mkey => $mvalue) 
                        {
                          $consprom = $mvalue->consprom;
                        }
                        if($art_cons_capt > 0){
                            $stockmin = ($art_dias_recup+$art_recup_marg)*$art_cons_capt;
                        } else {
                            $stockmin = ($art_dias_recup+$art_recup_marg)*$consprom;
                        }
                        
			            $result_array=array("descrartic"=>$descrartic,
                                            "codartid"=>$codartid,
                                            "icateg"=>$vicateg,
                                            "isubcat"=>$vsubcat,
                                            "iconscapt"=>$art_cons_capt,
                                            "iunidcpra"=>$viunidcpra,
                                            "iunideq"=>$art_equiv,
                                            "istkunid"=>$vistkunid,
                                            "diasrecu"=>$art_dias_recup,
                                            "recumarg"=>$art_recup_marg,
                                            "iprecart"=>$precart,
                                            "stockmin"=>$stockmin,
                                            "consprom"=>$consprom,
                                            "vcodprov"=>$art_cod_prov,
                                            "codarticulo"=>$codarticulo,
                                            "stockart"=>$stockart
                                           );
			echo json_encode($result_array);
                     return;
                     exit(0);
        }             
		if($_POST['t'] == 'selcateg'){
                        $catid=$_POST["catid"];
                        $qrysel = "SELECT categid, sctid, scdescr FROM subcateg WHERE categid = ".$catid." ";
                        $vsubcat='<select name="qsubcat" id="qsubcat" class ="select2" style="width:200px" onchange="selsubcateg(this.value)">';
                        $vsubcat.='<option value="0">Sub-Categorias</option>';
                        $resqry = $db->ObjectBuilder()->rawQuery ($qrysel);
                        foreach ($resqry as $xkey => $xvalue) 
                        {
                          $vsubcat.='<option value="'.$xvalue->sctid.'">'.$xvalue->scdescr.'</option>';
                        }
                        $vsubcat.='</select>';
                        $result_array=array("stat"=>"OK","vsubcat"=>$vsubcat);
                        echo json_encode($result_array);
                     return;
                     exit(0);
        }             
		if($_POST['t'] == 'selicateg'){
                        $catid=$_POST["catid"];
                        $qrysel = "SELECT categid, sctid, scdescr FROM subcateg WHERE categid = ".$catid." ";
                        $vsubcat='<select name="isubcat" id="isubcat" class ="select2" style="width:200px" onchange="selsubcateg(this.value)">';
                        $vsubcat.='<option value="0">Sub-Categorias</option>';
                        $resqry = $db->ObjectBuilder()->rawQuery ($qrysel);
                        foreach ($resqry as $xkey => $xvalue) 
                        {
                          $vsubcat.='<option value="'.$xvalue->sctid.'">'.$xvalue->scdescr.'</option>';
                        }
                        $vsubcat.='</select>';
                        $result_array=array("stat"=>"OK","vsubcat"=>$vsubcat);
                        echo json_encode($result_array);
                     return;
                     exit(0);
        }   
        if($_POST['t'] == 'deleart'){
          $artid=$_POST["artid"];
          $db->ObjectBuilder()->rawQuery ("UPDATE articulos SET deleted = 1 WHERE codartid = ".$artid." ");
          $result_array=array("stat"=>"OK");
          echo json_encode($result_array);
       return;
       exit(0);
}             
   }             
?>
