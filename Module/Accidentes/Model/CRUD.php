<?php
session_start();
class CRUD
{	
	var $conexion;
	var $conexion2;
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
		$this->conexion2=$Instancia->Conectar2();
	}

	//::::::::::::::::::::::::::::::::::::::::::::::: ACCIDENTES :::::::::::::::::::::::::::::::::::::::::::::://

	function BuscarAccidentes($fecha_inicio, $fecha_termino)
	{
		$Nove_Novedad 		= "NOVEDAD_OPERACION";
		$Nove_TipoNovedad 	= "'ACCIDENTE_TRANSITO','DAÑO_EN_OPERACION','VANDALISMO','ACCIDENTE_ESPECIAL'";
		$consulta			= "SELECT `OPE_Novedad`.`Nove_ProgramacionId`, `OPE_Novedad`.`Novedad_Id`, `OPE_Novedad`.`Nove_FechaOperacion`, (SELECT `colaborador`.`Colab_ApellidosNombres` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`OPE_Novedad`.`Nove_UsuarioId`) AS `UsuarioGenera`, `OPE_Novedad`.`Nove_Operacion`, `OPE_Novedad`.`Nove_TipoNovedad`, `OPE_Novedad`.`Nove_DetalleNovedad`, `OPE_Novedad`.`Nove_NombreColaborador`, `OPE_Novedad`.`Nove_Bus`, `OPE_Novedad`.`Nove_Estado`, `OPE_Accidentes`.`OPE_AccidentesId`, `OPE_Accidentes`.`Accidentes_Id`, `OPE_Accidentes`.`Accidentes_Id`, '' AS `Acci_ResponsabilidadPiloto`, `OPE_AccidentesInformePreliminar`.`Acci_EstadoInformePreliminar`, `OPE_AccidentesInvestigacion`.`Acci_EstadoInvestigacion`, (SELECT `OPE_AccidentesImagen`.`Acci_TipoImagen` FROM `OPE_AccidentesImagen` WHERE `OPE_AccidentesImagen`.`Accidentes_Id`=`OPE_Novedad`.`Novedad_Id` AND `OPE_AccidentesImagen`.`Acci_TipoImagen`='IP_PDF') AS `acci_ip_pdf`, (SELECT `OPE_AccidentesImagen`.`Acci_TipoImagen` FROM `OPE_AccidentesImagen` WHERE `OPE_AccidentesImagen`.`Accidentes_Id`=`OPE_Novedad`.`Novedad_Id` AND `OPE_AccidentesImagen`.`Acci_TipoImagen`='PDF') AS `acci_doc_adj` FROM `OPE_Novedad` LEFT JOIN `OPE_Accidentes` ON `OPE_Accidentes`.`Acci_OPENovedadId`=`OPE_Novedad`.`OPE_NovedadId` LEFT JOIN `OPE_AccidentesInformePreliminar` ON `OPE_AccidentesInformePreliminar`.`Accidentes_Id` = `OPE_Accidentes`.`Accidentes_Id` LEFT JOIN `OPE_AccidentesInvestigacion` ON `OPE_AccidentesInvestigacion`.`Accidentes_Id` = `OPE_Accidentes`.`Accidentes_Id` WHERE `OPE_Novedad`.`Nove_Novedad`='$Nove_Novedad' AND `OPE_Novedad`.`Nove_TipoNovedad` IN ($Nove_TipoNovedad) AND `OPE_Novedad`.`Nove_FechaOperacion`>='$fecha_inicio' AND `OPE_Novedad`.`Nove_FechaOperacion`<='$fecha_termino' ORDER BY `OPE_Novedad`.`OPE_NovedadId` DESC";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   

	function DetalleControlFacilitador($Nove_ProgramacionId, $Novedad_Id)
	{
		$consulta="SELECT `Nove_FechaOperacion`, `ControlFacilitador_Id`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, TIME_FORMAT( `Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT( `Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_ControlFacilitador`.`CFaci_UsuarioId` = `colaborador`.`Colaborador_id`) AS `CFaci_UsuarioId`, `Novedad_Id`, `Nove_Novedad`, `Nove_TipoNovedad`, `Nove_DetalleNovedad`, `Nove_Descripcion`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_Novedad`.`Nove_UsuarioId` = `colaborador`.`Colaborador_id`) AS `Nove_UsuarioId` FROM `OPE_ControlFacilitador` LEFT JOIN `OPE_Novedad` ON `Novedad_Id`='$Novedad_Id' WHERE `Programacion_Id`='$Nove_ProgramacionId'";
			
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function detalle_control_facilitador_hist($Nove_ProgramacionId, $Novedad_Id)
	{
		$consulta="SELECT `Nove_FechaOperacion`, `ControlFacilitador_Id`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, TIME_FORMAT( `Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT( `Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_ControlFacilitador`.`CFaci_UsuarioId` = `colaborador`.`Colaborador_id`) AS `CFaci_UsuarioId`, `Novedad_Id`, `Nove_Novedad`, `Nove_TipoNovedad`, `Nove_DetalleNovedad`, `Nove_Descripcion`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_Novedad`.`Nove_UsuarioId` = `colaborador`.`Colaborador_id`) AS `Nove_UsuarioId` FROM `bdlimabus_hist`.`OPE_ControlFacilitador` LEFT JOIN `OPE_Novedad` ON `Novedad_Id`='$Novedad_Id' WHERE `Programacion_Id`='$Nove_ProgramacionId'";
			
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function CargaTablaNaturaleza($Accidentes_Id,$Acci_Tipo)
	{
		$consulta="SELECT * FROM `OPE_AccidentesNaturaleza` WHERE `Accidentes_Id` = '$Accidentes_Id' AND `Acci_Tipo` = '$Acci_Tipo' ORDER BY `OPE_AcciNaturalezaId` DESC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		$this->conexion=null;
	}

	function EliminarTablaNaturaleza($OPE_AcciNaturalezaId,$Accidentes_Id,$Acci_Tipo)
	{
		$consulta="DELETE FROM `OPE_AccidentesNaturaleza` WHERE `OPE_AcciNaturalezaId` = '$OPE_AcciNaturalezaId' AND `Accidentes_Id` = '$Accidentes_Id' AND `Acci_Tipo` = '$Acci_Tipo'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		//print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		$this->conexion=null;
	}   

	function CrearAccidentesNaturaleza($Accidentes_Id,$Acci_Tipo,$Acci_Descripcion,$Acci_Nombre,$Acci_Dni,$Acci_Edad,$Acci_Genero, $acci_origen, $Acci_Placa)
	{
		$consulta = "INSERT INTO `OPE_AccidentesNaturaleza`(`Accidentes_Id`, `Acci_Tipo`, `Acci_Descripcion`, `Acci_Nombre`, `Acci_Dni`, `Acci_Edad`, `Acci_Genero`, `acci_origen`, `Acci_Placa`) VALUES ('$Accidentes_Id','$Acci_Tipo','$Acci_Descripcion','$Acci_Nombre','$Acci_Dni','$Acci_Edad','$Acci_Genero', '$acci_origen', '$Acci_Placa')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$consulta= "SELECT * FROM `OPE_AccidentesNaturaleza` WHERE `Accidentes_Id` = '$Accidentes_Id' AND `Acci_Tipo` = '$Acci_Tipo'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a <AJAX></AJAX>

		$this->conexion=null;	
	}

	function editar_accidentes_naturaleza($Accidentes_Id, $Acci_Tipo, $Acci_Descripcion, $Acci_Nombre, $Acci_Dni, $Acci_Edad, $Acci_Genero, $acci_origen, $Acci_Placa, $OPE_AcciNaturalezaId)
	{
		$consulta = " UPDATE `OPE_AccidentesNaturaleza` SET `Acci_Descripcion`='$Acci_Descripcion', `Acci_Nombre`='$Acci_Nombre', `Acci_Dni`='$Acci_Dni', `Acci_Edad`='$Acci_Edad', `Acci_Genero`='$Acci_Genero', `acci_origen`='$acci_origen', `Acci_Placa`='$Acci_Placa' WHERE `OPE_AcciNaturalezaId`='$OPE_AcciNaturalezaId' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$consulta= "SELECT * FROM `OPE_AccidentesNaturaleza` WHERE `Accidentes_Id` = '$Accidentes_Id' AND `Acci_Tipo` = '$Acci_Tipo'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a <AJAX></AJAX>

		$this->conexion=null;	
	}

	function CargaTablaReparacion($Accidentes_Id)
	{
		$consulta="SELECT * FROM `OPE_AccidentesReparacion` WHERE `Accidentes_Id` = '$Accidentes_Id' ORDER BY `OPE_AcciReparacionId` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		$this->conexion=null;
	}   

	function EliminarTablaReparacion($OPE_AcciReparacionId,$Accidentes_Id)
	{
		$consulta="DELETE FROM `OPE_AccidentesReparacion` WHERE `OPE_AcciReparacionId` = '$OPE_AcciReparacionId' AND `Accidentes_Id` = '$Accidentes_Id'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		$this->conexion=null;
	}   

	function CrearAccidentesReparacion($Accidentes_Id,$Acci_CodigoColor,$Acci_SeccionBus,$Acci_DescripcionReparacion)
	{
		$consulta = "INSERT INTO `OPE_AccidentesReparacion`(`Accidentes_Id`, `Acci_CodigoColor`, `Acci_SeccionBus`, `Acci_DescripcionReparacion`) VALUES ('$Accidentes_Id','$Acci_CodigoColor','$Acci_SeccionBus','$Acci_DescripcionReparacion')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$consulta= "SELECT * FROM `OPE_AccidentesReparacion` WHERE `Accidentes_Id` = '$Accidentes_Id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a <AJAX></AJAX>

		$this->conexion=null;	
	}

	function CerrarInformePreliminar($Accidentes_Id)
	{
		$consulta	= "SELECT * FROM `OPE_AccidentesInformePreliminar` WHERE `Accidentes_Id`='$Accidentes_Id' ";
        $resultado 	= $this->conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach ($data as $row) {
			$acci_log_ip 	= $row['acci_log_ip'];
		}

		$Acci_FechaCerrar 		= date("Y-m-d H:i:s");
		$Acci_UsuarioId_Cerrar 	= $_SESSION['USUARIO_ID'];		
		$acci_usuario_nombres	= $_SESSION['Usua_NombreCorto'];
		$Acci_Estado 			= "CERRADO";
		$acci_log_ip 			= $Acci_FechaCerrar."  ".$Acci_Estado." ".$acci_usuario_nombres." CERRAR: IP <br>".$acci_log_ip;

		$consulta = "UPDATE `OPE_AccidentesInformePreliminar` SET `Acci_EstadoInformePreliminar`='$Acci_Estado', `Acci_FechaCerrar`='$Acci_FechaCerrar', `Acci_UsuarioId_Cerrar`='$Acci_UsuarioId_Cerrar', `acci_log_ip`='$acci_log_ip'  WHERE `Accidentes_Id`='$Accidentes_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT *,DATE_FORMAT(`Acci_FechaElaboracionInforme`,'%d-%m-%Y %H:%i') AS `f_Acci_FechaElaboracionInforme`, DATE_FORMAT(`Acci_FechaCerrar`,'%d-%m-%Y %H:%i') AS `f_Acci_FechaCerrar`, (SELECT `colaborador`.`Colab_ApellidosNombres` FROM `colaborador` WHERE `colaborador`.`Colaborador_id` = `Acci_UsuarioId_Cerrar`) AS `n_Acci_UsuarioId_Cerrar` FROM `OPE_AccidentesInformePreliminar` WHERE `Accidentes_Id`='$Accidentes_Id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a <AJAX></AJAX>

		$this->conexion=null;	
	}  		

	function AbrirInformePreliminar($Accidentes_Id)
	{
		$consulta	= "SELECT * FROM `OPE_AccidentesInformePreliminar` WHERE `Accidentes_Id`='$Accidentes_Id' ";
        $resultado 	= $this->conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach ($data as $row) {
			$acci_log_ip 	= $row['acci_log_ip'];
		}

		$Acci_UsuarioId_Cerrar = "";
		$Acci_Estado = "ABIERTO";
		$acci_usuario_nombres	= $_SESSION['Usua_NombreCorto'];
		$acci_log_ip 			= date('Y-m-d H:i:s')."  ".$Acci_Estado." ".$acci_usuario_nombres." ABRIR: IP <br>".$acci_log_ip;
 
		$consulta = "UPDATE `OPE_AccidentesInformePreliminar` SET `Acci_EstadoInformePreliminar`='$Acci_Estado', `Acci_FechaCerrar`=null, `Acci_UsuarioId_Cerrar`='$Acci_UsuarioId_Cerrar', `acci_log_ip`='$acci_log_ip'  WHERE `Accidentes_Id`='$Accidentes_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT *,DATE_FORMAT(`Acci_FechaElaboracionInforme`,'%d-%m-%Y %H:%i') AS `f_Acci_FechaElaboracionInforme`, DATE_FORMAT(`Acci_FechaCerrar`,'%d-%m-%Y %H:%i') AS `f_Acci_FechaCerrar`, (SELECT `colaborador`.`Colab_ApellidosNombres` FROM `colaborador` WHERE `colaborador`.`Colaborador_id` = `Acci_UsuarioId_Cerrar`) AS `n_Acci_UsuarioId_Cerrar` FROM `OPE_AccidentesInformePreliminar` WHERE `Accidentes_Id`='$Accidentes_Id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a <AJAX></AJAX>

		$this->conexion=null;	
	}  		

	function BorrarAccidentes($Accidentes_Id)
	{
		$consulta = "DELETE FROM `OPE_Accidentes` WHERE `Accidentes_Id`='$Accidentes_Id'";		
		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   
  		$this->conexion=null;	
  	}  		

	function SelectUsuario($Usua_Perfil)
	{
		$consulta="SELECT `colaborador`.`Colab_ApellidosNombres` AS `Usuario` FROM `glo_roles` RIGHT JOIN `colaborador` ON `colaborador`.`Colaborador_id`= `glo_roles`.`roles_dni` AND `colaborador`.`Colab_Estado`='ACTIVO' WHERE `glo_roles`.`roles_perfil` = '$Usua_Perfil'  ORDER BY `Usuario` ASC";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function SelectTablaAccidente($Prog_Fecha)
	{
		$consulta="SELECT DISTINCT `OPE_ControlFacilitador`.`Prog_Tabla` AS `Tabla` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$Prog_Fecha' ORDER BY `Tabla` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function select_tabla_accidente_hist($Prog_Fecha)
	{
		$consulta = " SELECT DISTINCT `OPE_ControlFacilitador`.`Prog_Tabla` AS `Tabla` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$Prog_Fecha' ORDER BY `Tabla` ASC";

		$resultado = $this->conexion2->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion2=null;
	}

	function SelectBus()
	{
		$consulta="SELECT `Buses`.`Bus_NroExterno` AS `Bus` FROM `Buses` ORDER BY `Bus` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function BuscarServicio($Prog_Fecha,$Prog_Tabla)
	{
		$consulta="SELECT DISTINCT `Prog_Servicio` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$Prog_Fecha' AND `Prog_Tabla`='$Prog_Tabla'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function buscar_servicio_hist($Prog_Fecha,$Prog_Tabla)
	{
		$consulta="SELECT DISTINCT `Prog_Servicio` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$Prog_Fecha' AND `Prog_Tabla`='$Prog_Tabla'";

		$resultado = $this->conexion2->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion2=null;
	}

	function SelectTipos($TtablaAccidentes_Operacion,$TtablaAccidentes_Tipo)
	{
		$consulta="SELECT `OPE_TipoTablaAccidentes`.`TtablaAccidentes_Detalle` AS 'Detalle' FROM `OPE_TipoTablaAccidentes` WHERE `OPE_TipoTablaAccidentes`.`TtablaAccidentes_Operacion` = '$TtablaAccidentes_Operacion' AND `OPE_TipoTablaAccidentes`.`TtablaAccidentes_Tipo` = '$TtablaAccidentes_Tipo' ORDER BY `Detalle` ASC";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        

		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function MaxId($TablaBD,$CampoId)
	{
		$consulta = "SELECT MAX(`$CampoId`) AS `MaxId` FROM `$TablaBD`";
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

	function buscar_dato($nombre_tabla, $campo_buscar, $condicion_where)
	{
		$consulta = "SELECT `$nombre_tabla`.`$campo_buscar` FROM `$nombre_tabla` WHERE ".$condicion_where;

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;   
		$this->conexion=null;
	}

	function GrabarImagen($Accidentes_Id,$Acci_TipoImagen,$Acci_Imagen)
	{
		$Acci_ImagenFecha = date("Y-m-d H:i:s");
		$Acci_ImagenUsuarioId = $_SESSION['USUARIO_ID'];		

		$consulta="INSERT INTO `OPE_AccidentesImagen`(`Accidentes_Id`, `Acci_TipoImagen`, `Acci_Imagen`, `Acci_ImagenFecha`, `Acci_ImagenUsuarioId`) VALUES ('$Accidentes_Id', '$Acci_TipoImagen', '$Acci_Imagen', '$Acci_ImagenFecha', '$Acci_ImagenUsuarioId')";

		$resultado = $this->conexion->prepare($consulta);
 		$resultado->execute();   

 		$this->conexion=null;	
 	}

	function EditarImagen($Accidentes_Id,$Acci_TipoImagen,$Acci_Imagen)
	{
		$Acci_ImagenFecha = date("Y-m-d H:i:s");
		$Acci_ImagenUsuarioId = $_SESSION['USUARIO_ID'];		

		$consulta="UPDATE `OPE_AccidentesImagen` SET `Acci_Imagen`='$Acci_Imagen', `Acci_ImagenFecha`='$Acci_ImagenFecha', `Acci_ImagenUsuarioId`='$Acci_ImagenUsuarioId', `Acci_ImagenFecha`='$Acci_ImagenFecha', `Acci_ImagenUsuarioId`='$Acci_ImagenUsuarioId'  WHERE `Accidentes_Id`='$Accidentes_Id' AND `Acci_TipoImagen`='$Acci_TipoImagen'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
 
		$this->conexion=null;	
	}
 
	function BuscarImagen($Accidentes_Id,$Acci_TipoImagen)
	{
		$consulta="SELECT TO_BASE64 (`Acci_Imagen`) AS `b64_Foto` FROM `OPE_AccidentesImagen` WHERE `Accidentes_Id`='$Accidentes_Id' AND `Acci_TipoImagen`='$Acci_TipoImagen'";
		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   
  		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

  		$this->conexion=null;	
	}  		

	function BuscarImagenPDF($Accidentes_Id)
	{
		$Acci_TipoImagen1 = 'PDF';
		$Acci_TipoImagen2 = 'IP_PDF';
		$consulta="SELECT TO_BASE64(`Acci_Imagen`) AS `b64_Imagen`, `OPE_AcciImagenId`, `Accidentes_Id`, `Acci_TipoImagen` FROM `OPE_AccidentesImagen` WHERE `Accidentes_Id`='$Accidentes_Id' AND `Acci_TipoImagen`!='$Acci_TipoImagen1' AND `Acci_TipoImagen`!='$Acci_TipoImagen2'";
		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   
  		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
  		$this->conexion=null;	
	}  		

	function BuscarInformePreliminar($Accidentes_Id)
    {
		$consulta = "SELECT *,DATE_FORMAT(`Acci_FechaElaboracionInforme`,'%d-%m-%Y %H:%i') AS `f_Acci_FechaElaboracionInforme`, DATE_FORMAT(`Acci_FechaCerrar`,'%d-%m-%Y %H:%i') AS `f_Acci_FechaCerrar`, (SELECT `colaborador`.`Colab_ApellidosNombres` FROM `colaborador` WHERE `colaborador`.`Colaborador_id` = `Acci_UsuarioId_Cerrar`) AS `n_Acci_UsuarioId_Cerrar`, `Buses`.`Bus_NroPlaca` AS `Acci_NroPlaca` FROM `OPE_AccidentesInformePreliminar` LEFT JOIN `Buses` ON `Buses`.`Bus_NroExterno`=`Acci_Bus` WHERE `Accidentes_Id`='$Accidentes_Id'";
		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   
  		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

  		$this->conexion=null;	
    }

	function CrearAccidentes($Accidentes_Id,$Nove_ProgramacionId,$Acci_ControlFacilitadorId,$Acci_OPENovedadId,$Novedad_Id,$Acci_Operacion,$Acci_FechaOperacion,$Acci_CFaRgId)
	{
		$Acci_EstadoAccidente 	= "ABIERTO";
		$Acci_FechaGenerar 		= date("Y-m-d H:i:s");
		$Acci_UsuarioId_Generar = $_SESSION['USUARIO_ID'];

		$consulta = "INSERT INTO `OPE_Accidentes`(`Accidentes_Id`, `Acci_ProgramacionId`, `Acci_ControlFacilitadorId`, `Acci_OPENovedadId`, `Acci_NovedadId`, `Acci_Operacion`, `Acci_FechaOperacion`, `Acci_EstadoAccidente`, `Acci_UsuarioId_Generar`, `Acci_FechaGenerar`, `Acci_CFaRgId`) VALUES ('$Accidentes_Id', '$Nove_ProgramacionId', '$Acci_ControlFacilitadorId', '$Acci_OPENovedadId', '$Novedad_Id', '$Acci_Operacion', '$Acci_FechaOperacion', '$Acci_EstadoAccidente', '$Acci_UsuarioId_Generar', '$Acci_FechaGenerar', '$Acci_CFaRgId')";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$this->conexion=null;	
	}

	function CrearInformePreliminar($Accidentes_Id, $Acci_ClaseAccidente, $Acci_TipoAccidente, $Acci_DanosMateriales, $Acci_Lesiones, $Acci_Fatalidad, $Acci_Otro,$Acci_OtroDescripcion, $Acci_TipoEvento, $Acci_Fecha, $Acci_Hora, $Acci_Dni, $Acci_CodigoColaborador, $Acci_NombreColaborador, $Acci_Tabla, $Acci_Servicio, $Acci_Lugar,$Acci_Bus, $Acci_Sentido, $Acci_km_perdidos, $Acci_Conciliacion, $Acci_MontoConciliado, $Acci_CodigoCGO, $Acci_NombreCGO, $Acci_CodigoPersonalApoyo, $Acci_NombrePersonalApoyo, $Acci_ReconoceResponsabilidad, $Acci_Hospital, $Acci_Comisaria, $Acci_HoraFinAtencion, $Acci_HorasTrabajadas, $Acci_Objeto, $Acci_HoraLlegadaProcurador, $Acci_CodigoCGM, $Acci_NombreCGM, $Acci_CodigoPersonalApoyoManto, $Acci_NombrePersonalApoyoManto, $Acci_NumeroOT, $Acci_DocReporte,$Acci_DocConciliacion, $Acci_DocPartePolicial, $Acci_DocOficioPeritaje, $Acci_DocReporteAtencion, $Acci_DocDenunciaPolicial, $Acci_DocCitacionManifestacion, $Acci_DocOtro,$Acci_DocOtroDescripcion, $Acci_Descripcion, $Acci_CodigoSuscribeInformacion, $Acci_NombreSuscribeInformacion, $Acci_FechaElaboracionInforme, $Acci_Operacion, $acci_lugar_referencia)
	{

		$Acci_FechaGenerar 				= date("Y-m-d H:i:s");
		$Acci_UsuarioId_Generar 		= $_SESSION['USUARIO_ID'];
		$acci_usuario_nombres			= $_SESSION['Usua_NombreCorto'];
		$Acci_EstadoInformePreliminar 	= "ABIERTO";
		$acci_log_ip 					= $Acci_FechaGenerar."  ".$Acci_EstadoInformePreliminar." ".$acci_usuario_nombres." CREAR: REGISTRO DE IP";

		$consulta="INSERT INTO `OPE_AccidentesInformePreliminar`(`Accidentes_Id`, `Acci_ClaseAccidente`, `Acci_TipoAccidente`, `Acci_DanosMateriales`, `Acci_Lesiones`, `Acci_Fatalidad`, `Acci_Otro`, `Acci_OtroDescripcion`, `Acci_TipoEvento`, `Acci_Fecha`, `Acci_Hora`, `Acci_Dni`, `Acci_CodigoColaborador`, `Acci_NombreColaborador`, `Acci_Tabla`, `Acci_Servicio`, `Acci_Bus`, `Acci_Lugar`, `Acci_Sentido`, `Acci_CodigoCGO`, `Acci_NombreCGO`, `Acci_CodigoPersonalApoyo`, `Acci_NombrePersonalApoyo`, `Acci_km_perdidos`, `Acci_Conciliacion`, `Acci_MontoConciliado`, `Acci_Hospital`, `Acci_ReconoceResponsabilidad`, `Acci_Comisaria`, `Acci_DocReporte`, `Acci_DocConciliacion`, `Acci_DocPartePolicial`, `Acci_DocOficioPeritaje`, `Acci_DocReporteAtencion`, `Acci_DocDenunciaPolicial`, `Acci_DocCitacionManifestacion`, `Acci_DocOtro`, `Acci_DocOtroDescripcion`, `Acci_HoraFinAtencion`, `Acci_HorasTrabajadas`, `Acci_Descripcion`, `Acci_CodigoSuscribeInformacion`, `Acci_NombreSuscribeInformacion`, `Acci_FechaElaboracionInforme`, `Acci_Objeto`, `Acci_HoraLlegadaProcurador`, `Acci_CodigoCGM`, `Acci_NombreCGM`, `Acci_CodigoPersonalApoyoManto`, `Acci_NombrePersonalApoyoManto`, `Acci_NumeroOT`, `Acci_EstadoInformePreliminar`, `Acci_UsuarioId_Generar`, `Acci_FechaGenerar`, `Acci_Operacion`, `acci_log_ip`, `acci_lugar_referencia`) VALUES ('$Accidentes_Id', '$Acci_ClaseAccidente', '$Acci_TipoAccidente', '$Acci_DanosMateriales', '$Acci_Lesiones', '$Acci_Fatalidad', '$Acci_Otro', '$Acci_OtroDescripcion', '$Acci_TipoEvento', '$Acci_Fecha', '$Acci_Hora', '$Acci_Dni', '$Acci_CodigoColaborador', '$Acci_NombreColaborador', '$Acci_Tabla', '$Acci_Servicio', '$Acci_Bus', '$Acci_Lugar', '$Acci_Sentido', '$Acci_CodigoCGO', '$Acci_NombreCGO', '$Acci_CodigoPersonalApoyo', '$Acci_NombrePersonalApoyo', '$Acci_km_perdidos', '$Acci_Conciliacion', '$Acci_MontoConciliado', '$Acci_Hospital', '$Acci_ReconoceResponsabilidad', '$Acci_Comisaria', '$Acci_DocReporte', '$Acci_DocConciliacion', '$Acci_DocPartePolicial', '$Acci_DocOficioPeritaje', '$Acci_DocReporteAtencion', '$Acci_DocDenunciaPolicial', '$Acci_DocCitacionManifestacion', '$Acci_DocOtro', '$Acci_DocOtroDescripcion', IF('$Acci_HoraFinAtencion'='',null,'$Acci_HoraFinAtencion'), '$Acci_HorasTrabajadas', '$Acci_Descripcion', '$Acci_CodigoSuscribeInformacion', '$Acci_NombreSuscribeInformacion', '$Acci_FechaElaboracionInforme', '$Acci_Objeto', '$Acci_HoraLlegadaProcurador', '$Acci_CodigoCGM', '$Acci_NombreCGM', '$Acci_CodigoPersonalApoyoManto', '$Acci_NombrePersonalApoyoManto', '$Acci_NumeroOT', '$Acci_EstadoInformePreliminar', '$Acci_UsuarioId_Generar', '$Acci_FechaGenerar', '$Acci_Operacion', '$acci_log_ip', '$acci_lugar_referencia')";

		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   

		$consulta="SELECT *,DATE_FORMAT(`Acci_FechaElaboracionInforme`,'%d-%m-%Y %H:%i') AS `f_Acci_FechaElaboracionInforme`, DATE_FORMAT(`Acci_FechaCerrar`,'%d-%m-%Y %H:%i') AS `f_Acci_FechaCerrar`, (SELECT `colaborador`.`Colab_ApellidosNombres` FROM `colaborador` WHERE `colaborador`.`Colaborador_id` = `Acci_UsuarioId_Cerrar`) AS `n_Acci_UsuarioId_Cerrar`FROM `OPE_AccidentesInformePreliminar` WHERE `Accidentes_Id`='$Accidentes_Id'";
		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

  		$this->conexion=null;	
	}

	function EditarInformePreliminar($Accidentes_Id,$Acci_ClaseAccidente,$Acci_TipoAccidente,$Acci_DanosMateriales,$Acci_Lesiones,$Acci_Fatalidad,$Acci_Otro,$Acci_OtroDescripcion,$Acci_TipoEvento,$Acci_Fecha,$Acci_Hora,$Acci_Dni,$Acci_CodigoColaborador,$Acci_NombreColaborador,$Acci_Tabla,$Acci_Servicio,$Acci_Lugar,$Acci_Bus,$Acci_Sentido,$Acci_km_perdidos,$Acci_Conciliacion,$Acci_MontoConciliado,$Acci_CodigoCGO,$Acci_NombreCGO,$Acci_CodigoPersonalApoyo,$Acci_NombrePersonalApoyo,$Acci_ReconoceResponsabilidad,$Acci_Hospital,$Acci_Comisaria,$Acci_HoraFinAtencion,$Acci_HorasTrabajadas,$Acci_Objeto,$Acci_HoraLlegadaProcurador,$Acci_CodigoCGM,$Acci_NombreCGM,$Acci_CodigoPersonalApoyoManto,$Acci_NombrePersonalApoyoManto,$Acci_NumeroOT,$Acci_DocReporte,$Acci_DocConciliacion,$Acci_DocPartePolicial,$Acci_DocOficioPeritaje,$Acci_DocReporteAtencion,$Acci_DocDenunciaPolicial,$Acci_DocCitacionManifestacion,$Acci_DocOtro,$Acci_DocOtroDescripcion,$Acci_Descripcion,$Acci_CodigoSuscribeInformacion,$Acci_NombreSuscribeInformacion,$Acci_FechaElaboracionInforme, $acci_lugar_referencia)
	{

		$consulta	= "SELECT * FROM `OPE_AccidentesInformePreliminar` WHERE `Accidentes_Id`='$Accidentes_Id' ";
        $resultado 	= $this->conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach ($data as $row) {
			$acci_log_ip 					= $row['acci_log_ip'];
			$Acci_EstadoInformePreliminar 	= $row['Acci_EstadoInformePreliminar'];
		}

		$acci_usuario_nombres	= $_SESSION['Usua_NombreCorto'];
		$acci_log_ip 			= date('Y-m-d H:i:s')."  ".$Acci_EstadoInformePreliminar." ".$acci_usuario_nombres." EDITAR: IP <br>".$acci_log_ip;

		$consulta="UPDATE `OPE_AccidentesInformePreliminar` SET `Acci_TipoAccidente`='$Acci_TipoAccidente',`Acci_ClaseAccidente`='$Acci_ClaseAccidente',`Acci_DanosMateriales`='$Acci_DanosMateriales',`Acci_Lesiones`='$Acci_Lesiones',`Acci_Fatalidad`='$Acci_Fatalidad',`Acci_Otro`='$Acci_Otro',`Acci_OtroDescripcion`='$Acci_OtroDescripcion',`Acci_TipoEvento`='$Acci_TipoEvento',`Acci_Fecha`='$Acci_Fecha',`Acci_Hora`='$Acci_Hora',`Acci_Dni`='$Acci_Dni',`Acci_CodigoColaborador`='$Acci_CodigoColaborador',`Acci_NombreColaborador`='$Acci_NombreColaborador',`Acci_Tabla`='$Acci_Tabla',`Acci_Servicio`='$Acci_Servicio',`Acci_Bus`='$Acci_Bus',`Acci_Lugar`='$Acci_Lugar',`Acci_Sentido`='$Acci_Sentido',`Acci_CodigoCGO`='$Acci_CodigoCGO',`Acci_NombreCGO`='$Acci_NombreCGO',`Acci_CodigoPersonalApoyo`='$Acci_CodigoPersonalApoyo',`Acci_NombrePersonalApoyo`='$Acci_NombrePersonalApoyo',`Acci_km_perdidos`='$Acci_km_perdidos',`Acci_Conciliacion`='$Acci_Conciliacion',`Acci_MontoConciliado`='$Acci_MontoConciliado',`Acci_Hospital`='$Acci_Hospital',`Acci_ReconoceResponsabilidad`='$Acci_ReconoceResponsabilidad',`Acci_Comisaria`='$Acci_Comisaria',`Acci_DocReporte`='$Acci_DocReporte',`Acci_DocConciliacion`='$Acci_DocConciliacion',`Acci_DocPartePolicial`='$Acci_DocPartePolicial',`Acci_DocOficioPeritaje`='$Acci_DocOficioPeritaje',`Acci_DocReporteAtencion`='$Acci_DocReporteAtencion',`Acci_DocDenunciaPolicial`='$Acci_DocDenunciaPolicial',`Acci_DocCitacionManifestacion`='$Acci_DocCitacionManifestacion',`Acci_DocOtro`='$Acci_DocOtro',`Acci_DocOtroDescripcion`='$Acci_DocOtroDescripcion',`Acci_HoraFinAtencion`=IF('$Acci_HoraFinAtencion'='',null,'$Acci_HoraFinAtencion'),`Acci_HorasTrabajadas`='$Acci_HorasTrabajadas',`Acci_Descripcion`='$Acci_Descripcion',`Acci_CodigoSuscribeInformacion`='$Acci_CodigoSuscribeInformacion',`Acci_NombreSuscribeInformacion`='$Acci_NombreSuscribeInformacion',`Acci_FechaElaboracionInforme`='$Acci_FechaElaboracionInforme',`Acci_Objeto`='$Acci_Objeto',`Acci_HoraLlegadaProcurador`='$Acci_HoraLlegadaProcurador',`Acci_CodigoCGM`='$Acci_CodigoCGM',`Acci_NombreCGM`='$Acci_NombreCGM',`Acci_CodigoPersonalApoyoManto`='$Acci_CodigoPersonalApoyoManto',`Acci_NombrePersonalApoyoManto`='$Acci_NombrePersonalApoyoManto',`Acci_NumeroOT`='$Acci_NumeroOT', `acci_log_ip`='$acci_log_ip', `acci_lugar_referencia`='$acci_lugar_referencia' WHERE `Accidentes_Id`='$Accidentes_Id'";

		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();

		$consulta="SELECT *,DATE_FORMAT(`Acci_FechaElaboracionInforme`,'%Y-%m-%d %H:%i') AS `f_Acci_FechaElaboracionInforme`, DATE_FORMAT(`Acci_FechaCerrar`,'%Y-%m-%d %H:%i') AS `f_Acci_FechaCerrar`, (SELECT `colaborador`.`Colab_ApellidosNombres` FROM `colaborador` WHERE `colaborador`.`Colaborador_id` = `Acci_UsuarioId_Cerrar`) AS `n_Acci_UsuarioId_Cerrar`FROM `OPE_AccidentesInformePreliminar` WHERE `Accidentes_Id`='$Accidentes_Id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

  		$this->conexion=null;
	}

	function BuscarInvestigacion($fecha_inicio, $fecha_termino)
	{
		$consulta = " SELECT 
						`OPE_AccidentesInformePreliminar`.`Accidentes_Id`, 
						`OPE_AccidentesInformePreliminar`.`Acci_EstadoInformePreliminar`, 
						UPPER(DATE_FORMAT(`OPE_AccidentesInformePreliminar`.`Acci_Fecha`,'%Y-%m-%d %W')) AS `Acci_Fecha`, 
						TIME_FORMAT(`OPE_AccidentesInformePreliminar`.`Acci_Hora`,'%H:%i') AS `Acci_Hora`, 
						`OPE_AccidentesInformePreliminar`.`Acci_NombreCGO`, 
						`OPE_AccidentesInformePreliminar`.`Acci_NombreColaborador`, 
						DATE_FORMAT(`colaborador`.`Colab_FechaIngreso`,'%Y-%m-%d') AS `Colab_FechaIngreso`, 
						`OPE_AccidentesInformePreliminar`.`Acci_Tabla`, 
						`OPE_AccidentesInformePreliminar`.`Acci_Servicio`, 
						`OPE_AccidentesInformePreliminar`.`Acci_Bus`, 
						`Buses`.`Bus_NroPlaca`, 
						IF (`Buses`.`Bus_Operacion`='TRONCAL','ARTICULADO',`Bus_Operacion`) AS `Acci_TipoBus`, 
						`OPE_AccidentesInformePreliminar`.`Acci_Lugar`, 
						`OPE_AccidentesInformePreliminar`.`Acci_Sentido`, 
						`OPE_AccidentesInformePreliminar`.`Acci_TipoAccidente`, 
						`OPE_AccidentesInformePreliminar`.`Acci_ClaseAccidente`, 
						`OPE_AccidentesInformePreliminar`.`Acci_TipoEvento`, 
						`OPE_AccidentesInformePreliminar`.`Acci_ReconoceResponsabilidad`, 
						`OPE_AccidentesInvestigacion`.`Acci_EstadoInvestigacion`, 
						(SELECT COUNT(*) AS `acci_cantidad_lesionados` FROM `OPE_AccidentesNaturaleza` WHERE `OPE_AccidentesNaturaleza`.`Acci_Tipo`='DañosPersonales' AND `OPE_AccidentesNaturaleza`.`Accidentes_Id`=`OPE_AccidentesInformePreliminar`.`Accidentes_Id`) AS `acci_cantidad_lesionados`,
						(SELECT `OPE_AccidentesImagen`.`Acci_TipoImagen` FROM `OPE_AccidentesImagen` WHERE `OPE_AccidentesImagen`.`Accidentes_Id`=`OPE_AccidentesInformePreliminar`.`Accidentes_Id` AND `OPE_AccidentesImagen`.`Acci_TipoImagen`='PDF') AS `acci_doc_adj`
					FROM `OPE_AccidentesInformePreliminar` 
					LEFT JOIN `colaborador` ON `colaborador`.`Colaborador_id`=`OPE_AccidentesInformePreliminar`.`Acci_Dni`
					LEFT JOIN `Buses` ON `OPE_AccidentesInformePreliminar`.`Acci_Bus`=`Buses`.`Bus_NroExterno` 
					LEFT JOIN `OPE_AccidentesInvestigacion` ON `OPE_AccidentesInvestigacion`.`Accidentes_Id`=`OPE_AccidentesInformePreliminar`.`Accidentes_Id` 
					WHERE `Acci_Fecha`>='$fecha_inicio' AND `Acci_Fecha`<='$fecha_termino' AND 
						(SELECT `OPE_AccidentesImagen`.`Acci_TipoImagen` FROM `OPE_AccidentesImagen` WHERE `OPE_AccidentesImagen`.`Accidentes_Id`= `OPE_AccidentesInformePreliminar`.`Accidentes_Id` AND `OPE_AccidentesImagen`.`Acci_TipoImagen`='IP_PDF')!='' ";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		$this->conexion=null;
	}   

	function CargarInvestigacion($Accidentes_Id)
    {
		$consulta = "SELECT * FROM `OPE_AccidentesInvestigacion` LEFT JOIN `OPE_AccidentesInformePreliminar` ON `OPE_AccidentesInformePreliminar`.`Accidentes_Id`=`OPE_AccidentesInvestigacion`.`Accidentes_Id` WHERE `OPE_AccidentesInvestigacion`.`Accidentes_Id`='$Accidentes_Id'";
		
		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   
  		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

  		$this->conexion=null;	
    }

	function TablaVacia($NombreTabla)
	{
		$consulta="SELECT COUNT(*) AS `Contar` FROM `$NombreTabla` ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function CrearInvestigacion($Accidentes_Id, $Acci_DatosRegistro, $Acci_Trafico, $Acci_LugarReferencia, $Acci_FactorDeterminante, $Acci_ResponsabilidadDeterminante, $Acci_FactorContributivo, $Acci_ResponsabilidadContributivo, $Acci_TipoExpediente, $Acci_EventoReportado, $Acci_Frecuencia, $Acci_Probabilidad,$Acci_Severidad, $Acci_GravedadEvento, $Acci_ResponsabilidadAccidente, $Acci_GradoFalta, $Acci_Reincidencia, $Acci_CodigoRIT, $Acci_DescripcionRIT, $Acci_AccionDisciplinaria,$Acci_ReporteGDH, $Acci_FechaReporteGDH, $Acci_Premio, $Acci_FechaCierreAccidente, $Acci_TiempoInvestigacion, $Acci_CumplimientoMeta, $Acci_DelayRegistro,$Acci_CumplimientoRegistro, $Acci_FechaRegistro, $Acci_FechaCierreReporte, $acci_nro_siniestro)
	{
		$Acci_EstadoInvestigacion	= "CERRADO";
		$Acci_UsuarioId_Cierre		= $_SESSION['USUARIO_ID'];
		$Acci_Fecha_Cierre			= date("Y-m-d H:i:s");
		$acci_usuario_nombres		= $_SESSION['Usua_NombreCorto'];
		$acci_log_investigacion		= $Acci_Fecha_Cierre."  ".$Acci_EstadoInvestigacion." ".$acci_usuario_nombres." CREAR: REGISTRO DE INFORME FINAL";

		$consulta = "INSERT INTO `OPE_AccidentesInvestigacion`(`Accidentes_Id`, `Acci_DatosRegistro`, `Acci_Trafico`, `Acci_LugarReferencia`, `Acci_FactorDeterminante`, `Acci_ResponsabilidadDeterminante`, `Acci_FactorContributivo`, `Acci_ResponsabilidadContributivo`, `Acci_TipoExpediente`, `Acci_EventoReportado`, `Acci_Frecuencia`, `Acci_Probabilidad`, `Acci_Severidad`, `Acci_GravedadEvento`, `Acci_ResponsabilidadAccidente`, `Acci_GradoFalta`, `Acci_Reincidencia`, `Acci_CodigoRIT`, `Acci_DescripcionRIT`, `Acci_AccionDisciplinaria`, `Acci_ReporteGDH`, `Acci_FechaReporteGDH`, `Acci_Premio`, `Acci_FechaCierreAccidente`, `Acci_TiempoInvestigacion`, `Acci_CumplimientoMeta`, `Acci_DelayRegistro`, `Acci_CumplimientoRegistro`, `Acci_FechaRegistro`, `Acci_EstadoInvestigacion`, `Acci_FechaCierreReporte`, `Acci_LogInvestigacion`, `Acci_UsuarioId_Cierre`, `Acci_Fecha_Cierre`, `acci_nro_siniestro`) VALUES ('$Accidentes_Id', '$Acci_DatosRegistro', '$Acci_Trafico', '$Acci_LugarReferencia', '$Acci_FactorDeterminante', '$Acci_ResponsabilidadDeterminante', '$Acci_FactorContributivo', '$Acci_ResponsabilidadContributivo', '$Acci_TipoExpediente', '$Acci_EventoReportado', '$Acci_Frecuencia', '$Acci_Probabilidad', '$Acci_Severidad', '$Acci_GravedadEvento', '$Acci_ResponsabilidadAccidente', '$Acci_GradoFalta', '$Acci_Reincidencia', '$Acci_CodigoRIT', '$Acci_DescripcionRIT', '$Acci_AccionDisciplinaria', '$Acci_ReporteGDH', '$Acci_FechaReporteGDH', '$Acci_Premio', '$Acci_FechaCierreAccidente', '$Acci_TiempoInvestigacion', '$Acci_CumplimientoMeta', '$Acci_DelayRegistro', '$Acci_CumplimientoRegistro', '$Acci_FechaRegistro', '$Acci_EstadoInvestigacion', '$Acci_FechaCierreReporte', '$acci_log_investigacion', '$Acci_UsuarioId_Cierre', '$Acci_Fecha_Cierre', '$acci_nro_siniestro')";

		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   

  		$this->conexion=null;	
	}

	function EditarInvestigacion($Accidentes_Id, $Acci_DatosRegistro, $Acci_Trafico, $Acci_LugarReferencia, $Acci_FactorDeterminante, $Acci_ResponsabilidadDeterminante, $Acci_FactorContributivo, $Acci_ResponsabilidadContributivo, $Acci_TipoExpediente, $Acci_EventoReportado, $Acci_Frecuencia, $Acci_Probabilidad,$Acci_Severidad, $Acci_GravedadEvento, $Acci_ResponsabilidadAccidente, $Acci_GradoFalta, $Acci_Reincidencia, $Acci_CodigoRIT, $Acci_DescripcionRIT, $Acci_AccionDisciplinaria,$Acci_ReporteGDH, $Acci_FechaReporteGDH, $Acci_Premio, $Acci_FechaCierreAccidente, $Acci_TiempoInvestigacion, $Acci_CumplimientoMeta, $Acci_DelayRegistro,$Acci_CumplimientoRegistro, $Acci_FechaRegistro, $Acci_FechaCierreReporte, $acci_nro_siniestro)
	{
		$Acci_EstadoInvestigacion = "CERRADO";
		$Acci_UsuarioId_Cierre		= $_SESSION['USUARIO_ID'];
		$Acci_Fecha_Cierre			= date("Y-m-d H:i:s");

		$consulta	= "SELECT * FROM `OPE_AccidentesInvestigacion` WHERE `Accidentes_Id`='$Accidentes_Id' ";
        $resultado 	= $this->conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach ($data as $row) {
			$acci_log_investigacion	= $row['Acci_LogInvestigacion'];
		}

		$acci_usuario_nombres	= $_SESSION['Usua_NombreCorto'];
		$acci_log_investigacion	= $Acci_Fecha_Cierre."  ".$Acci_EstadoInvestigacion." ".$acci_usuario_nombres." CERRAR: INFORME FINAL <br>".$acci_log_investigacion;
		
		$consulta = "UPDATE `OPE_AccidentesInvestigacion` SET `Accidentes_Id`='$Accidentes_Id', `Acci_DatosRegistro`='$Acci_DatosRegistro', `Acci_Trafico`='$Acci_Trafico', `Acci_LugarReferencia`='$Acci_LugarReferencia', `Acci_FactorDeterminante`='$Acci_FactorDeterminante', `Acci_ResponsabilidadDeterminante`='$Acci_ResponsabilidadDeterminante', `Acci_FactorContributivo`='$Acci_FactorContributivo', `Acci_ResponsabilidadContributivo`='$Acci_ResponsabilidadContributivo', `Acci_TipoExpediente`='$Acci_TipoExpediente', `Acci_EventoReportado`='$Acci_EventoReportado', `Acci_Frecuencia`='$Acci_Frecuencia', `Acci_Probabilidad`='$Acci_Probabilidad', `Acci_Severidad`='$Acci_Severidad', `Acci_GravedadEvento`='$Acci_GravedadEvento', `Acci_ResponsabilidadAccidente`='$Acci_ResponsabilidadAccidente', `Acci_GradoFalta`='$Acci_GradoFalta', `Acci_Reincidencia`='$Acci_Reincidencia', `Acci_CodigoRIT`='$Acci_CodigoRIT', `Acci_DescripcionRIT`='$Acci_DescripcionRIT', `Acci_AccionDisciplinaria`='$Acci_AccionDisciplinaria', `Acci_ReporteGDH`='$Acci_ReporteGDH', `Acci_FechaReporteGDH`='$Acci_FechaReporteGDH', `Acci_Premio`='$Acci_Premio', `Acci_FechaCierreAccidente`='$Acci_FechaCierreAccidente', `Acci_TiempoInvestigacion`='$Acci_TiempoInvestigacion', `Acci_CumplimientoMeta`='$Acci_CumplimientoMeta', `Acci_DelayRegistro`='$Acci_DelayRegistro', `Acci_CumplimientoRegistro`='$Acci_CumplimientoRegistro', `Acci_FechaRegistro`='$Acci_FechaRegistro', `Acci_EstadoInvestigacion`='$Acci_EstadoInvestigacion', `Acci_FechaCierreReporte`='$Acci_FechaCierreReporte', `Acci_LogInvestigacion`='$acci_log_investigacion', `Acci_UsuarioId_Cierre`='$Acci_UsuarioId_Cierre', `Acci_Fecha_Cierre`='$Acci_Fecha_Cierre', `acci_nro_siniestro`='$acci_nro_siniestro' WHERE `Accidentes_Id`='$Accidentes_Id'";

		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   

  		$this->conexion=null;	
	}

	function abrir_informe_final($Accidentes_Id)
	{
		$Acci_EstadoInvestigacion 	= "ABIERTO";

		$consulta	= "SELECT * FROM `OPE_AccidentesInvestigacion` WHERE `Accidentes_Id`='$Accidentes_Id' ";
        $resultado 	= $this->conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach ($data as $row) {
			$acci_log_investigacion	= $row['Acci_LogInvestigacion'];
		}

		$acci_usuario_nombres	= $_SESSION['Usua_NombreCorto'];
		$acci_log_investigacion	= date('Y-m-d H:i:s')."  ".$Acci_EstadoInvestigacion." ".$acci_usuario_nombres." EDITAR: INFORME FINAL <br>".$acci_log_investigacion;

 
		$consulta = "UPDATE `OPE_AccidentesInvestigacion` SET `Acci_EstadoInvestigacion`='$Acci_EstadoInvestigacion', `Acci_LogInvestigacion`='$acci_log_investigacion', `Acci_UsuarioId_Cierre`=null, `Acci_Fecha_Cierre`=null WHERE `Accidentes_Id`='$Accidentes_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$this->conexion=null;	
	}  		

	function BuscarReportegdh($fecha_inicio, $fecha_termino)
	{
		$acci_tipo = 'CausasAccidentes';
		$consulta = " 	SELECT	`OPE_AccidentesInformePreliminar`.`Accidentes_Id`, 
								`OPE_AccidentesInformePreliminar`.`Acci_Fecha`, 
								`OPE_AccidentesInformePreliminar`.`Acci_Hora`, 
								`OPE_AccidentesInformePreliminar`.`Acci_NombreCGO`, 
								`OPE_AccidentesInformePreliminar`.`Acci_Dni`, 
								`OPE_AccidentesInformePreliminar`.`Acci_CodigoColaborador`, 
								`OPE_AccidentesInformePreliminar`.`Acci_NombreColaborador`,
								`colaborador`.`Colab_FechaIngreso` AS `Acci_FechaIngreso`,
								CONCAT(TIMESTAMPDIFF ( YEAR, `colaborador`.`Colab_FechaIngreso`, CURRENT_DATE ),' AÑOS') AS `Acci_Antiguedad`,
								`OPE_AccidentesInformePreliminar`.`Acci_Tabla`, 
								`OPE_AccidentesInformePreliminar`.`Acci_Bus`, 
								`Buses`.`Bus_NroPlaca` AS `Acci_NroPlaca`,
								`OPE_AccidentesInformePreliminar`.`Acci_Servicio`, 
								`OPE_AccidentesInformePreliminar`.`Acci_Lugar`, 
								`OPE_AccidentesInformePreliminar`.`Acci_Sentido`, 
								`OPE_AccidentesInformePreliminar`.`Acci_TipoAccidente`, 
								`OPE_AccidentesInformePreliminar`.`Acci_TipoEvento`, 
								`OPE_AccidentesInformePreliminar`.`Acci_Descripcion` AS `ocurrencia`, 
								`OPE_AccidentesInformePreliminar`.`Acci_ReconoceResponsabilidad`,
								(SELECT GROUP_CONCAT(' ',`Acci_DescripcionReparacion`) FROM `OPE_AccidentesReparacion` WHERE `OPE_AccidentesReparacion`.`Accidentes_Id`=`OPE_Accidentes`.`Accidentes_Id` ) AS `Acci_DanosMateriales`, 
								`OPE_AccidentesInformePreliminar`.`Acci_Conciliacion`, 
	 							'SOLES' AS `Acci_Moneda`, 
								`OPE_AccidentesInformePreliminar`.`Acci_MontoConciliado`, 
								`OPE_AccidentesInformePreliminar`.`Acci_DocDenunciaPolicial`, 
								`OPE_AccidentesInformePreliminar`.`Acci_NombrePersonalApoyo`, 
								`OPE_AccidentesInvestigacion`.`Acci_FactorDeterminante`, 
								`OPE_AccidentesInvestigacion`.`Acci_FactorContributivo`,
								`OPE_AccidentesInvestigacion`.`Acci_ResponsabilidadDeterminante`, 
								`OPE_AccidentesInvestigacion`.`Acci_GravedadEvento`, 
								`ope_accidentes_costo`.`acos_monto_cotizado` AS `Acci_CostoTotalReparacion`, 
								`OPE_AccidentesInvestigacion`.`Acci_ResponsabilidadAccidente`, 
								`OPE_AccidentesInvestigacion`.`Acci_FechaReporteGDH`, 
								(SELECT GROUP_CONCAT(' ',`Acci_Descripcion`) FROM `OPE_AccidentesNaturaleza` WHERE `OPE_AccidentesNaturaleza`.`Accidentes_Id`=`OPE_Accidentes`.`Accidentes_Id` AND `OPE_AccidentesNaturaleza`.`Acci_Tipo`='$acci_tipo') AS `causas_accidentes`,
								`OPE_AccidentesInvestigacion`.`Acci_FactorDeterminante`, 
								`OPE_AccidentesInvestigacion`.`Acci_ResponsabilidadDeterminante`, 
								`OPE_AccidentesInvestigacion`.`Acci_FactorContributivo`, 
								`OPE_AccidentesInvestigacion`.`Acci_ResponsabilidadContributivo`, 
								`OPE_AccidentesInvestigacion`.`Acci_CodigoRIT`, 
								IF(`OPE_AccidentesInvestigacion`.`Acci_DescripcionRIT`!='',`OPE_AccidentesInvestigacion`.`Acci_DescripcionRIT`,`OPE_AccidentesInvestigacion`.`Acci_DescripcionRIT`) AS `Acci_DescripcionRIT`, 
								IF(`OPE_AccidentesInvestigacion`.`Acci_Premio`='SI','NO','SI') AS `afecta_bono`, 
								`OPE_AccidentesInvestigacion`.`Acci_AccionDisciplinaria`, 
								(SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_Id`=`OPE_AccidentesInvestigacion`.`Acci_UsuarioId_Cierre`) AS `usuario_gestiona`, 
								IF(`OPE_AccidentesInvestigacion`.`Acci_TiempoInvestigacion`='0','< 1 d',`OPE_AccidentesInvestigacion`.`Acci_TiempoInvestigacion`) AS `dias_investigacion`, 
								`OPE_AccidentesInvestigacion`.`Acci_FechaRegistro`, 
								(SELECT COUNT(*) AS `acci_cantidad_lesionados` FROM	`OPE_AccidentesNaturaleza` WHERE `OPE_AccidentesNaturaleza`.`Acci_Tipo`='DañosPersonales' AND `OPE_AccidentesNaturaleza`.`Accidentes_Id`=`OPE_Accidentes`.`Accidentes_Id`) AS `acci_cantidad_lesionados` 
						FROM	`OPE_Accidentes` 
						LEFT JOIN `OPE_AccidentesInformePreliminar` 
						ON 		`OPE_AccidentesInformePreliminar`.`Accidentes_Id` = `OPE_Accidentes`.`Accidentes_Id` 
						LEFT JOIN `OPE_AccidentesInvestigacion` 
						ON 		`OPE_AccidentesInvestigacion`.`Accidentes_Id` = `OPE_Accidentes`.`Accidentes_Id` 
						LEFT JOIN `colaborador` 
						ON 		`OPE_AccidentesInformePreliminar`.`Acci_Dni`=`colaborador`.`Colaborador_id`
						LEFT JOIN `Buses`
						ON		`OPE_AccidentesInformePreliminar`.`Acci_Bus`=`Buses`.`Bus_NroExterno`
						LEFT JOIN `ope_accidentes_costo` 
						ON 		`ope_accidentes_costo`.`acos_accidentes_id` = `OPE_Accidentes`.`Accidentes_Id` 
						WHERE	`OPE_Accidentes`.`Acci_FechaOperacion`>='$fecha_inicio' AND 
								`OPE_Accidentes`.`Acci_FechaOperacion`<='$fecha_termino' 
						ORDER BY `OPE_Accidentes`.`Accidentes_Id` DESC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
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

	function CantidadAccidentes($Acci_Dni,$Fecha_Inicio,$Fecha_Termino)
	{
		$consulta = "SELECT COUNT(*) AS `CantidadAccidentes` FROM `OPE_AccidentesInformePreliminar` WHERE `Acci_Dni`='$Acci_Dni' AND `Acci_Fecha`>='$Fecha_Inicio' AND `Acci_Fecha`<'$Fecha_Termino'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;

	}

	function DescripcionRIT($Acci_CodigoRIT,$Acci_GradoFalta)
	{
		$consulta = "SELECT * FROM `ope_accidentesmatriz` WHERE `acmt_campo`='$Acci_GradoFalta' AND `acmt_busqueda`='$Acci_CodigoRIT'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;

	}

	function AccionDisciplinaria($Acci_CodigoRIT,$Acci_Reincidencia)
	{
		$consulta = "SELECT * FROM `ope_accidentesmatriz` WHERE `acmt_campo`='$Acci_CodigoRIT' AND `acmt_busqueda`='$Acci_Reincidencia'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;

	}

	function PDFInformePreliminar($Accidentes_Id)
	{
		$consulta = "SELECT *, (SELECT `Bus_NroPlaca`FROM `Buses` WHERE `Bus_NroExterno` = `Acci_Bus`) AS `Bus_NroPlaca`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `Colaborador_id` = `Acci_UsuarioId_Edicion`) AS `CGOSuscribe`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `Colaborador_id` = (SELECT `OPE_AccidentesInvestigacion`.`Acci_UsuarioId_Cierre` FROM `OPE_AccidentesInvestigacion` WHERE `OPE_AccidentesInvestigacion`.`Accidentes_Id` = `OPE_AccidentesInformePreliminar`.`Accidentes_Id`)) AS `CGORevisado`, (SELECT `OPE_AccidentesInvestigacion`.`Acci_Fecha_Cierre`  FROM `OPE_AccidentesInvestigacion` WHERE `OPE_AccidentesInvestigacion`.`Accidentes_Id` = `OPE_AccidentesInformePreliminar`.`Accidentes_Id`) AS `fecha_revisado` FROM `OPE_AccidentesInformePreliminar` WHERE `OPE_AccidentesInformePreliminar`.`Accidentes_Id`='$Accidentes_Id'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;

	}

	function horas_trabajadas($operacion, $fecha, $dni, $hora)
	{
		$consulta = "SELECT
						`OPE_ControlFacilitador`.`Prog_Operacion`,
						`OPE_ControlFacilitador`.`Prog_Fecha`, 
						`OPE_ControlFacilitador`.`Prog_Dni`,
						ADDTIME(TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(SUBTIME( `OPE_ControlFacilitador`.`Prog_HoraDestino`,`OPE_ControlFacilitador`.`Prog_HoraOrigen`)))),'%H:%i'),TIME_FORMAT(SEC_TO_TIME(TIME_TO_SEC(SUBTIME('$hora',MAX(`OPE_ControlFacilitador`.`Prog_HoraDestino`)))),'%H:%i')) AS `horas_trabajadas`
					FROM 
						`OPE_ControlFacilitador` 
					WHERE
						`OPE_ControlFacilitador`.`Prog_Operacion`='$operacion' AND
						`OPE_ControlFacilitador`.`Prog_Fecha`='$fecha' AND
						`OPE_ControlFacilitador`.`Prog_HoraDestino`<='$hora'
					GROUP BY 
						`OPE_ControlFacilitador`.`Prog_Dni`
					HAVING
						`OPE_ControlFacilitador`.`Prog_Dni`='$dni' ";
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function horas_trabajadas_hist($operacion, $fecha, $dni, $hora)
	{
		$consulta = "SELECT
						`OPE_ControlFacilitador`.`Prog_Operacion`,
						`OPE_ControlFacilitador`.`Prog_Fecha`, 
						`OPE_ControlFacilitador`.`Prog_Dni`,
						ADDTIME(TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(SUBTIME( `OPE_ControlFacilitador`.`Prog_HoraDestino`,`OPE_ControlFacilitador`.`Prog_HoraOrigen`)))),'%H:%i'),TIME_FORMAT(SEC_TO_TIME(TIME_TO_SEC(SUBTIME('$hora',MAX(`OPE_ControlFacilitador`.`Prog_HoraDestino`)))),'%H:%i')) AS `horas_trabajadas`
					FROM 
						`OPE_ControlFacilitador` 
					WHERE
						`OPE_ControlFacilitador`.`Prog_Operacion`='$operacion' AND
						`OPE_ControlFacilitador`.`Prog_Fecha`='$fecha' AND
						`OPE_ControlFacilitador`.`Prog_HoraDestino`<='$hora'
					GROUP BY 
						`OPE_ControlFacilitador`.`Prog_Dni`
					HAVING
						`OPE_ControlFacilitador`.`Prog_Dni`='$dni' ";
		$resultado 	= $this->conexion2->prepare($consulta);
		$resultado->execute();        
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion2=null;
	}

	function km_perdidos($Accidentes_Id, $operacion, $bus, $fecha_operacion)
	{
		$prog_tipo_evento = 'VIAJE PERDIDO';

		$consulta 	= "	SELECT
							ROUND(SUM(`OPE_ControlFacilitador`.`Prog_KmXPuntos`),2) AS `km_perdidos`
						FROM
							`OPE_ControlFacilitador`
						LEFT JOIN
								(SELECT
									DISTINCT `CNove_ControlFacilitadorId`
								FROM
									`OPE_ControlCambiosNovedad`
								WHERE
									`OPE_ControlCambiosNovedad`.`CNove_NovedadId` = '$Accidentes_Id') AS `t_novedad`
						ON
							`OPE_ControlFacilitador`.`ControlFacilitador_Id` = `t_novedad`.`CNove_ControlFacilitadorId`
						WHERE
							`OPE_ControlFacilitador`.`Prog_Operacion` = '$operacion' AND
							`OPE_ControlFacilitador`.`Prog_Bus` = '$bus' AND
							`OPE_ControlFacilitador`.`Prog_TipoEvento` = '$prog_tipo_evento' AND
							`OPE_ControlFacilitador`.`Prog_Fecha` = '$fecha_operacion'";

		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function km_perdidos_hist($Accidentes_Id, $operacion, $bus, $fecha_operacion)
	{
		$prog_tipo_evento = 'VIAJE PERDIDO';

		$consulta 	= "	SELECT
							ROUND(SUM(`OPE_ControlFacilitador`.`Prog_KmXPuntos`),2) AS `km_perdidos`
						FROM
							`bdlimabus_hist`.`OPE_ControlFacilitador`
						LEFT JOIN
								(SELECT
									DISTINCT `CNove_ControlFacilitadorId`
								FROM
									`BDLIMABUS`.`OPE_ControlCambiosNovedad`
								WHERE
									`OPE_ControlCambiosNovedad`.`CNove_NovedadId` = '$Accidentes_Id') AS `t_novedad`
						ON
							`OPE_ControlFacilitador`.`ControlFacilitador_Id` = `t_novedad`.`CNove_ControlFacilitadorId`
						WHERE
							`OPE_ControlFacilitador`.`Prog_Operacion` = '$operacion' AND
							`OPE_ControlFacilitador`.`Prog_Bus` = '$bus' AND
							`OPE_ControlFacilitador`.`Prog_TipoEvento` = '$prog_tipo_evento' AND
							`OPE_ControlFacilitador`.`Prog_Fecha` = '$fecha_operacion'";

		$resultado 	= $this->conexion2->prepare($consulta);
		$resultado->execute();        
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion2=null;
	}

	function cerrar_pdf_informe_preliminar($Accidentes_Id)
	{
		$consulta= "SELECT * FROM `OPE_AccidentesInformePreliminar` WHERE `Accidentes_Id`='$Accidentes_Id' ";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach ($data as $row) {
			$acci_log_ip 	= $row['acci_log_ip'];
		}

		$Acci_FechaCerrar 		= date("Y-m-d H:i:s");
		$Acci_UsuarioId_Cerrar 	= $_SESSION['USUARIO_ID'];
		$acci_usuario_nombres	= $_SESSION['Usua_NombreCorto'];
		$Acci_Estado 			= "CERRADO";
 		$acci_log_ip 			= $Acci_FechaCerrar."  ".$Acci_Estado." ".$acci_usuario_nombres." GENERAR PDF: IP <br>".$acci_log_ip;

		$consulta = "UPDATE `OPE_AccidentesInformePreliminar` SET `Acci_EstadoInformePreliminar`='$Acci_Estado', `Acci_FechaCerrar`='$Acci_FechaCerrar', `Acci_UsuarioId_Cerrar`='$Acci_UsuarioId_Cerrar', `Acci_FechaEdicion`='$Acci_FechaCerrar', `Acci_UsuarioId_Edicion`='$Acci_UsuarioId_Cerrar', `acci_log_ip`='$acci_log_ip'  WHERE `Accidentes_Id`='$Accidentes_Id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$consulta= "SELECT *,DATE_FORMAT(`Acci_FechaElaboracionInforme`,'%d-%m-%Y %H:%i') AS `f_Acci_FechaElaboracionInforme`, DATE_FORMAT(`Acci_FechaCerrar`,'%d-%m-%Y %H:%i') AS `f_Acci_FechaCerrar`, (SELECT `colaborador`.`Colab_ApellidosNombres` FROM `colaborador` WHERE `colaborador`.`Colaborador_id` = `Acci_UsuarioId_Cerrar`) AS `n_Acci_UsuarioId_Cerrar` FROM `OPE_AccidentesInformePreliminar` WHERE `Accidentes_Id`='$Accidentes_Id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a <AJAX></AJAX>

		$this->conexion=null;	
	}  		

	function buscar_pdf($tabla, $campo_archivo, $campo_buscar, $dato_buscar, $campo_tipo_archivo, $dato_tipo_archivo)
	{
		$consulta  ="SELECT TO_BASE64 (`$campo_archivo`) AS `b64_file` FROM `$tabla` WHERE `$campo_buscar`='$dato_buscar' AND `$campo_tipo_archivo`='$dato_tipo_archivo'";
		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   
  		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
  		
		return $data;
  		$this->conexion=null;	
	}

	function control_facilitador_id_hist($Programacion_Id)
	{
		$consulta= "SELECT * FROM `OPE_ControlFacilitador` WHERE `Programacion_Id`='$Programacion_Id' ";
        $resultado = $this->conexion2->prepare($consulta);
        $resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion2=null;
	}

	function control_facilitador_id($Programacion_Id)
	{
		$consulta= "SELECT * FROM `OPE_ControlFacilitador` WHERE `Programacion_Id`='$Programacion_Id' ";
        $resultado = $this->conexion ->prepare($consulta);
        $resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function LeerTipoTablaAccidentes()
	{
        $consulta="SELECT * FROM `OPE_TipoTablaAccidentes`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);
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
        print json_encode($data, JSON_UNESCAPED_UNICODE);
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
        print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;	
	}  		
	
	function BorrarTipoTablaAccidentes($TtablaAccidentes_Id)
	{
		$consulta = "DELETE FROM `OPE_TipoTablaAccidentes` WHERE `TtablaAccidentes_Id`='$TtablaAccidentes_Id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}

	function carga_tabla_ver_lesionados($Accidentes_Id,$Acci_Tipo)
	{
		$consulta="SELECT * FROM `OPE_AccidentesNaturaleza` WHERE `Accidentes_Id` = '$Accidentes_Id' AND `Acci_Tipo` = '$Acci_Tipo' ORDER BY `OPE_AcciNaturalezaId` DESC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		$this->conexion=null;
	}

}