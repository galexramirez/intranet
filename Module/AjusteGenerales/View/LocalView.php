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
	</nav>

	<!-- Contenido para el Modulo -->
	<div class="my-contenidoModulo container-fluid pl-0 pr-0 ml-0 mr-0">

		<nav>
	 		<div class="nav nav-tabs" id="nav-tab-AjusteGenerales" role="tablist">
				<!-- PHP Accesos Creacion de Tabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">

	  		<!-- TAB BUSES -->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<section class="container-fluid py-3">
					<button id="btnNuevoBuses" type="button" class="btn btn-secondary btn-sm" data-toggle="modal">+ Nuevo</button>  
				</section>
	
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaBuses">
							<!-- PHP Creacion de Tablas -->
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDBuses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog" role="document">
			        	<div class="modal-content">
			           
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
					  		<form id="formBuses">    
			      		    	<div class="modal-body">
			      		        	<div class="row">
			      		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                  		<label for="" class="col-form-label">Nro. Externo</label>
						                   		<input type="text" class="form-control" id="Bus_NroExterno">
				  		               		</div>
			      		            	</div>
			      		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                		<label for="" class="col-form-label">Nro. VID</label>
												<input type="text" class="form-control" id="Bus_NroVid">
											</div> 
			      		            	</div>    
			      		        	</div>
			      		        	<div class="row"> 
			      		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                   		<label for="" class="col-form-label">Nro. Placa</label>
												<input type="text" class="form-control" id="Bus_NroPlaca">
											</div>               
						           		</div>
						               	<div class="col-lg-6">
						                  	<div class="form-group">
						                   		<label for="" class="col-form-label">Operación</label>
						                   		<select class="form-control" id="Bus_Operacion">
								   					<option disabled selected>Selecciona una opción</option>
						    						<option value="ALIMENTADOR">ALIMENTADOR</option>
							    					<option value="TRONCAL">TRONCAL</option>
													<option value="PRE-TRONCAL">PRE-TRONCAL</option>
													<option value="AUXILIO MECANICO">AUXILIO MECANICO</option>
												</select>										  
				  		                	</div>
			      		            	</div>
									</div>  
									<div class="row"> 
			      		            	<div class="col-lg-12">
				  		                	<div class="form-group">
						                   		<label for="" class="col-form-label">Detalle</label>
												<input type="text" class="form-control" id="Bus_Detalle">
											</div>               
						           		</div>
									</div>  
									<div class="row"> 
			      		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                   		<label for="" class="col-form-label">Tipo</label>
												<input type="text" class="form-control" id="Bus_Tipo">
											</div>               
						           		</div>
						               	<div class="col-lg-6">
						                  	<div class="form-group">
						                   		<label for="" class="col-form-label">Tipo 2</label>
						                   		<input type="text" class="form-control" id="Bus_Tipo2">
				  		                	</div>
			      		            	</div>
									</div>  
									<div class="row"> 
			      		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                   		<label for="" class="col-form-label">Estado</label>
												<input type="text" class="form-control" id="Bus_Estado">
											</div>               
						           		</div>
						               	<div class="col-lg-6">
						                  	<div class="form-group">
						                   		<label for="" class="col-form-label">Tanques</label>
						                   		<input type="text" class="form-control" id="Bus_Tanques">
				  		                	</div>
			      		            	</div>
									</div>  
								</div>
			      		    	<div class="modal-footer">
			      		        	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
			      		        	<button type="submit" id="btnGuardarBuses" class="btn btn-dark">Guardar</button>
			      		    	</div>
			      			</form>    
			        	
						</div>
			    	</div>
				</div>  			

			</div>

			<!-- TAB ROLES DE USUARIOS -->
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

				<section class="container-fluid py-3">
					<button id="btn_nuevo_roles" type="button" class="btn btn-secondary btn-sm btn_nuevo_roles" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_roles">

						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modal_crud_roles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="form_roles">
				  				<div class="modal-body">
					  				<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="roles_id" class="col-form-label form-control-sm">ID</label>
												<input type="text" readonly class="form-control form-control-sm" id="roles_id">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="roles_dni" class="col-form-label form-control-sm">Nro. DNI</label>
												<input type="text" class="form-control form-control-sm" id="roles_dni" maxlength="8">
											</div> 
									  	</div>    
					  				</div>
					  				<div class="row"> 
										<div class="col-lg-12">
							  				<div class="form-group">
												<label for="roles_apellidosnombres" class="col-form-label form-control-sm">APELLIDOS Y NOMBRES</label>
												<input type="text" readonly class="form-control form-control-sm" id="roles_apellidosnombres">
											</div>
						  				</div>
									</div>
									<div class="row">
						  				<div class="col-lg-6">
							  				<div class="form-group">
												<label for="roles_nombrecorto" class="col-form-label form-control-sm">NOMBRE CORTO</label>
												<input type="text" readonly class="form-control form-control-sm" id="roles_nombrecorto">
											</div>               
						   				</div>
										<div class="col-lg-6">
							  				<div class="form-group">
												<label for="roles_perfil" class="col-form-label form-control-sm">PERFIL</label>
												<input type="text" class="form-control form-control-sm text-uppercase" maxlength="45" id="roles_perfil">
											</div>
						  				</div>
									</div>
								</div>
								<div class="modal-footer">
					  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btn_guardar_roles" class="btn btn-dark btn-sm">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			
			</div>

			<!-- TAB CALENDARIO -->
			<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

				<section class="container-fluid py-3">
					<div id="div_btnNuevoCalendario">

					</div>
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaCalendario">
							
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDCalendario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="formCalendario">    
				  				<div class="modal-body">
					  				<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="Calendario_Id" class="col-form-label form-control-sm">FECHA</label>
												<input type="date" class="form-control form-control-sm" id="Calendario_Id" placeholder="dd/mm/aaaaa">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="Calendario_Anio" class="col-form-label form-control-sm">AÑO</label>
												<input type="number" class="form-control form-control-sm" id="Calendario_Anio" maxlength="4">
											</div> 
									  	</div>    
					  				</div>
					  				<div class="row"> 
										<div class="col-lg-6">
							  				<div class="form-group">
												<label for="Calendario_TipoDia" class="col-form-label form-control-sm">TIPO DIA</label>
												<select class="form-control form-control-sm" id="Calendario_TipoDia">
												</select>
											</div>
						  				</div>
						  				<div class="col-lg-6">
							  				<div class="form-group">
												<label for="Calendario_Semana" class="col-form-label form-control-sm">SEMANA</label>
												<input type="text" class="form-control form-control-sm" id="Calendario_Semana" maxlength="21">
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarCalendario" class="btn btn-dark btn-sm btnGuardarCalendario">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			
			</div>

			<!-- TAB PERIODO -->
			<div class="tab-pane fade" id="nav-periodo" role="tabpanel" aria-labelledby="nav-periodo-tab">

				<section class="container-fluid py-3">
					<div id="div_btn_nuevo_periodo">

					</div>
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_periodo">
							
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modal_crud_periodo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="form_periodo">    
				  				<div class="modal-body">
					  				<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="periodo_id" class="col-form-label form-control-sm">PERIODO ID</label>
												<input type="text" readonly class="form-control form-control-sm" id="periodo_id">
											</div>
										</div>
					  				</div>
					  				<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="peri_anio" class="col-form-label form-control-sm">AÑO</label>
												<input type="number" class="form-control form-control-sm" id="peri_anio">
											</div> 
									  	</div>    
										  <div class="col-lg-6">
											<div class="form-group">
												<label for="peri_mes" class="col-form-label form-control-sm">MES</label>
												<select class="form-control form-control-sm" id="peri_mes">
													<option value="ENERO">ENERO</option>
													<option value="FEBRERO">FEBRERO</option>
													<option value="MARZO">MARZO</option>
													<option value="ABRIL">ABRIL</option>
													<option value="MAYO">MAYO</option>
													<option value="JUNIO">JUNIO</option>
													<option value="JULIO">JULIO</option>
													<option value="AGOSTO">AGOSTO</option>
													<option value="SETIEMBRE">SETIEMBRE</option>
													<option value="OCTUBRE">OCTUBRE</option>
													<option value="NOVIEMBRE">NOVIEMBRE</option>
													<option value="DICIEMBRE">DICIEMBRE</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row"> 
										<div class="col-lg-6">
							  				<div class="form-group">
												<label for="peri_proceso" class="col-form-label form-control-sm">PROCESO</label>
												<input type='text' class="form-control form-control-sm text-uppercase" id="peri_proceso">
											</div>
						  				</div>
						  				<div class="col-lg-6">
							  				<div class="form-group">
												<label for="peri_descripcion" class="col-form-label form-control-sm">PERIODO</label>
												<input type="text" readonly class="form-control form-control-sm" id="peri_descripcion">
											</div>               
						   				</div>
					  				</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="peri_fecha_inicio" class="col-form-label form-control-sm">FECHA INICIO</label>
												<input type="date" class="form-control form-control-sm" id="peri_fecha_inicio" placeholder="dd/mm/aaaaa">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
											<label for="peri_fecha_termino" class="col-form-label form-control-sm">FECHA TERMINO</label>
												<input type="date" class="form-control form-control-sm" id="peri_fecha_termino" placeholder="dd/mm/aaaaa">
											</div> 
									  	</div>    
					  				</div>

								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btn_guardar:periodo" class="btn btn-dark btn-sm btn_guardar_periodo">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			
			</div>

			<!-- TAB TIPO DE CAMBIO -->
			<div class="tab-pane fade" id="nav-tipocambio" role="tabpanel" aria-labelledby="nav-tipocambio-tab">
				<section class="container-fluid py-3">
					<button id="btnNuevoTipoCambio" type="button" class="btn btn-secondary btn-sm" data-toggle="modal">+ Nuevo</button>  
					<button id="btnCargarTipoCambio" type="button" class="btn btn-secondary btn-sm" data-toggle="modal">Cargar</button>  
				</section>
	
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive">
							<table id="tablaTipoCambio" class="table table-striped table-bordered table-condensed w-100">
				    			<thead class="text-center">
				        			<tr>
				        		    	<th>NRO.ID</th>
										<th>FECHA</th>
										<th>MONEDA</th>
										<th>TIPO</th>
										<th>VALOR</th>
				        		    	<th>ACCIONES</th>
				        			</tr>
				    			</thead>
				    			<tbody>                           
				    			</tbody>
							</table>
						</div>
					</div>
				</div>

				<!-- Modal para CRUD -->
				<div class="row modal fade" id="modalCRUDTipoCambio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog" role="document">
			        	<div class="modal-content">
			           
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
					  		<form id="formTipoCambio">    
			      		    	<div class="modal-body">
			      		        	<div class="row">
			      		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                  		<label for="" class="col-form-label">NRO. ID</label>
						                   		<input type="text" class="form-control" id="tipocambio_id">
				  		               		</div>
			      		            	</div>
			      		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                		<label for="" class="col-form-label">FECHA</label>
												<input type="date" class="form-control" id="tipocambio_fecha">
											</div> 
			      		            	</div>    
			      		        	</div>
			      		        	<div class="row"> 
			      		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                   		<label for="" class="col-form-label">MONEDA</label>
												<input type="text" class="form-control" id="tipocambio_moneda">
											</div>               
						           		</div>
						               	<div class="col-lg-6">
						                  	<div class="form-group">
						                   		<label for="" class="col-form-label">TIPO</label>
						                   		<input type="text" class="form-control" id="tipocambio_tipo">
				  		                	</div>
			      		            	</div>
									</div>  
									<div class="row"> 
			      		            	<div class="col-lg-6">
				  		                	<div class="form-group">
												<label for="tipocambio_valor" class="col-form-label">VALOR</label>
												<input type="text" class="form-control" id="tipocambio_valor">
											</div>               
						           		</div>
									</div>  
								</div>
			      		    	<div class="modal-footer">
			      		        	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
			      		        	<button type="submit" id="btnGuardarTipoCambio" class="btn btn-dark">Guardar</button>
			      		    	</div>
			      			</form>    
			        	
						</div>
			    	</div>
				</div>  			

				<!-- Modal para Cargar Tipo Cambio de URL -->
				<div class="row modal fade" id="modalCRUDCargarTipoCambio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
			           
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
					  		<form id="formCargarTipoCambio">    
			      		    	<div class="modal-body">
			      		        	<div class="row">
			      		            	<div class="col-lg-12">
				  		                	<div class="form-group">
						                  		<label for="" class="col-form-label">URL</label>
						                   		<input type="text" class="form-control" id="tipocambio_url">
				  		               		</div>
			      		            	</div>
			      		        	</div>
			      		        	<div class="row"> 
			      		            	<div class="col-lg-3">
				  		                	<div class="form-group">
						                   		<label for="" class="col-form-label">FECHA INICIO</label>
												<input type="date" class="form-control" id="tipocambio_fechainicio">
											</div>               
						           		</div>
						               	<div class="col-lg-3">
						                  	<div class="form-group">
						                   		<label for="" class="col-form-label">FECHA FIN</label>
						                   		<input type="date" class="form-control" id="tipocambio_fechafin">
				  		                	</div>
			      		            	</div>
										<div class="col-lg-3">
						                  	<div class="form-group">
						                   		<label for="" class="col-form-label">MONEDA</label>
						                   		<input type="text" class="form-control" id="tipocambio_monedacarga">
				  		                	</div>
			      		            	</div>
									</div>  
								</div>
			      		    	<div class="modal-footer">
			      		        	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
			      		        	<button type="submit" id="btnImportarTipoCambio" class="btn btn-dark">Importar</button>
			      		    	</div>
			      			</form>    
			        	
						</div>
			    	</div>
				</div>  			

			</div>

			<!-- TAB MODULOS -->
			<div class="tab-pane fade" id="nav-modulo" role="tabpanel" aria-labelledby="nav-modulo-tab">
				<section class="container-fluid py-3">
					<button id="btnNuevoModulo" type="button" class="btn btn-secondary btn-sm" data-toggle="modal">+ Nuevo</button>  
				</section>
	
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaModulo">
							
						</div>
    				</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDModulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog" role="document">
			        	<div class="modal-content">
						    <div class="modal-header">
				                <h5 class="modal-title" id="exampleModalLabel"></h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				                </button>
			    	        </div>
						  	<form id="formModulo">    
			      			    <div class="modal-body">
			      			        <div class="row">
			      			            <div class="col-lg-6">
				  		    	            <div class="form-group">
						        	          	<label for="Modulo_Id" class="col-form-label form-control-sm">ID</label>
						            	       	<input type="text" readonly class="form-control form-control-sm" id="Modulo_Id">
				  		               		</div>
				      		            </div>
				      		            <div class="col-lg-6">
					  		                <div class="form-group">
							                   <label for="ModNombre" class="col-form-label form-control-sm">NOMBRE</label>
							                   <input type="text" class="form-control form-control-sm" id="Mod_Nombre" maxlength="100">
				  			                </div> 
			      		    	        </div>    
			      		        	</div>
				      		        <div class="row"> 
				      		            <div class="col-lg-12">
					  		                <div class="form-group">
							                   	<label for="Mod_NombreVista" class="col-form-label form-control-sm">NOMBRE DE VISTA</label>
							                   	<input type="text" class="form-control form-control-sm" id="Mod_NombreVista" maxlength="25">
							               	</div>               
						    	       </div>
				      		        </div>
				      		        <div class="row"> 
				      		            <div class="col-lg-6">
					  		                <div class="form-group">
							                   	<label for="mod_tipo" class="col-form-label form-control-sm">TIPO</label>
							                   	<select type="text" class="form-control form-control-sm" id="mod_tipo">
												   <option value="Modulo">Modulo</option>
        											<option value="Plegable">Plegable</option>
												</select>
							               	</div>               
						    	       </div>
									   <div class="col-lg-6">
					  		                <div class="form-group">
							                   	<label for="mod_plegable" class="col-form-label form-control-sm">MENU PLEGABLE</label>
							                   	<input type="text" class="form-control form-control-sm" id="mod_plegable" maxlength="25">
							               	</div>               
						    	       </div>
									</div>
									<div class="row"> 
					        	       	<div class="col-lg-12">
						            	    <div class="form-group">
						                	   	<label for="Mod_Icono" class="col-form-label form-control-sm">LINK DE ICONO</label>
						                   		<input type="text" class="form-control form-control-sm" id="Mod_Icono" maxlength="2000">
					  		                </div>
				      		            </div>  
				      		        </div>

								</div>
			      			    <div class="modal-footer">
			      			        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
			      		    	    <button type="submit" id="btnGuardarModelo" class="btn btn-dark btnGuardarModelo btn-sm">Guardar</button>
			      		    	</div>
			      			</form>    
			        	</div>
			    	</div>
				</div>

			</div>

			<!-- TAB PERMISOS -->
			<div class="tab-pane fade" id="nav-permisos" role="tabpanel" aria-labelledby="nav-permisos-tab">
				<section class="container-fluid py-3">
					<button id="btnNuevoPermisos" type="button" class="btn btn-secondary btn-sm" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaPermisos">
							
						</div>
    				</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDPermisos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog" role="document">
			        	<div class="modal-content">
						    <div class="modal-header">
				                <h5 class="modal-title" id="exampleModalLabel"></h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				                </button>
			    	        </div>
						  	<form id="formPermisos">    
				      		    <div class="modal-body">
				      		        <div class="row">
				      		            <div class="col-lg-6">
					  		                <div class="form-group">
							                  	<label for="Permiso_Id" class="col-form-label form-control-sm">ID</label>
							                   	<input type="text" readonly class="form-control form-control-sm" id="Permiso_Id">
				  		        	       	</div>
			      		            	</div>
				      		            <div class="col-lg-6">
					  		                <div class="form-group">
							                	<label for="PER_UsuarioId" class="col-form-label form-control-sm">DNI</label>
												<input type="text" class="form-control form-control-sm" id="PER_UsuarioId" maxlength="8">
				  			                </div> 
			      			            </div>    
			      		    	    </div>
			      		        	<div class="row"> 
										<div class="col-lg-6">
					  		                <div class="form-group">
							                	<label for="nombre_corto" class="col-form-label form-control-sm">USUARIO</label>
												<input type="text" readonly class="form-control form-control-sm" id="nombre_corto">
				  			                </div> 
			      			            </div>    
										<div class="col-lg-6">
				  		                	<div class="form-group">
						                   		<label for="PER_ModuloId" class="col-form-label form-control-sm">MODULO</label>
											   	<select class="form-control form-control-sm" id="PER_ModuloId">
												</select>
						               		</div>               
						           		</div>
			      		        	</div>
			      		        	<div class="row"> 
			      		            	<div class="col-lg-6">
				  		                	<div class="form-group">
												<label for="PER_ModInicio" class="col-form-label form-control-sm">MODULO DE INICIO</label>
						                   		<select class="form-control form-control-sm" id="PER_ModInicio">
								   					<option disabled selected>Selecciona una opción</option>
						    						<option value="NO">NO</option>
							    					<option value="SI">SI</option>
												</select>										  
						               		</div>               
						           		</div>
			      		        	</div>
								</div>
			      		    	<div class="modal-footer">
			      		        	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
			      		        	<button type="submit" id="btnGuardarPermisos" class="btn btn-dark btn-sm btnGuardarPermisos">Guardar</button>
			      		    	</div>
			      			</form>    
			        	</div>
			    	</div>
				</div>  			
			</div>

			<!-- TAB OBJETOS -->
			<div class="tab-pane fade" id="nav-objetos" role="tabpanel" aria-labelledby="nav-objetos-tab">
				<section class="container-fluid py-3">
					<button id="btnNuevoObjeto" type="button" class="btn btn-secondary btn-sm" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaObjetos">
							<!-- PHP Accesos Creacion de tablas -->
						</div>
    				</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDObjetos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="formObjetos">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="" class="col-form-label">ID</label>
										   		<input type="text" readonly class="form-control" id="objetos_id">
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="obj_nombremodulo" class="col-form-label">MODULO</label>
										   		<select class="form-control" id="obj_nombremodulo">

												</select>
											</div> 
									 	</div>    
									</div>
					  				<div class="row"> 
										<div class="col-lg-12">
									  		<div class="form-group">
												<label for="" class="col-form-label">NOMBRE</label>
												<input type="text" class="form-control" id="obj_nombreobjeto" maxlength="100">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
						  				<div class="col-lg-12">
									  		<div class="form-group">
												<label for="obj_descripcion" class="col-form-label">DESCRIPCION (Máx.200 caracteres)</label>
										  		<textarea class="form-control z-depth-1 text-uppercase" id="obj_descripcion" rows="7" placeholder="escribe algo aqui..." maxlength="200"></textarea>
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarObjeto" class="btn btn-dark">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>
			</div>

			<!-- TAB CONTROL DE ACCESOS -->
			<div class="tab-pane fade" id="nav-controlaccesos" role="tabpanel" aria-labelledby="nav-controlaccesos-tab">
				<section class="container-fluid py-3">
					<button id="btnNuevoControlAccesos" type="button" class="btn btn-secondary btn-sm" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaControlAccesos">
							
						</div>
    				</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDControlAccesos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog" role="document">
			        	<div class="modal-content">
						    <div class="modal-header">
				                <h5 class="modal-title" id="exampleModalLabel"></h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				                </button>
			    	        </div>
						  	<form id="formControlAccesos">    
				      		    <div class="modal-body">
				      		        <div class="row">
				      		            <div class="col-lg-6">
					  		                <div class="form-group">
							                  	<label for="" class="col-form-label">ID</label>
							                   	<input type="text" class="form-control" id="controlaccesos_id" disabled="true">
				  		        	       	</div>
			      		            	</div>
				      		            <div class="col-lg-6">
					  		                <div class="form-group">
							                	<label for="" class="col-form-label">PERFIL</label>
												<select class="form-control" id="cacces_perfil">
												</select>
				  			                </div> 
			      			            </div>    
			      		    	    </div>
			      		        	<div class="row"> 
			      		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                   		<label for="" class="col-form-label">MODULO</label>
											   	<select class="form-control" id="cacces_nombremodulo">
												
												</select>
						               		</div>               
						           		</div>
						               	<div class="col-lg-6">
						                  	<div class="form-group">
						                   		<label for="" class="col-form-label">OBJETO</label>
						                   		<select class="form-control" id="cacces_nombreobjeto">

												</select>
				  		                	</div>
			      		            	</div>  
			      		        	</div>
			      		        	<div class="row"> 
			      		            	<div class="col-lg-6">
				  		                	<div class="form-group">
												<label for="" class="col-form-label">Acceso</label>
						                   		<select class="form-control" id="cacces_acceso">
								   					<option disabled selected>Selecciona una opción</option>
						    						<option value="NO">NO</option>
							    					<option value="SI">SI</option>
												</select>										  
						               		</div>               
						           		</div>
			      		        	</div>
								</div>
			      		    	<div class="modal-footer">
			      		        	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
			      		        	<button type="submit" id="btnGuardarControlAccesos" class="btn btn-dark">Guardar</button>
			      		    	</div>
			      			</form>    
			        	</div>
			    	</div>
				</div>  			
			</div>

			<!-- TAB MAESTRO -->
			<div class="tab-pane fade" id="nav-maestrouno" role="tabpanel" aria-labelledby="nav-maestrouno-tab">
				<section class="container-fluid py-3">
					<button id="btnNuevoMaestrouno" type="button" class="btn btn-secondary btn-sm" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaMaestrouno">
							<!-- PHP Accesos Creacion de tablas -->
						</div>
    				</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDMaestrouno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="formMaestrouno">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="" class="col-form-label">ID</label>
										   		<input type="text" class="form-control" id="ttablamaestrouno_id">
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Ficha</label>
										   		<input type="text" class="form-control text-uppercase" id="ttablamaestrouno_operacion" maxlength="45">
											</div> 
									 	</div>    
									</div>
					  				<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Categoría 1</label>
												<input type="text" class="form-control text-uppercase" id="ttablamaestrouno_tipo" maxlength="45">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
						  				<div class="col-lg-12">
									  		<div class="form-group">
												<label for="ttablamaestrouno_detalle" class="col-form-label">Categoría 2</label>
										  		<textarea class="form-control z-depth-1 text-uppercase" id="ttablamaestrouno_detalle" rows="7" placeholder="escribe algo aqui..." maxlength="250"></textarea>
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarMaestrouno" class="btn btn-dark">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>
			</div>

			<!-- TAB USUARIO -->
			<div class="tab-pane fade" id="nav-usuario" role="tabpanel" aria-labelledby="nav-usuario-tab">
				<section class="container-fluid py-3">
					<button id="btnNuevoUsuario" type="button" class="btn btn-secondary btn-sm" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaUsuario">
							<!-- PHP Accesos Creacion de tablas -->
						</div>
    				</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="formUsuario">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="" class="col-form-label">ID</label>
										   		<input type="text" class="form-control" id="ttablausuario_id">
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Ficha</label>
										   		<input type="text" class="form-control text-uppercase" id="ttablausuario_operacion" maxlength="45">
											</div> 
									 	</div>    
									</div>
					  				<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Categoría 1</label>
												<input type="text" class="form-control text-uppercase" id="ttablausuario_tipo" maxlength="45">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
						  				<div class="col-lg-12">
									  		<div class="form-group">
												<label for="ttablaUsuario_detalle" class="col-form-label">Categoría 2</label>
										  		<textarea class="form-control z-depth-1 text-uppercase" id="ttablausuario_detalle" rows="7" placeholder="escribe algo aqui..." maxlength="250"></textarea>
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarUsuario" class="btn btn-dark">Guardar</button>
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