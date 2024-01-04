<?php

// Accion declarada en el JS
$Accion=$_POST['Accion'];
$Modulo="InfoBus";   

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

   case 'select_combo':
      $nombre_tabla     = $_POST['nombre_tabla'];
      $es_campo_unico   = $_POST['es_campo_unico'];
      $campo_select     = $_POST['campo_select'];
      $campo_inicial    = $_POST['campo_inicial'];
      $condicion_where  = $_POST['condicion_where'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->select_combo($nombre_tabla, $es_campo_unico, $campo_select, $campo_inicial, $condicion_where);
   break;

   case 'CalculoFecha':
      $inicio= $_POST['inicio'];
      $calculo = $_POST['calculo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CalculoFecha($inicio,$calculo);
   break;

   case 'DiferenciaFecha':
      $inicio = $_POST['inicio'];
      $final = $_POST['final'];
      $dias = $_POST['dias'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DiferenciaFecha($inicio,$final,$dias);
   break;

   case 'BuscarDataBD':
      $TablaBD = $_POST['TablaBD'];
      $CampoBD = $_POST['CampoBD'];
      $DataBuscar = $_POST['DataBuscar'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);
   break;

   case 'buscar_dato':
      $nombre_tabla     = $_POST['nombre_tabla'];
      $campo_buscar     = $_POST['campo_buscar'];
      $condicion_where  = $_POST['condicion_where'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->buscar_dato($nombre_tabla, $campo_buscar, $condicion_where);
   break;

   case 'CargarInfoBus':
      $ib_FechaInicio = $_POST['ib_FechaInicio'];
      $ib_FechaTermino = $_POST['ib_FechaTermino'];
      $ib_Bus = $_POST['ib_Bus'];
      $ib_Tipo = $_POST['ib_Tipo'];
      $ib_Sistema = $_POST['ib_Sistema'];
      $ib_Contenga = $_POST['ib_Contenga'];
      $ib_origen = $_POST['ib_origen'];
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CargarInfoBus($ib_FechaInicio,$ib_FechaTermino,$ib_Bus,$ib_Tipo,$ib_Sistema,$ib_Contenga, $ib_origen);
   break;

   case 'BusesInfoBus':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BusesInfoBus();
   break;

   case 'InfoBusOTs':
      $nro_ot= $_POST['nro_ot'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->InfoBusOTs($nro_ot);
   break;

   case 'InfoBusVales':
      $nro_ot= $_POST['nro_ot'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->InfoBusVales($nro_ot);
   break;

   case 'DescargarInfoBus':
      //Recepcion de Variables del JS
      $ib_FechaInicio = $_POST['ib_FechaInicio'];
      $ib_FechaTermino = $_POST['ib_FechaTermino'];
      $ib_Bus = $_POST['ib_Bus'];
      $ib_Tipo = $_POST['ib_Tipo'];
      $ib_Sistema = $_POST['ib_Sistema'];
      $ib_Contenga = $_POST['ib_Contenga'];
      $ib_origen = $_POST['ib_origen'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DescargarInfoBus($ib_FechaInicio,$ib_FechaTermino,$ib_Bus,$ib_Tipo,$ib_Sistema,$ib_Contenga, $ib_origen);
   break;

   case 'DocumentRoot':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DocumentRoot();
   break;

   case 'SelectTipos':
      $ttablaotcorrectivas_operacion= $_POST['ttablaotcorrectivas_operacion'];
      $ttablaotcorrectivas_tipo = $_POST['ttablaotcorrectivas_tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectTipos($ttablaotcorrectivas_operacion,$ttablaotcorrectivas_tipo);
   break;

   case 'info_bus_km':
      $bus_nro_externo = $_POST['bus_nro_externo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->info_bus_km($bus_nro_externo);
   break;

   case 'borrar_archivo':
      $archivo = $_POST['archivo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->borrar_archivo($archivo);
   break;

   default: header('Location: /inicio');
}

