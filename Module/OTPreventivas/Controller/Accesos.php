<?php
class Accesos
{
	var $Modulo="OTPreventivas";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-otpreventivas":
				$tabshtml = '	<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Carga</a>
								<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Listado</a>
								<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><span id="idProcesar">Procesar</span></a>';
			break;
		}
		echo $tabshtml;
	}
	
    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
		$tablahtml = "";
        switch ($NombreTabla) 
		{
            case "tablaOTPrvCarga":
                $tablahtml = "<table id='tablaOTPrvCarga' class='table table-striped table-bordered table-condensed w-100'>
								<thead class='text-center'>
									<tr>
										<th>CARGA ID</th>
										<th>SEMANA PROGRAMADA</th>
										<th>CANT. REGISTROS</th>
										<th>FECHA CARGA</th>
										<th>USUARIO CARGA</th>
										<th>ACCIONES</th> 
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>";
            break;

            case "tablaOTPrv":
                $tablahtml = 	'<table id="tablaOTPrv" class="table table-striped table-bordered table-condensed w-80">
									<thead class="text-center">
										<tr>
											<th>VER OT</th>
											<th>CODIGO_OT</th>
											<th>ESTADO</th>
											<th>FECHA_PROG.</th>
											<th>USUARIO_GENERA</th>
											<th>BUS</th>
											<th>FRECUENCIA</th>
											<th>ASOCIADO</th>
											<th>TECNICO</th>
											<th>DESCRIPCION_DE_LA_ACTIVIDAD_DE_PROGRAMACION</th>
											<th>CIERRE_TECNICO</th>
											<th>CGM_CIERRE_TECNICO</th>
											<th>CIERRE_ADM.</th>
											<th>RESP._CIERRE_ADM.</th>
											<th>KILOMETRAJE</th>
											<th>SEMANA</th>
											<th>TURNO</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

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
            case "tablaOTPrvCarga":
				$defaultContent = "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btn-sm btnBorrarOTPrvCarga'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "otprvcarga_id"},
									{"data": "otprvcarga_semanaprogramada"},
									{"data": "otprvcarga_nroregistros"},
									{"data": "otprvcarga_fechacargada"},
									{"data": "otprvcarga_usuarioid"},
									{"defaultContent": " '.$defaultContent.' "}
								]';
			break;

            case "tablaOTPrv":
				$defaultContent0 = "<div class='text-center'><div class='btn-group'><button title='Ver OT' class='btn btn-sm btn_ver_ot_prv'><i class='bi bi-search'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg></i></button></div></div>";
				$defaultContent = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarOTPrv'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"defaultContent": " '.$defaultContent0.' "},
									{"data": "cod_otpv"},
                					{"data": "otpv_estado"},
                					{"data": "otpv_date_prog"},
                					{"data": "otpv_genera"},
                					{"data": "otpv_bus"},
                					{"data": "otpv_fecuencia"},
                					{"data": "otpv_asociado"},
                					{"data": "otpv_tecnico"},
                					{"data": "otpv_descripcion"},
                					{"data": "otpv_fin"},
                					{"data": "otpv_cgm_cierra"},
                					{"data": "otpv_date_cierra_ad"},
                					{"data": "otpv_cierra_ad"},
                					{"data": "otpv_kmrealiza"},
									{"data": "otpv_semana"},
									{"data": "otpv_turno"},
									{"defaultContent": " '.$defaultContent.' "}
								]';
			break;

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
			case "contenido":
				switch($NombreObjeto)
				{
					case "div_alertsDropdown_otprv":
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax	= new CRUD();
						$Respuesta		= $InstanciaAjax->buscar_estado("manto_otprv", "otpv_estado", "OBSERVADO", "otpv_date_prog", "2022-12-31");

						$divformulario = '	<h6 class="dropdown-header">
												Alertas OTs Prv. Observadas
											</h6>';
						
						foreach($Respuesta as $row){
							$divformulario .= '	<a class="dropdown-item d-flex align-items-center" href="javascript:f_editar_otprv('.$row['cod_otpv'].')">
													<div class="mr-3">
														<div class="icon-circle bg-primary">
															<i class="fas fa-file-alt text-white"></i>
														</div>
													</div>	
													<div>
														<div class="font-weight-bold">'.$row['cod_otpv'].'</div>
														<span class="small text-gray-500">'.$row['otpv_date_prog'].' - '.$row['otpv_bus'].' - '.$row['otpv_asociado'].'</span>
													</div>
												</a>';		
						}
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
			case "":
				switch($NombreObjeto)
				{
					case "":
						$Mostrar_div = '';
					break;

					case "":
						switch($Dato)
						{
							case "":
							break;

							case "":
							break;

						}
						$Mostrar_div = '';
					break;

				}
			break;
		}
		echo $Mostrar_div;
    }


}