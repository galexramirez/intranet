<?php
session_start();
class CRUD
{	
	var $conexion;
	var $objeto;

	function __construct()
	{
		if (!isset($_SESSION['USUARIO_ID'])){
			session_destroy();
			echo '<script>window.location.href = "LogOut";</script>';  
			exit();
		}
		SController('ConexionesBD','C_ConexionBD');
		$Instancia= new C_ConexionesBD();
		$this->conexion=$Instancia->Conectar(); 	
	}

	function SelectTipos($TtablaKilometraje_Operacion,$TtablaKilometraje_Tipo)
	{
		$consulta="SELECT `manto_tipotablaKilometraje`.`TtablaKilometraje_Detalle` AS 'Detalle' FROM `manto_tipotablaKilometraje` WHERE `manto_tipotablaKilometraje`.`TtablaKilometraje_Operacion` = '$TtablaKilometraje_Operacion' AND `manto_tipotablaKilometraje`.`TtablaKilometraje_Tipo` = '$TtablaKilometraje_Tipo' ORDER BY `Detalle` ASC";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function SelectAnios()
	{
		$consulta="SELECT DISTINCT `Calendario_Anio` AS Anio FROM `Calendario` WHERE `Calendario_Anio` > '2022' ORDER BY `Calendario_Anio` DESC";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        return $data;

		$this->conexion=null;
   	}

	function MaxId($TablaBD,$CampoId)
	{
		$consulta = "SELECT MAX(`$CampoId`) AS `MaxId` FROM `$TablaBD`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        

		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function CrearKmDetalle($ckl_km_fecha,$ckl_km_bus,$ckl_km_kilometraje,$ckl_km_fecha_carga,$ckl_km_kmcargaid)
	{
		$ckl_km_usu_carga = $_SESSION['USUARIO_ID'];

		$consulta="INSERT INTO `manto_ckl_kilometraje`(`ckl_km_fecha`, `ckl_km_bus`, `ckl_km_kilometraje`, `ckl_km_usu_carga`, `ckl_km_fecha_carga`, `ckl_km_historial`, `ckl_km_motivo`, `ckl_kilometrajecol`,`ckl_km_kmcargaid`) VALUES ('$ckl_km_fecha','$ckl_km_bus','$ckl_km_kilometraje','$ckl_km_usu_carga','$ckl_km_fecha_carga',NULL,NULL,NULL,'$ckl_km_kmcargaid')";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$valida = $resultado->rowCount();
		if($valida==0){
			return false; 
		}else{
			return true;
		}

		$this->conexion=null;
	}

	function CrearKmCarga($kmcarga_nroregistros,$kmcarga_fecha,$kmcarga_fechacarga)
	{
		$kmcarga_usuarioid = $_SESSION['USUARIO_ID'];
		$consulta="INSERT INTO `manto_kmcarga`(`kmcarga_nroregistros`, `kmcarga_fecha`, `kmcarga_fechacarga`, `Kmcarga_usuarioid`) VALUES ('$kmcarga_nroregistros', '$kmcarga_fecha', '$kmcarga_fechacarga', '$kmcarga_usuarioid')";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		$this->conexion=null;
	}

	function LeerKmCarga($Anios)
	{
		$consulta = "SELECT `kmcarga_id`, `kmcarga_nroregistros`, UPPER(DATE_FORMAT(`kmcarga_fecha`, '%Y-%m-%d %W')) AS `kmcarga_fecha`, UPPER(DATE_FORMAT(`kmcarga_fechacarga`, '%Y-%m-%d %H:%i')) AS `kmcarga_fechacarga`, (SELECT `roles_nombrecorto`FROM `glo_roles` WHERE `manto_kmcarga`.`kmcarga_usuarioid` = `glo_roles`.`roles_dni` LIMIT 1) AS `kmcarga_usuarioid` FROM `manto_kmcarga` WHERE YEAR(`kmcarga_fecha`)='$Anios' ORDER BY `kmcarga_fecha` DESC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}   

	function BorrarKmCarga($kmcarga_id)
	{
		$consulta="DELETE FROM `manto_kmcarga` WHERE `kmcarga_id`='$kmcarga_id'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        

		$this->conexion=null;
	}

	function BorrarKm($kmcarga_id)
	{
		$consulta="DELETE FROM `manto_ckl_kilometraje` WHERE `ckl_km_kmcargaid`='$kmcarga_id'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        

		$this->conexion=null;
	}

	function CrearColumnasKm($FechaInicioKm,$FechaTerminoKm,$TipoBusKm)
	{
		if($TipoBusKm=="TODOS"){
			$consulta = "SELECT DISTINCT `CKL_KM_FECHA` AS `fecha` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_FECHA` >= '$FechaInicioKm' AND `CKL_KM_FECHA` <= '$FechaTerminoKm' ORDER BY `fecha` ASC";
		}else{
			$consulta = "SELECT DISTINCT `CKL_KM_FECHA` AS `fecha` FROM `manto_ckl_kilometraje` LEFT JOIN `Buses` ON `Bus_NroExterno` = `CKL_KM_BUS` WHERE `CKL_KM_FECHA` >= '$FechaInicioKm' AND `CKL_KM_FECHA` <= '$FechaTerminoKm' AND `Bus_Operacion` = '$TipoBusKm' ORDER BY `fecha` ASC";
		}

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;

		$this->conexion=null;
   	}   

	function LeerKm($FechaInicioKm,$FechaTerminoKm,$TipoBusKm)
	{
		if($TipoBusKm=="TODOS"){
			$consulta = "SELECT `CKL_KM_FECHA` AS `fecha`, `CKL_KM_BUS` AS `bus`, ROUND(`CKL_KM_KILOMETRAJE`,0) AS `kmacumulado`, ROUND((`CKL_KM_KILOMETRAJE` - (SELECT `CKL_KM_KILOMETRAJE` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_FECHA` = DATE_ADD(`fecha`, INTERVAL -1 DAY) AND `CKL_KM_BUS`=`bus`)),0) AS `kmrecorrido`, `Bus_Operacion` AS `tipobus` FROM `manto_ckl_kilometraje` LEFT JOIN `Buses` ON `Bus_NroExterno` = `CKL_KM_BUS` WHERE `CKL_KM_FECHA` >= '$FechaInicioKm' AND `CKL_KM_FECHA` <= '$FechaTerminoKm' ORDER BY `bus`, `fecha` ASC";
		}else{
			$consulta = "SELECT `CKL_KM_FECHA` AS `fecha`, `CKL_KM_BUS` AS `bus`, ROUND(`CKL_KM_KILOMETRAJE`,0) AS `kmacumulado`, ROUND((`CKL_KM_KILOMETRAJE` - (SELECT `CKL_KM_KILOMETRAJE` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_FECHA` = DATE_ADD(`fecha`, INTERVAL -1 DAY) AND `CKL_KM_BUS`=`bus`)),0) AS `kmrecorrido`, `Bus_Operacion` AS `tipobus` FROM `manto_ckl_kilometraje` LEFT JOIN `Buses` ON `Bus_NroExterno` = `CKL_KM_BUS` WHERE `CKL_KM_FECHA` >= '$FechaInicioKm' AND `CKL_KM_FECHA` <= '$FechaTerminoKm' AND `Bus_Operacion` = '$TipoBusKm' ORDER BY `bus`, `fecha` ASC";
		}

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;

		$this->conexion=null;
   	}   

	function BusesKm()
	{
		$consulta = "SELECT DISTINCT `CKL_KM_BUS` AS `Buses` FROM `manto_ckl_kilometraje` ORDER BY `Buses` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;

		$this->conexion=null;
   	}   

	function BuscarBusKm($km_bus,$km_fecha)
	{
		$consulta = "SELECT `CKL_KM_FECHA`, `CKL_KM_BUS`, `CKL_KM_KILOMETRAJE`, `CKL_KM_USU_CARGA`, `CKL_KM_FECHA_CARGA`, `CKL_KM_HISTORIAL`, `CKL_KM_MOTIVO`, (SELECT `glo_roles`.`roles_apellidosnombres`FROM `glo_roles` WHERE `glo_roles`.`roles_dni` = `CKL_KM_USU_CARGA` LIMIT 1) AS `km_usuario_carga` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_BUS` = '$km_bus' AND `CKL_KM_FECHA` = '$km_fecha'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}

	function CalculoKilometraje($km_bus,$km_fecha)
	{
		$consulta="SELECT `CKL_KM_BUS`, `CKL_KM_FECHA`, `CKL_KM_KILOMETRAJE`, (SELECT `CKL_KM_KILOMETRAJE` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_BUS` = '$km_bus' AND `CKL_KM_FECHA` = DATE_ADD('$km_fecha', INTERVAL -1 DAY)) AS `km_anterior`, (SELECT `CKL_KM_KILOMETRAJE` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_BUS` = '$km_bus' AND `CKL_KM_FECHA` = DATE_ADD('$km_fecha', INTERVAL +1 DAY)) AS `km_siguiente` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_BUS` = '$km_bus' AND `CKL_KM_FECHA` = '$km_fecha'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function GrabarKm($km_bus,$km_fecha,$km_kilometraje,$km_motivo,$km_historial)
	{
		$nombre_graba = $_SESSION['Usua_NombreCorto'];
		$fecha_graba = date("Y-m-d H:i:s");
		$km_historial .= $fecha_graba." - ".$nombre_graba.": ".$km_motivo." <br>";

		$consulta = "UPDATE `manto_ckl_kilometraje` SET `CKL_KM_KILOMETRAJE`='$km_kilometraje', `CKL_KM_HISTORIAL`='$km_historial', `CKL_KM_MOTIVO`='$km_motivo' WHERE `CKL_KM_FECHA`='$km_fecha' AND `CKL_KM_BUS`='$km_bus'";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        

		$this->conexion=null;
	}

	function DatosGraficoKm($buskm)
	{
		$consulta = "SELECT `CKL_KM_FECHA` AS `date`, ROUND((`CKL_KM_KILOMETRAJE` - (SELECT `CKL_KM_KILOMETRAJE` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_FECHA` = DATE_ADD(`date`, INTERVAL -1 DAY) AND `CKL_KM_BUS`='$buskm')),0) AS `value` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_BUS`='$buskm' ORDER BY `CKL_KM_FECHA` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}

	function ObservadoKmCarga($kmcarga_fecha)
	{
		$otpv_obs_km = "1";
		$otpv_estado = "OBSERVADO";
		$otpv_estado_cerrado = "CERRADO";
		$otpv_obs_cierre_adm = "Observado: Por Kilometraje. <br>";

		$consulta = "UPDATE `manto_otprv` SET `otpv_estado`='$otpv_estado', `otpv_obs_cierre_ad`=CONCAT(`otpv_obs_cierre_ad`,'$otpv_obs_cierre_adm') WHERE `otpv_inicio`=DATE_ADD('$kmcarga_fecha', INTERVAL -1 DAY) AND ( (SELECT `CKL_KM_KILOMETRAJE` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_BUS` = `otpv_bus` AND `CKL_KM_FECHA` = DATE_ADD('$kmcarga_fecha', INTERVAL -2 DAY)) <= `otpv_kmrealiza` OR (SELECT `CKL_KM_KILOMETRAJE` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_BUS` = `otpv_bus` AND `CKL_KM_FECHA` = '$kmcarga_fecha') >= `otpv_kmrealiza` ) AND `otpv_estado`='$otpv_estado_cerrado' ";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        

		$this->conexion=null;
	}

	function ValidarFechaCarga()
	{
		$consulta = "SELECT MAX(`CKL_KM_FECHA`) AS `ultimafechacarga` FROM `manto_ckl_kilometraje`";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function Permisos($cacces_nombremodulo,$cacces_nombreobjeto)
	{
		$rptapermisos = "";
		$cacces_moduloid = "";
		$cacces_objetosid = "";
		$cacces_perfil = $_SESSION['USU_PERFIL'];

		$consulta = "SELECT * FROM `Modulo` WHERE `Modulo`.`Mod_Nombre` = '$cacces_nombremodulo'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		foreach($data as $row){
			$cacces_moduloid = $row['Modulo_Id'];
		}

		$consulta = "SELECT * FROM `glo_objetos` WHERE `glo_objetos`.`obj_nombre` = '$cacces_nombreobjeto'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		foreach($data as $row){
			$cacces_objetosid = $row['objetos_id'];
		}

		$consulta="SELECT * FROM `glo_controlaccesos` WHERE `cacces_perfil` = '$cacces_perfil' AND `cacces_moduloid` = '$cacces_moduloid' AND `cacces_objetosid` = '$cacces_objetosid'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($data as $row){
			$rptapermisos = $row['cacces_acceso'];
		}
		return $rptapermisos;
		$this->conexion=null;
	}

}

// ACTUALIZAR LOS KILOMETRAJES DESPUES DE LA CARGA
/*$inicio=date('Y-m-d',strtotime('-5 days', strtotime($f)));

$sql="
UPDATE OT  SET ot_estado='OBSERVADO',ot_obs_km=1,ot_obs_aom=concat(ot_obs_aom,'<br> Sistema: Observa por kilometraje')
WHERE ot_estado='CERRADO' AND ot_obs_km<>2 AND ot_date_crea>
				ot_date_crea>'$inicio 00:00:00' and
				(	ot_kilometraje<
					(SELECT CKL_KM_KILOMETRAJE  
					FROM CKL_KILOMETRAJE WHERE CKL_KM_BUS=ot_bus  and CKL_KM_FECHA<DATE_FORMAT(ot_date_crea,'%Y-%m-%d') ORDER BY CKL_KM_FECHA DESC LIMIT 1)-5
					OR
					ot_kilometraje> 
					(SELECT CKL_KM_KILOMETRAJE
					FROM CKL_KILOMETRAJE WHERE CKL_KM_BUS=ot_bus  and CKL_KM_FECHA>DATE_FORMAT(ot_date_crea,'%Y-%m-%d') ORDER BY CKL_KM_FECHA ASC LIMIT 1)
				)";

$resultado=mysql_query($sql,$cnx);


$sql4="
UPDATE OTPRV  SET otpv_estado='OBSERVADO',otpv_obs_km=1,otpv_obs_cierre_ad=concat(otpv_obs_cierre_ad,' Sistema: Observa por kilometraje','<BR>')
WHERE otpv_estado='CERRADO' AND otpv_obs_km<>2 AND 
				otpv_inicio>'$inicio 00:00:00' and
				(	otpv_kmrealiza<(SELECT CKL_KM_KILOMETRAJE  
					FROM CKL_KILOMETRAJE WHERE CKL_KM_BUS=otpv_bus  and CKL_KM_FECHA<DATE_FORMAT(otpv_inicio,'%Y-%m-%d') ORDER BY CKL_KM_FECHA DESC LIMIT 1)-5
					OR
					otpv_kmrealiza>(SELECT CKL_KM_KILOMETRAJE
					FROM CKL_KILOMETRAJE WHERE CKL_KM_BUS=otpv_bus  and CKL_KM_FECHA>DATE_FORMAT(otpv_inicio,'%Y-%m-%d') ORDER BY CKL_KM_FECHA ASC LIMIT 1)
				)


";
*/