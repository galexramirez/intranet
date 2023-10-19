<?php
$Accion=$_POST['Accion'];
$Modulo="ControlFacilitador";

switch ($Accion)
{

   //:::::::::::::::::::::::::::::: CREACION DE OBJETOS :::::::::::::::::::::::::::::::::::::::::::::://

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

   ///:::::::::::::::::::::::::::::: FIN DE CREACION DE OBJETOS :::::::::::::::::::::::::::::::::::::///

   //:::::::::::::::::::::::::::::: FACILITADOR CARGA :::::::::::::::::::::::::::::::::::::::::::::://

   case 'LeerFacilitadorCarga':
      //Recepcion de Variables del JS
      $Calendario_Semana=$_POST['Semana'];
      
      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerFacilitadorCarga($Calendario_Semana);
   break;

   case 'BorrarFacilitadorCarga':
      $CFaRg_Id=$_POST['CFaRg_Id'];
         
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarFacilitadorCarga($CFaRg_Id);
   break;

   case 'CrearFacilitadorCarga':
      $CFaRg_FechaCargada = $_POST['CFaRg_FechaCargada'];
      $CFaRg_TipoOperacionCargada = $_POST['CFaRg_TipoOperacionCargada'];
      $Semana = $_POST['Semana'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CrearFacilitadorCarga($CFaRg_FechaCargada,$CFaRg_TipoOperacionCargada,$Semana);
   break;

   case 'AniosFacilitadorCarga':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->AniosFacilitadorCarga();
   break;

   case 'SemanasFacilitadorCarga':
      $Calendario_Anio = $_POST['elegidoC1'];
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SemanasFacilitadorCarga($Calendario_Anio);
   break;

   case 'CerrarFacilitadorCarga':
      $CFaRg_Id                     = $_POST['CFaRg_Id'];
      $CFaRg_FechaCargada           = substr($_POST['CFaRg_FechaCargada'],0,10);     
      $CFaRg_TipoOperacionCargada   = $_POST['CFaRg_TipoOperacionCargada'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CerrarFacilitadorCarga($CFaRg_Id, $CFaRg_FechaCargada, $CFaRg_TipoOperacionCargada);
   break;

   case 'BorrarDetalleFacilitador':
      $CFaRg_Id            = $_POST['CFaRg_Id'];
      $CFaRg_FechaCargada  = $_POST['CFaRg_FechaCargada'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->BorrarDetalleFacilitador($CFaRg_Id, $CFaRg_FechaCargada);
   break;

   //:::::::::::::::::::::::::::::::::::::::::::: DETALLE CONTROL FACILITADOR :::::::::::::::::::::::::::::::::::::::::::::::://

   case 'LeerControlFacilitador':
      $Prog_Fecha= $_POST['Prog_Fecha'];
      $Prog_Operacion= $_POST['Prog_Operacion'];
      $VaijesCancelados= $_POST['ViajesCancelados'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerControlFacilitador($Prog_Fecha,$Prog_Operacion,$VaijesCancelados);
   break;

   case 'leer_control_facilitador_hist':
      $Prog_Fecha       = $_POST['Prog_Fecha'];
      $Prog_Operacion   = $_POST['Prog_Operacion'];
      $ViajesCancelados = $_POST['ViajesCancelados'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta     = $InstanciaAjax->leer_control_facilitador_hist($Prog_Fecha,$Prog_Operacion,$ViajesCancelados);
   break;

   case 'CrearControlFacilitador':
      $Prog_Operacion= $_POST['Prog_Operacion'];   
      $Prog_Fecha= $_POST['Prog_Fecha'];
      $Prog_NombreColaborador=$_POST['Prog_NombreColaborador'];
      $Prog_Tabla=$_POST['Prog_Tabla'];
      $Prog_HoraOrigen=$_POST['Prog_HoraOrigen'];
      $Prog_HoraDestino=$_POST['Prog_HoraDestino'];
      $Prog_Servicio=$_POST['Prog_Servicio'];
      $Prog_ServBus=$_POST['Prog_ServBus'];
      $Prog_Bus=$_POST['Prog_Bus'];
      $Prog_LugarOrigen=$_POST['Prog_LugarOrigen'];
      $Prog_LugarDestino=$_POST['Prog_LugarDestino'];
      $Prog_TipoEvento=$_POST['Prog_TipoEvento'];
      $Prog_KmXPuntos=$_POST['Prog_KmXPuntos'];
      $Prog_Sentido=$_POST['Prog_Sentido'];
      $Prog_BusManto=$_POST['Prog_BusManto'];
      $Prog_IdManto=$_POST['Prog_IdManto'];
      $Prog_Observaciones=$_POST['Prog_Observaciones'];
      $OPE_NovedadId=$_POST['OPE_NovedadId'];
      $btnOpcionNovedad=$_POST['btnOpcionNovedad'];
      $Nove_Novedad = $_POST['Nove_Novedad'];
      $Nove_TipoNovedad = $_POST['Nove_TipoNovedad'];
      $Nove_DetalleNovedad = $_POST['Nove_DetalleNovedad'];
      $Nove_Descripcion = $_POST['Nove_Descripcion'];
      $Nove_LugarExacto = $_POST['Nove_LugarExacto'];
      $Nove_HoraInicio = $_POST['Nove_HoraInicio'];
      $Nove_HoraFin = $_POST['Nove_HoraFin'];
      $Nove_TipoOrigen = $_POST['Nove_TipoOrigen'];
      $arrData = json_decode($_POST['arrData']);
      
      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CrearControlFacilitador($Prog_Operacion, $Prog_Fecha, $Prog_NombreColaborador, $Prog_Tabla, $Prog_HoraOrigen, $Prog_HoraDestino, $Prog_Servicio,$Prog_ServBus, $Prog_Bus, $Prog_LugarOrigen, $Prog_LugarDestino, $Prog_TipoEvento, $Prog_KmXPuntos, $Prog_Sentido, $Prog_BusManto, $Prog_IdManto, $Prog_Observaciones, $OPE_NovedadId, $btnOpcionNovedad, $Nove_Novedad,$Nove_TipoNovedad, $Nove_DetalleNovedad, $Nove_Descripcion, $Nove_LugarExacto, $Nove_HoraInicio, $Nove_HoraFin, $Nove_TipoOrigen, $arrData);

   break;

   case 'EditarControlFacilitador':
      $Prog_Fecha             = $_POST['Prog_Fecha'];
      $Prog_Operacion         = $_POST['Prog_Operacion'];
      $Prog_NombreColaborador = $_POST['Prog_NombreColaborador'];
      $Prog_Tabla             = $_POST['Prog_Tabla'];
      $Prog_HoraOrigen        = $_POST['Prog_HoraOrigen'];
      $Prog_HoraDestino       = $_POST['Prog_HoraDestino'];
      $Prog_Servicio          = $_POST['Prog_Servicio'];
      $Prog_ServBus           = $_POST['Prog_ServBus'];
      $Prog_Bus               = $_POST['Prog_Bus'];
      $Prog_LugarOrigen       = $_POST['Prog_LugarOrigen'];
      $Prog_LugarDestino      = $_POST['Prog_LugarDestino'];
      $Prog_TipoEvento        = $_POST['Prog_TipoEvento'];
      $Prog_KmXPuntos         = $_POST['Prog_KmXPuntos'];
      $Prog_Sentido           = $_POST['Prog_Sentido'];
      $Prog_BusManto          = $_POST['Prog_BusManto'];
      $Prog_IdManto           = $_POST['Prog_IdManto'];
      $Prog_Observaciones     = $_POST['Prog_Observaciones'];
      $arrData                = json_decode($_POST['arrData']);
      $OPE_NovedadId          = $_POST['OPE_NovedadId'];
      $btnOpcionNovedad       = $_POST['btnOpcionNovedad'];
      $Nove_Novedad           = $_POST['Nove_Novedad'];
      $Nove_TipoNovedad       = $_POST['Nove_TipoNovedad'];
      $Nove_DetalleNovedad    = $_POST['Nove_DetalleNovedad'];
      $Nove_Descripcion       = $_POST['Nove_Descripcion'];
      $Nove_LugarExacto       = $_POST['Nove_LugarExacto'];
      $Nove_HoraInicio        = $_POST['Nove_HoraInicio'];
      $Nove_HoraFin           = $_POST['Nove_HoraFin'];
      $Nove_TipoOrigen        = $_POST['Nove_TipoOrigen'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->EditarControlFacilitador($Prog_Fecha, $Prog_Operacion, $Prog_NombreColaborador, $Prog_Tabla, $Prog_HoraOrigen, $Prog_HoraDestino, $Prog_Servicio,$Prog_ServBus, $Prog_Bus, $Prog_LugarOrigen, $Prog_LugarDestino, $Prog_TipoEvento, $Prog_KmXPuntos, $Prog_Sentido, $Prog_BusManto, $Prog_IdManto, $Prog_Observaciones, $arrData, $OPE_NovedadId, $btnOpcionNovedad,$Nove_Novedad, $Nove_TipoNovedad, $Nove_DetalleNovedad, $Nove_Descripcion, $Nove_LugarExacto, $Nove_HoraInicio, $Nove_HoraFin, $Nove_TipoOrigen);
   break;

   case 'EditarTotalControlFacilitador':
      $Prog_Fecha= $_POST['Prog_Fecha'];
      $Prog_Operacion= $_POST['Prog_Operacion'];
      $Prog_IdManto1=$_POST['Prog_IdManto1'];
      $Prog_Bus2=$_POST['Prog_Bus2'];
      $OPE_NovedadId=$_POST['OPE_NovedadId'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->EditarTotalControlFacilitador($Prog_Fecha,$Prog_Operacion,$Prog_IdManto1,$Prog_Bus2,$OPE_NovedadId);
   break;

   case 'ValidarControlFacilitador':
      $Prog_Fecha= $_POST['Prog_Fecha'];
      $Prog_Operacion= $_POST['Prog_Operacion'];
         
      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ValidarControlFacilitador($Prog_Fecha,$Prog_Operacion);
   break;

   case 'SelectUsuario':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectUsuario();
   break;

   case 'SelectUsuarioActual':
      $Prog_Fecha= $_POST['Prog_Fecha'];
      $Prog_Operacion= $_POST['Prog_Operacion'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectUsuarioActual($Prog_Fecha,$Prog_Operacion);
   break;

   case 'SelectBus':
      $Prog_Operacion= $_POST['Prog_Operacion'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectBus($Prog_Operacion);
   break;

   case 'SelectIdMantoActual':
      $Prog_Fecha= $_POST['Prog_Fecha'];
      $Prog_Operacion= $_POST['Prog_Operacion'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectIdMantoActual($Prog_Fecha,$Prog_Operacion);
   break;

   case 'SelectBusCambio':
      $Prog_Fecha= $_POST['Prog_Fecha'];
      $Prog_Operacion= $_POST['Prog_Operacion'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectBusCambio($Prog_Fecha,$Prog_Operacion);
   break;

   case 'CodigoColaborador':
      $Prog_NombreColaborador= $_POST['Prog_NombreColaborador'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CodigoColaborador($Prog_NombreColaborador);
   break;

   case 'BusNroVid':
      $Prog_Bus= $_POST['Prog_Bus'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BusNroVid($Prog_Bus);
   break;

   case 'BusNroPlaca':
      $Prog_Bus= $_POST['Prog_Bus'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BusNroPlaca($Prog_Bus);
   break;

   case 'SelectTipos':
      $Prog_Operacion= $_POST['Prog_Operacion'];
      $Ttabla_Tipo = $_POST['Tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectTipos($Prog_Operacion,$Ttabla_Tipo);
   break;

   case 'InconsistenciasControlFacilitador':
      $Prog_Fecha= $_POST['Prog_Fecha'];   
      $Prog_Operacion= $_POST['Prog_Operacion'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->InconsistenciasControlFacilitador($Prog_Fecha,$Prog_Operacion);
   break;

   case 'InconsistenciasBusPiloto':
      $Prog_Fecha= $_POST['Prog_Fecha'];   
      $Prog_Operacion= $_POST['Prog_Operacion'];
      $Prog_Bus=$_POST['Prog_Bus'];
      $Prog_NombreColaborador=$_POST['Prog_NombreColaborador'];
      $arrData=json_decode($_POST['arrData']);
      $Prog_HoraOrigen = $_POST['Prog_HoraOrigen'];
      $Prog_HoraDestino = $_POST['Prog_HoraDestino'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->InconsistenciasBusPiloto($Prog_Fecha,$Prog_Operacion,$Prog_Bus,$Prog_NombreColaborador,$arrData,$Prog_HoraOrigen,$Prog_HoraDestino);
   break;

   case 'ResumenOperacion':
      $Prog_Fecha= $_POST['Prog_Fecha'];   
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ResumenOperacion($Prog_Fecha);
   break;

   case 'resumen_operacion_hist':
      $Prog_Fecha = $_POST['Prog_Fecha'];   
      
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->resumen_operacion_hist($Prog_Fecha);
   break;

   case 'ListarReporte':
      $ControlFacilitador_Id = $_POST['ControlFacilitador_Id'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ListarReporte($ControlFacilitador_Id);
   break;

   case 'CambiosControlFacilitador':
      $ControlFacilitador_Id = $_POST['ControlFacilitador_Id'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CambiosControlFacilitador($ControlFacilitador_Id);
   break;

   case 'cambios_control_facilitador_hist':
      $ControlFacilitador_Id = $_POST['ControlFacilitador_Id'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->cambios_control_facilitador_hist($ControlFacilitador_Id);
   break;

   case 'CerrarReporte':
      $ControlFacilitador_Id= $_POST['ControlFacilitador_Id'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CerrarReporte($ControlFacilitador_Id);
   break;

   case 'ValidarControlFacilitadorCarga':
      $Prog_Fecha= $_POST['Prog_Fecha'];   

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ValidarControlFacilitadorCarga($Prog_Fecha);
   break;

   case 'KmRecorridos':
      $Prog_Operacion = $_POST['Prog_Operacion'];
      $Prog_Sentido = $_POST['Prog_Sentido'];
      $Prog_Servicio = $_POST['Prog_Servicio'];
      $Prog_LugarOrigen = $_POST['Prog_LugarOrigen'];
      $Prog_LugarDestino = $_POST['Prog_LugarDestino'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->KmRecorridos($Prog_Operacion,$Prog_Sentido,$Prog_Servicio,$Prog_LugarOrigen,$Prog_LugarDestino);
   break;

   case 'horas_trabajdas':
      $operacion  = $_POST['operacion'];
      $fecha      = $_POST['fecha'];
      $codigo     = $_POST['codigo'];
      $hora       = $_POST['hora'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->horas_trabajdas($operacion, $fecha, $codigo, $hora);      
   break;
   //:::::::::::::::::::::::::::::::::::::::::::: NOVEDAD CARGA :::::::::::::::::::::::::::::::::::::::::::::::://

   case 'ListarNovedad':
      //Recepcion de Variables del JS
      $OPE_NovedadId = $_POST['OPE_NovedadId'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ListarNovedad($OPE_NovedadId);
   break;

   case 'ValidarNovedad':
      //Recepcion de Variables del JS
      $Prog_Fecha= $_POST['Prog_Fecha'];   
      $Prog_Operacion= $_POST['Prog_Operacion'];
         
      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ValidarNovedad($Prog_Fecha,$Prog_Operacion);
   break;

   case 'ValidarNovedad_ControlFacilitador':
      //Recepcion de Variables del JS
      $OPE_NovedadId= $_POST['OPE_NovedadId'];   
      $Novedad_Id= $_POST['Novedad_Id'];
         
      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ValidarNovedad_ControlFAcilitador($OPE_NovedadId,$Novedad_Id);
   break;

   case 'SelectNovedad':
      $Prog_Fecha= $_POST['Prog_Fecha'];   
      $Prog_Operacion= $_POST['Prog_Operacion'];
      $ControlFacilitador_Id= $_POST['ControlFacilitador_Id'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectNovedad($Prog_Fecha,$Prog_Operacion,$ControlFacilitador_Id);
   break;

   case 'BuscarNovedadCarga':
      //Recepcion de Variables del JS
      $Nove_FechaOperacion = $_POST['Nove_Fecha'];
      $Nove_Estado         = $_POST['Nove_Estado'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BuscarNovedadCarga($Nove_FechaOperacion, $Nove_Estado);
   break;

   case 'DetalleNovedadCarga':
      $Nove_FechaOperacion = $_POST['Nove_FechaOperacion'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->DetalleNovedadCarga($Nove_FechaOperacion);
   break;

   case 'detalle_novedad_carga_hist':
      $Nove_FechaOperacion = $_POST['Nove_FechaOperacion'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->detalle_novedad_carga_hist($Nove_FechaOperacion);
   break;

   case 'BorrarNovedadCarga':
      //Recepcion de Variables del JS
      $CFaRg_Id=$_POST['CFaRg_Id'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarNovedadCarga($CFaRg_Id);
   break;

   case 'BorrarControlCambiosNovedad':
      //Recepcion de Variables del JS
      $CFaRg_Id=$_POST['CFaRg_Id'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarControlCambiosNovedad($CFaRg_Id);
   break;

   case 'EditarNovedadCarga':
      //Recepcion de Variables del JS
      $OPE_NovedadId       = $_POST['OPE_NovedadId'];
      $Novedad_Id          = $_POST['Novedad_Id'];
      $Nove_Novedad        = $_POST['Nove_Novedad'];
      $Nove_TipoNovedad    = $_POST['Nove_TipoNovedad'];
      $Nove_DetalleNovedad = $_POST['Nove_DetalleNovedad'];
      $Nove_Descripcion    = $_POST['Nove_Descripcion'];
      $Nove_LugarExacto    = $_POST['Nove_LugarExacto'];
      $Nove_HoraInicio     = $_POST['Nove_HoraInicio'];
      $Nove_HoraFin        = $_POST['Nove_HoraFin'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->EditarNovedadCarga($OPE_NovedadId,$Novedad_Id,$Nove_Novedad,$Nove_TipoNovedad,$Nove_DetalleNovedad,$Nove_Descripcion,$Nove_LugarExacto,$Nove_HoraInicio,$Nove_HoraFin);
   break;

   case 'EliminarNovedadCarga':
      //Recepcion de Variables del JS
      $OPE_NovedadId=$_POST['OPE_NovedadId'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EliminarNovedadCarga($OPE_NovedadId);
   break;

   case 'CerrarNovedadCarga':
      //Recepcion de Variables del JS
      $OPE_NovedadId = $_POST['OPE_NovedadId'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CerrarNovedadCarga($OPE_NovedadId);
   break;

   case 'AbrirNovedadCarga':

      //Recepcion de Variables del JS
      $OPE_NovedadId=$_POST['OPE_NovedadId'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->AbrirNovedadCarga($OPE_NovedadId);
   break;

   case 'HistorialNovedadCarga':
      //Recepcion de Variables del JS
      $Novedad_Id=$_POST['Novedad_Id'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->HistorialNovedadCarga($Novedad_Id);
   break;

   case 'BuscarDescripcionNovedad':
      //Recepcion de Variables del JS
      $Prog_Operacion= $_POST['Prog_Operacion'];
      $Ttabla_Tipo = $_POST['Tipo'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarDescripcionNovedad($Prog_Operacion,$Ttabla_Tipo);
   break;

   case 'Reporteop':
      $fechaReporteop      = $_POST['fechaReporteop'];
      $tipoReporteop       = $_POST['tipoReporteop'];
      $operacionReporteop  = $_POST['operacionReporteop'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->Reporteop($fechaReporteop,$tipoReporteop,$operacionReporteop);
   break;

   case 'reporte_op_hist':
      $fechaReporteop      = $_POST['fechaReporteop'];
      $tipoReporteop       = $_POST['tipoReporteop'];
      $operacionReporteop  = $_POST['operacionReporteop'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->reporte_op_hist($fechaReporteop,$tipoReporteop,$operacionReporteop);
   break;

   case 'BuscarServBus':
      //Recepcion de Variables del JS
      $Prog_Operacion=$_POST['Prog_Operacion'];
      $Prog_Fecha=$_POST['Prog_Fecha'];
      $Prog_IdManto=$_POST['Prog_IdManto'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarServBus($Prog_Operacion,$Prog_Fecha,$Prog_IdManto);
   break;

   case 'BuscarDataBD':
      $TablaBD = $_POST['TablaBD'];
      $CampoBD = $_POST['CampoBD'];
      $DataBuscar = $_POST['DataBuscar'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);
   break;

   case 'auto_completar':
      $nombre_tabla  = $_POST['nombre_tabla'];
      $nombre_campo  = $_POST['nombre_campo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->auto_completar($nombre_tabla, $nombre_campo);
   break;

   case 'buscar_dato':
      $nombre_tabla     = $_POST['nombre_tabla'];
      $campo_buscar     = $_POST['campo_buscar'];
      $condicion_where  = $_POST['condicion_where'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->buscar_dato($nombre_tabla, $campo_buscar, $condicion_where);
   break;

   case 'DocumentRoot':
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->DocumentRoot();
   break;

   case 'buscar_pdf':
      $tabla               = $_POST['tabla'];
      $campo_archivo       = $_POST['campo_archivo'];
      $campo_buscar        = $_POST['campo_buscar'];
      $dato_buscar         = $_POST['dato_buscar'];
      $campo_tipo_archivo  = $_POST['campo_tipo_archivo'];
      $dato_tipo_archivo   = $_POST['dato_tipo_archivo'];
      $nombre_archivo      = $_POST['nombre_archivo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->buscar_pdf($tabla, $campo_archivo, $campo_buscar, $dato_buscar, $campo_tipo_archivo, $dato_tipo_archivo, $nombre_archivo);
   break;

   case 'unlink_pdf':
      $archivo = $_POST['archivo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->unlink_pdf($archivo);
   break;

   case 'grabar_imagen':
      $novedad_id       = $_POST['novedad_id'];
      $nove_tipo_imagen = $_POST['nove_tipo_imagen'];
      $nove_imagen      = addslashes(file_get_contents($_FILES['nove_imagen']['tmp_name']));
         
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->grabar_imagen($novedad_id, $nove_tipo_imagen, $nove_imagen);
   break;

   case 'editar_imagen':
      $novedad_id       = $_POST['novedad_id'];
      $nove_tipo_imagen = $_POST['nove_tipo_imagen'];
      $nove_imagen      = addslashes(file_get_contents($_FILES['nove_imagen']['tmp_name']));
         
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_imagen($novedad_id, $nove_tipo_imagen, $nove_imagen);
   break;

   case 'LeerTipoTablas':
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerTipoTablas();
   break;

   case 'CrearTipoTablas':
      $Ttabla_Id = $_POST['Ttabla_Id'];
      $Ttabla_Tipo = strtoupper($_POST['Ttabla_Tipo']);
      $Ttabla_Operacion = strtoupper($_POST['Ttabla_Operacion']);
      $Ttabla_Detalle = strtoupper($_POST['Ttabla_Detalle']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearTipoTablas($Ttabla_Id,$Ttabla_Tipo,$Ttabla_Operacion,$Ttabla_Detalle);
   break;

   case 'EditarTipoTablas':
      $Ttabla_Id = $_POST['Ttabla_Id'];
      $Ttabla_Tipo = strtoupper($_POST['Ttabla_Tipo']);
      $Ttabla_Operacion = strtoupper($_POST['Ttabla_Operacion']);
      $Ttabla_Detalle = strtoupper($_POST['Ttabla_Detalle']);
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarTipoTablas($Ttabla_Id,$Ttabla_Tipo,$Ttabla_Operacion,$Ttabla_Detalle);
   break;

   case 'BorrarTipoTablas':
      $Ttabla_Id=$_POST['Ttabla_Id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarTipoTablas($Ttabla_Id);
   break;

   default: header('Location: /inicio');

}