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

	function Read()
		{
        $consulta="SELECT * FROM usuario";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   		}   
		 
	function Create($Usuario_Id,$Usua_Nombres,$Usua_NombreCorto,$Usua_UsuarioWeb,$Usua_Password,$Usua_Perfil,$Usua_Estado)
	   	{
		$Usua_Password = MD5($Usua_Password);
		$consulta = "INSERT INTO `usuario`(`Usuario_Id`, `Usua_Nombres`, `Usua_NombreCorto`, `Usua_UsuarioWeb`, `Usua_Password`, `Usua_Perfil`, `Usua_Estado`)
					 VALUES ('$Usuario_Id','$Usua_Nombres','$Usua_NombreCorto','$Usua_UsuarioWeb','$Usua_Password','$Usua_Perfil','$Usua_Estado')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta= "SELECT * FROM usuario WHERE Usuario_Id ='$Usuario_Id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
		}  	
	
	function Update($Usuario_Id,$Usua_Nombres,$Usua_NombreCorto,$Usua_UsuarioWeb,$Usua_Password,$Usua_Perfil,$Usua_Estado)
	{
			$consulta= "SELECT Usua_Password FROM usuario WHERE Usuario_Id ='$Usuario_Id'";
			$resultado = $this->conexion->prepare($consulta);
			$resultado->execute();
			$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

			foreach($data as $row){
				$password = $row['Usua_Password'];
			}

			if($Usua_Password!==$password){
				$Usua_Password=MD5($Usua_Password);
			}        
		
		$consulta = "UPDATE `usuario` SET `Usua_Nombres`='$Usua_Nombres',`Usua_NombreCorto`='$Usua_NombreCorto',`Usua_UsuarioWeb`='$Usua_UsuarioWeb',`Usua_Password`='$Usua_Password',`Usua_Perfil`='$Usua_Perfil',`Usua_Estado`='$Usua_Estado' WHERE `Usuario_Id`='$Usuario_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta= "SELECT * FROM usuario WHERE Usuario_Id ='$Usuario_Id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function Delete($Usuario_Id)
	{
		$consulta = "DELETE FROM `usuario` WHERE `Usuario_Id`='$Usuario_Id'";
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
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

	function BuscarDataBD($TablaBD,$CampoBD,$DataBuscar)
	{
		$consulta="SELECT * FROM `$TablaBD` WHERE `$CampoBD` = '$DataBuscar'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

}
