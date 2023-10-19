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

	function LeerVales($FechaInicioVales,$FechaTerminoVales)
	{
		$consulta = "SELECT `cod_vale`, IF(`va_ot`='0','',`va_ot`) AS `va_ot`, `manto_ot`.`ot_bus` AS `va_bus`, `manto_ot`.`ot_origen` AS `va_origen`, `va_asociado`, `va_responsable`, (SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`va_genera`) AS `va_genera`, DATE_FORMAT(`va_date_genera`,'%d-%m-%Y %H:%i') AS `va_date_genera`, (SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`va_cierra`) AS `va_cierra`, DATE_FORMAT(`va_date_cierra`,'%d-%m-%Y %H:%i') AS `va_date_cierra`, (SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`va_cierre_adm`) AS `va_cierre_adm`, DATE_FORMAT(`va_date_cierre_adm`,'%d-%m-%Y %H:%i') AS `va_date_cierre_adm`, `va_estado` FROM `manto_vales` LEFT JOIN `manto_ot` ON `cod_ot`=`va_ot` WHERE DATE_FORMAT(`va_date_genera`,'%Y-%m-%d')>='$FechaInicioVales' AND DATE_FORMAT(`va_date_genera`,'%Y-%m-%d')<='$FechaTerminoVales'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
   	}   

	function cargar_detalle_repuestos($cod_vale)
	{
		$consulta = "SELECT 
						`rv_id`, 
						`cod_rv`, 
						`rv_repuesto`, 
						`rv_nroserie`, 
						`rv_cantidad`, 
						`rv_precio`, 
						IF(ISNULL(`rv_descripcion`)='1',(SELECT `rep_desc` FROM `manto_repuestos` WHERE `manto_repuestos`.`cod_rep`=`manto_rep_vale`.`rv_repuesto`),`rv_descripcion`) AS `rv_descripcion`, 
						IF(ISNULL(`manto_rep_vale`.`rv_unidad_medida`)='1',(SELECT `rep_unida` FROM `manto_repuestos` WHERE `manto_rep_vale`.`rv_repuesto`=`manto_repuestos`.`cod_rep`),(SELECT `manto_unidad_medida`.`um_descripcion` FROM `manto_unidad_medida` WHERE `manto_unidad_medida`.`unidad_medida`=`manto_rep_vale`.`rv_unidad_medida`)) AS `rv_unidad`, 
						`rv_tipo` 
					FROM 
						`manto_rep_vale` 
					WHERE 
						`rv_vale`='$cod_vale'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}
	
	function generar_vales($cod_vale, $va_ot, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $va_obs_aom, $va_estado, $nombre_cierre_adm, $va_tipo, $va_ruc)
	{
        $va_cierre_adm 		= $_SESSION['USUARIO_ID'];
		$va_date_cierre_adm = date("Y-m-d H:i:s");
		$va_obs_aom 		= date_format(date_create($va_date_cierre_adm),"Y-m-d H:i")." ".$nombre_cierre_adm.": REGISTRO SISTEMA ".$va_obs_aom;
		if($va_ot==""){
			$va_ot='0';
		}
		$consulta="INSERT INTO `manto_vales`(`cod_vale`, `va_ot`, `va_genera`, `va_date_genera`, `va_asociado`, `va_responsable`, `va_cierre_adm`, `va_date_cierre_adm`, `va_garantia`, `va_obs_cgm`, `va_obs_aom`, `va_estado`, `va_tipo`, `va_ruc`) VALUES ('$cod_vale', '$va_ot', '$va_genera', '$va_date_genera', '$va_asociado', '$va_responsable', '$va_cierre_adm', '$va_date_cierre_adm', '$va_garantia', '$va_obs_cgm', '$va_obs_aom', '$va_estado', '$va_tipo', '$va_ruc')";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        
		$this->conexion=null;
	}

	function crear_detalle_repuestos($rv_vale, $rv_id, $rv_repuesto, $rv_nroserie, $rv_cantidad, $rv_precio, $rv_unidad_medida, $rv_material_id, $rv_precio_proveedor_id, $rv_moneda, $rv_precio_soles, $rv_fecha_vigencia, $rv_tipo, $rv_descripcion)
	{
		$consulta = "INSERT INTO `manto_rep_vale`(`rv_vale`, `rv_id`, `rv_repuesto`, `rv_nroserie`, `rv_cantidad`, `rv_precio`, `rv_unidad_medida`, `rv_material_id`, `rv_precio_proveedor_id`, `rv_moneda`, `rv_precio_soles`, `rv_fecha_vigencia`, `rv_tipo`, `rv_descripcion`) VALUES ('$rv_vale', '$rv_id', '$rv_repuesto', '$rv_nroserie', '$rv_cantidad', '$rv_precio', '$rv_unidad_medida', '$rv_material_id', '$rv_precio_proveedor_id', '$rv_moneda', '$rv_precio_soles', '$rv_fecha_vigencia', '$rv_tipo', '$rv_descripcion')";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$this->conexion=null;
	}

	function eliminar_detalle_repuestos($cod_rv)
	{
		$consulta="DELETE FROM `manto_rep_vale` WHERE `rv_vale`='$cod_rv'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$this->conexion=null;
	}

	function cargar_vales($cod_vale)
	{
		$consulta="SELECT `cod_vale`, `va_ot`, `manto_ot`.`ot_bus` AS `va_bus`, `manto_ot`.`ot_origen` AS `va_origen`, `va_asociado`, `va_responsable`, (SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`va_genera`) AS `va_genera`, `va_date_genera`, (SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`va_cierre_adm`) AS `va_cierre_adm`, `va_date_cierre_adm`, `va_estado`, `va_garantia`, CONCAT(`manto_ot`.`ot_origen`,' - ',`manto_ot`.`ot_descrip`) AS `va_descrip`, `va_obs_cgm`, `va_obs_aom` FROM `manto_vales` LEFT JOIN `manto_ot` ON `cod_ot`=`va_ot` WHERE `cod_vale`='$cod_vale'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}

	function editar_vales($cod_vale, $va_ot, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $tva_obs_aom, $va_obs_aom, $va_estado, $nombre_cierre_adm, $va_tipo, $va_ruc)
	{
        $va_cierre_adm 		= $_SESSION['USUARIO_ID'];
		$va_date_cierre_adm = date("Y-m-d H:i:s");
		$va_obs_aom 		= $va_estado." ".date_format(date_create($va_date_cierre_adm),"Y-m-d H:i")." ".$nombre_cierre_adm." EDITAR: ".$va_obs_aom."<br>".$tva_obs_aom;

		$consulta = "UPDATE `manto_vales` SET `va_ot`=IF('$va_ot'='','0','$va_ot'),`va_genera`='$va_genera',`va_date_genera`='$va_date_genera',`va_asociado`='$va_asociado',`va_responsable`='$va_responsable',`va_cierre_adm`='$va_cierre_adm',`va_date_cierre_adm`='$va_date_cierre_adm',`va_garantia`='$va_garantia', `va_obs_cgm`='$va_obs_cgm', `va_obs_aom`='$va_obs_aom', `va_estado`='$va_estado', `va_tipo`='$va_tipo', `va_ruc`='$va_ruc' WHERE `cod_vale`='$cod_vale'";
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

	function descargar_vales($FechaInicioVales,$FechaTerminoVales)
	{
		$consulta = "(SELECT 
						`manto_vales`.`cod_vale`, 
						`manto_vales`.`va_estado`, 
						`manto_vales`.`va_ot`, 
						`manto_vales`.`va_asociado`, 
						`manto_vales`.`va_responsable`, 
						(SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`manto_vales`.`va_genera`) AS `va_genera`,
						DATE_FORMAT(`manto_vales`.`va_date_genera`,'%Y-%m-%d') AS `va_date_genera`, 
						`manto_vales`.`va_obs_cgm`, 
						`manto_vales`.`va_garantia`,
						`manto_ot`.`ot_bus`, 
						`manto_ot`.`ot_origen`, 
						`manto_ot`.`ot_descrip`, 
						(SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`manto_vales`.`va_cierre_adm`) AS `va_cierre_adm`,
						DATE_FORMAT(`manto_vales`.`va_date_cierre_adm`,'%Y-%m-%d') AS `va_date_cierre_adm`, 
						TIME_FORMAT(`manto_vales`.`va_date_cierre_adm`,'%H:%i') AS `va_time_cierre_adm`, 
						`manto_vales`.`va_obs_aom`, 
						`manto_rep_vale`.`rv_repuesto`, 
						`manto_rep_vale`.`rv_nroserie`, 
						`manto_rep_vale`.`rv_cantidad`,
						`manto_rep_vale`.`rv_moneda`,
						ROUND(`manto_rep_vale`.`rv_precio_soles`,2) AS `rv_precio_soles`,
						`manto_rep_vale`.`rv_fecha_vigencia`,
						IF(ISNULL(`rv_descripcion`)='1',(SELECT `rep_desc` FROM `manto_repuestos` WHERE `manto_repuestos`.`cod_rep`=`manto_rep_vale`.`rv_repuesto`),`rv_descripcion`) AS `rep_desc`, 
						IF(ISNULL(`manto_rep_vale`.`rv_unidad_medida`)='1',(SELECT `rep_unida` FROM `manto_repuestos` WHERE `manto_rep_vale`.`rv_repuesto`=`manto_repuestos`.`cod_rep`),(SELECT `manto_unidad_medida`.`um_descripcion` FROM `manto_unidad_medida` WHERE `manto_unidad_medida`.`unidad_medida`=`manto_rep_vale`.`rv_unidad_medida`)) AS `rep_unidad`,
						`manto_rep_vale`.`rv_tipo`,
						ROUND((`manto_rep_vale`.`rv_cantidad`*`manto_rep_vale`.`rv_precio_soles`),2) AS `rv_subtotal`
					FROM 
						`manto_rep_vale`,
						`manto_vales`
					LEFT JOIN
						`manto_ot`
					ON
						`manto_vales`.`va_ot`=`manto_ot`.`cod_ot`
					WHERE 
						DATE_FORMAT(`manto_vales`.`va_date_genera`,'%Y-%m-%d')>='$FechaInicioVales' AND
						DATE_FORMAT(`manto_vales`.`va_date_genera`,'%Y-%m-%d')<='$FechaTerminoVales' AND
						`manto_vales`.`cod_vale` = `manto_rep_vale`.`rv_vale`
					ORDER BY
						`manto_vales`.`va_date_genera` DESC
					)
					UNION
					(SELECT
						`manto_vales`.`cod_vale`, 
						`manto_vales`.`va_estado`, 
						`manto_vales`.`va_ot`, 
						`manto_vales`.`va_asociado`, 
						`manto_vales`.`va_responsable`, 
						(SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`manto_vales`.`va_genera`) AS `va_genera`,
						DATE_FORMAT(`manto_vales`.`va_date_genera`,'%Y-%m-%d') AS `va_date_genera`, 
						`manto_vales`.`va_obs_cgm`, 
						`manto_vales`.`va_garantia`,
						`manto_ot`.`ot_bus`, 
						`manto_ot`.`ot_origen`, 
						`manto_ot`.`ot_descrip`, 
						(SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`manto_vales`.`va_cierre_adm`) AS `va_cierre_adm`, 
						DATE_FORMAT(`manto_vales`.`va_date_cierre_adm`,'%Y-%m-%d') AS `va_date_cierre_adm`, 
						TIME_FORMAT(`manto_vales`.`va_date_cierre_adm`,'%H:%i') AS `va_time_cierre_adm`, 
						`manto_vales`.`va_obs_aom`, 
						'' AS `rv_repuesto`, 
						'' AS `rv_nroserie`,
						'' AS `rv_cantidad`,
						'' AS `rv_moneda`,
						'' AS `rv_precio_soles`,
						'' AS `rv_fecha_vigencia`,
						'' AS `rep_desc`, 
						'' AS `rep_unidad`,
						'' AS `rv_tipo`,
						'' AS `rv_subtotal`
					FROM
						`manto_vales`
					LEFT JOIN
						`manto_ot`
					ON
						`manto_vales`.`va_ot`=`manto_ot`.`cod_ot`
					WHERE
						NOT EXISTS (
							SELECT 
								`manto_rep_vale`.`rv_vale`
							FROM
								`manto_rep_vale`
							WHERE
								`manto_vales`.`cod_vale`=`manto_rep_vale`.`rv_vale`) AND
								DATE_FORMAT(`manto_vales`.`va_date_genera`,'%Y-%m-%d')>='$FechaInicioVales' AND
								DATE_FORMAT(`manto_vales`.`va_date_genera`,'%Y-%m-%d')<='$FechaTerminoVales'
					ORDER BY
						`manto_vales`.`va_date_genera` DESC
					)";

		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);
   
		return $data;
		$this->conexion=null;
	}   

	function BuscarCodigoRepuesto($rv_repuesto, $va_ruc, $va_date_genera, $va_tipo){
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
						`precioprov_codproveedor`='$rv_repuesto' AND
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

	function vales_observadas()
	{

		$consulta = " SELECT COUNT(*) AS `cantidad_vales` FROM `manto_vales` WHERE `va_estado`='OBSERVADO' AND `va_date_genera`>'2022-12-31'";
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