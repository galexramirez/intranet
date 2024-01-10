<?php
$Modulo = "vale";
// Accion declarada en el JS
$Accion=$_POST['Accion'];   

// Define la accion de JS
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
      $Dato1            = $_POST['Dato1'];
      $Dato2            = $_POST['Dato2'];

      MController($Modulo,'Accesos');
      $InstanciaAjax = new Accesos();
      $Respuesta     = $InstanciaAjax->MostrarDiv($NombreFormulario, $NombreObjeto, $Dato1, $Dato2);
   break;

   case 'select_roles':
      $roles_perfil  = $_POST['roles_perfil'];
      $roles_campo   = $_POST['roles_campo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->select_roles($roles_perfil, $roles_campo);
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

   case 'CalculoFecha':
      $inicio= $_POST['inicio'];
      $calculo = $_POST['calculo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CalculoFecha($inicio,$calculo);
   break;

   case 'DiferenciaFecha':
      $inicio= $_POST['inicio'];
      $final = $_POST['final'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DiferenciaFecha($inicio,$final);
   break;

   case 'DocumentRoot':
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->DocumentRoot();
   break;

   case 'leer_vale':
      $fecha_inicio_listado = $_POST['fecha_inicio_listado'];
      $fecha_termino_listado = $_POST['fecha_termino_listado'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->leer_vale($fecha_inicio_listado, $fecha_termino_listado);
   break;

   case 'generar_vale':
      $vale_id          = $_POST['vale_id'];
      $va_ot_id         = $_POST['va_ot_id'];
      $va_genera        = $_POST['va_genera'];
      $va_date_genera   = $_POST['va_date_genera'];
      $va_asociado      = $_POST['va_asociado'];
      $va_responsable   = $_POST['va_responsable'];
      $va_garantia      = $_POST['va_garantia'];
      $va_obs_cgm       = strtoupper($_POST['va_obs_cgm']);
      $tva_obs_aom      = strtoupper($_POST['tva_obs_aom']);
      $va_obs_aom       = strtoupper($_POST['va_obs_aom']);
      $va_estado        = $_POST['va_estado'];
      $va_tipo          = $_POST['va_tipo'];
      $array_data       = json_decode($_POST['array_data'],true);

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->generar_vale($vale_id, $va_ot_id, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $tva_obs_aom, $va_obs_aom, $va_estado, $va_tipo, $array_data);
   break;

   case 'editar_vale':
      $vale_id         = $_POST['vale_id'];
      $va_ot_id            = $_POST['va_ot_id'];
      $va_genera        = $_POST['va_genera'];
      $va_date_genera   = $_POST['va_date_genera'];
      $va_asociado      = $_POST['va_asociado'];
      $va_responsable   = $_POST['va_responsable'];
      $va_garantia      = $_POST['va_garantia'];
      $va_obs_cgm       = $_POST['va_obs_cgm'];
      $tva_obs_aom      = $_POST['tva_obs_aom'];
      $va_obs_aom       = $_POST['va_obs_aom'];
      $va_estado        = $_POST['va_estado'];
      $va_tipo          = $_POST['va_tipo'];
      $array_data       = json_decode($_POST['array_data'],true);

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->editar_vale($vale_id, $va_ot_id, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $tva_obs_aom, $va_obs_aom, $va_estado, $va_tipo, $array_data);
   break;

   case 'cargar_vale':
      $vale_id = $_POST['vale_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->cargar_vale($vale_id);
   break;

   case 'cargar_repuestos':
      $vale_id = $_POST['vale_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->cargar_repuestos($vale_id);
   break;

   case 'AutoCompletar':
      $NombreTabla      = $_POST['NombreTabla'];
      $NombreCampo      = $_POST['NombreCampo'];
      $va_asociado      = $_POST['va_asociado'];
      $va_date_genera   = substr($_POST['va_date_genera'],0,10);
      $va_tipo          = $_POST['va_tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->AutoCompletar($NombreTabla,$NombreCampo, $va_asociado, $va_date_genera, $va_tipo);
   break;

   case 'BuscarCodigoRepuesto':
      $vr_repuesto      = $_POST['vr_repuesto'];
      $va_asociado      = $_POST['va_asociado'];
      $va_date_genera   = $_POST['va_date_genera'];
      $va_tipo          = $_POST['va_tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->BuscarCodigoRepuesto($vr_repuesto, $va_asociado, $va_date_genera, $va_tipo);
   break;

   case 'descargar_vale':
      $fecha_inicio_listado    = $_POST['fecha_inicio_listado'];
      $fecha_termino_listado   = $_POST['fecha_termino_listado'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->descargar_vale($fecha_inicio_listado,$fecha_termino_listado);
   break;

   case 'vales_observados':
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->vales_observados();
   break;

   case 'leer_tc_vale_usuario':
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_tc_vale_usuario();
   break;

   case 'crear_tc_vale_usuario':
      $tc_vale_id = $_POST['tc_vale_id'];
      $tc_categoria1 = strtoupper($_POST['tc_categoria1']);
      $tc_categoria2 = strtoupper($_POST['tc_categoria2']);
      $tc_categoria3 = strtoupper($_POST['tc_categoria3']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->crear_tc_vale_usuario($tc_vale_id, $tc_categoria1, $tc_categoria2, $tc_categoria3);
   break;

   case 'editar_tc_vale_usuario':
      $tc_vale_id = $_POST['tc_vale_id'];
      $tc_categoria1 = strtoupper($_POST['tc_categoria1']);
      $tc_categoria2 = strtoupper($_POST['tc_categoria2']);
      $tc_categoria3 = strtoupper($_POST['tc_categoria3']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_tc_vale_usuario($tc_vale_id, $tc_categoria1, $tc_categoria2, $tc_categoria3);
   break;

   case 'borrar_tc_vale_usuario':
      $tc_vale_id=$_POST['tc_vale_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->borrar_tc_vale_usuario($tc_vale_id);
   break;

   case 'leer_tc_vale_sistema':
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_tc_vale_sistema();
   break;

   case 'crear_tc_vale_sistema':
      $tc_vale_id = $_POST['tc_vale_id'];
      $tc_categoria1 = strtoupper($_POST['tc_categoria1']);
      $tc_categoria2 = strtoupper($_POST['tc_categoria2']);
      $tc_categoria3 = strtoupper($_POST['tc_categoria3']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->crear_tc_vale_sistema($tc_vale_id, $tc_categoria1, $tc_categoria2, $tc_categoria3);
   break;

   case 'editar_tc_vale_sistema':
      $tc_vale_id = $_POST['tc_vale_id'];
      $tc_categoria1 = strtoupper($_POST['tc_categoria1']);
      $tc_categoria2 = strtoupper($_POST['tc_categoria2']);
      $tc_categoria3 = strtoupper($_POST['tc_categoria3']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_tc_vale_sistema($tc_vale_id, $tc_categoria1, $tc_categoria2, $tc_categoria3);
   break;

   case 'borrar_tc_vale_sistema':
      $tc_vale_id=$_POST['tc_vale_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->borrar_tc_vale_sistema($tc_vale_id);
   break;
   default: header('Location: /inicio');
}