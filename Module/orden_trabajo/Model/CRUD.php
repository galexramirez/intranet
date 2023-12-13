<?php
session_start();
class CRUD
{	
	var $conexion;

	function __construct()
	{
		if (!isset($_SESSION['USUARIO_ID'])){         
			session_destroy();
			echo '<script>window.location.href = "LogOut";</script>';  
			exit();
		}
		SController('ConexionesBD','C_ConexionBD');
		$Instancia = new C_ConexionesBD();
		$this->conexion = $Instancia->Conectar(); 	
	}

	function select_combo($nombre_tabla, $es_campo_unico, $campo_select, $condicion_where, $order_by)
	{
		$distinct 	= "";
		$c_where 	= "";
		$c_order_by = "";
		if($es_campo_unico == "SI"){
			$distinct = "DISTINCT";
		}
		if($condicion_where!==""){
			$c_where = "WHERE ".$condicion_where;
		}
		if($order_by!==""){
			$c_order_by = "ORDER BY ".$order_by;
		}
		$consulta = "SELECT ".$distinct." `$nombre_tabla`.`$campo_select` AS `detalle` FROM `$nombre_tabla` ".$c_where." ".$c_order_by;
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;   
		$this->conexion=null;
	}

	function select_roles($roles_perfil, $roles_campo)
	{
		$consulta="SELECT `colaborador`.`$roles_campo` AS `nombres` FROM `glo_roles` RIGHT JOIN `colaborador` ON `colaborador`.`Colaborador_id`= `glo_roles`.`roles_dni` AND `colaborador`.`Colab_Estado`='ACTIVO' WHERE `glo_roles`.`roles_perfil` = '$roles_perfil'  ORDER BY `nombres` ASC";

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

	function contar_dato($nombre_tabla, $campo_buscar, $condicion_where)
	{
		$consulta = "SELECT COUNT(`$nombre_tabla`.`$campo_buscar`) AS `cantidad` FROM `$nombre_tabla` WHERE ".$condicion_where;

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

	function LeerOT($FechaInicioOT,$FechaTerminoOT)
	{
		$consulta = "SELECT IF(`ot_tipo`='CORRECTIVAS',CONCAT_WS('-','C',`ot_id`),CONCAT_WS('-','P',`ot_id`)) AS `ot_id`, `ot_estado`, DATE_FORMAT(`ot_date_crea`,'%d-%m-%Y %H:%i') AS `ot_date_crea`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_cgm_crea` LIMIT 1) AS `ot_cgm_crea`, `ot_bus`, `ot_origen`, `ot_asociado`, `ot_tecnico`, `ot_descrip`, DATE_FORMAT(`ot_fin`,'%d-%m-%Y %H:%i') AS `ot_fin`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_cgm_ct`LIMIT 1) AS `ot_cgm_ct`, DATE_FORMAT(`ot_date_ca`,'%d-%m-%Y %H:%i') AS `ot_date_ca`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_ca`LIMIT 1) AS `ot_ca`, `ot_kilometraje`, IF(`tvale`.`nvale`>'0',SUBSTRING(CONCAT('00',`tvale`.`nvale`),-2),'') AS `ot_vales` FROM `manto_orden_trabajo` LEFT JOIN (SELECT `manto_vales`.`va_ot`, COUNT(*) AS `nvale` FROM `manto_vales` GROUP BY `manto_vales`.`va_ot`) AS `tvale` ON `tvale`.`va_ot`=`manto_orden_trabajo`.`ot_id` WHERE DATE_FORMAT(`ot_date_crea`,'%Y-%m-%d')>='$FechaInicioOT' AND DATE_FORMAT(`ot_date_crea`,'%Y-%m-%d')<='$FechaTerminoOT'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
   	}   

	function CrearOT($ot_id, $ot_origen, $ot_bus, $ot_kilometraje, $ot_date_crea, $ot_date_ct, $ot_asociado, $ot_hmotor, $ot_cgm_crea, $ot_cgm_ct, $ot_estado, $ot_resp_asoc, $ot_descrip, $ot_tecnico, $ot_check, $ot_obs_cgm, $ot_sistema, $ot_inicio, $ot_fin, $ot_codfalla, $ot_at, $ot_obs_asoc, $ot_montado, $ot_dmontado, $ot_busmont, $ot_busdmont, $ot_motivo, $ot_obs_aom, $ot_ca, $ot_date_ca, $ot_componente_raiz, $ot_obs_aom2, $ot_accidentes_id, $ot_semana_cierre, $ot_cod_vinculada)
	{
        $ot_ca 		= $_SESSION['USUARIO_ID'];
		$ot_date_ca = date("Y-m-d H:i:s");
		$ot_obs_aom = $ot_obs_aom2;

		$consulta=" INSERT INTO `manto_orden_trabajo`(`ot_id`, `ot_origen`, `ot_bus`, `ot_kilometraje`, `ot_date_crea`, `ot_date_ct`, `ot_asociado`, `ot_hmotor`, `ot_cgm_crea`, `ot_cgm_ct`, `ot_estado`, `ot_resp_asoc`, `ot_descrip`, `ot_tecnico`, `ot_check`, `ot_obs_cgm`, `ot_sistema`, `ot_inicio`, `ot_fin`, `ot_codfalla`, `ot_at`, `ot_obs_asoc`, `ot_montado`, `ot_dmontado`, `ot_busmont`, `ot_busdmont`, `ot_motivo`, `ot_obs_aom`, `ot_ca`, `ot_date_ca`, `ot_componente_raiz`, `ot_accidentes_id`, `ot_semana_cierre`, `ot_cod_vinculada`) VALUES ('$ot_id', '$ot_origen', '$ot_bus', '$ot_kilometraje', IF('$ot_date_crea'='',NULL,'$ot_date_crea'), IF('$ot_date_ct'='',NULL,'$ot_date_ct'), '$ot_asociado', '$ot_hmotor', '$ot_cgm_crea', '$ot_cgm_ct', '$ot_estado', '$ot_resp_asoc', '$ot_descrip', '$ot_tecnico', '$ot_check', '$ot_obs_cgm', '$ot_sistema', IF('$ot_inicio'='',NULL,'$ot_inicio'), IF('$ot_fin'='',NULL,'$ot_fin'), '$ot_codfalla', '$ot_at', '$ot_obs_asoc', '$ot_montado', '$ot_dmontado', '$ot_busmont', '$ot_busdmont', '$ot_motivo', '$ot_obs_aom', '$ot_ca', '$ot_date_ca', '$ot_componente_raiz', '$ot_accidentes_id', '$ot_semana_cierre', IF('$ot_cod_vinculada'='',NULL,'$ot_cod_vinculada')) ";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		$this->conexion=null;
	}
	
	function BorrarOT($ot_id)
	{
		$consulta="DELETE FROM `manto_orden_trabajo` WHERE `ot_id`='$ot_id'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        

		$this->conexion=null;
	}

	function CargarOT($ot_id)
	{
		$consulta="SELECT `ot_id`, `ot_origen`, `ot_bus`, `ot_kilometraje`, `ot_date_crea`, DATE_FORMAT(`ot_date_ct`,'%d-%m-%Y %H:%i') AS `ot_date_ct`, `ot_asociado`, `ot_hmotor`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_cgm_crea` LIMIT 1) AS `ot_cgm_crea`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_cgm_ct` LIMIT 1) AS `ot_cgm_ct`, `ot_estado`, `ot_reg_rec`, `ot_resp_asoc`, `ot_descrip`, `ot_tecnico`, `ot_check`, `ot_obs_cgm`, `ot_recep_aom`, `ot_date_recep_aom`, `ot_sistema`, `ot_inicio`, `ot_fin`, `ot_codfalla`, `ot_at`, `ot_obs_asoc`, `ot_montado`, `ot_dmontado`, `ot_busmont`, `ot_busdmont`, `ot_motivo`, `ot_obs_aom`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_ca` LIMIT 1) AS `ot_ca`, DATE_FORMAT(`ot_date_ca`,'%d-%m-%Y %H:%i') AS `ot_date_ca`, `ot_obs_km`, `ot_date_rec_cgm`, `ot_pin`, `ot_componente_raiz`, `ot_accidentes_id`, `ot_semana_cierre`, `ot_cod_vinculada` FROM `manto_orden_trabajo` WHERE `ot_id`='$ot_id'";

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

	function SelectTecnico($ot_asociado)
	{
		$consulta="SELECT DISTINCT `manto_resp_asociado`.`ra_nombres` AS `Usuario` FROM `manto_resp_asociado` WHERE `ra_asociado` = '$ot_asociado' ORDER BY `Usuario` ASC ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function BuscarTecnico($ot_asociado)
	{
		$consulta="SELECT `manto_resp_asociado`.`ra_nombres` AS `ot_tecnico` FROM `manto_resp_asociado` WHERE `ra_asociado` = '$ot_asociado' ORDER BY `ot_tecnico` ASC LIMIT 1";

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

	function CalculoKilometraje($ot_bus,$ot_inicio){
		$consulta="SELECT (SELECT `CKL_KM_FECHA` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_BUS` = '$ot_bus' AND `CKL_KM_FECHA` = '$ot_inicio' ORDER BY `CKL_KM_FECHA` DESC LIMIT 1) AS `fechafinal`, (SELECT `CKL_KM_KILOMETRAJE` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_BUS`='$ot_bus' AND `CKL_KM_FECHA` = '$ot_inicio' ORDER BY `CKL_KM_FECHA` DESC LIMIT 1) AS `kmfinal`, (SELECT `CKL_KM_FECHA` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_BUS`='$ot_bus' AND `CKL_KM_FECHA` < '$ot_inicio' ORDER BY `CKL_KM_FECHA` DESC LIMIT 1) AS `fechainicial`, (SELECT `CKL_KM_KILOMETRAJE` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_BUS`='$ot_bus' AND `CKL_KM_FECHA` < '$ot_inicio' ORDER BY `CKL_KM_FECHA` DESC LIMIT 1) AS `kminicial`, `CKL_KM_BUS` FROM `manto_ckl_kilometraje` WHERE `CKL_KM_BUS`='$ot_bus' ORDER BY `fechafinal` DESC LIMIT 1";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function EditarOT($ot_id, $ot_origen, $ot_bus, $ot_kilometraje, $ot_date_crea, $ot_date_ct, $ot_asociado, $ot_hmotor, $ot_cgm_crea, $ot_cgm_ct, $ot_estado, $ot_resp_asoc, $ot_descrip, $ot_tecnico, $ot_check, $ot_obs_cgm, $ot_sistema, $ot_inicio, $ot_fin, $ot_codfalla, $ot_at, $ot_obs_asoc, $ot_montado, $ot_dmontado, $ot_busmont, $ot_busdmont, $ot_motivo, $ot_obs_aom, $ot_ca, $ot_date_ca, $ot_componente_raiz, $ot_obs_aom2, $ot_accidentes_id, $ot_semana_cierre, $ot_cod_vinculada)
	{
        $ot_ca = $_SESSION['USUARIO_ID'];
		$nombre_cierra_adm = $_SESSION['Usua_NombreCorto'];
		$ot_date_ca = date("Y-m-d H:i:s");

		if(!empty($ot_obs_aom2)){
			$ot_obs_aom = date_format(date_create($ot_date_ca),"d-m-Y H:i")." ".$ot_estado." ".$nombre_cierra_adm." : ".$ot_obs_aom2."<br>".$ot_obs_aom;
		}else{
			$ot_obs_aom = date_format(date_create($ot_date_ca),"d-m-Y H:i")." ".$ot_estado." ".$nombre_cierra_adm."<br>".$ot_obs_aom;
		}

		$consulta = "UPDATE `manto_orden_trabajo` SET `ot_id`='$ot_id', `ot_origen`='$ot_origen', `ot_bus`='$ot_bus', `ot_kilometraje`='$ot_kilometraje', `ot_date_crea`=IF('$ot_date_crea' = '', NULL, '$ot_date_crea'), `ot_date_ct`=IF('$ot_date_ct' = '', NULL, '$ot_date_ct'), `ot_asociado`='$ot_asociado', `ot_hmotor`='$ot_hmotor', `ot_cgm_crea`='$ot_cgm_crea', `ot_cgm_ct`='$ot_cgm_ct', `ot_estado`='$ot_estado', `ot_resp_asoc`='$ot_resp_asoc', `ot_descrip`='$ot_descrip', `ot_tecnico`='$ot_tecnico', `ot_check`='$ot_check', `ot_obs_cgm`='$ot_obs_cgm', `ot_sistema`='$ot_sistema', `ot_inicio`=IF('$ot_inicio' = '', NULL, '$ot_inicio'), `ot_fin`=IF('$ot_fin' = '', NULL, '$ot_fin'), `ot_codfalla`='$ot_codfalla', `ot_at`='$ot_at', `ot_obs_asoc`='$ot_obs_asoc', `ot_montado`='$ot_montado', `ot_dmontado`='$ot_dmontado', `ot_busmont`='$ot_busmont', `ot_busdmont`='$ot_busdmont', `ot_motivo`='$ot_motivo', `ot_obs_aom`='$ot_obs_aom', `ot_ca`='$ot_ca', `ot_date_ca`=IF('$ot_date_ca' = '', NULL, '$ot_date_ca'), `ot_componente_raiz`='$ot_componente_raiz', `ot_accidentes_id`='$ot_accidentes_id', `ot_semana_cierre`='$ot_semana_cierre', `ot_cod_vinculada`=IF('$ot_cod_vinculada'='',NULL,'$ot_cod_vinculada') WHERE `ot_id` = '$ot_id'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$this->conexion=null;
	}


	function BusesOT()
	{
		$consulta = "SELECT `Bus_NroExterno` AS `Buses` FROM `Buses` ORDER BY `Buses` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;

		$this->conexion=null;
   	}   

	function AsociadoOT()
	{
		$consulta = "SELECT DISTINCT `ra_asociado` AS `Asociado` FROM `manto_resp_asociado` WHERE `ra_asociado`!='' ORDER BY `Asociado` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;

		$this->conexion=null;
   	}   

	function Origenes()
	{
		$consulta = "SELECT `or_nombre` AS `Origenes` FROM `manto_origenes` WHERE `or_nombre`!='' ORDER BY `or_nombre` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;

		$this->conexion=null;
   	}   

	function ver_ot($ot_id)
	{
		$consulta="SELECT `ot_id`, `ot_origen`, `ot_bus`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_cgm_crea` LIMIT 1) AS `ot_cgm_crea`, `ot_date_crea`, `ot_asociado`, `ot_resp_asoc`, `ot_kilometraje`, `ot_hmotor`, `ot_check`, `ot_descrip`, `ot_obs_cgm`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_cgm_ct` LIMIT 1) AS `ot_cgm_ct`, `ot_date_ct`, `ot_inicio`, `ot_fin`, `ot_sistema`, `ot_codfalla`, `ot_at`, `ot_obs_asoc`, `ot_montado`, `ot_dmontado`, `ot_busdmont`, `ot_busmont`, `ot_motivo`, `ot_componente_raiz`, `ot_tecnico`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_ca` LIMIT 1) AS `ot_ca`, `ot_date_ca`, `ot_estado`, `ot_obs_aom`, `ot_accidentes_id`, `ot_semana_cierre`, `ot_cod_vinculada` FROM `manto_orden_trabajo` WHERE `ot_id` = '$ot_id'";
		   
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
		return $data;
		$this->conexion=null;
	}
   
	function ver_vale($ot_id)
	{
		$consulta	= "SELECT `cod_vale`, `va_ot`, `manto_orden_trabajo`.`ot_bus` AS `va_bus`, `manto_orden_trabajo`.`ot_origen` AS `va_origen`, `va_asociado`, `va_responsable`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`va_genera` LIMIT 1) AS `va_genera`, `va_date_genera`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`va_cierre_adm` LIMIT 1) AS `va_cierre_adm`, `va_date_cierre_adm`, `va_estado`, `va_garantia`, `manto_orden_trabajo`.`ot_descrip` AS `va_descrip`, `va_obs_cgm`, `va_obs_aom` FROM `manto_vales` LEFT JOIN `manto_orden_trabajo` ON `ot_id`=`va_ot` WHERE `va_ot`='$ot_id'";
   
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		$data		=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
		return $data;
		$this->conexion=null;
	}
   
	function ver_detalle_repuesto($cod_vale)
	{
		$consulta	= "SELECT `cod_rv`, `rv_repuesto`, `rv_nroserie`, `rv_cantidad`, `rv_precio`, `rep_desc` AS `rv_desc`, `rep_unida` AS `rv_unidad` FROM `manto_rep_vale` LEFT JOIN `manto_repuestos` ON `cod_rep`=`rv_repuesto` WHERE `rv_vale`='$cod_vale'";
   
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;
   
		$this->conexion=null;
	}

	function descargar_ot($FechaInicioOT,$FechaTerminoOT)
	{
		$consulta 	= "SELECT IF(`ot_tipo`='CORRECTIVAS',CONCAT_WS('-','C',`ot_id`),CONCAT_WS('-','P',`ot_id`)) AS `ot_id`, `ot_estado`, DATE_FORMAT(`ot_date_crea`,'%d-%m-%Y %H:%i') AS `ot_date_crea`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_cgm_crea` LIMIT 1) AS `ot_cgm_crea`, `ot_bus`, `ot_origen`, `ot_asociado`, `ot_resp_asoc`, `ot_descrip`, `ot_kilometraje`, `ot_hmotor`, `ot_sistema`, `ot_codfalla`, `ot_check`, DATE_FORMAT(`ot_inicio`,'%d-%m-%Y %H:%i') AS `ot_inicio`, DATE_FORMAT(`ot_fin`,'%d-%m-%Y %H:%i') AS `ot_fin`, TIMESTAMPDIFF(MINUTE,`ot_inicio`,`ot_fin`) AS `ot_duracion_actividad`, `ot_at`, `ot_obs_asoc`, `ot_tecnico`, `ot_montado`, `ot_dmontado`, `ot_busmont`, `ot_busdmont`, `ot_motivo`, DATE_FORMAT(`ot_date_ct`,'%d-%m-%Y %H:%i') AS `ot_date_ct`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_cgm_ct` LIMIT 1) AS `ot_cgm_ct`, `ot_obs_cgm`, DATE_FORMAT(`ot_date_ca`,'%d-%m-%Y %H:%i') AS `ot_date_ca`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ot_ca` LIMIT 1) AS `ot_ca`, `ot_obs_aom`, '' AS `ot_semana`, '' AS `ot_turno`, '' AS `ot_publicacion` FROM `manto_orden_trabajo` WHERE DATE_FORMAT(`ot_date_crea`,'%Y-%m-%d')>='$FechaInicioOT' AND DATE_FORMAT(`ot_date_crea`,'%Y-%m-%d')<='$FechaTerminoOT' ";
	
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);
   
		return $data;
		$this->conexion=null;
	}   

	function cargar_horas_tecnicos($ot_id)
	{
		$consulta	= "	SELECT 
							`manto_ot_horas_tecnicos`.`ht_tecnico_nombres` AS `tecnico_nombres`,
							DATE_FORMAT(`manto_ot_horas_tecnicos`.`ht_hora_inicio`,'%d-%m-%Y %H:%i') AS `hora_inicio`,
							DATE_FORMAT(`manto_ot_horas_tecnicos`.`ht_hora_fin`,'%d-%m-%Y %H:%i') AS `hora_fin`,
							DATE_FORMAT(TIMEDIFF(`manto_ot_horas_tecnicos`.`ht_hora_fin`,`manto_ot_horas_tecnicos`.`ht_hora_inicio`),'%H:%i') AS `total_horas`
						FROM `manto_ot_horas_tecnicos`
						WHERE `manto_ot_horas_tecnicos`.`ht_ot_id`='$ot_id' ";
   
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);
   
		$this->conexion=null;
	}

	function crear_horas_tecnicos($ht_ot_id, $ht_tecnico_nombres, $ht_hora_inicio, $ht_hora_fin)
	{
		$consulta = " INSERT INTO `manto_ot_horas_tecnicos` (`ht_ot_id`, `ht_tecnico_nombres`, `ht_hora_inicio`, `ht_hora_fin`) VALUES ('$ht_ot_id', '$ht_tecnico_nombres', '$ht_hora_inicio', '$ht_hora_fin') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$this->conexion=null;

	}

	function eliminar_horas_tecnicos($ht_ot_id)
	{
		$consulta = " DELETE FROM `manto_ot_horas_tecnicos` WHERE `ht_ot_id`='$ht_ot_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$this->conexion=null;

	}

	function ot_observadas()
	{
		$consulta = " SELECT COUNT(*) AS `cantidad_ot` FROM `manto_orden_trabajo` WHERE `ot_estado`='OBSERVADO' AND `ot_date_crea`>'2022-12-31'";
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

	function leer_cierre_semanal($anios_cierre_semanal)
	{
		$consulta = " 	SELECT `manto_ot_cierre`.`ot_cierre_id`,
							`manto_ot_cierre`.`otc_semana`,
							`manto_ot_cierre`.`otc_fecha_genera`,
							(SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`manto_ot_cierre`.`otc_usuario_id_genera`) AS `otc_usuario_genera`,
							`manto_ot_cierre`.`otc_fecha_abrir`,
							(SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`manto_ot_cierre`.`otc_usuario_id_abrir`) AS `otc_usuario_abrir`,
							`manto_ot_cierre`.`otc_estado`
						FROM `manto_ot_cierre`
						WHERE SUBSTRING(`manto_ot_cierre`.`otc_semana`,1,4)='$anios_cierre_semanal'
						ORDER BY `manto_ot_cierre`.`otc_semana` DESC ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
   	}

	function validar_estado_cerrado($tabla, $semana, $estado)
	{
		switch ($tabla)
		{
			case 'manto_ot':
				$consulta = " SELECT COUNT(*) AS `registro` FROM `$tabla` WHERE `ot_semana_cierre`='$semana' AND `ot_estado`!='$estado' ";
			break;

			case 'manto_vales':
				$consulta = " SELECT COUNT(*) AS `registro` FROM `manto_orden_trabajo` RIGHT JOIN `$tabla` ON `$tabla`.`va_ot`=`manto_orden_trabajo`.`ot_id` AND `$tabla`.`va_estado`!='$estado' WHERE `ot_semana_cierre`='$semana' ";
			break;
		}

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
		return $data;
		$this->conexion=null;
	}

	function validar_semana($tabla, $campo_semana, $semana)
	{
		$consulta = " SELECT COUNT(*) AS `registro` FROM `$tabla` WHERE `$campo_semana`='$semana' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
		return $data;
		$this->conexion=null;
	}

	function generar_cierre_semanal($otc_semana)
	{
		$otc_fecha_genera 		= date("Y-m-d H:i:s");
		$otc_usuario_id_genera 	= $_SESSION['USUARIO_ID'];
		$otc_estado				= "CERRADO";

		$consulta = " INSERT INTO `manto_ot_cierre` (`otc_semana`, `otc_fecha_genera`, `otc_usuario_id_genera`, `otc_estado`) VALUES ('$otc_semana', '$otc_fecha_genera', '$otc_usuario_id_genera', '$otc_estado') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$this->conexion=null;

	}

	function codigos_repuestos($otc_semana)
	{
		$consulta = " SELECT `cod_rv`, DATE_FORMAT(`va_date_cierre_adm`,'%Y-%m-%d') AS `va_date_cierre_adm`, `rv_repuesto`, `va_ruc` FROM `manto_rep_vale` RIGHT JOIN (SELECT `manto_vales`.`cod_vale`, `manto_vales`.`va_ot`, `manto_vales`.`va_date_cierre_adm`, `manto_vales`.`va_ruc`,`manto_orden_trabajo`.`ot_id`, `manto_orden_trabajo`.`ot_semana_cierre` FROM `manto_orden_trabajo` RIGHT JOIN `manto_vales` ON `manto_orden_trabajo`.`ot_id`=`manto_vales`.`va_ot` WHERE `ot_semana_cierre`='$otc_semana') AS `t1` ON `manto_rep_vale`.`rv_vale`=`t1`.`cod_vale` ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
		return $data;
		$this->conexion=null;
	}

	function precios_repuestos($ruc, $fecha_vigencia, $repuesto)
	{
		$consulta = " SELECT MAX(`precioprov_fechavigencia`) AS `fecha_vigencia`, ANY_VALUE(`precioprov_codproveedor`) AS `codproveedor`, ANY_VALUE(`precioprov_descripcion`) AS `descripcion`, ANY_VALUE(`precioprov_unidadmedida`) AS `unidad_medida`, ANY_VALUE(`precioprov_moneda`) AS `moneda`, ANY_VALUE(`precioprov_precio`) AS `precio`, ANY_VALUE(`precioprov_preciosoles`) AS `precio_soles`, ANY_VALUE(`precioprov_precio`) AS `precio`, ANY_VALUE(`precioprov_materialid`) AS `material_id`, ANY_VALUE(`precioprov_id`) AS `precio_proveedor_id`, ANY_VALUE(`precioprov_tipo`) AS `tipo` FROM `manto_preciosproveedor` WHERE `manto_preciosproveedor`.`precioprov_ruc`='$ruc' AND `precioprov_fechavigencia`<='$fecha_vigencia' AND `precioprov_codproveedor`='$repuesto' GROUP BY `manto_preciosproveedor`.`precioprov_ruc`, `precioprov_codproveedor` ";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
		return $data;
		$this->conexion=null;
	}

	function editar_repuestos_vale($cod_rv, $rv_precio, $rv_unidad_medida, $rv_material_id, $rv_precio_proveedor_id, $rv_moneda, $rv_precio_soles, $rv_fecha_vigencia, $rv_tipo, $rv_descripcion)
	{
		$consulta = " UPDATE `manto_rep_vale` SET `rv_precio` = '$rv_precio', `rv_unidad_medida` = '$rv_unidad_medida', `rv_material_id` = '$rv_material_id', `rv_precio_proveedor_id` = '$rv_precio_proveedor_id', `rv_moneda` = '$rv_moneda', `rv_precio_soles` = '$rv_precio_soles', `rv_fecha_vigencia` = '$rv_fecha_vigencia', `rv_tipo` = '$rv_tipo', `rv_descripcion` = '$rv_descripcion' WHERE `cod_rv` = '$cod_rv' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
		return $data;
		$this->conexion=null;
	}

	function leer_novedades($fecha_inicio, $fecha_termino)
	{
		$Nove_TipoNovedad = ['FALLA_COMUNICACION', 'FALLA_TELEMETRIA','FALLA_BUS' ];
		$Nove_TipoNovedad = "'" . implode("','", $Nove_TipoNovedad) . "'";
		$consulta = "( ";
		$consulta .= "	SELECT  
							CONCAT('NO-',`OPE_Novedad`.`Novedad_Id`) AS `id`,
							`OPE_Novedad`.`Nove_FechaOperacion` AS `fecha`,
							`colaborador`.`Colab_nombre_corto` AS `nombres_usuario_genera`,
							'NOVEDAD OPERACIONES' AS `origen`,
							`OPE_Novedad`.`Nove_TipoNovedad` AS `tipo_novedad`,
							`OPE_Novedad`.`Nove_Descripcion` AS `descripcion`,
							CONCAT(`manto_novedad_operacion`.`nope_componente`,'-',`manto_novedad_operacion`.`nope_posicion`,'-',`manto_novedad_operacion`.`nope_falla`,'-',`manto_novedad_operacion`.`nope_accion`) AS `ot_accion`,
							`OPE_Novedad`.`Nove_Operacion` AS `operacion`,
							`OPE_Novedad`.`Nove_Bus` AS `bus`,
							`manto_novedad_operacion`.`nope_componente` AS `componente`,
							`manto_novedad_operacion`.`nope_posicion` AS `posicion`,
							`manto_novedad_operacion`.`nope_falla` AS `falla`,
							`manto_novedad_operacion`.`nope_accion` AS `accion`,
							CONCAT(SUBSTRING(`manto_novedad_ot`.`not_ot_tipo`,1,1),'-',`manto_novedad_ot`.`not_ot_id`) AS `ot_id`,
							IF(`manto_novedad_ot`.`not_estado` IS NULL,'PENDIENTE',`manto_novedad_ot`.`not_estado`) AS `ot_estado`,
							`manto_novedad_ot`.`not_procedencia` AS `procedencia`
						FROM 
							`OPE_Novedad`
						LEFT JOIN
							`colaborador`
						ON
							`colaborador`.`Colaborador_id` = `OPE_Novedad`.`Nove_UsuarioId`
						LEFT JOIN
							`manto_novedad_operacion`
						ON
							`manto_novedad_operacion`.`nope_novedad_id`=`OPE_Novedad`.`Novedad_Id`
						LEFT JOIN
							`manto_novedad_ot`
						ON
							`manto_novedad_ot`.`not_novedad_id`=`OPE_Novedad`.`Novedad_Id`
							AND `manto_novedad_ot`.`not_origen_novedad`='NOVEDAD OPERACIONES'
							AND `manto_novedad_ot`.`not_tipo_novedad`=`OPE_Novedad`.`Nove_TipoNovedad`
						WHERE 
							`OPE_Novedad`.`Nove_TipoNovedad` IN ($Nove_TipoNovedad)
							AND `OPE_Novedad`.`Nove_FechaOperacion`>='$fecha_inicio' 
							AND `OPE_Novedad`.`Nove_FechaOperacion`<='$fecha_termino'
						UNION
						SELECT
							CONCAT('IP-',`OPE_AccidentesInformePreliminar`.`Accidentes_Id`) AS `id`,
							`OPE_AccidentesInformePreliminar`.`Acci_Fecha` AS `fecha`,
							`colaborador`.`Colab_nombre_corto` AS `nombres_usuario_genera`,
							'INFORME PRELIMINAR' AS `origen`,
							`OPE_AccidentesInformePreliminar`.`Acci_TipoAccidente` AS `tipo_novedad`,
							`OPE_AccidentesInformePreliminar`.`Acci_Descripcion` AS `descripcion`,
							CONCAT(`manto_novedad_operacion`.`nope_componente`,'-',`manto_novedad_operacion`.`nope_posicion`,'-',`manto_novedad_operacion`.`nope_falla`,'-',`manto_novedad_operacion`.`nope_accion`) AS `ot_accion`,
							`OPE_AccidentesInformePreliminar`.`Acci_Operacion` AS `operacion`,
							`OPE_AccidentesInformePreliminar`.`Acci_Bus` AS `bus`,
							`manto_novedad_operacion`.`nope_componente` AS `componente`,
							`manto_novedad_operacion`.`nope_posicion` AS `posicion`,
							`manto_novedad_operacion`.`nope_falla` AS `falla`,
							`manto_novedad_operacion`.`nope_accion` AS `accion`,
							CONCAT(SUBSTRING(`manto_novedad_ot`.`not_ot_tipo`,1,1),'-',`manto_novedad_ot`.`not_ot_id`) AS `ot_id`,
							IF(`manto_novedad_ot`.`not_estado` IS NULL,'PENDIENTE',`manto_novedad_ot`.`not_estado`) AS `ot_estado`,
							`manto_novedad_ot`.`not_procedencia` AS `procedencia`
						FROM 
							`OPE_AccidentesInformePreliminar`
						LEFT JOIN
							`manto_orden_trabajo`
						ON
							`manto_orden_trabajo`.`ot_accidentes_id`=`OPE_AccidentesInformePreliminar`.`Accidentes_Id` 
						LEFT JOIN
							`colaborador`
						ON
							`colaborador`.`Colaborador_id` = `OPE_AccidentesInformePreliminar`.`Acci_UsuarioId_Generar`
						LEFT JOIN
							`manto_novedad_operacion`
						ON
							`manto_novedad_operacion`.`nope_novedad_id`=`OPE_AccidentesInformePreliminar`.`Accidentes_Id`
						LEFT JOIN
							`manto_novedad_ot`
						ON
							`manto_novedad_ot`.`not_novedad_id`=`OPE_AccidentesInformePreliminar`.`Accidentes_Id`
							AND `manto_novedad_ot`.`not_origen_novedad`='INFORME PRELIMINAR'
							AND `manto_novedad_ot`.`not_tipo_novedad`=`OPE_AccidentesInformePreliminar`.`Acci_TipoAccidente`
						WHERE 
							`OPE_AccidentesInformePreliminar`.`Acci_Fecha`>='$fecha_inicio'
							AND `OPE_AccidentesInformePreliminar`.`Acci_Fecha`<='$fecha_termino'
							AND `OPE_AccidentesInformePreliminar`.`Acci_DanosMateriales`='CON_DAÑOS_MATERIALES'
						UNION
						SELECT 
							CONCAT('IF-',`manto_inspeccion_movimiento`.`inspeccion_movimiento_id`) AS `id`,
						    DATE_FORMAT(`manto_inspeccion_movimiento`.`insp_fecha`,'%Y-%m-%d') AS `fecha`,
						    `colaborador`.`Colab_nombre_corto` AS `nombres_usuario_genera`,
						    'INSPECCION MANTENIMIENTO' AS `origen`,
						    'INSPECCION FLOTA' AS `tipo_novedad`,
						    CONCAT(`manto_inspeccion_movimiento`.`insp_codigo`,'-',`manto_inspeccion_movimiento`.`insp_descripcion`) AS `descripcion`,
						    CONCAT(`manto_inspeccion_movimiento`.`insp_componente`,'-',`manto_inspeccion_movimiento`.`insp_posicion`,'-',`manto_inspeccion_movimiento`.`insp_falla`,'-',`manto_inspeccion_movimiento`.`insp_accion`) AS `ot_accion`,
							`Buses`.`Bus_Operacion` AS `operacion`,
						    `manto_inspeccion_movimiento`.`insp_bus` AS `bus`,
						    `manto_inspeccion_movimiento`.`insp_componente` AS `componente`,
						    `manto_inspeccion_movimiento`.`insp_posicion` AS `posicion`,
						    `manto_inspeccion_movimiento`.`insp_falla` AS `falla`,
						    `manto_inspeccion_movimiento`.`insp_accion` AS `accion`,
							CONCAT(SUBSTRING(`manto_novedad_ot`.`not_ot_tipo`,1,1),'-',`manto_novedad_ot`.`not_ot_id`) AS `ot_id`,
							IF(`manto_novedad_ot`.`not_estado` IS NULL,'PENDIENTE',`manto_novedad_ot`.`not_estado`) AS `ot_estado`,
							`manto_novedad_ot`.`not_procedencia` AS `procedencia`
						FROM 
							`manto_inspeccion_movimiento`
						LEFT JOIN 
							`colaborador`
						ON
							`colaborador`.`Colaborador_id`=`manto_inspeccion_movimiento`.`insp_usuario_id`
						LEFT JOIN
							`Buses`
						ON
							`Buses`.`Bus_NroExterno`=`manto_inspeccion_movimiento`.`insp_bus`
							LEFT JOIN
							`manto_novedad_ot`
						ON
							`manto_novedad_ot`.`not_novedad_id`=`manto_inspeccion_movimiento`.`inspeccion_movimiento_id`
							AND `manto_novedad_ot`.`not_origen_novedad`='INSPECCION MANTENIMIENTO'
							AND `manto_novedad_ot`.`not_tipo_novedad`='INSPECCION FLOTA'
						WHERE
							DATE_FORMAT(`manto_inspeccion_movimiento`.`insp_fecha`,'%Y-%m-%d')>='$fecha_inicio'
							AND DATE_FORMAT(`manto_inspeccion_movimiento`.`insp_fecha`,'%Y-%m-%d')<='$fecha_termino'
						UNION
						SELECT 
							CONCAT('CL-',`manto_check_list_observaciones`.`check_list_observaciones_id`) AS `id`,
    						`manto_check_list_registro`.`chl_fecha` AS `fecha`,
							`colaborador`.`Colab_nombre_corto` AS `nombres_usuario_genera`,
							'INSPECCION OPERACIONES' AS `origen`,
							'CHECK LIST' AS `tipo_novedad`,
							CONCAT(`manto_check_list_observaciones`.`chl_codigo`,'-',`manto_check_list_observaciones`.`chl_descripcion`) AS `descripcion`,
							CONCAT(`manto_check_list_observaciones`.`chl_componente`,'-',`manto_check_list_observaciones`.`chl_posicion`,'-',`manto_check_list_observaciones`.`chl_falla`,'-',`manto_check_list_observaciones`.`chl_accion` ) AS `ot_accion`,
    						`Buses`.`Bus_Operacion` AS `operacion`,
    						`manto_check_list_registro`.`chl_bus` AS `bus`,
							`manto_check_list_observaciones`.`chl_componente` AS `componente`,
    						`manto_check_list_observaciones`.`chl_posicion` AS `posicion`,
    						`manto_check_list_observaciones`.`chl_falla` AS `falla`,
    						`manto_check_list_observaciones`.`chl_accion` AS `accion`,
							CONCAT(SUBSTRING(`manto_novedad_ot`.`not_ot_tipo`,1,1),'-',`manto_novedad_ot`.`not_ot_id`) AS `ot_id`,
							IF(`manto_novedad_ot`.`not_estado` IS NULL,'PENDIENTE',`manto_novedad_ot`.`not_estado`) AS `ot_estado`,
							`manto_novedad_ot`.`not_procedencia` AS `procedencia`
						FROM 
							`manto_check_list_registro`
						RIGHT JOIN
							`manto_check_list_observaciones`
						ON
							`manto_check_list_registro`.`check_list_id`=`manto_check_list_observaciones`.`check_list_id`
						LEFT JOIN
							`colaborador`
						ON
							`colaborador`.`Colaborador_id`=`manto_check_list_registro`.`chl_usuario_id_genera`
						LEFT JOIN
							`Buses`
						ON
							`Buses`.`Bus_NroExterno`=`manto_check_list_registro`.`chl_bus`
						LEFT JOIN
							`manto_novedad_ot`
						ON
							`manto_novedad_ot`.`not_novedad_id`=`manto_check_list_observaciones`.`check_list_observaciones_id`
							AND `manto_novedad_ot`.`not_origen_novedad`='INNSPECCION OPERACIONES'
							AND `manto_novedad_ot`.`not_tipo_novedad`='CHECK LIST'
						WHERE
							DATE_FORMAT(`manto_check_list_registro`.`chl_fecha`,'%Y-%m-%d')>='$fecha_inicio'
							AND DATE_FORMAT(`manto_check_list_registro`.`chl_fecha`,'%Y-%m-%d')<='$fecha_termino'
						UNION
						SELECT 
							CONCAT('NR-',`manto_novedad_regular`.`novedad_regular_id`) AS `id`,
    						DATE_FORMAT(`manto_novedad_regular`.`nreg_fecha`,'%Y-%m-%d') AS `fecha`,
    						`colaborador`.`Colab_nombre_corto` AS `nombres_usuario_genera`,
    						`manto_novedad_regular`.`nreg_origen` AS `origen`,
    						`manto_novedad_regular`.`nreg_tipo` AS `tipo_novedad`,
    						`manto_novedad_regular`.`nreg_descripcion` AS `descripcion`, 
							CONCAT(`manto_novedad_regular`.`nreg_componente`,'-',`manto_novedad_regular`.`nreg_posicion`,'-',`manto_novedad_regular`.`nreg_falla`,'-',`manto_novedad_regular`.`nreg_accion`) AS `ot_accion`,
    						`manto_novedad_regular`.`nreg_operacion` AS `operacion`,
    						`manto_novedad_regular`.`nreg_bus` AS `bus`,
    						`manto_novedad_regular`.`nreg_componente` AS `componente`,
    						`manto_novedad_regular`.`nreg_posicion` AS `posicion`,
    						`manto_novedad_regular`.`nreg_falla` AS `falla`,
    						`manto_novedad_regular`.`nreg_accion` AS `accion`,
							CONCAT(SUBSTRING(`manto_novedad_ot`.`not_ot_tipo`,1,1),'-',`manto_novedad_ot`.`not_ot_id`) AS `ot_id`,
							IF(`manto_novedad_ot`.`not_estado` IS NULL,'PENDIENTE',`manto_novedad_ot`.`not_estado`) AS `ot_estado`,
							`manto_novedad_ot`.`not_procedencia` AS `procedencia`
						FROM 
							`manto_novedad_regular`
						LEFT JOIN 
							`colaborador`
						ON
							`colaborador`.`Colaborador_id`=`manto_novedad_regular`.`nreg_usuario_genera`
							LEFT JOIN
							`manto_novedad_ot`
						ON
							`manto_novedad_ot`.`not_novedad_id`=`manto_novedad_regular`.`novedad_regular_id`
							AND `manto_novedad_ot`.`not_origen_novedad`=`manto_novedad_regular`.`nreg_origen`
							AND `manto_novedad_ot`.`not_tipo_novedad`=`manto_novedad_regular`.`nreg_tipo`
						WHERE
							DATE_FORMAT(`manto_novedad_regular`.`nreg_fecha`,'%Y-%m-%d')>='$fecha_inicio'
							AND DATE_FORMAT(`manto_novedad_regular`.`nreg_fecha`,'%Y-%m-%d')<='$fecha_termino')
						ORDER BY `fecha` DESC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
   	}   

	function crear_novedad_regular($nreg_origen, $nreg_descripcion, $nreg_operacion, $nreg_bus, $nreg_componente, $nreg_posicion, $nreg_falla, $nreg_accion)
	{
		$nreg_usuario_genera = $_SESSION['USUARIO_ID'];
		$nreg_fecha = date("Y-m-d H:i:s");
		$nreg_tipo = 'NOVEDAD REGULAR';

	   	$consulta = " INSERT INTO `manto_novedad_regular` (`nreg_fecha`, `nreg_usuario_genera`, `nreg_origen`, `nreg_tipo`, `nreg_descripcion`, `nreg_operacion`, `nreg_bus`, `nreg_componente`, `nreg_posicion`, `nreg_falla`, `nreg_accion`) VALUES ('$nreg_fecha', '$nreg_usuario_genera', '$nreg_origen', '$nreg_tipo', '$nreg_descripcion', '$nreg_operacion', '$nreg_bus', '$nreg_componente', '$nreg_posicion', '$nreg_falla', '$nreg_accion') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

	    $this->conexion=null;	
	}  	

	function codificar_novedad($nope_tipo_novedad, $nope_novedad_id, $nope_componente, $nope_posicion, $nope_falla, $nope_accion)
	{
		$nope_usuario_genera = $_SESSION['USUARIO_ID'];
		$nope_fecha = date("Y-m-d H:i:s");
		$nope_novedad_id = substr($nope_novedad_id,3,15);
		
		$consulta = " INSERT INTO `manto_novedad_operacion` (`nope_fecha`, `nope_usuario_genera`, `nope_tipo_novedad`, `nope_novedad_id`, `nope_componente`, `nope_posicion`, `nope_falla`, `nope_accion`) VALUES ('$nope_fecha', '$nope_usuario_genera', '$nope_tipo_novedad', '$nope_novedad_id', '$nope_componente', '$nope_posicion', '$nope_falla', '$nope_accion') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

	    $this->conexion=null;	
	}  	

	function crear_orden_trabajo($not_ot_tipo, $ot_asociado, $not_bus, $ot_descrip, $not_novedad_id)
	{
		$ot_date_crea = date("Y-m-d H:i:s");
		$ot_cgm_crea = $_SESSION['USUARIO_ID'];
		$ot_usuario_genera = $_SESSION['Usua_NombreCorto'];;
		$ot_estado = 'ABIERTO';
		$ot_obs_aom = '<strong>'.$ot_estado.' '.$ot_date_crea.' '.$ot_usuario_genera.' GENERADA POR NOVEDAD '.$not_novedad_id.'</strong>';

		$consulta = "INSERT INTO `manto_orden_trabajo` (`ot_tipo`, `ot_date_crea`, `ot_cgm_crea`, `ot_estado`, `ot_descrip`, `ot_asociado`, `ot_bus`, `ot_obs_aom`) VALUES ('$not_ot_tipo','$ot_date_crea', '$ot_cgm_crea', '$ot_estado', '$ot_descrip', '$ot_asociado', '$not_bus', '$ot_obs_aom') ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		
		$ot_id = $this->conexion->lastInsertId();
		return $ot_id;

	    $this->conexion=null;	
	}

	function vincular_orden_trabajo($ot_id, $ot_descrip, $ot_estado, $ot_obs_aom, $novedad_id)
	{
		$ot_date_crea = date("Y-m-d H:i:s");
		$ot_usuario_genera = $_SESSION['Usua_NombreCorto'];
		$ot_obs_aom_edt = '<strong>'.$ot_estado.' '.$ot_date_crea.' '.$ot_usuario_genera.' VINCULAR NOVEDAD '.$novedad_id.'</strong><br>'.$ot_obs_aom;

		$consulta = " UPDATE `manto_orden_trabajo` SET `ot_descrip`='$ot_descrip', `ot_obs_aom`='$ot_obs_aom_edt' WHERE `ot_id`='$ot_id' ";
		echo $consulta;
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		
	    $this->conexion=null;	
	}

	function vincular_novedad_ot($not_origen_novedad, $not_tipo_novedad, $not_novedad_id, $not_operacion, $not_bus, $not_ot_tipo, $not_ot_id)
	{
		$not_fecha_generacion = date("Y-m-d H:i:s");
		$not_usuario_genera = $_SESSION['USUARIO_ID'];
		$not_estado = 'GENERA OT';
		$not_novedad_id = substr($not_novedad_id,3,15);
		$not_procedencia = 'VINCULACION';
		
		$consulta = " INSERT INTO `manto_novedad_ot` (`not_fecha_generacion`, `not_usuario_genera`, `not_estado`, `not_ot_tipo`, `not_ot_id`, `not_origen_novedad`, `not_tipo_novedad`, `not_novedad_id`, `not_operacion`, `not_bus`, `not_procedencia`) VALUES	('$not_fecha_generacion', '$not_usuario_genera', '$not_estado', '$not_ot_tipo', '$not_ot_id', '$not_origen_novedad', '$not_tipo_novedad', '$not_novedad_id', '$not_operacion', '$not_bus', '$not_procedencia') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

	    $this->conexion=null;	
	}  	

	function genera_novedad_ot($not_origen_novedad, $not_tipo_novedad, $not_novedad_id, $not_operacion, $not_bus, $not_ot_tipo, $not_ot_id)
	{
		$not_fecha_generacion = date("Y-m-d H:i:s");
		$not_usuario_genera = $_SESSION['USUARIO_ID'];
		$not_estado = 'GENERA OT';
		$not_novedad_id = substr($not_novedad_id,3,15);
		$not_procedencia = 'CREACION';
		
		$consulta = " INSERT INTO `manto_novedad_ot` (`not_fecha_generacion`, `not_usuario_genera`, `not_estado`, `not_ot_tipo`, `not_ot_id`, `not_origen_novedad`, `not_tipo_novedad`, `not_novedad_id`, `not_operacion`, `not_bus`, `not_procedencia`) VALUES	('$not_fecha_generacion', '$not_usuario_genera', '$not_estado', '$not_ot_tipo', '$not_ot_id', '$not_origen_novedad', '$not_tipo_novedad', '$not_novedad_id', '$not_operacion', '$not_bus', '$not_procedencia') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

	    $this->conexion=null;	
	}  	

	function no_genera_ot($not_origen_novedad, $not_tipo_novedad, $not_novedad_id, $not_operacion, $not_bus)
	{
		$not_fecha_generacion = date("Y-m-d H:i:s");
		$not_usuario_genera = $_SESSION['USUARIO_ID'];
		$not_estado = 'NO GENERA OT';
		$not_ot_tipo = 'NO_OT';
		$not_ot_id = '0';
		$not_novedad_id = substr($not_novedad_id,3,15);
		$not_procedencia = 'CREACION';
		
		$consulta = " INSERT INTO `manto_novedad_ot` (`not_fecha_generacion`, `not_usuario_genera`, `not_estado`, `not_ot_tipo`, `not_ot_id`, `not_origen_novedad`, `not_tipo_novedad`, `not_novedad_id`, `not_operacion`, `not_bus`, `not_procedencia`) VALUES	('$not_fecha_generacion', '$not_usuario_genera', '$not_estado', '$not_ot_tipo', '$not_ot_id', '$not_origen_novedad', '$not_tipo_novedad', '$not_novedad_id', '$not_operacion', '$not_bus', '$not_procedencia') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

	    $this->conexion=null;	
	}  	

	function leer_tc_ot_usuario()
	{
		$tc_variable = 'USUARIO';
		$consulta="SELECT * FROM `manto_tc_orden_trabajo` WHERE `tc_variable`='$tc_variable'";
   
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
		print json_encode($data, JSON_UNESCAPED_UNICODE);
		$this->conexion=null;
	}   
   
	function crear_tc_ot_usuario($tc_ot_id, $tc_categoria1, $tc_categoria2, $tc_categoria3)
	{
		$tc_variable = 'USUARIO';
		$consulta = "INSERT INTO `manto_tc_orden_trabajo`(`tc_variable`, `tc_categoria1`, `tc_categoria2`, `tc_categoria3`) VALUES ('$tc_variable', '$tc_categoria1','$tc_categoria2','$tc_categoria3')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta = "SELECT * FROM `manto_tc_orden_trabajo` WHERE `tc_variable`='$tc_variable'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);
		  
	   	$this->conexion=null;	
	}  	
	
	function editar_tc_ot_usuario($tc_ot_id, $tc_categoria1, $tc_categoria2, $tc_categoria3)
	{
	  	$consulta = "UPDATE `manto_tc_orden_trabajo` SET `tc_categoria1`='$tc_categoria1',`tc_categoria2`='$tc_categoria2',`tc_categoria3`='$tc_categoria3' 	WHERE`tc_ot_id`='$tc_ot_id'";		
	  	$resultado = $this->conexion->prepare($consulta);
	  	$resultado->execute();   
		
	  	$consulta= "SELECT * FROM `manto_tc_orden_trabajo` WHERE `tc_ot_id` ='$tc_ot_id'";
	  	$resultado = $this->conexion->prepare($consulta);
	  	$resultado->execute();        
	  	$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	  	print json_encode($data, JSON_UNESCAPED_UNICODE);
	  	$this->conexion=null;	
	}  		
	   
	function borrar_tc_ot_usuario($tc_ot_id)
	{
		$consulta = "DELETE FROM `manto_tc_orden_trabajo` WHERE `tc_ot_id`='$tc_ot_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$this->conexion=null;	
	}
   
	function leer_tc_ot_sistema()
	{
		$tc_variable = 'SISTEMA';
		$consulta="SELECT * FROM `manto_tc_orden_trabajo` WHERE `tc_variable`='$tc_variable'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);
		$this->conexion=null;
	}   
   
	function crear_tc_ot_sistema($tc_ot_id, $tc_categoria1, $tc_categoria2, $tc_categoria3)
	{
		$tc_variable = 'SISTEMA';
		$consulta = "INSERT INTO `manto_tc_orden_trabajo`(`tc_variable`, `tc_categoria1`, `tc_categoria2`, `tc_categoria3`) VALUES ('$tc_variable', '$tc_categoria1','$tc_categoria2','$tc_categoria3')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
   
		$consulta = "SELECT * FROM `manto_tc_orden_trabajo` WHERE `tc_variable`='$tc_variable'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);
		  
		$this->conexion=null;	
	}  	
	   
	function editar_tc_ot_sistema($tc_ot_id, $tc_categoria1, $tc_categoria2, $tc_categoria3)
	{
		$consulta = "UPDATE `manto_tc_orden_trabajo` SET `tc_categoria1`='$tc_categoria1',`tc_categoria2`='$tc_categoria2',`tc_categoria3`='$tc_categoria3'WHERE`tc_ot_id`='$tc_ot_id'";	

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `manto_tc_orden_trabajo` WHERE `tc_ot_id` ='$tc_ot_id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);
		$this->conexion=null;	
	}  		
	   
	function borrar_tc_ot_sistema($tc_ot_id)
	{
		$consulta = "DELETE FROM `manto_tc_orden_trabajo` WHERE `tc_ot_id`='$tc_ot_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$this->conexion=null;	
	}
   
}