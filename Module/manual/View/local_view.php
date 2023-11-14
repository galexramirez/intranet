<!-- 2.2 CONTENIDO DE MODULO -->
<div id="contenido" class="my-contenido-con-sidebar  p-0">

	<nav class="navbar navbar-light bg-light p-0">
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
					<a class="navbar-brand text-muted" href="manual" target="_blank">
						<i class="bi bi-question-circle-fill" title="Ayuda">
							<svg style="color: blue" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/></svg>
						</i>
					</a>
				</div>
			</div>
		</div>
	</nav>

	<!-- Contenido para el Modulo -->
	<div class="my-contenidoModulo container-fluid pl-0 pr-0 ml-0 mr-0">

		<nav>
	 		<div class="nav nav-tabs" id="nav-tab-manual" role="tablist">
				<!-- PHP Accesos CreacionTabs -->
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">
			<!------------------------------------------------------------------------------->
	  		<!-- TAB LISTADO MANUAL DE USUARIO  --------------------------------------------->
			<!------------------------------------------------------------------------------->
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<form id="form_seleccion_listado_manual" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
					<div class="row align-items-end pb-4 col-sm-12">
						<div class="col-lg-1 pt-3">             	
							<div class="form-group" id="div_btn_seleccion_listado_manual">
							</div>
			       		</div> 
					</div>
				</form>
			   	<div class="container-fluid caja">
					<div class="row w-100 p-0 m-0">
				       	<div class="col-lg-12">
				       		<div class="table-responsive" id="div_tabla_manual">
				            </div>
				        </div>
				    </div>  
				</div>
			</div>

			<!------------------------------------------------------------------------------->
			<!-- TAB REGISTRO MANUAL DE USUARIO --------------------------------------------->
			<!------------------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<form id="form_seleccion_manual_registro" class="row col-sm-12 container-fluid" onsubmit="return false;">	    
					<div class="row align-items-end pb-1 col-sm-12 mb-1">
						<div class="col-lg-1">
							<div class="form-group">
								<label for="manual_id" class="col-form-label form-control-sm">ID</label>
								<input type="number" readonly class="form-control form-control-sm" id="manual_id">
							</div>
						</div>
						<div class="col-lg-1">
							<div class="form-group">
								<label for="man_capitulo" class="col-form-label form-control-sm">CAPITULO</label>
								<input type="number" class="form-control form-control-sm man_capitulo" id="man_capitulo">
							</div>
						</div>
						<div class="col-lg-1">
							<div class="form-group">
								<label for="man_sub_capitulo" class="col-form-label form-control-sm">SUB CAP.</label>
								<input type="number" class="form-control form-control-sm man_sub_capitulo" id="man_sub_capitulo">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="man_descripcion" class="col-form-label form-control-sm">DESCRIPCION (Máx. 100 caract.)</label>
								<input type="text" class="form-control form-control-sm text-uppercase" id="man_descripcion" maxlength="100">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group" id="div_btn_seleccion_manual_registro">
							</div>
						</div>
					</div>
				</form>

				<div class="container-fluid ml-0 mr-0 mb-0 pt-3">
					<form id="form_manual_html" enctype="multipart/form-data" action="" method="post" onsubmit="return false;">    
						<div class="row align-items-end pb-4 col-sm-12" id="div_manual_html">
							
						</div>
					</form>
				</div>

				<!-- MODAL CRUD LOG MANUAL DE USUARIO -->
				<div class="row modal fade" id="modal_crud_log_manual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
					    	<div class="modal-header">
			                	<h5 class="modal-title" id="exampleModalLabel"></h5>
			                	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                	</button>
			            	</div>
					  		<form id="form_modal_log_manual" enctype="multipart/form-data" action="" method="post">    
			      		    	<div class="modal-body">
									<div class="row align-items-end">
										<div class="col-lg-12">
											<div class="form-control-sm mb-1 overflow-auto h-100 border border-muted border-radius rounded" id="div_log_manual">
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

			</div>

		</div>
	</div>
</div>