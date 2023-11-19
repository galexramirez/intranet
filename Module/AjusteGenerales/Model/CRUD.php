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

	function LeerBuses()
	{
        $consulta="SELECT * FROM `Buses`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearBuses($Bus_NroExterno,$Bus_NroVid,$Bus_NroPlaca,$Bus_Operacion,$Bus_Detalle,$Bus_Tipo,$Bus_Tipo2,$Bus_Estado,$Bus_Tanques)
	{
		$consulta = "INSERT INTO `Buses`(`Bus_NroExterno`, `Bus_NroVid`, `Bus_NroPlaca`, `Bus_Operacion`, `Bus_Detalle`, `Bus_Tipo`, `Bus_Tipo2`, `Bus_Estado`, `Bus_Tanques`) VALUES ('$Bus_NroExterno','$Bus_NroVid','$Bus_NroPlaca', '$Bus_Operacion', '$Bus_Detalle', '$Bus_Tipo', '$Bus_Tipo2', '$Bus_Estado', '$Bus_Tanques')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta= "SELECT * FROM `Buses`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function EditarBuses($Bus_NroExterno,$Bus_NroVid,$Bus_NroPlaca,$Bus_Operacion,$Bus_Detalle,$Bus_Tipo,$Bus_Tipo2,$Bus_Estado,$Bus_Tanques)
	{
		$consulta = "UPDATE `Buses` SET `Bus_NroVid`='$Bus_NroVid',`Bus_NroPlaca`='$Bus_NroPlaca',`Bus_Operacion`='$Bus_Operacion',`Bus_Detalle`='$Bus_Detalle', `Bus_Tipo`='$Bus_Tipo', `Bus_Tipo2`='$Bus_Tipo2', `Bus_Estado`='$Bus_Estado', `Bus_Tanques`='$Bus_Tanques' WHERE `Bus_NroExterno` ='$Bus_NroExterno'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta= "SELECT * FROM `Buses` WHERE `Bus_NroExterno` ='$Bus_NroExterno'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function BorrarBuses($Bus_NroExterno)
	{
		$consulta = "DELETE FROM `Buses` WHERE `Bus_NroExterno`='$Bus_NroExterno'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function leer_roles()
	{
        $consulta = "SELECT * FROM `glo_roles`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function crear_roles($roles_dni, $roles_apellidosnombres, $roles_nombrecorto, $roles_perfil)
	{
		$consulta = "INSERT INTO `glo_roles` (`roles_dni`, `roles_apellidosnombres`, `roles_nombrecorto`, `roles_perfil`) VALUES ('$roles_dni','$roles_apellidosnombres','$roles_nombrecorto', '$roles_perfil')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta= "SELECT * FROM `glo_roles`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function editar_roles($roles_id, $roles_dni, $roles_apellidosnombres, $roles_nombrecorto, $roles_perfil)
	{
		$consulta = "UPDATE `glo_roles` SET `roles_dni`='$roles_dni',`roles_apellidosnombres`='$roles_apellidosnombres',`roles_nombrecorto`='$roles_nombrecorto',`roles_perfil`='$roles_perfil' WHERE `roles_id` ='$roles_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta= "SELECT * FROM `glo_roles` WHERE `roles_id` ='$roles_id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function borrar_roles($roles_id)
	{
		$consulta = "DELETE FROM `glo_roles` WHERE `roles_id`='$roles_id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function selectColaborador()
	{
		$consulta = "SELECT `colaborador`.`Colab_ApellidosNombres` AS `Colaborador` FROM `colaborador` ORDER BY `colaborador`.`Colab_ApellidosNombres`";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;   
		$this->conexion=null;
	}  		

	function buscarDNI($roles_apellidosnombres)
	{
		$consulta = "SELECT `colaborador`.`Colaborador_id` AS `DNI` FROM `colaborador` WHERE `colaborador`.`Colab_ApellidosNombres`='$roles_apellidosnombres'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;   
		$this->conexion=null;
	}  		

	function buscarNombreCorto($roles_dni)
	{
		$consulta = "SELECT `usuario`.`Usua_NombreCorto` AS `NombreCorto` FROM `usuario` WHERE `Usuario_Id`='$roles_dni'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;
  		$this->conexion=null;	
	}  		

	function LeerCalendario()
	{
        $consulta="SELECT `Calendario_Id`, UPPER(DATE_FORMAT(`Calendario_Id`, '%W')) AS `Calendario_Dia`,`Calendario_Anio`,`Calendario_TipoDia`,`Calendario_Semana` FROM `Calendario` ORDER BY `Calendario`.`Calendario_Id` DESC";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearCalendario($Calendario_Id,$Calendario_Anio,$Calendario_TipoDia,$Calendario_Semana)
	{
		$consulta = "INSERT INTO `Calendario`(`Calendario_Id`, `Calendario_Anio`, `Calendario_TipoDia`, `Calendario_Semana`)
					 VALUES ('$Calendario_Id','$Calendario_Anio','$Calendario_TipoDia','$Calendario_Semana')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `Calendario`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function EditarCalendario($Calendario_Id,$Calendario_Anio,$Calendario_TipoDia,$Calendario_Semana)
	{
		$consulta = "UPDATE `Calendario` SET `Calendario_Anio`='$Calendario_Anio',`Calendario_TipoDia`='$Calendario_TipoDia',`Calendario_Semana`='$Calendario_Semana' WHERE `Calendario_Id` ='$Calendario_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta= "SELECT * FROM `Calendario` WHERE `Calendario_Id` ='$Calendario_Id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function BorrarCalendario($Calendario_Id)
	{
		$consulta = "DELETE FROM `Calendario` WHERE `Calendario_Id`='$Calendario_Id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function leer_periodo()
	{
        $consulta = " SELECT * FROM `glo_periodo` ORDER BY `glo_periodo`.`periodo_id` DESC ";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   

	function crear_periodo($periodo_id, $peri_anio, $peri_mes, $peri_proceso, $peri_descripcion, $peri_fecha_inicio, $peri_fecha_termino)
	{
		$consulta = "INSERT INTO `glo_periodo`(`peri_anio`, `peri_mes`, `peri_proceso`, `peri_descripcion`, `peri_fecha_inicio`, `peri_fecha_termino`) VALUES ('$peri_anio','$peri_mes','$peri_proceso','$peri_descripcion', '$peri_fecha_inicio', '$peri_fecha_termino')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function editar_periodo($periodo_id, $peri_anio, $peri_mes, $peri_proceso, $peri_descripcion, $peri_fecha_inicio, $peri_fecha_termino)
	{
		$consulta = "UPDATE `glo_periodo` SET `peri_anio`='$peri_anio', `peri_mes`='$peri_mes', `peri_proceso`='$peri_proceso', `peri_descripcion`='$peri_descripcion', `peri_fecha_inicio`='$peri_fecha_inicio', `peri_fecha_termino`='$peri_fecha_termino' WHERE `periodo_id` ='$periodo_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function borrar_periodo($periodo_id)
	{
		$consulta = "DELETE FROM `glo_periodo` WHERE `periodo_id`='$periodo_id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		


	function SelectTipos($Prog_Operacion,$Ttabla_Tipo)
	{
		$consulta="SELECT `TipoTabla`.`Ttabla_Detalle` AS 'Detalle' FROM `TipoTabla` WHERE `TipoTabla`.`Ttabla_Operacion` = '$Prog_Operacion' AND `TipoTabla`.`Ttabla_Tipo` = '$Ttabla_Tipo' ORDER BY `Detalle` ASC";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function SelectTiposUsuario($ttablausuario_operacion,$ttablausuario_tipo)
	{
		$consulta="SELECT `glo_tipotablausuario`.`ttablausuario_detalle` AS 'Detalle' FROM `glo_tipotablausuario` WHERE `glo_tipotablausuario`.`ttablausuario_operacion` = '$ttablausuario_operacion' AND `glo_tipotablausuario`.`ttablausuario_tipo` = '$ttablausuario_tipo' ORDER BY `Detalle` ASC";
	
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function SelectObjeto($cacces_moduloid)
	{
		$consulta="SELECT `glo_objetos`.`obj_nombre` AS 'Detalle' FROM `glo_objetos` WHERE `glo_objetos`.`obj_moduloid` = '$cacces_moduloid' ORDER BY `Detalle` ASC";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        

		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}
	
	function LeerTipoCambio()
	{
        $consulta="SELECT `tipocambio_id`, DATE_FORMAT(`tipocambio_fecha`,'%Y-%m-%d %W') AS `tipocambio_fecha`, `tipocambio_moneda`, `tipocambio_tipo`, `tipocambio_valor` FROM `glo_tipocambio`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearTipoCambio($tipocambio_fecha,$tipocambio_moneda,$tipocambio_tipo,$tipocambio_valor)
	{
		$consulta = "INSERT INTO `glo_tipocambio`(`tipocambio_fecha`, `tipocambio_moneda`, `tipocambio_tipo`, `tipocambio_valor`)
					 VALUES ('$tipocambio_fecha','$tipocambio_moneda','$tipocambio_tipo','$tipocambio_valor')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
        $this->conexion=null;	
	}  	
	
	function Editartipocambio($tipocambio_Id,$tipocambio_Objeto,$tipocambio_Tipo,$tipocambio_Nombre,$tipocambio_Estado,$tipocambio_Data)
	{
		$consulta = "UPDATE `GLO_tipocambio` SET `tipocambio_Objeto`='$tipocambio_Objeto',`tipocambio_Tipo`='$tipocambio_Tipo',`tipocambio_Nombre`='$tipocambio_Nombre',`tipocambio_Estado`='$tipocambio_Estado',`tipocambio_Data`='$tipocambio_Data' WHERE `tipocambio_Id` ='$tipocambio_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta= "SELECT * FROM `GLO_tipocambio` WHERE `tipocambio_Id` ='$tipocambio_Id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function Borrartipocambio($tipocambio_Id)
	{
		$consulta = "DELETE FROM `GLO_tipocambio` WHERE `tipocambio_Id`='$tipocambio_Id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function LeerDistancias()
	{
        $consulta="SELECT * FROM `OPE_Distancias`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   

	function CargarModulo()
	{
        $consulta="SELECT * FROM `Modulo`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearModulo($Mod_Nombre,$Mod_NombreVista,$Mod_Icono, $mod_tipo, $mod_plegable)
	{
		$consulta = "INSERT INTO `Modulo`(`Mod_Nombre`, `Mod_NombreVista`, `Mod_Icono`, `mod_tipo`, `mod_plegable`)
					 VALUES ('$Mod_Nombre','$Mod_NombreVista','$Mod_Icono', '$mod_tipo', '$mod_plegable')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta= "SELECT * FROM `Modulo` ORDER BY `Modulo_Id` DESC LIMIT 1";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function EditarModulo($Modulo_Id,$Mod_Nombre,$Mod_NombreVista,$Mod_Icono, $mod_tipo, $mod_plegable)
	{
		$consulta = "UPDATE `Modulo` SET `Mod_Nombre`='$Mod_Nombre',`Mod_NombreVista`='$Mod_NombreVista',`Mod_Icono`='$Mod_Icono', `mod_tipo`='$mod_tipo', `mod_plegable`='$mod_plegable' WHERE `Modulo_Id`='$Modulo_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta= "SELECT * FROM `Modulo` WHERE `Modulo_Id` ='$Modulo_Id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function BorrarModulo($Modulo_Id)
	{
		$consulta = "DELETE FROM `Modulo` WHERE `Modulo_Id`='$Modulo_Id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function CargarPermisos()
	{
        $consulta="SELECT `Permiso_Id`, `PER_UsuarioId`, `colaborador`.`Colab_nombre_corto` AS `nombre_corto`, `Modulo`.`Mod_Nombre` AS `PER_ModuloId`, `PER_ModInicio` FROM `Permisos` LEFT JOIN `Modulo` ON `PER_ModuloId` = `Modulo`.`Modulo_Id` LEFT JOIN `colaborador` ON `PER_UsuarioId` = `colaborador`.`Colaborador_id`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearPermisos($PER_UsuarioId,$PER_ModuloId,$PER_ModInicio)
	{
		$PER_ModuloId_1 = "";

		$consulta2 = "SELECT `Modulo`.`Modulo_Id` FROM `Modulo` WHERE `Modulo`.`Mod_Nombre` = '$PER_ModuloId'";
		$resultado2 = $this->conexion->prepare($consulta2);
		$resultado2->execute();
		
		foreach ($resultado2 as $row)
		{
			$PER_ModuloId_1 = $row['Modulo_Id'];
		}

		$consulta = "INSERT INTO `Permisos`(`PER_UsuarioId`, `PER_ModuloId`, `PER_ModInicio`) VALUES ('$PER_UsuarioId', '$PER_ModuloId_1', '$PER_ModInicio')";
		//echo $consulta;
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta= "SELECT * FROM `Permisos` ORDER BY `Permiso_Id` DESC LIMIT 1";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function EditarPermisos($Permiso_Id, $PER_UsuarioId, $PER_ModuloId, $PER_ModInicio)
	{
		$PER_ModuloId_1 = "";

		$consulta2 = "SELECT `Modulo`.`Modulo_Id` FROM `Modulo` WHERE `Modulo`.`Mod_Nombre` = '$PER_ModuloId'";
		$resultado2 = $this->conexion->prepare($consulta2);
		$resultado2->execute();
		
		foreach ($resultado2 as $row)
		{
			$PER_ModuloId_1 = $row['Modulo_Id'];
		}

		$consulta = "UPDATE `Permisos` SET `PER_ModInicio`='$PER_ModInicio' WHERE `Permiso_Id`='$Permiso_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta= "SELECT * FROM `Permisos` WHERE `Permiso_Id` ='$Permiso_Id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function BorrarPermisos($Permiso_Id)
	{
		$consulta = "DELETE FROM `Permisos` WHERE `Permiso_Id`='$Permiso_Id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function ValidarPermisos($PER_UsuarioId,$PER_ModuloId)
	{
		$PER_ModuloId_1 = "";

		$consulta2 = "SELECT `Modulo`.`Modulo_Id` FROM `Modulo` WHERE `Modulo`.`Mod_Nombre` = '$PER_ModuloId'";
		$resultado2 = $this->conexion->prepare($consulta2);
		$resultado2->execute();
		
		foreach ($resultado2 as $row)
		{
			$PER_ModuloId_1 = $row['Modulo_Id'];
		}

		$consulta= "SELECT * FROM `Permisos` WHERE `PER_UsuarioId`='$PER_UsuarioId' AND `PER_ModuloId`='$PER_ModuloId_1'";
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
	
	function SelectUsuario()
	{
		$consulta="SELECT DISTINCT `glo_roles`.`roles_nombrecorto` AS `Usuario` FROM `glo_roles` WHERE `roles_nombrecorto`!='' ORDER BY `Usuario` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
		   
	}   

	function SelectModulo()
	{
		$consulta="SELECT `Modulo`.`Mod_Nombre` AS `Modulo` FROM `Modulo` ORDER BY `Modulo` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}   

	function SelectModuloControlAccesos()
	{
		$consulta	= "SELECT DISTINCT `Modulo`.`Mod_Nombre` AS `Modulo` FROM `Modulo` RIGHT JOIN `glo_objetos` ON `glo_objetos`.`obj_moduloid`=`Modulo`.`Modulo_Id` ORDER BY `Modulo` ASC";
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}   

	function LeerObjetos()
	{
        $consulta = "SELECT `glo_objetos`.`objetos_id`, `Modulo`.`Mod_Nombre` AS `obj_nombremodulo`, `glo_objetos`.`obj_nombre` AS `obj_nombreobjeto`, `glo_objetos`.`obj_descripcion` FROM `glo_objetos` LEFT JOIN `Modulo` ON `Modulo`.`Modulo_Id`=`glo_objetos`.`obj_moduloid`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearObjetos($objetos_id,$obj_nombremodulo,$obj_nombre,$obj_descripcion)
	{
		$consulta = "SELECT * FROM `Modulo` WHERE `Modulo`.`Mod_Nombre` = '$obj_nombremodulo'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		foreach($data as $row){
			$obj_moduloid = $row['Modulo_Id'];
		}

		$consulta = "INSERT INTO `glo_objetos`(`obj_moduloid`, `obj_nombre`, `obj_descripcion`) VALUES ('$obj_moduloid','$obj_nombre','$obj_descripcion')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT `glo_objetos`.`objetos_id`, `Modulo`.`Mod_Nombre` AS `obj_nombremodulo`, `glo_objetos`.`obj_nombre` AS `obj_nombreobjeto`, `glo_objetos`.`obj_descripcion` FROM `glo_objetos` LEFT JOIN `Modulo` ON `Modulo`.`Modulo_Id`=`glo_objetos`.`obj_moduloid`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function EditarObjetos($objetos_id,$obj_nombremodulo,$obj_nombre,$obj_descripcion)
	{
		$consulta = "SELECT * FROM `Modulo` WHERE `Modulo`.`Mod_Nombre` = '$obj_nombremodulo'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		foreach($data as $row){
			$obj_moduloid = $row['Modulo_Id'];
		}

		$consulta = "UPDATE `glo_objetos` SET `obj_moduloid`='$obj_moduloid',`obj_nombre`='$obj_nombre',`obj_descripcion`='$obj_descripcion' WHERE `objetos_id`='$objetos_id'";
		echo $consulta;		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT `glo_objetos`.`objetos_id`, `Modulo`.`Mod_Nombre` AS `obj_nombremodulo`, `glo_objetos`.`obj_nombre` AS `obj_nombreobjeto`, `glo_objetos`.`obj_descripcion` FROM `glo_objetos` LEFT JOIN `Modulo` ON `Modulo`.`Modulo_Id`=`glo_objetos`.`obj_moduloid`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function BorrarObjetos($objetos_id)
	{
		$consulta = "DELETE FROM `glo_objetos` WHERE `objetos_id`='$objetos_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function ValidarObjetos($obj_moduloid, $obj_nombreobjeto)
	{
		$consulta= "SELECT * FROM `glo_objetos` WHERE `glo_objetos`.`obj_moduloid`='$obj_moduloid' AND `glo_objetos`.`obj_nombre`='$obj_nombreobjeto'";

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

	function CargarControlAccesos()
	{
        $consulta="SELECT `glo_controlaccesos`.`controlaccesos_id`, `glo_controlaccesos`.`cacces_perfil`, `Modulo`.`Mod_Nombre` AS `cacces_nombremodulo`, `glo_objetos`.`obj_nombre` AS `cacces_nombreobjeto` ,`glo_controlaccesos`.`cacces_acceso` FROM `glo_controlaccesos` LEFT JOIN `Modulo` ON `glo_controlaccesos`.`cacces_moduloid` = `Modulo`.`Modulo_Id` LEFT JOIN `glo_objetos` ON `glo_controlaccesos`.`cacces_objetosid`=`glo_objetos`.`objetos_id`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearControlAccesos($cacces_perfil, $cacces_moduloid, $cacces_objetosid, $cacces_acceso)
	{
		$consulta = "INSERT INTO `glo_controlaccesos`(`cacces_perfil`, `cacces_moduloid`, `cacces_objetosid`, `cacces_acceso`)
					 VALUES ('$cacces_perfil', '$cacces_moduloid', '$cacces_objetosid', '$cacces_acceso')";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT `glo_controlaccesos`.`controlaccesos_id`, `glo_controlaccesos`.`cacces_perfil`, `Modulo`.`Mod_Nombre` AS `cacces_nombremodulo`, `glo_objetos`.`obj_nombre` AS `cacces_nombreobjeto` ,`glo_controlaccesos`.`cacces_acceso` FROM `glo_controlaccesos` LEFT JOIN `Modulo` ON `glo_controlaccesos`.`cacces_moduloid` = `Modulo`.`Modulo_Id` LEFT JOIN `glo_objetos` ON `glo_controlaccesos`.`cacces_objetosid`=`glo_objetos`.`objetos_id`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		$this->conexion=null;	
	}  	
	
	function EditarControlAccesos($controlaccesos_id, $cacces_perfil, $cacces_moduloid, $cacces_objetosid, $cacces_acceso)
	{
		$consulta = "UPDATE `glo_controlaccesos` SET `glo_controlaccesos`.`cacces_perfil`='$cacces_perfil',`glo_controlaccesos`.`cacces_moduloid`='$cacces_moduloid',`cacces_objetosid`='$cacces_objetosid',`glo_controlaccesos`.`cacces_acceso`='$cacces_acceso' WHERE `glo_controlaccesos`.`controlaccesos_id`='$controlaccesos_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT `glo_controlaccesos`.`controlaccesos_id`, `glo_controlaccesos`.`cacces_perfil`, `Modulo`.`Mod_Nombre` AS `cacces_nombremodulo`, `glo_objetos`.`obj_nombre` AS `cacces_nombreobjeto` ,`glo_controlaccesos`.`cacces_acceso` FROM `glo_controlaccesos` LEFT JOIN `Modulo` ON `glo_controlaccesos`.`cacces_moduloid` = `Modulo`.`Modulo_Id` LEFT JOIN `glo_objetos` ON `glo_controlaccesos`.`cacces_objetosid`=`glo_objetos`.`objetos_id`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function BorrarControlAccesos($controlaccesos_id)
	{
		$consulta = "DELETE FROM `glo_controlaccesos` WHERE `controlaccesos_id`='$controlaccesos_id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function ValidarControlAccesos($cacces_perfil, $cacces_moduloid, $cacces_objetosid)
	{
		$consulta= "SELECT * FROM `glo_controlaccesos` WHERE `glo_controlaccesos`.`cacces_perfil`='$cacces_perfil' AND `glo_controlaccesos`.`cacces_moduloid`='$cacces_moduloid' AND `glo_controlaccesos`.`cacces_objetosid`='$cacces_objetosid'";

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

	function LeerMaestrouno()
	{
        $consulta="SELECT * FROM `glo_tipotablamaestrouno`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearMaestrouno($ttablamaestrouno_id,$ttablamaestrouno_tipo,$ttablamaestrouno_operacion,$ttablamaestrouno_detalle)
	{
		$consulta = "INSERT INTO `glo_tipotablamaestrouno`(`ttablamaestrouno_tipo`, `ttablamaestrouno_operacion`, `ttablamaestrouno_detalle`) VALUES ('$ttablamaestrouno_tipo','$ttablamaestrouno_operacion','$ttablamaestrouno_detalle')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT * FROM `glo_tipotablamaestrouno`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function EditarMaestrouno($ttablamaestrouno_id,$ttablamaestrouno_tipo,$ttablamaestrouno_operacion,$ttablamaestrouno_detalle)
	{
		$consulta = "UPDATE `glo_tipotablamaestrouno` SET `ttablamaestrouno_tipo`='$ttablamaestrouno_tipo',`ttablamaestrouno_operacion`='$ttablamaestrouno_operacion',`ttablamaestrouno_detalle`='$ttablamaestrouno_detalle' WHERE `ttablamaestrouno_id`='$ttablamaestrouno_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `glo_tipotablamaestrouno` WHERE `ttablamaestrouno_id` ='$ttablamaestrouno_id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function BorrarMaestrouno($ttablamaestrouno_id)
	{
		$consulta = "DELETE FROM `glo_tipotablamaestrouno` WHERE `ttablamaestrouno_id`='$ttablamaestrouno_id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function LeerUsuario()
	{
        $consulta="SELECT * FROM `glo_tipotablausuario`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearUsuario($ttablausuario_id,$ttablausuario_tipo,$ttablausuario_operacion,$ttablausuario_detalle)
	{
		$consulta = "INSERT INTO `glo_tipotablausuario`(`ttablausuario_tipo`, `ttablausuario_operacion`, `ttablausuario_detalle`) VALUES ('$ttablausuario_tipo','$ttablausuario_operacion','$ttablausuario_detalle')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT * FROM `glo_tipotablausuario`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function EditarUsuario($ttablausuario_id,$ttablausuario_tipo,$ttablausuario_operacion,$ttablausuario_detalle)
	{
		$consulta = "UPDATE `glo_tipotablausuario` SET `ttablausuario_tipo`='$ttablausuario_tipo',`ttablausuario_operacion`='$ttablausuario_operacion',`ttablausuario_detalle`='$ttablausuario_detalle' WHERE `ttablausuario_id`='$ttablausuario_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `glo_tipotablausuario` WHERE `ttablausuario_id` ='$ttablausuario_id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function BorrarUsuario($ttablausuario_id)
	{
		$consulta = "DELETE FROM `glo_tipotablausuario` WHERE `ttablausuario_id`='$ttablausuario_id'";		
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

}