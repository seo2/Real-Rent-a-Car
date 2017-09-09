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
?>   
			<div class="col l3 m4 s6">
				<div class="item center vehiculo">
				  <img src="admin/ajax/uploads/<?php echo $r['autoFoto']; ?>" width="185" class="responsive-img"/>
				  <h5><?php echo get_segmento(get_segmento_cat($r['catID'])); ?></h5>
				  <p><?php echo $r['autoDesc']; ?></p>
				  <div class="features_car">
					  <i class="fa fa-users" aria-hidden="true"></i> 4 /
					  <i class="fa fa-suitcase" aria-hidden="true"></i> 4 /
					  <i class="fa fa-sitemap" aria-hidden="true"></i> M
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
