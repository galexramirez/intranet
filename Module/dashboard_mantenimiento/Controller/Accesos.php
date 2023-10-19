<?php
class Accesos
{
	var $Modulo = "dashboard_mantenimiento";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "":
				$tabshtml = '';
			break;
		}
		echo $tabshtml;
	}
	
    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
		$tablahtml = "";
        switch ($NombreTabla) 
		{

			case "":
				$tablahtml = '';
			break;

        }
		echo $tablahtml;
	}

	public function ColumnasTabla($NombreTabla,$TipoTabla)
	{
		$columnashtml = "";
        switch ($NombreTabla) 
		{
			case "":
				$columnashtml = '';
			break;

        }
		echo $columnashtml;
	}

	public function BotonesFormulario($NombreFormulario,$NombreObjeto)
	{
		$botonesformulario = "";
		switch($NombreFormulario)
		{
			case "":
				switch($NombreObjeto)
				{
					case "":
						$botonesformulario = '';
					break;
				}
			break;
		}
		echo $botonesformulario;
    }

	public function DivFormulario($NombreFormulario,$NombreObjeto)
	{
		$divformulario = "";
		switch($NombreFormulario)
		{
			case "":
				switch($NombreObjeto)
				{
					case "":
						$divformulario = '';
					break;

					case "":
					break;

				}
			break;
		}
		echo $divformulario;
    }

	public function MostrarDiv($NombreFormulario,$NombreObjeto,$Dato)
	{
		$Mostrar_div = "";
		switch($NombreFormulario)
		{
			case "form_dashboard":
				switch($NombreObjeto)
				{
					case "content":
						switch($Dato)
						{
							case "inicio":
								$Mostrar_div = '';
							break;

							case "cargar":
								$Mostrar_div = '	<!-- Begin Page Content -->
													<div class="container-fluid p-0">

														<!-- Content Row -->
														<div class="row">

															<!-- Pie Chart -->
															<div class="col-xl-4 col-lg-5">
																<div class="card shadow mb-4">
																	<!-- Card Header -->
																	<div class="card-header py-3">
																		<h6 class="m-0 font-weight-bold text-success">OT CORRECTIVAS</h6>
																	</div>
																	<!-- Card Body -->
																	<div class="card-body">
																		<div class="chart-pie pt-4 pb-2">
																			<div id="div_chart_pie_ot" class="chartPiediv"></div>
																		</div>
																	</div>
																</div>
															</div>

															<!-- Pie Chart -->
															<div class="col-xl-4 col-lg-5">
																<div class="card shadow mb-4">
																	<!-- Card Header -->
																	<div class="card-header py-3">
																		<h6 class="m-0 font-weight-bold text-success">OT PREVENTIVAS</h6>
																	</div>
																	<!-- Card Body -->
																	<div class="card-body">
																		<div class="chart-pie pt-4 pb-2">
																			<div id="div_chart_pie_otprv"  class="chartPiediv"></div>
																		</div>
																	</div>
																</div>
															</div>

														</div>

														<!-- Content Row -->
														<div class="row">

															<!-- Pie Chart -->
															<div class="col-xl-4 col-lg-5">
																<div class="card shadow mb-4">
																	<!-- Card Header -->
																	<div class="card-header py-3">
																		<h6 class="m-0 font-weight-bold text-success">VALES</h6>
																	</div>
																	<!-- Card Body -->
																	<div class="card-body">
																		<div class="chart-pie pt-4 pb-2">
																			<div id="div_chart_pie_vales"  class="chartPiediv"></div>
																		</div>
																	</div>
																</div>
															</div>

															<!-- Pie Chart 
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
															-->

														</div>

														<!-- Content Row
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
														-->

													</div>
													<!-- /.container-fluid -->
						 						';
							break;

						}

					break;

				}
			break;
		}
		echo $Mostrar_div;
    }


}