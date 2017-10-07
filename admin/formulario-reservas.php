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
	
	if($_GET['resID'] ){
		$resID 	 = $_GET['resID'];
		$sql  = "select * from reservas where resID = $resID";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$resNom 	= $r['resNom'];
				$resApe		= $r['resApe'];
				$resMail	= $r['resMail'];
				$resFono	= $r['resFono'];
				$resRut		= $r['resRut'];
				$resAuto	= $r['resAuto'];
				$catID 		= get_cat_auto($resAuto);
				$resFecIni	= date("d/m/Y", strtotime($r['resFecIni']));
				$resHorIni	= $r['resHorIni'];
				$resFecFin	= date("d/m/Y", strtotime($r['resFecFin']));
				$resHorFin	= $r['resHorFin'];
				$resDias	= $r['resDias'];
				$resDesDir	= $r['resDesDir'];
				$resDesNum	= $r['resDesNum'];
				$resDesCom	= $r['resDesCom'];
				$resDevol   = $r['resDevol'];
				$resValTot	= $r['resValTot'];
				$resEst		= $r['resEst'];
	 		} 
	    }	
	    	
	    if($paisID==7){
			$accion = "Editar";
	    }else{
			$accion = "Modificar";
	    } 
	}else{
	    if($paisID==7){
			$accion = "Adicionar";
	    }else{
			$accion = "Agregar";
	    } 
	}
	
	
?>

    <div class="container" id="argumentos">
	    
		<header>
		    <span><?= $accion; ?> Reserva</span>
	    </header>

		    <div id="cajaposiciones" data-eveID="<?= $eveID; ?>" data-tiendaID="<?= $tieID; ?>">
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
			    	<h2>Reserva</h2>
			    </div>
 
		    
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
					
					<form action="ajax/graba-reserva.php" method="post" accept-charset="utf-8" id="formStd">
						<? if($_GET['resID']){ ?>
						<input type="hidden" name="resID" 		value="<?= $resID; ?>">
						<? } ?>
						<div class="row">
							<div class="form-group col-sm-6">
								<label class="ptdCan">Fecha de Inicio:</label>
								
								<div class="input-group date">
								  <input type="text" class="form-control datepicker" id="resFecIni" placeholder="" name="resFecIni" value="<?= $resFecIni; ?>" > <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
							<div class="form-group col-sm-6">
								<label class="ptdCan">Hora de Inicio:</label>
								
								<div class="input-group date">
								  <input type="time" class="form-control" id="resHorIni" placeholder="00:00" name="resHorIni" value="<?= $resHorIni; ?>" > <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-6">
								<label class="ptdCan">Fecha de Término:</label>
								
								<div class="input-group date">
								  <input type="text" class="form-control datepicker" id="resFecFin" placeholder="" name="resFecFin" value="<?= $resFecFin; ?>" > <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
							<div class="form-group col-sm-6">
								<label class="ptdCan">Hora de Término:</label>
								
								<div class="input-group date">
								  <input type="time" class="form-control" id="resHorFin" placeholder="00:00" name="resHorFin" value="<?= $resHorFin; ?>" > <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
								</div>
							</div>
						</div>
						<hr>
<!--
						<div class="checkbox">
						    <label>
						      <input type="checkbox" id="entrega" <?php if($resDesDir){ ?>checked<?php } ?>> Entrega a Domicilio
						    </label>
						</div>
-->
						<div class="row" id="domicilio" >
							<div class="form-group col-sm-8">
								<label class="ptdCan">Dirección</label>
								
								  <input type="text" class="form-control" id="horIni" placeholder="" name="resDesDir" value="<?= $resDesDir; ?>" >
							</div>		
							<div class="form-group col-sm-4">
								<label class="ptdCan">Número</label>
								
								  <input type="text" class="form-control" id="horIni" placeholder="" name="resDesNum" value="<?= $resDesNum; ?>" >
							</div>	
						
							<div class="form-group col-sm-12">
								<label for="exampleInputEmail1">Cómuna:</label>
								<select class="form-control" name="resDesCom" id="resDesCom" >
									<option value="0" selected>Seleccione comuna</option>
									<?
										$sql  = "select * from comuna where comuna_provincia_id = 131 order by comuna_nombre";
									  	$resultado = $db->rawQuery($sql);
										if($resultado){
											foreach ($resultado as $r) {
								    ?>  
									<option data-precio="<?php echo get_tramo_valor($r['comuna_tramo']); ?>" value="<?= $r['comuna_id']; ?>" <? if($r['comuna_id']==$resDesCom){ ?>selected<? } ?>><?= $r['comuna_nombre']; ?></option>
								    <?  	} 
									    } ?>
								</select>
							</div>	
						
							<div class="form-group col-sm-12">
								<label for="exampleInputEmail1">Devolución:</label>
								<select class="form-control" name="resDevol" id="resDevol" >
									<option value="1">Oficinas de Real Rent a Car</option>	 
									<option value="2">Misma dirección de entrega</option> 
									<option value="2">Lugar a acordar telefónicamente</option>
								</select>
							</div>					
						</div>
						<hr>
						<div class="row">
							<div class="form-group col-xs-8">
								<label for="ptdGra">Categoría:</label>
								<select class="form-control" name="catID"  id="catID2">
									<option value=""><? if($paisID==7){ ?>Selecionar<? }else{ ?>Seleccione<? } ?></option>
									<?
									$tema = $db->rawQuery('select * from autos_categorias order by catDesc');
									if($tema){
										foreach ($tema as $t) {										
									?>
									<option value="<?= $t['catID']; ?>" <? if($t['catID']==$catID){ ?>selected<? } ?>><?php echo $t['catDesc']; ?></option>
									<?		
										}
									}
									?>
								</select>
							</div>	
							<div class="form-group col-sm-4">
								<label for="exampleInputEmail1">Precio x día:</label>
								<? if($_GET['resID']){?>
								<input type="text" 		class="form-control" id="precioUnit1" value="<?= get_categoria_precio($catID); ?>" >
								<input type="hidden" 	class="form-control" id="precioUnit" value="<?php echo get_categoria_precio($catID); ?>" >
								<? }else{ ?>
								<input type="text" 		class="form-control" id="precioUnit1" value="" >
								<input type="hidden" 	class="form-control" id="precioUnit" value="" >
								<? } ?>
							</div>							
						</div>
						
						<? if($_GET['resID']){?>
						
						<div class="form-group" id="autos">
							<label for="exampleInputEmail1">Autos</label>
							<select class="form-control" name="resAuto" id="resAuto" >
								<?
									
								$tema = $db->rawQuery('select * from autos_flota where catID = '.$catID);
								if($tema){
									foreach ($tema as $t) {
								?>							
								<option value="<?= $t['autoID']; ?>" <? if($t['autoID']==$resAuto){ ?>selected<? } ?>><?= $t['autoDesc']; ?> - <?= $t['autoPatente']; ?></option>
								<?		
									}
								}
								?>
							</select>
						</div>
						
						<? }else{ ?>
						
						<div class="form-group" id="autos" style="display:none;">
							<label for="exampleInputEmail1">Autos:</label>
							<select class="form-control" name="resAuto" id="resAuto" >
								<option value="">-</option>
							</select>
						</div>
						<? } ?>
						
						<div class="form-group">
							
							<label for="exampleInputEmail1">Opcionales:</label>
						</div>
							<div class="row">
								<?
									$sql  = "select * from opcionales where opcEst = 0 order by opcDesc";
								  	$resultado = $db->rawQuery($sql);
									if($resultado){
										foreach ($resultado as $r) {
											$ok = 0;
											if($_GET['resID'] ){
												$ok = ask_opcion_reserva($_GET['resID'] ,$r['opcID']);
											}
							    ?>   								
								<div class="col-xs-6">
								  <label >
								    <input type="checkbox" name="opcID[]" class="opcID" value="<?php echo $r['opcID']; ?>" <? if($ok==1){ ?>checked<? } ?> data-precio="<?php echo $r['opcPrec']; ?>">
								    <?php echo $r['opcDesc']; ?> $<?= number_format($r['opcPrec'],0,',','.'); ?>
								  </label>
								</div>
							    <? 		} 
								    } ?>
							</div>	
						<hr>
							<div class="row" id="Valor" >
								<div class="form-group col-sm-3">
									<label class="ptdCan">Días:</label>
									<input type="number" class="form-control" id="resDias" placeholder="" name="resDias" value="<?= $resDias; ?>"  readonly>
								</div>	
								<div class="form-group col-sm-6">
									<label class="ptdCan">Valor Total:</label>
									<input type="text" 		class="form-control" id="resValTot1" name="resValTot1" 	value="$<?= number_format($resValTot,0,',','.'); ?>"  readonly>
									<input type="hidden" 	class="form-control" id="resValTot"  name="resValTot"	value="<?= $resValTot; ?>" >
									
								</div>	
								<div class="form-group col-sm-3">
									<label class="ptdCan">Descuento:</label>
									<input type="number" class="form-control" id="resDesc" placeholder="" name="resDesc" value="<?= $resDesc; ?>">
								</div>	
							</div>
						<hr>

						<div class="row" id="datos-personales" >
							<div class="form-group col-sm-6">
								<label class="ptdCan">Nombre</label>
								<input type="text" class="form-control" id="resNom" placeholder="" name="resNom" value="<?= $resNom; ?>" >
							</div>		
							<div class="form-group col-sm-6">
								<label class="ptdCan">Apellido</label>
								<input type="text" class="form-control" id="resApe" placeholder="" name="resApe" value="<?= $resApe; ?>" >
							</div>	
							<div class="form-group col-sm-6">
								<label class="ptdCan">E-mail</label>
								<input type="text" class="form-control" id="resMail" placeholder="" name="resMail" value="<?= $resMail; ?>" >
							</div>		
							<div class="form-group col-sm-6">
								<label class="ptdCan">Teléfono</label>
								<input type="text" class="form-control" id="resFono" placeholder="" name="resFono" value="<?= $resFono; ?>" >
							</div>	
							<div class="form-group col-sm-6">
								<label class="ptdCan">RUT</label>
								<input type="text" class="form-control" id="resRut" placeholder="" name="resRut" value="<?= $resRut; ?>" >
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-6">
								<label for="ptdGra">Estado:</label>
								<select class="form-control" name="resEst" id="resEst">
									<option value="0" <? if($resEst==0 || !$_GET['resID']){ ?>selected<? } ?>>Por Confirmar</option>
									<option value="1" <? if($resEst==1 && $_GET['resID']){ ?>selected<? } ?>>Confirmado</option>
									<option value="2" <? if($resEst==2 && $_GET['resID']){ ?>selected<? } ?>>Entregado</option>
									<option value="3" <? if($resEst==3 && $_GET['resID']){ ?>selected<? } ?>>No Show</option>
									<option value="4" <? if($resEst==4 && $_GET['resID']){ ?>selected<? } ?>>Recepcionado</option>
								</select>
							</div>
						</div>
						<hr>
						<div class="form-group text-right">
					    	<button type="submit" class="btn btn-primary" id="btngrabar"><i class="fa fa-floppy-o"></i> <? if($paisID==7){ ?>Salvar<? }else{ ?>Grabar<? } ?></button>
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