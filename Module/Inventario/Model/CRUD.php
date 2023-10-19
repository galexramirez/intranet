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

	function SelectTipos($tc_operacion,$tc_tipo)
	{
		$consulta="SELECT `manto_tc_inventario`.`tcin_detalle` AS `Detalle` FROM `manto_tc_inventario` WHERE `manto_tc_inventario`.`tcin_operacion` = '$tc_operacion' AND `manto_tc_inventario`.`tcin_tipo`= '$tc_tipo' ORDER BY `Detalle` ASC";

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

	function AutoCompletar($NombreTabla,$NombreCampo)
	{
		$consulta="SELECT * FROM `$NombreTabla`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function select_almacen()
	{
		$consulta="SELECT `manto_almacen`.`alm_descripcion` AS `Detalle` FROM `manto_almacen` ORDER BY `Detalle` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function leer_inventario_registro($fecha_inicio_movimiento,$fecha_termino_movimiento)
	{
		$consulta = "SELECT *, (SELECT `roles_nombrecorto` FROM `glo_roles` WHERE `roles_dni` = `invr_usuario_id` LIMIT 1) AS `invr_usuario_nombre`, `alm_descripcion` AS `invr_almacen_descripcion` FROM `manto_inventario_registro` LEFT JOIN `manto_almacen` ON `almacen_id` = `invr_almacen_id` WHERE `invr_fecha_creacion`>='$fecha_inicio_movimiento' AND `invr_fecha_creacion`<='$fecha_termino_movimiento'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function cargar_materiales_entrada($entrada_id)
	{
		$consulta = "SELECT `invm_material_id` AS `entm_material_id`, `invm_material_descripcion` AS `entm_descripcion`, `invm_unidad_medida` AS `entm_unidad_medida`, `invm_cantidad` AS `entm_cantidad`,  `invm_moneda` AS `entm_moneda`, `invm_precio` AS `entm_precio`,  `invm_precio_soles` AS `entm_precio_soles`,`invm_material_patrimonial` AS `entm_patrimonial` FROM `manto_inventario_movimiento` WHERE `inventario_movimiento_id`='$entrada_id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function leer_almacen()
	{
		$consulta = "SELECT *, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni` = `manto_almacen`.`alm_responsable` LIMIT 1) AS `alm_nombre_responsable` FROM `manto_almacen`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function crear_almacen($almacen_id, $alm_fecha_creacion, $alm_descripcion, $alm_ubicacion, $alm_dimensiones, $alm_nombre_responsable, $alm_estado)
	{
		$alm_fecha = date("d-m-Y H:i:s");
		$alm_responsable = $_SESSION['USUARIO_ID'];
		$alm_log = "<strong>".$alm_estado."</strong> ".$alm_fecha." ".$alm_nombre_responsable." CREACIÓN ";
		$consulta = "INSERT INTO `BDLIMABUS`.`manto_almacen` (`alm_fecha_creacion`, `alm_descripcion`, `alm_ubicacion`, `alm_dimensiones`, `alm_responsable`, `alm_estado`, `alm_log`) VALUES ('$alm_fecha_creacion', '$alm_descripcion', '$alm_ubicacion', '$alm_dimensiones', '$alm_responsable', '$alm_estado', '$alm_log')";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function editar_almacen($almacen_id, $alm_fecha_creacion, $alm_descripcion, $alm_ubicacion, $alm_dimensiones, $alm_responsable, $alm_estado, $alm_log)
	{
		$consulta = "UPDATE `BDLIMABUS`.`manto_almacen` SET `alm_fecha_creacion` = '$alm_fecha_creacion', `alm_descripcion` = '$alm_descripcion', `alm_ubicacion` = '$alm_ubicacion', `alm_dimensiones` = '$alm_dimensiones', `alm_responsable` = '$alm_responsable', `alm_estado` = '$alm_estado', `alm_log` = '$alm_log' WHERE `almacen_id` = '$almacen_id'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function precio_vigente_actualizado($material_id)
	{
		$fecha_actual = date("Y-m-d");
		$consulta = "SELECT * FROM `manto_preciosproveedor` WHERE `precioprov_materialid`='$material_id' AND `precioprov_fechavigencia`<='$fecha_actual' ORDER BY `precioprov_fechavigencia` DESC LIMIT 1";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;

	}

	function leer_material_almacen($malm_descripcion_almacen){
		$malm_almacen_id = "";
		$consulta = "SELECT * FROM `manto_almacen` WHERE `manto_almacen`.`alm_descripcion` = '$malm_descripcion_almacen'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		foreach($data as $row){
			$malm_almacen_id = $row['almacen_id'];
		}

		$consulta = "SELECT `material_almacen_id`, `malm_material_id`, `manto_materiales`.`material_descripcion` AS `malm_descripcion_material`, `manto_almacen`.`alm_descripcion` AS `malm_descripcion_almacen`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`manto_material_almacen`.`malm_usuario_id` LIMIT 1) AS `malm_responsable`, `malm_fecha` FROM `manto_material_almacen` LEFT JOIN `manto_materiales` ON `manto_materiales`.`material_id`=`manto_material_almacen`.`malm_material_id` LEFT JOIN `manto_almacen` ON `manto_almacen`.`almacen_id`=`manto_material_almacen`.`malm_almacen_id` WHERE `manto_material_almacen`.`malm_almacen_id`='$malm_almacen_id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;

	}	

	function importar_materiales_entrada($nro_documento)
	{
		$consulta = "SELECT 
		`manto_pedidos`.`pedi_centrocosto` AS `ent_centro_costo`, 
		`manto_materialescotizaciones`.`mc_materialid` AS `entm_material_id`, 
		`manto_materiales`.`material_descripcion` AS `entm_descripcion`,
		`manto_materialescotizaciones`.`mc_unidadmedida` AS `entm_unidad_medida`,
		`manto_materialescotizaciones`.`mc_cantidad` AS `entm_cantidad`,
		`manto_materialescotizaciones`.`mc_moneda` AS `entm_moneda`,
		`manto_materialescotizaciones`.`mc_precio` AS `entm_precio`,
		`manto_materialescotizaciones`.`mc_preciosoles` AS `entm_precio_soles`,
		`manto_materiales`.`material_patrimonial` AS `entm_patrimonial`
		FROM `manto_ordencompra` 
		LEFT JOIN `manto_pedidos` ON `manto_pedidos`.`pedido_id`=`manto_ordencompra`.`orco_pedidoid` 
		LEFT JOIN `manto_materialescotizaciones` ON `manto_materialescotizaciones`.`mc_cotizacionid`=`manto_ordencompra`.`orco_cotizacionid` 
		LEFT JOIN `manto_materiales` ON `manto_materiales`.`material_id`=`manto_materialescotizaciones`.`mc_materialid`
		WHERE `manto_ordencompra`.`ordencompra_id`='$nro_documento'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;

	}

	function crear_entrada_inventario($invr_fecha_creacion, $invr_almacen_id, $invr_movimiento, $invr_tipo_movimiento, $invr_tipo_documento, $invr_nro_documento, $invr_nombre_entrega, $invr_centro_costo, $invr_usuario_id, $invr_campo_1, $invr_campo_2, $invr_campo_3, $invr_estado, $invr_log)
	{
		$consulta = "INSERT INTO `manto_inventario_registro` (`invr_fecha_creacion`, `invr_almacen_id`, `invr_movimiento`, `invr_tipo_movimiento`, `invr_tipo_documento`, `invr_nro_documento`, `invr_nombre_entrega`, `invr_centro_costo`, `invr_usuario_id`, `invr_campo_1`, `invr_campo_2`, `invr_campo_3`, `invr_estado`, `invr_log`) VALUES ('$invr_fecha_creacion', '$invr_almacen_id', '$invr_movimiento', '$invr_tipo_movimiento', '$invr_tipo_documento', '$invr_nro_documento', '$invr_nombre_entrega', '$invr_centro_costo', '$invr_usuario_id', '$invr_campo_1', '$invr_campo_2', '$invr_campo_3', '$invr_estado', '$invr_log')";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function crear_movimiento_entrada_inventario( $invm_inventario_registro_id, $invm_fecha_creacion, $invm_almacen_id, $invm_movimiento, $invm_tipo_movimiento, $invm_tipo_documento, $invm_nro_documento, $invm_centro_costo, $invm_material_id, $invm_material_descripcion, $invm_material_patrimonial, $invn_unidad_medida, $invm_cantidad, $invm_moneda, $invm_precio, $invm_precio_soles, $invm_campo_1, $invm_campo_2, $invm_campo_3, $invm_estado )
	{
		$consulta = "INSERT INTO `manto_inventario_movimiento` (`inventario_movimiento_id`, `invm_inventario_registro_id`, `invm_fecha_creacion`, `invm_almacen_id`, `invm_movimiento`, `invm_tipo_movimiento`, `invm_tipo_documento`, `invm_nro_documento`, `invm_centro_costo`, `invm_material_id`, `invm_material_descripcion`, `invm_material_patrimonial`, `invn_unidad_medida`, `invm_cantidad`, `invm_moneda`, `invm_precio`, `invm_precio_soles`, `invm_campo_1`, `invm_campo_2`, `invm_campo_3`, `invm_estado`) VALUES ( '$invm_inventario_registro_id', '$invm_fecha_creacion', '$invm_almacen_id', '$invm_movimiento', '$invm_tipo_movimiento', '$invm_tipo_documento', '$invm_nro_documento', '$invm_centro_costo', '$invm_material_id', '$invm_material_descripcion', '$invm_material_patrimonial', '$invn_unidad_medida', '$invm_cantidad', '$invm_moneda', '$invm_precio', '$invm_precio_soles', '$invm_campo_1', '$invm_campo_2', '$invm_campo_3', '$invm_estado' ) ";
echo $consulta;		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}
}