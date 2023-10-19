<?php
class PermisosModulo 
{	
	var $conexion;
	var $consulta;
	var $resultado;
	var $objeto;
	var $data;
	var $cant;
	function __construct()
	{
		SController('ConexionesBD','C_ConexionBD');
		$Instancia= new C_ConexionesBD();
		$this->conexion=$Instancia->Conectar(); 	
	}

	function ListaModulos($UsuarioId)
	{
			$this->consulta="SELECT 
							(SELECT `Mod_Nombre` 
							 FROM `Modulo` 
							 WHERE `Modulo_Id`=`PER_ModuloId`) AS Mod_Nombre
							,`PER_Nivel`,`PER_ModInicio` 
							FROM `Permisos` 
							WHERE `PER_UsuarioId`='$UsuarioId'";

        $this->resultado = $this->conexion->prepare($this->consulta);
      	$this->resultado->execute();
      	$this->data=$this->resultado->fetchall(PDO::FETCH_ASSOC);
      	return $this->data;
    }    

}
