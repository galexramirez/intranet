<?php
session_start();
class Accesos
{
    var $Modulo="ControlFacilitador";    

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-ControlFacilitador":
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();

                /* $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"nav-home-tab");
                if($Respuesta=="SI"){
                    $tabshtml .= '<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Generar</a>';
                } */
                $tabshtml .= '<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Generar</a>';
	    		$tabshtml .= '<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Troncal</a>';
	    		$tabshtml .= '<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Alimentador</a>';
                $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"nav-novedad-tab");
                if($Respuesta=="SI"){
                    $tabshtml .= '<a class="nav-item nav-link" id="nav-novedad-tab" data-toggle="tab" href="#nav-novedad" role="tab" aria-controls="nav-novedad" aria-selected="false">Novedades</a>';
                }
                $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"nav-detallenovedad-tab");
                if($Respuesta=="SI"){
                    $tabshtml .= '<a class="nav-item nav-link" id="nav-detallenovedad-tab" data-toggle="tab" href="#nav-detallenovedad" role="tab" aria-controls="nav-detallenovedad" aria-selected="false">Detalle</a>';
                }
                $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"nav-reporteop-tab");
                if($Respuesta=="SI"){
                    $tabshtml .= '<a class="nav-item nav-link" id="nav-reporteop-tab" data-toggle="tab" href="#nav-reporteop" role="tab" aria-controls="nav-reporteop" aria-selected="false">Reportes</a>';
                }
                $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"nav-ajustes_control_facilitador-tab");
                if($Respuesta=="SI"){
                    $tabshtml .= '<a class="nav-item nav-link" id="nav-ajustes_control_facilitador-tab" data-toggle="tab" href="#nav-ajustes_control_facilitador" role="tab" aria-controls="nav-ajustes_control_facilitador" aria-selected="false">Ajustes</a>';
                }
			break;
		}
		echo $tabshtml;
	}

    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
        $tablahtml="";
        switch ($NombreTabla)
        {
            case "tablaFacilitadorCarga":
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->Permisos($this->Modulo,$TipoTabla);

                $tablahtml .=   '<table id="tablaFacilitadorCarga" class="table table-striped table-bordered table-condensed w-100">
                                    <thead class="text-center">
                                        <tr>
                                            <th>ID</th>
                                            <th>FECHA CARGADA</th>
                                            <th>TIPO OPERACION</th>
                                            <th>FECHA GENERAR</th> 
                                            <th>USUARIO QUE GENERA</th>
                                            <th>FECHA CIERRE</th>
                                            <th>USUARIO QUE CIERRA</th>
                                            <th>FECHA ELIMINAR</th>
                                            <th>USUARIO QUE ELIMINA</th>
                                            <th>ESTADO</th>';
                if($Respuesta=="SI"){
                    $tablahtml .=          '<th>ACCIONES</th>';
                }
                $tablahtml .=          '</tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

            case "tablaControlFacilitador":
                $tablahtml = '  <table id="tablaControlFacilitador" class="table table-striped table-bordered table-condensed w-100 display nowrap row-border order-column">
                                    <thead class="text-center">
                                        <tr class="EncabezadoTabla">
                                            <th>ID</th>
                                            <th>COD.</th>
                                            <th>APELLIDOS Y NOMBRES</th>
                                            <th>TABLA</th>
                                            <th>H.ORI</th>
                                            <th>H.DES</th>
                                            <th>SERVICIO</th>
                                            <th>SERVBUS</th>
                                            <th>BUS</th>
                                            <th>ORIGEN</th>
                                            <th>DESTINO</th>
                                            <th>EVENTO</th>
                                            <th>OBSERVACIONES</th>
                                            <th>KM</th>
                                            <th>TUR.</th>
                                            <th>SENTIDO</th>
                                            <th>STATUS</th>
                                            <th>ID SB.</th>
                                            <th>VIAJES</th>
                                            <th>CAMBIOS</th>
                                            <th>NOV.</th>
                                            <th>REP.</th>
                                        </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

            case "tablaMostrarInconsistenciasTroncal":
                $tablahtml = '  <table id="tablaMostrarInconsistenciasTroncal" class="table table-striped table-bordered table-condensed w-100">
                                    <thead class="text-center">
                                        <tr>
                                            <th>DETALLE</th>	
                                            <th>ID</th>
                                            <th>ID BUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

            case "tablaControlFacilitadorAlimentador":
                $tablahtml = '  <table id="tablaControlFacilitadorAlimentador" class="table table-striped table-bordered table-condensed w-100 display nowrap row-border order-column">
                                    <thead class="text-center">
                                        <tr>
                                            <th>ID</th>
                                            <th>CODIGO</th>
                                            <th>APELLIDOS Y NOMBRES</th>
                                            <th>TABLA</th>
                                            <th>H.ORI</th>
                                            <th>H.DES</th>
                                            <th>SERVICIO</th>
                                            <th>SERVBUS</th>
                                            <th>BUS</th>
                                            <th>ORIGEN</th>
                                            <th>DESTINO</th>
                                            <th>EVENTO</th>
                                            <th>OBSERVACIONES</th>
                                            <th>KM</th>
                                            <th>T.TABLA</th>
                                            <th>SENTIDO</th>
                                            <th>STATUS</th>
                                            <th>ID SB.</th>
                                            <th>VIAJES</th>
                                            <th>CAMBIOS</>
                                            <th>NOV.</th>
                                            <th>REP.</th>
                                        </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

            case "tablaMostrarInconsistenciasAlimentador":
                $tablahtml = '  <table id="tablaMostrarInconsistenciasAlimentador" class="table table-striped table-bordered table-condensed w-100">
                                    <thead class="text-center">
                                        <tr>
                                            <th>DETALLE</th>
                                            <th>ID</th>
                                            <th>ID BUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

            case "tablaNovedadCarga":
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->Permisos($this->Modulo,$TipoTabla);

                $tablahtml = '  <table id="tablaNovedadCarga" class="table table-striped table-bordered table-condensed w-100"  >
                                    <thead class="text-center">
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>NOVE.ID</th>
                                            <th>PROG.ID</th>
                                            <th>ORIGEN</th>
                                            <th>FECHA GENERAR</th>
                                            <th>USUARIO QUE GENERA</th>
                                            <th>NOVEDAD</th>
                                            <th>TIPO NOVEDAD</th>
                                            <th>DETALLE NOVEDAD</th>
                                            <th>DESCRIPCION</th>
                                            <th>OPERACION</th>
                                            <th>APELLIDOS Y NOMBRES</th>
                                            <th>BUS</th>
                                            <th>LUGAR EXACTO</th>
                                            <th>H.INICIO</th>
                                            <th>H.FIN</th>
                                            <th>ESTADO</th>
                                            <th>ACCIONES</th>'; 
                if($Respuesta=="SI"){
                    $tablahtml .= '         <th>ABRIR</th>';
                }
                $tablahtml .= '         </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

            case "tablaDetalleNovedad":
                $tablahtml = '<table id="tablaDetalleNovedad" class="table table-striped table-bordered table-condensed w-100 display nowrap row-border order-column">
                                <thead class="text-center">
                                    <tr>
                                        <th>ID C.FACI</th>
                                        <th>ID PROG.</th>
                                        <th>CODIGO ANT.</th>
                                        <th>APELLIDOS Y NOMBRES ANT.</th>
                                        <th>TABLA ANT.</th>
                                        <th>H.ORI.ANT.</th>
                                        <th>H.DES.ANT.</th>
                                        <th>SERVICIO ANT.</th>
                                        <th>SERVBUS ANT.</th>
                                        <th>BUS ANT.</th>
                                        <th>ORIGEN ANT.</th>
                                        <th>DESTINO ANT.</th>
                                        <th>EVENTO ANT.</th>
                                        <th>OBSERVACIONES ANT.</th>
                                        <th>KM ANT.</th>
                                        <th>SENTIDO ANT.</th>
                                        <th>ID SB. ANT.</th>
                                        <th>CODIGO</th>
                                        <th>APELLIDOS Y NOMBRES</th>
                                        <th>TABLA</th>
                                        <th>H.ORI.</th>
                                        <th>H.DES.</th>
                                        <th>SERVICIO</th>
                                        <th>SERVBUS</th>
                                        <th>BUS</th>
                                        <th>ORIGEN</th>
                                        <th>DESTINO</th>
                                        <th>EVENTO</th>
                                        <th>OBSERVACIONES</th>
                                        <th>KM</th>
                                        <th>SENTIDO</th>
                                        <th>ID SB.</th>
                                        <th>ID NOVE.</th>
                                        <th>NOVEDAD</th>
                                        <th>TIPO NOVE.</th>
                                        <th>ESTADO</th>
                                        <th>USUARIO</th>
                                        <th>PROCESO</th>
                                        <th>TIPO</th>
                                        <th>FECHA</th>
                                    </tr>
                                </thead>
                                <tbody>                           
                                </tbody>
                            </table>';
            break;

            case "tablaReporteop":
                $tablahtml .= '<table id="tablaReporteop" class="table table-striped table-bordered table-condensed w-100 display nowrap row-border order-column">
                                    <thead class="text-center">
                                        <tr>';
                if($TipoTabla=="NOVEDADES"){
                    $tablahtml .= '         <th>CGO_REPORTA</th>
                                            <th>DIA</th>
                                            <th>FECHA</th>
                                            <th>DNI</th>
                                            <th>CODIGO</th>
                                            <th>NOMBRE_OPERADOR</th>
                                            <th>TABLA</th>
                                            <th>HORA ORIGEN</th>
                                            <th>HORA DESTINO</th>
                                            <th>SERVICIO</th>
                                            <th>BUS</th>
                                            <th>LUGAR_ORIGEN</th>
                                            <th>LUGAR_DESTINO</th>
                                            <th>TURNO</th>
                                            <th>NOVEDAD_ID</th>
                                            <th>NOVEDAD_1</th>
                                            <th>TIPO_NOVEDAD_1</th>
                                            <th>DETALLE_NOVEDAD_1</th>
                                            <th>DESCRIPCION_ADICIONAL_DE_FACILITADOR</th>';
                }else{
                    $tablahtml .= '         <th>ID</th>
                                            <th>COD.</th>
                                            <th>APELLIDOS Y NOMBRES</th>
                                            <th>TABLA</th>
                                            <th>H.ORI</th>
                                            <th>H.DES</th>
                                            <th>SERVICIO</th>
                                            <th>SERVBUS</th>
                                            <th>BUS</th>
                                            <th>ORIGEN</th>
                                            <th>DESTINO</th>
                                            <th>EVENTO</th>
                                            <th>OBSERVACIONES</th>
                                            <th>KM</th>
                                            <th>TUR.</th>
                                            <th>PLACA</th>
                                            <th>VID</th>
                                            <th>SENTIDO</th>
                                            <th>STATUS</th>
                                            <th>ID SB.</th>
                                            <th>VIAJES</th>';
                }
                switch ($TipoTabla)
                {
                    case "CAMBIO BUS":
                        $tablahtml .= '     <th>CAMBIO BUS</th>
                                            <th>ID NOVEDAD</th>
                                            <th>NOVEDAD</th>
                                            <th>TIPO NOVEDAD</th>
                                            <th>DETALLE NOVEDAD</th>
                                            <th>DESCRIPCION NOVEDAD</th>';
                    break;
                    case "CAMBIO PILOTO":
                        $tablahtml .= '     <th>CAMBIO PILOTO</th>
                                            <th>ID NOVEDAD</th>
                                            <th>NOVEDAD</th>
                                            <th>TIPO NOVEDAD</th>
                                            <th>DETALLE NOVEDAD</th>
                                            <th>DESCRIPCION NOVEDAD</th>';
                    break;
                    case "CONTROL FACILITADOR ORIGINAL":
                        $tablahtml .= '';
                    break;
                    case "HISTORIAL CAMBIOS":
                        $tablahtml .= '     <th>ID VERSION</th>
                                            <th>FECHA CAMBIO</th>';
                    break;
                }
                $tablahtml .= '          </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

            case "tablaTipoTablas":
                $tablahtml = ' <table id="tablaTipoTablas" class="table table-striped table-bordered table-condensed w-100">
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
        $columnasjs="";
        switch ($NombreTabla)
        {
            case "tablaFacilitadorCarga":
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->Permisos($this->Modulo,$TipoTabla);

                $defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Cerrar' class='btn btn-primary btn-sm btnCerrarFacilitadorCarga'><i class='bi bi-file-earmark-lock2-fill'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-file-earmark-lock2-fill' viewBox='0 0 16 16'><path d='M7 7a1 1 0 0 1 2 0v1H7V7z'/><path d='M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM10 7v1.076c.54.166 1 .597 1 1.224v2.4c0 .816-.781 1.3-1.5 1.3h-3c-.719 0-1.5-.484-1.5-1.3V9.3c0-.627.46-1.058 1-1.224V7a2 2 0 1 1 4 0z'/></svg></i></button><button title='Borrar' class='btn btn-danger btn-sm btnBorrarFacilitadorCarga'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
                $columnasjs .= '[{"data": "CFaRg_Id"},
                                {"data": "CFaRg_FechaCargada"},
                                {"data": "CFaRg_TipoOperacionCargada"},
                                {"data": "CFaRg_FechaGenerar"},
                                {"data": "CFaRg_UsuarioId_Generar"},
                                {"data": "CFaRg_FechaCerrar"},
                                {"data": "CFaRg_UsuarioId_Cerrar"},
                                {"data": "CFaRg_FechaEliminar"},
                                {"data": "CFaRg_UsuarioId_Eliminar"},
                                {"data": "CFaRg_Estado"}';
                if($Respuesta=="SI"){
                    $columnasjs.= ',{"defaultContent": "'.$defaultContent1.'"}';
                }                
                $columnasjs .= ']';
            break;

            case "tablaControlFacilitador":
                $columnasjs = '[    {"data": "ControlFacilitador_Id"},
                                    {"data": "Prog_CodigoColaborador"},
                                    {"data": "Prog_NombreColaborador"},
                                    {"data": "Prog_Tabla"},
                                    {"data": "Prog_HoraOrigen"},
                                    {"data": "Prog_HoraDestino"},
                                    {"data": "Prog_Servicio"},
                                    {"data": "Prog_ServBus"},
                                    {"data": "Prog_Bus"},
                                    {"data": "Prog_LugarOrigen"},
                                    {"data": "Prog_LugarDestino"},
                                    {"data": "Prog_TipoEvento"},
                                    {"data": "Prog_Observaciones"},
                                    {"data": "Prog_KmXPuntos"},
                                    {"data": "Prog_TipoTabla"},
                                    {"data": "Prog_Sentido"},
                                    {"data": "Prog_BusManto"},
                                    {"data": "Prog_IdManto"},
                                    {"data": "Prog_Viajes"},
                                    {"data": "Prog_CambiosBusPiloto"},
                                    {"data": "CFaci_Novedad"},
                                    {"data": "CFaci_Reporte"}
                                ]';
            break;

            case "tablaControlFacilitadorAlimentador":

                $columnasjs = '[    {"data": "ControlFacilitador_Id"},
                                    {"data": "Prog_CodigoColaborador"},
                                    {"data": "Prog_NombreColaborador"},
                                    {"data": "Prog_Tabla"},
                                    {"data": "Prog_HoraOrigen"},
                                    {"data": "Prog_HoraDestino"},
                                    {"data": "Prog_Servicio"},
                                    {"data": "Prog_ServBus"},
                                    {"data": "Prog_Bus"},
                                    {"data": "Prog_LugarOrigen"},
                                    {"data": "Prog_LugarDestino"},
                                    {"data": "Prog_TipoEvento"},
                                    {"data": "Prog_Observaciones"},
                                    {"data": "Prog_KmXPuntos"},
                                    {"data": "Prog_TipoTabla"},
                                    {"data": "Prog_Sentido"},
                                    {"data": "Prog_BusManto"},
                                    {"data": "Prog_IdManto"},
                                    {"data": "Prog_Viajes"},
                                    {"data": "Prog_CambiosBusPiloto"},
                                    {"data": "CFaci_Novedad"},
                                    {"data": "CFaci_Reporte"}
                                ]';
            break;

            case "tablaNovedadCarga":
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $btn1=""; $btn2=""; $btn3="";
                $btnini = "<div class='text-center'><div class='btn-group'>";
                $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnEditarNovedadCarga");
                if($Respuesta=="SI"){
                    $btn1 = "<button title='Editar' class='btn btn-primary btn-sm btnEditarNovedadCarga'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button>";
                }
                $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnCerrarNovedadCarga");
                if($Respuesta=="SI"){
                    $btn2 = "<button title='Cerrar' class='btn btn-success btn-sm btnCerrarNovedadCarga'><i class='bi bi-file-earmark-lock2-fill'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-file-earmark-lock2-fill' viewBox='0 0 16 16'><path d='M7 7a1 1 0 0 1 2 0v1H7V7z'/><path d='M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM10 7v1.076c.54.166 1 .597 1 1.224v2.4c0 .816-.781 1.3-1.5 1.3h-3c-.719 0-1.5-.484-1.5-1.3V9.3c0-.627.46-1.058 1-1.224V7a2 2 0 1 1 4 0z'/></svg></i></button>";
                }
                $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnEliminarNovedadCarga");
                if($Respuesta=="SI"){
                    $btn3 = "<button title='Anular' class='btn btn-danger btn-sm btnEliminarNovedadCarga'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button>";
                }
                $btn4 = "<button title='Historial' class='btn btn-info btn-sm btnHistorialNovedadCarga'><i class='bi bi-clock-history'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-clock-history' viewBox='0 0 16 16'><path d='M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z'/><path d='M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z'/><path d='M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z'/></svg></i></button>";
                $btnfin = "</div></div>";
                $btn5 = "<div class='text-center'><div class='btn-group'><button title='Abrir' class='btn btn-warning btn-sm btnAbrirNovedadCarga'><i class='bi bi-clipboard-plus'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-clipboard-plus' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z'/><path d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z'/><path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/></svg></i></button></div></div>";
                if($TipoTabla=="CERRADO"){
                    $btn1=""; $btn2=""; $btn3="";
                }
                $columnasjs = '[    {
                                        "className": "dt-control",
                                        "defaultContent": ""
                                    },
                                    {"data": "OPE_NovedadId"},
                                    {"data": "Novedad_Id"},
                                    {"data": "Nove_ProgramacionId"},
                                    {"data": "Nove_ProcesoOrigen"},
                                    {"data": "Nove_Fecha"},
                                    {"data": "Nove_UsuarioId"},
                                    {"data": "Nove_Novedad"},
                                    {"data": "Nove_TipoNovedad"},
                                    {"data": "Nove_DetalleNovedad"},
                                    {"data": "Nove_Descripcion"},
                                    {"data": "Nove_Operacion"},
                                    {"data": "Nove_NombreColaborador"},
                                    {"data": "Nove_Bus"},
                                    {"data": "Nove_LugarExacto"},
                                    {"data": "Nove_HoraInicio"},
                                    {"data": "Nove_HoraFin"},
                                    {"data": "Nove_Estado"},
                                    {"defaultContent": " '.$btnini.$btn1.$btn2.$btn3.$btn4.$btnfin.' "}';
                $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnAbrirNovedadCarga");
                if($Respuesta=="SI"){
                    $columnasjs .= ',{"defaultContent": " '.$btn5.' "}';
                }
                $columnasjs .=  ']';
            break;

            case "tablaDetalleNovedad":
                $columnasjs =   '[  {"data": "ControlFacilitador_Id"},
                                    {"data": "CNove_ProgramacionId"},
                                    {"data": "Prog_CodigoColaborador_ant"},
                                    {"data": "Prog_NombreColaborador_ant"},
                                    {"data": "Prog_Tabla_ant"},
                                    {"data": "Prog_HoraOrigen_ant"},
                                    {"data": "Prog_HoraDestino_ant"},
                                    {"data": "Prog_Servicio_ant"},
                                    {"data": "Prog_ServBus_ant"},
                                    {"data": "Prog_Bus_ant"},
                                    {"data": "Prog_LugarOrigen_ant"},
                                    {"data": "Prog_LugarDestino_ant"},
                                    {"data": "Prog_TipoEvento_ant"},
                                    {"data": "Prog_Observaciones_ant"},
                                    {"data": "Prog_KmXPuntos_ant"},
                                    {"data": "Prog_Sentido_ant"},
                                    {"data": "Prog_IdManto_ant"},
                                    {"data": "Prog_CodigoColaborador"},
                                    {"data": "Prog_NombreColaborador"},
                                    {"data": "Prog_Tabla"},
                                    {"data": "Prog_HoraOrigen"},
                                    {"data": "Prog_HoraDestino"},
                                    {"data": "Prog_Servicio"},
                                    {"data": "Prog_ServBus"},
                                    {"data": "Prog_Bus"},
                                    {"data": "Prog_LugarOrigen"},
                                    {"data": "Prog_LugarDestino"},
                                    {"data": "Prog_TipoEvento"},
                                    {"data": "Prog_Observaciones"},
                                    {"data": "Prog_KmXPuntos"},
                                    {"data": "Prog_Sentido"},
                                    {"data": "Prog_IdManto"},
                                    {"data": "Novedad_Id"},
                                    {"data": "Nove_Novedad"},
                                    {"data": "Nove_TipoNovedad"},
                                    {"data": "CFaci_Estado"},
                                    {"data": "CFaci_UsuarioId"},
                                    {"data": "CNove_ProcesoOrigen"},
                                    {"data": "CNove_TipoOrigen"},
                                    {"data": "CNove_Fecha"}
                                ]';
            break;

            case "tablaReporteop":
                if($TipoTabla=="NOVEDADES"){
                    $columnasjs .= '[       {"data": "cgo_nombres"},  
                                            {"data": "dia"}, 
                                            {"data": "fecha"},
                                            {"data": "piloto_dni"}, 
                                            {"data": "piloto_codigo"},
                                            {"data": "piloto_nombres"},
                                            {"data": "tabla"},       
                                            {"data": "hora_origen"},          
                                            {"data": "hora_destino"},           
                                            {"data": "servicio"},               
                                            {"data": "bus"},
                                            {"data": "lugar_origen"},      
                                            {"data": "lugar_destino"},
                                            {"data": "turno"},
                                            {"data": "novedad_id"},
                                            {"data": "novedad_1"},     
                                            {"data": "tipo_novedad_1"},         
                                            {"data": "detalle_novedad_1"},         
                                            {"data": "descripcion_adicional"}';
                }else{
                    $columnasjs .= '[       {"data": "ControlFacilitador_Id"},  
                                            {"data": "Prog_CodigoColaborador"}, 
                                            {"data": "Prog_NombreColaborador"}, 
                                            {"data": "Prog_Tabla"},             
                                            {"data": "Prog_HoraOrigen"},        
                                            {"data": "Prog_HoraDestino"},       
                                            {"data": "Prog_Servicio"},          
                                            {"data": "Prog_ServBus"},           
                                            {"data": "Prog_Bus"},               
                                            {"data": "Prog_LugarOrigen"},       
                                            {"data": "Prog_LugarDestino"},      
                                            {"data": "Prog_TipoEvento"},        
                                            {"data": "Prog_Observaciones"},     
                                            {"data": "Prog_KmXPuntos"},         
                                            {"data": "Prog_TipoTabla"},         
                                            {"data": "Prog_NPlaca"},            
                                            {"data": "Prog_NVid"},              
                                            {"data": "Prog_Sentido"},           
                                            {"data": "Prog_BusManto"},          
                                            {"data": "Prog_IdManto"},
                                            {"data": "Prog_Viajes"}';
                }
                switch ($TipoTabla)
                {
                    case "CAMBIO BUS":
                        $columnasjs .= '    ,{"data": "busanterior"},            
                                            {"data": "CNove_NovedadId"},        
                                            {"data": "Nove_Novedad"},           
                                            {"data": "Nove_TipoNovedad"},       
                                            {"data": "Nove_DetalleNovedad"},    
                                            {"data": "Nove_Descripcion"}';
                    break;
                    case "CAMBIO PILOTO":
                        $columnasjs .= '    ,{"data": "pilotoanterior"},         
                                            {"data": "CNove_NovedadId"},        
                                            {"data": "Nove_Novedad"},           
                                            {"data": "Nove_TipoNovedad"},       
                                            {"data": "Nove_DetalleNovedad"},    
                                            {"data": "Nove_Descripcion"}';
                    break;
                    case "CONTROL FACILITADOR ORIGINAL":
                        $columnasjs .= '';
                    break;
                    case "HISTORIAL CAMBIOS";
                        $columnasjs .= '     ,{"data": "CFaci_Version"},
                                            {"data": "EDT_FechaEdicion"}';
                    break;
                }
                $columnasjs .= ' ]';
            break;

            case "tablaTipoTablas":
                $defaultContent1 = " <div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarTipoTablas'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btnBorrarTipoTablas'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div> ";
                $columnasjs = ' [   {"data": "Ttabla_Id"},
                                    {"data": "Ttabla_Operacion"},                    
                                    {"data": "Ttabla_Tipo"},
                                    {"data": "Ttabla_Detalle"},
                                    {"defaultContent": "'.$defaultContent1.'"}
                                ] ';
            break;
        }
        echo $columnasjs;

    }

	public function BotonesFormulario($NombreFormulario,$NombreObjeto)
	{
		$botonesformulario = "";
		switch($NombreFormulario)
		{
			case "formSeleccionFacilitadorCarga":
                $botonesformulario = '<button type="button" id="btnBuscarFacilitador" class="btn btn-secondary btn-sm btnBuscarFacilitador ml-1">Buscar</button>';
				switch($NombreObjeto)
				{
					case "btnNuevoFacilitadorCarga":
                        MModel($this->Modulo, 'CRUD');
                        $InstanciaAjax= new CRUD();
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnNuevoFacilitadorCarga");
                        if($Respuesta=="SI"){
                            $botonesformulario .= '<button id="btnNuevoFacilitadorCarga" type="button" class="btn btn-secondary btn-sm btnNuevoFacilitadorCarga ml-1" data-toggle="modal">+ Generar</button>';
                        }
					break;
                }
            break;

            case "formSeleccionTroncal":
                switch($NombreObjeto)
                {
                    case "navbarNavDropdownTroncal":
                        MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
                        $botonesformulario = '  <div class="form-group m-0 mt-1 " id="div_btnViajesCanceladosTroncal">
                                                    <div class="custom-control custom-checkbox ml-3">
                                                          <input type="checkbox" class="custom-control-input font-smaller" id="ViajesCanceladosTroncal" value="ViajesCancelados" checked>
                                                          <label class="custom-control-label font-smaller" for="ViajesCanceladosTroncal">Anulados</label>
                                                    </div>
                                                </div>
                                                <ul class="navbar-nav">';
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnAgregarNovedadTroncal");
                        if($Respuesta=="SI"){
                            $botonesformulario .=   '<li class="nav-item"> <button  id="btnAgregarNovedadTroncal"  class="btn  btn-warning ml-1 ms-1 mt-1 btn-sinborde  font-smaller" type="button"> +Novedad</button> 	</li> ';
                        }
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnEditarTroncal");
                        if($Respuesta=="SI"){
                            $botonesformulario .=   '<li class="nav-item"> <button id="btnEditarTroncal"   class="btn  btn-warning ml-1 ms-1 mt-1 btn-sinborde  font-smaller"  type="button">Editar</button> </li> ';
                        }
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btn_logueo_troncal");
                        if($Respuesta=="SI"){
                            $botonesformulario .= '<li class="nav-item"> <button  id="btn_logueo_troncal"  class="btn btn-warning ml-1 ms-1 mt-1 btn-sinborde font-smaller btn_logueo_troncal" type="button">Logueo</button> 	</li> ';
                        }
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnAgregarPuntoFijoTroncal");
                        if($Respuesta=="SI"){
                            $botonesformulario .=   '<li class="nav-item"> <button id="btnAgregarPuntoFijoTroncal" class="btn  btn-warning ml-1 ms-1 mt-1 btn-sinborde  font-smaller"  type="button">+Rep.Via</button> </li> ';
                        }
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnEditarTotalTroncal");
                        if($Respuesta=="SI"){
                            $botonesformulario .=   '<li class="nav-item"> <button id="btnEditarTotalTroncal" class="btn  btn-secondary ml-1 ms-1 mt-1 btn-sinborde font-smaller" type="button">+Camb.Bus</button> </li> ';
                        }
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnViajeTroncal");
                        if($Respuesta=="SI"){
                            $botonesformulario .=   '<li class="nav-item"> <button id="btnViajeTroncal" class="btn  btn-secondary ml-1 ms-1 mt-1  btn-sinborde font-smaller" type="button">+Viaje</button> </li> ';
                        }
                        $botonesformulario .=       '<li class="nav-item"> <button id="btnResumenTroncal" class="btn  btn-secondary ml-1 ms-1 mt-1  btn-sinborde font-smaller" type="button">Resumen</button> </li> 
                                                    <li class="nav-item"> <button id="btnInconsistenciasTroncal"class="btn  btn-danger ml-1 ms-1 mt-1  btn-sinborde font-smaller"  type="button">Incosist.</button> </li>
                                                </ul>';
                    break;
				}
			break;

            case "formSeleccionAlimentador":
                switch ($NombreObjeto)
                {
                    case "navbarNavDropdownAlimentador":
                        MModel($this->Modulo, 'CRUD');
                        $InstanciaAjax= new CRUD();
    
                        $botonesformulario = '  <div class="form-group m-0 mt-1 " id="div_btnViajesCanceladosAlimentador">
                                                    <div class="custom-control custom-checkbox ml-3">
                                                        <input type="checkbox" class="custom-control-input font-smaller" id="ViajesCanceladosAlimentador" value="ViajesCancelados" checked>
                                                        <label class="custom-control-label font-smaller" for="ViajesCanceladosAlimentador">Anulados</label>
                                                    </div>
                                                </div>
                                                <ul class="navbar-nav">';
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnAgregarNovedadAlimentador");
                        if($Respuesta=="SI"){
                            $botonesformulario .=   '<li class="nav-item"> <button id="btnAgregarNovedadAlimentador" class="btn btn-warning ml-1 ms-1 mt-1 btn-sinborde font-smaller" type="button">+Novedad</button> </li>';
                        }
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnEditarAlimentador");
                        if($Respuesta=="SI"){
                            $botonesformulario .=   '<li class="nav-item"> <button id="btnEditarAlimentador" class="btn btn-warning ml-1 ms-1 mt-1 btn-sinborde font-smaller" type="button">Editar</button> </li>';
                        }
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnEditarAlimentador");
                        if($Respuesta=="SI"){
                            $botonesformulario .= '<li class="nav-item"> <button  id="btn_logueo_alimentador"  class="btn btn-warning ml-1 ms-1 mt-1 btn-sinborde font-smaller btn_logueo_alimentador" type="button">Logueo</button> 	</li> ';
                        }
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnAgregarPuntoFijoAlimentador");
                        if($Respuesta=="SI"){
                            $botonesformulario .=   '<li class="nav-item"> <button id="btnAgregarPuntoFijoAlimentador" class="btn btn-warning ml-1 ms-1 mt-1 btn-sinborde font-smaller" type="button">+Rep.Via</button> </li>';
                        }
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnEditarTotalAlimentador");
                        if($Respuesta=="SI"){
                            $botonesformulario .=   '<li class="nav-item"> <button id="btnEditarTotalAlimentador" class="btn btn-secondary ml-1 ms-1 mt-1 btn-sinborde font-smaller" type="button">+Camb.Bus</button> </li>';
                        }
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnViajeAlimentador");
                        if($Respuesta=="SI"){
                            $botonesformulario .=   '<li class="nav-item"> <button id="btnViajeAlimentador" class="btn btn-secondary ml-1 ms-1 mt-1 btn-sinborde font-smaller" type="button">+Viaje</button> </li> ';
                        }
                        $botonesformulario .=       '<li class="nav-item"> <button id="btnResumenAlimentador" class="btn btn-secondary ml-1 ms-1 mt-1 btn-sinborde font-smaller"  type="button">Resumen</button> </li>
                                                    <li class="nav-item"> <button id="btnInconsistenciasAlimentador" class="btn btn-danger ml-1 ms-1 mt-1 btn-sinborde font-smaller" type="button">Incosist.</button> </li> 
                                                </ul>';
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
						$InstanciaAjax= new CRUD();
						$divformulario=$InstanciaAjax->Permisos($this->Modulo,$NombreObjeto);
					break;

					case "div_ReporteGDH":
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$divformulario=$InstanciaAjax->Permisos($this->Modulo,$NombreObjeto);
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

				}
			break;

			case "form_seleccion_novedad_carga":
				switch($NombreObjeto)
				{
					case "div_seleccion_novedad_carga":
                        $Mostrar_div = '<button type="button" id="btnBuscarNovedadCarga" class="btn btn-secondary btn-sm btnBuscarNovedadCarga">Buscar</button>';
                        $boton_cargar_pdf = " <button type='button' id='btn_cargar_pdf_novedades' class='btn btn-danger btn-sm btn_cargar_pdf_novedades'><i class='bi bi-file-earmark-pdf'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-file-earmark-pdf' viewBox='0 0 16 16'><path d='M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z'/><path d='M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z'/></svg></i></button> ";
                        $boton_ver_pdf = ' <button type="button" id="btn_ver_pdf_novedades" class="btn btn-danger btn-sm btn_ver_pdf_novedades"><i class="bi bi-arrows-fullscreen"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-fullscreen" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707zm0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707zm-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707z"/></svg>PDF</i></button> ';
                        if($Dato!=""){
                            $nove_estado = "";
                            $nove_imagen = "NO";
                            MModel($this->Modulo, 'CRUD');
                            $InstanciaAjax= new CRUD();
                            $Respuesta=$InstanciaAjax->BuscarDataBD('OPE_Novedad','Novedad_Id',$Dato);
                            foreach($Respuesta as $row){
                                $nove_estado = $row['Nove_Estado'];
                            }
                            if($nove_estado=='PENDIENTE'){
                                $Mostrar_div .= $boton_cargar_pdf;
                            }
                            MModel($this->Modulo, 'CRUD');
                            $InstanciaAjax= new CRUD();
                            $Respuesta=$InstanciaAjax->BuscarDataBD('ope_novedad_imagen','novedad_id',$Dato);
                            foreach($Respuesta as $row){
                                $nove_imagen = "SI";
                            }
                            if($nove_imagen=="SI"){
                                $Mostrar_div .= $boton_ver_pdf;
                            }
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