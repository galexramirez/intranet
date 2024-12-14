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

	///:: NOVEDADES DE PILOTO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

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

	function buscar_inasistencias($fecha_inicio, $fecha_termino)
	{
		$inas_estadoinasistencias = 'CIERRE OPERACIONAL';
		$consulta = "	SELECT
    						`ope_inasistencias`.`inasistencias_id`,
    						`ope_inasistencias`.`inas_nombrecolaborador`,
    						`ope_inasistencias`.`inas_dni`,
							`ope_inasistencias`.`inas_fechaoperacion`,
							TIME_FORMAT(`ope_inasistencias`.`inas_horainicio`,'%H:%i') AS `inas_horainicio`,
    						TIME_FORMAT(`ope_inasistencias`.`inas_horafin`,'%H:%i') AS `inas_horafin`,
    						TIME_FORMAT(`ope_inasistencias`.`inas_totalhoras`,'%H:%i') AS `inas_totalhoras`,
							`ope_inasistencias`.`inas_tiponovedad`,
    						`ope_inasistencias`.`inas_detallenovedad`,
    						`ope_inasistencias`.`inas_descripcion`,
							`ope_inasistencias`.`inas_turno`,
							(SELECT `ope_novedad_colaborador_detalle`.`noco_novedad` FROM `ope_novedad_colaborador_detalle` WHERE `ope_novedad_colaborador_detalle`.`noco_colaborador_id`=`ope_inasistencias`.`inas_dni` AND `ope_novedad_colaborador_detalle`.`noco_fecha_inicio`<=`ope_inasistencias`.`inas_fechaoperacion` AND `ope_novedad_colaborador_detalle`.`noco_fecha_fin`>=`ope_inasistencias`.`inas_fechaoperacion` LIMIT 1) AS `noco_novedad`
						FROM 
							`ope_inasistencias`
						WHERE 
							`ope_inasistencias`.`inas_fechaoperacion`>='$fecha_inicio' AND 
							`ope_inasistencias`.`inas_fechaoperacion`<='$fecha_termino' AND 
							`ope_inasistencias`.`inas_estadoinasistencias`='$inas_estadoinasistencias' 
						ORDER BY 
							`ope_inasistencias`.`inasistencias_id` DESC";
		
        $resultado 	= $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   

	function ver_inasistencias($inasistencias_id)
	{
		$consulta=" SELECT * FROM `ope_inasistencias` LEFT JOIN `colaborador` ON `colaborador`.`Colaborador_id`=`ope_inasistencias`.`inas_usuarioid_edicion` WHERE `ope_inasistencias`.`inasistencias_id`='$inasistencias_id' ";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;
        $this->conexion=null;
   	}   

	function buscar_comportamientos($fecha_inicio, $fecha_termino)
	{
		$comp_estadocomportamiento = "CIERRE OPERACIONAL";
		$consulta = " SELECT `comportamiento_id`, `comp_fechaoperacion`, `comp_dni`, `comp_nombrecolaborador`, `comp_detallenovedad`, `comp_descripcion`, `comp_faltacometida`, `comp_codigofalta`, IF(`comp_premio`='SI','NO','SI') AS `comp_afectapremio`, TIME_FORMAT(`ope_comportamiento`.`comp_horainicio`,'%H:%i') AS `comp_horainicio`, `ope_comportamiento`.`comp_tiponovedad` FROM `ope_comportamiento` WHERE `ope_comportamiento`.`comp_fechaoperacion`>='$fecha_inicio' AND `ope_comportamiento`.`comp_fechaoperacion`<='$fecha_termino' AND `ope_comportamiento`.`comp_estadocomportamiento`='$comp_estadocomportamiento' ORDER BY `ope_comportamiento`.`comportamiento_id` DESC";
		
        $resultado 	= $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   

	function ver_comportamiento($comportamiento_id)
	{
		$consulta="SELECT * FROM `ope_comportamiento` LEFT JOIN `colaborador` ON `colaborador`.`Colaborador_id`=`ope_comportamiento`.`comp_usuarioid_edicion` WHERE `ope_comportamiento`.`comportamiento_id`='$comportamiento_id'";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;
        $this->conexion=null;
   	}   

	function buscar_accidentes($fecha_inicio, $fecha_termino)
	{
		$consulta="SELECT 
						`OPE_AccidentesInformePreliminar`.`Accidentes_Id`, 
						`OPE_AccidentesInformePreliminar`.`Acci_Fecha`, 
						`OPE_AccidentesInformePreliminar`.`Acci_Hora`, 
						`OPE_AccidentesInformePreliminar`.`Acci_Dni`, 
						`OPE_AccidentesInformePreliminar`.`Acci_NombreColaborador`,
						`OPE_AccidentesInformePreliminar`.`Acci_TipoAccidente`, 
						`OPE_AccidentesInformePreliminar`.`Acci_TipoEvento`, 
						`OPE_AccidentesInformePreliminar`.`Acci_Descripcion`, 
						`OPE_AccidentesInformePreliminar`.`Acci_ReconoceResponsabilidad`,
						`OPE_AccidentesInvestigacion`.`Acci_FactorDeterminante`, 
						`OPE_AccidentesInvestigacion`.`Acci_FactorContributivo`, 
						`OPE_AccidentesInvestigacion`.`Acci_CodigoRIT`, 
						`OPE_AccidentesInvestigacion`.`Acci_DescripcionRIT`, 
						IF(`OPE_AccidentesInvestigacion`.`Acci_Premio`='NO','SI','NO') AS `acci_afecta_premio`,
						`OPE_AccidentesInvestigacion`.`Acci_ResponsabilidadAccidente`
					FROM 
						`OPE_Accidentes` 
					LEFT JOIN 
						`OPE_AccidentesInformePreliminar` 
					ON 
						`OPE_AccidentesInformePreliminar`.`Accidentes_Id` = `OPE_Accidentes`.`Accidentes_Id` 
					LEFT JOIN 
						`OPE_AccidentesInvestigacion` 
					ON 
						`OPE_AccidentesInvestigacion`.`Accidentes_Id` = `OPE_Accidentes`.`Accidentes_Id` 
					WHERE  
						`OPE_Accidentes`.`Acci_FechaOperacion`>='$fecha_inicio' AND 
						`OPE_Accidentes`.`Acci_FechaOperacion`<='$fecha_termino' AND 
						`OPE_AccidentesInvestigacion`.`Acci_ReporteGDH`='SI' 
					ORDER BY 
						`OPE_Accidentes`.`Accidentes_Id` DESC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		$this->conexion=null;
	}   

	function leer_novedad_carga($anio)
	{
		$consulta="SELECT *, `colaborador`.`Colab_nombre_corto` AS `noco_nombres_usuario` FROM `ope_novedad_colaborador_carga` LEFT JOIN `colaborador` ON `colaborador`.`Colaborador_id` = `ope_novedad_colaborador_carga`.`noco_usuario_id` WHERE YEAR(`ope_novedad_colaborador_carga`.`noco_fecha`)='$anio' ORDER BY `ope_novedad_colaborador_carga`.`noco_fecha` DESC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);
		$this->conexion=null;
	}   

	function crear_novedad_detalle($noco_novedad_id, $noco_colaborador_id, $noco_novedad, $noco_fecha_inicio, $noco_fecha_fin, $noco_codigo_carga)
	{
		$consulta = " INSERT INTO `ope_novedad_colaborador_detalle`	(`noco_novedad_id`,	`noco_colaborador_id`, `noco_novedad`, `noco_fecha_inicio`, `noco_fecha_fin`, `noco_codigo_carga`) VALUES ('$noco_novedad_id', '$noco_colaborador_id', '$noco_novedad', '$noco_fecha_inicio', '$noco_fecha_fin', '$noco_codigo_carga') ";
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

	function crear_novedad_carga($noco_codigo_carga, $noco_fecha, $noco_registros, $noco_usuario_id)
	{
		$consulta = " INSERT INTO `ope_novedad_colaborador_carga` (`noco_codigo_carga`, `noco_fecha`, `noco_registros`, `noco_usuario_id`) VALUES ('$noco_codigo_carga', '$noco_fecha', '$noco_registros', '$noco_usuario_id') ";
		$resultado = $this->conexion->prepare($consulta);
	 	$resultado->execute();   

		$this->conexion=null;	
	}

	function buscar_novedad_detalle($fecha_inicio, $fecha_termino)
	{
		$consulta="SELECT 
						`ope_novedad_colaborador_detalle`.`noco_codigo_carga`,
						UPPER(MONTHNAME(`ope_novedad_colaborador_detalle`.`noco_fecha_inicio`)) AS `noco_mes`,
						`ope_novedad_colaborador_detalle`.`noco_colaborador_id`,
						`colaborador`.`Colab_ApellidosNombres` AS `noco_nombres_colaborador`,
						`ope_novedad_colaborador_detalle`.`noco_novedad`,
						`ope_novedad_colaborador_detalle`.`noco_fecha_inicio`,
						`ope_novedad_colaborador_detalle`.`noco_fecha_fin`,
						DATEDIFF(`ope_novedad_colaborador_detalle`.`noco_fecha_fin`,`ope_novedad_colaborador_detalle`.`noco_fecha_inicio`)+1 AS `noco_dias`
					FROM `ope_novedad_colaborador_detalle`
					LEFT JOIN
						`colaborador`
					ON 
						`colaborador`.`Colaborador_id` = `ope_novedad_colaborador_detalle`.`noco_colaborador_id`
					WHERE  
						`ope_novedad_colaborador_detalle`.`noco_fecha_inicio`>='$fecha_inicio' AND 
						`ope_novedad_colaborador_detalle`.`noco_fecha_inicio`<='$fecha_termino'
					ORDER BY 
					`ope_novedad_colaborador_detalle`.`noco_fecha_inicio` DESC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		$this->conexion=null;
	}   

	function borrar_novedad_carga($noco_codigo_carga)
	{
		$consulta = " DELETE FROM `ope_novedad_colaborador_detalle` WHERE `ope_novedad_colaborador_detalle`.`noco_codigo_carga`='$noco_codigo_carga' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        

		$consulta = " DELETE FROM `ope_novedad_colaborador_carga` WHERE `ope_novedad_colaborador_carga`.`noco_codigo_carga`='$noco_codigo_carga' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        

		$this->conexion=null;
	}
}