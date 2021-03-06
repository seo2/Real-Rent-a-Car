<?php
	require_once("../functions.php");
	
	/*
			
	ESTADOS:
			
	Solicitado: 			0 // creado por VM
	Para revisión: 			1 // A la espera de MM
	Objetado:				2 // Rechazado por MM
	Aprobado:				3 // Aprobado por MM --> traspasado a Proveedor --> para cotizar
	
	Cotizado:				4 // Recibido por Proveedor, ingresó precio y envió a MM
	Cotizacion Aprobada: 	5 // Cotización aprobada por MM --> Proveedor debe ingresar precio
	Ongoing:   				6 // Proveedor compromete fecha de entrega
	
	Entregado:				7 // Entregado por Proveedor
	Finalizado:				8 // Recepcionado por VM
			
	*/	

	$date = date('d/m/Y');
					
	$subject = 'Pedidos VM '.$date.'';
	
	$headers = "From: Adidas Retail Marketing <no-reply@iscrmktg.com>\r\n";
	$headers .= "CC: adidas@seo2.cl\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$sql1  = "SELECT * FROM usuario WHERE usuTipo = 2 and usuEst = 0";
	
  	$usuario = $db->rawQuery($sql1);
	if($usuario){
		foreach ($usuario as $u) {
			$usuId 	= $u['usuID'];
			$paisID = $u['paisID'];
			
			$to		= $u['usuMail'];
			
			$i 		= 0;

			$message  = '<html><head></head><body style="font-family: Helvetica, Arial, sans-serif;">';
			$message .= '<div><img src="http://iscrmktg.com/assets/img/cabeceramail.png"></div>';			
		    if($paisID==7){
				$message .= '<h3>Resumo Pedidos VM de '.$date.'</h3>';
		    }else{
				$message .= '<h3>Resumen Pedidos VM del '.$date.'</h3>';
		    } 
			$sql  		= "SELECT count(*) as Total, ptID, ptdTS FROM pedido_temporal_detalle WHERE paisID = ".$paisID." and ptdEst = 0 and ptdRes = ".$usuId." GROUP BY ptID  order by ptID DESC";		
			
		  	$resultado 	= $db->rawQuery($sql);
			if($resultado){
				foreach ($resultado as $r0) {
					
					$ptID  = $r0['ptID'];
					$ptTS  = get_pedido_fecha_proceso($paisID,$ptID);
					$fecha = substr($ptTS,8,2) . '/'. substr($ptTS,5,2) .'/'. substr($ptTS,0,4);
					$hora  = substr($ptTS,11,8);
					$total = $r0['Total'];
					$i++;
					$message .= '<div class="row"><span><strong>N&ordm; '.$ptID.'</strong></span> '. utf8_decode(get_tienda(get_tienda_pedido($paisID,$ptID)));
					$message .= ' <small><strong>'.get_formato(get_formato_tienda(get_tienda_pedido($paisID,$ptID))).'</strong></small>';
					$message .= ' <small>['.$total.']</small>';
					$message .= '<br><br>';
					
					$sql2  		= "SELECT *  FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID";
				  	$resultado2 = $db->rawQuery($sql2);
					if($resultado2){
						foreach ($resultado2 as $r) {
							$fecha = substr($r['ptdTS'],8,2) . '/'. substr($r['ptdTS'],5,2) .'/'. substr($r['ptdTS'],0,4);
							$hora  = substr($r['ptdTS'],11,8);
						
							$fecen = substr($r['ptdFecEn'],8,2) . '/'. substr($r['ptdFecEn'],5,2) .'/'. substr($r['ptdFecEn'],0,4);
						
							if($r['ptdISC']=='fw2017'){
								$pieza   = get_isc_camp($r['formID'],$r['ptdGra']) .'<br><small>'.get_isc_med($r['formID'],$r['ptdGra']).'</small>';
							}else{		
								if($r['ptdV2']==1){	
									$pieza_opc_desc = get_instore_opc_desc_v2($r['formID'], $r['ptdGra'], $r['ptdGraOp']);
									
									if($pieza_opc_desc=='-' || $pieza_opc_desc==''){
										$pieza = '<small>'.get_instore_nom_gen_v2( $r['formID'], $r['ptdGra']) . '</small><br>' . utf8_decode(get_instore_nom_x_pais_v2($paisID, $r['formID'], $r['ptdGra']));
									}else{
										$pieza = '<small>'.get_instore_nom_gen_v2( $r['formID'], $r['ptdGra']) . '</small><br>' . utf8_decode(get_instore_nom_x_pais_v2($paisID, $r['formID'], $r['ptdGra'])) . ' [' . utf8_decode($pieza_opc_desc) . '] ';
									}
								}else{	
									$pieza_opc_desc = get_instore_opc_desc($r['formID'], $r['ptdGra'], $r['ptdGraOp']);
									
									if($pieza_opc_desc=='-' || $pieza_opc_desc==''){
										$pieza = '<small>'.get_instore_nom_gen( $r['formID'], $r['ptdGra']) . '</small><br>' . utf8_decode(get_instore_nom_x_pais($paisID, $r['formID'], $r['ptdGra']));
									}else{
										$pieza = '<small>'.get_instore_nom_gen( $r['formID'], $r['ptdGra']) . '</small><br>' .  utf8_decode(get_instore_nom_x_pais($paisID, $r['formID'], $r['ptdGra'])) . ' [' . utf8_decode($pieza_opc_desc) . '] ';
									}
								}		
							}
	
							$estado = get_desc_estado($r['ptdEst']);
							$clase  = get_class_estado($r['ptdEst']);
											
							$message .= "<div style='border-bottom: 1px solid #ccc; padding: 0 0 10px 0; margin-bottom:10px; font-size:12px;' >";
							$message .= "<div style='margin-bottom:5px; font-size:14px;'>Instore: <strong>". $pieza."</strong></div>";

						    if($paisID==7){
								$message .= "<div  style='margin-bottom:5px;'><span>Quantidade: <strong>".$r['ptdCan']."</strong></div>";
						    }else{
								$message .= "<div  style='margin-bottom:5px;'><span>Cantidad: <strong>".$r['ptdCan']."</strong></div>";
						    } 

							if( $r['ptdObs']){
							    if($paisID==7){
									$message .= "<div  style='margin-bottom:5px;'><span>Obs:</span> <span><strong>". utf8_decode( $r['ptdObs'])." </strong></span></div>"; 
							    }else{
									$message .= "<div  style='margin-bottom:5px;'><span>Observaci&oacute;n:</span> <span><strong>". utf8_decode( $r['ptdObs'])." </strong></span></div>"; 
							    } 
							}
							
							if($paisID==7){
								$message .= "<div  style='margin-bottom:5px;'><span>Pedido por: <strong>". utf8_decode( get_user_nombre($r['ptdVM']))." </strong><span></div>";
								$message .= "<div  style='margin-bottom:5px;'><span>Respons&aacute;vel: <strong>". utf8_decode( get_user_nombre($r['ptdRes']))."</strong><span></div>";
								$message .= "<div  style='margin-bottom:5px;'><span>Fornecedor: <strong>". utf8_decode( get_proveedor_nombre($r['ptdProv']))."</strong><span></div>";
							}else{
								$message .= "<div  style='margin-bottom:5px;'><span>Solicitado por: <strong>". utf8_decode( get_user_nombre($r['ptdVM']))." </strong><span></div>";
								$message .= "<div  style='margin-bottom:5px;'><span>Responsable: <strong>". utf8_decode( get_user_nombre($r['ptdRes']))."</strong><span></div>";
								$message .= "<div  style='margin-bottom:5px;'><span>Proveedor: <strong>". utf8_decode( get_proveedor_nombre($r['ptdProv']))."</strong><span></div>";
							} 
							
							$estado =$r['ptdEst'];

							if($r['ptdCat']>0){
								if($r['ptdISC']=='fw2017'){
									$camID   = $r['ptdGraOp'];
									$camfile = get_foto_campana_v2($camID, $r['ptdCat']);
									$camfile = str_replace('../', '', $camfile) ;
								}else{
									$camfile = get_foto_campana($r['ptdCat']);
									$camfile = str_replace('../', '', $camfile) ;
								}
								$message .= "<div class='posevento fotospedido'>";
								if($paisID==7){
									$message .= "<span>Imagem de cat&aacute;logo:</span><br>";
							    }else{
									$message .= "<span>Imagen de Cat&aacute;logo:</span><br>";
							    } 
								$message .= "<img src='http://iscrmktg.com/resize2.php?img=".$camfile."&width=300&height=300&mode=fit' class='img-responsive'>";
								$message .= "</div>";
							}else{
								$camfile = $r['ptdISC'];
								if($camfile){
									$message .= "<div class='posevento fotospedido'>";
									if($paisID==7){
										$message .= "<span>Imagem ISC</span><br>";
								    }else{
										$message .= "<span>Imagen ISC</span><br>";
								    } 
									$message .= "<img src='http://iscrmktg.com/resize2.php?img=".$camfile."&width=300&height=300&mode=fit' class='img-responsive'>";
									$message .= "</div>";
								}
						 	} 
							if($r['ptdFoto']){	
								$message .= "<div class='posevento fotospedido'>";
								$message .= "<span>Foto:</span><br>";
								$message .= "<img src='http://iscrmktg.com/resize3.php?img=ajax/uploads/".$r['ptdFoto']."&width=300&height=300&mode=fit' class='img-responsive'>";	
								$message .= "</div>";
							}

							$message .= "<div class='col-lg-12'>";
							$message .= "<div class='row' id='comentarios'>";
							
							$ptditem = $r['ptdItem'];	
							
							$sql3  = "select * from pedido_observaciones where paisID = $paisID and ptID = $ptID and ptdItem = $ptditem";
							$c		= 1;
						  	$resultado3 = $db->rawQuery($sql3);
							if($resultado3){
								foreach ($resultado3 as $r2) {
									
									$fecha2 = substr($r2['ptoTS'],8,2) . '/'. substr($r2['ptoTS'],5,2) .'/'. substr($r2['ptoTS'],0,4);
									$hora2  = substr($r2['ptoTS'],11,8);

									$message .= "<div style='boder-top:1px dashed #eee'>";
									$message .= "<p><strong class='text-primary'>". get_user_nombre($r2['ptoUsu'])."</strong> <small>". get_tipo_usuario_desc(get_usertipo($r2['ptoUsu']))."</small></p>";
									$message .= "<p>". utf8_decode( $r2['ptoObs'])."</p>";
									$message .= "<small>". $fecha2." ".$hora."</small>";
									$message .= "</div>";
					     		} 
						    }	

							$message .= "</div>";
							$message .= "</div>";
								
							$message .= "</div>";
							$message .= "</div>";											    
		    			}
			    	}
					$message .='</div>';	
					$message .='<div ><a style="padding:10px 20px; background: #000; color:#fff; display: block; margin:10px auto; width:100px; text-align: center; text-decoration:none;" href="http://iscrmktg.com/">Ir al sitio</a></div>';
					$message .= "<div style='height:50px; background: #0084D6; margin-bottom:40px;'>";	
					$message .= "</div>";	
		
		 		} 
		    }	
			$message .= "</body></html>";
			if($i>0){
/*
				echo $to;
				echo $message;
*/
				//$to		= 'seodos@gmail.com';
				mail($to, $subject, $message, $headers);
			}

 		} 
    }	

	$data = Array (
		"ptEst" 	=> 1
	);		
	$db->where("ptEst", 0);
	$db->update('pedido_temporal', $data);

	$data = Array (
		"ptdEst" 	=> 1
	);		
	$db->where("ptdEst", 0);
	$db->update('pedido_temporal_detalle', $data);
	

echo 1;
?>