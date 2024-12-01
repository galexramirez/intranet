<?php
class Accesos
{
	var $Modulo = "pilotos";

	public function CreacionTabs($NombreTabs, $TipoTabs)
	{
		$tabshtml = '';
		switch ($NombreTabs) {
			case "nav-tab-comunicado":
				$tabshtml = '<a class="nav-item nav-link active nav-comunicado-tab" id="nav-comunicado-tab" data-toggle="tab" href="#nav-comunicado" role="tab" aria-controls="nav-comunicado" aria-selected="true"><i class="bi bi-megaphone-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-megaphone-fill" viewBox="0 0 16 16"><path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0zm-1 .724c-2.067.95-4.539 1.481-7 1.656v6.237a25 25 0 0 1 1.088.085c2.053.204 4.038.668 5.912 1.56zm-8 7.841V4.934c-.68.027-1.399.043-2.008.053A2.02 2.02 0 0 0 0 7v2c0 1.106.896 1.996 1.994 2.009l.496.008a64 64 0 0 1 1.51.048m1.39 1.081q.428.032.85.078l.253 1.69a1 1 0 0 1-.983 1.187h-.548a1 1 0 0 1-.916-.599l-1.314-2.48a66 66 0 0 1 1.692.064q.491.026.966.06"/></svg></i> Com</a>';
	    		$tabshtml .= '<a class="nav-item nav-link nav-sig-tab" id="nav-sig-tab" data-toggle="tab" href="#nav-sig" role="tab" aria-controls="nav-sig" aria-selected="false"><i class="bi bi-question-circle-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247m2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/></svg></i> SIG</a>';
				$tabshtml .= '<a class="nav-item nav-link nav-novedades-tab" id="nav-novedades-tab" data-toggle="tab" href="#nav-novedades" role="tab" aria-controls="nav-novedades" aria-selected="false"><i class="bi bi-exclamation-triangle-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16"><path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/></svg></i> Nov</a>';
				$tabshtml .= '<a class="nav-item nav-link nav-informativos-tab" id="nav-informativos-tab" data-toggle="tab" href="#nav-informativos" role="tab" aria-controls="nav-informativos" aria-selected="false"><i class="bi bi-inbox-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-inbox-fill" viewBox="0 0 16 16">  <path d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4zm-1.17-.437A1.5 1.5 0 0 1 4.98 3h6.04a1.5 1.5 0 0 1 1.17.563l3.7 4.625a.5.5 0 0 1 .106.374l-.39 3.124A1.5 1.5 0 0 1 14.117 13H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .106-.374z"/></svg></i> Inf</a>';
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-publicaciones-tab');
				if ($Respuesta=="SI"){					
					$tabshtml .= '<a class="nav-item nav-link nav-publicaciones-tab" id="nav-publicaciones-tab" data-toggle="tab" href="#nav-publicaciones" role="tab" aria-controls="nav-publicaciones" aria-selected="false"><i class="bi bi-cloud-arrow-up-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16"><path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2m2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0z"/></svg></i> Publicaciones</a>';
				}
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
											<th>IMAGEN</th>
											<th>PDF</th>
											<th>VIDEO</th>
											<th>LINK</th>
											<th>USUARIO_CREACION</th>
											<th>FECHA_CREACION</th>
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
									{"data": "Comu_Imagen"},
									{"data": "Comu_Pdf"},
									{"data": "Comu_Video"},
									{"data": "Comu_Link"},
									{"data": "Comu_Usuario"},
									{"data": "Comu_Fecha_Creacion"},
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
					case "carousel_comunicados":
						switch ($Dato) {
							case "ACTIVO":
								$track = '';
								MModel($this->Modulo, 'CRUD');
								$InstanciaAjax	= new CRUD();
								$Respuesta	= $InstanciaAjax->comunicados_destacados_vigentes();
								foreach ($Respuesta as $row){
									$track .= '	<div>
													<div class="slick">
														<a href="../../../Services/files/image/comunicados/'.$row['Comu_Imagen'].'" target="_blank">
															<picture>
																<img src="../../../Services/files/image/comunicados/'.$row['Comu_Imagen'].'" alt="'.$row['Comu_Imagen'].'" width="600px" height="500px">
															</picture>
														</a>
													</div>
												</div>';
								}
								$Mostrar_div = '<div class="slick-list" id="slick-list">
													<button class="slick-arrow slick-prev" id="button-prev" data-button="button-prev" onclick="app.processingButton(event)">
														<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-left" class="svg-inline--fa fa-chevron-left fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
															<path fill="currentColor" d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path>
														</svg>
													</button>
													<div class="slick-track" id="track">
														'.$track.'
													</div>
													<button class="slick-arrow slick-next" id="button-next" data-button="button-next" onclick="app.processingButton(event)">
														<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" class="svg-inline--fa fa-chevron-right fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
															<path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
														</svg>
													</button>
												</div>';
							break;
						}
					break;
					case "card_comunicados":
						switch ($Dato) {
							case "ACTIVO":
								MModel($this->Modulo, 'CRUD');
								$InstanciaAjax	= new CRUD();
								$Respuesta	= $InstanciaAjax->comunicados_vigentes();
								foreach ($Respuesta as $row){
									$boton_pdf = "";
									$boton_video = "";
									$boton_link = "";
									$footer = "";
									if($row['Comu_Pdf']!=""){
										$boton_pdf = '<a href="../../../Services/files/pdf/comunicados/'.$row['Comu_Pdf'].'" class="btn btn-danger" target="_blank"><i class="bi bi-filetype-pdf"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/></svg></i></a>';
									}
									if($row['Comu_Video']!=""){
										$boton_video = '<a href="'.$row['Comu_Video'].'" class="btn btn-primary" target="_blank"><i class="bi bi-play-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-btn" viewBox="0 0 16 16"><path d="M6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814z"/><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/></svg></i></a>';
									}
									if($row['Comu_Link']!=""){
										$boton_link = '<a href="'.$row['Comu_Link'].'" class="btn btn-success" target="_blank"><i class="bi bi-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link" viewBox="0 0 16 16"><path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9q-.13 0-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/><path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4 4 0 0 1-.82 1H12a3 3 0 1 0 0-6z"/></svg></i></a>';
									}
									if($boton_pdf!="" || $boton_video!="" || $boton_link!=""){
										$footer = ' <div class="card-footer">
														'.$boton_pdf.$boton_video.$boton_link.'
													</div>';
									}
									$Mostrar_div .= '<div class="card text-center border-info mb-3">
														<div class="card-header bg-info text-white">
															'.$row['Comu_Titulo'].'
														</div>
														<div class="card-body">
															<a href="../../../Services/files/image/comunicados/'.$row['Comu_Imagen'].'" target="_blank"</a>
																<img src="../../../Services/files/image/comunicados/'.$row['Comu_Imagen'].'" class="card-img-top" alt="'.$row['Comu_Imagen'].'" width="250px" height="250px">
															</a>
														</div>
														'.$footer.'
													</div>';
								}
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
								$track = '';
								MModel($this->Modulo, 'CRUD');
								$InstanciaAjax	= new CRUD();
								$Respuesta	= $InstanciaAjax->sig_destacados_vigentes();
								foreach ($Respuesta as $row){
									$track .= '	<div>
													<div class="slick">
														<a href="../../../Services/files/image/comunicados/'.$row['Comu_Imagen'].'" target="_blank">
															<picture>
																<img src="../../../Services/files/image/comunicados/'.$row['Comu_Imagen'].'" alt="'.$row['Comu_Imagen'].'" width="600px" height="500px">
															</picture>
														</a>
													</div>
												</div>';
								}
								$Mostrar_div = '<div class="slick-list" id="slick-list">
													<button class="slick-arrow slick-prev" id="button-prev" data-button="button-prev" onclick="app.processingButton(event)">
														<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-left" class="svg-inline--fa fa-chevron-left fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
															<path fill="currentColor" d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path>
														</svg>
													</button>
													<div class="slick-track" id="track">
														'.$track.'
													</div>
													<button class="slick-arrow slick-next" id="button-next" data-button="button-next" onclick="app.processingButton(event)">
														<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" class="svg-inline--fa fa-chevron-right fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
															<path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
														</svg>
													</button>
												</div>';
							break;
						}
					break;
					case "card_sig":
						switch ($Dato) {
							case "ACTIVO":
								MModel($this->Modulo, 'CRUD');
								$InstanciaAjax	= new CRUD();
								$Respuesta	= $InstanciaAjax->sig_vigentes();
								foreach ($Respuesta as $row){
									$boton_pdf = "";
									$boton_video = "";
									$boton_link = "";
									$footer = "";
									if($row['Comu_Pdf']!=""){
										$boton_pdf = '<a href="../../../Services/files/pdf/comunicados/'.$row['Comu_Pdf'].'" class="btn btn-danger" target="_blank"><i class="bi bi-filetype-pdf"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/></svg></i></a>';
									}
									if($row['Comu_Video']!=""){
										$boton_video = '<a href="'.$row['Comu_Video'].'" class="btn btn-primary" target="_blank"><i class="bi bi-play-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-btn" viewBox="0 0 16 16"><path d="M6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814z"/><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/></svg></i></a>';
									}
									if($row['Comu_Link']!=""){
										$boton_link = '<a href="'.$row['Comu_Link'].'" class="btn btn-success" target="_blank"><i class="bi bi-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link" viewBox="0 0 16 16"><path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9q-.13 0-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/><path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4 4 0 0 1-.82 1H12a3 3 0 1 0 0-6z"/></svg></i></a>';
									}
									if($boton_pdf!="" || $boton_video!="" || $boton_link!=""){
										$footer = ' <div class="card-footer">
														'.$boton_pdf.$boton_video.$boton_link.'
													</div>';
									}
									$Mostrar_div .= '<div class="card text-center border-info mb-3">
														<div class="card-header bg-info text-white">
															'.$row['Comu_Titulo'].'
														</div>
														<div class="card-body">
															<a href="../../../Services/files/image/comunicados/'.$row['Comu_Imagen'].'" target="_blank"</a>
																<img src="../../../Services/files/image/comunicados/'.$row['Comu_Imagen'].'" class="card-img-top" alt="'.$row['Comu_Imagen'].'" width="250px" height="250px">
															</a>
														</div>
														'.$footer.'
													</div>';
								}
							break;
						}
					break;
				}
			break;

			case "informativos":
				switch ($NombreObjeto) {
					case "carousel_informativos":
						switch ($Dato) {
							case "ACTIVO":
								$track = '';
								MModel($this->Modulo, 'CRUD');
								$InstanciaAjax	= new CRUD();
								$Respuesta	= $InstanciaAjax->informativos_destacados_activos();
								foreach ($Respuesta as $row){
									$track .= '	<div>
													<div class="slick">
														<a href="../../../Services/files/image/comunicados/'.$row['Comu_Imagen'].'" target="_blank">
															<picture>
																<img src="../../../Services/files/image/comunicados/'.$row['Comu_Imagen'].'" alt="'.$row['Comu_Imagen'].'" width="600px" height="500px">
															</picture>
														</a>
													</div>
												</div>';
								}
								$Mostrar_div = '<div class="slick-list" id="slick-list">
													<button class="slick-arrow slick-prev" id="button-prev" data-button="button-prev" onclick="app.processingButton(event)">
														<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-left" class="svg-inline--fa fa-chevron-left fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
															<path fill="currentColor" d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path>
														</svg>
													</button>
													<div class="slick-track" id="track">
														'.$track.'
													</div>
													<button class="slick-arrow slick-next" id="button-next" data-button="button-next" onclick="app.processingButton(event)">
														<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" class="svg-inline--fa fa-chevron-right fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
															<path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
														</svg>
													</button>
												</div>';
							break;
						}
					break;
					case "card_informativos":
						switch ($Dato) {
							case "ACTIVO":
								MModel($this->Modulo, 'CRUD');
								$InstanciaAjax	= new CRUD();
								$Respuesta	= $InstanciaAjax->informativos_activos();
								foreach ($Respuesta as $row){
									$boton_pdf = "";
									$boton_video = "";
									$boton_link = "";
									$footer = "";
									if($row['Comu_Pdf']!=""){
										$boton_pdf = '<a href="../../../Services/files/pdf/comunicados/'.$row['Comu_Pdf'].'" class="btn btn-danger" target="_blank"><i class="bi bi-filetype-pdf"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/></svg></i></a>';
									}
									if($row['Comu_Video']!=""){
										$boton_video = '<a href="'.$row['Comu_Video'].'" class="btn btn-primary" target="_blank"><i class="bi bi-play-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-btn" viewBox="0 0 16 16"><path d="M6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814z"/><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/></svg></i></a>';
									}
									if($row['Comu_Link']!=""){
										$boton_link = '<a href="'.$row['Comu_Link'].'" class="btn btn-success" target="_blank"><i class="bi bi-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link" viewBox="0 0 16 16"><path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9q-.13 0-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/><path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4 4 0 0 1-.82 1H12a3 3 0 1 0 0-6z"/></svg></i></a>';
									}
									if($boton_pdf!="" || $boton_video!="" || $boton_link!=""){
										$footer = ' <div class="card-footer">
														'.$boton_pdf.$boton_video.$boton_link.'
													</div>';
									}
									$Mostrar_div .= '<div class="card text-center border-info mb-3">
														<div class="card-header bg-info text-white">
															'.$row['Comu_Titulo'].'
														</div>
														<div class="card-body">
															<a href="../../../Services/files/image/comunicados/'.$row['Comu_Imagen'].'" target="_blank"</a>
																<img src="../../../Services/files/image/comunicados/'.$row['Comu_Imagen'].'" class="card-img-top" alt="'.$row['Comu_Imagen'].'" width="250px" height="250px">
															</a>
														</div>
														'.$footer.'
													</div>';
								}
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
