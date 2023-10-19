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
</div>