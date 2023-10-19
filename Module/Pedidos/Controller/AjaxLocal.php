<?php
$Modulo = "Pedidos";
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
      $Dato1=$_POST['Dato1'];
      $Dato2=$_POST['Dato2'];

      MController($Modulo,'Accesos');
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->MostrarDiv($NombreFormulario,$NombreObjeto,$Dato1,$Dato2);
   break;

   case 'MostrarObjetos':
      $NombresObjetos = $_POST['NombresObjetos'];
      $Accion = $_POST['Accion'];

      MController($Modulo,'Accesos');
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->MostrarObjetos($NombresObjetos,$Accion);
   break;

   case 'SelectTipos':
      $ttablapedidos_operacion= $_POST['ttablapedidos_operacion'];
      $ttablapedidos_tipo = $_POST['ttablapedidos_tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectTipos($ttablapedidos_operacion,$ttablapedidos_tipo);
   break;

   case 'select_roles':
      $roles_perfil = $_POST['roles_perfil'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->select_roles($roles_perfil);
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

   case 'auto_completar_tipo':
      $nombre_tabla  = $_POST['nombre_tabla'];
      $nombre_campo  = $_POST['nombre_campo'];
      $nombre_tipo   = $_POST['nombre_tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->auto_completar_tipo($nombre_tabla, $nombre_campo, $nombre_tipo);
   break;

   case 'DocumentRoot':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DocumentRoot();
   break;

   case 'BuscarDataBD':
      $TablaBD = $_POST['TablaBD'];
      $CampoBD = $_POST['CampoBD'];
      $DataBuscar = $_POST['DataBuscar'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);
   break;

   case 'select_proveedor':
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->select_proveedor();
   break;

   case 'buses_pedido':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->buses_pedido();
   break;

   case 'leer_pedido':
      $FechaInicioPedidos = $_POST['FechaInicioPedidos'];
      $FechaTerminoPedidos = $_POST['FechaTerminoPedidos'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->leer_pedido($FechaInicioPedidos,$FechaTerminoPedidos);
   break;

   case 'cargar_material_pedido':
      $pedido_id = $_POST['pedido_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->cargar_material_pedido($pedido_id);
   break;

   case 'generar_pedido':
      $pedido_id                 = $_POST['pedido_id'];
      $pedi_fechacreacion        = $_POST['pedi_fechacreacion'];
      $pedi_fecharequerimiento   = $_POST['pedi_fecharequerimiento'];
      $pedi_prioridad            = $_POST['pedi_prioridad'];
      $pedi_centrocosto          = $_POST['pedi_centrocosto'];
      $pedi_proceso              = $_POST['pedi_proceso'];
      $pedi_nombre_contacto      = $_POST['pedi_nombre_contacto'];
      $pedi_direccion_entrega    = $_POST['pedi_direccion_entrega'];
      $pedi_orden_compra_directa = $_POST['pedi_orden_compra_directa'];
      $pedi_tipo                 = $_POST['pedi_tipo'];
      $pedi_estado               = $_POST['pedi_estado'];
      $pedi_log                  = $_POST['pedi_log'];
      $obs_log                   = strtoupper($_POST['obs_log']);
      $array_data                = json_decode($_POST['array_data'],true);

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->generar_pedido($pedido_id, $pedi_fechacreacion, $pedi_fecharequerimiento, $pedi_prioridad, $pedi_centrocosto, $pedi_proceso, $pedi_nombre_contacto, $pedi_direccion_entrega, $pedi_orden_compra_directa, $pedi_tipo, $pedi_estado, $pedi_log, $obs_log, $array_data);
   break;

   case 'editar_pedido':
      $pedido_id                 = $_POST['pedido_id'];
      $pedi_fechacreacion        = $_POST['pedi_fechacreacion'];
      $pedi_fecharequerimiento   = $_POST['pedi_fecharequerimiento'];
      $pedi_prioridad            = $_POST['pedi_prioridad'];
      $pedi_bus                  = $_POST['pedi_bus'];
      $pedi_centrocosto          = $_POST['pedi_centrocosto'];
      $pedi_proceso              = $_POST['pedi_proceso'];
      $pedi_nombre_contacto      = $_POST['pedi_nombre_contacto'];
      $pedi_direccion_entrega    = $_POST['pedi_direccion_entrega'];
      $pedi_orden_compra_directa = $_POST['pedi_orden_compra_directa'];
      $pedi_tipo                 = $_POST['pedi_tipo'];
      $pedi_estado               = $_POST['pedi_estado'];
      $pedi_log                  = $_POST['pedi_log'];
      $obs_log                   = strtoupper($_POST['obs_log']);
      $array_data                = json_decode($_POST['array_data'],true);

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->editar_pedido($pedido_id, $pedi_fechacreacion, $pedi_fecharequerimiento, $pedi_prioridad, $pedi_centrocosto, $pedi_proceso, $pedi_nombre_contacto, $pedi_direccion_entrega, $pedi_orden_compra_directa, $pedi_tipo, $pedi_estado, $pedi_log, $obs_log, $array_data);
   break;

   case 'estado_pedido':
      $pedido_id        = $_POST['pedido_id'];
      $pedi_estado      = $_POST['pedi_estado'];
      $pedi_log         = $_POST['pedi_log'];
      $obs_log          = strtoupper($_POST['obs_log']);
      $pedi_estado_obs  = $_POST['pedi_estado_obs'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->estado_pedido($pedido_id, $pedi_estado, $pedi_log, $obs_log, $pedi_estado_obs);
   break;

   case 'cargar_pedido':
      $pedido_id = $_POST['pedido_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->cargar_pedido($pedido_id);
   break;

   case 'buscar_material_id':
      $mp_materialid = $_POST['mp_materialid'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->buscar_material_id($mp_materialid);
   break;

   case 'buscar_material_descripcion':
      $mp_descripcion = $_POST['mp_descripcion'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->buscar_material_descripcion($mp_descripcion);
   break;

   case 'cargar_cotizacion':
      $coti_pedidoid = $_POST['coti_pedidoid'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->cargar_cotizacion($coti_pedidoid);
   break;

   case 'guardar_cotizacion':
      $coti_pedidoid    = $_POST['coti_pedidoid'];
      $coti_fecha       = $_POST['coti_fecha'];
      $coti_razonsocial = $_POST['coti_razonsocial'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->guardar_cotizacion($coti_pedidoid, $coti_fecha, $coti_razonsocial);
   break;

   case 'ver_cotizacion':
      $pedido_id     = $_POST['pedido_id'];
      $coti_estado   = $_POST['coti_estado'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     =$InstanciaAjax->ver_cotizacion($pedido_id, $coti_estado);
   break;

   case 'cotizacion_pdf':
      $cotizacion_id = $_POST['cotizacion_id'];

      MController($Modulo, 'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->cotizacion_pdf($cotizacion_id);
   break;

   case 'cargar_material_cotizacion':
      $cotizacion_id = $_POST['cotizacion_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->cargar_material_cotizacion($cotizacion_id);
   break;

   case 'editar_cotizacion':
      $cotizacion_id = $_POST['cotizacion_id'];
      $array_data = json_decode($_POST['array_data'],true);

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->editar_cotizacion($cotizacion_id, $array_data);
   break;

   case 'valida_cerrar_cotizacion':
      $pedi_estado = $_POST['pedi_estado'];
      $coti_estado = $_POST['coti_estado'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->valida_cerrar_cotizacion($pedi_estado, $coti_estado);
   break;

   case 'atencion_pedido':
      $array_data = json_decode($_POST['array_data'],true);
      $pedido_id  = $_POST['pedido_id'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->atencion_pedido($pedido_id, $array_data);
   break;

   case 'validar_material_solicitado':
      $tmc_materialid                     = $_POST['tmc_materialid'];
      $tmc_cantidad_pedido                = $_POST['tmc_cantidad_pedido'];
      $tmc_cantidad_solicitada            = $_POST['tmc_cantidad_solicitada'];
      $tmc_cantidad_solicitada_anterior   = $_POST['tmc_cantidad_solicitada_anterior'];
      $array_data                         = json_decode($_POST['array_data'],true);
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->validar_material_solicitado($tmc_materialid, $tmc_cantidad_pedido, $tmc_cantidad_solicitada, $tmc_cantidad_solicitada_anterior, $array_data);
   break;

   case 'generar_orden_compra':
      $array_data      = json_decode($_POST['array_data'],true);
      $atencion_pedido = $_POST['atencion_pedido'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->generar_orden_compra($array_data, $atencion_pedido);
   break;

   case 'leer_orden_compra':
      $orco_pedidoid = $_POST['orco_pedidoid'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_orden_compra($orco_pedidoid);
   break;

   case 'cargar_material_orden_compra':
      $ordencompra_id = $_POST['ordencompra_id'];
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->cargar_material_orden_compra($ordencompra_id);
   break;

   case 'estado_orden_compra':
      $ordencompra_id   = $_POST['ordencompra_id'];
      $orco_estado      = $_POST['orco_estado'];
      $obs_log          = strtoupper($_POST['obs_log']);

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->estado_orden_compra($ordencompra_id, $orco_estado, $obs_log);
   break;


   case 'orden_compra_pdf':
      $ordencompra_id = $_POST['ordencompra_id'];

      MController($Modulo, 'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->orden_compra_pdf($ordencompra_id);
   break;

   case 'grabar_imagen':
      $cotimag_cotizacionid = $_POST['cotizacion_id'];
      $cotimag_imagen = addslashes(file_get_contents($_FILES['cotizacion_imagen']['tmp_name']));
         
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->grabar_imagen($cotimag_cotizacionid, $cotimag_imagen);
   break;

   case 'editar_imagen':
      $cotimag_cotizacionid = $_POST['cotizacion_id'];
      $cotimag_imagen = addslashes(file_get_contents($_FILES['cotizacion_imagen']['tmp_name']));
         
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->editar_imagen($cotimag_cotizacionid, $cotimag_imagen);
   break;

   case 'buscar_imagen':
      $cotimag_cotizacionid = $_POST['cotimag_cotizacionid'];
      $cotimag_tipoimagen = $_POST['cotimag_tipoimagen'];
         
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->buscar_imagen($cotimag_cotizacionid, $cotimag_tipoimagen);
   break;

   default: header('Location: /inicio');
}