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

	function leer_vale($fecha_inicio_listado, $fecha_termino_listado)
	{
		$consulta = "SELECT `vale_id`, IF(`va_ot_id`='0','',`va_ot_id`) AS `va_ot_id`, `manto_orden_trabajo`.`ot_bus` AS `va_bus`, `manto_orden_trabajo`.`ot_origen` AS `va_origen`, `va_asociado`, `va_responsable`, (SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`va_genera`) AS `va_genera`, DATE_FORMAT(`va_date_genera`,'%d-%m-%Y %H:%i') AS `va_date_genera`, (SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`va_cierra`) AS `va_cierra`, DATE_FORMAT(`va_date_cierra`,'%d-%m-%Y %H:%i') AS `va_date_cierra`, (SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`va_cierre_adm`) AS `va_cierre_adm`, DATE_FORMAT(`va_date_cierre_adm`,'%d-%m-%Y %H:%i') AS `va_date_cierre_adm`, `va_estado` FROM `manto_vale` LEFT JOIN `manto_orden_trabajo` ON `ot_id`=`va_ot_id` WHERE DATE_FORMAT(`va_date_genera`,'%Y-%m-%d')>='$fecha_inicio_listado' AND DATE_FORMAT(`va_date_genera`,'%Y-%m-%d')<='$fecha_termino_listado'";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
   	}   

	function generar_vale($vale_id, $va_ot_id, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $va_obs_aom, $va_estado, $nombre_cierre_adm, $va_tipo, $va_ruc)
	{
        $va_cierre_adm 		= $_SESSION['USUARIO_ID'];
		$va_date_cierre_adm = date("Y-m-d H:i:s");
		$va_obs_aom 		= date_format(date_create($va_date_cierre_adm),"Y-m-d H:i")." ".$nombre_cierre_adm.": REGISTRO SISTEMA ".$va_obs_aom;
		if($va_ot_id==""){
			$va_ot_id='0';
		}
		$consulta="INSERT INTO `manto_vale`(`vale_id`, `va_ot_id`, `va_genera`, `va_date_genera`, `va_asociado`, `va_responsable`, `va_cierre_adm`, `va_date_cierre_adm`, `va_garantia`, `va_obs_cgm`, `va_obs_aom`, `va_estado`, `va_tipo`, `va_ruc`) VALUES ('$vale_id', '$va_ot_id', '$va_genera', '$va_date_genera', '$va_asociado', '$va_responsable', '$va_cierre_adm', '$va_date_cierre_adm', '$va_garantia', '$va_obs_cgm', '$va_obs_aom', '$va_estado', '$va_tipo', '$va_ruc')";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        
		$this->conexion=null;
	}

	function cargar_vale($vale_id)
	{
		$consulta="SELECT `vale_id`, `va_ot_id`, `manto_orden_trabajo`.`ot_bus` AS `va_bus`, `manto_orden_trabajo`.`ot_origen` AS `va_origen`, `va_asociado`, `va_responsable`, (SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`va_genera`) AS `va_genera`, `va_date_genera`, (SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`va_cierre_adm`) AS `va_cierre_adm`, `va_date_cierre_adm`, `va_estado`, `va_garantia`, CONCAT(`manto_orden_trabajo`.`ot_origen`,' - ',`manto_orden_trabajo`.`ot_descrip`) AS `va_descrip`, `va_obs_cgm`, `va_obs_aom` FROM `manto_vale` LEFT JOIN `manto_orden_trabajo` ON `ot_id`=`va_ot_id` WHERE `vale_id`='$vale_id'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}

	function editar_vale($vale_id, $va_ot_id, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $tva_obs_aom, $va_obs_aom, $va_estado, $nombre_cierre_adm, $va_tipo, $va_ruc)
	{
        $va_cierre_adm 		= $_SESSION['USUARIO_ID'];
		$va_date_cierre_adm = date("Y-m-d H:i:s");
		$va_obs_aom 		= $va_estado." ".date_format(date_create($va_date_cierre_adm),"Y-m-d H:i")." ".$nombre_cierre_adm." EDITAR: ".$va_obs_aom."<br>".$tva_obs_aom;

		$consulta = "UPDATE `manto_vale` SET `va_ot_id`=IF('$va_ot_id'='','0','$va_ot_id'),`va_genera`='$va_genera',`va_date_genera`='$va_date_genera',`va_asociado`='$va_asociado',`va_responsable`='$va_responsable',`va_cierre_adm`='$va_cierre_adm',`va_date_cierre_adm`='$va_date_cierre_adm',`va_garantia`='$va_garantia', `va_obs_cgm`='$va_obs_cgm', `va_obs_aom`='$va_obs_aom', `va_estado`='$va_estado', `va_tipo`='$va_tipo', `va_ruc`='$va_ruc' WHERE `vale_id`='$vale_id'";
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
						`vr_cod_patrimonial_despacho`,
						`vr_nroserie`, 
						`vr_descripcion`,
						`vr_cantidad_requerida`, 
						`vr_cantidad_despachada`, 
						`vr_cantidad_utilizada`, 
						`vr_unidad_medida` AS `vr_unidad` 
					FROM 
						`manto_vale_repuestos` 
					WHERE 
						`vr_vale_id`='$vale_id'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}

	function crear_detalle_repuestos($vr_vale, $vr_id, $vr_repuesto, $vr_nroserie, $vr_cantidad_requerida, $vr_precio, $vr_unidad_medida, $vr_material_id, $vr_precio_proveedor_id, $vr_moneda, $vr_precio_soles, $vr_fecha_vigencia, $vr_tipo, $vr_descripcion)
	{
		$consulta = "INSERT INTO `manto_vale_repuestos`(`vr_vale`, `vr_id`, `vr_repuesto`, `vr_nroserie`, `vr_cantidad_requerida`, `vr_precio`, `vr_unidad_medida`, `vr_material_id`, `vr_precio_proveedor_id`, `vr_moneda`, `vr_precio_soles`, `vr_fecha_vigencia`, `vr_tipo`, `vr_descripcion`) VALUES ('$vr_vale', '$vr_id', '$vr_repuesto', '$vr_nroserie', '$vr_cantidad_requerida', '$vr_precio', '$vr_unidad_medida', '$vr_material_id', '$vr_precio_proveedor_id', '$vr_moneda', '$vr_precio_soles', '$vr_fecha_vigencia', '$vr_tipo', '$vr_descripcion')";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$this->conexion=null;
	}

	function eliminar_detalle_repuestos($cod_rv)
	{
		$consulta="DELETE FROM `manto_vale_repuestos` WHERE `vr_vale`='$cod_rv'";

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

	function leer_novedades($prov_ruc, $fecha_inicio, $fecha_termino)
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
							CONCAT(`manto_novedad_operacion`.`nope_accion`,'-',`manto_novedad_operacion`.`nope_componente`,'-',`manto_novedad_operacion`.`nope_posicion`,'-',`manto_novedad_operacion`.`nope_falla`) AS `ot_accion`,
							`OPE_Novedad`.`Nove_Operacion` AS `operacion`,
							`OPE_Novedad`.`Nove_Bus` AS `bus`,
							`manto_novedad_operacion`.`nope_componente` AS `componente`,
							`manto_novedad_operacion`.`nope_posicion` AS `posicion`,
							`manto_novedad_operacion`.`nope_falla` AS `falla`,
							`manto_novedad_operacion`.`nope_accion` AS `accion`,
							CONCAT(SUBSTRING(`manto_novedad_ot`.`not_ot_tipo`,1,1),'-',SUBSTRING(CONCAT('00000000',`manto_novedad_ot`.`not_ot_id`),-8)) AS `ot_id`,
							IF(`manto_novedad_ot`.`not_estado` IS NULL,'PENDIENTE',`manto_novedad_ot`.`not_estado`) AS `ot_estado`
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
							CONCAT(`manto_novedad_operacion`.`nope_accion`,'-',`manto_novedad_operacion`.`nope_componente`,'-',`manto_novedad_operacion`.`nope_posicion`,'-',`manto_novedad_operacion`.`nope_falla`) AS `ot_accion`,
							`OPE_AccidentesInformePreliminar`.`Acci_Operacion` AS `operacion`,
							`OPE_AccidentesInformePreliminar`.`Acci_Bus` AS `bus`,
							`manto_novedad_operacion`.`nope_componente` AS `componente`,
							`manto_novedad_operacion`.`nope_posicion` AS `posicion`,
							`manto_novedad_operacion`.`nope_falla` AS `falla`,
							`manto_novedad_operacion`.`nope_accion` AS `accion`,
							CONCAT(SUBSTRING(`manto_novedad_ot`.`not_ot_tipo`,1,1),'-',SUBSTRING(CONCAT('00000000',`manto_novedad_ot`.`not_ot_id`),-8)) AS `ot_id`,
							IF(`manto_novedad_ot`.`not_estado` IS NULL,'PENDIENTE',`manto_novedad_ot`.`not_estado`) AS `ot_estado`
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
						    CONCAT(`manto_inspeccion_movimiento`.`insp_accion`,'-',`manto_inspeccion_movimiento`.`insp_componente`,'-',`manto_inspeccion_movimiento`.`insp_posicion`,'-',`manto_inspeccion_movimiento`.`insp_falla`) AS `ot_accion`,
							`Buses`.`Bus_Operacion` AS `operacion`,
						    `manto_inspeccion_movimiento`.`insp_bus` AS `bus`,
						    `manto_inspeccion_movimiento`.`insp_componente` AS `componente`,
						    `manto_inspeccion_movimiento`.`insp_posicion` AS `posicion`,
						    `manto_inspeccion_movimiento`.`insp_falla` AS `falla`,
						    `manto_inspeccion_movimiento`.`insp_accion` AS `accion`,
							CONCAT(SUBSTRING(`manto_novedad_ot`.`not_ot_tipo`,1,1),'-',SUBSTRING(CONCAT('00000000',`manto_novedad_ot`.`not_ot_id`),-8)) AS `ot_id`,
							IF(`manto_novedad_ot`.`not_estado` IS NULL,'PENDIENTE',`manto_novedad_ot`.`not_estado`) AS `ot_estado`
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
							CONCAT(`manto_check_list_observaciones`.`chl_accion`,'-',`manto_check_list_observaciones`.`chl_componente`,'-',`manto_check_list_observaciones`.`chl_posicion`,'-',`manto_check_list_observaciones`.`chl_falla`) AS `ot_accion`,
    						`Buses`.`Bus_Operacion` AS `operacion`,
    						`manto_check_list_registro`.`chl_bus` AS `bus`,
							`manto_check_list_observaciones`.`chl_componente` AS `componente`,
    						`manto_check_list_observaciones`.`chl_posicion` AS `posicion`,
    						`manto_check_list_observaciones`.`chl_falla` AS `falla`,
    						`manto_check_list_observaciones`.`chl_accion` AS `accion`,
							CONCAT(SUBSTRING(`manto_novedad_ot`.`not_ot_tipo`,1,1),'-',SUBSTRING(CONCAT('00000000',`manto_novedad_ot`.`not_ot_id`),-8)) AS `ot_id`,
							IF(`manto_novedad_ot`.`not_estado` IS NULL,'PENDIENTE',`manto_novedad_ot`.`not_estado`) AS `ot_estado`
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
							AND `manto_novedad_ot`.`not_origen_novedad`='INSPECCION OPERACIONES'
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
							CONCAT(`manto_novedad_regular`.`nreg_accion`,'-',`manto_novedad_regular`.`nreg_componente`,'-',`manto_novedad_regular`.`nreg_posicion`,'-',`manto_novedad_regular`.`nreg_falla`) AS `ot_accion`,
    						`manto_novedad_regular`.`nreg_operacion` AS `operacion`,
    						`manto_novedad_regular`.`nreg_bus` AS `bus`,
    						`manto_novedad_regular`.`nreg_componente` AS `componente`,
    						`manto_novedad_regular`.`nreg_posicion` AS `posicion`,
    						`manto_novedad_regular`.`nreg_falla` AS `falla`,
    						`manto_novedad_regular`.`nreg_accion` AS `accion`,
							CONCAT(SUBSTRING(`manto_novedad_ot`.`not_ot_tipo`,1,1),'-',SUBSTRING(CONCAT('00000000',`manto_novedad_ot`.`not_ot_id`),-8)) AS `ot_id`,
							IF(`manto_novedad_ot`.`not_estado` IS NULL,'PENDIENTE',`manto_novedad_ot`.`not_estado`) AS `ot_estado`
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