<?php
class Accesos
{
	var $Modulo="Pedidos";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-pedidos":
				$tabshtml = '	<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Listado</a>
								<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><span id="idProcesar">Procesar</span></a>
								<a class="nav-item nav-link" id="nav-cotizacion-tab" data-toggle="tab" href="#nav-cotizacion" role="tab" aria-controls="nav-cotizacion" aria-selected="false">Cotizaciones</a>
								<a class="nav-item nav-link" id="nav-orden_compra-tab" data-toggle="tab" href="#nav-orden_compra" role="tab" aria-controls="nav-orden_compra" aria-selected="false">Orden de Compra</a>';
			break;
		}
		echo $tabshtml;
	}
	
    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
		$tablahtml = "";
        switch ($NombreTabla) 
		{
            case "tabla_pedido":
                $tablahtml = '	<table id="tabla_pedido" class="table table-striped table-bordered table-condensed w-80">
									<thead class="text-center">
										<tr>
											<th>VER</th>
											<th>COD.PEDIDO</th>
											<th>TIPO</th>
											<th>FECHA_PEDIDO</th>
											<th>FECHA_REQUERIMIENTO</th>
											<th>PRIORIDAD</th>
											<th>CENTRO_DE_COSTO</th>
											<th>ORD.COMP.DIRECTA</th>
											<th>PROCESO_SOLICITANTE</th>
											<th>CONTACTO</th>
											<th>DIRECCION_DE_ENTREGA</th>
											<th>RESPONSABLE</th>
											<th>ESTADO</th>
											<th>ESTADO_OBS.</th>
											<th>COMP.COTIZ.</th>
											<th>ORD.COMPRA</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

            case "tabla_material_pedido":
                $tablahtml = '  <table id="tabla_material_pedido" class="table table-striped table-bordered table-condensed w-100">
                                    <thead class="text-center">
                                        <tr>
											<th>CODIGO</th>
											<th>DESCRIPCION</th>
                                            <th>UNIDAD_MEDIDA</th>
											<th>CANTIDAD</th>
											<th>BUS</th>
											<th>OBSERVACIONES</th>';
				if($TipoTabla=="SI"){
					$tablahtml .= '			<th>ACCIONES</th>';
				}
				$tablahtml .= '	        </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

			case "tabla_ver_material_pedido":
                $tablahtml = '  <table id="tabla_ver_material_pedido" class="table table-striped table-bordered table-condensed w-100">
                                    <thead class="text-center">
                                        <tr>
											<th>CODIGO</th>
											<th>DESCRIPCION</th>
                                            <th>UNIDAD_MEDIDA</th>
											<th>CANTIDAD</th>
											<th>BUS</th>
											<th>OBSERVACIONES</th>
										</tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

			case "tabla_cotizacion":
                $tablahtml = '	<table id="tabla_cotizacion" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>COD.COTIZ.</th>
											<th>FECHA_COTIZACION</th>
											<th>RAZON_SOCIAL</th>
											<th>RESPONSABLE</th>
											<th>ESTADO</th>
											<th>PDF_SOL.COT.</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>';
            break;

			case "tabla_material_cotizacion":
                $tablahtml = '  <table id="tabla_material_cotizacion" class="table table-striped table-bordered table-condensed w-100">
                                    <thead class="text-center">
                                        <tr>
											<th>CODIGO</th>
											<th>DESCRIPCION</th>
                                            <th>UNID.MEDI.</th>
											<th>CANT.PEDI.</th>
											<th>CANTIDAD</th>
											<th>PRECIO</th>
											<th>IMPORTE</th>';
				if($TipoTabla=="SI"){
					$tablahtml .= '			<th>ACCIONES</th>';
				}
				$tablahtml .= '	        </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

			case "tabla_ver_cotizacion":
                $tablahtml = '	<table id="tabla_ver_cotizacion" class="table table-striped table-bordered table-condensed display w-80">
									<thead class="text-center">
										<tr>
											<th>COD.PEDI.</th>
											<th>COD.COTI.</th>
											<th>RAZON_SOCIAL</th>
											<th>MATERIAL_ID</th>
											<th>DESCRIPCION_DE_MATERIAL</th>
											<th>UNIDAD_MEDIDA</th>
											<th>CANT.PEDI.</th>
											<th>MONEDA</th>
											<th>PRECIO_SOLES</th>
											<th>FECHA_VIGENCIA</th>
											<th>CANT.COTIZ.</th>
											<th>CANT.SOLIC.</th>
											<th>PRECIO.COTIZ.</th>
											<th>SUBTOTAL_PRECIO</th>
											<th>SELECCION</th>
											<th>GRUPO_MATERIAL</th>
											<th>ACCION</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_material_orden_compra":
                $tablahtml = '  <table id="tabla_material_orden_compra" class="table table-striped table-bordered table-condensed w-100">
                                    <thead class="text-center">
                                        <tr>
											<th>CODIGO</th>
											<th>DESCRIPCION</th>
                                            <th>UNIDAD_MEDIDA</th>
											<th>CANTIDAD</th>
											<th>MONEDA</th>
											<th>PRECIO</th>
											<th>IMPORTE</th>	
											<th>OBSERVACIONES</th>
					        			</tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

			case "tabla_orden_compra":
				$tablahtml = '	<table id="tabla_orden_compra" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>VER</th>
											<th>ORD.COMP.</th>
											<th>FECHA</th>
											<th>COD.PEDIDO</th>
											<th>COD.COTIZ.</th>
											<th>NRO.RUC</th>
											<th>RAZON_SOCIAL</th>
											<th>CENTRO_DE_COSTO</th>
											<th>PRIORIDAD</th>
											<th>SUB_TOTAL</th>
											<th>IGV</th>
											<th>TOTAL</th>
											<th>ESTADO</th>
											<th>RESPONSABLE</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
			break;

        }
		echo $tablahtml;
	}

	public function ColumnasTabla($NombreTabla,$TipoTabla)
	{
		$columnashtml = "";
        switch ($NombreTabla) 
		{
            case "tabla_pedido":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Ver' class='btn btn-sm btn_ver_pedido'><i class='bi bi-search'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg></i></button></div></div>";
				$defaultContent2 = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_pedido'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"defaultContent": " '.$defaultContent1.' "},
									{"data": "pedido_id"},
									{"data": "pedi_tipo"},
									{"data": "pedi_fechacreacion"},
									{"data": "pedi_fecharequerimiento"},
									{"data": "pedi_prioridad"},
									{"data": "pedi_centrocosto"},
									{"data": "pedi_orden_compra_directa"},
									{"data": "pedi_proceso"},
									{"data": "pedi_nombre_contacto"},
									{"data": "pedi_direccion_entrega"},
									{"data": "pedi_responsable"},
									{"data": "pedi_estado"},
									{"data": "pedi_estado_obs"},
									{"data": "pedi_cotizacionid"},
									{"data": "pedi_ordencompraid"},
									{"defaultContent": " '.$defaultContent2.' "}
								]';
			break;

            case "tabla_material_pedido":
				$columnashtml = ' [ {"data": "mp_materialid"},
									{"data": "mp_descripcion"},
                                    {"data": "mp_unidadmedida"},
									{"data": "mp_cantidad"},
									{"data": "mp_bus"},
									{"data": "mp_observaciones"}';
				if($TipoTabla=="SI"){
					$defaultContent = "<div class='text-center'><div class='btn-group'><button tittle='Borrar' class='btn btn-danger btn-sm btn_borrar_material_pedido'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
					$columnashtml .= ',{"defaultContent": " '.$defaultContent.' "}';	
				}
				$columnashtml .= ']';
            break;

			case "tabla_ver_material_pedido":
				$columnashtml = ' [ {"data": "mp_materialid"},
									{"data": "mp_descripcion"},
									{"data": "mp_unidadmedida"},
									{"data": "mp_cantidad"},
									{"data": "mp_bus"},
									{"data": "mp_observaciones"}
								]';
            break;

			case "tabla_cotizacion":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Pdf Sol.Cot.' class='btn btn-danger btn-sm btn_cotizacion_pdf'><i class='bi bi-file-earmark-pdf'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-file-earmark-pdf' viewBox='0 0 16 16'><path d='M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z'/><path d='M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z'/></svg></i></button></div></div>";
				$defaultContent2 = "<div class='text-center'><div class='btn-group'><button title='Pdf Cot.' class='btn btn-primary btn-sm btn_adjuntar_pdf'><i class='bi bi-file-earmark-pdf'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-file-earmark-pdf' viewBox='0 0 16 16'><path d='M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z'/><path d='M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z'/></svg></i></button><button title='Recibir' class='btn btn-primary btn-sm btn_cerrar_cotizacion'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-database-fill-lock' viewBox='0 0 16 16'><path d='M8 1c-1.573 0-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4s.875 1.755 1.904 2.223C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777C13.125 5.755 14 5.007 14 4s-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1Z'/><path d='M3.904 9.223C2.875 8.755 2 8.007 2 7v-.839c.457.432 1.004.751 1.49.972C4.722 7.693 6.318 8 8 8s3.278-.307 4.51-.867c.486-.22 1.033-.54 1.49-.972V7c0 .424-.155.802-.411 1.133a4.51 4.51 0 0 0-1.364-.125 2.988 2.988 0 0 0-2.197.731 4.525 4.525 0 0 0-1.254 1.237A12.31 12.31 0 0 1 8 10c-1.573 0-3.022-.289-4.096-.777ZM8 14c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16c.09 0 .178 0 .266-.003A1.99 1.99 0 0 1 8 15v-1Zm0-1.5c0 .1.003.201.01.3A1.9 1.9 0 0 0 8 13c-1.573 0-3.022-.289-4.096-.777C2.875 11.755 2 11.007 2 10v-.839c.457.432 1.004.751 1.49.972C4.722 10.693 6.318 11 8 11c.086 0 .172 0 .257-.002A4.5 4.5 0 0 0 8 12.5Z'/><path d='M9 13a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z'/></svg></i></button></div></div>";

				$columnashtml = '[	{"data": "cotizacion_id"},
									{"data": "coti_fecha"},
									{"data": "coti_razonsocial"},
									{"data": "coti_responsable"},
									{"data": "coti_estado"},
									{"defaultContent": " '.$defaultContent1.' "},
									{"defaultContent": " '.$defaultContent2.' "}
								]';

			break;

			case "tabla_material_cotizacion":
				$columnashtml = ' [ {"data": "mc_materialid"},
									{"data": "mc_descripcion"},
                                    {"data": "mc_unidadmedida"},
									{"data": "mc_cantidad"},
									{"data": "mc_cantidad_cotizacion"},
									{"data": "mc_preciocotizacion"},
									{"data": "mc_totalprecio"}';
				if($TipoTabla=="SI"){
					$defaultContent = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_material_cotizacion'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
					$columnashtml .= ',{"defaultContent": " '.$defaultContent.' "}';	
				}
				$columnashtml .= ']';
            break;

			case "tabla_ver_cotizacion":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_material_seleccionado'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "tmc_pedidoid"},
									{"data": "tmc_cotizacionid"},
									{"data": "tmc_razonsocial"},
									{"data": "tmc_materialid"},
									{"data": "tmc_descripcion"},
									{"data": "tmc_unidadmedida"},
									{"data": "tmc_cantidad"},
									{"data": "tmc_moneda"},
									{"data": "tmc_preciosoles"},
									{"data": "tmc_fechavigencia"},
									{"data": "tmc_cantidad_cotizacion"},
									{"data": "tmc_cantidad_solicitada"},
									{"data": "tmc_preciocotizacion"},
									{"data": "tmc_subtotal_precio"},
									{"data": "tmc_seleccion"},
									{"data": "grupo_material"},
									{"defaultContent": " '.$defaultContent1.' "}
								]';
			break;

			case "tabla_material_orden_compra":
				$columnashtml = ' [ {"data": "moc_material_id"},
									{"data": "moc_descripcion"},
                                    {"data": "moc_unidad_medida"},
									{"data": "moc_cantidad"},
									{"data": "moc_moneda"},
									{"data": "moc_precio_soles"},
									{"data": "moc_precio_total"},
									{"data": "moc_observaciones"}
								]';
            break;

			case "tabla_orden_compra":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Ver' class='btn btn-sm btn_ver_orden_compra'><i class='bi bi-search'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg></i></button></div></div>";
				$defaultContent2 = "<div class='text-center'><div class='btn-group'><button title='PDF' class='btn btn-danger btn-sm btn_orden_compra_pdf'><i class='bi bi-file-earmark-pdf'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-file-earmark-pdf' viewBox='0 0 16 16'><path d='M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z'/><path d='M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z'/></svg></i></button><button title='Anular' class='btn btn-sm btn_anular_orden_compra'><i class='bi bi-x-square'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-square' viewBox='0 0 16 16'><path d='M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z'/><path d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"defaultContent": " '.$defaultContent1.' "},
									{"data": "ordencompra_id"},
									{"data": "orco_fecha"},
									{"data": "orco_pedidoid"},
									{"data": "orco_cotizacionid"},
									{"data": "orco_ruc"},
									{"data": "orco_razonsocial"},
									{"data": "orco_centrocosto"},
									{"data": "orco_prioridad"},
									{"data": "orco_subtotal"},
									{"data": "orco_igv"},
									{"data": "orco_total"},
									{"data": "orco_estado"},
									{"data": "orco_responsable"},
									{"defaultContent": " '.$defaultContent2.' "}
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
			case "form_seleccion_pedido":
				switch($NombreObjeto)
				{
					case "btn_seleccion_pedido":
						$botonesformulario = '<button type="button" id="btn_buscar_pedido" class="btn btn-secondary btn-sm btn_buscar_pedido">Buscar</button>';
					break;
				}
			break;

			case "form_seleccion_orden_compra":
				switch($NombreObjeto)
				{
					case "btn_seleccion_orden_compra":
						$botonesformulario = '<button type="button" id="btn_buscar_orden_compra" tabindex="2" class="btn btn-secondary btn-sm btn_buscar_orden_compra"> Buscar </button>';
					break;
				}
			break;

			case "":
				switch($NombreObjeto)
				{
					case "":
						$botonesformulario = '';
					break;
					
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
						$divformulario = '';
					break;

					case "":
					break;

				}
			break;
		}
		echo $divformulario;
    }

	public function MostrarDiv($NombreFormulario,$NombreObjeto,$Dato1,$Dato2)
	{
		$mostrar_div = "";
		switch($NombreFormulario)
		{
			case "form_seleccion_procesar_pedido":
				switch($NombreObjeto)
				{
					case "btn_seleccion_procesar_pedido":
						$btn_cargar_pedido 			= '<button type="button" id="btn_cargar_pedido" tabindex="2" class="btn btn-secondary btn-sm mr-1 btn_cargar_pedido">Cargar</button>';
						$btn_editar_procesar_pedido = '<button type="button" id="btn_editar_procesar_pedido" class="btn btn-secondary btn-sm mr-1 btn_editar_procesar_pedido">Editar</button>';
						$btn_cancelar_pedido 		= '<button type="button" id="btn_cancelar_pedido" class="btn btn-secondary btn-sm mr-1 btn_cancelar_pedido">Cancelar Pedido</button>';
						if($Dato1=="NUEVO"){
							$btn_nuevo_pedido 		= '';
						}else{
							$btn_nuevo_pedido 		= '<button type="button" id="btn_nuevo_pedido" class="btn btn-secondary btn-sm mr-1 btn_nuevo_pedido">+ Pedido</button>';
						}
						$btn_validar_pedido 		= '';
						$btn_validar_pedido_directo = '';

						switch($Dato2)
						{
							case "SI":
								MModel($this->Modulo, 'CRUD');
								$InstanciaAjax= new CRUD();
								$Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btn_validar_pedido_directo");
								if ($Respuesta=="SI"){
									$btn_validar_pedido_directo = '<button type="button" id="btn_validar_pedido_directo" class="btn btn-secondary btn-sm mr-1 btn_validar_pedido_directo">V.Pedido Directo</button>';
								}
							break;

							case "NO":
								MModel($this->Modulo, 'CRUD');
								$InstanciaAjax= new CRUD();
								$Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btn_validar_pedido");
								if ($Respuesta=="SI"){
									$btn_validar_pedido = '<button type="button" id="btn_validar_pedido" class="btn btn-secondary btn-sm mr-1 btn_validar_pedido">Validar Pedido</button>';
								}
							break;
						}

						switch($Dato1)
						{
							case "INICIO":
								$mostrar_div = $btn_cargar_pedido;
							break;

							case "PENDIENTE DE APROBACION":
								$mostrar_div  	 = $btn_cargar_pedido;
								$mostrar_div 	.= $btn_validar_pedido;
								$mostrar_div 	.= $btn_validar_pedido_directo;
								$mostrar_div	.= $btn_cancelar_pedido;
							break;

							case "REQUERIDO":
								$mostrar_div  	 = $btn_cargar_pedido;
								$mostrar_div	.= $btn_cancelar_pedido;
							break;

							case "OBSERVADO":
								$mostrar_div  	 = $btn_cargar_pedido;
								$mostrar_div 	.= $btn_editar_procesar_pedido;
								$mostrar_div	.= $btn_cancelar_pedido;
							break;

							case "EN COTIZACION":
								$mostrar_div  	 = $btn_cargar_pedido;
								$mostrar_div	.= $btn_cancelar_pedido;
							break;

							case "CANCELADO":
								$mostrar_div = $btn_cargar_pedido;
							break;

							case "CERRADO":
								$mostrar_div = $btn_cargar_pedido;
							break;
						}
						$mostrar_div .= $btn_nuevo_pedido;
					break;
				}
			break;

			case "form_procesar_pedido":
				switch($NombreObjeto)
				{
					case "form_procesar_pedido":
						$btn_material_pedido 			= "";
						$btn_cancelar_procesar_pedido 	= "";
						$btn_guardar_procesar_pedido 	= "";
						switch($Dato1)
						{
							case "material":
								$btn_material_pedido 			= '<button type="button" id="btn_material_pedido" class="btn btn-secondary btn-sm btn_material_pedido">+ Agregar</button>';
								$btn_cancelar_procesar_pedido 	= '<button type="button" id="btn_cancelar_procesar_pedido" class="btn btn-light btn-sm btn_cancelar_procesar_pedido">Cancelar</button>';
								$btn_guardar_procesar_pedido 	= '<button type="button" id="btn_guardar_procesar_pedido" class="btn btn-secondary btn-sm btn_guardar_procesar_pedido">Guardar</button>';
							break;

						}						
						switch($Dato2)
						{
							case "cargar":
								$mostrar_div = 	'	<form id="form_procesar_pedido" enctype="multipart/form-data" action="" method="post" onsubmit="return false;">    
														<div class="form-group">
															<div class="row">
																<div class="col-lg-6 mx-1 border border-muted border-radius rounded">
																	 <div class="row d-flex justify-content-araound">
																		<div class="col-lg-6">
																			<div class="row">
																				<div class="col-lg-5">
																					<div class="form-group form-control-sm mb-1">
																						<label for="tpedido_id" class="col-form-label form-control-sm mb-1">N° PEDIDO :</label>
																					</div>
																				</div>
																				<div class="col-lg-7">
																					<div class="form-group form-control-sm mb-1">
																						<input type="text" readonly class="form-control form-control-sm mb-1" id="tpedido_id">
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col-lg-6">
																			<div class="row">
																				<div class="col-lg-5">
																					<div class="form-group form-control-sm mb-1">
																						<label for="pedi_fechacreacion" class="col-form-label form-control-sm mb-1">F. PEDIDO :</label>
																					</div>
																				</div>
																				<div class="col-lg-7">
																					<div class="form-group form-control-sm mb-1">
																						<input type="date" readonly class="form-control form-control-sm mb-1" id="pedi_fechacreacion">
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
																						<label for="pedi_fecharequerimiento" class="col-form-label form-control-sm mb-1">F. REQUERIDA :</label>
																					</div>
																				</div>
																				<div class="col-lg-7">
																					<div class="form-group form-control-sm mb-1">
																						<input type="date" class="form-control form-control-sm mb-1" id="pedi_fecharequerimiento">
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col-lg-6">
																			<div class="row">
																				<div class="col-lg-5">
																					<div class="form-group form-control-sm mb-1">
																						<label for="pedi_urgencia" class="col-form-label form-control-sm mb-1">PRIORIDAD :</label>
																					</div>
																				</div>
																				<div class="col-lg-7">
																					<div class="form-group form-control-sm mb-1">
																						<select class="form-control form-control-sm mb-1" id="pedi_prioridad">

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
																						<label for="pedi_centrocosto" class="col-form-label form-control-sm mb-1">C.COSTO :</label>
																					</div>
																				</div>
																				<div class="col-lg-7">
																					<div class="form-group form-control-sm mb-1">
																						<select class="form-control form-control-sm mb-1" id="pedi_centrocosto">

																						</select>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col-lg-6">
																			<div class="row">
																				<div class="col-lg-5">
																					<div class="form-group form-control-sm mb-1">
																						<label for="pedi_proceso" class="col-form-label form-control-sm mb-1">PROCESO SOLIC. :</label>
																					</div>
																				</div>
																				<div class="col-lg-7">
																					<div class="form-group form-control-sm mb-1">
																						<select class="form-control form-control-sm mb-1" id="pedi_proceso">

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
																						<label for="pedi_nombre_contacto" class="col-form-label form-control-sm mb-1">CONTACTO :</label>
																					</div>
																				</div>
																				<div class="col-lg-7">
																					<div class="form-group form-control-sm mb-1">
																						<select class="form-control form-control-sm mb-1" id="pedi_nombre_contacto">
																						
																						</select>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col-lg-6">
																			<div class="row">
																				<div class="col-lg-5">
																					<div class="form-group form-control-sm mb-1">
																						<label for="pedi_direccion_entrega" class="col-form-label form-control-sm mb-1">DIRECC. ENTREGA :</label>
																					</div>
																				</div>
																				<div class="col-lg-7">
																					<div class="form-group form-control-sm mb-1">
																						<input type="text" class="form-control form-control-sm mb-1 text-uppercase" id="pedi_direccion_entrega">
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
																						<label for="pedi_orden_compra_directa" class="col-form-label form-control-sm mb-1">O.COMP.DIRECTA :</label>
																					</div>
																				</div>
																				<div class="col-lg-7">
																					<div class="form-group form-control-sm mb-1">
																						<select class="form-control form-control-sm mb-1" id="pedi_orden_compra_directa">
							
																						</select>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col-lg-6">
																			<div class="row">
																				<div class="col-lg-5">
																					<div class="form-group form-control-sm mb-1">
																						<label for="pedi_tipo" class="col-form-label form-control-sm mb-1">TIPO :</label>
																					</div>
																				</div>
																				<div class="col-lg-7">
																					<div class="form-group form-control-sm mb-1">
																						<select class="form-control form-control-sm mb-1" id="pedi_tipo">

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
																						<label for="pedi_estado" class="col-form-label form-control-sm mb-1">ESTADO :</label>
																					</div>
																				</div>
																				<div class="col-lg-7">
																					<div class="form-group form-control-sm mb-1">
																						<input type="text" readonly class="form-control form-control-sm mb-1" id="pedi_estado">
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col-lg-6">
																			<div class="row align-items-end d-flex">
																				<div class="btn-toolbar ml-auto p-2" id="div_btnPedidos" role="toolbar" aria-label="Toolbar with button groups">
																					<div class="btn-group" role="group" aria-label="Four group" id="div_btn_material_pedido">
																						'.$btn_material_pedido.'
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
																						<div class="table-responsive" id="div_tabla_material_pedido">        
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
																				<div class="form-group col-lg-1 mb-1" id="div_btn_log_pedido">
																					<button type="button" id="btn_log_pedido" class="btn btn-info btn-sm btn_log_pedido">Log..</button>
																				</div>
																				<div class="form-group col-lg-11 mb-1">
																					<textarea class="form-control form-control-sm mb-3 text-uppercase" id="obs_log" rows="1" placeholder="escribe algo aqui..."></textarea>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="row d-flex justify-content-center">
																		<div class="col-lg-4">
																			<div class="form-group align-items-center d-flex">
																				'.$btn_cancelar_procesar_pedido.'
																				'.$btn_guardar_procesar_pedido.'
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-lg-5 mx-1 border border-muted border-radius rounded" id="div_solicitar_cotizacion">
																	<!-- MostrarDiv -->									
																</div>
															</div>
														</div>		
													</form>		';

							break;
						}
					break;

					case "div_solicitar_cotizacion":
						$mostrar_div_cotizacion 		= "NO";
						$btn_nueva_cotizacion 			= "";
						$btn_cerrar_pedido_no_atendido 	= "";
						
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btn_nueva_cotizacion");
						if ($Respuesta=="SI"){
							$btn_nueva_cotizacion = '<button type="button" id="btn_nueva_cotizacion" class="btn btn-secondary btn-sm mt-1 btn_nueva_cotizacion">+ Solicitar Cotización</button>';
						}

						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btn_cerrar_pedido_no_atendido");
						if ($Respuesta=="SI"){
							$btn_cerrar_pedido_no_atendido = '<button type="button" id="btn_cerrar_pedido_no_atendido" class="btn btn-secondary btn-sm mt-1 btn_cerrar_pedido_no_atendido">Cerrar Pedido No Atendido</button>';
						}
						
						switch($Dato1)
						{
							case "REQUERIDO":
								$mostrar_div_cotizacion = "SI";
								$btn_cerrar_pedido_no_atendido = "";
							break;

							case "EN COTIZACION":
								$mostrar_div_cotizacion = "SI";
							break;

							case "CANCELADO":
								$mostrar_div_cotizacion 		= "SI";
								$btn_nueva_cotizacion 			= "";
								$btn_cerrar_pedido_no_atendido 	= "";
							break;

							case "CERRADO":
								$mostrar_div_cotizacion 		= "SI";
								$btn_nueva_cotizacion 			= "";
								$btn_cerrar_pedido_no_atendido	= "";
							break;
						}

						if($mostrar_div_cotizacion=="SI"){
							$mostrar_div = '	<div id="div_btn_cotizacion">
													'.$btn_nueva_cotizacion.'
													'.$btn_cerrar_pedido_no_atendido.'
												</div>
												<div class="row p-3">
													<div class="col-auto m-0">
														<div class="table-responsive" id="div_tabla_cotizacion">
															<!-- CreacionTabla -->
														</div>
													</div>
												</div>';
						}

					break;

				}
			break;

			case "form_seleccion_ver_cotizacion":
				switch($NombreObjeto)
				{
					case "btn_seleccion_ver_cotizacion":
						$mostrar_div = '<button type="button" id="btn_buscar_ver_cotizacion" tabindex="2" class="btn btn-secondary btn-sm btn_buscar_ver_cotizacion mr-1">Buscar</button>';
						switch($Dato1)
						{
							case "orden de compra";
								$mostrar_div .= '<button type="button" id="btn_generar_orden_compra" tabindex="3" class="btn btn-secondary btn-sm btn_generar_orden_compra mr-1">+ O.Compra</button>'; 
							break;
						}
					break;
				}
			break;

			case "form_modal_cerrar_cotizacion":
				switch ($NombreObjeto)
				{
					case "btn_cerrar_cotizacion":
						$mostrar_div = '<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>';
						switch ($Dato1)
						{
							case "SI":
								$mostrar_div .= '<button type="button" id="btn_grabar_cerrar_cotizacion" class="btn btn-secondary btn-sm btn_grabar_cerrar_cotizacion">Grabar</button>';
							break;
						}
					break;
				}
			break;
		}
		echo $mostrar_div;
    }

	public function MostrarObjetos($NombresObjetos, $Accion)
	{
		$MostrarObjetos = "";
		switch($NombreFormulario)
		{
			case "":
				switch($NombreObjeto)
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