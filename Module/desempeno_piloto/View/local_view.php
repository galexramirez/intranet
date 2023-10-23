<!-- 2.2 CONTENIDO DE MODULO -->

<div id="contenido" class="container-fluid p-0">

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
	
	<section class="container-fluid py-2">
		<form id="form_desempeno_piloto" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
			<div class="row align-items-end pb-4 col-sm-12">
                <div class="col-lg-3">
			      	<div class="form-group ui-widget">
						<label for="dp_nombre_piloto" class="col-form-label form-control-sm">PILOTO</label>
						<input type="text" class="form-control form-control-sm text-uppercase" id="dp_nombre_piloto">
			      	</div>
			    </div>
                <div class="col-lg-1">
			      	<div class="form-group">
						<label for="dp_fecha_inicio" class="col-form-label form-control-sm">F.INICIO</label>
						<input type="date" class="form-control form-control-sm" id="dp_fecha_inicio" placeholder="dd-mm-aaaa">
			      	</div>
			    </div>
				<div class="col-lg-1">
			      	<div class="form-group">
						<label for="dp_fecha_termino" class="col-form-label form-control-sm">F.TERMINO</label>
						<input type="date" class="form-control form-control-sm" id="dp_fecha_termino" placeholder="dd-mm-aaaa">
			      	</div>
			    </div>
                <div class="col-lg-1">
                    <div class="form-group">
                        <button type="button" id="btn_cargar_desempeno_piloto" class="btn btn-secondary btn-sm btn_cargar_desempeno_piloto">Cargar</button>
                    </div>
                </div>
			</div>
		</form>
	</section>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="container-fluid d-flex flex-column py-2">

            <!-- Main Content -->
            <div id="content" class="container-fluid p-0">
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

			</div>	
        </div>
        <!-- End of Content Wrapper -->

</div>