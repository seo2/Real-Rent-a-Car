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
	
	$catID = 0;

	include('header.php');
	
	if($_GET['autoID'] ){
		$autoID 	 	= $_GET['autoID'];
		$sql  		= "select * from autos_flota where autoID = $autoID";
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$catID  		= $r['catID'];
				$autoDesc  		= $r['autoDesc'];
				$autoPatente 	= $r['autoPatente'];
				$autoCilin		= $r['autoCilin'];
				$autoEst  		= $r['autoEst'];
				$autoFoto		= $r['autoFoto'];
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
			    	<h2><?= $opcion; ?> Auto</h2>
			    </div>
 
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
					
						<form action="ajax/graba-flota.php" method="post" accept-charset="utf-8" id="formFlota">
							<fieldset>
								<div class="form-group">
									<select class="form-control" name="catID" required>
										<option value="">Seleccione Categoría</option>
										<?
										$tema = $db->rawQuery('select * from autos_categorias order by catDesc');
										if($tema){
											foreach ($tema as $t) {
										?>
										<option value="<?= $t['catID']; ?>" <? if($t['catID']==$catID){ ?>selected<? } ?>><?= $t['catDesc']; ?></option>
										<?		
											}
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label class="ptdCan">Descripción del vehículo:</label>
									<input type="text" class="form-control" id="autoDesc" placeholder="Marca y Módelo" name="autoDesc" value="<?= $autoDesc; ?>" required >
									<? if($_GET['autoID'] ){?>
									<input type="hidden" name="autoID" 	value="<?= $autoID; ?>">
									<? } ?>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="ptdCan">Patente:</label>
											<input type="text" class="form-control" id="autoPatente" placeholder="XXXX99" name="autoPatente" value="<?= $autoPatente; ?>" required >
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="ptdCan">Motor:</label>
											<input type="text" class="form-control" id="autoCilin" placeholder="2.0" name="autoCilin" value="<?= $autoCilin; ?>" >
										</div>

									</div>
								</div>
		
								<div class="form-group">
							    	<div class="col-xs-10 col-xs-offset-1" id="campofoto" style="display:none;">
										<input type="file" id="uploadFoto" name="foto">
							    	</div>
								</div>
								<? if($_GET['autoID'] ){ // Modificación o consulta?>
								<div class="row">
									<div class="col-xs-offset-3 col-xs-6">
							    		<div id="fotito" style="margin-bottom:10px; padding:5px; border:1px solid #ccc;">
										<?	$archivo = 'ajax/uploads/'.$autoFoto; ?>	
							    			<img src="<?php echo $archivo; ?>" class="img-responsive" id="fotoperfil" >
							    		</div>
							    	</div>	
								</div>
									
								<div class="form-group">
									<div class="row">
										<div class="col-xs-offset-3 col-xs-6">
								    		<button type="button" onclick="document.getElementById('uploadFoto').click(); return false" class="btn btn-primary" id="subefoto">
												<i class="fa fa-camera"></i> Cambiar Foto
											</button>
										</div>
									</div>
								</div>	
								<? }else{ // agregar nuevo registro ?>
								<div class="row">
									<div class="col-xs-offset-3 col-xs-6">
							    		<div id="fotito" style="margin-bottom:10px; padding:5px; border:1px solid #ccc; display:none;" >
							    			<img src="" class="img-responsive" id="fotoperfil" >
							    		</div>
							    	</div>	
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-xs-offset-3 col-xs-6">
								    		<button type="button" onclick="document.getElementById('uploadFoto').click(); return false" class="btn btn-primary" id="subefoto">
												<i class="fa fa-camera"></i> Agregar Foto
											</button>
										</div>
									</div>
								</div>
								<? } ?>
								
																	
								<div class="form-group">
									<label for="ptdGra">Estado:</label>
									<select class="form-control" name="autoEst" required id="autoEst">
										<option value="0" <? if($autoEst==0){ ?>selected<? } ?>>Activo</option>
										<option value="1" <? if($autoEst==1){ ?>selected<? } ?>>Inactivo</option>
									</select>
								</div>			
								<hr>
								<div class="form-group text-right">
							    	<button type="submit" class="btn btn-primary" id="btngrabar"><i class="fa fa-floppy-o"></i> Grabar</button>
								</div>
							</fieldset>
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
							  <a href="<?php echo $back; ?>" 	class="btn btn-default"><i class="fa fa-chevron-left"></i> Volver</a>
							  <a href="home.php" 				class="btn btn-default"><i class="fa fa-home"></i> Home</a>
							  <a href="javascript:void();" 		class="btn btn-default" id="logoutBtn"><i class="fa fa-sign-out"></i> Salir</a>
							</div>
				    	</div>
			    	</div>
		    	</div>
	    	</div>	   
   
<? include('footer.php'); ?>