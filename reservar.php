<?php include('header.php'); ?>
	<main>	
	 	<div class="barra_naranja">
		 	<div class="container">
			 	<h4>ELIGE TU VEHÍCULO</h4>
		 	</div><!-- /.container -->
	 	</div><!-- /.barra_naranja -->
	  
		<div class="container">
			
			<div class="row">
				<div class="col s12">
					<ul class="modelos_autos">
						<li><a href="javascript:void(0);" data-filter="*" class="selected">Todos</a></li>
		<?
			$sql  = "select * from autos_segmentos where segEst = 0 order by segNom";
		  	$resultado = $db->rawQuery($sql);
			if($resultado){
				foreach ($resultado as $r) {
	    ?>   
	    						
						<li>/</li>
						<li><a href="javascript:void(0);" data-filter="segmento-<?php echo $r['segID']; ?>" class=""><?= $r['segNom']; ?></a></li>
	    <?  	} 
		    } ?>	
					</ul>			
				</div><!-- /.col -->
				
				<div class="col l8 s12">
					
					<div class="box_cars">
					
						<div class="box_grey">
							<p>Los valores incluyen IVA</p>
						</div><!-- /.box_txt -->
<?php
	
				$fecIni = $_GET['ini'];
				$fecFin = $_GET['fin'];
				$sql  = "select * from autos_categorias";
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
						$catPas  = $c['catPas'];
						$catPrec = $c['catPrec'];
						$catDesc = $c['catDesc'];	
						$catID   = $c['catID'];
						$ok 	 = 0;
						$auto    = 0;
						$sql0  = "select * from autos_flota where catID = $catID and autoEst = 0 and autoFoto != ''";					
					  	$formatos = $db->rawQuery($sql0);
						if($formatos){
							foreach ($formatos as $r) {	
								$autoFoto = $r['autoFoto'];
								$autoDesc = $r['autoDesc'];
								$autoID   = $r['autoID'];
								
								$resFecIni = date("Y-m-d", strtotime(str_replace('/', '-',$fecIni)));
								$resFecFin = date("Y-m-d", strtotime(str_replace('/', '-',$fecFin)));
								$ok 	   = 1;
								$pasa 	   = 0;
								$auto      = 1;
								$sql1     = "select * from reservas where resAuto = $autoID and resFecIni >= '$resFecFin'";
												
							  	$formatos = $db->rawQuery($sql1);
								if($formatos){
									foreach ($formatos as $f) {	
										$ok 	  = 0;
										$pasa 	  = 1;
									} 
								} 
								
								$sql2     = "select * from reservas where resAuto = $autoID and resFecFin >= '$resFecIni'";	
								//echo $sql2;			
							  	$formatos = $db->rawQuery($sql2);
								if($formatos){
									foreach ($formatos as $f) {	
										$ok 	  = 0;
										$pasa     = 2;
									} 
								} 
								
								
								
								$sql3     = "select * from reservas where resAuto = $autoID and resFecIni >= '$resFecIni' and resFecFin <= '$resFecFin'";	
								
							  	$formatos = $db->rawQuery($sql3);
								if($formatos){
									foreach ($formatos as $f) {	
										$ok 	  = 0;
										$pasa     = 3;
									} 
								} 
								
								
								if($ok==1){
									break;
								}
							} 
						} 
						//echo $pasa;
						
	if($auto      == 1){ 
?>	
						<div class="box_car grid-item segmento-<?php echo get_segmento_cat($c['catID']); ?>">
							<div class="row">
								<div class="col m4 s12 center">
									<img src="admin/ajax/uploads/<?php echo $autoFoto; ?>" width="210"/>
								</div><!-- /.col -->
								<div class="col m8 s12">
									<div class="box_info">

										<h5><?php echo get_segmento(get_segmento_cat($c['catID'])); ?> <small>Categoría <?php echo $catDesc; ?></small></h5>
										<p><?php echo $autoDesc; ?> <small>o similar</small></p>
										<div class="features_car">
											<span class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="<?php echo $catPas; ?> Pasajeros"><i class="fa fa-users" aria-hidden="true"></i> <?php echo $catPas; ?></span> /
<!-- 											<i class="fa fa-suitcase" aria-hidden="true"></i> 4 / -->
											<span class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="<?php echo $caja2; ?>"><i class="fa fa-sitemap" aria-hidden="true"></i> <?php echo $caja; ?></span>
 
											
										</div><!-- /.features_car -->
									  <p class="grey-text">$<?php echo number_format($catPrec,0,',','.'); ?> por día, total por <span class="dias" data-valor="<?php echo $catPrec; ?>"></span></p>
<?php	if($ok==1){ ?>
									  <a href="javascript:void(0);" target="" class="btn_orange btn-elegir btn-auto" data-auto="<?php echo $autoID; ?>" >Elegir</a>
<?php 	}else{ ?>
									  <p>Categoría no disponible para las fechas seleccionadas.</p>
<?php 	} ?>
									</div>
								</div><!-- /.col -->
							</div><!-- /.row -->
						</div><!-- /.box_car -->
<?php 					}			
					} 
			    } 
?>						
					</div><!-- /.box_cars -->
						
						<div class="row">
							<div class="col s6"><a href="javascript:void(0);" target="" class="btn_white left">Cancelar</a></div>
							<div class="col s6"><a href="index.php" target="" class="btn_white right">Volver</a></div>
						</div>
				</div><!-- /.col l8-->
	
				<div class="col l4 s12">
					<div class="box_side">
						<div class="box_orange">
							<p>Resumen de la reserva</p>
						</div><!-- /.box_txt -->
						
						<div class="dato_reserva hide" id="direccion_entrega">
							<p><span>Donde entregar:</span><a href="index.php?editar=1&paso=2" target="" class="btn_editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>editar</a></p>
							<p id="direccion"></p>
						</div><!-- /.datos_reserva -->
						
						<div class="dato_reserva hide" id="lugar_devolucion">
							<p><span>Devolución:</span><a href="index.php?editar=1&paso=2" target="" class="btn_editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>editar</a></p>
							<p id="ladevolucion"></p>
						</div><!-- /.datos_reserva -->
						
						<div class="dato_reserva">
							<p><span>Fecha entrega:</span><a href="index.php?editar=1&paso=2" target="" class="btn_editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>editar</a></p>
							<p id="fecha_desde"><i class="fa fa-cog fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span></p>
						</div><!-- /.datos_reserva -->
						
						<div class="dato_reserva">
							<p><span>Fecha devolución:</span><a href="index.php?editar=1&paso=2" target="" class="btn_editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>editar</a></p>
							<p id="fecha_hasta"></p>
						</div><!-- /.datos_reserva -->
						
					</div><!-- /.box_side -->
				</div><!-- /.col -->
			</div><!-- /.row -->
			
		</div><!-- /.container -->
	</main>

<?php include('footer.php'); ?>