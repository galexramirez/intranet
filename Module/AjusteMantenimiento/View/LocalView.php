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
	 		<div class="nav nav-tabs" id="nav-tab-AjusteMantenimiento" role="tablist">
	    		<!-- PHP Accesos Creacion de Tabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">

	  		<!-- TAB OT PREVENTIVAS -->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<section class="container-fluid py-3">
					<button id="btnNuevoTipoTablaOTPreventivas" type="button" class="btn btn-secondary btn-sm btnNuevoTipoTablaOTPreventivas" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaTipoTablaOTPreventivas">
							<!-- PHP Creacion de Tablas -->
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDTipoTablaOTPreventivas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="formTipoTablaOTPreventivas">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="TtablaOTPreventivas_Id" class="col-form-label form-control-sm">ID</label>
										   		<input type="text" class="form-control form-control-sm" id="TtablaOTPreventivas_Id">
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="TtablaOTPreventivas_Operacion" class="col-form-label form-control-sm">Ficha</label>
										   		<input type="text" class="form-control form-control-sm" id="TtablaOTPreventivas_Operacion">
											</div> 
									 	</div>    
									</div>
					  				<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="TtablaOTPreventivas_Tipo" class="col-form-label form-control-sm">Categoría 1</label>
												<input type="text" class="form-control form-control-sm" id="TtablaOTPreventivas_Tipo">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
						  				<div class="col-lg-12">
									  		<div class="form-group">
												<label for="TtablaOTPreventivas_Detalle" class="col-form-label form-control-sm">Categoría 2</label>
										  		<textarea class="form-control z-depth-1 form-control-sm" id="TtablaOTPreventivas_Detalle" rows="7" placeholder="escribe algo aqui..."></textarea>
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarTipoTablaOTPreventivas" class="btn btn-dark btn-sm">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			

			</div>
			  	
			<!-- TAB OT CORRECTIVAS-->
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<section class="container-fluid py-3">
					<button id="btnNuevoTipoTablaOTCorrectivas" type="button" class="btn btn-info" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaTipoTablaOTCorrectivas">
							<!-- PHP Creacion de Tablas -->
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDTipoTablaOTCorrectivas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="formTipoTablaOTCorrectivas">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="" class="col-form-label">ID</label>
										   		<input type="text" class="form-control" id="ttablaotcorrectivas_id">
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Ficha</label>
										   		<input type="text" class="form-control" id="ttablaotcorrectivas_operacion">
											</div> 
									 	</div>    
									</div>
					  				<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Categoría 1</label>
												<input type="text" class="form-control" id="ttablaotcorrectivas_tipo">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
						  				<div class="col-lg-12">
									  		<div class="form-group">
												<label for="ttablaotcorrectivas_detalle" class="col-form-label">Categoría 2</label>
										  		<textarea class="form-control z-depth-1" id="ttablaotcorrectivas_detalle" rows="7" placeholder="escribe algo aqui..."></textarea>
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarTipoTablaOTCorrectivas" class="btn btn-dark">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			

			</div>

			<!-- TAB ASOCIADOS -->
			<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
				<section class="container-fluid py-3">
					<button id="btnNuevoAsociados" type="button" class="btn btn-secondary btn-sm btnNuevoAsociados" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaAsociados">
							<!-- PHP Creacion de Tablas -->
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDAsociados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="formAsociados">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="cod_resasoc" class="col-form-label form-control-sm">ID</label>
										   		<input type="text" class="form-control form-control-sm" id="cod_resasoc">
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="ra_nombre" class="col-form-label form-control-sm">RESPONSABLE</label>
										   		<input type="text" class="form-control form-control-sm" id="ra_nombres">
											</div> 
									 	</div>    
									</div>
					  				<div class="row"> 
									  <div class="col-lg-6">
									  		<div class="form-group">
												<label for="ra_ruc_asociado" class="col-form-label form-control-sm">NRO. RUC</label>
												<input type="number" class="form-control form-control-sm" id="ra_ruc_asociado" maxlength="11">
											</div> 
						  				</div>
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="ra_asociado" class="col-form-label form-control-sm">ASOCIADO</label>
												<input type="text" class="form-control form-control-sm" id="ra_asociado">
											</div> 
						  				</div>
									</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarAsociados" class="btn btn-dark btn-sm btnGuardarAsociados">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			
		
			</div>

			<!-- TAB ORIGENES -->
			<div class="tab-pane fade" id="nav-origenes" role="tabpanel" aria-labelledby="nav-origenes-tab">
				<section class="container-fluid py-3">
					<button id="btnNuevoOrigenes" type="button" class="btn btn-info" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaOrigenes">
							<!-- PHP Creacion de Tablas -->
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDOrigenes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="formOrigenes">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="" class="col-form-label">Código</label>
										   		<input type="text" class="form-control" id="cod_origen">
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Origen</label>
										   		<input type="text" class="form-control" id="or_nombre" maxlength="100">
											</div> 
									 	</div>    
									</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarOrigenes" class="btn btn-dark">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			

			</div>

			<!-- TAB VALES-->
			<div class="tab-pane fade" id="nav-vales" role="tabpanel" aria-labelledby="nav-vales-tab">
				<section class="container-fluid py-3">
					<button id="btnNuevoTipoTablaVales" type="button" class="btn btn-info" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaTipoTablaVales">
							<!-- PHP Creacion de Tablas -->
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDTipoTablaVales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="formTipoTablaVales">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="" class="col-form-label">ID</label>
										   		<input type="text" class="form-control" id="ttablavales_id">
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Ficha</label>
										   		<input type="text" class="form-control" id="ttablavales_operacion">
											</div> 
									 	</div>    
									</div>
					  				<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Categoría 1</label>
												<input type="text" class="form-control" id="ttablavales_tipo">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
						  				<div class="col-lg-12">
									  		<div class="form-group">
												<label for="ttablavales_detalle" class="col-form-label">Categoría 2</label>
										  		<textarea class="form-control z-depth-1" id="ttablavales_detalle" rows="7" placeholder="escribe algo aqui..."></textarea>
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarTipoTablaVales" class="btn btn-dark">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			

			</div>

			<!-- TAB UNIDAD MEDIDA -->
			<div class="tab-pane fade" id="nav-unidad_medida" role="tabpanel" aria-labelledby="nav-unidad_medida-tab">
				<section class="container-fluid py-3">
					<button id="btn_nuevo_unidad_medida" type="button" class="btn btn-secondary btn-sm" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_unidad_medida">
							<!-- PHP Creacion de Tablas -->
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modal_crud_unidad_medida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="form_unidad_medida">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="unidad_medida" class="col-form-label">CODIGO</label>
										   		<input type="text" class="form-control" id="unidad_medida">
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="um_descripcion" class="col-form-label">DESCRIPCION</label>
										   		<input type="text" class="form-control" id="um_descripcion" maxlength="100">
											</div> 
									 	</div>    
									</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btn_guardar_unidad_medida" class="btn btn-dark">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			

			</div>

			<!-- TAB MATERIALES-->
			<div class="tab-pane fade" id="nav-Materiales" role="tabpanel" aria-labelledby="nav-Materiales-tab">
				<section class="container-fluid py-3">
					<button id="btnNuevoTipoTablaMateriales" type="button" class="btn btn-info" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaTipoTablaMateriales">
							<!-- PHP Creacion de Tablas -->
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDTipoTablaMateriales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="formTipoTablaMateriales">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="" class="col-form-label">ID</label>
										   		<input type="text" class="form-control" id="ttablamateriales_id">
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Ficha</label>
										   		<input type="text" class="form-control" id="ttablamateriales_operacion">
											</div> 
									 	</div>    
									</div>
					  				<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Categoría 1</label>
												<input type="text" class="form-control" id="ttablamateriales_tipo">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
						  				<div class="col-lg-12">
									  		<div class="form-group">
												<label for="ttablamateriales_detalle" class="col-form-label">Categoría 2</label>
										  		<textarea class="form-control z-depth-1" id="ttablamateriales_detalle" rows="7" placeholder="escribe algo aqui..."></textarea>
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarTipoTablaMateriales" class="btn btn-dark">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			

			</div>

			<!-- TAB  PEDIDOS-->
			<div class="tab-pane fade" id="nav-pedidos" role="tabpanel" aria-labelledby="nav-pedidos-tab">
				<section class="container-fluid py-3">
					<button id="btnNuevoTipoTablaPedidos" type="button" class="btn btn-info" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaTipoTablaPedidos">
							<!-- PHP Creacion de Tablas -->
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDTipoTablaPedidos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="formTipoTablaPedidos">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="" class="col-form-label">ID</label>
										   		<input type="text" class="form-control" id="ttablapedidos_id">
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Ficha</label>
										   		<input type="text" class="form-control" id="ttablapedidos_operacion">
											</div> 
									 	</div>    
									</div>
					  				<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Categoría 1</label>
												<input type="text" class="form-control" id="ttablapedidos_tipo">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
						  				<div class="col-lg-12">
									  		<div class="form-group">
												<label for="ttablapedidos_detalle" class="col-form-label">Categoría 2</label>
										  		<textarea class="form-control z-depth-1" id="ttablapedidos_detalle" rows="7" placeholder="escribe algo aqui..."></textarea>
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarTipoTablaPedidos" class="btn btn-dark">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			
			</div>

			<!-- TAB INVENTARIO-->
			<div class="tab-pane fade" id="nav-inventario" role="tabpanel" aria-labelledby="nav-inventario-tab">
				<section class="container-fluid py-3">
					<button id="btn_nuevo_tc_inventario" type="button" class="btn btn-info" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_tc_inventario">
							<!-- PHP Creacion de Tablas -->
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modal_crud_tc_inventario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="form_tc_inventario">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="" class="col-form-label">ID</label>
										   		<input type="text" class="form-control" id="tc_inventario_id">
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Ficha</label>
										   		<input type="text" class="form-control" id="tcin_operacion">
											</div> 
									 	</div>    
									</div>
					  				<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="" class="col-form-label">Categoría 1</label>
												<input type="text" class="form-control" id="tcin_tipo">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
						  				<div class="col-lg-12">
									  		<div class="form-group">
												<label for="tcin_detalle" class="col-form-label">Categoría 2</label>
										  		<textarea class="form-control z-depth-1" id="tcin_detalle" rows="7" placeholder="escribe algo aqui..."></textarea>
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btn_guardar_tc_inventario" class="btn btn-dark">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			
			</div>
			<!-- FIN TAB ALMACEN-->

	  		<!-- TAB COMPONENTE -->
			<div class="tab-pane fade" id="nav-componente" role="tabpanel" aria-labelledby="nav-componente-tab">
				<section class="container-fluid py-3">
					<button id="btn_nuevo_tc_componente" type="button" class="btn btn-secondary btn-sm btn_nuevo_tc_componente" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_tc_componente">
							<!-- PHP Creacion de Tablas -->
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modal_crud_tc_componente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="form_tc_componente">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="tc_componente_id" class="col-form-label form-control-sm">ID</label>
										   		<input type="text" readonly class="form-control form-control-sm" id="tc_componente_id">
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="comp_ficha" class="col-form-label form-control-sm">FICHA</label>
										   		<input type="text" class="form-control form-control-sm" id="comp_ficha">
											</div> 
									 	</div>    
									</div>
					  				<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="comp_categoria1" class="col-form-label form-control-sm">CATEGORIA 1</label>
												<input type="text" class="form-control form-control-sm" id="comp_categoria1">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
						  				<div class="col-lg-12">
									  		<div class="form-group">
												<label for="comp_categoria2" class="col-form-label form-control-sm">CATEGORIA 2</label>
										  		<textarea class="form-control z-depth-1" id="comp_categoria2" rows="7" placeholder="escribe algo aqui..."></textarea>
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btn_guardar_tc_componente" class="btn btn-dark btn-sm">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			

			</div>
			<!-- FIN TAB COMPONENTE -->

	  		<!-- TAB INSPECCION -->
			  <div class="tab-pane fade" id="nav-inspeccion" role="tabpanel" aria-labelledby="nav-inspeccion-tab">
				<section class="container-fluid py-3">
					<button id="btn_nuevo_tc_inspeccion" type="button" class="btn btn-secondary btn-sm btn_nuevo_tc_inspeccion" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_tc_inspeccion">
							<!-- PHP Creacion de Tablas -->
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modal_crud_tc_inspeccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="form_tc_inspeccion">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="tc_inspeccion_id" class="col-form-label form-control-sm">ID</label>
										   		<input type="text" readonly class="form-control form-control-sm" id="tc_inspeccion_id">
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="insp_ficha" class="col-form-label form-control-sm">FICHA</label>
										   		<input type="text" class="form-control form-control-sm" id="insp_ficha">
											</div> 
									 	</div>    
									</div>
					  				<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="insp_categoria1" class="col-form-label form-control-sm">CATEGORIA 1</label>
												<input type="text" class="form-control form-control-sm" id="insp_categoria1">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
						  				<div class="col-lg-12">
									  		<div class="form-group">
												<label for="insp_categoria2" class="col-form-label form-control-sm">CATEGORIA 2</label>
										  		<textarea class="form-control z-depth-1" id="insp_categoria2" rows="7" placeholder="escribe algo aqui..."></textarea>
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btn_guardar_tc_inspeccion" class="btn btn-dark btn-sm">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			

			</div>
			<!-- FIN TAB COMPONENTE -->

		</div>
	</div>
</div>