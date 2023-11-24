<?php
session_start();
class Logico
{
	var $Modulo = "Materiales";

	function Contenido($NombreDeModuloVista)    
	{		
			
		MView('Materiales','LocalView',compact('NombreDeModuloVista') );
			
	}

    public function SelectTipos($ttablamateriales_operacion, $ttablamateriales_tipo)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectTipos($ttablamateriales_operacion, $ttablamateriales_tipo);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Detalle'].'">'.$row['Detalle'].'</option>';
        }
        echo $html;
    }

    public function CalculoFecha($inicio,$calculo)
    {
        $rptaFecha = "";
        switch ($inicio)
        {
            case "hoy":
                if($calculo=="0"){
                    $rptaFecha = date("Y-m-d");
                }
                if(strlen($calculo)>0 && $calculo!="0"){
                    $f = strtotime($calculo);
                    $rptaFecha = date("Y-m-d",$f);
                }
            break;
        }
        echo $rptaFecha;
    }

    public function AutoCompletar($NombreTabla,$NombreCampo)
    {
        $rpta_autocompletar = [];

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->AutoCompletar($NombreTabla,$NombreCampo);
        foreach ($Respuesta as $row) {
            if($NombreCampo=="material_id"){
                $rpta_autocompletar[] = ["value" => $row['material_id'], "label" => "<strong>".$row['material_id']."</strong>   ".$row['material_descripcion']];
            }else{
                $rpta_autocompletar[] = ["value" => $row['material_descripcion'], "label" => "<strong>".$row['material_id']."</strong>   ".$row['material_descripcion']];
            }
        }
		echo json_encode($rpta_autocompletar);
    }

    public function auto_completar($tabla, $campo_codigo, $campo_descripcion, $campo_asociado, $asociado, $campo_fecha, $fecha, $campo_tipo, $tipo)
    {
        $rpta_auto_completar = [];

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->auto_completar($tabla, $campo_asociado, $asociado, $campo_fecha, $fecha, $campo_tipo, $tipo);
        foreach ($Respuesta as $row) {
            $rpta_autocompletar[] = ["value" => $row[$campo_codigo], "label" => "<strong>".$row[$campo_codigo]."</strong>   ".$row[$campo_descripcion]];
        }
		echo json_encode($rpta_autocompletar);
    }

    public function SelectAnios()
    {
        $html = '';
        //Ejecuta Modelo
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectAnios();

        foreach ($Respuesta as $row)
        {
            $html .= '<option value="'.$row['Anio'].'">'.$row['Anio'].'</option>';
        }
        echo $html;	
    }

    public function BuscarDataBD($TablaBD,$CampoBD,$DataBuscar)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);

        print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function buscar_dato($nombre_tabla, $campo_buscar, $condicion_where)
	{
		$rpta_buscar_dato = "";
        MModel($this->Modulo, 'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->buscar_dato($nombre_tabla, $campo_buscar, $condicion_where);

        foreach ($Respuesta as $row) {
			$rpta_buscar_dato = $row[$campo_buscar];
		}
		echo $rpta_buscar_dato;
	}

    public function CompararFechaActual($fecha)
    {
        $rptaComparar = "";
        $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
        $fecha_entrada = strtotime($fecha);
            
        if($fecha_actual > $fecha_entrada){
            $rptaComparar = "MAYOR";
        }else{
            $rptaComparar = "MENOR IGUAL";
        }
        echo $rptaComparar;
    }

    public function DocumentRoot()
    {
        $miCarpeta = '';
        $miHost = $_SERVER['HTTP_HOST'];
        $miReferer = $_SERVER['HTTP_REFERER'];
        $miCarpeta = substr($miReferer,0,strpos($miReferer,$miHost)).$miHost.'/';
        echo $miCarpeta;
    }

    public function unidad_medida()
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->unidad_medida();

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['unidad_medida'].' - '.$row['um_descripcion'].'">'.$row['unidad_medida'].' - '.$row['um_descripcion'].'</option>';
        }
        echo $html;
    }

    public function encontrar_dato($tabla, $campo_encontrar, $data_buscar, $campo_devuelto)
    {
        $rpta_encontrar_dato = '';
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->encontrar_dato($tabla, $campo_encontrar, $data_buscar);

        foreach ($Respuesta as $row) {
            $rpta_encontrar_dato = $row[$campo_devuelto];
        }
        echo $rpta_encontrar_dato;
    }

    public function GenerarCodigoMateriales($cod_asignacion,$cod_macrosistema,$cod_sistema,$cod_tarjeta,$cod_condicion,$cod_flota)
    {
        $cod_material = "";
        $cod_componente = "";
        $cod_buscar = $cod_asignacion.$cod_macrosistema.$cod_sistema;
        $adata = [];

        $TablaBD = "manto_materiales";
        $CampoBD = "material_id";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->MaxComponente($TablaBD,$CampoBD,$cod_buscar);
        foreach ($Respuesta as $row) {
            $cod_componente = substr("000".strval(intval(substr($row['MaxComponente'],6,3))+1),-3);
        }
        
        $cod_material = $cod_asignacion.$cod_macrosistema.$cod_sistema.$cod_componente.$cod_tarjeta.$cod_condicion.$cod_flota;
        $adata[] = ["cod_componente" => $cod_componente, "cod_material" => $cod_material];
        
        echo json_encode($adata);
    }

    public function BuscarCodigoMateriales($cod_material)
    {
        $cod_asignacion = substr($cod_material,0,2);
        $cod_macrosistema = "";
        $cod_sistema = "";
        $cod_componente = substr($cod_material,6,3);
        $adata = [];

        $ttablamateriales_operacion = "MATERIALES";
        $ttablamateriales_tipo = "MACROSISTEMA";
        $ttablamateriales_detalle = substr($cod_material,2,2);
        $caracteres = "2";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarCodigoMateriales($ttablamateriales_tipo, $ttablamateriales_operacion, $ttablamateriales_detalle, $caracteres);
        foreach ($Respuesta as $row) {
            $cod_macrosistema = $row['ttablamateriales_detalle'];
        }

        $ttablamateriales_tipo = $cod_macrosistema;
        $ttablamateriales_detalle = substr($cod_material,4,2);

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarCodigoMateriales($ttablamateriales_tipo, $ttablamateriales_operacion, $ttablamateriales_detalle, $caracteres);
        foreach ($Respuesta as $row) {
            $cod_sistema = $row['ttablamateriales_detalle'];
        }

        $ttablamateriales_tipo = "TARJETA";
        $ttablamateriales_detalle = substr($cod_material,9,1);
        $caracteres = "1";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarCodigoMateriales($ttablamateriales_tipo, $ttablamateriales_operacion, $ttablamateriales_detalle, $caracteres);
        foreach ($Respuesta as $row) {
            $cod_tarjeta = $row['ttablamateriales_detalle'];
        }

        $ttablamateriales_tipo = $cod_tarjeta;
        $ttablamateriales_detalle = substr($cod_material,10,1);

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarCodigoMateriales($ttablamateriales_tipo, $ttablamateriales_operacion, $ttablamateriales_detalle, $caracteres);
        foreach ($Respuesta as $row) {
            $cod_condicion = $row['ttablamateriales_detalle'];
        }

        $ttablamateriales_tipo = "FLOTA";
        $ttablamateriales_detalle = substr($cod_material,11,2);
        $caracteres = "2";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarCodigoMateriales($ttablamateriales_tipo, $ttablamateriales_operacion, $ttablamateriales_detalle, $caracteres);
        foreach ($Respuesta as $row) {
            $cod_flota = $row['ttablamateriales_detalle'];
        }

        $adata[] = ["cod_asignacion" => $cod_asignacion, "cod_macrosistema" => $cod_macrosistema, "cod_sistema" => $cod_sistema, "cod_componente" => $cod_componente, "cod_tarjeta" => $cod_tarjeta, "cod_condicion" => $cod_condicion, "cod_flota" => $cod_flota ];
        
        echo json_encode($adata);
    }

    public function CrearMateriales($material_id,$material_descripcion, $material_unidadmedida, $material_patrimonial, $material_categoria,$material_estado,$material_observaciones, $material_obslog, $material_macrosistema, $material_sistema, $material_tarjeta, $material_condicion, $material_flota )
    {
        $material_responsablecreacion = $_SESSION['USUARIO_ID'];
        $material_log = "";
        $material_usuario = "";

        $TablaBD = "glo_roles";
        $CampoBD = "roles_dni";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$material_responsablecreacion);
        foreach ($Respuesta as $row) {
            $material_usuario = $row['roles_nombrecorto'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->CrearMateriales($material_id, $material_descripcion, $material_unidadmedida, $material_patrimonial, $material_categoria,$material_estado,$material_observaciones,$material_usuario,$material_log, $material_obslog, $material_macrosistema, $material_sistema, $material_tarjeta, $material_condicion, $material_flota);
    }

    public function EditarMateriales($material_id,$material_descripcion, $material_unidadmedida, $material_patrimonial, $material_categoria,$material_estado,$material_observaciones, $material_obslog)
    {
        $material_responsablecreacion = $_SESSION['USUARIO_ID'];
        $material_log = "";
        $material_usuario = "";

        $TablaBD = "glo_roles";
        $CampoBD = "roles_dni";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$material_responsablecreacion);
        foreach ($Respuesta as $row) {
            $material_usuario = $row['roles_nombrecorto'];
        }

        $TablaBD = "manto_materiales";
        $CampoBD = "material_id";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$material_id);
        foreach ($Respuesta as $row) {
            $material_log = $row['material_log'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->EditarMateriales($material_id, $material_descripcion, $material_unidadmedida, $material_patrimonial, $material_categoria,$material_observaciones,$material_usuario,$material_log,$material_estado, $material_obslog);
    }

    public function BuscarAsignarCodigoId($material_id)
    {
        $a_data = [];
        $TablaBD = "manto_materiales";
        $CampoBD = "material_id";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$material_id);
        echo json_encode($Respuesta);
    }

    public function BuscarAsignarCodigoDescripcion($material_descripcion)
    {
        $a_data = [];
        $TablaBD = "manto_materiales";
        $CampoBD = "material_descripcion";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$material_descripcion);
        foreach ($Respuesta as $row) {
            $a_data[] = ["material_id" => $row['material_id'], "material_descripcion" => $row['material_descripcion']];
        }
        echo json_encode($a_data);
    }

    public function MostrarPreciosProveedor($material_id)
    {
        $html = "";
        $TablaBD = "manto_preciosproveedor";
        $CampoBD = "precioprov_materialid";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$material_id);

        $html = '	<table id="tablaProveedorMateriales" class="table table-striped table-bordered table-condensed w-100 my-custom-scrollbar table-wrapper-scroll-y">
						<thead class="text-center">
							<tr>
							    <th>RUC</th>
							    <th>RAZON SOCIAL</th>
							    <th>CODIGO PROVEEDOR</th>
							    <th>DESCRIPCION PROVEEDOR</th> 
							    <th>MARCA</th>
							    <th>MONEDA</th>
							    <th>PRECIO</th>
							    <th>FECHA VIGENCIA</th>
							</tr>
                        </thead>
                        <tbody>';
        foreach ($Respuesta as $row){
            $html .='       <tr>
                                <td>'.$row['precioprov_ruc'].'</td>
                                <td>'.$row['precioprov_razonsocial'].'</td>
                                <td>'.$row['precioprov_codproveedor'].'</td>
                                <td>'.$row['precioprov_descripcion'].'</td>
                                <td>'.$row['precioprov_marca'].'</td>
                                <td>'.$row['precioprov_moneda'].'</td>
                                <td>'.$row['precioprov_precio'].'</td>
                                <td>'.$row['precioprov_fechavigencia'].'</td>
                            <tr>';
        }
		$html .='	    </tbody>
					</table>';
        echo $html;
    }

    public function CrearCargarPrecios($inputFileName,$Anio)
    {
        require_once 'Services/Composer/vendor/autoload.php';
          /**  Identify the type of $inputFileName  **/
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
         /**  Create a new Reader of the type that has been identified  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
         /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);
         /**  Hoja de trabajo de Excel  **/
        $worksheet = $spreadsheet->getActiveSheet();
         /**   Get the highest row number and column letter referenced in the worksheet   **/
        $highestRow = $worksheet->getHighestRow(); // e.g. 10

        $cpm_fechacarga = date("Y-m-d H:i:s");

        // Se asigna el nombre corto del usuario que genera
        $cpm_responsablecarga = $_SESSION['USUARIO_ID'];
        $precioprov_log = "";
        $cpm_usuario = "";
        $cpm_estado = "ACTIVO";

        $TablaBD = "glo_roles";
        $CampoBD = "roles_dni";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$cpm_responsablecarga);
        foreach ($Respuesta as $row) {
            $cpm_usuario = $row['roles_nombrecorto'];
        }

        // Se asigna el siguiente Id de manto_cargapreciomateriales a cpm_id
        $TablaBD="manto_cargapreciomateriales";
        $CampoId="cpm_id";
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $MaxId = $InstanciaAjax->MaxId($TablaBD,$CampoId);
        foreach ($MaxId as $row) {
            $cpm_id = $row['MaxId']+1;
        }
        $precioprov_cargaid = $cpm_id;
        $precioprov_responsablecreacion = $cpm_responsablecarga;
        $precioprov_fechacreacion = $cpm_fechacarga;

        $CantErrores=0;
        for ($row = 2; $row <= $highestRow; $row++) {
            $precioprov_codproveedor    = $worksheet->getCell('A'.$row)->getValue();
            $precioprov_descripcion     = $worksheet->getCell('B'.$row)->getValue();
            $precioprov_marca           = $worksheet->getCell('C'.$row)->getValue();
            $precioprov_procedencia     = $worksheet->getCell('D'.$row)->getValue();
            $precioprov_unidadmedida    = $worksheet->getCell('E'.$row)->getValue();
            $precioprov_garantia        = $worksheet->getCell('F'.$row)->getValue();
            $precioprov_moneda          = $worksheet->getCell('G'.$row)->getValue();
            $precioprov_precio          = $worksheet->getCell('H'.$row)->getValue();
            $precioprov_preciosoles     = $worksheet->getCell('I'.$row)->getValue();
            $precioprov_ruc             = $worksheet->getCell('J'.$row)->getValue();
            $precioprov_razonsocial     = $worksheet->getCell('K'.$row)->getValue();
            $precioprov_materialid      = $worksheet->getCell('L'.$row)->getValue();
            if(empty($precioprov_materialid)){
                $precioprov_estado = "NO RELACIONADO";
            }else{
                $precioprov_estado = "RELACIONADO";
            }
            $precioprov_log             = "<strong>".$precioprov_estado."</strong> ".$precioprov_fechacreacion." ".$cpm_usuario." CREACIÓN";
            $precioprov_documentacion   = $worksheet->getCell('M'.$row)->getValue();
            $precioprov_fechavigencia   = $worksheet->getCell('N'.$row)->getValue();
            $precioprov_tipo            = $worksheet->getCell('O'.$row)->getValue();
            $UNIX_DATE                  = ($precioprov_fechavigencia - 25569) * 86400;
            $precioprov_fechavigencia   = gmdate("Y-m-d", $UNIX_DATE);
                if (empty($precioprov_descripcion) || empty($precioprov_marca) || empty($precioprov_unidadmedida) || empty($precioprov_garantia) || empty($precioprov_moneda) || empty($precioprov_precio) || empty($precioprov_ruc) || empty($precioprov_razonsocial) || empty($precioprov_fechavigencia)){
                    $CantErrores=$CantErrores+1;
                    echo "No grabo linea ".$row." -> Código Proveedor: ".$precioprov_codproveedor." ERROR: Posible Datos INCOMPLETOS . <hr>"  ;
                }else{
                    MModel($this->Modulo, 'CRUD');
                    $InstanciaAjax= new CRUD();
                    $Respuesta=$InstanciaAjax->CrearPreciosProveedor($precioprov_codproveedor, $precioprov_descripcion, $precioprov_marca, $precioprov_procedencia, $precioprov_unidadmedida, $precioprov_garantia, $precioprov_moneda, $precioprov_precio, $precioprov_preciosoles, $precioprov_ruc, $precioprov_razonsocial, $precioprov_materialid, $precioprov_documentacion, $precioprov_fechavigencia, $precioprov_cargaid, $precioprov_responsablecreacion, $precioprov_fechacreacion, $precioprov_estado, $precioprov_log, $precioprov_tipo );
                    if(count($Respuesta)>0){
                        echo "No grabo linea ".$row." -> Código Proveedor: ".$precioproveedor_codproveedor." ERROR: "  ;
                        print_r($Respuesta);
                        echo "<br>";
                        $CantErrores = $CantErrores + 1;
                    }
                }
        }
        $cpm_nroregistros = $highestRow-$CantErrores-1;
        if($cpm_nroregistros>0){
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->CrearCargarPrecios($cpm_nroregistros, $cpm_fechacarga, $cpm_responsablecarga, $cpm_estado);
        }
        echo "Se cargaron ".($highestRow-$CantErrores-1)." de ".($highestRow-1);
    }

    public function ValidarCargarPrecios($cpm_id)
    {
        $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
        $rptaComparar = "";
        $validarCargarPrecios = true;
        $TablaBD="manto_preciosproveedor";
        $CampoId="precioprov_cargaid";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta = $InstanciaAjax->MaxId($TablaBD,$CampoId,$cpm_id);
        foreach ($Respuesta as $row) {
            $fecha_entrada = strtotime($row['precioprov_fechavigencia']);
            if($fecha_actual > $fecha_entrada){
                $rptaComparar = "MAYOR";
            }else{
                $rptaComparar = "MENOR IGUAL";
                $validarCargarPrecios = false;
                break;
            }
        }
        return $validarCargarPrecios;
    }

    public function CrearProveedores($prov_ruc,$prov_razonsocial,$prov_contacto,$prov_cta_detraccion_soles,$prov_cta_banco_soles,$prov_cta_banco_dolares,$prov_cta_interbanco_soles,$prov_cta_interbanco_dolares,$prov_condicion_pago,$prov_correo,$prov_telefono,$prov_estado, $prov_log)
	{
        $prov_responsablecreacion = $_SESSION['USUARIO_ID'];
        $prov_fechacreacion = date("Y-m-d H:i:s");

        $TablaBD = "glo_roles";
        $CampoBD = "roles_dni";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$prov_responsablecreacion);
        foreach ($Respuesta as $row) {
            $prov_usuario = $row['roles_nombrecorto'];
        }
        $prov_log = "<strong>".$prov_estado."</strong> ".$prov_fechacreacion." ".$prov_usuario." CREACIÓN <br>".$prov_log;	
        
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->CrearProveedores($prov_ruc,$prov_razonsocial,$prov_contacto,$prov_cta_detraccion_soles,$prov_cta_banco_soles,$prov_cta_banco_dolares,$prov_cta_interbanco_soles,$prov_cta_interbanco_dolares,$prov_condicion_pago,$prov_correo,$prov_telefono,$prov_estado, $prov_log);
	}  	
	
	public function EditarProveedores($prov_ruc,$prov_razonsocial,$prov_contacto,$prov_cta_detraccion_soles,$prov_cta_banco_soles,$prov_cta_banco_dolares,$prov_cta_interbanco_soles,$prov_cta_interbanco_dolares,$prov_condicion_pago,$prov_correo,$prov_telefono,$prov_estado, $prov_log)
	{
        $prov_responsablecreacion = $_SESSION['USUARIO_ID'];
        $prov_fechacreacion = date("Y-m-d H:i:s");

        $TablaBD = "glo_roles";
        $CampoBD = "roles_dni";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$prov_responsablecreacion);
        foreach ($Respuesta as $row) {
            $prov_usuario = $row['roles_nombrecorto'];
        }
        $prov_log = "<strong>".$prov_estado."</strong> ".$prov_fechacreacion." ".$prov_usuario." EDICIÓN <br>".$prov_log;	

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->EditarProveedores($prov_ruc,$prov_razonsocial,$prov_contacto,$prov_cta_detraccion_soles,$prov_cta_banco_soles,$prov_cta_banco_dolares,$prov_cta_interbanco_soles,$prov_cta_interbanco_dolares,$prov_condicion_pago,$prov_correo,$prov_telefono,$prov_estado, $prov_log);
	}  		

    public function SelectProveedores()
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectProveedores();

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['prov_razonsocial'].'">'.$row['prov_razonsocial'].'</option>';
        }
        echo $html;
    }

    public function EditarAsignarCodigos($precioprov_codproveedor, $precioprov_descripcion, $precioprov_razonsocial, $precioprov_materialid)
    {
        $precioprov_estado = 'RELACIONADO';
		$fecha_registro = date("Y-m-d H:i:s");

        $usuario_id = $_SESSION['USUARIO_ID'];
        $TablaBD = "glo_roles";
        $CampoBD = "roles_dni";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$usuario_id);
		
        foreach($Respuesta as $row){
			$usuario = $row['roles_nombrecorto'];
		}

        $TablaBD = "manto_proveedores";
        $CampoBD = "prov_razonsocial";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$precioprov_razonsocial);
		
        foreach($Respuesta as $row){
			$precioprov_ruc = $row['prov_ruc'];
		}

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarAsignarCodigos($precioprov_codproveedor, $precioprov_ruc);

        foreach($Respuesta as $row){
            $precioprov_log2 = "";
            $precioprov_log = "";
            $precioprov_id = $row['precioprov_id'];
            $precioprov_log2 = $row['precioprov_log'];
            $precioprov_log = "<strong>".$precioprov_estado."</strong> ".$fecha_registro." ".$usuario." EDICION: ASIGNAR CODIGO <br>".$precioprov_log2;

            MModel($this->Modulo,'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->EditarAsignarCodigos($precioprov_id, $precioprov_materialid, $precioprov_estado, $precioprov_log);
        }
    }

    public function CrearPreciosProveedor($precioprov_codproveedor, $precioprov_descripcion, $precioprov_marca, $precioprov_procedencia, $precioprov_unidadmedida, $precioprov_garantia, $precioprov_moneda, $precioprov_precio, $precioprov_preciosoles, $precioprov_fechavigencia, $precioprov_razonsocial, $precioprov_obslog, $precioprov_tipo)
    {
        $precioprov_estado              = "NO RELACIONADO";
        $precioprov_materialid          = "";
        $precioprov_documentacion       = "NO";
        $precioprov_cargaid             = "0"; // CREACION MANUAL
        $precioprov_fechacreacion       = date("Y-m-d H:i:s");
        $precioprov_responsablecreacion = $_SESSION['USUARIO_ID'];
        $usuario                        = $_SESSION['Usua_NombreCorto'];
        
        $TablaBD = "manto_proveedores";
        $CampoBD = "prov_razonsocial";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$precioprov_razonsocial);
		
        foreach($Respuesta as $row){
			$precioprov_ruc = $row['prov_ruc'];
		}

        $precioprov_log = "<strong>".$precioprov_estado."</strong> ".$precioprov_fechacreacion." ".$usuario." CREACION: ".$precioprov_obslog."<br>";

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->CrearPreciosProveedor($precioprov_codproveedor, $precioprov_descripcion, $precioprov_marca, $precioprov_procedencia, $precioprov_unidadmedida, $precioprov_garantia, $precioprov_moneda, $precioprov_precio, $precioprov_preciosoles, $precioprov_ruc, $precioprov_razonsocial, $precioprov_materialid, $precioprov_documentacion, $precioprov_fechavigencia, $precioprov_cargaid, $precioprov_responsablecreacion, $precioprov_fechacreacion, $precioprov_estado, $precioprov_log, $precioprov_tipo );        
    }

    public function GrabarImagen($matimag_codproveedor, $asignarcod_razonsocial, $matimag_tipoimagen, $matimag_imagen)
    {
        $matimag_fecha = date("Y-m-d H:i:s");
        $matimag_usuarioid = $_SESSION['USUARIO_ID'];
        $TablaBD = "glo_roles";
        $CampoBD = "roles_dni";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$matimag_usuarioid);
		
        foreach($Respuesta as $row){
			$usuario = $row['roles_nombrecorto'];
		}

        $matimag_log = "<strong>".$matimag_fecha."</strong> ".$usuario." CREACION <br>";

        $TablaBD = "manto_proveedores";
        $CampoBD = "prov_razonsocial";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$asignarcod_razonsocial);
		
        foreach($Respuesta as $row){
			$matimag_ruc = $row['prov_ruc'];
		}

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->GrabarImagen($matimag_codproveedor, $matimag_ruc, $matimag_tipoimagen, $matimag_imagen, $matimag_usuarioid, $matimag_fecha, $matimag_log);

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarAsignarCodigos($matimag_codproveedor, $matimag_ruc);
        $precioprov_documentacion = "SI";

        foreach($Respuesta as $row){
            $precioprov_log2 = "";
            $precioprov_log = "";
            $precioprov_id = $row['precioprov_id'];
            $precioprov_log2 = $row['precioprov_log'];
            $precioprov_log = "<strong>".$matimag_fecha."</strong> ".$usuario." EDICION: GRABAR PDF <br>".$precioprov_log2;

            MModel($this->Modulo,'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->EditarDocumentacion($precioprov_id, $precioprov_documentacion, $precioprov_log);
        }
    }

    public function EditarImagen($matimag_codproveedor, $asignarcod_razonsocial, $matimag_tipoimagen, $matimag_imagen)
    {
        $TablaBD = "manto_proveedores";
        $CampoBD = "prov_razonsocial";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$asignarcod_razonsocial);
		
        foreach($Respuesta as $row){
			$matimag_ruc = $row['prov_ruc'];
		}

        $matimag_fecha = date("Y-m-d H:i:s");
        $matimag_usuarioid = $_SESSION['USUARIO_ID'];

        $TablaBD = "glo_roles";
        $CampoBD = "roles_dni";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$matimag_usuarioid);
		
        foreach($Respuesta as $row){
			$usuario = $row['roles_nombrecorto'];
		}

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarLogImagen($matimag_codproveedor, $matimag_ruc, $matimag_tipoimagen);
		
        foreach($Respuesta as $row){
			$matimag_log1 = $row['matimag_log'];
		}

        $matimag_log = "<strong>".$matimag_fecha."</strong> ".$usuario." EDICION <br>".$matimag_log1;

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->EditarImagen($matimag_codproveedor, $matimag_ruc, $matimag_tipoimagen, $matimag_imagen, $matimag_usuarioid, $matimag_fecha, $matimag_log);
    }

    public function BuscarImagen($matimag_codproveedor, $asignarcod_razonsocial, $matimag_tipoimagen)
    {
        $TablaBD = "manto_proveedores";
        $CampoBD = "prov_razonsocial";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$asignarcod_razonsocial);
		
        foreach($Respuesta as $row){
			$matimag_ruc = $row['prov_ruc'];
		}

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarImagen($matimag_codproveedor, $matimag_ruc, $matimag_tipoimagen);
    }

    public function AnularPreciosProveedor($precioprov_id)
    {
        $precioprov_fecha = date("Y-m-d H:i:s");
        $precioprov_usuarioid = $_SESSION['USUARIO_ID'];
        $precioprov_estado = "ANULADO";

        $TablaBD = "manto_preciosproveedor";
        $CampoBD = "precioprov_id";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$precioprov_id);
		
        foreach($Respuesta as $row){
			$precioprov_log1 = $row['precioprov_log'];
		}

        $TablaBD = "glo_roles";
        $CampoBD = "roles_dni";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$precioprov_usuarioid);
		
        foreach($Respuesta as $row){
			$usuario = $row['roles_nombrecorto'];
		}

        $precioprov_log = "<strong>".$precioprov_fecha."</strong> ".$usuario." ANULACIÓN <br>".$precioprov_log1;

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->AnularPreciosProveedor($precioprov_id, $precioprov_estado, $precioprov_log);
    }

    public function AnularCargarPreciosProveedor($cpm_id)
    {
        $precioprov_fecha = date("Y-m-d H:i:s");
        $precioprov_usuarioid = $_SESSION['USUARIO_ID'];
        $precioprov_estado = "ANULADO";

        $TablaBD = "glo_roles";
        $CampoBD = "roles_dni";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$precioprov_usuarioid);
		
        foreach($Respuesta as $row){
			$usuario = $row['roles_nombrecorto'];
		}

        $TablaBD = "manto_preciosproveedor";
        $CampoBD = "precioprov_cargaid";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD, $CampoBD, $cpm_id);
		
        foreach($Respuesta as $row){
            $precioprov_id = $row['precioprov_id'];
			$precioprov_log1 = $row['precioprov_log'];
            $precioprov_log = "<strong>".$precioprov_fecha."</strong> ".$usuario." ANULACIÓN <br>".$precioprov_log1;

            MModel($this->Modulo,'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta2=$InstanciaAjax->AnularPreciosProveedor($precioprov_id, $precioprov_estado, $precioprov_log);
        }
    }

}