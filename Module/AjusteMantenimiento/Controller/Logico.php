<?php
session_start();
class Logico
	{
	var $Modulo = "AjusteMantenimiento";
	// 1.0 CARGA DATOS DE BUSQUEDA DE PILOTO
	function Contenido($NombreDeModuloVista)    
	{				
		MView($this->Modulo,'LocalView',compact('NombreDeModuloVista') );
	}



	}