<div id="contenido" class="my-contenido-con-sidebar p-0">

	<nav class="navbar navbar-light bg-light p-0">
		<div class="container-fluid">
			<div class="row justify-content-between w-100 align-items-center">
				<div class="col-4">
					<a class="navbar-brand text-muted" href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
 						 <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
					</svg>	
					<?= $NombreDeModuloVista ?></a>
				</div>	
				<div class="col-4 text-right">
					<a class="navbar-brand text-muted" href="#">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
							<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
						</svg>
					</a>
				</div>
			</div>
		</div>
	</nav>

	<!-- Contenido para el Modulo -->
	<div class="my-contenidoModulo container-fluid pl-0 pr-0 ml-0 mr-0">

		<nav>
			<div class="nav nav-tabs" id="nav-tab-componentes" role="tablist">
				<!-- PHP Accesos Creacion Tabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">

			<!-- TAB COMPONENTES -->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<form id="form_seleccion_componentes" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="form-group m-0 mt-1 py-3">
						<div class="ml-3">
							<button id="btn_buscar_componentes" type="button" class="btn btn-secondary btn-sm btn_buscar_componentes">Buscar</button>
							<button id="btn_nuevo_componentes" type="button" class="btn btn-secondary btn-sm btn_nuevo_componentes" data-toggle="modal">+ Agregar</button>	
						</div>
					</div>
				</form>
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_componentes">
							<!-- PHP Accesos CreacionTabla -->
						</div>
    				</div>
				</div>

				<!--Modal para CRUD COMPONENTES -->
				<div class="row modal fade" id="modal_crud_componentes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
			        	<div class="modal-content ui-widget-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_componentes" enctype="multipart/form-data" action="" method="post">    
								<div class="modal-body">
									<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label for="componente_id" class="col-form-label form-control-sm">NRO. REGISTRO</label>
															<input type="text" readonly class="form-control form-control-sm" id="componente_id">
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label for="comp_sistema" class="col-form-label form-control-sm ">SISTEMA</label>
															<select class="form-control form-control-sm  text-uppercase" id="comp_sistema">
															</select>
														</div>
													</div>
									</div>
									<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label for="comp_tipo_componente" class="col-form-label form-control-sm">TIPO COMPONENTE</label>
															<select class="form-control form-control-sm text-uppercase" id="comp_tipo_componente">
															</select>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label for="comp_codigo_patrimonial" class="col-form-label form-control-sm">CODIGO PATRIMONIAL</label>
															<input type="text" readonly class="form-control-sm form-control" id="comp_codigo_patrimonial">
														</div>
													</div>
									</div>
									<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label for="comp_origen" class="col-form-label form-control-sm ">ORIGEN (ANTIGUO/NUEVO)</label>
															<select class="form-control form-control-sm  text-uppercase" id="comp_origen">
															</select>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label for="comp_nro_serie" class="col-form-label form-control-sm ">NRO. DE SERIE</label>
															<input type="text" class="form-control-sm  form-control" id="comp_nro_serie">
														</div>
													</div>
									</div>
									<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label for="comp_nro_parte" class="col-form-label form-control-sm ">NRO. PARTE</label>
															<input type="text" class="form-control-sm  form-control" id="comp_nro_parte">
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label for="comp_turno" class="col-form-label form-control-sm ">TURNO</label>
															<select class="form-control form-control-sm text-uppercase" id="comp_turno">
															</select>
														</div>
													</div>
									</div>
									<div class="row">
													<div class="col-lg-12">
														<div class="form-group mb-4">
															<label for="comp_observaciones" class="col-form-label form-control-sm">OBSERVACIONES</label>
															<textarea class="form-control form-control-sm mb-4 text-uppercase" id="comp_observaciones" rows="2" placeholder="escribe algo aqui..." maxlength="500"></textarea>
														</div>
													</div>
									</div>
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group">
												<label for="comp_nombres_usuario" class="col-form-label form-control-sm">RESPONSABLE</label>
												<input type="text" readonly class="form-control-sm  form-control" id="comp_nombres_usuario">
											</div>
										</div>
										<div class="col-lg-5">
											<div class="form-group">
												<label for="comp_fecha" class="col-form-label form-control-sm">FECHA</label>
												<input type="text" readonly class="form-control form-control-sm" id="comp_fecha">
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<label for="comp_log" class="col-form-label form-control-sm"></label>
												<button type="button" id="btn_comp_log" class="btn btn-info btn-sm btn_comp_log">Log</button>
											</div>
										</div>
									</div>
								</div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
									<button type="submit" id="btn_guardar_componente" class="btn btn-dark btn-sm btn_guardar_componente">Guardar</button>
								</div>
							</form>
			        	</div>
			    	</div>
				</div>

				<!-- MODAL CRUD LOG COMPONENTES -->
				<div class="row modal fade" id="modal_crud_log_componentes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header modal-header-log_componentes">
			                	<h5 class="modal-title modal-title-log_componentes" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_log_componentes" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_log_componentes">
											</div>
			      		            	</div>
									</div>  
								</div>
							</form>
			        	</div>
			    	</div>
				</div>
				<!-- FIN CRUD LOG COMPONENTES --> 

			</div>

			<!-- TAB HISTORIAL COMPONENTES -->
			<div class="tab-pane fade" id="nav-historial" role="tabpanel" aria-labelledby="nav-historial-tab">
				<section class="container-fluid py-3">
					<button id="btn_historial_componente" type="button" class="btn btn-secondary btn-sm btn_historial_componente" data-toggle="modal">Buscar</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_historial_componentes">
							<!-- PHP Creacion de Tablas -->
						</div>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>