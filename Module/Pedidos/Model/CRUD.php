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

	function SelectTipos($ttablapedidos_operacion,$ttablapedidos_tipo)
	{
		$consulta="SELECT `manto_tipotablapedidos`.`ttablapedidos_detalle` AS `Detalle` FROM `manto_tipotablapedidos` WHERE `manto_tipotablapedidos`.`ttablapedidos_operacion` = '$ttablapedidos_operacion' AND `manto_tipotablapedidos`.`ttablapedidos_tipo`= '$ttablapedidos_tipo' ORDER BY `Detalle` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function select_roles($roles_perfil)
	{
		$consulta="SELECT `glo_roles`.`roles_nombrecorto` AS `nombre_corto` FROM `glo_roles` WHERE `glo_roles`.`roles_perfil` = '$roles_perfil' ORDER BY `nombre_corto` ASC";

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

	function buses_pedido()
	{
		$consulta = "SELECT `Bus_NroExterno` AS `Buses` FROM `Buses` ORDER BY `Buses` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;

		$this->conexion=null;
   	}   

	function auto_completar_tipo($nombre_tabla, $nombre_campo, $nombre_tipo)
	{
		$consulta="SELECT * FROM `$nombre_tabla` WHERE `material_tipo`='$nombre_tipo'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function select_proveedor()
	{
        $consulta="SELECT * FROM `manto_proveedores`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        return $data;
        $this->conexion=null;
   	}   

	function leer_pedido($FechaInicioPedidos,$FechaTerminoPedidos)
	{
		$consulta = "SELECT `manto_pedidos`.`pedido_id`, `manto_pedidos`.`pedi_fechacreacion`, `manto_pedidos`.`pedi_fecharequerimiento`, `manto_pedidos`.`pedi_prioridad`, `manto_pedidos`.`pedi_centrocosto`, `manto_pedidos`.`pedi_proceso`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`manto_pedidos`.`pedi_contacto_id` LIMIT 1) AS `pedi_nombre_contacto`, `manto_pedidos`.`pedi_direccion_entrega`, `manto_pedidos`.`pedi_tipo`, `manto_pedidos`.`pedi_orden_compra_directa`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`manto_pedidos`.`pedi_responsable` LIMIT 1) AS `pedi_responsable`, `manto_pedidos`.`pedi_cotizacionid`, `manto_pedidos`.`pedi_ordencompraid`, `manto_pedidos`.`pedi_estado`, `manto_pedidos`.`pedi_log`, `pedi_estado_obs` FROM `manto_pedidos` WHERE DATE_FORMAT(`pedi_fechacreacion`,'%Y-%m-%d')>='$FechaInicioPedidos' AND DATE_FORMAT(`pedi_fechacreacion`,'%Y-%m-%d')<='$FechaTerminoPedidos'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
   	}   

	function cargar_material_pedido($pedido_id)
	{
		$consulta="SELECT `manto_materialespedidos`.`mp_materialid`, `manto_materialespedidos`.`mp_unidadmedida`, `manto_materialespedidos`.`mp_cantidad`, `manto_materialespedidos`.`mp_bus`, `manto_materialespedidos`.`mp_observaciones`, `manto_materiales`.`material_descripcion` AS `mp_descripcion` FROM `manto_materialespedidos` LEFT JOIN `manto_materiales` ON `manto_materiales`.`material_id`=`manto_materialespedidos`.`mp_materialid` WHERE `mp_pedidoid`='$pedido_id'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}

	function generar_pedido($pedido_id, $pedi_fechacreacion, $pedi_fecharequerimiento, $pedi_prioridad, $pedi_centrocosto, $pedi_proceso, $pedi_contacto_id, $pedi_direccion_entrega, $pedi_orden_compra_directa, $pedi_tipo, $pedi_responsable, $pedi_estado, $pedi_log)
	{
		$consulta="INSERT INTO `manto_pedidos`(`pedi_fechacreacion`, `pedi_fecharequerimiento`, `pedi_prioridad`, `pedi_centrocosto`, `pedi_proceso`, `pedi_contacto_id`, `pedi_direccion_entrega`, `pedi_orden_compra_directa`, `pedi_tipo`, `pedi_responsable`, `pedi_estado`, `pedi_log`) VALUES ('$pedi_fechacreacion', '$pedi_fecharequerimiento', '$pedi_prioridad', '$pedi_centrocosto', '$pedi_proceso', '$pedi_contacto_id', '$pedi_direccion_entrega', '$pedi_orden_compra_directa', '$pedi_tipo', '$pedi_responsable', '$pedi_estado', '$pedi_log')";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        
		$consulta = "SELECT * FROM manto_pedidos ORDER BY pedido_id DESC LIMIT 1";
		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function estado_pedido($pedido_id, $pedi_estado, $pedi_log, $pedi_estado_obs)
	{
		$consulta="UPDATE `manto_pedidos` SET `pedi_estado`='$pedi_estado', `pedi_log`='$pedi_log', `pedi_estado_obs`='$pedi_estado_obs' WHERE `pedido_id`='$pedido_id'";
		if($pedi_estado=="EN COTIZACION"){
			$pedi_cotizacionid = "1";
			$consulta="UPDATE `manto_pedidos` SET `pedi_estado`='$pedi_estado', `pedi_log`='$pedi_log', `pedi_cotizacionid`='$pedi_cotizacionid', `pedi_estado_obs`='$pedi_estado_obs' WHERE `pedido_id`='$pedido_id'";
		}
		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();

		$this->conexion=null;
	}

	function crear_material_pedido($mp_pedidoid, $mp_materialid, $mp_unidadmedida, $mp_cantidad, $mp_bus, $mp_observaciones)
	{
		$consulta="INSERT INTO `manto_materialespedidos` (`mp_pedidoid`, `mp_materialid`, `mp_unidadmedida`, `mp_cantidad`, `mp_bus`, `mp_observaciones`) VALUES ('$mp_pedidoid','$mp_materialid','$mp_unidadmedida','$mp_cantidad','$mp_bus','$mp_observaciones')";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$this->conexion=null;
	}

	function eliminar_material_pedido($mp_pedidoid)
	{
		$consulta="DELETE FROM `manto_materialespedidos` WHERE `mp_pedidoid`='$mp_pedidoid'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$this->conexion=null;
	}

	function cargar_pedido($pedido_id)
	{
		$consulta="SELECT `manto_pedidos`.`pedido_id`, `manto_pedidos`.`pedi_fechacreacion`, `manto_pedidos`.`pedi_fecharequerimiento`, `manto_pedidos`.`pedi_prioridad`, `manto_pedidos`.`pedi_centrocosto`, `manto_pedidos`.`pedi_proceso`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`manto_pedidos`.`pedi_contacto_id` LIMIT 1) AS `pedi_nombre_contacto`, `manto_pedidos`.`pedi_direccion_entrega`, `manto_pedidos`.`pedi_tipo`, `manto_pedidos`.`pedi_orden_compra_directa`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`manto_pedidos`.`pedi_responsable` LIMIT 1) AS `pedi_responsable`, `manto_pedidos`.`pedi_cotizacionid`, `manto_pedidos`.`pedi_ordencompraid`, `manto_pedidos`.`pedi_estado`, `manto_pedidos`.`pedi_log` FROM `manto_pedidos` WHERE `pedido_id`='$pedido_id'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}

	function editar_pedido($pedido_id, $pedi_fechacreacion, $pedi_fecharequerimiento, $pedi_prioridad, $pedi_bus, $pedi_centrocosto, $pedi_ordcompdirecta, $pedi_log, $pedi_estado)
	{
		$consulta = "UPDATE `manto_pedidos` SET `pedi_fechacreacion` = '$pedi_fechacreacion', `pedi_fecharequerimiento` = '$pedi_fecharequerimiento', `pedi_prioridad` = '$pedi_prioridad', `pedi_bus` = '$pedi_bus', `pedi_centrocosto` = '$pedi_centrocosto', `pedi_ordcompdirecta` = '$pedi_ordcompdirecta', `pedi_log` = '$pedi_log', `pedi_estado` = '$pedi_estado' WHERE `pedido_id`='$pedido_id'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        
		$consulta = "SELECT `manto_pedidos`.`pedido_id`, `manto_pedidos`.`pedi_fechacreacion`, `manto_pedidos`.`pedi_fecharequerimiento`, `manto_pedidos`.`pedi_prioridad`, `manto_pedidos`.`pedi_bus`, `manto_pedidos`.`pedi_centrocosto`, `manto_pedidos`.`pedi_ordcompdirecta`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`manto_pedidos`.`pedi_responsable` LIMIT 1) AS `pedi_responsable`, `manto_pedidos`.`pedi_cotizacionid`, `manto_pedidos`.`pedi_ordencompraid`, `manto_pedidos`.`pedi_estado`, `manto_pedidos`.`pedi_log` FROM `manto_pedidos` WHERE `manto_pedidos`.`pedido_id`='$pedido_id'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}

	function cargar_cotizacion($coti_pedidoid)
	{
		$consulta="SELECT `manto_cotizaciones`.`cotizacion_id`, `manto_cotizaciones`.`coti_fecha`, `manto_cotizaciones`.`coti_razonsocial`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`manto_cotizaciones`.`coti_responsable` LIMIT 1) AS `coti_responsable`, `manto_cotizaciones`.`coti_estado` FROM `manto_cotizaciones` WHERE `manto_cotizaciones`.`coti_pedidoid`='$coti_pedidoid'";
   
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
   
		$this->conexion=null;
	}

	function cargar_material_cotizacion($cotizacion_id)
	{
		$consulta="SELECT `manto_materialescotizaciones`.`mc_materialid`, `manto_materialescotizaciones`.`mc_unidadmedida`, `manto_materialescotizaciones`.`mc_cantidad`, `manto_materialescotizaciones`.`mc_preciocotizacion`, ROUND((`manto_materialescotizaciones`.`mc_cantidad_cotizacion`*`manto_materialescotizaciones`.`mc_preciocotizacion`),2) AS `mc_totalprecio`, `manto_materialescotizaciones`.`mc_cantidad_cotizacion`, `manto_materiales`.`material_descripcion` AS `mc_descripcion` FROM `manto_materialescotizaciones` LEFT JOIN `manto_materiales` ON `manto_materiales`.`material_id`=`manto_materialescotizaciones`.`mc_materialid` WHERE `mc_cotizacionid`='$cotizacion_id'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}

	function guardar_cotizacion($coti_pedidoid, $coti_fecha, $coti_ruc, $coti_razonsocial, $coti_responsable, $coti_estado, $coti_log)
	{
		$consulta="INSERT INTO `manto_cotizaciones`	(`coti_fecha`, `coti_pedidoid`, `coti_ruc`, `coti_razonsocial`, `coti_responsable`, `coti_estado`, `coti_log`) VALUES ('$coti_fecha', '$coti_pedidoid', '$coti_ruc', '$coti_razonsocial', '$coti_responsable', '$coti_estado', '$coti_log')";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        
		$consulta = "SELECT * FROM manto_cotizaciones ORDER BY cotizacion_id DESC LIMIT 1";
		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function crear_material_cotizacion($mc_cotizacionid, $mc_materialid, $mc_unidadmedida, $mc_cantidad, $mc_cantidad_cotizacion, $mc_cantidad_solicitada, $mc_precioprovid, $mc_codproveedor, $mc_moneda, $mc_precio, $mc_preciosoles, $mc_fechavigencia, $mc_observaciones)
	{
		$mc_seleccion = "NO";
		
		$consulta = "INSERT INTO `manto_materialescotizaciones` (`mc_cotizacionid`, `mc_materialid`, `mc_unidadmedida`, `mc_cantidad`, `mc_cantidad_cotizacion`, `mc_cantidad_solicitada`,`mc_precioprovid`, `mc_codproveedor`, `mc_moneda`, `mc_precio`, `mc_preciosoles`, `mc_fechavigencia`, `mc_observaciones`, `mc_seleccion`) VALUES ('$mc_cotizacionid', '$mc_materialid', '$mc_unidadmedida', '$mc_cantidad',  '$mc_cantidad_cotizacion', '$mc_cantidad_solicitada', '$mc_precioprovid', '$mc_codproveedor', '$mc_moneda', '$mc_precio', '$mc_preciosoles', IF('$mc_fechavigencia'='',null,'$mc_fechavigencia'), '$mc_observaciones', '$mc_seleccion')";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$this->conexion=null;
	}

	function precio_vigente($coti_ruc, $mc_materialid, $coti_fecha)
	{
		$consulta = "SELECT * FROM `manto_preciosproveedor` WHERE `precioprov_ruc` = '$coti_ruc' AND `precioprov_materialid` = '$mc_materialid' AND `precioprov_fechavigencia` <= '$coti_fecha' ORDER BY `precioprov_fechavigencia` DESC LIMIT 1";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function ver_cotizacion($pedido_id, $coti_estado)
	{
		$where_coti_estado = "";
		if($coti_estado!=""){
			$where_coti_estado = "AND `manto_cotizaciones`.`coti_estado`='$coti_estado'";
		}

		$consulta = "SELECT `manto_cotizaciones`.`coti_pedidoid` AS `tmc_pedidoid`, `manto_cotizaciones`.`cotizacion_id` AS `tmc_cotizacionid`, `manto_cotizaciones`.`coti_razonsocial` AS `tmc_razonsocial`, `manto_materialescotizaciones`.`mc_materialid` AS `tmc_materialid`, `manto_materiales`.`material_descripcion` AS `tmc_descripcion`, `manto_materialescotizaciones`.`mc_unidadmedida` AS `tmc_unidadmedida`, `manto_materialescotizaciones`.`mc_cantidad` AS `tmc_cantidad`, `manto_materialescotizaciones`.`mc_moneda` AS `tmc_moneda`, `manto_materialescotizaciones`.`mc_preciosoles` AS `tmc_preciosoles`, `manto_materialescotizaciones`.`mc_fechavigencia` AS `tmc_fechavigencia`, `manto_materialescotizaciones`.`mc_cantidad_cotizacion` AS `tmc_cantidad_cotizacion`, `manto_materialescotizaciones`.`mc_cantidad_solicitada` AS `tmc_cantidad_solicitada`, `manto_materialescotizaciones`.`mc_preciocotizacion` AS `tmc_preciocotizacion`, ROUND( (`manto_materialescotizaciones`.`mc_cantidad_solicitada` * `manto_materialescotizaciones`.`mc_preciocotizacion`),'2' ) AS `tmc_subtotal_precio`, `manto_materialescotizaciones`.`mc_seleccion` AS `tmc_seleccion`, CONCAT('CODIGO: ',`manto_materialescotizaciones`.`mc_materialid`,' - DESCRIPCION: ',`manto_materiales`.`material_descripcion`,' - CANTIDAD PEDIDO: ',`manto_materialescotizaciones`.`mc_cantidad`) AS `grupo_material` FROM `manto_cotizaciones` LEFT JOIN `manto_materialescotizaciones` ON `manto_cotizaciones`.`cotizacion_id`=`manto_materialescotizaciones`.`mc_cotizacionid` LEFT JOIN `manto_proveedores` ON `manto_proveedores`.`prov_ruc` = `manto_cotizaciones`.`coti_ruc` LEFT JOIN `manto_materiales` ON `manto_materiales`.`material_id`=`manto_materialescotizaciones`.`mc_materialid` WHERE `manto_cotizaciones`.`coti_pedidoid`='$pedido_id' ".$where_coti_estado;

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);
   
		$this->conexion=null;
	}

	function cotizacion_pdf_head($cotizacion_id)
	{
		$consulta = "SELECT *, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni` = `manto_cotizaciones`.`coti_responsable` LIMIT 1 ) AS `usuario` FROM `manto_cotizaciones` LEFT JOIN `manto_proveedores` ON `manto_proveedores`.`prov_ruc` = `manto_cotizaciones`.`coti_ruc` WHERE `manto_cotizaciones`.`cotizacion_id` = '$cotizacion_id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function cotizacion_pdf_body($cotizacion_id)
	{
		$consulta = "SELECT * FROM `manto_materialescotizaciones` LEFT JOIN `manto_materiales` ON `manto_materiales`.`material_id` = `manto_materialescotizaciones`.`mc_materialid` WHERE `manto_materialescotizaciones`.`mc_cotizacionid` = '$cotizacion_id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function editar_cotizacion($cotizacion_id, $coti_log1, $coti_estado)
	{
		$consulta = "UPDATE `manto_cotizaciones` SET `coti_log` = '$coti_log1', `coti_estado` = '$coti_estado' WHERE `cotizacion_id`='$cotizacion_id'";
		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        

		$this->conexion=null;
	}

	function editar_material_cotizacion($mc_cotizacionid, $mc_materialid, $mc_preciocotizacion, $mc_cantidad_cotizacion)
	{
		$consulta = "UPDATE `manto_materialescotizaciones` SET `mc_preciocotizacion` = '$mc_preciocotizacion', `mc_cantidad_cotizacion` = '$mc_cantidad_cotizacion' WHERE `mc_cotizacionid`='$mc_cotizacionid' AND `mc_materialid` = '$mc_materialid'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        

		$this->conexion=null;
	}

	function editar_cantidad_solicitada($mc_cotizacionid, $mc_materialid, $mc_cantidad_solicitada, $mc_seleccion)
	{
		$consulta = "UPDATE `manto_materialescotizaciones` SET `mc_cantidad_solicitada` = '$mc_cantidad_solicitada', `mc_seleccion` = '$mc_seleccion' WHERE `mc_cotizacionid`='$mc_cotizacionid' AND `mc_materialid` = '$mc_materialid'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        

		$this->conexion=null;
	}

	function generar_orden_compra($orco_fecha, $orco_pedidoid, $orco_cotizacionid, $orco_ruc, $orco_razonsocial, $orco_subtotal, $orco_igv, $orco_total, $orco_responsable, $orco_estado, $orco_log)
	{
		$consulta = "INSERT INTO `manto_ordencompra` (`orco_fecha`, `orco_pedidoid`, `orco_cotizacionid`, `orco_ruc`, `orco_razonsocial`, `orco_subtotal`, `orco_igv`, `orco_total`, `orco_responsable`, `orco_estado`, `orco_log`) VALUES ('$orco_fecha', '$orco_pedidoid', '$orco_cotizacionid', '$orco_ruc', '$orco_razonsocial', '$orco_subtotal', '$orco_igv', '$orco_total', '$orco_responsable', '$orco_estado', '$orco_log')";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();

		$consulta = "SELECT * FROM `manto_ordencompra` ORDER BY `manto_ordencompra`.`ordencompra_id` DESC LIMIT 1";
		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function crear_material_orden_compra($moc_orden_compra_id, $moc_cotizacion_id, $moc_pedido_id, $moc_material_id, $moc_unidad_medida, $moc_cantidad, $moc_moneda, $moc_precio_soles, $moc_observaciones)
	{
		$consulta = "INSERT INTO `manto_material_orden_compra` (`moc_orden_compra_id`, `moc_cotizacion_id`, `moc_pedido_id`, `moc_material_id`, `moc_unidad_medida`, `moc_cantidad`, `moc_moneda`, `moc_precio_soles`, `moc_observaciones`) VALUES ('$moc_orden_compra_id', '$moc_cotizacion_id', '$moc_pedido_id', '$moc_material_id', '$moc_unidad_medida', '$moc_cantidad', '$moc_moneda', '$moc_precio_soles', '$moc_observaciones')";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();

		$this->conexion=null;
	}

	function editar_pedido_orden_compra($orco_pedidoid, $pedi_ordencompraid, $pedi_estado, $pedi_estado_obs, $pedi_log)
	{
		$consulta = "UPDATE `manto_pedidos` SET `pedi_ordencompraid` = '$pedi_ordencompraid', `pedi_estado` = '$pedi_estado', `pedi_estado_obs` = '$pedi_estado_obs', `pedi_log` = '$pedi_log'  WHERE `pedido_id`='$orco_pedidoid'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        

		$this->conexion=null;
	}

	function leer_orden_compra($orco_pedidoid)
	{
		$consulta = "SELECT `ordencompra_id`, `orco_fecha`, `orco_pedidoid`, `orco_cotizacionid`, `orco_ruc`, `orco_razonsocial`, FORMAT(`orco_subtotal`,2) AS `orco_subtotal`, FORMAT(`orco_igv`,2) AS `orco_igv`, FORMAT(`orco_total`,2) AS `orco_total`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`manto_ordencompra`.`orco_responsable` LIMIT 1) AS `orco_responsable`, `orco_estado`, `orco_log`, `pedi_centrocosto` AS `orco_centrocosto`, `pedi_prioridad` AS `orco_prioridad` FROM `manto_ordencompra` LEFT JOIN `manto_pedidos` ON `manto_pedidos`.`pedido_id` = `manto_ordencompra`.`orco_pedidoid` WHERE `orco_pedidoid`='$orco_pedidoid'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
   	}   

	function cargar_material_orden_compra($ordencompra_id)
	{
		$consulta = "SELECT `moc_orden_compra_id`, `moc_material_id`, `manto_materiales`.`material_descripcion` AS `moc_descripcion`, `moc_unidad_medida`, `moc_cantidad`, `moc_moneda`, `moc_precio_soles`, FORMAT((`moc_cantidad`*`moc_precio_soles`),2) AS `moc_precio_total`, `moc_observaciones` FROM `manto_material_orden_compra` LEFT JOIN `manto_materiales` ON `manto_materiales`.`material_id`=`manto_material_orden_compra`.`moc_material_id` WHERE `moc_orden_compra_id`='$ordencompra_id'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
   	}   

	function estado_orden_compra($ordencompra_id, $orco_estado, $orco_log)
	{
		$consulta="UPDATE `manto_ordencompra` SET `orco_estado`='$orco_estado', `orco_log`='$orco_log' WHERE `ordencompra_id`='$ordencompra_id'";
		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();

		$this->conexion=null;
	}

	function orden_compra_pdf_head($ordencompra_id)
	{
		$consulta = "SELECT *, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni` = `manto_ordencompra`.`orco_responsable` LIMIT 1 ) AS `usuario` FROM `manto_ordencompra` LEFT JOIN `manto_proveedores` ON `manto_proveedores`.`prov_ruc`=`manto_ordencompra`.`orco_ruc` WHERE `manto_ordencompra`.`ordencompra_id` = '$ordencompra_id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function orden_compra_pdf_body($ordencompra_id)
	{
		$consulta = "SELECT *, ROUND((`moc_cantidad`*`moc_precio_soles`),2) AS `moc_precio_total` FROM `manto_material_orden_compra` LEFT JOIN `manto_materiales` ON `manto_materiales`.`material_id` = `manto_material_orden_compra`.`moc_material_id` WHERE `manto_material_orden_compra`.`moc_orden_compra_id` = '$ordencompra_id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function grabar_imagen($cotimag_cotizacionid, $cotimag_ruc, $cotimag_tipoimagen, $cotimag_imagen, $cotimag_usuarioid, $cotimag_fecha, $cotimag_log)
	{
		$consulta="INSERT INTO `manto_cotizacionesimagen`(`cotimag_cotizacionid`, `cotimag_ruc`, `cotimag_tipoimagen`, `cotimag_imagen`, `cotimag_usuarioid`, `cotimag_fecha`, `cotimag_log`) VALUES ('$cotimag_cotizacionid', '$cotimag_ruc', '$cotimag_tipoimagen', '$cotimag_imagen', '$cotimag_usuarioid', '$cotimag_fecha', '$cotimag_log')";

		$resultado = $this->conexion->prepare($consulta);
 		$resultado->execute();
 		$this->conexion=null;
 	}

	function editar_imagen($cotimag_cotizacionid, $cotimag_ruc, $cotimag_tipoimagen, $cotimag_imagen, $cotimag_log)
	{
		$consulta="UPDATE `manto_cotizacionesimagen` SET `cotimag_imagen` = '$cotimag_imagen', `cotimag_log` = '$cotimag_log' WHERE `cotimag_cotizacionid`='$cotimag_cotizacionid' AND `cotimag_ruc`='$cotimag_ruc' AND `cotimag_tipoimagen`='$cotimag_tipoimagen'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
 		$this->conexion=null;
	}
 
	function buscar_imagen($cotimag_cotizacionid, $cotimag_ruc, $cotimag_tipoimagen)
	{
		$consulta="SELECT TO_BASE64 (`cotimag_imagen`) AS `b64_Foto` FROM `manto_cotizacionesimagen` WHERE `cotimag_cotizacionid`='$cotimag_cotizacionid' AND `cotimag_ruc`='$cotimag_ruc' AND `cotimag_tipoimagen`='$cotimag_tipoimagen'";

		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   
  		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

  		$this->conexion=null;	
	}  		

	function buscar_log_imagen($cotimag_cotizacionid, $cotimag_ruc, $cotimag_tipoimagen)
	{
		$consulta="SELECT `cotimag_log` FROM `manto_cotizacionesimagen` WHERE `cotimag_cotizacionid`='$cotimag_cotizacionid' AND `cotimag_ruc`='$cotimag_ruc' AND `cotimag_tipoimagen`='$cotimag_tipoimagen'";
		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   
  		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
  		$this->conexion=null;	
	}  		

	function buscar_material_id($mp_materialid)
	{
		$consulta 	= "SELECT `material_descripcion`, `material_macrosistema`, `material_sistema`, `material_tarjeta`, `material_condicion`, `material_flota`, `material_patrimonial`, `material_categoria`, CONCAT(`material_unidadmedida`,' - ',`um_descripcion`) AS `material_unidadmedida`, `material_tipo` FROM `manto_materiales` LEFT JOIN `manto_unidad_medida` ON `manto_unidad_medida`.`unidad_medida`=`manto_materiales`.`material_unidadmedida` WHERE `material_id`='$mp_materialid'";

		$resultado 	= $this->conexion->prepare($consulta);
  		$resultado->execute();   
  		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);
  		
		return $data;
  		$this->conexion=null;	
	}  		

}