<?php
class Accesos
{
	var $Modulo="solicitudes";

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
            case "tabla_solicitudes":
				$mostrar_acciones = "";
				$defaultContent_2 = "<div class='text-center'><div class='btn-group'>";
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax 	= new CRUD();
				$Respuesta		= $InstanciaAjax->Permisos($this->Modulo,"btn_editar_solicitudes");
				if ($Respuesta=="SI"){
					$mostrar_acciones = "<th>ACCIONES</th>";
				}
				
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax 	= new CRUD();
				$Respuesta		= $InstanciaAjax->Permisos($this->Modulo,"btn_observar_solicitudes");
				if ($Respuesta=="SI"){
					$mostrar_acciones = "<th>ACCIONES</th>";
				}

				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax 	= new CRUD();
				$Respuesta		= $InstanciaAjax->Permisos($this->Modulo,"btn_validar_solicitudes");
				if ($Respuesta=="SI"){
					$mostrar_acciones = "<th>ACCIONES</th>";
				}
                $tablahtml = '	<table id="tabla_solicitudes" class="table table-striped table-bordered table-condensed w-80">
									<thead class="text-center">
										<tr>
											<th>VER</th>
											<th>ID</th>
											<th>FECHA__INGRESO</th>
											<th>FECHA_RECEPCION</th>
											<th>DNI</th>
											<th>APELLIDOS__Y__NOMBRES</th>
											<th>FECHA__INICIO</th>
											<th>FECHA__FIN</th>
											<th>TIPO</th>
											<th>COD.ADMINISTRACION</th>
											<th>DESCRIPCION</th>
											<th>ESTADO</th>
											<th>RESPUESTA</th>
											<th>DETALLE__RESPUESTA</th>
											<th>REGISTRADO_POR</th>
											<th>RESPONSABLE</th>
											'.$mostrar_acciones.'
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

            case "":
                $tablahtml = ' ';
            break;

        }
		echo $tablahtml;
	}

	public function ColumnasTabla($NombreTabla,$TipoTabla)
	{
		$columnashtml = "";
        switch ($NombreTabla) 
		{
            case "tabla_solicitudes":
				$defaultContent_1 	= "<div class='text-center'><div class='btn-group'><button title='Ver' class='btn btn-sm btn_ver_solicitudes'><i class='bi bi-search'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg></i></button></div></div>";
				
				
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax 	= new CRUD();
				$Respuesta		= $InstanciaAjax->Permisos($this->Modulo,"btn_editar_solicitudes");
				if ($Respuesta=="SI"){
					$defaultContent_2 = "<button title='Editar' class='btn btn-primary btn-sm btn_editar_solicitudes'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button>";
				}
				
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax 	= new CRUD();
				$Respuesta		= $InstanciaAjax->Permisos($this->Modulo,"btn_observar_solicitudes");
				if ($Respuesta=="SI"){
					$defaultContent_2 .= "<button title='Observar' class='btn btn-warning btn-sm btn_observar_solicitudes'><i class='bi bi-exclamation-square'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-exclamation-square' viewBox='0 0 16 16'><path d='M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z'/><path d='M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z'/></svg></i></button>";
				}

				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax 	= new CRUD();
				$Respuesta		= $InstanciaAjax->Permisos($this->Modulo,"btn_validar_solicitudes");
				if ($Respuesta=="SI"){
					$defaultContent_2 .= "<button title='Validar' class='btn btn-success btn-sm btn_validar_solicitudes'><i class='bi bi-check-square-fill'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check-square-fill' viewBox='0 0 16 16'><path d='M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z'/></svg></i></button>";
				}
				if($defaultContent_2!=""){
					$defaultContent_2 = "<div class='text-center'><div class='btn-group'>".$defaultContent_2."</div></div>";
				}

				$columnashtml = '	[	{"defaultContent": " '.$defaultContent_1.' "},
										{"data": "solicitudes_id"},
										{"data": "soli_fecha_ingreso"},
										{"data": "soli_fecha_recepcion"},
										{"data": "soli_dni"},
										{"data": "soli_apellidos_nombres"},
										{"data": "soli_fecha_inicio"},
										{"data": "soli_fecha_fin"},
										{"data": "soli_tipo"},
										{"data": "soli_codigo_adm"},
										{"data": "soli_descripcion"},
										{"data": "soli_estado"},
										{"data": "soli_respuesta"},
										{"data": "soli_detalle_respuesta"},
										{"data": "soli_usuario_nombres"},
										{"data": "soli_responsable_nombres"}';
				if($defaultContent_2!=""){
					$columnashtml .= '	,{"defaultContent": " '.$defaultContent_2.' "}';	
				}
				$columnashtml .= '	]';
			break;

            case "":
				$columnashtml = ' ';	
            break;

			case "":
				$columnashtml = '';
			break;

        }
		echo $columnashtml;
	}

	public function BotonesFormulario($NombreFormulario,$NombreObjeto)
	{
		$botonesformulario = "";
		switch($NombreFormulario)
		{
			case "form_solicitudes_seleccion":
				$botonesformulario	= '<button type="button" id="btn_buscar_solicitudes" class="btn btn-secondary btn-sm btn_buscar_solicitudes ml-1">Buscar</button>';
				$botonesformulario	.= '<button type="button" id="btn_buscar_solicitudes_activas" class="btn btn-secondary btn-sm btn_buscar_solicitudes_activas ml-1">Activas</button>';
				$botonesformulario	.= '<button type="button" id="btn_descargar_solicitudes" class="btn btn-secondary btn-sm btn_descargar_solicitudes ml-1">Descargar</button>';
				
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax 	= new CRUD();
				$Respuesta		= $InstanciaAjax->Permisos($this->Modulo,"btn_nuevo_solicitudes");
				if ($Respuesta=="SI"){				
					$botonesformulario	.= '<button type="button" id="btn_nuevo_solicitudes"  class="btn btn-secondary btn-sm btn_nuevo_solicitudes ml-1" data-toggle="modal">+Nuevo</button>';
				}
			break;


			case "form_ver_solicitudes":
				$botonesformulario .= '<button type="button" id="btn_log_solicitudes" class="btn btn-info btn-sm btn_log_solicitudes ml-2">Log..</button>';
				if($NombreObjeto=="btn_validar"){
					$botonesformulario	.= '<button type="button" class="btn btn-sm btn-light ml-2" data-dismiss="modal">Cancelar</button>';
					$botonesformulario	.= '<button type="button" id="btn_aprobar_solicitudes" class="btn btn-sm btn-primary btn_aprobar_solicitudes ml-2">Aprobar</button>';
					$botonesformulario	.= '<button type="button" id="btn_desaprobar_solicitudes" class="btn btn-sm btn-danger btn_desaprobar_solicitudes ml-2">Desaprobar</button>';
					$botonesformulario	.= '<button type="button" id="btn_citar_solicitudes" class="btn btn-sm btn-warning btn_citar_solicitudes ml-2">Citar Piloto</button>';
				}
				$botonesformulario  .= '<button type="button" id="btn_xlpdf_solicitudes" class="btn btn-outline-danger btn-sm btn_xlpdf_solicitudes ml-2"><i class="bi bi-arrows-fullscreen"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-fullscreen" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707zm0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707zm-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707z"/></svg>PDF</i></button>';
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