<?php


include "PHP/connectAD.php";
//compte admin unique

?>





<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>   


<title>GSB</title>

<link href="CSS/design.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body class="fondindex" >

<div id="bandeau">
	<div id="logo">
		<img class="image" src="IMG/logo.png" height="155px" width="230px"></img>
		<h1>Authentification</h1>
		<hr class="hrmenu"></hr>
	</div>
</div>


<br />
<br />


       
       

<fieldset class="fieldsetconnexion">

	<legend align="center">Connexion</legend>

	<div id="erreur">	

<?php
//renvoie un message d'erreur si non vide
if(!empty($Message_D_Erreur)) {
	echo $Message_D_Erreur;
}
?>
</div>


	<form action="" method="POST">
	
			<input class="inputbasic" placeholder="Identifiant" name="nom_de_compte" id="nom_de_compte" value="" type="text" size="auto" />
			
			<br /><br/>
			
			<input class="inputbasic" placeholder="Mot de passe" name="mot_de_passe" id="mot_de_passe" value="" type="password" size="auto"/>
			
			<br /><br />

			<input id="validation" type="submit" class="connexionsubmit" value="Connexion"/>


    </form>


</fieldset> 