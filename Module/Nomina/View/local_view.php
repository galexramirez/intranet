<!-- 2.2 CONTENIDO DE MODULO -->
<div id="contenido" class="my-contenido-con-sidebar p-0">

	<nav class="navbar navbar-light bg-light p-0 navbar-expand topbar static-top">
		<div class="container-fluid">
			<div class="row justify-content-between w-100 align-items-center">	
				<div class="col-4">
					<a class="navbar-brand text-muted" href="#">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
 				 			<path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
						</svg>
						<?= $NombreDeModuloVista ?>
					</a>
				</div>
				<div class="text-right">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown no-arrow mx-1">
							<a class="nav-link-alert dropdown-toggle" href="#" id="alertsDropdown_ayuda" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="bi bi-question-circle-fill" title="Ayuda">
									<svg style="color: blue" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/></svg>
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
	 		<div class="nav nav-tabs" id="nav-tab-nomina" role="tablist">
				<!-- PHP Accesos Creacion Tabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">
			<!--------------------------------------------------------------------------->
	  		<!-- TAB LISTADO NOMINA ----------------------------------------------------->
			<!--------------------------------------------------------------------------->
			<div class="tab-pane fade show active" id="nav-listado_nomina" role="tabpanel" aria-labelledby="nav-listado_nomina-tab">
				<section class="container-fluid py-3">
					<form id="form_listado_nomina" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
						<div class="row align-items-end pb-4 col-sm-12">
							<div class="col-lg-1">
						      	<div class="form-group">
									<label for="fecha_inicio" class="col-form-label">F.INICIO</label>
									<input type="date" class="form-control form-control-sm" id="fecha_inicio" placeholder="aaaa-mm-dd" >
						      	</div>
						    </div>
							<div class="col-lg-1">
						      	<div class="form-group">
									<label for="fecha_termino" class="col-form-label">F.TERMINO</label>
									<input type="date" class="form-control form-control-sm" id="fecha_termino" placeholder="aaaa-mm-dd" >
						      	</div>
						    </div>
							<div class="col-lg-2">
					        	<div class="form-group">
									<label for="tipo_nomina" class="col-form-label form-control-sm">TIPO</label>
									<select name="tipo_nomina" class="form-control form-control-sm" id="tipo_nomina">
										<option value="PROGRAMACION">PROGRAMACION</option>
										<option value="OPERACION">OPERACION</option>
									</select>
						       	</div>
			        		</div>
							<div class="col-lg-1">
								<div class="form-group">
									<button type="button" id="btn_buscar_nomina" class="btn btn-secondary btn-sm btn_buscar_nomina">Buscar</button>
								</div>
						    </div> 
						</div>
					</form>
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_listado_nomina">

						</div>
    				</div>
				</div>
			</div>

			<!--------------------------------------------------------------------------->
	  		<!-- TAB GENERAR NOMINA ----------------------------------------------------->
			<!--------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-generar_nomina" role="tabpanel" aria-labelledby="nav-generar_nomina-tab">
				<section class="container-fluid py-3">
					<form id="form_seleccion_gerenar_nomina" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
						<div class="row align-items-end pb-4 col-sm-12">
							<div class="col-lg-1">
					        	<div class="form-group">
									<label for="anio_generar_nomina" class="col-form-label form-control-sm">AÑO</label>
									<select name="anio_generar_nomina" class="form-control form-control-sm" id="anio_generar_nomina">
							    	</select>
						       	</div>
			        		</div>
							<div class="col-lg-2">
								<div class="form-group">
									<button type="button" id="btn_buscar_generar_nomina" class="btn btn-secondary btn-sm btn_buscar_generar_nomina">Buscar</button>
									<button type="button" id="btn_agregar_nomina" class="btn btn-secondary btn-sm btn_agregar_nomina">+ Nómina</button>
								</div>
						    </div> 
						</div>
					</form>
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_generar_nomina">

						</div>
    				</div>
				</div>

				<!--Modal para CRUD GENERAR NOMINA A JSON-->
				<div class="row modal fade" id="modal_crud_generar_nomina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="form_generar_nomina">    
				  				<div class="modal-body">
					  				<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<label for="ncar_anio" class="col-form-label form-control-sm">AÑO</label>
												<select name="ncar_anio" class="form-control form-control-sm" id="ncar_anio">
										    	</select>
											</div> 
									  	</div>    
										<div class="col-lg-4">
											<div class="form-group">
												<label for="ncar_periodo" class="col-form-label form-control-sm">PERIODO</label>
												<select class="form-control form-control-sm" id="ncar_periodo">
													<option value="ENERO">ENERO</option>
													<option value="FEBRERO">FEBRERO</option>
													<option value="MARZO">MARZO</option>
													<option value="ABRIL">ABRIL</option>
													<option value="MAYO">MAYO</option>
													<option value="JUNIO">JUNIO</option>
													<option value="JULIO">JULIO</option>
													<option value="AGOSTO">AGOSTO</option>
													<option value="SETIEMBRE">SETIEMBRE</option>
													<option value="OCTUBRE">OCTUBRE</option>
													<option value="NOVIEMBRE">NOVIEMBRE</option>
													<option value="DICIEMBRE">DICIEMBRE</option>
												</select>
											</div>
										</div>
										<div class="col-lg-5">
							  				<div class="form-group">
												<label for="ncar_tipo" class="col-form-label form-control-sm">TIPO</label>
												<select class="form-control form-control-sm" id="ncar_tipo">
													<option value="PROGRAMACION">PROGRAMACION</option>
													<option value="OPERACION">OPERACION</option>
												</select>

											</div>
						  				</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="ncar_fecha_inicio" class="col-form-label form-control-sm">FECHA INICIO</label>
												<input type="date" class="form-control form-control-sm" id="ncar_fecha_inicio" placeholder="dd/mm/aaaaa">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
											<label for="ncar_fecha_termino" class="col-form-label form-control-sm">FECHA TERMINO</label>
												<input type="date" class="form-control form-control-sm" id="ncar_fecha_termino" placeholder="dd/mm/aaaaa">
											</div> 
									  	</div>    
					  				</div>

								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btn_generar_nomina" class="btn btn-dark btn-sm btn_generar_nomina">Generar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			


			</div>

			<!--------------------------------------------------------------------------->
	  		<!-- TAB GENERAR HORARIOS NOMINA -------------------------------------------->
			<!--------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-carga_horarios_nomina" role="tabpanel" aria-labelledby="nav-carga_horarios_nomina-tab">
				<section class="container-fluid py-3">
					<form id="form_seleccion_carga_horarios_nomina" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
						<div class="row align-items-end pb-4 col-sm-12">
							<div class="col-lg-1">
					        	<div class="form-group">
									<label for="anio_carga_horarios_nomina" class="col-form-label form-control-sm">AÑO</label>
									<select name="anio_carga_horarios_nomina" class="form-control form-control-sm" id="anio_carga_horarios_nomina">
							    	</select>
						       	</div>
			        		</div>
							<div class="col-lg-2">
								<div class="form-group">
									<button type="button" id="btn_buscar_carga_horarios_nomina" class="btn btn-secondary btn-sm btn_buscar_carga_horarios_nomina">Buscar</button>
									<button type="button" id="btn_agregar_carga_horarios_nomina" class="btn btn-secondary btn-sm btn_agregar_carga_horarios_nomina">+ Horarios</button>
								</div>
						    </div> 
						</div>
					</form>
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_carga_horarios_nomina">

						</div>
    				</div>
				</div>

				<!--Modal para CRUD GENERAR NOMINA A JSON-->
				<div class="row modal fade" id="modal_crud_generar_horarios_nomina" tabindex="-1" role="dialog" aria-labelledby="carga_horarios_nomina_ModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="carga_horarios_nomina_ModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="form_carga_horarios_nomina">    
				  				<div class="modal-body">
					  				<div class="row">
									  <div class="col-lg-6">
											<div class="form-group">
												<label for="chn_fecha" class="col-form-label form-control-sm">FECHA</label>
												<input type="date" class="form-control form-control-sm" id="chn_fecha" placeholder="dd/mm/aaaaa">
											</div>
										</div>
										<div class="col-lg-6">
							  				<div class="form-group">
												<label for="chn_operacion" class="col-form-label form-control-sm">OPERACION</label>
												<select class="form-control form-control-sm" id="chn_operacion">
													<option value="TRONCAL">TRONCAL</option>
													<option value="ALIMENTADOR">ALIMENTADOR</option>
												</select>

											</div>
						  				</div>
									</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btn_generar_horarios_nomina" class="btn btn-dark btn-sm btn_generar_horarios_nomina">Generar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			


			</div>

			<!--------------------------------------------------------------------------->
	  		<!-- TAB LISTADO HORARIOS NOMINA -------------------------------------------->
			<!--------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-listado_horarios_nomina" role="tabpanel" aria-labelledby="nav-listado_horarios_nomina-tab">
				<section class="container-fluid py-3">
					<form id="form_listado_horarios_nomina" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
						<div class="row align-items-end pb-4 col-sm-12">
							<div class="col-lg-1">
						      	<div class="form-group">
									<label for="hn_fecha" class="col-form-label">FECHA</label>
									<input type="date" class="form-control form-control-sm" id="hn_fecha" placeholder="aaaa-mm-dd" >
						      	</div>
						    </div>
							<div class="col-lg-2">
					        	<div class="form-group">
									<label for="hn_operacion" class="col-form-label form-control-sm">OPERACION</label>
									<select name="hn_operacion" class="form-control form-control-sm" id="hn_operacion">
										<option value="TRONCAL">TRONCAL</option>
										<option value="ALIMENTADOR">ALIMENTADOR</option>
									</select>
						       	</div>
			        		</div>
							<div class="col-lg-1">
								<div class="form-group">
									<button type="button" id="btn_buscar_horarios_nomina" class="btn btn-secondary btn-sm btn_buscar_horarios_nomina">Buscar</button>
								</div>
						    </div> 
						</div>
					</form>
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_listado_horarios_nomina">

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
