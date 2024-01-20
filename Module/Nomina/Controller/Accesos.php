<?php
class Accesos
{
	var $Modulo = "Nomina";

	public function CreacionTabs($NombreTabs,$TipoTabs)
	{		
		$tabshtml = '';
		switch($NombreTabs) 
 		{
			case "nav-tab-nomina":
				$tabshtml  = ' <a class="nav-item nav-link active" id="nav-listado_nomina-tab" data-toggle="tab" href="#nav-listado_nomina" role="tab" aria-controls="nav-listado_nomina" aria-selected="true">Listado</a>';
                $tabshtml .= ' <a class="nav-item nav-link" id="nav-generar_nomina-tab" data-toggle="tab" href="#nav-generar_nomina" role="tab" aria-controls="nav-generar_nomina" aria-selected="false">Generar</a>';
            break;

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
			case "tabla_listado_nomina":
				$tablahtml = '	<table id="tabla_listado_nomina" class="table table-striped table-bordered table-condensed w-100">
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

			case "tabla_generar_nomina":
				$tablahtml = '	<table id="tabla_generar_nomina" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>AÑO</th>
											<th>PERIODO</th>
											<th>TIPO</th>
											<th>ARCHIVO</th>
											<th>F.INICIO</th>
											<th>F.TERMINO</th>
											<th>USUARIO GENERA</th>
											<th>FECHA GENERA</th>
											<th>USUARIO ELIMINA</th>
											<th>FECHA ELIMINA</th>
											<th>ESTADO</th>
											<th>ACCIONES</th>
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
			case "tabla_listado_nomina":
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

			case "tabla_generar_nomina":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Anular' class='btn btn-danger btn-sm btn_borrar_generar_nomina'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "ncar_anio"},
									{"data": "ncar_periodo"},                    
									{"data": "ncar_tipo"},					
									{"data": "ncar_archivo"},
									{"data": "ncar_fecha_inicio"},                    
									{"data": "ncar_fecha_termino"},
									{"data": "ncar_usuario_genera"},                    
									{"data": "ncar_fecha_crea"},                    
									{"data": "ncar_usuario_elimina"},
									{"data": "ncar_fecha_elimina"},
									{"data": "ncar_estado"},
									{"defaultContent": "'.$defaultContent1.'"}
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