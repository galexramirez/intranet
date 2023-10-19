<?php
session_start();
class Logico
	{
	// 1.0 CARGA DATOS DE BUSQUEDA DE PILOTO
	function Contenido($NombreDeModuloVista)    
		{		
				
			MView('AjusteOperaciones','LocalView',compact('NombreDeModuloVista') );

		}

	public function SelectTipos($Prog_Operacion, $Ttabla_Tipo)
		{
			//Ejecuta Modelo
			MModel('AjusteOperaciones', 'CRUD');
			$InstanciaAjax= new CRUD();
			$Respuesta=$InstanciaAjax->SelectTipos($Prog_Operacion, $Ttabla_Tipo);
	
			$html = '<option value="">Seleccione una opcion</option>';
			foreach ($Respuesta as $row) {
				$html .= '<option value="'.$row['Detalle'].'">'.$row['Detalle'].'</option>';
			}
			echo $html;
		}


	}