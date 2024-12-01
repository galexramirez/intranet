<?php

$Accion = $_POST['Accion'];
$Modulo = "pilotos";   

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

   case 'DocumentRoot':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DocumentRoot();
   break;

   case 'auto_completar':
      $NombreTabla= $_POST['NombreTabla'];
      $NombreCampo = $_POST['NombreCampo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->auto_completar($NombreTabla,$NombreCampo);
   break;

   case 'usuario_id':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->usuario_id();
   break;

   case 'marcacion':
      $lat = $_POST['lat'];
      $long = $_POST['long'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->marcacion($lat, $long);
   break;

   case 'listado_publicacion':
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->listado_publicacion();
   break;

   case 'crear_publicacion':
      $comu_titulo = strtoupper($_POST['comu_titulo']);
      $comu_fecha_inicio = $_POST['comu_fecha_inicio'];
      $comu_fecha_fin = $_POST['comu_fecha_fin'];
      $comu_categoria = $_POST['comu_categoria'];
      $comu_destacado = $_POST['comu_destacado'];
      $nombre_imagen = $_POST['nombre_imagen'];
      if($nombre_imagen!=""){
         $comu_imagen = $_FILES['comu_imagen']['tmp_name'];
      }
      $nombre_pdf = $_POST['nombre_pdf'];
      if($nombre_pdf!=""){
         $comu_pdf = $_FILES['comu_pdf']['tmp_name'];
      }
      $comu_video = $_POST['comu_video'];
      $comu_link = $_POST['comu_link'];
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->crear_publicacion($comu_titulo, $comu_fecha_inicio, $comu_fecha_fin, $comu_categoria, $comu_destacado, $nombre_imagen, $comu_imagen, $nombre_pdf, $comu_pdf, $comu_video, $comu_link);
   break;

   case 'borrar_publicacion':
      $comunicado_id = $_POST['comunicado_id'];
      $comu_imagen = $_POST['comu_imagen'];
      $comu_pdf = $_POST['comu_pdf'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->borrar_publicacion($comunicado_id, $comu_imagen, $comu_pdf);
   break;

   case 'cargar_desempeno_piloto':
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->cargar_desempeno_piloto();
   break;

   case 'data_accidente':
      $accidente_id = $_POST['accidente_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->data_accidente($accidente_id);
   break;

   case 'data_punto_fijo':
      $punto_fijo_id = $_POST['punto_fijo_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->data_punto_fijo($punto_fijo_id);
   break;

   case 'data_acompanamiento':
      $acompanamiento_id = $_POST['acompanamiento_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->data_acompanamiento($acompanamiento_id);
   break;

   case 'data_comportamiento':
      $comportamiento_id = $_POST['comportamiento_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->data_comportamiento($comportamiento_id);
   break;

   case 'data_ausencia':
      $ausencia_id = $_POST['ausencia_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->data_ausencia($ausencia_id);
   break;

   default: header('Location: /inicio');
}