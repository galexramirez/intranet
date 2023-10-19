<?php
session_start();

class Logico
	{
	// 1.0 CARGA DATOS DE BUSQUEDA DE PILOTO
	function Contenido($NombreDeModuloVista)    
		{		
				
			MView('Nomina','LocalView',compact('NombreDeModuloVista') );

		}


	}