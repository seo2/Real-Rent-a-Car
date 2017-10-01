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
								<img src="assets/img/autos/nissan_march_ss_16.jpg" width="210"/>
								<h5>Nissan</h5>
								<p>March SS 1.6</p>
								  <div class="features_car">
									  <i class="fa fa-users" aria-hidden="true"></i> 4 /
									  <i class="fa fa-suitcase" aria-hidden="true"></i> 4 /
									  <i class="fa fa-sitemap" aria-hidden="true"></i> M
								  </div><!-- /.features_car -->
							</div><!-- /.item -->
							
							<br>
							
							<div class="divider"></div>
							
							<h5 class="titulo">Detalle de la reserva:</h5>
							<div class="dato_reserva">
								<p><span>Donde entregar:</span></p>
								<p><?php echo $resDesDir; ?> <?php echo $resDesNum; ?>, <?php echo get_comuna($resDesCom); ?></p>
							</div><!-- /.datos_reserva -->
							
							<div class="dato_reserva">
								<p><span>Devolución: <?php echo $devolucion; ?>.</span></p>
							</div><!-- /.datos_reserva -->
							
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
				            <td>Nissan March SS 1.6<br>5 días / $22.990 por día</td>
				            <td>$114.950</td>
				          </tr>
				          <tr>
				            <td>Ítems Adicionales</td>
				            <td>GPS<br>5 días / $5.990 por día</td>
				            <td>$29.950</td>
				          </tr>
				          <tr>
				            <td>TOTAL</td>
				            <td></td>
				            <td>$140.900</td>
				          </tr>
				        </tbody>
				      </table>
							
							<br>
							
							<div class="row">
								<div class="col s6"><a href="" target="" class="btn_white left">Volver</a></div>
								<div class="col s6">
									<a href="" target="" class="btn_white right">Imprimir</a>
								</div>
							</div><!-- /.row -->
							
						</div><!-- /.col -->
					</div><!-- /.row -->
											
					
					
				</div><!-- /.section -->
				
			</div><!-- /.row -->
			
		</div><!-- /.container -->
	</main>

<?php include('footer.php'); ?>