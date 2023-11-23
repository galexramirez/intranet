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

	function leer_solicitudes($fecha_inicio, $fecha_termino, $t_where_solo_solicitudes)
	{
        $consulta="SELECT *, (SELECT `colaborador`.`Colab_ApellidosNombres` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`ope_solicitudes`.`soli_dni`) AS `soli_apellidos_nombres`, (SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`ope_solicitudes`.`soli_usuario`) AS `soli_usuario_nombres`, (SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`ope_solicitudes`.`soli_responsable`) AS `soli_responsable_nombres` FROM `ope_solicitudes` WHERE DATE_FORMAT(`soli_fecha_ingreso`,'%Y-%m-%d')>='$fecha_inicio' AND DATE_FORMAT(`soli_fecha_ingreso`,'%Y-%m-%d')<='$fecha_termino' ".$t_where_solo_solicitudes;

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;
   	}   

	function leer_solicitudes_activas($fecha_inicio, $fecha_termino, $t_where_solo_solicitudes)
	{
        $consulta="SELECT *, (SELECT `colaborador`.`Colab_ApellidosNombres` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`ope_solicitudes`.`soli_dni`) AS `soli_apellidos_nombres`, (SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`ope_solicitudes`.`soli_usuario`) AS `soli_usuario_nombres`, (SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`ope_solicitudes`.`soli_responsable`) AS `soli_responsable_nombres` FROM `ope_solicitudes` WHERE DATE_FORMAT(`soli_fecha_inicio`,'%Y-%m-%d')<='$fecha_termino' AND DATE_FORMAT(`soli_fecha_fin`,'%Y-%m-%d')>='$fecha_inicio' ".$t_where_solo_solicitudes;

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;
   	}   

	function crear_solicitudes($solicitudes_id, $soli_fecha_ingreso, $soli_fecha_recepcion, $soli_tipo, $soli_codigo_adm, $soli_dni, $soli_apellidos_nombres, $soli_fecha_inicio, $soli_fecha_fin, $soli_descripcion)
   	{
		$soli_estado 			= 'PENDIENTE';
		$soli_fecha_ingreso 	= date('Y-m-d H:i:s');
		$soli_usuario_nombres	= $_SESSION['Usua_NombreCorto'];
		$soli_usuario			= $_SESSION['USUARIO_ID'];
		$soli_log 				= $soli_estado." ".date('d-m-Y H:i:s')."  ".$soli_usuario_nombres." Crear: Registro de Solicitud";

		$consulta = "INSERT INTO `ope_solicitudes` (`soli_fecha_ingreso`, `soli_fecha_recepcion`, `soli_tipo`, `soli_dni`, `soli_fecha_inicio`, `soli_fecha_fin`, `soli_codigo_adm`, `soli_descripcion`, `soli_estado`, `soli_usuario`, `soli_log`) VALUES ('$soli_fecha_ingreso', '$soli_fecha_recepcion', '$soli_tipo', '$soli_dni', '$soli_fecha_inicio', '$soli_fecha_fin', '$soli_codigo_adm', '$soli_descripcion', '$soli_estado', '$soli_usuario', '$soli_log')"; 
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT `solicitudes_id` FROM `ope_solicitudes` ORDER BY `solicitudes_id` DESC LIMIT 1";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach ($data as $row) {
			$solicitudes_id = $row['solicitudes_id'];
		}

		$consulta = "INSERT INTO `ope_solicitudes_pdf` (`spdf_solicitudes_id`, `spdf_log`) VALUES ('$solicitudes_id', '$soli_log')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$consulta= "SELECT * FROM `ope_solicitudes` WHERE `solicitudes_id` ='$solicitudes_id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
	}
	
	function editar_solicitudes($solicitudes_id, $soli_fecha_ingreso, $soli_fecha_recepcion, $soli_tipo, $soli_codigo_adm, $soli_dni, $soli_apellidos_nombres, $soli_fecha_inicio, $soli_fecha_fin, $soli_descripcion)
   	{
		$consulta= "SELECT * FROM `ope_solicitudes` WHERE `solicitudes_id`='$solicitudes_id' ";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach ($data as $row) {
			$soli_estado 	= $row['soli_estado'];
			$soli_log 		= $row['soli_log'];
		}

		$soli_estado			= "PENDIENTE";
		$soli_usuario_nombres	= $_SESSION['Usua_NombreCorto'];
		$soli_log 				= $soli_estado." ".date('d-m-Y H:i:s')."  ".$soli_usuario_nombres." Editar: Actualizar Registro <br> ".$soli_log;

		$consulta = " UPDATE `ope_solicitudes` SET `soli_fecha_recepcion` = '$soli_fecha_recepcion', `soli_tipo` = '$soli_tipo', `soli_dni` = '$soli_dni',  `soli_fecha_inicio` = '$soli_fecha_inicio', `soli_fecha_fin` = '$soli_fecha_fin', `soli_codigo_adm` = '$soli_codigo_adm', `soli_descripcion` = '$soli_descripcion', `soli_estado` = '$soli_estado', `soli_log` = '$soli_log'  WHERE `solicitudes_id` = '$solicitudes_id' ";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "UPDATE `ope_solicitudes_pdf` SET `spdf_log`= '$soli_log' WHERE `spdf_solicitudes_id`='$solicitudes_id' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$consulta= "SELECT * FROM `ope_solicitudes` WHERE `solicitudes_id` ='$solicitudes_id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);

        $this->conexion=null;	
	}  		

	function estado_solicitudes($solicitudes_id, $soli_estado, $soli_detalle_respuesta, $soli_respuesta)
	{
		$consulta= "SELECT `soli_log` FROM `ope_solicitudes` WHERE `solicitudes_id`='$solicitudes_id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach ($data as $row) {
			$soli_log = $row['soli_log'];
		}

		$soli_responsable		= $_SESSION['USUARIO_ID'];
		$soli_usuario_nombres	= $_SESSION['Usua_NombreCorto'];
		$soli_log 				= $soli_estado." ".date('d-m-Y H:i:s')."  ".$soli_usuario_nombres." Editar: Estado <br> ".$soli_log;

		if($soli_estado=="OBSERVADO" || $soli_estado=="CITACION"){
			$consulta 	= "UPDATE `ope_solicitudes` SET `soli_estado`='$soli_estado', `soli_log`='$soli_log' WHERE `solicitudes_id`='$solicitudes_id'";	
		}else{
			$consulta 	= "UPDATE `ope_solicitudes` SET `soli_estado`='$soli_estado', `soli_log`='$soli_log', `soli_detalle_respuesta`='$soli_detalle_respuesta', `soli_respuesta`='$soli_respuesta', `soli_responsable`='$soli_responsable' WHERE `solicitudes_id`='$solicitudes_id'";	
		}
		
	   	$resultado 	= $this->conexion->prepare($consulta);
	 	$resultado->execute();   

	 	$this->conexion=null;	
 	}  		

	function borrar_solicitudes($solicitudes_id)
   	{
		$consulta 	= "DELETE FROM `ope_solicitudes` WHERE `solicitudes_id`='$solicitudes_id'";		
  		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta 	= "DELETE FROM `ope_solicitudes_pdf` WHERE `spdf_solicitudes_id`='$solicitudes_id'";		
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();   

		$this->conexion=null;	
	}  		

	function pdf_solicitudes($solicitudes_id)
	{
		$consulta	= "SELECT TO_BASE64 (`spdf_pdf`) AS `b64_pdf` FROM `ope_solicitudes_pdf` WHERE `spdf_solicitudes_id`='$solicitudes_id'";
  		$resultado	= $this->conexion->prepare($consulta);
		$resultado->execute();   
        $data		= $resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;	
	}  		

	function grabar_pdf_solicitudes($solicitudes_id,$soli_pdf)
	{
		$consulta="UPDATE `ope_solicitudes_pdf` SET `spdf_pdf`= '$soli_pdf' WHERE `spdf_solicitudes_id`='$solicitudes_id'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

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

	function descargar_solicitudes($fecha_inicio, $fecha_termino)
	{
		$consulta = "SELECT *, (SELECT `glo_roles`.`roles_apellidosnombres` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ope_solicitudes`.`soli_dni` LIMIT 1) AS `soli_apellidos_nombres`, (SELECT `ope_solicitudes_pdf`.`spdf_solicitudes_id` FROM `ope_solicitudes_pdf` WHERE `ope_solicitudes_pdf`.`spdf_solicitudes_id`=`ope_solicitudes`.`solicitudes_id` AND `spdf_pdf`!='') AS `soli_pdf`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ope_solicitudes`.`soli_usuario` LIMIT 1) AS `soli_usuario_nombres`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`ope_solicitudes`.`soli_responsable` LIMIT 1) AS `soli_responsable_nombres` FROM `ope_solicitudes` WHERE DATE_FORMAT(`soli_fecha_ingreso`,'%Y-%m-%d')>='$fecha_inicio' AND DATE_FORMAT(`soli_fecha_ingreso`,'%Y-%m-%d')<='$fecha_termino'";

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

	function select_roles($roles_perfil, $roles_campo)
	{
		$consulta="SELECT `glo_roles`.`$roles_campo` AS `nombres` FROM `glo_roles` WHERE `glo_roles`.`roles_perfil` = '$roles_perfil'  ORDER BY `nombres` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function SelectTipos($operacion,$tipo)
	{
		$consulta="SELECT `TipoTabla`.`Ttabla_Detalle` AS `Detalle` FROM `TipoTabla` WHERE `TipoTabla`.`Ttabla_operacion` = '$operacion' AND `TipoTabla`.`Ttabla_tipo`= '$tipo' ORDER BY `Detalle` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function solicitudes_anio($dni, $fecha_inicio, $fecha_fin){
		$soli_respuesta = "APROBADO";
		$soli_tipo		= "CARTAS";

		$consulta = "SELECT COUNT(*) AS `nro_solicitudes_anio`FROM `ope_solicitudes` WHERE `soli_dni`='$dni' AND `soli_respuesta`='$soli_respuesta' AND `soli_tipo`!='$soli_tipo' AND `soli_fecha_inicio`>='$fecha_inicio' AND `soli_fecha_inicio`<='$fecha_fin'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function buscar_pdf($tabla, $campo_archivo, $campo_buscar, $dato_buscar, $campo_tipo_archivo, $dato_tipo_archivo)
	{
		$where_tipo_archivo = "";
		if($campo_tipo_archivo!="" && $dato_tipo_archivo!="")
		{
			$where_tipo_archivo = " AND `$campo_tipo_archivo`='$dato_tipo_archivo' ";
		}
		
		$consulta  ="SELECT TO_BASE64 (`$campo_archivo`) AS `b64_file` FROM `$tabla` WHERE `$campo_buscar`='$dato_buscar' ".$where_tipo_archivo ;
		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   
  		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
  		
		return $data;
  		$this->conexion=null;	
	}
}