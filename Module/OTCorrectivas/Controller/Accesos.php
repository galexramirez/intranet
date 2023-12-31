<?php
class Accesos
{
	var $Modulo="OTCorrectivas";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-OTCorrectivas":
				$tabshtml = '	<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Listado</a>
								<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><span id="idProcesar">Procesar</span></a>
								<a class="nav-item nav-link" id="nav-cierre_semanal-tab" data-toggle="tab" href="#nav-cierre_semanal" role="tab" aria-controls="nav-cierre_semanal" aria-selected="false"><span id="id_cierre_semanal">Cierre Semanal</span></a> ';
			break;
		}
		echo $tabshtml;
	}
	
    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
		$tablahtml = "";
        switch ($NombreTabla) 
		{
            case "tablaOT":
                $tablahtml = '	<table id="tablaOT" class="table table-striped table-bordered table-condensed w-80">
									<thead class="text-center">
										<tr>
											<th>VER OT</th>
											<th>CODIGO OT</th>
											<th>ESTADO</th>
											<th>FECHA_APERTURA.</th>
											<th>USUARIO_GENERA</th>
											<th>BUS</th>
											<th>ORIGEN</th>
											<th>ASOCIADO</th>
											<th>TECNICO</th>
											<th>DESCRIPCION_ACTIVIDAD</th>
											<th>CIERRE_TECNICO</th>
											<th>CGM_CIERRE_TECNICO</th>
											<th>CIERRE_ADM.</th>
											<th>RESP._CIERRE_ADM.</th>
											<th>KILOMETRAJE</th>
											<th>VER VALES</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_horas_tecnicos":
                $tablahtml = '  <table id="tabla_horas_tecnicos" class="table table-striped table-bordered table-condensed w-100">
                                    <thead class="text-center">
                                        <tr>
											<th>TECNICO</th>
											<th>INICIO</th>
                                            <th>FINAL</th>
											<th>T.HORAS</th>
											<th>ACCION</th>
										</tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

			case "tabla_ver_horas_tecnicos":
                $tablahtml = '  <table id="tabla_ver_horas_tecnicos" class="table table-striped table-bordered table-condensed w-100">
                                    <thead class="text-center">
                                        <tr>
											<th>TECNICO</th>
											<th>INICIO</th>
                                            <th>FINAL</th>
											<th>T.HORAS</th>
										</tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

			case "tabla_cierre_semanal":
                $tablahtml = '	<table id="tabla_cierre_semanal" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
					   					<tr>
							  				<th>ID</th>
											<th>SEMANA_CERRADA</th>
											<th>FECHA_GENERAR</th>
											<th>USUARIO_QUE_GENERA</th>
											<th>FECHA_ABRIR</th>
											<th>USUARIO_QUE_ABRE</th>
											<th>ESTADO</th>
						   					<th>ACCIONES</th>
					   					</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>	';
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
            case "tablaOT":
				$defaultContent0 = "<div class='text-center'><div class='btn-group'><button title='Ver OT' class='btn btn-sm btn_ver_ot'><i class='bi bi-search'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg></i></button></div></div>";
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarOT'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"defaultContent": " '.$defaultContent0.' "},
									{"data": "cod_ot"},
									{"data": "ot_estado"},
									{"data": "ot_date_crea"},
									{"data": "ot_cgm_crea"},
									{"data": "ot_bus"},
									{"data": "ot_origen"},
									{"data": "ot_asociado"},
									{"data": "ot_tecnico"},
									{"data": "ot_descrip"},
									{"data": "ot_fin"},
									{"data": "ot_cgm_ct"},
									{"data": "ot_date_ca"},
									{"data": "ot_ca"},
									{"data": "ot_kilometraje"},
									{"data": "ot_vales"},
									{"defaultContent": " '.$defaultContent1.' "}
								]';
			break;

			case "tabla_horas_tecnicos":
				$defaultContent = "<div class='text-center'><div class='btn-group'><button tittle='Borrar' class='btn btn-danger btn-sm btn_borrar_horas_tecnicos'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "tecnico_nombres"},
									{"data": "hora_inicio"},
									{"data": "hora_fin"},
                                    {"data": "total_horas"},
									{"defaultContent": " '.$defaultContent.' "}	
								]';
            break;

			case "tabla_ver_horas_tecnicos":
				$columnashtml = '[	{"data": "tecnico_nombres"},
									{"data": "hora_inicio"},
									{"data": "hora_fin"},
                                    {"data": "total_horas"}
								]';
            break;

			case "tabla_cierre_semanal":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Abrir' class='btn btn-primary btn-sm btn_abrir_semana'><i class='bi bi-unlock-fill'> <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-unlock-fill' viewBox='0 0 16 16'><path d='M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2z'/></svg></i></button><button title='Cerrar' class='btn btn-success btn-sm btn_cerrar_semana_abierta'><i class='bi bi-unlock-fill'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-lock-fill' viewBox='0 0 16 16'><path d='M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "ot_cierre_id"},
                					{"data": "otc_semana"},
                					{"data": "otc_fecha_genera"},
                					{"data": "otc_usuario_genera"},
                					{"data": "otc_fecha_abrir"},
                					{"data": "otc_usuario_abrir"},
                					{"data": "otc_estado"},
                					{"defaultContent": "'.$defaultContent1.'"}
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
			case "formSeleccionTelemetriaCarga":
				switch($NombreObjeto)
				{
					case "btnNuevoTelemetriaCarga":
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta=$InstanciaAjax->Permisos($this->Modulo,$NombreObjeto);
						if ($Respuesta=="SI"){
							$botonesformulario = '<button id="btnNuevoTelemetriaCarga" type="button" class="btn btn-info" data-toggle="modal">+ Nuevo</button>';
						}
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
					case "div_alertsDropdown_ot":
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax	= new CRUD();
						$Respuesta		= $InstanciaAjax->buscar_estado("manto_ot", "ot_estado", "OBSERVADO", "ot_date_crea", "2022-12-31");

						$divformulario = '	<h6 class="dropdown-header">
												Alertas OTs Observadas
											</h6>';
						
						foreach($Respuesta as $row){
							$divformulario .= '	<a class="dropdown-item d-flex align-items-center" href="javascript:f_editar_ot('.$row['cod_ot'].')">
													<div class="mr-3">
														<div class="icon-circle bg-primary">
															<i class="fas fa-file-alt text-white"></i>
														</div>
													</div>	
													<div>
														<div class="font-weight-bold">'.$row['cod_ot'].'</div>
														<span class="small text-gray-500">'.$row['ot_date_crea'].' - '.$row['ot_bus'].' - '.$row['ot_asociado'].'</span>
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
		$color = "";
		switch($NombreFormulario)
		{
			case "formProcesarOT":
				switch($NombreObjeto)
				{
					case "div_CodigoOT":
						$Mostrar_div = '<h5 class="font-weight-bold">N° '.$Dato.'</h5>';
					break;

					case "div_ot_estadoactual":
						switch($Dato)
						{
							case "CERRADO":
								$color = "success";
							break;

							case "OBSERVADO":
								$color = "danger";

							case "ANULADO":
								$color = "primary";
							break;

							case "ABIERTO":
								$color = "warning";
							break;

							case "PENDIENTE CT":
								$color = "warning";
							break;

						}
						$Mostrar_div = '<label for="" class="form-control-sm pl-0 mb-0 text-'.$color.' font-weight-bold">ESTADO ACTUAL DE LA OT : '.$Dato.'</label>';
					break;

					case "div_ot_ca":
						$Mostrar_div = '<label for="" class="form-control-sm pl-0 mb-0">CIERRE ADMINISTRATIVO POR '.$Dato.'</label>';
					break;

					case "div_ot_date_ct":
						$Mostrar_div = '<label for="ot_data_ct" class="form-control-sm pl-0 mb-0">EL '.$Dato.'</label>';
					break;

					case "btn_guardar_ot":
						if($Dato=='CERRADO'){
							$Mostrar_div = ' <button type="button" id="btn_cancelar_ot" class="btn btn-light btn-sm form-control-sm mb-1 btn_cancelar_ot ">Cancelar</button> ';	
						}else{
							$Mostrar_div = ' <button type="button" id="btnGuardarOT" class="btn btn-dark btn-sm form-control-sm mb-1 btnGuardarOT ">Guardar</button> ';
						}
					break;

				}
			break;

			case "form_seleccion_cierre_semanal":
				switch($NombreObjeto)
				{
					case "btn_cierre_semanal":
						$Mostrar_div = '<button type="button" id="btn_buscar_cierre_semanal" class="btn btn-secondary btn-sm mr-1 btn_buscar_cierre_semanal">Buscar</button>';
						switch($Dato)
						{
							case "btn_generar_cierre_semanal":
								MModel($this->Modulo, 'CRUD');
								$InstanciaAjax = new CRUD();
								$Respuesta = $InstanciaAjax->Permisos($this->Modulo,"btn_generar_cierre_semanal");
								if($Respuesta=="SI"){
									$Mostrar_div .= '<button type="button" id="btn_generar_cierre_semanal" class="btn btn-secondary btn-sm mr-1 btn_generar_cierre_semanal">+ Cierre Semanal</button>';
								}
							break;
						}
					break;
				}
			break;

			case "contenido":
				switch($NombreObjeto)
				{
					case "div_alertsDropdown_ayuda":
						$man_modulo_id = '';
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax	= new CRUD();
						$Respuesta	= $InstanciaAjax->BuscarDataBD("Modulo", "Mod_Nombre", $Dato );
						foreach($Respuesta as $row){
							$man_modulo_id = $row['Modulo_Id'];
						}

						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax	= new CRUD();
						$Respuesta	= $InstanciaAjax->BuscarDataBD("glo_manual", "man_modulo_id", $man_modulo_id );

						usort($Respuesta, function($a, $b) {
                            return $a['man_titulo'] <=> $b['man_titulo'];
                        });
						
						$Mostrar_div = '	<h5 class="dropdown-header">
												AYUDA
											</h5>';
						
						foreach($Respuesta as $row){
							$Mostrar_div .= '	<a class="dropdown-item d-flex align-items-center" href="javascript:f_ayuda_modulo('."'".$row['man_titulo']."'".')">
													<div>
														<div class="font-weight-ligth drop-titulo">'.$row['man_titulo'].'</div>
													</div>
												</a>'; 
						}
					break;

				}
			break;

		}
		echo $Mostrar_div;
    }


}