<?php
$Modulo = "Materiales";
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

   case 'LeerMateriales':
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerMateriales();
   break;

   case 'GeneraCodigoMateriales':
      //Recepcion de Variables del JS
      $cod_asignacion = $_POST['cod_asignacion'];
      $cod_macrosistema = substr($_POST['cod_macrosistema'],0,2);
      $cod_sistema = substr($_POST['cod_sistema'],0,2);
      $cod_tarjeta = substr($_POST['cod_tarjeta'],0,1);
      $cod_condicion = substr($_POST['cod_condicion'],0,1);
      $cod_flota = substr($_POST['cod_flota'],0,2);

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->GenerarCodigoMateriales($cod_asignacion,$cod_macrosistema,$cod_sistema,$cod_tarjeta,$cod_condicion,$cod_flota);
   break;

   case 'BuscarCodigoMateriales':
      //Recepcion de Variables del JS
      $cod_material = $_POST['cod_material'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarCodigoMateriales($cod_material);
   break;

   case 'CrearMateriales':
      //Recepcion de Variables del JS
      $material_id            = strtoupper($_POST['material_id']);
      $material_descripcion   = strtoupper($_POST['material_descripcion']);
      $material_unidadmedida  = strtoupper($_POST['material_unidadmedida']);
      $material_patrimonial   = strtoupper($_POST['material_patrimonial']);
      $material_categoria     = strtoupper($_POST['material_categoria']);
      $material_estado        = strtoupper($_POST['material_estado']);
      $material_observaciones = strtoupper($_POST['material_observaciones']);
      $material_obslog        = strtoupper($_POST['material_obslog']);
      $material_macrosistema  = $_POST["material_macrosistema"];
      $material_sistema       = $_POST["material_sistema"];
      $material_tarjeta       = $_POST["material_tarjeta"];
      $material_condicion     = $_POST["material_condicion"];
      $material_flota         = $_POST["material_flota"];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CrearMateriales($material_id, $material_descripcion, $material_unidadmedida, $material_patrimonial, $material_categoria,$material_estado,$material_observaciones, $material_obslog, $material_macrosistema, $material_sistema, $material_tarjeta, $material_condicion, $material_flota);
   break;

   case 'EditarMateriales':
      $material_id            = strtoupper($_POST['material_id']);
      $material_unidadmedida  = strtoupper($_POST['material_unidadmedida']);
      $material_descripcion   = strtoupper($_POST['material_descripcion']);
      $material_patrimonial   = strtoupper($_POST['material_patrimonial']);
      $material_categoria     = strtoupper($_POST['material_categoria']);
      $material_estado        = strtoupper($_POST['material_estado']);
      $material_observaciones = strtoupper($_POST['material_observaciones']);
      $material_obslog        = strtoupper($_POST['material_obslog']);

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->EditarMateriales($material_id, $material_descripcion, $material_unidadmedida, $material_patrimonial, $material_categoria, $material_estado, $material_observaciones, $material_obslog);
   break;

   case 'LeerPreciosProveedor':
      $asignarcod_ruc = $_POST['asignarcod_ruc'];
      $asignarcod_fecha = $_POST['asignarcod_fecha'];
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerPreciosProveedor($asignarcod_ruc, $asignarcod_fecha);
   break;

   case 'leer_precios_material':
      $asignarcod_ruc         = $_POST['asignarcod_ruc'];
      $asignarcod_fecha       = $_POST['asignarcod_fecha'];
      $asignarcod_proveedor   = $_POST['asignarcod_proveedor'];
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_precios_material($asignarcod_ruc, $asignarcod_fecha, $asignarcod_proveedor);
   break;

   case 'SelectTipos':
      $ttablamateriales_operacion= $_POST['ttablamateriales_operacion'];
      $ttablamateriales_tipo = $_POST['ttablamateriales_tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectTipos($ttablamateriales_operacion,$ttablamateriales_tipo);
   break;

   case 'AutoCompletar':
      $NombreTabla= $_POST['NombreTabla'];
      $NombreCampo = $_POST['NombreCampo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->AutoCompletar($NombreTabla,$NombreCampo);
   break;

   case 'auto_completar':
      $tabla               = $_POST['tabla'];
      $campo_codigo        = $_POST['campo_codigo'];
      $campo_descripcion   = $_POST['campo_descripcion'];
      $campo_asociado      = $_POST['campo_asociado'];
      $asociado            = $_POST['asociado'];
      $campo_fecha         = $_POST['campo_fecha'];
      $fecha               = $_POST['fecha'];
      $campo_tipo          = $_POST['campo_tipo'];
      $tipo                = $_POST['tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->auto_completar($tabla, $campo_codigo, $campo_descripcion, $campo_asociado, $asociado, $campo_fecha, $fecha, $campo_tipo, $tipo);
   break;

   case 'BuscarAsignarCodigoId':
      $material_id = $_POST['material_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->BuscarAsignarCodigoId($material_id);
   break;

   case 'BuscarAsignarCodigoDescripcion':
      $material_descripcion = $_POST['material_descripcion'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->BuscarAsignarCodigoDescripcion($material_descripcion);
   break;

   case 'EditarAsignarCodigos':
      $precioprov_codproveedor = $_POST['precioprov_codproveedor'];
      $precioprov_descripcion = $_POST['precioprov_descripcion'];
      $precioprov_razonsocial = $_POST['precioprov_razonsocial'];
      $precioprov_materialid = $_POST['precioprov_materialid'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->EditarAsignarCodigos($precioprov_codproveedor, $precioprov_descripcion, $precioprov_razonsocial, $precioprov_materialid);
   break;

   case 'MostrarPreciosProveedor':
      $material_id = $_POST['material_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->MostrarPreciosProveedor($material_id);
   break;

   case 'LeerProveedores':
      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerProveedores();
   break;

   case 'CrearProveedores':
      $prov_ruc                     = $_POST['prov_ruc'];
      $prov_razonsocial             = strtoupper($_POST['prov_razonsocial']);
      $prov_contacto                = strtoupper($_POST['prov_contacto']);
      $prov_cta_detraccion_soles    = $_POST['prov_cta_detraccion_soles'];
      $prov_cta_banco_soles         = $_POST['prov_cta_banco_soles'];
      $prov_cta_banco_dolares       = $_POST['prov_cta_banco_dolares'];
      $prov_cta_interbanco_soles    = $_POST['prov_cta_interbanco_soles'];
      $prov_cta_interbanco_dolares  = $_POST['prov_cta_interbanco_dolares'];
      $prov_condicion_pago          = $_POST['prov_condicion_pago'];
      $prov_correo                  = strtolower($_POST['prov_correo']);
      $prov_telefono                = $_POST['prov_telefono'];
      $prov_estado                  = $_POST['prov_estado'];
      $prov_log                     = $_POST['prov_log'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->CrearProveedores($prov_ruc,$prov_razonsocial,$prov_contacto,$prov_cta_detraccion_soles,$prov_cta_banco_soles,$prov_cta_banco_dolares,$prov_cta_interbanco_soles,$prov_cta_interbanco_dolares,$prov_condicion_pago,$prov_correo,$prov_telefono,$prov_estado, $prov_log);
   break;

   case 'EditarProveedores':
      $prov_ruc                     = $_POST['prov_ruc'];
      $prov_razonsocial             = strtoupper($_POST['prov_razonsocial']);
      $prov_contacto                = strtoupper($_POST['prov_contacto']);
      $prov_cta_detraccion_soles    = $_POST['prov_cta_detraccion_soles'];
      $prov_cta_banco_soles         = $_POST['prov_cta_banco_soles'];
      $prov_cta_banco_dolares       = $_POST['prov_cta_banco_dolares'];
      $prov_cta_interbanco_soles    = $_POST['prov_cta_interbanco_soles'];
      $prov_cta_interbanco_dolares  = $_POST['prov_cta_interbanco_dolares'];
      $prov_condicion_pago          = $_POST['prov_condicion_pago'];
      $prov_correo                  = strtolower($_POST['prov_correo']);
      $prov_telefono                = $_POST['prov_telefono'];
      $prov_estado                  = $_POST['prov_estado'];
      $prov_log                     = $_POST['prov_log'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->EditarProveedores($prov_ruc,$prov_razonsocial,$prov_contacto,$prov_cta_detraccion_soles,$prov_cta_banco_soles,$prov_cta_banco_dolares,$prov_cta_interbanco_soles,$prov_cta_interbanco_dolares,$prov_condicion_pago,$prov_correo,$prov_telefono,$prov_estado, $prov_log);
   break;

   case 'SelectProveedores':
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->SelectProveedores();
   break;

   case 'SelectAnios':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectAnios();
   break;

   case 'LeerCargarPrecios':
      $Anios = $_POST['Anios'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerCargarPrecios($Anios);
   break;

   case 'CrearCargarPrecios':
      $inputFileName = $_FILES['archivoexcel']['tmp_name'];
      $Anio = $_POST['Anio'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CrearCargarPrecios($inputFileName,$Anio);
   break;

   case 'EliminarCargarPreciosProveedor':
      $cpm_id = $_POST['cpm_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EliminarCargarPreciosProveedor($cpm_id);
   break;

   case 'AnularCargarPreciosProveedor':
      $cpm_id = $_POST['cpm_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->AnularCargarPreciosProveedor($cpm_id);
   break;

   case 'AnularPreciosProveedor':
      $precioprov_id = $_POST['precioprov_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->AnularPreciosProveedor($precioprov_id);
   break;

   case 'ValidarCargarPrecios':
      $cpm_id = $_POST['cpm_id'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ValidarCargarPrecios($cpm_id);
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

   case 'LeerAsignarCodigos':
      $asignarcod_ruc = $_POST['asignarcod_ruc'];
      $asignarcod_tipo = $_POST['asignarcod_tipo'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerAsignarCodigos($asignarcod_ruc, $asignarcod_tipo);
   break;

   case 'CrearPreciosProveedor':
      $precioprov_codproveedor   = $_POST['precioprov_codproveedor'];
      $precioprov_descripcion    = $_POST['precioprov_descripcion'];
      $precioprov_marca          = $_POST['precioprov_marca'];
      $precioprov_procedencia    = $_POST['precioprov_procedencia'];
      $precioprov_unidadmedida   = $_POST['precioprov_unidadmedida'];
      $precioprov_garantia       = $_POST['precioprov_garantia'];
      $precioprov_moneda         = $_POST['precioprov_moneda'];
      $precioprov_precio         = $_POST['precioprov_precio'];
      $precioprov_preciosoles    = $_POST['precioprov_preciosoles'];
      $precioprov_fechavigencia  = $_POST['precioprov_fechavigencia'];
      $precioprov_razonsocial    = $_POST['precioprov_razonsocial'];
      $precioprov_obslog         = strtoupper($_POST['precioprov_obslog']);
      $precioprov_tipo           = $_POST['precioprov_tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CrearPreciosProveedor($precioprov_codproveedor, $precioprov_descripcion, $precioprov_marca, $precioprov_procedencia, $precioprov_unidadmedida, $precioprov_garantia, $precioprov_moneda, $precioprov_precio, $precioprov_preciosoles, $precioprov_fechavigencia, $precioprov_razonsocial, $precioprov_obslog, $precioprov_tipo);
   break;

   case 'CompararFechaActual':
      $fecha = $_POST['fecha'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CompararFechaActual($fecha);
   break;

   case 'GrabarImagen':
      //Recepcion de Variables del JS | addslashes(file_get_contents() | mysql_real_escape_string(file_get_contents()
      $matimag_codproveedor = $_POST['matimag_codproveedor'];
      $asignarcod_razonsocial = $_POST['asignarcod_razonsocial'];
      $matimag_tipoimagen = $_POST['matimag_tipoimagen'];
      $matimag_imagen = addslashes(file_get_contents($_FILES['matimag_imagen']['tmp_name']));
         
      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->GrabarImagen($matimag_codproveedor, $asignarcod_razonsocial, $matimag_tipoimagen, $matimag_imagen);
   break;

   case 'EditarImagen':
      //Recepcion de Variables del JS | addslashes(file_get_contents() | mysql_real_escape_string(file_get_contents()
      $matimag_codproveedor = $_POST['matimag_codproveedor'];
      $asignarcod_razonsocial = $_POST['asignarcod_razonsocial'];
      $matimag_tipoimagen = $_POST['matimag_tipoimagen'];
      $matimag_imagen = addslashes(file_get_contents($_FILES['matimag_imagen']['tmp_name']));
         
      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->EditarImagen($matimag_codproveedor, $asignarcod_razonsocial, $matimag_tipoimagen, $matimag_imagen);
   break;

   case 'BuscarImagen':
      $matimag_codproveedor = $_POST['matimag_codproveedor'];
      $asignarcod_razonsocial = $_POST['asignarcod_razonsocial'];
      $matimag_tipoimagen = $_POST['matimag_tipoimagen'];
         
      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarImagen($matimag_codproveedor, $asignarcod_razonsocial, $matimag_tipoimagen);
   break;

   case 'DocumentRoot':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DocumentRoot();
   break;

   case 'unidad_medida':
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->unidad_medida();
   break;

   case 'encontrar_dato':
      $tabla            = $_POST['tabla'];
      $campo_encontrar  = $_POST['campo_encontrar'];
      $data_buscar      = $_POST['data_buscar'];
      $campo_devuelto   = $_POST['campo_devuelto'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->encontrar_dato($tabla, $campo_encontrar, $data_buscar, $campo_devuelto);
   break;

   case 'CalculoFecha':
      $inicio  = $_POST['inicio'];
      $calculo = $_POST['calculo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->CalculoFecha($inicio,$calculo);
   break;

   default: header('Location: /inicio');
}