<?php
$Accion=$_POST['Accion']; 
$Modulo='Usuario';  

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

   case 'BuscarDataBD':
      $TablaBD    = $_POST['TablaBD'];
      $CampoBD    = $_POST['CampoBD'];
      $DataBuscar = $_POST['DataBuscar'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);
   break;

   case 'CargaTablaUsuario':
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->Read();
   break;

   case 'CrearUsuario':
      $Usuario_Id       = $_POST['Usuario_Id'];
      $Usua_Nombres     = $_POST['Usua_Nombres'];
      $Usua_NombreCorto = $_POST['Usua_NombreCorto'];
      $Usua_UsuarioWeb  = $_POST['Usua_UsuarioWeb'];
      $Usua_Password    = $_POST['Usua_Password'];
      $Usua_Perfil      = $_POST['Usua_Perfil'];
      $Usua_Estado      = $_POST['Usua_Estado'];
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     =$InstanciaAjax->Create($Usuario_Id,$Usua_Nombres,$Usua_NombreCorto,$Usua_UsuarioWeb,$Usua_Password,$Usua_Perfil,$Usua_Estado);
   break;

   case 'EditarUsuario':
      $Usuario_Id       = $_POST['Usuario_Id'];
      $Usua_Nombres     = $_POST['Usua_Nombres'];
      $Usua_NombreCorto = $_POST['Usua_NombreCorto'];
      $Usua_UsuarioWeb  = $_POST['Usua_UsuarioWeb'];
      $Usua_Password    = $_POST['Usua_Password'];
      $Usua_Perfil      = $_POST['Usua_Perfil'];
      $Usua_Estado      = $_POST['Usua_Estado'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->Update($Usuario_Id,$Usua_Nombres,$Usua_NombreCorto,$Usua_UsuarioWeb,$Usua_Password,$Usua_Perfil,$Usua_Estado);
   break;

   case 'BorrarUsuario':
      $Usuario_Id = $_POST['Usuario_Id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->Delete($Usuario_Id);
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

   default: header('Location: /inicio');
}

