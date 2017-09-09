<?
require_once("../functions.php");

date_default_timezone_set('America/Santiago');

$segID		= $_POST['segID'];
$catDesc 	= $_POST['catDesc'];
$catPrec    = $_POST['catPrec'];
$catPuertas = $_POST['catPuertas'];
$catPas 	= $_POST['catPas'];
$catCaja	= $_POST['catCaja'];
$catTrac	= $_POST['catTrac'];
$catEst 	= $_POST['catEst'];

$data = Array (
	'segID'		 => $segID,
	'catDesc' 	 => $catDesc,
	'catPrec'    => $catPrec,
	'catPuertas' => $catPuertas,
	'catPas' 	 => $catPas,
	'catCaja'	 => $catCaja,
	'catTrac'	 => $catTrac,
	'catEst' 	 => $catEst
);	

if($_POST['catID']){
	$catID = $_POST['catID'];	
	$db->where("catID", $catID);
	$db->update('autos_categorias', $data);
	
	$respuesta = '2';	
}else{
	$id = $db->insert ('autos_categorias', $data);
	
	$respuesta = '1';		
}

echo $respuesta;
?>