<? 
	
session_start();
	if($_SESSION['todos']['Logged']){ 
 
	$usuID = $_SESSION['todos']['id'];
	
	setcookie("id", $usuID, time()+3600, "/");
 
 }elseif($_COOKIE['id']) { 
 	$usuID = $_COOKIE['id'];
 }else{ ?>
 <script>
 		window.location.replace("index.php");
 </script>
	

<?  }  ?>
<? 
	include('header.php');
?>

    <div class="container" id="argumentos">
	    
		<header>
		    <span>Flota <?= $formato; ?></span>
	    </header>
		   
		    <div id="cajaposiciones" >
			    <div class="col-xs-12 col-md-8 col-md-offset-2" id="pedidohead">
					<div class="row">
				    	<div class="col-xs-9">
							<form class="horizontal-form" role="search">
								<div class="form-group">
									<select class="form-control" name="catID" required id="catID">
										<option value="">Filtrar por Categoría (todos)</option>
										<?
											if($_GET['catID'] ){
												$catID = $_GET['catID'];
											}else{
												$catID = 0;
											}
										$tema = $db->rawQuery('select * from autos_categorias');
										if($tema){
											foreach ($tema as $t) {
										?>
										<option value="<?= $t['catID']; ?>" <? if($t['catID']==$catID){ ?>selected<? } ?>><?= $t['catDesc']; ?></option>
										<?		
											}
										}
										?>
									</select>
								</div>
							</form>
						</div>	
				    	<div class="col-xs-3 text-right">
					    	<?php if($usuTipo==1){ ?>
				    		<a href="formulario-flota.php" class="btn btn-default"><span class="hidden-xs"><? if($paisID==7){ ?>Adicionar<? }else{ ?>Agregar<? } ?> </span><i class="fa fa-plus-circle"></i></a>
				    		<?php } ?>
				    	</div>
					</div>
				</div>
			    
			<?
			if($_GET['catID'] && $_GET['catID'] >0){
				$catID = $_GET['catID'];
				$sql0  = "select * from autos_flota where catID = $catID";
			}else{
				$sql0  = "select * from autos_flota order by catID";
			}
			
		  	$formatos = $db->rawQuery($sql0);
			if($formatos){
				foreach ($formatos as $r) {	
					if($r['autoEst']==1){ 
						$estado = 'off';
						$estDesc = 'Inactivo';						
					}else{ 
						$estado = 'on';
						$estDesc = 'Activo';
					} 
		    ?>   
		    
				<div class="col-xs-12 col-md-8 col-md-offset-2 posicion">
					<div class="row">					
						<div class="col-sm-1">
							<a href="javascript:void(0)" data-camid="<?php echo $segID; ?>" data-estado="<?php echo $estado; ?>" class="cambiaEstado" data-toggle="tooltip" data-placement="right"  title="<?php echo $estDesc; ?>">
								<i class="fa fa-toggle-<?php echo $estado; ?>" aria-hidden="true"></i></span>
							</a>
						</div>					
						<div class="col-sm-2">
							<?php if($r['autoFoto']){ ?>
								<img src="ajax/uploads/<?php echo $r['autoFoto']; ?>" class="img-responsive">
							<?php } ?>
						</div>
						<div class="col-xs-6 postema nopadl nopadr">
								<?php if($usuTipo==1){ ?><a href="formulario-flota.php?autoID=<?= $r['autoID']; ?>"><?php } ?><?= $r['autoDesc']; ?><?php if($usuTipo==1){ ?></a><?php } ?> <span><?= $r['autoPatente']; ?></span>
								<br><span><?= get_categoria($r['catID']); ?></span>
							</div>
						<div class="col-xs-3 text-right posvotos">
							<?php if($usuTipo==1){ ?>
							<a href="formulario-flota.php?autoID=<?= $r['autoID']; ?>" class="btn btn-default"><i class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a> 
							<?php } ?>
						</div>
					</div>
				</div>
		    <? 		} 
			    } ?>
			    	
			    		    
		    </div>

	    	<div id="footer" class="blancobg">
		    	<div class="container">
			    	<div class="row">
						<div class="col-xs-12 col-md-6 col-md-offset-3 footer">
							
					    	<? 
								$back = 'maestros.php';
							?>
							<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">
							  <a href="<?php echo $back; ?>" 	class="btn btn-default"><i class="fa fa-chevron-left"></i> <? if($paisID==7){ ?>Voltar<? }else{ ?>Volver<? } ?></a>
							  <a href="home.php" 				class="btn btn-default"><i class="fa fa-home"></i> Home</a>
							  <a href="javascript:void();" 		class="btn btn-default" id="logoutBtn"><i class="fa fa-sign-out"></i> <? if($paisID==7){ ?>Sair<? }else{ ?>Salir<? } ?></a>
							</div>
				    	</div>
			    	</div>
		    	</div>
	    	</div>       

		    
<? include('footer.php'); ?>




