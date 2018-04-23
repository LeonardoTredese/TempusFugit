<?php
	include ("../../Util/UtilStudente.php");
	include ("../../Util/UtilSUDO.php");
    session_start();

    if(isset($_SESSION['ruolo'])){
        if($_SESSION['ruolo'] == 's'){
			$uSt = new UtilStudente();
			$adm = new UtilSUDO();
			$resu= $adm->getAllCorsi();
			$retu = $resu->fetch_assoc();
			$result = $uSt->getCorsiIscritto($_SESSION['id']);
			$return = $result->fetch_assoc();
			$uSt->close();
			if($result){
				$return = $result->fetch_assoc();
				echo json_encode(array_merge(array("esito"=> "ok"), $return));
			}else{
				$a = array('esito' => 'dberror');
				echo json_encode($a);
			}
        }else{
            $a = array('esito' => 'roleerror');
			echo json_encode($a);
        }//if-else
    }else{
        $a = array('esito' => 'notlogged');
		echo json_encode($a);
    }//if-else
?>
