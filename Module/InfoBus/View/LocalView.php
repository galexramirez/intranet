<!-- 2.2 CONTENIDO DE MODULO -->

<div id="contenido" class="my-contenido-con-sidebar p-0">

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
	
	<section class="container-fluid py-3">
		<form id="formInfoBus" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
			<div class="row align-items-end pb-4 col-sm-12">
				<div class="col-lg-1">
			      	<div class="form-group">
						<label for="ib_FechaInicio" class="col-form-label form-control-sm">F.INICIO</label>
						<input type="date" class="form-control form-control-sm" id="ib_FechaInicio" placeholder="dd-mm-aaaa" >
			      	</div>
			    </div>
				<div class="col-lg-1">
			      	<div class="form-group">
						<label for="ib_FechaTermino" class="col-form-label form-control-sm">F.TERMINO</label>
						<input type="date" class="form-control form-control-sm" id="ib_FechaTermino" placeholder="dd-mm-aaaa" >
			      	</div>
			    </div>
				<div class="col-lg-1">
			      	<div class="form-group">
						<label for="ib_Bus" class="col-form-label form-control-sm">BUS</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
    							<button class="btn btn-outline-secondary btn-sm btn_ver_bus" type="button" id="btn_ver_bus"><i class="bi bi-bus-front"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bus-front" viewBox="0 0 16 16"><path d="M5 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm-6-1a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2H7Zm1-6c-1.876 0-3.426.109-4.552.226A.5.5 0 0 0 3 4.723v3.554a.5.5 0 0 0 .448.497C4.574 8.891 6.124 9 8 9c1.876 0 3.426-.109 4.552-.226A.5.5 0 0 0 13 8.277V4.723a.5.5 0 0 0-.448-.497A44.303 44.303 0 0 0 8 4Zm0-1c-1.837 0-3.353.107-4.448.22a.5.5 0 1 1-.104-.994A44.304 44.304 0 0 1 8 2c1.876 0 3.426.109 4.552.226a.5.5 0 1 1-.104.994A43.306 43.306 0 0 0 8 3Z"/><path d="M15 8a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1V2.64c0-1.188-.845-2.232-2.064-2.372A43.61 43.61 0 0 0 8 0C5.9 0 4.208.136 3.064.268 1.845.408 1 1.452 1 2.64V4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v3.5c0 .818.393 1.544 1 2v2a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5V14h6v1.5a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-2c.607-.456 1-1.182 1-2V8ZM8 1c2.056 0 3.71.134 4.822.261.676.078 1.178.66 1.178 1.379v8.86a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 11.5V2.64c0-.72.502-1.301 1.178-1.379A42.611 42.611 0 0 1 8 1Z"/></svg></i></button>
  							</div>
							<select class="form-control form-control-sm" id="ib_Bus" name="ib_Bus" >
							</select>												
						</div>
					</div>
			    </div>
				<div class="col-lg-1">
			      	<div class="form-group">
						<label for="ib_Tipo" class="col-form-label form-control-sm">TIPO</label>
						<select class="form-control form-control-sm" id="ib_Tipo" name="ib_Tipo" >
							<option value="GENERAL">OTsGENERAL</option>
							<option value="CORRECTIVAS">OTsCORRECTIVAS</option>
							<option value="PREVENTIVAS">OTsPREVENTIVAS</option>
						</select>
					</div>
			    </div>
				<div class="col-lg-1">
			      	<div class="form-group">
						<label for="ib_Sistema" class="col-form-label form-control-sm">SISTEMA</label>
						<select class="form-control form-control-sm" id="ib_Sistema" name="ib_Sistema" >
						</select>
					</div>
			    </div>
				<div class="col-lg-1">
			      	<div class="form-group">
						<label for="ib_origen" class="col-form-label form-control-sm">ORIGEN</label>
						<select class="form-control form-control-sm" id="ib_origen" name="ib_origen" >
						</select>
					</div>
			    </div>
				<div class="col-lg-1">
			      	<div class="form-group">
						<label for="ib_Contenga" class="col-form-label form-control-sm">CONTENGA</label>
						<input type="text" class="form-control form-control-sm" id="ib_Contenga" name="ib_Contenga" >
					</div>
			    </div>
				<div class="col-lg-2">             	
					<div class="form-group">
						<button type="button" id="btnCargarInfoBus" class="btn btn-secondary btn-sm">Cargar</button>
						<button type="button" id="btnDescargarInfoBus" class="btn btn-secondary btn-sm">Descargar</button>
					</div>
			    </div> 
			</div>
		</form>
	</section>
	<div class="row p-3">
		<div class="col-auto m-0">
			<div class="table-responsive" id="div_tablaInfoBus">
				<!-- PHP Accesos CreacionTabla -->
			</div>	
    	</div>
	</div>

	<!--Modal para CRUD-->
	<div class="row modal fade" id="modalCRUDInformacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content ui-widget-content" id="modal-resizable">
				<div class="modal-header dragable_touch">
					<h5 class="modal-title" id="exampleModalLabel"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body scrollVClass">
					<form id="formModalInformacion">
						<div class="container-fluid ml-0 mr-0 mb-0">
							<form id="formInfoDetalle" enctype="multipart/form-data" action="" method="post">    
								<div class="form-group" id="div_InfoDetalle">
									<!-- PHP Logico InfoBusOTs -->
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

	<!--Modal para CRUD VER INFORMACAION DE BUS-->
	<div class="row modal fade" id="modal_crud_buses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
	    	<div class="modal-content">
	       
		    	<div class="modal-header">
	            	<h5 class="modal-title" id="exampleModalLabel"></h5>
	            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
	            	</button>
	        	</div>
	  	
		  		<form id="form_modal_buses">    
	  		    	<div class="modal-body">
	  		        	<div class="row">
	  		            	<div class="col-lg-6">
	  		                	<div class="form-group">
			                  		<label for="Bus_NroExterno" class="col-form-label form-control-sm">Nro. EXTERNO</label>
			                   		<input type="text" readonly class="form-control form-control-sm" id="Bus_NroExterno">
	  		               		</div>
	  		            	</div>
	  		            	<div class="col-lg-6">
	  		                	<div class="form-group">
			                		<label for="bus_km" class="col-form-label form-control-sm">KILOMETRAJE</label>
									<input type="text" readonly class="form-control form-control-sm" id="bus_km">
								</div> 
	  		            	</div>
	  		        	</div>
	  		        	<div class="row"> 
	  		            	<div class="col-lg-6">
	  		                	<div class="form-group">
			                   		<label for="Bus_NroPlaca" class="col-form-label form-control-sm">Nro. PLACA</label>
									<input type="text" readonly class="form-control form-control-sm" id="Bus_NroPlaca">
								</div>               
			           		</div>
			               	<div class="col-lg-6">
			                  	<div class="form-group">
			                   		<label for="Bus_Operacion" class="col-form-label form-control-sm">OPERACION</label>
			                   		<input type="text" readonly class="form-control form-control-sm" id="Bus_Operacion">
	  		                	</div>
	  		            	</div>
						</div>  
						<div class="row"> 
	  		            	<div class="col-lg-12">
	  		                	<div class="form-group">
			                   		<label for="Bus_Detalle" class="col-form-label form-control-sm">DETALLE</label>
									<input type="text" readonly class="form-control form-control-sm" id="Bus_Detalle">
								</div>               
			           		</div>
						</div>  
						<div class="row"> 
	  		            	<div class="col-lg-6">
	  		                	<div class="form-group">
			                   		<label for="Bus_Tipo" class="col-form-label form-control-sm">TIPO</label>
									<input type="text" readonly class="form-control form-control-sm" id="Bus_Tipo">
								</div>               
			           		</div>
			               	<div class="col-lg-6">
			                  	<div class="form-group">
			                   		<label for="Bus_Tipo2" class="col-form-label form-control-sm">TIPO 2</label>
			                   		<input type="text" readonly class="form-control form-control-sm" id="Bus_Tipo2">
	  		                	</div>
	  		            	</div>
						</div>  
						<div class="row"> 
	  		            	<div class="col-lg-6">
	  		                	<div class="form-group">
			                   		<label for="Bus_Estado" class="col-form-label form-control-sm">ESTADO</label>
									<input type="text" readonly class="form-control form-control-sm" id="Bus_Estado">
								</div>               
			           		</div>
			               	<div class="col-lg-6">
			                  	<div class="form-group">
			                   		<label for="Bus_Tanques" class="col-form-label form-control-sm">Tanques</label>
			                   		<input type="text" readonly class="form-control form-control-sm" id="Bus_Tanques">
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