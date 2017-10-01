<?php include('header.php'); ?>

	<div id="portada" class="intro">
    <div class="intro-body">
        <div class="container">
            <div class="row">
              <div class="col l6 m12 hide-on-small-only">
	              <div class="section">
		              <div class="home_titulo_a">Donde nos necesites,</div>
		              <div class="home_titulo_b">ahí estaremos.</div>
	              </div><!-- /.section -->
              </div><!-- /.col -->
              <div class="col l6 m12">
               	<div class="reserva_home" id="reserva_home">
                 	<div class="row">
<!--
	                 	<div class="col l3 s3">
	                 		<img src="assets/img/logo_blanco.png" width="70" class="responsive-img"/>
	                 	</div>
-->
	                 	<div class="col l12">
							<h6>Arrienda con nosotros y te llevamos el auto donde estés dentro de Santiago.</h6>
	                 	</div><!-- /.col -->
                 	</div><!-- /.row -->
                 	
                 	<div class="row">
	                 	
                 		<div class="divider"></div>
                 		
	                	<ul>
		                	<li><a href="javascript:void(0);" target="" class="selected">Reservar</a></li>
<!--
		                	<li>/</li>
		                	<li><a href="" target="" class="">Ver Reserva</a></li>
-->
	                	</ul>
                 	
						<div class="divider"></div>
									 	
                	</div><!-- /.row -->
                 	
					<div class="row">
	                	<form class="col s12 reserva_home_form" id="formReserva">
							<div class="row">
		               	        <div class="input-field col s6 m3">
		               	          <input placeholder="02/01/2009" id="desde_el" type="date" class="validate datepicker" readonly="readonly" name="desde">
		               	          <label for="desde_el">Desde el:</label>
		               	        </div>
		               	        <div class="input-field col s6 m3">
		               	          <input placeholder="00:00" id="desde_elh" type="time" class="validate timepicker" name="desdeh">
<!-- 		               	          <label for="desde_elh">Hora:</label> -->
		               	        </div>
		               	        
		               	        <div class="input-field col s6 m3">
		               	          <input placeholder="24/09/2011" id="hasta_el" type="date" class="validate datepicker" readonly="readonly" name="hasta">
		               	          <label for="hasta_el">Hasta el:</label>
		               	        </div>
		               	        <div class="input-field col s6 m3">
		               	          <input placeholder="00:00" id="hasta_elh" type="time" class="validate timepicker" name="hastah">
<!-- 		               	          <label for="hasta_elh">Hora:</label> -->
		               	        </div>
							</div>
							<div class="row">
		                 	    <div class="col l12">
			                 	    <p>
									    <input type="checkbox" id="test5" name="entrega" />
									    <label for="test5">Deseo entrega a domicilio</label><br><br>
									</p>
		                 	    </div>
		               	        <div id="entrega" style="display:none;">
			               	        <div class="input-field col s8">
										<input placeholder="Infante" id="direccion" type="text" class="validate" name="direccion">
										<label for="direccion">Dirección:</label>
			               	        </div>
			               	        <div class="input-field col s4">
										<input placeholder="22" id="numero" type="text" class="validate" name="numero">
										<label for="numero">Número:</label>
			               	        </div>
			               	        <div class="input-field col s12">
										<select  id="comuna" name="comuna" class="validate">
											<option value="" disabled selected>Seleccione comuna</option>
											<?
												$sql  = "select * from comuna where comuna_provincia_id = 131 order by comuna_nombre";
											  	$resultado = $db->rawQuery($sql);
												if($resultado){
													foreach ($resultado as $r) {
										    ?>  
											<option value="<?= $r['comuna_id']; ?>"><?= $r['comuna_nombre']; ?></option>
										    <?  	} 
											    } ?>	
										</select>
										<label for="comuna" class="active">Comuna:</label>
			               	        </div>
			               	        <div class="input-field col s12">
										<select  id="devolucion" name="devolucion" class="validate">
<!-- 											<option value="" disabled selected>Seleccione</option>  -->
											<option value="1">Oficinas de Real Rent a Car</option>	 
											<option value="2">Misma dirección de entrega</option> 
											<option value="2">Lugar a acordar telefónicamente</option>
										</select>
										<label for="devolucion" class="active">Devolución:</label>
			               	        </div>
<!--
			                 	    <div class="col l12">
				                 	    <p>
										    <input type="checkbox" id="test6" />
										    <label for="test6">¿Retiramos el vehículo en la misma dirección?</label>
										</p>
			                 	    </div>
-->
		               	        </div>
							</div><!-- /.row -->
							<div class="row">
								<div class="col s12">
									<button class="btn left z-depth-0" type="submit" name="action">Hacer Reserva</button>
								</div><!-- .col -->
							</div><!-- /.row -->
								<div class="progress hide" id="progreso">
							      <div class="indeterminate"></div>
							  </div>
						</form>
                	</div><!-- /.row -->
               	</div><!-- /.reserva_home -->
              </div><!-- /.col -->
            </div>
        </div>
    </div>
	</div><!-- /portada -->
  
	<div class="container">
		<div class="section">
	    <div class="row">
		    <div class="col s12">
		    	<h4 class="titulos">Arrienda con Nosotros</h4>
		    </div>
		  </div><!-- /.row -->
			<div class="row">
	      <div class="col s12 m4">
	        <div class="features">
	          <i class="fa fa-car features_icono" aria-hidden="true"></i>
	        	<div class="features_content">
	           	<h5>Amplia gama de vehículos</h5>
	          	<p>Sujetos a disponibilidad.</p>
	        	</div>
	        </div><!-- /features -->
	      </div><!-- /.col -->
	      <div class="col s12 m4">
	        <div class="features">
		        <i class="fa fa-credit-card features_icono" aria-hidden="true"></i>
	        	<div class="features_content">
	          	<h5>3 cuotas sin intereses</h5>
	          	<p>Aceptamos todas las tarjetas bancarias.</p>
	        	</div>
	        </div><!-- /features -->
	      </div><!-- /.col -->
	      <div class="col s12 m4">
	        <div class="features">
		        <i class="fa fa-map-marker features_icono" aria-hidden="true"></i>
	        	<div class="features_content">
	          	<h5>Llevamos el vehículo donde estés.</h5>
	          	<p>El costo varía según tramos.</p>
	        	</div>
	        </div><!-- /features -->
				</div><!-- /.col -->
			</div><!-- /.row -->
	  </div><!-- /.section -->
		
		<div class="section">	
			<div class="row">
				<div class="col l12 m12 s12">
					<div id="owl-demo" class="owl-carousel owl-theme">
<?php
					$sql0  = "select * from autos_flota where autoEst = 0 and autoFoto != '' group by catID order by catID";					
				  	$formatos = $db->rawQuery($sql0);
					if($formatos){
						foreach ($formatos as $r) {	
?>   
						<div class="item center">
						  <img src="admin/ajax/uploads/<?php echo $r['autoFoto']; ?>" width="185"/>
						  <h5><?php echo get_segmento(get_segmento_cat($r['catID'])); ?></h5>
						  <p><?php echo $r['autoDesc']; ?></p>
						  <a href="#reserva_home" class="btn_orange">Reservar</a>
						</div>
<?php 				
					} 
			    } 
?>
					</div><!-- /.owl -->
				</div><!-- /.col -->
			</div><!-- /.row -->	
		</div><!-- /.section -->
		
		<div class="section"></div><!-- /.section -->
	</div><!-- /.container -->

<?php include('footer.php'); ?>
<?php if($_GET['editar']!=1){ ?>
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
			$('#desde_el').val('');
			$('#hasta_el').val('');
			$('#desde_elh').val('');
			$('#hasta_elh').val('');
		});
	</script>
<?php } ?>