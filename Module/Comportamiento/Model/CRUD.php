<?php
session_start();
class CRUD
{	
	var $conexion;
	var $conexion2;
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
		$this->conexion2=$Instancia->Conectar2();
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

	function buscar_dato($nombre_tabla, $campo_buscar, $condicion_where)
	{
		$consulta = "SELECT `$nombre_tabla`.`$campo_buscar` FROM `$nombre_tabla` WHERE ".$condicion_where;

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;   
		$this->conexion=null;
	}

	function tabla_vacia($NombreTabla)
	{
		$consulta	= "SELECT COUNT(*) AS `Contar` FROM `$NombreTabla` ";
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();   
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function MaxId($TablaBD,$CampoId)
	{
		$consulta 	= "SELECT MAX(`$CampoId`) AS `MaxId` FROM `$TablaBD`";
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);
		
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
	
	function buscar_servicio($Prog_Fecha,$Prog_Tabla)
	{
		$consulta="SELECT DISTINCT `Prog_Servicio` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$Prog_Fecha' AND `Prog_Tabla`='$Prog_Tabla'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function buscar_servicio_hist($Prog_Fecha,$Prog_Tabla)
	{
		$consulta="SELECT DISTINCT `Prog_Servicio` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$Prog_Fecha' AND `Prog_Tabla`='$Prog_Tabla'";

		$resultado = $this->conexion2->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion2=null;
	}

	function select_tabla($prog_fecha, $operacion)
	{
		$consulta = "SELECT DISTINCT `OPE_ControlFacilitador`.`Prog_Tabla` AS `Tabla` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$prog_fecha' AND `Prog_Operacion`='$operacion' ORDER BY `Tabla` ASC";

		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function select_tabla_hist($prog_fecha, $operacion)
	{
		$consulta = "SELECT DISTINCT `OPE_ControlFacilitador`.`Prog_Tabla` AS `Tabla` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$prog_fecha' AND `Prog_Operacion`='$operacion' ORDER BY `Tabla` ASC";

		$resultado 	= $this->conexion2->prepare($consulta);
		$resultado->execute();        
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion2=null;
	}


	//::::::::::::::::::::::::::::::::::::::::::::::: COMPORTAMIENTO :::::::::::::::::::::::::::::::::::::::::::::://

	function BuscarComportamiento($fecha_inicio, $fecha_termino)
	{
		$Comp_TipoNovedad = "('ACTITUD_NEGATIVA','INCUMP_NORMA_SISTEMA','INCUMP_NORMA_TRANSITO')";
		$Nove_TipoOrigen = "('CGO','PUNTO FIJO')";
		
		$consulta="SELECT *,(SELECT `colaborador`.`Colab_ApellidosNombres` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`OPE_Novedad`.`Nove_UsuarioId`) AS `UsuarioGenera` FROM `OPE_Novedad` LEFT JOIN `ope_comportamiento` ON `ope_comportamiento`.`comp_openovedadid`=`OPE_Novedad`.`OPE_NovedadId` WHERE `OPE_Novedad`.`Nove_TipoNovedad` IN $Comp_TipoNovedad AND `OPE_Novedad`.`Nove_FechaOperacion`>='$fecha_inicio' AND `OPE_Novedad`.`Nove_FechaOperacion`<='$fecha_termino' AND `Nove_TipoOrigen` IN $Nove_TipoOrigen ORDER BY `OPE_Novedad`.`OPE_NovedadId` DESC";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   

	function CargaInicialComportamiento($comp_programacionid,$comp_novedadid)
	{
		$consulta="SELECT `OPE_Novedad`.`Nove_TipoNovedad` AS `comp_tiponovedad`,`OPE_Novedad`.`Nove_DetalleNovedad` AS `comp_detallenovedad`, `OPE_Novedad`.`Nove_FechaOperacion` AS `comp_fechaoperacion`, (SELECT `glo_roles`.`roles_apellidosnombres` FROM `glo_roles` WHERE `glo_roles`.`roles_dni` = `OPE_Novedad`.`Nove_Dni` LIMIT 1) AS `comp_nombrecolaborador`, `OPE_Novedad`.`Nove_Tabla` AS `comp_tabla`, `OPE_Novedad`.`Nove_Servicio` AS `comp_servicio`, `OPE_Novedad`.`Nove_Bus` AS `comp_bus`, (SELECT `glo_roles`.`roles_apellidosnombres` FROM `glo_roles` WHERE `glo_roles`.`roles_dni` = `OPE_Novedad`.`Nove_UsuarioId` LIMIT 1) AS `comp_nombrecgo`, `OPE_Novedad`.`Nove_Descripcion` AS `comp_descripcion`,`Nove_LugarExacto` AS `comp_lugarexacto`,`Nove_HoraInicio` AS `comp_horainicio`,`Nove_HoraFin` AS `comp_horafin`, `OPE_Novedad`.`Nove_Operacion` AS `comp_operacion`, `OPE_Novedad`.`Nove_LugarOrigen` AS `comp_lugar_origen`, `OPE_Novedad`.`Nove_LugarDestino` AS `comp_lugar_destino` FROM `OPE_Novedad` WHERE `OPE_Novedad`.`Nove_ProgramacionId`='$comp_programacionid' AND `OPE_Novedad`.`Novedad_Id`='$comp_novedadid'";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   

   	function CargaComportamiento($comportamiento_id)
	{
		$consulta="SELECT *, (SELECT `roles_apellidosnombres` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ope_comportamiento`.`comp_usuarioid_edicion` LIMIT 1) AS `Usua_Nombres` FROM `ope_comportamiento` WHERE `ope_comportamiento`.`comportamiento_id`='$comportamiento_id'";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   

	function CrearComportamiento($comportamiento_id, $comp_programacionid, $comp_novedadid, $comp_tiponovedad, $comp_fechaoperacion, $comp_nombrecolaborador, $comp_descripcion, $comp_tabla, $comp_servicio, $comp_bus, $comp_nombrecgo, $comp_lugarexacto, $comp_lugar_origen, $comp_lugar_destino, $comp_horainicio, $comp_horafin, $comp_total_horas, $comp_detallenovedad, $comp_estadocomportamiento, $comp_reconoceresponsabilidad, $comp_grado_falta, $comp_codigofalta, $comp_faltacometida, $comp_monto, $comp_linkvideo, $comp_obs_log, $comp_operacion, $comp_controlfacilitadorid, $comp_cfargid, $comp_turno, $comp_openovedadid, $comp_novedad, $comp_tipoorigen, $comp_dni, $comp_codigocolaborador, $comp_cargo_colaborador, $comp_codigocgo, $comp_reportegdh, $comp_premio)
	{
		$comp_fechagenerar 		= date("Y-m-d H:i:s");
		$comp_usuarioid_generar = $_SESSION['USUARIO_ID'];
		$comp_telemetriacargaid = "0";
		$comp_usuario_nombres	= $_SESSION['Usua_NombreCorto'];
		$comp_log 				= $comp_fechagenerar."  ".$comp_estadocomportamiento." ".$comp_usuario_nombres." CREAR: ".$comp_obs_log;
		if($comp_monto==""){
			$comp_monto="0";
		}				

		$consulta =" INSERT INTO `ope_comportamiento` (`comportamiento_id`, `comp_programacionid`, `comp_controlfacilitadorid`, `comp_openovedadid`, `comp_novedadid`, `comp_novedad`, `comp_tiponovedad`, `comp_tipoorigen`, `comp_detallenovedad`, `comp_descripcion`, `comp_operacion`, `comp_fechaoperacion`, `comp_estadocomportamiento`, `comp_dni`, `comp_codigocolaborador`, `comp_nombrecolaborador`, `comp_codigocgo`, `comp_nombrecgo`, `comp_tabla`, `comp_servicio`, `comp_bus`, `comp_lugarexacto`, `comp_horainicio`, `comp_horafin`, `comp_linkvideo`, `comp_grado_falta`, `comp_codigofalta`, `comp_faltacometida`, `comp_monto`, `comp_reconoceresponsabilidad`, `comp_reportegdh`, `comp_fechareportegdh`, `comp_premio`, `comp_cfargid`, `comp_telemetriacargaid`, `comp_usuarioid_generar`, `comp_fechagenerar`, `comp_usuarioid_edicion`, `comp_fechaedicion`, `comp_usuarioid_cerrar`, `comp_fechacerrar`, `comp_log`, `comp_cargo_colaborador`, `comp_lugar_origen`, `comp_lugar_destino`, `comp_turno`, `comp_total_horas`) VALUES ('$comportamiento_id', '$comp_programacionid', '$comp_controlfacilitadorid', '$comp_openovedadid', '$comp_novedadid', '$comp_novedad', '$comp_tiponovedad', '$comp_tipoorigen', '$comp_detallenovedad', '$comp_descripcion', '$comp_operacion', '$comp_fechaoperacion', '$comp_estadocomportamiento', '$comp_dni', '$comp_codigocolaborador', '$comp_nombrecolaborador', '$comp_codigocgo', '$comp_nombrecgo', '$comp_tabla', '$comp_servicio', '$comp_bus', '$comp_lugarexacto', '$comp_horainicio', '$comp_horafin', '$comp_linkvideo', '$comp_grado_falta', '$comp_codigofalta', '$comp_faltacometida', '$comp_monto', '$comp_reconoceresponsabilidad', '$comp_reportegdh', '$comp_fechagenerar', '$comp_premio', '$comp_cfargid', '$comp_telemetriacargaid', '$comp_usuarioid_generar', '$comp_fechagenerar', '$comp_usuarioid_generar', '$comp_fechagenerar', '$comp_usuarioid_generar', '$comp_fechagenerar', '$comp_log', '$comp_cargo_colaborador', '$comp_lugar_origen', '$comp_lugar_destino', '$comp_turno', '$comp_total_horas') ";

		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   
  		$this->conexion=null;	
	}

	function EditarComportamiento($comportamiento_id, $comp_tiponovedad, $comp_fechaoperacion, $comp_nombrecolaborador,$comp_descripcion, $comp_tabla, $comp_servicio, $comp_bus, $comp_nombrecgo, $comp_lugarexacto, $comp_lugar_origen, $comp_lugar_destino, $comp_horainicio, $comp_horafin, $comp_total_horas, $comp_detallenovedad, $comp_estadocomportamiento, $comp_reconoceresponsabilidad, $comp_grado_falta, $comp_codigofalta, $comp_faltacometida, $comp_monto, $comp_linkvideo, $comp_obs_log,  $comp_dni, $comp_codigocolaborador, $comp_cargo_colaborador, $comp_codigocgo, $comp_reportegdh, $comp_premio, $comp_log)
	{
		$comp_fechaedicion 		= date("Y-m-d H:i:s");
		$comp_usuarioid_edicion = $_SESSION['USUARIO_ID'];
		$comp_usuario_nombres	= $_SESSION['Usua_NombreCorto'];
		$comp_log				= $comp_fechaedicion."  ".$comp_estadocomportamiento." ".$comp_usuario_nombres." EDICION: ".$comp_obs_log.'<br>'.$comp_log;				
		if($comp_monto==""){
			$comp_monto="0";
		}				

		$consulta = " UPDATE `ope_comportamiento` SET `comp_tiponovedad` = '$comp_tiponovedad', `comp_detallenovedad` = '$comp_detallenovedad', `comp_descripcion` = '$comp_descripcion', `comp_fechaoperacion` = '$comp_fechaoperacion', `comp_estadocomportamiento` = '$comp_estadocomportamiento', `comp_dni` = '$comp_dni', `comp_codigocolaborador` = '$comp_codigocolaborador', `comp_nombrecolaborador` = '$comp_nombrecolaborador', `comp_codigocgo` = '$comp_codigocgo', `comp_nombrecgo` = '$comp_nombrecgo', `comp_tabla` = '$comp_tabla', `comp_servicio` = '$comp_servicio', `comp_bus` = '$comp_bus', `comp_lugarexacto` = '$comp_lugarexacto', `comp_horainicio` = '$comp_horainicio', `comp_horafin` = '$comp_horafin', `comp_linkvideo` = '$comp_linkvideo', `comp_grado_falta`='$comp_grado_falta', `comp_codigofalta` = '$comp_codigofalta', `comp_faltacometida` = '$comp_faltacometida', `comp_monto` = '$comp_monto', `comp_reconoceresponsabilidad` = '$comp_reconoceresponsabilidad', `comp_reportegdh` = '$comp_reportegdh', `comp_fechareportegdh` = '$comp_fechaedicion', `comp_premio` = '$comp_premio', `comp_usuarioid_edicion` = '$comp_usuarioid_edicion', `comp_fechaedicion` = '$comp_fechaedicion', `comp_usuarioid_cerrar` = '$comp_usuarioid_edicion', `comp_fechacerrar` = '$comp_fechaedicion', `comp_log` = '$comp_log', `comp_cargo_colaborador` = '$comp_cargo_colaborador', `comp_lugar_origen` =  '$comp_lugar_origen', `comp_lugar_destino` = '$comp_lugar_destino', `comp_total_horas` = '$comp_total_horas' WHERE `comportamiento_id` = '$comportamiento_id' ";

		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   
  		$this->conexion=null;
	}

	function DetalleControlFacilitador($Nove_ProgramacionId, $Novedad_Id)
	{
	   $consulta="SELECT `Nove_FechaOperacion`, `ControlFacilitador_Id`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, TIME_FORMAT( `Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT( `Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`,`Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, (SELECT `roles_nombrecorto` FROM `glo_roles` WHERE `OPE_ControlFacilitador`.`CFaci_UsuarioId`=`glo_roles`.`roles_dni` LIMIT 1) AS `CFaci_UsuarioId`, `Novedad_Id`, `Nove_Novedad`, `Nove_TipoNovedad`, `Nove_DetalleNovedad`, `Nove_Descripcion`, (SELECT `roles_nombrecorto` FROM `glo_roles` WHERE `OPE_Novedad`.`Nove_UsuarioId` = `glo_roles`.`roles_dni` LIMIT 1) AS `Nove_UsuarioId` FROM `OPE_ControlFacilitador` LEFT JOIN `OPE_Novedad` ON `Novedad_Id`='$Novedad_Id' WHERE `Programacion_Id`='$Nove_ProgramacionId'";

	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();
	   $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

	   return $data;
	   $this->conexion=null;
	}

	function detalle_control_facilitador_hist($Nove_ProgramacionId, $Novedad_Id)
	{
	   $consulta="SELECT `Nove_FechaOperacion`, `ControlFacilitador_Id`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, TIME_FORMAT( `Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT( `Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`,`Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, (SELECT `roles_nombrecorto` FROM `glo_roles` WHERE `OPE_ControlFacilitador`.`CFaci_UsuarioId`=`glo_roles`.`roles_dni` LIMIT 1) AS `CFaci_UsuarioId`, `Novedad_Id`, `Nove_Novedad`, `Nove_TipoNovedad`, `Nove_DetalleNovedad`, `Nove_Descripcion`, (SELECT `roles_nombrecorto` FROM `glo_roles` WHERE `OPE_Novedad`.`Nove_UsuarioId` = `glo_roles`.`roles_dni` LIMIT 1) AS `Nove_UsuarioId` FROM `bdlimabus_hist`.`OPE_ControlFacilitador` LEFT JOIN `OPE_Novedad` ON `Novedad_Id`='$Novedad_Id' WHERE `Programacion_Id`='$Nove_ProgramacionId'";

	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();
	   $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

	   return $data;
	   $this->conexion=null;
	}

	function BuscarReportegdh($fecha_inicio, $fecha_termino)
	{
		$consulta="SELECT `comportamiento_id`, `comp_nombrecgo`, `comp_fechaoperacion`, `comp_dni`, `comp_codigocolaborador`, `comp_nombrecolaborador`, `comp_bus`, `comp_cargo_colaborador`, `comp_tabla`, `comp_servicio`, `comp_detallenovedad`, `comp_descripcion`, `comp_faltacometida`, `comp_codigofalta`, `comp_monto`, `comp_reconoceresponsabilidad`, IF(`comp_premio`='SI','NO','SI') AS `comp_afectapremio`, 'PENDIENTE G-H' AS `comp_tipodisciplina`, 'ATENCION DIRECTA POR G-H' AS `comp_observaciones`, `comp_fechareportegdh`, `comp_tipoorigen`, `comp_estadocomportamiento` FROM `ope_comportamiento` WHERE `ope_comportamiento`.`comp_fechaoperacion`>='$fecha_inicio' AND `ope_comportamiento`.`comp_fechaoperacion`<='$fecha_termino' ORDER BY `ope_comportamiento`.`comportamiento_id` DESC";
		
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   

	function BuscarTelemetriaCarga($Calendario_Anio)
	{
		$consulta="SELECT *, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ope_telemetriacarga`.`tlmtcarga_usuarioid` LIMIT 1) AS `UsuarioGenera` FROM `ope_telemetriacarga` WHERE YEAR(`ope_telemetriacarga`.`tlmtcarga_fechaoperacion`)='$Calendario_Anio' ORDER BY `ope_telemetriacarga`.`telemetriacarga_id` DESC";
		
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   

	function BorrarTelemetriaCarga($telemetriacarga_id)
	{
		$consulta="DELETE FROM `ope_telemetriacarga` WHERE `telemetriacarga_id`='$telemetriacarga_id'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        

		$this->conexion=null;
	}

	function BorrarTelemetria($telemetriacarga_id)
	{
		$consulta="DELETE FROM `ope_comportamiento` WHERE `comp_telemetriacargaid`='$telemetriacarga_id'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        

		$this->conexion=null;
	}

	function ExisteFechaOperacion($tlmtcarga_fechaoperacion)
	{
		$consulta = "SELECT * FROM `ope_telemetriacarga` WHERE `tlmtcarga_fechaoperacion` = '$tlmtcarga_fechaoperacion'";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function CrearTelemetriaDetalle($comportamiento_id,$comp_programacionid,$comp_controlfacilitadorid,$comp_openovedadid,$comp_novedadid,$comp_novedad,$comp_tiponovedad,$comp_detallenovedad,$comp_descripcion,$comp_operacion,$comp_fechaoperacion,$comp_estadocomportamiento,$comp_dni,$comp_codigocolaborador,$comp_nombrecolaborador,$comp_codigocgo,$comp_nombrecgo,$comp_tabla,$comp_servicio,$comp_bus,$comp_lugarexacto,$comp_horainicio,$comp_horafin,$comp_linkvideo,$comp_codigofalta,$comp_faltacometida,$comp_monto,$comp_reconoceresponsabilidad,$comp_reportegdh,$comp_fechareportegdh,$comp_premio,$comp_cfargid,$comp_tipoorigen,$comp_telemetriacargaid,$comp_fechagenerar)
	{
		$comp_usuarioid_generar = $_SESSION['USUARIO_ID'];				

		$consulta="INSERT INTO `ope_comportamiento`(`comportamiento_id`, `comp_programacionid`, `comp_controlfacilitadorid`, `comp_openovedadid`, `comp_novedadid`, `comp_novedad`, `comp_tiponovedad`, `comp_detallenovedad`, `comp_descripcion`, `comp_operacion`, `comp_fechaoperacion`, `comp_estadocomportamiento`, `comp_dni`, `comp_codigocolaborador`, `comp_nombrecolaborador`, `comp_codigocgo`, `comp_nombrecgo`, `comp_tabla`, `comp_servicio`, `comp_bus`, `comp_lugarexacto`, `comp_horainicio`, `comp_horafin`, `comp_linkvideo`, `comp_codigofalta`, `comp_faltacometida`, `comp_monto`, `comp_reconoceresponsabilidad`, `comp_reportegdh`, `comp_fechareportegdh`, `comp_premio`, `comp_cfargid`, `comp_tipoorigen`, `comp_telemetriacargaid`, `comp_usuarioid_generar`, `comp_fechagenerar`, `comp_usuarioid_edicion`, `comp_fechaedicion`) VALUES ('$comportamiento_id','$comp_programacionid','$comp_controlfacilitadorid','$comp_openovedadid','$comp_novedadid','$comp_novedad','$comp_tiponovedad','$comp_detallenovedad','$comp_descripcion','$comp_operacion','$comp_fechaoperacion','$comp_estadocomportamiento','$comp_dni','$comp_codigocolaborador','$comp_nombrecolaborador','$comp_codigocgo','$comp_nombrecgo','$comp_tabla','$comp_servicio','$comp_bus','$comp_lugarexacto','$comp_horainicio','$comp_horafin','$comp_linkvideo','$comp_codigofalta','$comp_faltacometida','$comp_monto','$comp_reconoceresponsabilidad','$comp_reportegdh','$comp_fechareportegdh','$comp_premio','$comp_cfargid','$comp_tipoorigen','$comp_telemetriacargaid', '$comp_usuarioid_generar', '$comp_fechagenerar', '$comp_usuarioid_generar', '$comp_fechagenerar')";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$valida = $resultado->rowCount();
		if($valida==0){
			return false; 
		}else{
			return true;
		}

		$this->conexion=null;
	}

	function CrearTelemetriaCarga($tlmtcarga_nroregistros,$tlmtcarga_fechaoperacion)
	{
		$tlmtcarga_usuarioid = $_SESSION['USUARIO_ID'];
		$tlmtcarga_fechacarga = date("Y-m-d H:i:s");
		
		$consulta="INSERT INTO `ope_telemetriacarga`(`tlmtcarga_fechaoperacion`, `tlmtcarga_nroregistros`, `tlmtcarga_fechacarga`, `tlmtcarga_usuarioid`) VALUES ('$tlmtcarga_fechaoperacion', '$tlmtcarga_nroregistros', '$tlmtcarga_fechacarga', '$tlmtcarga_usuarioid')";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		$this->conexion=null;
	}

	function control_facilitador_id_hist($Programacion_Id)
	{
		$consulta= "SELECT * FROM `OPE_ControlFacilitador` WHERE `Programacion_Id`='$Programacion_Id' ";
        $resultado = $this->conexion2->prepare($consulta);
        $resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion2=null;
	}

	function control_facilitador_id($Programacion_Id)
	{
		$consulta= "SELECT * FROM `OPE_ControlFacilitador` WHERE `Programacion_Id`='$Programacion_Id' ";
        $resultado = $this->conexion ->prepare($consulta);
        $resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function LeerTipoTablaComportamiento()
	{
        $consulta="SELECT * FROM `OPE_TipoTablaComportamiento`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;
   	}   
		 
	function CrearTipoTablaComportamiento($TtablaComportamiento_Id,$TtablaComportamiento_Tipo,$TtablaComportamiento_Operacion,$TtablaComportamiento_Detalle)
	{
		$consulta = "INSERT INTO `OPE_TipoTablaComportamiento`(`TtablaComportamiento_Tipo`, `TtablaComportamiento_Operacion`, `TtablaComportamiento_Detalle`) VALUES ('$TtablaComportamiento_Tipo','$TtablaComportamiento_Operacion','$TtablaComportamiento_Detalle')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT * FROM `OPE_TipoTablaComportamiento`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;	
	}  	
	
	function EditarTipoTablaComportamiento($TtablaComportamiento_Id,$TtablaComportamiento_Tipo,$TtablaComportamiento_Operacion,$TtablaComportamiento_Detalle)
	{
		$consulta = "UPDATE `OPE_TipoTablaComportamiento` SET `TtablaComportamiento_Tipo`='$TtablaComportamiento_Tipo',`TtablaComportamiento_Operacion`='$TtablaComportamiento_Operacion',`TtablaComportamiento_Detalle`='$TtablaComportamiento_Detalle' WHERE `TtablaComportamiento_Id`='$TtablaComportamiento_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `OPE_TipoTablaComportamiento` WHERE `TtablaComportamiento_Id` ='$TtablaComportamiento_Id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;	
	}  		
	
	function BorrarTipoTablaComportamiento($TtablaComportamiento_Id)
	{
		$consulta = "DELETE FROM `OPE_TipoTablaComportamiento` WHERE `TtablaComportamiento_Id`='$TtablaComportamiento_Id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

}