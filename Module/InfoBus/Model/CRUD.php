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

	function CargarInfoBus($ib_FechaInicio,$ib_FechaTermino,$ib_Bus,$ib_Tipo,$ib_Sistema,$ib_Contenga, $ib_origen)
	{

		$btnVale1 = '<div class="text-center"><div class="btn-group"><button title="Ver" class="btn btn-sm btn-outline-secondary btnVerVales">';
		$btnVale2 = '</button></div></div>';
		$ib_Contenga_otc = '';
		$ib_Contenga_otp = '';
		$ib_Sistema_otc = '';
		$ib_origen_otc = '';
		$ib_frecuencia_otp = '';
		
		if($ib_Bus=="TODOS"){
			$ib_Bus_otc = "";
			$ib_Bus_otp = "";
		}else{
			$ib_Bus_otc = "AND `ot_bus`='$ib_Bus'";
			$ib_Bus_otp = "AND `otpv_bus`='$ib_Bus'";
		}

		if(trim($ib_Contenga)<>"") {
			$ib_Contenga_otc="AND (ot_origen LIKE '%$ib_Contenga%' OR ot_descrip LIKE '%$ib_Contenga%'OR ot_obs_cgm LIKE '%$ib_Contenga%' OR ot_at LIKE '%$ib_Contenga%' OR ot_obs_aom LIKE '%$ib_Contenga%' OR ot_obs_asoc LIKE '%$ib_Contenga%')";
			
			$ib_Contenga_otp="AND (otpv_fecuencia LIKE '%$ib_Contenga%' OR otpv_descripcion LIKE '%$ib_Contenga%' OR otpv_obs_as LIKE '%$ib_Contenga%' OR otpv_obs_cgm LIKE '%$ib_Contenga%' OR otpv_obs_cierre_ad LIKE '%$ib_Contenga%')";
		}

		if(trim($ib_Sistema)<>""){
			$ib_Sistema_otc = "AND `ot_sistema`='$ib_Sistema'";
		}

		if(trim($ib_origen)<>""){
			$ib_origen_otc = "AND `ot_origen`='$ib_origen'";
			$ib_frecuencia_otp = "AND `otpv_fecuencia`='$ib_origen'";
		}

		switch ($ib_Tipo)
		{
			case "GENERAL":
				$consulta="SELECT CONCAT_WS('-','C',`cod_ot`) AS `ib_nro_ot`, `ot_bus` AS `ib_bus`, `ot_estado` AS `ib_estado`, `ot_date_crea` AS `ib_fecha_genera`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_cgm_crea` LIMIT 1) AS `ib_cgm_genera`, `ot_origen` AS `ib_orig_frec`, `ot_asociado` AS `ib_asociado`, `ot_resp_asoc` AS `ib_tecn_resp`, `ot_descrip` AS `ib_desc_acti`, `ot_fin` AS `ib_fecha_cierre_tecnico`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_cgm_ct`  LIMIT 1) AS `ib_cgm_cierre_tecnico`, `ot_date_ca` AS `ib_fecha_cierre_adm`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_ca`  LIMIT 1) AS `ib_resp_cierre_adm`, `ot_bus` AS `ib_bus`, `ot_kilometraje` AS `ib_km`, IF(`tvale`.`nvale`>'0',CONCAT('$btnVale1',SUBSTRING(CONCAT('00',`tvale`.`nvale`),-2),'$btnVale2'),'') AS `ib_cant_vales`, `ot_sistema` AS `ib_sistema` FROM `manto_ot` LEFT JOIN (SELECT `manto_vales`.`va_ot`, COUNT(*) AS `nvale` FROM `manto_vales` GROUP BY `manto_vales`.`va_ot`) AS `tvale` ON `tvale`.`va_ot`=`manto_ot`.`cod_ot` WHERE DATE_FORMAT(`ot_date_crea`,'%Y-%m-%d')>='$ib_FechaInicio' AND DATE_FORMAT(`ot_date_crea`,'%Y-%m-%d')<='$ib_FechaTermino' ".$ib_Bus_otc." ".$ib_Sistema_otc." ".$ib_origen_otc." ".$ib_Contenga_otc."
				UNION
				SELECT CONCAT_WS('-','P',`cod_otpv`) AS `ib_nro_ot`, `otpv_bus` AS `ib_bus`, `otpv_estado` AS `ib_estado`, `otpv_date_prog` AS `ib_fecha_genera`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_genera` LIMIT 1) AS `ib_cgm_genera`, `otpv_fecuencia` AS `ib_orig_frec`, `otpv_asociado` AS `ib_asociado`, `otpv_tecnico` AS `ib_tecn_resp`, `otpv_descripcion` AS `ib_desc_acti`, `otpv_fin` AS `ib_fecha_cierre_tecnico`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_cgm_cierra` LIMIT 1) AS `ib_cgm_cierre_tecnico`, `otpv_date_cierra_ad` AS `ib_fecha_cierre_adm`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_cierra_ad` LIMIT 1) AS `ib_resp_cierre_adm`, `otpv_bus` AS `ib_bus`, `otpv_kmrealiza` AS `ib_km`, '' AS `ib_cant_vales`, '' AS `ib_sistema` FROM `manto_otprv` WHERE DATE_FORMAT(`otpv_date_prog`,'%Y-%m-%d')>='$ib_FechaInicio' AND DATE_FORMAT(`otpv_date_prog`,'%Y-%m-%d')<='$ib_FechaTermino' ".$ib_Bus_otp." ".$ib_Contenga_otp." ".$ib_frecuencia_otp;
			break;
			
			case "CORRECTIVAS":
				$consulta="SELECT CONCAT_WS('-','C',`cod_ot`) AS `ib_nro_ot`, `ot_bus` AS `ib_bus`, `ot_estado` AS `ib_estado`, `ot_date_crea` AS `ib_fecha_genera`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_cgm_crea` LIMIT 1) AS `ib_cgm_genera`, `ot_origen` AS `ib_orig_frec`, `ot_asociado` AS `ib_asociado`, `ot_resp_asoc` AS `ib_tecn_resp`, `ot_descrip` AS `ib_desc_acti`, `ot_fin` AS `ib_fecha_cierre_tecnico`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_cgm_ct` LIMIT 1) AS `ib_cgm_cierre_tecnico`, `ot_date_ca` AS `ib_fecha_cierre_adm`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_ca` LIMIT 1) AS `ib_resp_cierre_adm`, `ot_bus` AS `ib_bus`, `ot_kilometraje` AS `ib_km`, IF(`tvale`.`nvale`>'0',CONCAT('$btnVale1',SUBSTRING(CONCAT('00',`tvale`.`nvale`),-2),'$btnVale2'),'') AS `ib_cant_vales`, `ot_sistema` AS `ib_sistema` FROM `manto_ot` LEFT JOIN (SELECT `manto_vales`.`va_ot`, COUNT(*) AS `nvale` FROM `manto_vales` GROUP BY `manto_vales`.`va_ot`) AS `tvale` ON `tvale`.`va_ot`=`manto_ot`.`cod_ot` WHERE DATE_FORMAT(`ot_date_crea`,'%Y-%m-%d')>='$ib_FechaInicio' AND DATE_FORMAT(`ot_date_crea`,'%Y-%m-%d')<='$ib_FechaTermino' ".$ib_Bus_otc." ".$ib_Sistema_otc." ".$ib_origen_otc." ".$ib_Contenga_otc;
			break;

			case "PREVENTIVAS":
				$consulta="SELECT CONCAT_WS('-','P',`cod_otpv`) AS `ib_nro_ot`, `otpv_bus` AS `ib_bus`, `otpv_estado` AS `ib_estado`, `otpv_date_prog` AS `ib_fecha_genera`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_genera`  LIMIT 1) AS `ib_cgm_genera`, `otpv_fecuencia` AS `ib_orig_frec`, `otpv_asociado` AS `ib_asociado`, `otpv_tecnico` AS `ib_tecn_resp`, `otpv_descripcion` AS `ib_desc_acti`, `otpv_fin` AS `ib_fecha_cierre_tecnico`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_cgm_cierra` LIMIT 1) AS `ib_cgm_cierre_tecnico`, `otpv_date_cierra_ad` AS `ib_fecha_cierre_adm`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_cierra_ad` LIMIT 1) AS `ib_resp_cierre_adm`, `otpv_bus` AS `ib_bus`, `otpv_kmrealiza` AS `ib_km`, '' AS `ib_cant_vales`, '' AS `ib_sistema` FROM `manto_otprv` WHERE DATE_FORMAT(`otpv_date_prog`,'%Y-%m-%d')>='$ib_FechaInicio' AND DATE_FORMAT(`otpv_date_prog`,'%Y-%m-%d')<='$ib_FechaTermino' ".$ib_Bus_otp." ".$ib_Contenga_otp." ".$ib_frecuencia_otp;
			break;
			
		}

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   

	function BusesInfoBus()
	{
		$consulta = "SELECT `Bus_NroExterno` AS `Buses` FROM `Buses` ORDER BY `Buses` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;

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
	
	function InfoBusOTs($tipo_ot,$nro_ot)
	{
		if($tipo_ot=="C"){
			$consulta="SELECT `cod_ot`, `ot_origen`, `ot_bus`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_cgm_crea` LIMIT 1) AS `ot_cgm_crea`, `ot_date_crea`, `ot_asociado`, `ot_resp_asoc`, `ot_kilometraje`, `ot_hmotor`, `ot_check`, `ot_descrip`, `ot_obs_cgm`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_cgm_ct` LIMIT 1) AS `ot_cgm_ct`, `ot_date_ct`, `ot_inicio`, `ot_fin`, `ot_sistema`, `ot_codfalla`, `ot_at`, `ot_obs_asoc`, `ot_montado`, `ot_dmontado`, `ot_busdmont`, `ot_busmont`, `ot_motivo`, `ot_componente_raiz`, `ot_tecnico`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_ca` LIMIT 1) AS `ot_ca`, `ot_date_ca`, `ot_estado`, `ot_obs_aom` FROM `manto_ot` WHERE `cod_ot` = '$nro_ot'";
		}else{
			$consulta="SELECT `cod_otpv`, `otpv_semana`, `otpv_turno`, `otpv_date_prog`, `otpv_bus`, `otpv_fecuencia`, `otpv_descripcion`, `otpv_asociado`, `otpv_estado`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_genera` LIMIT 1) AS `otpv_genera`, `otpv_date_genera`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_cierra_ad` LIMIT 1) AS `otpv_cierra_ad`, `otpv_date_cierra_ad`, `otpv_tecnico`, `otpv_inicio`, `otpv_fin`, `otpv_kmrealiza`, `otpv_hmotor`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_cgm_cierra` LIMIT 1) AS `otpv_cgm_cierra`, `otpv_obs_as`, `otpv_obs_cgm`, `otpv_obs_cierre_ad` FROM `manto_otprv` WHERE `cod_otpv` = '$nro_ot'";
		}
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function InfoBusVales($nro_ot)
	{
		$consulta="SELECT `cod_vale`, `va_ot`, `manto_ot`.`ot_bus` AS `va_bus`, `manto_ot`.`ot_origen` AS `va_origen`, `va_asociado`, `va_responsable`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`va_genera` LIMIT 1) AS `va_genera`, `va_date_genera`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`va_cierre_adm` LIMIT 1) AS `va_cierre_adm`, `va_date_cierre_adm`, `va_estado`, `va_garantia`, `manto_ot`.`ot_descrip` AS `va_descrip`, `va_obs_cgm`, `va_obs_aom` FROM `manto_vales` LEFT JOIN `manto_ot` ON `cod_ot`=`va_ot` WHERE `va_ot`='$nro_ot'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function InfoBusDetalleRepuestos($cod_vale)
	{
		$consulta="SELECT `cod_rv`, `rv_repuesto`, `rv_nroserie`, `rv_cantidad`, `rv_precio`, `rep_desc` AS `rv_desc`, `rep_unida` AS `rv_unidad` FROM `manto_rep_vale` LEFT JOIN `manto_repuestos` ON `cod_rep`=`rv_repuesto` WHERE `rv_vale`='$cod_vale'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function DescargarInfoBus($ib_FechaInicio,$ib_FechaTermino,$ib_Bus,$ib_Tipo,$ib_Sistema,$ib_Contenga, $ib_origen)
	{
		$ib_Contenga_otc = '';
		$ib_Contenga_otp = '';
		$ib_Sistema_otc = '';
		$ib_origen_otc = '';
		$ib_frecuencia_otp = '';
		$consulta = '';

		if($ib_Bus=="TODOS"){
			$ib_Bus_otc = "";
			$ib_Bus_otp = "";
		}else{
			$ib_Bus_otc = "AND `ot_bus`='$ib_Bus'";
			$ib_Bus_otp = "AND `otpv_bus`='$ib_Bus'";
		}

		if(trim($ib_Contenga)<>"") {
			$ib_Contenga_otc="AND (ot_origen LIKE '%$ib_Contenga%' OR ot_descrip LIKE '%$ib_Contenga%'OR ot_obs_cgm LIKE '%$ib_Contenga%' OR ot_at LIKE '%$ib_Contenga%' OR ot_obs_aom LIKE '%$ib_Contenga%' OR ot_obs_asoc LIKE '%$ib_Contenga%')";
			
			$ib_Contenga_otp="AND (otpv_fecuencia LIKE '%$ib_Contenga%' OR otpv_descripcion LIKE '%$ib_Contenga%' OR otpv_obs_as LIKE '%$ib_Contenga%' OR otpv_obs_cgm LIKE '%$ib_Contenga%' OR otpv_obs_cierre_ad LIKE '%$ib_Contenga%')";
		}

		if(trim($ib_Sistema)<>""){
			$ib_Sistema_otc = "AND `ot_sistema`='$ib_Sistema'";
		}

		if(trim($ib_origen)<>""){
			$ib_origen_otc = "AND `ot_origen`='$ib_origen'";
			$ib_frecuencia_otp = "AND `otpv_fecuencia`='$ib_origen'";
		}

		switch ($ib_Tipo)
		{
			case "GENERAL":
				$consulta="SELECT CONCAT_WS('-','C',`cod_ot`) AS `ib_nro_ot`, `ot_estado` AS `ib_estado`, DATE_FORMAT(`ot_date_crea`,'%d-%m-%Y %H:%i') AS `ib_fecha_genera`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_cgm_crea` LIMIT 1) AS `ib_cgm_genera`, `ot_bus` AS `ib_bus`, `ot_origen` AS `ib_orig_frec`, `ot_asociado` AS `ib_asociado`, `ot_resp_asoc` AS `ib_tecn_resp`, `ot_descrip` AS `ib_desc_acti`, `ot_kilometraje` AS `ib_km`, `ot_hmotor` AS `ib_hmotor`, `ot_sistema` AS `ib_sistema`, `ot_codfalla` AS `ib_codfalla`, `ot_check` AS `ib_check`, DATE_FORMAT(`ot_inicio`,'%d-%m-%Y %H:%i') AS `ib_inicio`, DATE_FORMAT(`ot_fin`,'%d-%m-%Y %H:%i') AS `ib_fin`, TIMESTAMPDIFF(MINUTE,`ot_inicio`,`ot_fin`) AS `ib_duracion_actividad`, `ot_at` AS `ib_accion_tomada`, `ot_obs_asoc` AS `ib_obs_asoc`, `ot_tecnico` AS `ib_tecnico`, `ot_montado` AS `ib_montado`, `ot_dmontado` AS `ib_dmontado`, `ot_busmont` AS `ib_busmont`, `ot_busdmont` AS `ib_busdmont`, `ot_motivo` AS `ib_motivo`, DATE_FORMAT(`ot_date_ct`,'%d-%m-%Y %H:%i') AS `ib_fecha_cierre_tecnico`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_cgm_ct` LIMIT 1) AS `ib_cgm_cierre_tecnico`, `ot_obs_cgm` AS `ib_obs_cgm`, DATE_FORMAT(`ot_date_ca`,'%d-%m-%Y %H:%i') AS `ib_date_ca`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_ca` LIMIT 1) AS `ib_ca`, `ot_obs_aom` AS `ib_obs_aom`, '' AS `ib_semana`, '' AS `ib_turno`, '' AS `ib_publicacion` FROM `manto_ot` WHERE DATE_FORMAT(`ot_date_crea`,'%Y-%m-%d')>='$ib_FechaInicio' AND DATE_FORMAT(`ot_date_crea`,'%Y-%m-%d')<='$ib_FechaTermino' ".$ib_Bus_otc." ".$ib_Sistema_otc." ".$ib_origen_otc." ".$ib_Contenga_otc."
				UNION
				SELECT CONCAT_WS('-','P',`cod_otpv`) AS `ib_nro_ot`, `otpv_estado` AS `ib_estado`, DATE_FORMAT(`otpv_date_prog`,'%d-%m-%Y') AS `ib_fecha_genera`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_genera` LIMIT 1) AS `ib_cgm_genera`, `otpv_bus` AS `ib_bus`, `otpv_fecuencia` AS `ib_orig_frec`, `otpv_asociado` AS `ib_asociado`, `otpv_tecnico` AS `ib_tecn_resp`, `otpv_descripcion` AS `ib_desc_acti`, `otpv_kmrealiza` AS `ib_km`, `otpv_hmotor` AS `ib_hmotor`, '' AS `ib_sistema`, '' AS `ib_codfalla`, '' AS `ib_check`, DATE_FORMAT(`otpv_inicio`,'%d-%m-%Y %H:%i') AS `ib_inicio`, DATE_FORMAT(`otpv_fin`,'%d-%m-%Y %H:%i') AS `ib_fin`, TIMESTAMPDIFF(MINUTE,`otpv_inicio`,`otpv_fin`) AS `ib_duracion_actividad`, '' AS `ib_accion_tomada`, `otpv_obs_as` AS `ib_obs_asoc`, '' AS `ib_tecnico`, '' AS `ib_montado`, '' AS `ib_dmontado`, '' AS `ib_busmont`, '' AS `ib_busdmont`, '' AS `ib_motivo`, DATE_FORMAT(`otpv_fin`,'%d-%m-%Y %H:%i') AS `ib_fecha_cierre_tecnico`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_cgm_cierra` LIMIT 1) AS `ib_cgm_cierre_tecnico`, `otpv_obs_cgm` AS `ib_obs_cgm`, DATE_FORMAT(`otpv_date_cierra_ad`,'%d-%m-%Y %H:%i') AS `ib_date_ca`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_cierra_ad` LIMIT 1) AS `ib_ca`, `otpv_obs_cierre_ad` AS `ib_obs_aom`, `otpv_semana` AS `ib_semana`, `otpv_turno` AS `ib_turno`, DATE_FORMAT(`otpv_date_genera`,'%d-%m-%Y %H:%i') AS `ib_publicacion` FROM `manto_otprv` WHERE DATE_FORMAT(`otpv_date_genera`,'%Y-%m-%d')>='$ib_FechaInicio' AND DATE_FORMAT(`otpv_date_genera`,'%Y-%m-%d')<='$ib_FechaTermino' ".$ib_Bus_otp." ".$ib_Contenga_otp." ".$ib_frecuencia_otp;
				//." INTO OUTFILE '".$file_out."'	FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n' ";
			break;
			
			case "CORRECTIVAS":
				$consulta="SELECT CONCAT_WS('-','C',`cod_ot`) AS `cod_ot`, `ot_estado`, DATE_FORMAT(`ot_date_crea`,'%d-%m-%Y %H:%i') AS `ot_date_crea`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_cgm_crea` LIMIT 1) AS `ot_cgm_crea`, `ot_bus`, `ot_origen`, `ot_asociado`, `ot_resp_asoc`, `ot_descrip`, `ot_kilometraje`, `ot_hmotor`, `ot_sistema`, `ot_codfalla`, `ot_check`, DATE_FORMAT(`ot_inicio`,'%d-%m-%Y %H:%i') AS `ot_inicio`, DATE_FORMAT(`ot_fin`,'%d-%m-%Y %H:%i') AS `ot_fin`, TIMESTAMPDIFF(MINUTE,`ot_inicio`,`ot_fin`) AS `ot_duracion_actividad`, `ot_at`, `ot_obs_asoc`, `ot_tecnico`, `ot_montado`, `ot_dmontado`, `ot_busmont`, `ot_busdmont`, `ot_motivo`, DATE_FORMAT(`ot_date_ct`,'%d-%m-%Y %H:%i') AS `ot_date_ct`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_cgm_ct` LIMIT 1) AS `ot_cgm_ct`, `ot_obs_cgm`, DATE_FORMAT(`ot_date_ca`,'%d-%m-%Y %H:%i') AS `ot_date_ca`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_ca` LIMIT 1) AS `ot_ca`, `ot_obs_aom`, '' AS `ot_semana`, '' AS `ot_turno`, '' AS `ot_publicacion` FROM `manto_ot` WHERE DATE_FORMAT(`ot_date_crea`,'%Y-%m-%d')>='$ib_FechaInicio' AND DATE_FORMAT(`ot_date_crea`,'%Y-%m-%d')<='$ib_FechaTermino' ".$ib_Bus_otc." ".$ib_Sistema_otc." ".$ib_origen_otc." ".$ib_Contenga_otc;
			break;

			case "PREVENTIVAS":
				$consulta="SELECT CONCAT_WS('-','P',`cod_otpv`) AS `cod_otpv`, `otpv_estado`, DATE_FORMAT(`otpv_date_prog`,'%d-%m-%Y') AS `otpv_date_prog`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_genera` LIMIT 1) AS `otpv_genera`, `otpv_bus`, `otpv_fecuencia`, `otpv_asociado`, `otpv_tecnico`, `otpv_descripcion`, `otpv_kmrealiza`, `otpv_hmotor`, '' AS `otpv_sistema`, '' AS `otpv_codfalla`, '' AS `otpv_check`, DATE_FORMAT(`otpv_inicio`,'%d-%m-%Y %H:%i') AS `otpv_inicio`, DATE_FORMAT(`otpv_fin`,'%d-%m-%Y %H:%i') AS `otpv_fin`, TIMESTAMPDIFF(MINUTE,`otpv_inicio`,`otpv_fin`) AS `otpv_duracion_actividad`, '' AS `otpv_accion_tomada`, `otpv_obs_as`, '' AS `otpv_tecnico2`, '' AS `otpv_montado`, '' AS `otpv_dmontado`, '' AS `otpv_busmont`, '' AS `otpv_busdmont`, '' AS `otpv_motivo`, DATE_FORMAT(`otpv_fin`,'%d-%m-%Y %H:%i') AS `otpv_date_cierre_tecnico`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_cgm_cierra` LIMIT 1) AS `otpv_cgm_cierra`, `otpv_obs_cgm`, DATE_FORMAT(`otpv_date_cierra_ad`,'%d-%m-%Y %H:%i') AS `otpv_date_cierra_ad`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`otpv_cierra_ad` LIMIT 1) AS `otpv_cierra_ad`, `otpv_obs_cierre_ad`, `otpv_semana`, `otpv_turno`, DATE_FORMAT(`otpv_date_genera`,'%d-%m-%Y %H:%i') AS `otpv_date_genera`, '' AS `ib_Sistema` FROM `manto_otprv` WHERE DATE_FORMAT(`otpv_date_genera`,'%Y-%m-%d')>='$ib_FechaInicio' AND DATE_FORMAT(`otpv_date_genera`,'%Y-%m-%d')<='$ib_FechaTermino' ".$ib_Bus_otp." ".$ib_Contenga_otp." ".$ib_frecuencia_otp;
			break;
			
		}

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        return $data;
        $this->conexion=null;
   	}   

	function SelectTipos($ttablaotcorrectivas_operacion,$ttablaotcorrectivas_tipo)
	{
		$consulta="SELECT `manto_tipotablaotcorrectivas`.`ttablaotcorrectivas_detalle` AS `Detalle` FROM `manto_tipotablaotcorrectivas` WHERE `manto_tipotablaotcorrectivas`.`ttablaotcorrectivas_operacion` = '$ttablaotcorrectivas_operacion' AND `manto_tipotablaotcorrectivas`.`ttablaotcorrectivas_tipo`= '$ttablaotcorrectivas_tipo' ORDER BY `Detalle` ASC";
   
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;
   
		$this->conexion=null;
	}

	function info_bus_km($bus_nro_externo)
	{
		$consulta = "SELECT `CKL_KM_KILOMETRAJE` AS `km`, `CKL_KM_FECHA` AS `fecha` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_BUS`='$bus_nro_externo' ORDER BY `CKL_KM_FECHA` DESC LIMIT 1";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;

		$this->conexion=null;
   	}

}