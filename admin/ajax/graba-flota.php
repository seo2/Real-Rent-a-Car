<?
require_once("../functions.php");

date_default_timezone_set('America/Santiago');

$catID  		= $_POST['catID'];
$autoDesc  		= $_POST['autoDesc'];
$autoPatente 	= $_POST['autoPatente'];
$autoCilin		= $_POST['autoCilin'];
$autoEst  		= $_POST['autoEst'];
$autoFoto		= $_POST['autoFoto'];

if($_POST['autoID']){ // modifica

	if (!empty($_FILES['foto']['name'])) {
		$sourcePath  = $_FILES['foto']['tmp_name']; 
		$temp 		 = explode(".",$_FILES["foto"]["name"]);
		$newfilename = sha1(uniqid(mt_rand(), TRUE)) . '.' .end($temp);
		$targetPath  = "uploads/".$newfilename; 
		move_uploaded_file($sourcePath,$targetPath) ;  
			
		$autoFoto = $newfilename;
	
		$data = Array (
			"catID" 		=> $catID,
			"autoDesc" 		=> $autoDesc,
			"autoPatente" 	=> $autoPatente,
			"autoCilin" 	=> $autoCilin,
			"autoEst" 		=> $autoEst,
			"autoFoto" 		=> $autoFoto
		);		
	}else{
		$data = Array (
			"catID" 		=> $catID,
			"autoDesc" 		=> $autoDesc,
			"autoPatente" 	=> $autoPatente,
			"autoCilin" 	=> $autoCilin,
			"autoEst" 		=> $autoEst
		);		
	}	
	
	$autoID = $_POST['autoID'];
	$db->where("autoID", $autoID);
	$db->update('autos_flota', $data);
	
	$respuesta = '2';	
}else{ // agrega

	if (!empty($_FILES['foto']['name'])) {
		$sourcePath  = $_FILES['foto']['tmp_name']; 
		$temp 		 = explode(".",$_FILES["foto"]["name"]);
		$newfilename = sha1(uniqid(mt_rand(), TRUE)) . '.' .end($temp);
		$targetPath  = "uploads/".$newfilename; 
		move_uploaded_file($sourcePath,$targetPath) ;  
			
		$autoFoto = $newfilename;
		
		$data = Array (
			"catID" 		=> $catID,
			"autoDesc" 		=> $autoDesc,
			"autoPatente" 	=> $autoPatente,
			"autoCilin" 	=> $autoCilin,
			"autoEst" 		=> $autoEst,
			"autoFoto" 		=> $autoFoto
		);		
	}else{
		$data = Array (
			"catID" 		=> $catID,
			"autoDesc" 		=> $autoDesc,
			"autoPatente" 	=> $autoPatente,
			"autoCilin" 	=> $autoCilin,
			"autoEst" 		=> $autoEst
		);		
	}	

	$id = $db->insert ('autos_flota', $data);
	
	$respuesta = '1';		
}

echo $respuesta;
?>