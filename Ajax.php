<?php
set_time_limit(10000);
// Nivel Modulo o Servicio donde se esta trabajando
    $MoS=$_POST['MoS'];

// Nombre  del Modulo o Servicio donde se esta trabajando    
    $NombreMoS=$_POST['NombreMoS']; 

// 0.3 Funciones para enrutamiento MVC
    // Servicios
    function SModel($NomModulo,$Modelo,$array=array())
       {     extract($array);    require_once  "Services/$NomModulo/Model/$Modelo.php"; }
    function SView($NomModulo,$Vista,$array=array())
       {     extract($array);    require_once  "Services/$NomModulo/View/$Vista.php"; }
    function SController($NomModulo,$Controlador,$array=array())
       {     extract($array);    require_once "Services/$NomModulo/Controller/$Controlador.php";  }

    // Local-Modulo
    function MModel($NomModulo,$Modelo,$array=array())
        {    extract($array);    require_once  "Module/$NomModulo/Model/$Modelo.php"; }
    function MView($NomModulo,$Vista,$array=array())
        {    extract($array);    require_once  "Module/$NomModulo/View/$Vista.php"; }
    function MController($NomModulo,$Controlador,$array=array())
        {    extract($array);    require_once "Module/$NomModulo/Controller/$Controlador.php";  }

    include  "$MoS/$NombreMoS/Controller/AjaxLocal.php";

    
