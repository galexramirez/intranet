<?php
$Modulo = "Vales";
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
      $Dato=$_POST['Dato'];

      MController($Modulo,'Accesos');
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->MostrarDiv($NombreFormulario,$NombreObjeto,$Dato);
   break;

   case 'buscar_dato':
      $nombre_tabla     = $_POST['nombre_tabla'];
      $campo_buscar     = $_POST['campo_buscar'];
      $condicion_where  = $_POST['condicion_where'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->buscar_dato($nombre_tabla, $campo_buscar, $condicion_where);
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

   case 'LeerVales':
      $FechaInicioVales = $_POST['FechaInicioVales'];
      $FechaTerminoVales = $_POST['FechaTerminoVales'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerVales($FechaInicioVales,$FechaTerminoVales);
   break;

   case 'cargar_detalle_repuestos':
      $cod_vale = $_POST['cod_vale'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->cargar_detalle_repuestos($cod_vale);
   break;

   case 'generar_vales':
      $cod_vale         = $_POST['cod_vale'];
      $va_ot            = $_POST['va_ot'];
      $va_genera        = $_POST['va_genera'];
      $va_date_genera   = $_POST['va_date_genera'];
      $va_asociado      = $_POST['va_asociado'];
      $va_responsable   = $_POST['va_responsable'];
      $va_garantia      = $_POST['va_garantia'];
      $va_obs_cgm       = $_POST['va_obs_cgm'];
      $tva_obs_aom      = $_POST['tva_obs_aom'];
      $va_obs_aom       = $_POST['va_obs_aom'];
      $va_estado        = $_POST['va_estado'];
      $array_data       = json_decode($_POST['array_data'],true);

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->generar_vales($cod_vale, $va_ot, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $tva_obs_aom, $va_obs_aom, $va_estado, $array_data);
   break;

   case 'editar_vales':
      $cod_vale         = $_POST['cod_vale'];
      $va_ot            = $_POST['va_ot'];
      $va_genera        = $_POST['va_genera'];
      $va_date_genera   = $_POST['va_date_genera'];
      $va_asociado      = $_POST['va_asociado'];
      $va_responsable   = $_POST['va_responsable'];
      $va_garantia      = $_POST['va_garantia'];
      $va_obs_cgm       = $_POST['va_obs_cgm'];
      $tva_obs_aom      = $_POST['tva_obs_aom'];
      $va_obs_aom       = $_POST['va_obs_aom'];
      $va_estado        = $_POST['va_estado'];
      $array_data       = json_decode($_POST['array_data'],true);

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->editar_vales($cod_vale, $va_ot, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $tva_obs_aom, $va_obs_aom, $va_estado, $array_data);
   break;

   case 'cargar_vales':
      $cod_vale = $_POST['cod_vale'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->cargar_vales($cod_vale);
   break;

   case 'SelectUsuario':
      $Usua_Perfil = $_POST['Usua_Perfil'];
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectUsuario($Usua_Perfil);
   break;

   case 'SelectResponsable':
      $va_asociado = $_POST['va_asociado'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectResponsable($va_asociado);
   break;

   case 'BuscarResponsable':
      $va_asociado = $_POST['va_asociado'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarResponsable($va_asociado);
   break;

   case 'SelectTipos':
      $ttablavales_operacion= $_POST['ttablavales_operacion'];
      $ttablavales_tipo = $_POST['ttablavales_tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectTipos($ttablavales_operacion,$ttablavales_tipo);
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

   case 'BusesVales':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BusesVales();
   break;

   case 'AsociadoVales':
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->AsociadoVales();
   break;

   case 'BuscarOT':
      $va_ot = $_POST['va_ot'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarOT($va_ot);
   break;

   case 'LeerRepuestos':
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerRepuestos();
   break;

   case 'CrearRepuestos':
      $cod_rep       = $_POST['cod_rep'];
      $rep_desc      = $_POST['rep_desc'];
      $rep_unida     = $_POST['rep_unida'];
      $rep_precio    = $_POST['rep_precio'];
      $rep_ingreso   = $_POST['rep_ingreso'];
      $rep_asociado  = $_POST['rep_asociado'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearRepuestos($cod_rep,$rep_desc,$rep_unida,$rep_precio,$rep_ingreso,$rep_asociado);
   break;

   case 'EditarRepuestos':
      //Recepcion de Variables del JS
      $cod_rep       = $_POST['cod_rep'];
      $rep_desc      = $_POST['rep_desc'];
      $rep_unida     = $_POST['rep_unida'];
      $rep_precio    = $_POST['rep_precio'];
      $rep_ingreso   = $_POST['rep_ingreso'];
      $rep_asociado  = $_POST['rep_asociado'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarRepuestos($cod_rep,$rep_desc,$rep_unida,$rep_precio,$rep_ingreso,$rep_asociado);
   break;

   case 'BorrarRepuestos':
      //Recepcion de Variables del JS
      $cod_rep=$_POST['cod_rep'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarRepuestos($cod_rep);
   break;

   case 'LeerReporte':
      $FechaInicioReporte = $_POST['FechaInicioReporte'];
      $FechaTerminoReporte = $_POST['FechaTerminoReporte'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerReporte($FechaInicioReporte,$FechaTerminoReporte);
   break;

   case 'AutoCompletar':
      $NombreTabla= $_POST['NombreTabla'];
      $NombreCampo = $_POST['NombreCampo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->AutoCompletar($NombreTabla,$NombreCampo);
   break;

   case 'BuscarCodigoRepuesto':
      $rv_repuesto = $_POST['rv_repuesto'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->BuscarCodigoRepuesto($rv_repuesto);
   break;

   case 'BuscarDescripcionRepuesto':
      $rv_desc = $_POST['rv_desc'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->BuscarDescripcionRepuesto($rv_desc);
   break;

   case 'descargar_vales':
      $FechaInicioVales    = $_POST['FechaInicioVales'];
      $FechaTerminoVales   = $_POST['FechaTerminoVales'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->descargar_vales($FechaInicioVales,$FechaTerminoVales);
   break;

   case 'DocumentRoot':
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->DocumentRoot();
   break;

   case 'vales_observadas':
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->vales_observadas();
   break;

   default: header('Location: /inicio');
}