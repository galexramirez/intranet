<div id="contenido" class="my-contenido-con-sidebar p-0">

	<nav class="navbar navbar-light bg-light p-0">
		<div class="container-fluid">
			<div class="row justify-content-between w-100 align-items-center">
				<div class="col-4">
					<a class="navbar-brand text-muted" href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
 						 <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
					</svg>	
					<?= $NombreDeModuloVista ?></a>
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
			<div class="nav nav-tabs" id="nav-tab-Materiales" role="tablist">
				<!-- PHP Accesos Creacion Tabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">

			<!-- TAB MATERIALES -->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<form id="formSeleccionMateriales" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="form-group m-0 mt-1 py-3">
						<div class="ml-3">
							<button id="btnBuscarMateriales" type="button" class="btn btn-secondary btn-sm">Buscar</button>
							<button id="btnNuevoMateriales" type="button" class="btn btn-secondary btn-sm" data-toggle="modal">+ Agregar</button>	
						</div>
					</div>
				</form>
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaMateriales">
							<!-- PHP Accesos CreacionTabla -->
						</div>
    				</div>
				</div>

				<!--Modal para CRUD MATERIALES -->
				<div class="row modal fade" id="modalCRUDMateriales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content ui-widget-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="formModalMateriales" enctype="multipart/form-data" action="" method="post">    
								<div class="modal-body">
									<div class="form-group">
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-3">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">CODIGO LBI:</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control-sm mb-1 form-control" id="material_id">
														</div>
													</div>
													<div class="col-lg-1">
														<div class="form-group form-control-sm mb-1">
															<button type="button" id="btnCodigoMateriales" class="btn btn-secondary btn-sm">+Código</button>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-3">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">DESCRIPCION :</label>
														</div>
													</div>
													<div class="col-lg-9">
														<div class="form-group form-control-sm mb-1">
															<input type="text" class="form-control form-control-sm mb-1 text-uppercase" id="material_descripcion">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-3">
														<div class="form-group form-control-sm mb-1">
															<label for="mate_unidad_medida" class="col-form-label form-control-sm mb-1">UNIDAD MEDIDA :</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<select class="form-control form-control-sm mb-1 text-uppercase" id="mate_unidad_medida">
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-3">
														<div class="form-group form-control-sm mb-1">
															<label for="material_tipo" class="col-form-label form-control-sm mb-1">TIPO :</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<select class="form-control form-control-sm mb-1 text-uppercase" id="material_tipo">
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-3">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">COD. PATRIMONIAL :</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<select class="form-control form-control-sm mb-1 text-uppercase" id="material_patrimonial">
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-3">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">CATEGORIA :</label>
														</div>
													</div>
													<div class="col-lg-9">
														<div class="form-group form-control-sm mb-1">
															<select class="form-control form-control-sm mb-1 text-uppercase" id="material_categoria">
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row align-items-end">
													<div class="col-lg-3">
														<div class="form-group form-control-sm mb-4">
															<label for="" class="col-form-label form-control-sm mb-4">OBSERVACIONES :</label>
														</div>
													</div>
													<div class="col-lg-9">
														<div class="form-group form-control-sm mb-4">
															<textarea class="form-control form-control-sm mb-4 text-uppercase" id="material_observaciones" rows="2" placeholder="escribe algo aqui..." maxlength="500"></textarea>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-3">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">ESTADO :</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<select class="form-control form-control-sm mb-1 text-uppercase" id="material_estado">
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-3">
														<div class="form-group form-control-sm mb-4">
															<label for="" class="col-form-label form-control-sm mb-4">LOG :</label>
														</div>
													</div>
													<div class="col-lg-9">
														<div class="form-group form-control-sm mb-4">
															<div class="form-control-sm mb-4 overflow-auto border border-muted border-radius rounded" style="height:50px" id="div_material_log">
																<!-- JS material_log -->
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row align-items-end">
													<div class="col-lg-3">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">OBSERVACION LOG :</label>
														</div>
													</div>
													<div class="col-lg-9">
														<div class="form-group form-control-sm mb-1">
															<textarea class="form-control form-control-sm mb-1 text-uppercase" id="material_obslog" rows="2" placeholder="escribe algo aqui..." maxlength="100"></textarea>
														</div>
													</div>
												</div>
											</div>											
										</div>
									</div>
								</div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
									<button type="submit" id="btnGuardarMateriales" class="btn btn-dark btn-sm">Guardar</button>
								</div>
							</form>
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD GENERAR CODIGO MATERIALES -->
				<div class="row modal fade" id="modalCRUDCodigoMateriales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
			        	<div class="modal-content ui-widget-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="codigoModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="formModalCodigoMateriales" enctype="multipart/form-data" action="" method="post">    
								<div class="modal-body ui-front">
									<div class="form-group">
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">CODIGO:</label>
														</div>
													</div>
													<div class="col-lg-8">
															<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control-sm mb-1 form-control-plaintext" id="cod_material">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">ASIGNACION:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<select class="form-control form-control-sm mb-1" id="cod_asignacion">
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">MACROSISTEMA:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<select class="form-control form-control-sm mb-1" id="cod_macrosistema">
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">SISTEMA:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<select class="form-control form-control-sm mb-1" id="cod_sistema">
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">COMPONENTE:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control-sm mb-1 form-control-plaintext" id="cod_componente">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">TARJETA:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<select class="form-control form-control-sm mb-1" id="cod_tarjeta">
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">CONDICION:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<select class="form-control form-control-sm mb-1" id="cod_condicion">
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group form-control-sm mb-1">
															<label for="" class="col-form-label form-control-sm mb-1">FLOTA:</label>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group form-control-sm mb-1">
															<select class="form-control form-control-sm mb-1" id="cod_flota">
															</select>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
									<button type="submit" id="btnGenerarCodigo" class="btn btn-dark btn-sm">Generar</button>
								</div>
							</form>
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD MOSTRAR PRECIOS POR PROVEEDOR DE MATERIALES -->
				<div class="row modal fade" id="modalCRUDProveedorMateriales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="formModalProveedorMateriales" enctype="multipart/form-data" action="" method="post">    
								<div class="modal-body">
									<div class="form-group">
										<div class="row p-3">
											<div class="col-auto m-0">
												<div class="table-responsive" id="div_tablaProveedorMateriales">
													<!-- PHP Logico -->
												</div>
    										</div>
										</div>
									</div>
								</div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
								</div>
							</form>
			        	</div>
			    	</div>
				</div>

			</div>

			<!-- TAB PROVEEDORES -->
			<div class="tab-pane fade" id="nav-proveedores" role="tabpanel" aria-labelledby="nav-proveedores-tab">
				<section class="container-fluid py-3">
					<button id="btnNuevoProveedores" type="button" class="btn btn-secondary btn-sm" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaProveedores">
							<!-- PHP Creacion de Tablas -->
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDProveedores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
	   
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	  
			  				<form id="formProveedores">
				  				<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
										  		<label for="prov_ruc" class="col-form-label form-control-sm">NRO. RUC</label>
										   		<input type="number" class="form-control form-control-sm" id="prov_ruc">
										 	</div>
									 	</div>
										 <div class="col-lg-6">
									  		<div class="form-group">
												<label for="prov_razonsocial" class="col-form-label form-control-sm">RAZON SOCIAL</label>
										   		<input type="text" class="form-control text-uppercase form-control-sm" id="prov_razonsocial" maxlength="100">
											</div> 
									 	</div>    
									</div>
									<div class="row">
										 <div class="col-lg-6">
									  		<div class="form-group">
												<label for="prov_contacto" class="col-form-label form-control-sm">CONTACTO</label>
												<input type="text" class="form-control text-uppercase form-control-sm" id="prov_contacto" maxlength="100">
											</div> 
						  				</div>
										  <div class="col-lg-6">
									  		<div class="form-group">
												<label for="prov_cta_detraccion_soles" class="col-form-label form-control-sm">CUENTA DETRACCION EN SOLES</label>
												<input type="text" class="form-control text-uppercase form-control-sm" id="prov_cta_detraccion_soles" maxlength="100">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="prov_cta_banco_soles" class="col-form-label form-control-sm">CUENTA BANCARIA EN SOLES</label>
												<input type="text" class="form-control text-uppercase form-control-sm" id="prov_cta_banco_soles" maxlength="100">
											</div> 
						  				</div>
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="prov_cta_banco_dolares" class="col-form-label form-control-sm">CUENTA BANCARIA EN DOLARES</label>
												<input type="text" class="form-control text-uppercase form-control-sm" id="prov_cta_banco_dolares" maxlength="100">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="prov_cta_interbanco_soles" class="col-form-label form-control-sm">CUENTA INTER BANCARIA EN SOLES</label>
												<input type="text" class="form-control text-uppercase form-control-sm" id="prov_cta_interbanco_soles" maxlength="100">
											</div> 
						  				</div>
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="prov_cta_interbanco_dolares" class="col-form-label form-control-sm">CUENTA INTER BANCARIA EN DOLARES</label>
												<input type="text" class="form-control text-uppercase form-control-sm" id="prov_cta_interbanco_dolares" maxlength="100">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="prov_condicion_pago" class="col-form-label form-control-sm">CONDICION DE PAGO</label>
												<select class="form-control form-control-sm" id="prov_condicion_pago">
												</select>	
											</div> 
						  				</div>
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="prov_correo" class="col-form-label form-control-sm">CORREO ELECTRONICO</label>
												<input type="text" class="form-control text-lowercase form-control-sm" id="prov_correo" maxlength="100">
											</div> 
						  				</div>
									</div>

									<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="prov_telefono" class="col-form-label form-control-sm">TELEFONO</label>
												<input type="text" class="form-control form-control-sm" id="prov_telefono">
											</div> 
						  				</div>
										  <div class="col-lg-6">
									  		<div class="form-group">
												<label for="prov_estado" class="col-form-label form-control-sm">ESTADO</label>
												<select class="form-control form-control-sm" id="prov_estado">
												</select>
											</div> 
						  				</div>
									</div>
									<div class="row"> 
										<div class="col-lg-12">
									  		<div class="form-group">
												<label for="prov_log" class="col-form-label form-control-sm">LOG</label>
											</div> 
						  				</div>
										<div class="col-lg-12">
											<div class="form-group">
												<div class="form-control-sm overflow-auto border border-muted border-radius rounded" style="height:50px" id="div_proveedor_log">
													<!-- JS proveedor_log -->
												</div>
											</div>
										</div>
									</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarProveedores" class="btn btn-dark btn-sm btnGuardarProveedores">Guardar</button>
				  				</div>
			  				</form>    
						</div>
					</div>
				</div>  			

			</div>

			<!-- TAB CARGAR PRECIOS -->
			<div class="tab-pane fade" id="nav-cargarprecios" role="tabpanel" aria-labelledby="nav-cargarprecios-tab">
				<form id="formSeleccionCargarPrecios" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">
					<section class="container-fluid py-3">
						<div class="form-row align-items-center">
							<label for="selectAniosCargarPrecios" class="col-form-label">Año :</label>
							<div class='col-lg-1 my-2'>
								<select name="selectAniosCargarPrecios" class="form-control form-control-sm" id="selectAniosCargarPrecios">
								</select>
							</div>
							<div class='col-auto my-2'>
								<button id="btnBuscarCargarPrecios" type="button" class="btn btn-secondary btn-sm" data-toggle="modal">Buscar</button>
							</div>
							<div class='col-auto my-2'>
								<button id="btnCargarLista" type="button" class="btn btn-secondary btn-sm" data-toggle="modal">+ Cargar por Lista</button>
							</div>		
  						</div>
					</section>
				</form>
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaCargarPrecios">
							<!-- PHP Accesos CreacionTabla -->
						</div>
    				</div>
				</div>

				<!--Modal para CRUD CARGAR PRECIOS -->
				<div class="row modal fade" id="modalCRUDCargarPrecios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
								</button>
   							</div>
							<form id="formCargarPrecios" enctype="multipart/form-data" action="" method="post">    
								<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-9">
											<div class="form-group">
												<label for="" class="col-form-label">Cargar Archivo</label>
												<div class="custom-file">
													<label id="LabelfileCargarPrecios" class="custom-file-label" for="customFileLang">Seleccionar Archivo .csv o .xlsx</label>
													<input type="file" class="custom-file-input" id="fileCargarPrecios" lang="es" accept=".csv, .xlsx"> 
												</div>
											</div>
									  	</div>
									  	<div class="col-lg-3">
										  	<div class="form-group">
											  	<label for="" class="col-form-label"></label>
												<button type="submit" id="btnCargarListaPrecios" class="btn btn-success">Cargar Lista</button>
											</div>
									  	</div>
								  	</div>    
							  	</div>
								<div class="modal-footer" id="div_ResultadoCargarPrecios">
									<!-- Carga de Mensajes -->
								</div>
						  	</form>
						</div>
					</div>
			    </div>

			</div>

			<!-- TAB PRECIOS PROVEEDOR -->
			<div class="tab-pane fade" id="nav-preciosproveedor" role="tabpanel" aria-labelledby="nav-preciosproveedor-tab">
				<form id="formSeleccionPreciosProveedor" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-3">
			    		  	<div class="form-group">
								<label for="pp_razonsocial" class="col-form-label form-control-sm">Razón Social:</label>
								<select class="form-control form-control-sm" id="pp_razonsocial" name="pp_razonsocial" >
								</select>
			    		  	</div>
			    		</div>
						<div class="col-lg-2">
			    		  	<div class="form-group">
								<label for="pp_fecha" class="col-form-label form-control-sm">Precio a la Fecha:</label>
								<input type="date" class="form-control form-control-sm" id="pp_fecha" placeholder="dd-mm-aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-4">
							<div class="form-group">
								<button type="button" id="btnBuscarPreciosProveedor"class="btn btn-secondary btn-sm">Buscar</button>	
								<button type="button" id="btnNuevoPreciosProveedor" class="btn btn-secondary btn-sm" data-toggle="modal">+ Precio Proveedor</button>
							</div>
			    		</div> 
					</div>
				</form>
				
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaPreciosProveedor">
							<!-- PHP Accesos CreacionTabla -->
						</div>
    				</div>
				</div>

				<!--Modal para CRUD VER PRECIOS PROVEEDOR -->
				<div class="row modal fade" id="modalCRUDPreciosProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="formModalPreciosProveedor" enctype="multipart/form-data" action="" method="post">    
								<div class="modal-body ui-front">
									<div class="form-group">
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group mb-2">
															<label for="precioprov_codproveedor" class="form-label form-control-sm mb-0">Código Proveedor</label>
															<input type="text" class="form-control form-control-sm text-uppercase" id="precioprov_codproveedor">
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group mb-2">
															<label for="precioprov_descripcion" class="form-label form-control-sm mb-0">Descripción</label>
															<input type="text" class="form-control form-control-sm text-uppercase" id="precioprov_descripcion">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-3">
														<div class="form-group mb-2">
															<label for="precioprov_tipo" class="form-label form-control-sm mb-0">Tipo</label>
															<select class="form-control form-control-sm" id="precioprov_tipo">

															</select>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group mb-2">
															<label for="precioprov_marca" class="form-label form-control-sm mb-0">Marca</label>
															<select class="form-control form-control-sm" id="precioprov_marca">

															</select>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group mb-2">
															<label for="precioprov_procedencia" class="form-label form-control-sm mb-0">Procedencia</label>
															<select class="form-control form-control-sm" id="precioprov_procedencia">

															</select>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group mb-2">
															<label for="precioprov_unidadmedida" class="form-label form-control-sm mb-0">Unidad de Medida</label>
															<select class="form-control form-control-sm" id="precioprov_unidadmedida">
																
															</select>															
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-3">
														<div class="form-group mb-2">
															<label for="precioprov_garantia" class="form-label form-control-sm mb-0">Garantía</label>
															<input type="text" class="form-control form-control-sm text-uppercase" id="precioprov_garantia">
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group mb-2">
															<label for="precioprov_moneda" class="form-label form-control-sm mb-0">Moneda</label>
															<select class="form-control form-control-sm" id="precioprov_moneda">
																
															</select>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group mb-2">
															<label for="precioprov_precio" class="form-label form-control-sm mb-0">Precio</label>
															<input type="number" step="0.001" class="form-control form-control-sm" id="precioprov_precio">
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group mb-2">
															<label for="precioprov_preciosoles" class="form-label form-control-sm mb-0">Precio en Soles</label>
															<input type="number" step="0.001" class="form-control form-control-sm" id="precioprov_preciosoles">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group mb-2">
															<label for="precioprov_fechavigencia" class="form-label form-control-sm mb-0">Fecha Vigencia</label>
															<input type="date" class="form-control form-control-sm text-uppercase" id="precioprov_fechavigencia">
														</div>
													</div>
													<div class="col-lg-8">
														<div class="form-group mb-2">
															<label for="precioprov_razonsocial" class="form-label form-control-sm mb-0">Razón Social</label>
															<select class="form-control form-control-sm" id="precioprov_razonsocial">

															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group mb-2">
															<label for="" class="form-label form-control-sm mb-0">Observaciones Log :</label>
															<input type="text" class="form-control form-control-sm text-uppercase" id="precioprov_obslog">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group mb-2">
															<label for="" class="form-label form-control-sm mb-0">Log :</label>
															<div class="form-control-sm overflow-auto border border-muted border-radius rounded" style="height:50px" id="div_precioprov_log">
																<!-- JS precioprov_log -->
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
									<button type="submit" id="btnGuardarPreciosProveedor" class="btn btn-dark">Guardar</button>
								</div>
							</form>
			        	</div>
			    	</div>
				</div>

			</div>

			<!-- TAB ASIGNAR CODIGOS -->
			<div class="tab-pane fade" id="nav-asignarcodigos" role="tabpanel" aria-labelledby="nav-asignarcodigos-tab">
				<form id="formSeleccionAsignarCodigos" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-3">
			    		  	<div class="form-group">
								<label for="select_razonsocial" class="col-form-label form-control-sm">Razón Social:</label>
								<select class="form-control form-control-sm" id="select_razonsocial" name="select_razonsocial">
								</select>
							</div>
			    		</div>
						<div class="col-lg-2">
			    		  	<div class="form-group">
								<label for="select_tipo" class="col-form-label form-control-sm">Tipo:</label>
								<select class="form-control form-control-sm" id="select_tipo" name="select_tipo" >
									<option value="SIN ASIGNAR - SIN DOCUMENTACION">SIN ASIGNAR - SIN DOCUMENTACION</option>	
									<option value="SIN ASIGNAR">SIN ASIGNAR</option>
									<option value="SIN DOCUMENTACION">SIN DOCUMENTACION</option>
									<option value="TODOS">TODOS</option>	
								</select>
							</div>
			    		</div>
						<div class="col-lg-1">
							<div class="form-group">
								<button type="button" id="btnBuscarAsignarcod" class="btn btn-secondary btn-sm">Buscar</button>
							</div>
					    </div> 
					</div>
				</form>
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaAsignarCodigos">
							<!-- PHP Accesos CreacionTabla -->
						</div>
    				</div>
				</div>

				<!--Modal para CRUD PDF-->
				<div class="row modal fade" id="modalCRUDFichaTecnicaPDF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="formModalFichaTecnicaPDF" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="ExternalFiles" id="div_FichaTecnicaPDF">
						        				<!--<img src=" " />-->
											</div>
			                			</div>
									</div>
			      		        	<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group">
												<div class="custom-file">
							  						<label id="labelFichaTecnica_PDF" class="custom-file-label" for="customFileLang">Seleccionar Archivo .pdf</label>
							  						<input type="file" class="custom-file-input" id="FichaTecnica_PDF" lang="es" accept=".pdf"> 
												</div>
				               				</div>
										</div>
									</div>
			      		        </div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
			      					<button type="submit" id="btnGuardarFichaTecnicaPDF" class="btn btn-dark">Cargar</button>
								</div>
							</form>
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD ASIGNAR CODIGOS -->
				<div class="row modal fade" id="modalCRUDAsignarCodigos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="formModalAsignarCodigos" enctype="multipart/form-data" action="" method="post">    
								<div class="modal-body ui-front">
									<div class="form-group">
										<div class="row d-flex justify-content-araound">
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-3">
														<div class="form-group form-control-sm mb-1">
															<label for="asignarcod_codproveedor" class="col-form-label form-control-sm mb-1">Código Proveedor:</label>
														</div>
													</div>
													<div class="col-lg-9">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control-sm mb-1 form-control-plaintext" id="asignarcod_codproveedor">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-3">
														<div class="form-group form-control-sm mb-1">
															<label for="asignarcod_desproveedor" class="col-form-label form-control-sm mb-1">Descr. Proveedor:</label>
														</div>
													</div>
													<div class="col-lg-9">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control-sm mb-1 form-control-plaintext" id="asignarcod_desproveedor">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-3">
														<div class="form-group form-control-sm mb-1">
															<label for="asignarcod_razonsocial" class="col-form-label form-control-sm mb-1">Razón Social:</label>
														</div>
													</div>
													<div class="col-lg-9">
														<div class="form-group form-control-sm mb-1">
															<input type="text" readonly class="form-control-sm mb-1 form-control-plaintext" id="asignarcod_razonsocial">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-3">
														<div class="form-group form-control-sm mb-1">
															<label for="asignarcod_materialid" class="col-form-label form-control-sm mb-1">Código LBI :</label>
														</div>
													</div>
													<div class="col-lg-9">
														<div class="form-group form-control-sm mb-1 ui-widget">
															<input type="text" class="form-control form-control-sm mb-1 text-uppercase" id="asignarcod_materialid">
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-3">
														<div class="form-group form-control-sm mb-1">
															<label for="asignarcod_descripcion" class="col-form-label form-control-sm mb-1">Descripción :</label>
														</div>
													</div>
													<div class="col-lg-9">
														<div class="form-group form-control-sm mb-1 ui-widget">
															<input type="text" class="form-control form-control-sm mb-1 text-uppercase" id="asignarcod_descripcion">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
									<button type="submit" id="btnGuardarAsignarCodigos" class="btn btn-dark">Guardar</button>
								</div>
							</form>
			        	</div>
			    	</div>
				</div>

			</div>

			<!-- TAB PRECIOS MATERIAL-->
			<div class="tab-pane fade" id="nav-precios_material" role="tabpanel" aria-labelledby="nav-precios_material-tab">
				<form id="form_seleccion_precios_material" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-3">
			    		  	<div class="form-group">
								<label for="pm_razon_social" class="col-form-label form-control-sm">Razón Social:</label>
								<select class="form-control form-control-sm" id="pm_razon_social" name="pm_razon_social" >
								</select>
			    		  	</div>
			    		</div>
						<div class="col-lg-3">
			    		  	<div class="form-group">
								<label for="pm_cod_proveedor" class="col-form-label form-control-sm">Código Material:</label>
								<input type="text" class="form-control form-control-sm ui-widget" id="pm_cod_proveedor" >
			    		  	</div>
			    		</div>
						<div class="col-lg-2">
			    		  	<div class="form-group">
								<label for="pm_fecha" class="col-form-label form-control-sm">Precio a la Fecha:</label>
								<input type="date" class="form-control form-control-sm" id="pm_fecha" placeholder="dd-mm-aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-1">
							<div class="form-group">
								<button type="button" id="btn_buscar_precios_material" class="btn btn-secondary btn-sm">Buscar</button>	
							</div>
			    		</div> 
					</div>
				</form>
				
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tabla_precios_material">
							<!-- PHP Accesos CreacionTabla -->
						</div>
    				</div>
				</div>

			</div>

		</div>
	</div>
</div>