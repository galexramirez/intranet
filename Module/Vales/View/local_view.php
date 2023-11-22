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
									<a class="nav-link-alert dropdown-toggle" href="#" id="alertsDropdown_vales" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-bell fa-fw"></i>
                		        		<span class="badge badge-danger badge-counter" id="vales_alerta"></span>
									</a>
                		            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown_vales" id="div_alertsDropdown_vales">
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
			<div class="nav nav-tabs" id="nav-tab-Vales" role="tablist">
				<!-- PHP Accesos Creacion Tabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">

			<!-- TAB VALES -->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<form id="form_seleccion_vales" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
			      			<div class="form-group">
								<label for="FechaInicioVales" class="col-form-label form-control-sm">F.INICIO</label>
								<input type="date" class="form-control form-control-sm" id="FechaInicioVales" placeholder="dd/mm/aaaa" >
			      			</div>
			    		</div>
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="FechaTermino1Vales" class="col-form-label form-control-sm">F.TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="FechaTerminoVales" placeholder="dd/mm/aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-2">
							<div class="form-group" id="div_btn_seleccion_vales">
								<!-- BotonesFormulario -->
							</div>
				    	</div> 
					</div>
				</form>
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_vales">
							<!-- CreacionTabla -->
						</div>
    				</div>
				</div>

				<!-- MODAL CRUD VER INFORMACION DE VALES -->
				<div class="row modal fade" id="modal_crud_ver_vales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
			        	<div class="modal-content  ui-widget-content" id="modal-resizable_ver_vales">
					    	<div class="modal-header  dragable_touch">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_ver_vales" enctype="multipart/form-data" action="" method="post">    
								<div class="modal-body">
									<div class="form-group">
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-4">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">N° VALE :</label>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="icod_vale" disabled>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">N° OT :</label>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="iva_ot" disabled>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">BUS :</label>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="iva_bus" disabled>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-2">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">DESC. ACTIVIDAD :</label>
														</div>
													</div>
													<div class="col-lg-10">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="iva_descrip" disabled>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">ASOCIADO :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="iva_asociado" disabled>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">RESP.ASOCIADO :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="iva_responsable" disabled>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">REG.REPUESTO :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="iva_garantia" disabled>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">ESTADO :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="iva_estado" disabled>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">CGM RESP. :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="iva_genera" disabled>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">FECHA GENERA :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="datetime-local" class="form-control form-control-sm mb-1" id="iva_date_genera" disabled>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">CIERRE ADM. :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="iva_cierre_adm" disabled>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">FEC. CIERRE ADM.:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="datetime-local" class="form-control form-control-sm mb-1" id="iva_date_cierre_adm" disabled>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12">
												<div class="container-fluid caja">
													<div class="row w-100 p-0 m-0">
												       	<div class="col-lg-12">
												       		<div class="table-responsive" id="div_tabla_ver_detalle_repuestos">        
												           		<!-- PHP Accesos CreacionTabla -->
												            </div>
												        </div>
												    </div>  
												</div>
											</div>
										</div>
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-12">
												<div class="row">
													<div class="form-group col-lg-6 mb-1">
    													<label for="iva_obs_cgm" class="form-control-sm pl-0 mb-0">OBSERVACIONES DE CGM :</label>
														<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_iva_obs_cgm">
															<!-- JS Cierre Administrativo -->
														</div>
													</div>
													<div class="form-group col-lg-6 mb-1">
    													<label for="iva_obs_aom" class="form-control-sm pl-0 mb-0">OBSERVACIONES DE AOM :</label>
														<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_iva_obs_aom">
															<!-- JS Cierre Administrativo -->
														</div>
													</div>
												</div>
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
				<!-- FIN MODAL CRUD VER INFORMACION DE VALES -->

			</div>
			<!-- FIN TAB VALES -->

			<!-- TAB PROCESAR Vales -->
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<form id="form_seleccion_procesar_vales" class="row col-sm-12 container-fluid" onsubmit="return false;">	    
					<div class="row align-items-end pb-0 col-sm-12 mb-1">
						<div class="col-lg-2">
							<div class="form-group mb-0">
								<div class="input-group mt-3">
							  		<div class="input-group-prepend">
       									<span class="input-group-text form-control-sm" id="basic-addon1">Vales N° P-</span>
        								<input type="text" class="form-control form-control-sm" id="cod_vale" placeholder="Código Vales" aria-label="cod_vale" aria-describedby="basic-addon1">
							  		</div>
      							</div>
							</div>
			        	</div>

						<div class="col-lg-2">             	
							<div class="form-group mb-0" id="div_btn_seleccion_procesar_vales">
								
							</div>
			       		</div> 

					</div>
				</form>

				<div class="container-fluid ml-0 mr-0 mb-0">
					<form id="form_procesar_vales" enctype="multipart/form-data" action="" method="post" onsubmit="return false;">    
			      		<div class="form-group">
						<div class="col-lg-6 mx-1 border border-muted border-radius rounded">
							<div class="row d-flex justify-content-araound">
								<div class="col-lg-4">
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group form-control-sm mb-1">
												<label for="tcod_vale" class="col-form-label form-control-sm mb-1">N° VALE :</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<input type="text" readonly class="form-control form-control-sm mb-1" id="tcod_vale">
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group form-control-sm mb-1">
												<label for="va_ot" class="col-form-label form-control-sm mb-1">N° OT :</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<input tabindex="1" type="text" class="form-control form-control-sm mb-1" id="va_ot">
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group form-control-sm mb-1">
												<label for="va_bus" class="col-form-label form-control-sm mb-1">BUS :</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<input type="text" readonly class="form-control form-control-sm mb-1" id="va_bus">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row d-flex justify-content-araound">
								<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group form-control-sm mb-1">
												<label for="va_descrip" class="col-form-label form-control-sm mb-1">DESC. ACTIVIDAD :</label>
											</div>
										</div>
										<div class="col-lg-9">
											<div class="form-group form-control-sm mb-1">
												<input type="text" readonly class="form-control form-control-sm mb-1" id="va_descrip">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row d-flex justify-content-araound">
								<div class="col-lg-6">
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group form-control-sm mb-1">
												<label for="" class="col-form-label form-control-sm mb-1">ASOCIADO :</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<select tabindex="2" class="form-control form-control-sm mb-1" id="va_asociado">
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group form-control-sm mb-1">
												<label for="" class="col-form-label form-control-sm mb-1">RESP.ASOCIADO :</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<select tabindex="3" class="form-control form-control-sm mb-1" id="va_responsable">
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group form-control-sm mb-1">
												<label for="" class="col-form-label form-control-sm mb-1">REG.REPUESTO :</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<select tabindex="4" class="form-control form-control-sm mb-1" id="va_garantia">
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group form-control-sm mb-1">
												<label for="" class="col-form-label form-control-sm mb-1">ESTADO :</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<input type="text" readonly class="form-control form-control-sm mb-1" id="tva_estado">
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group form-control-sm mb-1">
												<label for="" class="col-form-label form-control-sm mb-1">CGM RESP. :</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<select tabindex="5" class="form-control form-control-sm mb-1" id="va_genera">
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group form-control-sm mb-1">
												<label for="" class="col-form-label form-control-sm mb-1">FECHA GENERA :</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<input tabindex="6" type="datetime-local" class="form-control form-control-sm mb-1" id="va_date_genera" min="2000-01-01T00:00" max="2099-12-31T23:59">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group form-control-sm mb-1">
												<label for="" class="col-form-label form-control-sm mb-1">CIERRE ADM. :</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<input type="text" readonly class="form-control form-control-sm mb-1" id="va_cierre_adm">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group form-control-sm mb-1">
												<label for="" class="col-form-label form-control-sm mb-1">FEC. CIERRE ADM.:</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<input type="datetime-local" readonly class="form-control form-control-sm mb-1" id="va_date_cierre_adm">
											</div>
										</div>
									</div>
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row align-items-end d-flex">
												<div class="btn-toolbar ml-auto p-2" role="toolbar" aria-label="Toolbbutton groups">
													<div class="btn-group" role="group" aria-label="Four group" id="div_btn_repuesto_vale">
														<button tabindex="10" type="button" id="btn_repuestos_vale" class="btn btn-secondary btn-sm btn_repuestos_vale">+ Repuestos</button>
													</div>
												</div>
											</div>
										</div>
									</div>									
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="container-fluid caja">
										<div class="row w-100 p-0 m-0">
									       	<div class="col-lg-12">
									       		<div class="table-responsive" id="div_tablaDetalleRepuestos">        
									           		<!-- PHP Accesos CreacionTabla -->
									            </div>
									        </div>
									    </div>  
									</div>
								</div>
							</div>
							<div class="row d-flex justify-content-araound">
								<div class="col-lg-12">
									<div class="row">
										<div class="form-group col-lg-3 mb-1 border border-muted border-radius rounded">
    										<label for="va_obs_cgm" class="form-control-sm pl-0 mb-0">OBSERVACIONES DE CGM :</label>
    										<textarea class="form-control form-control-sm mb-1 text-uppercase" id="va_obs_cgm" rows="3" placeholder="escribe algo aqui..."></textarea>
										</div>
										<div class="form-group col-lg-6 mb-1 border border-muted border-radius rounded">
    										<label for="va_obs_aom" class="form-control-sm pl-0 mb-0">OBSERVACIONES DE AOM :</label>
											<div class="form-control-sm mb-1 overflow-auto h-50 border border-muted border-radius rounded" id="div_va_obs_aom">
												<!-- JS Cierre Administrativo -->
											</div>
    										<textarea class="form-control form-control-sm mb-1 text-uppercase" id="va_obs_aom" rows="1" placeholder="escribe algo aqui..."></textarea>
										</div>
										<div class="form-group col-lg-3 mb-1 border border-muted border-radius rounded">
    										<label for="va_estado" class="form-control-sm pl-0 mb-0">GUARDAR COMO :</label>
											<select class="col-form-label form-control form-control-sm mb-1" id="va_estado" name="va_estado" >
											</select>
										</div>
									</div>
									<div class="row align-items-end d-flex">
										<div class="btn-toolbar ml-auto p-2" role="toolbar" aria-label="Toolbbutton groups">
											<div class="btn-group" role="group" aria-label="Four group" id="div_btn_guardar_vale">
												<button tabindex="8" type="button" id="btn_cancelar_vale" class="btn btn-light btn-sm btn_cancelar_vale mr-1">Cancelar</button>
                           			        	<button type="button" id="btn_guardar_vale" class="btn btn-secondary btn-sm btn_guardar_vale mr-1">Guardar</button>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>	
						</div>
					</form>
				</div>

				<!--Modal para CRUD DETALLE REPUESTOS-->
				<div class="row modal fade" id="modal_crud_detalle_repuestos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_detalle_repuestos" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body ui-front">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group ui-widget">
												<label for="buscar_repuesto" class="col-form-label form-control-sm">BUSCAR</label>
												<div class="row input-group mb-3">
													<div class="col-lg-11 input-group-append">
														<input type="text" tabindex="11" class="form-control text-uppercase form-control-sm" id="buscar_repuesto" placeholder="REPUESTO" aria-label="REPUESTO" aria-describedby="btn_buscar_repuesto">
													</div>
													<div class="col-lg-1 input-group-append">
    													<button tabindex="12" class="btn btn-outline-secondary btn-sm btn_buscar_repuesto" type="button" id="btn_buscar_repuesto"><i class="bi bi-search"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg></i></button>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
								        		<label for="rv_repuesto" class="col-form-label form-control-sm">CODIGO</label>
												<input type="text" readonly class="form-control text-uppercase form-control-sm" id="rv_repuesto">
				  				        	</div> 
			      		            	</div>
										  <div class="col-lg-12">
											<div class="form-group">
								        		<label for="rv_desc" class="col-form-label form-control-sm">DESCRIPCION</label>
												<input type="text" readonly class="form-control text-uppercase form-control-sm" id="rv_desc">
				  				        	</div> 
			      		            	</div>
									</div>  
									<div class="row align-items-end">
										<div class="col-lg-6">
											<div class="form-group">
								    			<label for="rv_unidad" class="col-form-label form-control-sm">UNIDAD</label>
												<input type="text" readonly class="form-control form-control-sm" id="rv_unidad">
				  				    		</div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-3">
											<div class="form-group">
								    			<label for="rv_id" class="col-form-label form-control-sm">ITEM</label>
												<input type="number" tabindex="13" class="form-control form-control-sm" id="rv_id">
				  				    		</div> 
			      		            	</div>
										<div class="col-lg-6">
											<div class="form-group">
								    			<label for="rv_nroserie" class="col-form-label form-control-sm">NRO. SERIE</label>
												<input type="text" tabindex="14" class="form-control form-control-sm" id="rv_nroserie">
				  				    		</div> 
			      		            	</div>
										<div class="col-lg-3">
											<div class="form-group">
								    			<label for="rv_cantidad" class="col-form-label form-control-sm">CANTIDAD</label>
												<input type="text" tabindex="15" class="form-control form-control-sm" id="rv_cantidad">
				  				    		</div> 
			      		            	</div>
									</div>
								</div>
			      		    	<div class="modal-footer">
								  	<button type="button" tabindex="16" id="btn_cancelar_detalle_repuesto" class="btn btn-light btn-sm btn_cancelar_detalle_repuesto" data-dismiss="modal">Cancelar</button>
			      					<button type="submit" tabindex="17" id="btn_guardar_detalle_repuestos" class="btn btn-dark btn-sm btn_guardar_detalle_repuestos">Agregar</button>
								</div>
							</form>
			        	</div>
			    	</div>
				</div>

				<!-- MODAL CRUD VER INFORMACION DE VER PROCESAR VALES -->
				<div class="row modal fade" id="modal_crud_ver_procesar_vales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
			        	<div class="modal-content  ui-widget-content" id="modal-resizable_ver_procesar_vales">
					    	<div class="modal-header  dragable_touch">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_ver_procesar_vales" enctype="multipart/form-data" action="" method="post">    
								<div class="modal-body">
									<div class="form-group">
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-4">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">N° VALE :</label>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="ipcod_vale" disabled>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">N° OT :</label>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="ipva_ot" disabled>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">BUS :</label>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="ipva_bus" disabled>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-2">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">DESC. ACTIVIDAD :</label>
														</div>
													</div>
													<div class="col-lg-10">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="ipva_descrip" disabled>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">ASOCIADO :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="ipva_asociado" disabled>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">RESP.ASOCIADO :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="ipva_responsable" disabled>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">REG.REPUESTO :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="ipva_garantia" disabled>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">ESTADO :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="ipva_estado" disabled>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">CGM RESP. :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="ipva_genera" disabled>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">FECHA GENERA :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="datetime-local" class="form-control form-control-sm mb-1" id="ipva_date_genera" disabled>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">CIERRE ADM. :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1" id="ipva_cierre_adm" disabled>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">FEC. CIERRE ADM.:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="datetime-local" class="form-control form-control-sm mb-1" id="ipva_date_cierre_adm" disabled>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12">
												<div class="container-fluid caja">
													<div class="row w-100 p-0 m-0">
												       	<div class="col-lg-12">
												       		<div class="table-responsive" id="div_tabla_ver_procesar_detalle_repuestos">        
												           		<!-- PHP Accesos CreacionTabla -->
												            </div>
												        </div>
												    </div>  
												</div>
											</div>
										</div>
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-12">
												<div class="row">
													<div class="form-group col-lg-6 mb-1">
    													<label for="ipva_obs_cgm" class="form-control-sm pl-0 mb-0">OBSERVACIONES DE CGM :</label>
														<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_ipva_obs_cgm">
															<!-- JS Cierre Administrativo -->
														</div>
													</div>
													<div class="form-group col-lg-6 mb-1">
    													<label for="ipva_obs_aom" class="form-control-sm pl-0 mb-0">OBSERVACIONES DE AOM :</label>
														<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_ipva_obs_aom">
															<!-- JS Cierre Administrativo -->
														</div>
													</div>
												</div>
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
				<!-- FIN MODAL CRUD VER INFORMACION DE VER PROCESAR VALES -->

			</div>

			<!-- TAB REPUESTOS -->
			<div class="tab-pane fade" id="nav-repuestos" role="tabpanel" aria-labelledby="nav-repuestos-tab">
				<section class="container-fluid py-3">
					<button id="btnNuevoRepuestos" type="button" class="btn btn-secondary btn-sm" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaRepuestos">
							<!-- PHP Creacion de Tablas -->
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDRepuestos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="formRepuestos">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group">
										  		<label for="cod_rep" class="col-form-label form-control-sm">CODIGO</label>
										   		<input type="text" class="form-control form-control-sm" id="cod_rep">
										 	</div>
									 	</div>
									</div>
									<div class="row">
									 	<div class="col-lg-12">
									  		<div class="form-group">
												<label for="rep_desc" class="col-form-label form-control-sm">DESCRIPCION</label>
										   		<input type="text" class="form-control form-control-sm" id="rep_desc">
											</div> 
									 	</div>    
									</div>
					  				<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="rep_unida" class="col-form-label form-control-sm">UNIDAD</label>
												<select class="form-control form-control-sm" id="rep_unida">
												</select>
											</div> 
						  				</div>
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="rep_precio" class="col-form-label form-control-sm">PRECIO</label>
												<input type="text" class="form-control form-control-sm" id="rep_precio">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="rep_asociado" class="col-form-label form-control-sm">ASOCIADO</label>
												<select class="form-control form-control-sm" id="rep_asociado">
												</select>
											</div> 
						  				</div>
									</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light btn*sm" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarRepuestos" class="btn btn-dark btn-sm">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			

			</div>

			<!-- TAB REPORTE -->
			<div class="tab-pane fade" id="nav-reporte" role="tabpanel" aria-labelledby="nav-reporte-tab">
				<form id="formSeleccionReporte" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
			      			<div class="form-group">
								<label for="FechaInicioReporte" class="col-form-label form-control-sm">F.INICIO</label>
								<input type="date" class="form-control form-control-sm" id="FechaInicioReporte" placeholder="dd/mm/aaaa" >
			      			</div>
			    		</div>
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="FechaTerminoReporte" class="col-form-label form-control-sm">F.TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="FechaTerminoReporte" placeholder="dd/mm/aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-2">             	
							<div class="form-group">
								<button type="button" id="btnBuscarReporte" class="btn btn-secondary btn-sm">Buscar</button>
							</div>
				    	</div> 
					</div>
				</form>
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaReporte">
							<!-- PHP Accesos CreacionTabla -->
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