<div id="contenido" class="my-contenido-con-sidebar p-0">

	<nav class="navbar navbar-light bg-light p-0 navbar-expand topbar static-top">
		<div class="container-fluid">
			<div class="row justify-content-between w-100 align-items-center">
				<div class="col-4">
					<a class="navbar-brand text-muted" href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
 						 <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
					</svg>	
					<?= $NombreDeModuloVista ?></a>
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
			<div class="nav nav-tabs" id="nav-tab-inventario" role="tablist">
				<!-- Accesos Creacion Tabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">
			<!-- INICIO TAB MOVIMIENTOS -->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<form id="form_seleccion_movimiento" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-2 col-sm-12">
						<div class="col-lg-1">
			      			<div class="form-group">
								<label for="fecha_inicio_movimiento" class="col-form-label form-control-sm">F.INICIO</label>
								<input type="date" class="form-control form-control-sm" id="fecha_inicio_movimiento" placeholder="dd/mm/aaaa" >
			      			</div>
			    		</div>
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="fecha_termino_movimiento" class="col-form-label form-control-sm">F.TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="fecha_termino_movimiento" placeholder="dd/mm/aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-2">
							<div class="form-group" id="div_btn_seleccion_movimiento">
								<!-- Accesos MostrarDiv -->
							</div>
				    	</div> 
					</div>
				</form>
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_movimiento">
							<!-- Accesos CreacionTabla -->
						</div>
    				</div>
				</div>

			</div>
			<!-- FIN TAB MOVIMIENTOS --> 

			<!-- INICIO TAB PROCESAR INVENTARIO -->
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<form id="form_seleccion_procesar_inventario" class="row col-sm-12 container-fluid" onsubmit="return false;">
					<div class="row align-items-end pb-0 col-sm-6 mb-1">
						<div class="col-lg-4">
							<div class="form-group mb-0">
								<div class="input-group mt-3">
							  		<div class="input-group-prepend">
       									<span class="input-group-text form-control-sm" id="basic-addon1">Inventario N° I-</span>
        								<input type="text" tabindex="1" class="form-control form-control-sm" id="inventario_id" placeholder="Código Inventario" aria-label="cod_inventario" aria-describedby="basic-addon1">
							  		</div>
      							</div>
							</div>
			        	</div>
						<div class="col-lg-8">             	
							<div class="form-group mb-0" id="div_btn_seleccion_procesar_inventario">
								<!-- Accesos Botones Formulario -->
							</div>
			       		</div> 
					</div>
				</form>

				<div class="container-fluid ml-0 mr-0 mb-0" id="div_form_procesar_inventario">
					<!--<form id="form_procesar_inventario" enctype="multipart/form-data" action="" method="post" onsubmit="return false;">    
			    		<div class="form-group">
							<div class="row">
								<div class="col-lg-6 mx-1 border border-muted border-radius rounded">
					 				<div class="row d-flex justify-content-araound">
										<div class="col-lg-6">
											<div class="row">
												<div class="col-lg-5">
													<div class="form-group form-control-sm mb-1">
														<label for="t_inventario_id" class="col-form-label form-control-sm mb-1">N° INVENTARIO :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<input type="text" readonly class="form-control form-control-sm mb-1" id="t_inventario_id">
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="row">
												<div class="col-lg-5">
													<div class="form-group form-control-sm mb-1">
														<label for="inv_fecha_creacion" class="col-form-label form-control-sm mb-1">FECHA INVENTARIO :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<input type="date" readonly class="form-control form-control-sm mb-1" id="inv_fecha_creacion">
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
														<label for="inv_alm_descripcion" class=	"col-form-label form-control-sm mb-1">ALMACEN :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<select class="form-control form-control-sm mb-1" id="inv_alm_descripcion">

														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="row">
												<div class="col-lg-5">
													<div class="form-group form-control-sm mb-1">
														<label for="alm_movimiento" class="col-form-label form-control-sm mb-1">MOVIMIENTO :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<select class="form-control form-control-sm mb-1" id="alm_movimiento">

														</select>
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
														<label for="alm_tipo_movimiento" class="col-form-label form-control-sm mb-1">TIPO MOVIMIENTO :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<select class="form-control form-control-sm mb-1" id="alm_tipo_movimiento">

														</select>
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
														<label for="inv_nombre_responsable" class="col-form-label form-control-sm mb-1">RESPONSABLE :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<input type="text" readonly class="form-control form-control-sm mb-1" id="inv_nombre_responsable">
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="row">
												<div class="col-lg-5">
													<div class="form-group form-control-sm mb-1">
														<label for="alm_estado" class="col-form-label form-control-sm mb-1">ESTADO :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<input type="text" readonly class="form-control form-control-sm mb-1" id="alm_estado">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row align-items-end d-flex">
												<div class="btn-toolbar ml-auto p-2" id="div_btnPedidos" role="toolbar" aria-label="Toolbar with button groups">
													<div class="btn-group" role="group" aria-label="Four group">
                            					        <button type="button" id="btn_materiales_inventario" class="btn btn-secondary btn-sm mr-1 btn_materiales_inventario">+ Materiales</button>
														<button type="button" id="btn_materiales_importar" class="btn btn-secondary btn-sm mr-1 btn_materiales_importar">+ Importar</button>
                            					    </div>
												</div>
											</div>
										</div>
									</div>
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="container-fluid caja">
												<div class="row w-100 p-0 m-0">
											       	<div class="col-lg-12">
											       		<div class="table-responsive" id="div_tabla_materiales_inventario">        
											           		Accesos CreacionTabla
											            </div>
											        </div>
											    </div>  
											</div>
										</div>
									</div>
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row">
												<div class="form-group col-lg-1 mb-1">
													<button type="button" id="btn_log_inventario" class="btn btn-info btn-sm btn_log_inventario">Log...</button>
												</div>
												<div class="form-group col-lg-11 mb-1">
													<textarea class="form-control form-control-sm mb-3 text-uppercase" id="obs_inv_log" rows="1" placeholder="escribe algo aqui..."></textarea>
												</div>
											</div>
										</div>
									</div>
									<div class="row d-flex justify-content-center">
										<div class="col-lg-4">
											<div class="form-group align-items-center d-flex">
												<button type="button" id="btn_cancelar_procesar_inventario" class="btn btn-light btn-sm btn_cancelar_procesar_inventario">Cancelar</button>
												<button type="button" id="btn_guardar_inventario" class="btn btn-secondary btn-sm btn_guardar_inventario">Guardar</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>		
					</form>-->
				</div>

				<!-- Modal para CRUD LOG INVENTARIO-->
				<div class="row modal fade" id="modal_crud_log_inventario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_log_inventario" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_log_inventario">
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
			<!-- FIN TAB PROCESAR INVENTARIO --> 

			<!-- INICIO TAB ENTRADAS -->
			<div class="tab-pane fade" id="nav-entrada" role="tabpanel" aria-labelledby="nav-entrada-tab">
				<form id="form_seleccion_entrada" class="row col-sm-12 container-fluid" onsubmit="return false;">
					<div class="row align-items-end pb-0 col-sm-6 mb-1">
						<div class="col-lg-4">
							<div class="form-group mb-0">
								<div class="input-group mt-3">
							  		<div class="input-group-prepend">
       									<span class="input-group-text form-control-sm" id="basic-addon1">Entrada N° E-</span>
        								<input type="text" tabindex="1" class="form-control form-control-sm" id="entrada_id" placeholder="Código Entrada" aria-label="entrada_id" aria-describedby="basic-addon1">
							  		</div>
      							</div>
							</div>
			        	</div>
						<div class="col-lg-8">             	
							<div class="form-group mb-0" id="div_btn_seleccion_entrada">
								<!-- Accesos Botones Formulario -->
							</div>
			       		</div> 
					</div>
				</form>

				<div class="container-fluid ml-0 mr-0 mb-0" id="div_form_entrada">
					<!--
					<form id="form_entrada" enctype="multipart/form-data" action="" method="post" onsubmit="return false;">    
			    		<div class="form-group">
							<div class="row">
								<div class="col-lg-6 mx-1 border border-muted border-radius rounded">
					 				<div class="row d-flex justify-content-araound">
										<div class="col-lg-6">
											<div class="row">
												<div class="col-lg-5">
													<div class="form-group form-control-sm mb-1">
														<label for="t_entrada_id" class="col-form-label form-control-sm mb-1">N° ENTRADA :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<input type="text" readonly class="form-control form-control-sm mb-1" id="t_entrada_id">
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="row">
												<div class="col-lg-5">
													<div class="form-group form-control-sm mb-1">
														<label for="ent_fecha_creacion" class="col-form-label form-control-sm mb-1">FECHA ENTRADA :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<input type="date" readonly class="form-control form-control-sm mb-1" id="ent_fecha_creacion">
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
														<label for="ent_alm_descripcion" class=	"col-form-label form-control-sm mb-1">ALMACEN :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<select class="form-control form-control-sm mb-1" id="ent_alm_descripcion">

														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="row">
												<div class="col-lg-5">
													<div class="form-group form-control-sm mb-1">
														<label for="ent_tipo_movimiento" class="col-form-label form-control-sm mb-1">TIPO ENTRADA :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<select class="form-control form-control-sm mb-1 ent_tipo_movimiento" id="ent_tipo_movimiento">

														</select>
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
														<label for="ent_tipo_documento" class="col-form-label form-control-sm mb-1">TIPO DOCUMENTO :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<select class="form-control form-control-sm mb-1 ent_tipo_documento" id="ent_tipo_documento">

														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="row">
												<div class="col-lg-5">
													<div class="form-group form-control-sm mb-1">
														<label for="ent_nro_documento" class="col-form-label form-control-sm mb-1">NRO. DOCUMENTO :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<select class="form-control form-control-sm mb-1 ent_nro_documento" id="ent_nro_documento">

														</select>
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
														<label for="ent_nombre_responsable" class="col-form-label form-control-sm mb-1">RESPONSABLE :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<input type="text" readonly class="form-control form-control-sm mb-1" id="ent_nombre_responsable">
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="row">
												<div class="col-lg-5">
													<div class="form-group form-control-sm mb-1">
														<label for="ent_estado" class="col-form-label form-control-sm mb-1">ESTADO :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<input type="text" readonly class="form-control form-control-sm mb-1" id="ent_estado">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row align-items-end d-flex">
												<div class="btn-toolbar ml-auto p-2" role="toolbar" aria-label="Toolbar with button groups">
													<div class="btn-group" role="group" aria-label="Four group" id="div_btn_materiales_entrada">
                            					        <button type="button" id="btn_materiales_entrada" class="btn btn-secondary btn-sm mr-1 btn_materiales_entrada">+ Materiales</button>
														<button type="button" id="btn_materiales_entrada_importar" class="btn btn-secondary btn-sm mr-1 btn_materiales_entrada_importar">+ Importar</button>
                            					    </div>
												</div>
											</div>
										</div>
									</div>
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="container-fluid caja">
												<div class="row w-100 p-0 m-0">
											       	<div class="col-lg-12">
											       		<div class="table-responsive" id="div_tabla_materiales_entrada">        
											           		CreacionTabla
											            </div>
											        </div>
											    </div>  
											</div>
										</div>
									</div>
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row">
												<div class="form-group col-lg-1 mb-1">
													<button type="button" id="btn_log_entrada" class="btn btn-info btn-sm btn_log_entrada">Log...</button>
												</div>
												<div class="form-group col-lg-11 mb-1">
													<textarea class="form-control form-control-sm mb-3 text-uppercase" id="obs_ent_log" rows="1" placeholder="escribe algo aqui..."></textarea>
												</div>
											</div>
										</div>
									</div>
									<div class="row d-flex justify-content-center">
										<div class="col-lg-4">
											<div class="form-group align-items-center d-flex" id="div_btn_guardar_entrada">
												<button type="button" id="btn_cancelar_entrada" class="btn btn-light btn-sm btn_cancelar_entrada">Cancelar</button>
												<button type="button" id="btn_guardar_entrada" class="btn btn-secondary btn-sm btn_guardar_entrada">Guardar</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>		
					</form>
					-->
				</div>

				<!-- Modal para CRUD MATERIALES ENTRADA-->
				<div class="row modal fade" id="modal_crud_entrada_materiales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content ui-widget-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_entrada_materiales" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body ui-front">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group ui-widget">
								        		<label for="entm_material_id" class="col-form-label form-control-sm">BUSCAR MATERIAL</label>
												<input type="text" class="form-control text-uppercase form-control-sm" id="entm_material_id">
				  				        	</div> 
			      		            	</div>
										  <div class="col-lg-12">
											<div class="form-group">
								        		<label for="entm_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
												<input type="text" readonly class="form-control text-uppercase form-control-sm" id="entm_descripcion">
				  				        	</div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">ASIGNACION:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="entm_asignacion">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">TARJETA:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="entm_tarjeta">
														</div>
													</div>
												</div>
											</div>
									</div>
									<div class="row align-items-end">
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">MACROSISTEMA:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="entm_macrosistema">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">CONDICION:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="entm_condicion">
														</div>
													</div>
												</div>
											</div>
									</div>
									<div class="row align-items-end">
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">SISTEMA:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="entm_sistema">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">FLOTA:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="entm_flota">
														</div>
													</div>
												</div>
											</div>
									</div>
									<div class="row align-items-end">
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm">
															<label for="" class="col-form-label form-control-sm">COD.PATRIMON.:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm">
															<input type="text" readonly class="form-control form-control-sm" id="entm_patrimonial">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm">
															<label for="" class="col-form-label form-control-sm">CATEGORIA:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm">
															<input type="text" readonly class="form-control form-control-sm" id="entm_categoria">
														</div>
													</div>
												</div>
											</div>
									</div>

									
									<div class="row align-items-end">
										<div class="col-lg-3">
											<div class="form-group">
								    			<label for="entm_unidad_medida" class="col-form-label form-control-sm">UNIDAD</label>
												<input type="text" readonly class="form-control form-control-sm" id="entm_unidad_medida">
				  				    		</div> 
			      		            	</div>
										<div class="col-lg-3">
											<div class="form-group">
								    			<label for="entm_moneda" class="col-form-label form-control-sm">MONEDA</label>
												<input type="text" readonly class="form-control form-control-sm" id="entm_moneda">
				  				    		</div> 
			      		            	</div>
										  <div class="col-lg-3">
											<div class="form-group">
								    			<label for="entm_precio" class="col-form-label form-control-sm">PRECIO</label>
												<input type="number" readonly class="form-control form-control-sm" id="entm_precio">
				  				    		</div>
			      		            	</div>
										<div class="col-lg-3">
											<div class="form-group">
								    			<label for="entm_precio_soles" class="col-form-label form-control-sm">PRECIO S/.</label>
												<input type="number" readonly class="form-control form-control-sm" id="entm_precio_soles">
				  				    		</div>
			      		            	</div>
									</div>
									<div class="row d-flex justify-content-end">
										<div class="col-lg-3">
											<div class="form-group">
								    			<label for="entm_cantidad" class="col-form-label form-control-sm">CANTIDAD</label>
												<input type="number" class="form-control form-control-sm" id="entm_cantidad">
				  				    		</div> 
			      		            	</div>
									</div>

								</div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
			      					<button type="submit" id="btn_guardar_entrada_materiales" class="btn btn-dark btn-sm btn_guardar_entrada_materiales">Agregar</button>
								</div>
							</form>
			        	</div>
			    	</div>
				</div>
				<!-- Termino Modal para CRUD MATERIALES ENTRADA-->

				<!-- Modal para CRUD LOG ENTRADA-->
				<div class="row modal fade" id="modal_crud_log_entrada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_log_entrada" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_log_entrada">
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
				<!-- Termino de CRUD LOG ENTRADA --> 

			</div>
			<!-- FIN TAB ENTRADAS --> 

			<!-- INICIO TAB SALIDAS -->
			<div class="tab-pane fade" id="nav-salida" role="tabpanel" aria-labelledby="nav-salida-tab">
				<form id="form_seleccion_salida" class="row col-sm-12 container-fluid" onsubmit="return false;">
					<div class="row align-items-end pb-0 col-sm-6 mb-1">
						<div class="col-lg-4">
							<div class="form-group mb-0">
								<div class="input-group mt-3">
							  		<div class="input-group-prepend">
       									<span class="input-group-text form-control-sm" id="basic-addon1">Salida N° S-</span>
        								<input type="text" tabindex="1" class="form-control form-control-sm" id="salida_id" placeholder="Código Salida" aria-label="salida_id" aria-describedby="basic-addon1">
							  		</div>
      							</div>
							</div>
			        	</div>
						<div class="col-lg-8">             	
							<div class="form-group mb-0" id="div_btn_seleccion_salida">
								<!-- Accesos Botones Formulario -->
							</div>
			       		</div> 
					</div>
				</form>

				<div class="container-fluid ml-0 mr-0 mb-0" id="div_form_salida">
					<form id="form_salida" enctype="multipart/form-data" action="" method="post" onsubmit="return false;">    
			    		<div class="form-group">
							<div class="row">
								<div class="col-lg-6 mx-1 border border-muted border-radius rounded">
					 				<div class="row d-flex justify-content-araound">
										<div class="col-lg-6">
											<div class="row">
												<div class="col-lg-5">
													<div class="form-group form-control-sm mb-1">
														<label for="t_salida_id" class="col-form-label form-control-sm mb-1">N° SALIDA :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<input type="text" readonly class="form-control form-control-sm mb-1" id="t_salida_id">
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="row">
												<div class="col-lg-5">
													<div class="form-group form-control-sm mb-1">
														<label for="sal_fecha_creacion" class="col-form-label form-control-sm mb-1">FECHA SALIDA :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<input type="date" readonly class="form-control form-control-sm mb-1" id="sal_fecha_creacion">
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
														<label for="sal_alm_descripcion" class=	"col-form-label form-control-sm mb-1">ALMACEN :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<select class="form-control form-control-sm mb-1" id="sal_alm_descripcion">

														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="row">
												<div class="col-lg-5">
													<div class="form-group form-control-sm mb-1">
														<label for="sal_tipo_movimiento" class="col-form-label form-control-sm mb-1">TIPO SALIDA :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<select class="form-control form-control-sm mb-1" id="sal_tipo_movimiento">

														</select>
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
														<label for="sal_tipo_documento" class="col-form-label form-control-sm mb-1">TIPO DOCUMENTO :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<select class="form-control form-control-sm mb-1" id="sal_tipo_docuemnto">

														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="row">
												<div class="col-lg-5">
													<div class="form-group form-control-sm mb-1">
														<label for="sal_nro_documento" class="col-form-label form-control-sm mb-1">NRO. DOCUMENTO :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<select class="form-control form-control-sm mb-1" id="sal_nro_docuemnto">

														</select>
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
														<label for="sal_nombre_responsable" class="col-form-label form-control-sm mb-1">RESPONSABLE :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<input type="text" readonly class="form-control form-control-sm mb-1" id="sal_nombre_responsable">
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="row">
												<div class="col-lg-5">
													<div class="form-group form-control-sm mb-1">
														<label for="sal_estado" class="col-form-label form-control-sm mb-1">ESTADO :</label>
													</div>
												</div>
												<div class="col-lg-7">
													<div class="form-group form-control-sm mb-1">
														<input type="text" readonly class="form-control form-control-sm mb-1" id="sal_estado">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row align-items-end d-flex">
												<div class="btn-toolbar ml-auto p-2" id="div_btn_salida" role="toolbar" aria-label="Toolbar with button groups">
													<div class="btn-group" role="group" aria-label="Four group">
                            					        <button type="button" id="btn_materiales_salida" class="btn btn-secondary btn-sm mr-1 btn_materiales_salida">+ Materiales</button>
														<button type="button" id="btn_materiales_salida_importar" class="btn btn-secondary btn-sm mr-1 btn_materiales_salida_importar">+ Importar</button>
                            					    </div>
												</div>
											</div>
										</div>
									</div>
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="container-fluid caja">
												<div class="row w-100 p-0 m-0">
											       	<div class="col-lg-12">
											       		<div class="table-responsive" id="div_tabla_materiales_salida">        
											           		<!-- CreacionTabla -->
											            </div>
											        </div>
											    </div>  
											</div>
										</div>
									</div>
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row">
												<div class="form-group col-lg-1 mb-1">
													<button type="button" id="btn_log_entrada" class="btn btn-info btn-sm btn_log_salida">Log...</button>
												</div>
												<div class="form-group col-lg-11 mb-1">
													<textarea class="form-control form-control-sm mb-3 text-uppercase" id="obs_sal_log" rows="1" placeholder="escribe algo aqui..."></textarea>
												</div>
											</div>
										</div>
									</div>
									<div class="row d-flex justify-content-center">
										<div class="col-lg-4">
											<div class="form-group align-items-center d-flex" id="div_btn_guardar_salida">
												<button type="button" id="btn_cancelar_salida" class="btn btn-light btn-sm btn_cancelar_salida">Cancelar</button>
												<button type="button" id="btn_guardar_salida" class="btn btn-secondary btn-sm btn_guardar_salida">Guardar</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>		
					</form>
				</div>

				<!-- Modal para CRUD LOG ENTRADA-->
				<div class="row modal fade" id="modal_crud_log_entrada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_log_entrada" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_log_entrada">
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
				<!-- Termino de CRUD LOG ENTRADA --> 

			</div>
			<!-- FIN TAB ENTRADAS --> 

			<!-- INICIO TAB ALMACENES -->
			<div class="tab-pane fade" id="nav-almacen" role="tabpanel" aria-labelledby="nav-almacen-tab">
				
				<form id="form_seleccion_almacen" class="row col-sm-12 container-fluid" enctype="multipart/form-data">	    
					<div class="row align-items-end pb-0 col-sm-6 mb-1">
						<div class="col-lg-4">
							<div class="form-group mb-0" id="div_btn_seleccion_almacen">
							</div>
			        	</div>
					</div>
				</form>
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_almacen">
							<!-- Accesos CreacionTabla -->
						</div>
    				</div>
				</div>
				<!--Modal para CRUD ALMACEN-->
				<div class="row modal fade" id="modal_crud_almacen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="form_crud_almacen">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="almacen_id" class="col-form-label form-control-sm">CODIGO ALMACEN</label>
										   		<input type="number" readonly class="form-control form-control-sm" id="almacen_id">
										 	</div>
									 	</div>
										 <div class="col-lg-6">
											<div class="form-group">
										  		<label for="alm_fecha_creacion" class="col-form-label form-control-sm">FECHA CREACION</label>
										   		<input type="date" readonly class="form-control form-control-sm" id="alm_fecha_creacion">
										 	</div>
									 	</div>
									</div>
									<div class="row">
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="alm_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
										   		<input type="text" class="form-control form-control-sm text-uppercase" id="alm_descripcion" maxlength="100">
											</div> 
									 	</div>    
										 <div class="col-lg-6">
									  		<div class="form-group">
												<label for="alm_ubicacion" class="col-form-label form-control-sm">UBICACION</label>
												<input type="text" class="form-control form-control-sm text-uppercase" id="alm_ubicacion" maxlength="100">
											</div> 
						  				</div>
									</div>
									<div class="row">
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="alm_dimesiones" class="col-form-label form-control-sm">DIMENSIONES</label>
										   		<input type="text" class="form-control form-control-sm text-uppercase" id="alm_dimensiones" maxlength="100">
											</div> 
									 	</div>    
									</div>
									<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="alm_nombre_responsable" class="col-form-label form-control-sm">RESPONSABLE</label>
												<input type="text" readonly class="form-control" id="alm_nombre_responsable" maxlength="45">
											</div> 
						  				</div>
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="alm_estado" class="col-form-label form-control-sm">ESTADO</label>
												<select class="form-control form-control-sm" id="alm_estado">

												</select>
											</div> 
						  				</div>
									</div>
									<div class="row"> 
										<div class="col-lg-12">
											<div class="form-group">
												<label for="alm_log" class="col-form-label form-control-sm">LOG</label>
												<div class="form-control-sm overflow-auto border border-muted border-radius rounded" style="height:50px" id="div_alm_log">
													<!-- JS alm_log -->
												</div>
											</div>
										</div>
									</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btn_guardar_almacen" class="btn btn-secondary btn-sm">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			

				<!--Modal para VER ALMACEN-->
				<div class="row modal fade" id="modal_crud_ver_almacen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="form_crud_ver_almacen">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="t_almacen_id" class="col-form-label form-control-sm">CODIGO ALMACEN</label>
										   		<input type="number" readonly class="form-control form-control-sm" id="t_almacen_id">
										 	</div>
									 	</div>
										 <div class="col-lg-6">
											<div class="form-group">
										  		<label for="t_alm_fecha_creacion" class="col-form-label form-control-sm">FECHA CREACION</label>
										   		<input type="date" readonly class="form-control form-control-sm" id="t_alm_fecha_creacion">
										 	</div>
									 	</div>
									</div>
									<div class="row">
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="t_alm_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
										   		<input type="text" readonly class="form-control form-control-sm text-uppercase" id="t_alm_descripcion" maxlength="100">
											</div> 
									 	</div>    
										 <div class="col-lg-6">
									  		<div class="form-group">
												<label for="t_alm_ubicacion" class="col-form-label form-control-sm">UBICACION</label>
												<input type="text" readonly class="form-control form-control-sm text-uppercase" id="t_alm_ubicacion" maxlength="100">
											</div> 
						  				</div>
									</div>
									<div class="row">
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="t_alm_dimesiones" class="col-form-label form-control-sm">DIMENSIONES</label>
										   		<input type="text" readonly class="form-control form-control-sm text-uppercase" id="t_alm_dimensiones" maxlength="100">
											</div> 
									 	</div>    
									</div>
									<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="t_alm_nombre_responsable" class="col-form-label form-control-sm">RESPONSABLE</label>
												<input type="text" readonly class="form-control" id="t_alm_nombre_responsable" maxlength="45">
											</div> 
						  				</div>
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="t_alm_estado" class="col-form-label form-control-sm">ESTADO</label>
												<input type="text" readonly class="form-control form-control-sm" id="t_alm_estado">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
										<div class="col-lg-12">
											<div class="form-group">
												<label for="t_alm_log" class="col-form-label form-control-sm">LOG</label>
												<div class="form-control-sm overflow-auto border border-muted border-radius rounded" style="height:50px" id="div_t_alm_log">
													<!-- JS alm_log -->
												</div>
											</div>
										</div>
									</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>

			</div>
			<!-- FIN TAB ALMACENES --> 

			<!-- INICIO TAB MATERIAL POR ALMACEN -->
			<div class="tab-pane fade" id="nav-material_almacen" role="tabpanel" aria-labelledby="nav-material_almacen-tab">
				
				<form id="form_seleccion_material_almacen" class="row col-sm-12 container-fluid" enctype="multipart/form-data">	    
					<div class="row align-items-end pb-4 col-sm-12 mb-1">
						<div class="col-lg-2">
			    		  	<div class="form-group">
								<label for="malm_select_almacen" class="col-form-label form-control-sm">ALMACEN</label>
								<select class="form-control form-control-sm" id="malm_select_almacen" name="malm_select_almacen">
								</select>
							</div>
			    		</div>

						<div class="col-lg-2">
							<div class="form-group" id="div_btn_seleccion_material_almacen">
								<!-- BotonesFormulario -->
							</div>
			        	</div>
					</div>
				</form>
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_material_almacen">
							<!-- CreacionTabla -->
						</div>
    				</div>
				</div>
				<!--Modal para CRUD ALMACEN-->
				<div class="row modal fade" id="modal_crud_material_almacen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="form_crud_almacen">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group">
										  		<label for="malm_material_id" class="col-form-label form-control-sm">CODIGO MATERIAL</label>
										   		<input type="text" class="form-control form-control-sm" id="malm_material_id">
										 	</div>
									 	</div>
									</div>
									<div class="row">
										 <div class="col-lg-6">
											<div class="form-group">
										  		<label for="malm_descripcion" class="col-form-label form-control-sm">DESCRIPCION MATERIAL</label>
										   		<input type="text" readonly class="form-control form-control-sm" id="malm_descripcion">
										 	</div>
									 	</div>
									</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btn_guardar_material_almacen" class="btn btn-secondary btn-sm">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			

				<!--Modal para VER ALMACEN-->
				<div class="row modal fade" id="modal_crud_ver_almacen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="form_crud_ver_almacen">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="t_almacen_id" class="col-form-label form-control-sm">CODIGO ALMACEN</label>
										   		<input type="number" readonly class="form-control form-control-sm" id="t_almacen_id">
										 	</div>
									 	</div>
										 <div class="col-lg-6">
											<div class="form-group">
										  		<label for="t_alm_fecha_creacion" class="col-form-label form-control-sm">FECHA CREACION</label>
										   		<input type="date" readonly class="form-control form-control-sm" id="t_alm_fecha_creacion">
										 	</div>
									 	</div>
									</div>
									<div class="row">
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="t_alm_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
										   		<input type="text" readonly class="form-control form-control-sm text-uppercase" id="t_alm_descripcion" maxlength="100">
											</div> 
									 	</div>    
										 <div class="col-lg-6">
									  		<div class="form-group">
												<label for="t_alm_ubicacion" class="col-form-label form-control-sm">UBICACION</label>
												<input type="text" readonly class="form-control form-control-sm text-uppercase" id="t_alm_ubicacion" maxlength="100">
											</div> 
						  				</div>
									</div>
									<div class="row">
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="t_alm_dimesiones" class="col-form-label form-control-sm">DIMENSIONES</label>
										   		<input type="text" readonly class="form-control form-control-sm text-uppercase" id="t_alm_dimensiones" maxlength="100">
											</div> 
									 	</div>    
									</div>
									<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="t_alm_nombre_responsable" class="col-form-label form-control-sm">RESPONSABLE</label>
												<input type="text" readonly class="form-control" id="t_alm_nombre_responsable" maxlength="45">
											</div> 
						  				</div>
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="t_alm_estado" class="col-form-label form-control-sm">ESTADO</label>
												<input type="text" readonly class="form-control form-control-sm" id="t_alm_estado">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
										<div class="col-lg-12">
											<div class="form-group">
												<label for="t_alm_log" class="col-form-label form-control-sm">LOG</label>
												<div class="form-control-sm overflow-auto border border-muted border-radius rounded" style="height:50px" id="div_t_alm_log">
													<!-- JS alm_log -->
												</div>
											</div>
										</div>
									</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>

			</div>
			<!-- FIN TAB MATERIAL POR ALMACEN --> 

			<!-- INICIO TAB INVENTARIO -->
			<div class="tab-pane fade" id="nav-inventario" role="tabpanel" aria-labelledby="nav-inventario-tab">
				
				<form id="form_seleccion_inventario" class="row col-sm-12 container-fluid" enctype="multipart/form-data">	    
					<div class="row align-items-end pb-0 col-sm-6 mb-1">
						<div class="col-lg-4">
							<div class="form-group mb-0">
							</div>
			        	</div>
						<div class="col-lg-1">             	
							<div class="form-group mb-0">
							</div>
				    	</div> 
					</div>
				</form>
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_inventario">
							<!-- Accesos CreacionTabla -->
						</div>
    				</div>
				</div>

			</div>
			<!-- FIN TAB INVENTARIO --> 

			<!-- INICIO TAB REPORTES -->
			<div class="tab-pane fade" id="nav-reportes" role="tabpanel" aria-labelledby="nav-reportes-tab">
				
				<form id="form_seleccion_reportes" class="row col-sm-12 container-fluid" enctype="multipart/form-data">	    
					<div class="row align-items-end pb-0 col-sm-6 mb-1">
						<div class="col-lg-4">
							<div class="form-group mb-0">
							</div>
			        	</div>
						<div class="col-lg-1">             	
							<div class="form-group mb-0">
							</div>
				    	</div> 
					</div>
				</form>
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_reportes">
							<!-- Accesos CreacionTabla -->
						</div>
    				</div>
				</div>

			</div>
			<!-- FIN TAB REPORTES --> 

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