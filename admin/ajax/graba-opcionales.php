<?
require_once("../functions.php");

date_default_timezone_set('America/Santiago');

$opcDesc 	= $_POST['opcDesc'];
$opcPrec 	= $_POST['opcPrec'];
$opcEst 	= $_POST['opcEst'];

$data = Array (
	"opcDesc" 	=> $opcDesc,
	"opcPrec" 	=> $opcPrec,
	"opcEst" 	=> $opcEst
);	

if($_POST['opcID']){
	$opcID = $_POST['opcID'];	
	$db->where("opcID", $opcID);
	$db->update('opcionales', $data);
	
	$respuesta = '2';	
}else{
	$id = $db->insert ('opcionales', $data);
	
	$respuesta = '1';		
}

echo $respuesta;
?>