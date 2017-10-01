<?php
	require_once("admin/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>REAL Rent a Car</title>
  <link rel="icon" type="image/png" href="assets/img/icono.png" />

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="assets/fonts/font-awesome-4.6.3/css/font-awesome.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
  <link href="assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="assets/css/style.css?ver=2" type="text/css" rel="stylesheet" media="screen,projection"/>
  
</head>

<body>

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
			$resValTot	= $r['resValTot'];
		} 
    } 
?>		
	<main>	
		<div class="container">
			<div class="row">
				<div class="section">
					<div class="row">
						<div class="col l8 offset-l2 s12">
							
							<h5 class="titulo">Tu número de confirmación es <?php echo str_pad($resID, 5, '0', STR_PAD_LEFT); ; ?></h5>
							
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
								<p>Miguel Claro 1457, Providencia</p>
							</div><!-- /.datos_reserva -->
							
							<div class="dato_reserva">
								<p><span>Fecha entrega:</span></p>
								<p>26 Junio 2017</p>
							</div><!-- /.datos_reserva -->
							
							<div class="dato_reserva">
								<p><span>Fecha devolución:</span></p>
								<p>30 Junio 2017</p>
							</div><!-- /.datos_reserva -->
							
							<div class="dato_reserva">
								<p><span>devolución mismo lugar de entrega.</span></p>
							</div><!-- /.datos_reserva -->
							
							<div class="dato_reserva">
								<p><span>Ítem Opcional:</span></p>
								<p>GPS</p>
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
		
							
						</div><!-- /.col -->
					</div><!-- /.row -->
											
					
					
				</div><!-- /.section -->
				
			</div><!-- /.row -->
			
		</div><!-- /.container -->
	</main>

  </body>
</html>