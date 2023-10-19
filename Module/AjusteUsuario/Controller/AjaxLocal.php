<?php
// Accion declarada en el JS
$Accion=$_POST['Accion'];   
$Modulo = "AjusteUsuario";

switch ($Accion)
   {
   case 'SelectTipos':
      $ttablamaestrouno_operacion= $_POST['ttablamaestrouno_operacion'];
      $ttablamaestrouno_tipo = $_POST['ttablamaestrouno_tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectTipos($ttablamaestrouno_operacion,$ttablamaestrouno_tipo);
   break;

   case 'CargarAjusteUsuario':
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->Read();
   break;

   case 'EditarAjusteUsuario':
      $Usua_Password=$_POST['Usua_Password'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->Update($Usua_Password);
   break;

   case 'BuscarFotografia':
         MModel($Modulo,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->BuscarFotografia();
   break;

   default: header('Location: /inicio');
}

?>