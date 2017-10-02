<?php
require_once("../admin/functions.php");


$autoID		= $_POST['autoID'];
$fecIni		= $_POST['fecIni'];
$horIni		= $_POST['horIni'];
$fecFin		= $_POST['fecFin'];
$horFin		= $_POST['horFin'];
$resDias	= $_POST['dias'];
$opcional	= $_POST['opcional'];
$nombre		= $_POST['nombre'];
$apellido	= $_POST['apellido'];
$mail		= $_POST['mail'];
$fono		= $_POST['fono'];
if($_POST['recibir']){
	$recibir = $_POST['recibir'];
}else{
	$recibir = 0;
}
$resDesDir	= $_POST['resDesDir'];
$resDesNum	= $_POST['resDesNum'];
$resDesCom	= $_POST['resDesCom'];
$resDevol	= $_POST['resDevol'];
$resValTot	= $_POST['total'];

$resFecIni = date("Y-m-d", strtotime(str_replace('/', '-',$fecIni)));
$resFecFin = date("Y-m-d", strtotime(str_replace('/', '-',$fecFin)));

date_default_timezone_set('America/Santiago');
$ahora = date("Y-m-d H:i:s");

$data = Array (
	"resNom"  	=> $nombre,
	"resApe"  	=> $apellido,
	"resMail"  	=> $mail,
	"resFono"  	=> $fono,
	"resAuto"  	=> $autoID,
	"resFecIni" => $resFecIni,
	"resHorIni" => $horIni,
	"resFecFin" => $resFecFin,
	"resHorFin" => $horFin,
	"resDias"  	=> $resDias,
	"resDesDir" => $resDesDir,
	"resDesNum" => $resDesNum,
	"resDesCom" => $resDesCom,
	"resDevol" 	=> $resDevol,
	"resValTot" => $resValTot,
	"resRecibe" => $recibir,
	"resEst"  	=> 0,
	"resTS"  	=> $ahora
);
if($resDevol==1){
    $devolucion = "Oficinas de Real Rent a Car";
}elseif($resDevol==2){
    $devolucion = "Misma dirección de entrega";
}elseif($resDevol==3){
    $devolucion = "Lugar a acordar telefónicamente";
}
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

if($resDias>1){
    $dias = $resDias.' d&iacute;as';
}else{
    $dias = $resDias.' d&iacute;a';
}
$autoTot = $catPrec * $resDias;

//	print_r( $data);
	
$id = $db->insert('reservas', $data);		

if ($id){
	for($i=0;$i<count($opcional);$i+=1){
		$data2 = Array (
			"resID"		=> $id,
			"opcID"  	=> $opcional[$i]['opcID']
		);
		//print_r( $data2);
		$db->insert('reservas_opcionales', $data2);	
	}
	
	$message   = "<!DOCTYPE html>";
	$message  .= "<html lang='en' style='box-sizing: border-box; color: rgba(0, 0, 0, 0.87); font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: normal; height: 100%; line-height: 1.5; width: 100%; '>";
	$message  .= "<head style='box-sizing: inherit;'>";
	$message  .= "<meta content='text/html; charset=UTF-8' http-equiv='Content-Type' style='box-sizing: inherit;' />";
	$message  .= "<meta content='width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no' name='viewport' style='box-sizing: inherit;' />";
	$message  .= "<title style='box-sizing: inherit;'>REAL Rent a Car</title>";
	$message  .= "</head>";
	$message  .= "<body style='box-sizing: inherit; height: 100%; margin: 0; width: 100%;'>";
	$message  .= "<div class='container' style='box-sizing: inherit; margin: 0 auto; width:650px;'>";
	$message  .= "<div class='row' style='box-sizing: inherit; margin-bottom: 20px; margin-left: -0.75rem; margin-right: -0.75rem;'>";
	$message  .= "<div class='section' style='box-sizing: inherit; padding-bottom: 1rem; padding-top: 1rem;'>";
	$message  .= "<div class='row' style='box-sizing: inherit; margin-bottom: 20px; margin-left: -0.75rem; margin-right: -0.75rem;'>";
	$message  .= "<div class='col l8 offset-l2 s12' style='box-sizing: border-box; float: left; left: auto; margin-left: auto; min-height: 1px; padding: 0 0.75rem; right: auto; width: 100%;'>";
	$message  .= "<img src='http://realrentacar.cl/dev/assets/img/logoreal.png' width='200'>";
	$message  .= "</div>";
	$message  .= "</div>";
	$message  .= "<div class='row' style='box-sizing: inherit; margin-bottom: 20px; margin-left: -0.75rem; margin-right: -0.75rem;'>";
	$message  .= "<div class='col l8 offset-l2 s12' style='box-sizing: border-box; float: left; left: auto; margin-left: auto; min-height: 1px; padding: 0 0.75rem; right: auto; width: 100%;'>";
	$message  .= "<h5 class='titulo' style='box-sizing: inherit; color: #343233; font-size: 18px; font-weight: 700; line-height: 110%; margin: 30px 0; text-align: left;'>Tu n&uacute;mero de confirmaci&oacute;n es ".str_pad($id, 5, '0', STR_PAD_LEFT)."</h5>";
	$message  .= "<div class='divider' style='background-color: #e0e0e0; box-sizing: inherit; height: 1px; overflow: hidden;'>";
	$message  .= "</div>";
	$message  .= "<h5 class='titulo' style='box-sizing: inherit; color: #343233; font-size: 18px; font-weight: 700; line-height: 110%; margin: 30px 0; text-align: left;'>". utf8_decode($nombre). " ". utf8_decode($apellido)."</h5>";
	$message  .= "<table class='bordered' style='border: none; border-collapse: collapse; border-spacing: 0; box-sizing: inherit; display: table; width: 100%;'>";
	$message  .= "<tbody style='box-sizing: inherit;'>";
	$message  .= "<tr style='border-bottom: 1px solid #d0d0d0; box-sizing: inherit;'>";
	$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>Email:</td>";
	$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>".$mail."</td>";
	$message  .= "</tr>";
	$message  .= "</tbody>";
	$message  .= "</table>";
	$message  .= "<h5 class='titulo' style='box-sizing: inherit; color: #343233; font-size: 18px; font-weight: 700; line-height: 110%; margin: 30px 0; text-align: left;'>Tu veh&iacute;culo:</h5>";
	$message  .= "<div class='item center' style='box-sizing: inherit; text-align: center;'><img src='http://realrentacar.cl/dev/admin/ajax/uploads/".$autoFoto."' style='border: 0; box-sizing: inherit;' width='210' /><h5 style='box-sizing: inherit; color: #909090; font-size: 18px; font-weight: 700; line-height: 110%; margin: 5px 0;'>".get_segmento(get_segmento_cat($catID))."</h5>";
	$message  .= "<p style='box-sizing: inherit; color: #343234; font-size: 14px; font-weight: 700; margin: 5px 0;'>".$rautoDesc." <small>o similar</small></p>";
	$message  .= "<div class='features_car' style='box-sizing: inherit; color: #c2c2c2; font-weight: 700;'><i aria-hidden='true' class='fa fa-users' style='box-sizing: inherit; display: inline-block; font: normal normal normal 14px/1 FontAwesome; font-size: inherit; line-height: inherit; text-rendering: auto;'></i> 4 / <i aria-hidden='true' class='fa fa-suitcase' style='box-sizing: inherit; display: inline-block; font: normal normal normal 14px/1 FontAwesome; font-size: inherit; line-height: inherit; text-rendering: auto;'></i> 4 / <i aria-hidden='true' class='fa fa-sitemap' style='box-sizing: inherit; display: inline-block; font: normal normal normal 14px/1 FontAwesome; font-size: inherit; line-height: inherit; text-rendering: auto;'></i> M </div>";
	$message  .= "</div>";
	$message  .= "<br style='box-sizing: inherit;' />";
	$message  .= "<div class='divider' style='background-color: #e0e0e0; box-sizing: inherit; height: 1px; overflow: hidden;'>";
	$message  .= "</div>";
	$message  .= "<h5 class='titulo' style='box-sizing: inherit; color: #343233; font-size: 18px; font-weight: 700; line-height: 110%; margin: 30px 0; text-align: left;'>Detalle de la reserva:</h5>";
	if($resDesCom){ 
		$message  .= "<div class='dato_reserva' style='box-sizing: inherit; color: #343233; font-size: 14px; font-weight: 400; margin: 15px 0;'>";
		$message  .= "<p style='box-sizing: inherit; display: block; margin: 0;'><span style='box-sizing: inherit; font-size: 14px; font-weight: 700;'>Donde entregar:</span></p>";
		$message  .= "<p style='box-sizing: inherit; display: block; margin: 0;'>".utf8_decode($resDesDir)." ".$resDesNum.", ".utf8_decode(get_comuna($resDesCom))."</p>";
		$message  .= "</div>";
		$message  .= "<div class='dato_reserva' style='box-sizing: inherit; color: #343233; font-size: 14px; font-weight: 400; margin: 15px 0;'>";
		$message  .= "<p style='box-sizing: inherit; display: block; margin: 0;'><span style='box-sizing: inherit; font-size: 14px; font-weight: 700;'>Devoluci&oacute;n: </span>".$devolucion."</p>";
		$message  .= "</div>";
	}
	$message  .= "<div class='dato_reserva' style='box-sizing: inherit; color: #343233; font-size: 14px; font-weight: 400; margin: 15px 0;'>";
	$message  .= "<p style='box-sizing: inherit; display: block; margin: 0;'><span style='box-sizing: inherit; font-size: 14px; font-weight: 700;'>Fecha entrega:</span></p>";
	$message  .= "<p style='box-sizing: inherit; display: block; margin: 0;'>".date("d-m-Y", strtotime($resFecIni))." ". $resHorIni."</p>";
	$message  .= "</div>";
	$message  .= "<div class='dato_reserva' style='box-sizing: inherit; color: #343233; font-size: 14px; font-weight: 400; margin: 15px 0;'>";
	$message  .= "<p style='box-sizing: inherit; display: block; margin: 0;'><span style='box-sizing: inherit; font-size: 14px; font-weight: 700;'>Fecha devoluci&oacute;n:</span></p>";
	$message  .= "<p style='box-sizing: inherit; display: block; margin: 0;'>". date("d-m-Y", strtotime($resFecFin))." ". $resHorFin."</p>";
	$message  .= "</div>";
	$message  .= "<div class='divider' style='background-color: #e0e0e0; box-sizing: inherit; height: 1px; overflow: hidden;'>";
	$message  .= "</div>";
	$message  .= "<h5 class='titulo' style='box-sizing: inherit; color: #343233; font-size: 18px; font-weight: 700; line-height: 110%; margin: 30px 0; text-align: left;'>Resumen de la reserva:</h5>";
	$message  .= "<table class='bordered' style='border: none; border-collapse: collapse; border-spacing: 0; box-sizing: inherit; display: table; width: 100%;'>";
	$message  .= "<tbody style='box-sizing: inherit;'>";
	
	$message  .= "<tr style='border-bottom: 1px solid #d0d0d0; box-sizing: inherit;'>";
	$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>Arriendo Auto</td>";
	$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>".$rautoDesc."<br style='box-sizing: inherit;' />".$dias." / $".number_format($catPrec,0,',','.')." por d&iacute;a</td>";
	$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>$".number_format($autoTot,0,',','.')."</td>";
	$message  .= "</tr>";
							
	$sql1  = "select * from reservas_opcionales where resID = $id";
  	$opcionales = $db->rawQuery($sql1);
	if($opcionales){
		foreach ($opcionales as $o) {	
			$opcID = $o['opcID'];						
			$sql  = "select * from opcionales where opcID = $opcID";
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
					$opcPrec = $r['opcPrec'];
					$opcTot  = $opcPrec * $resDias;
	$message  .= "<tr style='border-bottom: 1px solid #d0d0d0; box-sizing: inherit;'>";
	$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>".$r['opcDesc']."</td>";	
	$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>".$dias." / $".number_format($opcPrec,0,',','.')." por d&iacute;a</td>";
	$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>$".number_format($opcTot,0,',','.')."</td>";
				$i++;
				} 
			} 
	    } 
    }  	
	$message  .= "</tr>";
	$message  .= "<tr style='border-bottom: 1px solid #d0d0d0; box-sizing: inherit;'>";
	$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>TOTAL</td>";
	$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>";
	$message  .= "</td>";
	$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>$".number_format($resValTot,0,',','.')."</td>";
	$message  .= "</tr>";
	$message  .= "</tbody>";
	$message  .= "</table>";
	$message  .= "</div>";
	$message  .= "</div>";
	$message  .= "</div>";
	$message  .= "</div>";

	$message  .= "<div class='section' style='box-sizing: inherit; padding-bottom: 1rem; padding-top: 1rem;'>";
	$message  .= "<div class='row' style='box-sizing: inherit; margin-bottom: 20px; margin-left: -0.75rem; margin-right: -0.75rem;'>";
	$message  .= "<div class='col l8 offset-l2 s12' style='box-sizing: border-box; float: left; left: auto; margin-left: auto; min-height: 1px; padding: 0 0.75rem; right: auto; width: 100%;'>";	

$message  .= "<p><strong>Condiciones Especiales:</strong></p>";

$message  .= "<ol><li>Valor Incluye Kilometraje libre y seguro b&aacute;sico CDW con deducible seg&uacute;n categor&iacute;a</li>";
$message  .= "<li>Seguro no cubre rotura de neum&aacute;ticos o pinchazos, ni robo de accesorios.</li>";
$message  .= "<li>El estanque de combustible debe ser entregado en las mismas condiciones que se le entreg&oacute; al cliente, de lo contrario se cobrar&aacute; la diferencia de combustible a $1.200 pesos + Iva por litro de bencina.</li>";
$message  .= "<li>La reserva dura hasta 2 horas posteriores indicada en la reserva, en caso de sobrepasar este tiempo se liberar&aacute; la referida reserva.</li>";
$message  .= "<li>Para la devoluci&oacute;n del veh&iacute;culo se dar&aacute;n 3 horas de gracia en relaci&oacute;n a la hora de arriendo, siempre y cuando esta sea dentro de horario h&aacute;bil, en caso de sobrepasar este limite, se cobrar&aacute; un d&iacute;a adicional.</li>";
$message  .= "<li>Dem&aacute;s condiciones se encuentran reguladas en el contrato de arriendo.</li></ol>";

$message  .= "<p><strong>Requisitos para arrendar:</strong></p>";
$message  .= "<ol><li>Conductor mayor de 22 a&ntilde;os.</li>";
$message  .= "<li>Poseer licencia de conducir vigente y acorde al tipo de veh&iacute;culo solicitado.</li>";
$message  .= "<li>Garant&iacute;a de Arriendo: Tarjeta de cr&eacute;dito bancaria con al menos $350.000 de cupo libre (este valor puede variar dependiendo el tiempo y categor&iacute;a de arriendo).</li></ol>";

	$message  .= "</div>";
	$message  .= "</div>";
	$message  .= "</div>";
	$message  .= "</div>";
	$message  .= "</body>";
	$message  .= "</html>";

	$to = $mail;
	
	$subject = 'Su reserva en Real Rent a car  Nº '.str_pad($id, 5, '0', STR_PAD_LEFT).'';
	
	$headers  = "From: Real Rent a Car <contacto@realrentacar.cl>\r\n";
	$headers .= "CC: contacto@realrentacar.cl\r\n";
	$headers .= "BCC: seo2@seo2.cl\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	mail($to, $subject, $message, $headers);

    echo $id;	
}else{
    echo 'error';
}

	

?>