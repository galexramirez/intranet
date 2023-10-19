<!-- 2.2 CONTENIDO DE MODULO -->
<div  id="contenido" class="my-contenido-con-sidebar  p-0">
		
	<nav class="navbar navbar-light bg-light p-0  ">
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
	 		<div class="nav nav-tabs font-smaller" id="nav-tab-ControlFacilitador" role="tablist">
				<!-- PHP Accesos Creacion Tabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">
			<!---------------------------------------------------------------------->
	  		<!------------------------- TAB CARGA ---------------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<form id="formSeleccionFacilitadorCarga" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
				        	<div class="form-group">
								<label for="selectAniosFacilitadorCarga" class="col-form-label form-control-sm">AÑO</label>
								<select name="selectAniosFacilitadorCarga" class="form-control form-control-sm" id="selectAniosFacilitadorCarga">
						    	</select>
					       	</div>
			        	</div>
						<div class="col-md-2">
				        	<div class="form-group">
								<label for="selectSemanasFacilitadorCarga" class="col-form-label form-control-sm">SEMANA</label>
								<select name="selectSemanasFacilitadorCarga" class="form-control form-control-sm zonal_selected" placeholder="m" id="selectSemanasFacilitadorCarga">
							    <option disabled selected>Semana</option>
								</select>
					       	</div>
			        	</div>
						<div class="col-lg-2">
				        	<div class="form-group" id="div_btn_facilitador_carga">
								<!-- PHP Accesos Creacion BotonesFormulario -->
							</div>
			        	</div>   
					
					</div>
				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tablaFacilitadorCarga">        
				           		<!-- Creacion de Tabla -->               
				            </div>
				        </div>
				    </div>  
				</div>   
			
				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDFacilitadorCarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
					  		<form id="formFacilitadorCarga" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
			      		        	<div class="row align-items-end">
			      		            	<div class="col-lg-5">
											<div class="form-group">
												<label for="CFaRg_FechaCargada" class="col-form-label form-control-sm">FECHA</label>
												<input type="date" class="form-control form-control-sm" id="CFaRg_FechaCargada" placeholder="dd/mm/aaaaa">
			   								</div>
			      		            	</div>
										<div class="col-lg-4">             	
											<div class="form-group">
												<label for="CFaRg_TipoOperacionCargada" class="col-form-label form-control-sm">TIPO</label>
												<select name="CFaRg_TipoOperacionCargada" class="form-control form-control-sm zonal_selected" placeholder="m" id="CFaRg_TipoOperacionCargada">
				    								<option disabled selected>Operacion</option>
													<option value="TRONCAL">TRONCAL</option>
													<option value="ALIMENTADOR">ALIMENTADOR</option>
												</select>
											</div>
										</div>
										<div class="col-lg-1">
				  		                	<div class="form-group">
						                  		<label for="btnCargarFacilitador" class="col-form-label"></label>
												<button type="submit" id="btnCargarFacilitador" class="btn btn-secondary btn-sm btnCargarFacilitador">Generar</button>
				  		               		</div>
			      		            	</div>
			      		            </div>    
			      		        </div>
			      		    	<div class="modal-footer" id="div_ResultadoFacilitadorCarga">

								</div>
			      			</form>
						
			        	</div>
			    	</div>
				</div>

			</div>
			
			<!---------------------------------------------------------------------->
			<!-------------------------- TAB TRONCAL ------------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">


				<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
 			
					<!-- Elementos fijos-->	
					<div class="container-fluid pl-0 pr-0 mt-1 ">
				    	<form class="d-flex m-0">
							<input type="date" class="form-control font-smaller" id="Prog_Fecha" placeholder="dd/mm/aaaaa">
				    		<button type="button" id="btnBuscarProgramacionTroncal" class="btn btn-sm btn-secondary ml-1 font-smaller">Cargar</button>
							<input type="text" class="form-control font-smaller ml-5" id="bus_troncal" name="bus_troncal" >
							<button class="btn btn-outline-secondary btn-sm btn_ver_bus_troncal" type="button" id="btn_ver_bus_troncal"><i class="bi bi-bus-front"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bus-front" viewBox="0 0 16 16"><path d="M5 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm-6-1a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2H7Zm1-6c-1.876 0-3.426.109-4.552.226A.5.5 0 0 0 3 4.723v3.554a.5.5 0 0 0 .448.497C4.574 8.891 6.124 9 8 9c1.876 0 3.426-.109 4.552-.226A.5.5 0 0 0 13 8.277V4.723a.5.5 0 0 0-.448-.497A44.303 44.303 0 0 0 8 4Zm0-1c-1.837 0-3.353.107-4.448.22a.5.5 0 1 1-.104-.994A44.304 44.304 0 0 1 8 2c1.876 0 3.426.109 4.552.226a.5.5 0 1 1-.104.994A43.306 43.306 0 0 0 8 3Z"/><path d="M15 8a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1V2.64c0-1.188-.845-2.232-2.064-2.372A43.61 43.61 0 0 0 8 0C5.9 0 4.208.136 3.064.268 1.845.408 1 1.452 1 2.64V4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v3.5c0 .818.393 1.544 1 2v2a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5V14h6v1.5a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-2c.607-.456 1-1.182 1-2V8ZM8 1c2.056 0 3.71.134 4.822.261.676.078 1.178.66 1.178 1.379v8.86a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 11.5V2.64c0-.72.502-1.301 1.178-1.379A42.611 42.611 0 0 1 8 1Z"/></svg></i></button>
				    	</form>

						<button class="navbar-toggler font-smaller" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
 				   			<span class="navbar-toggler-icon"></span>
 				  		</button>
				 	</div>

					<!-- Elementos Colapsables-->	
 					<div class="collapse navbar-collapse" id="div_navbarNavDropdownTroncal">
						<!-- PHP Accesos Creacion Botones Formulario -->
 					</div>
				</nav>

			   	
				<div class="container-fluid caja w-auto" >
		    	   	<div class="row w-100 p-0 m-0">
		        	   	<div class="col-lg-12">
		            		<div class="table-responsive" id="div_tablaControlFacilitador">        
		                		<!-- PHP Accesos Crear Tablas -->
		            		</div>
		           		</div>
		       		</div>
		   		</div>
	  		
				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDControlFacilitador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog modal-xl" role="document">
			        	<div class="modal-content">
			           
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
							<form id="formControlFacilitador" enctype="multipart/form-data" action="" method="post">    
			    			    <div class="modal-body">
									<section class="DatosControlFacilitadorTroncal">
										<div id="div_ControlFacilitadorTroncalEditarTotal">
			    			  			    <div class="row align-items-end">
												<div class="col-lg-6">    
			      						            <div class="form-group">
			      						            	<label for="" class="col-form-label">* Actual Id Bus</label>
														<select class="form-control" id="Prog_IdManto1">
														</select>
			      						            </div>            
			      						        </div>
												<div class="col-lg-6">    
			      						            <div class="form-group">
			      						            	<label for="" class="col-form-label">* Cambiar por Bus</label>
														<select class="form-control" id="Prog_BusTroncal2">
														</select>
			      						            </div>            
			      						        </div>
											</div>
										</div>
										<div id="div_ControlFacilitadorTroncalMultiple">
			    			  			    <div class="row align-items-end">
			    			  			        <div class="col-lg-5">
							  			            <div class="form-group">
										            	<label for="" class="col-form-label">Apellidos y Nombres</label>
														<select class="form-control" id="Prog_NombreColaborador">
														</select>
							  			            </div> 
			    			  			        </div>
												<div class="col-lg-2">    
			      						            <div class="form-group">
			      						            	<label for="" class="col-form-label">Bus</label>
														<select class="form-control" id="Prog_Bus">
														</select>
			      						            </div>            
			      						        </div>
												<div class="col-lg-3">    
			      						            <div class="form-group">
			      						            	<label for="" class="col-form-label">Tipo de Evento</label>
														<select class="form-control" id="Prog_TipoEvento">
														</select>
			      						            </div>            
			      						        </div>
											</div>
										</div>
										<div id="div_ControlFacilitadorTroncalUnico">
			    			  			    <div class="row align-items-end">
												<div class="col-lg-2">
				  						            <div class="form-group">
														<label for="" class="col-form-label">H.Origen</label>
														<div class="input-group">
															<input type="text" name="HoraOrigen" class="form-control col-lg-4" id="HoraOrigen" title="Hora ente 1 y 30" maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 1 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
															<label class="form-control col-lg-1">:</label>
															<input type="text" name="MinutoOrigen" class="form-control col-lg-4" id="MinutoOrigen" title="Minutos entre 0 y 59"  maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
														</div>
										           	</div>               
										       	</div>
												<div class="col-lg-2">
										            <div class="form-group">
														<label for="" class="col-form-label">H.Destino</label>
														<div class="input-group">
															<input type="text" name="HoraDestino" class="form-control col-lg-4" id="HoraDestino" title="Hora ente 1 y 30" maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 1 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
															<label class="form-control col-lg-1">:</label>
															<input type="text" name="MinutoDestino" class="form-control col-lg-4" id="MinutoDestino" title="Minutos entre 0 y 59"  maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
														</div>
				  						            </div>
			      						        </div>  
												<div class="col-lg-2">    
			      						            <div class="form-group">
			      						            	<label for="" class="col-form-label">Lugar de Origen</label>
														<select class="form-control" id="Prog_LugarOrigen">
														</select>
			      						            </div>            
			      						        </div>    
												<div class="col-lg-2">
			      						           	<div class="form-group">
			      						            	<label for="" class="col-form-label">Lugar de Destino</label>
														<select class="form-control" id="Prog_LugarDestino">
														</select>
			      						            </div>
			      						        </div>
												<div class="col-lg-1">
				  						            <div class="form-group">
										               <label for="" class="col-form-label">Tabla</label>
										               <input type="text" class="form-control" id="Prog_Tabla">
				  						            </div> 
			      						        </div>    
			      						        <div class="col-lg-3">
				  						            <div class="form-group">
										            	<label for="" class="col-form-label">Servicio</label>
														<select class="form-control" id="Prog_Servicio">
														</select>
				  						            </div> 
			      						        </div>
											</div>   
			      						    <div class="row align-items-end">
											  <div class="col-lg-2">
			      						           	<div class="form-group">
			      						            	<label for="" class="col-form-label">Sentido</label>
			      						            	<select class="form-control" id="Prog_Sentido">
														</select>
			      						            </div>
			      						        </div>
												<div class="col-lg-1">
				  						            <div class="form-group">
										               <label for="" class="col-form-label">Id Bus</label>
										               <input type="text" class="form-control" id="Prog_IdManto">
				  						            </div> 
			      						        </div>    
												<div class="col-lg-2">
			      						           	<div class="form-group">
			      						            	<label for="" class="col-form-label">ServicioBus</label>
			      						            	<input type="text" class="form-control" id="Prog_ServBus">
			      						            </div>
			      						        </div>	
												<div class="col-lg-2">    
			      						            <div class="form-group">
			      						            	<label for="" class="col-form-label">Status</label>
														<input type="text" class="form-control" id="Prog_BusManto">
			      						            </div>            
			      						        </div>
												  <div class="col-lg-3">    
			      						            <div class="form-group">
			      						            	<label for="" class="col-form-label">Observaciones</label>
														<input type="text" class="form-control" id="Prog_Observaciones">
			      						            </div>            
			      						        </div>
												<div class="col-lg-2">
			      						           	<div class="form-group">
			      						            	<label for="" class="col-form-label">Kilometros</label>
			      						            	<input type="text" class="form-control" id="Prog_KmXPuntos">
			      						            </div>
			      						        </div>
				    					    </div>
										</div>
										<div id="div_OpcionNovedadTroncal">
											<div class="row align-items-end"> 
												<div class="col-lg-7"></div>
												<div class="col-lg-5"> 
													<div class="form-group btn-group btn-group-toggle" data-toggle="buttons">
														<label class="btn btn-outline-success active" id="label_AsociarNovedadTroncal">
    														<input type="radio" class="btn-check" name="optionsNovedadTroncal" id="btn_AsociarNovedadTroncal" value="AsociarNovedad" disabled> Asociar Novedad
  														</label>
														<label class="btn btn-outline-warning">
    														<input type="radio" class="btn-check" name="optionsNovedadTroncal" id="btn_NuevaNovedadTroncal" value="NuevaNovedad"> Agregar Novedad
  														</label>
													</div>
			      						        </div>
			    						  	</div>
										</div>
									</section>
									<section class="novedadTroncal">
										<div id="div_NuevaNovedadTroncal">
											<div class="row align-items-end">
			      						        <div class="col-lg-4">    
			      						            <div class="form-group">
			      						            	<label for="" class="col-form-label">* Novedad</label>
														<select class="form-control" id="Nove_NovedadTroncal">
														</select>
			      						            </div>            
			      						        </div>
												<div class="col-lg-4">
			      						           	<div class="form-group">
			      						            	<label for="" class="col-form-label">* Tipo Novedad</label>
			      						            	<select class="form-control" id="Nove_TipoNovedadTroncal">
														</select>
			      						            </div>
			      						        </div>    
			      						        <div class="col-lg-4">    
			      						            <div class="form-group">
			      						            	<label for="" class="col-form-label">* Detalle Novedad</label>
														<select class="form-control" id="Nove_DetalleNovedadTroncal">
														</select>
													</div>            
			      						        </div>
				    					    </div>
											<div class="row align-items-end">
												<div class="col-lg-6">
													<div class="form-group">
								    		        	<label for="" class="col-form-label">* Lugar Exacto / Estación o Paradero de Referencia</label>
														<input type="text" class="form-control" id="Nove_LugarExactoTroncal" maxlength="50">
				  				    		        </div> 
			      		            			</div>
												<div class="col-lg-2">
													<div class="form-group">
								    		        	<label for="" class="col-form-label">* H. Inicio</label>
														<div class="input-group">
															<input type="text" name="HoraInicioTroncal" class="form-control col-lg-4" id="HoraInicioTroncal" title="Hora ente 1 y 30" maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 1 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
															<label class="form-control col-lg-1">:</label>
															<input type="text" name="MinutoInicioTroncal" class="form-control col-lg-4" id="MinutoInicioTroncal" title="Minutos entre 0 y 59"  maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
														</div>
				  				    		        </div> 
			      		            			</div>
												  <div class="col-lg-1">
													<div class="form-group">
														<div class="input-group">
															<button type="button" id="btn_igual_fecha_troncal" class="btn btn-light btn-sm btn_igual_fecha_troncal">
																<i class="bi bi-arrow-right-square">
																	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-square" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm4.5 5.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/></svg>
																</i>
															</button>
														</div>
				  				    		        </div> 
			      		            			</div>
												<div class="col-lg-2">
													<div class="form-group">
								    		        	<label for="" class="col-form-label">* H. Fin</label>
														<div class="input-group">
															<input type="text" name="HoraFinTroncal" class="form-control col-lg-4" id="HoraFinTroncal" title="Hora ente 1 y 30" maxlength="2"  onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 1 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
															<label class="form-control col-lg-1">:</label>
															<input type="text" name="MinutoFinTroncal" class="form-control col-lg-4" id="MinutoFinTroncal" title="Minutos entre 0 y 59"  maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
														</div>
				  				    		        </div> 
			      		            			</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">    
													<div class="form-group shadow-textarea">
			      				            			<label for="Nove_DescripcionNovedadTroncal" class="col-form-label">* Descripción Novedad (Máx 1500 caract.)</label>
			      				            			<textarea class="form-control z-depth-1" id="Nove_DescripcionNovedadTroncal" rows="4" placeholder="escribe algo aqui..."></textarea>
			      				            		</div>
			    						  		</div>
											</div>
										</div>			 
										<div id="div_AsociarNovedadTroncal">
											<div class="row align-items-end">
												<div class="col-lg-12">
			      								   	<div class="form-group">
			      								    	<label for="" class="col-form-label">* Seleccionar Novedad</label>
														<select class="form-control" id="selectNovedadIdTroncal">
														</select>
			      								    </div>
			      								</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-3">    	
													<div class="form-group">
			      						            	<label for="" class="col-form-label">ID Novedad</label>
														<input type="text" class="form-control" id="t_NovedadIdTroncal" disabled>
			      						        	</div>            
												</div>
												<div class="col-lg-3">    
			      						            <div class="form-group">
			      						            	<label for="" class="col-form-label">Novedad</label>
														<input type="text" class="form-control" id="t_NovedadTroncal" disabled>
			      						            </div>            
			      						        </div>
												<div class="col-lg-3">
			      						           	<div class="form-group">
			      						            	<label for="" class="col-form-label">Tipo Novedad</label>
			      						            	<input type="text" class="form-control" id="t_TipoNovedadTroncal" disabled>
			      						            </div>
			      						        </div>    
			      						        <div class="col-lg-3">    
			      						            <div class="form-group">
			      						            	<label for="" class="col-form-label">Detalle Novedad</label>
														<input type="text" class="form-control" id="t_DetalleNovedadTroncal" disabled>
													</div>            
			      						        </div>
				    					    </div>
											<div class="row align-items-end">
												<div class="col-lg-12">    
			      						       		<div class="form-group"> 
			      						       			<label for="" class="col-form-label">Descripción Novedad</label>
														<input type="text" class="form-control" id="t_DescripcionNovedadTroncal" disabled>
			      						       		</div>            
			      						    	</div>    
			    							</div>
										</div>
									</section>
								</div>
			      				<div class="modal-footer">
			      					<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
			      					<button type="submit" id="btnGuardarTroncal" class="btn btn-dark">Guardar</button>
			      				</div>
			    			</form>

						</div>
			    	</div>
				</div>

				<!--Modal para CRUD MOSTRAR NOVEDADES-->
				<div class="row modal fade" id="modalCRUDMostrarNovedadTroncal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog modal-xl" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
							<form id="formMostrarNovedadTroncal">    
								<div class="modal-body scrollVClass" id="div_MostrarNovedadTroncal">
									<!-- Se debe genera la informacion historica -->
								</div>
			      				<div class="modal-footer">
			      					<button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
			      				</div>
							</form>
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD MOSTRAR INCONSISTENCIAS -->
				<div class="row modal fade" id="modalCRUDMostrarInconsistenciasTroncal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog" role="document">
			        	<div class="modal-content">
			           
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>

			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
							<form id="formMostrarInconsistenciasTroncal">    
			    			    <div class="modal-body">
									<div class="container-fluid caja w-auto">
							    	   	<div class="row w-100 p-0 m-0">
										   <h6 class="modal-subtitle" id="exampleModalLabelsubtitle"></h6>
										</div>
										<div class="row w-100 p-0 m-0">
							        	   	<div class="col-lg-12">
							            		<div class="table-responsive" id="div_tablaMostrarInconsistenciasTroncal">
													<!-- PHP Accesos Crear Tabla -->
							            		</div>
							           		</div>
							       		</div>  
							   		</div>   
								</div>
			      				<div class="modal-footer">
			      					<button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
			      				</div>
			    			</form>
						
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD MOSTRAR RESUMEN -->
				<div class="row modal fade" id="modalCRUDMostrarResumenTroncal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog modal-lg" role="document" id="modal-resizable_resumen_troncal">
			        	<div class="modal-content">
			           
					    	<div class="modal-header dragable_touch">
			                	<h5 class="modal-title_resumen_troncal" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
							</div>
			      	
							<form id="formMostrarResumenTroncal" enctype="multipart/form-data" action="" method="post">
								<div id="div_form_mostrar_resumen_troncal">

								</div>		      			
							</form>
						
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD MOSTRAR REPORTES-->
				<div class="row modal fade" id="modalCRUDMostrarReporteTroncal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
							<form id="formMostrarReporteTroncal">    
								<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-4">    
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Bus Cambio</label>
												<input class="form-control" id="Repo_BusCambio" disabled>
										    </div>
			      						</div>
										<div class="col-lg-4">
				  						    <div class="form-group">
												<label for="" class="col-form-label">Hora Salida</label>
												<div class="input-group">
													<input type="text" class="form-control col-lg-4" id="HoraSalida" disabled>
													<label class="form-control col-lg-1">:</label>
													<input type="text" class="form-control col-lg-4" id="MinutoSalida" disabled>
												</div>
										    </div>               
										</div>
										<div class="col-lg-4">    
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Estado</label>
												<input class="form-control" id="Repo_Estado" disabled>
			      						    </div>
			      						</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-12">
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Motivo</label>
												<input class="form-control" id="Repo_Motivo" disabled>
			      						    </div>            
			      						</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-12">
				      				        <div class="form-group shadow-textarea">
				      				            <label for="Repo_Descripcion" class="col-form-label">Descripcion Novedad</label>
				      				            <textarea class="form-control z-depth-1" id="Repo_Descripcion" rows="7" placeholder="escribe algo aqui..." disabled></textarea>
				      				        </div>
				      				    </div>
				      		        </div>
									<div class="row align-items-end">
										<div class="col-lg-6">
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Usuario que Genera</label>
												<input class="form-control" id="Repo_UsuarioId_Generar" disabled>
			      						    </div>            
			      						</div>
										<div class="col-lg-6">
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Fecha que Genera</label>
												<input class="form-control" id="Repo_FechaGenerar" disabled>
			      						    </div>            
			      						</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-6">
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Usuario Ultima Edición</label>
												<input class="form-control" id="Repo_UsuarioId_Edicion" disabled>
			      						    </div>            
			      						</div>
										<div class="col-lg-6">
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Fecha de Ultima Edición</label>
												<input class="form-control" id="Repo_FechaEdicion" disabled>
			      						    </div>            
			      						</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-6">
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Usuario que Atiende</label>
												<input class="form-control" id="Repo_UsuarioId_Cerrar" disabled>
			      						    </div>            
			      						</div>
										<div class="col-lg-6">
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Fecha de Atención</label>
												<input class="form-control" id="Repo_FechaCerrar" disabled>
			      						    </div>            
			      						</div>
									</div>
								</div>
			      				<div class="modal-footer">
									<button type="submit" id="btnAtendidoReporteTroncal" class="btn btn-dark">Atendido</button>
			      					<button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
			      				</div>
							</form>
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD LOGUEO TRONCAL -->
				<div class="row modal fade" id="modal_crud_logueo_troncal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
			           
					    	<div class="modal-header">
								<h5 class="modal-title_logueo_troncal" id="modal-title_logueo_troncal"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
							<form id="form_logueo_troncal" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
									<div class="row align-items-end mb-3 border-bottom border-muted">
										<div class="col-lg-3">
											<img src="Module/ControlFacilitador/View/Img/logo23.JPG" class="my-logo-modal-body" alt="">
										</div>
										<div class="col-lg-9">
											<div class="row">
												<div class="col-lg-12">
													<h5 class="modal-body-title_logueo_troncal" id="modal-body-title_logueo_troncal"></h5>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<h6 class="modal-body-subtitle_logueo_troncal" id="modal-body-subtitle_logueo_troncal"></h6> 
												</div>
											</div>
										</div>
									</div>

									<div class="row align-items-end">
									  	<div class="col-lg-3">
											<div class="form-group">
								            	<label for="" class="col-form-label form-control-sm">N° BUS:</label>
				  				            </div> 
			      		            	</div>
									  	<div class="col-lg-3">
											<div class="form-group">
												<input type="text" readonly class="form-control form-control-sm" id="logueo_troncal_bus">
				  				            </div> 
			      		            	</div>
										<div class="col-lg-6">
											<div class="form-group">
								            	<label for="" class="col-form-label form-control-sm">ARTICULADO</label>
				  				            </div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
									  	<div class="col-lg-3">
											<div class="form-group">
								            	<label for="" class="col-form-label form-control-sm">COD. ACS:</label>
				  				            </div> 
			      		            	</div>
									  	<div class="col-lg-3">
											<div class="form-group">
												<input type="text" readonly class="form-control form-control-sm" id="logueo_troncal_vid">
				  				            </div> 
			      		            	</div>
										<div class="col-lg-6">
											<div class="form-group">
								            	<label for="" class="col-form-label form-control-sm">(CODIGO INTERNO)</label>
				  				            </div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
									  	<div class="col-lg-3">
											<div class="form-group">
								            	<label for="" class="col-form-label form-control-sm">PASE PILOTO:</label>
				  				            </div> 
			      		            	</div>
									  	<div class="col-lg-3">
											<div class="form-group">
												<input type="text" readonly class="form-control form-control-sm" id="logueo_troncal_codigo_piloto">
				  				            </div> 
			      		            	</div>
										<div class="col-lg-6">
											<div class="form-group">
								            	<input type="text" readonly class="form-control form-control-sm" id="logueo_troncal_nombre_piloto">
				  				            </div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
									  	<div class="col-lg-3">
											<div class="form-group">
								            	<label for="" class="col-form-label form-control-sm">SERVICIO:</label>
				  				            </div> 
			      		            	</div>
									  	<div class="col-lg-3">
											<div class="form-group">
												<input type="text" readonly class="form-control form-control-sm" id="logueo_troncal_tabla">
				  				            </div> 
			      		            	</div>
										<div class="col-lg-6">
											<div class="form-group">
								            	<input type="text" readonly class="form-control form-control-sm" id="logueo_troncal_servicio">
				  				            </div> 
			      		            	</div>
									</div>
								</div>
								<div class="modal-footer">
				  		        	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
									<button type="button" id="btn_novedad_logueo_troncal" class="btn btn-dark btn-sm btn_novedad_logueo_troncal">+Novedad</button>
				  		    	</div>
			      			</form>
						
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD VER INFORMACION DE BUS-->
				<div class="row modal fade" id="modal_crud_bus_troncal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
				    	<div class="modal-content">
					    	<div class="modal-header">
				            	<h5 class="modal-title" id="exampleModalLabel"></h5>
				            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
				            	</button>
				        	</div>
					  		<form id="form_modal_bus_troncal">    
				  		    	<div class="modal-body">
				  		        	<div class="row">
				  		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                  		<label for="Bus_NroExterno_troncal" class="col-form-label form-control-sm">Nro. EXTERNO</label>
						                   		<input type="text" readonly class="form-control form-control-sm" id="Bus_NroExterno_troncal">
				  		               		</div>
				  		            	</div>
				  		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                		<label for="Bus_NroVid_troncal" class="col-form-label form-control-sm">Nro. VID</label>
												<input type="text" readonly class="form-control form-control-sm" id="Bus_NroVid_troncal">
											</div> 
				  		            	</div>
				  		        	</div>
				  		        	<div class="row"> 
				  		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                   		<label for="Bus_NroPlaca_troncal" class="col-form-label form-control-sm">Nro. PLACA</label>
												<input type="text" readonly class="form-control form-control-sm" id="Bus_NroPlaca_troncal">
											</div>               
						           		</div>
						               	<div class="col-lg-6">
						                  	<div class="form-group">
						                   		<label for="Bus_Operacion_troncal" class="col-form-label form-control-sm">OPERACION</label>
						                   		<input type="text" readonly class="form-control form-control-sm" id="Bus_Operacion_troncal">
				  		                	</div>
				  		            	</div>
									</div>  
									<div class="row"> 
				  		            	<div class="col-lg-12">
				  		                	<div class="form-group">
						                   		<label for="Bus_Detalle_troncal" class="col-form-label form-control-sm">DETALLE</label>
												<input type="text" readonly class="form-control form-control-sm" id="Bus_Detalle_troncal">
											</div>               
						           		</div>
									</div>  
									<div class="row"> 
				  		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                   		<label for="Bus_Tipo_troncal" class="col-form-label form-control-sm">TIPO</label>
												<input type="text" readonly class="form-control form-control-sm" id="Bus_Tipo_troncal">
											</div>               
						           		</div>
						               	<div class="col-lg-6">
						                  	<div class="form-group">
						                   		<label for="Bus_Tipo2_troncal" class="col-form-label form-control-sm">TIPO 2</label>
						                   		<input type="text" readonly class="form-control form-control-sm" id="Bus_Tipo2_troncal">
				  		                	</div>
				  		            	</div>
									</div>  
									<div class="row"> 
				  		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                   		<label for="Bus_Estado_troncal" class="col-form-label form-control-sm">ESTADO</label>
												<input type="text" readonly class="form-control form-control-sm" id="Bus_Estado_troncal">
											</div>               
						           		</div>
						               	<div class="col-lg-6">
						                  	<div class="form-group">
						                   		<label for="Bus_Tanques_troncal" class="col-form-label form-control-sm">Tanques</label>
						                   		<input type="text" readonly class="form-control form-control-sm" id="Bus_Tanques_troncal">
				  		                	</div>
				  		            	</div>
									</div>  
								</div>
				  		    	<div class="modal-footer">
				  		        	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
				  		    	</div>
				  			</form>    

						</div>
					</div>
				</div>  			
				
			</div>
			  	
			<!---------------------------------------------------------------------->
			<!------------------------- TAB ALIMENTADOR ---------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

				<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
 			
					<!-- Elementos fijos-->	
					<div class="container-fluid pl-0 pr-0 mt-1 ">
				    	<form class="d-flex m-0">
							<input type="date" class="form-control font-smaller" id="Prog_FechaAlimentador" placeholder="dd/mm/aaaaa">
				    		<button type="button" id="btnBuscarProgramacionAlimentador" class="btn btn-sm btn-secondary ml-1 font-smaller">Cargar</button>
							<input type="text" class="form-control font-smaller ml-5" id="bus_alimentador" name="bus_alimentador" >
							<button class="btn btn-outline-secondary btn-sm btn_ver_bus_alimentador" type="button" id="btn_ver_bus_alimentador"><i class="bi bi-bus-front"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bus-front" viewBox="0 0 16 16"><path d="M5 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm-6-1a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2H7Zm1-6c-1.876 0-3.426.109-4.552.226A.5.5 0 0 0 3 4.723v3.554a.5.5 0 0 0 .448.497C4.574 8.891 6.124 9 8 9c1.876 0 3.426-.109 4.552-.226A.5.5 0 0 0 13 8.277V4.723a.5.5 0 0 0-.448-.497A44.303 44.303 0 0 0 8 4Zm0-1c-1.837 0-3.353.107-4.448.22a.5.5 0 1 1-.104-.994A44.304 44.304 0 0 1 8 2c1.876 0 3.426.109 4.552.226a.5.5 0 1 1-.104.994A43.306 43.306 0 0 0 8 3Z"/><path d="M15 8a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1V2.64c0-1.188-.845-2.232-2.064-2.372A43.61 43.61 0 0 0 8 0C5.9 0 4.208.136 3.064.268 1.845.408 1 1.452 1 2.64V4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v3.5c0 .818.393 1.544 1 2v2a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5V14h6v1.5a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-2c.607-.456 1-1.182 1-2V8ZM8 1c2.056 0 3.71.134 4.822.261.676.078 1.178.66 1.178 1.379v8.86a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 11.5V2.64c0-.72.502-1.301 1.178-1.379A42.611 42.611 0 0 1 8 1Z"/></svg></i></button>
				    	</form>

						<button class="navbar-toggler font-smaller" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
 				   			<span class="navbar-toggler-icon"></span>
 				  		</button>
				 	</div>

					<!-- Elementos Colapsables-->	
 					<div class="collapse navbar-collapse" id="div_navbarNavDropdownAlimentador">
						<!-- PHP Accesos Cracion Botones Formulario -->
 					</div>
				</nav>

				<div class="container-fluid caja w-auto">
		    	   	<div class="row w-100 p-0 m-0">
		        	   	<div class="col-lg-12">
		            		<div class="table-responsive" id="div_tablaControlFacilitadorAlimentador">        
		                		<!-- PHP Accesos Creacion Tablas -->
		            		</div>
		           		</div>
		       		</div>  
		   		</div>   
	  		
				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDControlFacilitadorAlimentador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog modal-xl" role="document">
			        	<div class="modal-content">
			           
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
							<form id="formControlFacilitadorAlimentador">    
			    			    <div class="modal-body">
									<section class="DatosControlFacilitadorAlimentador">
										<div id="div_ControlFacilitadorAlimentadorEditarTotal">
			    			  			    <div class="row align-items-end">
												<div class="col-lg-6">    
			      						            <div class="form-group">
			      						            	<label for="" class="col-form-label">* Actual Id Bus</label>
														<select class="form-control" id="Prog_IdMantoAlimentador1">
														</select>
			      						            </div>            
			      						        </div>
												<div class="col-lg-6">    
			      						            <div class="form-group">
			      						            	<label for="" class="col-form-label">* Cambiar por Bus</label>
														<select class="form-control" id="Prog_BusAlimentador2">
														</select>
			      						            </div>            
			      						        </div>
											</div>
										</div>
										<div id="div_ControlFacilitadorAlimentadorMultiple">
											<div class="row align-items-end">
			    			  	    		    <div class="col-lg-5">
							  	    		        <div class="form-group">
								    		        	<label for="" class="col-form-label">Apellidos y Nombres</label>
														<select class="form-control" id="Prog_NombreColaboradorAlimentador">
														</select>
							  	    		        </div> 
			    			  	    		    </div>
												<div class="col-lg-2">    
			      				        		    <div class="form-group">
			      				        		    	<label for="" class="col-form-label">Bus</label>
														<select class="form-control" id="Prog_BusAlimentador">
														</select>
			      				        		    </div>            
			      				        		</div>
												<div class="col-lg-3">
			      				    		        <div class="form-group">
			      				    		        	<label for="" class="col-form-label">Tipo de Evento</label>
														<select class="form-control" id="Prog_TipoEventoAlimentador">
														</select>
			      				    		        </div>            
			      				    		    </div>
											</div>
										</div>    
										<div id="div_ControlFacilitadorAlimentadorUnico">
											<div class="row align-items-end">
												<div class="col-lg-2">
				  						            <div class="form-group">
														<label for="" class="col-form-label">H.Origen</label>
										            	<div class="input-group">
															<input type="text" name="HoraOrigenAlimentador" class="form-control col-lg-4" id="HoraOrigenAlimentador" title="Hora ente 1 y 30" maxlength="2"  onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 1 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
															<label class="form-control col-lg-1">:</label>
															<input type="text" name="MinutoOrigenAlimentador" class="form-control col-lg-4" id="MinutoOrigenAlimentador" title="Minutos entre 0 y 59"  maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
														</div>
										           	</div>               
										       	</div>
												<div class="col-lg-2">
										            <div class="form-group">
														<label for="" class="col-form-label">H.Destino</label>
										            	<div class="input-group">
															<input type="text" name="HoraDestinoAlimentador" class="form-control col-lg-4" id="HoraDestinoAlimentador" title="Hora ente 1 y 30" maxlength="2"  onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 1 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
															<label class="form-control col-lg-1">:</label>
															<input type="text" name="MinutoDestinoAlimentador" class="form-control col-lg-4" id="MinutoDestinoAlimentador" title="Minutos entre 0 y 59"  maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
														</div>
				  						            </div>
			      						        </div>  
												<div class="col-lg-2">    
			      				    		        <div class="form-group">
			      				    		        	<label for="" class="col-form-label">Lugar de Origen</label>
														<select class="form-control" id="Prog_LugarOrigenAlimentador">
														</select>
			      				    		        </div>            
			      				    		    </div>    
												<div class="col-lg-2">
			      				    		       	<div class="form-group">
			      				    		        	<label for="" class="col-form-label">Lugar de Destino</label>
														<select class="form-control" id="Prog_LugarDestinoAlimentador">
														</select>
			      				    		        </div>
			      				    		    </div>
												<div class="col-lg-1">
				  				    		        <div class="form-group">
								    		           <label for="" class="col-form-label">Tabla</label>
								    		           <input type="text" class="form-control" id="Prog_TablaAlimentador">
				  				    		        </div> 
			      				    		    </div>
												  <div class="col-lg-3">
				  						            <div class="form-group">
										            	<label for="" class="col-form-label">Servicio</label>
														<select class="form-control" id="Prog_ServicioAlimentador">
														</select>
				  						            </div> 
			      						        </div>
											</div>
			      						    <div class="row align-items-end"> 
												<div class="col-lg-2">
			      						           	<div class="form-group">
			      						            	<label for="" class="col-form-label">Sentido</label>
			      						            	<select class="form-control" id="Prog_SentidoAlimentador">
														</select>
			      						            </div>
			      						        </div>
												<div class="col-lg-1">
			      				    		       	<div class="form-group">
			      				    		        	<label for="" class="col-form-label">Id Bus</label>
			      				    		        	<input type="text" class="form-control" id="Prog_IdMantoAlimentador">
			      				    		        </div>
			      				    		    </div>    
												<div class="col-lg-2">
			      				    		       	<div class="form-group">
			      				    		        	<label for="" class="col-form-label">ServicioBus</label>
			      				    		        	<input type="text" class="form-control" id="Prog_ServBusAlimentador">
			      				    		        </div>
			      				    		    </div>    
												<div class="col-lg-2">    
			      						            <div class="form-group">
			      						            	<label for="" class="col-form-label">Status</label>
														<input type="text" class="form-control" id="Prog_BusMantoAlimentador">
			      						            </div>            
			      						        </div>
												<div class="col-lg-3">
			      				    		       	<div class="form-group">
			      				    		        	<label for="" class="col-form-label">Observaciones</label>
			      				    		        	<input type="text" class="form-control" id="Prog_ObservacionesAlimentador">
			      				    		        </div>
			      				    		    </div>    
												<div class="col-lg-2">
			      						           	<div class="form-group">
			      						            	<label for="" class="col-form-label">Kilometros</label>
			      						            	<input type="text" class="form-control" id="Prog_KmXPuntosAlimentador">
			      						            </div>
			      						        </div>    
											</div>   
										</div>
										<div id="div_OpcionNovedadAlimentador">
											<div class="row align-items-end">
											<div class="col-lg-7"></div>
												<div class="col-lg-5"> 
													<div class="form-group btn-group btn-group-toggle" data-toggle="buttons">
														<label class="btn btn-outline-success active" id="label_AsociarNovedadAlimentador">
    														<input type="radio" class="btn-check" name="optionsNovedadAlimentador" id="btn_AsociarNovedadAlimentador" value="AsociarNovedad" disabled> Asociar Novedad
  														</label>
														<label class="btn btn-outline-warning">
    														<input type="radio" class="btn-check" name="optionsNovedadAlimentador" id="btn_NuevaNovedadAlimentador" value="NuevaNovedad" checked> Agregar Novedad
  														</label>
													</div>
			      						        </div>
			    						  	</div>
										</div>
									</section>	
									<section class="novedadAlimentador">
										<div id="div_NuevaNovedadAlimentador">
											<div class="row align-items-end">
			      						        <div class="col-lg-4">    
			      						            <div class="form-group">
			      						            	<label for="" class="col-form-label">* Novedad</label>
														<select class="form-control" id="Nove_NovedadAlimentador">
														</select>
			      						            </div>            
			      						        </div>
												<div class="col-lg-4">
			      						           	<div class="form-group">
			      						            	<label for="" class="col-form-label">* Tipo Novedad</label>
			      						            	<select class="form-control" id="Nove_TipoNovedadAlimentador">
														</select>
			      						            </div>
			      						        </div>    
			      						        <div class="col-lg-4">    
			      						            <div class="form-group">
			      						            	<label for="" class="col-form-label">* Detalle Novedad</label>
														<select class="form-control" id="Nove_DetalleNovedadAlimentador">
														</select>
													</div>            
			      						        </div>
				    					    </div>
											<div class="row align-items-end">
												<div class="col-lg-6">
													<div class="form-group">
								    		        	<label for="" class="col-form-label">* Lugar Exacto / Estación o Paradero de Referencia</label>
														<input type="text" class="form-control" id="Nove_LugarExactoAlimentador" maxlength="50">
				  				    		        </div> 
			      		            			</div>
												<div class="col-lg-2">
													<div class="form-group">
								    		        	<label for="" class="col-form-label">* H. Inicio</label>
														<div class="input-group">
															<input type="text" name="HoraInicioAlimentador" class="form-control col-lg-4" id="HoraInicioAlimentador" title="Hora ente 1 y 30" maxlength="2"  onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 1 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
															<label class="form-control col-lg-1">:</label>
															<input type="text" name="MinutoInicioAlimentador" class="form-control col-lg-4" id="MinutoInicioAlimentador" title="Minutos entre 0 y 59"  maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
														</div>
				  				    		        </div> 
			      		            			</div>
												<div class="col-lg-1">
													<div class="form-group">
														<div class="input-group">
															<button type="button" id="btn_igual_fecha_alimentador" class="btn btn-light btn-sm btn_igual_fecha_alimentador">
																<i class="bi bi-arrow-right-square">
																	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-square" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm4.5 5.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/></svg>
																</i>
															</button>
														</div>
				  				    		        </div> 
			      		            			</div>
												<div class="col-lg-2">
													<div class="form-group">
								    		        	<label for="" class="col-form-label">* H. Fin</label>
														<div class="input-group">
															<input type="text" name="HoraFinAlimentador" class="form-control col-lg-4" id="HoraFinAlimentador" title="Hora ente 1 y 30" maxlength="2"  onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 1 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
															<label class="form-control col-lg-1">:</label>
															<input type="text" name="MinutoFinAlimentador" class="form-control col-lg-4" id="MinutoFinAlimentador" title="Minutos entre 0 y 59"  maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
														</div>
				  				    		        </div> 
			      		            			</div>
											</div>
											<div class="row align-items-end">
												<div class="col-lg-12">
													<div class="form-group shadow-textarea">
			      				            			<label for="Nove_DescripcionNovedadAlimentador" class="col-form-label">* Descripción Novedad (Máx 1500 caract.)</label>
			      				            			<textarea class="form-control z-depth-1" id="Nove_DescripcionNovedadAlimentador" rows="4" placeholder="escribe algo aqui..."></textarea>
			      				            		</div>
			      						        </div>    
			    						  	</div>
										</div> 

										<div id="div_AsociarNovedadAlimentador">
											<div class="row align-items-end">
												<div class="col-lg-9">
			      						           	<div class="form-group">
			      						            	<label for="" class="col-form-label">* Seleccionar Evento</label>
														<select class="form-control" id="selectNovedadIdAlimentador">
														</select>
			      						            </div>
			      						        </div>    
											</div>
											<div class="row align-items-end">
												<div class="col-lg-3">    	
													<div class="form-group">
			      						            	<label for="" class="col-form-label">ID Novedad</label>
														<input type="text" class="form-control" id="t_NovedadIdAlimentador" disabled>
			      						        	</div>            
												</div>
												<div class="col-lg-3">    
			      						            <div class="form-group">
			      						            	<label for="" class="col-form-label">Novedad</label>
														<input type="text" class="form-control" id="t_NovedadAlimentador" disabled>
			      						            </div>            
			      						        </div>
												<div class="col-lg-3">
			      						           	<div class="form-group">
			      						            	<label for="" class="col-form-label">Tipo Novedad</label>
			      						            	<input type="text" class="form-control" id="t_TipoNovedadAlimentador" disabled>
			      						            </div>
			      						        </div>    
			      						        <div class="col-lg-3">    
			      						            <div class="form-group">
			      						            	<label for="" class="col-form-label">Detalle Novedad</label>
														<input type="text" class="form-control" id="t_DetalleNovedadAlimentador" disabled>
													</div>            
			      						        </div>
				    					    </div>
											<div class="row align-items-end">
												<div class="col-lg-12">    
			      						       		<div class="form-group"> 
			      						       			<label for="" class="col-form-label">Descripción Novedad (Máx 1500 caract.)</label>
														<input type="text" class="form-control" id="t_DescripcionNovedadAlimentador" disabled>
			      						       		</div>            
			      						    	</div>    
			    							</div>
										</div>
									</section>
								</div>
			      				<div class="modal-footer">
			      					<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
			      					<button type="submit" id="btnGuardarAlimentador" class="btn btn-dark">Guardar</button>
			      				</div>
			    			</form>
						
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD MOSTRAR NOVEDADES-->
				<div class="row modal fade" id="modalCRUDMostrarNovedadAlimentador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog modal-xl" role="document">
			        	<div class="modal-content">
			           
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
							<form id="formMostrarNovedadAlimentador">    
								<div class="modal-body scrollVClass" id="div_MostrarNovedadAlimentador">
								</div>
			      				<div class="modal-footer">
			      					<button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
			      				</div>
			    			</form>
						
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD MOSTRAR INCONSISTENCIAS -->
				<div class="row modal fade" id="modalCRUDMostrarInconsistenciasAlimentador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog" role="document">
			        	<div class="modal-content">
			           
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>

			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
							<form id="formMostrarInconsistenciasAlimentador">    
			    			    <div class="modal-body">
									<div class="container-fluid caja w-auto">
							    	   	<div class="row w-100 p-0 m-0">
										   <h6 class="modal-subtitle" id="exampleModalLabelsubtitle"></h6>
										</div>
										<div class="row w-100 p-0 m-0">
							        	   	<div class="col-lg-12">
							            		<div class="table-responsive" id="div_tablaMostrarInconsistenciasAlimentador">
							                		<!-- PHP Accesos Creacion Tablas
													<table id="tablaMostrarInconsistenciasAlimentador" class="table table-striped table-bordered table-condensed w-100">
							                    		<thead class="text-center">
															<tr>
																<th>DETALLE</th>
																<th>ID</th>
																<th>ID BUS</th>
															</tr>
							                    		</thead>
							                    		<tbody>                           
														</tbody>
							                		</table> -->
							            		</div>
							           		</div>
							       		</div>  
							   		</div>   
								</div>
			      				<div class="modal-footer">
			      					<button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
			      				</div>
			    			</form>
						
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD MOSTRAR RESUMEN -->
				<div class="row modal fade" id="modalCRUDMostrarResumenAlimentador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog modal-lg" role="document" id="modal-resizable_resumen_alimentador">
			        	<div class="modal-content">
			           
					    	<div class="modal-header dragable_touch">
			                	<h5 class="modal-title_resumen_alimentador" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
							</div>
			      	
							<form id="formMostrarResumenAlimentador" enctype="multipart/form-data" action="" method="post">    
								<div id="div_form_mostrar_resumen_alimentador">

								</div>		      			
							</form>
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD MOSTRAR REPORTES-->
				<div class="row modal fade" id="modalCRUDMostrarReporteAlimentador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
							<form id="formMostrarReporteAlimentador">    
								<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-4">    
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Bus Cambio</label>
												<input class="form-control" id="Repo_BusCambioAlimentador" disabled>
										    </div>
			      						</div>
										<div class="col-lg-4">
				  						    <div class="form-group">
												<label for="" class="col-form-label">Hora Salida</label>
												<div class="input-group">
													<input type="text" class="form-control col-lg-4" id="HoraSalidaAlimentador" disabled>
													<label class="form-control col-lg-1">:</label>
													<input type="text" class="form-control col-lg-4" id="MinutoSalidaAlimentador" disabled>
												</div>
										    </div>               
										</div>
										<div class="col-lg-4">    
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Estado</label>
												<input class="form-control" id="Repo_EstadoAlimentador" disabled>
			      						    </div>
			      						</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-12">
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Motivo</label>
												<input class="form-control" id="Repo_MotivoAlimentador" disabled>
			      						    </div>            
			      						</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-12">
				      				        <div class="form-group shadow-textarea">
				      				            <label for="Repo_Descripcion" class="col-form-label">Descripcion Novedad</label>
				      				            <textarea class="form-control z-depth-1" id="Repo_DescripcionAlimentador" rows="7" placeholder="escribe algo aqui..." disabled></textarea>
				      				        </div>
				      				    </div>
				      		        </div>
									<div class="row align-items-end">
										<div class="col-lg-6">
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Usuario que Genera</label>
												<input class="form-control" id="Repo_UsuarioId_GenerarAlimentador" disabled>
			      						    </div>            
			      						</div>
										<div class="col-lg-6">
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Fecha que Genera</label>
												<input class="form-control" id="Repo_FechaGenerarAlimentador" disabled>
			      						    </div>            
			      						</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-6">
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Usuario Ultima Edición</label>
												<input class="form-control" id="Repo_UsuarioId_EdicionAlimentador" disabled>
			      						    </div>            
			      						</div>
										<div class="col-lg-6">
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Fecha de Ultima Edición</label>
												<input class="form-control" id="Repo_FechaEdicionAlimentador" disabled>
			      						    </div>            
			      						</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-6">
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Usuario que Atiende</label>
												<input class="form-control" id="Repo_UsuarioId_CerrarAlimentador" disabled>
			      						    </div>            
			      						</div>
										<div class="col-lg-6">
			      						    <div class="form-group">
			      						    	<label for="" class="col-form-label">Fecha de Atención</label>
												<input class="form-control" id="Repo_FechaCerrarAlimentador" disabled>
			      						    </div>            
			      						</div>
									</div>
								</div>
			      				<div class="modal-footer">
									<button type="submit" id="btnAtendidoReporteAlimentador" class="btn btn-dark">Atendido</button>
			      					<button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
			      				</div>
							</form>
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD LOGUEO ALIMENTADOR -->
				<div class="row modal fade" id="modal_crud_logueo_alimentador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
			           
					    	<div class="modal-header">
								<h5 class="modal-title_logueo_alimentador" id="modal-title_logueo_alimentador"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
							<form id="form_logueo_alimentador" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
								  	<div class="row align-items-end mb-3 border-bottom border-muted">
										<div class="col-lg-3">
											<img src="Module/ControlFacilitador/View/Img/logo23.JPG" class="my-logo-modal-body" alt="">
										</div>
										<div class="col-lg-9">
											<div class="row">
												<div class="col-lg-12">
													<h5 class="modal-body-title_logueo_alimentador" id="modal-body-title_logueo_alimentador"></h5>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<h6 class="modal-body-subtitle_logueo_alimentador" id="modal-body-subtitle_logueo_alimentador"></h6> 
												</div>
											</div>
										</div>
									</div>
									<div class="row align-items-end">
									  	<div class="col-lg-3">
											<div class="form-group">
								            	<label for="" class="col-form-label form-control-sm">N° BUS:</label>
				  				            </div> 
			      		            	</div>
									  	<div class="col-lg-3">
											<div class="form-group">
												<input type="text" readonly class="form-control form-control-sm" id="logueo_alimentador_bus">
				  				            </div> 
			      		            	</div>
										<div class="col-lg-6">
											<div class="form-group">
								            	<label for="" class="col-form-label form-control-sm">ALIMENTADOR</label>
				  				            </div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
									  	<div class="col-lg-3">
											<div class="form-group">
								            	<label for="" class="col-form-label form-control-sm">COD. ACS:</label>
				  				            </div> 
			      		            	</div>
									  	<div class="col-lg-3">
											<div class="form-group">
												<input type="text" readonly class="form-control form-control-sm" id="logueo_alimentador_vid">
				  				            </div> 
			      		            	</div>
										<div class="col-lg-6">
											<div class="form-group">
								            	<label for="" class="col-form-label form-control-sm">(CODIGO INTERNO)</label>
				  				            </div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
									  	<div class="col-lg-3">
											<div class="form-group">
								            	<label for="" class="col-form-label form-control-sm">PASE PILOTO:</label>
				  				            </div> 
			      		            	</div>
									  	<div class="col-lg-3">
											<div class="form-group">
												<input type="text" readonly class="form-control form-control-sm" id="logueo_alimentador_codigo_piloto">
				  				            </div> 
			      		            	</div>
										<div class="col-lg-6">
											<div class="form-group">
								            	<input type="text" readonly class="form-control form-control-sm" id="logueo_alimentador_nombre_piloto">
				  				            </div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
									  	<div class="col-lg-3">
											<div class="form-group">
								            	<label for="" class="col-form-label form-control-sm">SERVICIO:</label>
				  				            </div> 
			      		            	</div>
									  	<div class="col-lg-3">
											<div class="form-group">
												<input type="text" readonly class="form-control form-control-sm" id="logueo_alimentador_tabla">
				  				            </div> 
			      		            	</div>
										<div class="col-lg-6">
											<div class="form-group">
								            	<input type="text" readonly class="form-control form-control-sm" id="logueo_alimentador_servicio">
				  				            </div> 
			      		            	</div>
									</div>
								</div>
								<div class="modal-footer">
				  		        	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
									<button type="button" id="btn_novedad_logueo_alimentador" class="btn btn-dark btn-sm btn_novedad_logueo_alimentador">+Novedad</button>
				  		    	</div>
			      			</form>
						
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD VER INFORMACION DE BUS ALIMENTADOR-->
				<div class="row modal fade" id="modal_crud_bus_alimentador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
				    	<div class="modal-content">
					    	<div class="modal-header">
				            	<h5 class="modal-title" id="exampleModalLabel"></h5>
				            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
				            	</button>
				        	</div>
					  		<form id="form_modal_bus_alimentador">
				  		    	<div class="modal-body">
				  		        	<div class="row">
				  		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                  		<label for="Bus_NroExterno_alimentador" class="col-form-label form-control-sm">Nro. EXTERNO</label>
						                   		<input type="text" readonly class="form-control form-control-sm" id="Bus_NroExterno_alimentador">
				  		               		</div>
				  		            	</div>
				  		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                		<label for="Bus_NroVid_alimentador" class="col-form-label form-control-sm">Nro. VID</label>
												<input type="text" readonly class="form-control form-control-sm" id="Bus_NroVid_alimentador">
											</div> 
				  		            	</div>
				  		        	</div>
				  		        	<div class="row"> 
				  		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                   		<label for="Bus_NroPlaca_alimentador" class="col-form-label form-control-sm">Nro. PLACA</label>
												<input type="text" readonly class="form-control form-control-sm" id="Bus_NroPlaca_alimentador">
											</div>               
						           		</div>
						               	<div class="col-lg-6">
						                  	<div class="form-group">
						                   		<label for="Bus_Operacion_alimentador" class="col-form-label form-control-sm">OPERACION</label>
						                   		<input type="text" readonly class="form-control form-control-sm" id="Bus_Operacion_alimentador">
				  		                	</div>
				  		            	</div>
									</div>  
									<div class="row"> 
				  		            	<div class="col-lg-12">
				  		                	<div class="form-group">
						                   		<label for="Bus_Detalle_alimentador" class="col-form-label form-control-sm">DETALLE</label>
												<input type="text" readonly class="form-control form-control-sm" id="Bus_Detalle_alimentador">
											</div>               
						           		</div>
									</div>  
									<div class="row"> 
				  		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                   		<label for="Bus_Tipo_alimentador" class="col-form-label form-control-sm">TIPO</label>
												<input type="text" readonly class="form-control form-control-sm" id="Bus_Tipo_alimentador">
											</div>               
						           		</div>
						               	<div class="col-lg-6">
						                  	<div class="form-group">
						                   		<label for="Bus_Tipo2_alimentador" class="col-form-label form-control-sm">TIPO 2</label>
						                   		<input type="text" readonly class="form-control form-control-sm" id="Bus_Tipo2_alimentador">
				  		                	</div>
				  		            	</div>
									</div>  
									<div class="row"> 
				  		            	<div class="col-lg-6">
				  		                	<div class="form-group">
						                   		<label for="Bus_Estado_alimentador" class="col-form-label form-control-sm">ESTADO</label>
												<input type="text" readonly class="form-control form-control-sm" id="Bus_Estado_alimentador">
											</div>               
						           		</div>
						               	<div class="col-lg-6">
						                  	<div class="form-group">
						                   		<label for="Bus_Tanques_alimentador" class="col-form-label form-control-sm">Tanques</label>
						                   		<input type="text" readonly class="form-control form-control-sm" id="Bus_Tanques_alimentador">
				  		                	</div>
				  		            	</div>
									</div>  
								</div>
				  		    	<div class="modal-footer">
				  		        	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
				  		    	</div>
				  			</form>    

						</div>
					</div>
				</div>  			

			</div>

			<!---------------------------------------------------------------------->
			<!------------------------- TAB NOVEDADES ------------------------------>
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-novedad" role="tabpanel" aria-labelledby="nav-novedad-tab">

				<form id="formSeleccionNovedadCarga" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">

						<div class="col-lg-1">
							<div class="form-group">
								<label for="Prog_FechaNovedadCarga" class="col-form-label form-control-sm">F. OPERACION</label>
								<input type="date" class="form-control form-control-sm" id="Prog_FechaNovedadCarga" placeholder="dd/mm/aaaaa">
			   				</div>
						</div>

						<div class="col-lg-1">
							<div class="form-group">
								<label for="Nove_Estado" class="col-form-label form-control-sm">ESTADO</label>
								<select class="form-control form-control-sm" id="Nove_Estado">
									
								</select>
			   				</div>
						</div>

						<div class="col-lg-3">
							<div class="form-group" id="div_seleccion_novedad_carga">
								
							</div>
			       		</div> 

					</div>
				</form>

			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tablaNovedadCarga">
								<!-- PHP Accesos Creacion Tabla -->
				            </div>
				        </div>
				    </div>  
				</div>   
			
				<!--Modal para CRUD-->
				<div class="row modal fade" id="modalCRUDNovedadCarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
					  		<form id="formNovedadCarga" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
			      		        	<div class="row align-items-end">
									  	<div class="col-lg-6">
											<div class="form-group">
								            	<label for="" class="col-form-label">Novedad</label>
												<input type="text" class="form-control" id="NovedadCarga_Id">
				  				            </div> 
			      		            	</div>
									  	<div class="col-lg-6">
											<div class="form-group">
								            	<label for="" class="col-form-label">Novedad</label>
												<select class="form-control" id="Nove_NovedadCarga">
												</select>
				  				            </div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-6">
											<div class="form-group">
								            	<label for="" class="col-form-label">Tipo Novedad</label>
												<select class="form-control" id="Nove_TipoNovedadCarga">
												</select>
				  				            </div> 
			      		            	</div>
										<div class="col-lg-6">
											<div class="form-group">
								            	<label for="" class="col-form-label">Detalle Novedad</label>
												<select class="form-control" id="Nove_DetalleNovedadCarga">
												</select>
				  				            </div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="" class="col-form-label">Lugar Exacto / Estación o Paradero de Referencia</label>
												<input type="text" class="form-control" id="Nove_LugarExactoNovedadCarga"  maxlength="50">
				  				            </div> 
			      		            	</div>
										<div class="col-lg-3">
											<div class="form-group">
								            	<label for="" class="col-form-label">H. Inicio</label>
												<div class="input-group">
													<input type="text" name="HoraInicioNovedadCarga" class="form-control col-lg-4" id="HoraInicioNovedadCarga" title="Hora ente 1 y 30" maxlength="2"  onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 1 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
													<label class="form-control col-lg-1">:</label>
													<input type="text" name="MinutoInicioNovedadCarga" class="form-control col-lg-4" id="MinutoInicioNovedadCarga" title="Minutos entre 0 y 59"  maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
													</div>
				  				            </div> 
			      		            	</div>
										<div class="col-lg-3">
											<div class="form-group">
								            	<label for="" class="col-form-label">H. Fin</label>
												<div class="input-group">
													<input type="text" name="HoraFinNovedadCarga" class="form-control col-lg-4" id="HoraFinNovedadCarga" title="Hora ente 1 y 30" maxlength="2"  onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 1 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
													<label class="form-control col-lg-1">:</label>
													<input type="text" name="MinutoFinNovedadCarga" class="form-control col-lg-4" id="MinutoFinNovedadCarga" title="Minutos entre 0 y 59"  maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
													</div>
				  				            </div> 
			      		            	</div>
									</div>
									<div class="row align-items-end">
										<div class="col-lg-12">
			      				           	<div class="form-group shadow-textarea">
			      				            	<label for="Nove_DescripcionNovedadCarga" class="col-form-label">Descripcion Novedad (Máx 1500 caract.)</label>
			      				            	<textarea class="form-control z-depth-1" id="Nove_DescripcionNovedadCarga" rows="7" placeholder="escribe algo aqui..."></textarea>
			      				            </div>
			      				        </div>    
			      		            </div>
			      		        </div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
			      					<button type="submit" id="btnGuardarNovedadCarga" class="btn btn-dark">Guardar</button>
								</div>
			      			</form>
						
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD MOSTRAR HISTORIAL NOVEDADES-->
				<div class="row modal fade" id="modalCRUDMostrarHistorialNovedadCarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    	<div class="modal-dialog modal-xl" role="document">
			        	<div class="modal-content">
			           
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
			      	
							<form id="formMostrarHistorialNovedadCarga">    
								<div class="modal-body scrollVClass" id="div_MostrarHistorialNovedadCarga">
									<!-- Se genera información -->
								</div>
			      				<div class="modal-footer">
			      					<button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
			      				</div>
			    			</form>
						
			        	</div>
			    	</div>
				</div>

				<!--Modal para CRUD CARGAR PDF-->
				<div class="row modal fade" id="modal_crud_cargar_pdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_cargar_pdf" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
			      		        	<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-group">
												<div class="custom-file">
							  						<label id="label_cargar_pdf" class="custom-file-label form-control-sm" for="customFileLang">Seleccionar Archivo .pdf</label>
							  						<input type="file" class="custom-file-input form-control-sm" id="cargar_pdf" lang="es" accept=".pdf"> 
												</div>
				               				</div>
										</div>
									</div>
			      		        </div>
			      		    	<div class="modal-footer">
								  	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
			      					<button type="submit" id="btn_guardar_cargar_pdf" class="btn btn-dark btn-sm btn_guardar_cargar_pdf">Cargar</button>
								</div>
							  </form>
			        	</div>
			    	</div>
				</div>

			</div>

			<!---------------------------------------------------------------------->
			<!---------------- TAB DETALLE DE NOVEDADES ---------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-detallenovedad" role="tabpanel" aria-labelledby="nav-detallenovedad-tab">

				<form id="formDetalleNovedad" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
					
						<div class="col-lg-1">
							<div class="form-group">
								<label for="Nove_FechaOperacion" class="col-form-label form-control-sm">F. OPERACION</label>
								<input type="date" class="form-control form-control-sm" id="Nove_FechaOperacion" placeholder="dd/mm/aaaaa">
			   				</div>
						</div>
						<div class="col-sm-1">
							<div class="form-group">
								<button type="button" id="btnBuscarDetalleNovedad" class="btn btn-secondary btn-sm">Buscar</button>
							</div>
						</div>   
				
					</div>
				</form>
			   	
				<div class="container-fluid caja w-auto">
		    	   	<div class="row w-100 p-0 m-0">
		        	   	<div class="col-lg-12">
		            		<div class="table-responsive" id="div_tablaDetalleNovedad">
								<!-- PHP Accesos CreacionTabla -->
		            		</div>
		           		</div>
		       		</div>  
		   		</div>
			</div>	

			<!---------------------------------------------------------------------->
			<!---------------- TAB REPORTE OPERACIONES  ---------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-reporteop" role="tabpanel" aria-labelledby="nav-reporteop-tab">
				<form id="formReporteop" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1">
							<div class="form-group">
								<label for="fechaReporteop" class="col-form-label form-control-sm">F. OPERACION</label>
								<input type="date" class="form-control form-control-sm" id="fechaReporteop" placeholder="dd/mm/aaaaa">
			   				</div>
						</div>
						<div class="col-lg-2">
				        	<div class="form-group">
								<label for="tipoReporteop" class="col-form-label form-control-sm">REPORTE</label>
								<select name="tipoReporteop" class="form-control form-control-sm" id="tipoReporteop">
						    	</select>
					       	</div>
			        	</div>
						<div class="col-lg-1">
				        	<div class="form-group">
								<label for="operacionReporteop" class="col-form-label form-control-sm">OPERACION</label>
								<select name="operacionReporteop" class="form-control form-control-sm" id="operacionReporteop">
						    	</select>
					       	</div>
			        	</div>
						<div class="col-sm-2">
							<div class="form-group">
								<button type="button" id="btnBuscarReporteop" class="btn btn-secondary btn-sm">Buscar</button>
							</div>
						</div>   
					</div>
				</form>
				<div class="container-fluid caja w-auto">
		    	   	<div class="row w-100 p-0 m-0">
		        	   	<div class="col-lg-12">
		            		<div class="table-responsive" id="div_tablaReporteop">        
		                	<!-- PHP Accesos Creacion de Tabla -->
		            		</div>
		           		</div>
		       		</div>  
		   		</div>
			</div>

			<!---------------------------------------------------------------------->
			<!-- TAB AJUSTES DE CONTROL FACILITADOR -------------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-ajustes_control_facilitador" role="tabpanel" aria-labelledby="nav-ajustes_control_facilitador-tab">

				<section class="container-fluid py-3">
					<button id="btnNuevoTipoTablas" type="button" class="btn btn-secondary btnNuevoTipoTablas btn-sm" data-toggle="modal">+ Nuevo</button>  
				</section>
	
				<div class="row p-3">
					<div class="col-auto m-0">
						<div class="table-responsive" id="div_tablaTipoTablas">
							
						</div>
					</div>
				</div>

				<!--Modal para CRUD-->
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
						                  		<label for="Ttabla_Id" class="col-form-label form-control-sm">ID</label>
						                   		<input type="text" readonly class="form-control form-control-sm" id="Ttabla_Id">
				  		               		</div>
			      		            	</div>
										<div class="col-lg-6">
				  		                	<div class="form-group">
						                		<label for="Ttabla_Operacion" class="col-form-label form-control-sm">FICHA</label>
												<input type="text" class="form-control text-uppercase form-control-sm" id="Ttabla_Operacion" maxlength="45">
											</div> 
			      		            	</div>
			      		        	</div>
			      		        	<div class="row"> 
									  	<div class="col-lg-6">
				  		                	<div class="form-group">
												<label for="Ttabla_Tipo" class="col-form-label form-control-sm">CATEGORIA 1</label>
						                   		<input type="text" class="form-control form-control-sm text-uppercase" id="Ttabla_Tipo" maxlength="45">
											</div> 
			      		            	</div>    
									</div>
									<div class="row"> 
									  	<div class="col-lg-12">
				  		                	<div class="form-group">
												<label for="Ttabla_Detalle" class="col-form-label form-control-sm">CATEGORIA 2</label>
			      				            	<textarea class="form-control z-depth-1 text-uppercase form-control-sm" id="Ttabla_Detalle" rows="7" placeholder="escribe algo aqui..." maxlength="250"></textarea>
											</div>               
						           		</div>
			      		        	</div>
								</div>
			      		    	<div class="modal-footer">
			      		        	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
			      		        	<button type="submit" id="btnGuardarTipoTablas" class="btn btn-dark btn-sm btnGuardarTipoTablas">Guardar</button>
			      		    	</div>
			      			</form>    
			        	</div>
			    	</div>
				</div>  			
			</div>


		</div>
	</div>
</div>