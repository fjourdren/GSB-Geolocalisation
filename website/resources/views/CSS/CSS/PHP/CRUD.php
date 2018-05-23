<?php 
include "connectAD.php";
$username=shell_exec("echo %username%" );
?>

<!DOCTYPE html>
<html>
<head>

<title>Utilisateurs</title>

<link href="../CSS/design.css" rel="stylesheet" type="text/css" />
	<link href="../CSS/design.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body class="fond">
<div id="fond">
				<!--       -------------HEADER-----------------          -->
	<div class="container-fluid">
		<div class="row" id="bandeau">
				<div class="col-md-2">
					<div id="logo">
						<img class="image" src="../IMG/logo.png" height="175px" width="250px"></img>
					</div>
				</div>
				
				<div class="col-md-4">
					<h2 class="username"><?php echo "Connect&eacute; : " .$username;?></h2>
				</div>
				
				<div class="col-md-5">
					<h1 class="titre">Gestion des utilisateurs</h1>
				</div>
				
				<div class="col-md-1">
					<a onclick="if(!confirm('Deconnexion ?')) return false;" href="../iindex.php"><img src="../IMG/logout.png" class="deconnexion" height="50px" width="50px"></img></a>
				</div>		
		  </div>
	
		  
		  	<hr class="hraffiche"/>

	</div>

<br />
<br />

<div id="erreur">
<?php
	if (isset($_GET['message']))
		echo $_GET['message'];
?>
</div>

<a href='#bandeauAffiche'><input type="button" id="le_bouton" value="^" ></a>




	<a href=""><input id="grandbouton" class="grandboutonaffiche1" type="button" value="Ajouter un utilisateur"/></a>
	<br>
	
	<a href="map.php"><input id="grandbouton" class="grandboutonaffiche2" type="button" value="Voir la map"/></a>

	



<?php


		
		$sql="SELECT * FROM user;";
		$rows = compteSQL($sql);
		$nombrevisiteur = compteSQL($sql);
		$resultat = tableSQL($sql);


		echo "<table border=1>";
		echo "<thead>
		    <tr>
		    	<th>Num&eacute;ro</th>
		    	<th>Login</th>
				<th>Password</th>
				<th>Email</th>
				<th>Modifer</th>
				<th>Supprimer</th>
		
		  </thead>
		  <tbody>";
		
		
		$compteur=0;
		
		if ($nombrevisiteur>0) {
		
			foreach ($resultat as $ligne) {
			
			//on extrait chaque valeur de la ligne courante
			$numero     	= $ligne[0];
			$login       	= $ligne[1];
			$password  		= $ligne[2];
			$email 		  		= $ligne[3];
		
			


			$compteur++;
			if ($compteur %2 == 0) 
				echo "<tr id=\"fonce\">"; 
			else 
				echo "<tr>";
			

			/*Affiche les valeurs récuperer dans la base de donner dans le tableau*/
			
			// nom du marché
				echo "<td>".$numero."</td>";
			
			//nom de la société
				echo "<td>".$login."</td>";
			
			// nom de la personne
				echo "<td>".$password."</td>";
			
			// prénom de la personne
				echo "<td>".$email."</td>";



			/*Bouton pour Modifier*/
			echo "<td> 
				<a onclick=\"if(!confirm('Voulez-vous Modifier ?')) return false;\" 
				href=\"ModifierPersonneBREST.php?id=$numero\">
				<img src=\"../IMG/modif.png\" width=\"25\" height=\"25\" /></a></td>";
			/*Bouton pour Supprimer*/
			echo "<td> 
				<a onclick=\"if(!confirm('Voulez-vous Supprimer ?')) return false;\" 
				href=\"SupprimerPersonneBREST.php?id=$numero\"> 
				<img src=\"../IMG/delete.png\" width=\"30\" height=\"30\" /></a></td>";

			echo "</tr>";
			
			}
		
		} else {
		
			echo "<tr>";
			
			echo "<td>Aucune information...</td>";
			
			echo "</tr>";
		
		}
		
		echo "</tbody>
		</table> ";

		/* Fin du tableau */


if(isset($_POST['affiche']) && !empty ($_POST['affiche'])){
	$sql="SELECT * FROM brest ORDER BY marche,nom_societe,nom";
		$affichage = affichageusers($sql);
		echo $affichage;
}

$resultat = "";
//TRAITEMENT DE LA REQUETE
?>

	</form>
	
</center>

<br />
<br />
</div>
</body>
</html>