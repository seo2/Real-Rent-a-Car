<? 
	
session_start();
global $usuID;
	if($_SESSION['todos']['Logged']){ 
	
	//setcookie('id', $_SESSION['todos']['id']);
 
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

    <div class="container" id="posiciones" style="margin-bottom:40px;">
	    <? $titulo 	= 'Menú';
		   $tipo 	=  get_usertipo($_COOKIE['id']);
	    ?>
	    
	    <header>
		    <span><? if($paisID==7){ ?>Master<? }else{ ?>Maestros<? } ?></span>
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
					<a href="flota.php" class="btn btn-primary btn-lg btn-block">Flota</a>
					<br>
					<a href="categorias.php" class="btn btn-primary btn-lg btn-block">Categorías</a>
					<br>
					<a href="segmentos.php" class="btn btn-primary btn-lg btn-block">Segmentos</a>
					<br>
					<a href="opcionales.php" class="btn btn-primary btn-lg btn-block">Opcionales</a>
					<br>
					<a href="tramos.php" class="btn btn-primary btn-lg btn-block">Tramos</a>
					<br>
					<a href="comunas.php" class="btn btn-primary btn-lg btn-block">Comunas</a>
					<br>
					<a href="usuarios.php" class="btn btn-primary btn-lg btn-block">Usuarios</a>
				</div>
			</div>

	    	<div id="footer" class="blancobg">
		    	<div class="container">
			    	<div class="row">
						<div class="col-xs-12 col-md-6 col-md-offset-3 footer">
							
					    	<? 
								$back = 'home.php';
							?>
							<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">
							  <a href="<?php echo $back; ?>" 	class="btn btn-default"><i class="fa fa-chevron-left"></i>Volver</a>
							  <a href="home.php" 				class="btn btn-default"><i class="fa fa-home"></i> Home</a>
							  <a href="javascript:void();" 		class="btn btn-default" id="logoutBtn"><i class="fa fa-sign-out"></i> <? if($paisID==7){ ?>Sair<? }else{ ?>Salir<? } ?></a>
							</div>
				    	</div>
			    	</div>
		    	</div>
	    	</div>
<? include('footer.php'); ?>