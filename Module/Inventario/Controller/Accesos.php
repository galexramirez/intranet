<?php
class Accesos
{
	var $Modulo="Inventario";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-inventario":
				$tabshtml = '	<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Movimientos</a>								
								<a class="nav-item nav-link" id="nav-entrada-tab" data-toggle="tab" href="#nav-entrada" role="tab" aria-controls="nav-entrada" aria-selected="false"><span id="id_nav_entrada">Entradas</span></a>
								<a class="nav-item nav-link" id="nav-salida-tab" data-toggle="tab" href="#nav-salida" role="tab" aria-controls="nav-salida" aria-selected="false"><span id="id_nav_salida">Salidas</span></a>
								<a class="nav-item nav-link" id="nav-almacen-tab" data-toggle="tab" href="#nav-almacen" role="tab" aria-controls="nav-almacen" aria-selected="false">Almacen</a>
								<a class="nav-item nav-link" id="nav-material_almacen-tab" data-toggle="tab" href="#nav-material_almacen" role="tab" aria-controls="nav-material_almacen" aria-selected="false">Material por Almacen</a>
								<a class="nav-item nav-link" id="nav-inventario-tab" data-toggle="tab" href="#nav-inventario" role="tab" aria-controls="nav-inventario" aria-selected="false">Inventario</a>
								<a class="nav-item nav-link" id="nav-reportes-tab" data-toggle="tab" href="#nav-reportes" role="tab" aria-controls="nav-reportes" aria-selected="false">Reportes</a>';
			break;
		}
		echo $tabshtml;
	}
	
    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
		$tablahtml = "";
        switch ($NombreTabla) 
		{
            case "tabla_movimiento":
                $tablahtml = '	<table id="tabla_movimiento" class="table table-striped table-bordered table-condensed w-80">
									<thead class="text-center">
										<tr>
											<th>VER</th>
											<th>COD.INVENTARIO</th>
											<th>FECHA_INVENTARIO</th>
											<th>ALMACEN_DESCRIPCION</th>
											<th>MOVIMIENTO</th>
											<th>TIPO_MOVIMIENTO</th>
											<th>TIPO_DOCUMENTO</th>
											<th>NRO_DOCUMENTO</th>
											<th>REGISTRADO_POR</th>
											<th>CAMPO_1</th>
											<th>CAMPO_2</th>
											<th>CAMPO_3</th>
											<th>ESTADO</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_materiales_entrada":
                $tablahtml = '  <table id="tabla_materiales_entrada" class="table table-striped table-bordered table-condensed w-100">
                                    <thead class="text-center">
                                        <tr>
											<th>CODIGO</th>
											<th>DESCRIPCION_DE_MATERIALES</th>
                                            <th>UNIDAD_MEDIDA</th>
											<th>CANTIDAD</th>
											<th>MONEDA</th>
											<th>PRECIO</th>
											<th>PRECIO_SOLES</th>
											<th>PATRIMONIAL</th>';
				if($TipoTabla=="SI"){
					$tablahtml .= '			<th>ACCIONES</th>';
				}
				$tablahtml .= '	        </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

            case "tabla_almacen":
                $tablahtml = '	<table id="tabla_almacen" class="table table-striped table-bordered table-condensed w-80">
									<thead class="text-center">
										<tr>
											<th>VER</th>
											<th>COD.ALMACEN</th>
											<th>FECHA_CREACION</th>
											<th>DESCRIPCION</th>
											<th>UBICACION</th>
											<th>DIMENSIONES</th>
											<th>RESPONSABLE</th>
											<th>CAMPO_1</th>
											<th>CAMPO_2</th>
											<th>CAMPO_3</th>
											<th>ESTADO</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_material_almacen":
                $tablahtml = '	<table id="tabla_material_almacen" class="table table-striped table-bordered table-condensed w-80">
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>CODIGO MATERIAL</th>
											<th>DESCRIPCION_MATERIAL</th>
											<th>DESCRIPCION_ALMACEN</th>
											<th>RESPONSABLE</th>
											<th>FECHA_REGISTRO</th>
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
            case "tabla_movimiento":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Ver' class='btn btn-sm btn_ver_movimiento'><i class='bi bi-search'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg></i></button></div></div>";
				$defaultContent2 = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_movimiento'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"defaultContent": " '.$defaultContent1.' "},
									{"data": "inventario_registro_id"},
									{"data": "invr_fecha_creacion"},
									{"data": "invr_almacen_descripcion"},
									{"data": "invr_movimiento"},
									{"data": "invr_tipo_movimiento"},
									{"data": "invr_tipo_documento"},
									{"data": "invr_nro_documento"},
									{"data": "invr_usuario_nombre"},
									{"data": "invr_campo_1"},
									{"data": "invr_campo_2"},
									{"data": "invr_campo_3"},
									{"data": "invr_estado"},
									{"defaultContent": " '.$defaultContent2.' "}
								]';
			break;

			case "tabla_materiales_entrada":
				$columnashtml = ' [ {"data": "entm_material_id"},
									{"data": "entm_descripcion"},
                                    {"data": "entm_unidad_medida"},
									{"data": "entm_cantidad"},
									{"data": "entm_moneda"},
									{"data": "entm_precio"},
									{"data": "entm_precio_soles"},
									{"data": "entm_patrimonial"}';
				if($TipoTabla=="SI"){
					$defaultContent = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_materiales_entrada'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button tittle='Borrar' class='btn btn-danger btn-sm btn_borrar_materiales_entrada'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
					$columnashtml .= ',{"defaultContent": " '.$defaultContent.' "}';	
				}
				$columnashtml .= ']';
            break;

			case "tabla_almacen":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Ver' class='btn btn-sm btn_ver_almacen'><i class='bi bi-search'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg></i></button></div></div>";
				$defaultContent2 = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_almacen'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"defaultContent": " '.$defaultContent1.' "},
									{"data": "almacen_id"},
									{"data": "alm_fecha_creacion"},
									{"data": "alm_descripcion"},
									{"data": "alm_ubicacion"},
									{"data": "alm_dimensiones"},
									{"data": "alm_nombre_responsable"},
									{"data": "alm_campo_1"},
									{"data": "alm_campo_2"},
									{"data": "alm_campo_3"},
									{"data": "alm_estado"},
									{"defaultContent": " '.$defaultContent2.' "}
								]';
			break;

			case "tabla_material_almacen":
				$defaultContent = "<div class='text-center'><div class='btn-group'><button tittle='Borrar' class='btn btn-danger btn-sm btn_borrar_material_almacen'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = ' [ {"data": "material_almacen_id"},
									{"data": "malm_material_id"},
									{"data": "malm_descripcion_material"},
									{"data": "malm_descripcion_almacen"},
                                    {"data": "malm_responsable"},
									{"data": "malm_fecha"},
									{"defaultContent": " '.$defaultContent.' "}';
				$columnashtml .= ']';
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
			case "form_seleccion_material_almacen":
				switch($NombreObjeto)
				{
					case "btn_seleccion_material_almacen":
						$botonesformulario = '<button type="button" id="btn_buscar_material_almacen" class="btn btn-secondary btn-sm mr-1 btn_buscar_material_almacen">Buscar</button>';
						$botonesformulario .= '<button type="button" id="btn_nuevo_material_almacen" class="btn btn-secondary btn-sm mr-1 btn_nuevo_material_almacen">+ Nuevo</button>';
					break;
				}
			break;

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

					break;
				}
			break;

			case "form_entrada":
				$botones_1 = '';
				$botones_2 = '';
				if($NombreObjeto=="vacio"){
					$divformulario = "";
				}else{
					switch($NombreObjeto)
					{
						case "editar":
							$botones_1 = '	<button type="button" id="btn_materiales_entrada" class="btn btn-secondary btn-sm mr-1 btn_materiales_entrada">+ Materiales</button>
											<button type="button" id="btn_materiales_importar" class="btn btn-secondary btn-sm mr-1 btn_materiales_importar">+ Importar</button>';
							$botones_2 = '	<button type="button" id="btn_cancelar_entrada" class="btn btn-light btn-sm btn_cancelar_entrada">Cancelar</button>
											<button type="button" id="btn_guardar_entrada" class="btn btn-secondary btn-sm btn_guardar_entrada">Guardar</button>';
						break;
					}
					$divformulario = '<form id="form_entrada" enctype="multipart/form-data" action="" method="post" onsubmit="return false;">    
					<div class="form-group">
						<div class="row">
							<div class="col-lg-6 mx-1 border border-muted border-radius rounded">
								 <div class="row d-flex justify-content-araound">
									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-5">
												<div class="form-group form-control-sm mb-1">
													<label for="t_entrada_id" class="col-form-label form-control-sm mb-1">N° ENTRADA :</label>
												</div>
											</div>
											<div class="col-lg-7">
												<div class="form-group form-control-sm mb-1">
													<input type="text" readonly class="form-control form-control-sm mb-1" id="t_entrada_id">
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-5">
												<div class="form-group form-control-sm mb-1">
													<label for="ent_fecha_creacion" class="col-form-label form-control-sm mb-1">FECHA ENTRADA :</label>
												</div>
											</div>
											<div class="col-lg-7">
												<div class="form-group form-control-sm mb-1">
													<input type="date" readonly class="form-control form-control-sm mb-1" id="ent_fecha_creacion">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row d-flex justify-content-araound">
									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-5">
												<div class="form-group form-control-sm mb-1">
													<label for="ent_almacen_descripcion" class=	"col-form-label form-control-sm mb-1">ALMACEN :</label>
												</div>
											</div>
											<div class="col-lg-7">
												<div class="form-group form-control-sm mb-1">
													<select class="form-control form-control-sm mb-1" id="ent_almacen_descripcion">

													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-5">
												<div class="form-group form-control-sm mb-1">
													<label for="ent_tipo_movimiento" class="col-form-label form-control-sm mb-1">TIPO ENTRADA :</label>
												</div>
											</div>
											<div class="col-lg-7">
												<div class="form-group form-control-sm mb-1">
													<select class="form-control form-control-sm mb-1 ent_tipo_movimiento" id="ent_tipo_movimiento">

													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row d-flex justify-content-araound">
									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-5">
												<div class="form-group form-control-sm mb-1">
													<label for="ent_tipo_documento" class="col-form-label form-control-sm mb-1">TIPO DOCUMENTO :</label>
												</div>
											</div>
											<div class="col-lg-7">
												<div class="form-group form-control-sm mb-1">
													<select class="form-control form-control-sm mb-1 ent_tipo_documento" id="ent_tipo_documento">

													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-5">
												<div class="form-group form-control-sm mb-1">
													<label for="ent_nro_documento" class="col-form-label form-control-sm mb-1">NRO. DOCUMENTO :</label>
												</div>
											</div>
											<div class="col-lg-7">
												<div class="form-group form-control-sm mb-1">
													<input type="number" class="form-control form-control-sm mb-1 ent_nro_documento" id="ent_nro_documento">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row d-flex justify-content-araound">
									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-5">
												<div class="form-group form-control-sm mb-1">
													<label for="ent_nombre_entrega" class="col-form-label form-control-sm mb-1">ENTREGADO POR :</label>
												</div>
											</div>
											<div class="col-lg-7">
												<div class="form-group form-control-sm mb-1">
													<input type="text" class="form-control form-control-sm mb-1 text-uppercase ent_nombre_entrega" id="ent_nombre_entrega">
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-5">
												<div class="form-group form-control-sm mb-1">
													<label for="ent_centro_costo" class="col-form-label form-control-sm">CENTRO DE COSTO</label>
												</div>
											</div>
											<div class="col-lg-7">
												<div class="form-group form-control-sm mb-1">
													<select type="text" class="form-control form-control-sm" id="ent_centro_costo">

													</select>
												</div>
											</div>	
									  	</div> 
								  	</div>
								</div>

								<div class="row d-flex justify-content-araound">
									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-5">
												<div class="form-group form-control-sm mb-1">
													<label for="ent_usuario_nombre" class="col-form-label form-control-sm mb-1">REGISTRADO POR :</label>
												</div>
											</div>
											<div class="col-lg-7">
												<div class="form-group form-control-sm mb-1">
													<input type="text" readonly class="form-control form-control-sm mb-1" id="ent_usuario_nombre">
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-5">
												<div class="form-group form-control-sm mb-1">
													<label for="ent_estado" class="col-form-label form-control-sm mb-1">ESTADO :</label>
												</div>
											</div>
											<div class="col-lg-7">
												<div class="form-group form-control-sm mb-1">
													<input type="text" readonly class="form-control form-control-sm mb-1" id="ent_estado">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row d-flex justify-content-araound">
									<div class="col-lg-12">
										<div class="row align-items-end d-flex">
											<div class="btn-toolbar ml-auto p-2" role="toolbar" aria-label="Toolbar with button groups">
												<div class="btn-group" role="group" aria-label="Four group" id="div_btn_agregar_materiales_entrada">
													'.$botones_1.'
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row d-flex justify-content-araound">
									<div class="col-lg-12">
										<div class="container-fluid caja">
											<div class="row w-100 p-0 m-0">
												   <div class="col-lg-12">
													   <div class="table-responsive" id="div_tabla_materiales_entrada">        
														   <!-- CreacionTabla -->
													</div>
												</div>
											</div>  
										</div>
									</div>
								</div>
								<div class="row d-flex justify-content-araound">
									<div class="col-lg-12">
										<div class="row">
											<div class="form-group col-lg-1 mb-1">
												<button type="button" id="btn_log_entrada" class="btn btn-info btn-sm btn_log_entrada">Log...</button>
											</div>
											<div class="form-group col-lg-11 mb-1">
												<textarea class="form-control form-control-sm mb-3 text-uppercase" id="obs_ent_log" rows="1" placeholder="escribe algo aqui..."></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="row d-flex justify-content-center">
									<div class="col-lg-4">
										<div class="form-group align-items-center d-flex" id="div_btn_guardar_entrada">
											'.$botones_2.'
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>		
				</form>';
				}
			break;

		}
		echo $divformulario;
    }

	public function MostrarDiv($NombreFormulario,$NombreObjeto,$Dato1,$Dato2)
	{
		$Mostrar_div = "";
		switch($NombreFormulario)
		{
			case "form_seleccion_movimiento":
				switch($NombreObjeto)
				{
					case "btn_seleccion_movimiento":
						switch($Dato1)
						{
							case "buscar":
								$Mostrar_div = '<button type="button" id="btn_buscar_movimiento" class="btn btn-secondary btn-sm btn_buscar_movimiento">Buscar</button>';
							break;

							case "generar":
								MModel($this->Modulo, 'CRUD');
								$InstanciaAjax= new CRUD();
								$Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btn_generar_movimiento");
								$Mostrar_div = '<button type="button" id="btn_buscar_movimiento" class="btn btn-secondary btn-sm btn_buscar_movimiento">Buscar</button>';
								if($Respuesta=="SI"){
									$Mostrar_div .= '<button type="button" id="btn_generar_movimiento" class="btn btn-secondary btn-sm btn_generar_movimiento ml-1">Generar</button>';
								}
							break;

						}
					break;
				}
			break;

			case "form_seleccion_entrada":
				switch($NombreObjeto)
				{
					case "btn_seleccion_entrada":
						$btn_cargar_entrada = '<button type="button" id="btn_cargar_entrada" class="btn btn-secondary btn-sm btn_cargar_entrada mr-1">Cargar</button>';
						$btn_editar_entrada = '<button type="button" id="btn_editar_entrada" class="btn btn-secondary btn-sm btn_editar_entrada mr-1">Editar</button>';
						$btn_nuevo_entrada = '<button type="button" id="btn_nuevo_entrada" class="btn btn-secondary btn-sm btn_nuevo_entrada mr-1">+ Entrada</button>';
						switch($Dato1)
						{
							case "inicio":
								$Mostrar_div = $btn_cargar_entrada;
								$Mostrar_div .= $btn_nuevo_entrada;
							break;

							case "nuevo":
								$Mostrar_div = "";
							break;

							case "cargar":
								$Mostrar_div = $btn_cargar_entrada;
								$Mostrar_div .= $btn_editar_entrada;
							break;
	
						}
					break;
				}
			break;

			case "form_seleccion_almacen":
				switch($NombreObjeto)
				{
					case "btn_seleccion_almacen":
						switch($Dato1)
						{
							case "nuevo":
								MModel($this->Modulo, 'CRUD');
								$InstanciaAjax= new CRUD();
								$Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btn_nuevo_almacen");
								if($Respuesta=="SI"){
									$Mostrar_div = '<button type="button" id="btn_nuevo_almacen" class="btn btn-secondary btn-sm btn_nuevo_almacen mt-3">+ Nuevo</button>';
								}
							break;

							case "":
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
		}
		echo $Mostrar_div;
    }

	public function MostrarObjetos($NombresObjetos, $Accion)
	{
		$MostrarObjetos = "";
		switch($NombresObjetos)
		{
			case "":
				switch($NombresObjetos)
				{
					case "":
						$divformulario = '';
					break;

					case "":
					break;

				}
			break;
		}
		echo $MostrarObjetos;
    }


}