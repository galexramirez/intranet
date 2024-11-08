<?php
class Accesos
{
	var $Modulo = "pilotos";

	public function CreacionTabs($NombreTabs, $TipoTabs)
	{
		$tabshtml = '';
		switch ($NombreTabs) {
			case "nav-tab-comunicado":
				$tabshtml = '<a class="nav-item nav-link active" id="nav-comunicado-tab" data-toggle="tab" href="#nav-comunicado" role="tab" aria-controls="nav-comunicado" aria-selected="true"><i class="bi bi-megaphone-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-megaphone-fill" viewBox="0 0 16 16"><path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0zm-1 .724c-2.067.95-4.539 1.481-7 1.656v6.237a25 25 0 0 1 1.088.085c2.053.204 4.038.668 5.912 1.56zm-8 7.841V4.934c-.68.027-1.399.043-2.008.053A2.02 2.02 0 0 0 0 7v2c0 1.106.896 1.996 1.994 2.009l.496.008a64 64 0 0 1 1.51.048m1.39 1.081q.428.032.85.078l.253 1.69a1 1 0 0 1-.983 1.187h-.548a1 1 0 0 1-.916-.599l-1.314-2.48a66 66 0 0 1 1.692.064q.491.026.966.06"/></svg></i> Com</a>';
	    		$tabshtml .= '<a class="nav-item nav-link" id="nav-sig-tab" data-toggle="tab" href="#nav-sig" role="tab" aria-controls="nav-sig" aria-selected="false"><i class="bi bi-question-circle-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247m2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/></svg></i> SIG</a>';
				$tabshtml .= '<a class="nav-item nav-link" id="nav-novedades-tab" data-toggle="tab" href="#nav-novedades" role="tab" aria-controls="nav-novedades" aria-selected="false"><i class="bi bi-exclamation-triangle-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16"><path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/></svg></i> Nov</a>';
				$tabshtml .= '<a class="nav-item nav-link" id="nav-informativos-tab" data-toggle="tab" href="#nav-informativos" role="tab" aria-controls="nav-informativos" aria-selected="false"><i class="bi bi-inbox-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-inbox-fill" viewBox="0 0 16 16">  <path d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4zm-1.17-.437A1.5 1.5 0 0 1 4.98 3h6.04a1.5 1.5 0 0 1 1.17.563l3.7 4.625a.5.5 0 0 1 .106.374l-.39 3.124A1.5 1.5 0 0 1 14.117 13H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .106-.374z"/></svg></i> Inf</a>';
				$tabshtml .= '<a class="nav-item nav-link" id="nav-publicaciones-tab" data-toggle="tab" href="#nav-publicaciones" role="tab" aria-controls="nav-publicaciones" aria-selected="false"><i class="bi bi-cloud-arrow-up-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16"><path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2m2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0z"/></svg></i> Publicaciones</a>';
			break;
		}
		echo $tabshtml;
	}

	public function CreacionTabla($NombreTabla, $TipoTabla)
	{
		$tablahtml = "";
		switch ($NombreTabla) {
			case "tabla_publicacion":
                $tablahtml = '	<table id="tabla_publicacion" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>TITULO</th>
											<th>F.INICIO</th>
											<th>F.TERMINO</th>
											<th>DESTACADO</th>
											<th>CATEGORIA</th>
											<th>ARCHIVO</th>
											<th>ACCION</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

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
			case "tabla_publicacion":
				$defaultContent = "<div class='text-center'><div class='btn-group'><button title='Eliminar' class='btn btn-danger btn-sm btn_borrar'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "Comunicado_Id"},
									{"data": "Comu_Titulo"},
									{"data": "Comu_FechaInicio"},
									{"data": "Comu_FechaFin"},
									{"data": "Comu_Destacado"},
									{"data": "Comu_Categoria"},
									{"data": "Comu_Archivo"},
									{"defaultContent": " '.$defaultContent.' "}
								]';
			break;

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
			case "comunicados":
				switch ($NombreObjeto) {
					case "carouselComunicados":
						switch ($Dato) {
							case "ACTIVO":
								MModel($this->Modulo, 'CRUD');
								$InstanciaAjax	= new CRUD();
								$Respuesta	= $InstanciaAjax->comunicados_destacados_activos();
								foreach ($Respuesta as $row){
									$Mostrar_div .= '	<div>
															<div class="slick">
																<a href="../../../Services/image/comunicados/'.$row['Comu_Archivo'].'" target="_blank">
																	<picture>
																		<img src="../../../Services/image/comunicados/'.$row['Comu_Archivo'].'" alt="'.$row['Comu_Archivo'].'" width="600px" height="500px">
																	</picture>
																</a>
															</div>
														</div>';
								}
								break;

							case "":
								$Mostrar_div = '';
								break;
						}

						break;
				}
				break;

			case "sig":
				switch ($NombreObjeto) {
					case "carousel_sig":
						switch ($Dato) {
							case "ACTIVO":
								$li="";
								$item="";
								$active=-1;
								MModel($this->Modulo, 'CRUD');
								$InstanciaAjax	= new CRUD();
								$Respuesta	= $InstanciaAjax->sig_activos();
								foreach ($Respuesta as $row){
									$active++;
									if($active===0){
										$li = '<li data-target="#carousel_sig" data-slide-to="'.$active.'" class="active"></li>';
										$item ='<div class="carousel-item active">
													<a href="../../../Services/image/comunicados/'.$row['Comu_Archivo'].'" target="_blank">
														<img src="../../../Services/image/comunicados/'.$row['Comu_Archivo'].'" class="d-block w-100" alt="'.$row['Comu_Titulo'].'" width="600px" height="500px">
													</a>
												</div>';
									}else{
										$li .= '<li data-target="#carousel_sig" data-slide-to="'.$active.'"></li>';
										$item .='<div class="carousel-item">
													<a href="../../../Services/image/comunicados/'.$row['Comu_Archivo'].'" target="_blank">
														<img src="../../../Services/image/comunicados/'.$row['Comu_Archivo'].'" class="d-block w-100" alt="'.$row['Comu_Titulo'].'" width="600px" height="500px">
													</a>
												</div>';
									}
								}
								$Mostrar_div = '<ol class="carousel-indicators">
													'.$li.'					
												</ol>
												<div class="carousel-inner">
													'.$item.'
												</div>
												<a class="carousel-control-prev" role="button" href="#carousel_sig" data-slide="prev">
													<span class="carousel-control-prev-icon" aria-hidden="true"></span>
													<span class="sr-only">Previo</span>
												</a>
												<a class="carousel-control-next" role="button" href="#carousel_sig" data-slide="next">
													<span class="carousel-control-next-icon" aria-hidden="true"></span>
													<span class="sr-only">Siguiente</span>
													</button>
												</a>';
							break;
							case "":
								$Mostrar_div = '';
							break;
						}
					break;
				}
			break;

			case "informativo":
				switch ($NombreObjeto) {
					case "carousel_informativo":
						switch ($Dato) {
							case "ACTIVO":
								$li="";
								$item="";
								$active=-1;
								MModel($this->Modulo, 'CRUD');
								$InstanciaAjax	= new CRUD();
								$Respuesta	= $InstanciaAjax->informativos_activos();
								foreach ($Respuesta as $row){
									$active++;
									if($active===0){
										$li = '<li data-target="#carousel_informativo" data-slide-to="'.$active.'" class="active"></li>';
										$item ='<div class="carousel-item active">
													<a href="../../../Services/image/comunicados/'.$row['Comu_Archivo'].'" target="_blank">
														<img src="../../../Services/image/comunicados/'.$row['Comu_Archivo'].'" class="d-block w-100" alt="'.$row['Comu_Titulo'].'" width="600px" height="500px">
													</a>
												</div>';
									}else{
										$li .= '<li data-target="#carousel_informativo" data-slide-to="'.$active.'"></li>';
										$item .='<div class="carousel-item">
													<a href="../../../Services/image/comunicados/'.$row['Comu_Archivo'].'" target="_blank">
														<img src="../../../Services/image/comunicados/'.$row['Comu_Archivo'].'" class="d-block w-100" alt="'.$row['Comu_Titulo'].'" width="600px" height="500px">
													</a>
												</div>';
									}
								}
								$Mostrar_div = '<ol class="carousel-indicators">
													'.$li.'					
												</ol>
												<div class="carousel-inner">
													'.$item.'
												</div>
												<a class="carousel-control-prev" role="button" href="#carousel_informativo" data-slide="prev">
													<span class="carousel-control-prev-icon" aria-hidden="true"></span>
													<span class="sr-only">Previo</span>
												</a>
												<a class="carousel-control-next" role="button" href="#carousel_informativo" data-slide="next">
													<span class="carousel-control-next-icon" aria-hidden="true"></span>
													<span class="sr-only">Siguiente</span>
													</button>
												</a>';
							break;
							case "":
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
