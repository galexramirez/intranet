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
			<div class="nav nav-tabs" id="div_nav-tab-documento-laboral" role="tablist">
				<!-- Creacion Tabs -->
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<!---------------------------------------------------------------------->
			<!-------------------- TAB BOLRETA DE PAGO ----------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade show active" id="nav-boleta" role="tabpanel" aria-labelledby="nav-boleta-tab">

			</div>
			<!---------------------------------------------------------------------->
			<!---------------------------- TAB CTS --------------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-cts" role="tabpanel" aria-labelledby="nav-cts-tab">

			</div>
			<!---------------------------------------------------------------------->
			<!--------------------- TAB UTILIDADES --------------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-utilidades" role="tabpanel" aria-labelledby="nav-utilidades-tab">

			</div>
			<!---------------------------------------------------------------------->
			<!------------------------- TAB CARGAR --------------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-cargar" role="tabpanel" aria-labelledby="nav-cargar-tab">

			</div>
			<!---------------------------------------------------------------------->
			<!--------------------- TAB REPORTES ----------------------------------->
			<!---------------------------------------------------------------------->
			<div class="tab-pane fade" id="nav-reportes" role="tabpanel" aria-labelledby="nav-reposrtes-tab">

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
