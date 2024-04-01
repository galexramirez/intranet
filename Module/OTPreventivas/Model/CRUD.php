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
		$Instancia		= new C_ConexionesBD();
		$this->conexion = $Instancia->Conectar(); 	
	}

	function select_combo($nombre_tabla, $es_campo_unico, $campo_select, $condicion_where)
	{
		$distinct 	= "";
		$c_where 	= "";
		if($es_campo_unico == "SI"){
			$distinct = "DISTINCT";
		}
		if($condicion_where!=""){
			$c_where = "WHERE ".$condicion_where;
		}
		$consulta = "SELECT ".$distinct." `$nombre_tabla`.`$campo_select` AS `detalle` FROM `$nombre_tabla` ".$c_where." ORDER BY `$nombre_tabla`.`$campo_select`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;   
		$this->conexion=null;
	}

	function LeerOTPrvCarga($Anios)
	{
		$consulta = "SELECT `otprvcarga_id`, `otprvcarga_semanaprogramada`, `otprvcarga_nroregistros`, UPPER(DATE_FORMAT(`otprvcarga_fechacargada`, '%Y-%m-%d %W')) AS `otprvcarga_fechacargada`,(SELECT `roles_nombrecorto` FROM `glo_roles` WHERE `manto_otprvcarga`.`otprvcarga_usuarioid` = `glo_roles`.`roles_dni` LIMIT 1) AS `otprvcarga_usuarioid` FROM `manto_otprvcarga` WHERE CONCAT('20',SUBSTRING(`otprvcarga_semanaprogramada`,1,2))='$Anios'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion = null;
	}   
	
	function LeerOTPrv($FechaInicioOTPrv,$FechaTerminoOTPrv)
	{
		$consulta = "SELECT CONCAT_WS('-','P',`cod_otpv`) AS `cod_otpv`, `otpv_estado`, DATE_FORMAT(`otpv_date_prog`,'%Y-%m-%d') AS `otpv_date_prog`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_genera` LIMIT 1) AS `otpv_genera`, `otpv_bus`,`otpv_fecuencia`, `otpv_asociado`, `otpv_tecnico`, `otpv_descripcion`, DATE_FORMAT(`otpv_fin`,'%Y-%m-%d %H:%i') AS `otpv_fin`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_cgm_cierra` LIMIT 1) AS `otpv_cgm_cierra`, DATE_FORMAT(`otpv_date_cierra_ad`,'%Y-%m-%d %H:%i') AS `otpv_date_cierra_ad`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_cierra_ad` LIMIT 1) AS `otpv_cierra_ad`,`otpv_kmrealiza`, '' AS `otpv_vales`, `otpv_semana`, `otpv_turno` FROM `manto_otprv` WHERE DATE_FORMAT(`otpv_date_prog`,'%Y-%m-%d')>='$FechaInicioOTPrv' AND DATE_FORMAT(`otpv_date_prog`,'%Y-%m-%d')<='$FechaTerminoOTPrv'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

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
	
	function CrearOTPrvCarga($otprvcarga_semanaprogramada,$otprvcarga_fechacargada,$otprvcarga_nroregistros)
	{
		$otprvcarga_usuarioid = $_SESSION['USUARIO_ID'];
		$consulta="INSERT INTO `manto_otprvcarga`(`otprvcarga_semanaprogramada`, `otprvcarga_fechacargada`, `otprvcarga_usuarioid`,`otprvcarga_nroregistros`) VALUES ('$otprvcarga_semanaprogramada', '$otprvcarga_fechacargada', '$otprvcarga_usuarioid', '$otprvcarga_nroregistros')";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		$this->conexion=null;
	}
	
	function CrearOTPrvDetalle($cod_otpv,$otpv_semana,$otpv_turno,$otpv_date_prog,$otpv_bus,$otpv_frecuencia,$otpv_descripcion,$otpv_asociado,$otpv_date_genera,$otpv_cargaid)
	{
		$otpv_genera	= $_SESSION['USUARIO_ID'];
		$otpv_estado	= 'ABIERTO';
		$error			= [];

		$consulta="INSERT INTO `manto_otprv`(`cod_otpv`, `otpv_semana`, `otpv_turno`, `otpv_date_prog`, `otpv_bus`, `otpv_fecuencia`, `otpv_descripcion`, `otpv_asociado`, `otpv_genera`, `otpv_date_genera`, `otpv_estado`, `otpv_cargaid`) VALUES ('$cod_otpv','$otpv_semana','$otpv_turno','$otpv_date_prog','$otpv_bus','$otpv_frecuencia','$otpv_descripcion','$otpv_asociado','$otpv_genera','$otpv_date_genera','$otpv_estado','$otpv_cargaid')";
		
		$resultado = $this->conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$valida = $resultado->rowCount();

		if($valida==0){
			$error = $resultado->errorInfo();
		}
		return $error;
		$this->conexion = null;
	}

	function BuscarOTPrvCarga($otprvcarga_semanaprogramada)
	{
		$consulta="SELECT * FROM `manto_otprvcarga` WHERE `otprvcarga_semanaprogramada`='$otprvcarga_semanaprogramada'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$valida = $resultado->rowCount();
		if($valida==0){
			return true; 
		}else{
			return false;
		}

		$this->conexion=null;
	}

	function BorrarOTPrvCarga($otprvcarga_id)
	{
		$consulta="DELETE FROM `manto_otprvcarga` WHERE `otprvcarga_id`='$otprvcarga_id'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        

		$this->conexion=null;
	}

	function BorrarOTPrv($otprvcarga_id)
	{
		$consulta="DELETE FROM `manto_otprv` WHERE `otpv_cargaid`='$otprvcarga_id'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        

		$this->conexion=null;
	}

	function ValidarOTPrv($otprvcarga_semanaprogramada)
	{
		$consulta="SELECT MIN(`otpv_date_prog`) AS `MinFechaProgramada` FROM `manto_otprv` WHERE `otpv_semana`='$otprvcarga_semanaprogramada'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        return $data;

		$this->conexion=null;
	}

	function CargarOTPrv($cod_otpv)
	{
		$consulta="SELECT `cod_otpv`, `otpv_semana`, `otpv_turno`, `otpv_date_prog`, `otpv_bus`, `otpv_fecuencia`, `otpv_descripcion`, `otpv_asociado`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_genera` LIMIT 1) AS `otpv_genera`, DATE_FORMAT(`otpv_date_genera`,'%d-%m-%Y %H:%i') AS `otpv_date_genera`, `otpv_estado`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_cgm_cierra` LIMIT 1) AS `otpv_cgm_cierra`, `otpv_tecnico`, DATE_FORMAT(`otpv_inicio`,'%Y-%m-%dT%H:%i') AS `otpv_inicio`, DATE_FORMAT(`otpv_fin`,'%Y-%m-%dT%H:%i') AS `otpv_fin`, `otpv_kmrealiza`, `otpv_hmotor`, `otpv_componente`, `otpv_obs_as`, `otpv_obs_cgm`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_cierra_ad`  LIMIT 1) AS `otpv_cierra_ad`, DATE_FORMAT(`otpv_date_cierra_ad`,'%d-%m-%Y %H:%i') AS `otpv_date_cierra_ad`, `otpv_obs_cierre_ad`, `otpv_obs_km` FROM `manto_otprv` WHERE `cod_otpv` = '$cod_otpv'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}

	function SelectUsuario($Usua_Perfil)
	{
		switch ($Usua_Perfil){
			case 'CGM':
				$consulta="SELECT `glo_roles`.`roles_nombrecorto` AS `Usuario` FROM `glo_roles` WHERE `roles_perfil` = '$Usua_Perfil' ORDER BY `Usuario` ASC";
			break;
			
			case 'TECNICO':
				$ra_asociado = "LBI";
				$consulta="SELECT DISTINCT `manto_resp_asociado`.`ra_nombres` AS `Usuario` FROM `manto_resp_asociado` WHERE `ra_asociado` <> '$ra_asociado' ORDER BY `Usuario` ASC ";
			break;
			
			default: ;
		}

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function SelectTecnico($otpv_asociado)
	{
		$consulta="SELECT DISTINCT `manto_resp_asociado`.`ra_nombres` AS `Usuario` FROM `manto_resp_asociado` WHERE `ra_asociado` = '$otpv_asociado' ORDER BY `Usuario` ASC ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function BuscarTecnico($otpv_asociado)
	{
		$consulta="SELECT `manto_resp_asociado`.`ra_nombres` AS `otpv_tecnico` FROM `manto_resp_asociado` WHERE `ra_asociado` = '$otpv_asociado' ORDER BY `otpv_tecnico` ASC LIMIT 1";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function SelectTipos($TtablaOTPreventivas_Operacion,$TtablaOTPreventivas_Tipo)
	{
		$consulta="SELECT `manto_tipotablaotpreventivas`.`TtablaOTPreventivas_Detalle` AS 'Detalle' FROM `manto_tipotablaotpreventivas` WHERE `manto_tipotablaotpreventivas`.`TtablaOTPreventivas_Operacion` = '$TtablaOTPreventivas_Operacion' AND `manto_tipotablaotpreventivas`.`TtablaOTPreventivas_Tipo` = '$TtablaOTPreventivas_Tipo' ORDER BY `Detalle` ASC";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function CalculoKilometraje($optv_bus,$optv_inicio)
	{
		$consulta="SELECT (SELECT `CKL_KM_FECHA` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_BUS` = '$optv_bus' AND `CKL_KM_FECHA` = '$optv_inicio' ORDER BY `CKL_KM_FECHA` DESC LIMIT 1) AS `fechafinal`, (SELECT `CKL_KM_KILOMETRAJE` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_BUS`='$optv_bus' AND `CKL_KM_FECHA` = '$optv_inicio' ORDER BY `CKL_KM_FECHA` DESC LIMIT 1) AS `kmfinal`, (SELECT `CKL_KM_FECHA` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_BUS`='$optv_bus' AND `CKL_KM_FECHA` < '$optv_inicio' ORDER BY `CKL_KM_FECHA` DESC LIMIT 1) AS `fechainicial`, (SELECT `CKL_KM_KILOMETRAJE` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_BUS`='$optv_bus' AND `CKL_KM_FECHA` < '$optv_inicio' ORDER BY `CKL_KM_FECHA` DESC LIMIT 1) AS `kminicial`, `CKL_KM_BUS` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_BUS`='$optv_bus' ORDER BY `fechafinal` DESC LIMIT 1";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function EditarOTPrv($cod_otpv, $otpv_cgm_cierra, $otpv_tecnico, $otpv_inicio, $otpv_fin, $otpv_kmrealiza, $otpv_hmotor, $otpv_componente, $otpv_obs_as, $otpv_obs_cgm,  $otpv_obs_cierre_ad, $otpv_obs_cierre_ad2, $otpv_obs_km, $otpv_estado, $otpv_turno, $otpv_date_prog, $otpv_bus, $otpv_fecuencia, $otpv_descripcion, $otpv_asociado)
	{
        $error_msg = [];
		$otpv_cierra_ad = $_SESSION['USUARIO_ID'];
		$nombre_cierra_adm = $_SESSION['Usua_NombreCorto'];
		$otpv_date_cierra_ad = date("Y-m-d H:i:s");

		if(!empty($otpv_obs_cierre_ad2)){
			$otpv_obs_cierre_ad = "<strong>".$otpv_estado." ".date_format(date_create($otpv_date_cierra_ad),"d-m-Y H:i")." ".$nombre_cierra_adm." : ".$otpv_obs_cierre_ad2."</strong><br>".$otpv_obs_cierre_ad;
		}else{
			$otpv_obs_cierre_ad = "<strong>".$otpv_estado." ".date_format(date_create($otpv_date_cierra_ad),"d-m-Y H:i")." ".$nombre_cierra_adm."</strong><br>".$otpv_obs_cierre_ad;
		}

		$consulta = "UPDATE `manto_otprv` SET `otpv_cgm_cierra` = IF('$otpv_cgm_cierra' = '', NULL, '$otpv_cgm_cierra'), `otpv_tecnico` = '$otpv_tecnico', `otpv_inicio` = IF('$otpv_inicio' = '', NULL, '$otpv_inicio'), `otpv_fin` = IF('$otpv_fin' = '', NULL, '$otpv_fin'), `otpv_kmrealiza` = '$otpv_kmrealiza', `otpv_hmotor` = '$otpv_hmotor', `otpv_componente` = '$otpv_componente', `otpv_obs_as` = '$otpv_obs_as', `otpv_obs_cgm` = '$otpv_obs_cgm', `otpv_cierra_ad` = '$otpv_cierra_ad', `otpv_date_cierra_ad` = '$otpv_date_cierra_ad', `otpv_obs_cierre_ad` = '$otpv_obs_cierre_ad', `otpv_obs_km` = '$otpv_obs_km', `otpv_estado` = '$otpv_estado', `otpv_turno` = '$otpv_turno', `otpv_date_prog` = '$otpv_date_prog', `otpv_bus` = '$otpv_bus', `otpv_fecuencia` = '$otpv_fecuencia', `otpv_descripcion` = '$otpv_descripcion', `otpv_asociado` = '$otpv_asociado' WHERE `cod_otpv` = '$cod_otpv'";

		$resultado = $this->conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		
		$error_msg = $resultado->errorInfo();
		return $error_msg;
		$this->conexion=null;
	}

	function BuscarDataBD($TablaBD,$CampoBD,$DataBuscar)
	{
		$consulta="SELECT * FROM `$TablaBD` WHERE `$CampoBD` = '$DataBuscar'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function buscar_dato($nombre_tabla, $campo_buscar, $condicion_where)
	{
		$consulta = "SELECT `$nombre_tabla`.`$campo_buscar` FROM `$nombre_tabla` WHERE ".$condicion_where;

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

	function TruncateTabla($TablaBD)
	{
		$consulta = "TRUNCATE `$TablaBD`";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        

		$this->conexion=null;
	}

	function AutoCompletar($NombreTabla,$NombreCampo)
	{
		$consulta="SELECT * FROM `$NombreTabla`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function Permisos($obj_moduloid,$obj_objetoid)
	{
		$rptapermisos = "";
		$modulo_id = "";
		$obj_usuarioid = $_SESSION['USUARIO_ID'];
		$consulta = "SELECT * FROM `Modulo` WHERE `Modulo`.`Mod_Nombre` = '$obj_moduloid'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		foreach($data as $row){
			$modulo_id = $row['Modulo_Id'];
		}
		$consulta="SELECT * FROM `glo_objetos` WHERE `obj_usuarioid` = '$obj_usuarioid' AND `obj_moduloid` = '$modulo_id' AND `obj_objetoid` = '$obj_objetoid'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($data as $row){
			$rptapermisos = $row['obj_acceso'];
		}
		return $rptapermisos;
		$this->conexion=null;
	}

	function ver_ot_prv($cod_ot_prv)
	{
		$consulta = "SELECT `cod_otpv`, `otpv_semana`, `otpv_turno`, `otpv_date_prog`, `otpv_bus`, `otpv_fecuencia`, `otpv_descripcion`, `otpv_asociado`, `otpv_estado`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_genera` LIMIT 1) AS `otpv_genera`, `otpv_date_genera`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_cierra_ad` LIMIT 1) AS `otpv_cierra_ad`, `otpv_date_cierra_ad`, `otpv_tecnico`, `otpv_inicio`, `otpv_fin`, `otpv_kmrealiza`, `otpv_hmotor`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_cgm_cierra` LIMIT 1) AS `otpv_cgm_cierra`, `otpv_obs_as`, `otpv_obs_cgm`, `otpv_obs_cierre_ad` FROM `manto_otprv` WHERE `cod_otpv` = '$cod_ot_prv'";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function descargar_otprv($FechaInicioOTPrv,$FechaTerminoOTPrv)
	{
		$consulta	= "SELECT CONCAT_WS('-','P',`cod_otpv`) AS `cod_otpv`, `otpv_estado`, DATE_FORMAT(`otpv_date_prog`,'%d-%m-%Y') AS `otpv_date_prog`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_genera` LIMIT 1) AS `otpv_genera`, `otpv_bus`, `otpv_fecuencia`, `otpv_asociado`, `otpv_tecnico`, `otpv_descripcion`, `otpv_kmrealiza`, `otpv_hmotor`, '' AS `otpv_sistema`, '' AS `otpv_codfalla`, '' AS `otpv_check`, DATE_FORMAT(`otpv_inicio`,'%d-%m-%Y %H:%i') AS `otpv_inicio`, DATE_FORMAT(`otpv_fin`,'%d-%m-%Y %H:%i') AS `otpv_fin`, TIMESTAMPDIFF(MINUTE,`otpv_inicio`,`otpv_fin`) AS `otpv_duracion_actividad`, '' AS `otpv_accion_tomada`, `otpv_obs_as`, '' AS `otpv_tecnico`, '' AS `otpv_montado`, '' AS `otpv_dmontado`, '' AS `otpv_busmont`, '' AS `otpv_busdmont`, '' AS `otpv_motivo`, DATE_FORMAT(`otpv_fin`,'%d-%m-%Y %H:%i') AS `otpv_date_cierre_tecnico`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_cgm_cierra` LIMIT 1) AS `otpv_cgm_cierra`, `otpv_obs_cgm`, DATE_FORMAT(`otpv_date_cierra_ad`,'%d-%m-%Y %H:%i') AS `otpv_date_cierra_ad`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_cierra_ad` LIMIT 1) AS `otpv_cierra_ad`, `otpv_obs_cierre_ad`, `otpv_semana`, `otpv_turno`, DATE_FORMAT(`otpv_date_genera`,'%d-%m-%Y %H:%i') AS `otpv_date_genera`, '' AS `ib_Sistema` FROM `manto_otprv` WHERE DATE_FORMAT(`otpv_date_genera`,'%Y-%m-%d')>='$FechaInicioOTPrv' AND DATE_FORMAT(`otpv_date_genera`,'%Y-%m-%d')<='$FechaTerminoOTPrv' ";

		$resultado 	= $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

        return $data;
        $this->conexion=null;
   	}   

	function otprv_observadas()
	{

		$consulta = " SELECT COUNT(*) AS `cantidad_otpv` FROM `manto_otprv` WHERE `otpv_estado`='OBSERVADO' AND `otpv_date_prog`>'2022-12-31'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
		return $data;
		$this->conexion=null;
	}

	function buscar_estado($tabla, $campo_estado, $estado, $campo_fecha, $fecha_inicio)
	{
		$consulta = " SELECT * FROM `$tabla` WHERE `$campo_estado`='$estado' AND `$campo_fecha`>'$fecha_inicio'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
		return $data;
		$this->conexion=null;

	}


}