<?php
require_once("../functions.php");

$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);

$catID  = $_POST["catID"];
$fecIni = $_POST["fecIni"];
$horIni = $_POST["horIni"];
$fecFin = $_POST["fecFin"];
$horFin = $_POST["horFin"];

$precio = get_categoria_precio($catID);


$ok = 0;
$resultado = $db->rawQuery('SELECT * FROM autos_flota WHERE catID = '.$catID);
if($resultado){
	foreach ($resultado as $r) {

		$autoID   = $r["autoID"];

		$resFecIni = date("Y-m-d", strtotime(str_replace('/', '-',$fecIni)));
		$resFecFin = date("Y-m-d", strtotime(str_replace('/', '-',$fecFin)));
		
		$ok 	   = 1;
		$pasa 	   = 0;
		$auto      = 1;
		$sql1     = "select * from reservas where resAuto = $autoID and resFecIni >= '$resFecFin'";
						
	  	$formatos = $db->rawQuery($sql1);
		if($formatos){
			foreach ($formatos as $f) {	
				$ok 	  = 0;
				$pasa 	  = 1;
			} 
		} 
		
		$sql2     = "select * from reservas where resAuto = $autoID and resFecFin >= '$resFecIni'";	
		//echo $sql2;			
	  	$formatos = $db->rawQuery($sql2);
		if($formatos){
			foreach ($formatos as $f) {	
				$ok 	  = 0;
				$pasa     = 2;
			} 
		} 
		
		
		
		$sql3     = "select * from reservas where resAuto = $autoID and resFecIni >= '$resFecIni' and resFecFin <= '$resFecFin'";	
		
	  	$formatos = $db->rawQuery($sql3);
		if($formatos){
			foreach ($formatos as $f) {	
				$ok 	  = 0;
				$pasa     = 3;
			} 
		} 
		
		if($ok==0){
			$cola = ' (reservado)';
		}else{
			$cola = '';
		}
		
	    $json[] = array(
	    	'Value' 	=> $r["autoID"], 
	    	'Display' 	=> $r["autoDesc"] .' - '. $r["autoPatente"] . $cola,
	    	'precio' 	=> $precio
	    );
	    $ok = 1;
	}
}

if($ok==0){
    $json[] = array(
    	'Value' 	=> 0, 
    	'Display' 	=> '', 
    	'pieCat' 	=> 0
    );	
}

$opciones = array('opciones' => $json);

header("Content-Type: application/json", true);
echo json_encode($opciones);

?>