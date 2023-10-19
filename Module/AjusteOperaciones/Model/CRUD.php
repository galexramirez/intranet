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

	function LeerTipoTablas()
	{
        $consulta="SELECT * FROM `TipoTabla`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearTipoTablas($Ttabla_Id,$Ttabla_Tipo,$Ttabla_Operacion,$Ttabla_Detalle)
	{
		$consulta = "INSERT INTO `TipoTabla`(`Ttabla_Tipo`, `Ttabla_Operacion`, `Ttabla_Detalle`)
					 VALUES ('$Ttabla_Tipo','$Ttabla_Operacion','$Ttabla_Detalle')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta= "SELECT * FROM `TipoTabla`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function EditarTipoTablas($Ttabla_Id,$Ttabla_Tipo,$Ttabla_Operacion,$Ttabla_Detalle)
	{
		$consulta = "UPDATE `TipoTabla` SET `Ttabla_Tipo`='$Ttabla_Tipo',`Ttabla_Operacion`='$Ttabla_Operacion',`Ttabla_Detalle`='$Ttabla_Detalle' WHERE `Ttabla_Id` ='$Ttabla_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta= "SELECT * FROM `TipoTabla` WHERE `Ttabla_Id` ='$Ttabla_Id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function BorrarTipoTablas($Ttabla_Id)
	   	{
		$consulta = "DELETE FROM `TipoTabla` WHERE `Ttabla_Id`='$Ttabla_Id'";		
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

	function LeerDistancias()
		{
        $consulta="SELECT * FROM `OPE_Distancias`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   		}   
		 
	function CrearDistancias($Dist_Operacion,$Dist_Orden,$Dist_Sentido,$Dist_Servicio,$Dist_LugarOrigen,$Dist_LugarDestino,$Dist_Kilometros)
	   	{
		$consulta = "INSERT INTO `OPE_Distancias`(`Dist_Operacion`,`Dist_Orden`,`Dist_Sentido`,`Dist_Servicio`,`Dist_LugarOrigen`,`Dist_LugarDestino`,`Dist_Kilometros`)
					 VALUES ('$Dist_Operacion','$Dist_Orden','$Dist_Sentido','$Dist_Servicio','$Dist_LugarOrigen','$Dist_LugarDestino','$Dist_Kilometros')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta= "SELECT * FROM `OPE_Distancias`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
		}  	
	
	function EditarDistancias($Distancias_Id,$Dist_Operacion,$Dist_Orden,$Dist_Sentido,$Dist_Servicio,$Dist_LugarOrigen,$Dist_LugarDestino,$Dist_Kilometros)
	   	{
		$consulta = "UPDATE `OPE_Distancias` SET `Dist_Operacion`='$Dist_Operacion',`Dist_Orden`='$Dist_Orden',`Dist_Sentido`='$Dist_Sentido'`Dist_Servicio`='$Dist_Servicio',`Dist_LugarOrigen`='$Dist_LugarOrigen',`Dist_LugarDestino`='$Dist_LugarDestino',`Dist_Kilometros`='$Dist_Kilometros' WHERE `Distancias_Id` ='$Distancias_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `OPE_Distancias` WHERE `Distancias_Id` ='$Distancias_Id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
		}  		
	
	function BorrarDistancias($Distancias_Id)
	   	{
		$consulta = "DELETE FROM `OPE_Distancias` WHERE `Distancias_Id`='$Distancias_Id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
		}  		

	function LeerTipoTablaAccidentes()
		{
        $consulta="SELECT * FROM `OPE_TipoTablaAccidentes`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   		}   
		 
	function CrearTipoTablaAccidentes($TtablaAccidentes_Id,$TtablaAccidentes_Tipo,$TtablaAccidentes_Operacion,$TtablaAccidentes_Detalle)
	   	{
		$consulta = "INSERT INTO `OPE_TipoTablaAccidentes`(`TtablaAccidentes_Tipo`, `TtablaAccidentes_Operacion`, `TtablaAccidentes_Detalle`) VALUES ('$TtablaAccidentes_Tipo','$TtablaAccidentes_Operacion','$TtablaAccidentes_Detalle')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT * FROM `OPE_TipoTablaAccidentes`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
		}  	
	
	function EditarTipoTablaAccidentes($TtablaAccidentes_Id,$TtablaAccidentes_Tipo,$TtablaAccidentes_Operacion,$TtablaAccidentes_Detalle)
	   	{
		$consulta = "UPDATE `OPE_TipoTablaAccidentes` SET `TtablaAccidentes_Tipo`='$TtablaAccidentes_Tipo',`TtablaAccidentes_Operacion`='$TtablaAccidentes_Operacion',`TtablaAccidentes_Detalle`='$TtablaAccidentes_Detalle' WHERE `TtablaAccidentes_Id`='$TtablaAccidentes_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `OPE_TipoTablaAccidentes` WHERE `TtablaAccidentes_Id` ='$TtablaAccidentes_Id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
		}  		
	
	function BorrarTipoTablaAccidentes($TtablaAccidentes_Id)
	   	{
		$consulta = "DELETE FROM `OPE_TipoTablaAccidentes` WHERE `TtablaAccidentes_Id`='$TtablaAccidentes_Id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
		}  		

	function LeerTipoTablaComportamiento()
		{
        $consulta="SELECT * FROM `OPE_TipoTablaComportamiento`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   		}   
		 
	function CrearTipoTablaComportamiento($TtablaComportamiento_Id,$TtablaComportamiento_Tipo,$TtablaComportamiento_Operacion,$TtablaComportamiento_Detalle)
	   	{
		$consulta = "INSERT INTO `OPE_TipoTablaComportamiento`(`TtablaComportamiento_Tipo`, `TtablaComportamiento_Operacion`, `TtablaComportamiento_Detalle`) VALUES ('$TtablaComportamiento_Tipo','$TtablaComportamiento_Operacion','$TtablaComportamiento_Detalle')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT * FROM `OPE_TipoTablaComportamiento`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
		}  	
	
	function EditarTipoTablaComportamiento($TtablaComportamiento_Id,$TtablaComportamiento_Tipo,$TtablaComportamiento_Operacion,$TtablaComportamiento_Detalle)
	   	{
		$consulta = "UPDATE `OPE_TipoTablaComportamiento` SET `TtablaComportamiento_Tipo`='$TtablaComportamiento_Tipo',`TtablaComportamiento_Operacion`='$TtablaComportamiento_Operacion',`TtablaComportamiento_Detalle`='$TtablaComportamiento_Detalle' WHERE `TtablaComportamiento_Id`='$TtablaComportamiento_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `OPE_TipoTablaComportamiento` WHERE `TtablaComportamiento_Id` ='$TtablaComportamiento_Id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
		}  		
	
	function BorrarTipoTablaComportamiento($TtablaComportamiento_Id)
	   	{
		$consulta = "DELETE FROM `OPE_TipoTablaComportamiento` WHERE `TtablaComportamiento_Id`='$TtablaComportamiento_Id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
		}  		

	function LeerTipoTablaInasistencias()
		{
        $consulta="SELECT * FROM `ope_tipotablainasistencias`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   		}   
		 
	function CrearTipoTablaInasistencias($TtablaInasistencias_Id,$TtablaInasistencias_Tipo,$TtablaInasistencias_Operacion,$TtablaInasistencias_Detalle)
	   	{
		$consulta = "INSERT INTO `ope_tipotablainasistencias`(`ttablainasistencias_tipo`, `ttablainasistencias_operacion`, `ttablainasistencias_detalle`) VALUES ('$TtablaInasistencias_Tipo','$TtablaInasistencias_Operacion','$TtablaInasistencias_Detalle')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT * FROM `ope_tipotablainasistencias`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
		}  	
	
	function EditarTipoTablaInasistencias($TtablaInasistencias_Id,$TtablaInasistencias_Tipo,$TtablaInasistencias_Operacion,$TtablaInasistencias_Detalle)
	   	{
		$consulta = "UPDATE `ope_tipotablainasistencias` SET `ttablainasistencias_tipo`='$TtablaInasistencias_Tipo',`ttablainasistencias_operacion`='$TtablaInasistencias_Operacion',`ttablainasistencias_detalle`='$TtablaInasistencias_Detalle' WHERE `ttablainasistencias_id`='$TtablaInasistencias_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `ope_tipotablainasistencias` WHERE `ttablainasistencias_id` ='$TtablaInasistencias_Id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
		}  		
	
	function BorrarTipoTablaInasistencias($TtablaInasistencias_Id)
	   	{
		$consulta = "DELETE FROM `ope_tipotablainasistencias` WHERE `ttablainasistencias_id`='$TtablaInasistencias_Id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
		}  		

	function leer_matriz_accidentes()
	{
        $consulta = "SELECT * FROM `ope_accidentesmatriz`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function crear_matriz_accidentes($accidentesmatriz_id, $acmt_campo, $acmt_busqueda, $acmt_respuesta)
	   	{
		$consulta = "INSERT INTO `ope_accidentesmatriz`(`acmt_campo`, `acmt_busqueda`, `acmt_respuesta`) VALUES ('$acmt_campo', '$acmt_busqueda', '$acmt_respuesta')";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT * FROM `ope_accidentesmatriz`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
		}  	
	
	function editar_matriz_accidentes($accidentesmatriz_id, $acmt_campo, $acmt_busqueda, $acmt_respuesta)
	   	{
		$consulta = "UPDATE `ope_accidentesmatriz` SET `acmt_campo`='$acmt_campo',`acmt_busqueda`='$acmt_busqueda',`acmt_respuesta`='$acmt_respuesta' WHERE `accidentesmatriz_id`='$accidentesmatriz_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `ope_accidentesmatriz` WHERE `accidentesmatriz_id` ='$accidentesmatriz_id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
		}  		
	
	function borrar_matriz_accidentes($accidentesmatriz_id)
	   	{
		$consulta = "DELETE FROM `ope_accidentesmatriz` WHERE `accidentesmatriz_id`='$accidentesmatriz_id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
		}  		
	
}