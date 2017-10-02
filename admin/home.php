<? 
	
session_start();
global $usuID;

if($_SESSION['todos']['Logged']){ 
	
	$usuID = $_SESSION['todos']['id'];
	
	setcookie("id", $usuID, time()+3600, "/");
 
 }elseif($_COOKIE['id']) { 
 	$usuID = $_COOKIE['id'];
 }else{ ?>
 <script>
 		window.location.replace("index.php");
 </script>
	


<?  }  ?>
<? 
	
	include('header.php');	
	
?>
	<style>
		#botonera{display: none;}
	</style>
    <div class="container" id="posiciones">
	    <header>
		    <span>Menú</span>
	    </header>
			<div class="row">
				
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 cajita" >
					<div class="row">
						<div class="col-xs-8 col-xs-offset-2">
							<br>
							<img src="assets/img/logo.png?ver=2.1" class="img-responsive">
						</div>
					</div>
					<p class="logo animated fadeInDown text-center">Administrador</p>



					<a href="reservas.php" class="btn btn-primary btn-lg btn-block"><i class="fa fa-car" aria-hidden="true"></i> Reservas</a>
					<br>

					<a href="maestros.php" class="btn btn-primary btn-lg btn-block"><i class="fa fa-bar-chart" aria-hidden="true"></i> Informes</a>
					<br>
					
					<hr>

					<a href="maestros.php" class="btn btn-primary btn-lg btn-block">Maestros</a>
					<br>
					

					<a href="formulario-cambiar-password.php" class="btn btn-primary btn-lg btn-block">Cambiar Contraseña</a>
					<br>
					<a href="javascript:void();" class="btn btn-primary btn-lg btn-block" id="logoutBtn"><i class="fa fa-sign-out" aria-hidden="true"></i> Salir</a>
				</div>
			</div>
    
<? include('footer.php'); ?>