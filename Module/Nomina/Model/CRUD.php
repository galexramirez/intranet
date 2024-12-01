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
		$this->conexion = $Instancia->Conectar();
		$this->conexion2 = $Instancia->conectar2();
		$this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->conexion2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	function select_combo($nombre_tabla, $es_campo_unico, $campo_select, $condicion_where, $order_by)
	{
		$distinct 	= "";
		$c_where 	= "";
		$c_order_by = "";
		if($es_campo_unico == "SI"){
			$distinct = "DISTINCT";
		}
		if($condicion_where!==""){
			$c_where = "WHERE ".$condicion_where;
		}
		if($order_by!==""){
			$c_order_by = "ORDER BY ".$order_by;
		}
		$consulta = "SELECT ".$distinct." `$nombre_tabla`.`$campo_select` AS `detalle` FROM `$nombre_tabla` ".$c_where." ".$c_order_by;
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

	function listar_nomina($fecha_inicio,$fecha_termino)
	{
		$consulta = "	SELECT 
							ANY_VALUE(DATE_FORMAT( `Prog_Fecha`,'%d-%m-%Y')) AS Fecha, 
							ANY_VALUE( `Prog_CodigoColaborador`) AS Codigo, 
							`Prog_Dni` AS DNI, 
							ANY_VALUE( `Prog_NombreColaborador`) AS ApellidosNombres, 
							TIME_FORMAT(MIN( `Prog_HoraOrigen`),'%H:%i') AS HoraInicio, 
							TIME_FORMAT(MAX( `Prog_HoraDestino`),'%H:%i') AS HoraTermino,
							TIME_FORMAT(SUBTIME(MAX( `Prog_HoraDestino`),MIN( `Prog_HoraOrigen`)),'%H:%i') AS Amplitud, 
							TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(SUBTIME( `Prog_HoraDestino`,`Prog_HoraOrigen`)))),'%H:%i') AS Duracion, 
							ANY_VALUE( `Prog_Operacion`) AS TipoOperacion, 
							ANY_VALUE( `Prog_Servicio`) AS Servicio 
						FROM 
							`Programacion` 
						GROUP BY 
							`Prog_Fecha`, 
							`Prog_Dni` 
						HAVING 
							`Prog_Fecha`>='$fecha_inicio' AND 
							`Prog_Fecha`<='$fecha_termino' ";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}

	function leer_nomina_programacion($fecha_inicio,$fecha_termino)
	{
		$consulta = "	SELECT 
							ANY_VALUE(DATE_FORMAT( `Prog_Fecha`,'%Y-%m-%d')) AS Fecha, 
							ANY_VALUE( `Prog_CodigoColaborador`) AS Codigo, 
							`Prog_Dni` AS DNI, 
							ANY_VALUE( `Prog_NombreColaborador`) AS ApellidosNombres, 
							TIME_FORMAT(MIN( `Prog_HoraOrigen`),'%H:%i') AS HoraInicio, 
							TIME_FORMAT(MAX( `Prog_HoraDestino`),'%H:%i') AS HoraTermino,
							TIME_FORMAT(SUBTIME(MAX( `Prog_HoraDestino`),MIN( `Prog_HoraOrigen`)),'%H:%i') AS Amplitud, 
							TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(SUBTIME( `Prog_HoraDestino`,`Prog_HoraOrigen`)))),'%H:%i') AS Duracion, 
							ANY_VALUE( `Prog_Operacion`) AS TipoOperacion, 
							ANY_VALUE( `Prog_Servicio`) AS Servicio 
						FROM 
							`Programacion` 
						GROUP BY 
							`Prog_Fecha`, 
							`Prog_Dni` 
						HAVING 
							`Prog_Fecha`>='$fecha_inicio' AND 
							`Prog_Fecha`<='$fecha_termino' ";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        return $data;
        $this->conexion=null;
   	}

	function leer_nomina_operacion($fecha_inicio,$fecha_termino)
	{   
	   	$consulta = "	SELECT 
						   ANY_VALUE(DATE_FORMAT( `Prog_Fecha`,'%Y-%m-%d')) AS Fecha, 
						   ANY_VALUE( `Prog_CodigoColaborador`) AS Codigo, 
						   `Prog_Dni` AS DNI, 
						   ANY_VALUE( `Prog_NombreColaborador`) AS ApellidosNombres, 
						   TIME_FORMAT(MIN( `Prog_HoraOrigen`),'%H:%i') AS HoraInicio, 
						   TIME_FORMAT(MAX( `Prog_HoraDestino`),'%H:%i') AS HoraTermino,
						   TIME_FORMAT(SUBTIME(MAX( `Prog_HoraDestino`),MIN( `Prog_HoraOrigen`)),'%H:%i') AS Amplitud, 
						   TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(SUBTIME( `Prog_HoraDestino`,`Prog_HoraOrigen`)))),'%H:%i') AS Duracion, 
						   ANY_VALUE( `Prog_Operacion`) AS TipoOperacion, 
						   ANY_VALUE( `Prog_Servicio`) AS Servicio,
						   CONCAT(ANY_VALUE(DATE_FORMAT( `Prog_Fecha`,'%Y-%m-%d')),`Prog_Dni`) AS `FechaDNI`
					   	FROM 
					   		`OPE_ControlFacilitador` 
					   	GROUP BY 
						   `Prog_Fecha`, 
						   `Prog_Dni` 
					   	HAVING 
						   `Prog_Fecha`>='$fecha_inicio' AND 
						   `Prog_Fecha`<='$fecha_termino' ";

	   	$resultado = $this->conexion->prepare($consulta);
	   	$resultado->execute();        
	   	$data_horas =$resultado->fetchAll(PDO::FETCH_ASSOC);

	   	$consulta = "	SELECT 
						   ANY_VALUE(DATE_FORMAT( `Prog_Fecha`,'%Y-%m-%d')) AS Fecha, 
						   ANY_VALUE( `Prog_CodigoColaborador`) AS Codigo, 
						   `Prog_Dni` AS DNI, 
						   ANY_VALUE( `Prog_NombreColaborador`) AS ApellidosNombres, 
						   TIME_FORMAT(MIN( `Prog_HoraOrigen`),'%H:%i') AS HoraInicio, 
						   TIME_FORMAT(MAX( `Prog_HoraDestino`),'%H:%i') AS HoraTermino,
						   TIME_FORMAT(SUBTIME(MAX( `Prog_HoraDestino`),MIN( `Prog_HoraOrigen`)),'%H:%i') AS Amplitud, 
						   TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(SUBTIME( `Prog_HoraDestino`,`Prog_HoraOrigen`)))),'%H:%i') AS Duracion, 
						   ANY_VALUE( `Prog_Operacion`) AS TipoOperacion, 
						   ANY_VALUE( `Prog_Servicio`) AS Servicio,
						   CONCAT(ANY_VALUE(DATE_FORMAT( `Prog_Fecha`,'%Y-%m-%d')),`Prog_Dni`) AS `FechaDNI`
					   	FROM 
					   		`OPE_ControlFacilitador` 
						WHERE
							`Prog_Servicio` = 'DISPONIBLE'
					   	GROUP BY 
						   `Prog_Fecha`, 
						   `Prog_Dni` 
					   	HAVING 
						   `Prog_Fecha`>='$fecha_inicio' AND 
						   `Prog_Fecha`<='$fecha_termino' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data_disponibles = $resultado->fetchAll(PDO::FETCH_ASSOC);

		$consulta = "	SELECT 
							ANY_VALUE(DATE_FORMAT( `Prog_Fecha`,'%Y-%m-%d')) AS Fecha, 
							ANY_VALUE( `Prog_CodigoColaborador`) AS Codigo, 
							`Prog_Dni` AS DNI, 
							ANY_VALUE( `Prog_NombreColaborador`) AS ApellidosNombres, 
							TIME_FORMAT(MIN( `Prog_HoraOrigen`),'%H:%i') AS HoraInicio, 
							TIME_FORMAT(MAX( `Prog_HoraDestino`),'%H:%i') AS HoraTermino,
							TIME_FORMAT(SUBTIME(MAX( `Prog_HoraDestino`),MIN( `Prog_HoraOrigen`)),'%H:%i') AS Amplitud, 
							TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(SUBTIME( `Prog_HoraDestino`,`Prog_HoraOrigen`)))),'%H:%i') AS Duracion, 
							ANY_VALUE( `Prog_Operacion`) AS TipoOperacion, 
							ANY_VALUE( `Prog_Servicio`) AS Servicio,
							CONCAT(ANY_VALUE(DATE_FORMAT( `Prog_Fecha`,'%Y-%m-%d')),`Prog_Dni`) AS `FechaDNI`
						FROM 
							`OPE_ControlFacilitador` 
	 					WHERE
							SUBSTRING(`Prog_NombreColaborador`,1,19) = 'SIN PILOTO ASIGNADO'
						GROUP BY 
							`Prog_Fecha`, 
							`Prog_Dni` 
						HAVING 
							`Prog_Fecha`>='$fecha_inicio' AND 
							`Prog_Fecha`<='$fecha_termino' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data_sin_piloto_asignado = $resultado->fetchAll(PDO::FETCH_ASSOC);

		$consulta = " SELECT CONCAT(`inas_fechaoperacion`,`inas_dni`) AS `FechaDNI` FROM `ope_inasistencias` WHERE `inas_fechaoperacion`>='$fecha_inicio' AND `inas_fechaoperacion`<='$fecha_termino' AND `inas_tiponovedad`='INASISTENCIA_TOTAL' AND `inas_estadoinasistencias`='CIERRE OPERACIONAL' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data_inasistencias = $resultado->fetchAll(PDO::FETCH_ASSOC);
/*
		$key = "";
		$key = array_search("", array_column($data_horas,'DNI'));
		if($key!==""){
			array_splice($data_horas, $key, 1);
		}
		 
		//:: Se eliminan los registros que no se deben mostrar en la nomina porque no tienen piloto asignado
		foreach($data_sin_piloto_asignado as $row){
			$key = "";
			$key = array_search($row['FechaDNI'], array_column($data_horas,'FechaDNI'));
			if($key!==""){
				array_splice($data_horas, $key, 1);
			}
		}

		//:: Se eliminan los registros que no se deben mostrar en la nomina porque tienen inasistencia total
		foreach($data_inasistencias as $row){
			$key = "";
			$key = array_search($row['FechaDNI'], array_column($data_horas,'FechaDNI'));
			if($key!==""){
				array_splice($data_horas, $key, 1);
			}
		}

		//:: Se eliminan los registros que no se deben mostrar en la nomina porque son pilotos disponibles
		foreach($data_disponibles as $row){
			$key = "";
			$key = array_search($row['FechaDNI'], array_column($data_horas,'FechaDNI'));
			if($key!==""){
				array_splice($data_horas, $key, 1);
			}
		}

		//:: Se eliminan los registros de pilotos disponibles que tienen inasistencia total
		foreach($data_inasistencias as $row){
			$key = "";
			$key = array_search($row['FechaDNI'], array_column($data_disponibles,'FechaDNI'));
			if($key!==""){
				array_splice($data_disponibles, $key, 1);
			}
		}

		//:: Se unen los registros de nomina horas y pilotos disponibles
		$data_array = array_merge($data_horas, $data_disponibles);    

		$key = 'FechaDNI';
		array_walk($data_array, function (&$v) use ($key) {
			unset($v[$key]);
		});
*/
		$data = array_values($data_horas);
		//$data = array_values($data_array);
		return $data;
	   	$this->conexion=null;
	}
   
	function leer_generar_nomina($ncar_anio)
	{   
	   $consulta = "	SELECT 
					    	`ope_nomina_carga`.`nomina_carga_id`,
							`ope_nomina_carga`.`ncar_anio`,
    						`ope_nomina_carga`.`ncar_periodo`,
    						`ope_nomina_carga`.`ncar_tipo`,
							`ope_nomina_carga`.`ncar_archivo`,
    						`ope_nomina_carga`.`ncar_fecha_inicio`,
    						`ope_nomina_carga`.`ncar_fecha_termino`,
    						`t_crea`.`Colab_nombre_corto` AS `ncar_usuario_genera`,
    						`ope_nomina_carga`.`ncar_fecha_crea`,
    						`t_elimina`.`Colab_nombre_corto` AS `ncar_usuario_elimina`,
    						`ope_nomina_carga`.`ncar_fecha_elimina`,
    						`ope_nomina_carga`.`ncar_estado`
						FROM 
						   `ope_nomina_carga`
						LEFT JOIN
						   `colaborador` AS `t_crea`
						ON
						   `ope_nomina_carga`.`ncar_usuario_id_crea`=`t_crea`.`Colaborador_id`
						LEFT JOIN
						   `colaborador` AS `t_elimina`
						ON
						   `ope_nomina_carga`.`ncar_usuario_id_elimina`=`t_elimina`.`Colaborador_id`
						WHERE
						   `ncar_anio`='$ncar_anio' ";

	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();        
	   $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
	   print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
	   $this->conexion=null;
	}

	function generar_nomina($ncar_anio, $ncar_periodo, $ncar_tipo, $ncar_fecha_inicio, $ncar_fecha_termino)
	{
		$ncar_estado = "GENERADO";
		$ncar_usuario_id_crea = $_SESSION['USUARIO_ID'];
		$ncar_fecha_crea = date("Y-m-d H:i:s");

		$consulta = " INSERT INTO `ope_nomina_carga` (`ncar_anio`,`ncar_periodo`,`ncar_tipo`,`ncar_fecha_inicio`,`ncar_fecha_termino`,`ncar_usuario_id_crea`,`ncar_fecha_crea`,`ncar_estado`) VALUES ('$ncar_anio', '$ncar_periodo', '$ncar_tipo', '$ncar_fecha_inicio', '$ncar_fecha_termino', '$ncar_usuario_id_crea', '$ncar_fecha_crea', '$ncar_estado') ";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        

		$nomina_carga_id = $this->conexion->lastInsertId();
		return $nomina_carga_id;

		$this->conexion=null;
	}

	function editar_generar_nomina($nomina_carga_id, $ncar_archivo)
	{
		$consulta = " UPDATE `ope_nomina_carga` SET `ncar_archivo`='$ncar_archivo' WHERE `nomina_carga_id`='$nomina_carga_id'  ";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        

		$this->conexion=null;
	}

	function borrar_generar_nomina($nomina_carga_id)
	{
		$ncar_estado = "ANULADO";
		$ncar_usuario_id_elimina = $_SESSION['USUARIO_ID'];
		$ncar_fecha_elimina = date("Y-m-d H:i:s");
		$consulta = " UPDATE `ope_nomina_carga` SET `ncar_estado`='$ncar_estado', `ncar_usuario_id_elimina`='$ncar_usuario_id_elimina', `ncar_fecha_elimina`='$ncar_fecha_elimina' WHERE `nomina_carga_id`='$nomina_carga_id' ";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        

		$this->conexion=null;
	}

	function leer_carga_horarios_nomina($chn_anio)
	{   
	   $consulta = "	SELECT 
	   						`id`, 
							`hnc_anio`, 
							`hnc_periodo`, 
							`hnc_tipo_nomina`, 
							`hnc_fecha`, 
							`hnc_operacion`, 
							`t_crea`.`Colab_nombre_corto` AS `hnc_usuario_crea`,
							`hnc_fecha_crea`, 
							`t_elimina`.`Colab_nombre_corto` AS `hnc_usuario_elimina`,
							`hnc_fecha_elimina`, 
							`hnc_estado`
						FROM 
						   `ope_horarios_nomina_carga` AS `t_hnc`
						LEFT JOIN
						   `colaborador` AS `t_crea`
						ON
						   `t_hnc`.`hnc_usuario_crea`=`t_crea`.`Colaborador_id`
						LEFT JOIN
						   `colaborador` AS `t_elimina`
						ON
						   `t_hnc`.`hnc_usuario_elimina`=`t_elimina`.`Colaborador_id`
						WHERE
						   `hnc_anio`='$chn_anio' ";
	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();        
	   $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
	   print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
	   $this->conexion=null;
	}

	function generar_carga_horarios_nomina($chn_anio, $chn_periodo, $chn_tipo_nomina, $chn_fecha, $chn_operacion, $chn_usuario_crea, $chn_fecha_crea, $chn_estado)
	{
		try {
			$consulta = " INSERT INTO `ope_horarios_nomina_carga` (`hnc_anio`, `hnc_periodo`, `hnc_tipo_nomina`, `hnc_fecha`, `hnc_operacion`, `hnc_usuario_crea`, `hnc_fecha_crea`, `hnc_estado`) VALUES ('$chn_anio', '$chn_periodo', '$chn_tipo_nomina', '$chn_fecha', '$chn_operacion', '$chn_usuario_crea', '$chn_fecha_crea', '$chn_estado') ";
			$resultado = $this->conexion->prepare($consulta);
        	$resultado->execute();        
			$horarios_nomina_carga_id = $this->conexion->lastInsertId();
			return $horarios_nomina_carga_id;
		} catch (PDOException $e) {
			$error = 'Excepción capturada: '. $e->getMessage(). "\n";
			return $error;
		}
		$this->conexion=null;
	}

	function leer_horarios_nomina_programacion($chn_fecha, $chn_operacion)
	{
		$prog_tabla = "OP11";
	   	$consulta = "SELECT 
	   					`Prog_Fecha`, 
						`Prog_Dni`, 
						`Prog_CodigoColaborador`, 
						`Prog_NombreColaborador`, 
						`Prog_HoraOrigen`, 
						`Prog_HoraDestino`, 
						`Prog_Operacion`, 
						`Prog_Servicio`, 
						`Prog_LugarOrigen`, 
						`Prog_LugarDestino` 
					FROM `Programacion` 
					WHERE 
						`Prog_Fecha` = '$chn_fecha' AND 
						`Prog_Operacion` = '$chn_operacion' AND
						`Prog_Tabla` != '$prog_tabla'
					ORDER BY 
						`Prog_Dni`, `Prog_HoraOrigen` ASC";
	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();        
	   $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
	   return $data;
	   $this->conexion=null;
	}
	
	function generar_horarios_nomina($horarios_nomina_carga_id, $chn_anio, $chn_periodo, $chn_tipo_nomina, $chn_operacion, $chn_fecha, $hn_dni, $hn_codigo_colaborador, $hn_nombre_colaborador, $hn_hora, $hn_servicio, $hn_lugar, $hn_tipo_marcacion, $hn_hora_programacion)
	{
		try {
			$consulta = " INSERT INTO `ope_horarios_nomina` (`hn_hnc_id`, `hn_anio`, `hn_periodo`, `hn_tipo_nomina`, `hn_operacion`, `hn_fecha`, `hn_dni`, `hn_codigo_colaborador`, `hn_nombre_colaborador`, `hn_hora`, `hn_servicio`, `hn_lugar`, `hn_tipo_marcacion`, `hn_hora_programacion`) VALUES ('$horarios_nomina_carga_id', '$chn_anio', '$chn_periodo', '$chn_tipo_nomina', '$chn_operacion', '$chn_fecha', '$hn_dni', '$hn_codigo_colaborador', '$hn_nombre_colaborador', '$hn_hora', '$hn_servicio', '$hn_lugar', '$hn_tipo_marcacion', '$hn_hora_programacion') ";
			$resultado = $this->conexion->prepare($consulta);
			$resultado->execute();        
			$horarios_nomina_id = $this->conexion->lastInsertId();
			return $horarios_nomina_id;	
		} catch (PDOException $e) {
			$error = 'Excepción capturada: '. $e->getMessage(). "\n";
			return $error;
		}
		$this->conexion=null;
	}

	function borrar_generar_horarios_nomina($horarios_nomina_carga_id)
	{
		$hnc_estado = "ANULADO";
		$hnc_usuario_elimina = $_SESSION['USUARIO_ID'];
		$hnc_fecha_elimina = date("Y-m-d H:i:s");

		$consulta = " UPDATE `ope_horarios_nomina_carga` SET `hnc_estado`='$hnc_estado', `hnc_usuario_elimina`='$hnc_usuario_elimina', `hnc_fecha_elimina`='$hnc_fecha_elimina' WHERE `id`='$horarios_nomina_carga_id' ";
		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        

		$consulta = " DELETE FROM `ope_horarios_nomina` WHERE `hn_hnc_id`='$horarios_nomina_carga_id' ";
		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        

		$this->conexion=null;
	}

	function listar_horarios_nomina($hn_fecha,$hn_operacion)
	{
		$consulta = "	SELECT 
							*
						FROM 
							`ope_horarios_nomina` 
						WHERE 
							`hn_fecha` = '$hn_fecha' AND 
							`hn_operacion` = '$hn_operacion' 
						ORDER BY 
							`hn_dni`, `hn_hora` ";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}

}