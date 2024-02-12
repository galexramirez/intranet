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
		$Instancia= new C_ConexionesBD();
		$this->conexion=$Instancia->Conectar(); 	
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

	function select_roles($roles_perfil, $roles_campo)
	{
		$consulta="SELECT `colaborador`.`$roles_campo` AS `nombres` FROM `glo_roles` RIGHT JOIN `colaborador` ON `colaborador`.`Colaborador_id`= `glo_roles`.`roles_dni` AND `colaborador`.`Colab_Estado`='ACTIVO' WHERE `glo_roles`.`roles_perfil` = '$roles_perfil'  ORDER BY `nombres` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function leer_ot($ot_ruc_proveedor, $fecha_inicio_ot, $fecha_termino_ot)
	{
		$where_ruc_proveedor = "";
		if($ot_ruc_proveedor!=""){
			$where_ruc_proveedor = "AND `ot_ruc_proveedor`='$ot_ruc_proveedor'";
		}
		$consulta = " 	SELECT 
							CONCAT_WS('-',SUBSTRING(`ot_tipo`,1,1),SUBSTRING(CONCAT('00000000',`ot_id`),-8)) AS `ot_id`, 
							`ot_estado`, 
							DATE_FORMAT(`ot_fecha_registro`,'%Y-%m-%d %H:%i') AS `ot_fecha`, 
							`colaborador`.`Colab_nombre_corto` AS `ot_cgm_genera`, 
							`ot_bus`, 
							`ot_origen`, 
							`ot_nombre_proveedor` AS `ot_proveedor`, 
							`ot_actividad`, 
							`ot_kilometraje`,
							IF(`tvale`.`nvale`>'0',SUBSTRING(CONCAT('00',`tvale`.`nvale`),-2),'') AS `ot_vales`
						FROM 
							`manto_ots` 
						LEFT JOIN 
							(SELECT `manto_vale`.`va_ot_id`, COUNT(*) AS `nvale` FROM `manto_vale` GROUP BY `manto_vale`.`va_ot_id`) AS `tvale` 
						ON 
							`tvale`.`va_ot_id`=`manto_ots`.`ot_id`
						LEFT JOIN
							`colaborador`
						ON 
							`colaborador`.`Colaborador_id`=`manto_ots`.`ot_cgm_id`
						WHERE 
							DATE_FORMAT(`ot_fecha_registro`,'%Y-%m-%d')>='$fecha_inicio_ot' AND 
							DATE_FORMAT(`ot_fecha_registro`,'%Y-%m-%d')<='$fecha_termino_ot' ".$where_ruc_proveedor;

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
   	}   

	function ver_ot($ot_id)
	{
		$consulta = "	SELECT 
							`manto_ots`.`ot_id`,
    						`manto_ots`.`ot_estado`,
    						`manto_ots`.`ot_origen`,
    						`manto_ots`.`ot_tipo`,
    						`manto_ots`.`ot_bus`,
    						`manto_ots`.`ot_ruc_proveedor`,
    						`manto_ots`.`ot_nombre_proveedor`,
    						`colaborador`.`Colab_nombre_corto` AS `ot_cgm_nombres`,
    						`manto_ots`.`ot_fecha_registro`,
    						`manto_ots`.`ot_actividad`,
    						`manto_ots`.`ot_actividad_vincular`,
    						`manto_ots`.`ot_kilometraje`,
    						`manto_ots`.`ot_sistema`,
    						`manto_ots`.`ot_ejecucion`,
    						`manto_ots`.`ot_obs_proveedor`,
    						`manto_ots`.`ot_obs_cgm`,
    						`manto_ots`.`ot_log`,
    						`manto_ots`.`ot_semana_cierre`
						FROM 
							`manto_ots`
						LEFT JOIN
							`colaborador`
						ON
							`colaborador`.`Colaborador_id`=`manto_ots`.`ot_cgm_id`
						WHERE 
							`ot_id` = '$ot_id'";
		   
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
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

	function ver_vale($ot_id)
	{
		$consulta	= " SELECT 
							`manto_vale`.`vale_id`, 
							`manto_vale`.`va_ot_id`,
							`manto_ots`.`ot_bus` AS `va_bus`, 
							`manto_vale`.`va_asociado`,
							`colaborador`.`Colab_nombre_corto` AS `va_genera_nomnbre`,
							`manto_vale`.`va_date_genera`,
							`manto_vale`.`va_estado`,
							CONCAT(`manto_ots`.`ot_origen`,' - ',`manto_ots`.`ot_actividad`) AS `va_actividad`,
							`manto_vale`.`va_obs_cgm`, 
							`manto_vale`.`va_obs_aom`, 
							`manto_vale`.`va_log`
						FROM 
							`manto_vale` 
						LEFT JOIN 
							`manto_ots` 
						ON 
							`manto_ots`.`ot_id`=`manto_vale`.`va_ot_id` 
						LEFT JOIN
							`colaborador`
						ON
							`colaborador`.`Colaborador_id`=`manto_vale`.`va_genera`
						WHERE 
							`manto_vale`.`va_ot_id`='$ot_id'";
   
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		$data		=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
		return $data;
		$this->conexion=null;
	}

	function ver_detalle_repuesto($vale_id)
	{
		$consulta	= "	SELECT
							`manto_vale_repuestos`.`vr_repuesto`,
							`manto_vale_repuestos`.`vr_cod_patrimonial`,
							`manto_vale_repuestos`.`vr_descripcion`,
							`manto_vale_repuestos`.`vr_nroserie`, 
							`manto_vale_repuestos`.`vr_cantidad_requerida`, 
							`manto_vale_repuestos`.`vr_cantidad_despachada`,
							`manto_vale_repuestos`.`vr_cantidad_utilizada`,
							CONCAT(`manto_unidad_medida`.`unidad_medida`,'-',`manto_unidad_medida`.`um_descripcion`) AS `vr_unidad` 
						FROM 
							`manto_vale_repuestos` 
						LEFT JOIN
							`manto_unidad_medida`
						ON
							`manto_unidad_medida`.`unidad_medida` = `manto_vale_repuestos`.`vr_unidad_medida`
						WHERE 
							`vr_vale_id`='$vale_id' ";
   
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;
   
		$this->conexion=null;
	}

	function leer_vale($fecha_inicio_listado, $fecha_termino_listado)
	{
		$consulta = "	SELECT
							SUBSTRING(CONCAT('00000000',`manto_vale`.`vale_id`),-8) AS `vale_id`,
    						`manto_vale`.`va_asociado`,
    						`manto_vale`.`va_date_genera`,
    						`manto_vale`.`va_estado`,
    						`colaborador`.`Colab_nombre_corto` AS `va_nombre_genera`,
						    CONCAT_WS('-',SUBSTRING(`manto_ots`.`ot_tipo`,1,1),SUBSTRING(CONCAT('00000000',`manto_ots`.`ot_id`),-8)) AS `va_ot_id`,
							`manto_ots`.`ot_bus` AS `va_bus`, 
							`manto_ots`.`ot_origen` AS `va_origen`
						FROM 
							`manto_vale` 
						LEFT JOIN 
							`manto_ots` 
						ON 
							manto_ots.`ot_id`=`manto_vale`.`va_ot_id` 
						LEFT JOIN
							`colaborador`
						ON
							`colaborador`.`Colaborador_id`=`manto_vale`.`va_genera`
						WHERE 
							DATE_FORMAT(`manto_vale`.`va_date_genera`,'%Y-%m-%d')>='$fecha_inicio_listado' 
							AND DATE_FORMAT(`manto_vale`.`va_date_genera`,'%Y-%m-%d')<='$fecha_termino_listado'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
   	}   

	function generar_vale($vale_id, $va_ot_id, $va_genera, $va_date_genera, $va_asociado, $va_obs_cgm, $va_obs_aom, $va_estado, $nombre_cierre_adm, $va_tipo, $va_ruc)
	{
		$va_fecha = date("Y-m-d H:i:s");
		$va_log = "<strong>".$va_estado."</strong> ".$va_fecha." ".$nombre_cierre_adm.": REGISTRO CREACION ";

		$consulta="INSERT INTO `manto_vale`(`va_ot_id`, `va_genera`, `va_date_genera`, `va_asociado`,  `va_obs_cgm`, `va_obs_aom`, `va_estado`, `va_tipo`, `va_ruc`, `va_log`) VALUES ('$va_ot_id', '$va_genera', '$va_date_genera', '$va_asociado', '$va_obs_cgm', '$va_obs_aom', '$va_estado', '$va_tipo', '$va_ruc', '$va_log')";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$vale_id = $this->conexion->lastInsertId();
		return $vale_id;

		$this->conexion=null;
	}

	function cargar_vale($vale_id)
	{
		$consulta = "	SELECT 
							`manto_vale`.`vale_id`, 
							`manto_vale`.`va_ot_id`, 
							`manto_ots`.`ot_bus` AS `va_bus`, 
							`manto_ots`.`ot_origen` AS `va_origen`, 
							`manto_vale`.`va_asociado`, 
							`colaborador`.`Colab_nombre_corto` AS `va_genera`, 
							`va_date_genera`, 
							`manto_vale`.`va_estado`, 
							CONCAT(`manto_ots`.`ot_origen`,' - ',`manto_ots`.`ot_actividad`) AS `va_descrip`, 
							`manto_vale`.`va_obs_cgm`, 
							`manto_vale`.`va_obs_aom`,
							`manto_vale`.`va_log`
						FROM 
							`manto_vale` 
						LEFT JOIN 
							`manto_ots` 
						ON 
							`manto_ots`.`ot_id`=`manto_vale`.`va_ot_id` 
						LEFT JOIN
							`colaborador`
						ON
							`colaborador`.`Colaborador_id`=`manto_vale`.`va_genera`
						WHERE 
							`vale_id`='$vale_id'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}

	function editar_vale($vale_id, $va_ot_id, $va_genera, $va_date_genera, $va_asociado, $va_obs_cgm, $va_obs_aom, $va_estado, $nombre_cierre_adm, $va_tipo, $va_ruc, $va_log)
	{
		$va_date_cierre_adm = date("Y-m-d H:i:s");
		$va_log_edt = $va_estado." ".$va_date_cierre_adm." ".$nombre_cierre_adm." EDITAR <br>".$va_log;

		$consulta = "UPDATE `manto_vale` SET `va_ot_id`='$va_ot_id', `va_genera`='$va_genera', `va_date_genera`='$va_date_genera',`va_asociado`='$va_asociado', `va_obs_cgm`='$va_obs_cgm', `va_obs_aom`='$va_obs_aom', `va_estado`='$va_estado', `va_tipo`='$va_tipo', `va_ruc`='$va_ruc', `va_log`='$va_log_edt' WHERE `vale_id`='$vale_id'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$this->conexion=null;
	}

	function cargar_repuestos($vale_id)
	{
		$consulta = "SELECT 
						`vr_vale_id`,
						`vr_id`, 
						`vr_repuesto`,
						`vr_cod_patrimonial`,
						`vr_nroserie`, 
						`vr_descripcion`,
						`vr_cantidad_requerida`, 
						`vr_cantidad_despachada`, 
						`vr_cantidad_utilizada`, 
						CONCAT(`manto_unidad_medida`.`unidad_medida`,'-',`manto_unidad_medida`.`um_descripcion`) AS `vr_unidad` 
					FROM 
						`manto_vale_repuestos`
					LEFT JOIN
						`manto_unidad_medida`
					ON
						`manto_vale_repuestos`.`vr_unidad_medida`=`manto_unidad_medida`.`unidad_medida` 
					WHERE 
						`vr_vale_id`='$vale_id'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}

	function crear_detalle_repuestos($vr_vale_id, $vr_id, $vr_repuesto, $vr_cod_patrimonial, $vr_descripcion, $vr_nroserie, $vr_cantidad_requerida, $vr_cantidad_despachada, $vr_cantidad_utilizada, $va_tipo, $vr_unidad_medida, $vr_moneda, $vr_precio, $vr_precio_soles, $vr_material_id, $vr_precio_proveedor_id, $vr_fecha_vigencia)
	{
		$consulta = " INSERT INTO `manto_vale_repuestos` (`vr_vale_id`, `vr_id`, `vr_repuesto`, `vr_descripcion`, `vr_nroserie`, `vr_unidad_medida`, `vr_moneda`, `vr_precio`, `vr_precio_soles`, `vr_fecha_vigencia`, `vr_tipo`, `vr_cantidad_requerida`, `vr_cantidad_despachada`, `vr_cantidad_utilizada`, `vr_cod_patrimonial`, `vr_material_id`, `vr_precio_proveedor_id`) VALUES ('$vr_vale_id', '$vr_id', '$vr_repuesto', '$vr_descripcion', '$vr_nroserie', '$vr_unidad_medida', '$vr_moneda', '$vr_precio', '$vr_precio_soles', '$vr_fecha_vigencia', '$va_tipo', '$vr_cantidad_requerida', '$vr_cantidad_despachada', '$vr_cantidad_utilizada', '$vr_cod_patrimonial', '$vr_material_id', '$vr_precio_proveedor_id') ";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$this->conexion=null;
	}

	function eliminar_detalle_repuestos($vale_id)
	{
		$consulta="DELETE FROM `manto_vale_repuestos` WHERE `vr_vale_id`='$vale_id'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$this->conexion=null;
	}

	function AutoCompletar($NombreTabla, $NombreCampo, $va_ruc, $va_date_genera, $va_tipo)
	{
		$consulta = "SELECT DISTINCT `$NombreTabla`.`$NombreCampo`, `$NombreTabla`.`precioprov_descripcion` FROM `$NombreTabla` WHERE `precioprov_ruc`='$va_ruc' AND `precioprov_fechavigencia`<='$va_date_genera' AND `precioprov_tipo`='$va_tipo'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function BuscarCodigoRepuesto($vr_repuesto, $va_ruc, $va_date_genera, $va_tipo){
		$consulta = "SELECT 
						`manto_preciosproveedor`.`precioprov_materialid`, 
						`manto_preciosproveedor`.`precioprov_descripcion`,
						`manto_materiales`.`material_macrosistema`,
						`manto_materiales`.`material_sistema`,
						`manto_materiales`.`material_tarjeta`,
						`manto_materiales`.`material_condicion`,
						`manto_materiales`.`material_flota`,
						`manto_preciosproveedor`.`precioprov_tipo`,
						`manto_materiales`.`material_categoria`,
						`manto_materiales`.`material_patrimonial`,
						`manto_unidad_medida`.`um_descripcion`,
						`manto_preciosproveedor`.`precioprov_moneda`,
						`manto_preciosproveedor`.`precioprov_preciosoles`,
						`manto_preciosproveedor`.`precioprov_fechavigencia`,
						`manto_unidad_medida`.`unidad_medida`,
						`manto_preciosproveedor`.`precioprov_id`,
						`manto_preciosproveedor`.`precioprov_precio`
					FROM 
						`manto_preciosproveedor` 
					LEFT JOIN 
						`manto_materiales` 
					ON 
						`manto_materiales`.`material_id` = `manto_preciosproveedor`.`precioprov_materialid` 
					LEFT JOIN
						`manto_unidad_medida`
					ON
						`manto_unidad_medida`.`unidad_medida`=`manto_preciosproveedor`.`precioprov_unidadmedida`
					WHERE 
						`precioprov_ruc`='$va_ruc' AND 
						`precioprov_fechavigencia`<='$va_date_genera' AND 
						`precioprov_codproveedor`='$vr_repuesto' AND
						`precioprov_tipo`='$va_tipo'
					ORDER BY
						`precioprov_fechavigencia` DESC
					LIMIT 1;";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function descargar_vale($fecha_inicio_listado,$fecha_termino_listado)
	{
		$consulta = "(SELECT 
						`manto_vale`.`vale_id`, 
						`manto_vale`.`va_estado`, 
						`manto_vale`.`va_ot_id`, 
						`manto_vale`.`va_asociado`, 
						`manto_vale`.`va_responsable`, 
						(SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`manto_vale`.`va_genera`) AS `va_genera`,
						DATE_FORMAT(`manto_vale`.`va_date_genera`,'%Y-%m-%d') AS `va_date_genera`, 
						`manto_vale`.`va_obs_cgm`, 
						`manto_vale`.`va_garantia`,
						`manto_orden_trabajo`.`ot_bus`, 
						`manto_orden_trabajo`.`ot_origen`, 
						`manto_orden_trabajo`.`ot_descrip`, 
						(SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`manto_vale`.`va_cierre_adm`) AS `va_cierre_adm`,
						DATE_FORMAT(`manto_vale`.`va_date_cierre_adm`,'%Y-%m-%d') AS `va_date_cierre_adm`, 
						TIME_FORMAT(`manto_vale`.`va_date_cierre_adm`,'%H:%i') AS `va_time_cierre_adm`, 
						`manto_vale`.`va_obs_aom`, 
						`manto_vale_repuestos`.`vr_repuesto`, 
						`manto_vale_repuestos`.`vr_nroserie`, 
						`manto_vale_repuestos`.`vr_cantidad_requerida`,
						`manto_vale_repuestos`.`vr_moneda`,
						ROUND(`manto_vale_repuestos`.`vr_precio_soles`,2) AS `vr_precio_soles`,
						`manto_vale_repuestos`.`vr_fecha_vigencia`,
						IF(ISNULL(`vr_descripcion`)='1',(SELECT `rep_desc` FROM `manto_repuestos` WHERE `manto_repuestos`.`cod_rep`=`manto_vale_repuestos`.`vr_repuesto`),`vr_descripcion`) AS `rep_desc`, 
						IF(ISNULL(`manto_vale_repuestos`.`vr_unidad_medida`)='1',(SELECT `rep_unida` FROM `manto_repuestos` WHERE `manto_vale_repuestos`.`vr_repuesto`=`manto_repuestos`.`cod_rep`),(SELECT `manto_unidad_medida`.`um_descripcion` FROM `manto_unidad_medida` WHERE `manto_unidad_medida`.`unidad_medida`=`manto_vale_repuestos`.`vr_unidad_medida`)) AS `rep_unidad`,
						`manto_vale_repuestos`.`vr_tipo`,
						ROUND((`manto_vale_repuestos`.`vr_cantidad_requerida`*`manto_vale_repuestos`.`vr_precio_soles`),2) AS `vr_subtotal`
					FROM 
						`manto_vale_repuestos`,
						`manto_vale`
					LEFT JOIN
						`manto_orden_trabajo`
					ON
						`manto_vale`.`va_ot_id`=`manto_orden_trabajo`.`ot_id`
					WHERE 
						DATE_FORMAT(`manto_vale`.`va_date_genera`,'%Y-%m-%d')>='$fecha_inicio_listado' AND
						DATE_FORMAT(`manto_vale`.`va_date_genera`,'%Y-%m-%d')<='$fecha_termino_listado' AND
						`manto_vale`.`vale_id` = `manto_vale_repuestos`.`vr_vale`
					ORDER BY
						`manto_vale`.`va_date_genera` DESC
					)
					UNION
					(SELECT
						`manto_vale`.`vale_id`, 
						`manto_vale`.`va_estado`, 
						`manto_vale`.`va_ot_id`, 
						`manto_vale`.`va_asociado`, 
						`manto_vale`.`va_responsable`, 
						(SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`manto_vale`.`va_genera`) AS `va_genera`,
						DATE_FORMAT(`manto_vale`.`va_date_genera`,'%Y-%m-%d') AS `va_date_genera`, 
						`manto_vale`.`va_obs_cgm`, 
						`manto_vale`.`va_garantia`,
						`manto_orden_trabajo`.`ot_bus`, 
						`manto_orden_trabajo`.`ot_origen`, 
						`manto_orden_trabajo`.`ot_descrip`, 
						(SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`manto_vale`.`va_cierre_adm`) AS `va_cierre_adm`, 
						DATE_FORMAT(`manto_vale`.`va_date_cierre_adm`,'%Y-%m-%d') AS `va_date_cierre_adm`, 
						TIME_FORMAT(`manto_vale`.`va_date_cierre_adm`,'%H:%i') AS `va_time_cierre_adm`, 
						`manto_vale`.`va_obs_aom`, 
						'' AS `vr_repuesto`, 
						'' AS `vr_nroserie`,
						'' AS `vr_cantidad_requerida`,
						'' AS `vr_moneda`,
						'' AS `vr_precio_soles`,
						'' AS `vr_fecha_vigencia`,
						'' AS `rep_desc`, 
						'' AS `rep_unidad`,
						'' AS `vr_tipo`,
						'' AS `vr_subtotal`
					FROM
						`manto_vale`
					LEFT JOIN
						`manto_orden_trabajo`
					ON
						`manto_vale`.`va_ot_id`=`manto_orden_trabajo`.`ot_id`
					WHERE
						NOT EXISTS (
							SELECT 
								`manto_vale_repuestos`.`vr_vale`
							FROM
								`manto_vale_repuestos`
							WHERE
								`manto_vale`.`vale_id`=`manto_vale_repuestos`.`vr_vale`) AND
								DATE_FORMAT(`manto_vale`.`va_date_genera`,'%Y-%m-%d')>='$fecha_inicio_listado' AND
								DATE_FORMAT(`manto_vale`.`va_date_genera`,'%Y-%m-%d')<='$fecha_termino_listado'
					ORDER BY
						`manto_vale`.`va_date_genera` DESC
					)";

		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);
   
		return $data;
		$this->conexion=null;
	}   

	function vales_observados()
	{
		$consulta = " SELECT COUNT(*) AS `cantidad_vales` FROM `manto_vale` WHERE `va_estado`='OBSERVADO'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
		return $data;
		$this->conexion=null;
	}

	function leer_tc_vale_usuario()
	{
		$tc_variable = 'USUARIO';
		$consulta="SELECT * FROM `manto_tc_vale` WHERE `tc_variable`='$tc_variable'";
   
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
		print json_encode($data, JSON_UNESCAPED_UNICODE);
		$this->conexion=null;
	}   
   
	function crear_tc_vale_usuario($tc_vale_id, $tc_categoria1, $tc_categoria2, $tc_categoria3)
	{
		$tc_variable = 'USUARIO';
		$consulta = "INSERT INTO `manto_tc_vale`(`tc_variable`, `tc_categoria1`, `tc_categoria2`, `tc_categoria3`) VALUES ('$tc_variable', '$tc_categoria1','$tc_categoria2','$tc_categoria3')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta = "SELECT * FROM `manto_tc_vale` WHERE `tc_variable`='$tc_variable'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);
		  
	   	$this->conexion=null;	
	}  	
	
	function editar_tc_vale_usuario($tc_vale_id, $tc_categoria1, $tc_categoria2, $tc_categoria3)
	{
	  	$consulta = "UPDATE `manto_tc_vale` SET `tc_categoria1`='$tc_categoria1',`tc_categoria2`='$tc_categoria2',`tc_categoria3`='$tc_categoria3' 	WHERE`tc_vale_id`='$tc_vale_id'";		
	  	$resultado = $this->conexion->prepare($consulta);
	  	$resultado->execute();   
		
	  	$consulta= "SELECT * FROM `manto_tc_vale` WHERE `tc_vale_id` ='$tc_vale_id'";
	  	$resultado = $this->conexion->prepare($consulta);
	  	$resultado->execute();        
	  	$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	  	print json_encode($data, JSON_UNESCAPED_UNICODE);
	  	$this->conexion=null;	
	}  		
	   
	function borrar_tc_vale_usuario($tc_vale_id)
	{
		$consulta = "DELETE FROM `manto_tc_vale` WHERE `tc_vale_id`='$tc_vale_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$this->conexion=null;	
	}
   
	function leer_tc_vale_sistema()
	{
		$tc_variable = 'SISTEMA';
		$consulta="SELECT * FROM `manto_tc_vale` WHERE `tc_variable`='$tc_variable'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);
		$this->conexion=null;
	}   
   
	function crear_tc_vale_sistema($tc_vale_id, $tc_categoria1, $tc_categoria2, $tc_categoria3)
	{
		$tc_variable = 'SISTEMA';
		$consulta = "INSERT INTO `manto_tc_vale`(`tc_variable`, `tc_categoria1`, `tc_categoria2`, `tc_categoria3`) VALUES ('$tc_variable', '$tc_categoria1','$tc_categoria2','$tc_categoria3')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
   
		$consulta = "SELECT * FROM `manto_tc_vale` WHERE `tc_variable`='$tc_variable'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);
		  
		$this->conexion=null;	
	}  	
	   
	function editar_tc_vale_sistema($tc_vale_id, $tc_categoria1, $tc_categoria2, $tc_categoria3)
	{
		$consulta = "UPDATE `manto_tc_vale` SET `tc_categoria1`='$tc_categoria1',`tc_categoria2`='$tc_categoria2',`tc_categoria3`='$tc_categoria3'WHERE`tc_vale_id`='$tc_vale_id'";	

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `manto_tc_vale` WHERE `tc_vale_id` ='$tc_vale_id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);
		$this->conexion=null;	
	}  		
	   
	function borrar_tc_vale_sistema($tc_vale_id)
	{
		$consulta = "DELETE FROM `manto_tc_vale` WHERE `tc_vale_id`='$tc_vale_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$this->conexion=null;	
	}

}