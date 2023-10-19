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

	function CargarNomina($FechaInicio,$FechaTermino)
		{

		$consulta="SELECT ANY_VALUE(DATE_FORMAT( `Prog_Fecha`,'%d-%m-%Y')) AS Fecha, ANY_VALUE( `Prog_CodigoColaborador`) AS Codigo, `Prog_Dni` AS DNI, ANY_VALUE( `Prog_NombreColaborador`) AS ApellidosNombres, time_format(MIN( `Prog_HoraOrigen`),'%H:%i') AS HoraInicio, time_format(MAX( `Prog_HoraDestino`),'%H:%i') AS HoraTermino, time_format(SUBTIME(MAX( `Prog_HoraDestino`),MIN( `Prog_HoraOrigen`)),'%H:%i') AS Amplitud, time_format(SEC_TO_TIME(SUM(TIME_TO_SEC(SUBTIME( `Prog_HoraDestino`,`Prog_HoraOrigen`)))),'%H:%i') AS Duracion, ANY_VALUE( `Prog_Operacion`) AS TipoOperacion, ANY_VALUE( `Prog_Servicio`) AS Servicio FROM `Programacion` GROUP BY `Prog_Fecha`, `Prog_Dni` HAVING `Prog_Fecha`>='$FechaInicio' AND `Prog_Fecha`<='$FechaTermino' ";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   		}   
		 

}