<!-- 2.2 CONTENIDO DE MODULO -->
<div id="contenido" class="my-contenido-con-sidebar  p-0">

	<nav class="navbar navbar-light bg-light p-0">
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
				<div class="col-4 text-right">
					<a class="navbar-brand text-muted" href="Module/inspeccion_flota/View/local_view_ayuda.php" target="_blank">
						<i class="bi bi-question-circle-fill" title="Ayuda">
							<svg style="color: blue" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/></svg>
						</i>
					</a>
				</div>
			</div>
		</div>
	</nav>

	<!-- Contenido para el Modulo -->
	<div class="my-contenidoModulo container-fluid pl-0 pr-0 ml-0 mr-0">

		<nav>
	 		<div class="nav nav-tabs" id="nav-tab-inspeccion_flota" role="tablist">
				<!-- PHP Accesos CreacionTabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">
			<!------------------------------------------------------------------------------->
	  		<!-- TAB LISTADO INSPECCION DE FLOTA  ------------------------------------------->
			<!------------------------------------------------------------------------------->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<form id="form_seleccion_inspeccion_flota" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
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
						<div class="col-lg-4">             	
							<div class="form-group" id="div_btn_seleccion_inspeccion">
								<!-- PHP Accesos BotonesFormulario -->
							</div>
			       		</div> 

					</div>
				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tabla_inspeccion">        
								<!-- PHP Accesos CreacionTablas -->
				            </div>
				        </div>
				    </div>  
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modal_crud_inspeccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog" role="document">
			        	<div class="modal-content">
						    <div class="modal-header">
				                <h5 class="modal-title" id="exampleModalLabel"></h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				                </button>
			    	        </div>
						  	<form id="form_inspeccion">    
				      		    <div class="modal-body">
				      		        <div class="row">
				      		            <div class="col-lg-4">
					  		                <div class="form-group">
							                  	<label for="insp_fecha_programada" class="col-form-label form-control-sm">FECHA PROG.</label>
							                   	<input type="date" class="form-control form-control-sm" id="insp_fecha_programada">
						    	           	</div>
			      		            	</div>
										<div class="col-lg-8">
						                  	<div class="form-group">
						                   		<label for="insp_bus_tipo" class="col-form-label form-control-sm">FLOTA</label>
						                   		<select class="form-control form-control-sm" id="insp_bus_tipo">
												</select>
				  		                	</div>
			      		            	</div>
			      		    	    </div>
			      		        	<div class="row"> 
										<div class="col-lg-6">
					  		                <div class="form-group">
							                	<label for="insp_seleccion_buses" class="col-form-label form-control-sm">SELECCION BUSES</label>
												<select class="form-control form-control-sm" id="insp_seleccion_buses">

												</select>
				  			                </div> 
			      		        		</div>
			      		    	    </div>
									
									<div class="row d-md-flex" id="div_seleccion_buses">
									</div>
								</div>
			      		    	<div class="modal-footer">
			      		        	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
			      		        	<button type="submit" id="btn_crear_inspeccion" class="btn btn-dark">Generar</button>
			      		    	</div>
			      			</form>    
			        	</div>
			    	</div>
				</div>  			
			</div>

			<!------------------------------------------------------------------------------->
			<!-- TAB REGISTRO INSPECCION FLOTA ---------------------------------------------->
			<!------------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<form id="form_seleccion_inspeccion_registro" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col col-lg-1 col-sm-2">
				        	<div class="form-group">
								<label for="reg_inspeccion_id" class="col-form-label form-control-sm">INSP.ID</label>
								<input type="text" class="form-control form-control-sm" id="reg_inspeccion_id">
					       	</div>
			        	</div>
						<div class="col col-lg-1 col-sm-2">
				        	<div class="form-group">
								<label for="reg_inspeccion_bus" class="col-form-label form-control-sm">BUS</label>
								<select class="form-control form-control-sm" id="reg_inspeccion_bus"></select>
					       	</div>
			        	</div>
						<div class="col col-lg-1 col-sm-2">
							<div class="form-group" id="div_btn_seleccion_inspeccion_registro">
								
							</div>
						</div>
					</div>   
				</form>
	
				<div class="row p-1">
					<div class="col-auto m-0">
    			    	<div class="col-md-8 col-sm-12 right_box">
    			        	<div class="row">
    			            	<div class="card-columns" id="div_card_columns_inspeccion_registro">
    			            	</div>
    			        	</div>
							<div class="row justify-content-end" id="div_btn_enviar_inspeccion_registro">
	   			        	</div>
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modal_crud_inspeccion_registro_posicion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog modal-lg" role="document">
				        <div class="modal-content">

						    <div class="modal-header">
				                <h5 class="modal-title" id="exampleModalLabel"></h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
				                </button>
				            </div>

						  	<form id="form_inspeccion_registro_posicion" enctype="multipart/form-data" action="" method="post" onsubmit="return false;">    
				      		    <div class="modal-body">
								  	<div class="row d-flex justify-content-araound">
										<div class="col-lg-12">
											<div class="row">
												<div class="col-lg-2">
			      						    		<div class="form-group form-control-sm">
			      						    			<label for="reg_insp_componente" class="col-form-label form-control-sm">COMPONENTE:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="reg_insp_componente"></select>
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
			      						    			<label for="reg_insp_posicion" class="col-form-label form-control-sm">POSICION:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="reg_insp_posicion"></select>
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
			      						    			<label for="reg_insp_falla" class="col-form-label form-control-sm">FALLA:</label>
			      						    		</div>
												</div>
												<div class="col-lg-10">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="reg_insp_falla"></select>
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
			      						    			<label for="reg_insp_accion" class="col-form-label form-control-sm">ACCION:</label>
			      						    		</div>
												</div>
												<div class="col-lg-8">
			      						    		<div class="form-group form-control-sm">
														<select class="form-control form-control-sm" id="reg_insp_accion"></select>
			      						    		</div>
												</div>
												<div class="col-lg-2">
			      						    		<div class="form-group form-control-sm">
														<button type="button" id="btn_agregar_inspeccion_registro_posicion" class="btn btn-dark btn-sm btn_agregar_inspeccion_registro_posicion">+Agregar</button>
			      						    		</div>
												</div>
											</div>
			      						</div>
									</div>

									<div class="container-fluid caja">
										<div class="row w-100 p-0 m-0">
				    					   	<div class="col-lg-12">
									       		<div class="table-responsive" id="div_tabla_inspeccion_registro_posicion">        
													<!-- PHP Accesos CreacionTablas -->
									            </div>
				    					    </div>
									    </div>  
									</div>
				      		    </div>
				      		</form>    

						</div>
				    </div>
				</div>  			

			</div>

			<!------------------------------------------------------------------------------->
			<!-- TAB ARBOL DE INSPECCION DE FLOTA ------------------------------------------>
			<!------------------------------------------------------------------------------->
 			<div class="tab-pane fade" id="nav-arbol_inspeccion_flota" role="tabpanel" aria-labelledby="nav-arbol_inspeccion_flota-tab">

				<h5 class="pt-3 pl-3">Arbol de Inspección</h5>
				<nav>
	 				<div class="nav nav-tabs" id="nav-tab-arbol" role="tablist">
						<!-- PHP Accesos CreacionTabs -->
					</div>
				</nav>
				
				<div class="tab-content" id="nav-tabContent-arbol">

					<!------------------------------------------------------------------------------->
					<!-- TAB CODIGO DE INSPECCION DE FLOTA ------------------------------------------>
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade show active" id="nav-codigo" role="tabpanel" aria-labelledby="nav-codigo-tab">
						<form id="form_seleccion_codigo" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
							<div class="row align-items-end pb-4 col-sm-12">
								<div class="col-lg-1">
									<div class="form-group">
										<label for="cod_inspeccion_flota" class="col-form-label form-control-sm">FLOTA</label>
										<select class="form-control form-control-sm" id="cod_inspeccion_flota"></select>
				   					</div>
			    				</div>
								<div class="col-lg-2">
									<div class="form-group" id="div_btn_seleccion_inspeccion_codigo">

									</div>
					    		</div> 
							</div>
						</form>

					   	<div class="container-fluid caja">
							<div class="row w-100 p-0 m-0">
						       	<div class="col-lg-12">
						       		<div class="table-responsive" id="div_tabla_inspeccion_codigo">        
										<!-- PHP Accesos CreacionTablas -->
						            </div>
						        </div>
						    </div>  
						</div>   

						<!--Modal para CRUD-->
						<div class="row modal fade" id="modal_crud_inspeccion_codigo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						    <div class="modal-dialog" role="document">
						        <div class="modal-content">
								    <div class="modal-header">
						                <h5 class="modal-title" id="exampleModalLabel"></h5>
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
						                </button>
						            </div>
								  	<form id="form_inspeccion_codigo" enctype="multipart/form-data" action="" method="post">    
						      		    <div class="modal-body">
											<div class="row align-items-end">
												<div class="col-lg-6">
						        					<div class="form-group">
														<label for="cod_insp_bus_tipo" class="col-form-label form-control-sm">FLOTA</label>
														<select class="form-control form-control-sm" id="cod_insp_bus_tipo"></select>
							    				   	</div>
					        					</div>
												<div class="col-lg-3">
					      						    <div class="form-group">
					      						    	<label for="cod_insp_orden" class="col-form-label form-control-sm">ORDEN ID</label>
														<input type="number" class="form-control form-control-sm" id="cod_insp_orden">
														</select>
					      						    </div>
					      						</div>
												<div class="col-lg-3">
						  						    <div class="form-group">
														<label for="cod_insp_codigo" class="col-form-label form-control-sm">CODIGO</label>
														<div class="input-group">
															<input type="text" name="cod_ins_codigo" class="form-control form-control-sm" id="cod_insp_codigo">
														</div>
												    </div>               
												</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						      				        <div class="form-group shadow-textarea">
						      				            <label for="cod_insp_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
						      				            <textarea class="form-control z-depth-1 text-uppercase" id="cod_insp_descripcion" rows="7" placeholder="escribe algo aqui..." maxlength="250"></textarea>
						      				        </div>
						      				    </div>
						      		        </div>
						      		    </div>
						      		    <div class="modal-footer">
						      		        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
						      		        <button type="submit" id="btn_guardar_inspeccion_codigo" class="btn btn-dark btn-sm btn_guardar_inspeccion_codigo">Guardar</button>
						      		    </div>
						      		</form>    
								</div>
						    </div>
						</div> 
					</div>

					<!------------------------------------------------------------------------------->
					<!-- TAB COMPONENTE DE INSPECCION DE FLOTA -------------------------------------->
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade" id="nav-componente" role="tabpanel" aria-labelledby="nav-componente-tab">
						<form id="form_seleccion_componente" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
							<div class="row align-items-end pb-4 col-sm-12">
								<div class="col-lg-1">
									<div class="form-group">
										<label for="com_inspeccion_flota" class="col-form-label form-control-sm">FLOTA</label>
										<select class="form-control form-control-sm" id="com_inspeccion_flota"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
						        	<div class="form-group">
										<label for="com_inspeccion_codigo" class="col-form-label form-control-sm">CODIGO DESCRIPCION</label>
										<select class="form-control form-control-sm" id="com_inspeccion_codigo"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
									<div class="form-group" id="div_btn_seleccion_inspeccion_componente">

									</div>
					    		</div> 
							</div>
						</form>

					   	<div class="container-fluid caja">
							<div class="row w-100 p-0 m-0">
						       	<div class="col-lg-12">
						       		<div class="table-responsive" id="div_tabla_inspeccion_componente">        
										<!-- PHP Accesos CreacionTablas -->
						            </div>
						        </div>
						    </div>  
						</div>   

						<!--Modal para CRUD-->
						<div class="row modal fade" id="modal_crud_inspeccion_componente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 						    <div class="modal-dialog" role="document">
						        <div class="modal-content">
								    <div class="modal-header">
						                <h5 class="modal-title" id="exampleModalLabel"></h5>
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
						                </button>
						            </div>
								  	<form id="form_inspeccion_componente" enctype="multipart/form-data" action="" method="post">    
						      		    <div class="modal-body">
											<div class="row align-items-end">
												<div class="col-lg-6">
						        					<div class="form-group">
														<label for="com_insp_bus_tipo" class="col-form-label form-control-sm">FLOTA</label>
														<select class="form-control form-control-sm" id="com_insp_bus_tipo"></select>
							    				   	</div>
					        					</div>
												<div class="col-lg-6">
						  						    <div class="form-group">
														<label for="com_insp_codigo" class="col-form-label form-control-sm">CODIGO</label>
														<select class="form-control form-control-sm" id="com_insp_codigo"></select>
												    </div>               
												</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						      				        <div class="form-group shadow-textarea">
						      				            <label for="com_insp_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
						      				            <textarea readonly class="form-control z-depth-1 text-uppercase" id="com_insp_descripcion" rows="2"></textarea>
						      				        </div>
						      				    </div>
						      		        </div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						        					<div class="form-group">
														<label for="com_insp_componente" class="col-form-label form-control-sm">COMPONENTE</label>
														<textarea class="form-control form-control-sm z-depth-1 text-uppercase" id="com_insp_componente" rows="2" placeholder="escribe algo aqui..." maxlength="100"></textarea>
							    				   	</div>
					        					</div>
											</div>
										</div>
						      		    <div class="modal-footer">
						      		        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
						      		        <button type="submit" id="btn_guardar_inspeccion_componente" class="btn btn-dark btn-sm btn_guardar_inspeccion_componente">Guardar</button>
						      		    </div>
						      		</form>    
								</div>
						    </div>
						</div>  			
					</div>

					<!------------------------------------------------------------------------------->
					<!-- TAB MODO FALLA - ACCION DE INSPECCION DE FLOTA ----------------------------->
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade" id="nav-falla_accion" role="tabpanel" aria-labelledby="nav-falla_accion-tab">
						<form id="form_seleccion_falla_accion" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
							<div class="row align-items-end pb-4 col-sm-12">
								<div class="col-lg-1">
									<div class="form-group">
										<label for="fal_inspeccion_flota" class="col-form-label form-control-sm">FLOTA</label>
										<select class="form-control form-control-sm" id="fal_inspeccion_flota"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
						        	<div class="form-group">
										<label for="fal_inspeccion_codigo" class="col-form-label form-control-sm">CODIGO DESCRIPCION</label>
										<select class="form-control form-control-sm" id="fal_inspeccion_codigo"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
						        	<div class="form-group">
										<label for="fal_inspeccion_componente" class="col-form-label form-control-sm">COMPONENTE</label>
										<select class="form-control form-control-sm" id="fal_inspeccion_componente"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
									<div class="form-group" id="div_btn_seleccion_inspeccion_falla_accion">

									</div>
					    		</div> 
							</div>
						</form>

					   	<div class="container-fluid caja">
							<div class="row w-100 p-0 m-0">
						       	<div class="col-lg-12">
						       		<div class="table-responsive" id="div_tabla_inspeccion_falla_accion">        
										<!-- PHP Accesos CreacionTablas -->
						            </div>
						        </div>
						    </div>  
						</div>   

						<!--Modal para CRUD-->
						<div class="row modal fade" id="modal_crud_inspeccion_falla_accion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 						    <div class="modal-dialog" role="document">
						        <div class="modal-content">
								    <div class="modal-header">
						                <h5 class="modal-title" id="exampleModalLabel"></h5>
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
						                </button>
						            </div>
								  	<form id="form_inspeccion_falla_accion" enctype="multipart/form-data" action="" method="post">    
						      		    <div class="modal-body">
											<div class="row align-items-end">
												<div class="col-lg-6">
						        					<div class="form-group">
														<label for="fal_insp_bus_tipo" class="col-form-label form-control-sm">FLOTA</label>
														<select class="form-control form-control-sm" id="fal_insp_bus_tipo"></select>
							    				   	</div>
					        					</div>
												<div class="col-lg-6">
						  						    <div class="form-group">
														<label for="fal_insp_codigo" class="col-form-label form-control-sm">CODIGO</label>
														<select class="form-control form-control-sm" id="fal_insp_codigo"></select>
												    </div>               
												</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						      				        <div class="form-group shadow-textarea">
						      				            <label for="fal_insp_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
						      				            <textarea readonly class="form-control z-depth-1 text-uppercase" id="fal_insp_descripcion" rows="2"></textarea>
						      				        </div>
						      				    </div>
						      		        </div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						        					<div class="form-group">
														<label for="fal_insp_componente" class="col-form-label form-control-sm">COMPONENTE</label>
														<select class="form-control form-control-sm" id="fal_insp_componente" ></select>
							    				   	</div>
					        					</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-6">
						  						    <div class="form-group">
														<label for="fal_insp_falla" class="col-form-label form-control-sm">FALLA</label>
														<select class="form-control form-control-sm" id="fal_insp_falla"></select>
												    </div>               
												</div>
												<div class="col-lg-6">
						        					<div class="form-group">
														<label for="fal_insp_accion" class="col-form-label form-control-sm">ACCION</label>
														<select class="form-control form-control-sm" id="fal_insp_accion"></select>
							    				   	</div>
					        					</div>
											</div>
										</div>
						      		    <div class="modal-footer">
						      		        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
						      		        <button type="submit" id="btn_guardar_inspeccion_falla_accion" class="btn btn-dark btn-sm btn_guardar_inspeccion_falla_accion">Guardar</button>
						      		    </div>
						      		</form>    
								</div>
						    </div>
						</div>  			
					</div>


					<!------------------------------------------------------------------------------->
					<!-- TAB POSICION DE INSPECCION DE FLOTA ---------------------------------------->
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade" id="nav-posicion" role="tabpanel" aria-labelledby="nav-posicion-tab">
						<form id="form_seleccion_posicion" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
							<div class="row align-items-end pb-4 col-sm-12">
								<div class="col-lg-1">
									<div class="form-group">
										<label for="pos_inspeccion_flota" class="col-form-label form-control-sm">FLOTA</label>
										<select class="form-control form-control-sm" id="pos_inspeccion_flota"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
						        	<div class="form-group">
										<label for="pos_inspeccion_codigo" class="col-form-label form-control-sm">CODIGO DESCRIPCION</label>
										<select class="form-control form-control-sm" id="pos_inspeccion_codigo"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
						        	<div class="form-group">
										<label for="pos_inspeccion_componente" class="col-form-label form-control-sm">COMPONENTE</label>
										<select class="form-control form-control-sm" id="pos_inspeccion_componente"></select>
						   			</div>
					    		</div>
								<div class="col-lg-2">
									<div class="form-group" id="div_btn_seleccion_inspeccion_posicion">

									</div>
					    		</div> 
							</div>
						</form>

					   	<div class="container-fluid caja">
							<div class="row w-100 p-0 m-0">
						       	<div class="col-lg-12">
						       		<div class="table-responsive" id="div_tabla_inspeccion_posicion">        
										<!-- PHP Accesos CreacionTablas -->
						            </div>
						        </div>
						    </div>  
						</div>   

						<!--Modal para CRUD-->
						<div class="row modal fade" id="modal_crud_inspeccion_posicion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						    <div class="modal-dialog" role="document">
						        <div class="modal-content">
								    <div class="modal-header">
						                <h5 class="modal-title" id="exampleModalLabel"></h5>
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
						                </button>
						            </div>
								  	<form id="form_inspeccion_posicion" enctype="multipart/form-data" action="" method="post">    
						      		    <div class="modal-body">
											<div class="row align-items-end">
												<div class="col-lg-6">
						        					<div class="form-group">
														<label for="pos_insp_bus_tipo" class="col-form-label form-control-sm">FLOTA</label>
														<select class="form-control form-control-sm" id="pos_insp_bus_tipo"></select>
							    				   	</div>
					        					</div>
												<div class="col-lg-6">
						  						    <div class="form-group">
														<label for="pos_insp_codigo" class="col-form-label form-control-sm">CODIGO</label>
														<select class="form-control form-control-sm" id="pos_insp_codigo"></select>
												    </div>               
												</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						      				        <div class="form-group shadow-textarea">
						      				            <label for="pos_insp_descripcion" class="col-form-label form-control-sm">DESCRIPCION</label>
						      				            <textarea readonly class="form-control z-depth-1 text-uppercase" id="pos_insp_descripcion" rows="2"></textarea>
						      				        </div>
						      				    </div>
						      		        </div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						        					<div class="form-group">
														<label for="pos_insp_componente" class="col-form-label form-control-sm">COMPONENTE</label>
														<select class="form-control form-control-sm" id="pos_insp_componente"></select>
							    				   	</div>
					        					</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
						  						    <div class="form-group">
														<label for="pos_insp_posicion" class="col-form-label form-control-sm">POSICION</label>
														<input type="text" class="form-control form-control-sm text-uppercase" id="pos_insp_posicion" maxlength="100">
												    </div>               
												</div>
											</div>
										</div>
						      		    <div class="modal-footer">
						      		        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
						      		        <button type="submit" id="btn_guardar_inspeccion_posicion" class="btn btn-dark btn-sm btn_guardar_inspeccion_posicion">Guardar</button>
						      		    </div>
						      		</form>    
								</div>
						    </div>
						</div>  			
					</div>
					

				</div>
			</div>

			<!------------------------------------------------------------------------------->
			<!-- TAB REPORTE INSPECCION DE FLOTA -------------------------------------------->
			<!------------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-reporte" role="tabpanel" aria-labelledby="nav-reporte-tab">
				<form id="form_seleccion_reporte" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
				<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
							<div class="form-group">
								<label for="repo_fecha_inicio" class="col-form-label form-control-sm">F.INICIO</label>
								<input type="date" class="form-control form-control-sm" id="repo_fecha_inicio" placeholder="dd/mm/aaaaa">
					       	</div>
				        	<!-- <div class="form-group">
								<label for="rep_inspeccion_id" class="col-form-label form-control-sm">INSPECCION ID</label>
								<input type="text" class="form-control form-control-sm" id="rep_inspeccion_id">
					       	</div> -->
			        	</div>
						<div class="col-lg-1">
							<div class="form-group">
								<label for="repo_fecha_termino" class="col-form-label form-control-sm">F.TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="repo_fecha_termino" placeholder="dd/mm/aaaaa">
					       	</div>
				        	<!-- <div class="form-group">
								<label for="rep_inspeccion_bus" class="col-form-label form-control-sm">BUS</label>
								<select class="form-control form-control-sm" id="rep_inspeccion_bus"></select>
					       	</div> -->
			        	</div>
						<div class="col-sm-3">
							<div class="form-group" id="div_btn_seleccion_reporte">
								
							</div>
						</div>
					</div>   
				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tabla_reporte">        
				            </div>
				        </div>
				    </div>  
				</div>   

			</div>

			<!------------------------------------------------------------------------------->
			<!-- TAB FALLAS INSPECCION DE FLOTA --------------------------------------------->
			<!------------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-falla" role="tabpanel" aria-labelledby="nav-falla-tab">
				<form id="form_seleccion_falla" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
				<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
							<div class="form-group">
								<label for="falla_fecha_inicio" class="col-form-label form-control-sm">F.INICIO</label>
								<input type="date" class="form-control form-control-sm" id="falla_fecha_inicio" placeholder="dd/mm/aaaaa">
					       	</div>
				        	<!-- <div class="form-group">
								<label for="fal_inspeccion_id" class="col-form-label form-control-sm">INSPECCION ID</label>
								<input type="text" class="form-control form-control-sm" id="fal_inspeccion_id">
					       	</div> -->
			        	</div>
						<div class="col-lg-1">
							<div class="form-group">
								<label for="falla_fecha_termino" class="col-form-label form-control-sm">F.TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="falla_fecha_termino" placeholder="dd/mm/aaaaa">
					       	</div>
				        	<!-- <div class="form-group">
								<label for="fal_inspeccion_bus" class="col-form-label form-control-sm">BUS</label>
								<select class="form-control form-control-sm" id="fal_inspeccion_bus"></select>
					       	</div> -->
			        	</div>
						<div class="col-sm-3">
							<div class="form-group" id="div_btn_seleccion_falla">
								
							</div>
						</div>
					</div>   
				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tabla_falla">        
				            </div>
				        </div>
				    </div>  
				</div>   

			</div>

			<!------------------------------------------------------------------------------->
			<!-- TAB AJUSTE DE INSPECCION --------------------------------------------------->
			<!------------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-ajustes_inspeccion_flota" role="tabpanel" aria-labelledby="nav-ajustes_inspeccion_flota-tab">
				<h5 class="pt-3 pl-3">Variables</h5>
				
				<nav>
	 				<div class="nav nav-tabs" id="nav-tab-ajustes_inspeccion_flota" role="tablist">
						<!-- PHP Accesos CreacionTabs -->
					</div>
				</nav>
				
				<div class="tab-content" id="nav-tabContent-ajustes_inspeccion_flota">

					<!------------------------------------------------------------------------------->
					<!-- TAB AJUSTE VARIABLE DE USUARIO DE INSPECCION DE FLOTA ---------------------->
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade show active" id="nav-ajustes_inspeccion_flota_usuario" role="tabpanel" aria-labelledby="nav-ajustes_inspeccion_flota_usuario-tab">

						<section class="container-fluid py-3">
							<button id="btn_nuevo_tc_inspeccion_usuario" type="button" class="btn btn-secondary btn-sm btn_nuevo_tc_inspeccion_usuario" data-toggle="modal">+ Nuevo</button>  
						</section>
						<div class="row p-3">
							<div class="col-auto m-0">
								<div class="table-responsive" id="div_tabla_tc_inspeccion_usuario">
									<!-- PHP Creacion de Tablas -->
								</div>
							</div>
						</div>
						<!--Modal para CRUD-->
						<div class="row modal fade" id="modal_crud_tc_inspeccion_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel"></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form id="form_tc_inspeccion_usuario">
						  				<div class="modal-body">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
												  		<label for="tc_inspeccion_id_usuario" class="col-form-label form-control-sm">ID</label>
												   		<input type="text" readonly class="form-control form-control-sm" id="tc_inspeccion_id_usuario">
												 	</div>
											 	</div>
											 	<div class="col-lg-6">
											  		<div class="form-group">
														<label for="insp_cat1_usuario" class="col-form-label form-control-sm">CATEGORIA 1</label>
												   		<input type="text" class="form-control form-control-sm text-uppercase" id="insp_cat1_usuario" maxlength="45">
													</div> 
											 	</div>    
											</div>
							  				<div class="row"> 
												<div class="col-lg-6">
											  		<div class="form-group">
														<label for="insp_cat2_usuario" class="col-form-label form-control-sm">CATEGORIA 2</label>
														<input type="text" class="form-control form-control-sm text-uppercase" id="insp_cat2_usuario" maxlength="45">
													</div> 
								  				</div>
											</div>
											<div class="row"> 
								  				<div class="col-lg-12">
											  		<div class="form-group">
														<label for="insp_cat3_usuario" class="col-form-label form-control-sm">CATEGORIA 3</label>
												  		<textarea class="form-control z-depth-1 text-uppercase" id="insp_cat3_usuario" rows="7" placeholder="escribe algo aqui..." maxlength="250"></textarea>
													</div>               
								   				</div>
							  				</div>
										</div>
						  				<div class="modal-footer">
							  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
							  				<button type="submit" id="btn_guardar_tc_inspeccion_usuario" class="btn btn-dark btn-sm btn_guardar_tc_inspeccion_usuario">Guardar</button>
						  				</div>
									</form>    
								</div>
							</div>
						</div>  
					
					</div>
					
					<!------------------------------------------------------------------------------->
					<!-- TAB AJUSTE VARIABLE DE SISTEMA DE INSPECCION DE FLOTA ---------------------->
					<!------------------------------------------------------------------------------->
					<div class="tab-pane fade" id="nav-ajustes_inspeccion_flota_sistema" role="tabpanel" aria-labelledby="nav-ajustes_inspeccion_flota_sistema-tab">

						<section class="container-fluid py-3">
							<button id="btn_nuevo_tc_inspeccion_sistema" type="button" class="btn btn-secondary btn-sm btn_nuevo_tc_inspeccion_sistema" data-toggle="modal">+ Nuevo</button>  
						</section>
						<div class="row p-3">
							<div class="col-auto m-0">
								<div class="table-responsive" id="div_tabla_tc_inspeccion_sistema">
									<!-- PHP Creacion de Tablas -->
								</div>
							</div>
						</div>
						<!--Modal para CRUD-->
						<div class="row modal fade" id="modal_crud_tc_inspeccion_sistema" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel"></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form id="form_tc_inspeccion_sistema">
						  				<div class="modal-body">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
												  		<label for="tc_inspeccion_id_sistema" class="col-form-label form-control-sm">ID</label>
												   		<input type="text" readonly class="form-control form-control-sm" id="tc_inspeccion_id_sistema">
												 	</div>
											 	</div>
											 	<div class="col-lg-6">
											  		<div class="form-group">
														<label for="insp_cat1_sistema" class="col-form-label form-control-sm">CATEGORIA 1</label>
												   		<input type="text" class="form-control form-control-sm text-uppercase" id="insp_cat1_sistema" maxlength="45">
													</div> 
											 	</div>    
											</div>
							  				<div class="row"> 
												<div class="col-lg-6">
											  		<div class="form-group">
														<label for="insp_cat2_sistema" class="col-form-label form-control-sm">CATEGORIA 2</label>
														<input type="text" class="form-control form-control-sm text-uppercase" id="insp_cat2_sistema" maxlength="45">
													</div> 
								  				</div>
											</div>
											<div class="row"> 
								  				<div class="col-lg-12">
											  		<div class="form-group">
														<label for="insp_cat3_sistema" class="col-form-label form-control-sm">CATEGORIA 3</label>
												  		<textarea class="form-control z-depth-1 text-uppercase" id="insp_cat3_sistema" rows="7" placeholder="escribe algo aqui..." maxlength="250"></textarea>
													</div>               
								   				</div>
							  				</div>
										</div>
						  				<div class="modal-footer">
							  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
							  				<button type="submit" id="btn_guardar_tc_inspeccion_sistema" class="btn btn-dark btn-sm btn_guardar_tc_inspeccion_sistema">Guardar</button>
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
</div>