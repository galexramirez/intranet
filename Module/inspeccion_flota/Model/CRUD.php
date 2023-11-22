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

	function BuscarDataBD($TablaBD,$CampoBD,$DataBuscar)
	{
		$consulta="SELECT * FROM `$TablaBD` WHERE `$CampoBD` = '$DataBuscar'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function buscar_data_bd($tabla, $c_where)
	{
		$consulta  ="SELECT * FROM `$tabla` WHERE ".$c_where;
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

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

	function select_codigo_inspeccion($insp_bus_tipo)
	{
		$consulta = "SELECT * FROM `manto_inspeccion_codigo` WHERE `insp_bus_tipo`='$insp_bus_tipo' ORDER BY `insp_codigo` ";

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

	function AutoCompletar($NombreTabla, $NombreCampo, $va_ruc, $va_date_genera, $va_tipo)
	{
		$consulta = "SELECT DISTINCT `$NombreTabla`.`$NombreCampo`, `$NombreTabla`.`precioprov_descripcion` FROM `$NombreTabla` WHERE `precioprov_ruc`='$va_ruc' AND `precioprov_fechavigencia`<='$va_date_genera' AND `precioprov_tipo`='$va_tipo'";
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

	function max_id($tabla_bd, $campo_id)
	{
		$max_id = '0';
		$consulta = "SELECT MAX(`$campo_id`) AS `max_id` FROM `$tabla_bd`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($data as $row){
			$max_id = $row['max_id']; 
		}
		return $max_id;
		$this->conexion=null;
	}

	function contar_tabla($tabla_bd)
	{
		$contar = '0';
		$consulta="SELECT COUNT(*) AS `contar` FROM `$tabla_bd` ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach($data as $row){
			$contar = $row['contar']; 
		}
		return $contar;
		$this->conexion=null;
	}

	function buscar_inspeccion($fecha_inicio, $fecha_termino)
	{
		$consulta = " 	SELECT  `manto_inspeccion_registro`.`inspeccion_id`,
								`manto_inspeccion_registro`.`insp_fecha_programada`,
								`manto_inspeccion_registro`.`insp_bus_tipo`,
								`manto_inspeccion_registro`.`insp_seleccion_buses`,
								(SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id` = `manto_inspeccion_registro`.`insp_usuario_id_genera`) AS `insp_nombres_genera`,
								`manto_inspeccion_registro`.`insp_fecha_genera`,
								(SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id` = `manto_inspeccion_registro`.`insp_usuario_id_cierre`) AS `insp_nombres_cierre`,
								`manto_inspeccion_registro`.`insp_fecha_cierre`,
								`manto_inspeccion_registro`.`insp_estado`
						FROM `manto_inspeccion_registro` 
						WHERE 	`manto_inspeccion_registro`.`insp_fecha_programada`>='$fecha_inicio' AND 
								`manto_inspeccion_registro`.`insp_fecha_programada`<='$fecha_termino' 
						ORDER BY `manto_inspeccion_registro`.`insp_fecha_programada`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function crear_inspeccion($insp_fecha_programada, $insp_bus_tipo,  $insp_seleccion_buses,  $insp_usuario_id_genera, $insp_fecha_genera, $insp_estado, $insp_log)
	{
		$last_insert_id = '0';
		$consulta = " INSERT INTO `manto_inspeccion_registro` (`insp_fecha_programada`, `insp_bus_tipo`, `insp_seleccion_buses`, `insp_usuario_id_genera`, `insp_fecha_genera`, `insp_estado`, `insp_log`) VALUES ('$insp_fecha_programada', '$insp_bus_tipo', '$insp_seleccion_buses', '$insp_usuario_id_genera', '$insp_fecha_genera', '$insp_estado', '$insp_log') ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$consulta = " SELECT LAST_INSERT_ID() ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach($data as $row){
			$last_insert_id = $row['LAST_INSERT_ID()']; 
		}
		return $last_insert_id;

		$this->conexion=null;
	}

	function crear_inspeccion_detalle($inspeccion_id, $insp_bus, $insp_detalle_estado )
	{
		$consulta = " INSERT INTO `manto_inspeccion_detalle` (`inspeccion_id`, `insp_bus`, `insp_detalle_estado`) VALUES ('$inspeccion_id', '$insp_bus', '$insp_detalle_estado')";
 		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function cerrar_inspeccion($inspeccion_id, $insp_fecha_registro, $insp_estado, $insp_log, $insp_usuario_id )
	{
		$consulta = " UPDATE `manto_inspeccion_registro` SET `insp_fecha_cierre`='$insp_fecha_registro', `insp_usuario_id_cierre`='$insp_usuario_id', `insp_estado`='$insp_estado', `insp_log`='$insp_log' WHERE `inspeccion_id`='$inspeccion_id'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function anular_inspeccion($inspeccion_id, $insp_fecha_registro, $insp_estado, $insp_log, $insp_usuario_id )
	{
		$consulta = " UPDATE `manto_inspeccion_registro` SET `insp_fecha_cierre`='$insp_fecha_registro', `insp_usuario_id_cierre`='$insp_usuario_id', `insp_estado`='$insp_estado', `insp_log`='$insp_log' WHERE `inspeccion_id`='$inspeccion_id'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function buscar_inspeccion_codigo($insp_bus_tipo)
	{
		$consulta = " SELECT  * FROM `manto_inspeccion_codigo` WHERE `manto_inspeccion_codigo`.`insp_bus_tipo`='$insp_bus_tipo' ORDER BY `manto_inspeccion_codigo`.`insp_orden`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function bus_inspeccion_codigo($insp_bus_tipo)
	{
		$consulta = " SELECT  * FROM `manto_inspeccion_codigo` WHERE `manto_inspeccion_codigo`.`insp_bus_tipo`='$insp_bus_tipo' ORDER BY `manto_inspeccion_codigo`.`insp_orden`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function crear_inspeccion_codigo($insp_bus_tipo, $insp_orden, $insp_codigo, $insp_descripcion)
	{
		$consulta = " INSERT INTO `manto_inspeccion_codigo` (`insp_bus_tipo`, `insp_orden`, `insp_codigo`, `insp_descripcion`) VALUES ('$insp_bus_tipo', '$insp_orden', '$insp_codigo', '$insp_descripcion') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function editar_inspeccion_codigo($inspeccion_codigo_id, $insp_bus_tipo, $insp_orden, $insp_codigo, $insp_descripcion)
	{
		$consulta = " UPDATE `manto_inspeccion_codigo` SET `insp_bus_tipo` = '$insp_bus_tipo', `insp_orden` = '$insp_orden', `insp_codigo` = '$insp_codigo', `insp_descripcion` = '$insp_descripcion' WHERE `inspeccion_codigo_id` = '$inspeccion_codigo_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function borrar_inspeccion_codigo($insp_bus_tipo, $insp_codigo)
	{
		$consulta = " DELETE FROM `manto_inspeccion_codigo` WHERE `insp_bus_tipo` = '$insp_bus_tipo' AND `insp_codigo` = '$insp_codigo' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$consulta = " DELETE FROM `manto_inspeccion_componente` WHERE `insp_bus_tipo` = '$insp_bus_tipo' AND `insp_codigo` = '$insp_codigo' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$consulta = " DELETE FROM `manto_inspeccion_falla_accion` WHERE `insp_bus_tipo` = '$insp_bus_tipo' AND `insp_codigo` = '$insp_codigo' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$consulta = " DELETE FROM `manto_inspeccion_posicion` WHERE `insp_bus_tipo` = '$insp_bus_tipo' AND `insp_codigo` = '$insp_codigo' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function buscar_inspeccion_componente($insp_bus_tipo, $insp_codigo)
	{
		$where_codigo = "";
		if($insp_codigo!=""){
			$where_codigo = "AND `manto_inspeccion_componente`.`insp_codigo` = '$insp_codigo'";
		}
		$consulta = " SELECT  `manto_inspeccion_componente`.`inspeccion_componente_id`,	`manto_inspeccion_componente`.`insp_bus_tipo`, `manto_inspeccion_componente`.`insp_codigo`, `manto_inspeccion_codigo`.`insp_descripcion`, `manto_inspeccion_componente`.`insp_componente` FROM `manto_inspeccion_componente` LEFT JOIN `manto_inspeccion_codigo` ON `manto_inspeccion_codigo`.`insp_codigo`=`manto_inspeccion_componente`.`insp_codigo` AND `manto_inspeccion_codigo`.`insp_bus_tipo`=`manto_inspeccion_componente`.`insp_bus_tipo` WHERE `manto_inspeccion_componente`.`insp_bus_tipo`='$insp_bus_tipo' ".$where_codigo." ORDER BY `manto_inspeccion_componente`.`inspeccion_componente_id`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function crear_inspeccion_componente($insp_bus_tipo, $insp_codigo, $insp_componente)
	{
		$consulta = " INSERT INTO `manto_inspeccion_componente` (`insp_bus_tipo`, `insp_codigo`, `insp_componente`) VALUES ('$insp_bus_tipo', '$insp_codigo', '$insp_componente') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function editar_inspeccion_componente($inspeccion_componente_id, $insp_bus_tipo, $insp_codigo, $insp_componente)
	{
		$consulta = " UPDATE `manto_inspeccion_componente` SET `insp_bus_tipo` = '$insp_bus_tipo', `insp_codigo` = '$insp_codigo', `insp_componente` = '$insp_componente' WHERE `inspeccion_componente_id` = '$inspeccion_componente_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function borrar_inspeccion_componente($insp_bus_tipo, $insp_codigo ,$insp_componente)
	{
		$consulta = " DELETE FROM `manto_inspeccion_componente` WHERE `insp_bus_tipo` = '$insp_bus_tipo' AND `insp_codigo` = '$insp_codigo' AND `insp_componente` = '$insp_componente' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$consulta = " DELETE FROM `manto_inspeccion_falla_accion` WHERE `insp_bus_tipo` = '$insp_bus_tipo' AND `insp_codigo` = '$insp_codigo'  AND `insp_componente` = '$insp_componente' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$consulta = " DELETE FROM `manto_inspeccion_posicion` WHERE `insp_bus_tipo` = '$insp_bus_tipo' AND `insp_codigo` = '$insp_codigo'  AND `insp_componente` = '$insp_componente' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function buscar_inspeccion_falla_accion($insp_bus_tipo, $insp_codigo, $insp_componente)
	{
		$where_componente = "";
		if($insp_componente!=""){
			$where_componente = "AND `manto_inspeccion_falla_accion`.`insp_componente` = '$insp_componente'";
		}
		$consulta = " SELECT  `manto_inspeccion_falla_accion`.`inspeccion_falla_accion_id`,	`manto_inspeccion_falla_accion`.`insp_bus_tipo`, `manto_inspeccion_falla_accion`.`insp_codigo`, `manto_inspeccion_codigo`.`insp_descripcion`, `manto_inspeccion_falla_accion`.`insp_componente`, `manto_inspeccion_falla_accion`.`insp_falla`, `manto_inspeccion_falla_accion`.`insp_accion` FROM `manto_inspeccion_falla_accion` LEFT JOIN `manto_inspeccion_codigo` ON `manto_inspeccion_codigo`.`insp_codigo`=`manto_inspeccion_falla_accion`.`insp_codigo` AND `manto_inspeccion_codigo`.`insp_bus_tipo`=`manto_inspeccion_falla_accion`.`insp_bus_tipo` WHERE `manto_inspeccion_falla_accion`.`insp_bus_tipo`='$insp_bus_tipo' AND `manto_inspeccion_falla_accion`.`insp_codigo`='$insp_codigo' ".$where_componente." ORDER BY `manto_inspeccion_falla_accion`.`inspeccion_falla_accion_id`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function crear_inspeccion_falla_accion($insp_bus_tipo, $insp_codigo, $insp_componente, $insp_falla, $insp_accion)
	{
		$consulta = " INSERT INTO `manto_inspeccion_falla_accion` (`insp_bus_tipo`, `insp_codigo`, `insp_componente`, `insp_falla`, `insp_accion`) VALUES ('$insp_bus_tipo', '$insp_codigo', '$insp_componente', '$insp_falla', '$insp_accion') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function editar_inspeccion_falla_accion($inspeccion_falla_accion_id, $insp_bus_tipo, $insp_codigo, $insp_componente, $insp_falla, $insp_accion)
	{
		$consulta = " UPDATE `manto_inspeccion_falla_accion` SET `insp_bus_tipo` = '$insp_bus_tipo', `insp_codigo` = '$insp_codigo', `insp_componente` = '$insp_componente', `insp_falla` = '$insp_falla', `insp_accion` = '$insp_accion' WHERE `inspeccion_falla_accion_id` = '$inspeccion_falla_accion_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function borrar_inspeccion_falla_accion($inspeccion_falla_accion_id)
	{
		$consulta = " DELETE FROM `manto_inspeccion_falla_accion` WHERE `inspeccion_falla_accion_id` = '$inspeccion_falla_accion_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function buscar_inspeccion_posicion($insp_bus_tipo, $insp_codigo, $insp_componente){
		$where_componente = "";
		if($insp_componente!=""){
			$where_componente = "AND `manto_inspeccion_posicion`.`insp_componente` = '$insp_componente'";
		}

		$consulta = " SELECT  `manto_inspeccion_posicion`.`inspeccion_posicion_id`, `manto_inspeccion_posicion`.`insp_bus_tipo`, `manto_inspeccion_posicion`.`insp_codigo`, `manto_inspeccion_codigo`.`insp_descripcion`, `manto_inspeccion_posicion`.`insp_componente`, `manto_inspeccion_posicion`.`insp_posicion` FROM `manto_inspeccion_posicion` LEFT JOIN `manto_inspeccion_codigo` ON `manto_inspeccion_codigo`.`insp_codigo`=`manto_inspeccion_posicion`.`insp_codigo` AND `manto_inspeccion_codigo`.`insp_bus_tipo`=`manto_inspeccion_posicion`.`insp_bus_tipo` WHERE `manto_inspeccion_posicion`.`insp_bus_tipo`='$insp_bus_tipo'  AND `manto_inspeccion_posicion`.`insp_codigo`='$insp_codigo' ".$where_componente." ORDER BY `manto_inspeccion_posicion`.`inspeccion_posicion_id`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function crear_inspeccion_posicion($insp_bus_tipo, $insp_codigo, $insp_componente, $insp_posicion)
	{
		$consulta = " INSERT INTO `manto_inspeccion_posicion` (`insp_bus_tipo`, `insp_codigo`, `insp_componente`, `insp_posicion`) VALUES ('$insp_bus_tipo', '$insp_codigo', '$insp_componente', '$insp_posicion') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function editar_inspeccion_posicion($inspeccion_posicion_id, $insp_bus_tipo, $insp_codigo, $insp_componente, $insp_posicion)
	{
		$consulta = " UPDATE `manto_inspeccion_posicion` SET `insp_bus_tipo` = '$insp_bus_tipo', `insp_codigo` = '$insp_codigo', `insp_componente` = '$insp_componente', `insp_posicion` = '$insp_posicion' WHERE `inspeccion_posicion_id` = '$inspeccion_posicion_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function borrar_inspeccion_posicion($inspeccion_posicion_id)
	{
		$consulta = " DELETE FROM `manto_inspeccion_posicion` WHERE `inspeccion_posicion_id` = '$inspeccion_posicion_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function guardar_inspeccion_bus($inspeccion_id, $insp_bus, $insp_codigo, $insp_descripcion, $insp_estado_codigo )
	{
		$consulta = " INSERT INTO `manto_inspeccion_bus` (`inspeccion_id`, `insp_bus`, `insp_codigo`, `insp_descripcion`, `insp_estado_codigo`) VALUES ('$inspeccion_id', '$insp_bus', '$insp_codigo', '$insp_descripcion', '$insp_estado_codigo') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function editar_inspeccion_detalle($inspeccion_id, $insp_usuario_id, $insp_fecha_detalle, $insp_bus, $insp_detalle_estado)
	{
		$consulta = " UPDATE `manto_inspeccion_detalle` SET `insp_colaborador_id`='$insp_usuario_id', `insp_fecha_detalle`='$insp_fecha_detalle', `insp_detalle_estado`='$insp_detalle_estado' WHERE `inspeccion_id` = '$inspeccion_id' AND `insp_bus`='$insp_bus' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function guardar_inspeccion_movimiento($inspeccion_id, $insp_bus_tipo, $insp_bus, $insp_codigo, $insp_descripcion, $insp_componente, $insp_posicion, $insp_falla, $insp_accion,	$insp_fecha, $insp_usuario_id)
	{
		$insp_movimiento_estado = 'ACTIVO';
		$consulta = " INSERT INTO `manto_inspeccion_movimiento`	(`inspeccion_id`, `insp_bus_tipo`, `insp_bus`, `insp_codigo`, `insp_descripcion`, `insp_componente`, `insp_posicion`, `insp_falla`, `insp_accion`, `insp_fecha`, `insp_usuario_id`, `insp_movimiento_estado`) VALUES ('$inspeccion_id', '$insp_bus_tipo', '$insp_bus', '$insp_codigo', '$insp_descripcion', '$insp_componente', '$insp_posicion', '$insp_falla', '$insp_accion', '$insp_fecha', '$insp_usuario_id', '$insp_movimiento_estado') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function anular_falla($inspeccion_movimiento_id)
	{
		$insp_fecha_anula = date('Y-m-d H:i:s');
		$insp_usuario_id_anula = $_SESSION['USUARIO_ID'];
		$insp_movimiento_estado = 'ANULADO';

		$consulta = " UPDATE `manto_inspeccion_movimiento` SET `insp_fecha_anula`='$insp_fecha_anula', `insp_usuario_id_anula`='$insp_usuario_id_anula', `insp_movimiento_estado`='$insp_movimiento_estado' WHERE `inspeccion_movimiento_id`='$inspeccion_movimiento_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function buscar_reporte($fecha_inicio, $fecha_termino)
	{
		$consulta = " SELECT
						`manto_inspeccion_detalle`.`inspeccion_id`,
						`colaborador`.`Colab_nombre_corto`,
						`manto_inspeccion_detalle`.`insp_fecha_detalle`,
						`manto_inspeccion_detalle`.`insp_bus`,
						`manto_inspeccion_detalle`.`insp_detalle_estado`
					FROM `manto_inspeccion_detalle`
					LEFT JOIN `colaborador`
					ON `colaborador`.`Colaborador_id`=`manto_inspeccion_detalle`.`insp_colaborador_id`
					WHERE DATE_FORMAT(`insp_fecha_detalle`,'%Y-%m-%d')>='$fecha_inicio' AND DATE_FORMAT(`insp_fecha_detalle`,'%Y-%m-%d')<='$fecha_termino' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function buscar_reporte_bus($inspeccion_id, $inspeccion_bus)
	{
		$where_bus = "";
		if($inspeccion_bus!=""){
			$where_bus = "AND `manto_inspeccion_detalle`.`insp_bus`='".$inspeccion_bus."'";
		}

		$consulta = " SELECT 
						`manto_inspeccion_detalle`.`inspeccion_id`,
						`colaborador`.`Colab_nombre_corto`,
						`manto_inspeccion_detalle`.`insp_fecha_detalle`,
						`manto_inspeccion_detalle`.`insp_bus`,
						`manto_inspeccion_detalle`.`insp_detalle_estado`,
						`manto_inspeccion_bus`.`insp_codigo`,
						`manto_inspeccion_bus`.`insp_descripcion`,
						`manto_inspeccion_bus`.`insp_estado_codigo`
					FROM `manto_inspeccion_detalle`
					LEFT JOIN `colaborador`
					ON `colaborador`.`Colaborador_id`=`manto_inspeccion_detalle`.`insp_colaborador_id`
					LEFT JOIN `manto_inspeccion_bus`
					ON `manto_inspeccion_bus`.`inspeccion_id`=`manto_inspeccion_detalle`.`inspeccion_id` AND `manto_inspeccion_bus`.`insp_bus`=`manto_inspeccion_detalle`.`insp_bus`
					WHERE `manto_inspeccion_detalle`.`inspeccion_id`='$inspeccion_id' ".$where_bus;

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function buscar_falla($fecha_inicio, $fecha_termino)
	{
		$consulta = " SELECT 
						CONCAT('F-',`manto_inspeccion_movimiento`.`inspeccion_movimiento_id`) AS `inspeccion_movimiento_id`,
						`manto_inspeccion_movimiento`.`inspeccion_id`,
						`manto_inspeccion_movimiento`.`insp_movimiento_estado`,
						`manto_inspeccion_movimiento`.`insp_bus_tipo`,
						`manto_inspeccion_movimiento`.`insp_bus`,
						`manto_inspeccion_movimiento`.`insp_codigo`,
						`manto_inspeccion_codigo`.`insp_descripcion`,
						`manto_inspeccion_movimiento`.`insp_componente`,
						`manto_inspeccion_movimiento`.`insp_posicion`,
						`manto_inspeccion_movimiento`.`insp_falla`,
						`manto_inspeccion_movimiento`.`insp_accion`,
						`manto_inspeccion_movimiento`.`insp_fecha`,
						`colaborador`.`Colab_nombre_corto` AS `insp_usuario_registra`,
						`manto_inspeccion_movimiento`.`insp_fecha_anula`,
						(SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`manto_inspeccion_movimiento`.`insp_usuario_id_anula`) AS `insp_usuario_anula`
					FROM `manto_inspeccion_movimiento`
					LEFT JOIN `colaborador`
					ON `colaborador`.`Colaborador_id`=`manto_inspeccion_movimiento`.`insp_usuario_id`
					LEFT JOIN `manto_inspeccion_codigo`
					ON `manto_inspeccion_codigo`.`insp_bus_tipo`=`manto_inspeccion_movimiento`.`insp_bus_tipo` 
					AND `manto_inspeccion_codigo`.`insp_codigo`=`manto_inspeccion_movimiento`.`insp_codigo`
					WHERE DATE_FORMAT(`manto_inspeccion_movimiento`.`insp_fecha`,'%Y-%m-%d')>='$fecha_inicio' 
					AND DATE_FORMAT(`manto_inspeccion_movimiento`.`insp_fecha`,'%Y-%m-%d')<='$fecha_termino'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function descargar_arbol($insp_bus_tipo)
	{
		$consulta = " 	SELECT 
							`manto_inspeccion_codigo`.`insp_bus_tipo`,
							`manto_inspeccion_codigo`.`insp_orden`,
							`manto_inspeccion_codigo`.`insp_codigo`,
							`manto_inspeccion_codigo`.`insp_descripcion`,
							`manto_inspeccion_componente`.`insp_componente`,
							`manto_inspeccion_posicion`.`insp_posicion`,
							`manto_inspeccion_falla_accion`.`insp_falla`,
							`manto_inspeccion_falla_accion`.`insp_accion`
						FROM `manto_inspeccion_codigo`
						LEFT JOIN `manto_inspeccion_componente`
						ON `manto_inspeccion_componente`.`insp_bus_tipo`=`manto_inspeccion_codigo`.`insp_bus_tipo`
						AND `manto_inspeccion_componente`.`insp_codigo`=`manto_inspeccion_codigo`.`insp_codigo`
						LEFT JOIN `manto_inspeccion_posicion`
						ON `manto_inspeccion_posicion`.`insp_bus_tipo`=`manto_inspeccion_codigo`.`insp_bus_tipo`
						AND `manto_inspeccion_posicion`.`insp_codigo`=`manto_inspeccion_codigo`.`insp_codigo`
						AND `manto_inspeccion_posicion`.`insp_componente`=`manto_inspeccion_componente`.`insp_componente`
						LEFT JOIN `manto_inspeccion_falla_accion`
						ON `manto_inspeccion_falla_accion`.`insp_bus_tipo`=`manto_inspeccion_codigo`.`insp_bus_tipo`
						AND `manto_inspeccion_falla_accion`.`insp_codigo`=`manto_inspeccion_codigo`.`insp_codigo`
						AND `manto_inspeccion_falla_accion`.`insp_componente`=`manto_inspeccion_componente`.`insp_componente`
						WHERE `manto_inspeccion_codigo`.`insp_bus_tipo`='$insp_bus_tipo' 
						ORDER BY `manto_inspeccion_codigo`.`insp_codigo` ASC ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function leer_tc_inspeccion_usuario()
	{
		$tc_variable = 'USUARIO';
        $consulta="SELECT * FROM `manto_tc_inspeccion` WHERE `tc_variable`='$tc_variable'";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;
   	}   

	function crear_tc_inspeccion_usuario($tc_inspeccion_id, $tc_ficha, $tc_categoria1, $tc_categoria2)
	{
	   	$tc_variable = 'USUARIO';
		$consulta = "INSERT INTO `manto_tc_inspeccion`(`tc_variable`, `tc_ficha`, `tc_categoria1`, `tc_categoria2`) VALUES ('$tc_variable', '$tc_ficha','$tc_categoria1','$tc_categoria2')";
	   	$resultado = $this->conexion->prepare($consulta);
	   	$resultado->execute();   

	   	$consulta = "SELECT * FROM `manto_tc_inspeccion` WHERE `tc_variable`='$tc_variable'";
	   	$resultado = $this->conexion->prepare($consulta);
	   	$resultado->execute();        
	   	$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	   	print json_encode($data, JSON_UNESCAPED_UNICODE);
	   	
		$this->conexion=null;	
	}  	
	
	function editar_tc_inspeccion_usuario($tc_inspeccion_id, $tc_ficha, $tc_categoria1, $tc_categoria2)
	{
	   $consulta = "UPDATE `manto_tc_inspeccion` SET `tc_ficha`='$tc_ficha',`tc_categoria1`='$tc_categoria1',`tc_categoria2`='$tc_categoria2' WHERE`tc_inspeccion_id`='$tc_inspeccion_id'";		
	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();   

	   $consulta= "SELECT * FROM `manto_tc_inspeccion` WHERE `tc_inspeccion_id` ='$tc_inspeccion_id'";
	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();        
	   $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	   print json_encode($data, JSON_UNESCAPED_UNICODE);
	   $this->conexion=null;	
	}  		
	
	function borrar_tc_inspeccion_usuario($tc_inspeccion_id)
	{
		$consulta = "DELETE FROM `manto_tc_inspeccion` WHERE `tc_inspeccion_id`='$tc_inspeccion_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$this->conexion=null;	
	}

	function leer_tc_inspeccion_sistema()
	{
        $tc_variable = 'SISTEMA';
		$consulta="SELECT * FROM `manto_tc_inspeccion` WHERE `tc_variable`='$tc_variable'";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;
   	}   

	function crear_tc_inspeccion_sistema($tc_inspeccion_id, $tc_ficha, $tc_categoria1, $tc_categoria2)
	{
		$tc_variable = 'SISTEMA';
	   	$consulta = "INSERT INTO `manto_tc_inspeccion`(`tc_variable`, `tc_ficha`, `tc_categoria1`, `tc_categoria2`) VALUES ('$tc_variable', '$tc_ficha','$tc_categoria1','$tc_categoria2')";
	   	$resultado = $this->conexion->prepare($consulta);
	   	$resultado->execute();   

	   	$consulta = "SELECT * FROM `manto_tc_inspeccion` WHERE `tc_variable`='$tc_variable'";
	   	$resultado = $this->conexion->prepare($consulta);
	   	$resultado->execute();        
	   	$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	   	print json_encode($data, JSON_UNESCAPED_UNICODE);
	   	
		$this->conexion=null;	
	}  	
	
	function editar_tc_inspeccion_sistema($tc_inspeccion_id, $tc_ficha, $tc_categoria1, $tc_categoria2)
	{
	   $consulta = "UPDATE `manto_tc_inspeccion` SET `tc_ficha`='$tc_ficha',`tc_categoria1`='$tc_categoria1',`tc_categoria2`='$tc_categoria2' WHERE`tc_inspeccion_id`='$tc_inspeccion_id'";	

	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();   

	   $consulta= "SELECT * FROM `manto_tc_inspeccion` WHERE `tc_inspeccion_id` ='$tc_inspeccion_id'";
	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();        
	   $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	   print json_encode($data, JSON_UNESCAPED_UNICODE);
	   $this->conexion=null;	
	}  		
	
	function borrar_tc_inspeccion_sistema($tc_inspeccion_id)
	{
		$consulta = "DELETE FROM `manto_tc_inspeccion` WHERE `tc_inspeccion_id`='$tc_inspeccion_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$this->conexion=null;	
	}

}