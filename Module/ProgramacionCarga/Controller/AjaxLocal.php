<?php

// Accion declarada en el JS
$Accion=$_POST['Accion'];   
$Modulo = "ProgramacionCarga";

switch ($Accion)
   {
   case 'CreacionTabs':
      $NombreTabs=$_POST['NombreTabs'];
      $TipoTabs=$_POST['TipoTabs'];

      MController($Modulo,'Accesos');
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->CreacionTabs($NombreTabs,$TipoTabs);
   break;

   case 'CreacionTabla':
      $NombreTabla=$_POST['NombreTabla'];
      $TipoTabla=$_POST['TipoTabla'];

      MController($Modulo,'Accesos');
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->CreacionTabla($NombreTabla,$TipoTabla);
   break;

   case 'ColumnasTabla':
      $NombreTabla=$_POST['NombreTabla'];
      $TipoTabla=$_POST['TipoTabla'];

      MController($Modulo,'Accesos');
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->ColumnasTabla($NombreTabla,$TipoTabla);
   break;

   case 'BotonesFormulario':
      $NombreFormulario=$_POST['NombreFormulario'];
      $NombreObjeto=$_POST['NombreObjeto'];

      MController($Modulo,'Accesos');
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->BotonesFormulario($NombreFormulario,$NombreObjeto);
   break;

   case 'DivFormulario':
      $NombreFormulario=$_POST['NombreFormulario'];
      $NombreObjeto=$_POST['NombreObjeto'];

      MController($Modulo,'Accesos');
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->DivFormulario($NombreFormulario,$NombreObjeto);
   break;

   case 'MostrarDiv':
      $NombreFormulario=$_POST['NombreFormulario'];
      $NombreObjeto=$_POST['NombreObjeto'];
      $Dato=$_POST['Dato'];

      MController($Modulo,'Accesos');
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->MostrarDiv($NombreFormulario,$NombreObjeto,$Dato);
   break;

   case 'BuscarDataBD':
      $TablaBD    = $_POST['TablaBD'];
      $CampoBD    = $_POST['CampoBD'];
      $DataBuscar = $_POST['DataBuscar'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);
   break;

   case 'buscar_dato':
      $nombre_tabla     = $_POST['nombre_tabla'];
      $campo_buscar     = $_POST['campo_buscar'];
      $condicion_where  = $_POST['condicion_where'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->buscar_dato($nombre_tabla, $campo_buscar, $condicion_where);
   break;

   case 'LeerProgramacionCarga':
         //Recepcion de Variables del JS
            $Calendario_Semana=$_POST['Semana'];
         //Ejecuta Modelo
            MModel($Modulo,'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->LeerProgramacionCarga($Calendario_Semana);
   break;

   case 'BorrarProgramacionCarga':
      //Recepcion de Variables del JS
         $PrgRg_Id=$_POST['PrgRg_Id'];
         
      //Ejecuta Modelo
         MModel($Modulo,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->BorrarProgramacionCarga($PrgRg_Id);
   break;

   case 'CrearProgramacionCarga':
      $inputFileName = $_FILES['archivoexcel']['tmp_name'];
      $Semana = $_POST['Semana'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CrearProgramacionCarga($inputFileName,$Semana);
   break;

   case 'BorrarProgramacion':
      //Recepcion de Variables del JS
         $PrgRg_FechaProgramado=$_POST['PrgRg_FechaProgramado'];
         $PrgRg_Operacion=$_POST['PrgRg_Operacion'];

      //Ejecuta Modelo
         MModel($Modulo,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->BorrarProgramacion($PrgRg_FechaProgramado,$PrgRg_Operacion);
   break;

   case 'AniosProgramacionCarga':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->AniosProgramacionCarga();
   break;

   case 'SemanasProgramacionCarga':
      $Calendario_Anio = $_POST['elegidoC1'];
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SemanasProgramacionCarga($Calendario_Anio);
   break;

   case 'AniosPublicacionCarga':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->AniosPublicacionCarga();
   break;

   case 'LeerPublicacionCarga':
      //Recepcion de Variables del JS
         $AniosPublicados=$_POST['AniosPublicados'];
      //Ejecuta Modelo
         MModel($Modulo,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->LeerPublicacionCarga($AniosPublicados);
   break;

   case 'BuscarPublicacionCarga':
      //Recepcion de Variables del JS
         $AniosPublicados=$_POST['AniosPublicados'];
         $Prog_Dni=$_POST['Dni'];
      //Ejecuta Modelo
         MModel($Modulo,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->BuscarPublicacionCarga($AniosPublicados,$Prog_Dni);
   break;

   case 'SemanasPublicacionCarga':
      //Recepcion de Variables del JS
      $AniosPublicados=$_POST['AniosPublicados'];
      //Ejecuta Modelo

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SemanasPublicacionCarga($AniosPublicados);
   break;   

   case 'CrearPublicacionCarga':
      //Recepcion de Variables del JS
      $PubRg_SemanaPublicada=$_POST['PubRg_SemanaPublicada'];

      //Ejecuta Modelo|
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearPublicacionCarga($PubRg_SemanaPublicada);
   break;

   case 'BorrarPublicacionCarga':
      //Recepcion de Variables del JS
      $PubRg_Id=$_POST['PubRg_Id'];
      
      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarPublicacionCarga($PubRg_Id);
   break;

   case 'ValidarProgramacionCarga':
      $PrgRg_FechaProgramado = $_POST['PrgRg_FechaProgramado'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->ValidarProgramacionCarga($PrgRg_FechaProgramado);
   break;

   case 'ValidarControlFacilitador':
      $PrgRg_FechaProgramado = $_POST['PrgRg_FechaProgramado'];
      $PrgRg_Operacion = $_POST['PrgRg_Operacion'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->ValidarControlFacilitador($PrgRg_FechaProgramado,$PrgRg_Operacion);
   break;

   case 'PublicarProgramacion':
      //Recepcion de Variables del JS
      $PubRg_Id=$_POST['PubRg_Id'];
      
      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->PublicarProgramacion($PubRg_Id);
   break;

   case 'DetalleProgramacion':
      //Recepcion de Variables del JS
         $FechaInicio=$_POST['FechaInicio'];
         $FechaTermino=$_POST['FechaTermino'];
         $Prog_Dni=$_POST['Prog_Dni'];

         //Ejecuta Modelo
         MModel($Modulo,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->DetalleProgramacion($FechaInicio,$FechaTermino,$Prog_Dni);
   break;

   case 'ReportePDF_General':
      //Recepcion de Variables del JS
      $Semana=$_POST['Semana'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ReportePDF_General($Semana);
   break;   

   case 'ReportePDF_Individual':
      //Recepcion de Variables del JS
      $Semana=$_POST['Semana'];
      $Dni=$_POST['Dni'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ReportePDF_Individual($Semana,$Dni);
   break;   

   case 'CrearRegistroDescarga':
      //Recepcion de Variables del JS
         $Dni=$_POST['Dni'];

         //Ejecuta Modelo
         MModel($Modulo,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->CrearRegistroDescarga($Dni);
   break;

   case 'DetalleDescargaPdf':
      //Recepcion de Variables del JS
         $Desc_FechaInicio=$_POST['Desc_FechaInicio'];
         $Desc_FechaTermino=$_POST['Desc_FechaTermino'];
         $Desc_Prog_Dni=$_POST['Desc_Prog_Dni'];

         //Ejecuta Modelo
         MModel($Modulo,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->DetalleDescargaPdf($Desc_FechaInicio,$Desc_FechaTermino,$Desc_Prog_Dni);
   break;

   case 'DocumentRoot':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DocumentRoot();
   break;
   
   default: header('Location: /inicio');
}