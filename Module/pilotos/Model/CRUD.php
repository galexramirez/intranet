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
		foreach($data as $row){
			$cacces_moduloid = $row['Modulo_Id'];
		}

		$consulta = "SELECT * FROM `glo_objetos` WHERE `glo_objetos`.`obj_nombre` = '$cacces_nombreobjeto'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		foreach($data as $row){
			$cacces_objetosid = $row['objetos_id'];
		}

		$consulta = "SELECT * FROM `glo_controlaccesos` WHERE `cacces_perfil` = '$cacces_perfil' AND `cacces_moduloid` = '$cacces_moduloid' AND `cacces_objetosid` = '$cacces_objetosid'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($data as $row){
			$rptapermisos = $row['cacces_acceso'];
		}
		return $rptapermisos;
		$this->conexion = null;
	}

	function auto_completar($NombreTabla,$NombreCampo)
	{
		$consulta = "SELECT * FROM `$NombreTabla` WHERE `Colab_CargoActual` = 'PILOTO DE BUS ALIMENTADOR' OR `Colab_CargoActual` = 'PILOTO DE BUS ARTICULADO'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	///::: Registro de Marcacion :::///
	function marcacion($lat, $long, $marc_dni, $marc_nombre_colaborador, $marc_codigo_colaborador, $marc_fecha_operacion, $marc_lugar_exacto, $marc_estado)
	{
		$consulta = "INSERT INTO `ope_marcaciones` (`marc_dni`, `marc_codigo_colaborador`, `marc_nombre_colaborador`, `marc_fecha_operacion`, `marc_lugar_exacto`, `marc_latitud`, `marc_longitud`, `marc_estado`) VALUES('$marc_dni', '$marc_codigo_colaborador', '$marc_nombre_colaborador', '$marc_fecha_operacion', '$marc_lugar_exacto', '$lat', '$long', '$marc_estado')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function comunicados_destacados_vigentes()
	{
		$fecha_actual = date("Y-m-d");
		$comu_estado = "ACTIVO";
		$comu_categoria = "'INFORMATIVO','AVISO'";
		$comu_destacado = "1";
		$consulta = "SELECT * FROM `comunicado` WHERE `Comu_Estado` = '$comu_estado' AND `Comu_FechaInicio` <= '$fecha_actual' AND `Comu_FechaFin` >= '$fecha_actual' AND `Comu_Destacado`='$comu_destacado' AND `Comu_Categoria` IN ($comu_categoria) ORDER BY `Comu_FechaInicio` DESC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function comunicados_vigentes()
	{
		$fecha_actual = date("Y-m-d");
		$comu_estado = "ACTIVO";
		$comu_categoria = "'INFORMATIVO','AVISO'";
		$consulta = "SELECT * FROM `comunicado` WHERE `Comu_Estado` = '$comu_estado' AND `Comu_FechaInicio` <= '$fecha_actual' AND `Comu_FechaFin` >= '$fecha_actual' AND `Comu_Categoria` IN ($comu_categoria) ORDER BY `Comu_FechaInicio` DESC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function sig_destacados_vigentes()
	{
		$fecha_actual = date("Y-m-d");
		$comu_estado = "ACTIVO";
		$comu_categoria = "'SIG'";
		$comu_destacado = "1";
		$consulta = "SELECT * FROM `comunicado` WHERE `Comu_Estado` = '$comu_estado' AND `Comu_FechaInicio` <= '$fecha_actual' AND `Comu_FechaFin` >= '$fecha_actual' AND `Comu_Destacado`='$comu_destacado' AND `Comu_Categoria` IN ($comu_categoria) ORDER BY `Comu_FechaInicio` DESC";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function sig_vigentes()
	{
		$fecha_actual = date("Y-m-d");
		$comu_estado = "ACTIVO";
		$comu_categoria = "'SIG'";
		$consulta = "SELECT * FROM `comunicado` WHERE `Comu_Estado` = '$comu_estado' AND `Comu_FechaInicio` <= '$fecha_actual' AND `Comu_FechaFin` >= '$fecha_actual' AND `Comu_Categoria` IN ($comu_categoria) ORDER BY `Comu_FechaInicio` DESC";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function informativos_destacados_activos()
	{
		$comu_estado = "ACTIVO";
		$consulta = "SELECT * FROM `comunicado` WHERE `Comu_Estado` = '$comu_estado' ORDER BY `Comu_FechaInicio` DESC";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function informativos_activos()
	{
		$comu_estado = "ACTIVO";
		$consulta = "SELECT * FROM `comunicado` WHERE `Comu_Estado` = '$comu_estado' ORDER BY `Comu_FechaInicio` DESC";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function listado_publicacion()
	{
		$comu_estado = "ACTIVO";
        $consulta="SELECT `Comunicado_Id`, `Comu_Titulo`, `Comu_FechaInicio`, `Comu_FechaFin`, `Comu_Destacado`, `Comu_Categoria`, `Comu_Imagen`, `Comu_Pdf`, `Comu_Video`, `Comu_Link`, `Comu_Estado`, `colaborador`.`Colab_nombre_corto` AS `Comu_Usuario`, `Comu_Fecha_Creacion` FROM `comunicado` LEFT JOIN `colaborador` ON `colaborador`.`Colaborador_id`=`comunicado`.`Comu_Usuario_Creacion` WHERE `Comu_Estado`='".$comu_estado."'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function crear_publicacion($comu_titulo, $comu_fecha_inicio, $comu_fecha_fin, $comu_categoria, $comu_destacado, $nombre_imagen, $comu_estado, $nombre_pdf, $comu_video, $comu_link)
   	{
		$comu_usuario_creacion = $_SESSION['USUARIO_ID'];
        $comu_fecha_creacion = date("Y-m-d H:i:s");
		$consulta = "INSERT INTO `comunicado` (`Comu_Titulo`, `Comu_FechaInicio`, `Comu_FechaFin`, `Comu_Destacado`, `Comu_Imagen`, `Comu_Categoria`, `Comu_Estado`, `Comu_Pdf`, `Comu_Video`, `Comu_Link`, `Comu_Usuario_Creacion`, `Comu_Fecha_Creacion`) VALUES ('$comu_titulo', '$comu_fecha_inicio', '$comu_fecha_fin', '$comu_destacado', '$nombre_imagen', '$comu_categoria', '$comu_estado', '$nombre_pdf', '$comu_video', '$comu_link', '$comu_usuario_creacion', '$comu_fecha_creacion')";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

        $this->conexion=null;
	}
	
	function borrar_publicacion($comunicado_id)
   	{
		$comu_usuario_eliminacion = $_SESSION['USUARIO_ID'];
        $comu_fecha_eliminacion = date("Y-m-d H:i:s");
		$comu_estado = "INACTIVO";
		$consulta = "UPDATE `comunicado` SET `Comu_Estado`='$comu_estado', `Comu_Usuario_Eliminacion`='$comu_usuario_eliminacion', `Comu_Fecha_Eliminacion`='$comu_fecha_eliminacion' WHERE `Comunicado_Id`='$comunicado_id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;	
	}  		

	function accidentes_piloto($colaborador_id, $fecha_inicio, $fecha_termino, $acci_responsabilidad)
	{
		$consulta = "SELECT 
						`Accidentabilidad_id`,
						DATE_FORMAT(`Acci_FechaAccidente`, '%d-%m-%Y') AS `Acci_FechaAccidenteF`,
						`Acci_Responsabilidad`,
						`Acci_Evento` 
					FROM `accidentabilidad` 
					WHERE 
						`Acci_DniPiloto` = '$colaborador_id' AND 
						`Acci_Responsabilidad`= '$acci_responsabilidad' AND
						`Acci_FechaAccidente`>='$fecha_inicio' AND
						`Acci_FechaAccidente`<'$fecha_termino' AND 
						`Acci_FechaAccidente`<'2023-05-16'
					UNION SELECT 
						`OPE_AccidentesInformePreliminar`.`Accidentes_Id` AS `Accidentabilidad_id`,
						DATE_FORMAT(`OPE_AccidentesInformePreliminar`.`Acci_Fecha`, '%d-%m-%Y') AS `Acci_FechaAccidenteF`,
						`OPE_AccidentesInvestigacion`.`Acci_ResponsabilidadAccidente` AS `Acci_Responsabilidad`,
						`OPE_AccidentesInformePreliminar`.`Acci_TipoEvento` AS `Acci_Evento`
	 				FROM `OPE_AccidentesInformePreliminar`
					LEFT JOIN `OPE_AccidentesInvestigacion`
					ON
						`OPE_AccidentesInformePreliminar`.`Accidentes_Id` = `OPE_AccidentesInvestigacion`.`Accidentes_Id`
	 				WHERE 
						`OPE_AccidentesInformePreliminar`.`Acci_Dni`='$colaborador_id' AND
	 					`Acci_ResponsabilidadAccidente`='$acci_responsabilidad' AND
						`OPE_AccidentesInformePreliminar`.`Acci_Fecha`>='$fecha_inicio' AND 
						`OPE_AccidentesInformePreliminar`.`Acci_Fecha`<'$fecha_termino'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function data_accidente($accidente_id)
	{
		$consulta = "	SELECT 
							* 
						FROM `accidentabilidad` 
						WHERE 
							`Accidentabilidad_id` = '$accidente_id' 
						UNION
						SELECT
							`OPE_AccidentesInformePreliminar`.`OPE_AcciInformePreliminarId` AS `Accidentabilidad_id`,
							`OPE_AccidentesInformePreliminar`.`Accidentes_Id` AS `Acci_CodApl`,
    						`OPE_AccidentesInformePreliminar`.`Acci_Fecha` AS `Acci_FechaAccidente`,
    						`OPE_AccidentesInformePreliminar`.`Acci_Hora` AS `Acci_HoraDeAccidente`,
    						`OPE_AccidentesInformePreliminar`.`Acci_NombreCGO` AS `Acci_NombreDeCgo`,
    						`OPE_AccidentesInformePreliminar`.`Acci_Dni` AS `Acci_DniPiloto`,
    						`OPE_AccidentesInformePreliminar`.`Acci_CodigoColaborador` AS `Acci_CodigoPiloto`,
    						`OPE_AccidentesInformePreliminar`.`Acci_NombreColaborador` AS `Acci_NombreDePiloto`,
    						`colaborador`.`Colab_FechaIngreso` AS `Acci_FechaDeIngreso`,
    						TIMESTAMPDIFF(YEAR, `colaborador`.`Colab_FechaIngreso`, `OPE_AccidentesInformePreliminar`.`Acci_Fecha`) AS `Acci_AntiguedadDePiloto`,
							`OPE_AccidentesInformePreliminar`.`Acci_Tabla` AS `Acci_Tabla`,
							`OPE_AccidentesInformePreliminar`.`Acci_Bus` AS `Acci_NumBus`,
    						`OPE_AccidentesInformePreliminar`.`Acci_Servicio` AS `Acci_Servicio`,
    						`OPE_AccidentesInformePreliminar`.`Acci_Lugar` AS `Acci_DireccionAccidente`,
    						`OPE_AccidentesInformePreliminar`.`Acci_Sentido` AS `Acci_SentidoAccidente`,
    						`OPE_AccidentesInformePreliminar`.`Acci_TipoAccidente` AS `Acci_ClaseDeAccidente`,
							`OPE_AccidentesInformePreliminar`.`Acci_TipoEvento` AS `Acci_Evento`,
    						`OPE_AccidentesInformePreliminar`.`Acci_Descripcion` AS `Acci_OcurrenciaAccidente`,
							`OPE_AccidentesInformePreliminar`.`Acci_ReconoceResponsabilidad` AS `Acci_PilotoReconoceResponsabilidad`,
    						`OPE_AccidentesInformePreliminar`.`Acci_DanosMateriales` AS `Acci_DañosVehiculoLbi`,
							`OPE_AccidentesInformePreliminar`.`Acci_Conciliacion` AS `Acci_Conciliado`,
    						'SOLES' AS `Acci_Moneda`,
							`OPE_AccidentesInformePreliminar`.`Acci_MontoConciliado` AS `Acci_Monto`,
							`OPE_AccidentesInformePreliminar`.`Acci_Comisaria` AS `Acci_TramitePolicial`,
    						`OPE_AccidentesInformePreliminar`.`Acci_NombrePersonalApoyo` AS `Acci_AsistioAccidente`,
    						`OPE_AccidentesInvestigacion`.`Acci_FactorDeterminante` AS `Acci_FaltaCometidaPorElPiloto`,
    						`OPE_AccidentesInvestigacion`.`Acci_FactorContributivo` AS `Acci_FaltaCometida2`,
    						`OPE_AccidentesInvestigacion`.`Acci_ResponsabilidadContributivo` AS `Acci_ResponsabilidadDeFalta2`,
							`OPE_AccidentesInvestigacion`.`Acci_GravedadEvento` AS `Acci_GravedadDeEvento`,
    						'0.00' AS `Acci_CostoTotalDeAccidente`,
							`OPE_AccidentesInvestigacion`.`Acci_ResponsabilidadAccidente` AS `Acci_Responsabilidad`,
    						`OPE_AccidentesInvestigacion`.`Acci_Fecha_Cierre` AS `Acci_FechaCarga`
						FROM 
							`OPE_AccidentesInformePreliminar`
						LEFT JOIN
							`OPE_AccidentesInvestigacion`
						ON
							`OPE_AccidentesInformePreliminar`.`Accidentes_Id` = `OPE_AccidentesInvestigacion`.`Accidentes_Id`
						LEFT JOIN
							`colaborador`
						ON
							`OPE_AccidentesInformePreliminar`.`Acci_Dni` = `colaborador`.`Colaborador_id`
						WHERE 
							`OPE_AccidentesInformePreliminar`.`Accidentes_Id` = '$accidente_id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function punto_fijo_piloto($colaborador_id, $fecha_inicio, $fecha_termino)
	{
		$consulta = "SELECT 
						`PuntoFijo_id`, 
						`Puntofijo_FechaDelEvento`,
						`Puntofijo_TipologiaMulta`,
						`Puntofijo_AccionCorrectiva` 
 					FROM `puntofijo` 
 					WHERE `Puntofijo_Dni`='$colaborador_id' AND
						`Puntofijo_FechaDelEvento`>='$fecha_inicio' AND 
						`Puntofijo_FechaDelEvento`<'$fecha_termino'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function data_punto_fijo($punto_fijo_id)
	{
		$consulta = "SELECT * FROM `puntofijo` WHERE `PuntoFijo_id`='$punto_fijo_id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function acompanamiento_piloto($colaborador_id, $fecha_inicio, $fecha_termino)
	{
		$consulta = "SELECT 
						`Acompañamiento_id`, 
						DATE_FORMAT(`Acomp_Fecha`, '%d-%m-%Y') as `Acomp_FechaF`,`Acomp_CalificacionSeguridad`,
						`Acomp_CalificacionCalidad`,
						`Acomp_NotaFinal`
 					FROM `acompañamiento` 
 					WHERE 
						`Acomp_Dni`='$colaborador_id' AND
						`Acomp_Fecha`>='$fecha_inicio' AND 
						`Acomp_Fecha`<'$fecha_termino'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function data_acompanamiento($acompanamiento_id)
	{
		$consulta = "SELECT * FROM `acompañamiento` WHERE `Acompañamiento_Id`='$acompanamiento_id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function comportamiento_piloto($colaborador_id, $fecha_inicio, $fecha_termino, $estado_comportamiento)
	{
		$consulta = "SELECT 
						`comportamiento_id` AS `Comportamiento_id`, 
						DATE_FORMAT(`comp_fechaoperacion`, '%d-%m-%Y') AS `Comp_FechaEventoF`, 
						`comp_detallenovedad` AS `Comp_DetalleNovedad`, 
						'PENDIENTE-GH' AS `Comp_TipoDisciplina` 
					FROM `ope_comportamiento` 
					WHERE 
						`comp_dni`='$colaborador_id' AND 
						`comp_fechaoperacion`>='$fecha_inicio' AND `comp_fechaoperacion`<'$fecha_termino' AND `comp_estadocomportamiento`='$estado_comportamiento'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function data_comportamiento($comportamiento_id)
	{
		$consulta = 	"SELECT 
							`ope_comportamientoid` AS `Comportamiento_Id`,
							`comportamiento_id` AS `Comp_ID`,
							`comp_nombrecgo` AS `Comp_Nombre CGO`,
							`comp_fechaoperacion` AS `Comp_FechaEvento`,
							`comp_dni` AS `Comp_Dni`,
							`comp_codigocolaborador` AS `Comp_CodPiloto`,
							`comp_nombrecolaborador` AS `Comp_NombrePiloto`,
							`comp_bus` AS `Comp_Bus`,
							`comp_cargo_colaborador` AS `Comp_TipoPiloto`,
							`comp_tabla` AS `Comp_Tabla`,
							`comp_servicio` AS `Comp_Servicio`,
							`comp_detallenovedad` AS `Comp_DetalleNovedad`,
							`comp_descripcion` AS `Comp_DescripNovedad`,
							`comp_faltacometida` AS `Comp_AccionDisciplinaria`,
							`comp_codigofalta` AS `Comp_CodigoDeFalta`,
							`comp_monto` AS `Comp_Monto`,
							`comp_reconoceresponsabilidad` AS `Comp_ReconoceResp`,
							'SI' AS `Comp_AfectaPremio`,
							'PENDIENTE G-H' AS `Comp_TipoDisciplina`,
							'ATENCION DIRECTA POR G-H.' AS `Comp_Observacion`,
							`comp_fechareportegdh` AS `Comp_FechaCarga`
						FROM `ope_comportamiento` 
						WHERE 
							`comportamiento_id`  = '$comportamiento_id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function ausencia_piloto($colaborador_id, $fecha_inicio, $fecha_termino, $estado_ausencia)
	{
		$consulta = "	SELECT 
							`inasistencias_id` AS `Inasistencia_id`,
							DATE_FORMAT(`inas_fechaoperacion`, '%d-%m-%Y') AS `Inas_FechaDeEventoF`, `inas_tiponovedad` AS `Inas_TipoNovedad`, 
							`inas_totalhoras` AS `Inas_TotalHoras` 
						FROM `ope_inasistencias` 
						WHERE 
							`inas_dni`='$colaborador_id' AND 
							`inas_fechaoperacion`>='$fecha_inicio' AND `inas_fechaoperacion`<'$fecha_termino' AND `inas_estadoinasistencias`='$estado_ausencia'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function data_ausencia($ausencia_id)
	{
		$consulta = 	"SELECT 
							`inasistencias_id` AS `Inasistencia_id`,
    						`inas_novedadid` AS `Inas_IdNovedad`,
    						`inas_nombrecgo` AS `Inas_NombreCGO`,
    						`inas_dni` AS `Inas_DNI`,
    						`inas_codigocolaborador` AS `Inas_CodPiloto`,
    						`inas_nombrecolaborador` AS `Inas_NombrePiloto`,
    						`inas_cargo_colaborador` AS `Inas_TipoPiloto`,
    						`inas_fechaoperacion` AS `Inas_FechaDeEvento`,
    						`inas_horainicio` AS `Inas_HoraInicio`,
    						`inas_horafin` AS `Inas_HoraFinal`,
    						`inas_totalhoras` AS `Inas_TotalHoras`,
    						`inas_bus` AS `Inas_Bus`,
    						`inas_operacion` AS `Inas_TipoBus`,
    						`inas_tabla` AS `Inas_Tabla`,
    						`inas_servicio` AS `Inas_Servicio`,
    						`inas_tiponovedad` AS `Inas_TipoNovedad`,
    						`inas_detallenovedad` AS `Inas_DetalleNovedad`,
    						`inas_descripcion` AS `Inas_DescripNovedad`,
    						`inas_fechareportegdh` AS `Inas_FechaCarga`
						FROM 
							`ope_inasistencias` 
						WHERE 
							`inasistencias_id` = '$ausencia_id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}


}