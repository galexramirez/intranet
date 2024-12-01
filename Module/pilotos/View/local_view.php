<!-- 2.2 CONTENIDO DE MODULO -->

<div id="contenido" class="my-contenido-con-sidebar p-0">
	<nav class="navbar navbar-light bg-light p-0 navbar-expand topbar static-top">
		<div class="container-fluid">
			<div class="row justify-content-between w-100 align-items-center">
				<div class="col-4">
					<a class="navbar-brand text-muted" href="#">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
							<path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
						</svg>
						<?= $NombreDeModuloVista ?>
					</a>
				</div>
				<div class="text-right">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown no-arrow mx-1">
							<a class="nav-link-alert dropdown-toggle" href="#" id="alertsDropdown_ayuda" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="bi bi-question-circle-fill" title="Ayuda">
									<svg style="color: blue" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
										<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
									</svg>
								</i>
							</a>
							<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown_ayuda" id="div_alertsDropdown_ayuda">
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>

	<!-- Contenido para el Modulo -->
	<div class="my-contenidoModulo container-fluid pl-0 pr-0 ml-0 mr-0">
		<nav>
			<div class="nav nav-tabs" id="div_nav-tab-comunicado" role="tablist">
				<!-- Creacion Tabs -->
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<!---------------------------------------------------------------------->
			<!------------------------- TAB COMUNICADOS ---------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade show active" id="nav-comunicado" role="tabpanel" aria-labelledby="nav-comunicado-tab">
				<section class="container-fluid py-2">
					<form id="form_comunicados" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">
						<div class="row align-items-end justify-content-center pb-4 col-sm-12">
							<div class="col-sm-3">
								<div class="form-group" id="btn_form_comunicados" name="btn_form_comunicados">

								</div>
							</div>
						</div>
					</form>
				</section>
				<section class="container-fluid py-2">
					<div class="row align-items-end justify-content-center pb-4 col-sm-12">
						<div class="Carousel" id="carousel_comunicados">

						</div>
					</div>
				</section>
				<section class="container-fluid py-2">
					<div class="row justify-content-center pb-4 col-sm-12">
						<div class="col-sm-7">
							<div class="card-columns" id="card_comunicados">

							</div>
						</div>
					</div>
				</section>
				<!-- MODAL CRUD MARCACION EN HTML -->
				<div class='row modal fade' id='modal_marcacion' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
					<div class='modal-dialog' role='document'>
						<div class='modal-content'>
							<div class='modal-header'>
								<h5 class='modal-title' id='modal_title_marcacion'></h5>
								<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
								</button>
							</div>
							<div class='modal-body' id='modal_body_marcacion'>
							</div>
						</div>
					</div>
				</div>
				<!-- FIN MODAL CRUD MARCACION EN HTML -->
			</div>
			<!---------------------------------------------------------------------->
			<!---------------------------- TAB SIG --------------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-sig" role="tabpanel" aria-labelledby="nav-sig-tab">
				<section class="container-fluid py-2">
					<div class="row align-items-end justify-content-center pb-4 col-sm-12">
						<div class="Carousel" id="carousel_sig">
						</div>
					</div>
				</section>
				<section class="container-fluid py-2">
					<div class="row justify-content-center pb-4 col-sm-12">
						<div class="col-sm-7">
							<div class="card-columns" id="card_sig">

							</div>
						</div>
					</div>
				</section>
			</div>
			<!---------------------------------------------------------------------->
			<!------------------------- TAB NOVEDADES ------------------------------>
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-novedades" role="tabpanel" aria-labelledby="nav-novedades-tab">
				<!-- Content Wrapper -->
				<div id="content-wrapper" class="container-fluid d-flex flex-column py-4">
					<!-- Main Content -->
					<div id="content" class="container-fluid p-0">
						<div class="row justify-content-center pb-4 col-sm-12">
							<div class="card-columns" id="card_novedades">

							</div>
						</div>
					</div>
					<!-- End of Main Content -->
					<!-- Footer -->
					<footer class="sticky-footer">
						<div class="container my-auto">
							<div class="copyright text-center my-auto">

							</div>
						</div>
					</footer>
					<!-- End of Footer -->
				</div>
				<!-- End of Content Wrapper -->
			</div>
			<!---------------------------------------------------------------------->
			<!------------------------- TAB INFORMATIVOS --------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-informativos" role="tabpanel" aria-labelledby="nav-informativos-tab">
				<section class="container-fluid py-2">
					<div class="row align-items-end justify-content-center pb-4 col-sm-12">
						<div class="Carousel" id="carousel_informativos">
						</div>
					</div>
				</section>
				<section class="container-fluid py-2">
					<div class="row justify-content-center pb-4 col-sm-12">
						<div class="col-sm-7">
							<div class="card-columns" id="card_informativos">

							</div>
						</div>
					</div>
				</section>
			</div>
			<!---------------------------------------------------------------------->
			<!------------------------- TAB PUBLICACIONES -------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-publicaciones" role="tabpanel" aria-labelledby="nav-publicaciones-tab">
				<section class="container-fluid py-3">
					<button id="btn_nuevo" type="button" class="btn btn-secondary btn-sm btn_nuevo ml-3" data-toggle="modal">+ Nuevo</button>
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_publicacion">
							<!-- Accesos Creacion Tabla -->
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modal_crud_publicacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">

							<div class="modal-header">
								<h5 class="modal-title" id="publicacion_modal_label"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
								</button>
							</div>

							<form id="form_publicacion">
								<div class="modal-body">
									<div class="row">
										<div class="col-sm-6">
											<div class="row">
												<div class="col-lg-12"> <!--  ml-auto -->
													<div class="ExternalFiles text-center" id="div_comu_imagen">
														<!--<img src="data:image/jpg;base64," height="260px" width="280px" alt="" />-->
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group">
														<div class="custom-file">
															<label id="label_comu_imagen" class="custom-file-label form-control-sm" for="comu_imagen">Seleccionar Archivo .jpg, .bmp, .jpeg o .png</label>
															<input type="file" class="custom-file-input form-control-sm" id="comu_imagen" lang="es" accept=".jpg, .bmp, .jpeg, .png">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group">
														<label for="comu_titulo" class="col-form-label form-control-sm">TITULO (Máx. 200 caract.)</label>
														<input type="text" class="form-control text-uppercase form-control-sm" id="comu_titulo" maxlength="200">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="comu_fecha_inicio" class="col-form-label form-control-sm">F.INICIO</label>
														<input type="date" class="form-control form-control-sm" id="comu_fecha_inicio">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label for="comu_fecha_fin" class="col-form-label form-control-sm">F.TERMINO</label>
														<input type="date" class="form-control form-control-sm" id="comu_fecha_fin">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="comu_categoria" class="col-form-label form-control-sm">CATEGORIA</label>
														<select class="form-control form-control-sm" id="comu_categoria">
															<option value="INFORMATIVO" selected>INFORMATIVO</option>
															<option value="SIG">SIG</option>
															<option value="AVISO">AVISO</option>
														</select>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label for="comu_destacado" class="col-form-label form-control-sm">DESTACADO</label>
														<select class="form-control form-control-sm" id="comu_destacado">
															<option value="1">SI</option>
															<option value="2" selected>NO</option>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group">
														<label for="comu_pdf" class="col-form-label form-control-sm">PDF</label>
														<div class="form-group">
															<div class="custom-file">
																<label id="label_comu_pdf" class="custom-file-label form-control-sm" for="comu_pdf">Seleccionar Archivo .pdf</label>
																<input type="file" class="custom-file-input form-control-sm" id="comu_pdf" lang="es" accept=".pdf">
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group">
														<label for="comu_video" class="col-form-label form-control-sm">VIDEO (Máx. 200 caract.)</label>
														<input type="text" class="form-control form-control-sm" id="comu_video" maxlength="200">
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-lg-12">
													<div class="form-group">
														<label for="comu_link" class="col-form-label form-control-sm">LINK (Máx. 200 caract.)</label>
														<input type="text" class="form-control form-control-sm" id="comu_link" maxlength="200">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
									<button type="submit" id="btn_guardar" class="btn btn-dark btn-sm btn_guardar">Guardar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL CRUD VER AYUDA EN HTML -->
	<div class="row modal fade" id="modal_crud_ver_ayuda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<!--<div class="modal-content ui-widget-content" id="modal-resizable_ver_manual">-->
				<div class="modal-header dragable_touch">
					<h5 class="modal-title" id="exampleModalLabel"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form_modal_ver_ayuda" enctype="multipart/form-data" action="" method="post">
					<div class="modal-body">
						<div id="div_ver_ayuda_html">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- FIN MODAL CRUD VER AYUDA EN HTML -->

</div>