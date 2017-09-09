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
	
	if($_GET['segID'] ){
		$pieID 	 	= $_GET['segID'];
		$sql  		= "select * from autos_segmentos where segID = $pieID";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$formDesc 	= $r['segNom'];
				$formEst 	= $r['segEst'];
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
			    	<h2><?= $opcion; ?> Segmento</h2>
			    </div>
 
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
					
						<form action="ajax/graba-segmentos.php" method="post" accept-charset="utf-8" id="formStd">
							<div class="form-group">
								<label class="ptdCan">Descripción:</label>
								<input type="text" class="form-control" id="segNom" placeholder="Nombre del Segmento" name="segNom" value="<?= $formDesc; ?>" required>
								<? if($_GET['formID'] ){?>
								<input type="hidden" name="segID" 	value="<?= $formID; ?>">
								<? } ?>
							</div>
	
							<div class="form-group">
								<label for="ptdGra">Estado:</label>
								<select class="form-control" name="segEst" required id="formEst">
									<option value="0" <? if($formEst==0){ ?>selected<? } ?>>Activo</option>
									<option value="1" <? if($formEst==1){ ?>selected<? } ?>>Inactivo</option>
								</select>
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