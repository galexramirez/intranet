<?php
class Accesos
{
	var $Modulo="Inasistencias";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-inasistencias":
				$tabshtml = '<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Listado</a>';
	    		$tabshtml .= '<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Reporte Final</a>';
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-ajustes_inasistencias-tab');
				if ($Respuesta=="SI"){
					$tabshtml .= '<a class="nav-item nav-link" id="nav-ajustes_inasistencias-tab" data-toggle="tab" href="#nav-ajustes_inasistencias" role="tab" aria-controls="nav-ajustes_inasistencias" aria-selected="false">Ajustes</a>';
				}
			break;
		}
		echo $tabshtml;
	}
	
    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
		$tablahtml = "";
        switch ($NombreTabla) 
		{
            case "tabla_inasistencias":
                $tablahtml = '	<table id="tabla_inasistencias" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
				   						<tr>
					 						<th>ID PROG.</th>
					 						<th>ID NOVEDAD</th>
					 						<th>FECHA</th>
					 						<th>USUARIO QUE GENERA</th>
					 						<th>OPERACION</th>
					 						<th>TIPO NOVEDAD</th>
											<th>DETALLE NOVEDAD</th>
					 						<th>APELLIDOS Y NOMBRES</th>
					 						<th>BUS</th>
					 						<th>EST. NOVEDAD</th>
											<th>REPO.FACI.</th>
					 						<th>INASISTENCIAS</th>   
					 						<th>ID INASIST.</th>
					 						<th>EST. INASIST.</th>
				 						</tr>
									</thead>
									<tbody>                           
									</tbody>
		   						</table>';
            break;

            case "tabla_reporte_gdh":
                $tablahtml = '	<table id="tabla_reporte_gdh" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
										<tr>
											<th>ID INASIST.</th>
											<th>ESTADO</th>
											<th>NOMBRE_DE_CGO</th>
											<th>COD. PILOTO</th>
											<th>NOMBRE_DE_PILOTO</th>
											<th>DNI PILOTO</th>
											<th>TIPO_DE_PILOTO</th>
											<th>FECHA</th>
											<th>H.INICIO</th>
											<th>H.FINAL</th>
											<th>T.HORAS</th>
											<th>BUS</th>
											<th>TIPO_DE_BUS</th>
											<th>TABLA</th>
											<th>SERVICIO</th>
											<th>LUGAR_ORIGEN</th>
											<th>LUGAR_DESTINO</th>
											<th>TIPO NOV.</th>
											<th>DETALLE NOV.</th>   
											<th>DESCRIPCION_DE_NOVEDAD</th>
											<th>TIPO DE HORARIO</th>
											<th>FECHA_DE_CARGA</th>';
				
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax 	= new CRUD();
				$Respuesta		= $InstanciaAjax->Permisos($this->Modulo,"btn_editar_inasistencias");
				if ($Respuesta=="SI"){	
					$tablahtml .=			'<th>ACCIONES</th>';
				}
				$tablahtml .=		 	'</tr>
									</thead>
									<tbody>                           
									</tbody>
		   						</table> ';
            break;

			case "tablaTipoTablaInasistencias":
				$tablahtml = ' <table id="tablaTipoTablaInasistencias" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>FICHA</th>
											<th>CATEGORIA 1</th>
											<th>CATEGORIA 2</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table> ';
			break;
        }
		echo $tablahtml;
	}

	public function ColumnasTabla($NombreTabla,$TipoTabla)
	{
		$columnashtml = "";
        switch ($NombreTabla) 
		{
            case "tabla_inasistencias":
				$defaultContent_1 = "<div class='text-center'><div class='btn-group'><button title='R.Facilitador' class='btn btn-info btn-sm btn_reporte_facilitador'><i class='bi bi-clipboard-plus'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-clipboard-plus' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z'/><path d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z'/><path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/></svg></i></button></div></div>";
				
				$defaultContent_2 = "<div class='text-center'><div class='btn-group'><button title='I.Inasistencias' class='btn btn-warning btn-sm btn_inasistencias'><i class='bi bi-clipboard-plus'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-clipboard-plus' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z'/><path d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z'/><path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/></svg></i></button></div></div>";

				$columnashtml = '	[	{"data": "Nove_ProgramacionId"},
										{"data": "Novedad_Id"},
										{"data": "Nove_FechaOperacion"},
										{"data": "Usua_Nombres"},
										{"data": "Nove_Operacion"},
										{"data": "Nove_TipoNovedad"},
										{"data": "Nove_DetalleNovedad"},
										{"data": "Nove_NombreColaborador"},
										{"data": "Nove_Bus"},
										{"data": "Nove_Estado"},
										{"defaultContent": "'.$defaultContent_1.'"},
										{"defaultContent": "'.$defaultContent_2.'"},
										{"data": "inasistencias_id"},
										{"data": "inas_estadoinasistencias"}
				  					]';
			break;

            case "tabla_reporte_gdh":
				$defaultContent_1 = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_inasistencias'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '	[	{"data": "inasistencias_id"},
										{"data": "inas_estadoinasistencias"},
										{"data": "inas_nombrecgo"},
										{"data": "inas_codigocolaborador"},
										{"data": "inas_nombrecolaborador"},
										{"data": "inas_dni"},
										{"data": "inas_cargo_colaborador"},
										{"data": "inas_fechaoperacion"},
										{"data": "inas_horainicio"},
										{"data": "inas_horafin"},
										{"data": "inas_totalhoras"},
										{"data": "inas_bus"},
										{"data": "inas_operacion"},
										{"data": "inas_tabla"},
										{"data": "inas_servicio"},
										{"data": "inas_lugar_origen"},
										{"data": "inas_lugar_destino"},
										{"data": "inas_tiponovedad"},
										{"data": "inas_detallenovedad"},
										{"data": "inas_descripcion"},
										{"data": "inas_turno"},
										{"data": "inas_fechareportegdh"}';
				
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax 	= new CRUD();
				$Respuesta		= $InstanciaAjax->Permisos($this->Modulo,"btn_editar_inasistencias");
				if ($Respuesta=="SI"){	
					$columnashtml .= '	,{"defaultContent": "'.$defaultContent_1.'"}';
				}
									
				$columnashtml .= '  ]';	
            break;

			case "tablaTipoTablaInasistencias":
				$defaultContent_1 	= "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarTipoTablaInasistencias'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btnBorrarTipoTablaInasistencias'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '	[	{"data": "ttablainasistencias_id"},
										{"data": "ttablainasistencias_operacion"},
										{"data": "ttablainasistencias_tipo"},
										{"data": "ttablainasistencias_detalle"},
										{"defaultContent": "'.$defaultContent_1.'"}
									]';
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
				$botonesformulario	= '';
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
			case "formInasistencias":
				switch($NombreObjeto)
				{
					case "div_form_inasistencias":
						$readonly = "";
						$disabled = "";
						$btn_guardar_inasistencias = '<button type="submit" id="btn_guardar_inasistencias" class="btn btn-dark btn-sm btn_guardar_inasistencias">Guardar</button>';
						if($Dato!=""){
							$readonly = "readonly";
							$disabled = "disabled";
							$btn_guardar_inasistencias = "";
						}
						
						$Mostrar_div = '		<div class="modal-body">
													<div class="row align-items-end">
														<div class="col-lg-2">
														  	<div class="form-group">
																<label for="inasistencias_id" class="col-form-label form-control-sm">INASISTENCIAS ID</label>
																<input type="text" readonly class="form-control form-control-sm" id="inasistencias_id">
															</div> 
														</div>
														<div class="col-lg-3">
														  	<div class="form-group">
																<label for="inas_tiponovedad" class="col-form-label form-control-sm">TIPO NOVEDAD</label>
																<select class="form-control form-control-sm" id="inas_tiponovedad" '.$disabled.'>
																</select>
															</div> 
														</div>
													  	<div class="col-lg-2">
														  	<div class="form-group">
															  	<label for="inas_fechaoperacion" class="col-form-label form-control-sm">FECHA</label>
															  	<input type="date" '.$readonly.' class="form-control form-control-sm" id="inas_fechaoperacion" placeholder="dd/mm/aaaaa">
															</div>
													  	</div>
													  	<div class="col-lg-5">
														  	<div class="form-group">
															  	<label for="inas_nombrecolaborador" class="col-form-label form-control-sm">NOMBRE DE PILOTO</label>
															  	<select class="form-control form-control-sm" id="inas_nombrecolaborador" '.$disabled.'>
															  	</select>
															</div> 
														</div>
						  							</div>
						  							<div class="row align-items-end">
							  							<div class="col-lg-12">
									   						<div class="form-group shadow-textarea">
																<label for="inas_descripcion" class="col-form-label form-control-sm">DESCRIPCION NOVEDAD (Máximo 1500 carácteres)</label>
																<textarea '.$readonly.' class="form-control z-depth-1 form-control-sm text-uppercase" id="inas_descripcion" rows="3" placeholder="escribe algo aqui..." maxlength="1500"></textarea>
															</div>
														</div>
													</div>
						  							<div class="row align-items-end">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inas_tabla" class="col-form-label form-control-sm">TABLA</label>
																<select class="form-control form-control-sm" id="inas_tabla" '.$disabled.'>
																</select>
															</div> 
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inas_servicio" class="col-form-label form-control-sm">SERVICIO</label>
																<input readonly class="form-control form-control-sm" id="inas_servicio">
															</div> 
														</div>	
														<div class="col-lg-2">    
															<div class="form-group">
																<label for="inas_bus" class="col-form-label form-control-sm">BUS</label>
																<select class="form-control form-control-sm" id="inas_bus" '.$disabled.'>
																</select>
															</div>            
														</div>
														<div class="col-lg-5">
															<div class="form-group">
																<label for="inas_nombrecgo" class="col-form-label form-control-sm">PERSONAL QUE REPORTA</label>
																<select class="form-control form-control-sm" id="inas_nombrecgo" disabled>
																</select>
															</div> 
														</div>
						  							</div>
						  							<div class="row align-items-end">
														<div class="col-lg-6">
															<div class="form-group">
																<label for="inas_lugarexacto" class="col-form-label form-control-sm">LUGAR EXACTO / ESTACION O PAREDERO DE REFERENCIA</label>
																<input '.$readonly.' type="text" class="form-control form-control-sm text-uppercase" id="inas_lugarexacto">
															</div> 
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inas_lugar_origen" class="col-form-label form-control-sm">LUGAR ORIGEN</label>
																<select '.$readonly.' name="inas_lugar_origen" class="form-control form-control-sm" id="inas_lugar_origen">
																</select>
															</div> 
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inas_lugar_destino" class="col-form-label form-control-sm">LUGAR DESTINO</label>
																<select '.$readonly.' name="inas_lugar_destino" class="form-control form-control-sm" id="inas_lugar_destino">
																</select>
															</div> 
														</div>
						  							</div>
						  							<div class="row align-items-end" id="div_reporte_gdh">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="" class="col-form-label form-control-sm">H. INICIO</label>
																<div class="input-group">
																	<input '.$readonly.' type="text" name="horainicio" class="form-control form-control-sm col-lg-4" id="horainicio" title="Hora ente 1 y 30" 							maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 							1 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
																	<label class="form-control form-control-sm col-lg-1">:</label>
																	<input '.$readonly.' type="text" name="minutoinicio" class="form-control form-control-sm col-lg-4" id="minutoinicio" title="Minutos entre 0 y 59"  							maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 							0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
																</div>
															</div> 
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="" class="col-form-label form-control-sm">H. FIN</label>
																<div class="input-group">
																	<input '.$readonly.' type="text" name="horafin" class="form-control form-control-sm col-lg-4" id="horafin" title="Hora ente 1 y 30" maxlength="2"  							onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 1 ) || ( 							parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
																	<label class="form-control form-control-sm col-lg-1">:</label>
																	<input '.$readonly.' type="text" name="minutofin" class="form-control form-control-sm col-lg-4" id="minutofin" title="Minutos entre 0 y 59"  							maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 							0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
																</div>
															</div> 
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inas_totalhoras" class="col-form-label form-control-sm">TOTAL HORAS</label>
																<input '.$readonly.' type="time" class="form-control form-control-sm" id="inas_totalhoras">
															</div> 
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inas_detallenovedad" class="col-form-label form-control-sm">DETALLE NOVEDAD</label>
																<select class="form-control form-control-sm" id="inas_detallenovedad" '.$disabled.'>
																</select>
															</div> 
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inas_estadoinasistencias" class="col-form-label form-control-sm">ESTADO</label>
																<select class="form-control form-control-sm" id="inas_estadoinasistencias" '.$disabled.'>
																</select>
															</div>
														</div>
						  							</div>
						  							<div class="row align-items-end">
														<div class="col-lg-1">
															<div class="form-group">
																<button type="button" id="btn_log_inasistencias btn-sm" class="btn btn-info btn_log_inasistencias btn-sm">LOG...</button>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inas_obs_log" class="col-form-label form-control-sm">OBSERVACIONES LOG</label>
																<input '.$readonly.' type="text" class="form-control form-control-sm text-uppercase" id="inas_obs_log">
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inas_usuarioid_edicion" class="col-form-label form-control-sm">PERSONAL QUE SUSCRIBE LA INFORMACION</label>
																<input type="text" readonly class="form-control form-control-sm" id="inas_usuarioid_edicion">
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inas_fechaedicion" class="col-form-label form-control-sm">FECHA Y HORA DE ELABORACION</label>
																<input type="text" readonly class="form-control form-control-sm" id="inas_fechaedicion">
															</div>
														</div>
						  							</div>
					  							</div>
												<div class="modal-footer">
												  	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
													'.$btn_guardar_inasistencias.'
					  							</div>';
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

			case "form_inasistencias_editar":
				switch($NombreObjeto)
				{
					case "div_form_inasistencias_editar":
						$btn_guardar_inasistencias_editar = '<button type="submit" id="btn_guardar_inasistencias_editar" class="btn btn-dark btn-sm btn_guardar_inasistencias_editar">Guardar</button>';
						$Mostrar_div = '		<div class="modal-body">
													<div class="row align-items-end">
														<div class="col-lg-2">
														  	<div class="form-group">
																<label for="inasistencias_id" class="col-form-label form-control-sm">INASISTENCIAS ID</label>
																<input type="text" readonly class="form-control form-control-sm" id="inasistencias_id">
															</div> 
														</div>
														<div class="col-lg-3">
														  	<div class="form-group">
																<label for="inas_tiponovedad" class="col-form-label form-control-sm">TIPO NOVEDAD</label>
																<select class="form-control form-control-sm" id="inas_tiponovedad">
																</select>
															</div> 
														</div>
													  	<div class="col-lg-2">
														  	<div class="form-group">
															  	<label for="inas_fechaoperacion" class="col-form-label form-control-sm">FECHA</label>
															  	<input type="date" class="form-control form-control-sm" id="inas_fechaoperacion" placeholder="dd/mm/aaaaa">
															</div>
													  	</div>
													  	<div class="col-lg-5">
														  	<div class="form-group">
															  	<label for="inas_nombrecolaborador" class="col-form-label form-control-sm">NOMBRE DE PILOTO</label>
															  	<select class="form-control form-control-sm" id="inas_nombrecolaborador">
															  	</select>
															</div> 
														</div>
						  							</div>
						  							<div class="row align-items-end">
							  							<div class="col-lg-12">
									   						<div class="form-group shadow-textarea">
																<label for="inas_descripcion" class="col-form-label form-control-sm">DESCRIPCION NOVEDAD (Máximo 1500 carácteres)</label>
																<textarea class="form-control z-depth-1 form-control-sm text-uppercase" id="inas_descripcion" rows="3" placeholder="escribe algo aqui..." maxlength="1500"></textarea>
															</div>
														</div>
													</div>
						  							<div class="row align-items-end">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inas_tabla" class="col-form-label form-control-sm">TABLA</label>
																<select class="form-control form-control-sm" id="inas_tabla">
																</select>
															</div> 
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inas_servicio" class="col-form-label form-control-sm">SERVICIO</label>
																<input readonly class="form-control form-control-sm" id="inas_servicio">
															</div> 
														</div>	
														<div class="col-lg-2">    
															<div class="form-group">
																<label for="inas_bus" class="col-form-label form-control-sm">BUS</label>
																<select class="form-control form-control-sm" id="inas_bus">
																</select>
															</div>            
														</div>
														<div class="col-lg-5">
															<div class="form-group">
																<label for="inas_nombrecgo" class="col-form-label form-control-sm">PERSONAL QUE REPORTA</label>
																<select class="form-control form-control-sm" id="inas_nombrecgo" disabled>
																</select>
															</div> 
														</div>
						  							</div>
						  							<div class="row align-items-end">
														<div class="col-lg-6">
															<div class="form-group">
																<label for="inas_lugarexacto" class="col-form-label form-control-sm">LUGAR EXACTO / ESTACION O PAREDERO DE REFERENCIA</label>
																<input type="text" class="form-control form-control-sm text-uppercase" id="inas_lugarexacto">
															</div> 
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inas_lugar_origen" class="col-form-label form-control-sm">LUGAR ORIGEN</label>
																<select name="inas_lugar_origen" class="form-control form-control-sm" id="inas_lugar_origen">
																</select>
															</div> 
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inas_lugar_destino" class="col-form-label form-control-sm">LUGAR DESTINO</label>
																<select name="inas_lugar_destino" class="form-control form-control-sm" id="inas_lugar_destino">
																</select>
															</div> 
														</div>
						  							</div>
						  							<div class="row align-items-end" id="div_reporte_gdh">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="" class="col-form-label form-control-sm">H. INICIO</label>
																<div class="input-group">
																	<input type="text" name="horainicio" class="form-control form-control-sm col-lg-4" id="horainicio" title="Hora ente 1 y 30" 							maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 							1 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
																	<label class="form-control form-control-sm col-lg-1">:</label>
																	<input type="text" name="minutoinicio" class="form-control form-control-sm col-lg-4" id="minutoinicio" title="Minutos entre 0 y 59"  							maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 							0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
																</div>
															</div> 
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="" class="col-form-label form-control-sm">H. FIN</label>
																<div class="input-group">
																	<input type="text" name="horafin" class="form-control form-control-sm col-lg-4" id="horafin" title="Hora ente 1 y 30" maxlength="2"  							onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 1 ) || ( 							parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
																	<label class="form-control form-control-sm col-lg-1">:</label>
																	<input type="text" name="minutofin" class="form-control form-control-sm col-lg-4" id="minutofin" title="Minutos entre 0 y 59"  							maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 							0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
																</div>
															</div> 
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inas_totalhoras" class="col-form-label form-control-sm">TOTAL HORAS</label>
																<input type="time" class="form-control form-control-sm" id="inas_totalhoras">
															</div> 
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inas_detallenovedad" class="col-form-label form-control-sm">DETALLE NOVEDAD</label>
																<select class="form-control form-control-sm" id="inas_detallenovedad">
																</select>
															</div> 
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inas_estadoinasistencias" class="col-form-label form-control-sm">ESTADO</label>
																<select class="form-control form-control-sm" id="inas_estadoinasistencias">
																</select>
															</div>
														</div>
						  							</div>
						  							<div class="row align-items-end">
														<div class="col-lg-1">
															<div class="form-group">
																<button type="button" id="btn_log_inasistencias_editar btn-sm" class="btn btn-info btn_log_inasistencias_editar btn-sm">LOG...</button>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inas_obs_log" class="col-form-label form-control-sm">OBSERVACIONES LOG</label>
																<input type="text" class="form-control form-control-sm text-uppercase" id="inas_obs_log">
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inas_usuarioid_edicion" class="col-form-label form-control-sm">PERSONAL QUE SUSCRIBE LA INFORMACION</label>
																<input type="text" readonly class="form-control form-control-sm" id="inas_usuarioid_edicion">
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inas_fechaedicion" class="col-form-label form-control-sm">FECHA Y HORA DE ELABORACION</label>
																<input type="text" readonly class="form-control form-control-sm" id="inas_fechaedicion">
															</div>
														</div>
						  							</div>
					  							</div>
												<div class="modal-footer">
												  	<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
													'.$btn_guardar_inasistencias_editar.'
					  							</div>';
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