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

	function select_codigo_check_list($chl_bus_tipo)
	{
		$consulta = "SELECT * FROM `manto_check_list_codigo` WHERE `chl_bus_tipo`='$chl_bus_tipo' ORDER BY `chl_orden` ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;   
		$this->conexion=null;
	}

	function select_codigo_falla_via($fav_bus_tipo)
	{
		$consulta = "SELECT * FROM `manto_falla_via_codigo` WHERE `fav_bus_tipo`='$fav_bus_tipo' ORDER BY `fav_orden` ";

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

	function buscar_check_list($fecha_inicio, $fecha_termino)
	{
		$consulta = " 	SELECT  `manto_check_list_registro`.`check_list_id`,
								`manto_check_list_registro`.`chl_fecha`,
								`manto_check_list_registro`.`chl_bus`,
								`manto_check_list_registro`.`chl_kilometraje`,
								`colaborador`.`Colab_nombre_corto` AS `chl_usuario_nombre_genera`,
								`manto_check_list_registro`.`chl_fecha_genera`,
								`manto_check_list_registro`.`chl_nombre_piloto`,
								`manto_check_list_registro`.`chl_estado`
						FROM `manto_check_list_registro` 
						LEFT JOIN `colaborador`
						ON `colaborador`.`Colaborador_id` = `manto_check_list_registro`.`chl_usuario_id_genera`
						WHERE 	`manto_check_list_registro`.`chl_fecha`>='$fecha_inicio' AND 
								`manto_check_list_registro`.`chl_fecha`<='$fecha_termino' 
						ORDER BY `manto_check_list_registro`.`check_list_id`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function buscar_check_list_observaciones($check_list_id)
	{
		$consulta = " SELECT * FROM `manto_check_list_observaciones` WHERE `check_list_id`='$check_list_id' ORDER BY `check_list_id`, `chl_codigo`, `chl_componente`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);
		
		$this->conexion=null;
	}

	function buscar_check_list_falla_via($check_list_id)
	{
		$consulta = " SELECT * FROM `manto_check_list_falla_via` WHERE `check_list_id`='$check_list_id' ORDER BY `check_list_id`, `fav_codigo`, `fav_componente`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);
		
		$this->conexion=null;
	}

	function buscar_check_list_codigo($chl_bus_tipo)
	{
		$consulta = " SELECT  * FROM `manto_check_list_codigo` WHERE `manto_check_list_codigo`.`chl_bus_tipo`='$chl_bus_tipo' ORDER BY `manto_check_list_codigo`.`chl_orden`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function crear_check_list_codigo($chl_bus_tipo, $chl_orden, $chl_codigo, $chl_descripcion)
	{
		$consulta = " INSERT INTO `manto_check_list_codigo` (`chl_bus_tipo`, `chl_orden`, `chl_codigo`, `chl_descripcion`) VALUES ('$chl_bus_tipo', '$chl_orden', '$chl_codigo', '$chl_descripcion') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function editar_check_list_codigo($check_list_codigo_id, $chl_bus_tipo, $chl_orden, $chl_codigo, $chl_descripcion)
	{
		$consulta = " UPDATE `manto_check_list_codigo` SET `chl_bus_tipo` = '$chl_bus_tipo', `chl_orden` = '$chl_orden', `chl_codigo` = '$chl_codigo', `chl_descripcion` = '$chl_descripcion' WHERE `check_list_codigo_id` = '$check_list_codigo_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function borrar_check_list_codigo($chl_bus_tipo, $chl_codigo)
	{
		$consulta = " DELETE FROM `manto_check_list_codigo` WHERE `chl_bus_tipo` = '$chl_bus_tipo' AND `chl_codigo` = '$chl_codigo' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$consulta = " DELETE FROM `manto_check_list_componente` WHERE `chl_bus_tipo` = '$chl_bus_tipo' AND `chl_codigo` = '$chl_codigo' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$consulta = " DELETE FROM `manto_check_list_falla_accion` WHERE `chl_bus_tipo` = '$chl_bus_tipo' AND `chl_codigo` = '$chl_codigo' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$consulta = " DELETE FROM `manto_check_list_posicion` WHERE `chl_bus_tipo` = '$chl_bus_tipo' AND `chl_codigo` = '$chl_codigo' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function descargar_arbol($chl_bus_tipo)
	{
		$consulta = " 	SELECT 
							`manto_check_list_codigo`.`chl_bus_tipo`,
							`manto_check_list_codigo`.`chl_orden`,
							`manto_check_list_codigo`.`chl_codigo`,
							`manto_check_list_codigo`.`chl_descripcion`,
							`manto_check_list_componente`.`chl_componente`,
							`manto_check_list_posicion`.`chl_posicion`,
							`manto_check_list_falla_accion`.`chl_falla`,
							`manto_check_list_falla_accion`.`chl_accion`
						FROM `manto_check_list_codigo`
						LEFT JOIN `manto_check_list_componente`
						ON `manto_check_list_componente`.`chl_bus_tipo`=`manto_check_list_codigo`.`chl_bus_tipo`
						AND `manto_check_list_componente`.`chl_codigo`=`manto_check_list_codigo`.`chl_codigo`
						LEFT JOIN `manto_check_list_posicion`
						ON `manto_check_list_posicion`.`chl_bus_tipo`=`manto_check_list_codigo`.`chl_bus_tipo`
						AND `manto_check_list_posicion`.`chl_codigo`=`manto_check_list_codigo`.`chl_codigo`
						AND `manto_check_list_posicion`.`chl_componente`=`manto_check_list_componente`.`chl_componente`
						LEFT JOIN `manto_check_list_falla_accion`
						ON `manto_check_list_falla_accion`.`chl_bus_tipo`=`manto_check_list_codigo`.`chl_bus_tipo`
						AND `manto_check_list_falla_accion`.`chl_codigo`=`manto_check_list_codigo`.`chl_codigo`
						AND `manto_check_list_falla_accion`.`chl_componente`=`manto_check_list_componente`.`chl_componente`
						WHERE `manto_check_list_codigo`.`chl_bus_tipo`='$chl_bus_tipo' 
						ORDER BY `manto_check_list_codigo`.`chl_codigo` ASC ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function buscar_check_list_componente($chl_bus_tipo, $chl_codigo)
	{
		$where_codigo = "";
		if($chl_codigo!=""){
			$where_codigo = "AND `manto_check_list_componente`.`chl_codigo` = '$chl_codigo'";
		}
		$consulta = " SELECT  `manto_check_list_componente`.`check_list_componente_id`,	`manto_check_list_componente`.`chl_bus_tipo`, `manto_check_list_componente`.`chl_codigo`, `manto_check_list_codigo`.`chl_descripcion`, `manto_check_list_componente`.`chl_componente` FROM `manto_check_list_componente` LEFT JOIN `manto_check_list_codigo` ON `manto_check_list_codigo`.`chl_codigo`=`manto_check_list_componente`.`chl_codigo` AND `manto_check_list_codigo`.`chl_bus_tipo`=`manto_check_list_componente`.`chl_bus_tipo` WHERE `manto_check_list_componente`.`chl_bus_tipo`='$chl_bus_tipo' ".$where_codigo." ORDER BY `manto_check_list_componente`.`check_list_componente_id`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function crear_check_list_componente($chl_bus_tipo, $chl_codigo, $chl_componente)
	{
		$consulta = " INSERT INTO `manto_check_list_componente` (`chl_bus_tipo`, `chl_codigo`, `chl_componente`) VALUES ('$chl_bus_tipo', '$chl_codigo', '$chl_componente') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function editar_check_list_componente($check_list_componente_id, $chl_bus_tipo, $chl_codigo, $chl_componente)
	{
		$consulta = " UPDATE `manto_check_list_componente` SET `chl_bus_tipo` = '$chl_bus_tipo', `chl_codigo` = '$chl_codigo', `chl_componente` = '$chl_componente' WHERE `check_list_componente_id` = '$check_list_componente_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function borrar_check_list_componente($chl_bus_tipo, $chl_codigo ,$chl_componente)
	{
		$consulta = " DELETE FROM `manto_check_list_componente` WHERE `chl_bus_tipo` = '$chl_bus_tipo' AND `chl_codigo` = '$chl_codigo' AND `chl_componente` = '$chl_componente' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$consulta = " DELETE FROM `manto_check_list_falla_accion` WHERE `chl_bus_tipo` = '$chl_bus_tipo' AND `chl_codigo` = '$chl_codigo'  AND `chl_componente` = '$chl_componente' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$consulta = " DELETE FROM `manto_check_list_posicion` WHERE `chl_bus_tipo` = '$chl_bus_tipo' AND `chl_codigo` = '$chl_codigo'  AND `chl_componente` = '$chl_componente' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function buscar_check_list_falla_accion($chl_bus_tipo, $chl_codigo, $chl_componente)
	{
		$where_componente = "";
		if($chl_componente!=""){
			$where_componente = "AND `manto_check_list_falla_accion`.`chl_componente` = '$chl_componente'";
		}
		$consulta = " SELECT  `manto_check_list_falla_accion`.`check_list_falla_accion_id`,	`manto_check_list_falla_accion`.`chl_bus_tipo`, `manto_check_list_falla_accion`.`chl_codigo`, `manto_check_list_codigo`.`chl_descripcion`, `manto_check_list_falla_accion`.`chl_componente`, `manto_check_list_falla_accion`.`chl_falla`, `manto_check_list_falla_accion`.`chl_accion` FROM `manto_check_list_falla_accion` LEFT JOIN `manto_check_list_codigo` ON `manto_check_list_codigo`.`chl_codigo`=`manto_check_list_falla_accion`.`chl_codigo` AND `manto_check_list_codigo`.`chl_bus_tipo`=`manto_check_list_falla_accion`.`chl_bus_tipo` WHERE `manto_check_list_falla_accion`.`chl_bus_tipo`='$chl_bus_tipo' AND `manto_check_list_falla_accion`.`chl_codigo`='$chl_codigo' ".$where_componente." ORDER BY `manto_check_list_falla_accion`.`check_list_falla_accion_id`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function crear_check_list_falla_accion($chl_bus_tipo, $chl_codigo, $chl_componente, $chl_falla, $chl_accion)
	{
		$consulta = " INSERT INTO `manto_check_list_falla_accion` (`chl_bus_tipo`, `chl_codigo`, `chl_componente`, `chl_falla`, `chl_accion`) VALUES ('$chl_bus_tipo', '$chl_codigo', '$chl_componente', '$chl_falla', '$chl_accion') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function editar_check_list_falla_accion($check_list_falla_accion_id, $chl_bus_tipo, $chl_codigo, $chl_componente, $chl_falla, $chl_accion)
	{
		$consulta = " UPDATE `manto_check_list_falla_accion` SET `chl_bus_tipo` = '$chl_bus_tipo', `chl_codigo` = '$chl_codigo', `chl_componente` = '$chl_componente', `chl_falla` = '$chl_falla', `chl_accion` = '$chl_accion' WHERE `check_list_falla_accion_id` = '$check_list_falla_accion_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function borrar_check_list_falla_accion($check_list_falla_accion_id)
	{
		$consulta = " DELETE FROM `manto_check_list_falla_accion` WHERE `check_list_falla_accion_id` = '$check_list_falla_accion_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function buscar_check_list_posicion($chl_bus_tipo, $chl_codigo, $chl_componente){
		$where_componente = "";
		if($chl_componente!=""){
			$where_componente = "AND `manto_check_list_posicion`.`chl_componente` = '$chl_componente'";
		}

		$consulta = " SELECT  `manto_check_list_posicion`.`check_list_posicion_id`, `manto_check_list_posicion`.`chl_bus_tipo`, `manto_check_list_posicion`.`chl_codigo`, `manto_check_list_codigo`.`chl_descripcion`, `manto_check_list_posicion`.`chl_componente`, `manto_check_list_posicion`.`chl_posicion` FROM `manto_check_list_posicion` LEFT JOIN `manto_check_list_codigo` ON `manto_check_list_codigo`.`chl_codigo`=`manto_check_list_posicion`.`chl_codigo` AND `manto_check_list_codigo`.`chl_bus_tipo`=`manto_check_list_posicion`.`chl_bus_tipo` WHERE `manto_check_list_posicion`.`chl_bus_tipo`='$chl_bus_tipo'  AND `manto_check_list_posicion`.`chl_codigo`='$chl_codigo' ".$where_componente." ORDER BY `manto_check_list_posicion`.`check_list_posicion_id`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function crear_check_list_posicion($chl_bus_tipo, $chl_codigo, $chl_componente, $chl_posicion)
	{
		$consulta = " INSERT INTO `manto_check_list_posicion` (`chl_bus_tipo`, `chl_codigo`, `chl_componente`, `chl_posicion`) VALUES ('$chl_bus_tipo', '$chl_codigo', '$chl_componente', '$chl_posicion') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function editar_check_list_posicion($check_list_posicion_id, $chl_bus_tipo, $chl_codigo, $chl_componente, $chl_posicion)
	{
		$consulta = " UPDATE `manto_check_list_posicion` SET `chl_bus_tipo` = '$chl_bus_tipo', `chl_codigo` = '$chl_codigo', `chl_componente` = '$chl_componente', `chl_posicion` = '$chl_posicion' WHERE `check_list_posicion_id` = '$check_list_posicion_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function borrar_check_list_posicion($check_list_posicion_id)
	{
		$consulta = " DELETE FROM `manto_check_list_posicion` WHERE `check_list_posicion_id` = '$check_list_posicion_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function buscar_falla_via_codigo($fav_bus_tipo)
	{
		$consulta = " SELECT  * FROM `manto_falla_via_codigo` WHERE `manto_falla_via_codigo`.`fav_bus_tipo`='$fav_bus_tipo' ORDER BY `manto_falla_via_codigo`.`fav_orden`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function crear_falla_via_codigo($fav_bus_tipo, $fav_orden, $fav_codigo, $fav_descripcion)
	{
		$consulta = " INSERT INTO `manto_falla_via_codigo` (`fav_bus_tipo`, `fav_orden`, `fav_codigo`, `fav_descripcion`) VALUES ('$fav_bus_tipo', '$fav_orden', '$fav_codigo', '$fav_descripcion') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function editar_falla_via_codigo($falla_via_codigo_id, $fav_bus_tipo, $fav_orden, $fav_codigo, $fav_descripcion)
	{
		$consulta = " UPDATE `manto_falla_via_codigo` SET `fav_bus_tipo` = '$fav_bus_tipo', `fav_orden` = '$fav_orden', `fav_codigo` = '$fav_codigo', `fav_descripcion` = '$fav_descripcion' WHERE `falla_via_codigo_id` = '$falla_via_codigo_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function borrar_falla_via_codigo($fav_bus_tipo, $fav_codigo)
	{
		$consulta = " DELETE FROM `manto_falla_via_codigo` WHERE `fav_bus_tipo` = '$fav_bus_tipo' AND `fav_codigo` = '$fav_codigo' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$consulta = " DELETE FROM `manto_falla_via_componente` WHERE `fav_bus_tipo` = '$fav_bus_tipo' AND `fav_codigo` = '$fav_codigo' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$consulta = " DELETE FROM `manto_falla_via_falla_accion` WHERE `fav_bus_tipo` = '$fav_bus_tipo' AND `fav_codigo` = '$fav_codigo' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$consulta = " DELETE FROM `manto_check_list_posicion` WHERE `fav_bus_tipo` = '$fav_bus_tipo' AND `fav_codigo` = '$fav_codigo' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function descargar_arbol_falla_via($fav_bus_tipo)
	{
		$consulta = " 	SELECT 
							`manto_falla_via_codigo`.`fav_bus_tipo`,
							`manto_falla_via_codigo`.`fav_orden`,
							`manto_falla_via_codigo`.`fav_codigo`,
							`manto_falla_via_codigo`.`fav_descripcion`,
							`manto_falla_via_componente`.`fav_componente`,
							`manto_falla_via_posicion`.`fav_posicion`,
							`manto_falla_via_falla_accion`.`fav_falla`,
							`manto_falla_via_falla_accion`.`fav_accion`
						FROM `manto_falla_via_codigo`
						LEFT JOIN `manto_falla_via_componente`
						ON `manto_falla_via_componente`.`fav_bus_tipo`=`manto_falla_via_codigo`.`fav_bus_tipo`
						AND `manto_falla_via_componente`.`fav_codigo`=`manto_falla_via_codigo`.`fav_codigo`
						LEFT JOIN `manto_falla_via_posicion`
						ON `manto_falla_via_posicion`.`fav_bus_tipo`=`manto_falla_via_codigo`.`fav_bus_tipo`
						AND `manto_falla_via_posicion`.`fav_codigo`=`manto_falla_via_codigo`.`fav_codigo`
						AND `manto_falla_via_posicion`.`fav_componente`=`manto_falla_via_componente`.`fav_componente`
						LEFT JOIN `manto_falla_via_falla_accion`
						ON `manto_falla_via_falla_accion`.`fav_bus_tipo`=`manto_falla_via_codigo`.`fav_bus_tipo`
						AND `manto_falla_via_falla_accion`.`fav_codigo`=`manto_falla_via_codigo`.`fav_codigo`
						AND `manto_falla_via_falla_accion`.`fav_componente`=`manto_falla_via_componente`.`fav_componente`
						WHERE `manto_falla_via_codigo`.`fav_bus_tipo`='$fav_bus_tipo' 
						ORDER BY `manto_falla_via_codigo`.`fav_codigo` ASC ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function buscar_falla_via_componente($fav_bus_tipo, $fav_codigo)
	{
		$where_codigo = "";
		if($fav_codigo!=""){
			$where_codigo = "AND `manto_falla_via_componente`.`fav_codigo` = '$fav_codigo'";
		}
		$consulta = " SELECT  `manto_falla_via_componente`.`falla_via_componente_id`,	`manto_falla_via_componente`.`fav_bus_tipo`, `manto_falla_via_componente`.`fav_codigo`, `manto_falla_via_codigo`.`fav_descripcion`, `manto_falla_via_componente`.`fav_componente` FROM `manto_falla_via_componente` LEFT JOIN `manto_falla_via_codigo` ON `manto_falla_via_codigo`.`fav_codigo`=`manto_falla_via_componente`.`fav_codigo` AND `manto_falla_via_codigo`.`fav_bus_tipo`=`manto_falla_via_componente`.`fav_bus_tipo` WHERE `manto_falla_via_componente`.`fav_bus_tipo`='$fav_bus_tipo' ".$where_codigo." ORDER BY `manto_falla_via_componente`.`falla_via_componente_id`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function crear_falla_via_componente($fav_bus_tipo, $fav_codigo, $fav_descripcion, $fav_componente)
	{
		$consulta = " INSERT INTO `manto_falla_via_componente` (`fav_bus_tipo`, `fav_codigo`, `fav_descripcion`, `fav_componente`) VALUES ('$fav_bus_tipo', '$fav_codigo', '$fav_descripcion', '$fav_componente') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function editar_falla_via_componente($falla_via_componente_id, $fav_bus_tipo, $fav_codigo, $fav_descripcion, $fav_componente)
	{
		$consulta = " UPDATE `manto_falla_via_componente` SET `fav_bus_tipo` = '$fav_bus_tipo', `fav_codigo` = '$fav_codigo', `fav_descripcion` = '$fav_descripcion', `fav_componente` = '$fav_componente' WHERE `falla_via_componente_id` = '$falla_via_componente_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function borrar_falla_via_componente($fav_bus_tipo, $fav_codigo ,$fav_componente)
	{
		$consulta = " DELETE FROM `manto_falla_via_componente` WHERE `fav_bus_tipo` = '$fav_bus_tipo' AND `fav_codigo` = '$fav_codigo' AND `fav_componente` = '$fav_componente' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$consulta = " DELETE FROM `manto_falla_via_falla_accion` WHERE `fav_bus_tipo` = '$fav_bus_tipo' AND `fav_codigo` = '$fav_codigo'  AND `fav_componente` = '$fav_componente' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$consulta = " DELETE FROM `manto_falla_via_posicion` WHERE `fav_bus_tipo` = '$fav_bus_tipo' AND `fav_codigo` = '$fav_codigo'  AND `fav_componente` = '$fav_componente' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function buscar_falla_via_falla_accion($fav_bus_tipo, $fav_codigo, $fav_componente)
	{
		$where_componente = "";
		if($fav_componente!=""){
			$where_componente = "AND `manto_falla_via_falla_accion`.`fav_componente` = '$fav_componente'";
		}
		$consulta = " SELECT  `manto_falla_via_falla_accion`.`falla_via_falla_accion_id`, `manto_falla_via_falla_accion`.`fav_bus_tipo`, `manto_falla_via_falla_accion`.`fav_codigo`, `manto_falla_via_codigo`.`fav_descripcion`, `manto_falla_via_falla_accion`.`fav_componente`, `manto_falla_via_falla_accion`.`fav_falla`, `manto_falla_via_falla_accion`.`fav_accion` FROM `manto_falla_via_falla_accion` LEFT JOIN `manto_falla_via_codigo` ON `manto_falla_via_codigo`.`fav_codigo`=`manto_falla_via_falla_accion`.`fav_codigo` AND `manto_falla_via_codigo`.`fav_bus_tipo`=`manto_falla_via_falla_accion`.`fav_bus_tipo` WHERE `manto_falla_via_falla_accion`.`fav_bus_tipo`='$fav_bus_tipo' AND `manto_falla_via_falla_accion`.`fav_codigo`='$fav_codigo' ".$where_componente." ORDER BY `manto_falla_via_falla_accion`.`falla_via_falla_accion_id`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function crear_falla_via_falla_accion($fav_bus_tipo, $fav_codigo, $fav_componente, $fav_falla, $fav_accion)
	{
		$consulta = " INSERT INTO `manto_falla_via_falla_accion` (`fav_bus_tipo`, `fav_codigo`, `fav_componente`, `fav_falla`, `fav_accion`) VALUES ('$fav_bus_tipo', '$fav_codigo', '$fav_componente', '$fav_falla', '$fav_accion') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function editar_falla_via_falla_accion($falla_via_falla_accion_id, $fav_bus_tipo, $fav_codigo, $fav_componente, $fav_falla, $fav_accion)
	{
		$consulta = " UPDATE `manto_falla_via_falla_accion` SET `fav_bus_tipo` = '$fav_bus_tipo', `fav_codigo` = '$fav_codigo', `fav_componente` = '$fav_componente', `fav_falla` = '$fav_falla', `fav_accion` = '$fav_accion' WHERE `falla_via_falla_accion_id` = '$falla_via_falla_accion_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function borrar_falla_via_falla_accion($fav_falla_accion_id)
	{
		$consulta = " DELETE FROM `manto_falla_via_falla_accion` WHERE `falla_via_falla_accion_id` = '$fav_falla_accion_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function buscar_falla_via_posicion($fav_bus_tipo, $fav_codigo, $fav_componente){
		$where_componente = "";
		if($fav_componente!=""){
			$where_componente = "AND `manto_falla_via_posicion`.`fav_componente` = '$fav_componente'";
		}

		$consulta = " SELECT  `manto_falla_via_posicion`.`falla_via_posicion_id`, `manto_falla_via_posicion`.`fav_bus_tipo`, `manto_falla_via_posicion`.`fav_codigo`, `manto_falla_via_codigo`.`fav_descripcion`, `manto_falla_via_posicion`.`fav_componente`, `manto_falla_via_posicion`.`fav_posicion` FROM `manto_falla_via_posicion` LEFT JOIN `manto_falla_via_codigo` ON `manto_falla_via_codigo`.`fav_codigo`=`manto_falla_via_posicion`.`fav_codigo` AND `manto_falla_via_codigo`.`fav_bus_tipo`=`manto_falla_via_posicion`.`fav_bus_tipo` WHERE `manto_falla_via_posicion`.`fav_bus_tipo`='$fav_bus_tipo'  AND `manto_falla_via_posicion`.`fav_codigo`='$fav_codigo' ".$where_componente." ORDER BY `manto_falla_via_posicion`.`falla_via_posicion_id`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function crear_falla_via_posicion($fav_bus_tipo, $fav_codigo, $fav_componente, $fav_posicion)
	{
		$consulta = " INSERT INTO `manto_falla_via_posicion` (`fav_bus_tipo`, `fav_codigo`, `fav_componente`, `fav_posicion`) VALUES ('$fav_bus_tipo', '$fav_codigo', '$fav_componente', '$fav_posicion') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function editar_falla_via_posicion($falla_via_posicion_id, $fav_bus_tipo, $fav_codigo, $fav_componente, $fav_posicion)
	{
		$consulta = " UPDATE `manto_falla_via_posicion` SET `fav_bus_tipo` = '$fav_bus_tipo', `fav_codigo` = '$fav_codigo', `fav_componente` = '$fav_componente', `fav_posicion` = '$fav_posicion' WHERE `falla_via_posicion_id` = '$falla_via_posicion_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function borrar_falla_via_posicion($falla_via_posicion_id)
	{
		$consulta = " DELETE FROM `manto_falla_via_posicion` WHERE `falla_via_posicion_id` = '$falla_via_posicion_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function crear_check_list_registro($check_list_id, $chl_fecha, $chl_bus, $chl_kilometraje, $chl_nombre_piloto, $chl_estado, $chl_usuario_id_genera, $chl_fecha_genera,$chl_dni_piloto, $chl_codigo_piloto, $chl_log)
	{
		$consulta = " INSERT INTO `manto_check_list_registro`(`check_list_id`, `chl_fecha`, `chl_bus`, `chl_kilometraje`, `chl_usuario_id_genera`, `chl_fecha_genera`, `chl_codigo_piloto`, `chl_dni_piloto`, `chl_nombre_piloto`, `chl_estado`, `chl_log`) VALUES ('$check_list_id', '$chl_fecha', '$chl_bus', '$chl_kilometraje', '$chl_usuario_id_genera', '$chl_fecha_genera', '$chl_codigo_piloto', '$chl_dni_piloto', '$chl_nombre_piloto', '$chl_estado', '$chl_log') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function editar_check_list_registro($check_list_id, $chl_fecha, $chl_bus, $chl_kilometraje, $chl_nombre_piloto, $chl_estado, $chl_usuario_id_genera, $chl_fecha_genera,$chl_dni_piloto, $chl_codigo_piloto, $chl_log)
	{
		$consulta = " UPDATE `manto_check_list_registro` SET `chl_fecha` = '$chl_fecha', `chl_bus` = '$chl_bus', `chl_kilometraje` = '$chl_kilometraje', `chl_usuario_id_genera` = '$chl_usuario_id_genera', `chl_fecha_genera` = '$chl_fecha_genera', `chl_codigo_piloto` = '$chl_codigo_piloto', `chl_dni_piloto` = '$chl_dni_piloto', `chl_nombre_piloto` = '$chl_nombre_piloto', `chl_estado` = '$chl_estado', `chl_log` = '$chl_log' WHERE `check_list_id` = '$check_list_id' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function cerrar_check_list_registro($check_list_id, $chl_estado, $chl_log)
	{
		$consulta = " UPDATE `manto_check_list_registro` SET `chl_estado` = '$chl_estado', `chl_log` = '$chl_log' WHERE `check_list_id` = '$check_list_id' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function anular_check_list_registro($check_list_id, $chl_estado, $chl_log)
	{
		$consulta = " UPDATE `manto_check_list_registro` SET `chl_estado` = '$chl_estado', `chl_log` = '$chl_log' WHERE `check_list_id` = '$check_list_id' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function crear_check_list_observaciones($check_list_id, $chl_codigo, $chl_descripcion, $chl_componente, $chl_posicion, $chl_falla, $chl_accion)
	{
		$consulta = " INSERT INTO `BDLIMABUS`.`manto_check_list_observaciones` (`check_list_id`, `chl_codigo`, `chl_descripcion`, `chl_componente`, `chl_posicion`, `chl_falla`, `chl_accion`) VALUES ( '$check_list_id', '$chl_codigo', '$chl_descripcion', '$chl_componente', '$chl_posicion', '$chl_falla', '$chl_accion'); ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function borrar_check_list_observaciones($check_list_id)
	{
		$consulta = " DELETE FROM `manto_check_list_observaciones` WHERE `check_list_id`='$check_list_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function crear_check_list_falla_via($check_list_id, $fav_novedad_id, $fav_descripcion_novedad, $fav_codigo, $fav_descripcion_codigo, $fav_componente, $fav_posicion, $fav_falla, $fav_accion)
	{
		$consulta = " INSERT INTO `manto_check_list_falla_via` (`check_list_id`, `fav_novedad_id`, `fav_descripcion_novedad`, `fav_codigo`, `fav_descripcion_codigo`, `fav_componente`, `fav_posicion`, `fav_falla`, `fav_accion`) VALUES ( '$check_list_id', '$fav_novedad_id', '$fav_descripcion_novedad', '$fav_codigo', '$fav_descripcion_codigo', '$fav_componente', '$fav_posicion', '$fav_falla', '$fav_accion'); ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function borrar_check_list_falla_via($check_list_id)
	{
		$consulta = " DELETE FROM `manto_check_list_falla_via` WHERE `check_list_id`='$check_list_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function buscar_reporte_falla($fecha_inicio, $fecha_termino)
	{
		$consulta = " 	SELECT `manto_check_list_registro`.`check_list_id`,
							`manto_check_list_registro`.`chl_fecha`,
							`manto_check_list_registro`.`chl_bus`,
							`manto_check_list_registro`.`chl_kilometraje`,
							`colaborador`.`Colab_nombre_corto` AS `nombre_usuario_genera`,
							`manto_check_list_registro`.`chl_fecha_genera`,
							`manto_check_list_registro`.`chl_codigo_piloto`,
							`manto_check_list_registro`.`chl_nombre_piloto`,
							`manto_check_list_registro`.`chl_estado`,
							`t2`.`novedad_id`,
							`t2`.`codigo`,
							`t2`.`descripcion`,
							`t2`.`componente`,
							`t2`.`posicion`,
							`t2`.`falla`,
							`t2`.`accion`
						FROM `manto_check_list_registro`
						LEFT JOIN `colaborador`
						ON `colaborador`.`Colaborador_id`=`manto_check_list_registro`.`chl_usuario_id_genera`
						LEFT JOIN
						(SELECT `manto_check_list_observaciones`.`check_list_id` AS `check_list_id`,
							'' AS `novedad_id`,
							`manto_check_list_observaciones`.`chl_codigo` AS `codigo`,
							`manto_check_list_observaciones`.`chl_descripcion` AS `descripcion`,
							`manto_check_list_observaciones`.`chl_componente` AS `componente`,
							`manto_check_list_observaciones`.`chl_posicion` AS `posicion`,
							`manto_check_list_observaciones`.`chl_falla` AS `falla`,
							`manto_check_list_observaciones`.`chl_accion` AS `accion`
						FROM `manto_check_list_observaciones`
						UNION
						SELECT `manto_check_list_falla_via`.`check_list_id` AS `check_list_id`,
							`manto_check_list_falla_via`.`fav_novedad_id` AS `novedad_id`,
							`manto_check_list_falla_via`.`fav_codigo` AS `codigo`,
							`manto_check_list_falla_via`.`fav_descripcion` AS `descripcion`,
							`manto_check_list_falla_via`.`fav_componente` AS `componente`,
							`manto_check_list_falla_via`.`fav_posicion` AS `posicion`,
							`manto_check_list_falla_via`.`fav_falla` AS `falla`,
							`manto_check_list_falla_via`.`fav_accion` AS `accion`
						FROM `manto_check_list_falla_via`) AS `t2`
						ON `t2`.`check_list_id`=`manto_check_list_registro`.`check_list_id`
						WHERE `manto_check_list_registro`.`chl_fecha`>='$fecha_inicio' AND
							`manto_check_list_registro`.`chl_fecha`<='$fecha_termino' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}

	function leer_tc_check_list_usuario()
	{
		$tc_variable = 'USUARIO';
        $consulta="SELECT * FROM `manto_tc_check_list` WHERE `tc_variable`='$tc_variable'";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;
   	}   

	function crear_tc_check_list_usuario($tc_check_list_id, $tc_categoria1, $tc_categoria2, $tc_categoria3)
	{
	   	$tc_variable = 'USUARIO';
		$consulta = "INSERT INTO `manto_tc_check_list`(`tc_variable`, `tc_categoria1`, `tc_categoria2`, `tc_categoria3`) VALUES ('$tc_variable', '$tc_categoria1','$tc_categoria2','$tc_categoria3')";
	   	$resultado = $this->conexion->prepare($consulta);
	   	$resultado->execute();   

	   	$consulta = "SELECT * FROM `manto_tc_check_list` WHERE `tc_variable`='$tc_variable'";
	   	$resultado = $this->conexion->prepare($consulta);
	   	$resultado->execute();        
	   	$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	   	print json_encode($data, JSON_UNESCAPED_UNICODE);
	   	
		$this->conexion=null;	
	}  	
	
	function editar_tc_check_list_usuario($tc_check_list_id, $tc_categoria1, $tc_categoria2, $tc_categoria3)
	{
	   $consulta = "UPDATE `manto_tc_check_list` SET `tc_categoria1`='$tc_categoria1',`tc_categoria2`='$tc_categoria2',`tc_categoria3`='$tc_categoria3' WHERE`tc_check_list_id`='$tc_check_list_id'";		
	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();   

	   $consulta= "SELECT * FROM `manto_tc_check_list` WHERE `tc_check_list_id` ='$tc_check_list_id'";
	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();        
	   $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	   print json_encode($data, JSON_UNESCAPED_UNICODE);
	   $this->conexion=null;	
	}  		
	
	function borrar_tc_check_list_usuario($tc_check_list_id)
	{
		$consulta = "DELETE FROM `manto_tc_check_list` WHERE `tc_check_list_id`='$tc_check_list_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$this->conexion=null;	
	}

	function leer_tc_check_list_sistema()
	{
        $tc_variable = 'SISTEMA';
		$consulta="SELECT * FROM `manto_tc_check_list` WHERE `tc_variable`='$tc_variable'";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;
   	}   

	function crear_tc_check_list_sistema($tc_check_list_id, $tc_categoria1, $tc_categoria2, $tc_categoria3)
	{
		$tc_variable = 'SISTEMA';
	   	$consulta = "INSERT INTO `manto_tc_check_list`(`tc_variable`, `tc_categoria1`, `tc_categoria2`, `tc_categoria3`) VALUES ('$tc_variable', '$tc_categoria1','$tc_categoria2','$tc_categoria3')";
	   	$resultado = $this->conexion->prepare($consulta);
	   	$resultado->execute();   

	   	$consulta = "SELECT * FROM `manto_tc_check_list` WHERE `tc_variable`='$tc_variable'";
	   	$resultado = $this->conexion->prepare($consulta);
	   	$resultado->execute();        
	   	$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	   	print json_encode($data, JSON_UNESCAPED_UNICODE);
	   	
		$this->conexion=null;	
	}  	
	
	function editar_tc_check_list_sistema($tc_check_list_id, $tc_categoria1, $tc_categoria2, $tc_categoria3)
	{
	   $consulta = "UPDATE `manto_tc_check_list` SET `tc_categoria1`='$tc_categoria1',`tc_categoria2`='$tc_categoria2',`tc_categoria3`='$tc_categoria3' WHERE`tc_check_list_id`='$tc_check_list_id'";	

	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();   

	   $consulta= "SELECT * FROM `manto_tc_check_list` WHERE `tc_check_list_id` ='$tc_check_list_id'";
	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();        
	   $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	   print json_encode($data, JSON_UNESCAPED_UNICODE);
	   $this->conexion=null;	
	}  		
	
	function borrar_tc_check_list_sistema($tc_check_list_id)
	{
		$consulta = "DELETE FROM `manto_tc_check_list` WHERE `tc_check_list_id`='$tc_check_list_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$this->conexion=null;	
	}

}