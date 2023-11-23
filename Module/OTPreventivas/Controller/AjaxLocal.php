<?php
// Accion declarada en el JS
$Accion = $_POST['Accion'];   
$Modulo = "OTPreventivas";

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
      $NombreFormulario=$_POST['NombreFormulario'];
      $NombreObjeto=$_POST['NombreObjeto'];
      $Dato=$_POST['Dato'];

      MController($Modulo,'Accesos');
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->MostrarDiv($NombreFormulario,$NombreObjeto,$Dato);
   break;

   case 'AutoCompletar':
      $NombreTabla= $_POST['NombreTabla'];
      $NombreCampo = $_POST['NombreCampo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->AutoCompletar($NombreTabla,$NombreCampo);
   break;

   case 'DocumentRoot':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DocumentRoot();
   break;

   case 'descargar_otprv':
      $FechaInicioOTPrv    = $_POST['FechaInicioOTPrv'];
      $FechaTerminoOTPrv   = $_POST['FechaTerminoOTPrv'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->descargar_otprv($FechaInicioOTPrv,$FechaTerminoOTPrv);
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

   case 'CalculoFecha':
      $inicio= $_POST['inicio'];
      $calculo = $_POST['calculo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CalculoFecha($inicio,$calculo);
   break;

   case 'DiferenciaFecha':
      $inicio = $_POST['inicio'];
      $final = $_POST['final'];
      $dias = $_POST['dias'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DiferenciaFecha($inicio,$final,$dias);
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

   case 'LeerOTPrvCarga':
      //Recepcion de Variables del JS
         $Anios = $_POST['Anios'];
      //Ejecuta Modelo
         MModel($Modulo,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->LeerOTPrvCarga($Anios);
   break;

   case 'LeerOTPrv':
      $FechaInicioOTPrv = $_POST['FechaInicioOTPrv'];
      $FechaTerminoOTPrv = $_POST['FechaTerminoOTPrv'];
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerOTPrv($FechaInicioOTPrv,$FechaTerminoOTPrv);
   break;

   case 'SelectAnios':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectAnios();
   break;

   case 'CrearOTPrvCarga':
      $inputFileName = $_FILES['archivoexcel']['tmp_name'];
      $Anio = $_POST['Anio'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CrearOTPrvCarga($inputFileName,$Anio);
   break;

   case 'BorrarOTPrvCarga':
      $otprvcarga_id = $_POST['otprvcarga_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarOTPrvCarga($otprvcarga_id);
   break;

   case 'BorrarOTPrv':
      $otprvcarga_id = $_POST['otprvcarga_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarOTPrv($otprvcarga_id);
   break;

   case 'ValidarOTPrv':
      $otprvcarga_semanaprogramada = $_POST['otprvcarga_semanaprogramada'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ValidarOTPrv($otprvcarga_semanaprogramada);
   break;

   case 'CargarOTPrv':
      $cod_otpv = $_POST['cod_otpv'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CargarOTPrv($cod_otpv);
   break;

   case 'SelectUsuario':
      $Usua_Perfil = $_POST['Usua_Perfil'];
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectUsuario($Usua_Perfil);
   break;

   case 'SelectTecnico':
      $otpv_asociado = $_POST['otpv_asociado'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectTecnico($otpv_asociado);
   break;

   case 'BuscarTecnico':
      $otpv_asociado = $_POST['otpv_asociado'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarTecnico($otpv_asociado);
   break;

   case 'SelectTipos':
      $TtablaOTPreventivas_Operacion= $_POST['TtablaOTPreventivas_Operacion'];
      $TtablaOTPreventivas_Tipo = $_POST['TtablaOTPreventivas_Tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectTipos($TtablaOTPreventivas_Operacion,$TtablaOTPreventivas_Tipo);
   break;

   case 'CalculoKilometraje':
      $otpv_bus= $_POST['otpv_bus'];
      $otpv_inicio = $_POST['otpv_inicio'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CalculoKilometraje($otpv_bus,$otpv_inicio);
   break;

   case 'ValidarKm':
      $otpv_bus= $_POST['otpv_bus'];
      $otpv_inicio = $_POST['otpv_inicio'];
      $otpv_kmrealiza = $_POST['otpv_kmrealiza'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ValidarKm($otpv_bus,$otpv_inicio,$otpv_kmrealiza);
   break;

   case 'EditarOTPrv':
      $cod_otpv = $_POST['cod_otpv'];
      $otpv_cgm_cierra = $_POST['otpv_cgm_cierra'];
      $otpv_tecnico = $_POST['otpv_tecnico'];
      $otpv_inicio = $_POST['otpv_inicio'];
      $otpv_fin = $_POST['otpv_fin'];
      $otpv_kmrealiza = $_POST['otpv_kmrealiza'];
      $otpv_hmotor = $_POST['otpv_hmotor'];
      $otpv_componente = $_POST['otpv_componente'];
      $otpv_obs_as = strtoupper($_POST['otpv_obs_as']);
      $otpv_obs_cgm = strtoupper($_POST['otpv_obs_cgm']);
      $otpv_obs_cierre_ad = strtoupper($_POST['otpv_obs_cierre_ad']);
      $otpv_obs_cierre_ad2 = strtoupper($_POST['otpv_obs_cierre_ad2']);
      $otpv_obs_km = strtoupper($_POST['otpv_obs_km']);
      $otpv_estado = $_POST['otpv_estado'];

      $otpv_turno = $_POST['otpv_turno']; 
      $otpv_date_prog = $_POST['otpv_date_prog']; 
      $otpv_bus = $_POST['otpv_bus']; 
      $otpv_fecuencia = strtoupper($_POST['otpv_fecuencia']); 
      $otpv_descripcion = strtoupper($_POST['otpv_descripcion']); 
      $otpv_asociado = $_POST['otpv_asociado'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->EditarOTPrv($cod_otpv, $otpv_cgm_cierra, $otpv_tecnico, $otpv_inicio, $otpv_fin, $otpv_kmrealiza, $otpv_hmotor, $otpv_componente, $otpv_obs_as, $otpv_obs_cgm, $otpv_obs_cierre_ad, $otpv_obs_cierre_ad2, $otpv_obs_km, $otpv_estado, $otpv_turno, $otpv_date_prog, $otpv_bus, $otpv_fecuencia, $otpv_descripcion, $otpv_asociado);
   break;

   case 'ver_ot_prv':
      $cod_ot_prv = $_POST['cod_ot_prv'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->ver_ot_prv($cod_ot_prv);
   break;

   case 'otprv_observadas':
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->otprv_observadas();
   break;

   default: header('Location: /inicio');
}

