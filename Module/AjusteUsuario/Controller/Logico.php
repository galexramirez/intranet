<?php
class Logico
{
	var $Modulo = "AjusteUsuario";
	// 1.0 CARGA DATOS DE BUSQUEDA DE PILOTO
	function Contenido($NombreDeModuloVista)    
	{		
		MView('AjusteUsuario','LocalView',compact('NombreDeModuloVista') );
	}

	public function SelectTipos($ttablamaestrouno_operacion, $ttablamaestrouno_tipo)
	{
		MModel($this->Modulo, 'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->SelectTipos($ttablamaestrouno_operacion, $ttablamaestrouno_tipo);

		$html = '<option value="">Seleccione una opcion</option>';

		foreach ($Respuesta as $row) {
			$html .= '<option value="'.$row['Detalle'].'">'.$row['Detalle'].'</option>';
		}
		echo $html;
	}
	
}