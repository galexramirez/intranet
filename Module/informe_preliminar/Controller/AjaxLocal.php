<?php
$Accion = $_POST['Accion'];   
$Modulo = 'informe_preliminar';
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

   ///:::::::::::::::::::::::::::::: FIN DE CREACION DE OBJETOS :::::::::::::::::::::::::::::::::::::///

   case 'buscar_informe_preliminar':
      $fecha_inicio  = $_POST['fecha_inicio'];
      $fecha_termino = $_POST['fecha_termino'];
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->buscar_informe_preliminar($fecha_inicio, $fecha_termino);
   break;

   case 'descargar_informe_preliminar':
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_termino = $_POST['fecha_termino'];
     
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->descargar_informe_preliminar($fecha_inicio, $fecha_termino);
   break;

   case 'pdf_informe_preliminar':
      $accidentes_id = $_POST['accidentes_id'];

      MController($Modulo, 'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->pdf_informe_preliminar($accidentes_id);
   break;

   case 'DocumentRoot':
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->DocumentRoot();
   break;

   case 'buscar_imagen':
      $accidentes_id    = $_POST['accidentes_id'];
      $Acci_TipoImagen  = $_POST['Acci_TipoImagen'];
         
      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->buscar_imagen($accidentes_id, $Acci_TipoImagen);
   break;

   case 'buscar_pdf':
      $tabla               = $_POST['tabla'];
      $campo_archivo       = $_POST['campo_archivo'];
      $campo_buscar        = $_POST['campo_buscar'];
      $dato_buscar         = $_POST['dato_buscar'];
      $campo_tipo_archivo  = $_POST['campo_tipo_archivo'];
      $dato_tipo_archivo   = $_POST['dato_tipo_archivo'];
      $nombre_archivo      = $_POST['nombre_archivo'];

      //Ejecuta Modelo
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

   default: header('Location: /inicio');

}