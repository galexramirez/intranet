<?php
$Modulo = "orden_trabajo";
$Accion = $_POST['Accion'];   

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
      $NombreTabla = $_POST['NombreTabla'];
      $TipoTabla   = $_POST['TipoTabla'];

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
      $Dato1             = $_POST['Dato1'];
      $Dato2             = $_POST['Dato2'];

      MController($Modulo,'Accesos');
      $InstanciaAjax = new Accesos();
      $Respuesta     = $InstanciaAjax->MostrarDiv($NombreFormulario,$NombreObjeto,$Dato1, $Dato2);
   break;

   case 'DocumentRoot':
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->DocumentRoot();
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

   case 'BuscarDataBD':
      $TablaBD    = $_POST['TablaBD'];
      $CampoBD    = $_POST['CampoBD'];
      $DataBuscar = $_POST['DataBuscar'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);
   break;

   case 'buscar_data':
      $nombre_tabla     = $_POST['nombre_tabla'];
      $campo_buscar     = $_POST['campo_buscar'];
      $condicion_where  = $_POST['condicion_where'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->buscar_data($nombre_tabla, $campo_buscar, $condicion_where);
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

   case 'DiferenciaFecha':
      $inicio = $_POST['inicio'];
      $final  = $_POST['final'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->DiferenciaFecha($inicio,$final);
   break;

   case 'calcular_diferencia_horas':
      $horainicio = $_POST['horainicio'];
      $horafinal  = $_POST['horafinal'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->calcular_diferencia_horas($horainicio,$horafinal);
   break;

   case 'CalculoFecha':
      $inicio= $_POST['inicio'];
      $calculo = $_POST['calculo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CalculoFecha($inicio,$calculo);
   break;

   case 'MayorFecha':
      $inicio= $_POST['inicio'];
      $final = $_POST['final'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->MayorFecha($inicio,$final);
   break;

   case 'descargar_ot':
      $fecha_inicio_ot    = $_POST['fecha_inicio_ot'];
      $fecha_termino_ot   = $_POST['fecha_termino_ot'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->descargar_ot($fecha_inicio_ot,$fecha_termino_ot);
   break;

   case 'leer_ot':
      $fecha_inicio_ot    = $_POST['fecha_inicio_ot'];
      $fecha_termino_ot   = $_POST['fecha_termino_ot'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_ot($fecha_inicio_ot,$fecha_termino_ot);
   break;

   case 'crear_ot':
      $ot_id               = $_POST['ot_id'];
      $ot_origen           = $_POST['ot_origen'];
      $ot_bus              = $_POST['ot_bus'];
      $ot_kilometraje      = $_POST['ot_kilometraje'];
      $ot_fecha_registro   = $_POST['ot_fecha_registro'];
      $ot_nombre_proveedor = $_POST['ot_nombre_proveedor'];
      $ot_cgm              = $_POST['ot_cgm'];
      $ot_estado           = $_POST['ot_estado'];
      $ot_actividad        = strtoupper($_POST['ot_actividad']);
      $ot_ejecucion        = strtoupper($_POST['ot_ejecucion']);
      $ot_obs_cgm          = strtoupper($_POST['ot_obs_cgm']);
      $ot_sistema          = $_POST['ot_sistema'];
      $ot_obs_proveedor    = strtoupper($_POST['ot_obs_proveedor']);
      $ot_semana_cierre    = $_POST['ot_semana_cierre'];
      $ot_tipo             = $_POST['ot_tipo'];
      $array_data          = json_decode($_POST['array_data'],true);

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->crear_ot($ot_id, $ot_origen, $ot_bus, $ot_kilometraje, $ot_fecha_registro, $ot_nombre_proveedor, $ot_cgm, $ot_estado, $ot_actividad, $ot_ejecucion, $ot_obs_cgm, $ot_sistema, $ot_obs_proveedor, $ot_semana_cierre, $ot_tipo, $array_data);
   break;

   case 'BorrarOT':
      $ot_id = $_POST['ot_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->BorrarOT($ot_id);
   break;

   case 'cargar_ot':
      $ot_id = $_POST['ot_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->cargar_ot($ot_id);
   break;

   case 'cargar_vales':
      $ot_id = $_POST['ot_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->cargar_vales($ot_id);
   break;

   case 'CalculoKilometraje':
      $ot_bus= $_POST['ot_bus'];
      $ot_inicio = $_POST['ot_inicio'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CalculoKilometraje($ot_bus,$ot_inicio);
   break;

   case 'ValidarKm':
      $ot_bus= $_POST['ot_bus'];
      $ot_inicio = $_POST['ot_inicio'];
      $ot_kilometraje = $_POST['ot_kilometraje'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ValidarKm($ot_bus,$ot_inicio,$ot_kilometraje);
   break;

   case 'editar_ot':
      $ot_id               = $_POST['ot_id'];
      $ot_origen           = $_POST['ot_origen'];
      $ot_bus              = $_POST['ot_bus'];
      $ot_kilometraje      = $_POST['ot_kilometraje'];
      $ot_fecha_registro   = $_POST['ot_fecha_registro'];
      $ot_nombre_proveedor = $_POST['ot_nombre_proveedor'];
      $ot_cgm              = $_POST['ot_cgm'];
      $ot_estado           = $_POST['ot_estado'];
      $ot_actividad        = strtoupper($_POST['ot_actividad']);
      $ot_ejecucion        = strtoupper($_POST['ot_ejecucion']);
      $ot_obs_cgm          = strtoupper($_POST['ot_obs_cgm']);
      $ot_sistema          = $_POST['ot_sistema'];
      $ot_obs_proveedor    = strtoupper($_POST['ot_obs_proveedor']);
      $ot_semana_cierre    = $_POST['ot_semana_cierre'];
      $ot_tipo             = $_POST['ot_tipo'];
      $array_data          = json_decode($_POST['array_data'],true);
      
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->editar_ot($ot_id, $ot_origen, $ot_bus, $ot_kilometraje, $ot_fecha_registro, $ot_nombre_proveedor, $ot_cgm, $ot_estado, $ot_actividad, $ot_ejecucion, $ot_obs_cgm, $ot_sistema, $ot_obs_proveedor, $ot_semana_cierre, $ot_tipo, $array_data);
   break;

   case 'ver_ot':
      $ot_id= $_POST['ot_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->ver_ot($ot_id);
   break;

   case 'imprimir_ot':
      $ot_id= $_POST['ot_id'];

      MController($Modulo,'imprimir');
      $InstanciaAjax = new imprimir();
      $Respuesta = $InstanciaAjax->imprimir_ot($ot_id);
   break;

   case 'ver_vale':
      $ot_id = $_POST['ot_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->ver_vale($ot_id);
   break;

   case 'cargar_horas_tecnicos':
      $ot_id = $_POST['cod_ot'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->cargar_horas_tecnicos($ot_id);
   break;

   case 'ot_observadas':
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->ot_observadas();
   break;

   case 'leer_cierre_semanal':
      $anios_cierre_semanal    = $_POST['anios_cierre_semanal'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_cierre_semanal($anios_cierre_semanal);
   break;

   case 'validar_estado_cerrado':
      $tabla         = $_POST['tabla']; 
      $semana        = $_POST['semana']; 
      $estado        = $_POST['estado'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->validar_estado_cerrado($tabla, $semana, $estado);
   break;

   case 'validar_semana':
      $tabla         = $_POST['tabla']; 
      $campo_semana  = $_POST['campo_semana']; 
      $semana        = $_POST['semana'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->validar_semana($tabla, $campo_semana, $semana);
   break;

   case 'generar_cierre_semanal':
      $otc_semana = $_POST['otc_semana'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->generar_cierre_semanal($otc_semana);
   break;

   case 'leer_novedades':
      $fecha_inicio    = $_POST['fecha_inicio'];
      $fecha_termino   = $_POST['fecha_termino'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_novedades($fecha_inicio, $fecha_termino);
   break;

   case 'crear_novedad_regular':
      $nreg_origen = $_POST['nreg_origen'];
      $nreg_descripcion = strtoupper($_POST['nreg_descripcion']);
      $nreg_operacion = strtoupper($_POST['nreg_operacion']);
      $nreg_bus = $_POST['nreg_bus'];
      $nreg_componente = $_POST['nreg_componente'];
      $nreg_posicion = $_POST['nreg_posicion'];
      $nreg_falla = $_POST['nreg_falla'];
      $nreg_accion = $_POST['nreg_accion'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->crear_novedad_regular($nreg_origen, $nreg_descripcion, $nreg_operacion, $nreg_bus, $nreg_componente, $nreg_posicion, $nreg_falla, $nreg_accion);
   break;

   case 'codificar_novedad':
      $nope_tipo_novedad = strtoupper($_POST['nope_tipo_novedad']);
      $nope_novedad_id = strtoupper($_POST['nope_novedad_id']);
      $nope_componente = $_POST['nope_componente'];
      $nope_posicion = $_POST['nope_posicion'];
      $nope_falla = $_POST['nope_falla'];
      $nope_accion = $_POST['nope_accion'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta = $InstanciaAjax->codificar_novedad($nope_tipo_novedad, $nope_novedad_id, $nope_componente, $nope_posicion, $nope_falla, $nope_accion);
   break;

   case 'recodificar_novedad':
      $nope_tipo_novedad = strtoupper($_POST['nope_tipo_novedad']);
      $nope_novedad_id = strtoupper($_POST['nope_novedad_id']);
      $nope_componente = $_POST['nope_componente'];
      $nope_posicion = $_POST['nope_posicion'];
      $nope_falla = $_POST['nope_falla'];
      $nope_accion = $_POST['nope_accion'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->recodificar_novedad($nope_tipo_novedad, $nope_novedad_id, $nope_componente, $nope_posicion, $nope_falla, $nope_accion);
   break;

   case 'crear_orden_trabajo':
      $ot_origen = $_POST['ot_origen'];
      $ot_nombre_proveedor = $_POST['ot_nombre_proveedor'];
      $a_data = json_decode($_POST['a_data'],true);

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->crear_orden_trabajo($ot_origen, $ot_nombre_proveedor, $a_data);
   break;

   case 'no_genera_ot':
      $not_origen_novedad = $_POST['not_origen_novedad'];
      $not_tipo_novedad = $_POST['not_tipo_novedad'];
      $not_novedad_id = $_POST['not_novedad_id'];
      $not_operacion = $_POST['not_operacion'];
      $not_bus = $_POST['not_bus'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta = $InstanciaAjax->no_genera_ot($not_origen_novedad, $not_tipo_novedad, $not_novedad_id, $not_operacion, $not_bus);
   break;

   case 'validar_novedades_vincular_ot':
      $a_data = json_decode($_POST['a_data'],true);

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->validar_novedades_vincular_ot($a_data);
   break;

   case 'validar_novedades_desvincular_ot':
      $a_data = json_decode($_POST['a_data'],true);

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->validar_novedades_desvincular_ot($a_data);
   break;

   case 'vincular_orden_trabajo':
      $ot_id = $_POST['ot_id'];
      $a_data = json_decode($_POST['a_data'],true);

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->vincular_orden_trabajo($ot_id, $a_data);
   break;

   case 'desvincular_orden_trabajo':
      $a_data = json_decode($_POST['a_data'],true);

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->desvincular_orden_trabajo($a_data);
   break;

   case 'leer_tc_ot_usuario':
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_tc_ot_usuario();
   break;

   case 'crear_tc_ot_usuario':
      $tc_ot_id = $_POST['tc_ot_id'];
      $tc_categoria1 = strtoupper($_POST['tc_categoria1']);
      $tc_categoria2 = strtoupper($_POST['tc_categoria2']);
      $tc_categoria3 = strtoupper($_POST['tc_categoria3']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->crear_tc_ot_usuario($tc_ot_id, $tc_categoria1, $tc_categoria2, $tc_categoria3);
   break;

   case 'editar_tc_ot_usuario':
      $tc_ot_id = $_POST['tc_ot_id'];
      $tc_categoria1 = strtoupper($_POST['tc_categoria1']);
      $tc_categoria2 = strtoupper($_POST['tc_categoria2']);
      $tc_categoria3 = strtoupper($_POST['tc_categoria3']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_tc_ot_usuario($tc_ot_id, $tc_categoria1, $tc_categoria2, $tc_categoria3);
   break;

   case 'borrar_tc_ot_usuario':
      $tc_ot_id=$_POST['tc_ot_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->borrar_tc_ot_usuario($tc_ot_id);
   break;

   case 'leer_tc_ot_sistema':
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_tc_ot_sistema();
   break;

   case 'crear_tc_ot_sistema':
      $tc_ot_id = $_POST['tc_ot_id'];
      $tc_categoria1 = strtoupper($_POST['tc_categoria1']);
      $tc_categoria2 = strtoupper($_POST['tc_categoria2']);
      $tc_categoria3 = strtoupper($_POST['tc_categoria3']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->crear_tc_ot_sistema($tc_ot_id, $tc_categoria1, $tc_categoria2, $tc_categoria3);
   break;

   case 'editar_tc_ot_sistema':
      $tc_ot_id = $_POST['tc_ot_id'];
      $tc_categoria1 = strtoupper($_POST['tc_categoria1']);
      $tc_categoria2 = strtoupper($_POST['tc_categoria2']);
      $tc_categoria3 = strtoupper($_POST['tc_categoria3']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_tc_ot_sistema($tc_ot_id, $tc_categoria1, $tc_categoria2, $tc_categoria3);
   break;

   case 'borrar_tc_ot_sistema':
      $tc_ot_id=$_POST['tc_ot_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->borrar_tc_ot_sistema($tc_ot_id);
   break;

   case 'leer_origen':
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta = $InstanciaAjax->leer_origen();
   break;

   case 'crear_origen':
      $ot_origen_id = $_POST['ot_origen_id'];
      $or_nombre = $_POST['or_nombre'];
      $or_tipo_ot = $_POST['or_tipo_ot'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta = $InstanciaAjax->crear_origen($ot_origen_id, $or_nombre, $or_tipo_ot);
   break;

   case 'editar_origen':
      $ot_origen_id = $_POST['ot_origen_id'];
      $or_nombre = $_POST['or_nombre'];
      $or_tipo_ot = $_POST['or_tipo_ot'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta = $InstanciaAjax->editar_origen($ot_origen_id, $or_nombre, $or_tipo_ot);
   break;

   case 'borrar_origen':
      $ot_origen_id = $_POST['ot_origen_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta = $InstanciaAjax->borrar_origen($ot_origen_id);
   break;

   case 'leer_tecnico':
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta = $InstanciaAjax->leer_tecnico();
   break;

   case 'crear_tecnico':
      $tecnico_asociado_id = $_POST['tecnico_asociado_id'];
      $ta_dni = $_POST['ta_dni'];
      $ta_nombre_corto = strtoupper($_POST['ta_nombre_corto']);
      $ta_apellidos_nombres = strtoupper($_POST['ta_apellidos_nombres']);
      $ta_ruc = $_POST['ta_ruc'];
      $ta_razon_social = $_POST['ta_razon_social'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta = $InstanciaAjax->crear_tecnico($tecnico_asociado_id, $ta_dni, $ta_nombre_corto, $ta_apellidos_nombres, $ta_ruc, $ta_razon_social);
   break;

   case 'editar_tecnico':
      $tecnico_asociado_id = $_POST['tecnico_asociado_id'];
      $ta_dni = $_POST['ta_dni'];
      $ta_nombre_corto = strtoupper($_POST['ta_nombre_corto']);
      $ta_apellidos_nombres = strtoupper($_POST['ta_apellidos_nombres']);
      $ta_ruc = $_POST['ta_ruc'];
      $ta_razon_social = $_POST['ta_razon_social'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta = $InstanciaAjax->editar_tecnico($tecnico_asociado_id, $ta_dni, $ta_nombre_corto, $ta_apellidos_nombres, $ta_ruc, $ta_razon_social);
   break;

   case 'borrar_tecnico':
      $tecnico_asociado_id = $_POST['tecnico_asociado_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta = $InstanciaAjax->borrar_tecnico($tecnico_asociado_id);
   break;

   default: header('Location: /inicio');
}