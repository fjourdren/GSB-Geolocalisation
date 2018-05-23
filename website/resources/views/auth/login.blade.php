@extends('layouts.app')
<body class="fondindex">
<div class="container-fluid">
  <div class="row" id="bandeau">
    <div class="col-md-2">
      <div id="logo">
        <img class="image" src="<?php echo asset('IMG/logo.png')?>" height="175px" width="250px"></img>
      </div>
    </div>
    <div class="col-md-4">
      <h1 class="titre">Authentification</h1>
    </div>
  </div>
      <!-- Left Side Of Navbar -->
      <ul class="nav navbar-nav">
        <li><a href="{{ url('/home') }}">Home</a></li>
      </ul>
      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if (Auth::guest())
        <li><a href="{{ url('/login') }}">Connexion</a></li>
        <li><a href="{{ url('/register') }}">Créer un compte</a></li>
        @else
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ Auth::user()->name }} <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Deconexion</a></li>
          </ul>
        </li>
        @endif
      </ul>
  <hr class="hraffiche"/>
</div>

	<fieldset class="fieldsetconnexion">
		<legend align="center">Connexion</legend>
		<div id="erreur">
		</div>
		<form action="" method="POST">
			<input class="inputbasic" placeholder="Identifiant" name="email" id="email" value="" type="text" size="auto" />
			<br /><br/>
			<input class="inputbasic" placeholder="Mot de passe" name="password" id="password" value="" type="password" size="auto"/>
			<br /><br />
			<input id="validation" type="submit" class="connexionsubmit" value="Connexion"/>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</form>
	</fieldset>
