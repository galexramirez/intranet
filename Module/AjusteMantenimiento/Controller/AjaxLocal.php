<?php

// Accion declarada en el JS
$Accion=$_POST['Accion'];   
$Modulo="AjusteMantenimiento";

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

   case 'LeerTipoTablaOTPreventivas':
      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerTipoTablaOTPreventivas();
   break;

   case 'CrearTipoTablaOTPreventivas':
      //Recepcion de Variables del JS
      $TtablaOTPreventivas_Id=$_POST['TtablaOTPreventivas_Id'];
      $TtablaOTPreventivas_Tipo=$_POST['TtablaOTPreventivas_Tipo'];
      $TtablaOTPreventivas_Operacion=$_POST['TtablaOTPreventivas_Operacion'];
      $TtablaOTPreventivas_Detalle=$_POST['TtablaOTPreventivas_Detalle'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearTipoTablaOTPreventivas($TtablaOTPreventivas_Id,$TtablaOTPreventivas_Tipo,$TtablaOTPreventivas_Operacion,$TtablaOTPreventivas_Detalle);
   break;

   case 'EditarTipoTablaOTPreventivas':
      //Recepcion de Variables del JS
      $TtablaOTPreventivas_Id=$_POST['TtablaOTPreventivas_Id'];
      $TtablaOTPreventivas_Tipo=$_POST['TtablaOTPreventivas_Tipo'];
      $TtablaOTPreventivas_Operacion=$_POST['TtablaOTPreventivas_Operacion'];
      $TtablaOTPreventivas_Detalle=$_POST['TtablaOTPreventivas_Detalle'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarTipoTablaOTPreventivas($TtablaOTPreventivas_Id,$TtablaOTPreventivas_Tipo,$TtablaOTPreventivas_Operacion,$TtablaOTPreventivas_Detalle);
   break;

   case 'BorrarTipoTablaOTPreventivas':
      //Recepcion de Variables del JS
      $TtablaOTPreventivas_Id=$_POST['TtablaOTPreventivas_Id'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarTipoTablaOTPreventivas($TtablaOTPreventivas_Id);
   break;

   case 'LeerTipoTablaOTCorrectivas':
      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerTipoTablaOTCorrectivas();
   break;

   case 'CrearTipoTablaOTCorrectivas':
      //Recepcion de Variables del JS
      $ttablaotcorrectivas_id=$_POST['ttablaotcorrectivas_id'];
      $ttablaotcorrectivas_tipo=$_POST['ttablaotcorrectivas_tipo'];
      $ttablaotcorrectivas_operacion=$_POST['ttablaotcorrectivas_operacion'];
      $ttablaotcorrectivas_detalle=$_POST['ttablaotcorrectivas_detalle'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearTipoTablaOTCorrectivas($ttablaotcorrectivas_id,$ttablaotcorrectivas_tipo,$ttablaotcorrectivas_operacion,$ttablaotcorrectivas_detalle);
   break;

   case 'EditarTipoTablaOTCorrectivas':
      //Recepcion de Variables del JS
      $ttablaotcorrectivas_id=$_POST['ttablaotcorrectivas_id'];
      $ttablaotcorrectivas_tipo=$_POST['ttablaotcorrectivas_tipo'];
      $ttablaotcorrectivas_operacion=$_POST['ttablaotcorrectivas_operacion'];
      $ttablaotcorrectivas_detalle=$_POST['ttablaotcorrectivas_detalle'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarTipoTablaOTCorrectivas($ttablaotcorrectivas_id,$ttablaotcorrectivas_tipo,$ttablaotcorrectivas_operacion,$ttablaotcorrectivas_detalle);
   break;

   case 'BorrarTipoTablaOTCorrectivas':
      //Recepcion de Variables del JS
      $ttablaotcorrectivas_id=$_POST['ttablaotcorrectivas_id'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarTipoTablaOTCorrectivas($ttablaotcorrectivas_id);
   break;

   case 'LeerAsociados':
      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerAsociados();
   break;

   case 'CrearAsociados':
      //Recepcion de Variables del JS
      $cod_resasoc=$_POST['cod_resasoc'];
      $ra_nombres=$_POST['ra_nombres'];
      $ra_asociado=$_POST['ra_asociado'];
      $ra_ruc_asociado=$_POST['ra_ruc_asociado'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearAsociados($cod_resasoc,$ra_nombres,$ra_asociado, $ra_ruc_asociado);
   break;

   case 'EditarAsociados':
      //Recepcion de Variables del JS
      $cod_resasoc=$_POST['cod_resasoc'];
      $ra_nombres=$_POST['ra_nombres'];
      $ra_asociado=$_POST['ra_asociado'];
      $ra_ruc_asociado=$_POST['ra_ruc_asociado'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarAsociados($cod_resasoc,$ra_nombres,$ra_asociado, $ra_ruc_asociado);
   break;

   case 'BorrarAsociados':
      //Recepcion de Variables del JS
      $cod_resasoc = $_POST['cod_resasoc'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarAsociados($cod_resasoc);
   break;

   case 'LeerOrigenes':
      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerOrigenes();
   break;

   case 'CrearOrigenes':
      //Recepcion de Variables del JS
      $cod_origen=$_POST['cod_origen'];
      $or_nombre=$_POST['or_nombre'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearOrigenes($cod_origen,$or_nombre);
   break;

   case 'EditarOrigenes':
      //Recepcion de Variables del JS
      $cod_origen=$_POST['cod_origen'];
      $or_nombre=$_POST['or_nombre'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarOrigenes($cod_origen,$or_nombre);
   break;

   case 'BorrarOrigenes':
      //Recepcion de Variables del JS
      $cod_origen=$_POST['cod_origen'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarOrigenes($cod_origen);
   break;

   case 'LeerTipoTablaVales':
      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerTipoTablaVales();
   break;

   case 'CrearTipoTablaVales':
      //Recepcion de Variables del JS
      $ttablavales_id=$_POST['ttablavales_id'];
      $ttablavales_tipo=$_POST['ttablavales_tipo'];
      $ttablavales_operacion=$_POST['ttablavales_operacion'];
      $ttablavales_detalle=$_POST['ttablavales_detalle'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearTipoTablaVales($ttablavales_id,$ttablavales_tipo,$ttablavales_operacion,$ttablavales_detalle);
   break;

   case 'EditarTipoTablaVales':
      //Recepcion de Variables del JS
      $ttablavales_id=$_POST['ttablavales_id'];
      $ttablavales_tipo=$_POST['ttablavales_tipo'];
      $ttablavales_operacion=$_POST['ttablavales_operacion'];
      $ttablavales_detalle=$_POST['ttablavales_detalle'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarTipoTablaVales($ttablavales_id,$ttablavales_tipo,$ttablavales_operacion,$ttablavales_detalle);
   break;

   case 'BorrarTipoTablaVales':
      //Recepcion de Variables del JS
      $ttablavales_id=$_POST['ttablavales_id'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarTipoTablaVales($ttablavales_id);
   break;

   case 'leer_unidad_medida':
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_unidad_medida();
   break;

   case 'crear_unidad_medida':
      $unidad_medida  = $_POST['unidad_medida'];
      $um_descripcion = $_POST['um_descripcion'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->crear_unidad_medida($unidad_medida,$um_descripcion);
   break;

   case 'editar_unidad_medida':
      $unidad_medida  = $_POST['unidad_medida'];
      $um_descripcion = $_POST['um_descripcion'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_unidad_medida($unidad_medida,$um_descripcion);
   break;

   case 'borrar_unidad_medida':
      $unidad_medida  = $_POST['unidad_medida'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->borrar_unidad_medida($unidad_medida);
   break;

   case 'LeerTipoTablaMateriales':
      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerTipoTablaMateriales();
   break;

   case 'CrearTipoTablaMateriales':
      //Recepcion de Variables del JS
      $ttablamateriales_id=$_POST['ttablamateriales_id'];
      $ttablamateriales_tipo=$_POST['ttablamateriales_tipo'];
      $ttablamateriales_operacion=$_POST['ttablamateriales_operacion'];
      $ttablamateriales_detalle=$_POST['ttablamateriales_detalle'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearTipoTablaMateriales($ttablamateriales_id,$ttablamateriales_tipo,$ttablamateriales_operacion,$ttablamateriales_detalle);
   break;

   case 'EditarTipoTablaMateriales':
      //Recepcion de Variables del JS
      $ttablamateriales_id=$_POST['ttablamateriales_id'];
      $ttablamateriales_tipo=$_POST['ttablamateriales_tipo'];
      $ttablamateriales_operacion=$_POST['ttablamateriales_operacion'];
      $ttablamateriales_detalle=$_POST['ttablamateriales_detalle'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarTipoTablaMateriales($ttablamateriales_id,$ttablamateriales_tipo,$ttablamateriales_operacion,$ttablamateriales_detalle);
   break;

   case 'BorrarTipoTablaMateriales':
      //Recepcion de Variables del JS
      $ttablamateriales_id=$_POST['ttablamateriales_id'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarTipoTablaMateriales($ttablamateriales_id);
   break;

   case 'LeerTipoTablaPedidos':
      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerTipoTablaPedidos();
   break;

   case 'CrearTipoTablaPedidos':
      //Recepcion de Variables del JS
      $ttablapedidos_id=$_POST['ttablapedidos_id'];
      $ttablapedidos_tipo=$_POST['ttablapedidos_tipo'];
      $ttablapedidos_operacion=$_POST['ttablapedidos_operacion'];
      $ttablapedidos_detalle=$_POST['ttablapedidos_detalle'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearTipoTablaPedidos($ttablapedidos_id,$ttablapedidos_tipo,$ttablapedidos_operacion,$ttablapedidos_detalle);
   break;

   case 'EditarTipoTablaPedidos':
      //Recepcion de Variables del JS
      $ttablapedidos_id=$_POST['ttablapedidos_id'];
      $ttablapedidos_tipo=$_POST['ttablapedidos_tipo'];
      $ttablapedidos_operacion=$_POST['ttablapedidos_operacion'];
      $ttablapedidos_detalle=$_POST['ttablapedidos_detalle'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarTipoTablaPedidos($ttablapedidos_id,$ttablapedidos_tipo,$ttablapedidos_operacion,$ttablapedidos_detalle);
   break;

   case 'BorrarTipoTablaPedidos':
      //Recepcion de Variables del JS
      $ttablapedidos_id=$_POST['ttablapedidos_id'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarTipoTablaPedidos($ttablapedidos_id);
   break;

   case 'leer_tc_inventario':
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->leer_tc_inventario();
   break;

   case 'crear_tc_inventario':
      $tc_inventario_id=$_POST['tc_inventario_id'];
      $tcin_tipo=$_POST['tcin_tipo'];
      $tcin_operacion=$_POST['tcin_operacion'];
      $tcin_detalle=$_POST['tcin_detalle'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->crear_tc_inventario($tc_inventario_id,$tcin_tipo,$tcin_operacion,$tcin_detalle);
   break;

   case 'editar_tc_inventario':
      //Recepcion de Variables del JS
      $tc_inventario_id=$_POST['tc_inventario_id'];
      $tcin_tipo=$_POST['tcin_tipo'];
      $tcin_operacion=$_POST['tcin_operacion'];
      $tcin_detalle=$_POST['tcin_detalle'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->editar_tc_inventario($tc_inventario_id,$tcin_tipo,$tcin_operacion,$tcin_detalle);
   break;

   case 'borrar_tc_inventario':
      //Recepcion de Variables del JS
      $tc_inventario_id=$_POST['tc_inventario_id'];

      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->borrar_tc_inventario($tc_inventario_id);
   break;

   case 'leer_tc_componente':
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_tc_componente();
   break;

   case 'crear_tc_componente':
      $tc_componente_id = $_POST['tc_componente_id'];
      $tc_ficha         = $_POST['tc_ficha'];
      $tc_categoria1    = $_POST['tc_categoria1'];
      $tc_categoria2    = $_POST['tc_categoria2'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->crear_tc_componente($tc_componente_id, $tc_ficha, $tc_categoria1, $tc_categoria2);
   break;

   case 'editar_tc_componente':
      $tc_componente_id = $_POST['tc_componente_id'];
      $tc_ficha         = $_POST['tc_ficha'];
      $tc_categoria1    = $_POST['tc_categoria1'];
      $tc_categoria2    = $_POST['tc_categoria2'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_tc_componente($tc_componente_id, $tc_ficha, $tc_categoria1, $tc_categoria2);
   break;

   case 'borrar_tc_componente':
      $tc_componente_id=$_POST['tc_componente_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->borrar_tc_componente($tc_componente_id);
   break;

   case 'leer_tc_inspeccion':
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_tc_inspeccion();
   break;

   case 'crear_tc_inspeccion':
      $tc_inspeccion_id = $_POST['tc_inspeccion_id'];
      $tc_ficha         = $_POST['tc_ficha'];
      $tc_categoria1    = $_POST['tc_categoria1'];
      $tc_categoria2    = $_POST['tc_categoria2'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->crear_tc_inspeccion($tc_inspeccion_id, $tc_ficha, $tc_categoria1, $tc_categoria2);
   break;

   case 'editar_tc_inspeccion':
      $tc_inspeccion_id = $_POST['tc_inspeccion_id'];
      $tc_ficha         = $_POST['tc_ficha'];
      $tc_categoria1    = $_POST['tc_categoria1'];
      $tc_categoria2    = $_POST['tc_categoria2'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_tc_inspeccion($tc_inspeccion_id, $tc_ficha, $tc_categoria1, $tc_categoria2);
   break;

   case 'borrar_tc_inspeccion':
      $tc_inspeccion_id=$_POST['tc_inspeccion_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->borrar_tc_inspeccion($tc_inspeccion_id);
   break;

   default: header('Location: /inicio');
}