<?php
$Accion = $_POST['Accion'];
$Modulo = "check_list";   

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
      $order_by         = $_POST['order_by'];   

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->select_combo($nombre_tabla, $es_campo_unico, $campo_select, $campo_inicial, $condicion_where, $order_by);
   break;

   case 'select_codigo_check_list':
      $chl_bus_tipo = $_POST['chl_bus_tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->select_codigo_check_list($chl_bus_tipo);
   break;

   case 'select_codigo_falla_via':
      $fav_bus_tipo = $_POST['fav_bus_tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->select_codigo_falla_via($fav_bus_tipo);
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

   case 'buscar_check_list': 
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_termino = $_POST['fecha_termino'];
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->buscar_check_list($fecha_inicio, $fecha_termino);
   break;

   case 'buscar_check_list_observaciones': 
      $check_list_id = $_POST['check_list_id'];
     
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->buscar_check_list_observaciones($check_list_id);
   break;

   case 'buscar_check_list_falla_via': 
      $check_list_id = $_POST['check_list_id'];
     
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta = $InstanciaAjax->buscar_check_list_falla_via($check_list_id);
   break;

   case 'crear_check_list_registro':
      $check_list_id    = $_POST['check_list_id'];
      $chl_fecha        = $_POST['chl_fecha'];
      $chl_bus          = $_POST['chl_bus'];
      $chl_kilometraje  = $_POST['chl_kilometraje'];
      $chl_nombre_piloto     = $_POST['chl_nombre_piloto'];
      $chl_estado            = $_POST['chl_estado'];
      $a_data_observaciones  = json_decode($_POST['a_data_observaciones']);
      $a_data_falla_via  = json_decode($_POST['a_data_falla_via']);

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->crear_check_list_registro($check_list_id, $chl_fecha, $chl_bus, $chl_kilometraje, $chl_nombre_piloto, $chl_estado, $a_data_observaciones, $a_data_falla_via);
   break;

   case 'editar_check_list_registro':
      $check_list_id    = $_POST['check_list_id'];
      $chl_fecha        = $_POST['chl_fecha'];
      $chl_bus          = $_POST['chl_bus'];
      $chl_kilometraje  = $_POST['chl_kilometraje'];
      $chl_nombre_piloto     = $_POST['chl_nombre_piloto'];
      $chl_estado            = $_POST['chl_estado'];
      $a_data_observaciones  = json_decode($_POST['a_data_observaciones']);
      $a_data_falla_via  = json_decode($_POST['a_data_falla_via']);

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->editar_check_list_registro($check_list_id, $chl_fecha, $chl_bus, $chl_kilometraje, $chl_nombre_piloto, $chl_estado, $a_data_observaciones, $a_data_falla_via);
   break;

   case 'cerrar_check_list_registro':
      $check_list_id    = $_POST['check_list_id'];

      Mcontroller($Modulo, 'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->cerrar_check_list_registro($check_list_id);
   break;

   case 'anular_check_list_registro':
      $check_list_id    = $_POST['check_list_id'];

      Mcontroller($Modulo, 'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->anular_check_list_registro($check_list_id);
   break;

   case 'buscar_check_list_codigo':
      $chl_bus_tipo = $_POST['chl_bus_tipo'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->buscar_check_list_codigo($chl_bus_tipo);
   break;

   case 'crear_check_list_codigo': 
      $chl_bus_tipo    = $_POST['chl_bus_tipo'];
      $chl_orden       = $_POST['chl_orden'];
      $chl_codigo      = $_POST['chl_codigo'];
      $chl_descripcion = strtoupper($_POST['chl_descripcion']);
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->crear_check_list_codigo($chl_bus_tipo, $chl_orden, $chl_codigo, $chl_descripcion);
   break;

   case 'editar_check_list_codigo': 
      $check_list_codigo_id = $_POST['check_list_codigo_id'];
      $chl_bus_tipo        = $_POST['chl_bus_tipo'];
      $chl_orden           = $_POST['chl_orden'];
      $chl_codigo          = $_POST['chl_codigo'];
      $chl_descripcion     = strtoupper($_POST['chl_descripcion']);
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->editar_check_list_codigo($check_list_codigo_id, $chl_bus_tipo, $chl_orden, $chl_codigo, $chl_descripcion);
   break;

   case 'borrar_check_list_codigo': 
      $chl_bus_tipo = $_POST['chl_bus_tipo'];
      $chl_codigo   = $_POST['chl_codigo'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->borrar_check_list_codigo($chl_bus_tipo, $chl_codigo);
   break;

   case 'descargar_arbol': 
      $chl_bus_tipo = $_POST['chl_bus_tipo'];
       
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->descargar_arbol($chl_bus_tipo);
   break;

   case 'buscar_check_list_componente':
      $chl_bus_tipo = $_POST['chl_bus_tipo'];
      $chl_codigo = $_POST['chl_codigo'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->buscar_check_list_componente($chl_bus_tipo, $chl_codigo);
   break;

   case 'crear_check_list_componente': 
      $chl_bus_tipo    = $_POST['chl_bus_tipo'];
      $chl_codigo      = $_POST['chl_codigo'];
      $chl_componente  = strtoupper($_POST['chl_componente']);
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->crear_check_list_componente($chl_bus_tipo, $chl_codigo, $chl_componente);
   break;

   case 'editar_check_list_componente': 
      $check_list_componente_id = $_POST['check_list_componente_id'];
      $chl_bus_tipo          = $_POST['chl_bus_tipo'];
      $chl_codigo            = $_POST['chl_codigo'];
      $chl_componente        = strtoupper($_POST['chl_componente']);
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->editar_check_list_componente($check_list_componente_id, $chl_bus_tipo, $chl_codigo, $chl_componente);
   break;

   case 'borrar_check_list_componente':
      $chl_bus_tipo = $_POST['chl_bus_tipo'];
      $chl_codigo   = $_POST['chl_codigo'];
      $chl_componente = $_POST['chl_componente'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->borrar_check_list_componente($chl_bus_tipo, $chl_codigo ,$chl_componente);
   break;

   case 'buscar_check_list_falla_accion':
      $chl_bus_tipo = $_POST['chl_bus_tipo'];
      $chl_codigo = $_POST['chl_codigo'];
      $chl_componente = $_POST['chl_componente'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->buscar_check_list_falla_accion($chl_bus_tipo, $chl_codigo, $chl_componente);
   break;

   case 'crear_check_list_falla_accion': 
      $chl_bus_tipo    = $_POST['chl_bus_tipo'];
      $chl_codigo      = $_POST['chl_codigo'];
      $chl_componente  = $_POST['chl_componente'];
      $chl_falla       = $_POST['chl_falla'];
      $chl_accion      = $_POST['chl_accion'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->crear_check_list_falla_accion($chl_bus_tipo, $chl_codigo, $chl_componente, $chl_falla, $chl_accion);
   break;

   case 'editar_check_list_falla_accion': 
      $check_list_falla_accion_id = $_POST['check_list_falla_accion_id'];
      $chl_bus_tipo    = $_POST['chl_bus_tipo'];
      $chl_codigo      = $_POST['chl_codigo'];
      $chl_componente  = $_POST['chl_componente'];
      $chl_falla       = $_POST['chl_falla'];
      $chl_accion      = $_POST['chl_accion'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->editar_check_list_falla_accion($check_list_falla_accion_id, $chl_bus_tipo, $chl_codigo, $chl_componente, $chl_falla, $chl_accion);
   break;

   case 'borrar_check_list_falla_accion': 
      $check_list_falla_accion_id = $_POST['check_list_falla_accion_id'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->borrar_check_list_falla_accion($check_list_falla_accion_id);
   break;

   case 'buscar_check_list_posicion':
      $chl_bus_tipo = $_POST['chl_bus_tipo'];
      $chl_codigo = $_POST['chl_codigo'];
      $chl_componente = $_POST['chl_componente'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->buscar_check_list_posicion($chl_bus_tipo, $chl_codigo, $chl_componente);
   break;

   case 'crear_check_list_posicion': 
      $chl_bus_tipo    = $_POST['chl_bus_tipo'];
      $chl_codigo      = $_POST['chl_codigo'];
      $chl_componente  = strtoupper($_POST['chl_componente']);
      $chl_posicion    = strtoupper($_POST['chl_posicion']);
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->crear_check_list_posicion($chl_bus_tipo, $chl_codigo, $chl_componente, $chl_posicion);
   break;

   case 'editar_check_list_posicion': 
      $check_list_posicion_id = $_POST['check_list_posicion_id'];
      $chl_bus_tipo          = $_POST['chl_bus_tipo'];
      $chl_codigo            = $_POST['chl_codigo'];
      $chl_componente        = strtoupper($_POST['chl_componente']);
      $chl_posicion          = strtoupper($_POST['chl_posicion']);
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->editar_check_list_posicion($check_list_posicion_id, $chl_bus_tipo, $chl_codigo, $chl_componente, $chl_posicion);
   break;

   case 'borrar_check_list_posicion': 
      $check_list_posicion_id = $_POST['check_list_posicion_id'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->borrar_check_list_posicion($check_list_posicion_id);
   break;

   case 'buscar_falla_via_codigo':
      $fav_bus_tipo = $_POST['fav_bus_tipo'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->buscar_falla_via_codigo($fav_bus_tipo);
   break;

   case 'crear_falla_via_codigo': 
      $fav_bus_tipo    = $_POST['fav_bus_tipo'];
      $fav_orden       = $_POST['fav_orden'];
      $fav_codigo      = $_POST['fav_codigo'];
      $fav_descripcion = strtoupper($_POST['fav_descripcion']);
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->crear_falla_via_codigo($fav_bus_tipo, $fav_orden, $fav_codigo, $fav_descripcion);
   break;

   case 'editar_falla_via_codigo': 
      $falla_via_codigo_id = $_POST['falla_via_codigo_id'];
      $fav_bus_tipo        = $_POST['fav_bus_tipo'];
      $fav_orden           = $_POST['fav_orden'];
      $fav_codigo          = $_POST['fav_codigo'];
      $fav_descripcion     = strtoupper($_POST['fav_descripcion']);
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->editar_falla_via_codigo($falla_via_codigo_id, $fav_bus_tipo, $fav_orden, $fav_codigo, $fav_descripcion);
   break;

   case 'borrar_falla_via_codigo': 
      $fav_bus_tipo = $_POST['fav_bus_tipo'];
      $fav_codigo   = $_POST['fav_codigo'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->borrar_falla_via_codigo($fav_bus_tipo, $fav_codigo);
   break;

   case 'descargar_arbol_falla_via': 
      $fav_bus_tipo = $_POST['fav_bus_tipo'];
       
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->descargar_arbol_falla_via($fav_bus_tipo);
   break;

   case 'buscar_falla_via_componente':
      $fav_bus_tipo = $_POST['fav_bus_tipo'];
      $fav_codigo = $_POST['fav_codigo'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->buscar_falla_via_componente($fav_bus_tipo, $fav_codigo);
   break;

   case 'crear_falla_via_componente': 
      $fav_bus_tipo    = $_POST['fav_bus_tipo'];
      $fav_codigo      = $_POST['fav_codigo'];
      $fav_descripcion = strtoupper($_POST['fav_descripcion']);
      $fav_componente  = strtoupper($_POST['fav_componente']);
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->crear_falla_via_componente($fav_bus_tipo, $fav_codigo, $fav_descripcion, $fav_componente);
   break;

   case 'editar_falla_via_componente': 
      $falla_via_componente_id = $_POST['falla_via_componente_id'];
      $fav_bus_tipo          = $_POST['fav_bus_tipo'];
      $fav_codigo            = $_POST['fav_codigo'];
      $fav_descripcion       = strtoupper($_POST['fav_descripcion']);
      $fav_componente        = strtoupper($_POST['fav_componente']);
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->editar_falla_via_componente($falla_via_componente_id, $fav_bus_tipo, $fav_codigo, $fav_descripcion, $fav_componente);
   break;

   case 'borrar_falla_via_componente':
      $fav_bus_tipo = $_POST['fav_bus_tipo'];
      $fav_codigo   = $_POST['fav_codigo'];
      $fav_componente = $_POST['fav_componente'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->borrar_falla_via_componente($fav_bus_tipo, $fav_codigo ,$fav_componente);
   break;

   case 'buscar_falla_via_falla_accion':
      $fav_bus_tipo = $_POST['fav_bus_tipo'];
      $fav_codigo = $_POST['fav_codigo'];
      $fav_componente = $_POST['fav_componente'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->buscar_falla_via_falla_accion($fav_bus_tipo, $fav_codigo, $fav_componente);
   break;

   case 'crear_falla_via_falla_accion': 
      $fav_bus_tipo    = $_POST['fav_bus_tipo'];
      $fav_codigo      = $_POST['fav_codigo'];
      $fav_componente  = $_POST['fav_componente'];
      $fav_falla       = $_POST['fav_falla'];
      $fav_accion      = $_POST['fav_accion'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->crear_falla_via_falla_accion($fav_bus_tipo, $fav_codigo, $fav_componente, $fav_falla, $fav_accion);
   break;

   case 'editar_falla_via_falla_accion': 
      $falla_via_falla_accion_id = $_POST['falla_via_falla_accion_id'];
      $fav_bus_tipo    = $_POST['fav_bus_tipo'];
      $fav_codigo      = $_POST['fav_codigo'];
      $fav_componente  = $_POST['fav_componente'];
      $fav_falla       = $_POST['fav_falla'];
      $fav_accion      = $_POST['fav_accion'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->editar_falla_via_falla_accion($falla_via_falla_accion_id, $fav_bus_tipo, $fav_codigo, $fav_componente, $fav_falla, $fav_accion);
   break;

   case 'borrar_falla_via_falla_accion': 
      $falla_via_falla_accion_id = $_POST['falla_via_falla_accion_id'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->borrar_falla_via_falla_accion($falla_via_falla_accion_id);
   break;

   case 'buscar_falla_via_posicion':
      $fav_bus_tipo = $_POST['fav_bus_tipo'];
      $fav_codigo = $_POST['fav_codigo'];
      $fav_componente = $_POST['fav_componente'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->buscar_falla_via_posicion($fav_bus_tipo, $fav_codigo, $fav_componente);
   break;

   case 'crear_falla_via_posicion': 
      $fav_bus_tipo    = $_POST['fav_bus_tipo'];
      $fav_codigo      = $_POST['fav_codigo'];
      $fav_componente  = strtoupper($_POST['fav_componente']);
      $fav_posicion    = strtoupper($_POST['fav_posicion']);
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->crear_falla_via_posicion($fav_bus_tipo, $fav_codigo, $fav_componente, $fav_posicion);
   break;

   case 'editar_falla_via_posicion': 
      $falla_via_posicion_id = $_POST['falla_via_posicion_id'];
      $fav_bus_tipo          = $_POST['fav_bus_tipo'];
      $fav_codigo            = $_POST['fav_codigo'];
      $fav_componente        = strtoupper($_POST['fav_componente']);
      $fav_posicion          = strtoupper($_POST['fav_posicion']);
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->editar_falla_via_posicion($falla_via_posicion_id, $fav_bus_tipo, $fav_codigo, $fav_componente, $fav_posicion);
   break;

   case 'borrar_falla_via_posicion': 
      $falla_via_posicion_id = $_POST['falla_via_posicion_id'];
       
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->borrar_falla_via_posicion($falla_via_posicion_id);
   break;

   case 'buscar_reporte_falla':
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_termino = $_POST['fecha_termino'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta=$InstanciaAjax->buscar_reporte_falla($fecha_inicio, $fecha_termino);
   break;

   case 'leer_tc_check_list_usuario':
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_tc_check_list_usuario();
   break;

   case 'crear_tc_check_list_usuario':
      $tc_check_list_id = $_POST['tc_check_list_id'];
      $tc_categoria1 = strtoupper($_POST['tc_categoria1']);
      $tc_categoria2 = strtoupper($_POST['tc_categoria2']);
      $tc_categoria3 = strtoupper($_POST['tc_categoria3']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->crear_tc_check_list_usuario($tc_check_list_id, $tc_categoria1, $tc_categoria2, $tc_categoria3);
   break;

   case 'editar_tc_check_list_usuario':
      $tc_check_list_id = $_POST['tc_check_list_id'];
      $tc_categoria1 = strtoupper($_POST['tc_categoria1']);
      $tc_categoria2 = strtoupper($_POST['tc_categoria2']);
      $tc_categoria3 = strtoupper($_POST['tc_categoria3']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_tc_check_list_usuario($tc_check_list_id, $tc_categoria1, $tc_categoria2, $tc_categoria3);
   break;

   case 'borrar_tc_check_list_usuario':
      $tc_check_list_id=$_POST['tc_check_list_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->borrar_tc_check_list_usuario($tc_check_list_id);
   break;

   case 'leer_tc_check_list_sistema':
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_tc_check_list_sistema();
   break;

   case 'crear_tc_check_list_sistema':
      $tc_check_list_id = $_POST['tc_check_list_id'];
      $tc_categoria1 = strtoupper($_POST['tc_categoria1']);
      $tc_categoria2 = strtoupper($_POST['tc_categoria2']);
      $tc_categoria3 = strtoupper($_POST['tc_categoria3']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->crear_tc_check_list_sistema($tc_check_list_id, $tc_categoria1, $tc_categoria2, $tc_categoria3);
   break;

   case 'editar_tc_check_list_sistema':
      $tc_check_list_id = $_POST['tc_check_list_id'];
      $tc_categoria1 = strtoupper($_POST['tc_categoria1']);
      $tc_categoria2 = strtoupper($_POST['tc_categoria2']);
      $tc_categoria3 = strtoupper($_POST['tc_categoria3']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_tc_check_list_sistema($tc_check_list_id, $tc_categoria1, $tc_categoria2, $tc_categoria3);
   break;

   case 'borrar_tc_check_list_sistema':
      $tc_check_list_id=$_POST['tc_check_list_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->borrar_tc_check_list_sistema($tc_check_list_id);
   break;

   default: header('Location: /inicio');
}