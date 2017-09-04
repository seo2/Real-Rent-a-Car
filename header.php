<?php
	require_once("admin/_lib/config.php");
	require_once("admin/_lib/MysqliDb.php");
	$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>REAL Rent a Car</title>
  <link rel="icon" type="image/png" href="assets/img/icono.png" />

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="assets/fonts/font-awesome-4.6.3/css/font-awesome.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
  <link href="assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="assets/owlcarousel/assets/owl.carousel.css" type="text/css" rel="stylesheet"/>
  <link href="assets/css/style.css?ver=2" type="text/css" rel="stylesheet" media="screen,projection"/>
  
</head>

<body>
	<header>
	  <div class="navbar-fixed">
		  <nav class="" role="navigation">
	    <div class="nav-wrapper container"><a href="index.html" target="_self" class="brand-logo"><img src="assets/img/real_rent_a_car.svg" width="150"/></a>
	      <ul class="right hide-on-med-and-down">
	        <li><a href="reservar.html" target="_self" class="">Reservar</a></li>
	        <li><a href="vehiculos.html" target="_self" class="">Vehículos</a></li>
	        <li><a href="faqs.html" target="_self" class="">FAQS</a></li>
	        <li><a href="somos.html" target="_self" class="">SOMOS</a></li>
	        <li><a href="contacto.html" target="_self" class="">CONTACTO</a></li>
	      	<li><a href="#" target="_blank"><i class="fa fa-facebook fa-lg"></i></a></li>
					<li><a href="#" target="_blank"><i class="fa fa-twitter fa-lg"></i></a></li>
					<li><a href="#" target="_blank"><i class="fa fa-youtube fa-lg"></i></a></li>
					<li><a href="#" target="_blank"><i class="fa fa-instagram fa-lg"></i></a></li>
	      </ul>
	
	      <ul id="nav-mobile" class="side-nav">
		      <li class="brand-logo-mobile"><a href="index.html" target="_self"><img src="assets/img/real_rent_a_car.svg" width="150"/></a></li>
	        <li><a href="reservar.html" target="_self" class="">Reservar</a></li>
	        <li><a href="vehiculos.html" target="_self" class="">Vehículos</a></li>
	        <li><a href="faqs.html" target="_self" class="">FAQS</a></li>
	        <li><a href="somos.html" target="_self" class="">SOMOS</a></li>
	        <li><a href="contacto.html" target="_self" class="">CONTACTO</a></li>
	        <li class="redes_sociales">
		        <a href="#" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
						<a href="#" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
						<a href="#" target="_blank"><i class="fa fa-youtube fa-lg"></i></a>
						<a href="#" target="_blank"><i class="fa fa-instagram fa-lg"></i></a>
	        </li>
	      </ul>
	      <a href="#" data-activates="nav-mobile" class="button-collapse right">
		      <i class="material-icons">menu</i>
		    </a>
	    </div>
	  </nav>
	  </div><!-- /navbar-fixed -->
	</header>