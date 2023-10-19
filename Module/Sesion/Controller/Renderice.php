<?php 
// Fn.Valida si existe la variable Sesion
if (!isset($_SESSION['USUARIO_ID']))
	{         
	if(!isset($_POST["user_login"]))
 		{ 
 		MView('Sesion','LoginView');
 		}
	else
		{
		MModel('Sesion','Usuario');
		$Intancia = new Usuario();
		$validado=$Intancia->ValidaUsuario($_POST["user_login"],$_POST["user_pass"]);
		header('Location: /inicio');
		}
	} 
else
	{
	// Determina que modulo principal 

	SController('ConsultaModulos','C_ConsultaModulos'); 
	$Instancia2 = new C_ConsultaModulos();     
    $ModuloInicio=$Instancia2->ModuloDeInicio();     	
  
	if($ModuloInicio=='')
        { 
		session_destroy();  
		header('Location: /inicio');
		}
	else
		{ 
		header('Location: /'.$ModuloInicio); 
		}
	}
?>