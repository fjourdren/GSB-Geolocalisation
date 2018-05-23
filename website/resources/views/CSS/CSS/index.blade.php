@extends('layouts.app')
@section('content')

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

</div>


	<form action="" method="POST">

			<input class="inputbasic" placeholder="Identifiant" name="nom_de_compte" id="nom_de_compte" value="" type="text" size="auto" />

			<br /><br/>

			<input class="inputbasic" placeholder="Mot de passe" name="mot_de_passe" id="mot_de_passe" value="" type="password" size="auto"/>

			<br /><br />

			<input id="validation" type="submit" class="connexionsubmit" value="Connexion"/>


    </form>


</fieldset>
@endsection
