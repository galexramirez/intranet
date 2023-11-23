<!-- 2.2 CONTENIDO DE MODULO -->
<div  id="contenido" class="my-contenido-con-sidebar  p-0">
		
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
	 		<div class="nav nav-tabs" id="div_nav-tab-inasistencias" role="tablist">
	    		<!-- Creacion Tabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">
			<!---------------------------------------------------------------------->
	  		<!------------------------- TAB INASISTENCIAS -------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
			
				<form id="formSeleccionInasistencias" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="in_fecha_inicio" class="col-form-label form-control-sm">F.INICIO</label>
								<input type="date" class="form-control form-control-sm" id="in_fecha_inicio" placeholder="dd-mm-aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="in_fecha_termino" class="col-form-label form-control-sm">F.TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="in_fecha_termino" placeholder="dd-mm-aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-1">             	
							<div class="form-group">
								<button type="button" id="btn_buscar_inasistencias" class="btn btn-secondary btn-sm btn_buscar_inasistencias">Buscar</button>
							</div>
			       		</div> 
					</div>

				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tabla_inasistencias">        
				           		<!-- Creacion de Tablas -->               
				            </div>
				        </div>
				    </div>  
				</div>   
			
				<!--Modal para CRUD-->
				<div class="row modal fade" id="modal_crud_inasistencias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
			        	<div class="modal-content" id="modal-resizable_inasistencias">
					    	<div class="modal-header dragable_touch">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
							<form id="formInasistencias" enctype="multipart/form-data" action="" method="post">
								<div id="div_form_inasistencias">
								</div>
							</form>
						
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD DETALLE DE CONTROL FACILITADOR-->
				<div class="row modal fade" id="modal_crud_detalle_control_facilitador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog modal-xl" role="document">
			        	<div class="modal-content" id="modal-resizable_detalle_cf">
					    	<div class="modal-header dragable_touch">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
							<form id="formDetalleControlFacilitador">    
								<div class="modal-body scrollVClass" id="div_detalle_control_facilitador">
									<!-- Se debe genera la informacion detallada del control facilitador y la novedad -->
								</div>
			      				<div class="modal-footer">
			      					<button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
			      				</div>
							</form>
			        	</div>
			    	</div>
				</div>

				<!-- MODAL CRUD LOG INASISTENCIAS-->
				<div class="row modal fade" id="modal_crud_log_inasistencias" tabindex="-1" role="dialog" aria-labelledby="example_modal_label_log_inasistencias" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
				    	<div class="modal-content" id="modal-resizable_log">
					    	<div class="modal-header modal-header-log dragable_touch">
				            	<h5 class="modal-title modal-title-log" id="example_modal_label_log_inasistencias"></h5>
				            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				            	</button>
				        	</div>
					  		<form id="form_modal_log_inasistencias" enctype="multipart/form-data" action="" method="post">    
				  		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_log_inasistencias">
												<!-- JS Cierre Administrativo -->
											</div>
				  		            	</div>
									</div>  
								</div>
							</form>
				    	</div>
					</div>
				</div>
				<!--Termino de CRUD LOG INASISTENCIAS--> 

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
				       		<div class="table-responsive" id="div_tabla_reporte_gdh">        
				           		<!-- Creacion Tabla -->               
				            </div>
				        </div>
				    </div>  
				</div>
				
				<!--MODAL CRUD EDITAR INASISTENCIAS-->
				<div class="row modal fade" id="modal_crud_inasistencias_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
			        	<div class="modal-content" id="modal-resizable_inasistencias_editar">
					    	<div class="modal-header dragable_touch">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>

							<form id="form_inasistencias_editar" enctype="multipart/form-data" action="" method="post">
								<div id="div_form_inasistencias_editar">

								</div>
							</form>
						
			        	</div>
			    	</div>
				</div>

				<!-- MODAL CRUD LOG INASISTENCIAS-->
				<div class="row modal fade" id="modal_crud_log_inasistencias_editar" tabindex="-1" role="dialog" aria-labelledby="example_modal_label_log_inasistencias_editar" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
				    	<div class="modal-content" id="modal-resizable_log_editar">
					    	<div class="modal-header modal-header-log_editar dragable_touch">
				            	<h5 class="modal-title modal-title-log_editar" id="example_modal_label_log_inasistencias_editar"></h5>
				            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				            	</button>
				        	</div>
					  		<form id="form_modal_log_inasistencias_editar" enctype="multipart/form-data" action="" method="post">    
				  		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_log_inasistencias_editar">
												<!-- JS Cierre Administrativo -->
											</div>
				  		            	</div>
									</div>  
								</div>
							</form>
				    	</div>
					</div>
				</div>
				<!--Termino de CRUD LOG INASISTENCIAS--> 


			</div>

			<!---------------------------------------------------------------------->
			<!-- TAB AJUSTES DE INASISTENCIAS -------------------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-ajustes_inasistencias" role="tabpanel" aria-labelledby="nav-ajustes_inasistencias-tab">

				<section class="container-fluid py-3">
					<button id="btnNuevoTipoTablaInasistencias" type="button" class="btn btn-secondary btn-sm btnNuevoTipoTablaInasistencias" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaTipoTablaInasistencias">
							
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDTipoTablaInasistencias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="formTipoTablaInasistencias">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="TtablaInasistencias_Id" class="col-form-label control-form-sm">ID</label>
										   		<input type="text" readonly class="form-control control-form-sm" id="TtablaInasistencias_Id">
										 	</div>
									 	</div>
										 <div class="col-lg-6">
									  		<div class="form-group">
												<label for="TtablaInasistencias_Operacion" class="col-form-label control-form-sm">FICHA</label>
												<input type="text" class="form-control control-form-sm text-uppercase" id="TtablaInasistencias_Operacion" maxlength="45">
											</div> 
						  				</div>
									</div>
					  				<div class="row"> 
									  	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="TtablaInasistencias_Tipo" class="col-form-label control-form-sm">CATEGORIA 1</label>
										   		<input type="text" class="form-control control-form-sm text-uppercase" id="TtablaInasistencias_Tipo" maxlength="45">
											</div> 
									 	</div>    
									</div>
									<div class="row"> 
						  				<div class="col-lg-12">
									  		<div class="form-group">
												<label for="TtablaInasistencias_Detalle" class="col-form-label control-form-sm">CATEGORIA 2</label>
										  		<textarea class="form-control z-depth-1 control-form-sm text-uppercase" id="TtablaInasistencias_Detalle" rows="7" placeholder="escribe algo aqui..." maxlength="250"></textarea>
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarTipoTablaInasistencias" class="btn btn-dark btn-sm btnGuardarTipoTablaInasistencias">Guardar</button>
				  				</div>
			  				</form>    
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