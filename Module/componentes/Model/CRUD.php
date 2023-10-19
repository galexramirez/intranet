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

	function select_combo($nombre_tabla, $es_campo_unico, $campo_select, $condicion_where, $order_by)
	{
		$distinct 	= "";
		$c_where 	= "";
		if($es_campo_unico == "SI"){
			$distinct = "DISTINCT";
		}
		if($condicion_where!=""){
			$c_where = "WHERE ".$condicion_where;
		}
		$consulta = "SELECT ".$distinct." `$nombre_tabla`.`$campo_select` AS `detalle` FROM `$nombre_tabla` ".$c_where." ORDER BY `$nombre_tabla`.`$campo_select` ".$order_by;
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

	function leer_componentes()
	{
		$consulta = "SELECT 
						`manto_componentes`.`componente_id`,
						`manto_componentes`.`comp_sistema`,
						`manto_componentes`.`comp_tipo_componente`,
						`manto_componentes`.`comp_codigo_patrimonial`,
						`manto_componentes`.`comp_origen`,
						`manto_componentes`.`comp_nro_serie`,
						`manto_componentes`.`comp_nro_parte`,
						`manto_componentes`.`comp_observaciones`,
						`manto_componentes`.`comp_turno`,
						`manto_componentes`.`comp_usuario_id`,
						`manto_componentes`.`comp_fecha`,
						`manto_componentes`.`comp_log`,
						`colaborador`.`Colab_nombre_corto` AS `comp_nombres_usuario` 
					FROM `manto_componentes` 
					LEFT JOIN `colaborador` 
					ON `colaborador`.`Colaborador_id`=`manto_componentes`.`comp_usuario_id`";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		$this->conexion=null;
   	}   

	function correlativo_codigo_patrimonial($comp_tipo_componente)
	{
		$consulta = " SELECT CAST(SUBSTRING(`comp_codigo_patrimonial`,5) AS SIGNED) AS `correlativo` FROM `manto_componentes` WHERE SUBSTRING(`comp_codigo_patrimonial`,1,3)=SUBSTRING('$comp_tipo_componente',1,3) ORDER BY `comp_codigo_patrimonial` DESC LIMIT 1 ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;

	}	

	function crear_componentes($comp_sistema, $comp_tipo_componente, $comp_codigo_patrimonial, $comp_origen, $comp_nro_serie, $comp_nro_parte, $comp_turno, $comp_observaciones)
	{
		$comp_usuario_id 	= $_SESSION['USUARIO_ID'];
		$nombre_usuario  	= $_SESSION['Usua_NombreCorto'];
		$comp_fecha			= date("Y-m-d H:i:s");
		$comp_log			= $comp_fecha ." ".$nombre_usuario." : CREAR <br>";

		$consulta = " INSERT INTO `manto_componentes` (`comp_sistema`, `comp_tipo_componente`, `comp_codigo_patrimonial`, `comp_origen`, `comp_nro_serie`, `comp_nro_parte`, `comp_observaciones`, `comp_turno`, `comp_usuario_id`, `comp_fecha`, `comp_log`) VALUES ('$comp_sistema', '$comp_tipo_componente', '$comp_codigo_patrimonial', '$comp_origen', '$comp_nro_serie', '$comp_nro_parte', '$comp_observaciones', '$comp_turno', '$comp_usuario_id', '$comp_fecha', '$comp_log') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$this->conexion=null;
	}

	function editar_componentes($componente_id, $comp_sistema, $comp_tipo_componente, $comp_codigo_patrimonial, $comp_origen, $comp_nro_serie, $comp_nro_parte, $comp_turno, $comp_observaciones)
	{
		$consulta  = " SELECT * FROM `manto_componentes` WHERE `componente_id`='$componente_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach($data as $row){
			$comp_log = $row['comp_log'];
		}

		$nombre_usuario  	= $_SESSION['Usua_NombreCorto'];
		$comp_fecha			= date("Y-m-d H:i:s");
		$comp_log			= $comp_fecha ." ".$nombre_usuario." : EDITAR <br>".$comp_log;

		$consulta = " UPDATE `manto_componentes` SET `comp_sistema` = '$comp_sistema', `comp_tipo_componente` = '$comp_tipo_componente', `comp_codigo_patrimonial` = '$comp_codigo_patrimonial', `comp_origen` = '$comp_origen', `comp_nro_serie` = '$comp_nro_serie', `comp_nro_parte` = '$comp_nro_parte', `comp_observaciones` = '$comp_observaciones', `comp_turno` = '$comp_turno', `comp_log` = '$comp_log' WHERE `componente_id` = '$componente_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$this->conexion=null;
	}
}