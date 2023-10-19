<?php

// Accion declarada en el JS
$Accion=$_POST['Accion'];   

switch ($Accion)
{

   case 'CargarNomina':
      //Recepcion de Variables del JS
         $FechaInicio=$_POST['FechaInicio'];
         $FechaTermino=$_POST['FechaTermino'];

         //Ejecuta Modelo
         MModel('Nomina','CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->CargarNomina($FechaInicio,$FechaTermino);
   break;

   default: header('Location: /inicio');
}

?>