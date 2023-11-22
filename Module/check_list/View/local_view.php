<!-- 2.2 CONTENIDO DE MODULO -->
<div id="contenido" class="my-contenido-con-sidebar  p-0">

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
	 		<div class="nav nav-tabs" id="nav-tab-check_list" role="tablist">
				<!-- PHP Accesos CreacionTabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">
			<!------------------------------------------------------------------------------->
	  		<!-- TAB LISTADO CHECK LIST DE FLOTA  ------------------------------------------->
			<!------------------------------------------------------------------------------->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<form id="form_seleccion_check_list" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
				        	<div class="form-group">
								<label for="sele_fecha_inicio" class="col-form-label form-control-sm">F.INICIO</label>
								<input type="date" class="form-control form-control-sm" id="sele_fecha_inicio" placeholder="dd/mm/aaaaa">
					       	</div>
			        	</div>
						<div class="col-lg-1">
				        	<div class="form-group">
								<label for="sele_fecha_termino" class="col-form-label form-control-sm">F.TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="sele_fecha_termino" placeholder="dd/mm/aaaaa">
					       	</div>
			        	</div>
						<div class="col-lg-3">             	
							<div class="form-group" id="div_btn_seleccion_check_list">
							</div>
			       		</div> 
					</div>
				</form>
			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tabla_check_list">        
				            </div>
				        </div>
				    </div>  
				</div>
			</div>

			<!------------------------------------------------------------------------------->
			<!-- TAB REGISTRO CHECK LIST FLOTA ---------------------------------------------->
			<!------------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<form id="form_seleccion_check_list_registro" class="row col-sm-12 container-fluid" onsubmit="return false;">	    
					<div class="row align-items-end pb-1 col-sm-12 mb-1">
						<div class="col-lg-2">
							<div class="form-group mb-0">
								<div class="input-group mt-3">
							  		<div class="input-group-prepend">
       									<span class="input-group-text form-control-sm" id="basic-addon1">Check List N° -</span>
        								<input type="number" class="form-control form-control-sm" id="check_list_id" placeholder="Código Check List" aria-label="check_list_id" aria-describedby="basic-addon1">
							  		</div>
      							</div>
							</div>
			        	</div>
						<div class="col-lg-2">             	
							<div class="form-group mb-0" id="div_btn_seleccion_check_list_registro">
							</div>
			       		</div> 
					</div>
				</form>

				<div class="container-fluid ml-0 mr-0 mb-0 pt-3">
					<form id="form_check_list_registro" enctype="multipart/form-data" action="" method="post" onsubmit="return false;">    
						<div class="row align-items-end pb-4 col-sm-12" id="div_check_list_registro">
						</div>
					</form>
				</div>

				<nav>
					<div class="nav nav-tabs" id="nav-tab-detalle_check_list" role="tablist">
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent-detalle_check_list">
					<!------------------------------------------------------------------------------->
					<!-- TAB OBSERVACIONES CHECK LIST FLOTA ----------------------------------------->
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade show active" id="nav-observaciones" role="tabpanel" aria-labelledby="nav-observaciones-tab">
					    <form id="form_registro_observaciones" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
						    <div class="row align-items-end p-4 col-sm-12">
							    <div class="col-lg-1">
								    <div class="form-group" id="div_btn_nuevo_registro_observaciones">
									   
								    </div>
							    </div> 
						    </div>
					    </form>
						<div class="container-fluid caja">
						   	<div class="row w-100 p-0 m-0">
								<div class="col-lg-12">
									<div class="table-responsive" id="div_tabla_check_list_observaciones">
								   	</div>
							   	</div>
						   	</div>  
					   	</div>
					</div>
					<!------------------------------------------------------------------------------->
					<!-- TAB FALLA EN VIA CHECK LIST FLOTA ------------------------------------------>
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade" id="nav-falla_via" role="tabpanel" aria-labelledby="nav-falla_via-tab">
					   	<form id="form_registro_falla_via" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">
						   <div class="row align-items-end p-4 col-sm-12">
						    </div>
					   	</form>
						<div class="container-fluid caja">
						   	<div class="row w-100 p-0 m-0">
								<div class="col-lg-12">
									<div class="table-responsive" id="div_tabla_check_list_falla_via">
								   	</div>
							   	</div>
						   	</div>  
					   	</div>
					</div>
				</div>
				
				<!--Modal para CRUD OBSERVACIONES-->
				<div class="row modal fade" id="modal_crud_check_list_registro_observaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog modal-lg" role="document">
				        <div class="modal-content">

						    <div class="modal-header">
				                <h5 class="modal-title" id="exampleModalLabel"></h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
				                </button>
				            </div>

						  	<form id="form_check_list_registro_observaciones" enctype="multipart/form-data" action="" method="post" onsubmit="return false;">    
				      		    <div class="modal-body">
									<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row">
												<div class="col-lg-2">
			      						    		<div class="form-group form-control-sm">
			      						    			<label for="obs_chl_codigo" class="col-form-label form-control-sm">CODIGO:</label>
			      						    		</div>
												</div>
												<div class="col-lg-2">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="obs_chl_codigo"></select>
			      						    		</div>
												</div>
												<div class="col-lg-8">
			      						    		<div class="form-group form-control-sm">
														<input type="text" readonly class="form-control form-control-sm" id="obs_chl_descripcion">
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
			      						    			<label for="obs_chl_componente" class="col-form-label form-control-sm">COMPONENTE:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="obs_chl_componente"></select>
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
			      						    			<label for="obs_chl_posicion" class="col-form-label form-control-sm">POSICION:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="obs_chl_posicion"></select>
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
			      						    			<label for="obs_chl_falla" class="col-form-label form-control-sm">FALLA:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="obs_chl_falla"></select>
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
			      						    			<label for="obs_chl_accion" class="col-form-label form-control-sm">ACCION:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="obs_chl_accion"></select>
			      						    		</div>
												</div>
											</div>
			      						</div>
									</div>
				      		    </div>
				      		    <div class="modal-footer">
				      		        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
				      		        <button type="button" id="btn_check_list_registrar_observaciones" class="btn btn-dark btn-sm btn_check_list_registrar_observaciones">Registrar</button>
				      		    </div>
				      		</form>    

						</div>
				    </div>
				</div>  			

				<!--Modal para CRUD FALLA EN VIA-->
				<div class="row modal fade" id="modal_crud_check_list_registro_falla_via" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog modal-lg" role="document">
				        <div class="modal-content">

						    <div class="modal-header">
				                <h5 class="modal-title" id="exampleModalLabel"></h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
				                </button>
				            </div>

						  	<form id="form_check_list_registro_falla_via" enctype="multipart/form-data" action="" method="post" onsubmit="return false;">    
				      		    <div class="modal-body">
								  	<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row">
												<div class="col-lg-2">
			      						    		<div class="form-group form-control-sm">
			      						    			<label for="fav_chl_novedad_id" class="col-form-label form-control-sm">NOVEDAD:</label>
			      						    		</div>
												</div>
												<div class="col-lg-5">
			      						    		<div class="form-group form-control-sm">
														<input type="text" readonly class="form-control form-control-sm" id="fav_chl_novedad_id">
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
			      						    			<label for="fav_chl_descripcion_descripcion" class="col-form-label form-control-sm">DESCRIPCION:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
													<div class="form-group shadow-textarea">
						      				            <textarea readonly class="form-control z-depth-1 text-uppercase" id="fav_chl_descripcion_novedad" rows="2" placeholder="escribe algo aqui..." maxlength="250"></textarea>
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
			      						    			<label for="fav_chl_codigo" class="col-form-label form-control-sm">CODIGO:</label>
			      						    		</div>
												</div>
												<div class="col-lg-2">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="fav_chl_codigo"></select>
			      						    		</div>
												</div>
												<div class="col-lg-8">
			      						    		<div class="form-group form-control-sm">
														<input type="text" readonly class="form-control form-control-sm" id="fav_chl_descripcion_codigo"></select>
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
			      						    			<label for="fav_chl_componente" class="col-form-label form-control-sm">COMPONENTE:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="fav_chl_componente"></select>
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
			      						    			<label for="fav_chl_posicion" class="col-form-label form-control-sm">POSICION:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="fav_chl_posicion"></select>
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
			      						    			<label for="fav_chl_falla" class="col-form-label form-control-sm">FALLA:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="fav_chl_falla"></select>
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
			      						    			<label for="fav_chl_accion" class="col-form-label form-control-sm">ACCION:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="fav_chl_accion"></select>
			      						    		</div>
												</div>
											</div>
			      						</div>
									</div>
				      		    </div>
				      		    <div class="modal-footer">
				      		        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
				      		        <button type="button" id="btn_check_list_registrar_falla_via" class="btn btn-dark btn-sm btn_check_list_registrar_falla_via">Registrar</button>
				      		    </div>
				      		</form>    

						</div>
				    </div>
				</div>  			

				<!-- Modal para CRUD LOG Check List-->
				<div class="row modal fade" id="modal_crud_log_check_list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_log_check_lis" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_log_check_list">
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
			<!-- TAB ARBOL DE CHECK LIST DE FLOTA ------------------------------------------->
			<!------------------------------------------------------------------------------->
 			<div class="tab-pane fade" id="nav-arbol_check_list" role="tabpanel" aria-labelledby="nav-arbol_check_list-tab">
				<h5 class="pt-3 pl-3">Arbol de Check List</h5>
				<nav>
	 				<div class="nav nav-tabs" id="nav-tab-arbol" role="tablist">
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent-arbol">
					<!------------------------------------------------------------------------------->
					<!-- TAB CODIGO DE CHECK LIST DE FLOTA ------------------------------------------>
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade show active" id="nav-codigo" role="tabpanel" aria-labelledby="nav-codigo-tab">
						<form id="form_seleccion_codigo" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
							<div class="row align-items-end pb-4 col-sm-12">
								<div class="col-lg-1">
									<div class="form-group">
										<label for="cod_check_list_flota" class="col-form-label form-control-sm">FLOTA</label>
										<select class="form-control form-control-sm" id="cod_check_list_flota"></select>
				   					</div>
			    				</div>
								<div class="col-lg-2">
									<div class="form-group" id="div_btn_seleccion_check_list_codigo">
									</div>
					    		</div> 
							</div>
						</form>
					   	<div class="container-fluid caja">
							<div class="row w-100 p-0 m-0">
						       	<div class="col-lg-12">
						       		<div class="table-responsive" id="div_tabla_check_list_codigo">        
						            </div>
						        </div>
						    </div>  
						</div>   
						<div class="row modal fade" id="modal_crud_check_list_codigo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						    <div class="modal-dialog" role="document">
						        <div class="modal-content">
								    <div class="modal-header">
						                <h5 class="modal-title" id="exampleModalLabel"></h5>
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
						                </button>
						            </div>
								  	<form id="form_check_list_codigo" enctype="multipart/form-data" action="" method="post">    
						      		    <div class="modal-body">
											<div class="row align-items-end">
												<div class="col-lg-6">
						        					<div class="form-group">
														<label for="cod_chl_bus_tipo" class="col-form-label form-control-sm">FLOTA</label>
														<select class="form-control form-control-sm" id="cod_chl_bus_tipo"></select>
							    				   	</div>
					        					</div>
												<div class="col-lg-3">
					      						    <div class="form-group">
					      						    	<label for="cod_chl_orden" class="col-form-label form-control-sm">ORDEN ID</label>
														<input type="number" class="form-control form-control-sm" id="cod_chl_orden">
														</select>
					      						    </div>
					      						</div>
												<div class="col-lg-3">
						  						    <div class="form-group">
														<label for="cod_chl_codigo" class="col-form-label form-control-sm">CODIGO</label>
														<div class="input-group">
															<input type="text" name="cod_chl_codigo" class="form-control form-control-sm" id="cod_chl_codigo">
														</div>
												    </div>               
												</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						      				        <div class="form-group shadow-textarea">
						      				            <label for="cod_chl_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
						      				            <textarea class="form-control z-depth-1 text-uppercase" id="cod_chl_descripcion" rows="7" placeholder="escribe algo aqui..." maxlength="250"></textarea>
						      				        </div>
						      				    </div>
						      		        </div>
						      		    </div>
						      		    <div class="modal-footer">
						      		        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
						      		        <button type="submit" id="btn_guardar_check_list_codigo" class="btn btn-dark btn-sm btn_guardar_check_list_codigo">Guardar</button>
						      		    </div>
						      		</form>    
								</div>
						    </div>
						</div> 
					</div>

					<!------------------------------------------------------------------------------->
					<!-- TAB COMPONENTE DE CHECK LIST DE FLOTA -------------------------------------->
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade" id="nav-componente" role="tabpanel" aria-labelledby="nav-componente-tab">
						<form id="form_seleccion_componente" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
							<div class="row align-items-end pb-4 col-sm-12">
								<div class="col-lg-1">
									<div class="form-group">
										<label for="com_check_list_flota" class="col-form-label form-control-sm">FLOTA</label>
										<select class="form-control form-control-sm" id="com_check_list_flota"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
						        	<div class="form-group">
										<label for="com_check_list_codigo" class="col-form-label form-control-sm">CODIGO DESCRIPCION</label>
										<select class="form-control form-control-sm" id="com_check_list_codigo"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
									<div class="form-group" id="div_btn_seleccion_check_list_componente">

									</div>
					    		</div> 
							</div>
						</form>
					   	<div class="container-fluid caja">
							<div class="row w-100 p-0 m-0">
						       	<div class="col-lg-12">
						       		<div class="table-responsive" id="div_tabla_check_list_componente">        
						            </div>
						        </div>
						    </div>  
						</div>   
						<div class="row modal fade" id="modal_crud_check_list_componente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 						    <div class="modal-dialog" role="document">
						        <div class="modal-content">
								    <div class="modal-header">
						                <h5 class="modal-title" id="exampleModalLabel"></h5>
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
						                </button>
						            </div>
								  	<form id="form_check_list_componente" enctype="multipart/form-data" action="" method="post">    
						      		    <div class="modal-body">
											<div class="row align-items-end">
												<div class="col-lg-6">
						        					<div class="form-group">
														<label for="com_chl_bus_tipo" class="col-form-label form-control-sm">FLOTA</label>
														<select class="form-control form-control-sm" id="com_chl_bus_tipo"></select>
							    				   	</div>
					        					</div>
												<div class="col-lg-6">
						  						    <div class="form-group">
														<label for="com_chl_codigo" class="col-form-label form-control-sm">CODIGO</label>
														<select class="form-control form-control-sm" id="com_chl_codigo"></select>
												    </div>               
												</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						      				        <div class="form-group shadow-textarea">
						      				            <label for="com_chl_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
						      				            <textarea readonly class="form-control z-depth-1 text-uppercase" id="com_chl_descripcion" rows="2"></textarea>
						      				        </div>
						      				    </div>
						      		        </div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						        					<div class="form-group">
														<label for="com_chl_componente" class="col-form-label form-control-sm">COMPONENTE</label>
														<textarea class="form-control form-control-sm z-depth-1 text-uppercase" id="com_chl_componente" rows="2" placeholder="escribe algo aqui..." maxlength="100"></textarea>
							    				   	</div>
					        					</div>
											</div>
										</div>
						      		    <div class="modal-footer">
						      		        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
						      		        <button type="submit" id="btn_guardar_check_list_componente" class="btn btn-dark btn-sm btn_guardar_check_list_componente">Guardar</button>
						      		    </div>
						      		</form>    
								</div>
						    </div>
						</div>  			
					</div>

					<!------------------------------------------------------------------------------->
					<!-- TAB MODO FALLA - ACCION DE CHECK LIST DE FLOTA ----------------------------->
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade" id="nav-falla_accion" role="tabpanel" aria-labelledby="nav-falla_accion-tab">
						<form id="form_seleccion_falla_accion" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
							<div class="row align-items-end pb-4 col-sm-12">
								<div class="col-lg-1">
									<div class="form-group">
										<label for="fal_check_list_flota" class="col-form-label form-control-sm">FLOTA</label>
										<select class="form-control form-control-sm" id="fal_check_list_flota"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
						        	<div class="form-group">
										<label for="fal_check_list_codigo" class="col-form-label form-control-sm">CODIGO DESCRIPCION</label>
										<select class="form-control form-control-sm" id="fal_check_list_codigo"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
						        	<div class="form-group">
										<label for="fal_check_list_componente" class="col-form-label form-control-sm">COMPONENTE</label>
										<select class="form-control form-control-sm" id="fal_check_list_componente"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
									<div class="form-group" id="div_btn_seleccion_check_list_falla_accion">
									</div>
					    		</div> 
							</div>
						</form>
					   	<div class="container-fluid caja">
							<div class="row w-100 p-0 m-0">
						       	<div class="col-lg-12">
						       		<div class="table-responsive" id="div_tabla_check_list_falla_accion">        
						            </div>
						        </div>
						    </div>  
						</div>   
						<div class="row modal fade" id="modal_crud_check_list_falla_accion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 						    <div class="modal-dialog" role="document">
						        <div class="modal-content">
								    <div class="modal-header">
						                <h5 class="modal-title" id="exampleModalLabel"></h5>
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
						                </button>
						            </div>
								  	<form id="form_check_list_falla_accion" enctype="multipart/form-data" action="" method="post">    
						      		    <div class="modal-body">
											<div class="row align-items-end">
												<div class="col-lg-6">
						        					<div class="form-group">
														<label for="fal_chl_bus_tipo" class="col-form-label form-control-sm">FLOTA</label>
														<select class="form-control form-control-sm" id="fal_chl_bus_tipo"></select>
							    				   	</div>
					        					</div>
												<div class="col-lg-6">
						  						    <div class="form-group">
														<label for="fal_chl_codigo" class="col-form-label form-control-sm">CODIGO</label>
														<select class="form-control form-control-sm" id="fal_chl_codigo"></select>
												    </div>               
												</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						      				        <div class="form-group shadow-textarea">
						      				            <label for="fal_chl_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
						      				            <textarea readonly class="form-control z-depth-1 text-uppercase" id="fal_chl_descripcion" rows="2"></textarea>
						      				        </div>
						      				    </div>
						      		        </div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						        					<div class="form-group">
														<label for="fal_chl_componente" class="col-form-label form-control-sm">COMPONENTE</label>
														<select class="form-control form-control-sm" id="fal_chl_componente" ></select>
							    				   	</div>
					        					</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-6">
						  						    <div class="form-group">
														<label for="fal_chl_falla" class="col-form-label form-control-sm">FALLA</label>
														<select class="form-control form-control-sm" id="fal_chl_falla"></select>
												    </div>               
												</div>
												<div class="col-lg-6">
						        					<div class="form-group">
														<label for="fal_chl_accion" class="col-form-label form-control-sm">ACCION</label>
														<select class="form-control form-control-sm" id="fal_chl_accion"></select>
							    				   	</div>
					        					</div>
											</div>
										</div>
						      		    <div class="modal-footer">
						      		        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
						      		        <button type="submit" id="btn_guardar_check_list_falla_accion" class="btn btn-dark btn-sm btn_guardar_check_list_falla_accion">Guardar</button>
						      		    </div>
						      		</form>    
								</div>
						    </div>
						</div>  			
					</div>

					<!------------------------------------------------------------------------------->
					<!-- TAB POSICION DE CHECK LIST DE FLOTA ---------------------------------------->
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade" id="nav-posicion" role="tabpanel" aria-labelledby="nav-posicion-tab">
						<form id="form_seleccion_posicion" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
							<div class="row align-items-end pb-4 col-sm-12">
								<div class="col-lg-1">
									<div class="form-group">
										<label for="pos_check_list_flota" class="col-form-label form-control-sm">FLOTA</label>
										<select class="form-control form-control-sm" id="pos_check_list_flota"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
						        	<div class="form-group">
										<label for="pos_check_list_codigo" class="col-form-label form-control-sm">CODIGO DESCRIPCION</label>
										<select class="form-control form-control-sm" id="pos_check_list_codigo"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
						        	<div class="form-group">
										<label for="pos_check_list_componente" class="col-form-label form-control-sm">COMPONENTE</label>
										<select class="form-control form-control-sm" id="pos_check_list_componente"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
									<div class="form-group" id="div_btn_seleccion_check_list_posicion">
									</div>
					    		</div> 
							</div>
						</form>
					   	<div class="container-fluid caja">
							<div class="row w-100 p-0 m-0">
						       	<div class="col-lg-12">
						       		<div class="table-responsive" id="div_tabla_check_list_posicion">
						            </div>
						        </div>
						    </div>  
						</div>   
						<div class="row modal fade" id="modal_crud_check_list_posicion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						    <div class="modal-dialog" role="document">
						        <div class="modal-content">
								    <div class="modal-header">
						                <h5 class="modal-title" id="exampleModalLabel"></h5>
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
						                </button>
						            </div>
								  	<form id="form_check_list_posicion" enctype="multipart/form-data" action="" method="post">    
						      		    <div class="modal-body">
											<div class="row align-items-end">
												<div class="col-lg-6">
						        					<div class="form-group">
														<label for="pos_chl_bus_tipo" class="col-form-label form-control-sm">FLOTA</label>
														<select class="form-control form-control-sm" id="pos_chl_bus_tipo"></select>
							    				   	</div>
					        					</div>
												<div class="col-lg-6">
						  						    <div class="form-group">
														<label for="pos_chl_codigo" class="col-form-label form-control-sm">CODIGO</label>
														<select class="form-control form-control-sm" id="pos_chl_codigo"></select>
												    </div>               
												</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						      				        <div class="form-group shadow-textarea">
						      				            <label for="pos_chl_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
						      				            <textarea readonly class="form-control z-depth-1 text-uppercase" id="pos_chl_descripcion" rows="2"></textarea>
						      				        </div>
						      				    </div>
						      		        </div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						        					<div class="form-group">
														<label for="pos_chl_componente" class="col-form-label form-control-sm">COMPONENTE</label>
														<select class="form-control form-control-sm" id="pos_chl_componente"></select>
							    				   	</div>
					        					</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						  						    <div class="form-group">
														<label for="pos_chl_posicion" class="col-form-label form-control-sm">POSICION</label>
														<input type="text" class="form-control form-control-sm text-uppercase" id="pos_chl_posicion" maxlength="100">
												    </div>               
												</div>
											</div>
										</div>
						      		    <div class="modal-footer">
						      		        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
						      		        <button type="submit" id="btn_guardar_check_list_posicion" class="btn btn-dark btn-sm btn_guardar_check_list_posicion">Guardar</button>
						      		    </div>
						      		</form>    
								</div>
						    </div>
						</div>  			
					</div>
					

				</div>
			</div>

			<!------------------------------------------------------------------------------->
			<!-- TAB ARBOL DE FALLAS EN VIA ------------------------------------------------->
			<!------------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-arbol_falla_via" role="tabpanel" aria-labelledby="nav-arbol_falla_via-tab">
				<h5 class="pt-3 pl-3">Arbol de Falla en Vía</h5>
				<nav>
	 				<div class="nav nav-tabs" id="nav-tab-arbol_falla_via" role="tablist">
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent-arbol_falla_via">
					<!------------------------------------------------------------------------------->
					<!-- TAB CODIGO DE FALLAS EN VIA ------------------------------------------------>
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade show active" id="nav-codigo_falla_via" role="tabpanel" aria-labelledby="nav-codigo_falla_via-tab">
						<form id="form_seleccion_codigo_falla_via" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
							<div class="row align-items-end pb-4 col-sm-12">
								<div class="col-lg-1">
									<div class="form-group">
										<label for="cod_falla_via_flota" class="col-form-label form-control-sm">FLOTA</label>
										<select class="form-control form-control-sm" id="cod_falla_via_flota"></select>
				   					</div>
			    				</div>
								<div class="col-lg-2">
									<div class="form-group" id="div_btn_seleccion_falla_via_codigo">
									</div>
					    		</div> 
							</div>
						</form>
					   	<div class="container-fluid caja">
							<div class="row w-100 p-0 m-0">
						       	<div class="col-lg-12">
						       		<div class="table-responsive" id="div_tabla_falla_via_codigo">        
						            </div>
						        </div>
						    </div>  
						</div>   
						<div class="row modal fade" id="modal_crud_falla_via_codigo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						    <div class="modal-dialog" role="document">
						        <div class="modal-content">
								    <div class="modal-header">
						                <h5 class="modal-title" id="exampleModalLabel"></h5>
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
						                </button>
						            </div>
								  	<form id="form_falla_via_codigo" enctype="multipart/form-data" action="" method="post">    
						      		    <div class="modal-body">
											<div class="row align-items-end">
												<div class="col-lg-6">
						        					<div class="form-group">
														<label for="cod_fav_bus_tipo" class="col-form-label form-control-sm">FLOTA</label>
														<select class="form-control form-control-sm" id="cod_fav_bus_tipo"></select>
							    				   	</div>
					        					</div>
												<div class="col-lg-3">
					      						    <div class="form-group">
					      						    	<label for="cod_fav_orden" class="col-form-label form-control-sm">ORDEN ID</label>
														<input type="number" class="form-control form-control-sm" id="cod_fav_orden">
														</select>
					      						    </div>
					      						</div>
												<div class="col-lg-3">
						  						    <div class="form-group">
														<label for="cod_fav_codigo" class="col-form-label form-control-sm">CODIGO</label>
														<div class="input-group">
															<input type="text" class="form-control form-control-sm" id="cod_fav_codigo">
														</div>
												    </div>               
												</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						      				        <div class="form-group shadow-textarea">
						      				            <label for="cod_fav_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
						      				            <textarea class="form-control z-depth-1 text-uppercase" id="cod_fav_descripcion" rows="7" placeholder="escribe algo aqui..." maxlength="250"></textarea>
						      				        </div>
						      				    </div>
						      		        </div>
						      		    </div>
						      		    <div class="modal-footer">
						      		        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
						      		        <button type="submit" id="btn_guardar_falla_via_codigo" class="btn btn-dark btn-sm btn_guardar_falla_via_codigo">Guardar</button>
						      		    </div>
						      		</form>    
								</div>
						    </div>
						</div> 
					</div>

					<!------------------------------------------------------------------------------->
					<!-- TAB COMPONENTE DE FALLA EN VIA --------------------------------------------->
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade" id="nav-componente_falla_via" role="tabpanel" aria-labelledby="nav-componente_falla_via-tab">
						<form id="form_seleccion_componente_falla_via" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
							<div class="row align-items-end pb-4 col-sm-12">
								<div class="col-lg-1">
									<div class="form-group">
										<label for="com_falla_via_flota" class="col-form-label form-control-sm">FLOTA</label>
										<select class="form-control form-control-sm" id="com_falla_via_flota"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
						        	<div class="form-group">
										<label for="com_falla_via_codigo" class="col-form-label form-control-sm">CODIGO DESCRIPCION</label>
										<select class="form-control form-control-sm" id="com_falla_via_codigo"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
									<div class="form-group" id="div_btn_seleccion_falla_via_componente">

									</div>
					    		</div> 
							</div>
						</form>
					   	<div class="container-fluid caja">
							<div class="row w-100 p-0 m-0">
						       	<div class="col-lg-12">
						       		<div class="table-responsive" id="div_tabla_falla_via_componente">        
						            </div>
						        </div>
						    </div>  
						</div>   
						<div class="row modal fade" id="modal_crud_falla_via_componente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 						    <div class="modal-dialog" role="document">
						        <div class="modal-content">
								    <div class="modal-header">
						                <h5 class="modal-title" id="exampleModalLabel"></h5>
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
						                </button>
						            </div>
								  	<form id="form_falla_via_componente" enctype="multipart/form-data" action="" method="post">    
						      		    <div class="modal-body">
											<div class="row align-items-end">
												<div class="col-lg-6">
						        					<div class="form-group">
														<label for="com_fav_bus_tipo" class="col-form-label form-control-sm">FLOTA</label>
														<select class="form-control form-control-sm" id="com_fav_bus_tipo"></select>
							    				   	</div>
					        					</div>
												<div class="col-lg-6">
						  						    <div class="form-group">
														<label for="com_fav_codigo" class="col-form-label form-control-sm">CODIGO</label>
														<select class="form-control form-control-sm" id="com_fav_codigo"></select>
												    </div>               
												</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						      				        <div class="form-group shadow-textarea">
						      				            <label for="com_fav_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
						      				            <textarea readonly class="form-control z-depth-1 text-uppercase" id="com_fav_descripcion" rows="2"></textarea>
						      				        </div>
						      				    </div>
						      		        </div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						        					<div class="form-group">
														<label for="com_fav_componente" class="col-form-label form-control-sm">COMPONENTE</label>
														<textarea class="form-control form-control-sm z-depth-1 text-uppercase" id="com_fav_componente" rows="2" placeholder="escribe algo aqui..." maxlength="100"></textarea>
							    				   	</div>
					        					</div>
											</div>
										</div>
						      		    <div class="modal-footer">
						      		        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
						      		        <button type="submit" id="btn_guardar_falla_via_componente" class="btn btn-dark btn-sm btn_guardar_falla_via_componente">Guardar</button>
						      		    </div>
						      		</form>    
								</div>
						    </div>
						</div>  			
					</div>

					<!------------------------------------------------------------------------------->
					<!-- TAB MODO FALLA - ACCION DE FALLAS EN VIA ----------------------------------->
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade" id="nav-falla_accion_falla_via" role="tabpanel" aria-labelledby="nav-falla_accion_falla_via-tab">
						<form id="form_seleccion_falla_accion_falla_via" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
							<div class="row align-items-end pb-4 col-sm-12">
								<div class="col-lg-1">
									<div class="form-group">
										<label for="fal_falla_via_flota" class="col-form-label form-control-sm">FLOTA</label>
										<select class="form-control form-control-sm" id="fal_falla_via_flota"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
						        	<div class="form-group">
										<label for="fal_falla_via_codigo" class="col-form-label form-control-sm">CODIGO DESCRIPCION</label>
										<select class="form-control form-control-sm" id="fal_falla_via_codigo"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
						        	<div class="form-group">
										<label for="fal_falla_via_componente" class="col-form-label form-control-sm">COMPONENTE</label>
										<select class="form-control form-control-sm" id="fal_falla_via_componente"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
									<div class="form-group" id="div_btn_seleccion_falla_via_falla_accion">
									</div>
					    		</div> 
							</div>
						</form>
					   	<div class="container-fluid caja">
							<div class="row w-100 p-0 m-0">
						       	<div class="col-lg-12">
						       		<div class="table-responsive" id="div_tabla_falla_via_falla_accion">        
						            </div>
						        </div>
						    </div>  
						</div>   
						<div class="row modal fade" id="modal_crud_falla_via_falla_accion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 						    <div class="modal-dialog" role="document">
						        <div class="modal-content">
								    <div class="modal-header">
						                <h5 class="modal-title" id="exampleModalLabel"></h5>
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
						                </button>
						            </div>
								  	<form id="form_falla_via_falla_accion" enctype="multipart/form-data" action="" method="post">    
						      		    <div class="modal-body">
											<div class="row align-items-end">
												<div class="col-lg-6">
						        					<div class="form-group">
														<label for="fal_fav_bus_tipo" class="col-form-label form-control-sm">FLOTA</label>
														<select class="form-control form-control-sm" id="fal_fav_bus_tipo"></select>
							    				   	</div>
					        					</div>
												<div class="col-lg-6">
						  						    <div class="form-group">
														<label for="fal_fav_codigo" class="col-form-label form-control-sm">CODIGO</label>
														<select class="form-control form-control-sm" id="fal_fav_codigo"></select>
												    </div>               
												</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						      				        <div class="form-group shadow-textarea">
						      				            <label for="fal_fav_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
						      				            <textarea readonly class="form-control z-depth-1 text-uppercase" id="fal_fav_descripcion" rows="2"></textarea>
						      				        </div>
						      				    </div>
						      		        </div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						        					<div class="form-group">
														<label for="fal_fav_componente" class="col-form-label form-control-sm">COMPONENTE</label>
														<select class="form-control form-control-sm" id="fal_fav_componente" ></select>
							    				   	</div>
					        					</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-6">
						  						    <div class="form-group">
														<label for="fal_fav_falla" class="col-form-label form-control-sm">FALLA</label>
														<select class="form-control form-control-sm" id="fal_fav_falla"></select>
												    </div>               
												</div>
												<div class="col-lg-6">
						        					<div class="form-group">
														<label for="fal_fav_accion" class="col-form-label form-control-sm">ACCION</label>
														<select class="form-control form-control-sm" id="fal_fav_accion"></select>
							    				   	</div>
					        					</div>
											</div>
										</div>
						      		    <div class="modal-footer">
						      		        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
						      		        <button type="submit" id="btn_guardar_falla_via_falla_accion" class="btn btn-dark btn-sm btn_guardar_falla_via_falla_accion">Guardar</button>
						      		    </div>
						      		</form>    
								</div>
						    </div>
						</div>  			
					</div>

					<!------------------------------------------------------------------------------->
					<!-- TAB POSICION DE FALLAS EN VIA ---------------------------------------------->
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade" id="nav-posicion_falla_via" role="tabpanel" aria-labelledby="nav-posicion_falla_via-tab">
						<form id="form_seleccion_posicion_falla_via" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
							<div class="row align-items-end pb-4 col-sm-12">
								<div class="col-lg-1">
									<div class="form-group">
										<label for="pos_falla_via_flota" class="col-form-label form-control-sm">FLOTA</label>
										<select class="form-control form-control-sm" id="pos_falla_via_flota"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
						        	<div class="form-group">
										<label for="pos_falla_via_codigo" class="col-form-label form-control-sm">CODIGO DESCRIPCION</label>
										<select class="form-control form-control-sm" id="pos_falla_via_codigo"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
						        	<div class="form-group">
										<label for="pos_falla_via_componente" class="col-form-label form-control-sm">COMPONENTE</label>
										<select class="form-control form-control-sm" id="pos_falla_via_componente"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
									<div class="form-group" id="div_btn_seleccion_falla_via_posicion">
									</div>
					    		</div> 
							</div>
						</form>
					   	<div class="container-fluid caja">
							<div class="row w-100 p-0 m-0">
						       	<div class="col-lg-12">
						       		<div class="table-responsive" id="div_tabla_falla_via_posicion">
						            </div>
						        </div>
						    </div>  
						</div>   
						<div class="row modal fade" id="modal_crud_falla_via_posicion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						    <div class="modal-dialog" role="document">
						        <div class="modal-content">
								    <div class="modal-header">
						                <h5 class="modal-title" id="exampleModalLabel"></h5>
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
						                </button>
						            </div>
								  	<form id="form_falla_via_posicion" enctype="multipart/form-data" action="" method="post">    
						      		    <div class="modal-body">
											<div class="row align-items-end">
												<div class="col-lg-6">
						        					<div class="form-group">
														<label for="pos_fav_bus_tipo" class="col-form-label form-control-sm">FLOTA</label>
														<select class="form-control form-control-sm" id="pos_fav_bus_tipo"></select>
							    				   	</div>
					        					</div>
												<div class="col-lg-6">
						  						    <div class="form-group">
														<label for="pos_fav_codigo" class="col-form-label form-control-sm">CODIGO</label>
														<select class="form-control form-control-sm" id="pos_fav_codigo"></select>
												    </div>               
												</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						      				        <div class="form-group shadow-textarea">
						      				            <label for="pos_fav_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
						      				            <textarea readonly class="form-control z-depth-1 text-uppercase" id="pos_fav_descripcion" rows="2"></textarea>
						      				        </div>
						      				    </div>
						      		        </div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						        					<div class="form-group">
														<label for="pos_fav_componente" class="col-form-label form-control-sm">COMPONENTE</label>
														<select class="form-control form-control-sm" id="pos_fav_componente"></select>
							    				   	</div>
					        					</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						  						    <div class="form-group">
														<label for="pos_fav_posicion" class="col-form-label form-control-sm">POSICION</label>
														<input type="text" class="form-control form-control-sm text-uppercase" id="pos_fav_posicion" maxlength="100">
												    </div>               
												</div>
											</div>
										</div>
						      		    <div class="modal-footer">
						      		        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
						      		        <button type="submit" id="btn_guardar_falla_via_posicion" class="btn btn-dark btn-sm btn_guardar_falla_via_posicion">Guardar</button>
						      		    </div>
						      		</form>    
								</div>
						    </div>
						</div>  			
					</div>
					

				</div>
			</div>

			<!------------------------------------------------------------------------------->
			<!-- TAB REPORTE DE FALLAS CHECK LIST DE FLOTA ---------------------------------->
			<!------------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-reporte_falla" role="tabpanel" aria-labelledby="nav-reporte_falla-tab">
				<form id="form_seleccion_reporte_falla" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
				<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
							<div class="form-group">
								<label for="reporte_falla_fecha_inicio" class="col-form-label form-control-sm">F.INICIO</label>
								<input type="date" class="form-control form-control-sm" id="reporte_falla_fecha_inicio" placeholder="dd/mm/aaaaa">
					       	</div>
			        	</div>
						<div class="col-lg-1">
							<div class="form-group">
								<label for="reporte_falla_fecha_termino" class="col-form-label form-control-sm">F.TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="reporte_falla_fecha_termino" placeholder="dd/mm/aaaaa">
					       	</div>
			        	</div>
						<div class="col-sm-3">
							<div class="form-group" id="div_btn_seleccion_reporte_falla">
								
							</div>
						</div>
					</div>   
				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tabla_reporte_falla">        
				            </div>
				        </div>
				    </div>  
				</div>   

			</div>

			<!------------------------------------------------------------------------------->
			<!-- TAB AJUSTE DE CHECK LIST --------------------------------------------------->
			<!------------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-ajustes_check_list" role="tabpanel" aria-labelledby="nav-ajustes_check_list-tab">
				<h5 class="pt-3 pl-3">Variables</h5>
				<nav>
	 				<div class="nav nav-tabs" id="nav-tab-ajustes_check_list" role="tablist">
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent-ajustes_check_list">
					<!------------------------------------------------------------------------------->
					<!-- TAB AJUSTE VARIABLE DE USUARIO DE CHECK LIST DE FLOTA ---------------------->
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade show active" id="nav-ajustes_check_list_usuario" role="tabpanel" aria-labelledby="nav-ajustes_check_list_usuario-tab">
						<section class="container-fluid py-3">
							<button id="btn_nuevo_tc_check_list_usuario" type="button" class="btn btn-secondary btn-sm btn_nuevo_tc_check_list_usuario" data-toggle="modal">+ Nuevo</button>  
						</section>
						<div class="row p-3">
							<div class="col-auto m-0">
								<div class="table-responsive" id="div_tabla_tc_check_list_usuario">
								</div>
							</div>
						</div>
						<!--Modal para CRUD-->
						<div class="row modal fade" id="modal_crud_tc_check_list_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel"></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form id="form_tc_check_list_usuario">
						  				<div class="modal-body">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
												  		<label for="tc_check_list_id_usuario" class="col-form-label form-control-sm">ID</label>
												   		<input type="text" readonly class="form-control form-control-sm" id="tc_check_list_id_usuario">
												 	</div>
											 	</div>
											 	<div class="col-lg-6">
											  		<div class="form-group">
														<label for="chl_cat1_usuario" class="col-form-label form-control-sm">CATEGORIA 1</label>
												   		<input type="text" class="form-control form-control-sm text-uppercase" id="chl_cat1_usuario" maxlength="45">
													</div> 
											 	</div>    
											</div>
							  				<div class="row"> 
												<div class="col-lg-6">
											  		<div class="form-group">
														<label for="chl_cat2_usuario" class="col-form-label form-control-sm">CATEGORIA 2</label>
														<input type="text" class="form-control form-control-sm text-uppercase" id="chl_cat2_usuario" maxlength="45">
													</div> 
								  				</div>
											</div>
											<div class="row"> 
								  				<div class="col-lg-12">
											  		<div class="form-group">
														<label for="chl_cat3_usuario" class="col-form-label form-control-sm">CATEGORIA 3</label>
												  		<textarea class="form-control z-depth-1 text-uppercase" id="chl_cat3_usuario" rows="7" placeholder="escribe algo aqui..." maxlength="250"></textarea>
													</div>               
								   				</div>
							  				</div>
										</div>
						  				<div class="modal-footer">
							  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
							  				<button type="submit" id="btn_guardar_tc_check_list_usuario" class="btn btn-dark btn-sm btn_guardar_tc_check_list_usuario">Guardar</button>
						  				</div>
									</form>    
								</div>
							</div>
						</div>  
					</div>
					<!------------------------------------------------------------------------------->
					<!-- TAB AJUSTE VARIABLE DE SISTEMA DE INSPECCION DE FLOTA ---------------------->
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade" id="nav-ajustes_check_list_sistema" role="tabpanel" aria-labelledby="nav-ajustes_check_list_sistema-tab">
						<section class="container-fluid py-3">
							<button id="btn_nuevo_tc_check_list_sistema" type="button" class="btn btn-secondary btn-sm btn_nuevo_tc_check_list_sistema" data-toggle="modal">+ Nuevo</button>  
						</section>
						<div class="row p-3">
							<div class="col-auto m-0">
								<div class="table-responsive" id="div_tabla_tc_check_list_sistema">
								</div>
							</div>
						</div>
						<div class="row modal fade" id="modal_crud_tc_check_list_sistema" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel"></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form id="form_tc_check_list_sistema">
						  				<div class="modal-body">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
												  		<label for="tc_check_list_id_sistema" class="col-form-label form-control-sm">ID</label>
												   		<input type="text" readonly class="form-control form-control-sm" id="tc_check_list_id_sistema">
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
							  				<button type="submit" id="btn_guardar_tc_check_list_sistema" class="btn btn-dark btn-sm btn_guardar_tc_check_list_sistema">Guardar</button>
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