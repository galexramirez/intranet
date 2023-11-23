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

	<!-- Contenido para el Modulo -->
	<div class="my-contenidoModulo container-fluid pl-0 pr-0 ml-0 mr-0">

		<nav>
			<div class="nav nav-tabs" id="div_nav-tab-kilometraje" role="tablist">
				<!-- Accesos CreacionTabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">

			<!-- TAB CARGA -->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<form id="formSeleccionKmCarga" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-2 col-sm-12">
						<div class="col-lg-1">
							<div class="form-group">
								<label for="selectAniosKmCarga" class="col-form-label form-control-sm">AÑO</label>
								<select name="selectAniosKmCarga" class="form-control form-control-sm" id="selectAniosKmCarga">
								</select>
						   	</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group" id="div_btn-seleccion">
								<!-- Accesos BotonesFormulario -->
							</div>
						</div>   
					</div>
				</form>

				<div class="container-fluid caja">
					<div class="row p-0">
					   <div class="col-auto m-0">
						   <div class="table-responsive" id="div_tablaKmCarga">        
							<!-- Accesos CreacionTabla -->
							</div>
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDKmCarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
								</button>
   							</div>
							<form id="formKmCarga" enctype="multipart/form-data" action="" method="post">    
								<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-2">
			      							<div class="form-group">
												<label for="" class="col-form-label">Fecha de Carga:</label>
												<input type="date" class="form-control" id="kmcarga_fecha" placeholder="dd/mm/aaaa" >
			    								<div id="Mskmcarga_fecha"class="invalid-feedback">Complete el campo.</div>
			      							</div>
			    						</div>
										<div class="col-lg-9">
											<div class="form-group">
												<label for="" class="col-form-label">Cargar Archivo</label>
												<div class="custom-file">
													<label id="LabelfileKmCarga" class="custom-file-label" for="customFileLang">Seleccionar Archivo .csv o .xlsx</label>
													<input type="file" class="custom-file-input" id="fileKmCarga" lang="es" accept=".csv, .xlsx"> 
												</div>
												<div id="MsfileKmCarga"class="invalid-feedback">Complete el campo.</div>
											</div>
									  	</div>
									  	<div class="col-lg-1">
										  	<div class="form-group">
											  	<label for="" class="col-form-label"></label>
												<button type="submit" id="btnCargarKmCarga" class="btn btn-success">Cargar</button>
											</div>
									  	</div>
								  	</div>    
							  	</div>
								<div class="modal-footer" id="div_ResultadoKmCarga">
									<!-- Carga de Mensajes -->
								</div>
						  	</form>
						</div>
					</div>
				</div>
			</div>

			<!-- TAB KILOMETRAJE -->
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<form id="formSeleccionKm" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
			      			<div class="form-group form-control-sm">
								<label for="FechaTerminoKm" class="col-form-label form-control-sm">F. Consultar</label>
								<input type="date" class="form-control form-control-sm" id="FechaTerminoKm" placeholder="dd/mm/aaaa" >
			      			</div>
			    		</div>
						<div class="col-lg-1">             	
							<div class="form-group form-control-sm">
								<label for="selectDiasKm" class="col-form-label form-control-sm">Días</label>
								<select name="selectDiasKm" class="form-control form-control-sm" id="selectDiasKm">
									<option selected>Selecciona una opcion</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">13</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
									<option value="16">16</option>
									<option value="17">17</option>
									<option value="18">18</option>
									<option value="19">19</option>
									<option value="20">20</option>
									<option value="21">21</option>
									<option value="22">22</option>
									<option value="23">23</option>
									<option value="24">24</option>
  									<option value="25">25</option>
  									<option value="26">26</option>
									<option value="27">27</option>
									<option value="28">28</option>
									<option value="29">29</option>
									<option value="30">30</option>
								</select> 
							</div>
				    	</div> 
					<!--	<div class="col-lg-1">             	
							<div class="form-group form-control-sm">
								<label for="selectBusKm" class="col-form-label form-control-sm">Bus</label>
								<select name="selectBusKm" class="form-control form-control-sm" id="selectBusKm">
								</select>
							</div>
				    	</div>  --> 
						<div class="col-lg-1">             	
							<div class="form-group form-control-sm">
								<label for="selectTipoBusKm" class="col-form-label form-control-sm">Tipo Bus</label>
								<select name="selectTipoBusKm" class="form-control form-control-sm" id="selectTipoBusKm">
									<option selected>Selecciona una opcion</option>
  									<option value="TODOS">TODOS</option>
  									<option value="TRONCAL">TRONCAL</option>
  									<option value="ALIMENTADOR">ALIMENTADOR</option>
								</select>
							</div>
				    	</div> 
						<div class="col-lg-1">             	
							<div class="form-group form-control-sm">
								<label for="selectTipoKm" class="col-form-label form-control-sm">Kilometraje</label>
								<select name="selectTipoKm" class="form-control form-control-sm" id="selectTipoKm">
									<option selected>Selecciona una opcion</option>
  									<option value="TODOS">TODOS</option>
  									<option value="RECORRIDO">RECORRIDO</option>
  									<option value="ACUMULADO">ACUMULADO</option>
								</select>
							</div>
				    	</div> 
						<div class="col-lg-3">
							<div class="form-group form-control-sm">
								<div class="py-4" id="div_btn-seleccionkm">
									<!-- Accesos BotonesFormulario -->
								</div>
							</div>
				    	</div> 
					</div>
				</form>
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaKm"> 
							<!-- Logico CreacionTablaKm -->
						</div>
    				</div>
				</div>
				
				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDKmEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form id="formKmEditar" enctype="multipart/form-data" action="" method="post">    
								<div class="modal-body">
									<div id="div_DatosKm" class="bg-light">
										<div class="row align-items-end">
											<div class="col-lg-6">
			      								<div class="form-group">
													<label for="km_bus" class="col-form-label">Bus:</label>
													<select name="km_bus" class="form-control" id="km_bus">
													</select>
													<div id="Mskm_bus"class="invalid-feedback">Complete el campo.</div>
			    								</div>
			    							</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label for="km_fecha" class="col-form-label">Fecha:</label>
													<input type="date" name="km_fecha" class="form-control" id="km_fecha">
													<div id="Mskm_fecha"class="invalid-feedback">Complete el campo.</div>
												</div>
											</div>
										</div>
										<div class="d-flex flex-row-reverse">
											<div class="p-2">
												<button type="button" id="btnEditarKm" class="btn btn-primary">Editar</button>
											</div>
										</div>
									</div>
									<div id="div_EditarKm">
										<div class="row align-items-end">
											<div class="col-lg-6">
			      								<div class="form-group">
													<label for="tkm_bus" class="col-form-label">Bus:</label>
													<input type="text" class="form-control" id="tkm_bus" disabled>
			    								</div>
			    							</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label for="tkm_bus" class="col-form-label">Fecha:</label>
													<input type="date" class="form-control" id="tkm_fecha" disabled> 
												</div>
										  	</div>
										</div>
										<div class="row align-items-end">
										  	<div class="col-lg-6">
											  	<div class="form-group">
												  	<label for="km_kilometraje" class="col-form-label">Kilometraje:</label>
													<input type="text" class="form-control" id="km_kilometraje">
													<div id="Mskm_kilometraje"class="invalid-feedback">Complete el campo.</div>
												</div>
										  	</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label for="selectkm_motivo" class="col-form-label">Motivo:</label>
													<select name="selectkm_motivo" class="form-control" id="selectkm_motivo">
  														<option selected value="PATIO SUR">PATIO SUR</option>
  														<option value="KM EXTENDIDO">KM EXTENDIDO</option>
  														<option value="ERROR DE INGRESO">ERROR DE INGRESO</option>
													</select>
													<div id="Msselectkm_motivo"class="invalid-feedback">Complete el campo.</div>
												</div>
											</div>
								  		</div>
										<div class="row align-items-end">
											<div class="col-lg-12">
												<div class="form-group shadow-textarea">
			      				    	        	<label for="km_historial" class="col-form-label">Historial:</label>
													<div class="form-control-sm mb-1 overflow-auto h-50" id="div_km_historial"></div>
			      				    	        </div>
											</div>
										</div>    
							  		</div>
								</div>
								<div class="modal-footer" id="div_modal-footer">
									<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
				      		        <button type="submit" id="btnGuardarKm" class="btn btn-dark">Guardar</button>
								</div>
						  	</form>
						</div>
					</div>
				</div>

				<!--Modal para GRAFICO-->
				<div class="row modal fade" id="modalCRUDKmGrafico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
								</button>
   							</div>
							<form id="formKmGrafico" enctype="multipart/form-data" action="" method="post">    
								<div class="modal-body">
									<!--DIV para Grafico de Kilometraje por Bus
									<div id="chartdiv"></div> -->
									<div id="chartdivGraficoKm"></div>
								</div>
								<div class="modal-footer">

								</div>
						  	</form>
						</div>
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