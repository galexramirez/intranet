<?php
$Accion = $_POST['Accion'];   
$Modulo = 'costo_accidentes';
switch ($Accion)
   {

   //:::::::::::::::::::::::::::::: CREACION DE OBJETOS :::::::::::::::::::::::::::::::::::::::::::::://

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

   ///:::::::::::::::::::::::::::::: FIN DE CREACION DE OBJETOS :::::::::::::::::::::::::::::::::::::///

   case 'buscar_costo_accidentes':
      $fecha_inicio  = $_POST['fecha_inicio'];
      $fecha_termino = $_POST['fecha_termino'];
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->buscar_costo_accidentes($fecha_inicio, $fecha_termino);
   break;

   case 'DocumentRoot':
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->DocumentRoot();
   break;

   case 'buscar_pdf':
      $tabla               = $_POST['tabla'];
      $campo_archivo       = $_POST['campo_archivo'];
      $campo_buscar        = $_POST['campo_buscar'];
      $dato_buscar         = $_POST['dato_buscar'];
      $campo_tipo_archivo  = $_POST['campo_tipo_archivo'];
      $dato_tipo_archivo   = $_POST['dato_tipo_archivo'];
      $nombre_archivo      = $_POST['nombre_archivo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->buscar_pdf($tabla, $campo_archivo, $campo_buscar, $dato_buscar, $campo_tipo_archivo, $dato_tipo_archivo, $nombre_archivo);
   break;

   case 'unlink_pdf':
      $archivo = $_POST['archivo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->unlink_pdf($archivo);
   break;

   case 'grabar_imagen':
      $accidentes_id     = $_POST['accidentes_id'];
      $acci_tipo_imagen  = $_POST['acci_tipo_imagen'];
      $acci_imagen       = addslashes(file_get_contents($_FILES['acci_imagen']['tmp_name']));
         
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->grabar_imagen($accidentes_id, $acci_tipo_imagen, $acci_imagen);
   break;

   case 'editar_imagen':
      $accidentes_id    = $_POST['accidentes_id'];
      $acci_tipo_imagen = $_POST['acci_tipo_imagen'];
      $acci_imagen      = addslashes(file_get_contents($_FILES['acci_imagen']['tmp_name']));
         
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_imagen($accidentes_id, $acci_tipo_imagen, $acci_imagen);
   break;

   case 'crear_costo_accidente':
      $accidentes_id          = $_POST['accidentes_id'];
      $acos_monto_mano_obra   = $_POST['acos_monto_mano_obra'];
      $acos_monto_insumos     = $_POST['acos_monto_insumos'];
      $acos_costo_manto       = $_POST['acos_costo_manto'];
      $acos_monto_impuesto    = $_POST['acos_monto_impuesto'];
      $acos_monto_cotizado    = $_POST['acos_monto_cotizado'];
         
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->crear_costo_accidente($accidentes_id, $acos_monto_mano_obra, $acos_monto_insumos, $acos_costo_manto, $acos_monto_impuesto, $acos_monto_cotizado);
   break;

   case 'editar_costo_accidente':
      $accidentes_id          = $_POST['accidentes_id'];
      $acos_monto_mano_obra   = $_POST['acos_monto_mano_obra'];
      $acos_monto_insumos     = $_POST['acos_monto_insumos'];
      $acos_costo_manto       = $_POST['acos_costo_manto'];
      $acos_monto_impuesto    = $_POST['acos_monto_impuesto'];
      $acos_monto_cotizado    = $_POST['acos_monto_cotizado'];
         
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_costo_accidente($accidentes_id, $acos_monto_mano_obra, $acos_monto_insumos, $acos_costo_manto, $acos_monto_impuesto, $acos_monto_cotizado);
   break;

   case 'cerrar_firma_convenio':
      $accidentes_id          = $_POST['accidentes_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->cerrar_firma_convenio($accidentes_id);
   break;

   default: header('Location: /inicio');

}