<?
	
	session_start();
	require_once("_lib/config.php");
	require_once("_lib/MysqliDb.php");
	require_once("lib/WideImage.php");
	$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);


	global $urlactual, $dominio;
	$dominio   = $_SERVER['SERVER_NAME'];
	$urlactual = 'http://'.$_SERVER['SERVER_NAME'];

    function init () {
		$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);
    }	
	
	function get_username($userID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario where usuID = '.$userID);
		if($tema){
			foreach ($tema as $t) {
				$temaDesc  = $t["usuNom"];
			}
		}

		return $temaDesc;
		
	}	

	function get_user_nombre($userID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario where usuID = '.$userID);
		if($tema){
			foreach ($tema as $t) {
				$temaDesc  = $t["usuNom"] . ' ' . $t["usuApe"];
			}
		}

		return $temaDesc;
		
	}	

	function get_user_nombre2($userID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario where usuID = '.$userID);
		if($tema){
			foreach ($tema as $t) {
				$temaDesc  =  substr($t["usuNom"], 0,1)  . '. ' . $t["usuApe"];
			}
		}

		return $temaDesc;
		
	}	

	function get_user_mail($userID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario where usuID = '.$userID);
		if($tema){
			foreach ($tema as $t) {
				$temaDesc  = $t["usuMail"];
			}
		}

		return $temaDesc;
		
	}

	function get_usertipo($userID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario where usuID = '.$userID);
		if($tema){
			foreach ($tema as $t) {
				$usuTipo  = $t["usuTipo"];
			}
		}

		return $usuTipo;
		
	}

	function get_userpais($userID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario where usuID = '.$userID);
		if($tema){
			foreach ($tema as $t) {
				$usuTipo  = $t["paisID"];
			}
		}

		return $usuTipo;
		
	}


	function get_proveedor_usuario($userID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario where usuID = '.$userID);
		if($tema){
			foreach ($tema as $t) {
				$usuProv  = $t["usuProv"];
			}
		}

		return $usuProv;
		
	}
	
	function get_comuna($comID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from comuna where comuna_id = '.$comID);
		if($tema){
			foreach ($tema as $t) {
				$temaDesc  = $t["comuna_nombre"];
			}
		}

		return $temaDesc;
		
	}
	
	function get_tramo_desc($tramoID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from tramos_despacho where tramoID = '.$tramoID);
		if($tema){
			foreach ($tema as $t) {
				$temaDesc  = $t["tramoNom"];
			}
		}

		return $temaDesc;
		
	}
	
	function get_tramo_valor($tramoID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from tramos_despacho where tramoID = '.$tramoID);
		if($tema){
			foreach ($tema as $t) {
				$temaDesc  = $t["tramoVal"];
			}
		}

		return $temaDesc;
		
	}

	function get_usercomuna($userID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario where usuID = '.$userID);
		if($tema){
			foreach ($tema as $t) {
				if($t["usuCom"]>0){
					$temaDesc  =  get_comuna($t["usuCom"]);
				}else{
					$temaDesc  =  '';
				}
			}
		}

		return $temaDesc;
		
	}
	
	
	function get_estado_tienda($tiendaID,$eveID){
		$db 	= MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from items where tiendaID = '.$tiendaID.' and eveID = '.$eveID.' and itemEst = 0');
		$ok = 1;
		if($tema){
			foreach ($tema as $t) {
					$ok = 0;
			}
		}else{
			$ok = 1;
		}

		return $ok;
	
	}
	function get_auto($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from autos_flota where autoID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["autoDesc"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
		
	}
	function get_cat_auto($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from autos_flota where autoID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["catID"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
		
	}
	function get_pat_auto($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from autos_flota where autoID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["autoPatente"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
		
	}
	function get_categoria($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from autos_categorias where catID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["catDesc"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
		
	}
	function get_categoria_precio($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from autos_categorias where catID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["catPrec"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
		
	}


	function get_segmento_cat($catID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from autos_categorias where catID = '.$catID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["segID"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
	}
	
	
	function get_segmento($eveID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from autos_segmentos where segID = '.$eveID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["segNom"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
		
	}
	
	
	function get_regiones(){
		$db = MysqliDb::getInstance();
		$regiones = $db->rawQuery("SELECT region_id, region_nombre from region");
		return($regiones);    
	}





	



	function formatoxcatalogo($camID,$catID,$formID){
		$ok = false;
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from catalogo_x_formato where camID = '.$camID.' and catID = '.$catID.' and formID = '.$formID);
		if($tema){
			foreach ($tema as $t) {
				$ok = true;
			}
		}

		return $ok;
	}


	function ISCxformatoxcatalogo($camID,$catID,$formID,$inCaID){
		$ok = false;
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from catalogo_x_formato_x_ISC where camID = '.$camID.' and catID = '.$catID.' and formID = '.$formID.' and iscID = '.$inCaID);
		if($tema){
			foreach ($tema as $t) {
				$ok = true;
			}
		}

		return $ok;
	}


	function get_isc_camp($formID,$inCaID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores_campanas where formID = '.$formID.' and inCaID = '.$inCaID);
		if($tema){
			foreach ($tema as $t) {
				$inCaNom = $t['inCaNom'];
			}
		}

		return $inCaNom;
	}


	function get_isc_med($formID,$inCaID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores_campanas where formID = '.$formID.' and inCaID = '.$inCaID);
		if($tema){
			foreach ($tema as $t) {
				$inCaMed = $t['inCaMed'];
			}
		}

		return $inCaMed;
	}




	function get_pedido_temporal($tieID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from pedido_temporal where ptTie = '.$tieID.' and ptEst = 0');
		if($tema){
			foreach ($tema as $t) {
				$ptID = $t['ptID'];
			}
		}else{
			$ptID = '';
		}
		return $ptID;
	}
	
	
	

	function get_pedido_fecha_proceso($paisID,$ptID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from pedido_temporal where paisID = '.$paisID.' and ptID = '.$ptID);
		if($tema){
			foreach ($tema as $t) {
				$ptID = $t['ptTS'];
			}
		}else{
			$ptID = '';
		}
		return $ptID;
	}




	function get_pedido_temporal_x_usuario($paisID,$tieID,$usuID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from pedido_temporal where paisID = '.$paisID.' and ptTie = '.$tieID.' and ptVM = '.$usuID.' and ptEst = 0');
		if($tema){
			foreach ($tema as $t) {
				$ptID = $t['ptID'];
			}
		}else{
			$ptID = '';
		}
		return $ptID;
	}


	function get_total_items_pedido_temporal($paisID, $ptID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from pedido_temporal_detalle where paisID = '.$paisID.' and ptID = '.$ptID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}

	function get_tienda_pedido($paisID,$ptID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from pedido_temporal where paisID = '.$paisID.' and ptID = '.$ptID);
		if($tema){
			foreach ($tema as $t) {
				$tieID = $t['ptTie'];
			}
		}

		return $tieID;
	}

	function get_proveedor_nombre($pieProv){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from proveedores where provID = '.$pieProv);
		if($tema){
			foreach ($tema as $t) {
				$tieForm = $t['provNom'];
			}
		}

		return $tieForm;
	}

	function get_proveedor_mails($pieProv){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from proveedores where provID = '.$pieProv);
		if($tema){
			foreach ($tema as $t) {
				$tieForm = $t['provMail'];
			}
		}

		return $tieForm;
	}

	function get_tipo_usuario_desc($utipID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuTipos where utipID = '.$utipID);
		if($tema){
			foreach ($tema as $t) {
				$utiDesc = $t['utiDesc'];
			}
		}
		return $utiDesc;
	}


	function get_campana_desc($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from campana where camID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["camDesc"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
		
	}


	function get_campana_desc_v2($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from campana_v2 where camID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["camDesc"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
		
	}


	function get_desc_campana_v2($camID,$ID){
		$db 	= MysqliDb::getInstance();
		$tema 	= $db->rawQuery('select * from catalogo_v2 where camID = '.$camID.' and catID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$camDesc  = $t["camDesc"];
			}
		}else{
			$camFile = '';
		}

		return $camDesc;
		
	}

	
	function get_campana_catalogo($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from catalogo where catID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["camID"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
		
	}

	function get_total_fotos_campana($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from catalogo where camID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["total"];
			}
		}else{
			$eveNombre = 0;
		}

		return $eveNombre;
		
	}	function get_total_fotos_campana_v2($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from catalogo_v2 where camID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["total"];
			}
		}else{
			$eveNombre = 0;
		}

		return $eveNombre;
		
	}

	function get_foto_campana($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from catalogo where catID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["camFile"];
			}
		}else{
			$eveNombre = 0;
		}

		return $eveNombre;
		
	}

	function get_foto_campana_v2($camID,$ID){
		$db 	= MysqliDb::getInstance();
		$tema 	= $db->rawQuery('select * from catalogo_v2 where camID = '.$camID.' and catID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$camFile  = $t["camFile"];
			}
		}else{
			$camFile = '';
		}

		return $camFile;
		
	}


	function get_total_piezas_formato($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from piezas where formID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}

	function get_total_instores_formato($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from instores where formID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}


	function get_total_piezas_formato_x_responsable($ID,$usuID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from piezas where formID = '.$ID.'  and pieRes = '.$usuID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}
	


	function get_total_instores_formato_v2($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from instores_v2 where formID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}

	


	function get_total_piezas_instores_x_responsable($ID,$usuID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from instores where formID = '.$ID.'  and pieRes = '.$usuID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}

	function get_responsable_pieza($pieID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from piezas where pieID = '.$pieID);
		if($tema){
			foreach ($tema as $t) {
				$pieRes = $t['pieRes'];
			}
		}
		return $pieRes;
	}

	function get_cantidad_pieza($pieID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from piezas where pieID = '.$pieID);
		if($tema){
			foreach ($tema as $t) {
				$pieRes = $t['pieCan'];
			}
		}
		return $pieRes;
	}

	function get_total_opciones_pieza($pieID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from pieza_opciones where pieID = '.$pieID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}

	function get_total_opciones_instores($formID, $insID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from instores_opciones where formID = '.$formID.' and insID ='.$insID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}

	function get_total_opciones_instores_v2($formID, $insID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from instores_opciones_v2 where formID = '.$formID.' and insID ='.$insID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}
	
/*
	function get_proveedor_pedido($ptID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from pedido_temporal_detalle where ptID = '.$ptID);
		if($tema){
			foreach ($tema as $t) {
				$ptdProv = $t['ptdProv'];
			}
		}
		return $ptdProv;
	}
*/


	function get_VM_pedido($paisID, $ptID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from pedido_temporal_detalle where paisID = '.$paisID.' and ptID = '.$ptID);
		if($tema){
			foreach ($tema as $t) {
				$pieRes = $t['ptdVM'];
			}
		}
		return $pieRes;
	}

function resample($jpgFile, $thumbFile, $width, $orientation) {
    // Get new dimensions
    list($width_orig, $height_orig) = getimagesize($jpgFile);
    $height = (int) (($width / $width_orig) * $height_orig);
    // Resample
    $image_p = imagecreatetruecolor($width, $height);
    $image   = imagecreatefromjpeg($jpgFile);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
    // Fix Orientation
    switch($orientation) {
        case 3:
            $image_p = imagerotate($image_p, 180, 0);
            break;
        case 6:
            $image_p = imagerotate($image_p, -90, 0);
            break;
        case 8:
            $image_p = imagerotate($image_p, 90, 0);
            break;
    }
    // Output
    imagejpeg($image_p, $thumbFile, 90);
}



	
	function ask_opcion_reserva($resID,$opcID){
		$ok = 0;
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from reservas_opcionales where resID = '.$resID.' and opcID = '.$opcID);
		if($tema){
			foreach ($tema as $t) {
				$ok = 1;
			}
		}

		return $ok;
		
	}
	
	
	function get_pais_nom($clID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from paises where paisID = '.$clID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["paisNom"];
			}
		}else{
			$eveNombre = 'Error';
		}
	
		return $eveNombre;
		
	}
	function get_currency($clID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from rate_exchange where rexPais = '.$clID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["rexCurr"];
			}
		}else{
			$eveNombre = 'Error';
		}
	
		return $eveNombre;
		
	}
	function ask_usuario_formato($usuID,$formID){
		$ok = 0;
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario_x_formato where usuID = '.$usuID.' and formID = '.$formID);
		if($tema){
			foreach ($tema as $t) {
				$ok = 1;
			}
		}

		return $ok;
		
	}
	
	function get_instore_nom_gen($formID, $insID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores where formID = '.$formID.' and insID = '.$insID);
		if($tema){
			foreach ($tema as $t) {
				$nombre  = $t["insNomGen"];
			}
		}else{
			$nombre = 'Error';
		}
	
		return $nombre;
	}
	
	function get_instore_nom_gen_v2($formID, $insID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores_v2 where formID = '.$formID.' and insID = '.$insID);
		if($tema){
			foreach ($tema as $t) {
				$nombre  = $t["insNomGen"];
			}
		}else{
			$nombre = 'Error';
		}
	
		return $nombre;
	}
	
	
	function get_instore_nom_ges($formID, $insID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores where formID = '.$formID.' and insID = '.$insID);
		if($tema){
			foreach ($tema as $t) {
				$nombre  = $t["insNomGes"];
			}
		}else{
			$nombre = 'Error';
		}
	
		return $nombre;
	}
	
	function get_instore_nom_ges_v2($formID, $insID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores_v2 where formID = '.$formID.' and insID = '.$insID);
		if($tema){
			foreach ($tema as $t) {
				$nombre  = $t["insNomGes"];
			}
		}else{
			$nombre = 'Error';
		}
	
		return $nombre;
	}
	
	
	function get_tienda_x_formato_x_pais($formID, $paisID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from tiendas where tieForm = '.$formID.' and paisID = '.$paisID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}	
	
	function quitatodo($string){
    	$colA = str_replace(' ', '', $string);
    	$colA = str_replace('_', '', $colA);
    	$colA = str_replace('-', '', $colA);
    	$colA = str_replace('/', '', $colA);
    	$colA = str_replace(')', '', $colA);
    	$colA = str_replace('(', '', $colA);
    	$colA = str_replace('&ntilde;', 'n', $colA);
    	$colA = str_replace('&ouml;', 'o', $colA);
    	$colA = str_replace('ö', 'o', $colA);
    	$colA = str_replace('ñ', 'n', $colA);
    	$colA = str_replace('%', 'porc', $colA);
    	$colA = str_replace('&', 'porc', $colA);
    	$colA = str_replace('generico', '', $colA);
    	$colA = strtolower($colA);
    	return $colA;
	}

	

	function get_precio_opcional($opcID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from opcionales where opcID = '.$opcID);
		if($tema){
			foreach ($tema as $t) {
				$rexVal = $t['opcPrec'];
			}
		}

		return $rexVal;
	}
	
	function check_ISC_campana($camID, $catID){
		$db = MysqliDb::getInstance();
		$ok = 0;
		$tema = $db->rawQuery('select * from catalogo_x_formato where camID = '.$camID.' and catID = '.$catID.' limit 1');
		if($tema){
			foreach ($tema as $t) {
				$ok = 1;
			}
		}

		return $ok;
	}
	
	function get_ISC_camp_nom($formID,$inCaID){
		$db = MysqliDb::getInstance();
		$ok = 0;
		$tema = $db->rawQuery('select * from instores_campanas where formID = '.$formID.' and inCaID = '.$inCaID);
		if($tema){
			foreach ($tema as $t) {
				$inCaNom = $t['inCaNom'];
			}
		}

		return $inCaNom;
	}
	
	function get_ISC_camp_nom_med($formID,$inCaID){
		$db = MysqliDb::getInstance();
		$ok = 0;
		$tema = $db->rawQuery('select * from instores_campanas where formID = '.$formID.' and inCaID = '.$inCaID);
		if($tema){
			foreach ($tema as $t) {
				$desc = $t['inCaNom'].' ('.$t['inCaMed'].')';
			}
		}

		return $desc;
	}
	
	

	function comprueba_archivos_x_pieza_formato($formID,$pieID){
		$db 	= MysqliDb::getInstance();
		$ok 	= 1;
		$ruta 	= get_carpeta_ISC_v2($formID);
		$sql  	= "select * from instores_opciones_v2 where formID = $formID and insID = $pieID";

	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				if($r['insOpCat']==0){
					if($r['insOpFoto']){ 
						$archivo = '/ajax/uploads/ISC2/'.$r['insOpFoto'];
					}else{
						$archivo = '/'.$ruta.quitatodo($insNomGen).quitatodo($r["insOpNom"]).'.jpg';
					}				
					
					if (file_exists($archivo)) {
					
					}else{
					    $ok = 0;
					}	
				}else{
					$ok = 0;
				}				
			}
		}

		return $ok;
	}

	
?>