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
		"resValTot" => $resValTot,
		"resRecibe" => $recibir,
		"resEst"  	=> 0,
		"resTS"  	=> $ahora
	);


//	print_r( $data);
	
	$id = $db->insert('reservas', $data);		

	if ($id)
	    echo $id;	
	else
	    echo 'error';
	

?>