<?php
	function createPath($path) {
	    if (is_dir($path)) return true;
	    $prev_path = substr($path, 0, strrpos($path, '/', -2) + 1 );
	    $return = createPath($prev_path);
	    return ($return && is_writable($prev_path)) ? mkdir($path) : false;
	}
	function createPathImage($path){
		if (is_dir($path)) return true;
		    $path1 = $path .'/16x16';
		    $prev_path = substr($path, 0, strrpos($path.'/', '/', -2) + 1 );
		    $return = createPath($prev_path);
		    return ($return && is_writable($prev_path)) ? mkdir($path) : false;
	}
	function rfqsendmail($mail,$email='',$Subject='',$msj='',$fpath='',$encod='',$typ=''){
			$mail->IsSMTP();
			$mail->SMTPDebug  = 0;
			$mail->Host       = 'smtp.gmail.com';
			$mail->Port       = 587;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPAuth   = true;
			//$mail->Username   = "csr@sharksportswear.com";
			//$mail->Password   = "Shark2016";
			$mail->Username   = "dnores@gmail.com";
			$mail->Password   = "Pa55W0rd4u";
			$mail->SetFrom('dnores@gmail.com', 'Daniel Nores');
			$mail->AddReplyTo('dnores@gmail.com', 'Daniel Nores');

            $mref=strpos(trim($email),"+");
            if ($mref !== false)
            {
             $vemail = explode('+',$email);
			 for($i=0;$i<=(count($vemail)-1);$i++){
                 $cemail = explode('|',$vemail[$i]);
                 if($i==0){$mail->AddAddress($cemail[0], $cemail[1]);}
                 else {$mail->addBCC($cemail[0], $cemail[1]);}
             }
            } else {
              $uemail = explode('|',$email);
              $mail->AddAddress($uemail[0], $uemail[1]);
            }
			$mail->Subject = $Subject;
            if(strlen(trim($fpath)) > 0){
               $fref=strpos(trim($fpath),"|");
               if ($fref !== false)
               {
                $xfpath = explode('|',$fpath);
                $mail->AddAttachment($xfpath[0], '', $encoding = $encod, $type = $typ);
                $mail->AddAttachment($xfpath[1], '', $encoding = $encod, $type = $typ);
               } else {
                $mail->AddAttachment($fpath, '', $encoding = $encod, $type = $typ);
               }
            }
			$mail->MsgHTML($msj);
			$mail->AltBody = 'This is a plain-text message body';
			if(!$mail->Send()) {
			  return "Error: " . $mail->ErrorInfo;
			} else {
			  return "Enviado!";
			}
	}
	function ackOrder($vendor,$orderId,$type,$key){
		//return md5($vendor.$orderId.$weight.$format.$key);
	}
	function listUpdateOrder($vendor,$key){
		//return md5($vendor.$orderId.$weight.$format.$key);
	}
	function listOrderMessages($vendor,$key){
		//return md5($vendor.$orderId.$weight.$format.$key);
	}
?>
