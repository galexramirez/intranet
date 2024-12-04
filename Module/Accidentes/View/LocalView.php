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
		</div>
	</nav>

	<!-- Contenido para el Modulo -->
	<div class="my-contenidoModulo container-fluid pl-0 pr-0 ml-0 mr-0">

		<nav>
	 		<div class="nav nav-tabs" id="nav-tab-Accidentes" role="tablist">
				<!-- PHP Accesos Creacion Tabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">
			<!--------------------------------------------------------------------------->
	  		<!-- TAB ACCIDENTES --------------------------------------------------------->
			<!--------------------------------------------------------------------------->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
			
				<form id="formSeleccionAccidentes" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    

				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tablaAccidentes">        
				           		<!-- PHP Accesos Creacion Tabla -->
				            </div>
				        </div>
				    </div>  
				</div>   
			
				<!--Modal para CRUD DETALLE DE CONTROL FACILITADOR-->
				<div class="row modal fade" id="modalCRUDDetalleControlFacilitador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog modal-xl" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
							<form id="formDetalleControlFacilitador">    
								<div class="modal-body scrollVClass" id="div_DetalleControlFacilitador">
									<!-- Se debe genera la informacion detallada del control facilitador y la novedad -->
								</div>
			      				<div class="modal-footer">
			      					<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cerrar</button>
			      				</div>
							</form>
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD PDF-->
				<div class="row modal fade" id="modalCRUDPDFCarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="formModalPDFCarga" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
			      		        	<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group">
												<div class="custom-file">
							  						<label id="labelAcci_PDF" class="custom-file-label" for="customFileLang">Seleccionar Archivo .pdf</label>
							  						<input type="file" class="custom-file-input" id="Acci_PDF" lang="es" accept=".pdf"> 
												</div>
				               				</div>
										</div>
									</div>
			      		        </div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
			      					<button type="submit" id="btnGuardarPDFCarga" class="btn btn-dark">Cargar</button>
								</div>
							  </form>
			        	</div>
			    	</div>
				</div>

			</div>
			
			<!--------------------------------------------------------------------------->
			<!-- TAB INFORME PRELIMINAR ------------------------------------------------->
			<!--------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

				<form id="formSeleccionInformePreliminar" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-2">
				        	<div class="form-group">
								<label for="selectInformePreliminar_Id" class="col-form-label form-control-sm">CODIGO APLICACION</label>
								<input type="text" class="form-control form-control-sm" id="selectInformePreliminar_Id">
					       	</div>
			        	</div>
						<div class="col-lg-1">
							<div class="form-group">
								<button type="button" id="btnBuscarInformePreliminar"class="btn btn-secondary btn-sm btnBuscarInformePreliminar">Cargar</button>
							</div>
			       		</div> 
					</div>
				</form>

				<nav>
	 				<div class="nav nav-tabs" id="nav-tab-InformePreliminar" role="tablist">
						<!-- PHP Accesos Creacion Tabs -->
					</div>
				</nav>
				
				<div class="tab-content" id="nav-tabContent-profile">
					<!----------------------------------------------------------------------------------->
	  				<!------------------------- TAB ACCIDENTE INCIDENTE ---------------------------------->
					<!----------------------------------------------------------------------------------->
					<div class="tab-pane fade show active" id="nav-AccidenteIncidente" role="tabpanel" aria-labelledby="nav-AccidenteIncidente-tab">
						<div class="container-fluid ml-0 mr-0">
							<form id="formAccidenteIncidente" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="form-group">
			      		        	<div class="row align-items-end">
									  	<div class="col-lg-2">
											<div class="text-center form-group" id="div_CodigoQr">
				  				        		<!--<img src=" " />-->
											</div>
			      		            	</div>
										<div class="col-lg-10">
											<div class="row align-items-end">	
												<div class="col-lg-4 d-flex align-items-center">
													<div class="form-group form-control-sm mb-1 text-center" id="div_Accidentes_Id">
														<!-- PHP MostrarDiv Accidentes Id -->
													</div>
												</div>
											</div>		
											<div class="row align-items-end">
												<div class="col-lg-2">
													<div class="form-group">
								            			<label for="" class="col-form-label form-control-sm">Tipo Accidente</label>
														<select class="form-control form-control-sm" id="Acci_TipoAccidente">
														</select>
				  				            		</div> 
			      		            			</div>
												  <div class="col-lg-2">
													<div class="form-group">
								            			<label for="" class="col-form-label form-control-sm">Clase Accidente</label>
														<select class="form-control form-control-sm" id="Acci_ClaseAccidente">
														</select>
				  				            		</div> 
			      		            			</div>
												<div class="col-lg-4">
													<div class="form-group">
														<label for="" class="col-form-label form-control-sm">Tipo de Evento</label>
														<select class="form-control form-control-sm" id="Acci_TipoEvento">
														</select>
				  				        		    </div> 
												</div>
												<div class="col-lg-2">
													<div class="form-group">
														<label for="" class="col-form-label form-control-sm">Fecha</label>
														<input type="date" class="form-control form-control-sm" id="Acci_FechaAccidente" placeholder="dd/mm/aaaaa">
			   										</div>
												</div>	
												<div class="col-lg-2">
													<div class="form-group">
								        		    	<label for="" class="col-form-label form-control-sm">Hora</label>
														<div class="input-group">
															<input type="text" name="HoraAccidente" class="form-control col-lg-3 form-control-sm" id="HoraAccidente" title="Hora ente 1 y 30" 		maxlength="2"  onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.		keyCode)) < 1 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
															<label class="form-control col-lg-1 form-control-sm">:</label>
															<input type="text" name="MinutoAccidente" class="form-control col-lg-3 form-control-sm" id="MinutoAccidente" title="Minutos entre 0 y 59"  		maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.		keyCode)) < 0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
														</div>
				  				        		    </div> 
			      		            			</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-2"> 
													<div class="form-group">
														<label for="" class="col-form-label form-control-sm">Consecuencias del Evento</label>
														<select class="form-control form-control-sm" id="Acci_Lesiones">
														</select>
													</div>
												</div>
												<div class="col-lg-2"> 
													<div class="form-group">
														<label for="" class="col-form-label form-control-sm">Daños Materiales</label>
														<select class="form-control form-control-sm" id="Acci_DanosMateriales">
														</select>
													</div>
												</div>
 												<div class="col-lg-1">
													<div class="form-group">
														<label for="" class="col-form-label form-control-sm">DNI</label>
														<input type="text" class="form-control form-control-sm" id="Acci_Dni" placeholder="" disabled>
				  				        		    </div> 
			      		            			</div>
												<div class="col-lg-1">
													<div class="form-group">
														<label for="" class="col-form-label form-control-sm">Código</label>
														<input type="text" class="form-control form-control-sm" id="Acci_CodigoColaborador" placeholder="" disabled>
				  				        		    </div> 
			      		            			</div>
												<div class="col-lg-3">
							  	    				<div class="form-group">
								    				    <label for="" class="col-form-label form-control-sm">Nombre PILOTO</label>
														<select class="form-control form-control-sm" id="Acci_NombreColaborador">
														</select>
							  	    				</div>
			    			  	    			</div>
												  <div class="col-lg-3">
													<div class="form-group">
														<label for="acci_lugar_referencia" class="col-form-label form-control-sm">Lugar Exacto / Estación o Paradero de Referencia</label>
														<input type="text" class="form-control form-control-sm text-uppercase" id="acci_lugar_referencia" placeholder="">
				  				        		    </div> 
			      		            			</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-1">
				  				    				<div class="form-group">
								    					<label for="" class="col-form-label form-control-sm">Tabla</label>
								    					<select class="form-control form-control-sm" id="Acci_TablaAccidente">
														</select>
				  				    				</div> 
			      				    			</div>
												<div class="col-lg-1">
				  								    <div class="form-group">
												    	<label for="" class="col-form-label form-control-sm">Servicio</label>
														<input class="form-control form-control-sm" id="Acci_ServicioAccidente" disabled>
				  								    </div> 
			      								</div>	
												<div class="col-lg-1">
													<div class="form-group">
								        		    	<label for="Acci_km_perdidos_accidente" class="col-form-label form-control-sm">Km. Perd.</label>
														<input type="text" class="form-control form-control-sm" id="Acci_km_perdidos_accidente">
				  				        		    </div> 
			      		            			</div>
												<div class="col-lg-3">
													<div class="form-group">
														<label for="" class="col-form-label form-control-sm">Lugar</label>
														<select class="form-control form-control-sm" id="Acci_LugarAccidente">
														</select>
				  				        		    </div> 
			      		            			</div>
												<div class="col-lg-1">    
			      				    			    <div class="form-group">
			      				    			    	<label for="" class="col-form-label form-control-sm">Bus</label>
														<select class="form-control form-control-sm" id="Acci_BusAccidente">
														</select>
			      				    			    </div>            
			      				    			</div>
												<div class="col-lg-1">
													<div class="form-group">
														<label for="" class="col-form-label form-control-sm">No.Placa</label>
														<input type="text" class="form-control form-control-sm" id="Acci_NroPlacaAccidente" placeholder="AVG-234" disabled>
				  				        		    </div> 
			      		            			</div>
												<div class="col-lg-2">
			      								   	<div class="form-group">
			      								    	<label for="" class="col-form-label form-control-sm">Sentido</label>
			      								    	<select class="form-control form-control-sm" id="Acci_SentidoAccidente">
														</select>
			      								    </div>
			      								</div>
												<div class="col-lg-1">
			      								   	<div class="form-group">
			      								    	<label for="Acci_ConciliacionAccidente" class="col-form-label form-control-sm">Conciliación</label>
			      								    	<select class="form-control form-control-sm" id="Acci_ConciliacionAccidente">
														</select>
			      								    </div>
			      								</div>
												<div class="col-lg-1">
													<div class="form-group">
								    		        	<label for="Acci_MontoConciliadoAccidente" class="col-form-label form-control-sm">Importe S/.</label>
														<input type="number" class="form-control form-control-sm" id="Acci_MontoConciliadoAccidente" disabled>
				  				    		        </div> 
			      		            			</div>
											</div>
										</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-2">
							  	    				<div class="form-group">
								    				    <label for="" class="col-form-label form-control-sm">CGO de Turno</label>
														<select class="form-control form-control-sm" id="Acci_NombreCGO">
														</select>
							  	    				</div> 
			    			  	    			</div>
										<div class="col-lg-2">
							  	    		<div class="form-group">
								    		    <label for="" class="col-form-label form-control-sm">Personal APOYO OPERACIONES</label>
												<select class="form-control form-control-sm" id="Acci_NombrePersonalApoyo">
												</select>
							  	    		</div> 
			    			  	    	</div>
										<div class="col-lg-1">
			      						   	<div class="form-group">
			      						    	<label for="" class="col-form-label form-control-sm">Recon. Resp.</label>
			      						    	<select class="form-control form-control-sm" id="Acci_ReconoceResponsabilidadAccidente">
												</select>
			      						    </div>
			      						</div>	
										<div class="col-lg-2">
											<div class="form-group">
								            	<label for="" class="col-form-label form-control-sm">Clinica / Hospital</label>
												<input type="text" class="form-control form-control-sm text-uppercase" id="Acci_HospitalAccidente">
				  				            </div> 
			      		            	</div>
										<div class="col-lg-2">
			      						   	<div class="form-group">
			      						    	<label for="" class="col-form-label form-control-sm">Comisaría</label>
			      						    	<select class="form-control form-control-sm" id="Acci_ComisariaAccidente">
												</select>
			      						    </div>
			      						</div>
										<div class="col-lg-1">
											<div class="form-group">
								            	<label for="" class="col-form-label form-control-sm">Fin de Atención</label>
												<div class="input-group">
													<input type="text" name="HoraFinAtencionAccidente" class="form-control col-lg-5 form-control-sm" id="HoraFinAtencionAccidente" title="Hora ente 1 y 30" maxlength="2"  onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 1 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
													<label class="form-control col-lg-2 form-control-sm">:</label>
													<input type="text" name="MinutoFinAtencionAccidente" class="form-control col-lg-5 form-control-sm" id="MinutoFinAtencionAccidente" title="Minutos entre 0 y 59"  maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
													</div>
				  				            </div> 
			      		            	</div>
										<div class="col-lg-1">
											<div class="form-group">
								            	<label for="" class="col-form-label form-control-sm">H.Trab.Accidente</label>
												<div class="input-group">
													<input type="text" name="HoraTrabajadasAccidente" class="form-control col-lg-5 form-control-sm" id="HoraTrabajadasAccidente" title="Hora ente 0 y 30" maxlength="2"  onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
													<label class="form-control col-lg-1 form-control-sm">:</label>
													<input type="text" name="MinutoTrabajadosAccidente" class="form-control col-lg-5 form-control-sm" id="MinutoTrabajadosAccidente" title="Minutos entre 0 y 59"  maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
													</div>
				  				            </div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-2">
											<div class="form-group">	
												<label for="" class="col-form-label form-control-sm">Objeto del Accidente</label>
												<select class="form-control form-control-sm" id="Acci_ObjetoAccidente">
												</select>
											</div>
										</div>
										<div class="col-lg-2">
							  	    		<div class="form-group">
								    		    <label for="" class="col-form-label form-control-sm">CGM de Turno</label>
												<select class="form-control form-control-sm" id="Acci_NombreCGM">
												</select>
							  	    		</div> 
			    			  	    	</div>
										<div class="col-lg-2">
							  	    		<div class="form-group">
								    		    <label for="" class="col-form-label form-control-sm">Personal APOYO MANTENIMIENTO</label>
												<select class="form-control form-control-sm" id="Acci_NombrePersonalApoyoManto">
												</select>
							  	    		</div> 
			    			  	    	</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group">
												<label for="" class="col-form-label form-control-sm">Documentos Anexos</label>
												<div class="row align-items-end">
													<div class="col-lg-1">
														<div class="custom-control custom-checkbox">
  															<input type="checkbox" class="custom-control-input form-control-sm" id="Acci_DocReporteAccidente">
  															<label class="custom-control-label form-control-sm" for="Acci_DocReporteAccidente">Reporte de Accidente</label>
														</div>
													</div>
													<div class="col-lg-1">
														<div class="custom-control custom-checkbox">
  															<input type="checkbox" class="custom-control-input form-control-sm" id="Acci_DocConciliacion">
  															<label class="custom-control-label form-control-sm" for="Acci_DocConciliacion">Conciliacion</label>
														</div>
													</div>
													<div class="col-lg-1">
														<div class="custom-control custom-checkbox">
  															<input type="checkbox" class="custom-control-input form-control-sm" id="Acci_DocPartePolicial">
  															<label class="custom-control-label form-control-sm" for="Acci_DocPartePolicial">Parte Policial</label>
														</div>
													</div>
													<div class="col-lg-1">
														<div class="custom-control custom-checkbox">
  															<input type="checkbox" class="custom-control-input form-control-sm" id="Acci_DocOficioPeritaje">
  															<label class="custom-control-label form-control-sm" for="Acci_DocOficioPeritaje">Oficio de Peritaje</label>
														</div>
													</div>
													<div class="col-lg-1">
														<div class="custom-control custom-checkbox">
  															<input type="checkbox" class="custom-control-input form-control-sm" id="Acci_DocReporteAtencion">
  															<label class="custom-control-label form-control-sm" for="Acci_DocReporteAtencion">Reporte de Atención RIMAC</label>
														</div> 
			      		            				</div>
													<div class="col-lg-1">
														<div class="custom-control custom-checkbox">
  															<input type="checkbox" class="custom-control-input form-control-sm" id="Acci_DocDenunciaPolicial">
  															<label class="custom-control-label form-control-sm" for="Acci_DocDenunciaPolicial">Denuncia Policial</label>
														</div>
													</div>	
													<div class="col-lg-1">
														<div class="custom-control custom-checkbox">
  															<input type="checkbox" class="custom-control-input form-control-sm" id="Acci_DocCitacionManifestacion">
  															<label class="custom-control-label form-control-sm" for="Acci_DocCitacionManifestacion">Citacion a Manifestación</label>
														</div>
													</div>
													<div class="col-lg-1">
														<div class="custom-control custom-checkbox">
  															<input type="checkbox" class="custom-control-input form-control-sm" id="Acci_DocOtro">
  															<label class="custom-control-label form-control-sm" for="Acci_DocOtro">Otro:</label>
														</div>
													</div>
													<div class="col-lg-2">
														<input type="text" class="form-control form-control-sm text-uppercase" id="Acci_DocOtroDescripcion" disabled maxlength="50">
			      		            				</div>
												</div>
											</div>
										</div>
									</div>
									<div class-="row align-items-end">	
										<div class="col-lg-12">
			      				           	<div class="form-group shadow-textarea">
			      				            	<label for="Acci_DescripcionAccidente" class="col-form-label form-control-sm">Descripción del Evento - Información Disponible en el momento (Máx. 1500 caract.)</label>
			      				            	<textarea class="form-control z-depth-1 form-control-sm text-uppercase" id="Acci_DescripcionAccidente" rows="2" placeholder="escribe algo aqui..."></textarea>
			      				            </div>
			      				        </div>    
			      		            </div>
									<div class="row align-items-end d-flex">
										<div class="col-lg-2 p-2">
				  				    		<div class="form-group">
								    			<label for="" class="col-form-label form-control-sm">CGO que suscribe la información :</label>
				  				    		</div> 
			      				        </div>
										<div class="col-lg-2 p-2">
				  				    		<div class="form-group">
								    			<input type="text" class="form-control form-control-sm" id="Acci_NombreSuscribeInformacion" disabled>
				  				    		</div> 
			      				        </div>
										<div class="col-lg-2 p-2">
				  				    		<div class="form-group">
								    			<label for="" class="col-form-label form-control-sm">Fecha y Hora Elaboración del Informe :</label>
				  				    		</div> 
			      				        </div>
										<div class="col-lg-1 p-2">
				  				    		<div class="form-group">
								    			<input type="text" class="form-control form-control-sm" id="Acci_FechaElaboracionInforme" disabled>
				  				    		</div> 
			      				        </div>
										<div class="btn-toolbar ml-auto p-2" id="div_btnInformePreliminar" role="toolbar" aria-label="Toolbar with button groups">
											<!-- PHP Accesos BotonesFormulario -->
										</div>
									</div>
			      		        </div>
			      			</form>
						</div>
					</div>

					<!----------------------------------------------------------------------------------------->
	  				<!------------------------- TAB NATURALEZA DE LA PERDIDA ---------------------------------->
					<!----------------------------------------------------------------------------------------->
					<div class="tab-pane fade" id="nav-NaturalezaPerdida" role="tabpanel" aria-labelledby="nav-NaturalezaPerdida-tab">
						<div class="container-fluid ml-0 mr-0">
							<div class="row">
								<div class="col-lg-6">
									<form id="formDanosPersonales" enctype="multipart/form-data" action="" method="post">    
			      		    			<div class="form-group">
											<div class="row align-items-end">
												<div class="col-lg-8">
													<div class="form-group">
														<label for="" class="col-form-label">Daños Personales</label>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group" id="div_btnAgregarDanosPersonales">
														<!-- PHP Accesos BotonesFormulario -->
													</div>
												</div>
											</div>
										</div>	
									</form>
									<div class="container-fluid caja">
										<div class="row w-100 p-0 m-0">
									       	<div class="col-lg-12">
									       		<div class="table-responsive" id="div_tablaDanosPersonales">
													<!-- PHP Accesos CreacionTabla -->
									            </div>
									        </div>
									    </div>  
									</div>		
								</div>
								<div class="col-lg-6">
									<form id="formDanosTerceros" enctype="multipart/form-data" action="" method="post">    
			      		    			<div class="form-group">
											<div class="row align-items-end">
												<div class="col-lg-8">
													<div class="form-group">
														<label for="" class="col-form-label">Daños Materiales a Terceros</label>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group" id="div_btnAgregarDanosTerceros">
														<!-- PHP Accesos BotonesFormulario -->
													</div>
												</div>
											</div>
										</div>	
									</form>
									<div class="container-fluid caja">
										<div class="row w-100 p-0 m-0">
									       	<div class="col-lg-12">
									       		<div class="table-responsive" id="div_tablaDanosTerceros">
									           		<!-- PHP Accesos CreacionTabla -->
									            </div>
									        </div>
									    </div>  
									</div>		
								</div>
							</div>
						</div>

						<!--Modal para CRUD DAÑOS MATERIALES-->
						<div class="row modal fade" id="modalCRUDDanosMateriales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
			    		    	<div class="modal-content">
							    	<div class="modal-header">
			    		            	<h5 class="modal-title" id="exampleModalLabel"></h5>
			    		            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			    		            	</button>
			    		        	</div>
							  		<form id="formModalDanosMateriales" enctype="multipart/form-data" action="" method="post">    
			    		  		    	<div class="modal-body">
											<div class="row align-items-end">
												<div class="col-lg-12">
			      				           			<div class="form-group shadow-textarea">
			      				            			<label for="Acci_DescripcionNaturaleza" class="col-form-label form-control-sm" id="label_DescripcionNaturaleza"></label>
			      				            			<textarea class="form-control z-depth-1 text-uppercase form-control-sm" id="Acci_DescripcionNaturaleza" rows="5" placeholder="escribe algo aqui..."></textarea>
			      				            		</div>
			      				        		</div>
											</div>
			    		  		        </div>
			    		  		    	<div class="modal-footer">
										  	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
			    		  					<button type="submit" id="btnGuardarDanosMateriales" class="btn btn-dark btn-sm">Agregar</button>
										</div>
									</form>
			    		    	</div>
			    			</div>
						</div>

						<!--Modal para CRUD DAÑOS PERSONALES-->
						<div class="row modal fade" id="modalCRUDDanosPersonales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
			    		    	<div class="modal-content">
							    	<div class="modal-header">
			    		            	<h5 class="modal-title" id="exampleModalLabel"></h5>
			    		            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			    		            	</button>
			    		        	</div>
							  		<form id="formModalDanosPersonales" enctype="multipart/form-data" action="" method="post">    
			    		  		    	<div class="modal-body">
										  	<div class="row align-items-end">
												<div class="col-lg-12">
													<div class="form-group">
								            			<label for="Acci_NombreLesionado" class="col-form-label form-control-sm">Nombre del Lesionado</label>
														<input type="text" class="form-control text-uppercase form-control-sm" id="Acci_NombreLesionado">
				  				            		</div> 
			      		            			</div>
											</div>  
											<div class="row align-items-end">
												<div class="col-lg-3">
													<div class="form-group">
								            			<label for="Acci_DNILesionado" class="col-form-label form-control-sm">DNI (8 c.)</label>
														<input type="text" class="form-control form-control-sm" id="Acci_DNILesionado">
				  				            		</div> 
			      		            			</div>
												<div class="col-lg-2">
													<div class="form-group">
								            			<label for="Acci_EdadLesionado" class="col-form-label form-control-sm">Edad</label>
														<input type="text" class="form-control form-control-sm" id="Acci_EdadLesionado">
				  				            		</div> 
			      		            			</div>
												<div class="col-lg-3">
													<div class="form-group">
								            			<label for="Acci_GeneroLesionado" class="col-form-label form-control-sm">Género</label>
														<select class="form-control form-control-sm" id="Acci_GeneroLesionado">
														</select>
				  				            		</div> 
			      		            			</div> 
												<div class="col-lg-4">
													<div class="form-group">
								            			<label for="acci_origen_lesionado" class="col-form-label form-control-sm">Origen</label>
														<select class="form-control form-control-sm" id="acci_origen_lesionado">
														</select>
				  				            		</div> 
			      		            			</div> 
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
			      				           			<div class="form-group shadow-textarea">
			      				            			<label for="Acci_DetalleLesiones" class="col-form-label form-control-sm" id="label_DetalleLesiones">Detalle de Lesiones (Máx. 250 caráct.)</label>
			      				            			<textarea class="form-control z-depth-1 text-uppercase form-control-sm" id="Acci_DetalleLesiones" rows="5" placeholder="escribe algo aqui..."></textarea>
			      				            		</div>
			      				        		</div>
											</div>
			    		  		        </div>
			    		  		    	<div class="modal-footer">
										  	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
			    		  					<button type="submit" id="btnGuardarDanosPersonales" class="btn btn-dark btn-sm">Agregar</button>
										</div>
									</form>
			    		    	</div>
			    			</div>
						</div>

						<!--Modal para CRUD DAÑOS A TERCEROS-->
						<div class="row modal fade" id="modalCRUDDanosTerceros" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
			    		    	<div class="modal-content">
							    	<div class="modal-header">
			    		            	<h5 class="modal-title" id="exampleModalLabel"></h5>
			    		            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			    		            	</button>
			    		        	</div>
							  		<form id="formModalDanosTerceros" enctype="multipart/form-data" action="" method="post">    
			    		  		    	<div class="modal-body">
										  	<div class="row align-items-end">
												<div class="col-lg-12">
													<div class="form-group">
								            			<label for="Acci_NombreTercero" class="col-form-label form-control-sm">Nombre de Tercero Implicado</label>
														<input type="text" class="form-control text-uppercase form-control-sm" id="Acci_NombreTercero">
				  				            		</div> 
			      		            			</div>
											</div>  
											<div class="row align-items-end">
												<div class="col-lg-6">
													<div class="form-group">
								            			<label for="Acci_DNITercero" class="col-form-label form-control-sm">DNI (8 c.)</label>
														<input type="text" class="form-control form-control-sm" id="Acci_DNITercero">
				  				            		</div> 
			      		            			</div>
												<div class="col-lg-6">
													<div class="form-group">
								            			<label for="Acci_PlacaTercero" class="col-form-label form-control-sm">Placa</label>
														<input type="text" class="form-control form-control-sm" id="Acci_PlacaTercero">
				  				            		</div> 
			      		            			</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
			      				           			<div class="form-group shadow-textarea">
			      				            			<label for="Acci_DetalleDanosTercero" class="col-form-label form-control-sm" id="label_DetalleDanosTercero">Detalle de Daños (Máx. 250 caráct.)</label>
			      				            			<textarea class="form-control z-depth-1 text-uppercase form-control-sm" id="Acci_DetalleDanosTercero" rows="5" placeholder="escribe algo aqui..."></textarea>
			      				            		</div>
			      				        		</div>
											</div>
			    		  		        </div>
			    		  		    	<div class="modal-footer">
										  	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
			    		  					<button type="submit" id="btnGuardarDanosTerceros" class="btn btn-dark btn-sm">Agregar</button>
										</div>
									</form>
			    		    	</div>
			    			</div>
						</div>

					</div>

					<!----------------------------------------------------------------------------------->
	  				<!------------------------- TAB CAUSAS Y ACCIONES ----------------------------------->
					<!----------------------------------------------------------------------------------->
					<div class="tab-pane fade" id="nav-CausasAcciones" role="tabpanel" aria-labelledby="nav-CausasAcciones-tab">
						<div class="container-fluid ml-0 mr-0">
							<div class="row">
								<div class="col-lg-6">
									<form id="formCausasAccidentes" enctype="multipart/form-data" action="" method="post">    
										<div class="form-group">
											<div class="row align-items-end">
												<div class="col-lg-10">
													<div class="form-group">
														<label for="" class="col-form-label">CAUSAS Posibles del Accidente</label>
													</div>
												</div>
												<div class="col-lg-2">
													<div class="form-group" id="div_btnAgregarCausasAccidentes">
														<!-- PHP Accesos BotonesFormulario -->
													</div>
												</div>
											</div>
										</div>
									</form>
									<div class="container-fluid caja">
										<div class="row w-100 p-0 m-0">
									       	<div class="col-lg-12">
									       		<div class="table-responsive" id="div_tablaCausasAccidentes">
													<!-- PHP Accesos CreacionTabla -->
									            </div>
									        </div>
									    </div>  
									</div>
								</div>
								<div class="col-lg-6">
									<form id="formAccionesTomadas" enctype="multipart/form-data" action="" method="post">    
										<div class="form-group">
											<div class="row align-items-end">
												<div class="col-lg-10">
													<div class="form-group">
														<label for="" class="col-form-label">ACCIONES Tomadas al momento del Evento</label>
													</div>
												</div>
												<div class="col-lg-2">
													<div class="form-group" id="div_btnAgregarAccionesTomadas">
														<!-- PHP Accesos BotonesFormulario -->
													</div>
												</div>
											</div>	
										</div>
									</form>
									<div class="container-fluid caja">
										<div class="row w-100 p-0 m-0">
									       	<div class="col-lg-12">
									       		<div class="table-responsive" id="div_tablaAccionesTomadas">
													<!-- PHP Accesos CreacionTabla -->
									            </div>
									        </div>
									    </div>  
									</div>
								</div>
							</div>
						</div>
						<!--Modal para CRUD CAUSAS Y ACCIONES-->
						<div class="row modal fade" id="modalCRUDCausasAcciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
			    		    	<div class="modal-content">
							    	<div class="modal-header">
			    		            	<h5 class="modal-title" id="exampleModalLabel"></h5>
			    		            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			    		            	</button>
			    		        	</div>
							  		<form id="formModalCausasAcciones" enctype="multipart/form-data" action="" method="post">    
			    		  		    	<div class="modal-body">
											<div class="row align-items-end">
												<div class="col-lg-12">
			      				           			<div class="form-group shadow-textarea">
			      				            			<label for="Acci_DescripcionCausasAcciones" class="col-form-label" id="label_DescripcionCausasAcciones"></label>
			      				            			<textarea class="form-control z-depth-1 text-uppercase" id="Acci_DescripcionCausasAcciones" rows="5" placeholder="escribe algo aqui..."></textarea>
								       					<div id="MsAcci_DescripcionCausasAcciones" class="invalid-feedback">Complete el campo.</div>
			      				            		</div>
			      				        		</div>
											</div>
			    		  		        </div>
			    		  		    	<div class="modal-footer">
										  	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
			    		  					<button type="submit" id="btnGuardarCausasAcciones" class="btn btn-dark">Agregar</button>
										</div>
									</form>
			    		    	</div>
			    			</div>
						</div>

					</div>

					<!----------------------------------------------------------------------------------->
	  				<!------------------------- TAB IMAGENES -------------------------------------------->
					<!----------------------------------------------------------------------------------->
					<div class="tab-pane fade" id="nav-Imagenes" role="tabpanel" aria-labelledby="nav-Imagenes-tab">
						<div class="container-fluid ml-0 mr-0">
							<form id="formImagenes" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="form-group">
									<div class="row align-items-end d-flex justify-content-between">
										<div class="col-lg-4">
											<div class="form-group">
												<label for="" class="col-form-label">IMAGENES del Evento</label>
											</div>
										</div>	
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="row">
												<div class="col-lg-6">
													<div class="card">
														<div class="card-body" id="div_Imagen1">
  															<img src="Module/Accidentes/View/Img/SinImagen.jpg" class="card-img-top" alt="Responsive image">
														</div>
  														<div class="card-footer">
															<div class="d-flex justify-content-end">
																<a href="#" class="btn btn-info btn-sm btn_cargar_imagenes_ip" onclick="f_CargarImagenes('Imagen1')">+ Imagen</a>
															</div>
  														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="card">
														<div class="card-body" id="div_Imagen2">
  															<img src="Module/Accidentes/View/Img/SinImagen.jpg" class="card-img-top" alt="Responsive image">
														</div>
  														<div class="card-footer">
														  	<div class="d-flex justify-content-end">
																<a href="#" class="btn btn-info btn-sm btn_cargar_imagenes_ip" onclick="f_CargarImagenes('Imagen2')">+ Imagen</a>
															</div>
  														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<div class="card">
														<div class="card-body" id="div_Imagen3">
  															<img src="Module/Accidentes/View/Img/SinImagen.jpg" class="card-img-top" alt="Responsive image">
														</div>
  														<div class="card-footer">
															<div class="d-flex justify-content-end">
																<a href="#" class="btn btn-info btn-sm btn_cargar_imagenes_ip" onclick="f_CargarImagenes('Imagen3')">+ Imagen</a>
															</div>
  														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="card">
														<div class="card-body" id="div_Imagen4">
  															<img src="Module/Accidentes/View/Img/SinImagen.jpg" class="card-img-top" alt="Responsive image">
														</div>
  														<div class="card-footer">
														  	<div class="d-flex justify-content-end">
																<a href="#" class="btn btn-info btn-sm btn_cargar_imagenes_ip" onclick="f_CargarImagenes('Imagen4')">+ Imagen</a>
															</div>
  														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="row align-items-end">
												<div class="col-lg-12">
													<div class="card">
														<div class="card-body" id="div_Mapa">
  															<img src="Module/Accidentes/View/Img/SinImagen.jpg" class="card-img-top" alt="Responsive image">
														</div>
  														<div class="card-img-overlay">
															<div class="d-flex justify-content-end">
																<a href="#" class="btn btn-info btn-sm btn_cargar_imagenes_ip" onclick="f_CargarImagenes('Mapa')">+ Mapa</a>
															</div>
  														</div>
													</div>
			      		    				    </div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>

						<!--Modal para CRUD IMAGENES-->
						<div class="row modal fade" id="modalCRUDImagenesCarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
			    		    	<div class="modal-content">
							    	<div class="modal-header">
			    		            	<h5 class="modal-title" id="exampleModalLabel"></h5>
			    		            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			    		            	</button>
			    		        	</div>
							  		<form id="formModalImagenesCarga" enctype="multipart/form-data" action="" method="post">    
			    		  		    	<div class="modal-body">
											<div class="row align-items-end">
												<div class="col-lg-12">
													<div class="text-center form-group" id="div_ImagenCarga">
				  				        				<!--<img src=" " />-->
													</div>
			      		            			</div>
											</div>
			    		  		        	<div class="row align-items-end">
												<div class="col-lg-12">
													<div class="form-group">
														<div class="custom-file">
									  						<label id="labelAcci_Imagen" class="custom-file-label" for="customFileLang">Seleccionar Archivo .jpg o .bmp</label>
									  						<input type="file" class="custom-file-input" id="Acci_Imagen" lang="es" accept=".jpg, .bmp"> 
														</div>
														<div id="MsAcci_Imagen"class="invalid-feedback">Complete el campo.</div>
				  		               				</div>
												</div>
											</div>
			    		  		        </div>
			    		  		    	<div class="modal-footer">
										  	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
			    		  					<button type="submit" id="btnGuardarImagenesCarga" class="btn btn-dark">Cargar</button>
										</div>
									  </form>
			    		    	</div>
			    			</div>
						</div>

					</div>

					<!-------------------------------------------------------------------------------------->
	  				<!------------------------- TAB DAÑOS PARA REPARACION ---------------------------------->
					<!-------------------------------------------------------------------------------------->
					<div class="tab-pane fade" id="nav-DanosReparacion" role="tabpanel" aria-labelledby="nav-DanosReparacion-tab">
						<div class="container-fluid ml-0 mr-0">
							<form id="formDanosReparacion" enctype="multipart/form-data" action="" method="post" onsubmit="return false;">    
			      		    	<div class="form-body">
									<div class="row align-items-end">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="" class="col-form-label ">DETALLE DE DAÑOS PARA REPARACION</label>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="" class="col-form-label">CODIGO DE COLORES</label>
											</div>
										</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-6">		
											<div class="form-group">
												<label for="" class="col-form-label">Información Solicitada por Mantenimiento</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<button type="button" class="btn btn-success" disabled>P</button>
												<label for="" class="col-form-label">PINTADO / GRAFITIS +</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<button type="button" class="btn btn-warning" disabled>R</button>
												<label for="" class="col-form-label">RAYADO / RASPADO ++</label>
											</div>
										</div>

									</div>
									<div class="row align-items-end">
										<div class="col-lg-6">	
											<div class="form-group" id="div_btnAgregarDanosReparacion">
												<!-- PHP Accesos BotonesFormulario -->
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<button type="button" class="btn btn-warning" disabled>G</button>
												<label for="" class="col-form-label">GOLPEADO / HUNDIDO +++</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<button type="button" class="btn btn-danger" disabled>Q</button>
												<label for="" class="col-form-label">ROTO / QUEBRADO ++++</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="container-fluid caja">
												<div class="row w-100 p-0 m-0">
											       	<div class="col-lg-12">
											       		<div class="table-responsive" id="div_tablaDanosReparacion">        
															<!-- PHP Accesos CreacionTabla -->
											            </div>
											        </div>
											    </div>  
											</div>
										</div>
										<div class="col-lg-6">
											<div class="card">
												<div class="card-body" id="div_Bus">
  													<img src="Module/Accidentes/View/Img/SinImagen.jpg" class="card-img-top" alt="Responsive image">
												</div>
												<div class="card-img-overlay">
													<div class="d-flex justify-content-end">
														<a href="#" class="btn btn-info btn-sm btn_cargar_imagenes_ip" onclick="f_CargarImagenes('Bus')">+ Bus</a>
													</div>
  												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row align-items-end d-flex">
									<div class="col-lg-3 p-2">
				  				    	<div class="form-group">
								    		<label for="" class="col-form-label">CGO que cierra la informacion</label>
								    		<input type="text" class="form-control" id="Acci_UsuarioId_Cerrar" disabled>
				  				    	</div> 
			      				    </div>
									<div class="col-lg-3 p-2">
				  			    		<div class="form-group">
							    			<label for="" class="col-form-label">Fecha y Hora de Cierre del Informe</label>
							    			<input type="text" class="form-control" id="Acci_FechaCerrar" disabled>
			  				    		</div> 
		      				        </div>
									<div class="col-lg-2 ml-auto p-2">
										<div class="form-group" id="div_btn_cerrar_informe_preliminar">
											<!-- PHP Accesos BotonesFormulario -->
										</div>
									</div>
								</div>
							</form>
						</div>

						<!--Modal para CRUD IMAGENES BUS-->
						<div class="row modal fade" id="modalCRUDImagenesBus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
			    		    	<div class="modal-content">
							    	<div class="modal-header">
			    		            	<h5 class="modal-title" id="exampleModalLabel"></h5>
			    		            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			    		            	</button>
			    		        	</div>
							  		<form id="formModalImagenesBus" enctype="multipart/form-data" action="" method="post">    
			    		  		    	<div class="modal-body">
											<div class="row align-items-end">
												<div class="col-lg-12">
													<div class="text-center form-group" id="div_ImagenBus">
				  				        				<!--<img src=" " />-->
													</div>
			      		            			</div>
											</div>
			    		  		        	<div class="row align-items-end">
												<div class="col-lg-12">
													<div class="form-group">
														<div class="custom-file">
									  						<label id="labelAcci_ImagenBus" class="custom-file-label" for="customFileLang">Seleccionar Archivo .jpg o .bmp</label>
									  						<input type="file" class="custom-file-input" id="Acci_ImagenBus" lang="es" accept=".jpg, .bmp"> 
														</div>
				  		               				</div>
												</div>
											</div>
			    		  		        </div>
			    		  		    	<div class="modal-footer">
										  	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
			    		  					<button type="submit" id="btnGuardarImagenesBus" class="btn btn-dark">Cargar</button>
										</div>
									</form>
			    		    	</div>
			    			</div>
						</div>

						<!--Modal para CRUD DAÑOS PARA REPARACION-->
						<div class="row modal fade" id="modalCRUDDanosReparacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
			    		    	<div class="modal-content">
							    	<div class="modal-header">
			    		            	<h5 class="modal-title" id="exampleModalLabel"></h5>
			    		            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			    		            	</button>
			    		        	</div>
							  		<form id="formModalDanosReparacion" enctype="multipart/form-data" action="" method="post">    
			    		  		    	<div class="modal-body">
											<div class="row align-items-end">
												<div class="col-lg-4">
													<div class="form-group">
														<label for="Acci_CodigoColor" class="col-form-label form-control-sm">Código de Color</label>
														<select class="form-control form-control-sm" id="Acci_CodigoColor">
														</select>
				  				            		</div> 
			      		            			</div>
												<div class="col-lg-8">
													<div class="form-group">
								            			<label for="Acci_SeccionBus" class="col-form-label form-control-sm">Posición (Código Sección Bus)</label>
														<select class="form-control form-control-sm" id="Acci_SeccionBus">

														</select>
				  				            		</div> 
			      		            			</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
			      				           			<div class="form-group shadow-textarea">
			      				            			<label for="Acci_DescripcionReparacion" class="col-form-label form-control-sm" id="label_DescripcionReparacion">Detalle de Daños (Máx. 250 caráct.)</label>
			      				            			<textarea class="form-control z-depth-1 text-uppercase form-control-sm" id="Acci_DescripcionReparacion" rows="5" placeholder="escribe algo aqui..."></textarea>
			      				            		</div>
			      				        		</div>
											</div>
			    		  		        </div>
			    		  		    	<div class="modal-footer">
										  	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
			    		  					<button type="submit" id="btnGuardarDanosReparacion" class="btn btn-dark btn-sm">Agregar</button>
										</div>
									</form>
			    		    	</div>
			    			</div>
						</div>

						<!-- MODAL CRUD LOG IP-->
						<div class="row modal fade" id="modal_crud_log_ip" tabindex="-1" role="dialog" aria-labelledby="example_modal_label_log_ip" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
						    	<div class="modal-content">
							    	<div class="modal-header modal-header-log dragable_touch">
						            	<h5 class="modal-title modal-title-log" id="example_modal_label_log_ip"></h5>
						            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
						            	</button>
						        	</div>
							  		<form id="form_modal_log_ip" enctype="multipart/form-data" action="" method="post">    
						  		    	<div class="modal-body">
											<div class="row align-items-end">
												<div class="col-lg-12">
													<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_log_ip">

													</div>
						  		            	</div>
											</div>  
										</div>
									</form>
						    	</div>
							</div>
						</div>
						<!-- Termino de CRUD LOG SOLICITUDES --> 

					</div>
				
				</div>

			</div>
			  	
			<!--------------------------------------------------------------------------->
			<!-- TAB INVESTIGACION ------------------------------------------------------>
			<!--------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
				<form id="formSeleccionInvestigacion" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="inv_FechaInicio" class="col-form-label form-control-sm">F.INICIO</label>
								<input type="date" class="form-control form-control-sm" id="inv_FechaInicio" placeholder="dd-mm-aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-1">
			    		  	<div class="form-group">
								<label for="inv_FechaTermino" class="col-form-label form-control-sm">F.TERMINO</label>
								<input type="date" class="form-control form-control-sm" id="inv_FechaTermino" placeholder="dd-mm-aaaa" >
			    		  	</div>
			    		</div>
						<div class="col-lg-1">             	
							<div class="form-group">
								<button type="button" id="btnBuscarInvestigacion" class="btn btn-secondary btn-sm btnBuscarInvestigacion">Buscar</button>
							</div>
			       		</div> 

					</div>
				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tablaInvestigacion">        
				           		<!-- PHP Accesos CreacionTabla -->
				            </div>
				        </div>
				    </div>  
				</div>   
			
				<!--Modal para CRUD INVESTIGACION ACCIDENTES-->
				<div class="row modal fade" id="modalCRUDInvestigacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog modal-xl" role="document">
			        	<div class="modal-content">
							<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
							<form id="form_informe_final" enctype="multipart/form-data" action="" method="post">
								<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-3">
				  							<div class="form-group">
											    <h5 class="title_informe_final" id="title_informe_final"></h5>
				  							</div> 
			      						</div>	
									</div>
									<div class="row align-items-end">
										<div class="col-lg-3">
				  							<div class="form-group">
											    <label for="accif_fecha" class="col-form-label form-control-sm">Fecha</label>
												<input type= "text" readonly class="form-control form-control-sm" id="accif_fecha">
				  							</div> 
			      						</div>	
										<div class="col-lg-2">
				  							<div class="form-group">
												<label for="accif_hora" class="col-form-label form-control-sm">Hora</label>
												<input type="text" readonly class="form-control form-control-sm" id="accif_hora">
				  							</div> 
			      						</div>
										<div class="col-lg-3">
				  							<div class="form-group">
											    <label for="accif_piloto" class="col-form-label form-control-sm">Piloto</label>
												<input type= "text" readonly class="form-control form-control-sm" id="accif_piloto">
				  							</div> 
			      						</div>	
										<div class="col-lg-2">
				  							<div class="form-group">
											    <label for="accif_fecha_ingreso" class="col-form-label form-control-sm">Fecha Ingreso</label>
												<input type="date" readonly class="form-control form-control-sm" id="accif_fecha_ingreso">
				  							</div> 
			      						</div>	
										<div class="col-lg-2">
				  							<div class="form-group">
											    <label for="accif_antiguedad" class="col-form-label form-control-sm">Antiguedad</label>
												<input type= "text" readonly class="form-control form-control-sm" id="accif_antiguedad">
				  							</div> 
			      						</div>	
									</div>
									<div class="row align-items-end">
										<div class="col-lg-2">
				  							<div class="form-group">
											    <label for="accif_horas_trabajadas" class="col-form-label form-control-sm">Horas Trabajadas</label>
												<input type= "time" readonly class="form-control form-control-sm" id="accif_horas_trabajadas">
				  							</div> 
			      						</div>	
										<div class="col-lg-2">
				  							<div class="form-group">
												<label for="accif_tabla" class="col-form-label form-control-sm">Tabla</label>
												<input type="text" readonly class="form-control form-control-sm" id="accif_tabla">
				  							</div> 
			      						</div>
										<div class="col-lg-2">
				  							<div class="form-group">
											    <label for="accif_servicio" class="col-form-label form-control-sm">Servicio</label>
												<input type= "text" readonly class="form-control form-control-sm" id="accif_servicio">
				  							</div> 
			      						</div>	
										<div class="col-lg-2">
				  							<div class="form-group">
											    <label for="accif_bus" class="col-form-label form-control-sm">Bus</label>
												<input type="text" readonly class="form-control form-control-sm" id="accif_bus">
				  							</div> 
			      						</div>	
										<div class="col-lg-2">
				  							<div class="form-group">
											    <label for="accif_placa" class="col-form-label form-control-sm">Placa</label>
												<input type= "text" readonly class="form-control form-control-sm" id="accif_placa">
				  							</div> 
			      						</div>	
										  <div class="col-lg-2">
				  							<div class="form-group">
											    <label for="accif_tipo_bus" class="col-form-label form-control-sm">Tipo Bus</label>
												<input type= "text" readonly class="form-control form-control-sm" id="accif_tipo_bus">
				  							</div> 
			      						</div>	
									</div>
									<div class="row align-items-end">
										<div class="col-lg-6">
				  							<div class="form-group">
											    <label for="accif_direccion" class="col-form-label form-control-sm">Dirección</label>
												<input type= "text" readonly class="form-control form-control-sm" id="accif_direccion">
				  							</div> 
			      						</div>	
										<div class="col-lg-6">
				  							<div class="form-group">
												<label for="accif_evento" class="col-form-label form-control-sm">Evento</label>
												<input type="text" readonly class="form-control form-control-sm" id="accif_evento">
				  							</div> 
			      						</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-2">
				  							<div class="form-group">
												<label for="accif_sentido" class="col-form-label form-control-sm">Sentido</label>
												<input type="text" readonly class="form-control form-control-sm" id="accif_sentido">
				  							</div> 
			      						</div>
										<div class="col-lg-2">
				  							<div class="form-group">
											    <label for="accif_tipo_accidente" class="col-form-label form-control-sm">Tipo Accidente</label>
												<input type= "text" readonly class="form-control form-control-sm" id="accif_tipo_accidente">
				  							</div> 
			      						</div>	
										<div class="col-lg-2">
				  							<div class="form-group">
											    <label for="accif_clase_accidente" class="col-form-label form-control-sm">Clase Accidente</label>
												<input type="text" readonly class="form-control form-control-sm" id="accif_clase_accidente">
				  							</div> 
			      						</div>
										<div class="col-lg-2">
				  							<div class="form-group">
											    <label for="accif_reconoce_responsabilidad" class="col-form-label form-control-sm">Recon. Respons.</label>
												<input type= "text" readonly class="form-control form-control-sm" id="accif_reconoce_responsabilidad">
				  							</div> 
			      						</div>	
										<div class="col-lg-2">
				  							<div class="form-group">
											    <label for="accif_cantidad_lesionados" class="col-form-label form-control-sm">Cant. Lesionados</label>
												<input type= "text" readonly class="form-control form-control-sm" id="accif_cantidad_lesionados">
				  							</div> 
			      						</div>	
										<div class="col-lg-2">
				  							<div class="form-group">
												<label for="" class="col-form-label form-control-sm">Tráfico</label>
												<input class="form-control form-control-sm" id="Acci_Trafico" disabled>
				  							</div> 
			      						</div>

									</div>

									<div class="row align-items-end">
										<div class="col-lg-3">
				  							<div class="form-group">
											    <label for="" class="col-form-label form-control-sm">Datos Registro</label>
												<input class="form-control form-control-sm" id="Acci_DatosRegistro" disabled>
				  							</div> 
			      						</div>	
										<div class="col-lg-2">
				  							<div class="form-group">
												<label for="acci_nro_siniestro" class="col-form-label form-control-sm">Nro.Siniestro</label>
												<input type="number" class="form-control form-control-sm" id="acci_nro_siniestro">
				  							</div> 
			      						</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label for="" class="col-form-label form-control-sm">* Lugar Referencia</label>
												<select class="form-control form-control-sm" id="Acci_LugarReferencia">
												</select>
				  						    </div> 
			      		        		</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="" class="col-form-label form-control-sm">* Factor Determinante</label>
												<select class="form-control form-control-sm" id="Acci_FactorDeterminante">
												</select>
				  						    </div> 
			      		        		</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-2">    
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label form-control-sm">* Resp.Determinante</label>
												<select class="form-control form-control-sm" id="Acci_ResponsabilidadDeterminante">
												</select>
			      						    </div>            
			      						</div>	
										<div class="col-lg-4">
											<div class="form-group">
												<label for="" class="col-form-label form-control-sm">* Factor Contributivo</label>
												<select class="form-control form-control-sm" id="Acci_FactorContributivo">
												</select>
				  						    </div> 
			      		        		</div>
										<div class="col-lg-2">    
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label form-control-sm">* Resp.Contributivo</label>
												<select class="form-control form-control-sm" id="Acci_ResponsabilidadContributivo">
												</select>
			      						    </div>            
			      						</div>	
										<div class="col-lg-2">
			      						   	<div class="form-group">
			      						    	<label for="" class="col-form-label form-control-sm">* Tipo Expediente</label>
			      						    	<select class="form-control form-control-sm" id="Acci_TipoExpediente">
												</select>
			      						    </div>
			      						</div>
										<div class="col-lg-2">
											<div class="form-group">
										    	<label for="" class="col-form-label form-control-sm">* Reportado En</label>
												<select class="form-control form-control-sm" id="Acci_EventoReportado">
												</select>
				  						    </div> 
			      		        		</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-1">
											<div class="form-group">
										    	<label for="" class="col-form-label form-control-sm">* Frec.</label>
												<select class="form-control form-control-sm" id="Acci_Frecuencia">
												</select>
				  						    </div> 
			      		        		</div>
										  <div class="col-lg-1">
											<div class="form-group">
										    	<label for="" class="col-form-label form-control-sm">* Prob.</label>
												<select class="form-control form-control-sm" id="Acci_Probabilidad">
												</select>
				  						    </div> 
			      		        		</div>
										  <div class="col-lg-1">
											<div class="form-group">
										    	<label for="" class="col-form-label form-control-sm">* Seve.</label>
												<select class="form-control form-control-sm" id="Acci_Severidad">
												</select>
				  						    </div> 
			      		        		</div>

										<div class="col-lg-2">
											<div class="form-group">
										    	<label for="" class="col-form-label form-control-sm">Gravedad del Evento</label>
												<input class="form-control form-control-sm" id="Acci_GravedadEvento" disabled>
				  						    </div> 
			      		        		</div>
										<div class="col-lg-2">
			      						   	<div class="form-group">
			      						    	<label for="" class="col-form-label form-control-sm">Responsabilidad</label>
			      						    	<input class="form-control form-control-sm" id="Acci_ResponsabilidadAccidente" disabled>
			      						    </div>
			      						</div>
										<div class="col-lg-2">
							  				<div class="form-group">
											    <label for="" class="col-form-label form-control-sm">* Grado Falta</label>
												<select class="form-control form-control-sm" id="Acci_GradoFalta">
												</select>
							  				</div> 
			    			  			</div>
										<div class="col-lg-1">
											<div class="form-group">
										    	<label for="" class="col-form-label form-control-sm">Reincid.</label>
												<input class="form-control form-control-sm" id="Acci_Reincidencia" disabled>
				  						    </div> 
			      		        		</div>
										<div class="col-lg-2">
							  				<div class="form-group">
											    <label for="" class="col-form-label form-control-sm">* Cod. RIT</label>
												<select class="form-control form-control-sm" id="Acci_CodigoRIT">
												</select>
							  				</div> 
			    			  			</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-6">
			      						   	<div class="form-group">
			      						    	<label for="" class="col-form-label form-control-sm">Descripción RIT</label>
			      						    	<input type="text" class="form-control form-control-sm" id="Acci_DescripcionRIT" disabled>
			      						    </div>
			      						</div>
										<div class="col-lg-4">
			      						   	<div class="form-group">
			      						    	<label for="" class="col-form-label form-control-sm">Acción Disciplinaria</label>
			      						    	<input type="text" class="form-control form-control-sm" id="Acci_AccionDisciplinaria" disabled>
			      						    </div>
			      						</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="" class="col-form-label form-control-sm">Fecha Rep.GDH</label>
												<input type="date" class="form-control form-control-sm" id="Acci_FechaReporteGDH" placeholder="dd/mm/aaaaa" disabled>
			   								</div>
										</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-1">
			      						   	<div class="form-group">
			      						    	<label for="" class="col-form-label form-control-sm">Rep.GDH</label>
			      						    	<input type="text" class="form-control form-control-sm" id="Acci_ReporteGDH" disabled>
			      						    </div>
			      						</div>
										<div class="col-lg-1">
			      						   	<div class="form-group">
			      						    	<label for="" class="col-form-label form-control-sm">Premio</label>
			      						    	<input type="text" class="form-control form-control-sm" id="Acci_Premio" disabled>
			      						    </div>
			      						</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="" class="col-form-label form-control-sm">Cierre de Reporte</label>
												<input type="date" class="form-control form-control-sm" id="Acci_FechaCierreReporte" placeholder="dd/mm/aaaaa" disabled>
			   								</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
										    	<label for="" class="col-form-label form-control-sm">T.Invest.</label>
												<input type="text" class="form-control form-control-sm" id="tAcci_TiempoInvestigacion" disabled>
				  						    </div> 
			      		        		</div>
										<div class="col-lg-2">
			      						   	<div class="form-group">
			      						    	<label for="" class="col-form-label form-control-sm">Cumplim.Meta</label>
			      						    	<input class="form-control form-control-sm" id="Acci_CumplimientoMeta" disabled>
			      						    </div>
			      						</div>
										  <div class="col-lg-1">
											<div class="form-group">
										    	<label for="" class="col-form-label form-control-sm">Delay</label>
												<input type="text" class="form-control form-control-sm" id="tAcci_DelayRegistro" disabled>
				  						    </div> 
			      		        		</div>
									  	<div class="col-lg-2">
			      						   	<div class="form-group">
			      						    	<label for="" class="col-form-label form-control-sm">Cumplim. Registro</label>
			      						    	<input class="form-control form-control-sm" id="Acci_CumplimientoRegistro" disabled>
			      						    </div>
			      						</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="" class="col-form-label form-control-sm">Fecha Registro</label>
												<input type="date" class="form-control form-control-sm" id="Acci_FechaRegistro" placeholder="dd/mm/aaaaa" disabled>
			   								</div>
										</div>
									</div>
								</div>
			      				<div class="modal-footer" id="div_btn_cerrar_informe_final">
									
			      				</div>
							</form>
			        	</div>
			    	</div>
				</div>
			</div>

			<!-- MODAL CRUD LOG INFORME FINAL-->
			<div class="row modal fade" id="modal_crud_log_informe_final" tabindex="-1" role="dialog" aria-labelledby="example_modal_label_log_informe_final" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
			    	<div class="modal-content">
				    	<div class="modal-header modal-header-log dragable_touch">
			            	<h5 class="modal-title modal-title-log" id="example_modal_label_log_informe_fibal"></h5>
			            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			            	</button>
			        	</div>
				  		<form id="form_modal_log_informe_final" enctype="multipart/form-data" action="" method="post">    
			  		    	<div class="modal-body">
								<div class="row align-items-end">
									<div class="col-lg-12">
										<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_log_informe_final">
										</div>
			  		            	</div>
								</div>  
							</div>
						</form>
			    	</div>
				</div>
			</div>
			<!-- Termino de CRUD LOG INFORME FINAL --> 

			<!--------------------------------------------------------------------------->
			<!-- TAB REPORTE GDH -------------------------------------------------------->
			<!--------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-reporte" role="tabpanel" aria-labelledby="nav-reporte-tab">
				<form id="formSeleccionReportegdh" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
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
						<div class="col-lg-1">             	
							<div class="form-group">
								<button type="button" id="btn_buscar_accidentes" class="btn btn-secondary btn-sm btn_buscar_accidentes">Buscar</button>
							</div>
			       		</div> 
					</div>
				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tablaReportegdh">        
								<!-- PHP Accesos CreacionTabla -->
				            </div>
				        </div>
				    </div>  
				</div>   

				<!--Modal para crud ver lesionados-->
				<div class="row modal fade" id="modal_crud_ver_lesionados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
						<div class="modal-content ui-widget-content" id="modal-resizable_ver_lesionados">
							<div class="modal-header dragable_touch">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body scrollVClass">
								<form id="form_modal_ver_lesionados">
									<div class="container-fluid ml-0 mr-0 mb-0">
										<form id="form_ver_lesionados" enctype="multipart/form-data" action="" method="post">    
											<div class="table-responsive" id="div_tabla_ver_lesionados">        
											</div>
										</form>
									</div>			
								</form>
							</div>
							<div class="modal-footer">
					  			<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
  							</div>
						</div>
					</div>
				</div>  			

			</div>

			<!-- TAB TABLA DE AJUSTES ACCIDENTES -->
			<div class="tab-pane fade" id="nav-ajustes" role="tabpanel" aria-labelledby="nav-ajustes-tab">

				<section class="container-fluid py-3">
					<button id="btnNuevoTipoTablaAccidentes" type="button" class="btn btn-secondary btn-sm btnNuevoTipoTablaAccidentes" data-toggle="modal">+ Nuevo</button>  
				</section>

				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaTipoTablaAccidentes">
							
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
										  		<label for="TtablaAccidentes_Id" class="col-form-label form-control-sm">ID</label>
										   		<input type="text" class="form-control form-control-sm" id="TtablaAccidentes_Id">
										 	</div>
									 	</div>
									 	<div class="col-lg-6">
									  		<div class="form-group">
												<label for="TtablaAccidentes_Operacion" class="col-form-label form-control-sm">FICHA</label>
										   		<input type="text" class="form-control form-control-sm text-uppercase" id="TtablaAccidentes_Operacion" maxlength="45">
											</div> 
									 	</div>    
									</div>
					  				<div class="row"> 
										<div class="col-lg-6">
									  		<div class="form-group">
												<label for="TtablaAccidentes_Tipo" class="col-form-label form-control-sm">CATEGORIA 1</label>
												<input type="text" class="form-control form-control-sm text-uppercase" id="TtablaAccidentes_Tipo" maxlength="45">
											</div> 
						  				</div>
									</div>
									<div class="row"> 
						  				<div class="col-lg-12">
									  		<div class="form-group">
												<label for="TtablaAccidentes_Detalle" class="col-form-label form-control-sm">CATEGORIA 2</label>
										  		<textarea class="form-control z-depth-1 form-control-sm text-uppercase" id="TtablaAccidentes_Detalle" rows="7" placeholder="escribe algo aqui..." maxlength="250"></textarea>
											</div>               
						   				</div>
					  				</div>
								</div>
				  				<div class="modal-footer">
					  				<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
					  				<button type="submit" id="btnGuardarTipoTablaAccidentes" class="btn btn-dark btn-sm">Guardar</button>
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