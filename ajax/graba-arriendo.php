<?php
require_once("../admin/functions.php");


$autoID		= $_POST['autoID'];
$fecIni		= $_POST['fecIni'];
$horIni		= $_POST['horIni'];
$fecFin		= $_POST['fecFin'];
$horFin		= $_POST['horFin'];
$dias		= $_POST['dias'];
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
	"resDias"  	=> $dias,
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

//	print_r( $data);
	
$id = $db->insert('reservas', $data);		

for($i=0;$i<count($opcional);$i+=1){
	$data2 = Array (
		"resID"		=> $id,
		"opcID"  	=> $opcional[$i]['opcID']
	);
	print_r( $data2);
	$db->insert('reservas_opcionales', $data2);	
}


$message   = "<!DOCTYPE html>";
$message  .= "<html lang='en' style='box-sizing: border-box; color: rgba(0, 0, 0, 0.87); font-family: 'Lato', sans-serif; font-size: 14px; font-weight: normal; height: 100%; line-height: 1.5; width: 100%;'>";
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
$message  .= "<h5 class='titulo' style='box-sizing: inherit; color: #343233; font-size: 18px; font-weight: 700; line-height: 110%; margin: 30px 0; text-align: left;'>Tu número de confirmación es ".str_pad($resID, 5, '0', STR_PAD_LEFT)."</h5>";
$message  .= "<div class='divider' style='background-color: #e0e0e0; box-sizing: inherit; height: 1px; overflow: hidden;'>";
$message  .= "</div>";
$message  .= "<h5 class='titulo' style='box-sizing: inherit; color: #343233; font-size: 18px; font-weight: 700; line-height: 110%; margin: 30px 0; text-align: left;'>". $nombre. " ". $apellido."</h5>";
$message  .= "<table class='bordered' style='border: none; border-collapse: collapse; border-spacing: 0; box-sizing: inherit; display: table; width: 100%;'>";
$message  .= "<tbody style='box-sizing: inherit;'>";
$message  .= "<tr style='border-bottom: 1px solid #d0d0d0; box-sizing: inherit;'>";
$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>Email:</td>";
$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>".$mail."</td>";
$message  .= "</tr>";
$message  .= "</tbody>";
$message  .= "</table>";
$message  .= "<h5 class='titulo' style='box-sizing: inherit; color: #343233; font-size: 18px; font-weight: 700; line-height: 110%; margin: 30px 0; text-align: left;'>Tu vehículo:</h5>";
$message  .= "<div class='item center' style='box-sizing: inherit; text-align: center;'><img src='http://realrentacar.cl/dev/assets/img/autos/nissan_march_ss_16.jpg' style='border: 0; box-sizing: inherit;' width='210' /><h5 style='box-sizing: inherit; color: #909090; font-size: 18px; font-weight: 700; line-height: 110%; margin: 5px 0;'>Nissan</h5>";
$message  .= "<p style='box-sizing: inherit; color: #343234; font-size: 14px; font-weight: 700; margin: 5px 0;'>March SS 1.6</p>";
$message  .= "<div class='features_car' style='box-sizing: inherit; color: #c2c2c2; font-weight: 700;'><i aria-hidden='true' class='fa fa-users' style='box-sizing: inherit; display: inline-block; font: normal normal normal 14px/1 FontAwesome; font-size: inherit; line-height: inherit; text-rendering: auto;'></i> 4 / <i aria-hidden='true' class='fa fa-suitcase' style='box-sizing: inherit; display: inline-block; font: normal normal normal 14px/1 FontAwesome; font-size: inherit; line-height: inherit; text-rendering: auto;'></i> 4 / <i aria-hidden='true' class='fa fa-sitemap' style='box-sizing: inherit; display: inline-block; font: normal normal normal 14px/1 FontAwesome; font-size: inherit; line-height: inherit; text-rendering: auto;'></i> M </div>";
$message  .= "</div>";
$message  .= "<br style='box-sizing: inherit;' />";
$message  .= "<div class='divider' style='background-color: #e0e0e0; box-sizing: inherit; height: 1px; overflow: hidden;'>";
$message  .= "</div>";
$message  .= "<h5 class='titulo' style='box-sizing: inherit; color: #343233; font-size: 18px; font-weight: 700; line-height: 110%; margin: 30px 0; text-align: left;'>Detalle de la reserva:</h5>";
$message  .= "<div class='dato_reserva' style='box-sizing: inherit; color: #343233; font-size: 14px; font-weight: 400; margin: 15px 0;'>";
$message  .= "<p style='box-sizing: inherit; display: block; margin: 0;'><span style='box-sizing: inherit; font-size: 14px; font-weight: 700;'>Donde entregar:</span></p>";
$message  .= "<p style='box-sizing: inherit; display: block; margin: 0;'>".$resDesDir." ".$resDesNum.", ".get_comuna($resDesCom)."</p>";
$message  .= "</div>";
$message  .= "<div class='dato_reserva' style='box-sizing: inherit; color: #343233; font-size: 14px; font-weight: 400; margin: 15px 0;'>";
$message  .= "<p style='box-sizing: inherit; display: block; margin: 0;'><span style='box-sizing: inherit; font-size: 14px; font-weight: 700;'>Devolución: </span>".$devolucion."</p>";
$message  .= "</div>";
$message  .= "<div class='dato_reserva' style='box-sizing: inherit; color: #343233; font-size: 14px; font-weight: 400; margin: 15px 0;'>";
$message  .= "<p style='box-sizing: inherit; display: block; margin: 0;'><span style='box-sizing: inherit; font-size: 14px; font-weight: 700;'>Fecha entrega:</span></p>";
$message  .= "<p style='box-sizing: inherit; display: block; margin: 0;'>".date("d-m-Y", strtotime($resFecIni))." ". $resHorIni."</p>";
$message  .= "</div>";
$message  .= "<div class='dato_reserva' style='box-sizing: inherit; color: #343233; font-size: 14px; font-weight: 400; margin: 15px 0;'>";
$message  .= "<p style='box-sizing: inherit; display: block; margin: 0;'><span style='box-sizing: inherit; font-size: 14px; font-weight: 700;'>Fecha devolución:</span></p>";
$message  .= "<p style='box-sizing: inherit; display: block; margin: 0;'>". date("d-m-Y", strtotime($resFecFin))." ". $resHorFin."</p>";
$message  .= "</div>";
$message  .= "<div class='divider' style='background-color: #e0e0e0; box-sizing: inherit; height: 1px; overflow: hidden;'>";
$message  .= "</div>";
$message  .= "<h5 class='titulo' style='box-sizing: inherit; color: #343233; font-size: 18px; font-weight: 700; line-height: 110%; margin: 30px 0; text-align: left;'>Resumen de la reserva:</h5>";
$message  .= "<table class='bordered' style='border: none; border-collapse: collapse; border-spacing: 0; box-sizing: inherit; display: table; width: 100%;'>";
$message  .= "<tbody style='box-sizing: inherit;'>";

$message  .= "<tr style='border-bottom: 1px solid #d0d0d0; box-sizing: inherit;'>";
$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>Arriendo Auto</td>";
$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>Nissan March SS 1.6<br style='box-sizing: inherit;' />5 días / $22.990 por día</td>";
$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>$114.950</td>";
$message  .= "</tr>";

$message  .= "<tr style='border-bottom: 1px solid #d0d0d0; box-sizing: inherit;'>";
$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>Ítems Adicionales</td>";

$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>GPS<br style='box-sizing: inherit;' />5 días / $5.990 por día</td>";
$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>$29.950</td>";

$message  .= "</tr>";
$message  .= "<tr style='border-bottom: 1px solid #d0d0d0; box-sizing: inherit;'>";
$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>TOTAL</td>";
$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>";
$message  .= "</td>";
$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>$140.900</td>";
$message  .= "</tr>";
$message  .= "</tbody>";
$message  .= "</table>";
$message  .= "</div>";
$message  .= "</div>";
$message  .= "</div>";
$message  .= "</div>";
$message  .= "</div>";
$message  .= "</body>";
$message  .= "</html>";



	if ($id)
	    echo $id;	
	else
	    echo 'error';
	

?>