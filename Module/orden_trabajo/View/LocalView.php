<div id="contenido" class="my-contenido-con-sidebar p-0">

	<nav class="navbar navbar-light bg-light p-0 navbar-expand topbar static-top">
		<div class="container-fluid">
			<div class="row justify-content-between w-100 align-items-center">
				<div class="col-4">
					<a class="navbar-brand text-muted ml-3" href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
 						 <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
					</svg>	
					<?= $NombreDeModuloVista ?></a>
				</div>
				<div class="col-4">
					<div class="row justify-content-end w-100 align-items-center">
						<div class="text-right">
							<ul class="navbar-nav ml-auto">
								<li class="nav-item dropdown no-arrow mx-1">
									<a class="nav-link-alert dropdown-toggle" href="#" id="alertsDropdown_ot" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-bell fa-fw"></i>
                		        		<span class="badge badge-danger badge-counter" id="ot_alerta"></span>
									</a>
                		            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown_ot" id="div_alertsDropdown_ot">
                		            </div>
								</li>
							</ul>
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
			</div>
		</div>
	</nav>

	<!-- Contenido para el Modulo -->
	<div class="my-contenidoModulo container-fluid pl-0 pr-0 ml-0 mr-0">

		<nav>
			<div class="nav nav-tabs" id="nav-tab-OTCorrectivas" role="tablist">
				<!-- PHP Accesos Creacion Tabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">

			<!------------------------------------------------------------------------------->	
			<!-- TAB OT's ------------------------------------------------------------------->
			<!------------------------------------------------------------------------------->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

				<form id="formSeleccionOT" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
			      			<div class="form-group">
								<label for="" class="col-form-label form-control-sm">F.INICIO</label>
								<input type="date" class="form-control form-control-sm" id="FechaInicioOT" placeholder="dd/mm/aaaa" >
			      			</div>
			    		</div>
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="" class="col-form-label form-control-sm">F.TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="FechaTerminoOT" placeholder="dd/mm/aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-2">             	
							<div class="form-group">
								<button type="button" id="btnBuscarOT"class="btn btn-secondary btn-sm"> Buscar </button>
								<button type="button" id="btn_descargar_ot" class="btn btn-secondary btn-sm btn_descargar_ot">Descargar</button>
							</div>
				    	</div>
					</div>
				</form>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaOT">
							<!-- PHP Accesos CreacionTabla -->
						</div>
    				</div>
				</div>

				<!--Modal para CRUD VER OTs-->
				<div class="row modal fade" id="modal_crud_informacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
						<div class="modal-content ui-widget-content" id="modal-resizable_informacion">
							<div class="modal-header dragable_touch">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body scrollVClass">
								<form id="form_modal_informacion">
									<div class="container-fluid ml-0 mr-0 mb-0">
										<form id="form_info_detalle" enctype="multipart/form-data" action="" method="post">    
											<div class="form-group" id="div_info_detalle">
												<!-- PHP Logico InfoBusOTs -->
											</div>
										</form>
									</div>			
								</form>
							</div>
							<div class="modal-footer">
					  			<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
  							</div>
						</div>
					</div>
				</div>  			
				
			</div>

			<!------------------------------------------------------------------------------->
			<!-- TAB PROCESAR OT'S ---------------------------------------------------------->
			<!------------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

				<form id="formSeleccionProcesarOT" class="row col-sm-12 container-fluid" onsubmit="return false;">	    
					<div class="row align-items-end pb-0 col-sm-12 mb-1">
						<div class="col-lg-2">
							<div class="form-group mb-0">
								<div class="input-group mt-3">
							  		<div class="input-group-prepend">
       									<span class="input-group-text form-control-sm" id="basic-addon1">OT N° P-</span>
        								<input type="text" class="form-control form-control-sm" id="ot_id" placeholder="Código OT" aria-label="ot_id" aria-describedby="basic-addon1">
							  		</div>
      							</div>
							</div>
			        	</div>

						<div class="col-lg-2">
							<div class="form-group mb-0">
								<button type="button" id="btnCargarOT" class="btn btn-secondary btn-sm" >Cargar</button>
								<button type="button" title='Ver OT' id='btn_procesar_ver_ot' class='btn btn-secondary btn-sm btn_procesar_ver_ot'><i class='bi bi-search'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg></i></button>
							</div>
			       		</div>

					</div>
				</form>

				<div class="container-fluid ml-0 mr-0 mb-0">
					<form id="formProcesarOT" enctype="multipart/form-data" action="" method="post" onsubmit="return false;">
			      		<div class="form-group">
							<div class="row d-flex justify-content-araound">
								<div class="col-lg-6 mx-1">
									<div class="row border border-muted border-radius rounded mb-2">
										<div class="col-lg-12">
											<div class="row">
												<div class="col-lg-1 border border-muted border-radius rounded d-flex align-items-center">
													<div class="form-group form-control-sm mb-1">
														<h5 class="font-weight-bold">LBI</h5>
													</div>
												</div>
												<div class="col-lg-3 border border-muted border-radius rounded">
													<div class="row align-items-end">
														<div class="col-lg-12">
															<div class="form-group form-control-sm mb-1 text-center">
																<label for="" class="form-control-sm pl-0 mb-0">Orden de Trabajo</label>
																<label for="" class="form-control-sm pl-0 mb-0">MT-F-04</label>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-6 border border-muted border-radius rounded">
													<div class="row align-items-end">
														<div class="col-lg-12">
															<div class="form-group form-control-sm mb-1 text-center">
																<label for="ot_origen" class="form-control-sm pl-0 mb-0">ORIGEN</label>
															</div>
														</div>
													</div>
													<div class="row align-items-end">
														<div class="col-lg-12">
															<div class="form-group form-control-sm mb-1">
																<select class="col-form-label form-control form-control-sm mb-1" id="ot_origen" name="ot_origen" >
																</select>
															</div>
														</div>
													</div>
												</div>	
												<div class="col-lg-2 border border-muted border-radius rounded d-flex align-items-center">
													<div class="form-group form-control-sm mb-1 text-center" id="div_CodigoOT">
														<!-- PHP MostrarDiv Codigo OT -->
													</div>
												</div>		
											</div>
											<div class="row">
												<div class="col-lg-2 border border-muted border-radius rounded">
													<div class="row align-items-end">
														<div class="col-lg-12">
															<div class="form-group form-control-sm mb-1 text-center">
																<h5 class="font-weight-bold">BUS</h5>
															</div>
														</div>
													</div>
													<div class="row align-items-end">
														<div class="col-lg-12">
															<div class="form-group form-control-sm mb-1">
																<select class="col-form-label form-control form-control-sm mb-1" id="ot_bus" name="ot_bus" >
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-10">
													<div class="row align-items-end border border-muted border-radius rounded">
														<div class="col-lg-2">
															<div class="form-group form-control-sm mb-1">	
																<label for="ot_cgm_crea" class="form-control-sm pl-0 mb-0">GENERO</label>
															</div>
														</div>
														<div class="col-lg-5">
															<div class="form-group form-control-sm mb-1">
																<select class="col-form-label form-control form-control-sm mb-1" id="ot_cgm_crea" name="ot_cgm_crea" >
																</select>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group form-control-sm mb-1">	
																<label for="ot_data_crea" class="form-control-sm pl-0 mb-0">EL</label>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group form-control-sm mb-1">
																<input type="datetime-local" class="form-control form-control-sm mb-1" id="ot_date_crea">
															</div>
														</div>
													</div>
													<div class="row align-items-end border border-muted border-radius rounded">
														<div class="col-lg-2">
															<div class="form-group form-control-sm mb-1">	
																<label for="ot_asociado" class="form-control-sm pl-0 mb-0">ASOCIADO</label>
															</div>
														</div>
														<div class="col-lg-5">
															<div class="form-group form-control-sm mb-1">
																<select class="col-form-label form-control form-control-sm mb-1" id="ot_asociado" name="ot_asociado" >
																</select>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group form-control-sm mb-1">	
																<label for="ot_resp_asoc" class="form-control-sm pl-0 mb-0">RESP</label>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group form-control-sm mb-1">
																<select class="col-form-label form-control form-control-sm mb-1" id="ot_resp_asoc" name="ot_resp_asoc" >
																</select>
															</div>
														</div>
													</div>
												</div>	
											</div>
										</div>
									</div>
									<div class="row border border-muted border-radius rounded mb-2">
										<div class="col-lg-12">	
											<div class="row align-items-end border border-muted border-radius rounded">
												<div class="col-lg-2">
													<div class="form-group form-control-sm mb-1">
														<label for="ot_kilometraje" class="form-control-sm pl-0 mb-0">KILOMETRAJE:</label>
													</div>
												</div>
												<div class="col-lg-2">
													<div class="form-group form-control-sm mb-1">
														<input type="number" class="form-control form-control-sm mb-1" id="ot_kilometraje">
													</div>
												</div>
												<div class="col-lg-8">
													<div class="form-group form-control-sm mb-1" id="div_KmComparacion">
							    						<!-- JS f_CalculoKilometraje -->
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6 border border-muted border-radius rounded">
													<div class="row align-items-end">
														<div class="col-lg-6">
															<div class="form-group form-control-sm mb-1">
																<label for="ot_hmotor" class="form-control-sm pl-0 mb-0">HORA MOTOR:</label>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group form-control-sm mb-1">
																<input type="number" class="form-control form-control-sm mb-1" id="ot_hmotor">
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-6 border border-muted border-radius rounded">
													<div class="row align-items-end">
														<div class="col-lg-4">
															<div class="form-group form-control-sm mb-1">
																<label for="ot_check" class="form-control-sm pl-0 mb-0">CHECK:</label>
															</div>
														</div>
														<div class="col-lg-8">
															<div class="form-group form-control-sm mb-1">
																<select class="col-form-label form-control form-control-sm mb-1" id="ot_check" name="ot_check" >
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6 border border-muted border-radius rounded">
													<div class="row align-items-end">
														<div class="col-lg-6">
															<div class="form-group form-control-sm mb-1">
																<label for="ot_cod_vinculada" class="form-control-sm pl-0 mb-0">NRO. OT VINCULADA</label>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group form-control-sm mb-1">
																<input type="number" class="form-control form-control-sm mb-1" id="ot_cod_vinculada">
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-6 border border-muted border-radius rounded">
													<div class="row align-items-end">
														<div class="col-lg-4">
															<div class="form-group form-control-sm mb-1">
																<label for="ot_accidentes_id" class="form-control-sm pl-0 mb-0">N° IP:</label>
															</div>
														</div>
														<div class="col-lg-8">
															<div class="form-group form-control-sm mb-1">
																<input type="text" class="col-form-label form-control form-control-sm mb-1" id="ot_accidentes_id" name="ot_accidentes_id" placeholder="Informe Preliminar" disabled>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row align-items-end border border-muted border-radius rounded">
												<div class="form-group col-lg-12 mb-1">
    												<label for="ot_descrip" class="form-control-sm pl-0 mb-0">DESCRIPCION DE LA ACTIVIDAD (Verbo + Detalle - Máximo 10000 carácteres)</label>
    												<textarea class="form-control form-control-sm mb-1 text-uppercase" id="ot_descrip" rows="3" placeholder="escribe algo aqui..." maxlength="10000"></textarea>
												</div>
											</div>
											<div class="row align-items-end border border-muted border-radius rounded">
												<div class="form-group col-lg-12 mb-1">
    												<label for="ot_obs_cgm" class="form-control-sm pl-0 mb-0">OBSERVACIONES DE CGM (Máximo 1000 carácteres)</label>
    												<textarea class="form-control form-control-sm mb-1 text-uppercase" id="ot_obs_cgm" rows="3" placeholder="escribe algo aqui..." maxlength="1000"></textarea>
												</div>
											</div>
											<div class="row align-items-end border border-muted border-radius rounded">
												<div class="col-lg-3">
													<div class="form-group form-control-sm mb-1">	
														<label for="ot_cgm_ct" class="form-control-sm pl-0 mb-0">CIERRE TECNICO POR</label>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group form-control-sm mb-1">
														<select class="col-form-label form-control form-control-sm mb-1" id="ot_cgm_ct" name="ot_cgm_ct" >
														</select>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group form-control-sm mb-1" id="div_ot_date_ct">	
														<!-- PHP MostrarDiv Cierre Tecnico -->
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row border border-muted border-radius rounded">
										<div class="col-lg-12">	
											<div class="row">
												<div class="col-lg-6 border border-muted border-radius rounded d-flex align-items-center">
													<div class="form-group form-control-sm mb-1 text-center">
														<h5 class="font-weight-bold">CIERRE (ACCION TOMADA)</h5>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="row border border-muted border-radius rounded">
														<div class="col-lg-4">
															<div class="form-group form-control-sm mb-1">	
																<label for="ot_inicio" class="form-control-sm pl-0 mb-0">INICIO:</label>
															</div>
														</div>
														<div class="col-lg-8">
															<div class="form-group form-control-sm mb-1">
																<input type="datetime-local" class="form-control form-control-sm mb-1" id="ot_inicio">
															</div>
														</div>
													</div>
													<div class="row border border-muted border-radius rounded">
														<div class="col-lg-4">
															<div class="form-group form-control-sm mb-1">	
																<label for="ot_fin" class="form-control-sm pl-0 mb-0">FINALIZO:</label>
															</div>
														</div>
														<div class="col-lg-8">
															<div class="form-group form-control-sm mb-1">
																<input type="datetime-local" class="form-control form-control-sm mb-1" id="ot_fin">
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6 border border-muted border-radius rounded">
													<div class="row align-items-end">
														<div class="col-lg-3">
															<div class="form-group form-control-sm mb-1">
																<label for="ot_sistema" class="form-control-sm pl-0 mb-0">SISTEMA:</label>
															</div>
														</div>
														<div class="col-lg-9">
															<div class="form-group form-control-sm mb-1">
																<select class="col-form-label form-control form-control-sm mb-1" id="ot_sistema" name="ot_sistema" >
																</select>	
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-6 border border-muted border-radius rounded">
													<div class="row align-items-end">
														<div class="col-lg-6">
															<div class="form-group form-control-sm mb-1">
																<label for="ot_codfalla" class="form-control-sm pl-0 mb-0">CODIGO FALLA:</label>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group form-control-sm mb-1">
																<input type="text" class="form-control form-control-sm mb-1" id="ot_codfalla">	
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row align-items-end border border-muted border-radius rounded">
												<div class="form-group col-lg-12 mb-1">
    												<label for="ot_at" class="form-control-sm pl-0 mb-0">DESCRIPCION DE ACCION TOMADA (Máximo 5000 carácteres)</label>
    												<textarea class="form-control form-control-sm mb-1 text-uppercase" id="ot_at" rows="3" placeholder="escribe algo aqui..." maxlength="5000"></textarea>
												</div>
											</div>
											<div class="row align-items-end border border-muted border-radius rounded">
												<div class="form-group col-lg-12 mb-1">
    												<label for="ot_obs_asoc" class="form-control-sm pl-0 mb-0">OBSERVACIONES DE ASOCIADO (Máximo 5000 carcteres):</label>
    												<textarea class="form-control form-control-sm mb-1 text-uppercase" id="ot_obs_asoc" rows="3" placeholder="escribe algo aqui..." maxlength="5000"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-5 mx-1">
									<div class="row border border-muted border-radius rounded mb-2">
										<div class="col-lg-12">
											<div class="row">
												<div class="col-lg-4 border border-muted border-radius rounded d-flex justify-content-center bg-info text-white">
													<div class="form-group form-control-sm mb-1">
														<label for="" class="form-control-sm pl-0 mb-0">N° VALE</label>
													</div>
												</div>
												<div class="col-lg-4 border border-muted border-radius rounded d-flex justify-content-center bg-info text-white">
													<div class="form-group form-control-sm mb-1">
														<label for="" class="form-control-sm pl-0 mb-0">ASOCIADO</label>
													</div>
												</div>
												<div class="col-lg-4 border border-muted border-radius rounded d-flex justify-content-center bg-info text-white">
													<div class="form-group form-control-sm mb-1">
														<label for="" class="form-control-sm pl-0 mb-0">ESTADO</label>
													</div>
												</div>
											</div>
											<div id="div_vales">
												<!-- PHP Logico CargarVales  -->
											</div>
										</div>
									</div>
									<div class="row border border-muted border-radius rounded mb-2">
										<div class="col-lg-12">
											<div class="row align-items-end border border-muted border-radius rounded">
												<div class="col-lg-6">
													<div class="form-group form-control-sm mb-1">
														<label for="ot_montado" class="form-control-sm pl-0 mb-0">N° Serie o codigo de Componente Montado :</label>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group form-control-sm mb-1">
														<input type="text" class="form-control form-control-sm mb-1" id="ot_montado">	
													</div>
												</div>
											</div>
											<div class="row align-items-end border border-muted border-radius rounded">
												<div class="col-lg-6">
													<div class="form-group form-control-sm mb-1">
														<label for="ot_dmontado" class="form-control-sm pl-0 mb-0">N° Serie o codigo de Componente Desmontado :</label>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group form-control-sm mb-1">
														<input type="text" class="form-control form-control-sm mb-1" id="ot_dmontado">	
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6 border border-muted border-radius rounded">
													<div class="row align-items-end">
														<div class="col-lg-7">
															<div class="form-group form-control-sm mb-1">
																<label for="ot_busdmont" class="form-control-sm pl-0 mb-0">Se desmonto del bus:</label>
															</div>
														</div>
														<div class="col-lg-5">
															<div class="form-group form-control-sm mb-1">
																<select class="col-form-label form-control form-control-sm mb-1" id="ot_busdmont" name="ot_busdmont" >
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-6 border border-muted border-radius rounded">
													<div class="row align-items-end">
														<div class="col-lg-5">
															<div class="form-group form-control-sm mb-1">
																<label for="ot_busmont" class="form-control-sm pl-0 mb-0">Para el bus:</label>
															</div>
														</div>
														<div class="col-lg-5">
															<div class="form-group form-control-sm mb-1">
																<select class="col-form-label form-control form-control-sm mb-1" id="ot_busmont" name="ot_busmont" >
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row align-items-end border border-muted border-radius rounded">
												<div class="col-lg-3">
													<div class="form-group form-control-sm mb-1">
														<label for="ot_motivo" class="form-control-sm pl-0 mb-0">Motivo Montaje :</label>
													</div>
												</div>
												<div class="col-lg-9">
													<div class="form-group form-control-sm mb-1">
														<input type="text" class="form-control form-control-sm mb-1 text-uppercase" id="ot_motivo">	
													</div>
												</div>
											</div>
											<div class="row align-items-end border border-muted border-radius rounded">
												<div class="col-lg-3">
													<div class="form-group form-control-sm mb-1">
														<label for="ot_componenete_raiz" class="form-control-sm pl-0 mb-0 ">Componente Raiz :</label>
													</div>
												</div>
												<div class="col-lg-9">
													<div class="form-group form-control-sm mb-1">
														<input type="text" class="form-control form-control-sm mb-1 text-uppercase" id="ot_componente_raiz">	
													</div>
												</div>
											</div>
											<div class="row align-items-end border border-muted border-radius rounded">
												<div class="col-lg-3">
													<div class="form-group form-control-sm mb-1">
														<label for="ot_tecnico" class="form-control-sm pl-0 mb-0">TECNICO ASOCIADO :</label>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group form-control-sm mb-1">
														<select class="col-form-label form-control form-control-sm mb-1" id="ot_tecnico" name="ot_tecnico" >
														</select>
													</div>
												</div>
												<div class="col-lg-3">
													<div class="form-group form-control-sm mb-1">
														<button type="button" id="btn_horas_tecnicos" class="btn btn-secondary btn-sm form-control-sm mb-1 btn_horas_tecnicos">+ Horas por Técnico</button>
													</div>
												</div>												
											</div>
										</div>
									</div>
									<div class="row border border-muted border-radius rounded mb-5">
										<div class="col-lg-12">
											<div class="container-fluid caja">
												<div class="row w-100 p-0 m-0">
											       	<div class="col-lg-12">
											       		<div class="table-responsive" id="div_tabla_horas_tecnicos">

														</div>
										            </div>
										        </div>
										    </div>  
										</div>
									</div>
									<div class="row border border-muted border-radius rounded mb-2">
										<div class="col-lg-12">
											<div class="row align-items-end border border-muted border-radius rounded">
												<div class="col-lg-12">
													<div class="form-group form-control-sm mb-1" id="div_ot_ca">
														<!-- PHP MostrarDiv Cierre Administrativo -->
													</div> 
												</div>
											</div>
											<div class="row align-items-end border border-muted border-radius rounded">
												<div class="col-lg-6 border border-muted border-radius rounded">
													<div class="form-group form-control-sm mb-1" id="div_ot_estadoactual">
														<!-- PHP MostrarDiv Estado Actual OT -->
													</div>
												</div>
												<div class="col-lg-6 border border-muted border-radius rounded">
													<div class="row align-items-end">
														<div class="col-lg-5">
															<div class="form-group form-control-sm mb-1">
																<label for="ot_semana_cierre" class="form-control-sm pl-0 mb-0">SEMANA CIERRE:</label>
															</div>
														</div>
														<div class="col-lg-7">
															<div class="form-group form-control-sm mb-1">
																<select class="col-form-label form-control form-control-sm mb-1" id="ot_semana_cierre" name="ot_semana_cierre" >
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row align-items-end border border-muted border-radius rounded">
												<div class="form-group col-lg-12 mb-1">
    												<label for="ot_obs_aom" class="form-control-sm pl-0 mb-0">OBSERVACIONES DE CIERRE ADMINISTRATIVO</label>
													<button type="button" id="btnLogOT" class="btn btn-info btn-sm">Log..</button>
    												<textarea class="form-control form-control-sm mb-1 text-uppercase" id="ot_obs_aom2" rows="3" placeholder="escribe algo aqui..."></textarea>
												</div>
											</div>
											<div class="row align-items-end border border-muted border-radius rounded">
												<div class="col-lg-4">
													<div class="form-group form-control-sm mb-1">
														<label for="ot_estado" class="form-control-sm pl-0 mb-0">GUARDAR OT COMO :</label>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group form-control-sm mb-1">
														<select class="col-form-label form-control form-control-sm mb-1" id="ot_estado" name="ot_estado" >
														</select>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group form-control-sm mb-1" id="div_btn_guardar_ot">
														<!-- MostrarDiv -->
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					
					</form>
				</div>

				<!-- Modal para CRUD HORAS TECNICOS-->
				<div class="row modal fade" id="modal_crud_horas_tecnicos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog" role="document">
			        	<div class="modal-content">
			           
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
					  		<form id="form_horas_tecnicos">    
			      		    	<div class="modal-body">
			      		        	<div class="row">
			      		            	<div class="col-lg-12">
				  		                	<div class="form-group">
						                  		<label for="tecnico_nombres" class="col-form-label form-control-sm">TECNICO</label>
						                   		<select class="form-control form-control-sm" id="tecnico_nombres">
												</select>
				  		               		</div>
			      		            	</div>
									</div>
									<div class="row">
			      		            	<div class="col-lg-12">
				  		                	<div class="form-group">
						                		<label for="hora_inicio" class="col-form-label form-control-sm">HORA INICIO</label>
												<input type="datetime-local" class="form-control form-control-sm" id="hora_inicio">
											</div> 
			      		            	</div>    
			      		        	</div>
			      		        	<div class="row"> 
			      		            	<div class="col-lg-12">
				  		                	<div class="form-group">
						                   		<label for="hora_fin" class="col-form-label form-control-sm">HORA FIN</label>
												<input type="datetime-local" class="form-control form-control-sm" id="hora_fin">
											</div>               
						           		</div>
									</div>  
								</div>
			      		    	<div class="modal-footer">
			      		        	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
			      		        	<button type="submit" id="btn_guardar_horas_tecnicos" class="btn btn-dark btn-sm">Guardar</button>
			      		    	</div>
			      			</form>    
			        	
						</div>
			    	</div>
				</div>  			

				<!--Modal para CRUD VER OTs-->
				<div class="row modal fade" id="modal_crud_ver_ot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
						<div class="modal-content ui-widget-content" id="modal-resizable_ver_ot">
							<div class="modal-header dragable_touch">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body scrollVClass">
								<form id="form_modal_ver_ot">
									<div class="container-fluid ml-0 mr-0 mb-0">
										<form id="form_ver_ot" enctype="multipart/form-data" action="" method="post">    
											<div class="form-group" id="div_ver_ot">
												<!-- PHP Logico InfoBusOTs -->
											</div>
										</form>
									</div>			
								</form>
							</div>
							<div class="modal-footer">
					  			<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
  							</div>
						</div>
					</div>
				</div>  			

				<!-- Modal para CRUD LOG OTCorretivas-->
				<div class="row modal fade" id="modalCRUDLogOT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="formModalLogOT" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_logOT">
												<!-- JS Cierre Administrativo -->
											</div>
			      		            	</div>
									</div>  
								</div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
								</div>
							</form>
			        	</div>
			    	</div>
				</div>
				<!-- Termino de CRUD LOG PEDIDOS --> 

			</div>

			<!------------------------------------------------------------------------------->
			<!-- TAB CIERRE SEMANAL --------------------------------------------------------->
			<!------------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-cierre_semanal" role="tabpanel" aria-labelledby="nav-cierre_semanal-tab">
				<form id="form_seleccion_cierre_semanal" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-1 col-sm-12">
						<div class="col-lg-1">
				        	<div class="form-group">
					        	<label for="select_anios_cierre_semanal" class="col-form-label form-control-sm">AÑO</label>
								<select class="form-control form-control-sm" id="select_anios_cierre_semanal" name="select_anios_cierre_semanal">
					    			<option disabled selected>año</option>	
						    	</select>
					       	</div>
			        	</div>
						<div class="col-lg-2">             	
							<div class="form-group" id="div_btn_cierre_semanal">
								<!-- Accessos BotonesFormulario -->
						   	</div>
			        	</div>   
					</div>
				</form>
			   	
				<div class="container-fluid caja w-auto">
		    	   	<div class="row p-1">
		        	   	<div class="col-auto m-0">
		            		<div class="table-responsive" id="div_tabla_cierre_semanal">        
		                		<!-- Accesos CracionTabla -->               
		            		</div>
		           		</div>
		       		</div>  
		   		</div>   
	  		
				<!--Modal para CRUD-->
				<div class="row modal fade" id="modal_crud_cierre_semanal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog " role="document">
			        	<div class="modal-content">
			           
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
					  		<form id="form_cierre_semanal" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
			      		        	<div class="row align-items-end">
			      		            	<div class="col-lg-9">
				  		                	<div class="form-group">
						                  		<label for="select_semana_cerrar" class="col-form-label form-control-sm">Semana a Cerrar:</label>
												<select class="form-control form-control-sm" id="select_semana_cerrar" name="select_semana_cerrar">
					    							<option disabled selected>año-semana</option>
						    					</select>
				  		               		</div>
			      		            	</div>
			      		            	<div class="col-lg-3">
				  		                	<div class="form-group">
												<button type="submit" id="btn_cerrar_semana" class="btn btn-secondary btn-sm btn_cerrar_semana">Cerrar</button>
				  		               		</div>
			      		            	</div>
			      		            </div>    
			      		        </div>
			      		    	<div class="modal-footer" id="div_resultado_semana_cerrar">
			      		    	</div>
			      			</form>
						
			        	</div>
			    	</div>
				</div>
			</div>

			<!------------------------------------------------------------------------------->
			<!-- TAB NOVEDADES -------------------------------------------------------------->
			<!------------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-novedades" role="tabpanel" aria-labelledby="nav-novedades">
				<form id="form_seleccion_novedades" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-1 col-sm-12">
						<div class="col-lg-1">
			      			<div class="form-group">
								<label for="fecha_inicio_novedades" class="col-form-label form-control-sm">F.INICIO</label>
								<input type="date" class="form-control form-control-sm" id="fecha_inicio_novedades" placeholder="dd/mm/aaaa" >
			      			</div>
			    		</div>
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="fecha_termino_novedades" class="col-form-label form-control-sm">F.TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="fecha_termino_novedades" placeholder="dd/mm/aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-4">
							<div class="form-group" id="div_btn_seleccion_novedades">
								
							</div>
				    	</div>
					</div>
				</form>
			   	
				<div class="container-fluid caja w-auto">
		    	   	<div class="row p-1">
		        	   	<div class="col-auto m-0">
		            		<div class="table-responsive" id="div_tabla_novedades">        
		                		<!-- Accesos CracionTabla -->               
		            		</div>
		           		</div>
		       		</div>  
		   		</div>   
	  		
				<!--Modal para CRUD NOVEDAD REGULAR------------------------------------------>
 				<div class="row modal fade" id="modal_crud_novedad_regular" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog modal-lg" role="document">
				        <div class="modal-content">

						    <div class="modal-header">
				                <h5 class="modal-title" id="exampleModalLabel"></h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
				                </button>
				            </div>

						  	<form id="form_novedad_regular" enctype="multipart/form-data" action="" method="post">    
				      		    <div class="modal-body">
								  	<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row">
												<div class="col-lg-2">
			      						    		<div class="form-group form-control-sm">
			      						    			<label for="nreg_operacion" class="col-form-label form-control-sm">OPERACION:</label>
			      						    		</div>
												</div>
												<div class="col-lg-4">
			      						    		<div class="form-group form-control-sm">
													  	<select class="form-control form-control-sm" id="nreg_operacion"></select>	
			      						    		</div>
												</div>
												<div class="col-lg-2">
			      						    		<div class="form-group form-control-sm">
			      						    			<label for="fav_chl_codigo" class="col-form-label form-control-sm">BUS:</label>
			      						    		</div>
												</div>
												<div class="col-lg-4">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="nreg_bus"></select>
			      						    		</div>
												</div>
											</div>
			      						</div>
									</div>
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row">
												<div class="col-lg-2">
			      						    		<div class="form-group form-control-sm">
			      						    			<label for="nreg_descripcion" class="col-form-label form-control-sm">DESCRIPCION:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
													<div class="form-group shadow-textarea">
						      				            <textarea class="form-control z-depth-1 text-uppercase" id="nreg_descripcion" rows="2" placeholder="escribe algo aqui..." maxlength="250"></textarea>
						      				        </div>
												</div>
											</div>
			      						</div>
									</div>
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row">
												<div class="col-lg-2">
			      						    		<div class="form-group form-control-sm">
			      						    			<label for="nreg_componente" class="col-form-label form-control-sm">COMPONENTE:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="nreg_componente"></select>
			      						    		</div>
												</div>
											</div>
			      						</div>
									</div>
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row">
												<div class="col-lg-2">
			      						    		<div class="form-group form-control-sm">
			      						    			<label for="nreg_posicion" class="col-form-label form-control-sm">POSICION:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="nreg_posicion"></select>
			      						    		</div>
												</div>
											</div>
			      						</div>
									</div>
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row">
												<div class="col-lg-2">
			      						    		<div class="form-group form-control-sm">
			      						    			<label for="nreg_falla" class="col-form-label form-control-sm">FALLA:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="nreg_falla"></select>
			      						    		</div>
												</div>
											</div>
			      						</div>
									</div>
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row">
												<div class="col-lg-2">
			      						    		<div class="form-group form-control-sm">
			      						    			<label for="nreg_accion" class="col-form-label form-control-sm">ACCION:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="nreg_accion"></select>
			      						    		</div>
												</div>
											</div>
			      						</div>
									</div>
				      		    </div>
				      		    <div class="modal-footer">
				      		        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
				      		        <button type="submit" id="btn_registrar_novedad_regular" class="btn btn-dark btn-sm btn_registrar_novedad_regular">Registrar</button>
				      		    </div>
				      		</form>    

						</div>
				    </div>
				</div>  			

				<!--Modal para CRUD CODIFICAR NOVEDAD OPERACION------------------------------>
				<div class="row modal fade" id="modal_crud_codificar_novedad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog modal-lg" role="document">
				        <div class="modal-content">

						    <div class="modal-header">
				                <h5 class="modal-title" id="exampleModalLabel"></h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
				                </button>
				            </div>

						  	<form id="form_codificar_novedad" enctype="multipart/form-data" action="" method="post">    
				      		    <div class="modal-body">
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row">
												<div class="col-lg-2">
			      						    		<div class="form-group form-control-sm">
			      						    			<label for="nope_componente" class="col-form-label form-control-sm">COMPONENTE:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="nope_componente"></select>
			      						    		</div>
												</div>
											</div>
			      						</div>
									</div>
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row">
												<div class="col-lg-2">
			      						    		<div class="form-group form-control-sm">
			      						    			<label for="nope_posicion" class="col-form-label form-control-sm">POSICION:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="nope_posicion"></select>
			      						    		</div>
												</div>
											</div>
			      						</div>
									</div>
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row">
												<div class="col-lg-2">
			      						    		<div class="form-group form-control-sm">
			      						    			<label for="nope_falla" class="col-form-label form-control-sm">FALLA:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="nope_falla"></select>
			      						    		</div>
												</div>
											</div>
			      						</div>
									</div>
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row">
												<div class="col-lg-2">
			      						    		<div class="form-group form-control-sm">
			      						    			<label for="nope_accion" class="col-form-label form-control-sm">ACCION:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="nope_accion"></select>
			      						    		</div>
												</div>
											</div>
			      						</div>
									</div>
				      		    </div>
				      		    <div class="modal-footer">
				      		        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
				      		        <button type="submit" id="btn_codificar_novedad" class="btn btn-dark btn-sm btn_codificar_novedad">Codificar</button>
				      		    </div>
				      		</form>    

						</div>
				    </div>
				</div>  			

			</div>

			<!------------------------------------------------------------------------------->
			<!-- TAB AJUSTE DE ORDEN DE TRABAJO---------------------------------------------->
			<!------------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-ajustes_ot" role="tabpanel" aria-labelledby="nav-ajustes_ot">
				<h5 class="pt-3 pl-3">Variables</h5>
				<nav>
	 				<div class="nav nav-tabs" id="nav-tab-ajustes_ot" role="tablist">
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent-ajustes_ot">
					<!------------------------------------------------------------------------------->
					<!-- TAB AJUSTE VARIABLE DE USUARIO DE CHECK LIST DE FLOTA ---------------------->
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade show active" id="nav-ajustes_ot_usuario" role="tabpanel" aria-labelledby="nav-ajustes_ot_usuario-tab">
						<section class="container-fluid py-3">
							<button id="btn_nuevo_tc_ot_usuario" type="button" class="btn btn-secondary btn-sm btn_nuevo_tc_ot_usuario" data-toggle="modal">+ Nuevo</button>  
						</section>
						<div class="row p-3">
							<div class="col-auto m-0">
								<div class="table-responsive" id="div_tabla_tc_ot_usuario">
								</div>
							</div>
						</div>
						<!--Modal para CRUD-->
						<div class="row modal fade" id="modal_crud_tc_ot_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel"></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form id="form_tc_ot_usuario">
						  				<div class="modal-body">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
												  		<label for="tc_ot_id_usuario" class="col-form-label form-control-sm">ID</label>
												   		<input type="text" readonly class="form-control form-control-sm" id="tc_ot_id_usuario">
												 	</div>
											 	</div>
											 	<div class="col-lg-6">
											  		<div class="form-group">
														<label for="ot_cat1_usuario" class="col-form-label form-control-sm">CATEGORIA 1</label>
												   		<input type="text" class="form-control form-control-sm text-uppercase" id="ot_cat1_usuario" maxlength="45">
													</div> 
											 	</div>    
											</div>
							  				<div class="row"> 
												<div class="col-lg-6">
											  		<div class="form-group">
														<label for="ot_cat2_usuario" class="col-form-label form-control-sm">CATEGORIA 2</label>
														<input type="text" class="form-control form-control-sm text-uppercase" id="ot_cat2_usuario" maxlength="45">
													</div> 
								  				</div>
											</div>
											<div class="row"> 
								  				<div class="col-lg-12">
											  		<div class="form-group">
														<label for="ot_cat3_usuario" class="col-form-label form-control-sm">CATEGORIA 3</label>
												  		<textarea class="form-control z-depth-1 text-uppercase" id="ot_cat3_usuario" rows="7" placeholder="escribe algo aqui..." maxlength="250"></textarea>
													</div>               
								   				</div>
							  				</div>
										</div>
						  				<div class="modal-footer">
							  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
							  				<button type="submit" id="btn_guardar_tc_ot_usuario" class="btn btn-dark btn-sm btn_guardar_tc_ot_usuario">Guardar</button>
						  				</div>
									</form>    
								</div>
							</div>
						</div>  
					</div>
					<!------------------------------------------------------------------------------->
					<!-- TAB AJUSTE VARIABLE DE SISTEMA DE ORDEN DE TRABAJO ------------------------->
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade" id="nav-ajustes_ot_sistema" role="tabpanel" aria-labelledby="nav-ajustes_ot_sistema-tab">
						<section class="container-fluid py-3">
							<button id="btn_nuevo_tc_ot_sistema" type="button" class="btn btn-secondary btn-sm btn_nuevo_tc_ot_sistema" data-toggle="modal">+ Nuevo</button>  
						</section>
						<div class="row p-3">
							<div class="col-auto m-0">
								<div class="table-responsive" id="div_tabla_tc_ot_sistema">
								</div>
							</div>
						</div>
						<div class="row modal fade" id="modal_crud_tc_ot_sistema" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel"></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form id="form_tc_ot_sistema">
						  				<div class="modal-body">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
												  		<label for="tc_ot_id_sistema" class="col-form-label form-control-sm">ID</label>
												   		<input type="text" readonly class="form-control form-control-sm" id="tc_ot_id_sistema">
												 	</div>
											 	</div>
											 	<div class="col-lg-6">
											  		<div class="form-group">
														<label for="chl_cat1_sistema" class="col-form-label form-control-sm">CATEGORIA 1</label>
												   		<input type="text" class="form-control form-control-sm text-uppercase" id="chl_cat1_sistema" maxlength="45">
													</div> 
											 	</div>    
											</div>
							  				<div class="row"> 
												<div class="col-lg-6">
											  		<div class="form-group">
														<label for="chl_cat2_sistema" class="col-form-label form-control-sm">CATEGORIA 2</label>
														<input type="text" class="form-control form-control-sm text-uppercase" id="chl_cat2_sistema" maxlength="45">
													</div> 
								  				</div>
											</div>
											<div class="row"> 
								  				<div class="col-lg-12">
											  		<div class="form-group">
														<label for="chl_cat3_sistema" class="col-form-label form-control-sm">CATEGORIA 3</label>
												  		<textarea class="form-control z-depth-1 text-uppercase" id="chl_cat3_sistema" rows="7" placeholder="escribe algo aqui..." maxlength="250"></textarea>
													</div>               
								   				</div>
							  				</div>
										</div>
						  				<div class="modal-footer">
							  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
							  				<button type="submit" id="btn_guardar_tc_ot_sistema" class="btn btn-dark btn-sm btn_guardar_tc_ot_sistema">Guardar</button>
						  				</div>
									</form>    
								</div>
							</div>
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