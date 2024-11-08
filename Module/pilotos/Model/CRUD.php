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
	function marcacion($lat, $long, $marc_dni, $marc_nombre_colaborador, $marc_codigo_colaborador, $marc_fecha_operacion, $marc_hora_operacion, $marc_lugar_exacto, $marc_estado)
	{
		$consulta = "INSERT INTO `ope_marcaciones` (`marc_dni`, `marc_codigo_colaborador`, `marc_nombre_colaborador`, `marc_fecha_operacion`, `marc_hora_operacion`, `marc_lugar_exacto`, `marc_latitud`, `marc_longitud`, `marc_estado`) VALUES('$marc_dni', '$marc_codigo_colaborador', '$marc_nombre_colaborador', '$marc_fecha_operacion', '$marc_hora_operacion', '$marc_lugar_exacto', '$lat', '$long', '$marc_estado')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function comunicados_destacados_activos()
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

	function comunicados_activos()
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

	function sig_activos()
	{
		$fecha_actual = date("Y-m-d");
		$comu_estado = "ACTIVO";
		$comu_proceso = "SIG";
		$consulta = "SELECT * FROM `BDLIMABUS`.`comunicado` WHERE `Comu_Estado` = '$comu_estado' AND `Comu_FechaInicio` <= '$fecha_actual' AND `Comu_FechaFin` >= '$fecha_actual' AND `Comu_Proceso`='$comu_proceso' ORDER BY `Comu_Destacado`, `Comu_FechaInicio`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function informativos_activos()
	{
		$comu_estado = "ACTIVO";
		$comu_proceso = "OPERACIONES";
		$consulta = "SELECT * FROM `BDLIMABUS`.`comunicado` WHERE `Comu_Estado` = '$comu_estado' AND `Comu_Proceso`='$comu_proceso' ORDER BY `Comu_Destacado`, `Comu_FechaInicio`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion = null;
	}

	function listado_publicacion()
	{
		$comu_estado = "ACTIVO";
        $consulta="SELECT `Comunicado_Id`, `Comu_Titulo`, `Comu_FechaInicio`, `Comu_FechaFin`, `Comu_Destacado`, `Comu_Archivo`, `Comu_Categoria`, `Comu_Estado` FROM `comunicado` WHERE `Comu_Estado`='".$comu_estado."'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function crear_publicacion($comu_titulo, $comu_fecha_inicio, $comu_fecha_fin, $comu_proceso, $comu_destacado, $nombre_imagen, $comu_estado)
   	{
		$consulta = "INSERT INTO `comunicado` (`Comu_Titulo`, `Comu_FechaInicio`, `Comu_FechaFin`, `Comu_Destacado`, `Comu_Archivo`, `Comu_Proceso`, `Comu_Estado`) VALUES ('$comu_titulo', '$comu_fecha_inicio', '$comu_fecha_fin', '$comu_destacado', '$nombre_imagen', '$comu_proceso', '$comu_estado')";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

        $this->conexion=null;
	}
	
	function borrar_publicacion($comunicado_id)
   	{
		$comu_estado = "INACTIVO";
		$consulta = "UPDATE `comunicado` SET `Comu_Estado`='$comu_estado' WHERE `Comunicado_Id`='$comunicado_id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;	
	}  		

}