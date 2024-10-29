<?php
session_start();
class CRUD
{
	var $conexion;
	var $conexion2;
	var $objeto;

	function __construct()
	{
		if (!isset($_SESSION['USUARIO_ID'])) {
			session_destroy();
			echo '<script>window.location.href = "LogOut";</script>';
			exit();
		}

		SController('ConexionesBD', 'C_ConexionBD');
		$Instancia = new C_ConexionesBD();
		$this->conexion = $Instancia->Conectar();
		$this->conexion2 = $Instancia->conectar2();
	}

	function BuscarDataBD($TablaBD, $CampoBD, $DataBuscar)
	{
		$consulta	= "SELECT * FROM `$TablaBD` WHERE `$CampoBD` = '$DataBuscar'";
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function buscar_dato($nombre_tabla, $campo_buscar, $condicion_where)
	{
		$consulta = "SELECT `$nombre_tabla`.`$campo_buscar` FROM `$nombre_tabla` WHERE " . $condicion_where;

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;
		$this->conexion = null;
	}

	function select_tabla($Prog_Fecha, $operacion)
	{
		$consulta = "SELECT DISTINCT `OPE_ControlFacilitador`.`Prog_Tabla` AS `Tabla` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$Prog_Fecha' AND `Prog_Operacion`='$operacion' ORDER BY `Tabla` ASC";

		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function select_tabla_hist($Prog_Fecha, $operacion)
	{
		$consulta = "SELECT DISTINCT `OPE_ControlFacilitador`.`Prog_Tabla` AS `Tabla` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$Prog_Fecha' AND `Prog_Operacion`='$operacion' ORDER BY `Tabla` ASC";

		$resultado 	= $this->conexion2->prepare($consulta);
		$resultado->execute();
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion2 = null;
	}

	function select_bus($operacion)
	{
		$consulta = "SELECT `Buses`.`Bus_NroExterno` AS `Bus` FROM `Buses` WHERE `Bus_Operacion`='$operacion' ORDER BY `Bus` ASC";

		$resultado  = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function buscar_servicio($Prog_Fecha, $Prog_Tabla)
	{
		$consulta = "SELECT DISTINCT `Prog_Servicio` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$Prog_Fecha' AND `Prog_Tabla`='$Prog_Tabla'";

		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function buscar_servicio_hist($Prog_Fecha, $Prog_Tabla)
	{
		$consulta = "SELECT DISTINCT `Prog_Servicio` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$Prog_Fecha' AND `Prog_Tabla`='$Prog_Tabla'";

		$resultado 	= $this->conexion2->prepare($consulta);
		$resultado->execute();
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion2 = null;
	}

	function select_tipos($operacion, $tipo)
	{
		$consulta = "SELECT `ope_tipotablainasistencias`.`ttablainasistencias_detalle` AS 'Detalle' FROM `ope_tipotablainasistencias` WHERE `ope_tipotablainasistencias`.`ttablainasistencias_operacion` = '$operacion' AND `ope_tipotablainasistencias`.`ttablainasistencias_tipo` = '$tipo' ORDER BY `Detalle` ASC";

		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function tabla_vacia($NombreTabla)
	{
		$consulta	= "SELECT COUNT(*) AS `Contar` FROM `$NombreTabla` ";
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function MaxId($TablaBD, $CampoId)
	{
		$consulta 	= "SELECT MAX(`$CampoId`) AS `MaxId` FROM `$TablaBD`";
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function Permisos($cacces_nombremodulo, $cacces_nombreobjeto)
	{
		$rptapermisos = "";
		$cacces_moduloid = "";
		$cacces_objetosid = "";
		$cacces_perfil = $_SESSION['USU_PERFIL'];

		$consulta = "SELECT * FROM `Modulo` WHERE `Modulo`.`Mod_Nombre` = '$cacces_nombremodulo'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		foreach ($data as $row) {
			$cacces_moduloid = $row['Modulo_Id'];
		}

		$consulta = "SELECT * FROM `glo_objetos` WHERE `glo_objetos`.`obj_nombre` = '$cacces_nombreobjeto'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		foreach ($data as $row) {
			$cacces_objetosid = $row['objetos_id'];
		}

		$consulta = "SELECT * FROM `glo_controlaccesos` WHERE `cacces_perfil` = '$cacces_perfil' AND `cacces_moduloid` = '$cacces_moduloid' AND `cacces_objetosid` = '$cacces_objetosid'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach ($data as $row) {
			$rptapermisos = $row['cacces_acceso'];
		}
		return $rptapermisos;
		$this->conexion = null;
	}

	function select_roles($roles_perfil, $roles_campo)
	{
		$consulta = "SELECT `colaborador`.`$roles_campo` AS `nombres` FROM `glo_roles` RIGHT JOIN `colaborador` ON `colaborador`.`Colaborador_id`= `glo_roles`.`roles_dni` AND `colaborador`.`Colab_Estado`='ACTIVO' WHERE `glo_roles`.`roles_perfil` = '$roles_perfil'  ORDER BY `nombres` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion = null;
	}

	///:: INASISTENCIAS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

	function buscar_inasistencias($fecha_inicio, $fecha_termino)
	{
		$inas_tiponovedad = "('INASISTENCIA_TOTAL','INASISTENCIA_PARCIAL')";
		$consulta = "SELECT *, (SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`OPE_Novedad`.`Nove_UsuarioId`) AS `Usua_Nombres` FROM `OPE_Novedad` LEFT JOIN `ope_inasistencias` ON `ope_inasistencias`.`inas_openovedadid`=`OPE_Novedad`.`OPE_NovedadId` WHERE `OPE_Novedad`.`Nove_TipoNovedad` IN $inas_tiponovedad AND `OPE_Novedad`.`Nove_FechaOperacion`>='$fecha_inicio' AND `OPE_Novedad`.`Nove_FechaOperacion`<='$fecha_termino' ORDER BY `OPE_Novedad`.`OPE_NovedadId` DESC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
		$this->conexion = null;
	}

	function carga_inicial_inasistencias($inas_programacionid, $inas_novedadid)
	{
		$consulta = "SELECT `OPE_Novedad`.`Nove_TipoNovedad` AS `inas_tiponovedad`,`OPE_Novedad`.`Nove_DetalleNovedad` AS `inas_detallenovedad`, `OPE_Novedad`.`Nove_FechaOperacion` AS `inas_fechaoperacion`, (SELECT `colaborador`.`Colab_ApellidosNombres` FROM `colaborador` WHERE `colaborador`.`Colaborador_id` = `OPE_Novedad`.`Nove_Dni`) AS `inas_nombrecolaborador`, `OPE_Novedad`.`Nove_Tabla` AS `inas_tabla`, `OPE_Novedad`.`Nove_Servicio` AS `inas_servicio`, `OPE_Novedad`.`Nove_Bus` AS `inas_bus`, (SELECT `colaborador`.`Colab_ApellidosNombres` FROM `colaborador` WHERE `colaborador`.`Colaborador_id` = `OPE_Novedad`.`Nove_UsuarioId`) AS `inas_nombrecgo`, `OPE_Novedad`.`Nove_Descripcion` AS `inas_descripcion`, `Nove_LugarExacto` AS `inas_lugarexacto`,`Nove_HoraInicio` AS `inas_horainicio`,`Nove_HoraFin` AS `inas_horafin`, `Nove_LugarOrigen` AS `inas_lugar_origen`, `Nove_LugarDestino` AS `inas_lugar_destino`, `Nove_Operacion` AS `inas_operacion` FROM `OPE_Novedad` WHERE `OPE_Novedad`.`Nove_ProgramacionId`='$inas_programacionid' AND `OPE_Novedad`.`Novedad_Id`='$inas_novedadid'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
		$this->conexion = null;
	}

	function carga_inasistencias($inasistencias_id)
	{
		$consulta = "SELECT *,(SELECT `colaborador`.`Colab_ApellidosNombres` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`ope_inasistencias`.`inas_usuarioid_edicion`) AS `Usua_Nombres` FROM `ope_inasistencias` WHERE `ope_inasistencias`.`inasistencias_id`='$inasistencias_id'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
		$this->conexion = null;
	}

	function crear_inasistencias($inas_programacionid, $inas_novedadid, $inasistencias_id, $inas_tiponovedad, $inas_detallenovedad, $inas_fechaoperacion, $inas_nombrecolaborador, $inas_descripcion, $inas_tabla, $inas_servicio, $inas_bus, $inas_nombrecgo, $inas_lugarexacto, $inas_horainicio, $inas_horafin, $inas_totalhoras, $inas_controlfacilitadorid, $inas_operacion, $inas_cfargid, $inas_openovedadid, $inas_novedad, $inas_dni, $inas_codigocolaborador, $inas_codigocgo, $inas_estadoinasistencias, $inas_turno, $inas_cargo_colaborador, $inas_obs_log, $inas_lugar_origen, $inas_lugar_destino)
	{
		$inas_fechagenerar 		= date("Y-m-d H:i:s");
		$inas_usuarioid_generar = $_SESSION['USUARIO_ID'];
		$inas_usuario_nombres	= $_SESSION['Usua_NombreCorto'];
		$inas_log 				= $inas_estadoinasistencias . " " . $inas_fechagenerar . "  " . $inas_usuario_nombres . " CREAR: " . $inas_obs_log;

		$consulta = " INSERT INTO `ope_inasistencias`(`inasistencias_id`, `inas_programacionid`, `inas_controlfacilitadorid`, `inas_openovedadid`, `inas_novedadid`, `inas_novedad`, `inas_tiponovedad`, `inas_detallenovedad`, `inas_descripcion`, `inas_operacion`, `inas_fechaoperacion`, `inas_estadoinasistencias`, `inas_dni`, `inas_codigocolaborador`, `inas_nombrecolaborador`, `inas_codigocgo`, `inas_nombrecgo`, `inas_tabla`, `inas_servicio`, `inas_bus`, `inas_lugarexacto`, `inas_horainicio`, `inas_horafin`, `inas_totalhoras`, `inas_cfargid`, `inas_usuarioid_generar`, `inas_fechagenerar`, `inas_usuarioid_edicion`, `inas_fechaedicion`, `inas_fechareportegdh`, `inas_turno`, `inas_log`, `inas_cargo_colaborador`, `inas_usuarioid_cerrar`, `inas_fechacerrar`, `inas_lugar_origen`, `inas_lugar_destino`) VALUES ('$inasistencias_id', '$inas_programacionid', '$inas_controlfacilitadorid', '$inas_openovedadid', '$inas_novedadid', '$inas_novedad', '$inas_tiponovedad', '$inas_detallenovedad', '$inas_descripcion', '$inas_operacion', '$inas_fechaoperacion', '$inas_estadoinasistencias', '$inas_dni', '$inas_codigocolaborador', '$inas_nombrecolaborador', '$inas_codigocgo', '$inas_nombrecgo', '$inas_tabla', '$inas_servicio', '$inas_bus', '$inas_lugarexacto', '$inas_horainicio', '$inas_horafin', '$inas_totalhoras', '$inas_cfargid', '$inas_usuarioid_generar', '$inas_fechagenerar', '$inas_usuarioid_generar', '$inas_fechagenerar', '$inas_fechagenerar', '$inas_turno', '$inas_log', '$inas_cargo_colaborador', '$inas_usuarioid_generar', '$inas_fechagenerar', '$inas_lugar_origen', '$inas_lugar_destino') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$this->conexion = null;
	}

	function editar_inasistencias($inasistencias_id, $inas_tiponovedad, $inas_detallenovedad, $inas_fechaoperacion, $inas_nombrecolaborador, $inas_descripcion, $inas_tabla, $inas_servicio, $inas_bus, $inas_nombrecgo, $inas_lugarexacto, $inas_horainicio, $inas_horafin, $inas_totalhoras, $inas_dni, $inas_codigocolaborador, $inas_codigocgo, $inas_estadoinasistencias, $inas_cargo_colaborador, $inas_obs_log, $inas_log, $inas_lugar_origen, $inas_lugar_destino)
	{
		$inas_fechaedicion 		= date("Y-m-d H:i:s");
		$inas_usuarioid_edicion = $_SESSION['USUARIO_ID'];
		$inas_usuario_nombres	= $_SESSION['Usua_NombreCorto'];
		$inas_log				= $inas_estadoinasistencias . " " . $inas_fechaedicion . "  " . $inas_usuario_nombres . " EDICION: " . $inas_obs_log . '<br>' . $inas_log;

		$consulta = "UPDATE `ope_inasistencias` SET `inas_tiponovedad`='$inas_tiponovedad',`inas_detallenovedad`='$inas_detallenovedad',`inas_descripcion`='$inas_descripcion',`inas_fechaoperacion`='$inas_fechaoperacion',`inas_dni`='$inas_dni',`inas_codigocolaborador`='$inas_codigocolaborador',`inas_nombrecolaborador`='$inas_nombrecolaborador',`inas_codigocgo`='$inas_codigocgo',`inas_nombrecgo`='$inas_nombrecgo',`inas_tabla`='$inas_tabla',`inas_servicio`='$inas_servicio',`inas_bus`='$inas_bus',`inas_lugarexacto`='$inas_lugarexacto',`inas_horainicio`='$inas_horainicio',`inas_horafin`='$inas_horafin',`inas_totalhoras`='$inas_totalhoras',`inas_estadoinasistencias`='$inas_estadoinasistencias',`inas_cargo_colaborador`='$inas_cargo_colaborador', `inas_log`='$inas_log', `inas_lugar_origen`='$inas_lugar_origen', `inas_lugar_destino`='$inas_lugar_destino' WHERE `inasistencias_id`='$inasistencias_id'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$this->conexion = null;
	}

	function detalle_control_facilitador($Nove_ProgramacionId, $Novedad_Id)
	{
		$consulta = "SELECT `Nove_FechaOperacion`, `ControlFacilitador_Id`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, TIME_FORMAT( `Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT( `Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`,`Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_ControlFacilitador`.`CFaci_UsuarioId`=`colaborador`.`Colaborador_id`) AS `CFaci_UsuarioId`, `Novedad_Id`, `Nove_Novedad`, `Nove_TipoNovedad`, `Nove_DetalleNovedad`, `Nove_Descripcion`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_Novedad`.`Nove_UsuarioId` = `colaborador`.`Colaborador_id`) AS `Nove_UsuarioId` FROM `OPE_ControlFacilitador` LEFT JOIN `OPE_Novedad` ON `Novedad_Id`='$Novedad_Id' WHERE `Programacion_Id`='$Nove_ProgramacionId'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function detalle_control_facilitador_hist($Nove_ProgramacionId, $Novedad_Id)
	{
		$consulta = "SELECT `Nove_FechaOperacion`, `ControlFacilitador_Id`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, TIME_FORMAT( `Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT( `Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`,`Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_ControlFacilitador`.`CFaci_UsuarioId`=`colaborador`.`Colaborador_id`) AS `CFaci_UsuarioId`, `Novedad_Id`, `Nove_Novedad`, `Nove_TipoNovedad`, `Nove_DetalleNovedad`, `Nove_Descripcion`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_Novedad`.`Nove_UsuarioId` = `colaborador`.`Colaborador_id`) AS `Nove_UsuarioId` FROM `bdlimabus_hist`.`OPE_ControlFacilitador` LEFT JOIN `OPE_Novedad` ON `Novedad_Id`='$Novedad_Id' WHERE `Programacion_Id`='$Nove_ProgramacionId'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function buscar_reporte_gdh($fecha_inicio, $fecha_termino)
	{
		$consulta = "	SELECT
    						`ope_inasistencias`.`inasistencias_id`,
							`ope_inasistencias`.`inas_estadoinasistencias`,
    						`ope_inasistencias`.`inas_nombrecgo`,
    						`ope_inasistencias`.`inas_codigocolaborador`,
    						`ope_inasistencias`.`inas_nombrecolaborador`,
    						`ope_inasistencias`.`inas_dni`,
							`ope_inasistencias`.`inas_cargo_colaborador`,
							`ope_inasistencias`.`inas_fechaoperacion`,
							TIME_FORMAT(`ope_inasistencias`.`inas_horainicio`,'%H:%i') AS `inas_horainicio`,
    						TIME_FORMAT(`ope_inasistencias`.`inas_horafin`,'%H:%i') AS `inas_horafin`,
    						TIME_FORMAT(`ope_inasistencias`.`inas_totalhoras`,'%H:%i') AS `inas_totalhoras`,
							`ope_inasistencias`.`inas_bus`,
							`ope_inasistencias`.`inas_operacion`,
							`ope_inasistencias`.`inas_tabla`,
    						`ope_inasistencias`.`inas_servicio`,
							`ope_inasistencias`.`inas_lugar_origen`,
							`ope_inasistencias`.`inas_lugar_destino`,
							`ope_inasistencias`.`inas_tiponovedad`,
    						`ope_inasistencias`.`inas_detallenovedad`,
    						`ope_inasistencias`.`inas_descripcion`,
							`ope_inasistencias`.`inas_turno`,
							`ope_inasistencias`.`inas_fechareportegdh`
						FROM 
							`ope_inasistencias`
						WHERE 
							`ope_inasistencias`.`inas_fechaoperacion`>='$fecha_inicio' AND 
							`ope_inasistencias`.`inas_fechaoperacion`<='$fecha_termino' 
						ORDER BY 
							`ope_inasistencias`.`inasistencias_id` DESC";

		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
		$this->conexion = null;
	}

	function buscar_marcacion($fecha_inicio, $fecha_termino)
	{
		$consulta = "SELECT
		   				`ope_marcaciones_id`, 
						`marc_dni`, 
						`marc_codigo_colaborador`, 
						`marc_nombre_colaborador`, 
						`marc_fecha_operacion`,
						TIME_FORMAT(`marc_hora_operacion`,'%H:%i') AS `marc_hora_operacion`, 
						`marc_lugar_exacto`, 
						`marc_latitud`, 
						`marc_longitud`, 
						`marc_estado`
					FROM 
						`ope_marcaciones`
					WHERE 
						`marc_fecha_operacion`>='$fecha_inicio' AND 
						`marc_fecha_operacion`<='$fecha_termino' 
					ORDER BY 
						`ope_marcaciones_id` DESC";

		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);
		$this->conexion = null;
	}

	function control_facilitador_id_hist($Programacion_Id)
	{
		$consulta = "SELECT * FROM `OPE_ControlFacilitador` WHERE `Programacion_Id`='$Programacion_Id' ";
		$resultado = $this->conexion2->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion2 = null;
	}

	function control_facilitador_id($Programacion_Id)
	{
		$consulta = "SELECT * FROM `OPE_ControlFacilitador` WHERE `Programacion_Id`='$Programacion_Id' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function LeerTipoTablaInasistencias()
	{
		$consulta = "SELECT * FROM `ope_tipotablainasistencias`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
		$this->conexion = null;
	}

	function CrearTipoTablaInasistencias($TtablaInasistencias_Id, $TtablaInasistencias_Tipo, $TtablaInasistencias_Operacion, $TtablaInasistencias_Detalle)
	{
		$consulta = "INSERT INTO `ope_tipotablainasistencias`(`ttablainasistencias_tipo`, `ttablainasistencias_operacion`, `ttablainasistencias_detalle`) VALUES ('$TtablaInasistencias_Tipo','$TtablaInasistencias_Operacion','$TtablaInasistencias_Detalle')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$consulta = "SELECT * FROM `ope_tipotablainasistencias`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
		$this->conexion = null;
	}

	function EditarTipoTablaInasistencias($TtablaInasistencias_Id, $TtablaInasistencias_Tipo, $TtablaInasistencias_Operacion, $TtablaInasistencias_Detalle)
	{
		$consulta = "UPDATE `ope_tipotablainasistencias` SET `ttablainasistencias_tipo`='$TtablaInasistencias_Tipo',`ttablainasistencias_operacion`='$TtablaInasistencias_Operacion',`ttablainasistencias_detalle`='$TtablaInasistencias_Detalle' WHERE `ttablainasistencias_id`='$TtablaInasistencias_Id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$consulta = "SELECT * FROM `ope_tipotablainasistencias` WHERE `ttablainasistencias_id` ='$TtablaInasistencias_Id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
		$this->conexion = null;
	}

	function BorrarTipoTablaInasistencias($TtablaInasistencias_Id)
	{
		$consulta = "DELETE FROM `ope_tipotablainasistencias` WHERE `ttablainasistencias_id`='$TtablaInasistencias_Id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$this->conexion = null;
	}
}
