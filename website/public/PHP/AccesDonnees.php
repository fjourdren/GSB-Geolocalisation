<?php
/**
 *  Bibliotheque de fonctions AccesDonnees.php
*
*
*
* @author Erwan
* @copyright Estran
* @version 1.2.1 Mercredi 8 Fevrier 2017
*
* creation de la fonction AfficheRequete
* creation de la focntion nombreChamp
* creation de la fonction typeChamp
* creation de la fonction ligneSQL
*

*/


$modeacces = "mysqli";


$mysql_data_type_hash = array(
		1=>'tinyint',
		2=>'smallint',
		3=>'int',
		4=>'float',
		5=>'double',
		7=>'timestamp',
		8=>'bigint',
		9=>'mediumint',
		10=>'date',
		11=>'time',
		12=>'datetime',
		13=>'year',
		16=>'bit',
		//252 is currently mapped to all text and blob types (MySQL 5.0.51a)
		252=>'blob',
		253=>'string',
		254=>'string',
		246=>'decimal'
);





/**
 *
 * Ouvre une connexion a un serveur MySQL ou ORACLE et selectionne une base de donnees.
 * @param host string
 *  <p>Adresse du serveur MySQL.</p>
 * @param port integer
 *  <p>Numero du port du serveur MySQL.</p>
 * @param dbname string
 *  <p>Nom de la base de donnees.</p>
 * @param user string
 *  <p>Nom de l'utilisateur.</p>
 * @param password string
 *  <p>Mot de passe de l'utilisateur.</p>
 *
 *
 * @return resource - Retourne l'identifiant de connexion MySQL en cas de succes
 *         ou FALSE si une erreur survient.
 */
function connexion($host, $port, $dbname, $user, $password) {

	global $modeacces, $connexion;


	if ($modeacces == "mysql") {

		@$link = mysql_connect($host,$user,$password)
		or die("Impossible de se connecter : ".mysql_error());

		@$connexion = mysql_select_db($dbname)
		or die("Impossible d'ouvrir la base : ".mysql_error());

		return $connexion;

	}


	if ($modeacces == "mysqli") {

		$connexion = new mysqli("$host", "$user", "$password", "$dbname", $port);

		if ($connexion->connect_error) {
			die('Erreur de connexion (' . $connexion->connect_errno . ') '. $connexion->connect_error);
		}

		return $connexion;

	}


}



/**
 *
 * Ferme la connexion MySQL.
 *
 */
function deconnexion() {

	global $modeacces, $connexion;


	if ($modeacces == "mysql") {

		mysql_close();

	}


	if ($modeacces == "mysqli") {

		$connexion->close();

	}
}



/**
 *
 *Envoie une requete a un serveur MySQL.
 * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 * @return resource - Pour les requetes du type SELECT, SHOW, DESCRIBE, EXPLAIN et
 *          les autres requetes retournant un jeu de resultats, mysql_query()
 *          retournera une ressource en cas de succes, ou DIE en cas d'erreur.
 *
 *          Pour les autres types de requetes, INSERT, UPDATE, DELETE, DROP, etc.,
 *          mysql_query() retourne TRUE en cas de succes ou DIE en cas d'erreur.
 */
function executeSQL($sql) {

	global $modeacces, $connexion;

	if ($modeacces=="mysql") {
		@$result = mysql_query($sql)
		or die ("Erreur SQL de <b>".$_SERVER["SCRIPT_NAME"]."</b>.<br />
			 Dans le fichier : ".__FILE__." a la ligne : ".__LINE__."<br />".
				mysql_error().
				"<br /><br />
				<b>REQUETE SQL : </b>$sql<br />");
				return $result;
	}

	if ($modeacces=="mysqli") {
		$result = $connexion->query($sql)
		or die ("Erreur SQL de <b>".$_SERVER["SCRIPT_NAME"]."</b>.<br />
			 Dans le fichier : ".__FILE__." a la ligne : ".__LINE__."<br />".
				mysqli_error_list($connexion)[0]['error'].      //$mysqli->error_list;
				"<br /><br />
				<b>REQUETE SQL : </b>$sql<br />");
				return $result;
	}
}

function executeSQL1($sql) {

	global $modeacces, $connexion;

	if ($modeacces=="mysql") {
		@$result = mysql_query($sql);
		return $result;
	}

	if ($modeacces=="mysqli") {
		$result = $connexion->query($sql);
		return $result;
	}
}


/**
 *
 *Envoie une requete a un serveur MySQL laisse le programmeur Gerer les Erreurs.
 * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 * @return resource - Pour les requetes du type SELECT, SHOW, DESCRIBE, EXPLAIN et
 *          les autres requetes retournant un jeu de resultats, mysql_query()
 *          retournera une ressource en cas de succes, ou FALSE en cas d'erreur.
 *
 *          Pour les autres types de requetes, INSERT, UPDATE, DELETE, DROP, etc.,
 *          mysql_query() retourne TRUE en cas de succes ou FALSE en cas d'erreur.
 */
function executeSQL_GE($sql) {

	global $modeacces, $connexion;

	if ($modeacces=="mysql") {
		@$result = mysql_query($sql);
	}

	if ($modeacces=="mysqli") {
		$result = $connexion->query($sql);
	}
	return $result;
}



/**
 *
 *Retourne le nombre de lignes d'une requete MySQL.
 * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 * @return integer - Le nombre de lignes dans un jeu de resultats en cas de succes
 *         ou FALSE si une erreur survient.
 */
function compteSQL($sql) {

	global $modeacces, $connexion;

	$result = executeSQL($sql);

	if ($modeacces=="mysql") {
		$num_rows = mysql_num_rows($result);
	}

	if ($modeacces=="mysqli") {

		$num_rows = $connexion->affected_rows;
	}

	return $num_rows;

}



/**
 *
 *Retourne un tableau resultat d'une requete SQL
 * @param $sql string
 * 		<p>Requete SQL</p>
 *
 * @return array Tableau indexe et associatif resultat de la requete SQL
 *
 * <br/>
 * @example
 <code>
 $sql = "select * from user";				<br />
 $results = tableSQL($sql);					<br />
 foreach ($results as $row) {				<br />
 &nbsp;&nbsp;$login = $row['login'];		<br />
 &nbsp;&nbsp;$password = $row[3];			<br />
 &nbsp;&nbsp;echo $login." ".$password; 	<br />
 }											<br />
 </code>
 */
function tableSQL($sql) {

	global $modeacces, $connexion;

	$result = executeSQL($sql);
	$rows=array();

	if ($modeacces=="mysql") {
		while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
			array_push($rows,$row);
		}
	}

	if ($modeacces=="mysqli") {
		while ($row = $result->fetch_array(MYSQLI_BOTH)) {
			array_push($rows,$row);
		}
	}

	return $rows;

}



/**
 *
 *Retourne un seul champ resultat d'une requete MySQL.
 * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 * @return string - une chaine resultat de la requete MySQL.
 */
function champSQL($sql) {

	global $modeacces, $connexion;

	$result = executeSQL($sql);

	if ($modeacces=="mysql") {
		$rows = mysql_fetch_array($result, MYSQL_NUM);
	}


	if ($modeacces=="mysqli") {
		$rows = $result->fetch_array(MYSQLI_NUM);

	}

	return $rows[0];
}



/**
 *
 *Affiche sous forme d'un tableau le resultat d'une requette SQL
 * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 */
function afficheRequete($sql) {

	$results = tableSQL($sql);

	$nbchamps = nombreChamp($sql);

	echo "<table style=\"border: 2px solid blue; border-collapse: collapse; \">";
	echo "   <caption style=\"color:green;font-weight:bold\">$sql</caption>
	<tr style=\"border: 2px solid blue; border-collapse: collapse; \" >";
	for ($i=0;$i<$nbchamps;$i++) {
		echo "<th style=\"border: 2px solid blue; border-collapse: collapse; \">".nomChamp($sql,$i)."(".typeChamp($sql,$i).")</th>";
	}
	echo "   </tr>";

	foreach ($results as $ligne) {
		echo "<tr style=\"border: 1px solid red; border-collapse: collapse; \">";
		//on extrait chaque valeur de la ligne courante
		for ($i=0;$i<$nbchamps;$i++) {
			echo "<td style=\"border: 1px solid red; border-collapse: collapse; \">".$ligne[$i]."</td>";
		}
		echo "</tr>";
	}

	echo "</table>";
}



/**
 *
 *Retourne le nombre de champs d'une requete MySQL
 * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 * @return integer - Retourne le nombre de champs d'un jeu de resultat en cas de succes
 *         ou FALSE si une erreur survient.
 */
function nombreChamp($sql) {

	global $modeacces, $connexion;


	$result = executeSQL($sql);

	if ($modeacces=="mysql") {
		return mysql_num_fields($result);
	}

	if ($modeacces=="mysqli") {
		return  $result->field_count;
	}

}



/**
 *
 *Retourne le type d'une colonne MySQL specifique
 * @param sql string
 *  <p>Requete SQL.</p>
 * @param field_offset integer
 *  <p>La position numerique du champ. field_offset commence a  0. Si field_offset
 *     n'existe pas, une alerte E_WARNING sera egalement generee.</p>
 *
 *
 * @return string - Retourne le type du champ retourne peut etre : "int", "real", "string", "blob"
 *         ou d'autres, comme detaille Â» dans la documentation MySQL.
 *
 */
function typeChamp($sql, $field_offset) {

	global $modeacces, $connexion, $mysql_data_type_hash, $typebase;

	$result = executeSQL($sql);

	if ($modeacces=="mysql") {
		return mysql_field_type($result, $field_offset);
	}

	if ($modeacces=="mysqli") {
		return  $mysql_data_type_hash[$result->fetch_field_direct($field_offset)->type];
	}

}



/**
 *
 *Retourne le nom d'une colonne MySQL specifique
 * @param sql string
 *  <p>Requete SQL.</p>
 * @param field_offset integer
 *  <p>La position numerique du champ. field_offset commence a  0. Si field_offset
 *     n'existe pas, une alerte E_WARNING sera egalement generee.</p>
 *
 *
 * @return string - Retourne le nom du champ d'une colonne specifique
 *
 */
function nomChamp($sql, $field_offset) {

	global $modeacces, $connexion, $mysql_data_type_hash;

	$result = executeSQL($sql);

	if ($modeacces=="mysql") {
		return mysql_field_name($result, $field_offset);
	}

	if ($modeacces=="mysqli") {
		$infos = $result->fetch_field_direct($field_offset);
		return $infos->name;
	}

}



/**
 *
 *Retourne un seule ligne resultat d'une requete SQL
 * @param $sql string
 *  	<p>Requete SQL</p>
 *
 * @return array Tableau indexe et associatif representant la ligne
 *
 * <br/>
 * @example
 <code>
 $sql = "select * from user where numero = 1 "; <br />
 $results = ligneSQL($sql);						<br /><br />
 $login = $row['login'];						<br />
 $password = $row[3];							<br />
 echo $login." ".$password;						<br />
 </code>
 */
function ligneSQL($sql) {

	global $modeacces, $connexion;

	$result = executeSQL($sql);

	if ($modeacces=="mysql") {
		$rows = mysql_fetch_array($result, MYSQL_NUM);
	}

	if ($modeacces=="mysqli") {
		$rows = $result->fetch_array(MYSQLI_NUM);
	}

	return $rows;
}

function fixdate($date) {
    return date('d-m-Y', strtotime($date));
}


function affichage($sql) {
	$rows = compteSQL($sql);
		$nombrevisiteur = compteSQL($sql);
		$resultat = tableSQL($sql);


		echo "<table border=1>";
		echo "<thead>
		    <tr>
		    	<th>March&eacute;</th>
		    	<th>Nom Soci&eacute;t&eacute;</th>
				<th>Nom</th>
				<th>Pr&eacute;nom</th>
				<th>Type</th>
				<th>Sous-type</th>
				<th>Date de la demande</th>
				<th>D&eacute;but validit&eacute;</th>
				<th>Fin de validit&eacute; </th>
				<th>Date de retrait </th>
				<th>Fin de validite </th>
				<th>Date envoie DCE vers DSSF;</th>
				<th>Prise en compte de la DCE </th>
				<th>Num CE ou Habilitation</th>
				<th>Validit CE ou Habilitation</th>
				<th>Scan du badge</th>
				<th>INTERDICTIONS</th>
				<th>Observations </th>
				<th>Modif</th>
				<th>Suppr</th>
			</tr>
		  </thead>
		  <tbody>";
		
		
		$compteur=0;
		
		if ($nombrevisiteur>0) {
		
			foreach ($resultat as $ligne) {
			
			//on extrait chaque valeur de la ligne courante
			$idVisiteur     	= $ligne[0];
			$marcher        	= $ligne[1];
			$NomSociete  		= $ligne[2];
			$Nom 		  		= $ligne[3];
			$Prenom 	  		= $ligne[4];
			$Type      			= $ligne[5];
			$SousType     		= $ligne[6];
			$DateDemander   	= $ligne[7];
			$DebutValidite  	= $ligne[8];
			$FinValidite    	= $ligne[9];
			$DateRetrait    	= $ligne[10];
			$FinValitite2   	= $ligne[11];
			$DateEnvoieDCE  	= $ligne[12];
			$DatePriseDCE   	= $ligne[13];
			$NumDCEorHab    	= $ligne[14];
			$ValiditDCEorHAB	= $ligne[15];
			$ScanBadge      	= $ligne[16];
			$Interdiction     	= $ligne[17];
			$Observations      	= $ligne[18];
			


			$compteur++;
			if ($compteur %2 == 0) 
				echo "<tr id=\"fonce\">"; 
			else 
				echo "<tr>";
			

			/*Affiche les valeurs récuperer dans la base de donner dans le tableau*/
			
			// nom du marché
			echo "<td>".$marcher."</td>";
			
			//nom de la société
			echo "<td>".$NomSociete."</td>";
			
			// nom de la personne
			echo "<td>".$Nom."</td>";
			
			// prénom de la personne
			echo "<td>".$Prenom."</td>";

			// type de badge
			echo "<td>".$Type."</td>";

			// sous type du badge
			echo "<td>".$SousType."</td>";


			/* date de demande */
			/* Si la date est vide affiché du blanc, sinon affiché la date en Jour-Mois-Année */
			if ($DateDemander == 0000-00-00) {
				echo "<td> </td>";
			}
			else
				echo "<td>".$sqldate=date('d-m-Y',strtotime($DateDemander))."</td>";



			/*debut de la validite */
			if ($DebutValidite == 0000-00-00) {
				echo "<td> </td>";
			}
			else
				echo "<td>".$sqldate=date('d-m-Y',strtotime($DebutValidite))."</td>";



			/*fin de la validite */
			if ($FinValidite == 0000-00-00) {
				echo "<td> </td>";
			}
			else
				echo "<td>".$sqldate=date('d-m-Y',strtotime($FinValidite))."</td>";



			/* Affiche le debut du Retrait */
			if ($DateRetrait == 0000-00-00) {
				echo "<td> </td>";
			}
			else
				echo "<td>".$sqldate=date('d-m-Y',strtotime($DateRetrait))."</td>";


			/* Affiche le debut de la validite2 */
			if ($FinValitite2 == 0000-00-00) {
				echo "<td> </td>";
			}
			else
				echo "<td>".$sqldate=date('d-m-Y',strtotime($FinValitite2))."</td>";



			/*  Envoie a la DCE */
			if ($DateEnvoieDCE == 0000-00-00) {
				echo "<td> </td>";
			}
			else
				echo "<td>".$sqldate=date('d-m-Y',strtotime($DateEnvoieDCE))."</td>";


			/* Prise en compte de la DCE */
			if ($DatePriseDCE == 0000-00-00) {
				echo "<td> </td>";
			}
			else
				echo "<td>".$sqldate=date('d-m-Y',strtotime($DatePriseDCE))."</td>";

			/* Numero DCE ou de lhabilitation */
			echo "<td>".$NumDCEorHab."</td>";

			/* Validité DCE ou Habilitation */
			echo "<td>".$ValiditDCEorHAB."</td>";

			/* Scan du badge */
			echo "<td>".$ScanBadge."</td>";

			/* Interdictions */
			echo "<td>".$Interdiction."</td>";

			/* Prise en compte de la DCE */
			echo "<td>".$Observations."</td>";




			/*Bouton pour Modifier*/
			echo "<td> 
				<a onclick=\"if(!confirm('Voulez-vous Modifier ?')) return false;\" 
				href=\"ModifierPersonneBREST.php?id=$idVisiteur\">
				<img src=\"pictures/modif.png\" width=\"25\" height=\"25\" /></a></td>";
			/*Bouton pour Supprimer*/
			echo "<td> 
				<a onclick=\"if(!confirm('Voulez-vous Supprimer ?')) return false;\" 
				href=\"SupprimerPersonneBREST.php?id=$idVisiteur\"> 
				<img src=\"pictures/delete.png\" width=\"30\" height=\"30\" /></a></td>";

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
}

?>