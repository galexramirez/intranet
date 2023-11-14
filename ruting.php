<?php 
// 01. Configuracion php Inicio
    ini_set('display_error', true);
    error_reporting(E_ALL);

    session_start();

// 02. Datos del Sitio / Config. Cambia
    define("DF_TITULO", "Limabus Internacional");
    define("DF_MENSAJE", "Intranet");
    define("DF_RAIZ",dirname(__FILE__));

// 0.3 Funciones para enrutamiento MVC
    // Servicios
    function SModel($NomModulo,$Modelo,$array=array())
       {     extract($array);    require_once  "Services/$NomModulo/Model/$Modelo.php"; }
    function SView($NomModulo,$Vista,$array=array())
       {     extract($array);    require_once  "Services/$NomModulo/View/$Vista.php"; }
    function SController($NomModulo,$Controlador,$array=array())
       {     extract($array);    require_once "Services/$NomModulo/Controller/$Controlador.php"; }

    // Local-Modulo
    function MModel($NomModulo,$Modelo,$array=array())
        {    extract($array);    require_once  "Module/$NomModulo/Model/$Modelo.php"; }
    function MView($NomModulo,$Vista,$array=array())
        {    extract($array);    require_once  "Module/$NomModulo/View/$Vista.php"; }
    function MController($NomModulo,$Controlador,$array=array())
        {    extract($array);    require_once  "Module/$NomModulo/Controller/$Controlador.php";  }

//04. Configuracion de Ruting 
    $ruta=$_SERVER['REQUEST_URI'];
   
    switch ($ruta)
        {
        case '/inicio':
            MController('Sesion','Renderice'); break;

        case '/Usuario':
            MController('Usuario','Renderice'); break;
    
        case '/ProgramacionCarga':
            MController('ProgramacionCarga','Renderice');   break;

        case '/Maestro_uno':
            MController('Maestro_uno','Renderice');   break;

        case '/Nomina':
            MController('Nomina','Renderice');   break;

        case '/ControlFacilitador':
            MController('ControlFacilitador','Renderice');   break;
    
        case '/DespachoFlota':
            MController('DespachoFlota','Renderice');   break;

        case '/AjusteOperaciones':
            MController('AjusteOperaciones','Renderice');   break;

        case '/Accidentes':
            MController('Accidentes','Renderice');    break;     
        
        case '/Comportamiento':
            MController('Comportamiento','Renderice');    break;     

        case '/Inasistencias':
            MController('Inasistencias','Renderice');    break;     
        
        case '/OTPreventivas':
            MController('OTPreventivas','Renderice');    break;     

        case '/Kilometraje':
            MController('Kilometraje','Renderice');    break;     
    
        case '/AjusteMantenimiento':
            MController('AjusteMantenimiento','Renderice');    break;     
    
        case '/OTCorrectivas':
            MController('OTCorrectivas','Renderice');    break;     

        case '/Vales':
            MController('Vales','Renderice');    break;     

        case '/InfoBus':
            MController('InfoBus','Renderice');    break;     

        case '/Materiales':
            MController('Materiales','Renderice');    break;     

        case '/Pedidos':
            MController('Pedidos','Renderice');    break;     

        case '/Inventario':
            MController('Inventario','Renderice');    break;     
    
        case '/RecuperaContrasena':
            MController('RecuperaContrasena','Renderice');    break;     

        case '/AjusteGenerales':
            MController('AjusteGenerales','Renderice');    break;     

        case '/LogOut':
            MController('Sesion','LogOut');    break;     

        case '/AjusteUsuario':
            MController('AjusteUsuario','Renderice');    break;

        case '/solicitudes':
            MController('solicitudes','Renderice');   break;

        case '/novedades_piloto':
            MController('novedades_piloto','Renderice');   break;

        case '/costo_accidentes':
            MController('costo_accidentes','Renderice');   break;

        case '/informe_preliminar':
            MController('informe_preliminar','Renderice');   break;
        
        case '/vales_v3':
            MController('vales_v3','Renderice');    break;     

        case '/dashboard_mantenimiento':
            MController('dashboard_mantenimiento','Renderice');    break;     

        case '/orden_trabajo':
            MController('orden_trabajo','Renderice');    break;     

        case '/componentes':
            MController('componentes','Renderice');    break;     

        case '/inspeccion_flota':
            MController('inspeccion_flota','Renderice');    break;     

        case '/check_list':
            MController('check_list','Renderice');    break;     

        case '/desempeno_piloto':
            MController('desempeno_piloto','Renderice');    break;     
        
        case '/manual':
            MController('manual','renderice');    break;     
    
            
        default: header('Location: /inicio');
        }