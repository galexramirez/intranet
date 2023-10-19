<?php

// Accion declarada en el JS
$Accion=$_POST['Accion'];
$Module="AjusteOperaciones";

switch ($Accion)
{
   case 'LeerTipoTablas':
      //Recepcion de Variables del JS

      //Ejecuta Modelo
         MModel($Module,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->LeerTipoTablas();
   break;

   case 'CrearTipoTablas':
      //Recepcion de Variables del JS
         $Ttabla_Id=$_POST['Ttabla_Id'];
         $Ttabla_Tipo=$_POST['Ttabla_Tipo'];
         $Ttabla_Operacion=$_POST['Ttabla_Operacion'];
         $Ttabla_Detalle=$_POST['Ttabla_Detalle'];

      //Ejecuta Modelo
         MModel($Module,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->CrearTipoTablas($Ttabla_Id,$Ttabla_Tipo,$Ttabla_Operacion,$Ttabla_Detalle);
   break;

   case 'EditarTipoTablas':
      //Recepcion de Variables del JS
         $Ttabla_Id=$_POST['Ttabla_Id'];
         $Ttabla_Tipo=$_POST['Ttabla_Tipo'];
         $Ttabla_Operacion=$_POST['Ttabla_Operacion'];
         $Ttabla_Detalle=$_POST['Ttabla_Detalle'];

      //Ejecuta Modelo
         MModel($Module,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->EditarTipoTablas($Ttabla_Id,$Ttabla_Tipo,$Ttabla_Operacion,$Ttabla_Detalle);
   break;

   case 'BorrarTipoTablas':
      //Recepcion de Variables del JS
         $Ttabla_Id=$_POST['Ttabla_Id'];

      //Ejecuta Modelo
         MModel($Module,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->BorrarTipoTablas($Ttabla_Id);
   break;

   case 'SelectTipos':
      //Recepcion de Variables del JS
         $Prog_Operacion= $_POST['Prog_Operacion'];
         $Ttabla_Tipo = $_POST['Tipo'];

      //Ejecuta Modelo
         MController($Module,'Logico');
         $InstanciaAjax= new Logico();
         $Respuesta=$InstanciaAjax->SelectTipos($Prog_Operacion,$Ttabla_Tipo);
   break;

   case 'LeerDistancias':
      //Recepcion de Variables del JS

      //Ejecuta Modelo
      MModel($Module,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerDistancias();
   break;

   case 'CrearDistancias':
      //Recepcion de Variables del JS
      $Dist_Operacion=$_POST['Dist_Operacion'];   
      $Dist_Servicio=$_POST['Dist_Servicio']; 
      $Dist_Orden=$_POST['Dist_Orden']; 
      $Dist_Sentido=$_POST['Dist_Sentido'];   
      $Dist_LugarOrigen=$_POST['Dist_LugarOrigen'];
      $Dist_LugarDestino=$_POST['Dist_LugarDestino'];
      $Dist_Kilometros=$_POST['Dist_Kilometros'];

      //Ejecuta Modelo
      MModel($Module,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearDistancias($Dist_Operacion,$Dist_Orden,$Dist_Sentido,$Dist_Servicio,$Dist_LugarOrigen,$Dist_LugarDestino,$Dist_Kilometros);
   break;

   case 'EditarDistancias':
      //Recepcion de Variables del JS
      $Distancias_Id=$_POST['Distancias_Id'];
      $Dist_Operacion=$_POST['Dist_Operacion'];   
      $Dist_Orden=$_POST['Dist_Orden']; 
      $Dist_Sentido=$_POST['Dist_Sentido'];   
      $Dist_Servicio=$_POST['Dist_Servicio'];   
      $Dist_LugarOrigen=$_POST['Dist_LugarOrigen'];
      $Dist_LugarDestino=$_POST['Dist_LugarDestino'];
      $Dist_Kilometros=$_POST['Dist_Kilometros'];

      //Ejecuta Modelo
      MModel($Module,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarDistancias($Distancias_Id,$Dist_Operacion,$Dist_Orden,$Dist_Sentido,$Dist_Servicio,$Dist_LugarOrigen,$Dist_LugarDestino,$Dist_Kilometros);
   break;

   case 'BorrarDistancias':
      //Recepcion de Variables del JS
      $Distancias_Id=$_POST['Distancias_Id'];

      //Ejecuta Modelo
      MModel($Module,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarDistancias($Distancias_Id);
   break;

   case 'LeerTipoTablaAccidentes':
      //Recepcion de Variables del JS

      //Ejecuta Modelo
         MModel($Module,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->LeerTipoTablaAccidentes();
   break;

   case 'CrearTipoTablaAccidentes':
      //Recepcion de Variables del JS
         $TtablaAccidentes_Id=$_POST['TtablaAccidentes_Id'];
         $TtablaAccidentes_Tipo=$_POST['TtablaAccidentes_Tipo'];
         $TtablaAccidentes_Operacion=$_POST['TtablaAccidentes_Operacion'];
         $TtablaAccidentes_Detalle=$_POST['TtablaAccidentes_Detalle'];

      //Ejecuta Modelo
         MModel($Module,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->CrearTipoTablaAccidentes($TtablaAccidentes_Id,$TtablaAccidentes_Tipo,$TtablaAccidentes_Operacion,$TtablaAccidentes_Detalle);
   break;

   case 'EditarTipoTablaAccidentes':
      //Recepcion de Variables del JS
         $TtablaAccidentes_Id=$_POST['TtablaAccidentes_Id'];
         $TtablaAccidentes_Tipo=$_POST['TtablaAccidentes_Tipo'];
         $TtablaAccidentes_Operacion=$_POST['TtablaAccidentes_Operacion'];
         $TtablaAccidentes_Detalle=$_POST['TtablaAccidentes_Detalle'];

      //Ejecuta Modelo
         MModel($Module,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->EditarTipoTablaAccidentes($TtablaAccidentes_Id,$TtablaAccidentes_Tipo,$TtablaAccidentes_Operacion,$TtablaAccidentes_Detalle);
   break;

   case 'BorrarTipoTablaAccidentes':
      //Recepcion de Variables del JS
         $TtablaAccidentes_Id=$_POST['TtablaAccidentes_Id'];

      //Ejecuta Modelo
         MModel($Module,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->BorrarTipoTablaAccidentes($TtablaAccidentes_Id);
   break;

   case 'LeerTipoTablaComportamiento':
      //Recepcion de Variables del JS

      //Ejecuta Modelo
         MModel($Module,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->LeerTipoTablaComportamiento();
   break;

   case 'CrearTipoTablaComportamiento':
      //Recepcion de Variables del JS
         $TtablaComportamiento_Id=$_POST['TtablaComportamiento_Id'];
         $TtablaComportamiento_Tipo=$_POST['TtablaComportamiento_Tipo'];
         $TtablaComportamiento_Operacion=$_POST['TtablaComportamiento_Operacion'];
         $TtablaComportamiento_Detalle=$_POST['TtablaComportamiento_Detalle'];

      //Ejecuta Modelo
         MModel($Module,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->CrearTipoTablaComportamiento($TtablaComportamiento_Id,$TtablaComportamiento_Tipo,$TtablaComportamiento_Operacion,$TtablaComportamiento_Detalle);
   break;

   case 'EditarTipoTablaComportamiento':
      //Recepcion de Variables del JS
         $TtablaComportamiento_Id=$_POST['TtablaComportamiento_Id'];
         $TtablaComportamiento_Tipo=$_POST['TtablaComportamiento_Tipo'];
         $TtablaComportamiento_Operacion=$_POST['TtablaComportamiento_Operacion'];
         $TtablaComportamiento_Detalle=$_POST['TtablaComportamiento_Detalle'];

      //Ejecuta Modelo
         MModel($Module,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->EditarTipoTablaComportamiento($TtablaComportamiento_Id,$TtablaComportamiento_Tipo,$TtablaComportamiento_Operacion,$TtablaComportamiento_Detalle);
   break;

   case 'BorrarTipoTablaComportamiento':
      //Recepcion de Variables del JS
         $TtablaComportamiento_Id=$_POST['TtablaComportamiento_Id'];

      //Ejecuta Modelo
         MModel($Module,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->BorrarTipoTablaComportamiento($TtablaComportamiento_Id);
   break;

   case 'LeerTipoTablaInasistencias':
      //Recepcion de Variables del JS

      //Ejecuta Modelo
         MModel($Module,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->LeerTipoTablaInasistencias();
   break;

   case 'CrearTipoTablaInasistencias':
      //Recepcion de Variables del JS
         $TtablaInasistencias_Id=$_POST['TtablaInasistencias_Id'];
         $TtablaInasistencias_Tipo=$_POST['TtablaInasistencias_Tipo'];
         $TtablaInasistencias_Operacion=$_POST['TtablaInasistencias_Operacion'];
         $TtablaInasistencias_Detalle=$_POST['TtablaInasistencias_Detalle'];

      //Ejecuta Modelo
         MModel($Module,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->CrearTipoTablaInasistencias($TtablaInasistencias_Id,$TtablaInasistencias_Tipo,$TtablaInasistencias_Operacion,$TtablaInasistencias_Detalle);
   break;

   case 'EditarTipoTablaInasistencias':
      //Recepcion de Variables del JS
         $TtablaInasistencias_Id=$_POST['TtablaInasistencias_Id'];
         $TtablaInasistencias_Tipo=$_POST['TtablaInasistencias_Tipo'];
         $TtablaInasistencias_Operacion=$_POST['TtablaInasistencias_Operacion'];
         $TtablaInasistencias_Detalle=$_POST['TtablaInasistencias_Detalle'];

      //Ejecuta Modelo
         MModel($Module,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->EditarTipoTablaInasistencias($TtablaInasistencias_Id,$TtablaInasistencias_Tipo,$TtablaInasistencias_Operacion,$TtablaInasistencias_Detalle);
   break;

   case 'BorrarTipoTablaInasistencias':
      //Recepcion de Variables del JS
         $TtablaInasistencias_Id=$_POST['TtablaInasistencias_Id'];

      //Ejecuta Modelo
         MModel($Module,'CRUD');
         $InstanciaAjax= new CRUD();
         $Respuesta=$InstanciaAjax->BorrarTipoTablaInasistencias($TtablaInasistencias_Id);
   break;

   case 'leer_matriz_accidentes':
      MModel($Module,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->leer_matriz_accidentes();
   break;

   case 'crear_matriz_accidentes':
      $accidentesmatriz_id = $_POST['accidentesmatriz_id'];
      $acmt_campo          = strtoupper($_POST['acmt_campo']);
      $acmt_busqueda       = strtoupper($_POST['acmt_busqueda']);
      $acmt_respuesta      = strtoupper($_POST['acmt_respuesta']);

      MModel($Module,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->crear_matriz_accidentes($accidentesmatriz_id, $acmt_campo, $acmt_busqueda, $acmt_respuesta);
   break;

   case 'editar_matriz_accidentes':
      $accidentesmatriz_id = $_POST['accidentesmatriz_id'];
      $acmt_campo          = strtoupper($_POST['acmt_campo']);
      $acmt_busqueda       = strtoupper($_POST['acmt_busqueda']);
      $acmt_respuesta      = strtoupper($_POST['acmt_respuesta']);

      MModel($Module,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_matriz_accidentes($accidentesmatriz_id, $acmt_campo, $acmt_busqueda, $acmt_respuesta);
   break;

   case 'borrar_matriz_accidentes':
      $accidentesmatriz_id = $_POST['accidentesmatriz_id'];
   
      MModel($Module,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->borrar_matriz_accidentes($accidentesmatriz_id);
   break;

   default: header('Location: /inicio');
}