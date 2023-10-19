<?php
// Accion declarada en el JS
$Accion=$_POST['Accion'];   
$Modulo = "solicitudes";

switch ($Accion)
   {
   case 'CreacionTabs':
      $NombreTabs = $_POST['NombreTabs'];
      $TipoTabs   = $_POST['TipoTabs'];

      MController($Modulo,'Accesos');
      $InstanciaAjax = new Accesos();
      $Respuesta     = $InstanciaAjax->CreacionTabs($NombreTabs,$TipoTabs);
   break;

   case 'CreacionTabla':
      $NombreTabla   = $_POST['NombreTabla'];
      $TipoTabla     = $_POST['TipoTabla'];

      MController($Modulo,'Accesos');
      $InstanciaAjax = new Accesos();
      $Respuesta     = $InstanciaAjax->CreacionTabla($NombreTabla,$TipoTabla);
   break;

   case 'ColumnasTabla':
      $NombreTabla   = $_POST['NombreTabla'];
      $TipoTabla     = $_POST['TipoTabla'];

      MController($Modulo,'Accesos');
      $InstanciaAjax = new Accesos();
      $Respuesta     = $InstanciaAjax->ColumnasTabla($NombreTabla,$TipoTabla);
   break;

   case 'BotonesFormulario':
      $NombreFormulario = $_POST['NombreFormulario'];
      $NombreObjeto     = $_POST['NombreObjeto'];

      MController($Modulo,'Accesos');
      $InstanciaAjax = new Accesos();
      $Respuesta     = $InstanciaAjax->BotonesFormulario($NombreFormulario,$NombreObjeto);
   break;

   case 'DivFormulario':
      $NombreFormulario = $_POST['NombreFormulario'];
      $NombreObjeto     = $_POST['NombreObjeto'];

      MController($Modulo,'Accesos');
      $InstanciaAjax = new Accesos();
      $Respuesta     = $InstanciaAjax->DivFormulario($NombreFormulario,$NombreObjeto);
   break;

   case 'MostrarDiv':
      $NombreFormulario = $_POST['NombreFormulario'];
      $NombreObjeto     = $_POST['NombreObjeto'];
      $Dato             = $_POST['Dato'];

      MController($Modulo,'Accesos');
      $InstanciaAjax = new Accesos();
      $Respuesta     = $InstanciaAjax->MostrarDiv($NombreFormulario,$NombreObjeto,$Dato);
   break;

   case 'CalculoFecha':
      $inicio= $_POST['inicio'];
      $calculo = $_POST['calculo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CalculoFecha($inicio,$calculo);
   break;

   case 'DiferenciaFecha':
      $inicio  = $_POST['inicio'];
      $final   = $_POST['final'];
      $dias    = $_POST['dias'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->DiferenciaFecha($inicio,$final,$dias);
   break;

   case 'BuscarDataBD':
      $TablaBD    = $_POST['TablaBD'];
      $CampoBD    = $_POST['CampoBD'];
      $DataBuscar = $_POST['DataBuscar'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);
   break;

   case 'DocumentRoot':
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->DocumentRoot();
   break;

   case 'descargar_solicitudes':
      $fecha_inicio  = $_POST['fecha_inicio'];
      $fecha_termino = $_POST['fecha_termino'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->descargar_solicitudes($fecha_inicio, $fecha_termino);
   break;

   case 'select_roles':
      $roles_perfil = $_POST['roles_perfil'];
      $roles_campo = $_POST['roles_campo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->select_roles($roles_perfil, $roles_campo);
   break;

   case 'SelectTipos':
      $operacion  = $_POST['operacion'];
      $tipo       = $_POST['tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->SelectTipos($operacion,$tipo);
   break;

   case 'permisos':
      $objeto = $_POST['objeto'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->permisos($objeto);
   break;

   case 'leer_solicitudes':
      $fecha_inicio  = $_POST['fecha_inicio'];
      $fecha_termino = $_POST['fecha_termino'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->leer_solicitudes($fecha_inicio, $fecha_termino);
   break;

   case 'leer_solicitudes_activas':
      $fecha_inicio  = $_POST['fecha_inicio'];
      $fecha_termino = $_POST['fecha_termino'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->leer_solicitudes_activas($fecha_inicio, $fecha_termino);
   break;

   case 'crear_solicitudes':
      $solicitudes_id          = $_POST['solicitudes_id'];
      $soli_fecha_ingreso      = $_POST['soli_fecha_ingreso'];
      $soli_fecha_recepcion    = $_POST['soli_fecha_recepcion'];
      $soli_tipo               = $_POST['soli_tipo'];    
      $soli_codigo_adm         = $_POST['soli_codigo_adm'];
      $soli_dni                = $_POST['soli_dni'];    
      $soli_apellidos_nombres  = $_POST['soli_apellidos_nombres'];
      $soli_fecha_inicio       = $_POST['soli_fecha_inicio'];
      $soli_fecha_fin          = $_POST['soli_fecha_fin'];
      $soli_descripcion        = strtoupper($_POST['soli_descripcion']);
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->crear_solicitudes($solicitudes_id, $soli_fecha_ingreso, $soli_fecha_recepcion, $soli_tipo, $soli_codigo_adm, $soli_dni, $soli_apellidos_nombres, $soli_fecha_inicio, $soli_fecha_fin, $soli_descripcion);
   break;

   case 'editar_solicitudes':
      $solicitudes_id          = $_POST['solicitudes_id'];
      $soli_fecha_ingreso      = $_POST['soli_fecha_ingreso'];
      $soli_fecha_recepcion    = $_POST['soli_fecha_recepcion'];
      $soli_tipo               = $_POST['soli_tipo'];    
      $soli_codigo_adm         = $_POST['soli_codigo_adm'];
      $soli_dni                = $_POST['soli_dni'];    
      $soli_apellidos_nombres  = $_POST['soli_apellidos_nombres'];
      $soli_fecha_inicio       = $_POST['soli_fecha_inicio'];
      $soli_fecha_fin          = $_POST['soli_fecha_fin'];
      $soli_descripcion        = strtoupper($_POST['soli_descripcion']);
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_solicitudes($solicitudes_id, $soli_fecha_ingreso, $soli_fecha_recepcion, $soli_tipo, $soli_codigo_adm, $soli_dni, $soli_apellidos_nombres, $soli_fecha_inicio, $soli_fecha_fin, $soli_descripcion);
   break;

   case 'estado_solicitudes':
      $solicitudes_id         = $_POST['solicitudes_id'];
      $soli_estado            = $_POST['soli_estado'];
      $soli_detalle_respuesta = strtoupper($_POST['soli_detalle_respuesta']);
      $soli_respuesta         = $_POST['soli_respuesta'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->estado_solicitudes($solicitudes_id, $soli_estado, $soli_detalle_respuesta, $soli_respuesta);
   break;

   case 'borrar_solicitudes':
      $solicitudes_id = $_POST['solicitudes_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->borrar_solicitudes($solicitudes_id);
   break;

   case 'pdf_solicitudes':
      $solicitudes_id = $_POST['solicitudes_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->pdf_solicitudes($solicitudes_id);
   break;

   case 'grabar_pdf_solicitudes':
      $solicitudes_id   = $_POST['solicitudes_id'];
      $soli_pdf         = addslashes(file_get_contents($_FILES['soli_pdf']['tmp_name']));
         
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->grabar_pdf_solicitudes($solicitudes_id,$soli_pdf);
   break;

   case 'validacion_solicitudes':
      $fecha_ingreso    = $_POST['fecha_ingreso'];
      $fecha_recepcion  = $_POST['fecha_recepcion'];
      $fecha_inicio     = $_POST['fecha_inicio'];
      $dni              = $_POST['dni'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->validacion_solicitudes($fecha_ingreso, $fecha_recepcion, $fecha_inicio, $dni);
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
   
   default: header('Location: /inicio');
}

?>