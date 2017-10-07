<? 
	
session_start();
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
	
	if($_GET['tramoID'] ){
		$tramoID 	= $_GET['tramoID'];
		$sql  		= "select * from tramos_despacho where tramoID = $tramoID";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$tramoNom 	= $r['tramoNom'];
				$tramoVal 	= $r['tramoVal'];
	 		} 
	    }		
		$opcion = 'Modificar';	
	}else{
		
		$opcion = 'Agregar';
	}
	
	
?>

    <div class="container" id="argumentos">
	    
		<header>
		    <span></span>
	    </header>

		    <div id="cajaposiciones">
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
			    	<h2><?= $opcion; ?> Tramo</h2>
			    </div>
 
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
					
						<form action="ajax/graba-tramos.php" method="post" accept-charset="utf-8" id="formStd">
							<div class="form-group">
								<label class="ptdCan">Descripción:</label>
								<input type="text" class="form-control" id="segNom" placeholder="Nombre del tramo" name="tramoNom" value="<?= $tramoNom; ?>" required>
								<? if($_GET['tramoID'] ){?>
								<input type="hidden" name="tramoID" value="<?= $tramoID; ?>">
								<? } ?>
							</div>
							<div class="form-group">
								<label class="ptdCan">Valor:</label>
								<input type="text" class="form-control" id="segNom" placeholder="Ej: 9990" name="tramoVal" value="<?= $tramoVal; ?>" required>
							</div>
			
							<hr>
							<div class="form-group text-right">
						    	<button type="submit" class="btn btn-primary" id="btngrabar"><i class="fa fa-floppy-o"></i> Grabar</button>
							</div>
							
						</form>
					
					</div>

				</div>
				<div class="clear"></div>
		    </div>
    
    	<div id="footer" class="blancobg">
	    	<div class="container">
		    	<div class="row">
					<div class="col-xs-12 col-md-6 col-md-offset-3 footer">
	
		    	<?
						$back = 'javascript:window.history.back();';
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