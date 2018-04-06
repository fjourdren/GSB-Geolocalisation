<?php

	include "AccesDonnees.php";
	$username=shell_exec("echo %username%" );
	$ip=explode(".",$_SERVER['SERVER_ADDR']);

	switch ($ip[0]) {
		
	    case 127 :
	
			
		case 192 :
			//local
			$host = "127.0.0.1";
			$user = "root";
			$password = "";
			$dbname = "crudajaxx";
			$port='3306';
			break;
	    
		default :
			exit ("Serveur non reconnu...");
			break;
	}
	
	$connexion=connexion($host,$port,$dbname,$user,$password);

	
?>

