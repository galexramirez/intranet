<?php
class Accesos
{
	var $Modulo="Materiales";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-Materiales":
				$tabshtml = '	<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Listado</a>
								<a class="nav-item nav-link" id="nav-proveedores-tab" data-toggle="tab" href="#nav-proveedores" role="tab" aria-controls="nav-proveedores" aria-selected="false">Proveedores</a>
								<a class="nav-item nav-link" id="nav-repuesto_proveedor-tab" data-toggle="tab" href="#nav-repuesto_proveedor" role="tab" aria-controls="nav-repuesto_proveedor" aria-selected="false">Repuesto Proveedor</a>
								<a class="nav-item nav-link" id="nav-cargarprecios-tab" data-toggle="tab" href="#nav-cargarprecios" role="tab" aria-controls="nav-cargarprecios" aria-selected="false">Cargar Precios</a>
								<a class="nav-item nav-link" id="nav-preciosproveedor-tab" data-toggle="tab" href="#nav-preciosproveedor" role="tab" aria-controls="nav-preciosproveedor" aria-selected="false">Precios Proveedor</a>';
								/*<a class="nav-item nav-link" id="nav-asignarcodigos-tab" data-toggle="tab" href="#nav-asignarcodigos" role="tab" aria-controls="nav-asignarcodigos" aria-selected="false">Asignar Códigos</a>
								<a class="nav-item nav-link" id="nav-precios_material-tab" data-toggle="tab" href="#nav-precios_material" role="tab" aria-controls="nav-precios_material" aria-selected="false">Precios Material</a>';*/
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-ajustes_material-tab');
				if ($Respuesta=="SI"){
					$tabshtml .= '<a class="nav-item nav-link" id="nav-ajustes_material-tab" data-toggle="tab" href="#nav-ajustes_material" role="tab" aria-controls="nav-ajustes_material" aria-selected="false">Ajustes</a>';
				}

			break;

			case "nav-tab-ajustes_material":
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-ajustes_material_usuario-tab');
				if ($Respuesta=="SI"){
					$tabshtml = '	<a class="nav-item nav-link active" id="nav-ajustes_material_usuario-tab" data-toggle="tab" href="#nav-ajustes_material_usuario" role="tab" aria-controls="nav-ajustes_material_usuario" aria-selected="true">Usuario</a>';
				}
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->Permisos($this->Modulo,'nav-ajustes_material_sistema-tab');
				if ($Respuesta=="SI"){
					$tabshtml .= '	<a class="nav-item nav-link" id="nav-ajustes_material_sistema-tab" data-toggle="tab" href="#nav-ajustes_material_sistema" role="tab" aria-controls="nav-ajustes_material_sistema" aria-selected="false">Sistema</a>';
				}
				$tabshtml .= '	<a class="nav-item nav-link" id="nav-ajustes_unidad-tab" data-toggle="tab" href="#nav-ajustes_unidad" role="tab" aria-controls="nav-ajustes_unidad" aria-selected="false">Unidad</a>';
			break;

		}
		echo $tabshtml;
	}
	
    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
		$tablahtml = "";
        switch ($NombreTabla) 
		{
            case "tablaMateriales":
				MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btnEditarMateriales');

                $tablahtml = '	<table id="tablaMateriales" class="table table-striped table-bordered table-condensed w-80">
									<thead class="text-center">
										<tr>
											<th>CÓDIGO</th>
											<th>DESCRIPCIÓN</th>
											<th>UNIDAD_MEDIDA</th>
											<th>TIPO</th>
											<th>COD.PATRIMONIAL</TH>
											<th>CATEGORIA</th>
											<th>MACROSISTEMA</th>
											<th>SISTEMA</th>
											<th>TARJETA</th>
											<th>CONDICION</th>
											<th>FLOTA</th>
											<th>RESPONSABLE_CREACIÓN</th>
											<th>FECHA_CREACIÓN</th>
											<th>ESTADO</th>
											<th>PROVEEDOR</th>';
                if($Respuesta=="SI"){
                    $tablahtml .=          '<th>ACCIONES</th>';
                }
				$tablahtml .=			'</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tablaProveedores":
                $tablahtml = '	<table id="tablaProveedores" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
										<th>RUC</th>
										<th>RAZON_SOCIAL</th>
										<th>CONTACTO</th>
										<th>CUENTA_DETRACCION_SOLES</th> 
										<th>CUENTA_BANCARIA_SOLES</th> 
										<th>CUENTA_BANCARIA_DOLARES</th>
										<th>CUENTA_INTERBANCARIA_SOLES</th> 
										<th>CUENTA_INTERBANCARIA_DOLARES</th>
										<th>CONDICION DE PAGO</th>  
										<th>CORREO</th>
										<th>TELEFONO</th>
										<th>ESTADO</th>
										<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>';
            break;

			case "tabla_repuesto_proveedor":
                $tablahtml = '	<table id="tabla_repuesto_proveedor" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>CODIGO</th>
											<th>DESCRIPCION</th>
											<th>UNIDAD</th>
											<th>ESTADO</th>
											<th>MATERIAL_ID</th>
											<th>DESCRIPCION MATERIAL</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>';
            break;

			case "tablaCargarPrecios":
                $tablahtml = '	<table id="tablaCargarPrecios" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>NRO.REGISTROS</th>
											<th>FECHA_CARGA</th>
											<th>RAZON SOCIAL DEL PROVEEDOR</th>
											<th>RESPONSABLE_CARGA</th>
											<th>FECHA_ELIMINACION</th>
											<th>RESPONSABLE_ELIMINACION</th>
											<th>ESTADO</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>';
            break;

            case "tablaPreciosProveedor":
                $tablahtml = '	<table id="tablaPreciosProveedor" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>ID</th>	
											<th>CÓDIGO_PROVEEDOR</th>
											<th>DESCRIPCIÓN_PROVEEDOR</th>
											<th>TIPO</th>
											<th>MARCA</th>
											<th>PROCEDENCIA</th>
											<th>UNIDAD</th>
											<th>GARANTIA</th>
											<th>MONEDA</th>
											<th>PRECIO</th>
											<th>PRECIO_SOLES</th>
											<th>RUC</th>
											<th>RAZON_SOCIAL</th>
											<th>CÓDIGO_LBI</th>
											<th>DESCRIPCIÓN_LBI</th>
											<TH>DOCUMENTACIÓN</th>
											<th>FECHA VIGENCIA</th>
											<th>ID_CARGA</th>											
											<th>FECHA_CARGA</th>
											<th>RESPONSABLE_CARGA</th>
											<th>ESTADO</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tablaAsignarCodigos":
                $tablahtml = '	<table id="tablaAsignarCodigos" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>CÓDIGO_PROVEEDOR</th>
											<th>DESCRIPCIÓN_PROVEEDOR</th>
											<th>UNIDAD</th>
											<th>RAZON_SOCIAL</th>
											<th>CÓDIGO_LBI</th>
											<th>DESCRIPCIÓN_LBI</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

            case "tabla_precios_material":
                $tablahtml = '	<table id="tabla_precios_material" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>ID</th>	
											<th>CÓDIGO_PROVEEDOR</th>
											<th>DESCRIPCIÓN_PROVEEDOR</th>
											<th>TIPO</th>
											<th>MARCA</th>
											<th>PROCEDENCIA</th>
											<th>UNIDAD</th>
											<th>GARANTIA</th>
											<th>MONEDA</th>
											<th>PRECIO</th>
											<th>PRECIO_SOLES</th>
											<th>FECHA VIGENCIA</th>
											<th>ID_CARGA</th>											
											<th>FECHA_CARGA</th>
											<th>RESPONSABLE_CARGA</th>
											<th>ESTADO</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_tc_material_usuario":
                $tablahtml = '	<table id="tabla_tc_material_usuario" class="table table-striped table-bordered table-condensed w-100">
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

			case "tabla_tc_material_sistema":
                $tablahtml = '	<table id="tabla_tc_material_sistema" class="table table-striped table-bordered table-condensed w-100">
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

			case "tabla_unidad":
                $tablahtml = '	<table id="tabla_unidad" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>DESCRIPCION</th>
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
            case "tablaMateriales":
				MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btnEditarMateriales');

				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btnEditarMateriales'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "material_id"},
									{"data": "material_descripcion"},
									{"data": "mate_unidad_medida"},
									{"data": "material_tipo"},
									{"data": "material_patrimonial"},
									{"data": "material_categoria"},
									{"data": "material_macrosistema"},
									{"data": "material_sistema"},
									{"data": "material_tarjeta"},
									{"data": "material_condicion"},
									{"data": "material_flota"},
									{"data": "material_nombreresponsablecreacion"},
									{"data": "material_fechacreacion"},
									{"data": "material_estado"},
									{"data": "proveedor"}';
				if($Respuesta=="SI"){
                    $columnashtml.= ' ,{"defaultContent": "'.$defaultContent1.'"}';
                }                
				$columnashtml .= ']';
			break;

			case "tablaProveedores":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarProveedores'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "prov_ruc"},
									{"data": "prov_razonsocial"},
									{"data": "prov_contacto"},
									{"data": "prov_cta_detraccion_soles"},
									{"data": "prov_cta_banco_soles"},
									{"data": "prov_cta_banco_dolares"},
									{"data": "prov_cta_interbanco_soles"},
									{"data": "prov_cta_interbanco_dolares"},
									{"data": "prov_condicion_pago"},
									{"data": "prov_correo"},
									{"data": "prov_telefono"},
									{"data": "prov_estado"},
									{"defaultContent": " '.$defaultContent1.' "}
								]';
			break;

			case "tabla_repuesto_proveedor":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_repuesto_proveedor'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "repp_codigo"},
									{"data": "repp_descripcion"},
									{"data": "repp_unidad"},
									{"data": "repp_estado"},
									{"data": "repp_material_id"},
									{"data": "repp_material_descripcion"},
									{"defaultContent": " '.$defaultContent1.' "}
								]';
			break;

			case "tablaCargarPrecios":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='ELIMINAR' class='btn btn-danger btn-sm btnEliminarCargarPrecios'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "cpm_id"},
									{"data": "cpm_nroregistros"},
									{"data": "cpm_fechacarga"},
									{"data": "cpm_prov_razon_social"},
									{"data": "cpm_responsablecarga"},
									{"data": "cpm_fechaeliminacion"},
									{"data": "cpm_responsableeliminacion"},
									{"data": "cpm_estado"},
									{"defaultContent": " '.$defaultContent1.' "}
								]';
			break;

			case "tablaPreciosProveedor":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='ANULAR' class='btn btn-sm btnAnularPreciosProveedor'><i class='bi bi-x-square'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-square' viewBox='0 0 16 16'><path d='M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z'/><path d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "precioprov_id"},
									{"data": "precioprov_codproveedor"},
									{"data": "precioprov_descripcion"},
									{"data": "precioprov_tipo"},									
									{"data": "precioprov_marca"},
									{"data": "precioprov_procedencia"},
									{"data": "precioprov_unidadmedida"},
									{"data": "precioprov_garantia"},
									{"data": "precioprov_moneda"},
									{"data": "precioprov_precio"},
									{"data": "precioprov_preciosoles"},
									{"data": "precioprov_ruc"},
									{"data": "precioprov_razonsocial"},
									{"data": "precioprov_materialid"},
									{"data": "precioprov_materialdescripcion"},
									{"data": "precioprov_documentacion"},
									{"data": "precioprov_maxfechavigencia"},
									{"data": "precioprov_cargaid"},
									{"data": "precioprov_fechacreacion"},
									{"data": "precioprov_responsablecreacion"},
									{"data": "precioprov_estado"},
									{"defaultContent": " '.$defaultContent1.' "}
								]';
			break;

			case "tablaAsignarCodigos":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='PDF' class='btn btn-danger btn-sm btnAdjuntarPDF'><i class='bi bi-file-earmark-pdf'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-file-earmark-pdf' viewBox='0 0 16 16'><path d='M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z'/><path d='M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z'/></svg></i></button><button title='Asignar' class='btn btn-warning btn-sm btnAsignarCodigos'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "precioprov_codproveedor"},
									{"data": "precioprov_descripcion"},
									{"data": "precioprov_unidadmedida"},
									{"data": "precioprov_razonsocial"},
									{"data": "precioprov_materialid"},
									{"data": "material_descripcion"},
									{"defaultContent": " '.$defaultContent1.' "}
								]';
			break;

			case "tabla_precios_material":
				$columnashtml = '[	{"data": "precioprov_id"},
									{"data": "precioprov_codproveedor"},
									{"data": "precioprov_descripcion"},
									{"data": "precioprov_tipo"},									
									{"data": "precioprov_marca"},
									{"data": "precioprov_procedencia"},
									{"data": "precioprov_unidadmedida"},
									{"data": "precioprov_garantia"},
									{"data": "precioprov_moneda"},
									{"data": "precioprov_precio"},
									{"data": "precioprov_preciosoles"},
									{"data": "precioprov_fechavigencia"},
									{"data": "precioprov_cargaid"},
									{"data": "precioprov_fechacreacion"},
									{"data": "precioprov_responsablecreacion"},
									{"data": "precioprov_estado"}
								]';
			break;

			case "tabla_tc_material_usuario":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_tc_material_usuario'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_tc_material_usuario'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "tc_material_id"},
									{"data": "tc_categoria1"},
									{"data": "tc_categoria2"},
									{"data": "tc_categoria3"},
									{"defaultContent": " '.$defaultContent1.' "}
								]';
			break;

			case "tabla_tc_material_sistema":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_tc_material_sistema'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_tc_material_sistema'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "tc_material_id"},
									{"data": "tc_categoria1"},
									{"data": "tc_categoria2"},
									{"data": "tc_categoria3"},
									{"defaultContent": " '.$defaultContent1.' "}
								]';
			break;

			case "tabla_unidad":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_unidad'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button title='Borrar' class='btn btn-danger btn-sm btn_borrar_unidad'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "unidad_medida"},
									{"data": "um_descripcion"},
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