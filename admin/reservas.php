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
<? include('header.php');	?>
<?
	$cola = '';
	if($_GET['paisID']){
		$paisID = $_GET['paisID'];
		$cola = '&paisID='.$paisID;
	}


	
	if($_GET['desde']){
		
	}else{
			
	}
?>

    <div class="container-fluid" id="argumentos">
	    
		<header>
		    <span>Reservas</span>
	    </header>

	    <div id="cajaposiciones">
		    <div class="col-xs-12" id="pedidohead">
			    <div class="row">
			    	<div class="col-xs-6">
						<h2>Reservas</h2> 
			    	</div>
			    	<div class="col-xs-6 text-right hide">
			  			<form method="get" id="formFechas" class="form-inline">
			  				<div class="form-group">
								<label>Desde:</label>
								<input type="date" class="form-control" name="desde" required value="<?= $fecini; ?>">
							</div>	
							<div class="form-group">
								<label>Hasta:</label>
								<input type="date" class="form-control" name="hasta" required value="<?= $fecfin; ?>">
							</div>	
							<div class="form-group">
								<button type="submit" class="btn btn-primary " ><i class="fa fa-refresh" aria-hidden="true"></i></button>
							</div>
			  			</form>
			    	</div>
			    	<div class="col-xs-6 text-right">
			  			<form method="get" id="formFechas" class="form-inline">
							<div class="form-group">
								<label for="exampleInputName2">Estado</label>
								<select class="form-control" id="aaaa" name="aaaa">
								  <option value="2017" <? if($_GET['aaaa'] && $_GET['aaaa'] == '2017'){ ?>selected<? } ?>>2017</option>
								  <option value="2016" <? if($_GET['aaaa'] && $_GET['aaaa'] == '2016'){ ?>selected<? } ?>>2016</option>
								</select>
							</div>
							<div class="form-group">
								<a class="btn btn-primary" href="dashboard-excel.php?aaaa=<?= $anoactual; ?>" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
							</div>
			  			</form>
			    	</div>
			    </div>
		    </div>

					<div class="row">		
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<table class="table table-bordered table-hover table-condensed dashboard" id="latabla">
									  <thead>
										  <tr >
											  <th>Nº</th>
											  <th>Nombre</th>
											  <th>Mail</th>
											  <th>Fono</th>
											  <th>Cat.</th>
											  <th>Auto</th>
											  <th>Patente</th>
											  <th>Desde</th>
											  <th>Hasta</th>
											  <th>Días</th>
											  <th>Entrega</th>
											  <th>Devolución</th>
											  <th>Valor Total</th>
											  <th>Estado</th>
											  <th>Fecha</th>
										  </tr>
									  </thead>   
									  <tbody>
<?
			  	$reservas_sql = $db->rawQuery("SELECT * from reservas order by resID DESC");
				if($reservas_sql){
					foreach ($reservas_sql as $f) {
?>
										<tr class="formato">
											<td><a href="formulario-reservas.php?resID=<?php echo $f['resID']; ?>"><?php echo $f['resID']; ?> <i class="fa fa-pencil-square-o" aria-hidden="true"></td>
											<td><?php echo $f['resNom']; ?> <?php echo $f['resApe']; ?></td>
											<td><?php echo $f['resMail']; ?></td>
											<td class="text-right"><?php echo $f['resFono']; ?></td>
											<td><?php echo get_categoria(get_cat_auto($f['resAuto'])); ?></td>
											<td><?php echo get_auto($f['resAuto']); ?></td>
											<td><?php echo get_pat_auto($f['resAuto']); ?></td>
											<td><?php echo $f['resFecIni']; ?> <?php echo $f['resHorIni']; ?></td>
											<td><?php echo $f['resFecFin']; ?> <?php echo $f['resHorFin']; ?></td>
											<td class="text-right"><?php echo $f['resDias']; ?></td>
											<?php if($f['resDesDir']){ ?>
											<td><?php echo $f['resDesDir']; ?> <?php echo $f['resDesNum']; ?>, <?php echo get_comuna($f['resDesCom']); ?></td>
											<?php }else{ ?>
											<td>Oficina Real Rent a Car</td>
											<?php } ?>
											<?php 
											if($f['resDevol']==1 || !$f['resDevol']){
											    $devolucion = "Oficina de Real Rent a Car";
										    }elseif($f['resDevol']==2){
											    $devolucion = "Misma dirección de entrega";
										    }elseif($f['resDevol']==3){
											    $devolucion = "Lugar a acordar telefónicamente";
										    } ?>
											<td><?php echo $devolucion; ?></td>
											<td class="text-right">$<?php echo number_format($f['resValTot'],0,',','.'); ?></td>
											<?php if( $f['resEst']==0){ ?>
											<td><span class="label label-info">Por Confirmar</span></td>
											<?php }elseif( $f['resEst']==1){ ?>
											<td><span class="label label-primary">Confirmado</span></td>
											<?php }if( $f['resEst']==2){ ?>
											<td><span class="label label-success">Entregado</span></td>
											<?php }if( $f['resEst']==3){ ?>
											<td><span class="label label-danger">No Show</span></td>
											<?php }if( $f['resEst']==4){ ?>
											<td><span class="label label-default">Recepcionado</span></td>
											<?php }  ?>
											<td><?php echo $f['resTS']; ?></td>
										</tr>
										
		    <? 		
			    
			    	} 
			    } ?>																			
									  </tbody>
								  </table>            
								</div>
							</div>
						</div><!--/col-->
					
					</div><!--/row-->			    
			    
				<div class="clear"></div>
		    </div>

	    	<footer>
		    	<? 
				if($_GET['paisID']){ ?>
		    	<a href="paises.php" id="btnvolver"><i class="fa fa-chevron-left"></i> <span><? if($paisID==7){ ?>Voltar<? }else{ ?>Volver<? } ?></span></button>
				<? }else{ ?>
		    	<a href="home.php" id="btnvolver"><i class="fa fa-chevron-left"></i> <span><? if($paisID==7){ ?>Voltar<? }else{ ?>Volver<? } ?></span></button>
				<? } ?>
	    	</footer>	    



   
        </div><!-- fin container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

	<script src="assets/js/tableExport.js">
	<script src="assets/js/jquery.base64.js">
		
		
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="//oss.maxcdn.com/jquery.form/3.50/jquery.form.min.js"></script>
    <script src="assets/js/formValidation.min.js"></script>
    <script src="assets/js/language/es_ES.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
	<script src="assets/js/framework/bootstrap.min.js"></script>
    
	<script src="assets/js/jquery.validate.js"></script>
    
    <script src="assets/js/sweetalert.min.js"></script>
    <script src="assets/js/jquery.ddslick.min.js"></script>

    <script src="assets/js/visualapp.js?ver=2.4"></script>
  
    
    
  </body>
</html>