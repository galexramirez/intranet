<?php
class OpcionesSidebar
{
  function OpcionSimple($Mod_Nombre,$Mod_NombreVista,$Mod_Icono,$NombreDeModulo)
  {
    if($Mod_Nombre == $NombreDeModulo){
      $Activo = 'Id=activo';
    }
    $html = "
              <li $Activo>
                <a href='$Mod_Nombre' class='nav-link ml-2'>
                  $Mod_Icono
                  $Mod_NombreVista
                </a>
              </li>
            ";
    return $html;       
  }   

  function OpcionMultiple($Mod_Nombre, $Mod_NombreVista, $Mod_Icono, $mod_plegable, $menu_plegable, $ultimo_registro, $NombreDeModulo, $nombre_plegable)
  {
    $activo   = "";
    $expanded = "false";
    $collapse = "collapse";

    if($Mod_Nombre == $NombreDeModulo){
      $activo = 'Id=activo';
    }

    if($mod_plegable == $nombre_plegable){
      $expanded = 'true';
      $collapse = "collapse show";
    }

    switch ($menu_plegable)
    {
      case "inicio":
        $html = " <li class='mb-1'>
                    <button class='btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed' data-toggle='collapse' data-target='#$Mod_NombreVista' aria-expanded='$expanded'>
                      $Mod_Icono &nbsp
                      $Mod_NombreVista
                    </button>
                    <div class='$collapse' id='$Mod_NombreVista'> 
                      <ul class='btn-toggle-nav list-unstyled fw-normal pb-1 small'>  
                ";
      break;
      case "nuevo":
        $html = "     </ul>
                    </div>
                  </li> ";
        if($Mod_Nombre=="Plegable Ajustes"){
          $html .= "<li><hr class='dropdown-divider'></li>";
        }
        $html .=" <li class='mb-1'>
                    <button class='btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed' data-toggle='collapse' data-target='#$Mod_NombreVista' aria-expanded='$expanded'>
                      $Mod_Icono &nbsp
                      $Mod_NombreVista
                    </button>
                    <div class='$collapse' id='$Mod_NombreVista'> 
                      <ul class='btn-toggle-nav list-unstyled fw-normal pb-1 small'>  
                ";
      break;
      case "submenu":
        $html = "       <li $activo>
                          <a class='nav-link ml-2' href='$Mod_Nombre'>
                            $Mod_Icono &nbsp  
                            $Mod_NombreVista
                          </a>
                        </li>
                ";
      break;
    }
    if($ultimo_registro=="ultimo"){
      $html .= "       </ul>
                    </div>
                  </li> ";
    }
    return $html;       
  }    
       
}
