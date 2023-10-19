<?php
// Accion declarada en el JS
$Accion=$_POST['Accion'];
$Modulo="DespachoFlota";   

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

   case 'BuscarProgramacion':
      $Prog_Fecha=$_POST['Prog_Fecha'];
      $turno_DespachoFlota=$_POST['turno_DespachoFlota'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarProgramacion($Prog_Fecha,$turno_DespachoFlota);
   break;

   case 'BuscarSalidaFlota':
      //Recepcion de Variables del JS
      $Prog_Fecha=$_POST['Prog_Fecha'];
      $Prog_Operacion=$_POST['Prog_Operacion'];
      $tipo_SalidaFlota=$_POST['tipo_SalidaFlota'];
      
      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarSalidaFlota($Prog_Fecha,$Prog_Operacion,$tipo_SalidaFlota);
   break;

   case 'BuscarInformeDespacho':
      //Recepcion de Variables del JS
      $Prog_Fecha=$_POST['Prog_Fecha'];
      $Prog_Operacion=$_POST['Prog_Operacion']; 
      $turno_InformeDespacho=$_POST['turno_InformeDespacho'];     

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarInformeDespacho($Prog_Fecha,$Prog_Operacion,$turno_InformeDespacho);
   break;

   case 'BuscarInformeLlegada':
      //Recepcion de Variables del JS
      $Prog_Fecha=$_POST['Prog_Fecha'];
      $Prog_Operacion=$_POST['Prog_Operacion'];
      $tipo_InformeLlegada=$_POST['tipo_InformeLlegada'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarInformeLlegada($Prog_Fecha,$Prog_Operacion,$tipo_InformeLlegada);
   break;

   case 'NuevoDespachoFlota':
      //Recepcion de Variables del JS
      $ControlFacilitador_Id = $_POST['ControlFacilitador_Id'];
      $Programacion_Id = $_POST['Programacion_Id'];
      $Repo_Descripcion = $_POST['Repo_Descripcion'];
      $Repo_BusCambio = $_POST['Repo_BusCambio'];
      $Repo_HoraSalida = $_POST['Repo_HoraSalida'];
      $Repo_Motivo = $_POST['Repo_Motivo'];
      $Repo_CFaRgId = $_POST['Repo_CFaRgId'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->NuevoDespachoFlota($ControlFacilitador_Id,$Programacion_Id,$Repo_Descripcion,$Repo_BusCambio,$Repo_HoraSalida,$Repo_Motivo,$Repo_CFaRgId);
   break;

   case 'EditarDespachoFlota':
      //Recepcion de Variables del JS
      $ControlFacilitador_Id = $_POST['ControlFacilitador_Id'];
      $Programacion_Id = $_POST['Programacion_Id'];
      $Repo_Descripcion = $_POST['Repo_Descripcion'];
      $Repo_BusCambio = $_POST['Repo_BusCambio'];
      $Repo_HoraSalida = $_POST['Repo_HoraSalida'];
      $Repo_Motivo = $_POST['Repo_Motivo'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->EditarDespachoFlota($ControlFacilitador_Id,$Programacion_Id,$Repo_Descripcion,$Repo_BusCambio,$Repo_HoraSalida,$Repo_Motivo);
   break;

   case 'BuscarReporte':
      $ControlFacilitador_Id = $_POST['ControlFacilitador_Id'];
         
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarReporte($ControlFacilitador_Id);
   break;

   case 'ExisteDespachoFlotaTurno':
      $Prog_Fecha= $_POST['Prog_Fecha'];
      $turno_DespachoFlota = $_POST['turno_DespachoFlota'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ExisteDespachoFlotaTurno($Prog_Fecha,$turno_DespachoFlota);
   break;

   case 'SelectBus':
      $Prog_Operacion= $_POST['Prog_Operacion'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectBus($Prog_Operacion);
   break;

   case 'SelectTipos':
      $Prog_Operacion= $_POST['Prog_Operacion'];
      $Ttabla_Tipo = $_POST['Tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectTipos($Prog_Operacion,$Ttabla_Tipo);
   break;

   case 'CrearSalidaFlota':
      //Recepcion de Variables del JS
      $Prog_Fecha = $_POST['Prog_Fecha'];
      $Prog_Operacion = $_POST['Prog_Operacion'];
      $HoraInicio = $_POST['HoraInicio'];
      $HoraTermino = $_POST['HoraTermino'];
      $TurnoSalidaFlota = $_POST['TurnoSalidaFlota'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CrearSalidaFlota($Prog_Fecha,$Prog_Operacion,$HoraInicio,$HoraTermino,$TurnoSalidaFlota);
   break;

   case 'ExisteSalidaFlota':
      //Recepcion de Variables del JS
      $Prog_Fecha = $_POST['Prog_Fecha'];
      $Prog_Operacion = $_POST['Prog_Operacion'];
      $TurnoSalidaFlota = $_POST['TurnoSalidaFlota'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ExisteSalidaFlota($Prog_Fecha,$Prog_Operacion,$TurnoSalidaFlota);
   break;

   case 'TurnoInformeDespacho':
      //Recepcion de Variables del JS
      $Prog_Fecha = $_POST['Prog_Fecha'];
      $Prog_Operacion = $_POST['Prog_Operacion'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->TurnoInformeDespacho($Prog_Fecha,$Prog_Operacion);
   break;

   case 'TurnoDespachoFlota':
      //Recepcion de Variables del JS
      $Prog_Fecha = $_POST['Prog_Fecha'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->TurnoDespachoFlota($Prog_Fecha);
   break;

   default: header('Location: /inicio');
}