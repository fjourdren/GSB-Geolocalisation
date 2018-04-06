<?php


include "PHP/connectAD.php";
//compte admin unique

?>





<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>   


<title>GSB</title>

<link href="CSS/design.css" rel="stylesheet" type="text/css" />
<link href="../CSS/design.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body class="fondindex" >

		<!--       -------------HEADER-----------------          -->
	<div class="container-fluid">
		<div class="row" id="bandeau">
				<div class="col-md-2">
					<div id="logo">
						<img class="image" src="IMG/logo.png" height="175px" width="250px"></img>
					</div>
				</div>
				
				<div class="col-md-3">
					<h2 class="username"><?php echo "Connect&eacute; : " .$username;?></h2>
				</div>
				
				<div class="col-md-4">
					<h1 class="titre">Authentification</h1>
				</div>
				
		  </div>
	
		  
		  	<hr class="hraffiche"/>

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