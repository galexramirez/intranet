<?php
session_start();
class Accesos
{
    var $Modulo="Accidentes";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-Accidentes":
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
				$tabshtml = '<a class="nav-item nav-link active" id="nav-home-tab-Accidentes" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Listado</a>';
	    		$Respuesta = $InstanciaAjax->Permisos($this->Modulo,"nav-profile-tab-InformePreliminar");
                if($Respuesta=="SI"){
                    $tabshtml .= '<a class="nav-item nav-link" id="nav-profile-tab-InformePreliminar" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Informe Preliminar</a>';
                }
	    		$Respuesta = $InstanciaAjax->Permisos($this->Modulo,"nav-contact-tab-Investigacion");
                if($Respuesta=="SI"){
                    $tabshtml .= '<a class="nav-item nav-link" id="nav-contact-tab-Investigacion" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Informe Final</a>';
                }
	    		$Respuesta = $InstanciaAjax->Permisos($this->Modulo,"nav-reporte-tab-analisis_novedades");
                if($Respuesta=="SI"){
                    $tabshtml .= '<a class="nav-item nav-link" id="nav-reporte-tab-analisis_novedades" data-toggle="tab" href="#nav-reporte" role="tab" aria-controls="nav-reporte" aria-selected="false">Reporte</a>';
                }
	    		$Respuesta = $InstanciaAjax->Permisos($this->Modulo,"nav-reporte-tab-ajustes");
                if($Respuesta=="SI"){
                    $tabshtml .= '<a class="nav-item nav-link" id="nav-reporte-tab-ajustes" data-toggle="tab" href="#nav-ajustes" role="tab" aria-controls="nav-ajustes" aria-selected="false">Ajustes</a>';
                }
            break;

            case "nav-tab-InformePreliminar":
                $tabshtml = '   <a class="nav-item nav-link active" id="nav-AccidenteIncidente-tab" data-toggle="tab" href="#nav-AccidenteIncidente" role="tab" aria-controls="nav-AccidenteIncidente" aria-selected="true">Accidente / Incidente</a>
                                <a class="nav-item nav-link" id="nav-NaturalezaPerdida-tab" data-toggle="tab" href="#nav-NaturalezaPerdida" role="tab" aria-controls="nav-NaturalezaPerdida" aria-selected="false">Naturaleza de la Pérdida</a>
                                <a class="nav-item nav-link" id="nav-CausasAcciones-tab" data-toggle="tab" href="#nav-CausasAcciones" role="tab" aria-controls="nav-CausasAcciones" aria-selected="false">Causas y Acciones</a>
                                <a class="nav-item nav-link" id="nav-Imagenes-tab" data-toggle="tab" href="#nav-Imagenes" role="tab" aria-controls="nav-Imagenes" aria-selected="false">Imagenes</a>
                                <a class="nav-item nav-link" id="nav-DanosReparacion-tab" data-toggle="tab" href="#nav-DanosReparacion" role="tab" <aria-controls="nav-DanosReparacion" aria-selected="false">Daños para Reparación</a>';
            break;
		}
		echo $tabshtml;
	}

    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
        $tablahtml="";
        switch ($NombreTabla)
        {
            case "tablaAccidentes":
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $tablahtml =   '<table id="tablaAccidentes" class="table table-striped table-bordered table-condensed w-100"  >
                                    <thead class="text-center">
                                        <tr>
                                            <th>ID PROG.</th>
                                            <th>ID NOVEDAD</th>
                                            <th>FECHA</th>
                                            <th>USUARIO_QUE_GENERA</th>
                                            <th>OPERACION</th>
                                            <th>TIPO NOVEDAD</th>
                                            <th>DETALLE NOVEDAD</th>
                                            <th>APELLIDOS_Y_NOMBRES</th>
                                            <th>BUS</th>
                                            <th>ESTADO NOVEDAD</th>
                                            <th>REPO.FACI.</th>
                                            <th>INF.PREL.</th>
                                            <th>ID ACCIDENTE</th>
                                            <th>EST. I.P.</th>
                                            <th>PDF I.P.</th>
                                            <th>ADJ. PDF</th>
                                            <th>DOC. ADJ.</th>
                                        </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

            case "tablaDanosPersonales":
                $tablahtml = '  <table id="tablaDanosPersonales" class="table table-striped table-bordered table-condensed w-100" >
                                    <thead class="text-center">
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE DE LESIONADO</th>
                                            <th>DNI</th>
                                            <th>EDAD</th>
                                            <th>GENERO</th>
                                            <th>ORIGEN</th>
                                            <th>DETALLE DE LESIONES</th>';
                if($TipoTabla=="SI"){
                    $tablahtml .= '          <th>OPCIONES</th>';
                }
                $tablahtml .= '         </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

            case "tablaDanosTerceros":
                $tablahtml = '  <table id="tablaDanosTerceros" class="table table-striped table-bordered table-condensed w-100"  >
                                    <thead class="text-center">
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE DE TERCERO IMPLICADO</th>
                                            <th>DNI</th>
                                            <th>PLACA</th>
                                            <th>DETALLE DE DAÑOS</th>';
                if($TipoTabla=="SI"){
                    $tablahtml .= '         <th>OPCIONES</th>';
                }
                $tablahtml .= '         </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

            case "tablaCausasAccidentes":
                $tablahtml = '  <table id="tablaCausasAccidentes" class="table table-striped table-bordered table-condensed w-100"  >
                                    <thead class="text-center">
                                        <tr>
                                            <th>ID</th>
                                            <th>CAUSAS POSIBLES</th>';
                if($TipoTabla=="SI"){
                    $tablahtml .= '         <th>OPCIONES</th>';
                }
                $tablahtml .= '         </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

            case "tablaAccionesTomadas":
                $tablahtml = '  <table id="tablaAccionesTomadas" class="table table-striped table-bordered table-condensed w-100"  >
                                    <thead class="text-center">
                                        <tr>
                                            <th>ID</th>
                                            <th>ACCIONES TOMADAS</th>';
                if($TipoTabla=="SI"){
                    $tablahtml .= '         <th>OPCIONES</th>';
                }
                $tablahtml .= '         </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

            case "tablaDanosReparacion":
                $tablahtml = '  <table id="tablaDanosReparacion" class="table table-striped table-bordered table-condensed w-100"  >
                                    <thead class="text-center">
                                        <tr>
                                            <th>ID</th>
                                            <th>COD.COLOR</th>
                                            <th>POSICION (COD.SECCION BUS)</th>
                                            <th>DESCRIPCION ADICIONAL</th>';
                if($TipoTabla=="SI"){
                    $tablahtml .= '         <th>OPCIONES</th>';
                }
                $tablahtml .= '         </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

            case "tablaInvestigacion":
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta = $InstanciaAjax->Permisos($this->Modulo,"btnCargarInvestigacion"); 
                $tablahtml = '  <table id="tablaInvestigacion" class="table table-striped table-bordered table-condensed w-100"  >
                                    <thead class="text-center">
                                        <tr>
                                            <th>ID ACCID.</th>
                                            <th>ESTADO INF.PREL.</th>
                                            <th>FECHA</th>
                                            <th>HORA</th>
                                            <th>NOMBRE CGO</th>
                                            <th>NOMBRE PILOTO</th>
                                            <th>FECHA INGRESO</th>
                                            <th>ANTIGUEDAD</th>
                                            <th>H.TRAB.</th>
                                            <th>TABLA</th>
                                            <th>SERVICIO</th>
                                            <th>BUS</th>
                                            <th>PLACA</th>
                                            <th>TIPO BUS</th>
                                            <th>DIRECCION ACCID.</th>
                                            <th>SENTIDO ACCID.</th>
                                            <th>TIPO ACCID.</th>
                                            <th>CLASE ACCID.</th>
                                            <th>EVENTO</th>
                                            <th>RECON.RESP.</th>
                                            <th>CANT.LESION.</th>
                                            <th>ESTADO INVEST.</th>
                                            <th>INF.FIN.PDF</th>';
                if($Respuesta=="SI"){
                    $tablahtml .= '         <th>ACCIONES</th>';
                }
                $tablahtml .= '         </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

            case "tablaReportegdh":
                $tablahtml = '  <table id="tablaReportegdh" class="table table-striped table-bordered table-condensed w-100"  >
                                    <thead class="text-center">
                                        <tr>
                                            <th>COD. APLIC.</th>
                                            <th>FECHA ACCID.</th>
                                            <th>HORA ACCID.</th>
                                            <th>NOMBRE CGO</th>
                                            <th>DNI PILOTO</th>
                                            <th>COD. PILOTO</th>
                                            <th>NOMBRE PILOTO</th>
                                            <th>FECHA INGRESO</th>
                                            <th>ANTIGUEDAD</th>
                                            <th>TABLA</th>
                                            <th>BUS</th>
                                            <th>NRO.PLACA</th>
                                            <th>SERVICIO</th>
                                            <th>DIRECC. ACCID.</th>
                                            <th>SENTIDO ACCID.</th>
                                            <th>CLASE ACCID.</th>
                                            <th>EVENTO</th>
                                            <th>OCURRENCIA</th>
                                            <th>RECON.RESP.</th>
                                            <th>DAÑOS VEHICULO LBI</th>
                                            <th>CONCILIADO</th>
                                            <th>MONEDA</th>
                                            <th>MONTO</th>
                                            <th>TRAMITE POLICIAL</th>
                                            <th>ASISTIO ACCID.</th>
                                            <th>GRAVEDAD</th>
                                            <th>COSTO TOTAL</th>
                                            <th>RESPONSABILIDAD</th>
                                            <th>FECHA CARGA</th>
                                            <th>CAUSAS</th>
                                            <th>FACTOR DETERMINANTE</th>
                                            <th>RESP.DETERMINANTE</th>
                                            <th>FACTOR CONTRIBUTIVO</th>
                                            <th>RESP.CONTRIBUTIVO</th>
                                            <th>CODIGO RIT</th>
                                            <th>FALTA RIT</th>
                                            <th>AFECTA BONO</th>
                                            <th>TIPO DISCIPLINA</th>
                                            <th>CANT.LESION.</th>                                            
                                            <th>USUARIO GESTIONA</th>
                                            <th>DIAS INVEST.</th>
                                            <th>FECHA REGISTRO</th>
                                        </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

            case "tablaTipoTablaAccidentes":
                $tablahtml =    '<table id="tablaTipoTablaAccidentes" class="table table-striped table-bordered table-condensed w-100">
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
                                </table>';
            break;

            case "tabla_ver_lesionados":
                $tablahtml = '  <table id="tabla_ver_lesionados" class="table table-striped table-bordered table-condensed w-100" >
                                    <thead class="text-center">
                                        <tr>
                                            <th>NOMBRE DE LESIONADO</th>
                                            <th>DNI</th>
                                            <th>EDAD</th>
                                            <th>GENERO</th>
                                            <th>ORIGEN</th>
                                            <th>DETALLE DE LESIONES</th>
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
        $columnasjs="";
        switch ($NombreTabla)
        {
            case "tablaAccidentes":
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                
                $defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='R.Facilitador' class='btn btn-info btn-sm btnReporteFacilitador'><i class='bi bi-clipboard-plus'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-clipboard-plus' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z'/><path d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z'/><path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/></svg></i></button></div></div>";
                $defaultContent2 = "<div class='text-center'><div class='btn-group'><button title='I.Preliminar' class='btn btn-warning btn-sm btnInformePreliminar'><i class='bi bi-clipboard-plus'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-clipboard-plus' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z'/><path d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z'/><path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/></svg></i></button></div></div>";
                $defaultContent3 = "<div class='text-center'><div class='btn-group'><button title='Adjuntar PDF' class='btn btn-success btn-sm btnAdjuntarPDF'><i class='bi bi-cloud-upload-fill'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-cloud-upload-fill' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M8 0a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 4.095 0 5.555 0 7.318 0 9.366 1.708 11 3.781 11H7.5V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11h4.188C14.502 11 16 9.57 16 7.773c0-1.636-1.242-2.969-2.834-3.194C12.923 1.999 10.69 0 8 0zm-.5 14.5V11h1v3.5a.5.5 0 0 1-1 0z'/></svg></i></button></div></div>";
                $columnasjs = '[    {"data": "Nove_ProgramacionId"},
                                    {"data": "Novedad_Id"},
                                    {"data": "Nove_FechaOperacion"},
                                    {"data": "UsuarioGenera"},
                                    {"data": "Nove_Operacion"},
                                    {"data": "Nove_TipoNovedad"},
                                    {"data": "Nove_DetalleNovedad"},
                                    {"data": "Nove_NombreColaborador"},
                                    {"data": "Nove_Bus"},
                                    {"data": "Nove_Estado"},
                                    {"defaultContent": " '.$defaultContent1.' "},
                                    {"defaultContent": " '.$defaultContent2.' "},
                                    {"data": "Accidentes_Id"},
                                    {"data": "Acci_EstadoInformePreliminar"},
                                    {"data": "acci_ip_pdf"},
                                    {"defaultContent": " '.$defaultContent3.' "},
                                    {"data": "acci_doc_adj"}
                                ]';
            break;

            case "tablaDanosPersonales":
                $columnasjs = ' [   {"data": "OPE_AcciNaturalezaId"},
                                    {"data": "Acci_Nombre"},
                                    {"data": "Acci_Dni"},
                                    {"data": "Acci_Edad"},
                                    {"data": "Acci_Genero"},
                                    {"data": "acci_origen"},
                                    {"data": "Acci_Descripcion"}';
                if($TipoTabla=="SI"){
                    $defaultContent = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_danos_personales'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button tittle='Borrar' class='btn btn-danger btn-sm btnBorrarDanosPersonales'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
                    $columnasjs .= ',{"defaultContent": "'.$defaultContent.'"}';
                }
                $columnasjs .= ']';
            break;

            case "tablaDanosTerceros":
                $columnasjs = '[    {"data": "OPE_AcciNaturalezaId"},
                                    {"data": "Acci_Nombre"},
                                    {"data": "Acci_Dni"},
                                    {"data": "Acci_Placa"},
                                    {"data": "Acci_Descripcion"}';
                if($TipoTabla=="SI"){
                    $defaultContent = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_danos_terceros'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button tittle='Borrar' class='btn btn-danger btn-sm btnBorrarDanosTerceros'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
                    $columnasjs .= ',{"defaultContent": "'.$defaultContent.'"}';
                }
                $columnasjs .= ']';
            break;

            case "tablaCausasAccidentes":
                $columnasjs = '[    {"data": "OPE_AcciNaturalezaId"},
                                    {"data": "Acci_Descripcion"}';
                if($TipoTabla=="SI"){
                    $defaultContent = "<div class='text-center'><div class='btn-group'><button tittle='Borrar' class='btn btn-danger btn-sm btnBorrarCausasAccidentes'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
                    $columnasjs .= ',{"defaultContent": "'.$defaultContent.'"}';
                }
                $columnasjs .= ']';
            break;

            case "tablaAccionesTomadas":
                $columnasjs = '[    {"data": "OPE_AcciNaturalezaId"},
                                    {"data": "Acci_Descripcion"}';
                if($TipoTabla=="SI"){
                    $defaultContent = "<div class='text-center'><div class='btn-group'><button tittle='Borrar' class='btn btn-danger btn-sm btnBorrarAccionesTomadas'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
                    $columnasjs .= ',{"defaultContent": "'.$defaultContent.'"}';
                }
                $columnasjs .= ']';
            break;

            case "tablaDanosReparacion":
                $columnasjs = '[    {"data": "OPE_AcciReparacionId"},
                                    {"data": "Acci_CodigoColor"},
                                    {"data": "Acci_SeccionBus"},
                                    {"data": "Acci_DescripcionReparacion"}';
                if($TipoTabla=="SI"){
                    $defaultContent = "<div class='text-center'><div class='btn-group'><button tittle='Borrar' class='btn btn-danger btn-sm btnBorrarDanosReparacion'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
                    $columnasjs .= ',{"defaultContent": "'.$defaultContent.'"}';
                }
                $columnasjs .= ']';
            break;

            case "tablaInvestigacion":
                $defaultContent = "<div class='text-center'><div class='btn-group'><button title='Investigación' class='btn btn-info btn-sm btnCargarInvestigacion'><i class='bi bi-clipboard-plus'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-clipboard-plus' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z'/><path d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z'/><path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/></svg></i></button></div></div>";
                $defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='PDF' class='btn btn-danger btn-sm btnFilePDF'><i class='bi bi-file-earmark-pdf'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-file-earmark-pdf' viewBox='0 0 16 16'><path d='M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z'/><path d='M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z'/></svg></i></button></div></div>";
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnCargarInvestigacion");
                $columnasjs = '[    {"data": "Accidentes_Id"},
                                    {"data": "Acci_EstadoInformePreliminar"},
                                    {"data": "Acci_Fecha"},
                                    {"data": "Acci_Hora"},
                                    {"data": "Acci_NombreCGO"},
                                    {"data": "Acci_NombreColaborador"},
                                    {"data": "Colab_FechaIngreso"},
                                    {"data": "Acci_Antiguedad"},
                                    {"data": "Acci_HorasTrabajadas"},
                                    {"data": "Acci_Tabla"},
                                    {"data": "Acci_Servicio"},
                                    {"data": "Acci_Bus"},
                                    {"data": "Bus_NroPlaca"},
                                    {"data": "Acci_TipoBus"},
                                    {"data": "Acci_Lugar"},
                                    {"data": "Acci_Sentido"},
                                    {"data": "Acci_TipoAccidente"},
                                    {"data": "Acci_ClaseAccidente"},
                                    {"data": "Acci_TipoEvento"},
                                    {"data": "Acci_ReconoceResponsabilidad"},
                                    {"data": "acci_cantidad_lesionados"},
                                    {"data": "Acci_EstadoInvestigacion"},
                                    {"defaultContent": "'.$defaultContent1.'"}';
                if($Respuesta=="SI"){
                    $columnasjs .= '    ,{"defaultContent": "'.$defaultContent.'"}';
                }
                $columnasjs .= ']';
            break;

            case "tablaReportegdh":
                $columnasjs = '[    {"data": "Accidentes_Id"},
                                    {"data": "Acci_Fecha"},
                                    {"data": "Acci_Hora"},
                                    {"data": "Acci_NombreCGO"},
                                    {"data": "Acci_Dni"},
                                    {"data": "Acci_CodigoColaborador"},
                                    {"data": "Acci_NombreColaborador"},
                                    {"data": "Acci_FechaIngreso"},
                                    {"data": "Acci_Antiguedad"},
                                    {"data": "Acci_Tabla"},
                                    {"data": "Acci_Bus"},
                                    {"data": "Acci_NroPlaca"},
                                    {"data": "Acci_Servicio"},
                                    {"data": "Acci_Lugar"},
                                    {"data": "Acci_Sentido"},
                                    {"data": "Acci_TipoAccidente"},
                                    {"data": "Acci_TipoEvento"},
                                    {"data": "ocurrencia"},
                                    {"data": "Acci_ReconoceResponsabilidad"},
                                    {"data": "Acci_DanosMateriales"},
                                    {"data": "Acci_Conciliacion"},
                                    {"data": "Acci_Moneda"},
                                    {"data": "Acci_MontoConciliado"},
                                    {"data": "Acci_DocDenunciaPolicial"},
                                    {"data": "Acci_NombrePersonalApoyo"},
                                    {"data": "Acci_GravedadEvento"},
                                    {"data": "Acci_CostoTotalReparacion"},
                                    {"data": "Acci_ResponsabilidadAccidente"},
                                    {"data": "Acci_FechaReporteGDH"},
                                    {"data": "causas_accidentes"},
                                    {"data": "Acci_FactorDeterminante"},
                                    {"data": "Acci_ResponsabilidadDeterminante"},
                                    {"data": "Acci_FactorContributivo"},
                                    {"data": "Acci_ResponsabilidadContributivo"},
                                    {"data": "Acci_CodigoRIT"},
                                    {"data": "Acci_DescripcionRIT"},
                                    {"data": "afecta_bono"},
                                    {"data": "Acci_AccionDisciplinaria"},
                                    {"data": "acci_cantidad_lesionados"},
                                    {"data": "usuario_gestiona"},
                                    {"data": "dias_investigacion"},
                                    {"data": "Acci_FechaRegistro"}
                                ]';
            break;

            case "tablaTipoTablaAccidentes":
                $defaultContent = " <div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarTipoTablaAccidentes'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btnBorrarTipoTablaAccidentes'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
                $columnasjs = ' [   {"data": "TtablaAccidentes_Id"},
                                    {"data": "TtablaAccidentes_Operacion"},
                                    {"data": "TtablaAccidentes_Tipo"},
                                    {"data": "TtablaAccidentes_Detalle"},
                                    {"defaultContent": "'.$defaultContent.'"}
                                ]';
            break;

            case "tabla_ver_lesionados":
                $columnasjs = ' [   {"data": "Acci_Nombre"},
                                    {"data": "Acci_Dni"},
                                    {"data": "Acci_Edad"},
                                    {"data": "Acci_Genero"},
                                    {"data": "acci_origen"},
                                    {"data": "Acci_Descripcion"}
                                ]';
            break;

        }
        echo $columnasjs;

    }

	public function BotonesFormulario($NombreFormulario,$NombreObjeto)
	{
		$botonesformulario = "";
		switch($NombreFormulario)
		{
			case "formAccidenteIncidente":
				switch($NombreObjeto)
				{
					case "div_btnInformePreliminar":
                        MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
                        $botonesformulario = '';
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnEditarInformePreliminar");
                        if($Respuesta=="SI"){
                            $botonesformulario .= ' <div class="btn-group mr-2" role="group" aria-label="First group">
                                                        <button type="button" id="btnEditarInformePreliminar" class="btn btn-secondary btn-sm">Editar</button>
                                                    </div>';
                        }
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnCancelarInformePreliminar");
                        if($Respuesta=="SI"){
                            $botonesformulario .= ' <div class="btn-group mr-2" role="group" aria-label="Second group">
                                                        <button type="button" id="btnCancelarInformePreliminar" class="btn btn-secondary btn-sm">Cancelar</button>
                                                    </div>';
                        }
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnGuardarInformePreliminar");
                        if($Respuesta=="SI"){
                            $botonesformulario .= ' <div class="btn-group" role="group" aria-label="Third group">
                                                        <button type="button" id="btnGuardarInformePreliminar" class="btn btn-secondary btn-sm">Guardar</button>
                                                    </div>';
                        }
					break;
                }
            break;

            case "formDanosMateriales":
                switch($NombreObjeto)
                {
                    case "div_btnAgregarDanosMateriales":
                        $botonesformulario .= '<button type="button" id="btnAgregarDanosMateriales" class="btn btn-info btn-sm">+ Daños Materiales</button>';
                    break;
				}
			break;

            case "formDanosPersonales":
                switch ($NombreObjeto)
                {
                    case "div_btnAgregarDanosPersonales":
                        $botonesformulario .= '<button type="button" id="btnAgregarDanosPersonales" class="btn btn-info btn-sm">+ Daños Personales</button>';
                    break;
                }
            break;

            case "formDanosTerceros":
                switch ($NombreObjeto)
                {
                    case "div_btnAgregarDanosTerceros":
                        $botonesformulario .= '<button type="button" id="btnAgregarDanosTerceros" class="btn btn-info btn-sm">+ Daños a Terceros</button>';
                    break;
                }
            break;

            case "formCausasAccidentes":
                switch ($NombreObjeto)
                {
                    case "div_btnAgregarCausasAccidentes":
                        $botonesformulario .= '<button type="button" id="btnAgregarCausasAccidentes" class="btn btn-info btn-sm">+ Causas</button>';
                    break;
                }
            break;

            case "formAccionesTomadas":
                switch ($NombreObjeto)
                {
                    case "div_btnAgregarAccionesTomadas":
                        $botonesformulario .= '<button type="button" id="btnAgregarAccionesTomadas" class="btn btn-info btn-sm">+ Acciones</button>';
                    break;
                }
            break;

            case "formDanosReparacion":
                switch ($NombreObjeto)
                {
                    case "div_btnAgregarDanosReparacion":
                        $botonesformulario .= '<button type="button" id="btnAgregarDanosReparacion" class="btn btn-info btn-sm">+ Daños para Reparación</button>';
                    break;

                    case "div_btn_cerrar_informe_preliminar":
                        $botonesformulario .= '<button type="button" id="btn_log_informe_preliminar" class="btn btn-info btn-sm btn_log_informe_preliminar ml-1">Log IP</button>';
                        $botonesformulario .= '<button type="button" id="btn_generar_pdf_informe_preliminar" class="btn btn-dark btn-sm btn_generar_pdf_informe_preliminar ml-1">Generar IP</button>';
                        MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnAbrirInformePreliminar");
                        if($Respuesta=="SI"){
                            $botonesformulario .= '<button type="button" id="btnAbrirInformePreliminar" class="btn btn-dark btn-sm btnAbrirInformePreliminar ml-1">Abrir</button>';
                        }
                        MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btnCerrarInformePreliminar");
                        if($Respuesta=="SI"){
                            $botonesformulario .= '<button type="button" id="btnCerrarInformePreliminar" class="btn btn-dark btn-sm btnCerrarInformePreliminar ml-1">Cerrar</button>';
                        }
                    break;

                }
            break;

            case "form_informe_final":
                switch ($NombreObjeto)
                {
                    case "div_btn_cerrar_informe_final":
                        $botonesformulario .= '<button type="button" id="btn_log_informe_final" class="btn btn-info btn-sm btn_log_informe_final">Log IF</button>';
                        $botonesformulario .= '<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>';
                        MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
                        $Respuesta=$InstanciaAjax->Permisos($this->Modulo,"btn_abrir_informe_final");
                        if($Respuesta=="SI"){
                            $botonesformulario .= '<button type="button" id="btn_abrir_informe_final" class="btn btn-secondary btn-sm btn_abrir_informe_final">Abrir</button>';
                        }
                        $botonesformulario .= '<button type="submit" id="btn_guardar_informe_final" class="btn btn-secondary btn-sm btn_guardar_informe_final">Guardar</button>';
                    break;

                    case "":
                        $botonesformulario .=       '';
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
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$divformulario=$InstanciaAjax->Permisos($this->Modulo,$NombreObjeto);
					break;

					case "":
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
			case "formAccidenteIncidente":
				switch($NombreObjeto)
				{
					case "div_Accidentes_Id":
						$Mostrar_div = '<h5 class="font-weight-bold">Código de Aplicación: '.$Dato.'</h5>';
					break;

					case "":
						switch($Dato)
						{
							case "":
								$color = "";
							break;

							case "":
								$color = "";

						}
						$Mostrar_div = ''.$color.''.$Dato.'';
					break;

					case "":
						$Mostrar_div = ''.$Dato.'';
					break;

				}
			break;
		}
		echo $Mostrar_div;
    }

}