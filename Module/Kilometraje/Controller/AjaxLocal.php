<?php
// Accion declarada en el JS
$Accion = $_POST['Accion'];   
$Modulo = "Kilometraje";
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

   case 'SelectTipos':
      $TtablaKilometraje_Operacion= $_POST['TtablaKilometraje_Operacion'];
      $TtablaKilometraje_Tipo = $_POST['TtablaKilometraje_Tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectTipos($TtablaKilometraje_Operacion,$TtablaKilometraje_Tipo);
   break;

   case 'CalculoFecha':
      $inicio= $_POST['inicio'];
      $calculo = $_POST['calculo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CalculoFecha($inicio,$calculo);
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

   case 'SelectAnios':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectAnios();
   break;

   case 'CrearKmCarga':
      $inputFileName = $_FILES['archivoexcel']['tmp_name'];
      $Anio = $_POST['Anio'];
      $kmcarga_fecha = $_POST['kmcarga_fecha'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CrearKmCarga($inputFileName,$Anio,$kmcarga_fecha);
   break;

   case 'CreacionTablaKm':
      $NombreTabla = $_POST['NombreTabla'];
      $FechaInicioKm = $_POST['FechaInicioKm'];
      $FechaTerminoKm = $_POST['FechaTerminoKm'];
      $TipoBusKm = $_POST['TipoBusKm'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CreacionTablaKm($NombreTabla,$FechaInicioKm,$FechaTerminoKm,$TipoBusKm);
   break;

   case 'LeerKmCarga':
      $Anios = $_POST['Anios'];
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerKmCarga($Anios);
   break;

   case 'BorrarKmCarga':
      $kmcarga_id = $_POST['kmcarga_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarKmCarga($kmcarga_id);
   break;

   case 'BorrarKm':
      $kmcarga_id = $_POST['kmcarga_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarKm($kmcarga_id);
   break;

   case 'CrearColumnasKm':
      $FechaInicioKm = $_POST['FechaInicioKm'];
      $FechaTerminoKm = $_POST['FechaTerminoKm'];
      $TipoBusKm = $_POST['TipoBusKm'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CrearColumnasKm($FechaInicioKm, $FechaTerminoKm,$TipoBusKm);
   break;

   case 'LeerKm':
      $FechaInicioKm    = $_POST['FechaInicioKm'];
      $FechaTerminoKm   = $_POST['FechaTerminoKm'];
      $TipoKm           = $_POST['TipoKm'];
      $TipoBusKm        = $_POST['TipoBusKm'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->LeerKm($FechaInicioKm,$FechaTerminoKm,$TipoKm,$TipoBusKm);
   break;

   case 'BusesKm':
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BusesKm();
   break;

   case 'BuscarBusKm':
      $km_bus = $_POST['km_bus'];
      $km_fecha = $_POST['km_fecha'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BuscarBusKm($km_bus,$km_fecha);
   break;
   
   case 'ValidarKm':
      $km_bus= $_POST['km_bus'];
      $km_fecha = $_POST['km_fecha'];
      $km_kilometraje = $_POST['km_kilometraje'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ValidarKm($km_bus,$km_fecha,$km_kilometraje);
   break;

   case 'GrabarKm':
      $km_bus = $_POST['km_bus'];
      $km_fecha = $_POST['km_fecha'];
      $km_kilometraje = $_POST['km_kilometraje'];
      $km_motivo = $_POST['km_motivo'];
      $km_historial = $_POST['km_historial'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->GrabarKm($km_bus,$km_fecha,$km_kilometraje,$km_motivo,$km_historial);
   break;

   case 'DatosGraficoKm':
      $buskm = $_POST['buskm'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->DatosGraficoKm($buskm);
   break;

   case 'ValidarFechaCarga':

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ValidarFechaCarga();
   break;

   default: header('Location: /inicio');
}

