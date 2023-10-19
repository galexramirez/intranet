<!-- 2.2 CONTENIDO DE MODULO -->
<div  id="contenido" class="my-contenido-con-sidebar  p-0">
		
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
	 		<div class="nav nav-tabs" id="div_nav-tab-novedades_piloto" role="tablist">
	    		<!-- Creacion Tabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">
			<!---------------------------------------------------------------------->
	  		<!------------------------- TAB INASISTENCIAS -------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<form id="form_seleccion_inasistencias" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="rgdh_fecha_inicio" class="col-form-label form-control-sm">F.INICIO</label>
								<input type="date" class="form-control form-control-sm" id="rgdh_fecha_inicio" placeholder="dd-mm-aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="rgdh_fecha_termino" class="col-form-label form-control-sm">F.TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="rgdh_fecha_termino" placeholder="dd-mm-aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-2">
							<div class="form-group">
								<button type="button" id="btn_buscar_inasistencias" class="btn btn-secondary btn-sm btn_buscar_inasistencias">Buscar</button>
								<!-- <button type="button" id="btn_descargar_inasistencias" class="btn btn-secondary btn-sm btn_descargar_inasistencias">Descargar</button> -->
							</div>
			       		</div> 
					</div>
				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tabla_inasistencias">        
				           		<!-- Creacion Tabla -->               
				            </div>
				        </div>
				    </div>  
				</div>

				<!--Modal para CRUD VER INASISTENCIAS-->
				<div class="row modal fade" id="modal_crud_ver_inasistencias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
						<div class="modal-content ui-widget-content" id="modal-resizable_ver_inasistencias">
							<div class="modal-header dragable_touch">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body scrollVClass">
								<form id="form_modal_ver_inasistencias">
									<div class="container-fluid ml-0 mr-0 mb-0">
										<form id="form_ver_inasistencias" enctype="multipart/form-data" action="" method="post">    
											<div class="form-group" id="div_ver_inasistencias">
												<!-- PHP Logico -->
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
			
			<!---------------------------------------------------------------------->
			<!--------------------- TAB COMPORTAMIENTO ----------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<form id="form_seleccion_comportamiento" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="comp_fecha_inicio" class="col-form-label form-control-sm">F.INICIO</label>
								<input type="date" class="form-control form-control-sm" id="comp_fecha_inicio" placeholder="dd-mm-aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="comp_fecha_termino" class="col-form-label form-control-sm">F.TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="comp_fecha_termino" placeholder="dd-mm-aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-2">
							<div class="form-group">
								<button type="button" id="btn_buscar_comportamiento" class="btn btn-secondary btn-sm btn_buscar_comportamiento">Buscar</button>
								<!-- <button type="button" id="btn_descargar_comportamiento" class="btn btn-secondary btn-sm btn_descargar_comportamiento">Descargar</button> -->
							</div>
			       		</div> 
					</div>
				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tabla_comportamiento">        
				           		<!-- Creacion Tabla -->               
				            </div>
				        </div>
				    </div>  
				</div>

				<!--Modal para CRUD VER COMPORTAMIENTO-->
				<div class="row modal fade" id="modal_crud_ver_comportamiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
						<div class="modal-content ui-widget-content" id="modal-resizable_ver_comportamiento">
							<div class="modal-header dragable_touch">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body scrollVClass">
								<form id="form_modal_ver_comportamiento">
									<div class="container-fluid ml-0 mr-0 mb-0">
										<form id="form_ver_comportamiento" enctype="multipart/form-data" action="" method="post">    
											<div class="form-group" id="div_ver_comportamiento">
												<!-- PHP Logico -->
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

			<!---------------------------------------------------------------------->
			<!------------------------- TAB ACCIDENTES ----------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-accidentes" role="tabpanel" aria-labelledby="nav-accidentes-tab">
				
				<form id="form_seleccion_accidentes" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="acci_fecha_inicio" class="col-form-label form-control-sm">F.INICIO</label>
								<input type="date" class="form-control form-control-sm" id="acci_fecha_inicio" placeholder="dd-mm-aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="acci_fecha_termino" class="col-form-label form-control-sm">F.TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="acci_fecha_termino" placeholder="dd-mm-aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-2">
							<div class="form-group">
								<button type="button" id="btn_buscar_accidentes" class="btn btn-secondary btn-sm btn_buscar_accidentes">Buscar</button>
								<!-- <button type="button" id="btn_descargar_accidentes" class="btn btn-secondary btn-sm btn_descargar_accidentes">Descargar</button> -->
							</div>
			       		</div> 
					</div>
				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tabla_accidentes">        
								<!-- PHP Accesos CreacionTabla -->
				            </div>
				        </div>
				    </div>  
				</div>

				<!--Modal para CRUD VER ACCIDENTES-->
				<div class="row modal fade" id="modal_crud_ver_accidentes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
						<div class="modal-content ui-widget-content" id="modal-resizable_ver_accidentes">
							<div class="modal-header dragable_touch">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body scrollVClass">
								<form id="form_modal_ver_accidentes">
									<div class="container-fluid ml-0 mr-0 mb-0">
										<form id="form_ver_accidentes" enctype="multipart/form-data" action="" method="post">    
											<div class="form-group" id="div_ver_accidentes">
												<!-- PHP Logico -->
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

	  		<!-- TAB CARGA NOVEDAD ------------------------------------------------->
			<div class="tab-pane fade" id="nav-novedad_carga" role="tabpanel" aria-labelledby="nav-novedad_carga-tab">
				<form id="form_seleccion_novedad_carga" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-1 col-sm-12">
						<div class="col-lg-1">
				        	<div class="form-group">
								<label for="select_anio_novedad_arga" class="col-form-label form-control-sm">AÑO</label>
								<select name="select_anio_novedad_carga" class="form-control form-control-sm" id="select_anio_novedad_carga">
						    	</select>
					       	</div>
			        	</div>
						<div class="col-lg-2">
				        	<div class="form-group" id="div_btn_novedad_carga">
								<!-- PHP Accesos Botones Formulario -->
							</div>
			        	</div>   
					
					</div>
				</form>

			   	<div class="container-fluid caja">
					<div class="row p-1">
				       	<div class="col-auto m-0">
				       		<div class="table-responsive" id="div_tabla_novedad_carga">        
				           		<!-- PHP Accesos Creacion Tablas -->
				            </div>
				        </div>
				    </div>  
				</div>   
			
				<!--Modal para CRUD-->
				<div class="row modal fade" id="modal_crud_novedad_carga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
					  		<form id="form_novedad_carga" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
			      		        	<div class="row align-items-end">
			      		            	<div class="col-lg-10">
				  		                	<div class="form-group">
												<label for="label_novedad_carga" class="col-form-label form-control-sm">Cargar Archivo</label>
												<div class="custom-file">
									  				<label id="label_novedad_carga" class="custom-file-label form-control-sm" for="file_novedad_carga">Seleccionar Archivo .csv o .xlsx</label>
									  				<input type="file" class="custom-file-input form-control-sm" id="file_novedad_carga" lang="es" accept=".csv, .xlsx"> 
												</div>
				  		               		</div>
			      		            	</div>
			      		            	<div class="col-lg-2 py-1">
				  		                	<div class="form-group">
												<button type="submit" id="btn_cargar_novedad" class="btn btn-secondary btn_cargar_novedad btn-sm">Cargar</button>
				  		               		</div>
			      		            	</div>
			      		            </div>    
			      		        </div>
			      		    	<div class="modal-footer" id="div_resultado_novedad_carga">

								</div>
			      			</form>
						
			        	</div>
			    	</div>
				</div>

			</div>

			<!-- TAB DETALLE NOVEDAD ----------------------------------------------->
			<div class="tab-pane fade" id="nav-novedad_detalle" role="tabpanel" aria-labelledby="nav-novedad_detalle-tab">
				<form id="form_seleccion_novedad_detalle" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="node_fecha_inicio" class="col-form-label form-control-sm">F.INICIO</label>
								<input type="date" class="form-control form-control-sm" id="node_fecha_inicio" placeholder="dd-mm-aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="node_fecha_termino" class="col-form-label form-control-sm">F.TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="node_fecha_termino" placeholder="dd-mm-aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-2">
							<div class="form-group">
								<button type="button" id="btn_buscar_novedad_detalle" class="btn btn-secondary btn-sm btn_buscar_novedad_detalle">Buscar</button>
							</div>
			       		</div> 
					</div>
				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tabla_novedad_detalle">
				           		<!-- Creacion Tabla -->               
				            </div>
				        </div>
				    </div>  
				</div>

			</div>

		</div>
	</div>
</div>