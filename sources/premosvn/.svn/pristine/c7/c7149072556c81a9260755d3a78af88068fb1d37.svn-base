<?php

     if(isset($_POST['t'])){
		if($_POST['t'] == 'addscitem'){
                     $reng=$_POST['newrow'];
                     $vresu='<td id="dtddel-'.$reng.'"><a href="javascript:void(0)" onclick="showpdelalert(0,'.$reng.')"><i class="fa fa-trash-o" aria-hidden="true" style="font-size:20px;color:#FF0000"></i></a></td>
                              <td id="sctdnom-'.$reng.'"><input class="form-control" style="width:400px;" name="scnom-'.$reng.'" id="scnom-'.$reng.'" type="text"  value=""></td>
                              <td></td>
                              <td></td>';
                     $result_array = array('resu'=>$vresu);
                     //printf(json_encode($result_array));
                     echo json_encode($result_array);
                     return;
                     exit(0);
        }             
		if($_POST['t'] == 'savenewcateg'){
                     $catnom=$_POST['catnom'];
                     $dataitem=$_POST['dataitem'];
                     $datcateg = Array ("categdescr" => $catnom   );
                     $catid = $db->insert ('categorias', $datcateg);

                     $scitem=explode('|',$dataitem);
                     for($i=0;$i<count($scitem)-1;$i++){
                        if(strlen(trim($scitem[$i]))<>0)
                        {
                         $datai = Array ("categid" => $catid,
                                         "scdescr" => $scitem[$i]
                                        );
                         $wid = $db->insert ('subcateg', $datai);
                        }
                     }

                     $result_array = array('catid'=>$catid);
                     //printf(json_encode($result_array));
                     echo json_encode($result_array);
                     return;
                     exit(0);
        }             
		if($_POST['t'] == 'saveupdcat'){
                     $catid = $_POST['catid'];
                     $catnom=$_POST['catnom'];
                     $dataitem=$_POST['dataitem'];
                     $datcateg = Array ("categdescr" => $catnom   );
                     $db->where ('categid', $catid);
                     $upda = $db->update ('categorias', $datcateg);
                     $db->ObjectBuilder()->rawQuery ("DELETE FROM subcateg WHERE categid = ".$catid." ");

                     $scitem=explode('|',$dataitem);
                     for($i=0;$i<count($scitem)-1;$i++){
                        if(strlen(trim($scitem[$i]))<>0)
                        {
                         $scdata = explode(':',$scitem[$i]);

                         $datau = Array ("categid" => $catid,
                                         "sctid" => $scdata[0],
                                         "scdescr" => $scdata[1]
                                        );
                         $wid = $db->insert ('subcateg', $datau);
/*
                         $datau = Array ("scdescr" => $scdata[1]);
                         $db->where ('categid', $catid);
                         $db->where ('sctid', $scdata[0]);
                         $updb = $db->update ('subcateg', $datau);
*/
                        }
                     }

                     $result_array = array('catid'=>$catid);
                     //printf(json_encode($result_array));
                     echo json_encode($result_array);
                     return;
                     exit(0);
        }             
		if($_POST['t'] == 'editcateg'){
			$catid=$_POST["catid"];
            $vcatdel = '';
            $vscdel = '';
            $vrow = 1;
//SELECT categid, categdescr FROM categorias WHERE 1
                        $catqry="SELECT categid, categdescr, fgetcantcat(categid,0) as canti 
                                   FROM categorias 
                                  WHERE categid =".$catid." 
                                 ";
                        $catres = $db->ObjectBuilder()->rawQuery ($catqry);
                        foreach ($catres as $rkey => $rvalue) 
                        {
                            $categdescr = $rvalue->categdescr;
                            if($rvalue->canti == 0){    
                                $vcatdel = '<a href="javascript:void(0);" onclick="delecateg('.$catid.');" title="Delete"><i class="fa fa-trash-o" aria-hidden="true" style="font-size:20px;color:#FF0000"></i></a>';
                            }
                        }
//SELECT categid, sctid, scdescr FROM subcateg WHERE 1			
                        $scqry="SELECT categid, sctid, scdescr, fgetcantcat(categid, sctid) as cantisc 
                                  FROM subcateg 
                                 WHERE categid = ".$catid."
                                 ORDER BY categid, sctid
                               ";
                        $vresu='';
                        $detres = $db->ObjectBuilder()->rawQuery ($scqry);
                        foreach ($detres as $sckey => $scvalue) 
                        {
                             $vscdel = '';
                             $vrow = $vrow +1;
                             $reng=$scvalue->sctid;
                             if($scvalue->cantisc == 0){    
                                $vscdel = '<a href="javascript:void(0)" onclick="showpdelalert('.$catid.','.$reng.')"><i class="fa fa-trash-o" aria-hidden="true" style="font-size:20px;color:#FF0000"></i></a>';
                             }
                             $vresu.='<tr id="sctr-'.$reng.'" class="sctritems"><td id="dtddel-'.$reng.'">'.$vscdel.'</td>
                                      <td id="sctdnom-'.$reng.'"><input class="form-control" style="width:400px;" name="scnom-'.$reng.'" id="scnom-'.$reng.'" type="text"  value="'.$scvalue->scdescr.'"></td>
                                      <td></td>
                                      <td></td></tr>';
                        }
			$result_array=array("vresu"=>$vresu,"categdescr"=>$categdescr,"vcatdel"=>$vcatdel,"reng"=>$vrow );
			echo json_encode($result_array);
                     return;
                     exit(0);
        }             
		if($_POST['t'] == 'delecateg'){
                        $catid=$_POST["catid"];
                        $db->ObjectBuilder()->rawQuery ("DELETE FROM subcateg WHERE categid = ".$catid." ");
                        $db->ObjectBuilder()->rawQuery ("DELETE FROM categorias WHERE categid = ".$catid." ");
                        $result_array=array("stat"=>"OK");
                        echo json_encode($result_array);
                     return;
                     exit(0);
        }             
		if($_POST['t'] == 'delscitem'){
                        $catid=$_POST["catid"];
                        $scid=$_POST["scid"];
                        $db->ObjectBuilder()->rawQuery ("DELETE FROM subcateg WHERE categid = ".$catid." AND sctid = ".$scid." ");
                        $result_array=array("stat"=>"OK");
                        echo json_encode($result_array);
                     return;
                     exit(0);
        }             
		if($_POST['t'] == 'delscitem'){
                        $catid=$_POST["catid"];
                        $scid=$_POST["scid"];
                        $db->ObjectBuilder()->rawQuery ("DELETE FROM subcateg WHERE categid = ".$catid." AND sctid = ".$scid." ");
                        $result_array=array("stat"=>"OK");
                        echo json_encode($result_array);
                     return;
                     exit(0);
        }             
   }             
?>
