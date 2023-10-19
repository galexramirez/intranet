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
	 		<div class="nav nav-tabs" id="nav-tab" role="tablist">
	    		<!-- <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">Control Facilitador</a> -->
				<a class="nav-item nav-link active" id="nav-distancias-tab" data-toggle="tab" href="#nav-distancias" role="tab" aria-controls="nav-distancias" aria-selected="true">Matriz Distancias</a>
				<!-- <a class="nav-item nav-link" id="nav-tipoTablaAccidentes-tab" data-toggle="tab" href="#nav-tipoTablaAccidentes" role="tab" aria-controls="nav-tipoTablaAccidentes" aria-selected="false">Accidentes</a> -->
				<!-- <a class="nav-item nav-link" id="nav-tipoTablaComportamiento-tab" data-toggle="tab" href="#nav-tipoTablaComportamiento" role="tab" aria-controls="nav-tipoTablaComportamiento" aria-selected="false">Comportamiento</a> -->
				<!-- <a class="nav-item nav-link" id="nav-tipoTablaInasistencias-tab" data-toggle="tab" href="#nav-tipoTablaInasistencias" role="tab" aria-controls="nav-tipoTablaInasistencias" aria-selected="false">Inasistencias</a> -->
				<a class="nav-item nav-link" id="nav-matriz-accidentes-tab" data-toggle="tab" href="#nav-matriz-accidentes" role="tab" aria-controls="nav-matriz-accidentes" aria-selected="false">Matriz Novedades</a>
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">

			<!-- TAB TABLAS CONTROL FACILITADOR
			<div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

				<section class="container-fluid py-3">
					<button id="btnNuevoTipoTablas" type="button" class="btn btn-info" data-toggle="modal">+ Nuevo</button>  
				</section>
	
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive">
							<table id="tablaTipoTablas" class="table table-striped table-bordered table-condensed w-80">
				    			<thead class="text-center">
				        			<tr>
									<th>ID</th>
				        		    <th>TIPO</th>
									<th>OPERACION</th>
									<th>DETALLE</th>
				        		    <th>ACCIONES</th>
				        			</tr>
				    			</thead>
				    			<tbody>
				    			</tbody>
							</table>
						</div>
					</div>
				</div>

				--Modal para CRUD--
				<div class="row modal fade" id="modalCRUDTipoTablas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog" role="document">
			        	<div class="modal-content">
			           
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
					  		<form id="formTipoTablas">    
			      		    	<div class="modal-body">
			      		        	<div class="row">
			      		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                  		<label for="" class="col-form-label">ID</label>
						                   		<input type="text" class="form-control" id="Ttabla_Id">
						               			<div id="MsTtabla_Id" class="invalid-feedback">Complete el campo.</div>
				  		               		</div>
			      		            	</div>
			      		            	<div class="col-lg-6">
				  		                	<div class="form-group">
												<label for="" class="col-form-label">Tipo</label>
						                   		<input type="text" class="form-control" id="Ttabla_Tipo">
						               			<div id="MsTtabla_Tipo" class="invalid-feedback">Complete el campo.</div>
											</div> 
			      		            	</div>    
			      		        	</div>
			      		        	<div class="row"> 
										<div class="col-lg-6">
				  		                	<div class="form-group">
						                		<label for="" class="col-form-label">Operacion</label>
												<input type="text" class="form-control" id="Ttabla_Operacion">
						               			<div id="MsTtabla_Operacion" class="invalid-feedback">Complete el campo.</div>
											</div> 
			      		            	</div>
									</div>
									<div class="row"> 
									  	<div class="col-lg-12">
				  		                	<div class="form-group">
												<label for="Ttabla_Detalle" class="col-form-label">Detalle</label>
			      				            	<textarea class="form-control z-depth-1" id="Ttabla_Detalle" rows="7" placeholder="escribe algo aqui..."></textarea>
						               			<div id="MsTtabla_Detalle" class="invalid-feedback">Complete el campo.</div>
											</div>               
						           		</div>
			      		        	</div>
								</div>
			      		    	<div class="modal-footer">
			      		        	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
			      		        	<button type="submit" id="btnGuardarTipoTablas" class="btn btn-dark">Guardar</button>
			      		    	</div>
			      			</form>    
			        	</div>
			    	</div>
				</div>  			
			</div>
			-->
			<!-- TAB DISTANCIAS -->
			<div class="tab-pane fade show active" id="nav-distancias" role="tabpanel" aria-labelledby="nav-distancias-tab">
				<section class="container-fluid py-3">
					<button id="btnNuevoDistancias" type="button" class="btn btn-secondary btn-sm btnNuevoDistancias" data-toggle="modal">+ Nuevo</button>  
				</section>
	
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive">
							<table id="tablaDistancias" class="table table-striped table-bordered table-condensed w-100">
				    			<thead class="text-center">
				        			<tr>
				        		    <th>NRO.ID</th>
									<th>OPERACION</th>
									<th>NRO.ORDEN</th>
									<th>SENTIDO</th>
									<th>SERVICIO</th>
									<th>L.ORIGEN</th>
									<th>L.DESTINO</th>
									<th>DISTANCIA</th>
				        		    <th>ACCIONES</th>
				        			</tr>
				    			</thead>
				    			<tbody>                           
				    			</tbody>
							</table>
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDDistancias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog" role="document">
			        	<div class="modal-content">
			           
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
					  		<form id="formDistancias">    
			      		    	<div class="modal-body">
			      		        	<div class="row">
			      		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                  		<label for="" class="col-form-label">NRO. ID</label>
						                   		<input type="text" class="form-control" id="Distancias_Id">
						               			<div id="MsDistancias_Id" class="invalid-feedback">Complete el campo.</div>
				  		               		</div>
			      		            	</div>
			      		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                		<label for="" class="col-form-label">OPERACION</label>
												<select class="form-control" id="Dist_Operacion">
												</select>
						               			<div id="MsDist_Operacion" class="invalid-feedback">Complete el campo.</div>
											</div> 
			      		            	</div>    
			      		        	</div>
			      		        	<div class="row"> 
										<div class="col-lg-6">
				  		                	<div class="form-group">
						                		<label for="" class="col-form-label">NRO. ORDEN</label>
												<input type="text" class="form-control" id="Dist_Orden">
						               			<div id="MsDist_Orden" class="invalid-feedback">Complete el campo.</div>
											</div> 
			      		            	</div>    
										<div class="col-lg-6">
				  		                	<div class="form-group">
						                   		<label for="" class="col-form-label">SENTIDO</label>
												<select class="form-control" id="Dist_Sentido">
												</select>
						               			<div id="MsDist_Sentido" class="invalid-feedback">Complete el campo.</div>
											</div>               
						           		</div>
									</div>  
									<div class="row"> 
										<div class="col-lg-6">
				  		                	<div class="form-group">
						                		<label for="" class="col-form-label">SERVICIO</label>
												<select class="form-control" id="Dist_Servicio">
												</select>
						               			<div id="MsDist_Servicio" class="invalid-feedback">Complete el campo.</div>
											</div> 
			      		            	</div>    
										<div class="col-lg-6">
				  		                	<div class="form-group">
						                   		<label for="" class="col-form-label">LUGAR ORIGEN</label>
												<select class="form-control" id="Dist_LugarOrigen">
												</select>
						               			<div id="MsDist_LugarOrigen" class="invalid-feedback">Complete el campo.</div>
											</div>               
						           		</div>
									</div>  
									<div class="row"> 
										<div class="col-lg-6">
						                  	<div class="form-group">
						                   		<label for="" class="col-form-label">LUGAR DESTINO</label>
												<select class="form-control" id="Dist_LugarDestino">
												</select>
												<div id="MsDist_LugarDestino" class="invalid-feedback">Complete el campo.</div>
				  		                	</div>
			      		            	</div>
										<div class="col-lg-6">
				  		                	<div class="form-group">
												<label for="" class="col-form-label">DISTANCIA EN KM</label>
						                   		<input type="text" class="form-control" id="Dist_Kilometros">
												<div id="MsDist_Kilometros" class="invalid-feedback">Complete el campo.</div>
											</div>               
						           		</div>
									</div>  
								</div>
			      		    	<div class="modal-footer">
			      		        	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
			      		        	<button type="submit" id="btnGuardarDistancias" class="btn btn-dark">Guardar</button>
			      		    	</div>
			      			</form>    
			        	
						</div>
			    	</div>
				</div>  			

			</div>

			<!-- TAB TABLAS ACCIDENTES -->
			<div class="tab-pane fade" id="nav-tipoTablaAccidentes" role="tabpanel" aria-labelledby="nav-tipoTablaAccidentes-tab">

				<section class="container-fluid py-3">
					<button id="btnNuevoTipoTablaAccidentes" type="button" class="btn btn-info" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive">
							<table id="tablaTipoTablaAccidentes" class="table table-striped table-bordered table-condensed w-80">
								<thead class="text-center">
									<tr>
									<th>ID</th>
									<th>TIPO</th>
									<th>OPERACION</th>
									<th>DETALLE</th>
									<th>ACCIONES</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDTipoTablaAccidentes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="formTipoTablaAccidentes">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="" class="col-form-label">ID</label>
										   		<input type="text" class="form-control" id="TtablaAccidentes_Id">
										   		<div id="MsTtablaAccidentes_Id" class="invalid-feedback">Complete el campo.</div>
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Tipo</label>
										   		<input type="text" class="form-control" id="TtablaAccidentes_Tipo">
										   		<div id="MsTtablaAccidentes_Tipo" class="invalid-feedback">Complete el campo.</div>
											</div> 
									 	</div>    
									</div>
					  				<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Operacion</label>
												<input type="text" class="form-control" id="TtablaAccidentes_Operacion">
										   		<div id="MsTtablaAccidentes_Operacion" class="invalid-feedback">Complete el campo.</div>
											</div> 
						  				</div>
									</div>
									<div class="row"> 
						  				<div class="col-lg-12">
									  		<div class="form-group">
												<label for="TtablaAccidentes_Detalle" class="col-form-label">Detalle</label>
										  		<textarea class="form-control z-depth-1" id="TtablaAccidentes_Detalle" rows="7" placeholder="escribe algo aqui..."></textarea>
										   		<div id="MsTtablaAccidentes_Detalle" class="invalid-feedback">Complete el campo.</div>
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarTipoTablaAccidentes" class="btn btn-dark">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			
			</div>

			<!-- TAB TABLAS COMPORTAMIENTO -->
			<div class="tab-pane fade" id="nav-tipoTablaComportamiento" role="tabpanel" aria-labelledby="nav-tipoComportamiento-tab">

				<section class="container-fluid py-3">
					<button id="btnNuevoTipoTablaComportamiento" type="button" class="btn btn-info" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive">
							<table id="tablaTipoTablaComportamiento" class="table table-striped table-bordered table-condensed w-80">
								<thead class="text-center">
									<tr>
									<th>ID</th>
									<th>TIPO</th>
									<th>OPERACION</th>
									<th>DETALLE</th>
									<th>ACCIONES</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
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
										  		<label for="" class="col-form-label">ID</label>
										   		<input type="text" class="form-control" id="TtablaComportamiento_Id">
										   		<div id="MsTtablaComportamiento_Id" class="invalid-feedback">Complete el campo.</div>
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Tipo</label>
										   		<input type="text" class="form-control" id="TtablaComportamiento_Tipo">
										   		<div id="MsTtablaComportamiento_Tipo" class="invalid-feedback">Complete el campo.</div>
											</div> 
									 	</div>    
									</div>
					  				<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Operacion</label>
												<input type="text" class="form-control" id="TtablaComportamiento_Operacion">
										   		<div id="MsTtablaComportamiento_Operacion" class="invalid-feedback">Complete el campo.</div>
											</div> 
						  				</div>
									</div>
									<div class="row"> 
						  				<div class="col-lg-12">
									  		<div class="form-group">
												<label for="TtablaComportamiento_Detalle" class="col-form-label">Detalle</label>
										  		<textarea class="form-control z-depth-1" id="TtablaComportamiento_Detalle" rows="7" placeholder="escribe algo aqui..."></textarea>
										   		<div id="MsTtablaComportamiento_Detalle" class="invalid-feedback">Complete el campo.</div>
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarTipoTablaComportamiento" class="btn btn-dark">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			

			</div>

			<!-- TAB TABLAS INASISTENCIAS -->
			<div class="tab-pane fade" id="nav-tipoTablaInasistencias" role="tabpanel" aria-labelledby="nav-tipoInasistencias-tab">

				<section class="container-fluid py-3">
					<button id="btnNuevoTipoTablaInasistencias" type="button" class="btn btn-info" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive">
							<table id="tablaTipoTablaInasistencias" class="table table-striped table-bordered table-condensed w-80">
								<thead class="text-center">
									<tr>
									<th>ID</th>
									<th>TIPO</th>
									<th>OPERACION</th>
									<th>DETALLE</th>
									<th>ACCIONES</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
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
										  		<label for="" class="col-form-label">ID</label>
										   		<input type="text" class="form-control" id="TtablaInasistencias_Id">
										   		<div id="MsTtablaInasistencias_Id" class="invalid-feedback">Complete el campo.</div>
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Tipo</label>
										   		<input type="text" class="form-control" id="TtablaInasistencias_Tipo">
										   		<div id="MsTtablaInasistencias_Tipo" class="invalid-feedback">Complete el campo.</div>
											</div> 
									 	</div>    
									</div>
					  				<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Operacion</label>
												<input type="text" class="form-control" id="TtablaInasistencias_Operacion">
										   		<div id="MsTtablaInasistencias_Operacion" class="invalid-feedback">Complete el campo.</div>
											</div> 
						  				</div>
									</div>
									<div class="row"> 
						  				<div class="col-lg-12">
									  		<div class="form-group">
												<label for="TtablaInasistencias_Detalle" class="col-form-label">Detalle</label>
										  		<textarea class="form-control z-depth-1" id="TtablaInasistencias_Detalle" rows="7" placeholder="escribe algo aqui..."></textarea>
										   		<div id="MsTtablaInasistencias_Detalle" class="invalid-feedback">Complete el campo.</div>
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarTipoTablaInasistencias" class="btn btn-dark">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			

			</div>

			<!-- TAB MATRIZ DE ACCIDENTES -->
			<div class="tab-pane fade" id="nav-matriz-accidentes" role="tabpanel" aria-labelledby="nav-matriz-accidentes-tab">

				<section class="container-fluid py-3">
					<button id="btn_nuevo_matriz_accidentes" type="button" class="btn btn-secondary btn-sm btn_nuevo_matriz_accidentes" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive">
							<table id="tabla_matriz_accidentes" class="table table-striped table-bordered table-condensed w-80">
								<thead class="text-center">
									<tr>
									<th>ID</th>
									<th>CAMPO</th>
									<th>BUSQUEDA</th>
									<th>RESPUESTA</th>
									<th>ACCIONES</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modal_crud_matriz_accidentes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="form_matriz_accidentes">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="accidentesmatriz_id" class="col-form-label form-control-sm">ID</label>
										   		<input type="text" readonly class="form-control form-control-sm" id="accidentesmatriz_id">
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="acmt_campo" class="col-form-label form-control-sm">CAMPO</label>
										   		<input type="text" class="form-control form-control-sm text-uppercase" maxlength="60" id="acmt_campo">
											</div> 
									 	</div>    
									</div>
					  				<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="acmt_busqueda" class="col-form-label form-control-sm">BUSQUEDA</label>
												<input type="text" class="form-control form-control-sm text-uppercase" maxlength="100" id="acmt_busqueda">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
						  				<div class="col-lg-12">
									  		<div class="form-group">
												<label for="acmt_respuesta" class="col-form-label form-control-sm">RESPUESTA (Máx. 2,000 carácteres)</label>
										  		<textarea class="form-control z-depth-1 form-control-sm text-uppercase" maxlength="2000" id="acmt_respuesta" rows="7" placeholder="escribe algo aqui..."></textarea>
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btn_guardar_matriz_accidentes" class="btn btn-dark btn-sm btn_guardar_matriz_accidentes">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			

			</div>

		</div>
	</div>
</div>