<!-- 2.2 CONTENIDO DE MODULO -->
<div id="contenido" class="my-contenido-con-sidebar  p-0">

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
	 		<div class="nav nav-tabs" id="nav-tab-DespachoFlota" role="tablist">
				<!-- PHP Accesos CreacionTabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">
			<!----------------------------------------------------------------------------------------->
	  		<!------------------------------- TAB SALIDA DE FLOTA  ------------------------------------>
			<!----------------------------------------------------------------------------------------->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<form id="formSeleccionSalidaFlota" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
				        	<div class="form-group">
								<label for="Prog_FechaSalidaFlota" class="col-form-label form-control-sm">FECHA</label>
								<input type="date" class="form-control form-control-sm" id="Prog_FechaSalidaFlota" placeholder="dd/mm/aaaaa">
					       	</div>
			        	</div>
						<div class="col-lg-1">
				        	<div class="form-group">
								<label for="Prog_OperacionSalidaFlota" class="col-form-label form-control-sm">OPERACION</label>
								<select class="form-control form-control-sm" id="Prog_OperacionSalidaFlota">
								</select>
					       	</div>
			        	</div>
						<div class="col-lg-1">
				        	<div class="form-group">
								<label for="tipo_SalidaFlota" class="col-form-label form-control-sm">TIPO</label>
								<select class="form-control form-control-sm" id="tipo_SalidaFlota">
								</select>
					       	</div>
			        	</div>
						<div class="col-lg-1">             	
							<div class="form-group">
								<button type="button" id="btnBuscarSalidaFlota" class="btn btn-secondary btn-sm btnBuscarSalidaFlota">Buscar</button>
							</div>
			       		</div> 
						<div class="col-lg-1">             	
							<div class="form-group" id="div_btnGenerarSalidaFlota">
								<!-- PHP Accesos BotonesFormulario -->
							</div>
			       		</div> 

					</div>
				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tablaSalidaFlota">        
								<!-- PHP Accesos CreacionTablas -->
				            </div>
				        </div>
				    </div>  
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDSalidaFlota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog" role="document">
			        	<div class="modal-content">
						    <div class="modal-header">
				                <h5 class="modal-title" id="exampleModalLabel"></h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				                </button>
			    	        </div>
						  	<form id="formSalidaFlota">    
				      		    <div class="modal-body">
				      		        <div class="row">
				      		            <div class="col-lg-6">
					  		                <div class="form-group">
							                  	<label for="" class="col-form-label">Fecha</label>
							                   	<input type="date" class="form-control" id="dFechaSalidaFlota" disabled>
						    	           	</div>
			      		            	</div>
				      		            <div class="col-lg-6">
					  		                <div class="form-group">
							                	<label for="" class="col-form-label">Operación</label>
												<input type="text" class="form-control" id="selectOperacionSalidaFlota" disabled>
				  			                </div> 
			      			            </div>    
			      		    	    </div>
			      		        	<div class="row"> 
			      		            	<div class="col-lg-4">
				  		                	<div class="form-group">
						                   		<label for="" class="col-form-label">H.Inicio</label>
						                   		<input type="time" class="form-control" id="tHoraInicioSalidaFlota">
											</div>               
						           		</div>
						               	<div class="col-lg-4">
						                  	<div class="form-group">
						                   		<label for="" class="col-form-label">H.Termino</label>
						                   		<input type="time" class="form-control" id="tHoraTerminoSalidaFlota">
				  		                	</div>
			      		            	</div>
										<div class="col-lg-4">
						                  	<div class="form-group">
						                   		<label for="" class="col-form-label">Turno</label>
						                   		<select class="form-control" id="selectTurnoSalidaFlota">
												</select>
				  		                	</div>
			      		            	</div>  
			      		        	</div>
								</div>
			      		    	<div class="modal-footer">
			      		        	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
			      		        	<button type="submit" id="btnCrearSalidaFlota" class="btn btn-dark">Generar</button>
			      		    	</div>
			      			</form>    
			        	</div>
			    	</div>
				</div>  			
			</div>

			<!-------------------------------------------------------------------------------------->
			<!-------------------------- TAB REGISTRO DESPACHO FLOTA ------------------------------->
			<!-------------------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<form id="formSeleccionDespachoFlota" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
							<div class="form-group">
								<label for="Prog_FechaDespachoFlota" class="col-form-label form-control-sm">F. OPERACION</label>
								<input type="date" class="form-control form-control-sm" id="Prog_FechaDespachoFlota" placeholder="dd/mm/aaaaa">
						   	</div>
						</div>
						<div class="col-lg-1">
				        	<div class="form-group">
								<label for="turno_DespachoFlota" class="col-form-label form-control-sm">TURNO</label>
								<select class="form-control form-control-sm" id="turno_DespachoFlota">
								</select>
					       	</div>
			        	</div>
						<div class="col-sm-1">
							<div class="form-group">
								<button type="button" id="btnBuscarDespachoFlota" class="btn btn-secondary btn-sm">Buscar</button>
							</div>
						</div>
					</div>   
				</form>
	
				<div class="row p-1">
					<div class="col-auto m-0">
    			    	<div class="col-md-8 col-sm-12 right_box">
    			        	<div class="row">
    			            	<div class="card-columns" id="div_card-columns-DespachoFlota">
									<!-- PHP Logico BuscarProgramacion -->
    			            	</div>
    			        	</div>
    			    	</div>
					</div>
				</div>

				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDDespachoFlota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog" role="document">
				        <div class="modal-content">

						    <div class="modal-header">
				                <h5 class="modal-title" id="exampleModalLabel"></h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
				                </button>
				            </div>

						  	<form id="formDespachoFlota" enctype="multipart/form-data" action="" method="post">    
				      		    <div class="modal-body">
								  	<div class="row align-items-end">
										<div class="col-lg-6">    
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Bus Cambio</label>
												<select class="form-control" id="Repo_BusCambio">
												</select>
										    	<div id="MsRepo_BusCambio" class="invalid-feedback">Complete el campo.</div>
			      						    </div>
			      						</div>
										<div class="col-lg-6">
				  						    <div class="form-group">
												<label for="" class="col-form-label">Hora Salida</label>
												<div class="input-group">
													<input type="text" name="HoraSalida" class="form-control col-lg-4" id="HoraSalida" title="Hora ente 1 y 30" maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 1 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
													<label class="form-control col-lg-1">:</label>
													<input type="text" name="MinutoSalida" class="form-control col-lg-4" id="MinutoSalida" title="Minutos entre 0 y 59"  maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
												</div>
												<div id="MsRepo_HoraSalida"class="invalid-feedback">Complete el campo.</div>
										    </div>               
										</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-12">
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Motivo</label>
												<select class="form-control" id="Repo_Motivo">
												</select>
										    	<div id="MsRepo_Motivo" class="invalid-feedback">Complete el campo.</div>
			      						    </div>            
			      						</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-12">
				      				        <div class="form-group shadow-textarea">
				      				            <label for="CFaci_Reporte" class="col-form-label">Descripcion Novedad</label>
				      				            <textarea class="form-control z-depth-1" id="Repo_Descripcion" rows="7" placeholder="escribe algo aqui..."></textarea>
									       		<div id="MsRepo_Descripcion" class="invalid-feedback">Complete el campo.</div>
				      				        </div>
				      				    </div>
				      		        </div>
				      		    </div>
				      		    <div class="modal-footer">
				      		        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
				      		        <button type="submit" id="btnGuardarDespachoFlota" class="btn btn-dark">Guardar</button>
				      		    </div>
				      		</form>    

						</div>
				    </div>
				</div>  			
			</div>

			<!---------------------------------------------------------------------->
			<!-------------------------- TAB DESPACHO FLOTA ------------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-despacho" role="tabpanel" aria-labelledby="nav-despacho-tab">
				<form id="formSeleccionInformeDespacho" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">

						<div class="col-lg-2">
				        	<div class="form-group">
								<label for="" class="col-form-label">Fecha:</label>
								<input type="date" class="form-control" id="Prog_FechaInformeDespacho" placeholder="dd/mm/aaaaa">
					       	</div>
			        	</div>
						<div class="col-lg-2">
				        	<div class="form-group">
								<label for="" class="col-form-label">Operación:</label>
								<select class="form-control" id="Prog_OperacionInformeDespacho">
								</select>
					       	</div>
			        	</div>
						<div class="col-lg-2">
				        	<div class="form-group">
								<label for="" class="col-form-label">Turno:</label>
								<select class="form-control" id="turno_InformeDespacho">
								</select>
					       	</div>
			        	</div>
						
						<div class="col-lg-3">             	
							<div class="form-group">
								<button type="button" id="btnBuscarInformeDespacho"class="btn btn-success"> Buscar </button>
							</div>
			       		</div> 

					</div>
				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tablaInformeDespacho">        
								<!-- PHP Accesos CreacionTablas -->
				            </div>
				        </div>
				    </div>  
				</div>   

			</div>
			  	
			<!--------------------------------------------------------------------------->
			<!------------------------- TAB LLEGADA DE FLOTA ---------------------------->
			<!--------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
			<form id="formSeleccionInformeLlegada" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-2">
				        	<div class="form-group">
								<label for="" class="col-form-label">Fecha de Operación:</label>
								<input type="date" class="form-control" id="Prog_FechaInformeLlegada" placeholder="dd/mm/aaaaa">
								<div id="MsProg_FechaInformeLlegada"class="invalid-feedback">Complete el campo.</div>
					       	</div>
			        	</div>
						<div class="col-lg-2">
				        	<div class="form-group">
								<label for="" class="col-form-label">Operación:</label>
								<select class="form-control" id="Prog_OperacionInformeLlegada">
								</select>
					       	</div>
			        	</div>
						<div class="col-lg-2">
				        	<div class="form-group">
								<label for="" class="col-form-label">Tipo:</label>
								<select class="form-control" id="tipo_InformeLlegada">
								</select>
					       	</div>
			        	</div>
						<div class="col-lg-1">             	
							<div class="form-group">
								<button type="button" id="btnBuscarInformeLlegada"class="btn btn-success"> Buscar </button>
							</div>
			       		</div> 

					</div>
				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tablaInformeLlegada">        
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
