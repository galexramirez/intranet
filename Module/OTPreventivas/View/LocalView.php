<div id="contenido" class="my-contenido-con-sidebar p-0">

	<nav class="navbar navbar-light bg-light p-0 navbar-expand topbar static-top">
		<div class="container-fluid">
			<div class="row justify-content-between w-100 align-items-center">
				<div class="col-4">
					<a class="navbar-brand text-muted ml-3" href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
 						 <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
					</svg>	
					<?= $NombreDeModuloVista ?></a>
				</div>
				<div class="col-4">
					<div class="row justify-content-end w-100 align-items-center">
						<div class="text-right">
							<ul class="navbar-nav ml-auto">
								<li class="nav-item dropdown no-arrow mx-1">
									<a class="nav-link-alert dropdown-toggle" href="#" id="alertsDropdown_otprv" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-bell fa-fw"></i>
                		        		<span class="badge badge-danger badge-counter" id="otprv_alerta"></span>
									</a>
                		            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown_otprv" id="div_alertsDropdown_otprv">
                		            </div>
								</li>
							</ul>
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
			</div>
		</div>
	</nav>

	<!-- Contenido para el Modulo -->
	<div class="my-contenidoModulo container-fluid pl-0 pr-0 ml-0 mr-0">

		<nav>
			<div class="nav nav-tabs" id="nav-tab-otpreventivas" role="tablist">
				<!-- PHP CreacionTabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">

			<!-- TAB CARGA -->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<form id="formSeleccionOTPrvCarga" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
							<div class="form-group">
								<label for="selectAniosOTPrvCarga" class="col-form-label form-control-sm">Año :</label>
								<select name="selectAniosOTPrvCarga" class="form-control form-control-sm" id="selectAniosOTPrvCarga">
								</select>
						   	</div>
						</div>
						<div class="col-lg-2">             	
							<div class="form-group">
								<button type="button" id="btnBuscarOTPrvCarga"class="btn btn-secondary btn-sm"> Buscar </button>
								<button id="btnNuevoOTPrvCarga" type="button" class="btn btn-secondary btn-sm" data-toggle="modal">+ Nuevo</button>
							</div>
					   	</div> 
					</div>
				</form>

				<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
					   <div class="col-lg-12">
						   <div class="table-responsive" id="div_tablaOTPrvCarga">        
							<!-- PHP Creacion Tablas -->
							</div>
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDOTPrvCarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
								</button>
   							</div>
							<form id="formOTPrvCarga" enctype="multipart/form-data" action="" method="post">    
								<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-9">
											<div class="form-group">
												<label for="" class="col-form-label">Cargar Archivo</label>
												<div class="custom-file">
													<label id="LabelfileOTPrvCarga" class="custom-file-label" for="customFileLang">Seleccionar Archivo .xlsx</label>
													<input type="file" class="custom-file-input" id="fileOTPrvCarga" lang="es" accept=".xlsx"> 
												</div>
												<div id="MsfileOTPrvCarga"class="invalid-feedback">Complete el campo.</div>
											</div>
									  	</div>
									  	<div class="col-lg-3">
										  	<div class="form-group">
											  	<label for="" class="col-form-label"></label>
												<button type="submit" id="btnCargarOTPrvCarga" class="btn btn-success">Cargar</button>
											</div>
									  	</div>
								  	</div>    
							  	</div>
								<div class="modal-footer" id="div_ResultadoOTPrvCarga">
									<!-- Carga de Mensajes -->
								</div>
						  	</form>
						</div>
					</div>
				</div>
			</div>

			<!-- TAB OT PREVENTIVAS -->
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

				<form id="formSeleccionOTPrv" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
			      			<div class="form-group">
								<label for="" class="col-form-label form-control-sm">F.INICIO</label>
								<input type="date" class="form-control form-control-sm" id="FechaInicioOTPrv" placeholder="dd/mm/aaaa" >
			      			</div>
			    		</div>
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="" class="col-form-label form-control-sm">F.TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="FechaTerminoOTPrv" placeholder="dd/mm/aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-2">             	
							<div class="form-group">
								<button type="button" id="btnBuscarOTPrv" class="btn btn-secondary btn-sm">Buscar</button>
								<button type="button" id="btn_descargar_otprv" class="btn btn-secondary btn-sm btn_descargar_otprv">Descargar</button>
							</div>
				    	</div> 
					</div>
				</form>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaOTPrv">
							<!-- PHP Creacion Tablas -->
						</div>
    				</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modal_crud_informacion_otprv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
						<div class="modal-content ui-widget-content" id="modal-resizable_informacion_otprv">
							<div class="modal-header dragable_touch">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body scrollVClass">
								<form id="form_modal_informacion_otprv">
									<div class="container-fluid ml-0 mr-0 mb-0">
										<form id="form_info_detalle_otprv" enctype="multipart/form-data" action="" method="post">    
											<div class="form-group" id="div_info_detalle_otprv">
												<!-- ver_otprv -->
											</div>
										</form>
									</div>			
								</form>
							</div>
							<div class="modal-footer">
					  			<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
  							</div>
						</div>
					</div>
				</div>  			

			</div>

			<!-- TAB PROCESAR OT'S -->
			<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

				<form id="formSeleccionProcesarOTPrv" class="row col-sm-12 container-fluid" onsubmit="return false;">	    
					<div class="row align-items-end pb-0 col-sm-12 mb-1">

						<div class="col-lg-2">
							<div class="form-group mb-0">
								<div class="input-group mt-3">
							  		<div class="input-group-prepend">
       									<span class="input-group-text form-control-sm" id="basic-addon1">OT N° P-</span>
        								<input type="text" class="form-control form-control-sm" id="cod_otpv" placeholder="Código OT" aria-label="cod_otpv" aria-describedby="basic-addon1">
							  		</div>
      							</div>
							</div>
			        	</div>

						<div class="col-lg-2">             	
							<div class="form-group mb-0">
								<button type="button" id="btnCargarOTPrv" class="btn btn-secondary btn-sm" >Cargar</button>
								<button type="button" title='Ver OT' id='btn_procesar_ver_otprv' class='btn btn-secondary btn-sm btn_procesar_ver_otprv'><i class='bi bi-search'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg></i></button>
							</div>
			       		</div> 

					</div>
				</form>

				<div class="container-fluid ml-0 mr-0 mb-0">
					<form id="formProcesarOTPrv" enctype="multipart/form-data" action="" method="post">    
			      		<div class="form-group">
							<div class="row align-items-end">
								<div class="col-lg-5">
									<div class="form-group-sm mb-0" id="div_CodigoOT">
										<!-- CODIGO OT P- -->
									</div>
								</div>
							</div>
			      		    <div class="row">
								<div class="col-lg-4" id="div_DatosCargados">
									<div class="row align-items-end ">
										<div class="col-lg-3">
											<div class="form-group form-control-sm mb-1">
												<label for="otpv_semana" class="col-form-label form-control-sm mb-1">Semana:</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<input readonly type="text" class="form-control form-control-sm mb-1" id="otpv_semana">
											</div>
										</div>
									</div>
									<div class="row align-items-end">	
										<div class="col-lg-3">
											<div class="form-group form-control-sm mb-1">
												<label for="otpv_turno" class="col-form-label form-control-sm mb-1">Turno:</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<select class="form-control form-control-sm mb-1" id="otpv_turno"></select>
											</div>
										</div>
									</div>
									<div class="row align-items-end">	
										<div class="col-lg-3">
											<div class="form-group form-control-sm mb-1">
												<label for="" class="col-form-label form-control-sm mb-1">Fecha Prog.:</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<input type="date" class="form-control form-control-sm mb-1" id="otpv_date_prog">
											</div>
										</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-3">
											<div class="form-group form-control-sm mb-1">
												<label for="otpv_bus" class="col-form-label form-control-sm mb-1">Bus:</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<select class="form-control form-control-sm mb-1" id="otpv_bus"></select>
											</div>
										</div>
									</div>
									<div class="row align-items-end">	
										<div class="col-lg-3">
											<div class="form-group form-control-sm mb-1">
												<label for="otpv_fecuencia" class="col-form-label form-control-sm mb-1">Frec. Progr.:</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<input type="text" class="form-control form-control-sm mb-1 text-uppercase" id="otpv_fecuencia" maxlength="50">
											</div>
										</div>
									</div>
									<div class="row align-items-end mb-5">	
										<div class="col-lg-3">
											<div class="form-group form-control-sm mb-1">
												<label for="otpv_descripcion" class="col-form-label form-control-sm mb-1">Descripción:</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
											<textarea class="form-control form-control-sm mb-1 text-uppercase" id="otpv_descripcion" rows="3"></textarea>
											</div>
										</div>
									</div>
									<div class="row align-items-end">	
										<div class="col-lg-3">
											<div class="form-group form-control-sm mb-1">
												<label for="otpv_asociado" class="col-form-label form-control-sm mb-1">Asociado:</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<select class="form-control form-control-sm mb-1" id="otpv_asociado"></select>
											</div>
										</div>
									</div>
									<div class="row align-items-end">	
										<div class="col-lg-3">
											<div class="form-group form-control-sm mb-1">
												<label for="" class="col-form-label form-control-sm mb-1">Estado:</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<input type="text" readonly class="form-control form-control-sm mb-1" id="otpv_estado">
											</div>
										</div>
									</div>
									<div class="row align-items-end">	
										<div class="col-lg-3">
											<div class="form-group form-control-sm mb-1">
												<label for="" class="col-form-label form-control-sm mb-1">Generado:</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<input type="text" readonly class="form-control form-control-sm mb-1" id="otpv_genera">
											</div>
										</div>
									</div>
									<div class="row align-items-end">	
										<div class="col-lg-3">
											<div class="form-group form-control-sm mb-1">
												<label for="" class="col-form-label form-control-sm mb-1">Ultima Md:</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<input type="text" readonly class="form-control form-control-sm mb-1" id="otpv_cierra_ad">
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4" id="div_DatosEditados">
									<div class="row align-items-end">
										<div class="col-lg-3">
											<div class="form-group form-control-sm mb-1">
							    				<label for="otpv_tecnico" class="col-form-label form-control-sm mb-1">Técn. Resp.:</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<select class="form-control form-control-sm mb-1" id="otpv_tecnico" name="otpv_tecnico">
												</select>
								    			<div id="Msotpv_tecnico" class="invalid-feedback">Complete el campo.</div>
											</div>
										</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-3">
											<div class="form-group form-control-sm mb-1">
							    				<label for="" class="col-form-label form-control-sm mb-1">Fecha Inicio:</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<input type="datetime-local" class="form-control form-control-sm mb-1" id="otpv_inicio">
								    			<div id="Msotpv_inicio" class="invalid-feedback">Complete el campo.</div>
											</div>
										</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-3">
											<div class="form-group form-control-sm mb-1">
							    				<label for="" class="col-form-label form-control-sm mb-1">Fecha Final.:</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group form-control-sm mb-1">
												<input type="datetime-local" class="form-control form-control-sm mb-1" id="otpv_fin">
								    			<div id="Msotpv_fin" class="invalid-feedback">Complete el campo.</div>
											</div>
										</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-3">
											<div class="form-group form-control-sm mb-1">
							    				<label for="" class="col-form-label form-control-sm mb-1">Kilometraje:</label>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group form-control-sm mb-1">
												<input type="text" class="form-control form-control-sm mb-1" id="otpv_kmrealiza">
											</div>
										</div>
										<!--<div class="col-lg-5">
											<div class="form-group form-control-sm" id="div_KmComparacion">
							    				
											</div>
										</div>-->
									</div>
									<div class="row align-items-end">
										<div class="col-lg-3">
										</div>
										<div class="col-lg-7">
											<div class="form-group" id="div_KmComparacion">
							    				
											</div>
										</div>
									</div>

									<div class="row align-items-end">
										<div class="col-lg-3">
											<div class="form-group form-control-sm mb-1">
							    				<label for="" class="col-form-label form-control-sm mb-1">Hora Motor:</label>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group form-control-sm mb-1">
												<input type="text" class="form-control form-control-sm mb-1" id="otpv_hmotor">
								    			<div id="Msotpv_hmotor"class="invalid-feedback">Complete el campo.</div>
											</div>
										</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-3">
											<div class="form-group form-control-sm mb-1">
							    				<label for="" class="col-form-label form-control-sm mb-1">CGM Cierra:</label>
											</div>
										</div>
										<div class="col-lg-5">
											<div class="form-group form-control-sm mb-1">
												<select class="form-control form-control-sm mb-1" id="otpv_cgm_cierra">
												</select>
											</div>
										</div>
									</div>
									<div class="row align-items-end  pl-3">
										<div class="form-group col-lg-10 mb-1">
    										<label for="otpv_obs_as" class="form-control-sm pl-0 mb-0">Observaciones de Asociado (Máximo 12000 carácteres)</label>
    										<textarea class="form-control form-control-sm mb-1 text-uppercase" id="otpv_obs_as" rows="3" placeholder="escribe algo aqui..." maxlength="12000"></textarea>
  										</div>
										<div class="form-group col-lg-10 mb-1">
											<label for="otpv_obs_cgm" class="form-control-sm pl-0 mb-0">Observaciones de CGM (Máximo 4000 carácteres)</label>
											<textarea class="form-control form-control-sm mb-1 text-uppercase" id="otpv_obs_cgm" placeholder="escribe algo aqui..." rows="3" maxlength="4000"></textarea>
										</div>
  										<div class="form-group col-lg-10 mb-1">
  											<label for="div_otpv_obs_cierre_ad" class="form-control-sm pl-0 mb-0">Observaciones Cierre Administrativo</label>
											<button type="button" id="btnLogOTPrv" class="btn btn-info btn-sm">Log..</button>
									<!--	    <div class="form-control-sm mb-1 overflow-auto h-100" id="div_otpv_obs_cierre_ad"></div>  -->
  										</div>
  										<div class="form-group col-lg-10">
  											<textarea class="form-control form-control-sm mb-1 text-uppercase" id="otpv_obs_cierre_ad2"  placeholder="escribe algo aqui..." rows="3"></textarea>
  										</div>
									</div>  											
									<div class="row align-items-end ">
										<div class="col-lg-4">
											<div class="form-group form-control-sm mb-1">
												<label for="" class="col-form-label form-control-sm mb-1">GUARDAR COMO</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group form-control-sm mb-1">
												<select class="form-control form-control-sm mb-1" id="selectotpv_estado">
												</select>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group form-control-sm mb-1">
												<button type="button" id="btnGuardarOTPrv" class="btn btn-dark btn-sm form-control-sm mb-1">Guardar</button>
											</div>
										</div>
									</div>
			      		        </div>
							</div>
						</div>
			      	</form>
				</div>

				<!-- Modal para CRUD LOG OTPreventivas-->
				<div class="row modal fade" id="modalCRUDLogOTPrv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="formModalLogOTPrv" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_log">
												<!-- JS Cierre Administrativo -->
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
				<!-- Termino de CRUD LOG PEDIDOS --> 

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modal_crud_ver_otprv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
						<div class="modal-content ui-widget-content" id="modal-resizable_ver_otprv">
							<div class="modal-header dragable_touch">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body scrollVClass">
								<form id="form_modal_ver_otprv">
									<div class="container-fluid ml-0 mr-0 mb-0">
										<form id="form_ver_otprv" enctype="multipart/form-data" action="" method="post">    
											<div class="form-group" id="div_ver_otprv">
												<!-- ver_otprv -->
											</div>
										</form>
									</div>			
								</form>
							</div>
							<div class="modal-footer">
					  			<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
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