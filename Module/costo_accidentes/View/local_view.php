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
	 		<div class="nav nav-tabs" id="nav-tab-costo_accidentes" role="tablist">
				<!-- PHP Accesos Creacion Tabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">
			<!--------------------------------------------------------------------------->
	  		<!---------- TAB LISTADO COSTO ACCIDENTES ----------------------------------->
			<!--------------------------------------------------------------------------->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
			
				<form id="form_seleccion_costo_accidentes" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
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
						<div class="col-lg-7">             	
							<div class="form-group" id="div_seleccion_costo_accidentes">
								
							</div>
			       		</div> 
					</div>
				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tabla_costo_accidentes">        
				           		<!-- PHP Accesos Creacion Tabla -->
				            </div>
				        </div>
				    </div>  
				</div>

				<!--Modal para CRUD CARGAR PDF-->
				<div class="row modal fade" id="modal_crud_cargar_pdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_cargar_pdf" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
			      		        	<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group">
												<div class="custom-file">
							  						<label id="label_cargar_pdf" class="custom-file-label form-control-sm" for="customFileLang">Seleccionar Archivo .pdf</label>
							  						<input type="file" class="custom-file-input form-control-sm" id="cargar_pdf" lang="es" accept=".pdf"> 
												</div>
				               				</div>
										</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-3">
											<div class="form-group">
												<label for="acos_monto_mano_obra" class="col-form-label form-control-sm">MANO DE OBRA</label>
				               				</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<label for="" class="col-form-label form-control-sm">:</label>
				               				</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<input type="number" step=".01" class="form-control form-control-sm" id="acos_monto_mano_obra">
				               				</div>
										</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-3">
											<div class="form-group">
												<label for="acos_monto_insumos" class="col-form-label form-control-sm">INSUMOS</label>
				               				</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<label for="" class="col-form-label form-control-sm">:</label>
				               				</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<input type="number" step=".01" class="form-control form-control-sm" id="acos_monto_insumos">
				               				</div>
										</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-3">
											<div class="form-group">
												<label for="acos_costo_manto" class="col-form-label form-control-sm">SUB TOTAL</label>
				               				</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<label for="" class="col-form-label form-control-sm">:</label>
				               				</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<input type="number" step=".01" readonly class="form-control form-control-sm" id="acos_costo_manto">
				               				</div>
										</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-3">
											<div class="form-group">
												<label for="acos_monto_impuesto" class="col-form-label form-control-sm">IGV 18 %</label>
				               				</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<label for="" class="col-form-label form-control-sm">:</label>
				               				</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<input type="number" step=".01" readonly class="form-control form-control-sm" id="acos_monto_impuesto">
				               				</div>
										</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-3">
											<div class="form-group">
												<label for="acos_monto_cotizado" class="col-form-label form-control-sm">TOTAL</label>
				               				</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<label for="" class="col-form-label form-control-sm">:</label>
				               				</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<input type="number" step=".01" readonly class="form-control form-control-sm" id="acos_monto_cotizado">
				               				</div>
										</div>
									</div>

			      		        </div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
			      					<button type="submit" id="btn_guardar_cargar_pdf" class="btn btn-dark btn-sm btn_guardar_cargar_pdf">Cargar</button>
								</div>
							  </form>
			        	</div>
			    	</div>
				</div>

			
			</div>
			
			<!---------------------------------------------------------------------------------->
			<!-------------------------- TAB   ------------------------------------------------->
			<!---------------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

			</div>
			  	
			<!---------------------------------------------------------------------------------->
			<!------------------------- TAB  --------------------------------------------------->
			<!---------------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

			</div>

			<!---------------------------------------------------------------------------------->
			<!------------------------- TAB ---------------------------------------------------->
			<!---------------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-reporte" role="tabpanel" aria-labelledby="nav-reporte-tab">

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