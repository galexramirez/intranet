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
	
	<section class="container-fluid py-3">
		<form id="form_dashboard" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
			<div class="row align-items-end pb-4 col-sm-12">
				<div class="col-lg-1">
			      	<div class="form-group">
						<label for="dbm_fecha_inicio" class="col-form-label form-control-sm">F.INICIO</label>
						<input type="date" class="form-control form-control-sm" id="dbm_fecha_inicio" placeholder="dd-mm-aaaa" >
			      	</div>
			    </div>
				<div class="col-lg-1">
			      	<div class="form-group">
						<label for="dbm_fecha_termino" class="col-form-label form-control-sm">F.TERMINO</label>
						<input type="date" class="form-control form-control-sm" id="dbm_fecha_termino" placeholder="dd-mm-aaaa" >
			      	</div>
			    </div>
                <div class="col-lg-1">
                    <div class="form-group">
                        <button type="button" id="btn_cargar_dashboard" class="btn btn-secondary btn-sm btn_cargar_dashboard">Cargar</button>
                    </div>
                </div>
			</div>
		</form>
	</section>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="container-fluid d-flex flex-column py-3">

            <!-- Main Content -->
            <div id="content" class="container-fluid p-0">

                <!-- Begin Page Content
                <div class="container-fluid p-0">

                     Content Row 
                    <div class="row">

                         Pie Chart
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                 Card Header
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-success">OT CORRECTIVAS</h6>
                                </div>
                                 Card Body
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <div id="div_chart_pie_ot" class="chartPiediv"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         Pie Chart
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                 Card Header 
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-success">OT PREVENTIVAS</h6>
                                </div>
                                 Card Body 
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <div id="div_chart_pie_otprv"  class="chartPiediv"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                     Content Row 
                    <div class="row">

                         Pie Chart 
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                 Card Header 
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-success">VALES CORRECTIVOS</h6>
                                </div>
                                 Card Body 
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <div id="div_chart_pie_vales"  class="chartPiediv"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         Pie Chart 
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                Card Header
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-success">VALES PREVENTIVOS</h6>
                                </div>
                                Card Body
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <div id="div_chart_pie_vales_prv"  class="chartPiediv"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                    </div>
                    
                     Content Row
                    <div class="row">

                        Content Column 
                        <div class="col-lg-8 mb-4">

                            Project Card Example 
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-success">KILOMETROS RECORRIDOS</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <div id="div_chart_line_km"  class="chartLinediv"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> 
                

                </div>
                /.container-fluid -->

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