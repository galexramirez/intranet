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
			<div class="nav nav-tabs" id="nav-tab-pedidos" role="tablist">
				<!-- CreacionTabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">
			<!-- INICIO TAB PEDIDOS -->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<form id="form_seleccion_pedido" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
			      			<div class="form-group">
								<label for="FechaInicioPedidos" class="col-form-label form-control-sm">F. INICIO</label>
								<input type="date" class="form-control form-control-sm" id="FechaInicioPedidos" placeholder="dd/mm/aaaa" >
			      			</div>
			    		</div>
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="FechaTerminoPedidos" class="col-form-label form-control-sm">F. TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="FechaTerminoPedidos" placeholder="dd/mm/aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-1">             	
							<div class="form-group" id="div_btn_seleccion_pedido">
								
							</div>
				    	</div> 
					</div>
				</form>
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_pedido">
							<!-- CreacionTabla -->
						</div>
    				</div>
				</div>

				<!-- MODAL CRUD VER INFORMACION DE PEDIDO -->
				<div class="row modal fade" id="modal_crud_ver_pedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_ver_pedido" enctype="multipart/form-data" action="" method="post">    
								<div class="modal-body">
									<div class="form-group">
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<label for="ipedido_id" class="col-form-label form-control-sm mb-1">N° PEDIDO :</label>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="ipedido_id">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<label for="ipedi_fechacreacion" class="col-form-label form-control-sm mb-1">FECHA CREACION :</label>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="ipedi_fechacreacion">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<label for="ipedi_fechacreacion" class="col-form-label form-control-sm mb-1">F. REQUERIM. :</label>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<input type="date" readonly class="form-control form-control-sm mb-1" id="ipedi_fecharequerimiento">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<label for="ipedi_prioridad" class="col-form-label form-control-sm mb-1">PRIORIDAD :</label>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="ipedi_prioridad">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<label for="ipedi_bus" class="col-form-label form-control-sm mb-1">BUS :</label>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="ipedi_bus">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<label for="ipedi_centrocosto" class="col-form-label form-control-sm mb-1">C.COSTO :</label>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="ipedi_centrocosto">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<label for="ipedi_tipo" class="col-form-label form-control-sm mb-1">TIPO :</label>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="ipedi_tipo">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-6">	
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<label for="ipedi_responsable" class="col-form-label form-control-sm mb-1">RESPONSABLE :</label>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="ipedi_responsable">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<label for="ipedi_estado" class="col-form-label form-control-sm mb-1">ESTADO :</label>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="ipedi_estado">
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
												       		<div class="table-responsive" id="div_tabla_ver_material_pedido">
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
													<div class="form-group col-lg-12 mb-1">
    													<label for="ipedi_log" class="form-control-sm pl-0 mb-0">LOG :</label>
														<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_ipedi_log">
															<!-- JS Log -->
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
				<!-- FIN MODAL CRUD VER INFORMACION DE PEDIDO --> 

			</div>
			<!-- TERMINO TAB PEDIDOS --> 

			<!-- INICIO TAB PROCESAR PEDIDOS -->
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<form id="form_seleccion_procesar_pedido" class="row col-sm-12 container-fluid" onsubmit="return false;">
					<div class="row align-items-end pb-0 col-sm-6 mb-1">
						<div class="col-lg-4">
							<div class="form-group mb-0">
								<div class="input-group mt-3">
							  		<div class="input-group-prepend">
       									<span class="input-group-text form-control-sm" id="basic-addon1">Pedidos N° P-</span>
        								<input type="text" tabindex="1" class="form-control form-control-sm" id="pedido_id" placeholder="Código Pedidos" aria-label="cod_pedido" aria-describedby="basic-addon1">
							  		</div>
      							</div>
							</div>
			        	</div>
						<div class="col-lg-8">             	
							<div class="form-group mb-0" id="div_btn_seleccion_procesar_pedido">
								<!-- BotonesFormulario -->
							</div>
			       		</div> 
					</div>
				</form>
				<div class="container-fluid ml-0 mr-0 mb-0" id="div_form_procesar_pedido">
					<!-- MostrarDiv -->
				</div>

				<!-- MODAL CRUD MATERIALES PEDIDOS-->
				<div class="row modal fade" id="modal_crud_material_pedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content ui-widget-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_material_pedido" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body ui-front">
								  <div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group ui-widget">
												<label for="buscar_material" class="col-form-label form-control-sm">BUSCAR</label>	
												<div class="row input-group mb-3">
													<div class="col-lg-11 input-group-append">
  														<input type="text" class="form-control text-uppercase form-control-sm" placeholder="BUSCAR" aria-label="MATERIAL" aria-describedby="btn_buscar_material" id="buscar_material">
													</div>
													<div class="col-lg-1 input-group-append">
	    												<button class="btn btn-outline-secondary btn-sm btn_buscar_material" type="button" id="btn_buscar_material"><i class="bi bi-search"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg></i></button>
													</div>
												</div>
				  				        	</div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group ui-widget">
								        		<label for="mp_materialid" class="col-form-label form-control-sm">CODIGO</label>
												<input type="text" readonly class="form-control text-uppercase form-control-sm" id="mp_materialid">
				  				        	</div> 
			      		            	</div>
										  <div class="col-lg-12">
											<div class="form-group ui-widget">
								        		<label for="mp_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
												<input type="text" readonly class="form-control text-uppercase form-control-sm" id="mp_descripcion">
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
															<input type="text" readonly class="form-control form-control-sm mb-1" id="mp_asignacion">
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
															<input type="text" readonly class="form-control form-control-sm mb-1" id="mp_tarjeta">
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
															<input type="text" readonly class="form-control form-control-sm mb-1" id="mp_macrosistema">
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
															<input type="text" readonly class="form-control form-control-sm mb-1" id="mp_condicion">
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
															<input type="text" readonly class="form-control form-control-sm mb-1" id="mp_sistema">
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
															<input type="text" readonly class="form-control form-control-sm mb-1" id="mp_flota">
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
															<input type="text" readonly class="form-control form-control-sm" id="mp_patrimonial">
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
															<input type="text" readonly class="form-control form-control-sm" id="mp_categoria">
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
															<label for="mp_unidadmedida" class="col-form-label form-control-sm">UNID.MEDIDA:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm">
															<input type="text" readonly class="form-control form-control-sm" id="mp_unidadmedida">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm">
															<label for="mp_tipo" class="col-form-label form-control-sm">TIPO:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm">
															<input type="text" readonly class="form-control form-control-sm" id="mp_tipo">
														</div>
													</div>
												</div>
											</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-2">
											<div class="form-group">
								    			<label for="mp_cantidad" class="col-form-label form-control-sm">CANTIDAD</label>
												<input type="number" step="0.0001" class="form-control form-control-sm" id="mp_cantidad">
				  				    		</div> 
			      		            	</div>
										<div class="col-lg-2">
											<div class="form-group">
								    			<label for="mp_bus" class="col-form-label form-control-sm">BUS</label>
												<select class="form-control form-control-sm" id="mp_bus">
													
												</select>
				  				    		</div> 
			      		            	</div>
										<div class="col-lg-8">
											<div class="form-group">
								    			<label for="mp_observaciones" class="col-form-label form-control-sm">OBSERVACIONES</label>
												<input type="text" class="form-control text-uppercase form-control-sm" id="mp_observaciones" maxlength="100">
				  				    		</div> 
			      		            	</div>
									</div>
								</div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
			      					<button type="submit" id="btn_guardar_material_pedido" class="btn btn-dark btn-sm">Agregar</button>
								</div>
							</form>
			        	</div>
			    	</div>
				</div>
				<!-- FIN MODAL CRUD MATERIALES PEDIDOS-->
				
				<!-- MODAL CRUD LOG PEDIDO-->
				<div class="row modal fade" id="modal_crud_log_pedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_log_pedido" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_log_pedido">
												<!-- JS btn_log_pedido -->
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
				<!-- FIN CRUD LOG PEDIDO --> 

				<!-- MODAL CRUD VALIDAR PEDIDO -->
				<div class="row modal fade" id="modal_crud_validar_pedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_validar_pedido" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group">
								    			<label for="obs_validar" class="col-form-label form-control-sm">Observaciones</label>
												<textarea class="form-control form-control-sm mb-3 text-uppercase" id="obs_validar" rows="2" placeholder="escribe algo aqui..."></textarea>
				  				    		</div> 
			      		            	</div>
									</div>  
								</div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancelar</button>
									<button type="button" id="btn_aprobar_pedido" class="btn btn-sm btn-primary btn_aprobar_pedido">Aprobar</button>
									<button type="button" id="btn_rechazar_pedido" class="btn btn-sm btn-danger btn_rechazar_pedido">Rechazar</button>
								</div>
							</form>
			        	</div>
			    	</div>
				</div>
				<!-- TERMINO MODAL CRUD VALIDAR PEDIDO -->
				
				<!-- MODAL CRUD VALIDAR PEDIDO DIRECTO -->
				<div class="row modal fade" id="modal_crud_validar_pedido_directo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_validar_pedido_directo" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group">
								    			<label for="obs_validar_pedido_directo" class="col-form-label form-control-sm">Observaciones</label>
												<textarea class="form-control form-control-sm mb-3 text-uppercase" id="obs_validar_pedido_directo" rows="2" placeholder="escribe algo aqui..."></textarea>
				  				    		</div> 
			      		            	</div>
									</div>  
								</div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancelar</button>
									<button type="button" id="btn_aprobar_pedido_directo" class="btn btn-sm btn-primary btn_aprobar_pedido_directo">Aprobar</button>
								</div>
							</form>
			        	</div>
			    	</div>
				</div>
				<!-- FIN MODAL CRUD VALIDAR PEDIDO DIRECTO -->

				<!-- MODAL CRUD CANCELAR PEDIDO -->
				<div class="row modal fade" id="modal_crud_cancelar_pedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_cancelar_pedido" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group">
								    			<label for="obs_cancelar_pedido" class="col-form-label form-control-sm">Observaciones</label>
												<textarea class="form-control form-control-sm mb-3 text-uppercase" id="obs_cancelar_pedido" rows="2" placeholder="escribe algo aqui..."></textarea>
				  				    		</div> 
			      		            	</div>
									</div>  
								</div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancelar</button>
									<button type="button" id="btn_aceptar_cancelar_pedido" class="btn btn-sm btn-primary btn_aceptar_cancelar_pedido">Aceptar</button>
								</div>
							</form>
			        	</div>
			    	</div>
				</div>
				<!-- FIN MODAL CRUD CANCELAR PEDIDO -->

				<!-- MODAL CRUD COTIZACIONES -->
				<div class="row modal fade" id="modal_crud_cotizacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_cotizacion" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group">
								    			<label for="coti_razonsocial" class="col-form-label form-control-sm">Razón Social</label>
												<select class="form-control form-control-sm" id="coti_razonsocial">

												</select>
				  				    		</div> 
			      		            	</div>
									</div>  
									<div class="row align-items-end">
										<div class="col-lg-6">
											<div class="form-group">
								    			<label for="coti_fecha" class="col-form-label form-control-sm">Fecha</label>
												<input type="datetime-local" readonly class="form-control form-control-sm" id="coti_fecha">
				  				    		</div> 
			      		            	</div>
									</div>  
								</div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancelar</button>
									<button type="button" id="btn_guardar_cotizacion" class="btn btn-sm btn-secondary btn_guardar_cotizacion">Guardar</button>
								</div>
							</form>
			        	</div>
			    	</div>
				</div>
				<!-- FIN MODAL CRUD COTIZACIONES -->

				<!-- MODAL CRUD CERRAR COTIZACION -->
				<div class="row modal fade" id="modal_crud_cerrar_cotizacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_cerrar_cotizacion" enctype="multipart/form-data" action="" method="post" onsubmit="return false;">    
								<div class="modal-body">
									<div class="form-group">
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-4">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<label for="icotizacion_id" class="col-form-label form-control-sm mb-1">N° COTIZACION :</label>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="icotizacion_id">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="row">
													<div class="col-lg-5">
														<div class="form-group form-control-sm mb-1">
															<label for="icoti_fecha" class="col-form-label form-control-sm mb-1">FECHA :</label>
														</div>
													</div>
													<div class="col-lg-7">
														<div class="form-group form-control-sm mb-1">
															<input type="datetime-local" readonly class="form-control form-control-sm mb-1" id="icoti_fecha">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="row">
													<div class="col-lg-5">
														<div class="form-group form-control-sm mb-1">
															<label for="icoti_estado" class="col-form-label form-control-sm mb-1">ESTADO :</label>
														</div>
													</div>
													<div class="col-lg-7">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="icoti_estado">
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
															<label for="icoti_razonsocial" class="col-form-label form-control-sm mb-1">RAZON SOCIAL :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="icoti_razonsocial">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-6">	
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="icoti_responsable" class="col-form-label form-control-sm mb-1">RESPONSABLE :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="icoti_responsable">
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
												       		<div class="table-responsive" id="div_tabla_material_cotizacion">        
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
													<div class="form-group col-lg-12 mb-1">
    													<label for="icoti_log" class="form-control-sm pl-0 mb-0">LOG :</label>
														<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_icoti_log">
															<!-- JS Log -->
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
			      		    	<div class="modal-footer" id="div_btn_cerrar_cotizacion">
									<!-- MostrarDiv -->  	
								</div>
							</form>
			        	</div>
			    	</div>
				</div>
				<!-- FIN MODAL CRUD CERRAR COTIZACIONES --> 

				<!-- MODAL CRUD MATERIALES COTIZACIONES -->
				<div class="row modal fade" id="modal_crud_material_cotizacion" tabindex="-1" role="dialog" aria-labelledby="material_cotizacion_modal_label" aria-hidden="true">
					<div class="modal-dialog" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="material_cotizacion_modal_label"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_material_cotizacion" enctype="multipart/form-data" action="" method="post" onsubmit="return false;">
			      		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group">
								        		<label for="mc_materialid" class="col-form-label form-control-sm">CODIGO</label>
												<input type="text" readonly class="form-control text-uppercase form-control-sm" id="mc_materialid">
				  				        	</div> 
			      		            	</div>
										<div class="col-lg-12">
											<div class="form-group">
								        		<label for="mc_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
												<input type="text" readonly class="form-control text-uppercase form-control-sm" id="mc_descripcion">
				  				        	</div> 
			      		            	</div>
									</div>  
									<div class="row align-items-end">
										<div class="col-lg-4">
											<div class="form-group">
								    			<label for="mc_unidadmedida" class="col-form-label form-control-sm">UNIDAD</label>
												<input type="text" readonly class="form-control form-control-sm" id="mc_unidadmedida">
				  				    		</div> 
			      		            	</div>
										  <div class="col-lg-4">
											<div class="form-group">
								    			<label for="mc_cantidad" class="col-form-label form-control-sm">CANT.PEDIDO</label>
												<input type="number" step="0.0001" readonly class="form-control form-control-sm" id="mc_cantidad">
				  				    		</div> 
			      		            	</div>
										<div class="col-lg-4">
											<div class="form-group">
								    			<label for="mc_cantidad_cotizacion" class="col-form-label form-control-sm">CANT.COTIZ.</label>
												<input type="number" step="0.0001" class="form-control form-control-sm" id="mc_cantidad_cotizacion">
				  				    		</div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-6">
											<div class="form-group">
								    			<label for="mc_preciocotizacion" class="col-form-label form-control-sm">PRECIO COTIZ.</label>
												<input type="number" step="0.0001" class="form-control form-control-sm" id="mc_preciocotizacion">
				  				    		</div> 
			      		            	</div>
										<div class="col-lg-6">
											<div class="form-group">
								    			<label for="mc_totalprecio" class="col-form-label form-control-sm">IMPORTE</label>
												<input type="number" readonly class="form-control form-control-sm" id="mc_totalprecio">
				  				    		</div> 
			      		            	</div>
									</div>
								</div>
			      		    	<div class="modal-footer" id="div_btn_material_cotizacion">
								  <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
								  <button type="button" id="btn_guardar_material_cotizacion" class="btn btn-dark btn-sm btn_guardar_material_cotizacion">Guardar</button>
								</div> 
							</form>
			        	</div>
			    	</div>
				</div>
				<!-- FIN CRUD MATERIALES COTIZACIONES --> 

				<!-- MODAL CRUD COTIZACIONES PDF -->
				<div class="row modal fade" id="modal_crud_otizacion_pdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_cotizacion_pdf" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="ExternalFiles" id="div_cotizacion_pdf">
						        				<!--<img src=" " />-->
											</div>
			                			</div>
									</div>
			      		        	<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group">
												<div class="custom-file" id="div_label_cotizacion_pdf">
							  						<label id="label_cotizacion_pdf" class="custom-file-label" for="customFileLang">Seleccionar Archivo .pdf</label>
							  						<input type="file" class="custom-file-input" id="cotizacion_pdf" lang="es" accept=".pdf"> 
												</div>
				               				</div>
										</div>
									</div>
			      		        </div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
			      					<button type="submit" id="btn_guardar_cotizacion_pdf" class="btn btn-dark btn-sm btn_guardar_cotizacion_pdf">Cargar</button>
								</div>
							</form>
			        	</div>
			    	</div>
				</div>
				<!-- FIN MODAL CRUD COTIZACIONES PDF --> 

				<!-- MODAL CRUD CERRAR PEDIDO NO ATENDIDO -->
				<div class="row modal fade" id="modal_crud_cerrar_pedido_no_atendido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_cerrar_pedido_no_atendido" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group">
								    			<label for="obs_cerrar_pedido_no_etndido" class="col-form-label form-control-sm">Observaciones</label>
												<textarea class="form-control form-control-sm mb-3 text-uppercase" id="obs_cerrar_pedido_no_atendido" rows="2" placeholder="escribe algo aqui..."></textarea>
				  				    		</div> 
			      		            	</div>
									</div>  
								</div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancelar</button>
									<button type="button" id="btn_aceptar_cerrar_pedido_no_atendido" class="btn btn-sm btn-primary btn_aceptar_cerrar_pedido_no_atendido">Aceptar</button>
								</div>
							</form>
			        	</div>
			    	</div>
				</div>
				<!-- FIN MODAL CRUD VALIDAR PEDIDO DIRECTO -->

			</div>
			<!-- FIN TAB PROCESAR PEDIDOS --> 

			<!-- INICIO TAB COTIZACIONES -->
			<div class="tab-pane fade" id="nav-cotizacion" role="tabpanel" aria-labelledby="nav-cotizacion-tab">
				
				<form id="form_seleccion_ver_cotizacion" class="row col-sm-12 container-fluid" enctype="multipart/form-data" onsubmit="return false;">	    
					<div class="row align-items-end pb-0 col-sm-6 mb-1">
						<div class="col-lg-4">
							<div class="form-group mb-0">
								<div class="input-group mt-3">
							  		<div class="input-group-prepend">
       									<span class="input-group-text form-control-sm" id="basic-addon1">Pedidos N° P-</span>
        								<input type="number" tabindex="1" class="form-control form-control-sm" id="mc_pedidoid" placeholder="Código Pedidos" aria-label="mc_pedidoid" aria-describedby="basic-addon1">
							  		</div>
      							</div>
							</div>
			        	</div>
						<div class="col-lg-5">             	
							<div class="form-group mb-0" id="div_btn_seleccion_ver_cotizacion">
								<!-- MostrarDiv -->
							</div>
				    	</div> 
					</div>
				</form>
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_ver_cotizacion">
							<!-- CreacionTabla -->
						</div>
    				</div>
				</div>

				<!-- MODAL CRUD MATERIAL SELECCIONADO COTIZACIONES -->
				<div class="row modal fade" id="modal_crud_material_seleccionado" tabindex="-1" role="dialog" aria-labelledby="material_cotizacion_modal_label" aria-hidden="true">
					<div class="modal-dialog" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="material_seleccionado_modal_label"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_material_seleccionado" enctype="multipart/form-data" action="" method="post">
			      		    	<div class="modal-body">
								 	<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group">
								        		<label for="tmc_razonsocial" class="col-form-label form-control-sm">RAZON SOCIAL</label>
												<input type="text" readonly class="form-control text-uppercase form-control-sm" id="tmc_razonsocial">
				  				        	</div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group">
								        		<label for="tmc_materialid" class="col-form-label form-control-sm">CODIGO</label>
												<input type="text" readonly class="form-control text-uppercase form-control-sm" id="tmc_materialid">
				  				        	</div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group">
								        		<label for="tmc_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
												<input type="text" readonly class="form-control text-uppercase form-control-sm" id="tmc_descripcion">
				  				        	</div> 
			      		            	</div>
									</div>  
									<div class="row align-items-end">
										<div class="col-lg-4">
											<div class="form-group">
								    			<label for="tmc_pedidoid" class="col-form-label form-control-sm">N°PEDIDO</label>
												<input type="text" readonly class="form-control form-control-sm" id="tmc_pedidoid">
				  				    		</div> 
			      		            	</div>
										  <div class="col-lg-4">
											<div class="form-group">
								    			<label for="tmc_cotizacionid" class="col-form-label form-control-sm">N°COTIZACION</label>
												<input type="text" readonly class="form-control form-control-sm" id="tmc_cotizacionid">
				  				    		</div> 
			      		            	</div>
										<div class="col-lg-4">
											<div class="form-group">
								    			<label for="tmc_moneda" class="col-form-label form-control-sm">MONEDA</label>
												<input type="text" readonly class="form-control form-control-sm" id="tmc_moneda">
				  				    		</div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-4">
											<div class="form-group">
								    			<label for="tmc_unidadmedida" class="col-form-label form-control-sm">UNIDAD</label>
												<input type="text" readonly class="form-control form-control-sm" id="tmc_unidadmedida">
				  				    		</div> 
			      		            	</div>
										  <div class="col-lg-4">
											<div class="form-group">
								    			<label for="tmc_cantidad" class="col-form-label form-control-sm">CANT.PEDIDO</label>
												<input type="number" step="0.0001" readonly class="form-control form-control-sm" id="tmc_cantidad">
				  				    		</div> 
			      		            	</div>
										<div class="col-lg-4">
											<div class="form-group">
								    			<label for="tmc_cantidad_cotizacion" class="col-form-label form-control-sm">CANT.COTIZ.</label>
												<input type="number" step="0.0001" readonly class="form-control form-control-sm" id="tmc_cantidad_cotizacion">
				  				    		</div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-4">
											<div class="form-group">
								    			<label for="tmc_preciosoles" class="col-form-label form-control-sm">PRECIO SOLES</label>
												<input type="number" step="0.0001" readonly class="form-control form-control-sm" id="tmc_preciosoles">
				  				    		</div> 
			      		            	</div>
										<div class="col-lg-4">
											<div class="form-group">
								    			<label for="tmc_fechavigencia" class="col-form-label form-control-sm">FECHA VIGENCIA</label>
												<input type="date" readonly class="form-control form-control-sm" id="tmc_fechavigencia">
				  				    		</div> 
			      		            	</div>
										<div class="col-lg-4">
											<div class="form-group">
								        		<label for="tmc_seleccion" class="col-form-label form-control-sm">SELECCIONADO</label>
												<input type="text" readonly class="form-control text-uppercase form-control-sm" id="tmc_seleccion">
				  				        	</div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-4">
											<div class="form-group">
								    			<label for="tmc_cantidad_solicitada" class="col-form-label form-control-sm">CANT.SOLIC.</label>
												<input type="number" step="0.0001" class="form-control form-control-sm" id="tmc_cantidad_solicitada">
				  				    		</div> 
			      		            	</div>
										<div class="col-lg-4">
											<div class="form-group">
								    			<label for="tmc_preciocotizacion" class="col-form-label form-control-sm">PRECIO COTIZ.</label>
												<input type="number" readonly step="0.0001" class="form-control form-control-sm" id="tmc_preciocotizacion">
				  				    		</div> 
			      		            	</div>
										<div class="col-lg-4">
											<div class="form-group">
								    			<label for="tmc_subtotal_precio" class="col-form-label form-control-sm">IMPORTE</label>
												<input type="number" readonly class="form-control form-control-sm" id="tmc_subtotal_precio">
				  				    		</div> 
			      		            	</div>
									</div>
								</div>
			      		    	<div class="modal-footer" id="div_btn_material_seleccionado">
								  <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
								  <button type="submit" id="btn_guardar_material_selecionado" class="btn btn-dark btn-sm btn_guardar_material_seleccionado">Guardar</button>
								</div> 
							</form>
			        	</div>
			    	</div>
				</div>
				<!-- FIN MODAL CRUD MATERIAL SELECCIONADO COTIZACIONES -->

			</div>
			<!-- FIN TAB COTIZACIONES --> 

			<!-- INICIO TAB ORDENES DE COMPRA -->
			<div class="tab-pane fade" id="nav-orden_compra" role="tabpanel" aria-labelledby="nav-orden_compra-tab">
				
				<form id="form_seleccion_orden_compra" class="row col-sm-12 container-fluid" enctype="multipart/form-data">	    
					<div class="row align-items-end pb-0 col-sm-6 mb-1">
						<div class="col-lg-4">
							<div class="form-group mb-0">
								<div class="input-group mt-3">
							  		<div class="input-group-prepend">
       									<span class="input-group-text form-control-sm" id="basic-addon1">Pedidos N° P-</span>
        								<input type="number" tabindex="1" class="form-control form-control-sm" id="orco_pedidoid" placeholder="Código Pedidos" aria-label="orco_pedidoid" aria-describedby="basic-addon1">
							  		</div>
      							</div>
							</div>
			        	</div>
						<div class="col-lg-1">             	
							<div class="form-group mb-0" id="div_btn_seleccion_orden_compra">
								<!-- BotonesFormulario -->
							</div>
				    	</div> 
					</div>
				</form>
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_orden_compra">
							<!-- CreacionTabla -->
						</div>
    				</div>
				</div>

				<!-- MODAL CRUD GENERAR ORDEN DE COMPRA -->
				<div class="row modal fade" id="modal_crud_orden_compra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_orden_compra" enctype="multipart/form-data" action="" method="post" >    
								<div class="modal-body">
									<div class="form-group">
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-4">
												<div class="row">
													<div class="col-lg-5">
														<div class="form-group form-control-sm mb-1">
															<label for="ordencompra_id" class="col-form-label form-control-sm mb-1">N°O.COMPRA:</label>
														</div>
													</div>
													<div class="col-lg-7">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="ordencompra_id">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="row">
													<div class="col-lg-5">
														<div class="form-group form-control-sm mb-1">
															<label for="orco_cotizacionid" class="col-form-label form-control-sm mb-1">N°COTIZACION:</label>
														</div>
													</div>
													<div class="col-lg-7">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="orco_cotizacionid">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="orco_fecha" class="col-form-label form-control-sm mb-1">FECHA :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="datetime-local" readonly class="form-control form-control-sm mb-1" id="orco_fecha">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-4">
												<div class="row">
													<div class="col-lg-5">
														<div class="form-group form-control-sm mb-1">
															<label for="orco_centrocosto" class="col-form-label form-control-sm mb-1">C. COSTO :</label>
														</div>
													</div>
													<div class="col-lg-7">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="orco_centrocosto">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="row">
													<div class="col-lg-5">
														<div class="form-group form-control-sm mb-1">
															<label for="orco_prioridad" class="col-form-label form-control-sm mb-1">PRIORIDAD :</label>
														</div>
													</div>
													<div class="col-lg-7">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="orco_prioridad">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="orco_estado" class="col-form-label form-control-sm mb-1">ESTADO :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="orco_estado">
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
															<label for="orco_razonsocial" class="col-form-label form-control-sm mb-1">RAZON SOCIAL :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="orco_razonsocial">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-6">	
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="orco_responsable" class="col-form-label form-control-sm mb-1">RESPONSABLE :</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control form-control-sm mb-1" id="orco_responsable">
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
												       		<div class="table-responsive" id="div_tabla_material_orden_compra">        
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
													<div class="form-group col-lg-12 mb-1">
    													<label for="orco_log" class="form-control-sm pl-0 mb-0">LOG :</label>
														<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_orco_log">
															<!-- JS Log -->
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
									<!--<button type="button" id="btn_grabar_orden_compra" class="btn btn-secondary btn-sm btn_editar_orden_compra">Grabar</button>-->
								</div>
							</form>
			        	</div>
			    	</div>
				</div>
				<!-- FIN MODAL CRUD GENERAR ORDEN DE COMPRA --> 

				<!-- MODAL CRUD ANULAR ORDEN DE COMPRA -->
				<div class="row modal fade" id="modal_crud_anular_orden_compra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_anular_orden_compra" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group">
								    			<label for="obs_anular_orden_compra" class="col-form-label form-control-sm">OBSERVACIONES</label>
												<textarea class="form-control form-control-sm mb-3 text-uppercase" id="obs_anular_orden_compra" rows="2" placeholder="escribe algo aqui..."></textarea>
				  				    		</div> 
			      		            	</div>
									</div>  
								</div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancelar</button>
									<button type="button" id="btn_grabar_anular_orden_compra" class="btn btn-sm btn-danger btn_grabar_anular_orden_compra">Anular</button>
								</div>
							</form>
			        	</div>
			    	</div>
				</div>
				<!-- FIN MODAL CRUD ANULAR ORDEN DE COMPRA -->

			</div>
			<!-- FIN TAB ORDENES DE COMPRA --> 

		</div>

	</div>

</div> 



