<?php

     if(isset($_POST['t'])){
		if($_POST['t'] == 'savenewciva'){
                     $civanom=$_POST['civanom'];
                     $datciva = Array ("desccond" => $civanom   );
                     $civaid = $db->insert ('condiva', $datciva);
                     $result_array = array('civaid'=>$civaid);
                     echo json_encode($result_array);
                     return;
                     exit(0);
        }             
		if($_POST['t'] == 'saveupdciva'){
                     $civaid = $_POST['civaid'];
                     $civanom=$_POST['civanom'];
                     $datciva = Array ("desccond" => $civanom   );
                     $db->where ('condiva', $civaid);
                     $upda = $db->update ('condiva', $datciva);
                     $result_array = array('civaid'=>$civaid);
                     echo json_encode($result_array);
                     return;
                     exit(0);
        }             
		if($_POST['t'] == 'editciva'){
			$civaid=$_POST["civaid"];
            $vcatdel = '';
            $vscdel = '';
            $vrow = 1;
//SELECT condiva, desccond FROM condiva WHERE 1
                        $civaqry="SELECT condiva, desccond 
                                    FROM condiva 
                                   WHERE condiva =".$civaid." 
                                 ";
                        $civares = $db->ObjectBuilder()->rawQuery ($civaqry);
                        foreach ($civares as $rkey => $rvalue) 
                        {
                            $desccond = $rvalue->desccond;
                        }
			$result_array=array("desccond"=>$desccond);
			echo json_encode($result_array);
                     return;
                     exit(0);
        }             
		if($_POST['t'] == 'deleciva'){
                        $civaid=$_POST["civaid"];
                        $db->ObjectBuilder()->rawQuery ("DELETE FROM condiva WHERE condiva = ".$civaid." ");
                        $result_array=array("stat"=>"OK");
                        echo json_encode($result_array);
                     return;
                     exit(0);
        }             
   }             
?>
