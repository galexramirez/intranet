<?php
$Modulo = "Inasistencias";
$Accion = $_POST['Accion'];   

switch ($Accion) {

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
      $inicio  = $_POST['inicio'];
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
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DiferenciaFecha($inicio,$final,$dias);
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

   case 'select_roles':
      $roles_perfil = $_POST['roles_perfil'];
      $roles_campo = $_POST['roles_campo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->select_roles($roles_perfil, $roles_campo);
   break;

   case 'select_tipos':
      $operacion  = $_POST['operacion'];
      $tipo       = $_POST['tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->select_tipos($operacion,$tipo);
   break;

   case 'buscar_inasistencias':
      $fecha_inicio  = $_POST['fecha_inicio'];
      $fecha_termino = $_POST['fecha_termino'];
      
      MModel($Modulo, 'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->buscar_inasistencias($fecha_inicio, $fecha_termino);
   break;

   case 'detalle_control_facilitador':
      $Nove_ProgramacionId = $_POST['Nove_ProgramacionId'];
      $Novedad_Id          = $_POST['Novedad_Id'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->detalle_control_facilitador($Nove_ProgramacionId,$Novedad_Id);
   break;

   case 'select_bus':
      $operacion = $_POST['operacion'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->select_bus($operacion);
   break;

   case 'select_tipos':
      $TtablaInasistencias_Operacion   = $_POST['TtablaInasistencias_Operacion'];
      $TtablaInasistencias_Tipo        = $_POST['TtablaInasistencias_Tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->select_tipos($TtablaInasistencias_Operacion,$TtablaInasistencias_Tipo);
   break;

   case 'buscar_servicio':
      $Prog_Fecha = $_POST['Prog_Fecha'];
      $Prog_Tabla = $_POST['Prog_Tabla'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->buscar_servicio($Prog_Fecha,$Prog_Tabla);
   break;

   case 'select_tabla':
      $Prog_Fecha = $_POST['Prog_Fecha'];
      $operacion  = $_POST['operacion'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->select_tabla($Prog_Fecha, $operacion);
   break;

   case 'calcular_diferencia_horas':
      $horainicio = $_POST['horainicio'];
      $horafinal  = $_POST['horafinal'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->calcular_diferencia_horas($horainicio,$horafinal);
   break;

   case 'estado_inasistencias':
      $inasistencias_id = $_POST['inasistencias_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->estado_inasistencias($inasistencias_id);
   break;

   case 'carga_inicial_inasistencias':
      $inas_programacionid = $_POST['inas_programacionid'];
      $inas_novedadid      = $_POST['inas_novedadid'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->carga_inicial_inasistencias($inas_programacionid,$inas_novedadid);
   break;

   case 'carga_inasistencias':
      $inasistencias_id = $_POST['inasistencias_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->carga_inasistencias($inasistencias_id);
   break;

   case 'crear_inasistencias':
      $inas_programacionid       = $_POST['inas_programacionid'];
      $inas_novedadid            = $_POST['inas_novedadid'];
      $inasistencias_id          = $_POST['inasistencias_id'];
      $inas_tiponovedad          = $_POST['inas_tiponovedad'];
      $inas_detallenovedad       = $_POST['inas_detallenovedad'];
      $inas_fechaoperacion       = $_POST['inas_fechaoperacion'];
      $inas_nombrecolaborador    = $_POST['inas_nombrecolaborador'];
      $inas_descripcion          = strtoupper($_POST['inas_descripcion']);
      $inas_tabla                = $_POST['inas_tabla'];
      $inas_servicio             = $_POST['inas_servicio'];
      $inas_bus                  = $_POST['inas_bus'];
      $inas_nombrecgo            = $_POST['inas_nombrecgo'];
      $inas_lugarexacto          = strtoupper($_POST['inas_lugarexacto']);
      $inas_horainicio           = $_POST['inas_horainicio'];
      $inas_horafin              = $_POST['inas_horafin'];
      $inas_totalhoras           = $_POST['inas_totalhoras'];
      $inas_obs_log              = strtoupper($_POST['inas_obs_log']);
      $inas_estadoinasistencias  = $_POST['inas_estadoinasistencias'];
      $inas_lugar_origen         = $_POST['inas_lugar_origen'];
      $inas_lugar_destino        = $_POST['inas_lugar_destino'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->crear_inasistencias($inas_programacionid, $inas_novedadid, $inasistencias_id, $inas_tiponovedad, $inas_detallenovedad, $inas_fechaoperacion, $inas_nombrecolaborador, $inas_descripcion, $inas_tabla, $inas_servicio, $inas_bus, $inas_nombrecgo, $inas_lugarexacto, $inas_horainicio, $inas_horafin, $inas_totalhoras, $inas_obs_log, $inas_estadoinasistencias, $inas_lugar_origen, $inas_lugar_destino);
   break;

   case 'editar_inasistencias':
      $inasistencias_id          = $_POST['inasistencias_id'];
      $inas_tiponovedad          = $_POST['inas_tiponovedad'];
      $inas_detallenovedad       = $_POST['inas_detallenovedad'];
      $inas_fechaoperacion       = $_POST['inas_fechaoperacion'];
      $inas_nombrecolaborador    = $_POST['inas_nombrecolaborador'];
      $inas_descripcion          = strtoupper($_POST['inas_descripcion']);
      $inas_tabla                = $_POST['inas_tabla'];
      $inas_servicio             = $_POST['inas_servicio'];
      $inas_bus                  = $_POST['inas_bus'];
      $inas_nombrecgo            = $_POST['inas_nombrecgo'];
      $inas_lugarexacto          = strtoupper($_POST['inas_lugarexacto']);
      $inas_horainicio           = $_POST['inas_horainicio'];
      $inas_horafin              = $_POST['inas_horafin'];
      $inas_totalhoras           = $_POST['inas_totalhoras'];
      $inas_obs_log              = strtoupper($_POST['inas_obs_log']);
      $inas_estadoinasistencias  = $_POST['inas_estadoinasistencias'];
      $inas_lugar_origen         = $_POST['inas_lugar_origen'];
      $inas_lugar_destino        = $_POST['inas_lugar_destino'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->editar_inasistencias($inasistencias_id, $inas_tiponovedad, $inas_detallenovedad, $inas_fechaoperacion, $inas_nombrecolaborador, $inas_descripcion, $inas_tabla, $inas_servicio, $inas_bus, $inas_nombrecgo, $inas_lugarexacto, $inas_horainicio, $inas_horafin, $inas_totalhoras, $inas_obs_log, $inas_estadoinasistencias, $inas_lugar_origen, $inas_lugar_destino);
   break;

   case 'buscar_reporte_gdh':
      $fecha_inicio  = $_POST['fecha_inicio'];
      $fecha_termino = $_POST['fecha_termino'];
      
      MModel($Modulo, 'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->buscar_reporte_gdh($fecha_inicio, $fecha_termino);
   break;

   case 'LeerTipoTablaInasistencias':
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerTipoTablaInasistencias();
   break;

   case 'CrearTipoTablaInasistencias':
      $TtablaInasistencias_Id = $_POST['TtablaInasistencias_Id'];
      $TtablaInasistencias_Tipo = strtoupper($_POST['TtablaInasistencias_Tipo']);
      $TtablaInasistencias_Operacion = strtoupper($_POST['TtablaInasistencias_Operacion']);
      $TtablaInasistencias_Detalle = strtoupper($_POST['TtablaInasistencias_Detalle']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearTipoTablaInasistencias($TtablaInasistencias_Id,$TtablaInasistencias_Tipo,$TtablaInasistencias_Operacion,$TtablaInasistencias_Detalle);
   break;

   case 'EditarTipoTablaInasistencias':
      $TtablaInasistencias_Id = $_POST['TtablaInasistencias_Id'];
      $TtablaInasistencias_Tipo = strtoupper($_POST['TtablaInasistencias_Tipo']);
      $TtablaInasistencias_Operacion = strtoupper($_POST['TtablaInasistencias_Operacion']);
      $TtablaInasistencias_Detalle = strtoupper($_POST['TtablaInasistencias_Detalle']);
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarTipoTablaInasistencias($TtablaInasistencias_Id,$TtablaInasistencias_Tipo,$TtablaInasistencias_Operacion,$TtablaInasistencias_Detalle);
   break;

   case 'BorrarTipoTablaInasistencias':
      $TtablaInasistencias_Id=$_POST['TtablaInasistencias_Id'];
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarTipoTablaInasistencias($TtablaInasistencias_Id);
   break;

   default: header('Location: /inicio');
}