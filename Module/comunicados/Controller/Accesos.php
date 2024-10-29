<?php
class Accesos
{
	var $Modulo = "comunicados";

	public function CreacionTabs($NombreTabs, $TipoTabs)
	{
		$tabshtml = '';
		switch ($NombreTabs) {
			case "":
				$tabshtml = '';
				break;
		}
		echo $tabshtml;
	}

	public function CreacionTabla($NombreTabla, $TipoTabla)
	{
		$tablahtml = "";
		switch ($NombreTabla) {

			case "":
				$tablahtml = '';
				break;
		}
		echo $tablahtml;
	}

	public function ColumnasTabla($NombreTabla, $TipoTabla)
	{
		$columnashtml = "";
		switch ($NombreTabla) {
			case "":
				$columnashtml = '';
				break;
		}
		echo $columnashtml;
	}

	public function BotonesFormulario($NombreFormulario, $NombreObjeto)
	{
		$botonesformulario = "";
		switch ($NombreFormulario) {
			case "form_comunicados":
				switch ($NombreObjeto) {
					case "btn_form_comunicados":
						$botonesformulario = '	<button type="button" id="btn_programacion_actual" class="btn btn-success btn-sm btn_programacion_actual">
													<i class="bi bi-cloud-arrow-down-fill">
														<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-down-fill" viewBox="0 0 16 16">
															<path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2m2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708" />
														</svg>
													</i>
													Prog.Actual
												</button>
												<button type="button" id="btn_programacion_proxima" class="btn btn-warning btn-sm btn_programacion_proxima">
													<i class="bi bi-cloud-arrow-down-fill">
														<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-down-fill" viewBox="0 0 16 16">
															<path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2m2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708" />
														</svg>
													</i>
													Proxima.Prog.
												</button>
												<button type="button" id="btn_marcacion" class="btn btn-primary btn-sm btn_marcacion">
													<i class="bi bi-clock-fill">
														<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
															<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
														</svg>
													</i>
													Marcacion
												</button>';
						break;
				}
				break;
		}
		echo $botonesformulario;
	}

	public function DivFormulario($NombreFormulario, $NombreObjeto)
	{
		$divformulario = "";
		switch ($NombreFormulario) {
			case "":
				switch ($NombreObjeto) {
					case "":
						$divformulario = '';
						break;

					case "":
						break;
				}
				break;
		}
		echo $divformulario;
	}

	public function MostrarDiv($NombreFormulario, $NombreObjeto, $Dato)
	{
		$Mostrar_div = "";
		switch ($NombreFormulario) {
			case "desempeno_piloto":
				switch ($NombreObjeto) {
					case "content":
						switch ($Dato) {
							case "vacio":
								$Mostrar_div = '';
								break;

							case "cargar":
								$Mostrar_div = '';
								break;
						}

						break;
				}
				break;

			case "contenido":
				switch ($NombreObjeto) {
					case "div_alertsDropdown_ayuda":
						$man_modulo_id = '';
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax	= new CRUD();
						$Respuesta	= $InstanciaAjax->BuscarDataBD("Modulo", "Mod_Nombre", $Dato);
						foreach ($Respuesta as $row) {
							$man_modulo_id = $row['Modulo_Id'];
						}

						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax	= new CRUD();
						$Respuesta	= $InstanciaAjax->BuscarDataBD("glo_manual", "man_modulo_id", $man_modulo_id);

						usort($Respuesta, function ($a, $b) {
							return $a['man_titulo'] <=> $b['man_titulo'];
						});

						$Mostrar_div = '	<h5 class="dropdown-header">
												AYUDA
											</h5>';

						foreach ($Respuesta as $row) {
							$Mostrar_div .= '	<a class="dropdown-item d-flex align-items-center" href="javascript:f_ayuda_modulo(' . "'" . $row['man_titulo'] . "'" . ')">
													<div>
														<div class="font-weight-ligth drop-titulo">' . $row['man_titulo'] . '</div>
													</div>
												</a>';
						}
						break;
				}
				break;
		}
		echo $Mostrar_div;
	}
}
