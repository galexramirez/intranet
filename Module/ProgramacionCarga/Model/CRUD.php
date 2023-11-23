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

	function buscar_dato($nombre_tabla, $campo_buscar, $condicion_where)
	{
		$consulta = "SELECT `$nombre_tabla`.`$campo_buscar` FROM `$nombre_tabla` WHERE ".$condicion_where;

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;   
		$this->conexion=null;
	}

	function LeerProgramacionCarga($Calendario_Semana)
	{
		$consulta="SELECT `PrgRg_Id`, UPPER(DATE_FORMAT(`PrgRg_FechaProgramado`, '%Y-%m-%d %W')) AS `PrgRg_FechaProgramado`, DATE_FORMAT(`PrgRg_FechaCargada`, '%Y-%m-%d %H:%i:%s') AS `PrgRg_FechaCargada`,`PrgRg_Operacion`,(SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni` = `PrgRg_UsuarioId` LIMIT 1) AS `PrgRg_UsuarioId` FROM `ProgramacionRegistroCarga` LEFT JOIN `Calendario` ON `PrgRg_FechaProgramado`=`Calendario_Id` WHERE `Calendario_Semana`='$Calendario_Semana' ORDER BY `PrgRg_FechaProgramado` DESC"; 

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   

	function BuscarProgramacionCarga($PrgRg_Operacion,$PrgRg_FechaProgramado)
	{
		$consulta="SELECT * FROM `ProgramacionRegistroCarga` WHERE `PrgRg_Operacion`='$PrgRg_Operacion' AND `PrgRg_FechaProgramado`='$PrgRg_FechaProgramado'";
   		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$valida = $resultado->rowCount();
		
		if($valida==0){
			return true; 
		}else{
			return false;
		}

		$this->conexion=null;
	}

	function CrearProgramacionCarga($PrgRg_Operacion,$PrgRg_FechaProgramado)
	{
		$PrgRg_FechaCargada = date("Y-m-d H:i:s");
		$PrgRg_UsuarioId = $_SESSION['USUARIO_ID'];
		
		$consulta1 = "INSERT INTO `ProgramacionRegistroCarga`(`PrgRg_FechaProgramado`, `PrgRg_FechaCargada`, `PrgRg_Operacion`, `PrgRg_UsuarioId`) VALUES ('$PrgRg_FechaProgramado','$PrgRg_FechaCargada','$PrgRg_Operacion','$PrgRg_UsuarioId')";
		$resultado1 = $this->conexion->prepare($consulta1);
		$resultado1->execute();   
		
		$consulta2= "SELECT * FROM ProgramacionRegistroCarga ORDER BY PrgRg_Id DESC LIMIT 1";
        $resultado2= $this->conexion->prepare($consulta2);
        $resultado2->execute();

        $data=$resultado2->fetchAll(PDO::FETCH_ASSOC);

        $this->conexion=null;	
	}  	
	
	function BorrarProgramacionCarga($PrgRg_Id)
	{
		$consulta = "DELETE FROM `ProgramacionRegistroCarga` WHERE `PrgRg_Id`='$PrgRg_Id'";		
  		$resultado = $this->conexion->prepare($consulta);

		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function CrearProgramacion($Prog_Codigo,$Prog_Operacion,$Prog_Fecha,$Prog_Dni,$Prog_CodigoColaborador,$Prog_NombreColaborador,$Prog_Tabla,$Prog_HoraOrigen,$Prog_HoraDestino,$Prog_Servicio,$Prog_ServBus,$Prog_Bus,$Prog_LugarOrigen,$Prog_LugarDestino,$Prog_TipoEvento,$Prog_Observaciones,$Prog_KmXPuntos,$Prog_TipoTabla,$Prog_NPlaca,$Prog_NVid,$Prog_IdManto,$Prog_Sentido,$Prog_BusManto,$Prog_Viajes,$Prog_Campo1,$Prog_Campo2,$Prog_Campo3)
	{
	 	$consulta = "INSERT INTO `Programacion`(`Prog_Codigo`, `Prog_Operacion`, `Prog_Fecha`, `Prog_Dni`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, `Prog_HoraOrigen`, `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, `Prog_Viajes`, `Prog_Campo1`, `Prog_Campo2`, `Prog_Campo3`) VALUES ('$Prog_Codigo','$Prog_Operacion','$Prog_Fecha','$Prog_Dni','$Prog_CodigoColaborador','$Prog_NombreColaborador','$Prog_Tabla','$Prog_HoraOrigen','$Prog_HoraDestino','$Prog_Servicio','$Prog_ServBus','$Prog_Bus','$Prog_LugarOrigen','$Prog_LugarDestino','$Prog_TipoEvento','$Prog_Observaciones','$Prog_KmXPuntos','$Prog_TipoTabla','$Prog_NPlaca','$Prog_NVid','$Prog_IdManto','$Prog_Sentido','$Prog_BusManto','$Prog_Viajes','$Prog_Campo1','$Prog_Campo2','$Prog_Campo3')";
	 	
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

	function BorrarProgramacion($PrgRg_FechaProgramado,$PrgRg_Operacion)
	{
		$Prog_Codigo = substr($PrgRg_FechaProgramado, 0, 4).substr($PrgRg_FechaProgramado, 5, 2).substr($PrgRg_FechaProgramado, 8, 2).$PrgRg_Operacion;
		$consulta = "DELETE FROM `Programacion` WHERE `Prog_Codigo`='$Prog_Codigo'";		

  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function AniosProgramacionCarga()
	{
		$consulta="SELECT DISTINCT `Calendario_Anio` AS Anio FROM `Calendario` WHERE `Calendario_Anio` > '2020' ORDER BY `Calendario_Anio` DESC";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        return $data;
		$this->conexion=null;
   	}   
   
	function SemanasProgramacionCarga($Calendario_Anio)
	{
        $consulta="SELECT DISTINCT `Calendario_Semana` AS Semana FROM `Calendario` WHERE `Calendario_Anio`='$Calendario_Anio' ORDER BY `Calendario_Semana` DESC ";
 
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        return $data;
		$this->conexion=null;
		
   	}   

   function BuscarSemanaProgramacionCarga($PrgRg_FechaProgramado,$Semana)
	{
			$consulta="SELECT * FROM `Calendario` WHERE `Calendario_Id`='$PrgRg_FechaProgramado' AND `Calendario_Semana`='$Semana'";
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
   

	function AniosPublicacionCarga()
	{
		$consulta="SELECT DISTINCT `Calendario_Anio` AS Anio FROM `Calendario` WHERE `Calendario_Anio` > '2020' ORDER BY `Calendario_Anio` DESC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		return $data;
		$this->conexion=null;
	}   

	function LeerPublicacionCarga($AniosPublicados)
	{
		$consulta="SELECT `PubRg_Id`, `PubRg_SemanaPublicada`, DATE_FORMAT(`PubRg_FechaGenerar`,'%Y-%m-%d %H:%i:%s') AS `PubRg_FechaGenerar`, (SELECT `roles_nombrecorto` FROM `glo_roles` WHERE `PublicacionRegistroCarga`.`PubRg_UsuarioId_Generar` = `glo_roles`.`roles_dni` LIMIT 1) AS `PubRg_UsuarioId_Generar`, DATE_FORMAT(`PubRg_FechaPublicar`,'%Y-%m-%d %H:%i:%s') AS `PubRg_FechaPublicar`, (SELECT `roles_nombrecorto` FROM `glo_roles` WHERE `PublicacionRegistroCarga`.`PubRg_UsuarioId_Publicar` = `glo_roles`.`roles_dni` LIMIT 1) AS `PubRg_UsuarioId_Publicar`, DATE_FORMAT(`PubRg_FechaEliminar`,'%Y-%m-%d %H:%i:%s') AS `PubRg_FechaEliminar`, (SELECT `roles_nombrecorto` FROM `glo_roles` WHERE `PublicacionRegistroCarga`.`PubRg_UsuarioId_Eliminar` = `glo_roles`.`roles_dni` LIMIT 1) AS `PubRg_UsuarioId_Eliminar`, `PubRg_Estado` FROM `PublicacionRegistroCarga` WHERE SUBSTRING(`PubRg_SemanaPublicada`,1,4)='$AniosPublicados' ORDER BY `PubRg_SemanaPublicada` DESC";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}

   function BuscarPublicacionCarga($AniosPublicados, $Prog_Dni)
	{
		$PubRg_Estado =	"PUBLICADO";
	
		$consulta="SELECT DISTINCT `PublicacionRegistroCarga`.`PubRg_Id`,`PublicacionRegistroCarga`.`PubRg_SemanaPublicada`, DATE_FORMAT(`PublicacionRegistroCarga`.`PubRg_FechaPublicar`,'%Y-%m-%d %H:%i:%s') AS `PubRg_FechaPublicar`, (SELECT `roles_nombrecorto` FROM `glo_roles` WHERE `PublicacionRegistroCarga`.`PubRg_UsuarioId_Publicar` = `glo_roles`.`roles_dni` LIMIT 1) AS `PubRg_UsuarioId_Publicar`,`PublicacionRegistroCarga`.`PubRg_Estado` FROM `Programacion` LEFT JOIN `Calendario` ON `Programacion`.`Prog_Fecha`=`Calendario`.`Calendario_Id` LEFT JOIN `PublicacionRegistroCarga` ON `Calendario`.`Calendario_Semana` = `PublicacionRegistroCarga`.`PubRg_SemanaPublicada`  WHERE YEAR(`Programacion`.`Prog_Fecha`)='$AniosPublicados' AND `Programacion`.`Prog_Dni`='$Prog_Dni' AND `PublicacionRegistroCarga`.`PubRg_Estado` = '$PubRg_Estado' ORDER BY `PubRg_SemanaPublicada` DESC ";
		   
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		$this->conexion=null;
	}

	function CrearPublicacionCarga($PubRg_SemanaPublicada)
	{
		$PubRg_FechaGenerar = date("Y-m-d H:i:s");
		$PubRg_UsuarioId_Generar = $_SESSION['USUARIO_ID'];
		$PubRg_Estado1 = "PENDIENTE";
		$PubRg_Estado2 = "PUBLICADO";
		$valida1 = 0;

		$consulta1 = "SELECT * FROM `PublicacionRegistroCarga` WHERE `PubRg_SemanaPublicada`= '$PubRg_SemanaPublicada' AND (`PubRg_Estado` = '$PubRg_Estado1' OR `PubRg_Estado` = '$PubRg_Estado2' )";
		$resultado1 = $this->conexion->prepare($consulta1);
		$resultado1->execute();   

		$valida1 = $resultado1->rowCount();
		
		if($valida1==0)
			{
				$valida2 = 0;
				$consulta5="SELECT `Calendario_Semana`,`Prog_Dni`,`Prog_NombreColaborador`,`Prog_CodigoColaborador`,`Prog_Fecha`,`Prog_Tabla`, time_format(`Prog_HoraOrigen`,'%H:%i') as `Prog_HoraOrigen` ,time_format(`Prog_HoraDestino`,'%H:%i') as `Prog_HoraDestino`,`Prog_Servicio`,`Prog_Bus`,`Prog_LugarOrigen`,`Prog_LugarDestino`,`Prog_TipoEvento`,`Prog_Observaciones` FROM `Programacion` LEFT JOIN `Calendario` ON `Prog_Fecha`=`Calendario_Id` WHERE `Calendario_Semana`='$PubRg_SemanaPublicada' ORDER BY `Prog_Dni`,`Prog_Fecha`,`Prog_HoraOrigen` ";	
				$resultado5 = $this->conexion->prepare($consulta5);
				$resultado5->execute();    
				$valida2 = $resultado5->rowCount();
				
				if($valida2 > 0)
				{
                    $consulta2 = "INSERT INTO `PublicacionRegistroCarga`(`PubRg_SemanaPublicada`, `PubRg_FechaGenerar`, `PubRg_UsuarioId_Generar`,`PubRg_Estado`) VALUES ('$PubRg_SemanaPublicada','$PubRg_FechaGenerar','$PubRg_UsuarioId_Generar','$PubRg_Estado1')";
                    $resultado2 = $this->conexion->prepare($consulta2);
                    $resultado2->execute();

                    $consulta3= "SELECT * FROM PublicacionRegistroCarga ORDER BY PubRg_Id DESC LIMIT 1";
                    $resultado3 = $this->conexion->prepare($consulta3);
                    $resultado3->execute();
                    $data3=$resultado3->fetchAll(PDO::FETCH_ASSOC);
 
                    // Crea Carpeta por Años
                    $anio = substr($PubRg_SemanaPublicada, 0, 4);
                    $micarpeta = $_SERVER['DOCUMENT_ROOT']."/Services/PdfPublicacion/$anio";
            
                    if (!file_exists($micarpeta)) {
                        mkdir($micarpeta, 0777, true);
                    }
                    //else{ echo "Ya existe una publicacion activa de la semana: $PubRg_SemanaPublicada"; }

                    // GENERA ARCHIVOS JSON
                    $consulta4 = "SELECT * FROM `PublicacionRegistroCarga` WHERE `PubRg_SemanaPublicada` = '$PubRg_SemanaPublicada' AND `PubRg_Estado` = '$PubRg_Estado1'";
                    $resultado4 = $this->conexion->prepare($consulta4);
                    $resultado4->execute();
                    $data4=$resultado4->fetchAll(PDO::FETCH_ASSOC);
            
                    foreach ($data4 as $row) {
                        $PubRg_Id = $row['PubRg_Id'];
                    }
                    $SemanaPublicada = $PubRg_SemanaPublicada.$PubRg_Id.".json";
                
                    $anio = substr($PubRg_SemanaPublicada, 0, 4);
                    $micarpeta = $_SERVER['DOCUMENT_ROOT']."/Services/PdfPublicacion/$anio";
            
                    $data5=$resultado5->fetchAll(PDO::FETCH_ASSOC);
                    $var=json_encode($data5, JSON_UNESCAPED_UNICODE);
                    file_put_contents($micarpeta."/".$SemanaPublicada, $var);
        
                    echo "Generación Exitosa ...!!!";

                }else{
					echo "No existen registro para la semana selecionada ...!!!";	
				}
			}else{
				echo "El registro ya existe ...!!!";
			}

		$this->conexion=null;
	}  	
	
	function BorrarPublicacionCarga($PubRg_Id)
	{
		$PubRg_FechaEliminar = date("Y-m-d H:i:s");
		$PubRg_UsuarioId_Eliminar = $_SESSION['USUARIO_ID'];		
		$PubRg_Estado = "ELIMINADO";

		$consulta = "UPDATE `PublicacionRegistroCarga` SET `PubRg_Estado`='$PubRg_Estado', `PubRg_FechaEliminar`='$PubRg_FechaEliminar', `PubRg_UsuarioId_Eliminar`='$PubRg_UsuarioId_Eliminar'  WHERE `PubRg_Id`='$PubRg_Id'";		
  		$resultado = $this->conexion->prepare($consulta);

		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function SemanasPublicacionCarga($AniosPublicados)
	{
		$consulta="SELECT DISTINCT `Calendario_Semana` AS Semanas FROM `Calendario` WHERE `Calendario`.`Calendario_Anio` = '$AniosPublicados' ORDER BY `Calendario_Semana` DESC ";
   
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		return $data;
		$this->conexion=null;
	}

	function PublicarProgramacion($PubRg_Id)
	{
		$PubRg_FechaPublicar = date("Y-m-d H:i:s");
		$PubRg_UsuarioId_Publicar = $_SESSION['USUARIO_ID'];		
		$PubRg_Estado = "PUBLICADO";

		$consulta = "UPDATE `PublicacionRegistroCarga` SET `PubRg_Estado`='$PubRg_Estado', `PubRg_FechaPublicar`='$PubRg_FechaPublicar', `PubRg_UsuarioId_Publicar`='$PubRg_UsuarioId_Publicar'  WHERE `PubRg_Id`='$PubRg_Id'";		
		$resultado = $this->conexion->prepare($consulta);

		$resultado->execute();   
		$this->conexion=null;	
	}  		

	function DetalleProgramacion($FechaInicio,$FechaTermino,$Prog_Dni)
	{
        
		if(empty($Prog_Dni)){
			$consulta="SELECT `Prog_CodigoColaborador`, `Prog_NombreColaborador`, UPPER(DAYNAME (`Prog_Fecha`)) AS Dia, DATE_FORMAT(`Prog_Fecha`, '%Y-%m-%d') AS `Prog_Fecha`, `Prog_Tabla`, time_format(`Prog_HoraOrigen`,'%H:%i') as `Prog_HoraOrigen`, time_format(`Prog_HoraDestino`,'%H:%i') as `Prog_HoraDestino`, `Prog_Servicio`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones` FROM `Programacion` WHERE `Prog_Fecha`>='$FechaInicio' AND `Prog_Fecha`<='$FechaTermino' ";
		}else{
			$consulta="SELECT `Prog_CodigoColaborador`, `Prog_NombreColaborador`, UPPER(DAYNAME (`Prog_Fecha`)) AS Dia, DATE_FORMAT(`Prog_Fecha`, '%Y-%m-%d') AS `Prog_Fecha`, `Prog_Tabla`, time_format(`Prog_HoraOrigen`,'%H:%i') as `Prog_HoraOrigen`, time_format(`Prog_HoraDestino`,'%H:%i') as `Prog_HoraDestino`, `Prog_Servicio`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones` FROM `Programacion` WHERE `Prog_Fecha`>='$FechaInicio' AND `Prog_Fecha`<='$FechaTermino' AND `Prog_Dni` LIKE '$Prog_Dni' ";
		}

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
	}   

	function CrearArchivosJson($PubRg_SemanaPublicada)
	{
	
		$PubRg_Estado = "PENDIENTE";
		$consulta1 = "SELECT * FROM `PublicacionRegistroCarga` WHERE `PubRg_SemanaPublicada` = '$PubRg_SemanaPublicada' AND `PubRg_Estado` = '$PubRg_Estado'";
		$resultado1 = $this->conexion->prepare($consulta1);
        $resultado1->execute();        
	    $data1=$resultado1->fetchAll(PDO::FETCH_ASSOC);
	
		foreach ($data1 as $row){
            $PubRg_Id = $row['PubRg_Id'];
        }
		$SemanaPublicada = $PubRg_SemanaPublicada.$PubRg_Id.".json";
		
		$anio = substr($PubRg_SemanaPublicada,0,4);
		$micarpeta = $_SERVER['DOCUMENT_ROOT']."/Services/PdfPublicacion/$anio";
	
		$consulta2="SELECT `Calendario_Semana`,`Prog_Dni`,`Prog_NombreColaborador`,`Prog_CodigoColaborador`,`Prog_Fecha`,`Prog_Tabla`, time_format(`Prog_HoraOrigen`,'%H:%i') as `Prog_HoraOrigen` ,time_format(`Prog_HoraDestino`,'%H:%i') as `Prog_HoraDestino`,`Prog_Servicio`,`Prog_Bus`,`Prog_LugarOrigen`,`Prog_LugarDestino`,`Prog_TipoEvento`,`Prog_Observaciones` FROM `Programacion` LEFT JOIN `Calendario` ON `Prog_Fecha`=`Calendario_Id` WHERE `Calendario_Semana`='$PubRg_SemanaPublicada' ORDER BY `Prog_Dni`,`Prog_Fecha`,`Prog_HoraOrigen` ";	
   		
		$resultado2 = $this->conexion->prepare($consulta2);
		$resultado2->execute();        
		$data2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
		$var=json_encode($data2, JSON_UNESCAPED_UNICODE);
		file_put_contents($micarpeta."/".$SemanaPublicada, $var);
	}

	function CrearRegistroDescarga($Dni)
   	{
		$RgDes_FechaDescarga = date("Y-m-d H:i:s");
		
		$consulta = "INSERT INTO `RegistroDescarga`(`RgDes_UsuarioId`, `RgDes_FechaDescarga`) VALUES ('$Dni','$RgDes_FechaDescarga')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
        $this->conexion=null;	
	}

	function BuscarSemanaPublicada($Semana)
	{
	$PubRg_Estado =	"PUBLICADO";
	$Semana = substr($Semana,0,21);
	$consulta="SELECT DISTINCT `PubRg_Id` FROM `PublicacionRegistroCarga` WHERE `PubRg_SemanaPublicada` = '$Semana' AND `PubRg_Estado` = '$PubRg_Estado'";
	   
	$resultado = $this->conexion->prepare($consulta);
	$resultado->execute();        
	$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

	$valida = $resultado->rowCount();

	if($valida==0){
        $Semana = "";
    }else{
		foreach ($data as $row) {
            $Semana = $Semana.$row['PubRg_Id'];
        }
	}

	return $Semana;

	$this->conexion=null;
	}

	function DetalleDescargaPdf($Desc_FechaInicio,$Desc_FechaTermino,$Desc_Prog_Dni)
	{
		if(empty($Desc_Prog_Dni)){
			$consulta="SELECT `RgDes_Id`, `RgDes_UsuarioId`, (SELECT `glo_roles`.`roles_apellidosnombres` FROM `glo_roles` WHERE `RgDes_UsuarioId` = `roles_dni` LIMIT 1) AS `Usua_Nombres`, DATE_FORMAT(`RgDes_FechaDescarga`,'%d-%m-%Y %H:%i:%s') AS `RgDes_FechaDescarga` FROM `RegistroDescarga` WHERE DATE_FORMAT(`RgDes_FechaDescarga`,'%Y-%m-%d') >= '$Desc_FechaInicio' AND DATE_FORMAT(`RgDes_FechaDescarga`,'%Y-%m-%d') <= '$Desc_FechaTermino'";
		}else{
			$consulta="SELECT `RgDes_Id`, `RgDes_UsuarioId`, (SELECT `glo_roles`.`roles_apellidosnombres` FROM `glo_roles` WHERE `RgDes_UsuarioId` = `roles_dni` LIMIT 1) AS `Usua_Nombres`, DATE_FORMAT(`RgDes_FechaDescarga`,'%Y-%m-%d %H:%i:%s') AS `RgDes_FechaDescarga` FROM `RegistroDescarga` WHERE DATE_FORMAT(`RgDes_FechaDescarga`,'%Y-%m-%d') >= '$Desc_FechaInicio' AND DATE_FORMAT(`RgDes_FechaDescarga`,'%Y-%m-%d') <= '$Desc_FechaTermino' AND `RgDes_UsuarioId`='$Desc_Prog_Dni'";
		}
//echo $consulta;
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
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

	function ValidarProgramacionCarga($PubRg_SemanaPublicada, $PubRg_Estado)
	{
		$consulta="SELECT * FROM `PublicacionRegistroCarga` WHERE `PubRg_SemanaPublicada`='$PubRg_SemanaPublicada' AND `PubRg_Estado`='$PubRg_Estado'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$valida = $resultado->rowCount();
		
		if($valida==0){
			return false;
		}
		else{
			return true;			
		}
		$this->conexion=null;
	}

	function ValidarControlFacilitador($CFaRg_FechaCargada, $CFaRg_TipoOperacionCargada ,$CFaRg_Estado)
	{
		$consulta="SELECT * FROM `OPE_ControlFacilitadorRegistroCarga` WHERE `CFaRg_FechaCargada`='$CFaRg_FechaCargada' AND `CFaRg_TipoOperacionCargada`='$CFaRg_TipoOperacionCargada' AND `CFaRg_Estado`='$CFaRg_Estado'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$valida = $resultado->rowCount();
		
		if($valida==0){
			return false;
		}
		else{
			return true;			
		}
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

}