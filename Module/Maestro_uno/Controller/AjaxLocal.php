<?php
// Accion declarada en el JS
$Accion=$_POST['Accion'];   
$Modulo = "Maestro_uno";

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
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->MostrarDiv($NombreFormulario,$NombreObjeto,$Dato);
   break;

   case 'SelectTipos':
      $ttablamaestrouno_operacion= $_POST['ttablamaestrouno_operacion'];
      $ttablamaestrouno_tipo = $_POST['ttablamaestrouno_tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectTipos($ttablamaestrouno_operacion,$ttablamaestrouno_tipo);
   break;

   case 'BuscarDataBD':
      $TablaBD    = $_POST['TablaBD'];
      $CampoBD    = $_POST['CampoBD'];
      $DataBuscar = $_POST['DataBuscar'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);
   break;

   case 'CargaTablaMaestro_uno':
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->Read();
   break;

   case 'CrearMaestro_uno':
      $Colaborador_id         = $_POST['Colaborador_id'];
      $Colab_ApellidosNombres = strtoupper($_POST['Colab_ApellidosNombres']);
      $Colab_CargoActual      = $_POST['Colab_CargoActual'];
      $Colab_Estado           = $_POST['Colab_Estado'];
      $Colab_FechaIngreso     = $_POST['Colab_FechaIngreso'];
      $Colab_FechaCese        = $_POST['Colab_FechaCese'];
      $Colab_Email            = $_POST['Colab_Email'];
      $Colab_Direccion        = strtoupper($_POST['Colab_Direccion']);
      $Colab_Distrito         = $_POST['Colab_Distrito'];
      $Colab_CodigoCortoPT    = $_POST['Colab_CodigoCortoPT'];
      $Colab_PerfilEvaluacion = $_POST['Colab_PerfilEvaluacion'];
      $Colab_nombre_corto     = strtoupper($_POST['Colab_nombre_corto']);
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->Create($Colaborador_id,$Colab_ApellidosNombres,$Colab_CargoActual,$Colab_Estado,$Colab_FechaIngreso,$Colab_FechaCese,$Colab_Email,$Colab_Direccion,$Colab_Distrito,$Colab_CodigoCortoPT,$Colab_PerfilEvaluacion, $Colab_nombre_corto);
   break;

   case 'EditarMaestro_uno':
      $Colaborador_id         = $_POST['Colaborador_id'];
      $Colab_ApellidosNombres = strtoupper($_POST['Colab_ApellidosNombres']);
      $Colab_CargoActual      = $_POST['Colab_CargoActual'];
      $Colab_Estado           = $_POST['Colab_Estado'];
      $Colab_FechaIngreso     = $_POST['Colab_FechaIngreso'];
      $Colab_FechaCese        = $_POST['Colab_FechaCese'];
      $Colab_Email            = $_POST['Colab_Email'];
      $Colab_Direccion        = strtoupper($_POST['Colab_Direccion']);
      $Colab_Distrito         = $_POST['Colab_Distrito'];
      $Colab_CodigoCortoPT    = $_POST['Colab_CodigoCortoPT'];
      $Colab_PerfilEvaluacion = $_POST['Colab_PerfilEvaluacion'];
      $Colab_nombre_corto     = strtoupper($_POST['Colab_nombre_corto']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->Update($Colaborador_id,$Colab_ApellidosNombres,$Colab_CargoActual,$Colab_Estado,$Colab_FechaIngreso,$Colab_FechaCese,$Colab_Email,$Colab_Direccion,$Colab_Distrito,$Colab_CodigoCortoPT,$Colab_PerfilEvaluacion, $Colab_nombre_corto);
   break;

   case 'BorrarMaestro_uno':
      $Colaborador_id=$_POST['Colaborador_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->Delete($Colaborador_id);
   break;

   case 'FotografiaMaestro_uno':
      $Colaborador_id=$_POST['Colaborador_id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->FotografiaMaestroUno($Colaborador_id);
   break;

   case 'GrabarFotografia':
      $Colaborador_id   = $_POST['Colaborador_id'];
      $Colab_Fotografia = addslashes(file_get_contents($_FILES['Colab_Fotografia']['tmp_name']));
         
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->GrabarFotografia($Colaborador_id,$Colab_Fotografia);
   break;

   default: header('Location: /inicio');
}

?>