<?php
session_start();
class Accesos
{
    var $Modulo="costo_accidentes";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-costo_accidentes":
				$tabshtml = '   <a class="nav-item nav-link active" id="nav-home-tab-listado" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Listado</a>';
				/*$tabshtml .= '   <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"></a>';
                $tabshtml .= '   <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"></a>';
                $tabshtml .= '   <a class="nav-item nav-link" id="nav-reporte-tab" data-toggle="tab" href="#nav-reporte" role="tab" aria-controls="nav-reporte" aria-selected="false"></a>';*/
            break;

            case "":
                $tabshtml = '';
            break;
		}
		echo $tabshtml;
	}

    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
        $tablahtml="";
        switch ($NombreTabla)
        {
            case "tabla_costo_accidentes":
                $tablahtml = '  <table id="tabla_costo_accidentes" class="table table-striped table-bordered table-condensed w-100 tabla_costo_accidentes"  >
                                    <thead class="text-center">
                                        <tr>
                                            <th>COD.APLICACION</th>
                                            <th>FECHA ACCID.</th>
                                            <th>PILOTO</th>
                                            <th>BUS</th>
                                            <th>PLACA</th>
                                            <th>OPERACION</th>
                                            <th>M. CONCIL.</th>
                                            <th>M. COTIZADO</th>
                                            <th>ESTADO COTIZ.</th>
                                            <th>RESPONSABILIDAD</th>
                                            <th>FIRMA CONVENIO</th>
                                        </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

            case "":
                $tablahtml = '';
                switch ($TipoTabla)
                {
                    case "":
                        $tablahtml .= '';
                    break;
                    case "":
                        $tablahtml .= '';
                    break;
                    case "":
                        $tablahtml .= '';
                    break;
                    case "":
                        $tablahtml .= '';
                    break;
                }
                $tablahtml .= '';
            break;
        }
        echo $tablahtml;
    }

    public function ColumnasTabla($NombreTabla,$TipoTabla)
    {
        $columnasjs="";
        switch ($NombreTabla)
        {
            case "tabla_costo_accidentes":
                $defaultContent_1 = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_costo_accidentes'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
                $defaultContent_2 = "<div class='text-center'><div class='btn-group'><button title='PDF' class='btn btn-danger btn-sm btn_ip_pdf'><i class='bi bi-file-earmark-pdf'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-file-earmark-pdf' viewBox='0 0 16 16'><path d='M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z'/><path d='M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z'/></svg></i></button></div></div>";
                $columnasjs = '[    {"data": "codigo_aplicacion"},
                                    {"data": "fecha_accidente"},
                                    {"data": "nombre_piloto"},
                                    {"data": "bus"},
                                    {"data": "placa"},
                                    {"data": "operacion"},
                                    {"data": "monto_conciliado"},
                                    {"data": "monto_cotizado"},
                                    {"data": "estado_final"},
                                    {"data": "responsabilidad"},
                                    {"data": "firma_convenio"}
                                ]';
            break;

            case "":
                $columnasjs .= '';
                switch ($TipoTabla)
                {
                    case "":
                        $columnasjs .= '';
                    break;
                    case "":
                        $columnasjs .= '';
                    break;
                }
                $columnasjs .= ' ]';
            break;
        }
        echo $columnasjs;

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
                        $botonesformulario .= '';
					break;
                }
            break;


            case "":
                switch ($NombreObjeto)
                {
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
		$color = "";
		switch($NombreFormulario)
		{
			case "form_seleccion_costo_accidentes":
				switch($NombreObjeto)
				{
					case "div_seleccion_costo_accidentes":
                        $acci_responsabilidad_accidente = "";
                        $acos_estado                    = "";
                        $btn_buscar_costo_accidentes    = ' <button type="button" id="btn_buscar_costo_accidentes" class="btn btn-secondary btn-sm btn_buscar_costo_accidentes">Buscar</button>';
                        $btn_cargar_cotizacion          = ' <button type="button" id="btn_cargar_cotizacion" class="btn btn-secondary btn-sm btn_cargar_cotizacion">Carg.Cotiz.</button>';
                        $btn_firma_convenio             = ' <button type="button" id="btn_firma_convenio" class="btn btn-secondary btn-sm btn_firma_convenio">F.Conven.</button>';
                        $btn_ver_ip                     = ' <button type="button" id="btn_ver_ip" class="btn btn-secondary btn-sm btn_ver_ip">Ver I.P.</button>';
                        $btn_ver_doc_adj                = ' <button type="button" id="btn_ver_doc_adj" class="btn btn-secondary btn-sm btn_ver_doc_adj">Ver Doc.Adj.</button>';
                        $btn_ver_cotizacion             = ' <button type="button" id="btn_ver_cotizacion" class="btn btn-secondary btn-sm btn_ver_cotizacion">Ver Cotiz.</button>';
						$Mostrar_div = $btn_buscar_costo_accidentes;
                        if($Dato!=""){
                            MModel($this->Modulo, 'CRUD');
                            $InstanciaAjax  = new CRUD();
                            $Respuesta      = $InstanciaAjax->Permisos($this->Modulo,"btn_cargar_cotizacion");
                            if($Respuesta=="SI"){
                                $Mostrar_div .= $btn_cargar_cotizacion;
                            }
                            $Respuesta      = $InstanciaAjax->Permisos($this->Modulo,"btn_firma_convenio");
                            if($Respuesta=="SI"){
                                MModel($this->Modulo, 'CRUD');
                                $InstanciaAjax  = new CRUD();
                                $Respuesta2     = $InstanciaAjax->BuscarDataBD("OPE_AccidentesInvestigacion", "Accidentes_Id", $Dato);
                                foreach($Respuesta2 as $row2){
                                    $acci_responsabilidad_accidente = $row2['Acci_ResponsabilidadAccidente'];
                                }
                                MModel($this->Modulo, 'CRUD');
                                $InstanciaAjax  = new CRUD();
                                $Respuesta3     = $InstanciaAjax->BuscarDataBD("ope_accidentes_costo", "acos_accidentes_id", $Dato);
                                foreach($Respuesta3 as $row3){
                                    $acos_estado = $row3['acos_estado'];
                                    $acos_firma_convenio = $row3['acos_firma_convenio'];
                                }
                                if($acci_responsabilidad_accidente=="DIRECTA" && $acos_estado=="CERRADO" && $acos_firma_convenio!='CERRADO'){
                                    $Mostrar_div .= $btn_firma_convenio;
                                }
                            }
                            $Mostrar_div .= $btn_ver_ip;
                            $Mostrar_div .= $btn_ver_doc_adj;
                            $Mostrar_div .= $btn_ver_cotizacion;
                        }
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