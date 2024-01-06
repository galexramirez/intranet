<?php
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class imprimir 
{
    var $Modulo = "orden_trabajo";

    public function imprimir_ot($ot_id)
    {
        require 'Services/Composer/vendor/autoload.php'; 

        /* Cargamos los datos de la orden de trabajo */
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD('manto_ots','ot_id',$ot_id);

        foreach ($Respuesta as $row) {
            $ot_id = $row['ot_id'];
            $ot_bus = $row['ot_bus'];
            $ot_nombre_proveedor = $row['ot_nombre_proveedor'];
            $ot_fecha_registro = $row['ot_fecha_registro'];
            $ot_cgm = $row['ot_cgm'];
            $ot_actividad = $row['ot_actividad'];
            $ot_kilometraje = $row['ot_kilometraje'];
            $ot_sistema = $row['ot_sistema'];
        }

        /* Conectamos con la impresora */
        $nombre_impresora = "EPSON TM-U220 Receipt";
        $connector = new WindowsPrintConnector($nombre_impresora);
        $printer = new Printer($connector);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        echo "imprimiendo";
        /* Initialize */
        $printer -> initialize();
        
        /* Se impreme el logotipo */
        $logo = EscposImage::load('Module/orden_trabajo/View/Img/LBI1.png', false);
        //$printer->bitImage($logo);

        /*
        Imprimimos un mensaje. Podemos usar
        el salto de línea o llamar muchas
        veces a $printer->text()
         */
        $printer->setTextSize(2, 2);
        $printer->text("ORDEN DE TRABAJO N° ".$ot_id."\n");
        $printer->setTextSize(1, 1);
        $printer->text("BUS: ".$ot_bus."\n");
        $printer->text("PROVEEDOR: ".$ot_nombre_proveedor."\n");
        $printer->text("Fecha: ".$ot_fecha_registro."\n");
        $printer->text("CGM: ".$ot_cgm."\n");
        $printer->text("ACTIVIDAD: ".$ot_actividad."\n");
        $printer->text("KM: ".$ot_kilometraje."\n");
        $printer->text("SISTEMA: ".$ot_sistema."\n");
        $printer->feed();
        $printer->setTextSize(2, 1);
        $printer->text("EJECUCION DE ACTIVIDAD (DESCRIBA DETALLADAMENTE)\n");
        
        /*
        Hacemos que el papel salga. Es como
        dejar muchos saltos de línea sin escribir nada
         */
        $printer->feed(15);
        
        $printer->setTextSize(1, 1);
        $printer->text("CODIGO PATRIMONIO MONTADO:\n");
        $printer->text("CODIGO PATRIMONIO DESMONTADO\n");
        
        /*
        Cortamos el papel. Si nuestra impresora
        no tiene soporte para ello, no generará
        ningún error
         */
        $printer->cut();

        /*
        Por medio de la impresora mandamos un pulso.
        Esto es útil cuando la tenemos conectada
        por ejemplo a un cajón
         */
        //$printer->pulse();
        
        /*
        Para imprimir realmente, tenemos que "cerrar"
        la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
         */
        echo $nombre_impresora."<br>";
        $printer->close();
    }
}