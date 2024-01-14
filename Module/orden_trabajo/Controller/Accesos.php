<?php
class Accesos
{
	var $Modulo="orden_trabajo";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-ot":
				$tabshtml = '	<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Listado</a>
								<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><span id="idProcesar">Procesar</span></a>
								<a class="nav-item nav-link" id="nav-cierre_semanal-tab" data-toggle="tab" href="#nav-cierre_semanal" role="tab" aria-controls="nav-cierre_semanal" aria-selected="false"><span id="id_cierre_semanal">Cierre Semanal</span></a>
								<a class="nav-item nav-link" id="nav-novedades-tab" data-toggle="tab" href="#nav-novedades" role="tab" aria-controls="nav-novedades" aria-selected="false"><span id="nav-id_novedades">Novedades</span></a> ';
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-ajustes_ot-tab');
				if ($Respuesta=="SI"){
					$tabshtml .= '<a class="nav-item nav-link" id="nav-ajustes_ot-tab" data-toggle="tab" href="#nav-ajustes_ot" role="tab" aria-controls="nav-ajustes_ot" aria-selected="false">Ajustes</a>';
				}
				
			break;

			case "nav-tab-ajustes_ot":
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-ajustes_ot_usuario-tab');
				if ($Respuesta=="SI"){
					$tabshtml = '	<a class="nav-item nav-link active" id="nav-ajustes_ot_usuario-tab" data-toggle="tab" href="#nav-ajustes_ot_usuario" role="tab" aria-controls="nav-ajustes_ot_usuario" aria-selected="true">Usuario</a>';
				}
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-ajustes_ot_sistema-tab');
				if ($Respuesta=="SI"){
					$tabshtml .= '	<a class="nav-item nav-link" id="nav-ajustes_ot_sistema-tab" data-toggle="tab" href="#nav-ajustes_ot_sistema" role="tab" aria-controls="nav-ajustes_ot_sistema" aria-selected="false">Sistema</a>';
				}
				$tabshtml .= '	<a class="nav-item nav-link" id="nav-ajustes_ot_origen-tab" data-toggle="tab" href="#nav-ajustes_ot_origen" role="tab" aria-controls="nav-ajustes_ot_origen" aria-selected="false">Origen</a>';
				$tabshtml .= '	<a class="nav-item nav-link" id="nav-ajustes_tecnico-tab" data-toggle="tab" href="#nav-ajustes_tecnico" role="tab" aria-controls="nav-ajustes_tecnico" aria-selected="false">Técnico</a>';
			break;

		}
		echo $tabshtml;
	}
	
    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
		$tablahtml = "";
        switch ($NombreTabla) 
		{
            case "tabla_ot":
                $tablahtml = '	<table id="tabla_ot" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>VER</th>
											<th>OT_ID</th>
											<th>ESTADO</th>
											<th>FECHA_APERTURA.</th>
											<th>CGM_GENERA</th>
											<th>BUS</th>
											<th>ORIGEN</th>
											<th>PROVEEDOR</th>
											<th>DESCRIPCION_ACTIVIDAD</th>
											<th>KILOMETRAJE</th>
											<th>VALES</th>
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

			case "tabla_novedades":
                $tablahtml = '	<table id="tabla_novedades" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
					   					<tr>
							  				<th>ID_NOVEDAD</th>
											<th>FECHA</th>
											<th>USUARIO_GENERA</th>
											<th>ORIGEN</th>
											<th>TIPO</th>
											<th>OPERACION</th>
											<th>BUS</th>
											<th>COMPONENTE</th>
											<th>POSICION<ith>
											<th>FALLA</th>
											<th>ACCION</th>
											<th>ACCION_ORDEN_TRABAJO</th>
											<th>COD.OT</th>
											<th>ESTADO_OT</th>
					   					</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>	';
            break;

			case "tabla_tc_ot_usuario":
                $tablahtml = '	<table id="tabla_tc_ot_usuario" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>CATEGORIA 1</th>
											<th>CATEGORIA 2</th>
											<th>CATEGORIA 3</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>';
            break;

			case "tabla_tc_ot_sistema":
                $tablahtml = '	<table id="tabla_tc_ot_sistema" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>CATEGORIA 1</th>
											<th>CATEGORIA 2</th>
											<th>CATEGORIA 3</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>';
            break;

			case "tabla_origen":
                $tablahtml = '	<table id="tabla_origen" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>ORIGEN</th>
											<th>TIPO O.T.</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>';
            break;

			case "tabla_tecnico":
                $tablahtml = '	<table id="tabla_tecnico" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>DNI</th>
											<th>NOMBRE_CORTO</th>
											<th>APELLIDOS_Y_NOMBRES</th>
											<th>RUC</th>
											<th>ASOCIADO</th>
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
            case "tabla_ot":
				$defaultContent0 = "<div class='text-center'><div class='btn-group'><button title='Ver OT' class='btn btn-sm btn_ver_ot'><i class='bi bi-search'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg></i></button></div></div>";
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_ot'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"defaultContent": " '.$defaultContent0.' "},
									{"data": "ot_id"},
									{"data": "ot_estado"},
									{"data": "ot_fecha"},
									{"data": "ot_cgm_genera"},
									{"data": "ot_bus"},
									{"data": "ot_origen"},
									{"data": "ot_proveedor"},
									{"data": "ot_actividad"},
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

			case "tabla_novedades":
				$columnashtml = '[	{"data": "id"},
                					{"data": "fecha"},
                					{"data": "nombres_usuario_genera"},
									{"data": "origen"},
                					{"data": "tipo_novedad"},
									{"data": "operacion"},
									{"data": "bus"},
                					{"data": "componente"},
									{"data": "posicion"},
									{"data": "falla"},
									{"data": "accion"},
									{"data": "ot_accion"},
									{"data": "ot_id"},
									{"data": "ot_estado"}
      							]';
            break;

			case "tabla_tc_ot_usuario":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_tc_ot_usuario'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_tc_ot_usuario'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "tc_ot_id"},
									{"data": "tc_categoria1"},
									{"data": "tc_categoria2"},
									{"data": "tc_categoria3"},
									{"defaultContent": " '.$defaultContent1.' "}
								]';
			break;

			case "tabla_tc_ot_sistema":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_tc_ot_sistema'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_tc_ot_sistema'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "tc_ot_id"},
									{"data": "tc_categoria1"},
									{"data": "tc_categoria2"},
									{"data": "tc_categoria3"},
									{"defaultContent": " '.$defaultContent1.' "}
								]';
			break;

			case "tabla_origen":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_origen'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button title='Borrar' class='btn btn-danger btn-sm btn_borrar_origen'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "ot_origen_id"},
									{"data": "or_nombre"},
									{"data": "or_tipo_ot"},
									{"defaultContent": " '.$defaultContent1.' "}
								]';
			break;

			case "tabla_tecnico":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_tecnico'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button title='Borrar' class='btn btn-danger btn-sm btn_borrar_tecnico'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "tecnico_asociado_id"},
									{"data": "ta_dni"},
									{"data": "ta_nombre_corto"},
									{"data": "ta_apellidos_nombres"},
									{"data": "ta_ruc"},
									{"data": "ta_razon_social"},
									{"defaultContent": " '.$defaultContent1.' "}
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
			case "form_seleccion_ot":
				switch($NombreObjeto)
				{
					case "div_btn_seleccion_ot_listado":
						$botonesformulario  = ' <button type="button" id="btn_buscar_ot"class="btn btn-secondary btn-sm btn_buscar_ot">Buscar</button> ';
						$botonesformulario .= ' <button type="button" id="btn_descargar_ot" class="btn btn-secondary btn-sm btn_descargar_ot">Descargar</button> ';
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
						$Respuesta		= $InstanciaAjax->buscar_estado("manto_ots", "ot_estado", "OBSERVADO");

						$divformulario = '	<h6 class="dropdown-header">
												Alertas OTs Observadas
											</h6>';
						
						foreach($Respuesta as $row){
							$divformulario .= '	<a class="dropdown-item d-flex align-items-center" href="javascript:f_editar_ot('.$row['ot_id'].')">
													<div class="mr-3">
														<div class="icon-circle bg-primary">
															<i class="fas fa-file-alt text-white"></i>
														</div>
													</div>	
													<div>
														<div class="font-weight-bold">'.substr($row['ot_tipo'],0,1).'-'.$row['ot_id'].'</div>
														<span class="small text-gray-500">'.$row['ot_fecha_registro'].' - '.$row['ot_bus'].' - '.$row['ot_proveedor'].'</span>
													</div>
												</a>';		
						}
					break;

				}
			break;
		}
		echo $divformulario;
    }

	public function MostrarDiv($NombreFormulario,$NombreObjeto,$Dato1,$Dato2)
	{
		$Mostrar_div = "";
		$color = "";
		switch($NombreFormulario)
		{
			case "form_procesar_ot":
				switch($NombreObjeto)
				{
					case "div_codigo_ot":
						$Mostrar_div = '<h4 class="font-weight-bold">N° '.$Dato1.'</h4>';
					break;

					case "div_ot_estadoactual":
						switch($Dato1)
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
						$Mostrar_div = '<label for="" class="form-control-sm pl-0 mb-0 text-'.$color.' font-weight-bold">ESTADO ACTUAL DE LA OT : '.$Dato1.'</label>';
					break;

					case "div_ot_ca":
						$Mostrar_div = '<label for="" class="form-control-sm pl-0 mb-0">CIERRE ADMINISTRATIVO POR '.$Dato1.'</label>';
					break;

					case "div_ot_date_ct":
						$Mostrar_div = '<label for="ot_data_ct" class="form-control-sm pl-0 mb-0">EL '.$Dato1.'</label>';
					break;

					case "btn_guardar_ot":
						$Mostrar_div  = ' <button type="button" id="btn_log_ot" class="btn btn-info btn-sm btn_log_ot">Log</button> ';
						$Mostrar_div .= ' <button type="button" id="btn_procesar_imprimir_ot" title="Imprimir" class="btn btn-secondary btn-sm btn_procesar_imprimir_ot"><i class="bi bi-printer-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16"><path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"/><path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/></svg></i></button> ';
						$Mostrar_div .= ' <button type="button" id="btn_cancelar_ot" class="btn btn-light btn-sm form-control-sm mb-1 btn_cancelar_ot">Cancelar</button> ';
						if($Dato1!=='CERRADO'){
							$Mostrar_div .= ' <button type="button" id="btn_guardar_ot" class="btn btn-dark btn-sm form-control-sm mb-1 btn_guardar_ot">Guardar</button> ';
						}
					break;

				}
			break;

			case "form_seleccion_cierre_semanal":
				switch($NombreObjeto)
				{
					case "btn_cierre_semanal":
						$Mostrar_div = '<button type="button" id="btn_buscar_cierre_semanal" class="btn btn-secondary btn-sm mr-1 btn_buscar_cierre_semanal">Buscar</button>';
						switch($Dato1)
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
						$Respuesta	= $InstanciaAjax->BuscarDataBD("Modulo", "Mod_Nombre", $Dato1 );
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

			case "form_seleccion_novedades":
				switch($NombreObjeto)
				{
					case "btn_seleccion_novedades":
						$Mostrar_div  = '<button type="button" id="btn_buscar_novedades" class="btn btn-secondary btn-sm btn_buscar_novedades ml-1">Buscar</button>';
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btn_generar_novedad_regular');
						if ($Respuesta=="SI"){
							$Mostrar_div .= '<button type="button" id="btn_generar_novedad_regular" class="btn btn-secondary btn-sm btn_generar_novedad_regular ml-1">+ Novedad</button>';
						}
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btn_codificar');
						if ($Respuesta=="SI" && $Dato1=="" && $Dato2==""){
							$Mostrar_div .= '<button type="button" id="btn_codificar" title="Arborizar" class="btn btn-secondary btn-sm btn_codificar ml-1"><i class="bi bi-diagram-3-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-diagram-3-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5zm-6 8A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5zm6 0A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5zm6 0a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5z"/></svg></i></button>';
						}
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btn_agregar_ot');
						if ($Respuesta=="SI" && $Dato1!=="" && $Dato2==""){
							$Mostrar_div .= '<button type="button" id="btn_agregar_ot" class="btn btn-secondary btn-sm btn_agregar_ot ml-1">+ OT</button>';
						}
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btn_no_genera_ot');
						if ($Respuesta=="SI" && $Dato1!=="" && $Dato2=="" && $Dato1!=="seleccion"){
							$Mostrar_div .= '<button type="button" id="btn_no_genera_ot" class="btn btn-secondary btn-sm btn_no_genera_ot ml-1">- OT</button>';
						}
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btn_vincular_ot');
						if ($Respuesta=="SI" && $Dato1!=="" && $Dato2==""){
							$Mostrar_div .= '<button type="button" id="btn_vincular_ot" title="Vincular" class="btn btn-secondary btn-sm btn_vincular_ot ml-1"><i class="bi bi-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link" viewBox="0 0 16 16"><path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9q-.13 0-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/><path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4 4 0 0 1-.82 1H12a3 3 0 1 0 0-6z"/></svg></i></button>';
						}
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btn_desvincular_ot');
						if($Respuesta=="SI" && ($Dato2!=="" && substr($Dato2,0,1)!=="N" && substr($Dato2,0,1)!=="i" || $Dato1=="seleccion")){
							$Mostrar_div .= '<button type="button" id="btn_desvinuclar_ot" title="Desvincular" class="btn btn-secondary btn-sm btn_desvincular_ot ml-1"><i class="bi bi-share-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share-fill" viewBox="0 0 16 16"><path d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5"/></svg></i></button>';
						}
						if($Dato2!=="" && substr($Dato2,0,1)!=="N" && substr($Dato2,0,1)!=="i"){
							$Mostrar_div .= '<button type="button" id="btn_novedad_imprimir_ot" title="Imprimir" class="btn btn-secondary btn-sm btn_novedad_imprimir_ot ml-1"><i class="bi bi-printer-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16"><path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"/><path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/></svg></i></button>';
						}
					break;
				}
			break;

			case "form_imprimir_ot":
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax = new CRUD();
				$Respuesta      = $InstanciaAjax->BuscarDataBD("manto_ots","ot_id",$Dato1);

				foreach ($Respuesta as $row) {
					$ot_id = $row['ot_id'];
					$ot_bus = $row['ot_bus'];
					$ot_nombre_proveedor = $row['ot_nombre_proveedor'];
					$ot_fecha_registro = $row['ot_fecha_registro'];
					$ot_cgm_id = $row['ot_cgm_id'];	
					$ot_actividad = $row['ot_actividad'];
					
					if($row['ot_ejecucion']=="" || $row['ot_ejecucion']==null){
						$ot_ejecucion = "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
					}else{
						$ot_ejecucion = $row['ot_ejecucion'];
					}
					if($row['ot_kilometraje']=="0"){
						$ot_kilometraje = "";
					}else{
						$ot_kilometraje = $row['ot_kilometraje'];
					}
					$ot_sistema = $row['ot_sistema'];
				}

				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax = new CRUD();
				$$Respuesta = $InstanciaAjax->buscar_dato("colaborador","Colab_nombre_corto","`Colaborador_id`='".$ot_cgm_id."'");	

				foreach ($$Respuesta as $row) {
					$ot_cgm = $row['Colab_nombre_corto'];
				}

				switch($NombreObjeto)
				{
					case "div_imprimir_procesar_ot":
						$Mostrar_div = '<div class="container">	
											<div class="m-0 p-0">
												<h3>O.T. N° '.$ot_id.'</h3>
											</div>
									        <div class="m-0 p-0">
												<h3>BUS '.$ot_bus.'</h3>
											</div>
        									<div class="m-0 p-0" style="font-size: 13px">
												<p><strong>PROVEEDOR :</strong>'.$ot_nombre_proveedor.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
        										<p><strong>FECHA :</strong>'.$ot_fecha_registro.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
        										<p><strong>CGM :</strong>'.$ot_cgm.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
												<p><strong>ACTIVIDAD: </strong>'.$ot_actividad.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
	        									<p><strong>KM: </strong>'.$ot_kilometraje.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
												<p><strong>SISTEMA: </strong>'.$ot_sistema.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
												<p><strong>EJEC.ACTIVIDAD (DESCRIBA)</strong>'.$ot_ejecucion.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
        										<p><strong>COD.PAT.MONTADO: </strong></p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
												<p><strong>COd.PAT.DESMONTADO: </strong></p>
											</div>
										</div>';
					break;

					case "div_imprimir_novedad_ot":
						$Mostrar_div = '<div class="container">	
											<div class="m-0 p-0">
												<h3>O.T. N° '.$ot_id.'</h3>
											</div>
									        <div class="m-0 p-0">
												<h3>BUS '.$ot_bus.'</h3>
											</div>
        									<div class="m-0 p-0" style="font-size: 13px">
												<p><strong>PROVEEDOR :</strong>'.$ot_nombre_proveedor.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
        										<p><strong>FECHA :</strong>'.$ot_fecha_registro.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
        										<p><strong>CGM :</strong>'.$ot_cgm.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
												<p><strong>ACTIVIDAD: </strong>'.$ot_actividad.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
	        									<p><strong>KM: </strong>'.$ot_kilometraje.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
												<p><strong>SISTEMA: </strong>'.$ot_sistema.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
												<p><strong>EJEC.ACTIVIDAD (DESCRIBA)</strong>'.$ot_ejecucion.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
        										<p><strong>COD.PAT.MONTADO: </strong></p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
												<p><strong>COd.PAT.DESMONTADO: </strong></p>
											</div>
										</div>';
					break;
				}
			break;
		}
		echo $Mostrar_div;
    }


}