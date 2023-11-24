<?php
class Accesos
{
	var $Modulo = "Nomina";

	public function CreacionTabs($NombreTabs,$TipoTabs)
	{		
		$tabshtml = '';
		switch($NombreTabs) 
 		{
			case "":
				$tabshtml = ' ';
			break;

		}
		echo $tabshtml;
	}
	
    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
		$tablahtml = "";
        switch ($NombreTabla) 
		{
			case "tabla_nomina":
				$tablahtml = '	<table id="tabla_nomina" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>FECHA</th>
											<th>CODIGO</th>
											<th>DNI</th>
											<th>APELLIDOS Y NOMBRES</th>
											<th>HORA INICIO</th>
											<th>HORA TERMINO</th>
											<th>AMPLITUD</th>
											<th>DURACION</th>
											<th>TIPO OPERACION</th>
											<th>SERVICIO</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table> ';
			break;

		}
		echo $tablahtml;
	}

	public function ColumnasTabla($NombreTabla,$TipoTabla)
	{
		$columnashtml = "";
        switch ($NombreTabla) 
		{
			case "tabla_nomina":
				$columnashtml = '[	{"data": "Fecha"},
									{"data": "Codigo"},                    
									{"data": "DNI"},                    
									{"data": "ApellidosNombres"},                    
									{"data": "HoraInicio"},
									{"data": "HoraTermino"},                    
									{"data": "Amplitud"},
									{"data": "Duracion"},
									{"data": "TipoOperacion"},
									{"data": "Servicio"}
								] ';
			break;

        }
		echo $columnashtml;
	}

	public function BotonesFormulario($NombreFormulario,$NombreObjeto)
	{
		$botonesformulario = "";
		switch($NombreFormulario)
		{
			case "":
				switch($NombreObjeto)
				{
					case "":
						$botonesformulario = '';
					break;
				}
			break;

		}
		echo $botonesformulario;
    }

	public function DivFormulario($NombreFormulario,$NombreObjeto)
	{
		$divformulario = "";
		switch($NombreFormulario)
		{
			case "":
				switch($NombreObjeto)
				{
					case "":
					break;

					case "":
					break;

				}
			break;
		}
		echo $divformulario;
    }

	public function MostrarDiv($NombreFormulario,$NombreObjeto,$Dato)
	{
		$Mostrar_div = "";
		switch($NombreFormulario)
		{
			case "contenido":
				switch($NombreObjeto)
				{
					case "div_alertsDropdown_ayuda":
						$man_modulo_id = '';
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax	= new CRUD();
						$Respuesta	= $InstanciaAjax->BuscarDataBD("Modulo", "Mod_Nombre", $Dato );
						foreach($Respuesta as $row){
							$man_modulo_id = $row['Modulo_Id'];
						}

						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax	= new CRUD();
						$Respuesta	= $InstanciaAjax->BuscarDataBD("glo_manual", "man_modulo_id", $man_modulo_id );

						usort($Respuesta, function($a, $b) {
                            return $a['man_titulo'] <=> $b['man_titulo'];
                        });
						
						$Mostrar_div = '	<h5 class="dropdown-header">
												AYUDA
											</h5>';
						
						foreach($Respuesta as $row){
							$Mostrar_div .= '	<a class="dropdown-item d-flex align-items-center" href="javascript:f_ayuda_modulo('."'".$row['man_titulo']."'".')">
													<div>
														<div class="font-weight-ligth drop-titulo">'.$row['man_titulo'].'</div>
													</div>
												</a>'; 
						}
					break;

				}
			break;

			case "":
				switch($NombreObjeto)
				{
					case "":
						$Mostrar_div = '';
					break;

					case "":
						switch($Dato)
						{
							case "":
							break;

							case "":
							break;

						}
						$Mostrar_div = '';
					break;

				}
			break;


		}
		echo $Mostrar_div;
    }

}