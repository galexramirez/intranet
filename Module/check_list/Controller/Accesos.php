<?php
class Accesos
{
	var $Modulo="check_list";

	public function CreacionTabs($NombreTabs,$TipoTabs)
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-check_list":
				$tabshtml = '	<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Listado</a>
								<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Check List</a>';
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-arbol_check_list-tab');
				if ($Respuesta=="SI"){
			    	$tabshtml .= '<a class="nav-item nav-link" id="nav-arbol_check_list-tab" data-toggle="tab" href="#nav-arbol_check_list" role="tab" aria-controls="nav-arbol_check_list" aria-selected="false">Arbol Check List</a>';
				}
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-arbol_falla_via-tab');
				if ($Respuesta=="SI"){
			    	$tabshtml .= '<a class="nav-item nav-link" id="nav-arbol_falla_via-tab" data-toggle="tab" href="#nav-arbol_falla_via" role="tab" aria-controls="nav-arbol_falla_via" aria-selected="false">Arbol Falla en Vía</a>';
				}
				$tabshtml .= '	<a class="nav-item nav-link" id="nav-reporte_falla-tab" data-toggle="tab" href="#nav-reporte_falla" role="tab" aria-controls="nav-reporte_falla" aria-selected="false">Reporte de Fallas</a>';
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-ajustes_check_list-tab');
				if ($Respuesta=="SI"){
					$tabshtml .= '<a class="nav-item nav-link" id="nav-ajustes_check_list-tab" data-toggle="tab" href="#nav-ajustes_check_list" role="tab" aria-controls="nav-ajustes_check_list" aria-selected="false">Ajustes</a>';
				}
			break;

			case "nav-tab-arbol":
				$tabshtml = '	<a class="nav-item nav-link active" id="nav-codigo-tab" data-toggle="tab" href="#nav-codigo" role="tab" aria-controls="nav-codigo" aria-selected="true">Códigos</a>
								<a class="nav-item nav-link" id="nav-componente-tab" data-toggle="tab" href="#nav-componente" role="tab" aria-controls="nav-componente" aria-selected="false">Componentes</a>
								<a class="nav-item nav-link" id="nav-falla_accion-tab" data-toggle="tab" href="#nav-falla_accion" role="tab" aria-controls="nav-falla_accion" aria-selected="false">Modo de Falla - Accion </a>
								<a class="nav-item nav-link" id="nav-posicion-tab" data-toggle="tab" href="#nav-posicion" role="tab" aria-controls="nav-posicion" aria-selected="false">Posición</a>';
			break;

			case "nav-tab-arbol_falla_via":
				$tabshtml = '	<a class="nav-item nav-link active" id="nav-codigo_falla_via-tab" data-toggle="tab" href="#nav-codigo_falla_via" role="tab" aria-controls="nav-codigo_falla_via" aria-selected="true">Códigos</a>
								<a class="nav-item nav-link" id="nav-componente_falla_via-tab" data-toggle="tab" href="#nav-componente_falla_via" role="tab" aria-controls="nav-componente_falla_via" aria-selected="false">Componentes</a>
								<a class="nav-item nav-link" id="nav-falla_accion_falla_via-tab" data-toggle="tab" href="#nav-falla_accion_falla_via" role="tab" aria-controls="nav-falla_accion_falla_via" aria-selected="false">Modo de Falla - Accion </a>
								<a class="nav-item nav-link" id="nav-posicion_falla_via-tab" data-toggle="tab" href="#nav-posicion_falla_via" role="tab" aria-controls="nav-posicion_falla_via" aria-selected="false">Posición</a>';
			break;

			case "nav-tab-ajustes_check_list":
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-ajustes_check_list_usuario-tab');
				if ($Respuesta=="SI"){
					$tabshtml = '	<a class="nav-item nav-link active" id="nav-ajustes_check_list_usuario-tab" data-toggle="tab" href="#nav-ajustes_check_list_usuario" role="tab" aria-controls="nav-ajustes_check_list_usuario" aria-selected="true">Usuario</a>';
				}
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-ajustes_check_list_sistema-tab');
				if ($Respuesta=="SI"){
					$tabshtml .= '	<a class="nav-item nav-link" id="nav-ajustes_check_list_sistema-tab" data-toggle="tab" href="#nav-ajustes_check_list_sistema" role="tab" aria-controls="nav-ajustes_check_list_sistema" aria-selected="false">Sistema</a>';
				}
			break;

			case "nav-tab-detalle_check_list":
				$tabshtml = '	<a class="nav-item nav-link active" id="nav-observaciones-tab" data-toggle="tab" href="#nav-observaciones" role="tab" aria-controls="nav-observaciones" aria-selected="true">Observaciones</a>
								<a class="nav-item nav-link" id="nav-falla_via-tab" data-toggle="tab" href="#nav-falla_via" role="tab" aria-controls="nav-falla_via" aria-selected="false">Fallas en Vía</a>';

		}
		echo $tabshtml;
	}
	
    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
		$tablahtml = "";
        switch ($NombreTabla) 
		{
            case "tabla_check_list":
                $tablahtml = '	<table id="tabla_check_list" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
										<tr>
											<th>VER</th>
											<th>ID</th>
											<th>ESTADO</th>
											<th>FECHA</th>
											<th>ASISTENTE</th>
											<th>BUS</th>
											<th>PILOTO</th>
											<th>KILOMETRAJE</th>
											<th>FECHA GENERA</th>
											<th>ACCION</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_check_list_codigo":
                $tablahtml = '	<table id="tabla_check_list_codigo" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>ORDEN</th>
											<th>FLOTA</th>
											<th>CODIGO</th>
											<th>DESCRIPCION</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_check_list_componente":
                $tablahtml = '	<table id="tabla_check_list_componente" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>FLOTA</th>
											<th>CODIGO</th>
											<th>DESCRIPCION</th>
											<th>COMPONENTE</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_check_list_falla_accion":
                $tablahtml = '	<table id="tabla_check_list_falla_accion" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>FLOTA</th>
											<th>CODIGO</th>
											<th>DESCRIPCION</th>
											<th>COMPONENTE</th>
											<th>FALLA</th>
											<th>ACCION</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_check_list_posicion":
                $tablahtml = '	<table id="tabla_check_list_posicion" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>FLOTA</th>
											<th>CODIGO</th>
											<th>DESCRIPCION</th>
											<th>COMPONENTE</th>
											<th>POSICION</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_falla_via_codigo":
                $tablahtml = '	<table id="tabla_falla_via_codigo" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>ORDEN</th>
											<th>FLOTA</th>
											<th>CODIGO</th>
											<th>DESCRIPCION</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_falla_via_componente":
                $tablahtml = '	<table id="tabla_falla_via_componente" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>FLOTA</th>
											<th>CODIGO</th>
											<th>DESCRIPCION</th>
											<th>COMPONENTE</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_falla_via_falla_accion":
                $tablahtml = '	<table id="tabla_falla_via_falla_accion" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>FLOTA</th>
											<th>CODIGO</th>
											<th>DESCRIPCION</th>
											<th>COMPONENTE</th>
											<th>FALLA</th>
											<th>ACCION</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_falla_via_posicion":
                $tablahtml = '	<table id="tabla_falla_via_posicion" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>FLOTA</th>
											<th>CODIGO</th>
											<th>DESCRIPCION</th>
											<th>COMPONENTE</th>
											<th>POSICION</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_check_list_observaciones":
                $tablahtml = '	<table id="tabla_check_list_observaciones" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
										<tr>
											<th>CODIGO</th>
											<th>DESCRIPCION</th>
											<th>COMPONENTE</th>
											<th>POSICION</th>
											<th>FALLA</th>
											<th>ACCION</th> ';
				if($TipoTabla=="ABIERTO"){
					$tablahtml .='			<th>ACCIONES</th>';
				}
				$tablahtml .= '			</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_check_list_falla_via":
                $tablahtml = '	<table id="tabla_check_list_falla_via" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
										<tr>
											<th>NOVEDAD ID</th>
											<th>DESCRIPCION NOVEDAD</th>
											<th>CODIGO</th>
											<th>DESCRIPCION CODIGO</th>
											<th>COMPONENTE</th>
											<th>POSICION</th>
											<th>FALLA</th>
											<th>ACCION</th> ';
				if($TipoTabla=="ABIERTO"){
					$tablahtml .='			<th>ACCIONES</th>';
				}
				$tablahtml .= '			</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_reporte_falla":
                $tablahtml = '	<table id="tabla_reporte_falla" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
										<tr>
											<th>CHECK LIST</th>
											<th>FECHA</th>
											<th>BUS</th>
											<th>KM</th>
											<th>COD.PIL.</th>
											<th>NOMBRE PILOTO</th>
											<th>ESTADO</th>
											<th>NOVEDAD ID</th>
											<th>CODIGO</th>
											<th>DESCRIPCION DEL CODIGO</th>
											<th>COMPONENTE</th>
											<th>POSICION</th>
											<th>FALLA</th>
											<th>ACCION</th>
											<th>USUARIO GENERA</th>
											<th>FECHA GENERA</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_tc_check_list_usuario":
                $tablahtml = '	<table id="tabla_tc_check_list_usuario" class="table table-striped table-bordered table-condensed w-100">
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

			case "tabla_tc_check_list_sistema":
                $tablahtml = '	<table id="tabla_tc_check_list_sistema" class="table table-striped table-bordered table-condensed w-100">
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
            case "tabla_check_list":
				$defaultContent0 = "<div class='text-center'><div class='btn-group'><button title='Ver' class='btn btn-sm btn_ver_check_list'><i class='bi bi-search'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg></i></button></div></div>";
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_check_list'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"defaultContent": " '.$defaultContent0.' "},
									{"data": "check_list_id"},
									{"data": "chl_estado"},
									{"data": "chl_fecha"},					
									{"data": "chl_usuario_nombre_genera"},
									{"data": "chl_bus"},
									{"data": "chl_nombre_piloto"},
									{"data": "chl_kilometraje"},
									{"data": "chl_fecha_genera"},
									{"defaultContent": " '.$defaultContent1.' "}
				  				]';
			break;

			case "tabla_check_list_codigo":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_check_list_codigo'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_check_list_codigo'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "check_list_codigo_id"},
									{"data": "chl_orden"},
									{"data": "chl_bus_tipo"},
									{"data": "chl_codigo"},
									{"data": "chl_descripcion"},
									{"defaultContent": " '.$defaultContent1.' "}
				  				]';
			break;

			case "tabla_check_list_componente":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btn-sm btn_borrar_check_list_componente'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "check_list_componente_id"},
									{"data": "chl_bus_tipo"},
									{"data": "chl_codigo"},
									{"data": "chl_descripcion"},
									{"data": "chl_componente"},
									{"defaultContent": " '.$defaultContent1.' "}
				  				]';
			break;

			case "tabla_check_list_falla_accion":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_check_list_falla_accion'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_check_list_falla_accion'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "check_list_falla_accion_id"},
									{"data": "chl_bus_tipo"},
									{"data": "chl_codigo"},
									{"data": "chl_descripcion"},
									{"data": "chl_componente"},
									{"data": "chl_falla"},
									{"data": "chl_accion"},
									{"defaultContent": " '.$defaultContent1.' "}
				  				]';
			break;

			case "tabla_check_list_posicion":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_check_list_posicion'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_check_list_posicion'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "check_list_posicion_id"},
									{"data": "chl_bus_tipo"},
									{"data": "chl_codigo"},
									{"data": "chl_descripcion"},
									{"data": "chl_componente"},
									{"data": "chl_posicion"},
									{"defaultContent": " '.$defaultContent1.' "}
				  				]';
			break;

			case "tabla_falla_via_codigo":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_falla_via_codigo'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_falla_via_codigo'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "falla_via_codigo_id"},
									{"data": "fav_orden"},
									{"data": "fav_bus_tipo"},
									{"data": "fav_codigo"},
									{"data": "fav_descripcion"},
									{"defaultContent": " '.$defaultContent1.' "}
				  				]';
			break;

			case "tabla_falla_via_componente":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btn-sm btn_borrar_falla_via_componente'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "falla_via_componente_id"},
									{"data": "fav_bus_tipo"},
									{"data": "fav_codigo"},
									{"data": "fav_descripcion"},
									{"data": "fav_componente"},
									{"defaultContent": " '.$defaultContent1.' "}
				  				]';
			break;

			case "tabla_falla_via_falla_accion":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_falla_via_falla_accion'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_falla_via_falla_accion'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "falla_via_falla_accion_id"},
									{"data": "fav_bus_tipo"},
									{"data": "fav_codigo"},
									{"data": "fav_descripcion"},
									{"data": "fav_componente"},
									{"data": "fav_falla"},
									{"data": "fav_accion"},
									{"defaultContent": " '.$defaultContent1.' "}
				  				]';
			break;

			case "tabla_falla_via_posicion":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_falla_via_posicion'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_falla_via_posicion'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "falla_via_posicion_id"},
									{"data": "fav_bus_tipo"},
									{"data": "fav_codigo"},
									{"data": "fav_descripcion"},
									{"data": "fav_componente"},
									{"data": "fav_posicion"},
									{"defaultContent": " '.$defaultContent1.' "}
				  				]';
			break;

			case "tabla_check_list_observaciones":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btn-sm btn_borrar_check_list_observaciones'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "chl_codigo"},
									{"data": "chl_descripcion"},
									{"data": "chl_componente"},
									{"data": "chl_posicion"},    
									{"data": "chl_falla"},
									{"data": "chl_accion"} ';
				if($TipoTabla=="ABIERTO"){
					$columnashtml .= ',{"defaultContent": " '.$defaultContent1.' "}';
				}
				$columnashtml .= ']';
			break;

			case "tabla_check_list_falla_via":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_check_list_falla_via'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "fav_novedad_id"},
									{"data": "fav_descripcion_novedad"},
									{"data": "fav_codigo"},
									{"data": "fav_descripcion_codigo"},
									{"data": "fav_componente"},
									{"data": "fav_posicion"},    
									{"data": "fav_falla"},
									{"data": "fav_accion"} ';
				if($TipoTabla=="ABIERTO"){
					$columnashtml .= ',{"defaultContent": " '.$defaultContent1.' "}';
				}
				$columnashtml .= ']';
			break;

			case "tabla_reporte_falla":
				$columnashtml = '[	{"data": "check_list_id"},
									{"data": "chl_fecha"},					
									{"data": "chl_bus"},
									{"data": "chl_kilometraje"},
									{"data": "chl_codigo_piloto"},
									{"data": "chl_nombre_piloto"},
									{"data": "chl_estado"},
									{"data": "novedad_id"},
									{"data": "codigo"},
									{"data": "descripcion"},
									{"data": "componente"},
									{"data": "posicion"},    
									{"data": "falla"},
									{"data": "accion"},
									{"data": "nombre_usuario_genera"},
									{"data": "chl_fecha_genera"}
								]';
			break;

			case "tabla_tc_check_list_usuario":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_tc_check_list_usuario'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_tc_check_list_usuario'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "tc_check_list_id"},
									{"data": "tc_categoria1"},
									{"data": "tc_categoria2"},
									{"data": "tc_categoria3"},
									{"defaultContent": " '.$defaultContent1.' "}
								]';
			break;

			case "tabla_tc_check_list_sistema":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_tc_check_list_sistema'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_tc_check_list_sistema'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "tc_check_list_id"},
									{"data": "tc_categoria1"},
									{"data": "tc_categoria2"},
									{"data": "tc_categoria3"},
									{"defaultContent": " '.$defaultContent1.' "}
								]';
			break;

			case "":
				$columnastabla = '';
			break;

        }
		echo $columnashtml;
	}

	public function BotonesFormulario($NombreFormulario,$NombreObjeto)
	{
		$botonesformulario = "";
		switch($NombreFormulario)
		{
			case "form_seleccion_check_list_codigo":
				switch($NombreObjeto)
				{
					case "btn_seleccion_check_list_codigo":
						$botonesformulario = ' <button type="button" id="btn_buscar_check_list_codigo" class="btn btn-secondary btn-sm btn_buscar_check_list_codigo"> Buscar </button> ';
						$botonesformulario .= ' <button type="button" id="btn_nuevo_check_list_codigo" class="btn btn-secondary btn-sm btn_nuevo_check_list_codigo">+ Nuevo</button> ';
						$botonesformulario .= ' <button type="button" id="btn_descargar_arbol" class="btn btn-secondary btn-sm btn_descargar_arbol">Descargar Arbol</button> ';
					break;
				}
			break;

			case "form_seleccion_check_list_componente":
				switch($NombreObjeto)
				{
					case "btn_seleccion_check_list_componente":
						$botonesformulario = ' <button type="button" id="btn_buscar_check_list_componente" class="btn btn-secondary btn-sm btn_buscar_check_list_componente"> Buscar </button> ';
						$botonesformulario .= ' <button type="button" id="btn_nuevo_check_list_componente" class="btn btn-secondary btn-sm btn_nuevo_check_list_componente">+ Nuevo</button> ';
					break;
				}
			break;

			case "form_seleccion_check_list_falla_accion":
				switch($NombreObjeto)
				{
					case "btn_seleccion_check_list_falla_accion":
						$botonesformulario = ' <button type="button" id="btn_buscar_check_list_falla_accion" class="btn btn-secondary btn-sm btn_buscar_check_list_falla_accion"> Buscar </button> ';
						$botonesformulario .= ' <button type="button" id="btn_nuevo_check_list_falla_accion" class="btn btn-secondary btn-sm btn_nuevo_check_list_falla_accion">+ Nuevo</button> ';
					break;
				}
			break;

			case "form_seleccion_check_list_posicion":
				switch($NombreObjeto)
				{
					case "btn_seleccion_check_list_posicion":
						$botonesformulario = ' <button type="button" id="btn_buscar_check_list_posicion" class="btn btn-secondary btn-sm btn_buscar_check_list_posicion"> Buscar </button> ';
						$botonesformulario .= ' <button type="button" id="btn_nuevo_check_list_posicion" class="btn btn-secondary btn-sm btn_nuevo_check_list_posicion">+ Nuevo</button> ';
					break;
				}
			break;

			case "form_seleccion_falla_via_codigo":
				switch($NombreObjeto)
				{
					case "btn_seleccion_falla_via_codigo":
						$botonesformulario = ' <button type="button" id="btn_buscar_falla_via_codigo" class="btn btn-secondary btn-sm btn_buscar_falla_via_codigo"> Buscar </button> ';
						$botonesformulario .= ' <button type="button" id="btn_nuevo_falla_via_codigo" class="btn btn-secondary btn-sm btn_nuevo_falla_via_codigo">+ Nuevo</button> ';
						$botonesformulario .= ' <button type="button" id="btn_descargar_arbol_falla_via" class="btn btn-secondary btn-sm btn_descargar_arbol_falla_via">Descargar Arbol</button> ';
					break;
				}
			break;

			case "form_seleccion_falla_via_componente":
				switch($NombreObjeto)
				{
					case "btn_seleccion_falla_via_componente":
						$botonesformulario = ' <button type="button" id="btn_buscar_falla_via_componente" class="btn btn-secondary btn-sm btn_buscar_falla_via_componente"> Buscar </button> ';
						$botonesformulario .= ' <button type="button" id="btn_nuevo_falla_via_componente" class="btn btn-secondary btn-sm btn_nuevo_falla_via_componente">+ Nuevo</button> ';
					break;
				}
			break;

			case "form_seleccion_falla_via_falla_accion":
				switch($NombreObjeto)
				{
					case "btn_seleccion_falla_via_falla_accion":
						$botonesformulario = ' <button type="button" id="btn_buscar_falla_via_falla_accion" class="btn btn-secondary btn-sm btn_buscar_falla_via_falla_accion"> Buscar </button> ';
						$botonesformulario .= ' <button type="button" id="btn_nuevo_falla_via_falla_accion" class="btn btn-secondary btn-sm btn_nuevo_falla_via_falla_accion">+ Nuevo</button> ';
					break;
				}
			break;

			case "form_seleccion_falla_via_posicion":
				switch($NombreObjeto)
				{
					case "btn_seleccion_falla_via_posicion":
						$botonesformulario = ' <button type="button" id="btn_buscar_falla_via_posicion" class="btn btn-secondary btn-sm btn_buscar_falla_via_posicion"> Buscar </button> ';
						$botonesformulario .= ' <button type="button" id="btn_nuevo_falla_via_posicion" class="btn btn-secondary btn-sm btn_nuevo_falla_via_posicion">+ Nuevo</button> ';
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
			case "form_seleccion_check_list":
				switch($NombreObjeto)
				{
					case "btn_seleccion_check_list":
						$Mostrar_div  = ' <button type="button" id="btn_buscar_check_list" class="btn btn-secondary btn-sm btn_buscar_check_list">Buscar</button> ';
						$Mostrar_div .= ' <button type="button" id="btn_descargar_check_list" class="btn btn-secondary btn-sm btn_descargar_check_list">Descargar</button> ';
					break;
				}
			break;

			case "form_seleccion_check_list_registro":
				switch($NombreObjeto)
				{
					case "btn_seleccion_check_list_registro":
						$Mostrar_div  = ' <button type="button" id="btn_cargar_check_list_registro" class="btn btn-secondary btn-sm btn_cargar_check_list_registro" >Cargar</button> ';
						$Mostrar_div .= ' <button type="button" title="Ver Check List" id="btn_ver_check_list_registro" class="btn btn-secondary btn-sm btn_ver_check_list_registro"><i class="bi bi-search"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg></i></button> ';
					break;
				}
			break;

			case "form_check_list_registro":
				switch($NombreObjeto)
				{
					case "div_check_list_registro":
						$Mostrar_div = ' 	<div class="col-lg-1">
												<div class="form-group">
													<label for="t_check_list_id" class="col-form-label form-control-sm">CHECK LIST</label>
													<input type="number" readonly class="form-control form-control-sm" id="t_check_list_id">
												</div>
											</div>
											<div class="col-lg-1">
												<div class="form-group">
													<label for="chl_fecha" class="col-form-label form-control-sm">FECHA</label>
													<input type="date" class="form-control form-control-sm chl_fecha" id="chl_fecha">
												</div>
											</div>
											<div class="col-lg-1">
												<div class="form-group">
													<label for="chl_bus" class="col-form-label form-control-sm">BUS</label>
													<select class="form-control form-control-sm chl_bus" id="chl_bus">
													</select>
												</div>
											</div>
											<div class="col-lg-1">
												<div class="form-group">
													<label for="chl_kilometraje" class="col-form-label form-control-sm">KILOMETRAJE</label>
													<input type="number" class="form-control form-control-sm" id="chl_kilometraje">
												</div>
											</div>
											<div class="col-lg-2">
												<div class="form-group">
													<label for="chl_nombre_piloto" class="col-form-label form-control-sm">PILOTO</label>
													<select class="form-control form-control-sm" id="chl_nombre_piloto">
													</select>
												</div>
											</div>
											<div class="col-lg-1">
												<div class="form-group">
													<label for="chl_estado" class="col-form-label form-control-sm">ESTADO</label>
													<input type="text" readonly class="form-control form-control-sm" id="chl_estado">
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group" id="div_btn_guardar_check_list_registro">
												</div>
											</div> ';
					break;

					case "btn_guardar_check_list_registro":
						$Mostrar_div  = ' <button type="button" id="btn_log_check_list_registro" class="btn btn-info btn-sm btn_log_check_list_registro">Log</button> ';
						$Mostrar_div .= ' <button type="button" id="btn_cancelar_check_list_registro" class="btn btn-light btn-sm btn_cancelar_check_list_registro">Cancelar</button> ';
						if($Dato==""){
							$Mostrar_div .= ' <button type="button" id="btn_guardar_check_list_registro" class="btn btn-secondary btn-sm btn_guardar_check_list_registro">Guardar</button> ';
						}
						if($Dato=="ABIERTO"){
							$Mostrar_div .= ' <button type="button" id="btn_guardar_check_list_registro" class="btn btn-secondary btn-sm btn_guardar_check_list_registro">Guardar</button> ';
							$Mostrar_div .= ' <button type="button" id="btn_cerrar_check_list_registro" class="btn btn-secondary btn-sm btn_cerrar_check_list_registro">Cerrar</button> ';
							$Mostrar_div .= ' <button type="button" id="btn_anular_check_list_registro" class="btn btn-secondary btn-sm btn_anular_check_list_registro">Anular</button> ';	
						}
						if($Dato=="CERRADO"){
							$Mostrar_div .= ' <button type="button" id="btn_anular_check_list_registro" class="btn btn-secondary btn-sm btn_anular_check_list_registro">Anular</button> ';	
						}
					break;

				}
			break;

			case "form_registro_observaciones":

				switch($NombreObjeto)
				{
					case "btn_nuevo_registro_observaciones":
						if($Dato=="ABIERTO"){
							$Mostrar_div = '<button type="button" id="btn_nuevo_registro_observaciones" class="btn btn-secondary btn-sm btn_nuevo_registro_observaciones">+ Nuevo</button>';
						}
						
					break;
				}
			break;

			case "form_registro_falla_via":

				switch($NombreObjeto)
				{
					case "btn_nuevo_registro_falla_via":
						if($Dato=="ABIERTO"){
							$Mostrar_div = '<button type="button" id="btn_nuevo_registro_falla_via" class="btn btn-secondary btn-sm btn_nuevo_registro_falla_via">+ Nuevo</button>';
						}
						
					break;
				}
			break;

			case "form_seleccion_reporte_falla":
				switch($NombreObjeto)
				{
					case "btn_seleccion_reporte_falla":
						$Mostrar_div = ' <button type="button" id="btn_buscar_reporte_falla" class="btn btn-secondary btn-sm btn_buscar_reporte_falla">Buscar</button> ';
					break;
				}
			break;


			case "":

				switch($NombreObjeto)
				{
					case "":
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