<?php
$Modulo = "Comportamiento";
$Accion=$_POST['Accion'];   

switch ($Accion) {
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

   case 'buscar_dato':
      $nombre_tabla     = $_POST['nombre_tabla'];
      $campo_buscar     = $_POST['campo_buscar'];
      $condicion_where  = $_POST['condicion_where'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->buscar_dato($nombre_tabla, $campo_buscar, $condicion_where);
   break;

   case 'calcular_diferencia_horas':
      $horainicio = $_POST['horainicio'];
      $horafinal  = $_POST['horafinal'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->calcular_diferencia_horas($horainicio,$horafinal);
   break;

   case 'BuscarComportamiento':
      $fecha_inicio  = $_POST['fecha_inicio'];
      $fecha_termino = $_POST['fecha_termino'];
      
      MModel($Modulo, 'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->BuscarComportamiento($fecha_inicio, $fecha_termino);
   break;

   case 'DetalleControlFacilitador':
      $Nove_ProgramacionId = $_POST['Nove_ProgramacionId'];
      $Novedad_Id = $_POST['Novedad_Id'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DetalleControlFacilitador($Nove_ProgramacionId,$Novedad_Id);
   break;

   case 'buscar_servicio':
      $Prog_Fecha= $_POST['Prog_Fecha'];
      $Prog_Tabla = $_POST['Prog_Tabla'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->buscar_servicio($Prog_Fecha,$Prog_Tabla);
   break;

   case 'EstadoComportamiento':
      $comportamiento_id = $_POST['comportamiento_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->EstadoComportamiento($comportamiento_id);
   break;

   case 'CargaInicialComportamiento':
      $comp_programacionid = $_POST['comp_programacionid'];
      $comp_novedadid      = $_POST['comp_novedadid'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->CargaInicialComportamiento($comp_programacionid,$comp_novedadid);
   break;

   case 'CargaComportamiento':
      $comportamiento_id=$_POST['comportamiento_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->CargaComportamiento($comportamiento_id);
   break;

   case 'CrearComportamiento':
      $comp_programacionid          = $_POST['comp_programacionid'];
      $comp_novedadid               = $_POST['comp_novedadid'];
      $comp_tiponovedad             = $_POST['comp_tiponovedad'];
      $comp_fechaoperacion          = $_POST['comp_fechaoperacion'];
      $comp_nombrecolaborador       = $_POST['comp_nombrecolaborador'];
      $comp_descripcion             = $_POST['comp_descripcion'];
      $comp_tabla                   = $_POST['comp_tabla'];
      $comp_servicio                = $_POST['comp_servicio'];
      $comp_bus                     = $_POST['comp_bus'];
      $comp_nombrecgo               = $_POST['comp_nombrecgo'];
      $comp_lugarexacto             = $_POST['comp_lugarexacto'];
      $comp_lugar_origen            = $_POST['comp_lugar_origen'];
      $comp_lugar_destino           = $_POST['comp_lugar_destino'];
      $comp_horainicio              = $_POST['comp_horainicio'];
      $comp_horafin                 = $_POST['comp_horafin'];
      $comp_total_horas             = $_POST['comp_total_horas'];
      $comp_detallenovedad          = $_POST['comp_detallenovedad'];
      $comp_estadocomportamiento    = $_POST['comp_estadocomportamiento'];
      $comp_reconoceresponsabilidad = $_POST['comp_reconoceresponsabilidad'];
      $comp_grado_falta             = $_POST['comp_grado_falta'];
      $comp_codigofalta             = $_POST['comp_codigofalta'];
      $comp_faltacometida           = $_POST['comp_faltacometida'];
      $comp_monto                   = $_POST['comp_monto'];
      $comp_linkvideo               = $_POST['comp_linkvideo'];
      $comp_obs_log                 = $_POST['comp_obs_log'];
      $comp_operacion               = $_POST['comp_operacion'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->CrearComportamiento($comp_programacionid, $comp_novedadid, $comp_tiponovedad, $comp_fechaoperacion, $comp_nombrecolaborador, $comp_descripcion, $comp_tabla, $comp_servicio, $comp_bus, $comp_nombrecgo, $comp_lugarexacto, $comp_lugar_origen, $comp_lugar_destino, $comp_horainicio, $comp_horafin, $comp_total_horas, $comp_detallenovedad, $comp_estadocomportamiento, $comp_reconoceresponsabilidad, $comp_grado_falta, $comp_codigofalta, $comp_faltacometida, $comp_monto, $comp_linkvideo, $comp_obs_log, $comp_operacion);
   break;

   case 'EditarComportamiento':
      $comportamiento_id            = $_POST['comportamiento_id'];
      $comp_tiponovedad             = $_POST['comp_tiponovedad'];
      $comp_fechaoperacion          = $_POST['comp_fechaoperacion'];
      $comp_nombrecolaborador       = $_POST['comp_nombrecolaborador'];
      $comp_descripcion             = $_POST['comp_descripcion'];
      $comp_tabla                   = $_POST['comp_tabla'];
      $comp_servicio                = $_POST['comp_servicio'];
      $comp_bus                     = $_POST['comp_bus'];
      $comp_nombrecgo               = $_POST['comp_nombrecgo'];
      $comp_lugarexacto             = $_POST['comp_lugarexacto'];
      $comp_lugar_origen            = $_POST['comp_lugar_origen'];
      $comp_lugar_destino           = $_POST['comp_lugar_destino'];
      $comp_horainicio              = $_POST['comp_horainicio'];
      $comp_horafin                 = $_POST['comp_horafin'];
      $comp_total_horas             = $_POST['comp_total_horas'];
      $comp_detallenovedad          = $_POST['comp_detallenovedad'];
      $comp_estadocomportamiento    = $_POST['comp_estadocomportamiento'];
      $comp_reconoceresponsabilidad = $_POST['comp_reconoceresponsabilidad'];
      $comp_grado_falta             = $_POST['comp_grado_falta'];
      $comp_codigofalta             = $_POST['comp_codigofalta'];
      $comp_faltacometida           = $_POST['comp_faltacometida'];
      $comp_monto                   = $_POST['comp_monto'];
      $comp_linkvideo               = $_POST['comp_linkvideo'];
      $comp_obs_log                 = $_POST['comp_obs_log'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->EditarComportamiento($comportamiento_id, $comp_tiponovedad, $comp_fechaoperacion, $comp_nombrecolaborador, $comp_descripcion, $comp_tabla, $comp_servicio, $comp_bus, $comp_nombrecgo, $comp_lugarexacto, $comp_lugar_origen, $comp_lugar_destino, $comp_horainicio, $comp_horafin, $comp_total_horas, $comp_detallenovedad, $comp_estadocomportamiento, $comp_reconoceresponsabilidad, $comp_grado_falta, $comp_codigofalta, $comp_faltacometida, $comp_monto, $comp_linkvideo, $comp_obs_log);
   break;

   case 'BuscarReportegdh':
      $fecha_inicio  = $_POST['fecha_inicio'];
      $fecha_termino = $_POST['fecha_termino'];
      
      MModel($Modulo, 'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BuscarReportegdh($fecha_inicio, $fecha_termino);
   break;

   case 'CrearTelemetriaCarga':
      $inputFileName = $_FILES['archivoexcel']['tmp_name'];
      $Anio = $_POST['Anio'];
      $telemetriacarga_fechaoperacion = $_POST['telemetriacarga_fechaoperacion'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CrearTelemetriaCarga($inputFileName,$Anio,$telemetriacarga_fechaoperacion);
   break;

   case 'BuscarTelemetriaCarga':
      $Calendario_Anio = $_POST['Anio'];
      
      MModel($Modulo, 'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BuscarTelemetriaCarga($Calendario_Anio);
   break;

   case 'BorrarTelemetriaCarga':
      $telemetriacarga_id = $_POST['telemetriacarga_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarTelemetriaCarga($telemetriacarga_id);
   break;

   case 'BorrarTelemetria':
      $telemetriacarga_id = $_POST['telemetriacarga_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarTelemetria($telemetriacarga_id);
   break;

   case 'ExisteFechaOperacion':
      $tlmtcarga_fechaoperacion = $_POST['tlmtcarga_fechaoperacion'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ExisteFechaOperacion($tlmtcarga_fechaoperacion);
   break;

   case 'select_tabla':
      $prog_fecha = $_POST['prog_fecha'];
      $operacion  = $_POST['operacion'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->select_tabla($prog_fecha, $operacion);
   break;

   case 'LeerTipoTablaComportamiento':
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerTipoTablaComportamiento();
   break;

   case 'CrearTipoTablaComportamiento':
      $TtablaComportamiento_Id = $_POST['TtablaComportamiento_Id'];
      $TtablaComportamiento_Tipo = strtoupper($_POST['TtablaComportamiento_Tipo']);
      $TtablaComportamiento_Operacion = strtoupper($_POST['TtablaComportamiento_Operacion']);
      $TtablaComportamiento_Detalle = strtoupper($_POST['TtablaComportamiento_Detalle']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearTipoTablaComportamiento($TtablaComportamiento_Id,$TtablaComportamiento_Tipo,$TtablaComportamiento_Operacion,$TtablaComportamiento_Detalle);
   break;

   case 'EditarTipoTablaComportamiento':
      $TtablaComportamiento_Id = $_POST['TtablaComportamiento_Id'];
      $TtablaComportamiento_Tipo = strtoupper($_POST['TtablaComportamiento_Tipo']);
      $TtablaComportamiento_Operacion = strtoupper($_POST['TtablaComportamiento_Operacion']);
      $TtablaComportamiento_Detalle = strtoupper($_POST['TtablaComportamiento_Detalle']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarTipoTablaComportamiento($TtablaComportamiento_Id,$TtablaComportamiento_Tipo,$TtablaComportamiento_Operacion,$TtablaComportamiento_Detalle);
   break;

   case 'BorrarTipoTablaComportamiento':
      $TtablaComportamiento_Id=$_POST['TtablaComportamiento_Id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarTipoTablaComportamiento($TtablaComportamiento_Id);
   break;

   default: header('Location: /inicio');
}