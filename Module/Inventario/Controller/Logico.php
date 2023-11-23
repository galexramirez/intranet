<?php
session_start();
class Logico
{
	var $Modulo = "Inventario";

	function Contenido($NombreDeModuloVista) {		
		MView($this->Modulo,'LocalView',compact('NombreDeModuloVista') );
	}


    public function SelectTipos($tc_operacion, $tc_tipo)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectTipos($tc_operacion, $tc_tipo);

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
                    if($calculo=="hora"){
                        $rptaFecha = date("Y-m-d H:i:s");
                    }else{
                        $f = strtotime($calculo);
                        $rptaFecha = date("Y-m-d",$f);
                    }
                }
            break;
            
            //default: ;
        }
        echo $rptaFecha;
    }

    public function DiferenciaFecha($inicio,$final)
    {
        $rpta_Diferencia = "NO";
        $firstDate  = new DateTime($inicio);
        $secondDate = new DateTime($final);
        $intvl = $firstDate->diff($secondDate);
        
        if($intvl->days < "366"){
            $rpta_Diferencia = "SI";
        }
        echo $rpta_Diferencia;
    }

    public function AutoCompletar($NombreTabla,$NombreCampo)
    {
        $rpta_autocompletar = [];

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->AutoCompletar($NombreTabla,$NombreCampo);
        foreach ($Respuesta as $row) {
            if($NombreCampo=="material_id"){
                $rpta_autocompletar[] = ["value" => $row['material_id'], "label" => "<strong>".$row['material_id']."</strong> ".$row['material_descripcion']];
            }else{
                $rpta_autocompletar[] = ["value" => $row['material_descripcion'], "label" => " <strong>".$row['material_id']."</strong>".$row['material_descripcion']];
            }
        }
		echo json_encode($rpta_autocompletar);
    }

    public function BuscarMaterialid($material_id)
    {
        $a_data = [];
        $material_descripcion = "";
        $TablaBD = "manto_materiales";
        $CampoBD = "material_id";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$material_id);
        foreach ($Respuesta as $row) {
            $material_descripcion = $row['material_descripcion'];
            $material_macrosistema = $row['material_macrosistema'];
            $material_sistema = $row['material_sistema'];
            $material_tarjeta = $row['material_tarjeta'];
            $material_condicion = $row['material_condicion'];
            $material_flota = $row['material_flota'];
            $material_patrimonial = $row['material_patrimonial'];
            $material_categoria = $row['material_categoria'];
        }

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->precio_vigente_actualizado($material_id);
        foreach ($Respuesta as $row) {
            $a_data[] = ["material_descripcion" => $material_descripcion, "material_macrosistema" => $material_macrosistema, "material_sistema" => $material_sistema, "material_tarjeta" => $material_tarjeta, "material_condicion" => $material_condicion, "material_flota" => $material_flota, "material_patrimonial" => $material_patrimonial, "material_categoria" => $material_categoria, "unidad_medida" => $row['precioprov_unidadmedida'], "moneda" => $row['precioprov_moneda'], "precio"=> $row['precioprov_precio'], "precio_soles" => $row['precioprov_preciosoles']];
        }

        echo json_encode($a_data);
    }

    public function BuscarMaterialDescripcion($material_descripcion)
    {
        $a_data = [];
        $TablaBD = "manto_materiales";
        $CampoBD = "material_descripcion";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$material_descripcion);
        foreach ($Respuesta as $row) {
            $a_data[] = ["material_id" => $row['material_id']];
        }

        echo json_encode($a_data);
    }

    function DocumentRoot()
    {
        $miCarpeta = '';
        $miHost = $_SERVER['HTTP_HOST'];
        $miReferer = $_SERVER['HTTP_REFERER'];
        $miCarpeta = substr($miReferer,0,strpos($miReferer,$miHost)).$miHost.'/';
        echo $miCarpeta;
    }

    function usuario_nombre()
    {
        $usuario_nombre = '';
        $usuario_nombre = $_SESSION['Usua_NombreCorto'];
        echo $usuario_nombre;
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

    public function select_almacen()
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->select_almacen();

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Detalle'].'">'.$row['Detalle'].'</option>';
        }
        echo $html;
    }

    public function editar_almacen($almacen_id, $alm_fecha_creacion, $alm_descripcion, $alm_ubicacion, $alm_dimensiones, $alm_nombre_responsable, $alm_estado)
    {
        $alm_fecha = date("d-m-Y H:i:s");
		$alm_responsable = $_SESSION['USUARIO_ID'];
        $TablaBD = "manto_almacen";
        $CampoBD = "almacen_id";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$almacen_id);
        foreach ($Respuesta as $row) {
            $alm_log1 = $row['alm_log'];
        }
		$alm_log = "<strong>".$alm_estado."</strong> ".$alm_fecha." ".$alm_nombre_responsable." EDICIÓN <br> ".$alm_log1;

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->editar_almacen($almacen_id, $alm_fecha_creacion, $alm_descripcion, $alm_ubicacion, $alm_dimensiones, $alm_responsable, $alm_estado, $alm_log);
       
    }

    public function importar_materiales_entrada($tipo_documento, $nro_documento)
    {
        $a_data = [];
        switch($tipo_documento)
        {
            case "ORDEN DE COMPRA":
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->importar_materiales_entrada($nro_documento);
        

            break;

            case "VALE":

            break;

            case "SALIDA DE ALMACEN":

            break;
        }
        print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function crear_entrada_inventario($entrada_id, $ent_fecha_creacion, $ent_almacen_descripcion, $ent_tipo_movimiento, $ent_tipo_documento, $ent_nro_documento, $ent_nombre_entrega, $ent_centro_costo, $obs_ent_log, $array_data)
    {
        $TablaBD = "manto_almacen";
        $CampoBD = "alm_descripcion";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$ent_almacen_descripcion);
        foreach ($Respuesta as $row) {
            $invr_almacen_id = $row['almacen_id'];
        }

        $invr_nombre_usuario         = $_SESSION['Usua_NombreCorto'];
        $invr_fecha_creacion    = $ent_fecha_creacion;
        $invr_movimiento        = "ENTRADA";
        $invr_tipo_movimiento   = $ent_tipo_movimiento;
        $invr_tipo_documento    = $ent_tipo_documento;
        $invr_nro_documento     = $ent_nro_documento;
        $invr_nombre_entrega    = $ent_nombre_entrega;
        $invr_centro_costo      = $ent_centro_costo;
        $invr_usuario_id        = $_SESSION['USUARIO_ID'];
        $invr_campo_1           = "";
        $invr_campo_2           = "";
        $invr_campo_3           = "";
        $invr_estado            = "REGISTRADO";
        $invr_log               = "<strong>".$invr_estado."</strong> ".$invr_fecha_creacion." ".$invr_nombre_usuario." CREACIÓN <br> ";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->crear_entrada_inventario( $invr_fecha_creacion, $invr_almacen_id, $invr_movimiento, $invr_tipo_movimiento, $invr_tipo_documento, $invr_nro_documento, $invr_nombre_entrega, $invr_centro_costo, $invr_usuario_id, $invr_campo_1, $invr_campo_2, $invr_campo_3, $invr_estado, $invr_log );

        $TablaBD = "manto_inventario_registro";
        $CampoId = "";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->MaxId($TablaBD,$CampoId);
        foreach ($Respuesta as $row) {
            $inventario_registro_id = $row['Max_Id'];
        }

        foreach ($array_data as $row){
            $invm_inventario_registro_id    = $inventario_registro_id;
            $invm_fecha_creacion            = $invr_fecha_creacion;    
            $invm_almacen_id                = $invr_almacen_id;
            $invm_movimiento                = $invr_movimiento;
            $invm_tipo_movimiento           = $invr_tipo_movimiento;
            $invm_tipo_documento            = $invr_tipo_documento;
            $invm_nro_documento             = $invr_nro_documento;
            $invm_centro_costo              = $invr_centro_costo;
            $invm_material_id               = $row['entm_material_id'];           
            $invm_material_descripcion      = $row['entm_descripcion'];
            $invm_material_patrimonial      = $row['entm_patrimonial'];
            $invn_unidad_medida             = $row['entm_unidad_medida'];
            $invm_cantidad                  = $row['entm_cantidad'];
            $invm_moneda                    = $row['entm_moneda'];
            $invm_precio                    = $row['entm_precio'];
            $invm_precio_soles              = $row['entm_precio_soles'];
            $invm_campo_1                   = $invr_campo_1;
            $invm_campo_2                   = $invr_campo_2;
            $invm_campo_3                   = $invr_campo_3;
            $invm_estado                    = $invr_estado;
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->crear_movimiento_entrada_inventario( $invm_inventario_registro_id, $invm_fecha_creacion, $invm_almacen_id, $invm_movimiento, $invm_tipo_movimiento, $invm_tipo_documento, $invm_nro_documento, $invm_centro_costo, $invm_material_id, $invm_material_descripcion, $invm_material_patrimonial, $invn_unidad_medida, $invm_cantidad, $invm_moneda, $invm_precio, $invm_precio_soles, $invm_campo_1, $invm_campo_2, $invm_campo_3, $invm_estado );
        }
    }

    public function editar_entrada_inventario($entrada_id, $ent_fecha_creacion, $ent_almacen_descripcion, $ent_tipo_movimiento, $ent_tipo_documento, $ent_nro_documento, $ent_nombre_entrega, $ent_centro_costo, $obs_ent_log, $array_materiales_entrada)
    {

    }

}