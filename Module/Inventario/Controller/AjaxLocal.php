<?php
$Modulo = "Inventario";
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
      $Dato1=$_POST['Dato1'];
      $Dato2=$_POST['Dato2'];

      MController($Modulo,'Accesos');
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->MostrarDiv($NombreFormulario,$NombreObjeto,$Dato1,$Dato2);
   break;

   case 'MostrarObjetos':
      $NombresObjetos = $_POST['NombresObjetos'];
      $Accion = $_POST['Accion'];

      MController($Modulo,'Accesos');
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->MostrarObjetos($NombresObjetos,$Accion);
   break;

   case 'SelectTipos':
      $tc_operacion= $_POST['tc_operacion'];
      $tc_tipo = $_POST['tc_tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectTipos($tc_operacion,$tc_tipo);
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

   case 'AutoCompletar':
      $NombreTabla= $_POST['NombreTabla'];
      $NombreCampo = $_POST['NombreCampo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->AutoCompletar($NombreTabla,$NombreCampo);
   break;

   case 'BuscarMaterialid':
      $material_id = $_POST['material_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->BuscarMaterialid($material_id);
   break;

   case 'BuscarMaterialDescripcion':
      $material_descripcion = $_POST['material_descripcion'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->BuscarMaterialDescripcion($material_descripcion);
   break;

   case 'DocumentRoot':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DocumentRoot();
   break;

   case 'usuario_nombre':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->usuario_nombre();
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

   case 'select_almacen':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->select_almacen();
   break;

   case 'leer_inventario_registro':
      $fecha_inicio_movimiento = $_POST['fecha_inicio_movimiento'];
      $fecha_termino_movimiento = $_POST['fecha_termino_movimiento'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->leer_inventario_registro($fecha_inicio_movimiento,$fecha_termino_movimiento);
   break;

   case 'cargar_materiales_entrada':
      $entrada_id = $_POST['entrada_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->cargar_materiales_entrada($entrada_id);
   break;

   case 'importar_materiales_entrada':
      $tipo_documento = $_POST['tipo_documento'];
      $nro_documento = $_POST['nro_documento'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->importar_materiales_entrada($tipo_documento, $nro_documento);
   break;

   case "leer_almacen":
      MModel($Modulo,"CRUD");
      $InstanciaAjax = new CRUD;
      $Respuesta = $InstanciaAjax->leer_almacen();
   break;

   case 'crear_almacen':
      $almacen_id = $_POST['almacen_id'];    
      $alm_fecha_creacion = $_POST['alm_fecha_creacion'];
      $alm_descripcion = strtoupper($_POST['alm_descripcion']);
      $alm_ubicacion = strtoupper($_POST['alm_ubicacion']);
      $alm_dimensiones = strtoupper($_POST['alm_dimensiones']);
      $alm_nombre_responsable = $_POST['alm_nombre_responsable'];
      $alm_estado = $_POST['alm_estado'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->crear_almacen($almacen_id, $alm_fecha_creacion, $alm_descripcion, $alm_ubicacion, $alm_dimensiones, $alm_nombre_responsable, $alm_estado);
   break;

   case 'editar_almacen':
      $almacen_id = $_POST['almacen_id'];    
      $alm_fecha_creacion = $_POST['alm_fecha_creacion'];
      $alm_descripcion = strtoupper($_POST['alm_descripcion']);
      $alm_ubicacion = strtoupper($_POST['alm_ubicacion']);
      $alm_dimensiones = strtoupper($_POST['alm_dimensiones']);
      $alm_nombre_responsable = $_POST['alm_nombre_responsable'];
      $alm_estado = $_POST['alm_estado'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->editar_almacen($almacen_id, $alm_fecha_creacion, $alm_descripcion, $alm_ubicacion, $alm_dimensiones, $alm_nombre_responsable, $alm_estado);
   break;

   case "leer_material_almacen":
      $malm_descripcion_almacen = $_POST['malm_descripcion_almacen'];

      MModel($Modulo,"CRUD");
      $InstanciaAjax = new CRUD;
      $Respuesta = $InstanciaAjax->leer_material_almacen($malm_descripcion_almacen);
   break;

   case 'crear_entrada_inventario':
      $entrada_id                = $_POST['entrada_id'];
      $ent_fecha_creacion        = $_POST['ent_fecha_creacion'];
      $ent_almacen_descripcion   = $_POST['ent_almacen_descripcion'];
      $ent_tipo_movimiento       = $_POST['ent_tipo_movimiento'];
      $ent_tipo_documento        = $_POST['ent_tipo_documento'];
      $ent_nro_documento         = $_POST['ent_nro_documento'];
      $ent_nombre_entrega        = strtoupper($_POST['ent_nombre_entrega']);
      $ent_centro_costo          = $_POST['ent_centro_costo'];
      $obs_ent_log               = strtoupper($_POST['obs_ent_log']);
      $array_data                = json_decode($_POST['array_data'],true);
  
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->crear_entrada_inventario($entrada_id, $ent_fecha_creacion, $ent_almacen_descripcion, $ent_tipo_movimiento, $ent_tipo_documento, $ent_nro_documento, $ent_nombre_entrega, $ent_centro_costo, $obs_ent_log, $array_materiales_entrada);
   break;

   case 'editar_entrada_inventario':
      $entrada_id                = $_POST['entrada_id'];
      $ent_fecha_creacion        = $_POST['ent_fecha_creacion'];
      $ent_almacen_descripcion   = $_POST['ent_almacen_descripcion'];
      $ent_tipo_movimiento       = $_POST['ent_tipo_movimiento'];
      $ent_tipo_documento        = $_POST['ent_tipo_documento'];
      $ent_nro_documento         = $_POST['ent_nro_documento'];
      $ent_nombre_entrega        = strtoupper($_POST['ent_nombre_entrega']);
      $ent_centro_costo          = $_POST['ent_centro_costo'];
      $obs_ent_log               = strtoupper($_POST['obs_ent_log']);
      $array_data                = json_decode($_POST['array_data'],true);
  
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->editar_entrada_inventario($entrada_id, $ent_fecha_creacion, $ent_almacen_descripcion, $ent_tipo_movimiento, $ent_tipo_documento, $ent_nro_documento, $ent_nombre_entrega, $ent_centro_costo, $obs_ent_log, $array_data);
   break;

   default: header('Location: /inicio');
}