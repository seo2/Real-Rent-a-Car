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
	
	if($_GET['catID'] ){
		$catID 	 	= $_GET['catID'];
		$sql  		= "select * from autos_categorias where catID = $catID";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$segID		= $r['segID'];
				$catDesc 	= $r['catDesc'];
				$catPrec    = $r['catPrec'];
				$catPuertas = $r['catPuertas'];
				$catPas 	= $r['catPas'];
				$catCaja	= $r['catCaja'];
				$catTrac	= $r['catTrac'];
				$catEst 	= $r['catEst'];
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
			    	<h2><?= $opcion; ?> Categoría</h2>
			    </div>
 
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
					
						<form action="ajax/graba-categorias.php" method="post" accept-charset="utf-8" id="formStd">
							<div class="form-group">
								<label for="ptdGra">Segmento:</label>
								<select class="form-control" name="segID" required id="segID">
									<option value="">Seleccione</option>
									<?
									$tema = $db->rawQuery('select * from autos_segmentos where segEst = 0 order by segNom');
									if($tema){
										foreach ($tema as $t) {
									?>
									<option value="<?= $t['segID']; ?>" <? if($t['segID']==$segID){ ?>selected<? } ?>><?= $t['segNom']; ?></option>
									<?		
										}
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label class="ptdCan">Descripción:</label>
								<input type="text" class="form-control" id="formDesc" placeholder="Nombre del formato" name="catDesc" value="<?= $catDesc; ?>" required>
								<? if($_GET['catID'] ){?>
								<input type="hidden" name="catID" 	value="<?= $catID; ?>">
								<? } ?>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="ptdCan">Puertas:</label>
										<input type="number" class="form-control" id="catPuertas" placeholder="Cantidad" name="catPuertas" value="<?= $catPuertas; ?>" required>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="ptdCan">Pasajeros:</label>
										<input type="number" class="form-control" id="catPas" placeholder="Cantidad" name="catPas" value="<?= $catPas; ?>" required>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="ptdCan">Precio:</label>
								<input type="number" class="form-control" id="catPrec" placeholder="Nombre del formato" name="catPrec" value="<?= $catPrec; ?>" required>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="ptdGra">Transmisión:</label>
										<select class="form-control" name="catCaja" required id="catCaja">
											<option value="0" <? if($catCaja==0){ ?>selected<? } ?>>Mecánica</option>
											<option value="1" <? if($catCaja==1){ ?>selected<? } ?>>Automática</option>
										</select>
									</div>	
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="ptdGra">Tracción:</label>
										<select class="form-control" name="catTrac" required id="catTrac">
											<option value="0" <? if($catTrac==0){ ?>selected<? } ?>>2x4</option>
											<option value="1" <? if($catTrac==1){ ?>selected<? } ?>>4x4</option>
										</select>
									</div>	
								</div>
							</div>
							<div class="form-group">
								<label for="ptdGra">Estado:</label>
								<select class="form-control" name="catEst" required id="formEst">
									<option value="0" <? if($catEst==0){ ?>selected<? } ?>>Activo</option>
									<option value="1" <? if($catEst==1){ ?>selected<? } ?>>Inactivo</option>
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
							  <a href="<?php echo $back; ?>" 	class="btn btn-default"><i class="fa fa-chevron-left"></i>Volver</a>
							  <a href="home.php" 				class="btn btn-default"><i class="fa fa-home"></i> Home</a>
							  <a href="javascript:void();" 		class="btn btn-default" id="logoutBtn"><i class="fa fa-sign-out"></i> <? if($paisID==7){ ?>Sair<? }else{ ?>Salir<? } ?></a>
							</div>
				    	</div>
			    	</div>
		    	</div>
	    	</div>  
<? include('footer.php'); ?>