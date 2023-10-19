<?php
$Modulo = "componentes";
$Accion=$_POST['Accion'];   

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
      $TablaBD = $_POST['TablaBD'];
      $CampoBD = $_POST['CampoBD'];
      $DataBuscar = $_POST['DataBuscar'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);
   break;

   case 'CompararFechaActual':
      $fecha = $_POST['fecha'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CompararFechaActual($fecha);
   break;

   case 'DocumentRoot':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DocumentRoot();
   break;

   case 'CalculoFecha':
      $inicio  = $_POST['inicio'];
      $calculo = $_POST['calculo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->CalculoFecha($inicio,$calculo);
   break;

   case 'select_combo':
      $nombre_tabla     = $_POST['nombre_tabla'];
      $es_campo_unico   = $_POST['es_campo_unico'];
      $campo_select     = $_POST['campo_select'];
      $campo_inicial    = $_POST['campo_inicial'];
      $condicion_where  = $_POST['condicion_where'];
      $order_by         = $_POST['order_by'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->select_combo($nombre_tabla, $es_campo_unico, $campo_select, $campo_inicial, $condicion_where, $order_by);
   break;

   case 'leer_componentes':
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_componentes();
   break;

   case 'genera_codigo_patrimonial':
      $comp_tipo_componente     = strtoupper(trim($_POST['comp_tipo_componente']));

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->genera_codigo_patrimonial($comp_tipo_componente);
   break;

   case 'crear_componentes':
      $comp_sistema            = $_POST['comp_sistema'];
      $comp_tipo_componente               = $_POST['comp_tipo_componente'];
      $comp_codigo_patrimonial = $_POST['comp_codigo_patrimonial'];
      $comp_origen             = $_POST['comp_origen'];
      $comp_nro_serie          = $_POST['comp_nro_serie'];
      $comp_nro_parte          = $_POST['comp_nro_parte'];
      $comp_turno              = $_POST['comp_turno'];
      $comp_observaciones      = strtoupper(trim($_POST['comp_observaciones']));
  
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->crear_componentes($comp_sistema, $comp_tipo_componente, $comp_codigo_patrimonial, $comp_origen, $comp_nro_serie, $comp_nro_parte, $comp_turno, $comp_observaciones);
   break;

   case 'editar_componentes':
      $componente_id           = $_POST['componente_id'];
      $comp_sistema            = $_POST['comp_sistema'];
      $comp_tipo_componente               = $_POST['comp_tipo_componente'];
      $comp_codigo_patrimonial = $_POST['comp_codigo_patrimonial'];
      $comp_origen             = $_POST['comp_origen'];
      $comp_nro_serie          = $_POST['comp_nro_serie'];
      $comp_nro_parte          = $_POST['comp_nro_parte'];
      $comp_turno              = $_POST['comp_turno'];
      $comp_observaciones      = strtoupper(trim($_POST['comp_observaciones']));
  
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_componentes($componente_id, $comp_sistema, $comp_tipo_componente, $comp_codigo_patrimonial, $comp_origen, $comp_nro_serie, $comp_nro_parte, $comp_turno, $comp_observaciones);
   break;

   default: header('Location: /inicio');
}