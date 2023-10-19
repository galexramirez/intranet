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

	function LeerTipoTablaOTPreventivas()
	{
        $consulta="SELECT * FROM `manto_tipotablaotpreventivas`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearTipoTablaOTPreventivas($TtablaOTPreventivas_Id,$TtablaOTPreventivas_Tipo,$TtablaOTPreventivas_Operacion,$TtablaOTPreventivas_Detalle)
	{
		$consulta = "INSERT INTO `manto_tipotablaotpreventivas`(`TtablaOTPreventivas_Tipo`, `TtablaOTPreventivas_Operacion`, `TtablaOTPreventivas_Detalle`) VALUES ('$TtablaOTPreventivas_Tipo','$TtablaOTPreventivas_Operacion','$TtablaOTPreventivas_Detalle')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT * FROM `manto_tipotablaotpreventivas`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function EditarTipoTablaOTPreventivas($TtablaOTPreventivas_Id,$TtablaOTPreventivas_Tipo,$TtablaOTPreventivas_Operacion,$TtablaOTPreventivas_Detalle)
	{
		$consulta = "UPDATE `manto_tipotablaotpreventivas` SET `TtablaOTPreventivas_Tipo`='$TtablaOTPreventivas_Tipo',`TtablaOTPreventivas_Operacion`='$TtablaOTPreventivas_Operacion',`TtablaOTPreventivas_Detalle`='$TtablaOTPreventivas_Detalle' WHERE `TtablaOTPreventivas_Id`='$TtablaOTPreventivas_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `manto_tipotablaotpreventivas` WHERE `TtablaOTPreventivas_Id` ='$TtablaOTPreventivas_Id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function BorrarTipoTablaOTPreventivas($TtablaOTPreventivas_Id)
	{
		$consulta = "DELETE FROM `manto_tipotablaotpreventivas` WHERE `TtablaOTPreventivas_Id`='$TtablaOTPreventivas_Id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function LeerTipoTablaOTCorrectivas()
	{
        $consulta="SELECT * FROM `manto_tipotablaotcorrectivas`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearTipoTablaOTCorrectivas($ttablaotcorrectivas_id,$ttablaotcorrectivas_tipo,$ttablaotcorrectivas_operacion,$ttablaotcorrectivas_detalle)
	{
		$consulta = "INSERT INTO `manto_tipotablaotcorrectivas`(`ttablaotcorrectivas_tipo`, `ttablaotcorrectivas_operacion`, `ttablaotcorrectivas_detalle`) VALUES ('$ttablaotcorrectivas_tipo','$ttablaotcorrectivas_operacion','$ttablaotcorrectivas_detalle')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT * FROM `manto_tipotablaotcorrectivas`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function EditarTipoTablaOTCorrectivas($ttablaotcorrectivas_id,$ttablaotcorrectivas_tipo,$ttablaotcorrectivas_operacion,$ttablaotcorrectivas_detalle)
	{
		$consulta = "UPDATE `manto_tipotablaotcorrectivas` SET `ttablaotcorrectivas_tipo`='$ttablaotcorrectivas_tipo',`ttablaotcorrectivas_operacion`='$ttablaotcorrectivas_operacion',`ttablaotcorrectivas_detalle`='$ttablaotcorrectivas_detalle' WHERE `ttablaotcorrectivas_id`='$ttablaotcorrectivas_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `manto_tipotablaotcorrectivas` WHERE `ttablaotcorrectivas_id` ='$ttablaotcorrectivas_id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function BorrarTipoTablaOTCorrectivas($ttablaotcorrectivas_id)
	{
		$consulta = "DELETE FROM `manto_tipotablaotcorrectivas` WHERE `ttablaotcorrectivas_id`='$ttablaotcorrectivas_id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function LeerAsociados()
	{
        $consulta="SELECT * FROM `manto_resp_asociado`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearAsociados($cod_resasoc,$ra_nombres,$ra_asociado, $ra_ruc_asociado)
	{
		$consulta = "INSERT INTO `manto_resp_asociado`(`ra_nombres`, `ra_asociado`, `ra_ruc_asociado`) VALUES ('$ra_nombres','$ra_asociado', '$ra_ruc_asociado')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT * FROM `manto_resp_asociado`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function EditarAsociados($cod_resasoc,$ra_nombres,$ra_asociado, $ra_ruc_asociado)
	{
		$consulta = "UPDATE `manto_resp_asociado` SET `ra_nombres`='$ra_nombres',`ra_asociado`='$ra_asociado', `ra_ruc_asociado`='$ra_ruc_asociado' WHERE `cod_resasoc`='$cod_resasoc'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `manto_resp_asociado` WHERE `cod_resasoc` ='$cod_resasoc'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function BorrarAsociados($cod_resasoc)
	{
		$consulta = "DELETE FROM `manto_resp_asociado` WHERE `cod_resasoc`='$cod_resasoc'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function LeerOrigenes()
	{
        $consulta="SELECT * FROM `manto_origenes`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearOrigenes($cod_origen,$or_nombre)
	{
		$consulta = "INSERT INTO `manto_origenes`(`or_nombre`) VALUES ('$or_nombre')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT * FROM `manto_origenes`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function EditarOrigenes($cod_origen,$or_nombre)
	{
		$consulta = "UPDATE `manto_origenes` SET `or_nombre`='$or_nombre' WHERE `cod_origen`='$cod_origen'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `manto_origenes` WHERE `cod_origen` ='$cod_origen'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function BorrarOrigenes($cod_origen)
	{
		$consulta = "DELETE FROM `manto_origenes` WHERE `cod_origen`='$cod_origen'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		


	function LeerTipoTablaVales()
	{
        $consulta="SELECT * FROM `manto_tipotablavales`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearTipoTablaVales($ttablavales_id,$ttablavales_tipo,$ttablavales_operacion,$ttablavales_detalle)
	{
		$consulta = "INSERT INTO `manto_tipotablavales`(`ttablavales_tipo`, `ttablavales_operacion`, `ttablavales_detalle`) VALUES ('$ttablavales_tipo','$ttablavales_operacion','$ttablavales_detalle')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT * FROM `manto_tipotablavales`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function EditarTipoTablaVales($ttablavales_id,$ttablavales_tipo,$ttablavales_operacion,$ttablavales_detalle)
	{
		$consulta = "UPDATE `manto_tipotablavales` SET `ttablavales_tipo`='$ttablavales_tipo',`ttablavales_operacion`='$ttablavales_operacion',`ttablavales_detalle`='$ttablavales_detalle' WHERE `ttablavales_id`='$ttablavales_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `manto_tipotablavales` WHERE `ttablavales_id` ='$ttablavales_id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function BorrarTipoTablaVales($ttablavales_id)
	{
		$consulta = "DELETE FROM `manto_tipotablavales` WHERE `ttablavales_id`='$ttablavales_id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function leer_unidad_medida()
	{
        $consulta	= "SELECT * FROM `manto_unidad_medida`";

        $resultado 	= $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;
   	}   
		 
	function crear_unidad_medida($unidad_medida,$um_descripcion)
	{
		$consulta  = "INSERT INTO `manto_unidad_medida`(`unidad_medida`,`um_descripcion`) VALUES ('$unidad_medida', '$um_descripcion')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta  	= "SELECT * FROM `manto_unidad_medida`";
        $resultado 	= $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data		= $resultado->fetchAll(PDO::FETCH_ASSOC);
        
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function editar_unidad_medida($unidad_medida,$um_descripcion)
	{
		$consulta  = "UPDATE `manto_unidad_medida` SET `um_descripcion`='$um_descripcion' WHERE `unidad_medida`='$unidad_medida'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta   = "SELECT * FROM `manto_unidad_medida` WHERE `unidad_medida` ='$unidad_medida'";
        $resultado  = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;	
	}  		
	
	function borrar_unidad_medida($unidad_medida)
	{
		$consulta  = "DELETE FROM `manto_unidad_medida` WHERE `unidad_medida`='$unidad_medida'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		


	function LeerTipoTablaMateriales()
	{
        $consulta="SELECT * FROM `manto_tipotablamateriales`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearTipoTablaMateriales($ttablamateriales_id,$ttablamateriales_tipo,$ttablamateriales_operacion,$ttablamateriales_detalle)
	{
		$consulta = "INSERT INTO `manto_tipotablamateriales`(`ttablamateriales_tipo`, `ttablamateriales_operacion`, `ttablamateriales_detalle`) VALUES ('$ttablamateriales_tipo','$ttablamateriales_operacion','$ttablamateriales_detalle')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT * FROM `manto_tipotablamateriales`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function EditarTipoTablaMateriales($ttablamateriales_id,$ttablamateriales_tipo,$ttablamateriales_operacion,$ttablamateriales_detalle)
	{
		$consulta = "UPDATE `manto_tipotablamateriales` SET `ttablamateriales_tipo`='$ttablamateriales_tipo',`ttablamateriales_operacion`='$ttablamateriales_operacion',`ttablamateriales_detalle`='$ttablamateriales_detalle' WHERE `ttablamateriales_id`='$ttablamateriales_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `manto_tipotablamateriales` WHERE `ttablamateriales_id` ='$ttablamateriales_id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function BorrarTipoTablaMateriales($ttablamateriales_id)
	{
		$consulta = "DELETE FROM `manto_tipotablamateriales` WHERE `ttablamateriales_id`='$ttablamateriales_id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function LeerTipoTablaPedidos()
	{
        $consulta="SELECT * FROM `manto_tipotablapedidos`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearTipoTablaPedidos($ttablapedidos_id,$ttablapedidos_tipo,$ttablapedidos_operacion,$ttablapedidos_detalle)
	{
		$consulta = "INSERT INTO `manto_tipotablapedidos`(`ttablapedidos_tipo`, `ttablapedidos_operacion`, `ttablapedidos_detalle`) VALUES ('$ttablapedidos_tipo','$ttablapedidos_operacion','$ttablapedidos_detalle')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT * FROM `manto_tipotablapedidos`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function EditarTipoTablaPedidos($ttablapedidos_id,$ttablapedidos_tipo,$ttablapedidos_operacion,$ttablapedidos_detalle)
	{
		$consulta = "UPDATE `manto_tipotablapedidos` SET `ttablapedidos_tipo`='$ttablapedidos_tipo',`ttablapedidos_operacion`='$ttablapedidos_operacion',`ttablapedidos_detalle`='$ttablapedidos_detalle' WHERE `ttablapedidos_id`='$ttablapedidos_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `manto_tipotablapedidos` WHERE `ttablapedidos_id` ='$ttablapedidos_id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function BorrarTipoTablaPedidos($ttablapedidos_id)
	{
		$consulta = "DELETE FROM `manto_tipotablapedidos` WHERE `ttablapedidos_id`='$ttablapedidos_id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function leer_tc_inventario()
	{
        $consulta="SELECT * FROM `manto_tc_inventario`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function crear_tc_inventario($tcin_id,$tcin_tipo,$tcin_operacion,$tcin_detalle)
	{
		$consulta = "INSERT INTO `manto_tc_inventario`(`tcin_tipo`, `tcin_operacion`, `tcin_detalle`) VALUES ('$tcin_tipo','$tcin_operacion','$tcin_detalle')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT * FROM `manto_tc_inventario`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function editar_tc_inventario($tc_inventario_id,$tcin_tipo,$tcin_operacion,$tcin_detalle)
	{
		$consulta = "UPDATE `manto_tc_inventario` SET `tcin_tipo`='$tcin_tipo',`tcin_operacion`='$tcin_operacion',`tcin_detalle`='$tcin_detalle' WHERE `tc_inventario_id`='$tc_inventario_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `manto_tc_inventario` WHERE `tc_inventario_id` ='$tc_inventario_id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function borrar_tc_inventario($tc_inventario_id)
	{
		$consulta = "DELETE FROM `manto_tc_inventario` WHERE `tc_inventario_id`='$tc_inventario_id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function leer_tc_componente()
	{
        $consulta="SELECT * FROM `manto_tc_componente`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;
   	}   

	function crear_tc_componente($tc_componente_id, $tc_ficha, $tc_categoria1, $tc_categoria2)
	{
	   $consulta = "INSERT INTO `manto_tc_componente`(`tc_ficha`, `tc_categoria1`, `tc_categoria2`) VALUES ('$tc_ficha','$tc_categoria1','$tc_categoria2')";
	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();   

	   $consulta = "SELECT * FROM `manto_tc_componente`";
	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();        
	   $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	   print json_encode($data, JSON_UNESCAPED_UNICODE);
	   $this->conexion=null;	
	}  	
	
	function editar_tc_componente($tc_componente_id, $tc_ficha, $tc_categoria1, $tc_categoria2)
	{
	   $consulta = "UPDATE `manto_tc_componente` SET `tc_ficha`='$tc_ficha',`tc_categoria1`='$tc_categoria1',`tc_categoria2`='$tc_categoria2' WHERE`tc_componente_id`='$tc_componente_id'";		
	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();   

	   $consulta= "SELECT * FROM `manto_tc_componente` WHERE `tc_componente_id` ='$tc_componente_id'";
	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();        
	   $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	   print json_encode($data, JSON_UNESCAPED_UNICODE);
	   $this->conexion=null;	
	}  		
	
	function borrar_tc_componente($tc_componente_id)
	{
		$consulta = "DELETE FROM `manto_tc_componente` WHERE `tc_componente_id`='$tc_componente_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$this->conexion=null;	
	}  		
   
	function leer_tc_inspeccion()
	{
        $consulta="SELECT * FROM `manto_tc_inspeccion`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;
   	}   

	function crear_tc_inspeccion($tc_inspeccion_id, $tc_ficha, $tc_categoria1, $tc_categoria2)
	{
	   $consulta = "INSERT INTO `manto_tc_inspeccion`(`tc_ficha`, `tc_categoria1`, `tc_categoria2`) VALUES ('$tc_ficha','$tc_categoria1','$tc_categoria2')";
	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();   

	   $consulta = "SELECT * FROM `manto_tc_inspeccion`";
	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();        
	   $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	   print json_encode($data, JSON_UNESCAPED_UNICODE);
	   $this->conexion=null;	
	}  	
	
	function editar_tc_inspeccion($tc_inspeccion_id, $tc_ficha, $tc_categoria1, $tc_categoria2)
	{
	   $consulta = "UPDATE `manto_tc_inspeccion` SET `tc_ficha`='$tc_ficha',`tc_categoria1`='$tc_categoria1',`tc_categoria2`='$tc_categoria2' WHERE`tc_inspeccion_id`='$tc_inspeccion_id'";		
	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();   

	   $consulta= "SELECT * FROM `manto_tc_inspeccion` WHERE `tc_inspeccion_id` ='$tc_inspeccion_id'";
	   $resultado = $this->conexion->prepare($consulta);
	   $resultado->execute();        
	   $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	   print json_encode($data, JSON_UNESCAPED_UNICODE);
	   $this->conexion=null;	
	}  		
	
	function borrar_tc_inspeccion($tc_inspeccion_id)
	{
		$consulta = "DELETE FROM `manto_tc_inspeccion` WHERE `tc_inspeccion_id`='$tc_inspeccion_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$this->conexion=null;	
	}
}