<?php include('header.php'); ?>	<main>	
<?php
	$autoID = $_GET['autoID'];
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
			$autoFoto 	= $r['autoFoto'];
			$rautoDesc	= $r['autoDesc'];
		} 
    } 
?>		
	 	<div class="barra_naranja">
		 	<div class="container">
			 	<h4>resumen de la reserva</h4>
		 	</div><!-- /.container -->
	 	</div><!-- /.barra_naranja -->
	  
		<div class="container">
			
			<div class="row">
				<div class="col s12">
					<ul class="modelos_autos">
						<li>&nbsp</li>
					</ul>			
				</div><!-- /.col -->
				
				<div class="col l8 s12">

					<?php // include('include-upgrade.php'); ?>
					
					<div class="section">
						<table class="bordered">
			        <thead>
			          <tr>
			              <th>Detalle de la reserva:</th>
			              <th>&nbsp</th>
			              <th>&nbsp</th>
			          </tr>
			        </thead>
			
			        <tbody>
			          <tr>
			            <td>Arriendo Auto</td>
			            <td><?php echo $rautoDesc; ?><br><span class="los_dias"></span> / $<?php echo number_format($catPrec,0,',','.'); ?> por día</td>
			            <td>$<span class="dias2" data-valor="<?php echo $catPrec; ?>"></span></td>
			          </tr>
		<?  if($_GET['opcionales']){
				$opcionales = $_GET['opcionales'];
				$sql  = "select * from opcionales where opcID in ($opcionales) order by opcDesc";
			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {
						$opcPrec = $r['opcPrec'];
	    ?>   					          
			          <tr id="item_adicional">
			            <td><?php echo $r['opcDesc']; ?></td>
			            <td><span class="los_dias"></span> / $<?php echo number_format($opcPrec,0,',','.'); ?> por día</td>
			            <td>$<span class="dias2" data-valor="<?php echo $opcPrec; ?>"></span></td>
			          </tr>
		<?  		} 
			    } 
		    }?>
						
			          <tr>
			            <td>TOTAL</td>
			            <td></td>
			            <td>$<span class="supertotal"></span></td>
			          </tr>
			        </tbody>
			      </table>
		</div><!-- /.section -->
					
		<div class="section">
			<div class="reserva_home grey lighten-3">
	           	<div class="row">
	             	<form class="col s12 reserva_home_form grey lighten-3" id="formFinal" action="ajax/graba-arriendo.php">
		            	<div class="row">
	                		<div class="col l12 s12">
								<h6 class="grey-text text-darken-1">Información del conductor</h6>
							</div><!-- /.col -->
						</div><!-- /.row -->
						<div class="row">
		        	        <div class="input-field col s6">
								<input placeholder="Robinson" id="nombre" type="text" class="validate" name="nombre" required>
								<label for="nombre" class="grey-text text-darken-1">Nombre:</label>
		        	        </div>
		        	        <div class="input-field col s6">
								<input placeholder="Acuna" id="apellido" type="text" class="validate" name="apellido" required>
								<label for="apellido" class="grey-text text-darken-1">Apellido:</label>
		        	        </div>
							<div class="input-field col s6">
								<input placeholder="minombre@mimail.com" id="mail" type="email" name="mail" class="validate" required>
								<label for="comuna" class="grey-text text-darken-1">Email:</label>
		        	        </div>
							<div class="input-field col s6">
								<input placeholder="+56 9 9999 9999" id="fono" type="tel" name="fono" class="validate" required>
								<label for="comuna" class="grey-text text-darken-1">Teléfono:</label>
		        	        </div>
			        	    <div class="col l12 qwerty">
			            	    <p>
									<input type="checkbox" id="test5" name="recibir" value="1"/>
									<label for="test5" class="grey-text text-darken-1">Recibir publicidad vía Email.</label>
								</p>
			        	    </div>

					<?  if($_GET['opcionales']){
							$opcionales = $_GET['opcionales'];
							$sql  		= "select * from opcionales where opcID in ($opcionales) order by opcDesc";
						  	$resultado 	= $db->rawQuery($sql);
						  	$i = 0;
							if($resultado){
								foreach ($resultado as $r) {
									$opcPrec = $r['opcPrec'];
									$opcID = $r['opcID'];
				    ?>   					       
							<input type="hidden" name="opcional[<?php echo $i; ?>][opcID]" value="<?php echo $opcID; ?>">
					<?  		
									$i++;
								} 
						    } 
					    }?>	           	      
							<input type="hidden" name="autoID" value="<?php echo $autoID; ?>">
							<input type="hidden" name="total"  id="total"  value="">
							<input type="hidden" name="fecIni" id="fecIni" value="">
							<input type="hidden" name="horIni" id="horIni" value="">
							<input type="hidden" name="fecFin" id="fecFin" value="">
							<input type="hidden" name="horFin" id="horFin" value="">
							<input type="hidden" name="dias"   id="dias"   value="">
							<input type="hidden" name="resDesDir" id="resDesDir" value="">
							<input type="hidden" name="resDesNum" id="resDesNum" value="">
							<input type="hidden" name="resDesCom" id="resDesCom" value="">
							<input type="hidden" name="resDevol"  id="resDevol"  value="">
	         	      </div><!-- /.row -->
	         	      <div class="row">
		           	      <div class="col s12">
		             	      <button class="btn left z-depth-0" type="submit" name="action" id="btnArrendar">Arrendar</button>
		           	      </div><!-- .col -->
	         	      </div><!-- /.row -->
	         	    </form>
	           	      
					<div class="progress hide" id="progreso">
				    	<div class="indeterminate"></div>
					</div>
	           	</div><!-- /.row -->
	        </div><!-- /.reserva_home -->
	        	
	        	<div class="row">
							<div class="col s6"><a href="opcionales.php?autoID=<?php echo $autoID; ?>" target="" class="btn_white left">Volver</a></div>
							<div class="col s6">
								<a href="javascript:void(0);" class="btn_white right btn-cancel">Cancelar</a>
							</div>
						</div><!-- /.row -->
					</div><!-- /.section -->
         	
				</div><!-- /.col l8-->
	
				<div class="col l4 s12">
					<div class="box_side">
						<div class="box_orange">
							<p>Resumen de la reserva</p>
						</div><!-- /.box_txt -->

						<div class="item center">
							<img src="admin/ajax/uploads/<?php echo $autoFoto; ?>" width="210"/>
							<h5><?php echo get_segmento(get_segmento_cat($catID)); ?></h5>
							<p><?php echo $rautoDesc; ?> <small>o similar</small></p>
						  <div class="features_car">
								<span class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="<?php echo $catPas; ?> Pasajeros"><i class="fa fa-users" aria-hidden="true"></i> <?php echo $catPas; ?></span> /
	<!-- 											<i class="fa fa-suitcase" aria-hidden="true"></i> 4 / -->
								<span class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="<?php echo $caja2; ?>"><i class="fa fa-sitemap" aria-hidden="true"></i> <?php echo $caja; ?></span>
	
						  </div><!-- /.features_car -->
						  <p class="grey-text">$<?php echo number_format($catPrec,0,',','.'); ?> por día, total por <span class="dias" data-valor="<?php echo $catPrec; ?>"></span></p>
										
							<div class="dato_reserva">
								<p><a href="reservar.php" target="" class="btn_editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>editar</a></p>
							</div><!-- /.datos_reserva -->
						</div>
						
						<div class="divider"></div>
						
						<br>
						
						<div class="dato_reserva hide" id="direccion_entrega">
							<p><span>Donde entregar:</span><a href="index.php?editar=1" target="" class="btn_editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>editar</a></p>
							<p id="direccion"></p>
						</div><!-- /.datos_reserva -->
						
						<div class="dato_reserva hide" id="lugar_devolucion">
							<p><span>Devolución:</span><a href="index.php?editar=1" target="" class="btn_editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>editar</a></p>
							<p id="ladevolucion"></p>
						</div><!-- /.datos_reserva -->
						
						<div class="dato_reserva">
							<p><span>Fecha entrega:</span><a href="index.php?editar=1" target="" class="btn_editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>editar</a></p>
							<p id="fecha_desde"><i class="fa fa-cog fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span></p>
						</div><!-- /.datos_reserva -->
						
						<div class="dato_reserva">
							<p><span>Fecha devolución:</span><a href="index.php?editar=1" target="" class="btn_editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>editar</a></p>
							<p id="fecha_hasta"></p>
						</div><!-- /.datos_reserva -->
						
						<div class="divider"></div>
						
						<br>
						
						<div class="dato_reserva">
							<p><span>Opcionales:</span><a href="opcionales.php?autoID=<?php echo $autoID; ?>" target="" class="btn_editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>editar</a></p>
						<?  if($_GET['opcionales']){
								$opcionales = $_GET['opcionales'];
								$sql  = "select * from opcionales where opcID in ($opcionales) order by opcDesc";
							  	$resultado = $db->rawQuery($sql);
								if($resultado){
									foreach ($resultado as $r) {
										$opcPrec = $r['opcPrec'];
					    ?>   					          			
							<p><?php echo $r['opcDesc']; ?></p>
						<?  		} 
							    } 
						    }?>			
						</div><!-- /.datos_reserva -->
						
						<div class="box_grey">
							<p>Total: $<span class="supertotal"></span></p>
						</div><!-- /.box_txt -->
						
					</div><!-- /.box_side -->
				</div><!-- /.col -->
			</div><!-- /.row -->
			
		</div><!-- /.container -->
	</main>

<?php include('footer.php'); ?>