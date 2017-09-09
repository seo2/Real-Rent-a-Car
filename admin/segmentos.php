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
		    <span>Segmentos</span>
	    </header>
	    
	    <div id="cajaposiciones" >
		    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
			    <div class="row">
			    	<div class="col-xs-6">
						<h2>Segmentos</h2>
			    	</div>
					<? if($usuTipo == 1){ ?>
			    	<div class="col-xs-6 text-right">
						<a href="formulario-segmentos.php" class="btn btn-default"><span class="hidden-xs">Agregar </span><i class="fa fa-plus-circle"></i></a>
			    	</div>
			    	<? } ?>
			    </div>
		    </div>
		<?
			$sql  = "select * from autos_segmentos order by segNom";
		  	$resultado = $db->rawQuery($sql);
			if($resultado){
				foreach ($resultado as $r) {
					if($r['segEst']==1){ 
						$estado = 'off';
						$estDesc = 'Inactivo';						
					}else{ 
						$estado = 'on';
						$estDesc = 'Activo';
					} 
	    ?>   
			<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
				<div class="row">
					<div class="col-xs-2 col-sm-1">
						<a href="javascript:void(0)" data-camid="<?php echo $segID; ?>" data-estado="<?php echo $estado; ?>" class="cambiaEstado" data-toggle="tooltip" data-placement="right"  title="<?php echo $estDesc; ?>">
							<i class="fa fa-toggle-<?php echo $estado; ?>" aria-hidden="true"></i></span>
						</a>
					</div>
					<div class="col-xs-7 col-sm-8 postema nopadl nopadr">
						<a href="formulario-segmentos.php?segID=<?= $r['segID']; ?>"><?= $r['segNom']; ?></a><br>
					</div>
					<div class="col-xs-3 text-right posvotos">
						<a href="formulario-segmentos.php?segID=<?= $r['segID']; ?>" class="btn btn-default"><i class="fa fa-list"></i> <span class="hidden-xs">Editar</span></a> 
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