<?php
	include ("../../Util/UtilLogin.php");

	session_start();

	if((!empty($_POST['username']))&&(!empty($_POST['password']))){
		$uL = new UtilLogin();

		echo $_POST['username'], $_POST['password'];

		$utente = $uL->getUser($_POST['username'], $_POST['password']);

		if($utente){
			$_SESSION['ruolo'] = $utente['Ruolo'];
			$_SESSION['id'] = $utentet['idAccount'];

			$a = array("esito"=>"ok");
			echo json_encode($a);
		}else{
			$a = array("esito"=>"passworderrata");
			echo json_encode($a);
		}
		
	}
?>