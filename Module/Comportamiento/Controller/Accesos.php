<?php
class Accesos
{
	var $Modulo="Comportamiento";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-Comportamiento":
				$tabshtml = '	<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Listado</a>
								<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Reporte Final</a>';
								MModel($this->Modulo, 'CRUD');
								$InstanciaAjax= new CRUD();
								$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-ajustes_comportamiento-tab');
								if ($Respuesta=="SI"){
									$tabshtml .= '<a class="nav-item nav-link" id="nav-ajustes_comportamiento-tab" data-toggle="tab" href="#nav-ajustes_comportamiento" role="tab" aria-controls="nav-ajustes_comportamiento" aria-selected="false">Ajustes</a>';
								}
			break;
		}
		//<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Telemetría</a>//
		echo $tabshtml;
	}
	
    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
		$tablahtml = "";
        switch ($NombreTabla) 
		{
            case "tablaComportamiento":
                $tablahtml = '	<table id="tablaComportamiento" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
				   						<tr>
											<th>ID PROG.</th>
											<th>ID NOVEDAD</th>
											<th>FECHA</th>
											<th>USUARIO QUE GENERA</th>
											<th>OPERACION</th>
											<th>ORIGEN</th>
											<th>TIPO NOVEDAD</th>
											<th>DETALLE NOVEDAD</th>
											<th>APELLIDOS Y NOMBRES</th>
											<th>BUS</th>
											<th>EST. NOVEDAD</th>
											<th>REPO.FACI.</th>
											<th>COMPORTAMIENTO</th>   
											<th>ID COMPORTAM.</th>
											<th>EST. COMPORT.</th>
				 						</tr>
									</thead>
									<tbody>                           
									</tbody>
		   						</table>';
            break;

            case "tablaTelemetriaCarga":
                $tablahtml = '	<table id="tablaTelemetriaCarga" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
										<tr>
											<th>CARGA ID</th>
											<th>FECHA OPERACION</th>
											<th>CANT. REGISTROS</th>
											<th>FECHA CARGA</th>
											<th>USUARIO CARGA</th>
											<th>ACCIONES</th> 
										</tr>
				   					</thead>
				   					<tbody>
				   					</tbody>
			  					</table>';
            break;

			case "tablaReportegdh":
				$tablahtml = '	<table id="tablaReportegdh" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
				   						<tr>
											<th>ID COMP.</th>
											<th>ESTADO</th>
											<th>NOMBRE CGO</th>
											<th>FECHA</th>
											<th>DNI PILOTO</th>
											<th>COD. PILOTO</th>
											<th>NOMBRE PILOTO</th>
											<th>BUS</th>
											<th>TIPO PILOTO</th>
											<th>TABLA</th>
											<th>SERVICIO</th>
											<th>DETALLE NOV.</th>   
											<th>DESCRIPCION NOV.</th>
											<th>ACCION DISCIPLINARIA</th>
											<th>COD. FALTA</th>
											<th>MONTO</th>
											<th>RECON.RESP.</th>
											<th>AFECTA PREMIO</th>
											<th>TIPO DISCIPLINA</th>
											<th>OBSERVACION</th>
					 						<th>FECHA CARGA</th>
											<th>ORIGEN</th>';
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax 	= new CRUD();
				$Respuesta		= $InstanciaAjax->Permisos($this->Modulo,"btn_editar_comportamiento");
				if ($Respuesta=="SI"){
					$tablahtml .= '			<th>ACCIONES</th>';
				}
				$tablahtml .= '			</tr>
									</thead>
									<tbody>             
									</tbody>
		   						</table>';
			break;

			case "tablaTipoTablaComportamiento":
				$tablahtml = ' 	<table id="tablaTipoTablaComportamiento" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>TIPO</th>
											<th>OPERACION</th>
											<th>DETALLE</th>
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
            case "tablaComportamiento":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='R.Facilitador' class='btn btn-info btn-sm btnReporteFacilitador'><i class='bi bi-clipboard-plus'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-clipboard-plus' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z'/><path d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z'/><path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/></svg></i></button></div></div>";
				$defaultContent2 = "<div class='text-center'><div class='btn-group'><button title='I.Comportamiento' class='btn btn-warning btn-sm btnComportamiento'><i class='bi bi-clipboard-plus'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-clipboard-plus' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z'/><path d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z'/><path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "Nove_ProgramacionId"},
									{"data": "Novedad_Id"},
									{"data": "Nove_FechaOperacion"},
									{"data": "UsuarioGenera"},
									{"data": "Nove_Operacion"},
									{"data": "Nove_TipoOrigen"},
									{"data": "Nove_TipoNovedad"},
									{"data": "Nove_DetalleNovedad"},
									{"data": "Nove_NombreColaborador"},
									{"data": "Nove_Bus"},
									{"data": "Nove_Estado"},
									{"defaultContent": " '.$defaultContent1.' "},
									{"defaultContent": " '.$defaultContent2.' "},
									{"data": "comportamiento_id"},
									{"data": "comp_estadocomportamiento"}
				  				]';
			break;

			case "tablaTelemetriaCarga":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Eliminar' class='btn btn-danger btn-sm btnBorrarTelemetriaCarga'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "telemetriacarga_id"},
									{"data": "tlmtcarga_fechaoperacion"},
									{"data": "tlmtcarga_nroregistros"},
									{"data": "tlmtcarga_fechacarga"},
									{"data": "UsuarioGenera"},
									{"defaultContent": " '.$defaultContent1.'"}
				  				]';
            break;

			case "tablaReportegdh":
				$defaultContent_1 = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_comportamiento'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '	[	{"data": "comportamiento_id"},
										{"data": "comp_estadocomportamiento"},
										{"data": "comp_nombrecgo"},
										{"data": "comp_fechaoperacion"},
										{"data": "comp_dni"},
										{"data": "comp_codigocolaborador"},
										{"data": "comp_nombrecolaborador"},
										{"data": "comp_bus"},
										{"data": "comp_cargo_colaborador"},
										{"data": "comp_tabla"},
										{"data": "comp_servicio"},
										{"data": "comp_detallenovedad"},
										{"data": "comp_descripcion"},
										{"data": "comp_faltacometida"},
										{"data": "comp_codigofalta"},
										{"data": "comp_monto"},
										{"data": "comp_reconoceresponsabilidad"},
										{"data": "comp_afectapremio"},
										{"data": "comp_tipodisciplina"},
										{"data": "comp_observaciones"},
										{"data": "comp_fechareportegdh"},
										{"data": "comp_tipoorigen"}';
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax 	= new CRUD();
				$Respuesta		= $InstanciaAjax->Permisos($this->Modulo,"btn_editar_comportamiento");
				if ($Respuesta=="SI"){
					$columnashtml .= '	,{"defaultContent": "'.$defaultContent_1.'"}';
				}
									
				$columnashtml .= '  ]';	
					
			break;

			case "tablaTipoTablaComportamiento":
				$defaultContent_1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarTipoTablaComportamiento'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btnBorrarTipoTablaComportamiento'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '	[	{"data": "TtablaComportamiento_Id"},
										{"data": "TtablaComportamiento_Tipo"},
										{"data": "TtablaComportamiento_Operacion"},
										{"data": "TtablaComportamiento_Detalle"},
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
			case "formComportamiento":
				switch($NombreObjeto)
				{
					case "div_FaltaCometida":
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax = new CRUD();
						$divformulario = $InstanciaAjax->Permisos($this->Modulo,$NombreObjeto);
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
			case "formComportamiento":
				switch($NombreObjeto)
				{
					case "div_form_comportamiento":
						$readonly = "";
						$disabled = "";
						$btn_guardar_comportamiento = '<button type="submit" id="btn_guardar_comportamiento" class="btn btn-dark btn-sm btn_guardar_comportamiento">Guardar</button>';
						if($Dato!=""){
							$readonly = "readonly";
							$disabled = "disabled";
							$btn_guardar_inasistencias = "";
						}
						
						$Mostrar_div = '	
											<div class="modal-body">
												<div class="row align-items-end">
													<div class="col-lg-2">
													  	<div class="form-group">
															<label for="comportamiento_id" class="col-form-label form-control-sm">COMPORTAMIENT.ID</label>
														  	<input type="text" readonly class="form-control form-control-sm" id="comportamiento_id">
														</div> 
													</div>
													<div class="col-lg-3">
														<div class="form-group">
														  	<label for="comp_tiponovedad" class="col-form-label form-control-sm">TIPO NOVEDAD</label>
														  	<select class="form-control form-control-sm" id="comp_tiponovedad" '.$disabled.'>
															</select>	
														</div> 
													</div>
												  	<div class="col-lg-2">
													  	<div class="form-group">
														  	<label for="comp_fechaoperacion" class="col-form-label form-control-sm">FECHA</label>
														  	<input '.$readonly.' type="date" class="form-control form-control-sm" id="comp_fechaoperacion">
														</div>
												  	</div>
												  	<div class="col-lg-5">
													  	<div class="form-group">
														  	<label for="comp_nombrecolaborador" class="col-form-label form-control-sm">NOMBRE DE PILOTO</label>
														  	<select class="form-control form-control-sm" id="comp_nombrecolaborador" '.$disabled.'>
														  	</select>
														</div> 
													</div>
											  	</div>
											  	<div class="row align-items-end">
												  	<div class="col-lg-12">
														<div class="form-group shadow-textarea">
															<label for="comp_descripcion" class="col-form-label form-control-sm">DESCRIPCION DE NOVEDAD</label>
															<textarea '.$readonly.' class="form-control z-depth-1 form-control-sm" id="comp_descripcion" rows="3"></textarea>
														</div>
													</div>
												</div>
											  	<div class="row align-items-end">
												  	<div class="col-lg-2">
														<div class="form-group">
														  	<label for="comp_tabla" class="col-form-label form-control-sm">TABLA</label>
														  	<select class="form-control form-control-sm" id="comp_tabla" '.$disabled.'>

														  	</select>
														</div> 
													</div>
													<div class="col-lg-3">
														<div class="form-group">
														  	<label for="comp_servicio" class="col-form-label form-control-sm">SERVICIO</label>
														  	<input '.$readonly.' type="text" readonly class="form-control form-control-sm" id="comp_servicio">
														</div> 
													</div>	
												  	<div class="col-lg-2">    
														<div class="form-group">
															<label for="" class="col-form-label form-control-sm">BUS</label>
														  	<select class="form-control form-control-sm" id="comp_bus" '.$disabled.'>
															</select>
														</div>            
													</div>
													<div class="col-lg-5">
													  	<div class="form-group">
														  	<label for="comp_nombrecgo" class="col-form-label form-control-sm">PERSONAL QUE REPORTA</label>
														  	<input '.$readonly.' type="text" readonly class="form-control form-control-sm" id="comp_nombrecgo">
														</div> 
													</div>
											  	</div>
											  	<div class="row align-items-end">
												  	<div class="col-lg-6">
													  	<div class="form-group">
														  	<label for="comp_lugarexacto" class="col-form-label form-control-sm">LUGAR EXACTO / ESTACION O PRADERO DE REFERENCIA</label>
														  	<input '.$readonly.' type="text" class="form-control form-control-sm" id="comp_lugarexacto">
														</div> 
													</div>
												  	<div class="col-lg-3">
													  	<div class="form-group">
														  	<label for="comp_lugar_origen" class="col-form-label form-control-sm">LUGAR ORIGEN</label>
														  	<select name="comp_lugar_origen" class="form-control form-control-sm" id="comp_lugar_origen" '.$disabled.'>
														  	</select>
													  	</div> 
												  	</div>
												  	<div class="col-lg-3">
													  	<div class="form-group">
														  	<label for="comp_lugar_destino" class="col-form-label form-control-sm">LUGAR DESTINO</label>
														  	<select name="comp_lugar_destino" class="form-control form-control-sm" id="comp_lugar_destino" '.$disabled.'>
														  	</select>
													  	</div> 
												  	</div>
											  	</div>
											  	<div class="row align-items-end">
												  	<div class="col-lg-2">
													  	<div class="form-group">
														  	<label for="" class="col-form-label form-control-sm">HORA INICIO</label>
														  	<div class="input-group">
															  	<input '.$readonly.' type="text" name="horainicio" class="form-control form-control-sm col-lg-4" id="horainicio" title="Hora ente 1 y 30" 							maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 							1 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
															  	<label class="form-control form-control-sm col-lg-1">:</label>
															  	<input '.$readonly.' type="text" name="minutoinicio" class="form-control form-control-sm col-lg-4" id="minutoinicio" title="Minutos entre 0 y 59"  							maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 							0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
														  	</div>
													  	</div> 
												  	</div>
												  	<div class="col-lg-2">
														<div class="form-group">
														  	<label for="" class="col-form-label form-control-sm">HORA FIN</label>
														  	<div class="input-group">
															  	<input '.$readonly.' type="text" name="horafin" class="form-control form-control-sm col-lg-4" id="horafin" title="Hora ente 1 y 30" maxlength="2"  							onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 1 ) || ( 							parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
															  	<label class="form-control form-control-sm col-lg-1">:</label>
															  	<input '.$readonly.' type="text" name="minutofin" class="form-control form-control-sm col-lg-4" id="minutofin" title="Minutos entre 0 y 59"  							maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 							0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
														  	</div>
													  	</div> 
												  	</div>
												  	<div class="col-lg-2">
														<div class="form-group">
														  	<label for="comp_total_horas" class="col-form-label form-control-sm">TOTAL HORAS</label>
														  	<input '.$readonly.' type="time" class="form-control form-control-sm" id="comp_total_horas">
													  	</div> 
												  	</div>
												  	<div class="col-lg-3">
													  	<div class="form-group">
														  	<label for="comp_detallenovedad" class="col-form-label form-control-sm">DETALLE NOVEDAD</label>
														  	<select class="form-control form-control-sm" id="comp_detallenovedad" '.$disabled.'>

														  	</select>
														</div> 
													</div>
													<div class="col-lg-3">
													  <div class="form-group">
														  	<label for="comp_estadocomportamiento" class="col-form-label form-control-sm">ESTADO</label>
														  	<select class="form-control form-control-sm" id="comp_estadocomportamiento" '.$disabled.'>

														  	</select>
														</div> 
													</div>
											  	</div>
											  	<div class="row align-items-end" id="div_FaltaCometida">
												  	<div class="col-lg-2">
													  	<div class="form-group">
														  	<label for="comp_manto" class="col-form-label form-control-sm">MONTO S/.</label>
														  	<input '.$readonly.' type="text" class="form-control form-control-sm" id="comp_monto">
														</div> 
													</div>
												  	<div class="col-lg-2">
														<div class="form-group">
														  	<label for="comp_linkvideo" class="col-form-label form-control-sm">LINK VIDEO</label>
														  	<input '.$readonly.' type="text" class="form-control form-control-sm" id="comp_linkvideo">
														</div> 
													</div>
													<div class="col-lg-2">    
														<div class="form-group">
															<label for="comp_reconoceresponsabilidad" class="col-form-label form-control-sm">RECON.RESPONSAB</label>
														  	<select class="form-control form-control-sm" id="comp_reconoceresponsabilidad" '.$disabled.'>

														  	</select>
														</div>            
													</div>
													<div class="col-lg-2">    
														<div class="form-group">
															<label for="comp_grado_falta" class="col-form-label form-control-sm">GRADO FALTA</label>
														  	<select class="form-control form-control-sm" id="comp_grado_falta" '.$disabled.'>

														  	</select>
														</div>            
													</div>
													<div class="col-lg-2">    
														<div class="form-group">
															<label for="comp_codigofalta" class="col-form-label form-control-sm">CODIGO FALTA</label>
														  	<select class="form-control form-control-sm" id="comp_codigofalta" '.$disabled.'>

														  	</select>
														</div>            
													</div>
												</div>
											  	<div class="row align-items-end">
												  	<div class="col-lg-12">
														<div class="form-group shadow-textarea">
															<label for="comp_faltacometida" class="col-form-label form-control-sm">FALTA COMETIDA</label>
															<textarea readonly class="form-control z-depth-1 form-control-sm" id="comp_faltacometida" rows="3"></textarea>
														</div>
													</div>
												</div>
												<div class="row align-items-end">
												  	<div class="col-lg-1">
													  	<div class="form-group">
														  	<button type="button" id="btn_log_comportamiento btn-sm" class="btn btn-info btn_log_comportamiento btn-sm">LOG...</button>
													  	</div>
												  	</div>
												  	<div class="col-lg-4">
													  	<div class="form-group">
														  	<label for="comp_obs_log" class="col-form-label form-control-sm">OBSERVACIONES LOG</label>
														  	<input '.$readonly.' type="text" class="form-control form-control-sm text-uppercase" id="comp_obs_log">
													  	</div>
												  	</div>
												  	<div class="col-lg-4">
														<div class="form-group">
														  	<label for="comp_usuarioid_edicion" class="col-form-label form-control-sm">PERSONAL QUE SUSCRIBE INFORMACION</label>
														  	<input '.$readonly.' type="text" readonly class="form-control form-control-sm" id="comp_usuarioid_edicion">
														</div>
													</div>
												  	<div class="col-lg-3">
														<div class="form-group">
														 	<label for="comp_fechaedicion" class="col-form-label v">Fecha y Hora de Elaboración</label>
														  	<input '.$readonly.' type="text" readonly class="form-control form-control-sm" id="comp_fechaedicion">
														</div>
													</div>
											  	</div>
											</div>
											<div class="modal-footer">
											  	<button type="button" class="btn btn-light btn_sm" data-dismiss="modal">Cancelar</button>
											  	'.$btn_guardar_comportamiento.'
											<div>';
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

			case "form_comportamiento_editar":
				switch($NombreObjeto)
				{
					case "div_form_comportamiento_editar":
						$btn_guardar_comportamiento_editar = '<button type="submit" id="btn_guardar_comportamiento_editar" class="btn btn-dark btn-sm btn_guardar_comportamiento_editar">Guardar</button>';
						$Mostrar_div = '
											<div class="modal-body">
												<div class="row align-items-end">
													<div class="col-lg-2">
														<div class="form-group">
															<label for="comportamiento_id" class="col-form-label form-control-sm">COMPORTAMIENT.ID</label>
															<input type="text" readonly class="form-control form-control-sm" id="comportamiento_id">
														</div> 
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															  <label for="comp_tiponovedad" class="col-form-label form-control-sm">TIPO NOVEDAD</label>
															  <select class="form-control form-control-sm" id="comp_tiponovedad">
															</select>	
														</div> 
													</div>
													  <div class="col-lg-2">
														  <div class="form-group">
															  <label for="comp_fechaoperacion" class="col-form-label form-control-sm">FECHA</label>
															  <input type="date" class="form-control form-control-sm" id="comp_fechaoperacion">
														</div>
													  </div>
													  <div class="col-lg-5">
														  <div class="form-group">
															  <label for="comp_nombrecolaborador" class="col-form-label form-control-sm">NOMBRE DE PILOTO</label>
															  <select class="form-control form-control-sm" id="comp_nombrecolaborador">
															  </select>
														</div> 
													</div>
												</div>
												<div class="row align-items-end">
													<div class="col-lg-12">
														<div class="form-group shadow-textarea">
															<label for="comp_descripcion" class="col-form-label form-control-sm">DESCRIPCION DE NOVEDAD</label>
															<textarea class="form-control z-depth-1 form-control-sm" id="comp_descripcion" rows="3"></textarea>
														</div>
													</div>
												</div>
												<div class="row align-items-end">
													<div class="col-lg-2">
														<div class="form-group">
															<label for="comp_tabla" class="col-form-label form-control-sm">TABLA</label>
															<select class="form-control form-control-sm" id="comp_tabla">
															</select>
														</div> 
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<label for="comp_servicio" class="col-form-label form-control-sm">SERVICIO</label>
															<input type="text" readonly class="form-control form-control-sm" id="comp_servicio">
														</div> 
													</div>	
													  <div class="col-lg-2">    
														<div class="form-group">
															<label for="" class="col-form-label form-control-sm">BUS</label>
															<select class="form-control form-control-sm" id="comp_bus">
															</select>
														</div>            
													</div>
													<div class="col-lg-5">
														<div class="form-group">
															<label for="comp_nombrecgo" class="col-form-label form-control-sm">PERSONAL QUE REPORTA</label>
															<input type="text" readonly class="form-control form-control-sm" id="comp_nombrecgo">
														</div> 
													</div>
												</div>
												<div class="row align-items-end">
													<div class="col-lg-6">
														<div class="form-group">
															<label for="comp_lugarexacto" class="col-form-label form-control-sm">LUGAR EXACTO / ESTACION O PRADERO DE REFERENCIA</label>
															<input type="text" class="form-control form-control-sm" id="comp_lugarexacto">
														</div> 
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<label for="comp_lugar_origen" class="col-form-label form-control-sm">LUGAR ORIGEN</label>
															<select name="comp_lugar_origen" class="form-control form-control-sm" id="comp_lugar_origen">
															</select>
														</div> 
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<label for="comp_lugar_destino" class="col-form-label form-control-sm">LUGAR DESTINO</label>
															<select name="comp_lugar_destino" class="form-control form-control-sm" id="comp_lugar_destino">
															</select>
														</div> 
													</div>
												</div>
												<div class="row align-items-end">
													<div class="col-lg-2">
														<div class="form-group">
															<label for="" class="col-form-label form-control-sm">HORA INICIO</label>
															<div class="input-group">
																<input type="text" name="horainicio" class="form-control form-control-sm col-lg-4" id="horainicio" title="Hora ente 1 y 30" 							maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 							1 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
																<label class="form-control form-control-sm col-lg-1">:</label>
																<input type="text" name="minutoinicio" class="form-control form-control-sm col-lg-4" id="minutoinicio" title="Minutos entre 0 y 59"  							maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 							0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
															</div>
														</div> 
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<label for="" class="col-form-label form-control-sm">HORA FIN</label>
															<div class="input-group">
																<input type="text" name="horafin" class="form-control form-control-sm col-lg-4" id="horafin" title="Hora ente 1 y 30" maxlength="2"  							onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 1 ) || ( 							parseInt(value + String.fromCharCode(event.keyCode)) > 30) ) return false;">
																<label class="form-control form-control-sm col-lg-1">:</label>
																<input type="text" name="minutofin" class="form-control form-control-sm col-lg-4" id="minutofin" title="Minutos entre 0 y 59"  							maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) ) || ( parseInt(value + String.fromCharCode(event.keyCode)) < 							0 ) || ( parseInt(value + String.fromCharCode(event.keyCode)) > 59) ) return false;">
															</div>
														</div> 
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<label for="comp_total_horas" class="col-form-label form-control-sm">TOTAL HORAS</label>
															<input type="time" class="form-control form-control-sm" id="comp_total_horas">
														</div> 
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<label for="comp_detallenovedad" class="col-form-label form-control-sm">DETALLE NOVEDAD</label>
															<select class="form-control form-control-sm" id="comp_detallenovedad">
															</select>
														</div> 
													</div>
													<div class="col-lg-3">
													  	<div class="form-group">
															<label for="comp_estadocomportamiento" class="col-form-label form-control-sm">ESTADO</label>
															<select class="form-control form-control-sm" id="comp_estadocomportamiento">
															</select>
														</div> 
													</div>
												</div>
						  						<div class="row align-items-end" id="div_FaltaCometida">
												  	<div class="col-lg-2">
													  	<div class="form-group">
														  	<label for="comp_manto" class="col-form-label form-control-sm">MONTO S/.</label>
														  	<input type="text" class="form-control form-control-sm" id="comp_monto">
														</div> 
													</div>
												  	<div class="col-lg-2">
														<div class="form-group">
														  	<label for="comp_linkvideo" class="col-form-label form-control-sm">LINK VIDEO</label>
														  	<input type="text" class="form-control form-control-sm" id="comp_linkvideo">
														</div> 
													</div>
													<div class="col-lg-2">    
														<div class="form-group">
															<label for="comp_reconoceresponsabilidad" class="col-form-label form-control-sm">RECON.RESPONSAB</label>
														  	<select class="form-control form-control-sm" id="comp_reconoceresponsabilidad">

														  	</select>
														</div>            
													</div>
													<div class="col-lg-2">    
														<div class="form-group">
															<label for="comp_grado_falta" class="col-form-label form-control-sm">GRADO FALTA</label>
														  	<select class="form-control form-control-sm" id="comp_grado_falta">

														  	</select>
														</div>            
													</div>
													<div class="col-lg-2">    
														<div class="form-group">
															<label for="comp_codigofalta" class="col-form-label form-control-sm">CODIGO FALTA</label>
														  	<select class="form-control form-control-sm" id="comp_codigofalta">

														  	</select>
														</div>            
													</div>
												</div>
											  	<div class="row align-items-end">
												  	<div class="col-lg-12">
														<div class="form-group shadow-textarea">
															<label for="comp_faltacometida" class="col-form-label form-control-sm">FALTA COMETIDA</label>
															<textarea readonly class="form-control z-depth-1 form-control-sm" id="comp_faltacometida" rows="3"></textarea>
														</div>
													</div>
												</div>
						  						<div class="row align-items-end">
												  	<div class="col-lg-1">
													  	<div class="form-group">
														  	<button type="button" id="btn_log_comportamiento_editar btn-sm" class="btn btn-info btn_log_comportamiento_editar btn-sm">LOG...</button>
													  	</div>
												  	</div>
												  	<div class="col-lg-4">
													  	<div class="form-group">
														  	<label for="comp_obs_log" class="col-form-label form-control-sm">OBSERVACIONES LOG</label>
														  	<input type="text" class="form-control form-control-sm text-uppercase" id="comp_obs_log">
													  	</div>
												  	</div>
												  	<div class="col-lg-4">
														<div class="form-group">
														  	<label for="comp_usuarioid_edicion" class="col-form-label form-control-sm">PERSONAL QUE SUSCRIBE INFORMACION</label>
														  	<input type="text" readonly class="form-control form-control-sm" id="comp_usuarioid_edicion">
														</div>
													</div>
												  	<div class="col-lg-3">
														<div class="form-group">
														 	<label for="comp_fechaedicion" class="col-form-label v">Fecha y Hora de Elaboración</label>
														  	<input type="text" readonly class="form-control form-control-sm" id="comp_fechaedicion">
														</div>
													</div>
						  						</div>
											</div>
											<div class="modal-footer">
						  						<button type="button" class="btn btn-light btn_sm" data-dismiss="modal">Cancelar</button>
						  						'.$btn_guardar_comportamiento_editar.'
											<div>';
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