///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::MOVIMIENTO INVENTARIO v 1.0 FECHA: 25-01-2023 :::::::::::::::::::::::::::::///
//:::::::::::::: CREAR, EDITAR, ELIMINAR TABLA DE INVENTARIO :::::::::::::::::::::::::::///
///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::::::::///
var fecha_inicio_movimiento, fecha_termino_movimiento, tabla_movimiento;
fecha_inicio_movimiento = "";
fecha_termino_movimiento = "";
///:::::::::::::::::::FIN Declaracion de Variables :::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::.:::::: INICIO JS DOM PEDIDOS :::::::::::::::::::::::::::::///
$(document).ready(function(){
    if(fecha_inicio_movimiento=="" && fecha_termino_movimiento==""){
        fecha_inicio_movimiento = f_CalculoFecha("hoy","-1 Months");
        fecha_termino_movimiento = f_CalculoFecha("hoy","0");
        $('#fecha_inicio_movimiento').val(fecha_inicio_movimiento);
        $('#fecha_termino_movimiento').val(fecha_termino_movimiento);
    }

    div_show = f_MostrarDiv("form_seleccion_movimiento","btn_seleccion_movimiento","buscar","")
    $("#div_btn_seleccion_movimiento").html(div_show);

    // Si hay cambios en el Fecha se ocultan botones y datatable
    $("#fecha_inicio_movimiento").on('change', function () {
        div_show = f_MostrarDiv("form_seleccion_movimiento","btn_seleccion_movimiento","buscar","")
        $("#div_btn_seleccion_movimiento").html(div_show);
    
        $("#div_tabla_movimiento").empty();
    });
        
    $("#fecha_termino_movimiento").on('change', function () {
        div_show = f_MostrarDiv("form_seleccion_movimiento","btn_seleccion_movimiento","buscar","")
        $("#div_btn_seleccion_movimiento").html(div_show);
    
        $("#div_tabla_movimiento").empty();
    });

    ///::::::::::::::::::::::::: INICIO  BOTONES DE PEDIDOS :::::::::::::::::::::::::::::::///

    ///:::::::::::::::::::::::: BOTON BUSCAR MOVIMIENTO :::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_buscar_movimiento", function(){
        div_show = f_MostrarDiv("form_seleccion_movimiento","btn_seleccion_movimiento","generar","")
        $("#div_btn_seleccion_movimiento").html(div_show);
    
        fecha_inicio_movimiento = $("#fecha_inicio_movimiento").val();
        fecha_termino_movimiento = $("#fecha_termino_movimiento").val();

        div_tabla = f_CreacionTabla("tabla_movimiento","");
        $("#div_tabla_movimiento").html(div_tabla);
        columnastabla = f_ColumnasTabla("tabla_movimiento","");
        
        $("#tabla_movimiento").dataTable().fnDestroy();
        $('#tabla_movimiento').show();
        
        // Setup - add a text input to each footer cell
        $('#tabla_movimiento thead tr')
            .clone(true)
            .addClass('filters_movimiento')
            .appendTo('#tabla_movimiento thead');
        
        Accion='leer_inventario_registro';
        tabla_movimiento = $('#tabla_movimiento').DataTable({
            //Filtros por columnas
            orderCellsTop: true,
            fixedHeader: true,
            initComplete: function (){
                var api = this.api();
                // For each column
                api.columns().eq(0).each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters_movimiento th').eq($(api.column(colIdx).header()).index());
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
                    // On every keypress in this input
                    $('input',$('.filters_movimiento th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
                        e.stopPropagation();
                        // Get the search value
                        $(this).attr('title', $(this).val());
                        var regexr = '({search})'; //$(this).parents('th').find('select').val();
                        var cursorPosition = this.selectionStart;
                        // Search the column for that value
                        api.column(colIdx).search(
                            this.value != '' ? regexr.replace('{search}', '(((' + this.value + ')))'): '',
                            this.value != '',
                            this.value == ''
                        ).draw();
                        $(this).focus()[0].setSelectionRange(cursorPosition, cursorPosition);
                    });
                });
            },
            deferRender:    true,
            scrollY:        800,
            scrollCollapse: true,
            scroller:       true,
            scrollX:        true,
            fixedColumns:{
                left: 1
            },
            fixedHeader:{
                header : false
            },
            pageLength: 50,
            language: idiomaEspanol, 
            responsive: "true",
            dom: 'Blfrtip',
            buttons:[
                {
                    extend:     'excelHtml5',
                    text:       '<i class="fas fa-file-excel"></i> ',
                    titleAttr:  'Exportar a Excel',
                    className:  'btn btn-success'
                },
            ],
            "ajax":{            
                "url": "Ajax.php", 
                "method": 'POST',
                "data": {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,fecha_inicio_movimiento:fecha_inicio_movimiento,fecha_termino_movimiento:fecha_termino_movimiento}, //enviamos opcion 4 para que haga un SELECT
                "dataSrc":""
            },
            "columns": columnastabla,
            "order": [[1, 'desc']]
        });     

    });
    ///:::::::::::::::::::::::: TERMINO BOTON BUSCAR Inventario ::::::::::::::::::::::::::::///

    ///:::::::::::::::::::::::: BOTON GENERAR Inventario :::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_generar_movimiento", function(){
        alert("ingreso a generar movimiento");
    });
    ///:::::::::::::::::::::::: TERMINO BOTON GENERAR Inventario ::::::::::::::::::::::::::///

    ///::::::::::::::::::::::: FIN BOTONES PEDIDOS :::::::::::::::::::::::::::::::::::::///

});    
///:::::::::::::::::::::::::: FIN JS DOM PEDIDOS :::::::::::::::::::::::::::::::::::::::///


///:::::::::::::::::::::::::: INICIO FUNCIONES DE Inventario ::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::: FIN FUNCIONES DE Inventario ::::::::::::::::::::::::::::::///
