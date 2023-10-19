<?php
class C_PlantillaTemplon
{
            
    function VistaGeneral_A($InsertHead,$NombreDeModulo)
    {

     
        // Datos para de usaurio para la vista
        $NombreUsuario= $_SESSION['Usua_NombreCorto'];
        //$FotoUsuario= $_SESSION['USUARIO_ID']; // Pendiente de vinculas a la BD.
        $FotoUsuario = $_SESSION['usua_fotografia'];
             
        // Construye el SIDEBAR   
        SController('ConsultaModulos','C_ConsultaModulos'); 
	    $Instancia2 = new C_ConsultaModulos();     
        $Data=$Instancia2->ListaModulosDelUsuario();     	    
                   
        SView('PlantillaTemplon','OpcionesSidebar');        
        $Instancia = new OpcionesSidebar();     
        $OpcionesSidebar = "";    
        /*foreach ($Data as $row) 
        {
            $Respuesta      = $Instancia->OpcionSimple($row['Mod_Nombre'],$row['Mod_NombreVista'],$row['Mod_Icono'],$NombreDeModulo);
            $OpcionesSidebar= $OpcionesSidebar."".$Respuesta; 
        }*/
        
        $mod_plegable       = "";
        $menu_plegable      = "";
        $total_modulos      = count($Data);
        $contador           = 0;
        $ultimo_registro    = "";
        $nombre_plegable    = "";

        foreach ($Data as $row) 
        {
            if($row['Mod_Nombre']==$NombreDeModulo){
                $nombre_plegable = $row['mod_plegable'];
            }
        }
       
        foreach ($Data as $row) 
        {
            $contador++;
            if($contador==$total_modulos){
                $ultimo_registro = "ultimo";
            }
            if($row['mod_tipo']=='Plegable'){
                if($mod_plegable==""){
                    $mod_plegable = $row['Mod_NombreVista'];
                    $menu_plegable = "inicio";
                }else{
                    $menu_plegable = "nuevo";
                }
            }else{
                $menu_plegable = "submenu";
            }
            $Respuesta      = $Instancia->OpcionMultiple($row['Mod_Nombre'], $row['Mod_NombreVista'], $row['Mod_Icono'], $row['Mod_NombreVista'], $menu_plegable, $ultimo_registro, $NombreDeModulo, $nombre_plegable);
            $OpcionesSidebar= $OpcionesSidebar."".$Respuesta; 
            
        }

        // Trae y muestra la VIstaGeneral_A    
        SView('PlantillaTemplon','VistaGeneral_A',compact('NombreUsuario','FotoUsuario','OpcionesSidebar','InsertHead'));
    }     

    function VistaGeneral_B($InserFooter)
    {
        SView('PlantillaTemplon','VistaGeneral_B',compact('InserFooter'));
    }   
}    