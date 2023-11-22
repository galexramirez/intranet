<?php
$Accion = $_POST['Accion'];
$Modulo = "inspeccion_flota";   

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
      $InstanciaAjax = new Accesos();
      $Respuesta     = $InstanciaAjax->MostrarDiv($NombreFormulario,$NombreObjeto,$Dato);
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

   case 'select_codigo_inspeccion':
      $insp_bus_tipo = $_POST['insp_bus_tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->select_codigo_inspeccion($insp_bus_tipo);
   break;

   case 'BuscarDataBD':
      $TablaBD    = $_POST['TablaBD'];
      $CampoBD    = $_POST['CampoBD'];
      $DataBuscar = $_POST['DataBuscar'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);
   break;

   case 'buscar_data_bd':
      $tabla    = $_POST['tabla'];
      $c_where  = $_POST['c_where'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->buscar_data_bd($tabla, $c_where);
   break;

   case 'CalculoFecha':
      $inicio= $_POST['inicio'];
      $calculo = $_POST['calculo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CalculoFecha($inicio,$calculo);
   break;

   case 'CompararFechaActual':
      $fecha = $_POST['fecha'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CompararFechaActual($fecha);
   break;

   case 'DiferenciaFecha':
      $inicio= $_POST['inicio'];
      $final = $_POST['final'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DiferenciaFecha($inicio,$final);
   break;

   case 'dias_diferencia_fechas':
      $inicio= $_POST['inicio'];
      $final = $_POST['final'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->dias_diferencia_fechas($inicio,$final);
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

   case 'DocumentRoot':
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->DocumentRoot();
   break;

   case 'buscar_dato':
      $nombre_tabla     = $_POST['nombre_tabla'];
      $campo_buscar     = $_POST['campo_buscar'];
      $condicion_where  = $_POST['condicion_where'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->buscar_dato($nombre_tabla, $campo_buscar, $condicion_where);
   break;

   case 'contar_dato':
      $nombre_tabla     = $_POST['nombre_tabla'];
      $campo_buscar     = $_POST['campo_buscar'];
      $condicion_where  = $_POST['condicion_where'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->contar_dato($nombre_tabla, $campo_buscar, $condicion_where);
   break;

   case 'buscar_inspeccion': 
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_termino = $_POST['fecha_termino'];
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->buscar_inspeccion($fecha_inicio, $fecha_termino);
   break;

   case 'crear_inspeccion': 
      $insp_fecha_programada = $_POST['insp_fecha_programada'];
      $insp_bus_tipo         = $_POST['insp_bus_tipo'];
      $insp_seleccion_buses  = $_POST['insp_seleccion_buses'];
      $a_data                = json_decode($_POST['a_data']);
       
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta=$InstanciaAjax->crear_inspeccion($insp_bus_tipo, $insp_fecha_programada, $insp_seleccion_buses, $a_data);
   break;

   case 'cerrar_inspeccion': 
      $inspeccion_id = $_POST['inspeccion_id'];
       
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta=$InstanciaAjax->cerrar_inspeccion($inspeccion_id);
   break;

   case 'anular_inspeccion': 
      $inspeccion_id = $_POST['inspeccion_id'];
       
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta=$InstanciaAjax->anular_inspeccion($inspeccion_id);
   break;

   case 'buscar_inspeccion_bus':
      $inspeccion_id = $_POST['inspeccion_id'];
      $insp_bus = $_POST['insp_bus'];
      $tipo_data = $_POST['tipo_data'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta=$InstanciaAjax->buscar_inspeccion_bus($inspeccion_id, $insp_bus, $tipo_data);
   break;

   case 'guardar_inspeccion_bus': 
      $a_data_bus = json_decode($_POST['a_data_bus']);
      $a_data_movimiento = json_decode($_POST['a_data_movimiento']);
       
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta=$InstanciaAjax->guardar_inspeccion_bus($a_data_bus, $a_data_movimiento);
   break;

   case 'crear_falla': 
      $inspeccion_id    = $_POST['inspeccion_id']; 
      $insp_bus_tipo    = $_POST['insp_bus_tipo']; 
      $insp_bus         = $_POST['insp_bus']; 
      $insp_codigo      = $_POST['insp_codigo']; 
      $insp_descripcion = $_POST['insp_descripcion']; 
      $insp_componente  = $_POST['insp_componente']; 
      $insp_posicion    = $_POST['insp_posicion']; 
      $insp_falla       = $_POST['insp_falla']; 
      $insp_accion      = $_POST['insp_accion'];
       
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta=$InstanciaAjax->crear_falla($inspeccion_id, $insp_bus_tipo, $insp_bus, $insp_codigo, $insp_descripcion, $insp_componente, $insp_posicion, $insp_falla, $insp_accion);
   break;

   case 'anular_falla': 
      $inspeccion_movimiento_id = $_POST['inspeccion_movimiento_id'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta=$InstanciaAjax->anular_falla($inspeccion_movimiento_id);
   break;

   case 'buscar_inspeccion_codigo':
      $insp_bus_tipo = $_POST['insp_bus_tipo'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->buscar_inspeccion_codigo($insp_bus_tipo);
   break;

   case 'crear_inspeccion_codigo': 
      $insp_bus_tipo    = $_POST['insp_bus_tipo'];
      $insp_orden       = $_POST['insp_orden'];
      $insp_codigo      = $_POST['insp_codigo'];
      $insp_descripcion = strtoupper($_POST['insp_descripcion']);
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->crear_inspeccion_codigo($insp_bus_tipo, $insp_orden, $insp_codigo, $insp_descripcion);
   break;

   case 'editar_inspeccion_codigo': 
      $inspeccion_codigo_id = $_POST['inspeccion_codigo_id'];
      $insp_bus_tipo        = $_POST['insp_bus_tipo'];
      $insp_orden           = $_POST['insp_orden'];
      $insp_codigo          = $_POST['insp_codigo'];
      $insp_descripcion     = strtoupper($_POST['insp_descripcion']);
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->editar_inspeccion_codigo($inspeccion_codigo_id, $insp_bus_tipo, $insp_orden, $insp_codigo, $insp_descripcion);
   break;

   case 'borrar_inspeccion_codigo': 
      $insp_bus_tipo = $_POST['insp_bus_tipo'];
      $insp_codigo   = $_POST['insp_codigo'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->borrar_inspeccion_codigo($insp_bus_tipo, $insp_codigo);
   break;

   case 'descargar_arbol': 
      $insp_bus_tipo = $_POST['insp_bus_tipo'];
       
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->descargar_arbol($insp_bus_tipo);
   break;

   case 'buscar_inspeccion_componente':
      $insp_bus_tipo = $_POST['insp_bus_tipo'];
      $insp_codigo = $_POST['insp_codigo'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->buscar_inspeccion_componente($insp_bus_tipo, $insp_codigo);
   break;

   case 'crear_inspeccion_componente': 
      $insp_bus_tipo    = $_POST['insp_bus_tipo'];
      $insp_codigo      = $_POST['insp_codigo'];
      $insp_componente  = strtoupper($_POST['insp_componente']);
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->crear_inspeccion_componente($insp_bus_tipo, $insp_codigo, $insp_componente);
   break;

   case 'editar_inspeccion_componente': 
      $inspeccion_componente_id = $_POST['inspeccion_componente_id'];
      $insp_bus_tipo          = $_POST['insp_bus_tipo'];
      $insp_codigo            = $_POST['insp_codigo'];
      $insp_componente        = strtoupper($_POST['insp_componente']);
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->editar_inspeccion_componente($inspeccion_componente_id, $insp_bus_tipo, $insp_codigo, $insp_componente);
   break;

   case 'borrar_inspeccion_componente':
      $insp_bus_tipo = $_POST['insp_bus_tipo'];
      $insp_codigo   = $_POST['insp_codigo'];
      $insp_componente = $_POST['insp_componente'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->borrar_inspeccion_componente($insp_bus_tipo, $insp_codigo ,$insp_componente);
   break;

   case 'buscar_inspeccion_falla_accion':
      $insp_bus_tipo = $_POST['insp_bus_tipo'];
      $insp_codigo = $_POST['insp_codigo'];
      $insp_componente = $_POST['insp_componente'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->buscar_inspeccion_falla_accion($insp_bus_tipo, $insp_codigo, $insp_componente);
   break;

   case 'crear_inspeccion_falla_accion': 
      $insp_bus_tipo    = $_POST['insp_bus_tipo'];
      $insp_codigo      = $_POST['insp_codigo'];
      $insp_componente  = $_POST['insp_componente'];
      $insp_falla       = $_POST['insp_falla'];
      $insp_accion      = $_POST['insp_accion'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->crear_inspeccion_falla_accion($insp_bus_tipo, $insp_codigo, $insp_componente, $insp_falla, $insp_accion);
   break;

   case 'editar_inspeccion_falla_accion': 
      $inspeccion_falla_accion_id = $_POST['inspeccion_falla_accion_id'];
      $insp_bus_tipo    = $_POST['insp_bus_tipo'];
      $insp_codigo      = $_POST['insp_codigo'];
      $insp_componente  = $_POST['insp_componente'];
      $insp_falla       = $_POST['insp_falla'];
      $insp_accion      = $_POST['insp_accion'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->editar_inspeccion_falla_accion($inspeccion_falla_accion_id, $insp_bus_tipo, $insp_codigo, $insp_componente, $insp_falla, $insp_accion);
   break;

   case 'borrar_inspeccion_falla_accion': 
      $inspeccion_falla_accion_id = $_POST['inspeccion_falla_accion_id'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->borrar_inspeccion_falla_accion($inspeccion_falla_accion_id);
   break;

   case 'buscar_inspeccion_posicion':
      $insp_bus_tipo = $_POST['insp_bus_tipo'];
      $insp_codigo = $_POST['insp_codigo'];
      $insp_componente = $_POST['insp_componente'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->buscar_inspeccion_posicion($insp_bus_tipo, $insp_codigo, $insp_componente);
   break;

   case 'crear_inspeccion_posicion': 
      $insp_bus_tipo    = $_POST['insp_bus_tipo'];
      $insp_codigo      = $_POST['insp_codigo'];
      $insp_componente  = strtoupper($_POST['insp_componente']);
      $insp_posicion    = strtoupper($_POST['insp_posicion']);
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->crear_inspeccion_posicion($insp_bus_tipo, $insp_codigo, $insp_componente, $insp_posicion);
   break;

   case 'editar_inspeccion_posicion': 
      $inspeccion_posicion_id = $_POST['inspeccion_posicion_id'];
      $insp_bus_tipo          = $_POST['insp_bus_tipo'];
      $insp_codigo            = $_POST['insp_codigo'];
      $insp_componente        = strtoupper($_POST['insp_componente']);
      $insp_posicion          = strtoupper($_POST['insp_posicion']);
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->editar_inspeccion_posicion($inspeccion_posicion_id, $insp_bus_tipo, $insp_codigo, $insp_componente, $insp_posicion);
   break;

   case 'borrar_inspeccion_posicion': 
      $inspeccion_posicion_id = $_POST['inspeccion_posicion_id'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->borrar_inspeccion_posicion($inspeccion_posicion_id);
   break;

   case 'buscar_reporte':
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_termino = $_POST['fecha_termino'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta=$InstanciaAjax->buscar_reporte($fecha_inicio, $fecha_termino);
   break;

   case 'buscar_reporte_bus':
      $inspeccion_id = $_POST['inspeccion_id'];
      $insp_bus = $_POST['insp_bus'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta=$InstanciaAjax->buscar_reporte_bus($inspeccion_id, $insp_bus);
   break;

   case 'buscar_falla':
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_termino = $_POST['fecha_termino'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta=$InstanciaAjax->buscar_falla($fecha_inicio, $fecha_termino);
   break;

   case 'leer_tc_inspeccion_usuario':
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_tc_inspeccion_usuario();
   break;

   case 'crear_tc_inspeccion_usuario':
      $tc_inspeccion_id = $_POST['tc_inspeccion_id'];
      $tc_ficha         = strtoupper($_POST['tc_ficha']);
      $tc_categoria1    = strtoupper($_POST['tc_categoria1']);
      $tc_categoria2    = strtoupper($_POST['tc_categoria2']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->crear_tc_inspeccion_usuario($tc_inspeccion_id, $tc_ficha, $tc_categoria1, $tc_categoria2);
   break;

   case 'editar_tc_inspeccion_usuario':
      $tc_inspeccion_id = $_POST['tc_inspeccion_id'];
      $tc_ficha         = strtoupper($_POST['tc_ficha']);
      $tc_categoria1    = strtoupper($_POST['tc_categoria1']);
      $tc_categoria2    = strtoupper($_POST['tc_categoria2']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_tc_inspeccion_usuario($tc_inspeccion_id, $tc_ficha, $tc_categoria1, $tc_categoria2);
   break;

   case 'borrar_tc_inspeccion_usuario':
      $tc_inspeccion_id=$_POST['tc_inspeccion_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->borrar_tc_inspeccion_usuario($tc_inspeccion_id);
   break;

   case 'leer_tc_inspeccion_sistema':
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_tc_inspeccion_sistema();
   break;

   case 'crear_tc_inspeccion_sistema':
      $tc_inspeccion_id = $_POST['tc_inspeccion_id'];
      $tc_ficha         = strtoupper($_POST['tc_ficha']);
      $tc_categoria1    = strtoupper($_POST['tc_categoria1']);
      $tc_categoria2    = strtoupper($_POST['tc_categoria2']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->crear_tc_inspeccion_sistema($tc_inspeccion_id, $tc_ficha, $tc_categoria1, $tc_categoria2);
   break;

   case 'editar_tc_inspeccion_sistema':
      $tc_inspeccion_id = $_POST['tc_inspeccion_id'];
      $tc_ficha         = strtoupper($_POST['tc_ficha']);
      $tc_categoria1    = strtoupper($_POST['tc_categoria1']);
      $tc_categoria2    = strtoupper($_POST['tc_categoria2']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_tc_inspeccion_sistema($tc_inspeccion_id, $tc_ficha, $tc_categoria1, $tc_categoria2);
   break;

   case 'borrar_tc_inspeccion_sistema':
      $tc_inspeccion_id=$_POST['tc_inspeccion_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->borrar_tc_inspeccion_sistema($tc_inspeccion_id);
   break;

   default: header('Location: /inicio');
}