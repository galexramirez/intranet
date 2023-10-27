<?php
class Accesos
{
	var $Modulo="inspeccion_flota";

	public function CreacionTabs($NombreTabs,$TipoTabs)
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-inspeccion_flota":
				$tabshtml = '	<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Listado</a>
								<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Inspeccion</a>';
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-arbol_inspeccion_flota-tab');
				if ($Respuesta=="SI"){
			    	$tabshtml .= '<a class="nav-item nav-link" id="nav-arbol_inspeccion_flota-tab" data-toggle="tab" href="#nav-arbol_inspeccion_flota" role="tab" aria-controls="nav-arbol_inspeccion_flota" aria-selected="false">Arbol</a>';
				}
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-reporte-tab');
				if ($Respuesta=="SI"){
					$tabshtml .= '	<a class="nav-item nav-link" id="nav-reporte-tab" data-toggle="tab" href="#nav-reporte" role="tab" aria-controls="nav-reporte" aria-selected="false">Reporte</a>';
				}
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-falla-tab');
				if ($Respuesta=="SI"){
					$tabshtml .= '	<a class="nav-item nav-link" id="nav-falla-tab" data-toggle="tab" href="#nav-falla" role="tab" aria-controls="nav-falla" aria-selected="false">Modo de Fallas</a>';
				}
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-ajustes_inspeccion_flota-tab');
				if ($Respuesta=="SI"){
					$tabshtml .= '<a class="nav-item nav-link" id="nav-ajustes_inspeccion_flota-tab" data-toggle="tab" href="#nav-ajustes_inspeccion_flota" role="tab" aria-controls="nav-ajustes_inspeccion_flota" aria-selected="false">Ajustes</a>';
				}
			break;

			case "nav-tab-arbol":
				$tabshtml = '	<a class="nav-item nav-link active" id="nav-codigo-tab" data-toggle="tab" href="#nav-codigo" role="tab" aria-controls="nav-codigo" aria-selected="true">Códigos</a>
								<a class="nav-item nav-link" id="nav-componente-tab" data-toggle="tab" href="#nav-componente" role="tab" aria-controls="nav-componente" aria-selected="false">Componentes</a>
								<a class="nav-item nav-link" id="nav-falla_accion-tab" data-toggle="tab" href="#nav-falla_accion" role="tab" aria-controls="nav-falla_accion" aria-selected="false">Modo de Falla - Accion </a>
								<a class="nav-item nav-link" id="nav-posicion-tab" data-toggle="tab" href="#nav-posicion" role="tab" aria-controls="nav-posicion" aria-selected="false">Posición</a>';
			break;

			case "nav-tab-ajustes_inspeccion_flota":
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-ajustes_inspeccion_flota_usuario-tab');
				if ($Respuesta=="SI"){
					$tabshtml = '	<a class="nav-item nav-link active" id="nav-ajustes_inspeccion_flota_usuario-tab" data-toggle="tab" href="#nav-ajustes_inspeccion_flota_usuario" role="tab" aria-controls="nav-ajustes_inspeccion_flota_usuario" aria-selected="true">Usuario</a>';
				}
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-ajustes_inspeccion_flota_sistema-tab');
				if ($Respuesta=="SI"){
					$tabshtml .= '	<a class="nav-item nav-link" id="nav-ajustes_inspeccion_flota_sistema-tab" data-toggle="tab" href="#nav-ajustes_inspeccion_flota_sistema" role="tab" aria-controls="nav-ajustes_inspeccion_flota_sistema" aria-selected="false">Sistema</a>';
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
            case "tabla_inspeccion":
                $tablahtml = '	<table id="tabla_inspeccion" class="table table-striped table-bordered table-condensed w-100 tabla_inspeccion"  >
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>FECHA PROGR.</th>
											<th>FLOTA</th>
											<th>SEL.BUSES</th>
											<th>USUARIO GENERA</th>
											<th>FECHA GENERA</th>
											<th>USUARIO CIERRE</th>
											<th>FECHA CIERRE</th>
											<th>ESTADO</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_inspeccion_codigo":
                $tablahtml = '	<table id="tabla_inspeccion_codigo" class="table table-striped table-bordered table-condensed w-100"  >
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

			case "tabla_inspeccion_componente":
                $tablahtml = '	<table id="tabla_inspeccion_componente" class="table table-striped table-bordered table-condensed w-100"  >
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

			case "tabla_inspeccion_falla_accion":
                $tablahtml = '	<table id="tabla_inspeccion_falla_accion" class="table table-striped table-bordered table-condensed w-100"  >
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

			case "tabla_inspeccion_posicion":
                $tablahtml = '	<table id="tabla_inspeccion_posicion" class="table table-striped table-bordered table-condensed w-100"  >
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

			case "tabla_inspeccion_registro_posicion":
                $tablahtml = '	<table id="tabla_inspeccion_registro_posicion" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
										<tr>
											<th>COMPONENTE</th>
											<th>POSICION</th>
											<th>FALLA</th>
											<th>ACCION</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_reporte":
				if($TipoTabla==""){
					$tablahtml = '	<table id="tabla_reporte" class="table table-striped table-bordered table-condensed w-100"  >
										<thead class="text-center">
											<tr>
												<th>INSPECCION ID</th>
												<th>RESPONSABLE</th>
												<th>FECHA INSPECCION BUS</th>
												<th>BUS</th>
												<th>ESTADO BUS</th>
											</tr>
										</thead>
										<tbody>                           
										</tbody>
									</table>';
				}else{
					$tablahtml = '	<table id="tabla_reporte" class="table table-striped table-bordered table-condensed w-100"  >
										<thead class="text-center">
											<tr>
												<th>INSPECCION ID</th>
												<th>RESPONSABLE</th>
												<th>FECHA INSPECCION BUS</th>
												<th>BUS</th>
												<th>ESTADO BUS</th>
												<th>CODIGO</th>
												<th>DESCRIPCION</th>
												<th>ESTADO CODIGO</th>
											</tr>
										</thead>
										<tbody>                           
										</tbody>
									</table>';
				}
            break;

			case "tabla_falla":
                $tablahtml = '	<table id="tabla_falla" class="table table-striped table-bordered table-condensed w-100 tabla_falla"  >
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>ESTADO</th>
											<th>INSP.</th>
											<th>BUS</th>
											<th>COD.</th>
											<th>DESCRIPCION_CODIGO</th>
											<th>COMPONENTE</th>
											<th>POSICION</th>
											<th>FALLA</th>
											<th>ACCION</th>
											<th>RESP. REG.</th>
											<th>FECHA REG.</th>
											<th>RESP. ANUL.</th>
											<th>FECHA ANUL.</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_tc_inspeccion_usuario":
                $tablahtml = '	<table id="tabla_tc_inspeccion_usuario" class="table table-striped table-bordered table-condensed w-100">
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

			case "tabla_tc_inspeccion_sistema":
                $tablahtml = '	<table id="tabla_tc_inspeccion_sistema" class="table table-striped table-bordered table-condensed w-100">
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
            case "tabla_inspeccion":
				$columnashtml = '[	{"data": "inspeccion_id"},
									{"data": "insp_fecha_programada"},					
									{"data": "insp_bus_tipo"},
									{"data": "insp_seleccion_buses"},
									{"data": "insp_nombres_genera"},
									{"data": "insp_fecha_genera"},
									{"data": "insp_nombres_cierre"},
									{"data": "insp_fecha_cierre"},
									{"data": "insp_estado"}
				  				]';
			break;

			case "tabla_inspeccion_codigo":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_inspeccion_codigo'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_inspeccion_codigo'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "inspeccion_codigo_id"},
									{"data": "insp_orden"},
									{"data": "insp_bus_tipo"},
									{"data": "insp_codigo"},
									{"data": "insp_descripcion"},
									{"defaultContent": " '.$defaultContent1.' "}
				  				]';
			break;

			case "tabla_inspeccion_componente":
				/*$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_inspeccion_componente'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_inspeccion_componente'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";*/
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btn-sm btn_borrar_inspeccion_componente'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "inspeccion_componente_id"},
									{"data": "insp_bus_tipo"},
									{"data": "insp_codigo"},
									{"data": "insp_descripcion"},
									{"data": "insp_componente"},
									{"defaultContent": " '.$defaultContent1.' "}
				  				]';
			break;

			case "tabla_inspeccion_falla_accion":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_inspeccion_falla_accion'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_inspeccion_falla_accion'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "inspeccion_falla_accion_id"},
									{"data": "insp_bus_tipo"},
									{"data": "insp_codigo"},
									{"data": "insp_descripcion"},
									{"data": "insp_componente"},
									{"data": "insp_falla"},
									{"data": "insp_accion"},
									{"defaultContent": " '.$defaultContent1.' "}
				  				]';
			break;

			case "tabla_inspeccion_posicion":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_inspeccion_posicion'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_inspeccion_posicion'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "inspeccion_posicion_id"},
									{"data": "insp_bus_tipo"},
									{"data": "insp_codigo"},
									{"data": "insp_descripcion"},
									{"data": "insp_componente"},
									{"data": "insp_posicion"},
									{"defaultContent": " '.$defaultContent1.' "}
				  				]';
			break;

			case "tabla_inspeccion_registro_posicion":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btn-sm btn_borrar_inspeccion_registro_posicion'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "insp_componente"},
									{"data": "insp_posicion"},    
									{"data": "insp_falla"},
									{"data": "insp_accion"},
									{"defaultContent": " '.$defaultContent1.' "}
				  				]';
			break;

			case "tabla_reporte":
				if($TipoTabla==""){
					$columnashtml = '[	{"data": "inspeccion_id"},
										{"data": "Colab_nombre_corto"},    
										{"data": "insp_fecha_detalle"},
										{"data": "insp_bus"},
										{"data": "insp_detalle_estado"}
				  					]';
				}else{
					$columnashtml = '[	{"data": "inspeccion_id"},
										{"data": "Colab_nombre_corto"},    
										{"data": "insp_fecha_detalle"},
										{"data": "insp_bus"},
										{"data": "insp_detalle_estado"},
										{"data": "insp_codigo"},
										{"data": "insp_descripcion"},
										{"data": "insp_estado_codigo"}
				  					]';
				}
			break;

			case "tabla_falla":
				$columnashtml = '[	{"data": "inspeccion_movimiento_id"},
									{"data": "insp_movimiento_estado"},
									{"data": "inspeccion_id"},
									{"data": "insp_bus"},
									{"data": "insp_codigo"},
									{"data": "insp_descripcion"},
									{"data": "insp_componente"},
									{"data": "insp_posicion"},    
									{"data": "insp_falla"},
									{"data": "insp_accion"},
									{"data": "insp_usuario_registra"},
									{"data": "insp_fecha"},
									{"data": "insp_usuario_anula"},
									{"data": "insp_fecha_anula"}
				  				]';
			break;

			case "tabla_tc_inspeccion_usuario":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_tc_inspeccion_usuario'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_tc_inspeccion_usuario'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "tc_inspeccion_id"},
									{"data": "tc_ficha"},
									{"data": "tc_categoria1"},
									{"data": "tc_categoria2"},
									{"defaultContent": " '.$defaultContent1.' "}
								]';
			break;

			case "tabla_tc_inspeccion_sistema":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_tc_inspeccion_sistema'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_tc_inspeccion_sistema'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "tc_inspeccion_id"},
									{"data": "tc_ficha"},
									{"data": "tc_categoria1"},
									{"data": "tc_categoria2"},
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
			case "form_seleccion_inspeccion_codigo":
				switch($NombreObjeto)
				{
					case "btn_seleccion_inspeccion_codigo":
						$botonesformulario = ' <button type="button" id="btn_buscar_inspeccion_codigo" class="btn btn-secondary btn-sm btn_buscar_inspeccion_codigo"> Buscar </button> ';
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btn_nuevo_inspeccion_codigo');
						//if ($Respuesta=="SI"){
							$botonesformulario .= ' <button type="button" id="btn_nuevo_inspeccion_codigo" class="btn btn-secondary btn-sm btn_nuevo_inspeccion_codigo">+ Nuevo</button> ';
						//}
						$botonesformulario .= ' <button type="button" id="btn_descargar_arbol" class="btn btn-secondary btn-sm btn_descargar_arbol">Descargar Arbol</button> ';
					break;
				}
			break;

			case "form_seleccion_inspeccion_componente":
				switch($NombreObjeto)
				{
					case "btn_seleccion_inspeccion_componente":
						$botonesformulario = ' <button type="button" id="btn_buscar_inspeccion_componente" class="btn btn-secondary btn-sm btn_buscar_inspeccion_componente"> Buscar </button> ';
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btn_nuevo_inspeccion_componente');
						//if ($Respuesta=="SI"){
							$botonesformulario .= ' <button type="button" id="btn_nuevo_inspeccion_componente" class="btn btn-secondary btn-sm btn_nuevo_inspeccion_componente">+ Nuevo</button> ';
						//}

					break;
				}
			break;

			case "form_seleccion_inspeccion_falla_accion":
				switch($NombreObjeto)
				{
					case "btn_seleccion_inspeccion_falla_accion":
						$botonesformulario = ' <button type="button" id="btn_buscar_inspeccion_falla_accion" class="btn btn-secondary btn-sm btn_buscar_inspeccion_falla_accion"> Buscar </button> ';
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btn_nuevo_inspeccion_falla_accion');
						//if ($Respuesta=="SI"){
							$botonesformulario .= ' <button type="button" id="btn_nuevo_inspeccion_falla_accion" class="btn btn-secondary btn-sm btn_nuevo_inspeccion_falla_accion">+ Nuevo</button> ';
						//}

					break;
				}
			break;

			case "form_seleccion_inspeccion_posicion":
				switch($NombreObjeto)
				{
					case "btn_seleccion_inspeccion_posicion":
						$botonesformulario = ' <button type="button" id="btn_buscar_inspeccion_posicion" class="btn btn-secondary btn-sm btn_buscar_inspeccion_posicion"> Buscar </button> ';
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btn_nuevo_inspeccion_posicion');
						//if ($Respuesta=="SI"){
							$botonesformulario .= ' <button type="button" id="btn_nuevo_inspeccion_posicion" class="btn btn-secondary btn-sm btn_nuevo_inspeccion_posicion">+ Nuevo</button> ';
						//}

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
			case "form_seleccion_inspeccion_flota":
				switch($NombreObjeto)
				{
					case "btn_seleccion_inspeccion":
						$Mostrar_div = ' <button type="button" id="btn_buscar_inspeccion" class="btn btn-secondary btn-sm btn_buscar_inspeccion">Buscar</button> ';
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btn_nueva_inspeccion');
						if ($Respuesta=="SI"){
							$Mostrar_div .= ' <button type="button" id="btn_nueva_inspeccion" class="btn btn-secondary btn-sm btn_nueva_inspeccion">+ Nuevo</button> ';
						}
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btn_cerrar_inspeccion');
						if ($Respuesta=="SI"){
							if($Dato=='ABIERTO'){
								$Mostrar_div .= ' <button type="button" id="btn_cerrar_inspeccion" class="btn btn-secondary btn-sm btn_cerrar_inspeccion">Cerrar</button> ';
							}
						}
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btn_anular_inspeccion');
						if ($Respuesta=="SI"){
							if($Dato=='ABIERTO'){
								$Mostrar_div .= ' <button type="button" id="btn_anular_inspeccion" class="btn btn-secondary btn-sm btn_anular_inspeccion">Anular</button> ';
							}
						}
						if($Dato=="ABIERTO"){
							$Mostrar_div .= ' <button type="button" id="btn_registro_inspeccion" class="btn btn-secondary btn-sm btn_registro_inspeccion">Inspeccion</button> ';
						}
					break;
				}
			break;

			case "form_inspeccion":
				switch($NombreObjeto)
				{
					case "div_seleccion_buses":
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta = $InstanciaAjax->BuscarDataBD('Buses', 'Bus_Tipo2', $Dato);
						$Mostrar_div = '	<div class="col-lg-12">
												<div class="overflow-auto border border-muted border-radius rounded p-3 w-100" style="max-width:max-content; max-height:500px;"> ';
						foreach ($Respuesta as $row){
							$Mostrar_div .= ' 		<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="'.$row['Bus_NroExterno'].'" value="">
														<label class="form-check-label" for="'.$row['Bus_NroExterno'].'">'.$row['Bus_NroExterno'].'</label>
						  							</div> ';
						}
						$Mostrar_div .= '		</div>
											</div>';
					break;
				}
			break;

			case "form_seleccion_inspeccion_registro":
				switch($NombreObjeto)
				{
					case "btn_seleccion_inspeccion_registro":
						$Mostrar_div = ' <button type="button" id="btn_buscar_inspeccion_bus" class="btn btn-secondary btn-sm btn_buscar_inspeccion_bus">Buscar</button> ';
					break;

					case "btn_enviar_inspeccion_registro":
							MModel($this->Modulo, 'CRUD');
							$InstanciaAjax= new CRUD();
							$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btn_enviar_inspeccion_registro');
							if ($Respuesta=="SI"){
								$Mostrar_div = '	<div class="col col-lg-2 col-sm-3 p2">
														<p>INSPECCION BUS '.$Dato.'</p>
													</div>
													<div class="col col-lg-1 col-sm-2 p2">
														<button type="button" id="btn_enviar_inspeccion_registro" class="btn btn-secondary btn-sm btn_enviar_inspeccion_registro">Enviar</button> 
													</div> ';
													
							}
					break;

				}
			break;

			case "form_seleccion_reporte":
				switch($NombreObjeto)
				{
					case "btn_seleccion_reporte":
						$Mostrar_div = ' <button type="button" id="btn_buscar_reporte" class="btn btn-secondary btn-sm btn_buscar_reporte">Buscar</button> ';
					break;
				}
			break;

			case "form_seleccion_falla":
				switch($NombreObjeto)
				{
					case "btn_seleccion_falla":
						$Mostrar_div  = ' <button type="button" id="btn_buscar_falla" class="btn btn-secondary btn-sm btn_buscar_falla">Buscar</button> ';
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btn_crear_falla');
						if ($Respuesta=="SI"){
							$Mostrar_div .= ' <button type="button" id="btn_crear_falla" class="btn btn-secondary btn-sm btn_crear_falla">+ Falla</button> ';
						}
						if($Dato=='ACTIVO'){
							MModel($this->Modulo, 'CRUD');
							$InstanciaAjax= new CRUD();
							$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btn_anular_falla');
							if ($Respuesta=="SI"){
								$Mostrar_div .= ' <button type="button" id="btn_anular_falla" class="btn btn-secondary btn-sm btn_anular_falla">Anular</button> ';
							}						
						}
					break;
				}
			break;

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