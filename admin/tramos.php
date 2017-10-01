<?php	
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
<?php  }  ?>

<?php 
	include('header.php');
?>

    <div class="container" id="argumentos">
	    
		<header>
		    <span>Tramos</span>
	    </header>
	    
	    <div id="cajaposiciones" >
		    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
			    <div class="row">
			    	<div class="col-xs-6">
						<h2>Tramos</h2>
			    	</div>
					<? if($usuTipo == 1){ ?>
			    	<div class="col-xs-6 text-right">
						<a href="formulario-tramos.php" class="btn btn-default"><span class="hidden-xs">Agregar </span><i class="fa fa-plus-circle"></i></a>
			    	</div>
			    	<? } ?>
			    </div>
		    </div>
		<?
			$sql  = "select * from tramos_despacho";
		  	$resultado = $db->rawQuery($sql);
			if($resultado){
				foreach ($resultado as $r) {
	    ?>   
			<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
				<div class="row">
					<div class="col-xs-9 postema">
						<a href="formulario-tramos.php?catID=<?= $r['tramoID']; ?>"><?= $r['tramoNom']; ?></a>
						<br><span>
						<i class="fa fa-usd" aria-hidden="true"></i> <?= number_format($r['tramoVal'],0,',','.'); ?>
						</span>
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