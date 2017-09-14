<?php include('header.php'); ?>
<main>	
 	<div class="barra_naranja">
	 	<div class="container">
		 	<h4>VEHÍCULOS</h4>
	 	</div><!-- /.container -->
 	</div><!-- /.barra_naranja -->
  
 	<div class="container">
	<div class="section">	
		<div class="row">
<?php
			$sql0  = "select * from autos_flota where autoEst = 0 and autoFoto != '' order by catID";					
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
			<div class="col l3 m4 s6">
				<div class="item center vehiculo">
				  <img src="admin/ajax/uploads/<?php echo $r['autoFoto']; ?>" width="185" class="responsive-img"/>
				  <h5><?php echo get_segmento(get_segmento_cat($r['catID'])); ?></h5>
				  <p><?php echo $r['autoDesc']; ?></p>
				  <div class="features_car">
					<span class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="<?php echo $catPas; ?> Pasajeros"><i class="fa fa-users" aria-hidden="true"></i> <?php echo $catPas; ?></span> /
<!-- 											<i class="fa fa-suitcase" aria-hidden="true"></i> 4 / -->
					<span class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="<?php echo $caja2; ?>"><i class="fa fa-sitemap" aria-hidden="true"></i> <?php echo $caja; ?></span>
				  </div><!-- /.features_car -->
				  <a href="" target="" class="btn_orange">Reservar</a>
				</div>
			</div><!-- /.col -->
<?php 				
					} 
			    } 
?>	
		</div><!-- /.section -->	
	</div><!-- /.row -->
</div><!-- /.container -->
</main>

<?php include('footer.php'); ?>
