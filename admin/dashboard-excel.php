<? 
session_start();
require_once("functions.php");

if($_SESSION['todos']['Logged']){ 
	
	//setcookie('id', $_SESSION['todos']['id']);
 
	$usuID = $_SESSION['todos']['id'];
	$paisID 	= get_userpais($usuID);
	$usuTipo 	= get_usertipo($usuID);
	
	setcookie("id", $usuID, time()+3600, "/");
 
 }elseif($_COOKIE['id']) { 
 	$usuID = $_COOKIE['id'];
	$paisID 	= get_userpais($usuID);
	$usuTipo 	= get_usertipo($usuID);
 }else{ 
	 echo 'No está autorizado para ver este archivo';
		exit;
 }
	if($_GET['aaaa']){
		$anito =  $_GET['aaaa'];
	}else{
		$anito =  date("Y");
	}
	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-disposition: attachment; filename=Resumen-x-Tienda-$anito.xls" );
	require_once("functions.php");

	function pedidos_x_tienda_x_rango_fecha($tieID,$ini,$fin){
		$db = MysqliDb::getInstance();
		$sql  = "SELECT sum(b.ptdValor) as valor FROM pedido_temporal a, pedido_temporal_detalle b WHERE a.ptTS>='$ini'  AND a.ptTS< '$fin' AND a.ptTie = $tieID AND b.ptID = a.ptID AND b.ptdEst >=7";
		$valor = 0;
	  	$c = $db->rawQuery($sql);
		if($c){
			foreach ($c as $p) {
				$valor = $p['valor'];
			} 
	    } 
	    
	    return $valor;
	    
	}


	function pedidos_x_formato_x_rango_fecha($formID,$ini,$fin,$paisID){
		$db = MysqliDb::getInstance();
	
		$total = 0;
		
		$tiendas_sql  = "SELECT * from tiendas where tieForm = $formID and paisID = $paisID";
	  	$tiendas = $db->rawQuery($tiendas_sql);
		if($tiendas){
			foreach ($tiendas as $t) {
				$tieID = $t['tieID'];
				$valor = 0;
				$sql  = "SELECT sum(b.ptdValor) as valor FROM pedido_temporal a, pedido_temporal_detalle b WHERE a.ptTS>='$ini'  AND a.ptTS< '$fin' AND a.ptTie = $tieID AND b.ptID = a.ptID AND b.ptdEst >=7";
				$valor = 0;
			  	$c = $db->rawQuery($sql);
				if($c){
					foreach ($c as $p) {
						$valor = $p['valor'];
					} 
			    } 
				$total = $total + $valor;   
			} 
	    } 
			    
	    return $total;
	    
	}

	
	function pedidos_x_rango_fecha($ini,$fin){
		$db = MysqliDb::getInstance();
		$sql  = "SELECT sum(b.ptdValor) as valor FROM pedido_temporal a, pedido_temporal_detalle b WHERE a.ptTS>='$ini'  AND a.ptTS< '$fin' AND b.ptID = a.ptID AND b.ptdEst >=7";
		$valor = 0;
	  	$c = $db->rawQuery($sql);
		if($c){
			foreach ($c as $p) {
				$valor = $p['valor'];
			} 
	    } 
	    
	    return $valor;
	    
	}


	if($_GET['desde']){
		$fecini  =  $_GET['desde']; 
		$fecfin  =  $_GET['hasta']; 
	}else{
	
		if($_GET['aaaa']){
			$anoactual =  $_GET['aaaa'];
		}else{
			$anoactual =  date("Y");
		}
		
		$proxano   = $anoactual +1;
		
		$fecini  =  $anoactual.'-01-01'; 
		$fecfin  =  $proxano.'-01-01'; 
	
		$fecini1  =	$anoactual.'-01-01 00:00:00'; 
		$fecfin1  = $anoactual.'-02-01 00:00:00';
		$fecini2  =	$anoactual.'-02-01 00:00:00'; 
		$fecfin2  = $anoactual.'-03-01 00:00:00';
		$fecini3  = $anoactual.'-03-01 00:00:00'; 
		$fecfin3  = $anoactual.'-04-01 00:00:00';
		$fecini4  = $anoactual.'-04-01 00:00:00'; 
		$fecfin4  = $anoactual.'-05-01 00:00:00';
		$fecini5  =	$anoactual.'-05-01 00:00:00'; 
		$fecfin5  = $anoactual.'-06-01 00:00:00';
		$fecini6  =	$anoactual.'-06-01 00:00:00'; 
		$fecfin6  = $anoactual.'-07-01 00:00:00';
		$fecini7  =	$anoactual.'-07-01 00:00:00'; 
		$fecfin7  = $anoactual.'-08-01 00:00:00';
		$fecini8  =	$anoactual.'-08-01 00:00:00'; 
		$fecfin8  = $anoactual.'-09-01 00:00:00';
		$fecini9  =	$anoactual.'-09-01 00:00:00'; 
		$fecfin9  = $anoactual.'-10-01 00:00:00';
		$fecini10 =	$anoactual.'-10-01 00:00:00'; 
		$fecfin10 = $anoactual.'-11-01 00:00:00';
		$fecini11 =	$anoactual.'-11-01 00:00:00'; 
		$fecfin11 = $anoactual.'-12-01 00:00:00';
		$fecini12 =	$anoactual.'-12-01 00:00:00'; 
		$fecfin12 = $proxano.'-01-01 00:00:00';
		
	}
?>

	    

	    <div id="cajaposiciones">

					<div class="row">		
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<table class="table table-bordered table-hover table-condensed dashboard" id="latabla">
									  <thead>
										  <tr >
											  <th>Formatos / Tiendas</th>
											  <th>% Sobre Total</th>
											  <th>% Sobre Formato</th>
											  <th>Total</th>
											  <th class="text-center">Ene</th>
											  <th class="text-center">Feb</th>
											  <th class="text-center">Mar</th>
											  <th class="text-center">Abr</th>
											  <th class="text-center">May</th>
											  <th class="text-center">Jun</th>
											  <th class="text-center">Jul</th>
											  <th class="text-center">Ago</th>
											  <th class="text-center">Sep</th>
											  <th class="text-center">Oct</th>
											  <th class="text-center">Nov</th>
											  <th class="text-center">Dic</th>
										  </tr>
									  </thead>   
									  <tbody>
<?
	
				$sumaTotal = pedidos_x_rango_fecha($anoactual.'-01-01 00:00:00',$proxano.'-01-01 00:00:00');
	
	
				$tipo_formato_sql  = "SELECT * from tipo_formato";
			  	$tipo_formato_sql = $db->rawQuery($tipo_formato_sql);
				if($tipo_formato_sql){
					foreach ($tipo_formato_sql as $f) {
						$tipforID 	= $f['tipforID'];
						$tipforDesc	= $f['tipforDesc'];
?>
										<tr class="formato">
											<td><strong><?= $tipforDesc; ?></strong></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
<?
						$formatos_sql  = "SELECT * from formatos where formTipo = $tipforID";
					  	$formatos = $db->rawQuery($formatos_sql);
					  	$TotalFormato = 0;
						if($formatos){
							foreach ($formatos as $f1) {
								$formID 	= $f1['formID'];
								$formato	= $f1['formDesc'];
								$TotalFormato = $TotalFormato + pedidos_x_formato_x_rango_fecha($formID,$anoactual.'-01-01 00:00:00',$proxano.'-01-01 00:00:00',$paisID);

				// Tiendas por formatos
	
				$tiendas_sql  = "SELECT * from tiendas where tieForm = $formID and paisID = $paisID";
			  	$tiendas = $db->rawQuery($tiendas_sql);
				if($tiendas){
					foreach ($tiendas as $t) {
						$tieID = $t['tieID'];
						$total 	= 0;
				// Pedidos por tienda
						$ini = $anoactual.'-01-01 00:00:00';
						$fin = $proxano.'-01-01 00:00:00';
						$pedidos_sql  = "SELECT * from pedido_temporal where ptTie = $tieID and ptTS>='$ini' AND ptTS< '$fin'";
						
					  	$pedidos = $db->rawQuery($pedidos_sql);
						if($pedidos){
							foreach ($pedidos as $p) {
								$ptID = $p['ptID'];
												
					// Detalle Pedidos
							$detalle_sql  = "SELECT * from pedido_temporal_detalle where ptID = $ptID and ptdEst >= 7";
						  	$detalle = $db->rawQuery($detalle_sql);
							if($detalle){
								foreach ($detalle as $d) {
									
									$total = $total + $d['ptdValor'];
									
								} 
						    } 
								
								
								
							} 
					    } 
?>										  
										<tr class="tienda" id="tienda-<?= $tieID; ?>">
											<td class="text-right"><?= str_replace('Tienda','', $t['tieNom']) ; ?></td>
											<? 
											if($sumaTotal>0){
												$porcSobreTotal = round(($total / $sumaTotal)*100,0); 
											}else{
												$porcSobreTotal = 0;
											}	
											?>
											<td class="text-right"><?= $porcSobreTotal; ?>%</td>
											<? 
											if($TotalFormato>0){
												$porcSobreFormato = round(($total / $TotalFormato)*100,0); 
											}else{
												$porcSobreFormato = 0;
											}	
											?>
											<td class="text-right"><?= $porcSobreFormato; ?>%</td>
											<td class="text-right">$ <?= number_format($total,0,',','.'); ?></td>
											
											
											
											<?
											
												$ene =	pedidos_x_tienda_x_rango_fecha($tieID,$fecini1,$fecfin1);
												$feb =	pedidos_x_tienda_x_rango_fecha($tieID,$fecini2,$fecfin2);
												$mar = 	pedidos_x_tienda_x_rango_fecha($tieID,$fecini3,$fecfin3);
												$abr = 	pedidos_x_tienda_x_rango_fecha($tieID,$fecini4,$fecfin4);
												$may =	pedidos_x_tienda_x_rango_fecha($tieID,$fecini5,$fecfin5);
												$jun =	pedidos_x_tienda_x_rango_fecha($tieID,$fecini6,$fecfin6);
												$jul =	pedidos_x_tienda_x_rango_fecha($tieID,$fecini7,$fecfin7);
												$ago =	pedidos_x_tienda_x_rango_fecha($tieID,$fecini8,$fecfin8);
												$sep =	pedidos_x_tienda_x_rango_fecha($tieID,$fecini9,$fecfin9);
												$oct =	pedidos_x_tienda_x_rango_fecha($tieID,$fecini10,$fecfin10);
												$nov =	pedidos_x_tienda_x_rango_fecha($tieID,$fecini11,$fecfin11);
												$dic =	pedidos_x_tienda_x_rango_fecha($tieID,$fecini12,$fecfin12);
												
												$totform0  = $totform0 + $total;
												$totform1  = $totform1 + $ene;
												$totform2  = $totform2 + $feb;
												$totform3  = $totform3 + $mar;
												$totform4  = $totform4 + $abr;
												$totform5  = $totform5 + $may;
												$totform6  = $totform6 + $jun;
												$totform7  = $totform7 + $jul;
												$totform8  = $totform8 + $ago;
												$totform9  = $totform9 + $sep;
												$totform10 = $totform10 + $oct;
												$totform11 = $totform11 + $nov;
												$totform12 = $totform12 + $dic;												
												
												$tot0  = $tot0 + $total;
												$tot1  = $tot1 + $ene;
												$tot2  = $tot2 + $feb;
												$tot3  = $tot3 + $mar;
												$tot4  = $tot4 + $abr;
												$tot5  = $tot5 + $may;
												$tot6  = $tot6 + $jun;
												$tot7  = $tot7 + $jul;
												$tot8  = $tot8 + $ago;
												$tot9  = $tot9 + $sep;
												$tot10 = $tot10 + $oct;
												$tot11 = $tot11 + $nov;
												$tot12 = $tot12 + $dic;
												
											?>
											
											
											
											<td class="text-right">$ <?= number_format($ene,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($feb,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($mar,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($abr,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($may,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($jun,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($jul,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($ago,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($sep,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($oct,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($nov,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($dic,0,',','.'); ?></td>
										</tr>
										
										
										
										
		    <? 		} 
			    } 



								
							}
						}
						$PorcTotal	  = round(($TotalFormato / $sumaTotal)*100,0);
						
?>										  

										

	
										<tr class="totalformato" >
											
											<td class="text-right">Total Formato <?= $tipforDesc; ?>:</td>
											<td class="text-right"><?= $PorcTotal; ?>%</td>
											<td class="text-right"></td>
											<td class="text-right">$ <?= number_format($totform0,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($totform1,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($totform2,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($totform3,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($totform4,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($totform5,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($totform6,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($totform7,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($totform8,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($totform9,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($totform10,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($totform11,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($totform12,0,',','.'); ?></td>
										</tr>
										
										
		    <? 		
			    
			    
						$totform0  = 0;
						$totform1  = 0;
						$totform2  = 0;
						$totform3  = 0;
						$totform4  = 0;
						$totform5  = 0;
						$totform6  = 0;
						$totform7  = 0;
						$totform8  = 0;
						$totform9  = 0;
						$totform10 = 0;
						$totform11 = 0;
						$totform12 = 0;
			    
			    	} 
			    } ?>										
										<tr class="totales" >
											<td class="text-right">TOTAL:</td>
											<td></td>
											<td></td>
											<td class="text-right">$ <?= number_format($tot0,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot1,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot2,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot3,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot4,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot5,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot6,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot7,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot8,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot9,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot10,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot11,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot12,0,',','.'); ?></td>
										</tr>										
									  </tbody>
								  </table>            
								</div>
							</div>
						</div><!--/col-->
					
					</div><!--/row-->			    
			    
				<div class="clear"></div>
		    </div>

