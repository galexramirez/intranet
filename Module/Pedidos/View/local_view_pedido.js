///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: PEDIDOS v 2.0 FECHA: 18-02-2023 :::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR TABLA DE PEDIDOS ::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_pedido, FechaInicioPedidos, FechaTerminoPedidos, fila_pedido;
var pedido_id;
FechaInicioPedidos  = "";
FechaTerminoPedidos = "";
const fecha_hoy = new Date();
///:: TERMINO DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO JS DOM PEDIDOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_boton = f_BotonesFormulario("form_seleccion_pedido","btn_seleccion_pedido");
    $("#div_btn_seleccion_pedido").html(div_boton);
    
    if(FechaInicioPedidos=="" && FechaTerminoPedidos==""){
        FechaInicioPedidos  = f_CalculoFecha("hoy","-1 Months");
        FechaTerminoPedidos = f_CalculoFecha("hoy","0");
        $('#FechaInicioPedidos').val(FechaInicioPedidos);
        $('#FechaTerminoPedidos').val(FechaTerminoPedidos);
    }

    //:: SI SE REALIZAN CAMBIOS EN FECHAS SE OCULTA DATATABLE :::::::::::::::::::::::::::::///
    $("#FechaInicioPedidos").on('change', function () {
        $("#div_tabla_pedido").empty();
    });
        
    $("#FechaTerminoPedidos").on('change', function () {
        $("#div_tabla_pedido").empty();
    });

    ///:: INICIO BOTONES DE PEDIDOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON BUSCAR PEDIDOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_buscar_pedido", function(){
        FechaInicioPedidos = $("#FechaInicioPedidos").val();
        FechaTerminoPedidos = $("#FechaTerminoPedidos").val();

        div_tabla = f_CreacionTabla("tabla_pedido","");
        $("#div_tabla_pedido").html(div_tabla);
        columnastabla = f_ColumnasTabla("tabla_pedido","");
        
        $("#tabla_pedido").dataTable().fnDestroy();
        $('#tabla_pedido').show();
        
        // Setup - add a text input to each footer cell
        $('#tabla_pedido thead tr')
            .clone(true)
            .addClass('filters_pedido')
            .appendTo('#tabla_pedido thead');
        
        Accion='leer_pedido';
        tabla_pedido = $('#tabla_pedido').DataTable({
            //Filtros por columnas
            orderCellsTop: true,
            fixedHeader: true,
            initComplete: function (){
                var api = this.api();
                // For each column
                api.columns().eq(0).each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters_pedido th').eq($(api.column(colIdx).header()).index());
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
                    // On every keypress in this input
                    $('input',$('.filters_pedido th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
            // Para mostrar la barra scroll horizontal y vertical
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
            dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
            buttons:[
                {
                    extend:     'excelHtml5',
                    text:       '<i class="fas fa-file-excel"></i> ',
                    titleAttr:  'Exportar a Excel',
                    className:  'btn btn-success',
                    title:      'PEDIDOS'
                },
            ],
            "ajax":{            
                "url": "Ajax.php", 
                "method": 'POST',
                "data": {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,FechaInicioPedidos:FechaInicioPedidos,FechaTerminoPedidos:FechaTerminoPedidos},
                "dataSrc":""
            },
            "columns": columnastabla,
            "columnDefs": [ 
                {
                    "targets"  : [0, 14, 15, 16],
                    "orderable": false
                },
                {
                    "targets"  : [14],
                    "render"   : function(data, type, row, meta) {
                        if(data===1){
                            return "<div class='text-center'><div class='btn-group'><button title='Cotización' class='btn btn-warning btn-sm btn_cotizacion'><i class='bi bi-inbox'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-inbox' viewBox='0 0 16 16'> <path d='M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4H4.98zm9.954 5H10.45a2.5 2.5 0 0 1-4.9 0H1.066l.32 2.562a.5.5 0 0 0 .497.438h12.234a.5.5 0 0 0 .496-.438L14.933 9zM3.809 3.563A1.5 1.5 0 0 1 4.981 3h6.038a1.5 1.5 0 0 1 1.172.563l3.7 4.625a.5.5 0 0 1 .105.374l-.39 3.124A1.5 1.5 0 0 1 14.117 13H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .106-.374l3.7-4.625z'/></svg></i></button></div></div>";
                        }else{
                            return "";
                        }
                    }
                },
                {
                    "targets"  : [15],
                    "render"   : function(data, type, row, meta) {
                        if(data===1){
                            return "<div class='text-center'><div class='btn-group'><button title='O.Compra' class='btn btn-success btn-sm btn_orden_compra'><i class='bi bi-bagl'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-bag' viewBox='0 0 16 16'><path d='M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z'/></svg></i></button></div></div>";
                        }else{
                            return "";
                        }
                    }
                }
            ],
            "order": [[1, 'desc']]
        });     
    });
    ///:: FIN BOTON BUSCAR PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DEL BOTON EDITAR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_editar_pedido", function(){		
        fila_pedido = $(this).closest('tr'); 
        pedido_id = fila_pedido.find('td:eq(1)').text();
        $("#pedido_id").val(pedido_id);
        $('#nav-profile-tab').tab('show');
        document.getElementById("btn_cargar_pedido").click();
        $("#pedido_id").focus().select();
    });
    ///:: FIN EVENTO DEL BOTON EDITAR :::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DE BOTON VER PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_ver_pedido", function(){		
        fila_pedido = $(this).closest('tr'); 
        pedido_id = fila_pedido.find('td:eq(1)').text();
        $("#form_modal_ver_pedido").trigger("reset");

        Accion = 'cargar_pedido';
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",
          async: false,    
          data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,pedido_id:pedido_id},    
          success: function(data){
            data = $.parseJSON(data);
            $.each(data, function(idx, obj){ 
                ipedido_id                  = obj.pedido_id;
                ipedi_fechacreacion         = obj.pedi_fechacreacion;
                ipedi_fecharequerimiento    = obj.pedi_fecharequerimiento;
                ipedi_prioridad             = obj.pedi_prioridad;
                ipedi_bus                   = obj.pedi_bus;
                ipedi_centrocosto           = obj.pedi_centrocosto;
                ipedi_tipo                  = obj.pedi_tipo;
                ipedi_responsable           = obj.pedi_responsable;
                ipedi_estado                = obj.pedi_estado;
                ipedi_log                   = obj.pedi_log;
              });
          }
        });
        $('#ipedido_id').val(pedido_id);
        $('#ipedi_fechacreacion').val(ipedi_fechacreacion);
        $('#ipedi_fecharequerimiento').val(ipedi_fecharequerimiento);
        $('#ipedi_prioridad').val(ipedi_prioridad);
        $('#ipedi_bus').val(ipedi_bus);
        $("#ipedi_centrocosto").val(ipedi_centrocosto);
        $("#ipedi_tipo").val(ipedi_tipo);
        $('#ipedi_responsable').val(ipedi_responsable);
        $('#ipedi_estado').val(ipedi_estado);
        $("#div_ipedi_log").html(ipedi_log);

        div_tabla = f_CreacionTabla("tabla_ver_material_pedido","");
        $("#div_tabla_ver_material_pedido").html(div_tabla);
        columnastabla = f_ColumnasTabla("tabla_ver_material_pedido","");
        
        $("#tabla_ver_material_pedido").dataTable().fnDestroy();
        $('#tabla_ver_material_pedido').show();
        Accion='cargar_material_pedido';
        tabla_ver_material_pedido = $('#tabla_ver_material_pedido').DataTable({
          language      : idiomaEspanol,
          searching     : false,
          info          : false,
          lengthChange  : false,
          pageLength    : 5,
          responsive    : "true",
          "ajax":{            
            "url"       : "Ajax.php", 
            "method"    : 'POST',
            "data"      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, pedido_id:pedido_id },
            "dataSrc"   : ""
          },
          "columns"     : columnastabla,
        });     
    
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Información de Pedidos");
        $('#modal_crud_ver_pedido').modal('show');	    
    });
    ///:: FIN EVENTO DE BOTON VER PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DE BOTON VER COTIZACION ::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_cotizacion", function(){		
        fila_pedido = $(this).closest('tr'); 
        pedido_id   = fila_pedido.find('td:eq(1)').text();
        $("#mc_pedidoid").val(pedido_id);
        $('#nav-cotizacion-tab').tab('show')
        document.getElementById("btn_buscar_ver_cotizacion").click();
        $("#mc_pedidoid").focus().select();
    }); 
    ///:: FIN EVENTO DE BOTON VER COTIZACION ::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DE BOTON VER ORDEN COMPRA ::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_orden_compra", function(){
        fila_pedido = $(this).closest('tr'); 
        pedido_id   = fila_pedido.find('td:eq(1)').text();
        $("#orco_pedido_id").val(pedido_id);
        $('#nav-orden_compra-tab').tab('show')
        document.getElementById("btn_buscar_orden_compra").click();
        $("#orco_pedido_id").focus().select();
    }); 
    ///:: FIN EVENTO DE BOTON VER ORDEN COMPRA ::::::::::::::::::::::::::::::::::::::::::::///

    ///:: TERMINO BOTONES PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

});    
///:: TERMINO JS DOM PEDIDOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///


///:: INICIO FUNCIONES DE PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///