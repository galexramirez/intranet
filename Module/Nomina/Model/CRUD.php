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

		$consulta = " SELECT CONCAT(`inas_fechaoperacion`,`inas_dni`) AS `FechaDNI` FROM `ope_inasistencias` WHERE `inas_fechaoperacion`>='$fecha_inicio' AND `inas_fechaoperacion`<='$fecha_termino' AND `inas_tiponovedad`='INASISTENCIA_TOTAL' AND `inas_estadoinasistencias`='CIERRE OPERACIONAL' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data_inasistencias =$resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach($data_inasistencias as $row){
			$key = array_search($row['FechaDNI'], array_column($data_horas,'FechaDNI'));
			unset($data_horas[$key]);
		}
		$data = array_values($data_horas);
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

}