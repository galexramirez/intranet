
<div id="contenido" class="my-contenido-con-sidebar p-0">

	<nav class="navbar navbar-light bg-light p-0 navbar-expand topbar static-top">
		<div class="container-fluid">
			<div class="row justify-content-between w-100 align-items-center">
				<div class="col-4">
					<a class="navbar-brand text-muted align-baselin" href="#">
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

	<section class="container-fluid py-3">
		<form id="form_solicitudes_seleccion" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
			<div class="row align-items-end pb-4 col-sm-12">
				<div class="col-lg-1">
			      	<div class="form-group">
						<label for="sele_fecha_inicio" class="col-form-label form-control-sm">F.INICIO</label>
						<input type="date" class="form-control form-control-sm" id="sele_fecha_inicio" placeholder="dd-mm-aaaa" >
			      	</div>
			    </div>
				<div class="col-lg-1">
			      	<div class="form-group">
						<label for="sele_fecha_termino" class="col-form-label form-control-sm">F.TERMINO</label>
						<input type="date" class="form-control form-control-sm" id="sele_fecha_termino" placeholder="dd-mm-aaaa" >
			      	</div>
			    </div>
				<div class="col-lg-3">
					<div class="form-group" id="div_btn_solicitudes_seleccion">
						<!-- Botones Formulario -->						
					</div>
			    </div> 
			</div>
		</form>
	</section>
	
	<div class="row p-2">
		<div class="col-auto m-0">
			<div class="table-responsive" id="div_tabla_solicitudes">
				<!-- Creacion Tabla -->
			</div>
    	</div>
	</div>


	<!--MODAL PARA CRUD SOLICITUDES-->
	<div class="row modal fade" id="modal_crud_solicitudes" tabindex="-1" role="dialog" aria-labelledby="example_modal_label_solicitudes" aria-hidden="true">
		<div class="modal-dialog modal-lg"  role="document">
			<div class="modal-content">

				<div class="modal-header dragable_touch">
			        <h5 class="modal-title" id="example_modal_label_solicitudes"></h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			        </button>
			    </div>
			      	
				<form id="form_solicitudes">    
			      	<div class="modal-body">
			      		<div class="row">
			      		    <div class="col-lg-12">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
						          			<label for="solicitudes_id" class="col-form-label form-control-sm">ID</label>
						           			<input type="text" readonly class="form-control form-control-sm" id="solicitudes_id">
				  		       			</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
						          			<label for="soli_fecha_ingreso" class="col-form-label form-control-sm">F.INGRESO</label>
						           			<input type="datetime-local" readonly class="form-control form-control-sm" id="soli_fecha_ingreso">
				  		       			</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="soli_fecha_recepcion" class="col-form-label form-control-sm">F.RECEPCION</label>
			      				        	<input type="date" class="form-control form-control-sm" id="soli_fecha_recepcion">
				  		       			</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
						          			<label for="soli_tipo" class="col-form-label form-control-sm">TIPO</label>
						           			<select class="form-control form-control-sm" id="soli_tipo">
											</select>
				  		       			</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
						          			<label for="soli_codigo_adm" class="col-form-label form-control-sm">COD.ADMINISTRACION</label>
											<input type="text" class="form-control form-control-sm" id="soli_codigo_adm">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
						          			<label for="soli_dni" class="col-form-label form-control-sm">DNI</label>
						           			<input type="text" readonly class="form-control form-control-sm" id="soli_dni">
				  		       			</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
				  		        		<div class="form-group">
						           			<label for="soli_apellidos_nombres" class="col-form-label form-control-sm">APELLIDOS Y NOMBRES</label>
						           			<select class="form-control form-control-sm" id="soli_apellidos_nombres">
												
											</select>
				  		        		</div>
									</div>
								</div>
			      				<div class="row">
			      				    <div class="col-lg-6">
			      				       	<div class="form-group">
			      				        	<label for="soli_fecha_inicio" class="col-form-label form-control-sm">F.INICIO</label>
			      				        	<input type="date" class="form-control form-control-sm" id="soli_fecha_inicio">
			      				        </div>
			      				    </div>    
			      				    <div class="col-lg-6">    
			      				        <div class="form-group">
			      				        	<label for="soli_fecha_fin" class="col-form-label form-control-sm">F.FIN</label>
			      				        	<input type="date" class="form-control form-control-sm" id="soli_fecha_fin">
			      				        </div>            
			      				    </div>    
			      				</div>   
								<div class="row">
									<div class="col-lg-12">
				  		        		<div class="form-group">
						           			<label for="soli_descripcion" class="col-form-label form-control-sm">DESCRIPCION (Máx. 500 Carácteres)</label>
						           			<textarea class="form-control form-control-sm text-uppercase" id="soli_descripcion"rows="4" placeholder="escribe algo aqui..." maxlength="500"></textarea>
				  		        		</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
				  		        		<div class="form-group">
						           			<label for="soli_pdf" class="col-form-label form-control-sm">ADJUNTAR DOCUMENTO PDF</label>
											<div class="custom-file" id="div_label_solicitudes_pdf">
							  					<label id="label_solicitudes_pdf" class="custom-file-label" for="customFileLang">Seleccionar Archivo .pdf</label>
							  					<input type="file" class="custom-file-input" id="soli_pdf" lang="es" accept=".pdf"> 
											</div>

				  		        		</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
				  		        		<div class="form-group" id="div_validacion_solicitudes">
				  		        		</div>
									</div>
								</div>

			      		    </div>
			      		    <!-- <div class="col-lg-6">
							  	<div class="row align-items-end">
									<div class="col-lg-12">
										<div class="ExternalFiles" id="div_solicitudes_pdf">
						        				
										</div>
			                		</div>
								</div>
			      		        <div class="row align-items-end">
									<div class="col-lg-12">
										<div class="form-group">
											<div class="custom-file" id="div_label_solicitudes_pdf">
							  					<label id="label_solicitudes_pdf" class="custom-file-label" for="customFileLang">Seleccionar Archivo .pdf</label>
							  					<input type="file" class="custom-file-input" id="soli_pdf" lang="es" accept=".pdf"> 
											</div>
				               			</div>
									</div>
								</div>
							</div>  -->   
			      		</div>
					</div>
			      	<div class="modal-footer">
			      		<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
			      		<button type="submit" id="btn_guardar_solicitudes" class="btn btn-dark btn-sm btn_guardar_solicitudes">Guardar</button>
			      	</div>
			    </form>    
			</div>
		</div>
	</div>  			
	
	<!--MODAL PARA CRUD  VER SOLICITUDES-->
	<div class="row modal fade" id="modal_crud_ver_solicitudes" tabindex="-1" role="dialog" aria-labelledby="example_modal_label_ver_solicitudes" aria-hidden="true">
		<div class="modal-dialog modal-lg"  role="document">
			<div class="modal-content">

				<div class="modal-header dragable_touch">
			        <h5 class="modal-title" id="example_modal_label_ver_solicitudes"></h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			        </button>
			    </div>
			      	
				<form id="form_ver_solicitudes">
			      	<div class="modal-body">
			      		<div class="row">
			      		    <div class="col-lg-12">
							  	<div class="row">
									<div class="col-lg-4">
										<div class="form-group mb-1">
											<span class="form-control-sm pl-0 mb-0 font-weight-bold">ID</span> 
				  		       			</div>
									</div>
									<div class="col-lg-8">
										<div class="form-group mb-1">
											<span id="isolicitudes_id" class="form-control-sm pl-0 mb-0 font-weight-normal"></span>
				  		       			</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group mb-1">
											<span class="form-control-sm pl-0 mb-0 font-weight-bold">F.INGRESO</span> 
										</div>
									</div>
									<div class="col-lg-8">
										<div class="form-group mb-1">
											<span id="isoli_fecha_ingreso" class="form-control-sm pl-0 mb-0 font-weight-normal"></span>
				  		       			</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group mb-1">
											<span class="form-control-sm pl-0 mb-0 font-weight-bold">F.RECEPCION</span> 
				  		       			</div>
									</div>
									<div class="col-lg-8">
										<div class="form-group mb-1">
											<span id="isoli_fecha_recepcion" class="form-control-sm pl-0 mb-0 font-weight-normal"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group mb-1">
											<span class="form-control-sm pl-0 mb-0 font-weight-bold">TIPO</span> 
				  		       			</div>
									</div>
									<div class="col-lg-8">
										<div class="form-group mb-1">
											<span id="isoli_tipo" class="form-control-sm pl-0 mb-0 font-weight-normal"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group mb-1">
											<span class="form-control-sm pl-0 mb-0 font-weight-bold">COD.ADMINIST.</span> 
				  		       			</div>
									</div>
									<div class="col-lg-8">
										<div class="form-group mb-1">
											<span id="isoli_codigo_adm" class="form-control-sm pl-0 mb-0 font-weight-normal"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group mb-1">
											<span class="form-control-sm pl-0 mb-0 font-weight-bold">DNI</span> 
				  		       			</div>
									</div>
									<div class="col-lg-8">
										<div class="form-group mb-1">
											<span id="isoli_dni" class="form-control-sm pl-0 mb-0 font-weight-normal"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group mb-1">
											<span class="form-control-sm pl-0 mb-0 font-weight-bold">NOMBRES</span> 
				  		       			</div>
									</div>
									<div class="col-lg-8">
										<div class="form-group mb-1">
											<span id="isoli_apellidos_nombres" class="form-control-sm pl-0 mb-0 font-weight-normal"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group mb-1">
											<span class="form-control-sm pl-0 mb-0 font-weight-bold">F.INCIO</span> 
				  		       			</div>
									</div>
									<div class="col-lg-8">
										<div class="form-group mb-1">
											<span id="isoli_fecha_inicio" class="form-control-sm pl-0 mb-0 font-weight-normal"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group mb-1">
											<span class="form-control-sm pl-0 mb-0 font-weight-bold">F.FIN</span> 
				  		       			</div>
									</div>
									<div class="col-lg-8">
										<div class="form-group mb-1">
											<span id="isoli_fecha_fin" class="form-control-sm pl-0 mb-0 font-weight-normal"></span>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12">
				  		        		<div class="form-group mb-1">
											<span class="form-control-sm pl-0 mb-0 font-weight-bold">DESCRIPCION (Máx. 500 Carácteres)</span> 
						           			<textarea disabled class="form-control form-control-sm text-uppercase mb-0" id="isoli_descripcion" rows="4" placeholder="escribe algo aqui..." maxlength="500"></textarea>
				  		        		</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
				  		        		<div class="form-group mb-1" id="idiv_validacion_solicitudes">
				  		        		</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-4">
										<div class="form-group mb-1">
											<span class="form-control-sm pl-0 mb-0 font-weight-bold">ESTADO</span> 
				  		       			</div>
									</div>
									<div class="col-lg-8">
										<div class="form-group mb-1">
											<span id="isoli_estado" class="form-control-sm pl-0 mb-0 font-weight-normal"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group mb-1">
											<span class="form-control-sm pl-0 mb-0 font-weight-bold">RESPUESTA</span> 
				  		       			</div>
									</div>
									<div class="col-lg-8">
										<div class="form-group mb-1">
											<span id="isoli_respuesta" class="form-control-sm pl-0 mb-0 font-weight-normal"></span>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12">
				  				    	<div class="form-group mb-1">
										  	<span class="form-control-sm pl-0 mb-0 font-weight-bold">DETALLE RESPUESTA</span> 
								    		<textarea disabled class="form-control form-control-sm text-uppercase mb-0" id="isoli_detalle_respuesta" rows="4" placeholder="escriba algo aqui..." maxlength="250"></textarea>
				  				    	</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group mb-1">
											<span class="form-control-sm pl-0 mb-0 font-weight-bold">REGISTRADO POR</span> 
				  		       			</div>
									</div>
									<div class="col-lg-8">
										<div class="form-group mb-1">
											<span id="isoli_usuario_nombres" class="form-control-sm pl-0 mb-0 font-weight-normal"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group mb-1">
											<span class="form-control-sm pl-0 mb-0 font-weight-bold">RESPONSABLE</span> 
				  		       			</div>
									</div>
									<div class="col-lg-8">
										<div class="form-group mb-1">
											<span id="isoli_responsable_nombres" class="form-control-sm pl-0 mb-0 font-weight-normal"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group mb-1" id="idiv_btn_ver_solicitudes">
											
				  		       			</div>
									</div>
								</div>

							</div>
			      		    <!-- <div class="col-lg-6">
							  	<div class="row align-items-end">
									<div class="col-lg-12">
										<div class="ExternalFiles" id="idiv_ver_solicitudes_pdf">
						        				
										</div>
			                		</div>
								</div>
							</div> -->    
			      		</div>

					</div>
 			    </form> 

			</div>
		</div>
	</div>

	<!--MODAL CRUD PDF-->
	<div class="row modal fade" id="modal_crud_ver_solicitudes_pdf" tabindex="-1" role="dialog" aria-labelledby="example_modal_label_ver_pdf" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">

				<div class="modal-header modal-header-xl-pdf dragable_touch">
			        <h5 class="modal-title modal-title-xl-pdf" id="example_modal_label_ver_pdf"></h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			        </button>
			    </div>
			      	
				<form id="form_ver_solicitudes_pdf">    
			      	<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="text-center form-group" id="div_ver_solicitudes_pdf">

								</div>
							</div>		
						</div>
			      	</div>
			      	<div class="modal-footer">
			      		<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cerrar</button>
			      	</div>
			    </form>    
			</div>
		</div>
	</div>

	<!-- MODAL CRUD LOG SOLICITUDES-->
	<div class="row modal fade" id="modal_crud_log_solicitudes" tabindex="-1" role="dialog" aria-labelledby="example_modal_label_log_solicitudes" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
	    	<div class="modal-content">
		    	<div class="modal-header modal-header-log dragable_touch">
	            	<h5 class="modal-title modal-title-log" id="example_modal_label_log_solicitudes"></h5>
	            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
	            	</button>
	        	</div>
		  		<form id="form_modal_log_solicitudes" enctype="multipart/form-data" action="" method="post">    
	  		    	<div class="modal-body">
						<div class="row align-items-end">
							<div class="col-lg-12">
								<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_log_solicitudes">
									<!-- JS Cierre Administrativo -->
								</div>
	  		            	</div>
						</div>  
					</div>
				</form>
	    	</div>
		</div>
	</div>
	<!-- Termino de CRUD LOG SOLICITUDES --> 

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
