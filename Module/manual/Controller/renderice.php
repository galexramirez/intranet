<?php 

if (!isset($_SESSION['USUARIO_ID'])){ 
	session_destroy();  header('Location: /inicio'); 
}else{
	//$NombreModulo = strtolower($NombreModulo);
	MView('manual','local_view');
}
