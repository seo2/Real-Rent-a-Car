<?
require_once("../functions.php");

date_default_timezone_set('America/Santiago');

$tramoNom 	= $_POST['tramoNom'];
$tramoVal 	= $_POST['tramoVal'];

$data = Array (
	"tramoNom" 	=> $tramoNom,
	"tramoVal" 	=> $tramoVal
);	

if($_POST['tramoID']){
	$tramoID = $_POST['tramoID'];	
	$db->where("tramoID", $tramoID);
	$db->update('tramos_despacho', $data);
	
	$respuesta = '2';	
}else{
	$id = $db->insert ('tramos_despacho', $data);
	
	$respuesta = '1';		
}

echo $respuesta;
?>