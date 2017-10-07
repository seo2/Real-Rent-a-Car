<?php include('header.php'); ?>	
<?php 
	$autoID = $_GET['autoID'];	
?>
<main>	
	 	<div class="barra_naranja">
		 	<div class="container">
			 	<h4>Ítems opcionales</h4>
		 	</div><!-- /.container -->
	 	</div><!-- /.barra_naranja -->
	  
		<div class="container">
			
			<div class="row">
				<div class="col s12">
					<ul class="modelos_autos">
						<li>No gracias, ver Resumen de Reserva y proceder a <a href="resumen_reserva.php?autoID=<?php echo $autoID; ?>" target="_self">Arrendar</a></li>
					</ul>			
				</div><!-- /.col -->
				
				<div class="col l8 s12">
					
					<div class="box_cars">
					
						<div class="box_grey">
							<p>Los valores incluyen IVA</p>
						</div><!-- /.box_txt -->
		<?
			$sql  = "select * from opcionales where opcEst = 0 order by opcDesc";
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
	    ?>   						
						<div class="box_car">
							<div class="row">
								<div class="col m12 s12">
									<div class="box_info">
										<h5><?= $r['opcDesc']; ?></h5>
										<p>$<?= number_format($r['opcPrec'],0,',','.'); ?> por día, total por <span class="dias" data-valor="<?php echo $r['opcPrec']; ?>"></span></p>
										<a href="javascript:void(0);" class="btn_orange btn-opcional" data-valor="" data-id="<?php echo $r['opcID']; ?>">Agregar</a>
									</div>
								</div><!-- /.col -->
							</div><!-- /.row -->
						</div><!-- /.box_car -->
	    <?  	} 
		    } ?>
						
					</div><!-- /.box_cars -->
					<div class="row">
						<div class="col s6"><a href="javascript:void(0);" target="" class="btn_white left">Cancelar</a></div>
						<div class="col s6">
							<a href="resumen_reserva.php?autoID=<?php echo $autoID; ?>" target="" class="btn_orange right" id="btn_continuar">Continuar</a>
							<a href="reservar.php" target="" class="btn_white right" style="margin-right: 10px;">Volver</a>
						</div>
					</div><!-- /.row -->
				</div><!-- /.col l8-->
	
				<div class="col l4 s12">
					<div class="box_side">
						<div class="box_orange">
							<p>Resumen de la reserva</p>
						</div><!-- /.box_txt -->
<?php
					
					$sql0  = "select * from autos_flota where autoID = $autoID";					
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
?>	
						<div class="item center">
							<img src="admin/ajax/uploads/<?php echo $r['autoFoto']; ?>" width="210"/>
							<h5><?php echo get_segmento(get_segmento_cat($r['catID'])); ?></h5>
							<p><?php echo $r['autoDesc']; ?> <small>o similar</small></p>
						  <div class="features_car">
								<span class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="<?php echo $catPas; ?> Pasajeros"><i class="fa fa-users" aria-hidden="true"></i> <?php echo $catPas; ?></span> /
	<!-- 											<i class="fa fa-suitcase" aria-hidden="true"></i> 4 / -->
								<span class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="<?php echo $caja2; ?>"><i class="fa fa-sitemap" aria-hidden="true"></i> <?php echo $caja; ?></span>
	
						  </div><!-- /.features_car -->
						  <p class="grey-text">$<?php echo number_format($catPrec,0,',','.'); ?> por día, total por <span class="dias" data-valor="<?php echo $catPrec; ?>"></span></p>
<?php 				
					} 
			    } 
?>												
							<div class="dato_reserva">
								<p><a href="reservar.php" target="" class="btn_editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>editar</a></p>
							</div><!-- /.datos_reserva -->
						</div>
						
						<div class="divider"></div>
						
						<br>
						
						<div class="dato_reserva hide" id="direccion_entrega">
							<p><span>Donde entregar:</span><a href="index.php?editar=1&paso=3" target="" class="btn_editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>editar</a></p>
							<p id="direccion"></p>
						</div><!-- /.datos_reserva -->
						
						<div class="dato_reserva hide" id="lugar_devolucion">
							<p><span>Devolución:</span><a href="index.php?editar=1&paso=3" target="" class="btn_editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>editar</a></p>
							<p id="ladevolucion"></p>
						</div><!-- /.datos_reserva -->
						
						<div class="dato_reserva">
							<p><span>Fecha entrega:</span><a href="index.php?editar=1&paso=3" target="" class="btn_editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>editar</a></p>
							<p id="fecha_desde"><i class="fa fa-cog fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span></p>
						</div><!-- /.datos_reserva -->
						
						<div class="dato_reserva">
							<p><span>Fecha devolución:</span><a href="index.php?editar=1&paso=3" target="" class="btn_editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>editar</a></p>
							<p id="fecha_hasta"></p>
						</div><!-- /.datos_reserva -->
						
						<div class="box_grey">
							<p>Total: $<span class="supertotal1"></span></p>
						</div><!-- /.box_txt -->
						
					</div><!-- /.box_side -->
				</div><!-- /.col -->
			</div><!-- /.row -->
			
		</div><!-- /.container -->
	</main>

<?php include('footer.php'); ?>