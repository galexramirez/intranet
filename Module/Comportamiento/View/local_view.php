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
	 		<div class="nav nav-tabs" id="nav-tab-Comportamiento" role="tablist">
				<!-- PHP Accesos CreacionTabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">
			<!--------------------------------------------------------------------------->
	  		<!------------------------- TAB COMPORTAMIENTO ------------------------------>
			<!--------------------------------------------------------------------------->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
			
				<form id="formSeleccionComportamiento" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
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
						<div class="col-lg-1">             	
							<div class="form-group">
								<button type="button" id="btn_buscar_comportamiento" class="btn btn-secondary btn-sm btn_buscar_comportamiento">Buscar</button>
							</div>
			       		</div> 
					</div>

				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tablaComportamiento">
								<!-- PHP Accesos CreacionTablas -->
				            </div>
				        </div>
				    </div>  
				</div>   
			
				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDComportamiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
					  		<form id="formComportamiento" enctype="multipart/form-data" action="" method="post">
							  	<div id="div_form_comportamiento">
								</div> 
			      			</form>
						
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD DETALLE DE CONTROL FACILITADOR-->
				<div class="row modal fade" id="modalCRUDDetalleControlFacilitador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog modal-xl" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
							<form id="formDetalleControlFacilitador">    
								<div class="modal-body scrollVClass" id="div_DetalleControlFacilitador">
									<!-- Se debe genera la informacion detallada del control facilitador y la novedad -->
								</div>
			      				<div class="modal-footer">
			      					<button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
			      				</div>
							</form>
			        	</div>
			    	</div>
				</div>

				<!-- MODAL CRUD LOG COMPORTAMIENTO-->
				<div class="row modal fade" id="modal_crud_log_comportamiento" tabindex="-1" role="dialog" aria-labelledby="example_modal_label_log_comportamiento" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
				    	<div class="modal-content" id="modal-resizable_log">
					    	<div class="modal-header modal-header-log dragable_touch">
				            	<h5 class="modal-title modal-title-log" id="example_modal_label_log_comportamiento"></h5>
				            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				            	</button>
				        	</div>
					  		<form id="form_modal_log_comportamiento" enctype="multipart/form-data" action="" method="post">    
				  		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_log_comportamiento">
												<!-- JS Cierre Administrativo -->
											</div>
				  		            	</div>
									</div>  
								</div>
							</form>
				    	</div>
					</div>
				</div>
				<!--Termino de CRUD LOG COMPORTAMIENTO--> 

			</div>

			<!---------------------------------------------------------------------->
			<!------------------------ TELEMETRIA ---------------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
				<form id="formSeleccionTelemetriaCarga" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-2">
							<div class="form-group">
								<label for="selectAniosTelemetriaCarga" class="col-form-label">Año :</label>
								<select name="selectAniosTelemetriaCarga" class="form-control" id="selectAniosTelemetriaCarga">
								</select>
						   	</div>
						</div>
						<div class="col-lg-3">             	
							<div class="form-group">
								<button type="button" id="btnBuscarTelemetriaCarga"class="btn btn-success"> Buscar </button>
							</div>
					   	</div> 
						<div class="col-lg-2">
							<div class="form-group" id="div_btnNuevoTelemetriaCarga">
								<!-- PHP Accesos BotonesFormulario -->
							</div>
						</div>   
					</div>
				</form>

				<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
					   <div class="col-lg-12">
						   <div class="table-responsive" id="div_tablaTelemetriaCarga">        
								<!-- PHP Accesos CereacionTabla -->
							</div>
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDTelemetriaCarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
								</button>
   							</div>
							<form id="formTelemetriaCarga" enctype="multipart/form-data" action="" method="post">    
								<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-2">
			      							<div class="form-group">
												<label for="" class="col-form-label">Fecha de Carga:</label>
												<input type="date" class="form-control" id="telemetriacarga_fechaoperacion" placeholder="dd/mm/aaaa" >
			    								<div id="Mstelemetriacarga_fechaoperacion"class="invalid-feedback">Complete el campo.</div>
			      							</div>
			    						</div>
										<div class="col-lg-9">
											<div class="form-group">
												<label for="" class="col-form-label">Cargar Archivo</label>
												<div class="custom-file">
													<label id="LabelfileTelemetriaCarga" class="custom-file-label" for="customFileLang">Seleccionar Archivo .csv o .xlsx</label>
													<input type="file" class="custom-file-input" id="fileTelemetriaCarga" lang="es" accept=".csv, .xlsx"> 
												</div>
												<div id="MsfileTelemetriaCarga"class="invalid-feedback">Complete el campo.</div>
											</div>
									  	</div>
									  	<div class="col-lg-1">
										  	<div class="form-group">
											  	<label for="" class="col-form-label"></label>
												<button type="submit" id="btnCargarTelemetriaCarga" class="btn btn-success">Cargar</button>
											</div>
									  	</div>
								  	</div>    
							  	</div>
								<div class="modal-footer" id="div_ResultadoTelemetriaCarga">
									<!-- Carga de Mensajes -->
								</div>
						  	</form>
						</div>
					</div>
				</div>

			</div>

			<!---------------------------------------------------------------------->
			<!------------------------ REPORTE A GDH ------------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<form id="formSeleccionReportegdh" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
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
						<div class="col-lg-1">             	
							<div class="form-group">
								<button type="button" id="btn_buscar_reporte_gdh" class="btn btn-secondary btn-sm btn_buscar_reporte_gdh">Buscar</button>
							</div>
			       		</div> 
					</div>
				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tablaReportegdh">        
								<!-- PHP Accesos CreacionTabla -->
				            </div>
				        </div>
				    </div>  
				</div>   

				<!--MODAL CRUD EDITAR COMPORTAMIENTO-->
				<div class="row modal fade" id="modal_crud_comportamiento_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
			        	<div class="modal-content" id="modal-resizable_comportamiento_editar">
					    	<div class="modal-header dragable_touch">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>

							<form id="form_comportamiento_editar" enctype="multipart/form-data" action="" method="post">
								<div id="div_form_comportamiento_editar">

								</div>
							</form>
						
			        	</div>
			    	</div>
				</div>

				<!-- MODAL CRUD LOG EDITAR COMPORTAMIENTO-->
				<div class="row modal fade" id="modal_crud_log_comportamiento_editar" tabindex="-1" role="dialog" aria-labelledby="example_modal_label_log_comportamiento_editar" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
				    	<div class="modal-content" id="modal-resizable_log_editar">
					    	<div class="modal-header modal-header-log_editar dragable_touch">
				            	<h5 class="modal-title modal-title-log_editar" id="example_modal_label_log_comportamiento_editar"></h5>
				            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				            	</button>
				        	</div>
					  		<form id="form_modal_log_comportamiento_editar" enctype="multipart/form-data" action="" method="post">    
				  		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_log_comportamiento_editar">
												<!-- JS Cierre Administrativo -->
											</div>
				  		            	</div>
									</div>  
								</div>
							</form>
				    	</div>
					</div>
				</div>
				<!--Termino de CRUD LOG EDITAR COMPORTAMIENTO--> 

			</div>

			<!---------------------------------------------------------------------->
			<!-- AJUSTES DE COMPORTAMIENTO ----------------------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-ajustes_comportamiento" role="tabpanel" aria-labelledby="nav-ajustes_comportamiento-tab">

				<section class="container-fluid py-3">
					<button id="btnNuevoTipoTablaComportamiento" type="button" class="btn btn-secondary btn-sm btnNuevoTipoTablaComportamiento" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaTipoTablaComportamiento">
							
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDTipoTablaComportamiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="formTipoTablaComportamiento">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="TtablaComportamiento_Id" class="col-form-label form-control-sm">ID</label>
										   		<input type="text" readonly class="form-control form-control-sm" id="TtablaComportamiento_Id">
										 	</div>
									 	</div>
										 <div class="col-lg-6">
									  		<div class="form-group">
												<label for="TtablaComportamiento_Operacion" class="col-form-label form-control-sm">FICHA</label>
												<input type="text" class="form-control form-control-sm text-uppercase" id="TtablaComportamiento_Operacion" maxlength="45">
											</div> 
						  				</div>
									</div>
					  				<div class="row"> 
									  	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="TtablaComportamiento_Tipo" class="col-form-label form-control-sm">CATEGORIA 1</label>
										   		<input type="text" class="form-control form-control-sm text-uppercase" id="TtablaComportamiento_Tipo" maxlength="45">
											</div> 
									 	</div>    
									</div>
									<div class="row"> 
						  				<div class="col-lg-12">
									  		<div class="form-group">
												<label for="TtablaComportamiento_Detalle" class="col-form-label form-control-sm">CATEGORIA 2</label>
										  		<textarea class="form-control z-depth-1 form-control-sm text-uppercase" id="TtablaComportamiento_Detalle" rows="7" placeholder="escribe algo aqui..." maxlength="250"></textarea>
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarTipoTablaComportamiento" class="btn btn-dark btn-sm btnGuardarTipoTablaComportamiento">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			

			</div>

		</div>
	</div>
</div>