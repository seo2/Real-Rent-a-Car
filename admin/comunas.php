<? 
	
session_start();

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

    <div class="container" id="argumentos">
	    
		<header>
		    <span>Comunas</span>
	    </header>
	    
	    <div id="cajaposiciones" >
		    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
			    <div class="row">
			    	<div class="col-xs-6">
						<h2>Comunas</h2>
			    	</div>
			    </div>
		    </div>
		<?
			$sql  = "select * from comuna where comuna_provincia_id = 131 order by comuna_tramo";
		  	$resultado = $db->rawQuery($sql);
			if($resultado){
				foreach ($resultado as $r) {
	    ?>   
			<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
				<div class="row">
					<div class="col-xs-9 postema">
						<a href="formulario-comuna.php?catID=<?= $r['comuna_id']; ?>"><?= $r['comuna_nombre']; ?></a>
						<?php if($r['comuna_tramo']){ ?>
						<br><span>
						<?php echo get_tramo_desc($r['comuna_tramo']); ?> <i class="fa fa-usd" aria-hidden="true"></i> <?= number_format(get_tramo_valor($r['comuna_tramo']),0,',','.'); ?>
						</span>
						<?php } ?>
					</div>
					<div class="col-xs-3 text-right posvotos">
						<a href="formulario-tramos.php?catID=<?= $r['tramoID']; ?>" class="btn btn-default"><i class="fa fa-list"></i> <span class="hidden-xs">Editar</span></a> 
					</div>
				</div>

			</div>
	    <?  	} 
		    } ?>			    		    
	    </div>

    	<div id="footer" class="blancobg">
	    	<div class="container">
		    	<div class="row">
					<div class="col-xs-12 col-md-6 col-md-offset-3 footer">
			    	<?
				    	if($_GET['piezas']){
					    	if($usuTipo == 99){ 
						    	$back = 'home.php';
							}else{ 
								$back = 'maestros.php';
							}
						}else{
							$back = 'javascript:window.history.back();';
						}
					?>							
						<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">
						  <a href="<?php echo $back; ?>" 	class="btn btn-default"><i class="fa fa-chevron-left"></i> <? if($paisID==7){ ?>Voltar<? }else{ ?>Volver<? } ?></a>
						  <a href="home.php" 				class="btn btn-default"><i class="fa fa-home"></i> Home</a>
						  <a href="javascript:void();" 		class="btn btn-default" id="logoutBtn"><i class="fa fa-sign-out"></i> <? if($paisID==7){ ?>Sair<? }else{ ?>Salir<? } ?></a>
						</div>
			    	</div>
		    	</div>
	    	</div>
    	</div>	    

<? include('footer.php'); ?>