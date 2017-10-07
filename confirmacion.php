<?php include('header.php'); ?>
<?php
	$resID = $_GET['resID'];
	$sql0  = "select * from reservas where resID = $resID";					
  	$formatos = $db->rawQuery($sql0);
	if($formatos){
		foreach ($formatos as $r) {	
			$catID = $r['catID'];
/*
			$sql  = "select * from autos_categorias where catID = $catID";
		  	$resultado = $db->rawQuery($sql);
			if($resultado){
				foreach ($resultado as $c) {
					if($c['catCaja']==0){ 
						$caja = 'M';	
						$caja2 = 'Caja Manual';					
					}else{ 
						$caja = 'A';
						$caja2 = 'Caja Automática';	
					}
				} 
				$catPas = $c['catPas'];
				$catPrec = $c['catPrec'];
			} 
*/
			$resNom 	= $r['resNom'];
			$resApe		= $r['resApe'];
			$resMail	= $r['resMail'];
			$resFono	= $r['resFono'];
			$resAuto	= $r['resAuto'];
			$resFecIni	= $r['resFecIni'];
			$resHorIni	= $r['resHorIni'];
			$resFecFin	= $r['resFecFin'];
			$resHorFin	= $r['resHorFin'];
			$resDias	= $r['resDias'];
			$resDesDir	= $r['resDesDir'];
			$resDesNum	= $r['resDesNum'];
			$resDesCom	= $r['resDesCom'];
			$resDevol   = $r['resDevol'];
			$resValTot	= $r['resValTot'];
		} 
    } 
    
    if($resDevol==1){
	    $devolucion = "Oficinas de Real Rent a Car";
    }elseif($resDevol==2){
	    $devolucion = "Misma dirección de entrega";
    }elseif($resDevol==3){
	    $devolucion = "Lugar a acordar telefónicamente";
    }
    
?>	
<?php
	$sql0  = "select * from autos_flota where autoID = $resAuto";					
  	$formatos = $db->rawQuery($sql0);
	if($formatos){
		foreach ($formatos as $r) {	
			$catID = $r['catID'];
			$sql  = "select * from autos_categorias where catID = $catID";
		  	$resultado = $db->rawQuery($sql);
			if($resultado){
				foreach ($resultado as $c) {
					if($c['catCaja']==0){ 
						$caja = 'M';	
						$caja2 = 'Caja Manual';					
					}else{ 
						$caja = 'A';
						$caja2 = 'Caja Automática';	
					}
				} 
				$catPas = $c['catPas'];
				$catPrec = $c['catPrec'];
			} 
			$autoFoto 	= $r['autoFoto'];
			$rautoDesc	= $r['autoDesc'];
		} 
    } 
    if($resDias>1){
	    $dias = $resDias.' días';
    }else{
	    $dias = $resDias.' día';
    }
    $autoTot = $catPrec * $resDias;
    
?>	
	
	<main>	
	 	<div class="barra_naranja">
		 	<div class="container">
			 	<h4>confirmación</h4>
		 	</div><!-- /.container -->
	 	</div><!-- /.barra_naranja -->
	  
		<div class="container">
			
			<div class="row">
				<div class="section">
					<div class="row">
						<div class="col s12">
							<div class="box_cars center">
								Tu reserva ha sido confirmada. Hemos enviado un email a <?php echo $resMail; ?> con todos los datos.<!--
<br>
Un ejecutivo te contactará a la brevedad.
-->
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.section -->
				
				<div class="section">
					<div class="row">
						<div class="col l8 offset-l2 s12">
							
							<h5 class="titulo">Tu número de confirmación es <?php echo str_pad($resID, 5, '0', STR_PAD_LEFT) ; ?></h5>
							
							<div class="divider"></div>
							
							<h5 class="titulo"><?php echo $resNom; ?> <?php echo $resApe; ?></h5>
							
							<table class="bordered">
				        <tbody>
				          <tr>
				            <td>Email:</td>
				            <td><?php echo $resMail; ?></td>
				          </tr>
				        </tbody>
				      </table>
							
							<h5 class="titulo">Tu vehículo:</h5>
							
							<div class="item center">
								<img src="admin/ajax/uploads/<?php echo $autoFoto; ?>" width="210"/>
								<h5><?php echo get_segmento(get_segmento_cat($catID)); ?></h5>
								<p><?php echo $rautoDesc; ?> <small>o similar</small></p>
								<div class="features_car">
									<span class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="<?php echo $catPas; ?> Pasajeros"><i class="fa fa-users" aria-hidden="true"></i> <?php echo $catPas; ?></span> /
									<span class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="<?php echo $caja2; ?>"><i class="fa fa-sitemap" aria-hidden="true"></i> <?php echo $caja; ?></span>
								</div><!-- /.features_car -->
							</div><!-- /.item -->
							
							<br>
							
							<div class="divider"></div>
							
							<h5 class="titulo">Detalle de la reserva:</h5>
								<?php if($resDesCom){ ?>
							<div class="dato_reserva">
								<p><span>Donde entregar:</span></p>
								<p><?php echo $resDesDir; ?> <?php echo $resDesNum; ?>, <?php echo get_comuna($resDesCom); ?></p>
							</div><!-- /.datos_reserva -->
							
							<div class="dato_reserva">
								<p><span>Devolución: <?php echo $devolucion; ?>.</span></p>
							</div><!-- /.datos_reserva -->
							<?php }else{ ?>
							<div class="dato_reserva">
								<p><span>Retirar vehículo en Oficinas de Real Rent a Car.</span> Rinconada 8926, Vitacura</p>
							</div><!-- /.datos_reserva -->
							<?php } ?>
							
							<div class="dato_reserva">
								<p><span>Fecha entrega:</span></p>
								<p><?php echo date("d-m-Y", strtotime($resFecIni)); ?> <?php echo $resHorIni; ?></p>
							</div><!-- /.datos_reserva -->
							
							<div class="dato_reserva">
								<p><span>Fecha devolución:</span></p>
								<p><?php echo date("d-m-Y", strtotime($resFecFin)); ?> <?php echo $resHorFin; ?></p>
							</div><!-- /.datos_reserva -->
							
							
							<div class="divider"></div>
							
							<h5 class="titulo">Resumen de la reserva:</h5>
							
							<table class="bordered">
				        <tbody>
				          <tr>
				            <td>Arriendo Auto</td>
				            <td><?php echo $rautoDesc; ?><br><span class="los_dias"><?php echo $dias; ?></span> / $<?php echo number_format($catPrec,0,',','.'); ?> por día</td>
				            <td class="right-align">$<?php echo number_format($autoTot,0,',','.'); ?></td>
				          </tr>
		<?php  
			if($resDesCom){
				$sql  = "select * from comuna where comuna_id = $resDesCom";
			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {
						$tramoPrec = get_tramo_valor($r['comuna_tramo']);
						$comuna_nombre = $r['comuna_nombre'];
	    ?>			          
			          <tr class="entrega">
			            <td>Entrega a Domicilio</td>
			            <td>Comuna <span class="comuna"><?php echo $comuna_nombre; ?></span></td>
			            <td class="right-align">$<span class="dias2" data-dias="1" data-valor="<?php echo $tramoPrec; ?>"></span></td>
			          </tr>
		<?php  			
						if($resDevol==2){ ?>
			          <tr class="entrega">
			            <td>Devolución</td>
			            <td>Comuna <span class="comuna"><?php echo $comuna_nombre; ?></span></td>
			            <td class="right-align">$<span class="dias2" data-dias="1" data-valor="<?php echo $tramoPrec; ?>"></span></td>
			          </tr>
		<?php	
						}
					
					} 
			    } 
		    }
		?>
				          
						<?
							
							$sql1  = "select * from reservas_opcionales where resID = $resID";
						  	$opcionales = $db->rawQuery($sql1);
							if($opcionales){
								foreach ($opcionales as $o) {	
									$opcID = $o['opcID'];						
									$sql  = "select * from opcionales where opcID = $opcID";
								  	$resultado = $db->rawQuery($sql);
									if($resultado){
										foreach ($resultado as $r) {
											if($r['opcEst']==1){ 
												$estado = 'off';
												$estDesc = 'Inactivo';						
											}else{ 
												$estado = 'on';
												$estDesc = 'Activo';
											} 
											$opcPrec = $r['opcPrec'];
											$opcTot  = $opcPrec * $resDias;
					    ?>   				
				          <tr>				          
						            <td><?php echo $r['opcDesc']; ?></td>
						            <td><span class="los_dias"><?php echo $dias; ?></span> / $<?php echo number_format($opcPrec,0,',','.'); ?> por día</td>
						            <td class="right-align">$<?php echo number_format($opcTot,0,',','.'); ?></td>	
				          </tr>
				        <?  		
									$i++;
									} 
								} 
						    } 
					    }?>	  
				          <tr>
				            <td>TOTAL</td>
				            <td></td>
				            <td class="right-align"><strong>$<?php echo number_format($resValTot,0,',','.'); ?></strong></td>
				          </tr>
				        </tbody>
				      </table>
							
							<br>
							
<!--
							<div class="row">
								<div class="col s6"><a href="" target="" class="btn_white left">Volver</a></div>
								<div class="col s6">
									<a href="" target="" class="btn_white right">Imprimir</a>
								</div>
							</div>
--><!-- /.row -->
							
						</div><!-- /.col -->
					</div><!-- /.row -->
											
					
					
				</div><!-- /.section -->
				
			</div><!-- /.row -->
			
		</div><!-- /.container -->
	</main>

<?php include('footer.php'); ?>
	<script>
		$(document).ready(function(){
			localStorage.setItem('desde_el', '');
		  	localStorage.setItem('hasta_el', '');
			localStorage.setItem('desde_elh', '');
		  	localStorage.setItem('hasta_elh', '');
		  	localStorage.setItem('dias', ''); 	
			localStorage.setItem('direccion', '');
			localStorage.setItem('numero', '');
			localStorage.setItem('comuna', '');
			localStorage.setItem('auto', '');
			localStorage.setItem('opcional', '');	
		});
	</script>