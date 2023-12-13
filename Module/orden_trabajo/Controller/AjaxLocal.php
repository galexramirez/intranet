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
      $FechaInicioOT    = $_POST['FechaInicioOT'];
      $FechaTerminoOT   = $_POST['FechaTerminoOT'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->descargar_ot($FechaInicioOT,$FechaTerminoOT);
   break;

   case 'LeerOT':
      $FechaInicioOT    = $_POST['FechaInicioOT'];
      $FechaTerminoOT   = $_POST['FechaTerminoOT'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->LeerOT($FechaInicioOT,$FechaTerminoOT);
   break;

   case 'CrearOT':
      $ot_id              = $_POST['ot_id'];
      $ot_origen           = $_POST['ot_origen'];
      $ot_bus              = $_POST['ot_bus'];
      $ot_kilometraje      = $_POST['ot_kilometraje'];
      $ot_date_crea        = $_POST['ot_date_crea'];
      $ot_date_ct          = $_POST['ot_date_ct'];
      $ot_asociado         = $_POST['ot_asociado'];
      $ot_hmotor           = $_POST['ot_hmotor'];
      $ot_cgm_crea         = $_POST['ot_cgm_crea'];
      $ot_cgm_ct           = $_POST['ot_cgm_ct'];
      $ot_estado           = $_POST['ot_estado'];
      $ot_resp_asoc        = $_POST['ot_resp_asoc'];
      $ot_descrip          = strtoupper($_POST['ot_descrip']);
      $ot_tecnico          = $_POST['ot_tecnico'];
      $ot_check            = $_POST['ot_check'];
      $ot_obs_cgm          = strtoupper($_POST['ot_obs_cgm']);
      $ot_sistema          = $_POST['ot_sistema'];
      $ot_inicio           = $_POST['ot_inicio'];
      $ot_fin              = $_POST['ot_fin'];
      $ot_codfalla         = $_POST['ot_codfalla'];
      $ot_at               = strtoupper($_POST['ot_at']);
      $ot_obs_asoc         = $_POST['ot_obs_asoc'];
      $ot_montado          = $_POST['ot_montado'];
      $ot_dmontado         = $_POST['ot_dmontado'];
      $ot_busmont          = $_POST['ot_busmont'];
      $ot_busdmont         = $_POST['ot_busdmont'];
      $ot_motivo           = $_POST['ot_motivo'];
      $ot_obs_aom          = strtoupper($_POST['ot_obs_aom']);
      $ot_ca               = $_POST['ot_ca'];
      $ot_date_ca          = $_POST['ot_date_ca'];
      $ot_componente_raiz  = $_POST['ot_componente_raiz'];
      $ot_obs_aom2         = strtoupper($_POST['ot_obs_aom2']);
      $ot_accidentes_id    = $_POST['ot_accidentes_id'];
      $ot_semana_cierre    = $_POST['ot_semana_cierre'];
      $ot_cod_vinculada    = $_POST['ot_cod_vinculada'];
      $array_data          = json_decode($_POST['array_data'],true);

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CrearOT($ot_id, $ot_origen, $ot_bus, $ot_kilometraje, $ot_date_crea, $ot_date_ct, $ot_asociado, $ot_hmotor, $ot_cgm_crea, $ot_cgm_ct, $ot_estado, $ot_resp_asoc, $ot_descrip, $ot_tecnico, $ot_check, $ot_obs_cgm, $ot_sistema, $ot_inicio, $ot_fin, $ot_codfalla, $ot_at, $ot_obs_asoc, $ot_montado, $ot_dmontado, $ot_busmont, $ot_busdmont, $ot_motivo, $ot_obs_aom, $ot_ca, $ot_date_ca, $ot_componente_raiz, $ot_obs_aom2, $ot_accidentes_id, $ot_semana_cierre, $ot_cod_vinculada, $array_data);
   break;

   case 'BorrarOT':
      $ot_id = $_POST['ot_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->BorrarOT($ot_id);
   break;

   case 'CargarOT':
      $ot_id = $_POST['ot_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->CargarOT($ot_id);
   break;

   case 'CargarVales':
      $ot_id = $_POST['ot_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->CargarVales($ot_id);
   break;

   case 'SelectUsuario':
      $Usua_Perfil = $_POST['Usua_Perfil'];
 
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->SelectUsuario($Usua_Perfil);
   break;

   case 'SelectTecnico':
      $ot_asociado = $_POST['ot_asociado'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->SelectTecnico($ot_asociado);
   break;

   case 'BuscarTecnico':
      $ot_asociado = $_POST['ot_asociado'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarTecnico($ot_asociado);
   break;

   case 'SelectTipos':
      $ttablaotcorrectivas_operacion= $_POST['ttablaotcorrectivas_operacion'];
      $ttablaotcorrectivas_tipo = $_POST['ttablaotcorrectivas_tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectTipos($ttablaotcorrectivas_operacion,$ttablaotcorrectivas_tipo);
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

   case 'EditarOT':
      $ot_id              = $_POST['ot_id'];
      $ot_origen           = $_POST['ot_origen'];
      $ot_bus              = $_POST['ot_bus'];
      $ot_kilometraje      = $_POST['ot_kilometraje'];
      $ot_date_crea        = $_POST['ot_date_crea'];
      $ot_date_ct          = $_POST['ot_date_ct'];
      $ot_asociado         = $_POST['ot_asociado'];
      $ot_hmotor           = $_POST['ot_hmotor'];
      $ot_cgm_crea         = $_POST['ot_cgm_crea'];
      $ot_cgm_ct           = $_POST['ot_cgm_ct'];
      $ot_estado           = $_POST['ot_estado'];
      $ot_resp_asoc        = $_POST['ot_resp_asoc'];
      $ot_descrip          = strtoupper($_POST['ot_descrip']);
      $ot_tecnico          = $_POST['ot_tecnico'];
      $ot_check            = $_POST['ot_check'];
      $ot_obs_cgm          = strtoupper($_POST['ot_obs_cgm']);
      $ot_sistema          = $_POST['ot_sistema'];
      $ot_inicio           = $_POST['ot_inicio'];
      $ot_fin              = $_POST['ot_fin'];
      $ot_codfalla         = $_POST['ot_codfalla'];
      $ot_at               = strtoupper($_POST['ot_at']);
      $ot_obs_asoc         = $_POST['ot_obs_asoc'];
      $ot_montado          = $_POST['ot_montado'];
      $ot_dmontado         = $_POST['ot_dmontado'];
      $ot_busmont          = $_POST['ot_busmont'];
      $ot_busdmont         = $_POST['ot_busdmont'];
      $ot_motivo           = $_POST['ot_motivo'];
      $ot_obs_aom          = strtoupper($_POST['ot_obs_aom']);
      $ot_ca               = $_POST['ot_ca'];
      $ot_date_ca          = $_POST['ot_date_ca'];
      $ot_componente_raiz  = $_POST['ot_componente_raiz'];
      $ot_obs_aom2         = strtoupper($_POST['ot_obs_aom2']);
      $ot_accidentes_id    = $_POST['ot_accidentes_id'];
      $ot_semana_cierre    = $_POST['ot_semana_cierre'];
      $ot_cod_vinculada    = $_POST['ot_cod_vinculada'];
      $array_data          = json_decode($_POST['array_data'],true);
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->EditarOT($ot_id, $ot_origen, $ot_bus, $ot_kilometraje, $ot_date_crea, $ot_date_ct, $ot_asociado, $ot_hmotor, $ot_cgm_crea, $ot_cgm_ct, $ot_estado, $ot_resp_asoc, $ot_descrip, $ot_tecnico, $ot_check, $ot_obs_cgm, $ot_sistema, $ot_inicio, $ot_fin, $ot_codfalla, $ot_at, $ot_obs_asoc, $ot_montado, $ot_dmontado, $ot_busmont, $ot_busdmont, $ot_motivo, $ot_obs_aom, $ot_ca, $ot_date_ca, $ot_componente_raiz, $ot_obs_aom2, $ot_accidentes_id, $ot_semana_cierre, $ot_cod_vinculada, $array_data);
   break;

   case 'BusesOT':
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BusesOT();
   break;

   case 'AsociadoOT':
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->AsociadoOT();
   break;

   case 'Origenes':
      $ot_origen = $_POST['ot_origen'];
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->Origenes($ot_origen);
   break;

   case 'ver_ot':
      $ot_id= $_POST['ot_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->ver_ot($ot_id);
   break;

   case 'ver_vale':
      $ot_id = $_POST['ot_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->ver_vale($ot_id);
   break;

   case 'cargar_horas_tecnicos':
      $ot_id = $_POST['ot_id'];

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

   case 'crear_orden_trabajo':
      $not_ot_tipo = $_POST['not_ot_tipo'];
      $ot_asociado = $_POST['ot_asociado'];
      $not_origen_novedad = $_POST['not_origen_novedad'];
      $not_tipo_novedad = $_POST['not_tipo_novedad'];
      $not_novedad_id = $_POST['not_novedad_id'];
      $not_operacion = $_POST['not_operacion'];
      $not_bus = $_POST['not_bus'];
      $ot_descrip = $_POST['ot_descrip'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->crear_orden_trabajo($not_ot_tipo, $ot_asociado, $not_origen_novedad, $not_tipo_novedad, $not_novedad_id, $not_operacion, $not_bus, $ot_descrip);
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

   case 'vincular_orden_trabajo':
      $ot_tipo = $_POST['ot_tipo'];
      $ot_id = $_POST['ot_id'];
      $a_data = json_decode($_POST['a_data'],true);

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->vincular_orden_trabajo($ot_tipo, $ot_id, $a_data);
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

   default: header('Location: /inicio');
}