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

	function select_roles($roles_perfil, $roles_campo)
	{
		$consulta="SELECT `colaborador`.`$roles_campo` AS `nombres` FROM `glo_roles` RIGHT JOIN `colaborador` ON `colaborador`.`Colaborador_id`= `glo_roles`.`roles_dni` AND `colaborador`.`Colab_Estado`='ACTIVO' WHERE `glo_roles`.`roles_perfil` = '$roles_perfil'  ORDER BY `nombres` ASC";

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

	function select_modulo_nombre()
	{
		$usuario_id = $_SESSION['USUARIO_ID'];
		
		$consulta = " SELECT `Modulo`.`Mod_NombreVista` AS `detalle` FROM `Permisos` LEFT JOIN `Modulo` ON `Modulo`.`Modulo_Id`=`Permisos`.`PER_ModuloId` AND `Modulo`.`mod_tipo`='Modulo' WHERE `PER_UsuarioId`='$usuario_id' ORDER BY `Mod_NombreVista` ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;   
		$this->conexion=null;
	}

	function buscar_manual($man_modulo_id)
	{
		$consulta = " SELECT `glo_manual`.`manual_id`, `Modulo`.`Mod_NombreVista`, `glo_manual`.`man_titulo`, `colaborador`.`Colab_nombre_corto`, `glo_manual`.`man_fecha_genera` FROM `glo_manual` LEFT JOIN `colaborador` ON `colaborador`.`Colaborador_id`=`glo_manual`.`man_usuario_genera` LEFT JOIN `Modulo` ON `Modulo`.`Modulo_Id`=`glo_manual`.`man_modulo_id` WHERE `glo_manual`.`man_modulo_id`='$man_modulo_id' ORDER BY `Mod_Nombre`, `man_titulo` ASC ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);
		$this->conexion=null;
	}

	function crear_manual_registro($man_modulo_id, $man_titulo, $man_html)
	{
		$man_usuario_genera = $_SESSION['USUARIO_ID'];
		$nombre_usuario = $_SESSION['Usua_NombreCorto'];
		$man_fecha_genera = date("Y-m-d H:i:s");
		$man_log = date_format(date_create($man_fecha_genera),"d-m-Y H:i")." ".$nombre_usuario." : CREACION <br>";

		$consulta = " INSERT INTO `glo_manual` (`man_modulo_id`, `man_titulo`, `man_usuario_genera`, `man_fecha_genera`, `man_log`) VALUES ('$man_modulo_id', '$man_titulo', '$man_usuario_genera', '$man_fecha_genera', '$man_log') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$consulta = " SELECT * FROM `glo_manual` WHERE `man_modulo_id`='$man_modulo_id' AND `man_titulo`='$man_titulo' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach($data as $row){
			$manual_id = $row['manual_id']; 
		}

		$consulta = " INSERT INTO `glo_manual_html` (`manual_id`, `man_html`) VALUES ('$manual_id', '$man_html') ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function editar_manual_registro($manual_id, $man_html)
	{
		$man_log_anterior = '';
		$consulta = " SELECT * FROM `glo_manual` WHERE `manual_id`='$manual_id' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();      
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach($data as $row){
			$man_log_anterior = $row['man_log']; 
		}

		$nombre_usuario = $_SESSION['Usua_NombreCorto'];
		$man_fecha_genera = date("Y-m-d H:i:s");
		$man_log = date_format(date_create($man_fecha_genera),"d-m-Y H:i")." ".$nombre_usuario." : EDICION <br>".$man_log_anterior;

		$consulta = " UPDATE `glo_manual` SET `man_log`='$man_log' WHERE `manual_id`='$manual_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$consulta = " UPDATE `glo_manual_html` SET `man_html`='$man_html' WHERE `manual_id`='$manual_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}

	function borrar_manual_registro($manual_id)
	{

		$consulta = " DELETE FROM `glo_manual` WHERE `manual_id`='$manual_id' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        

		$consulta = " DELETE FROM `glo_manual_html` WHERE `manual_id`='$manual_id' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        

		$this->conexion=null;
	}

}