<?php
require_once("../admin/functions.php");


$nombre		= $_POST['nombre'];
$apellido	= $_POST['apellido'];
$email		= $_POST['email'];
$telefono	= $_POST['telefono'];
$mensaje	= $_POST['mensaje'];


date_default_timezone_set('America/Santiago');
$ahora = date("Y-m-d H:i:s");

$data = Array (
	"conNom"  	=> $nombre,
	"conApe"  	=> $apellido,
	"conMail"  	=> $email,
	"conFono"  	=> $telefono,
	"conMens"  	=> $mensaje,
	"conTS"  	=> $ahora
);

	
$id = $db->insert('contacto', $data);		

if ($id){
		
	$message   = "<!DOCTYPE html>";
	$message  .= "<html lang='en' style='box-sizing: border-box; color: rgba(0, 0, 0, 0.87);  font-size: 14px; font-weight: normal; height: 100%; line-height: 1.5; width: 100%; '>";
	$message  .= "<head style='box-sizing: inherit;'>";
	$message  .= "<meta content='text/html; charset=UTF-8' http-equiv='Content-Type' style='box-sizing: inherit;' />";
	$message  .= "<meta content='width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no' name='viewport' style='box-sizing: inherit;' />";
	$message  .= "<title style='box-sizing: inherit;'>REAL Rent a Car</title>";
	$message  .= "</head>";
	$message  .= "<body style='box-sizing: inherit; height: 100%; margin: 0; width: 100%;font-family: Arial, Helvetica, sans-serif;'>";
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
	$message  .= "<h5 class='titulo' style='box-sizing: inherit; color: #343233; font-size: 18px; font-weight: 300; line-height: 110%; margin: 30px 0; text-align: left;'>Mensaje desde formulario de contacto</strong></h5>";
	$message  .= "<div class='divider' style='background-color: #e0e0e0; box-sizing: inherit; height: 1px; overflow: hidden;'>";
	$message  .= "</div>";
	$message  .= "<h5 class='titulo' style='box-sizing: inherit; color: #343233; font-size: 18px; font-weight: 700; line-height: 110%; margin: 30px 0; text-align: left;'>". utf8_decode($nombre). " ". utf8_decode($apellido)."</h5>";
	$message  .= "<table class='bordered' style='border: none; border-collapse: collapse; border-spacing: 0; box-sizing: inherit; display: table; width: 100%;'>";
	$message  .= "<tbody style='box-sizing: inherit;'>";
	$message  .= "<tr style='border-bottom: 1px solid #d0d0d0; box-sizing: inherit;'>";
	$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>Email:</td>";
	$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>".$email."</td>";
	$message  .= "</tr>";
	$message  .= "<tr style='border-bottom: 1px solid #d0d0d0; box-sizing: inherit;'>";
	$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>Teléfono:</td>";
	$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>".$telefono."</td>";
	$message  .= "</tr>";
	$message  .= "<tr style='border-bottom: 1px solid #d0d0d0; box-sizing: inherit;'>";
	$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>Mensaje:</td>";
	$message  .= "<td style='border: none; border-radius: 2px; box-sizing: inherit; display: table-cell; padding: 15px 5px; text-align: left; vertical-align: middle;'>".$mensaje."</td>";
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
	
	
	
	
/*
	echo $message;
	
	exit;	
*/

	$to 		= 'contacto@realrentacar.cl';
	
	$subject 	= 'Contacto desde Real Rent a Car';
	
	$headers  = "From: Real Rent a Car <contacto@realrentacar.cl>\r\n";
	$headers .= "BCC: seo2@seo2.cl\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	mail($to, $subject, $message, $headers);

    echo $id;	
}else{
    echo 'error';
}

	

?>