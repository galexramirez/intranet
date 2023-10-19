<?php
$Modulo = "vales_v3";
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

   case 'BuscarDataBD':
      $TablaBD    = $_POST['TablaBD'];
      $CampoBD    = $_POST['CampoBD'];
      $DataBuscar = $_POST['DataBuscar'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);
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
      $va_obs_cgm       = strtoupper($_POST['va_obs_cgm']);
      $tva_obs_aom      = strtoupper($_POST['tva_obs_aom']);
      $va_obs_aom       = strtoupper($_POST['va_obs_aom']);
      $va_estado        = $_POST['va_estado'];
      $va_tipo          = $_POST['va_tipo'];
      $array_data       = json_decode($_POST['array_data'],true);

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->generar_vales($cod_vale, $va_ot, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $tva_obs_aom, $va_obs_aom, $va_estado, $va_tipo, $array_data);
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
      $va_tipo          = $_POST['va_tipo'];
      $array_data       = json_decode($_POST['array_data'],true);

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->editar_vales($cod_vale, $va_ot, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $tva_obs_aom, $va_obs_aom, $va_estado, $va_tipo, $array_data);
   break;

   case 'cargar_vales':
      $cod_vale = $_POST['cod_vale'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->cargar_vales($cod_vale);
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
      $rv_repuesto      = $_POST['rv_repuesto'];
      $va_asociado      = $_POST['va_asociado'];
      $va_date_genera   = $_POST['va_date_genera'];
      $va_tipo          = $_POST['va_tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->BuscarCodigoRepuesto($rv_repuesto, $va_asociado, $va_date_genera, $va_tipo);
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

   case 'imprimir_documento':
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->imprimir_documento();
   break;

   default: header('Location: /inicio');
}