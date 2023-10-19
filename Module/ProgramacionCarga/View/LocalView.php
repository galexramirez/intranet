<!-- 2.2 CONTENIDO DE MODULO -->
<div  id="contenido" class="my-contenido-con-sidebar  p-0">
		
	<nav class="navbar navbar-light bg-light p-0">
		<div class="container-fluid">

			<a class="navbar-brand text-muted" href="#">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
 			 	<path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
				</svg>
				<?= $NombreDeModuloVista ?>
			</a>
		</div>
	</nav>

	<!-- Contenido para el Modulo -->
	<div class="my-contenidoModulo container-fluid pl-0 pr-0 ml-0 mr-0">

		<nav>
	 		<div class="nav nav-tabs" id="nav-tab-ProgramacionCarga" role="tablist">
				<!-- PHP Accesos Creacion Tabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">

	  		<!-- TAB CARGA -->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<form id="formSeleccionProgramacionCarga" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-1 col-sm-12">

						<div class="col-lg-1">
				        	<div class="form-group">
								<label for="selectAniosProgramacionCarga" class="col-form-label form-control-sm">AÑO</label>
								<select name="selectAniosProgramacionCarga" class="form-control form-control-sm" id="selectAniosProgramacionCarga">
						    	</select>
					       	</div>
			        	</div>
						
						<div class="col-md-2">
				        	<div class="form-group">
								<label for="selectSemanasProgramacionCarga" class="col-form-label form-control-sm">SEMANA</label>
								<select name="selectSemanasProgramacionCarga" class="form-control form-control-sm zonal_selected" placeholder="m" id="selectSemanasProgramacionCarga">
							    <option disabled selected>Semana</option>
								</select>	
					       	</div>
			        	</div>
						<div class="col-lg-2">
				        	<div class="form-group" id="div_btn-ProgramacionCarga">
								<!-- PHP Accesos Botones Formulario -->
							</div>
			        	</div>   
					
					</div>
				</form>

			   	<div class="container-fluid caja">
					<div class="row p-1">
				       	<div class="col-auto m-0">
				       		<div class="table-responsive" id="div_tablaProgramacionCarga">        
				           		<!-- PHP Accesos Creacion Tablas -->
				            </div>
				        </div>
				    </div>  
				</div>   
			
				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDProgramacionCarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
					  		<form id="formProgramacionCarga" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
			      		        	<div class="row align-items-end">
			      		            	<div class="col-lg-10">
				  		                	<div class="form-group">
												<label for="LabelD3" class="col-form-label form-control-sm">Cargar Archivo</label>
												<div class="custom-file">
									  				<label id="LabelD3" class="custom-file-label form-control-sm" for="customFileLang">Seleccionar Archivo .csv o .xlsx</label>
									  				<input type="file" class="custom-file-input form-control-sm" id="D3" lang="es" accept=".csv, .xlsx"> 
												</div>
				  		               		</div>
			      		            	</div>
			      		            	<div class="col-lg-2 py-1">
				  		                	<div class="form-group">
												<button type="submit" id="btnCargarProgramacion" class="btn btn-secondary btn-sm">Cargar</button>
				  		               		</div>
			      		            	</div>
			      		            </div>    
			      		        </div>
			      		    	<div class="modal-footer" id="div_ResultadoProgramacionCarga">

								</div>
			      			</form>
						
			        	</div>
			    	</div>
				</div>

			</div>
			  	
			<!-- TAB PUBLICACION -->
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<form id="formSeleccionPublicacionCarga" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-1 col-sm-12">
						<div class="col-lg-1">
				        	<div class="form-group">
					        	<label for="selectAniosPublicacionCarga" class="col-form-label form-control-sm">AÑO</label>
								<select class="form-control form-control-sm" id="selectAniosPublicacionCarga" name="selectAniosPublicacionCarga">
					    			<option disabled selected>año</option>	
						    	</select>
					       	</div>
			        	</div>
						<div class="col-lg-2">             	
							<div class="form-group" id="div_btn-PublicacionCarga">
								<!-- Accessos BotonesFormulario -->
						   	</div>
			        	</div>   
					</div>
				</form>
			   	
				<div class="container-fluid caja w-auto">
		    	   	<div class="row p-1">
		        	   	<div class="col-auto m-0">
		            		<div class="table-responsive" id="div_tablaPublicacionCarga">        
		                		<!-- Accesos CracionTabla -->               
		            		</div>
		           		</div>
		       		</div>  
		   		</div>   
	  		
				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDPublicacionCarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog " role="document">
			        	<div class="modal-content">
			           
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
					  		<form id="formPublicacionCarga" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
			      		        	<div class="row align-items-end">
			      		            	<div class="col-lg-9">
				  		                	<div class="form-group">
						                  		<label for="selectSemanasPublicacionCarga" class="col-form-label form-control-sm">Semana a generar:</label>
												<select class="form-control form-control-sm" id="selectSemanasPublicacionCarga" name="selectSemanasPublicacionCarga">
					    							<option disabled selected>año-semana</option>
						    					</select>
				  		               		</div>
			      		            	</div>
			      		            	<div class="col-lg-3">
				  		                	<div class="form-group">
												<button type="submit" id="btnCargarPublicacion" class="btn btn-secondary btn-sm">Generar</button>
				  		               		</div>
			      		            	</div>
			      		            </div>    
			      		        </div>
			      		    	<div class="modal-footer" id="div_ResultadoPublicacionCarga">
			      		    	</div>
			      			</form>
						
			        	</div>
			    	</div>
				</div>
			</div>
			  	
			<!-- TAB DETALLE -->
			<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
				<form id="formSeleccionDetalleProgramacion" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-1 col-sm-12">
						<div class="col-lg-1">
				        	<div class="form-group">
								<label for="FechaInicio" class="col-form-label form-control-sm">F.INICIO</label>
								<input type="date" class="form-control form-control-sm" id="FechaInicio" placeholder="aaaa-mm-dd">
							</div>
			        	</div>
						<div class="col-lg-1">
				        	<div class="form-group">
								<label for="FechaTermino" class="col-form-label form-control-sm">F.TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="FechaTermino" placeholder="aaaa-mm-dd">
					       	</div>
			        	</div>
						<div class="col-lg-1">             	
							<div class="form-group">
								<label for="Prog_Dni" class="col-form-label form-control-sm">DNI</label>
						        <input type="number" class="form-control form-control-sm" id="Prog_Dni" maxlength="8">
							</div>
			       		</div> 
						<div class="col-lg-1">
							<div class="form-group">
								<button type="button" id="btnMostrarDetalleProgramacion" class="btn btn-secondary btn-sm">Mostrar</button>
							</div>
			        	</div>   
					</div>
				</form>

				<div class="container-fluid caja w-auto">
				    <div class="row p-1">
				        <div class="col-auto m-0">
				            <div class="table-responsive" id="div_tablaDetalleProgramacion">        
				                <!-- Accesos CreacionTabla -->               
			           		</div>
			          	</div>
			      	</div>  
				</div>   
			</div>

			<!-- TAB PDF -->
			<div class="tab-pane fade" id="nav-pdf" role="tabpanel" aria-labelledby="nav-pdf-tab">

				<form id="formSeleccionPDF" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-1 col-sm-12">
						<div class="col-lg-1">
				        	<div class="form-group">
					        	<label for="selectAniosPDF" class="col-form-label form-control-sm">AÑO</label>
								<select class="form-control form-control-sm" id="selectAniosPDF" name="selectAniosPDF">
					    			<option disabled selected>año</option>	
						    	</select>
					       	</div>
			        	</div>
						<div class="col-lg-1">
							<div class="form-group">
								<label for="PDF_Dni" class="col-form-label form-control-sm">DNI</label>
						        <input type="number" class="form-control form-control-sm" id="PDF_Dni" maxlength="8">
							</div>
			       		</div> 
						
						<div class="col-lg-1">
							<div class="form-group">
								<button type="button" id="btnMostrarPDF"class="btn btn-secondary btn-sm"> Mostrar </button>
							</div>
			       		</div> 

					</div>
				</form>
			   	
				<div class="container-fluid caja w-auto">
		    	   	<div class="row p-1">
		        	   	<div class="col-auto m-0">
		            		<div class="table-responsive" id="div_tablaPDF">        
		                		<!-- Accesos CreacionTabla -->               
		            		</div>
		           		</div>
		       		</div>  
		   		</div>   

			</div>

			<!-- TAB REGISTRO DE DESCARGA PDF -->
			<div class="tab-pane fade" id="nav-descargaPdf" role="tabpanel" aria-labelledby="nav-descargaPdf-tab">
				<form id="formDescargaPdf" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-1 col-sm-12">
						<div class="col-lg-1">
				        	<div class="form-group">
								<label for="Desc_FechaInicio" class="col-form-label form-control-sm">F.INICIO</label>
								<input type="date" class="form-control form-control-sm" id="Desc_FechaInicio" placeholder="aaaa-mm-dd">
							</div>
			        	</div>
						<div class="col-lg-1">
				        	<div class="form-group">
								<label for="Desc_FechaTermino" class="col-form-label form-control-sm">F.TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="Desc_FechaTermino" placeholder="aaaa-mm-dd">
					       	</div>
			        	</div>
				
						<div class="col-lg-1">             	
							<div class="form-group">
								<label for="Desc_Prog_Dni" class="col-form-label">DNI</label>
						        <input type="number" class="form-control form-control-sm" id="Desc_Prog_Dni" maxlength="8">
							</div>
			       		</div> 

						<div class="col-lg-2">
							<div class="form-group">
								<button type="button" id="btnMostrarDescargaPdf" class="btn btn-secondary btn-sm"> Mostrar </button>
							</div>
			        	</div>   
					
					</div>
				</form>

				<div class="container-fluid caja w-auto">
				    <div class="row p-1">
				        <div class="col-auto m-0">
				            <div class="table-responsive" id="div_tablaDescargaPdf">        
				                <!-- Accesos CreacionTabla -->               
			           		</div>
			          	</div>
			      	</div>  
				</div>   
			</div>


		</div>	
	
	</div>
</div>