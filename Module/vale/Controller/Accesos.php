<?php
class Accesos
{
	var $Modulo="vale";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-vale":
				$tabshtml = '	<a class="nav-item nav-link active" id="nav-orden_trabajo-tab" data-toggle="tab" href="#nav-orden_trabajo" role="tab" aria-controls="nav-orden_trabajo" aria-selected="true"><span id="nav_tab_id_orden_trabajo">OTs</span></a>
								<a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false">Listado</a>
								<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><span id="idProcesar">Procesar</span></a>';
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-ajustes_vale-tab');
				if ($Respuesta=="SI"){
					$tabshtml .= '<a class="nav-item nav-link" id="nav-ajustes_vale-tab" data-toggle="tab" href="#nav-ajustes_vale" role="tab" aria-controls="nav-ajustes_vale" aria-selected="false">Ajustes</a>';
				}
			break;

			case "nav-tab-ajustes_vale":
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-ajustes_vale_usuario-tab');
				if ($Respuesta=="SI"){
					$tabshtml = '	<a class="nav-item nav-link active" id="nav-ajustes_vale_usuario-tab" data-toggle="tab" href="#nav-ajustes_vale_usuario" role="tab" aria-controls="nav-ajustes_vale_usuario" aria-selected="true">Usuario</a>';
				}
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-ajustes_vale_sistema-tab');
				if ($Respuesta=="SI"){
					$tabshtml .= '	<a class="nav-item nav-link" id="nav-ajustes_vale_sistema-tab" data-toggle="tab" href="#nav-ajustes_vale_sistema" role="tab" aria-controls="nav-ajustes_vale_sistema" aria-selected="false">Sistema</a>';
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

			case "tabla_vale":
                $tablahtml = '	<table id="tabla_vale" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>VER</th>
											<th>VALE_ID</th>
											<th>ESTADO</th>
											<th>OT_ID</th>
											<th>BUS</th>
											<th>ORIGEN</th>
											<th>RAZON_SOCIAL_ASOCIADO</th>
											<th>CGM_GENERA</th>
											<th>FECHA</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

            case "tabla_repuestos":
                $tablahtml = '  <table id="tabla_repuestos" class="table table-striped table-bordered table-condensed w-100">
                                    <thead class="text-center">
                                        <tr>
											<th>ITEM</th>
											<th>CODIGO</th>
											<th>COD.PATRIM.</th>
											<th>NRO.SERIE</th>
                                            <th>DESCRIPCION_REPUESTOS</th>
											<th>CANT.REQ.</th>
											<th>CANT.DESP.</th>
											<th>CANT.UTIL.</th>
											<th>UNIDAD</th>';
				if($TipoTabla=="SI"){
					$tablahtml .= '			<th>ACCIONES</th>';
				}
				$tablahtml .= '	        </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

			case "tabla_ver_detalle_repuestos":
                $tablahtml = '  <table id="tabla_ver_detalle_repuestos" class="table table-striped table-bordered table-condensed w-100">
                                    <thead class="text-center">
                                        <tr>
											<th>CODIGO</th>
											<th>COD.PATRIM.</th>
											<th>NRO.SERIE</th>
											<th>DESCRIPCION_REPUESTOS</th>
											<th>CANT.REQ.</th>
											<th>CANT.DESP.</th>
											<th>CANT.UTIL.</th>
											<th>UNIDAD</th>
										</tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

			case "tabla_ver_procesar_repuestos":
                $tablahtml = '  <table id="tabla_ver_procesar_repuestos" class="table table-striped table-bordered table-condensed w-100">
                                    <thead class="text-center">
                                        <tr>
											<th>ITEM</th>
											<th>CODIGO</th>
											<th>COD.PATRIM.</th>
											<th>NRO.SERIE</th>
											<th>DESCRIPCION_REPUESTOS</th>
											<th>CANT.REQ.</th>
											<th>CANT.DESP.</th>
											<th>CANT.UTIL.</th>
											<th>UNIDAD</th>
									</tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

			case "tabla_tc_vale_usuario":
                $tablahtml = '	<table id="tabla_tc_vale_usuario" class="table table-striped table-bordered table-condensed w-100">
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

			case "tabla_tc_vale_sistema":
                $tablahtml = '	<table id="tabla_tc_vale_sistema" class="table table-striped table-bordered table-condensed w-100">
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
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='+ Vale' class='btn btn-info btn-sm btn_nuevo_vale'><i class='bi bi-clipboard-plus'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-clipboard-plus' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7'/><path d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z'/><path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z'/></svg></i></button></div></div>";
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

			case "tabla_ver_horas_tecnicos":
				$columnashtml = '[	{"data": "tecnico_nombres"},
									{"data": "hora_inicio"},
									{"data": "hora_fin"},
                                    {"data": "total_horas"}
								]';
            break;

			case "tabla_vale":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Ver' class='btn btn-sm btn_ver_vale'><i class='bi bi-search'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg></i></button></div></div>";
				$defaultContent2 = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_vale'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"defaultContent": " '.$defaultContent1.' "},
									{"data": "vale_id"},
									{"data": "va_estado"},
									{"data": "va_ot_id"},
									{"data": "va_bus"},
									{"data": "va_origen"},
									{"data": "va_asociado"},
									{"data": "va_nombre_genera"},
									{"data": "va_date_genera"},
									{"defaultContent": " '.$defaultContent2.' "}
								]';
			break;

            case "tabla_repuestos":
				$columnashtml = ' [ {"data": "vr_id"},
									{"data": "vr_repuesto"},
									{"data": "vr_cod_patrimonial"},
									{"data": "vr_nroserie"},
                                    {"data": "vr_descripcion"},
									{"data": "vr_cantidad_requerida"},
									{"data": "vr_cantidad_despachada"},
									{"data": "vr_cantidad_utilizada"},
									{"data": "vr_unidad"}';
				if($TipoTabla=="SI"){
					$defaultContent = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_repuesto'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button tittle='Borrar' class='btn btn-danger btn-sm btn_borrar_repuesto'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
					$columnashtml .= ',{"defaultContent": " '.$defaultContent.' "}';	
				}
				$columnashtml .= ']';
            break;

			case "tabla_ver_detalle_repuestos":
				$columnashtml = ' [ {"data": "vr_repuesto"},
									{"data": "vr_cod_patrimonial"},
									{"data": "vr_nroserie"},
									{"data": "vr_descripcion"},
									{"data": "vr_cantidad_requerida"},
									{"data": "vr_cantidad_despachada"},
									{"data": "vr_cantidad_utilizada"},
									{"data": "vr_unidad"}
								]';
            break;

			case "tabla_ver_procesar_repuestos":
				$columnashtml = ' [ {"data": "vr_id"},
									{"data": "vr_repuesto"},
									{"data": "vr_cod_patrimonial"},
									{"data": "vr_nroserie"},
									{"data": "vr_descripcion"},
									{"data": "vr_cantidad_requerida"},
									{"data": "vr_cantidad_despachada"},
									{"data": "vr_cantidad_utilizada"},
									{"data": "vr_unidad"}
								]';
            break;

 			case "tabla_tc_vale_usuario":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_tc_vale_usuario'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_tc_vale_usuario'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "tc_vale_id"},
									{"data": "tc_categoria1"},
									{"data": "tc_categoria2"},
									{"data": "tc_categoria3"},
									{"defaultContent": " '.$defaultContent1.' "}
								]';
			break;

			case "tabla_tc_vale_sistema":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_tc_vale_sistema'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_tc_vale_sistema'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "tc_vale_id"},
									{"data": "tc_categoria1"},
									{"data": "tc_categoria2"},
									{"data": "tc_categoria3"},
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
			case "form_seleccion_vale":
				switch($NombreObjeto)
				{
					case "btn_seleccion_vale":
						$botonesformulario = '<button type="button" id="btn_buscar_vales" class="btn btn-secondary btn-sm btn_buscar_vale ml-1">Buscar</button>';
						$botonesformulario .= '<button type="button" id="btn_descargar_vales" class="btn btn-secondary btn-sm btn_descargar_vale ml-1">Descargar</button>';
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
					case "div_alertsDropdown_vales":
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax	= new CRUD();
						$Respuesta		= $InstanciaAjax->BuscarDataBD("manto_vale", "va_estado", "OBSERVADO");

						$divformulario = '	<h6 class="dropdown-header">
												Alertas Vales Observados
											</h6>';
						
						foreach($Respuesta as $row){
							$divformulario .= '	<a class="dropdown-item d-flex align-items-center" href="javascript:f_editar_vale('.$row['vale_id'].')">
													<div class="mr-3">
														<div class="icon-circle bg-primary">
															<i class="fas fa-file-alt text-white"></i>
														</div>
													</div>	
													<div>
														<div class="font-weight-bold">'.$row['vale_id'].'</div>
														<span class="small text-gray-500">'.$row['vale_date_genera'].' - '.$row['va_ot_id'].' - '.$row['va_asociado'].'</span>
													</div>
												</a>';		
						}
					break;

				}
			break;
		}
		echo $divformulario;
    }

	public function MostrarDiv($NombreFormulario, $NombreObjeto, $Dato1, $Dato2)
	{
		$Mostrar_div = "";
		switch($NombreFormulario)
		{
			case "form_seleccion_procesar_vale":
				switch($NombreObjeto)
				{
					case "btn_seleccion_procesar_vale":
						$Mostrar_div = '<button type="button" id="btn_cargar_vale" class="btn btn-secondary btn-sm btn_cargar_vale ml-1" >Cargar</button>';
						$Mostrar_div .='<button type="button" title="Ver Vales" id="btn_procesar_ver_vale" class="btn btn-secondary btn-sm btn_procesar_ver_vale ml-1"><i class="bi bi-search"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg></i></button>';
						switch($Dato1)
						{
							case "vacio":
								$Mostrar_div = "";
							break;

							case "":
							break;

						}
					break;

				}
			break;

			case "form_procesar_vale":
				switch($NombreObjeto)
				{
					case "btn_guardar_vale":
						$Mostrar_div  = ' <button type="button" id="btn_log_vale" class="btn btn-info btn-sm btn_log_vale mr-1">Log</button> ';
						$Mostrar_div .= ' <button type="button" id="btn_procesar_imprimir_vale" title="Imprimir" class="btn btn-secondary btn-sm btn_procesar_imprimir_vale mr-1"><i class="bi bi-printer-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16"><path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"/><path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/></svg></i></button> ';
						$Mostrar_div .= ' <button type="button" id="btn_almacen_ok" title="Almacen OK" class="btn btn-secondary btn-sm btn_almacen_ok mr-1"><i class="bi bi-bag-check-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/></svg></i></button> ';
						$Mostrar_div .= ' <button type="button" id="btn_coordinador_ok" title="Coordinador OK" class="btn btn-secondary btn-sm btn_coordinador_ok mr-1"><i class="bi bi-person-check-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0"/><path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/></svg></i></button> ';
						$Mostrar_div .= ' <button tabindex="12" type="button" id="btn_cancelar_vale" class="btn btn-light btn-sm btn_cancelar_vale mr-1">Cancelar</button> ';
						$Mostrar_div .= ' <button type="button" id="btn_guardar_vale" class="btn btn-secondary btn-sm btn_guardar_vale mr-1">Guardar</button>';
						switch($Dato1)
						{
							case "":
							break;

							case "":
							break;

						}
						
					break;

				}
			break;

			case "form_seleccion_ot":
				switch($NombreObjeto)
				{
					case "btn_seleccion_ot":
						$Mostrar_div   = '<button type="button" id="btn_buscar_ot" class="btn btn-secondary btn-sm btn_buscar_ot ml-1">Buscar</button>';
						$Mostrar_div  .= '<button type="button" id="btn_descargar_ot" class="btn btn-secondary btn-sm btn_descargar_ot ml-1">Descargar</button>';
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

			case "form_imprimir_vale":
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax = new CRUD();
				$Respuesta      = $InstanciaAjax->BuscarDataBD("manto_vale","vale_id",$Dato1);

				foreach ($Respuesta as $row) {
					$vale_id = $row['vale_id'];
					$va_ot_id= $row['va_ot_id'];
					$va_nombre_proveedor = $row['va_asociado'];
					$va_fecha_registro = $row['va_date_genera'];
					$va_cgm_id = $row['va_genera'];	
				}
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax = new CRUD();
				$$Respuesta = $InstanciaAjax->buscar_dato("colaborador","Colab_nombre_corto","`Colaborador_id`='".$va_cgm_id."'");	

				foreach ($$Respuesta as $row) {
					$va_cgm = $row['Colab_nombre_corto'];
				}
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax = new CRUD();
				$$Respuesta = $InstanciaAjax->BuscarDataBD("manto_ots","ot_id",$va_ot_id);	

				foreach ($$Respuesta as $row) {
					$va_actividad = $row['ot_actividad'];
					$va_bus = $row['ot_bus'];
				}
				switch($NombreObjeto)
				{
					case "div_imprimir_vale":
						$Mostrar_div = '<div class="container">	
											<div class="m-0 p-0">
												<h3 class="font-weight-normal">VALE N° '.$vale_id.'</h3>
											</div>
											<div class="m-0 p-0">
												<h3 class="font-weight-normal">O.T.N° '.$va_ot_id.'</h3>
											</div>
									        <div class="m-0 p-0">
												<h3 class="font-weight-normal">BUS '.$va_bus.'</h3>
											</div>
        									<div class="m-0 p-0">
												<p class="font-weight-normal"><strong>PROVEEDOR :</strong>'.$va_nombre_proveedor.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
        										<p class="font-weight-normal"><strong>FECHA :</strong>'.$va_fecha_registro.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
        										<p class="font-weight-normal"><strong>CGM :</strong>'.$va_cgm.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
												<p class="font-weight-normal"><strong>ACTIVIDAD: </strong>'.$va_actividad.'</p>
											</div>';
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax = new CRUD();
						$Respuesta = $InstanciaAjax->BuscarDataBD("manto_vale_repuestos","vr_vale_id",$Dato1);
						
						foreach ($Respuesta as $row) {
							$Mostrar_div.='	<div class="m-0 p-0" style="font-size: 13px">
												<p class="font-weight-normal"><strong>'.$row['vr_repuesto'].'</strong> '.$row['vr_descripcion'].'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
												<p class="font-weight-normal">C.REQ.'.$row['vr_cantidad_requerida'].' C.DES.'.$row['vr_cantidad_despachada'].' C.UTI.'.$row['vr_cantidad_utilizada'].'</p>
											</div>';
						}
													
						$Mostrar_div .= '</div>';

					break;

					case "div_listado_imprimir_vale":
						$Mostrar_div = '<div class="container">	
											<div class="m-0 p-0">
												<h3 class="font-weight-normal">VALE N° '.$vale_id.'</h3>
											</div>
											<div class="m-0 p-0">
												<h3 class="font-weight-normal">O.T.N° '.$va_ot_id.'</h3>
											</div>
									        <div class="m-0 p-0">
												<h3 class="font-weight-normal">BUS '.$va_bus.'</h3>
											</div>
        									<div class="m-0 p-0">
												<p class="font-weight-normal"><strong>PROVEEDOR :</strong>'.$va_nombre_proveedor.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
        										<p class="font-weight-normal"><strong>FECHA :</strong>'.$va_fecha_registro.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
        										<p class="font-weight-normal"><strong>CGM :</strong>'.$va_cgm.'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
												<p class="font-weight-normal"><strong>ACTIVIDAD: </strong>'.$va_actividad.'</p>
											</div>';
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax = new CRUD();
						$Respuesta = $InstanciaAjax->BuscarDataBD("manto_vale_repuestos","vr_vale_id",$Dato1);
						
						foreach ($Respuesta as $row) {
							$Mostrar_div.='	<div class="m-0 p-0" style="font-size: 13px">
												<p class="font-weight-normal"><strong>'.$row['vr_repuesto'].'</strong> '.$row['vr_descripcion'].'</p>
											</div>
											<div class="m-0 p-0" style="font-size: 13px">
												<p class="font-weight-normal">C.REQ.'.$row['vr_cantidad_requerida'].' C.DES.'.$row['vr_cantidad_despachada'].' C.UTI.'.$row['vr_cantidad_utilizada'].'</p>
											</div>';
						}
													
						$Mostrar_div .= '</div>';

					break;

				}
			break;

		}
		echo $Mostrar_div;
    }


}