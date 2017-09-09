<?
require_once("../functions.php");

date_default_timezone_set('America/Santiago');

$segNom 	= $_POST['segNom'];
$segEst 	= $_POST['segEst'];

$data = Array (
	"segNom" 	=> $segNom,
	"segEst" 	=> $segEst
);	

if($_POST['segID']){
	$segID = $_POST['segID'];	
	$db->where("segID", $segID);
	$db->update('autos_segmentos', $data);
	
	$respuesta = '2';	
}else{
	$id = $db->insert ('autos_segmentos', $data);
	
	$respuesta = '1';		
}

echo $respuesta;
?>