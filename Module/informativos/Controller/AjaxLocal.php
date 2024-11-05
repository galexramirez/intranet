<?php
// Accion declarada en el JS
$Accion=$_POST['Accion'];   
$Modulo = "informativos";

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
      $NombreFormulario = $_POST['NombreFormulario'];
      $NombreObjeto     = $_POST['NombreObjeto'];
      $Dato             = $_POST['Dato'];

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

   case 'listado_informativo':
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->Read();
   break;

   case 'crear_informativo':
      $comunicado_id = $_POST['comunicado_id'];
      $comu_titulo = strtoupper($_POST['comu_titulo']);
      $comu_fecha_inicio = $_POST['comu_fecha_inicio'];
      $comu_fecha_fin = $_POST['comu_fecha_fin'];
      $comu_proceso = $_POST['comu_proceso'];
      $comu_destacado = $_POST['comu_destacado'];
      $nombre_imagen = $_POST['nombre_imagen'];
      if($nombre_imagen!=""){
         $comu_archivo = $_FILES['comu_archivo']['tmp_name'];
      }
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->Create($comunicado_id, $comu_titulo, $comu_fecha_inicio, $comu_fecha_fin, $comu_proceso, $comu_destacado, $nombre_imagen, $comu_archivo);
   break;

   case 'borrar_informativo':
      $comunicado_id = $_POST['comunicado_id'];
      $comu_archivo = $_POST['comu_archivo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->Delete($comunicado_id, $comu_archivo);
   break;

   default: header('Location: /inicio');
}

?>