<?php
$Accion=$_POST['Accion'];
$Modulo="AjusteGenerales";

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

   case 'BuscarDataBD':
      $TablaBD    = $_POST['TablaBD'];
      $CampoBD    = $_POST['CampoBD'];
      $DataBuscar = $_POST['DataBuscar'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);
   break;

   case 'SelectTipos':
      $ttablausuario_operacion= $_POST['ttablausuario_operacion'];
      $ttablausuario_tipo = $_POST['ttablausuario_tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectTipos($ttablausuario_operacion,$ttablausuario_tipo);
   break;

   case 'SelectTiposUsuario':
      $ttablausuario_operacion= $_POST['ttablausuario_operacion'];
      $ttablausuario_tipo = $_POST['ttablausuario_tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectTiposUsuario($ttablausuario_operacion,$ttablausuario_tipo);
   break;

   case 'SelectObjeto':
      $cacces_nombremodulo = $_POST['cacces_nombremodulo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectObjeto($cacces_nombremodulo);
   break;

   case 'LeerBuses':
         //Recepcion de Variables del JS

         //Ejecuta Modelo
            MModel($Modulo,'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->LeerBuses();
   break;

   case 'CrearBuses':
      //Recepcion de Variables del JS
         $Bus_NroExterno=$_POST['Bus_NroExterno'];
         $Bus_NroVid=$_POST['Bus_NroVid'];
         $Bus_NroPlaca=$_POST['Bus_NroPlaca'];
         $Bus_Operacion=$_POST['Bus_Operacion'];
         $Bus_Detalle=$_POST['Bus_Detalle'];
         $Bus_Tipo=$_POST['Bus_Tipo'];
         $Bus_Tipo2=$_POST['Bus_Tipo2'];
         $Bus_Estado=$_POST['Bus_Estado'];
         $Bus_Tanques=$_POST['Bus_Tanques'];

      //Ejecuta Modelo
         MModel($Modulo,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->CrearBuses($Bus_NroExterno,$Bus_NroVid,$Bus_NroPlaca,$Bus_Operacion,$Bus_Detalle,$Bus_Tipo,$Bus_Tipo2,$Bus_Estado,$Bus_Tanques);
   break;

   case 'EditarBuses':
      //Recepcion de Variables del JS
      $Bus_NroExterno=$_POST['Bus_NroExterno'];
      $Bus_NroVid=$_POST['Bus_NroVid'];
      $Bus_NroPlaca=$_POST['Bus_NroPlaca'];
      $Bus_Operacion=$_POST['Bus_Operacion'];
      $Bus_Detalle=$_POST['Bus_Detalle'];
      $Bus_Tipo=$_POST['Bus_Tipo'];
      $Bus_Tipo2=$_POST['Bus_Tipo2'];
      $Bus_Estado=$_POST['Bus_Estado'];
      $Bus_Tanques=$_POST['Bus_Tanques'];

      //Ejecuta Modelo
         MModel($Modulo,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->EditarBuses($Bus_NroExterno,$Bus_NroVid,$Bus_NroPlaca,$Bus_Operacion,$Bus_Detalle,$Bus_Tipo,$Bus_Tipo2,$Bus_Estado,$Bus_Tanques);
   break;

   case 'BorrarBuses':
      //Recepcion de Variables del JS
         $Bus_NroExterno=$_POST['Bus_NroExterno'];

      //Ejecuta Modelo
         MModel($Modulo,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->BorrarBuses($Bus_NroExterno);
   break;

   case 'leer_roles':
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_roles();
   break;

   case 'crear_roles':
      $roles_dni                 = $_POST['roles_dni'];
      $roles_apellidosnombres    = strtoupper($_POST['roles_apellidosnombres']);
      $roles_nombrecorto         = strtoupper($_POST['roles_nombrecorto']);
      $roles_perfil              = strtoupper($_POST['roles_perfil']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->crear_roles($roles_dni, $roles_apellidosnombres, $roles_nombrecorto, $roles_perfil);
   break;

   case 'editar_roles':
      $roles_id               = $_POST['roles_id'];
      $roles_dni              = $_POST['roles_dni'];
      $roles_apellidosnombres = strtoupper($_POST['roles_apellidosnombres']);
      $roles_nombrecorto      = strtoupper($_POST['roles_nombrecorto']);
      $roles_perfil           = strtoupper($_POST['roles_perfil']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_roles($roles_id, $roles_dni, $roles_apellidosnombres, $roles_nombrecorto, $roles_perfil);
   break;

   case 'borrar_roles':
      $roles_id = $_POST['roles_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->borrar_roles($roles_id);
   break;

   case 'selectColaborador':
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta  = $InstanciaAjax->selectColaborador();
   break;

   case 'buscarDNI':
      $roles_apellidosnombres = $_POST['roles_apellidosnombres'];
   
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->buscarDNI($roles_apellidosnombres);
   break;
   
   case 'buscarNombreCorto':
      $roles_dni = $_POST['roles_dni'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->buscarNombreCorto($roles_dni);
   break;


   case 'LeerCalendario':
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerCalendario();
   break;

   case 'CrearCalendario':
      //Recepcion de Variables del JS
      $Calendario_Id=$_POST['Calendario_Id'];
      $Calendario_Anio=$_POST['Calendario_Anio'];
      $Calendario_TipoDia=$_POST['Calendario_TipoDia'];
      $Calendario_Semana=$_POST['Calendario_Semana'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearCalendario($Calendario_Id,$Calendario_Anio,$Calendario_TipoDia,$Calendario_Semana);
   break;

   case 'EditarCalendario':
      //Recepcion de Variables del JS
      $Calendario_Id=$_POST['Calendario_Id'];
      $Calendario_Anio=$_POST['Calendario_Anio'];
      $Calendario_TipoDia=$_POST['Calendario_TipoDia'];
      $Calendario_Semana=$_POST['Calendario_Semana'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarCalendario($Calendario_Id,$Calendario_Anio,$Calendario_TipoDia,$Calendario_Semana);
   break;

   case 'BorrarCalendario':
      //Recepcion de Variables del JS
      $Calendario_Id=$_POST['Calendario_Id'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarCalendario($Calendario_Id);
   break;

   case 'SelectTipos':
      //Recepcion de Variables del JS
      $Prog_Operacion= $_POST['Prog_Operacion'];
      $Ttabla_Tipo = $_POST['Tipo'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectTipos($Prog_Operacion,$Ttabla_Tipo);
   break;

   case 'LeerTipoCambio':
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerTipoCambio();
   break;

   case 'CrearTipoCambio':
      //Recepcion de Variables del JS
         $Bus_NroExterno=$_POST['Bus_NroExterno'];
         $Bus_NroVid=$_POST['Bus_NroVid'];
         $Bus_NroPlaca=$_POST['Bus_NroPlaca'];
         $Bus_Operacion=$_POST['Bus_Operacion'];
         $Bus_Detalle=$_POST['Bus_Detalle'];
         $Bus_Tipo=$_POST['Bus_Tipo'];
         $Bus_Tipo2=$_POST['Bus_Tipo2'];
         $Bus_Estado=$_POST['Bus_Estado'];
         $Bus_Tanques=$_POST['Bus_Tanques'];

      //Ejecuta Modelo
         MModel($Modulo,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->CrearTipoCambio($Bus_NroExterno,$Bus_NroVid,$Bus_NroPlaca,$Bus_Operacion,$Bus_Detalle,$Bus_Tipo,$Bus_Tipo2,$Bus_Estado,$Bus_Tanques);
   break;

   case 'CrearCargarTipoCambio':
      $tipocambio_url = $_POST['tipocambio_url'];
      $tipocambio_fechainicio = $_POST['tipocambio_fechainicio'];
      $tipocambio_fechafin = $_POST['tipocambio_fechafin'];
      $tipocambio_moneda = $_POST['tipocambio_moneda'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CrearCargarTipoCambio($tipocambio_url, $tipocambio_fechainicio, $tipocambio_fechafin, $tipocambio_moneda);
   break;

   case 'EditarTipoCambio':
      //Recepcion de Variables del JS
      $Bus_NroExterno=$_POST['Bus_NroExterno'];
      $Bus_NroVid=$_POST['Bus_NroVid'];
      $Bus_NroPlaca=$_POST['Bus_NroPlaca'];
      $Bus_Operacion=$_POST['Bus_Operacion'];
      $Bus_Detalle=$_POST['Bus_Detalle'];
      $Bus_Tipo=$_POST['Bus_Tipo'];
      $Bus_Tipo2=$_POST['Bus_Tipo2'];
      $Bus_Estado=$_POST['Bus_Estado'];
      $Bus_Tanques=$_POST['Bus_Tanques'];

      //Ejecuta Modelo
         MModel($Modulo,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->EditarTipoCambio($Bus_NroExterno,$Bus_NroVid,$Bus_NroPlaca,$Bus_Operacion,$Bus_Detalle,$Bus_Tipo,$Bus_Tipo2,$Bus_Estado,$Bus_Tanques);
   break;

   case 'BorrarTipoCambio':
      //Recepcion de Variables del JS
         $Bus_NroExterno=$_POST['Bus_NroExterno'];

      //Ejecuta Modelo
         MModel($Modulo,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->BorrarTipoCambio($Bus_NroExterno);
   break;

   case 'CargarModulo':
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CargarModulo();
   break;

   case 'CrearModulo':
      $Mod_Nombre       = $_POST['Mod_Nombre'];
      $Mod_NombreVista  = $_POST['Mod_NombreVista'];
      $Mod_Icono        = $_POST['Mod_Icono'];
      $mod_tipo         = $_POST['mod_tipo'];
      $mod_plegable     = $_POST['mod_plegable'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearModulo($Mod_Nombre,$Mod_NombreVista,$Mod_Icono, $mod_tipo, $mod_plegable);
   break;

   case 'EditarModulo':
      $Modulo_Id        = $_POST['Modulo_Id'];
      $Mod_Nombre       = $_POST['Mod_Nombre'];
      $Mod_NombreVista  = $_POST['Mod_NombreVista'];
      $Mod_Icono        = $_POST['Mod_Icono'];
      $mod_tipo         = $_POST['mod_tipo'];
      $mod_plegable     = $_POST['mod_plegable'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarModulo($Modulo_Id,$Mod_Nombre,$Mod_NombreVista,$Mod_Icono, $mod_tipo, $mod_plegable);
   break;

   case 'BorrarModulo':
      $Modulo_Id=$_POST['Modulo_Id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarModulo($Modulo_Id);
   break;

   case 'CargarPermisos':
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->CargarPermisos();
   break;

   case 'CrearPermisos':
      $PER_UsuarioId = $_POST['PER_UsuarioId'];
      $PER_ModuloId  = $_POST['PER_ModuloId'];
      $PER_ModInicio = $_POST['PER_ModInicio'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearPermisos($PER_UsuarioId, $PER_ModuloId, $PER_ModInicio);
   break;

   case 'EditarPermisos':
      $Permiso_Id=$_POST['Permiso_Id'];
      $PER_UsuarioId=$_POST['PER_UsuarioId'];
      $PER_ModuloId=$_POST['PER_ModuloId'];
      $PER_ModInicio=$_POST['PER_ModInicio'];
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->EditarPermisos($Permiso_Id, $PER_UsuarioId, $PER_ModuloId, $PER_ModInicio);
   break;

   case 'BorrarPermisos':
      $Permiso_Id=$_POST['Permiso_Id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarPermisos($Permiso_Id);
   break;

   case 'ValidarPermisos':
      $PER_UsuarioId=$_POST['PER_UsuarioId'];
      $PER_ModuloId=$_POST['PER_ModuloId'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ValidarPermisos($PER_UsuarioId,$PER_ModuloId);
   break;

   case 'SelectUsuario':
      //Recepcion de Variables del JS

      //Ejecuta Modelo
         MController($Modulo,'Logico');
         $InstanciaAjax= new Logico();
         $Respuesta=$InstanciaAjax->SelectUsuario();
   break;

   case 'SelectModulo':
         MController($Modulo,'Logico');
         $InstanciaAjax= new Logico();
         $Respuesta=$InstanciaAjax->SelectModulo();
   break;

   case 'SelectModuloControlAccesos':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectModuloControlAccesos();
   break;

   case 'LeerObjetos':
      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerObjetos();
   break;

   case 'CrearObjetos':
      //Recepcion de Variables del JS
      $objetos_id = $_POST['objetos_id'];
      $obj_nombremodulo = $_POST['obj_nombremodulo'];
      $obj_nombre = $_POST['obj_nombreobjeto'];
      $obj_descripcion = strtoupper($_POST['obj_descripcion']);

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearObjetos($objetos_id,$obj_nombremodulo,$obj_nombre,$obj_descripcion);
   break;

   case 'EditarObjetos':
      //Recepcion de Variables del JS
      $objetos_id = $_POST['objetos_id'];
      $obj_nombremodulo = $_POST['obj_nombremodulo'];
      $obj_nombre = $_POST['obj_nombreobjeto'];
      $obj_descripcion = strtoupper($_POST['obj_descripcion']);

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarObjetos($objetos_id,$obj_nombremodulo,$obj_nombre,$obj_descripcion);
   break;

   case 'BorrarObjetos':
      $objetos_id=$_POST['objetos_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarObjetos($objetos_id);
   break;

   case 'ValidarObjetos':
      $obj_nombremodulo = $_POST['obj_nombremodulo'];
      $obj_nombreobjeto = $_POST['obj_nombreobjeto'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ValidarObjetos($obj_nombremodulo, $obj_nombreobjeto);
   break;

   case 'CargarControlAccesos':
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CargarControlAccesos();
   break;

   case 'CrearControlAccesos':
      $controlaccesos_id = $_POST['controlaccesos_id'];
      $cacces_perfil = $_POST['cacces_perfil'];
      $cacces_nombremodulo = $_POST['cacces_nombremodulo'];
      $cacces_nombreobjeto = $_POST['cacces_nombreobjeto'];
      $cacces_acceso=$_POST['cacces_acceso'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CrearControlAccesos($controlaccesos_id, $cacces_perfil, $cacces_nombremodulo, $cacces_nombreobjeto, $cacces_acceso);
   break;

   case 'EditarControlAccesos':
      $controlaccesos_id = $_POST['controlaccesos_id'];
      $cacces_perfil = $_POST['cacces_perfil'];
      $cacces_nombremodulo = $_POST['cacces_nombremodulo'];
      $cacces_nombreobjeto = $_POST['cacces_nombreobjeto'];
      $cacces_acceso=$_POST['cacces_acceso'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->EditarControlAccesos($controlaccesos_id, $cacces_perfil, $cacces_nombremodulo, $cacces_nombreobjeto, $cacces_acceso);
   break;

   case 'BorrarControlAccesos':
      $controlaccesos_id = $_POST['controlaccesos_id'];
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarControlAccesos($controlaccesos_id);
   break;

   case 'ValidarControlAccesos':
      $cacces_perfil = $_POST['cacces_perfil'];
      $cacces_nombremodulo = $_POST['cacces_nombremodulo'];
      $cacces_nombreobjeto = $_POST['cacces_nombreobjeto'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ValidarControlAccesos($cacces_perfil, $cacces_nombremodulo, $cacces_nombreobjeto);
   break;

   case 'LeerMaestrouno':
      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerMaestrouno();
   break;

   case 'CrearMaestrouno':
      //Recepcion de Variables del JS
      $ttablamaestrouno_id = $_POST['ttablamaestrouno_id'];
      $ttablamaestrouno_tipo = strtoupper($_POST['ttablamaestrouno_tipo']);
      $ttablamaestrouno_operacion = strtoupper($_POST['ttablamaestrouno_operacion']);
      $ttablamaestrouno_detalle = strtoupper($_POST['ttablamaestrouno_detalle']);

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearMaestrouno($ttablamaestrouno_id,$ttablamaestrouno_tipo,$ttablamaestrouno_operacion,$ttablamaestrouno_detalle);
   break;

   case 'EditarMaestrouno':
      //Recepcion de Variables del JS
      $ttablamaestrouno_id = $_POST['ttablamaestrouno_id'];
      $ttablamaestrouno_tipo = strtoupper($_POST['ttablamaestrouno_tipo']);
      $ttablamaestrouno_operacion = strtoupper($_POST['ttablamaestrouno_operacion']);
      $ttablamaestrouno_detalle = strtoupper($_POST['ttablamaestrouno_detalle']);

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarMaestrouno($ttablamaestrouno_id,$ttablamaestrouno_tipo,$ttablamaestrouno_operacion,$ttablamaestrouno_detalle);
   break;

   case 'BorrarMaestrouno':
      //Recepcion de Variables del JS
      $ttablamaestrouno_id=$_POST['ttablamaestrouno_id'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarMaestrouno($ttablamaestrouno_id);
   break;

   case 'LeerUsuario':
      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerUsuario();
   break;

   case 'CrearUsuario':
      //Recepcion de Variables del JS
      $ttablausuario_id = $_POST['ttablausuario_id'];
      $ttablausuario_tipo = strtoupper($_POST['ttablausuario_tipo']);
      $ttablausuario_operacion = strtoupper($_POST['ttablausuario_operacion']);
      $ttablausuario_detalle = strtoupper($_POST['ttablausuario_detalle']);

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearUsuario($ttablausuario_id,$ttablausuario_tipo,$ttablausuario_operacion,$ttablausuario_detalle);
   break;

   case 'EditarUsuario':
      //Recepcion de Variables del JS
      $ttablausuario_id = $_POST['ttablausuario_id'];
      $ttablausuario_tipo = strtoupper($_POST['ttablausuario_tipo']);
      $ttablausuario_operacion = strtoupper($_POST['ttablausuario_operacion']);
      $ttablausuario_detalle = strtoupper($_POST['ttablausuario_detalle']);

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarUsuario($ttablausuario_id,$ttablausuario_tipo,$ttablausuario_operacion,$ttablausuario_detalle);
   break;

   case 'BorrarUsuario':
      //Recepcion de Variables del JS
      $ttablausuario_id=$_POST['ttablausuario_id'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarUsuario($ttablausuario_id);
   break;

   default: header('Location: /inicio');
}