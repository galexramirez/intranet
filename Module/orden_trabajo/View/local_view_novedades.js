///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: LISTADO NOVEDADES MANTENIMIENTO v 2.0 FECHA: 2023-11-28 :::::::::::::::::::::::::::::///
///:: BUSCAR NOVEDADES DE MANTENIMIENTO :::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_novedades, fecha_inicio_novedades, fecha_termino_novedades, fila_novedades, novedad_id, tipo_operacion, bus_tipo, tipo_novedad;
fecha_inicio_novedades   = "";
fecha_termino_novedades  = "";

///:: JS DOM NOVEDADES MANTENIMIENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    if(fecha_inicio_novedades=="" && fecha_termino_novedades==""){
        fecha_inicio_novedades = f_CalculoFecha("hoy","0");
        fecha_termino_novedades = f_CalculoFecha("hoy","0");
        $('#fecha_inicio_novedades').val(fecha_inicio_novedades);
        $('#fecha_termino_novedades').val(fecha_termino_novedades);
    }

    div_show = f_MostrarDiv("form_seleccion_novedades", "btn_seleccion_novedades", "inicio", "inicio");
    $("#div_btn_seleccion_novedades").html(div_show);

    ///:: Si hay cambios en el Fecha se ocultan botones y datatable :::::::::::::::::::::::///
    $("#fecha_inicio_novedades, #fecha_termino_novedades").on('change', function () {
        $("#div_tabla_novedades").empty();
        div_show = f_MostrarDiv("form_seleccion_novedades", "btn_seleccion_novedades", "inicio", "inicio");
        $("#div_btn_seleccion_novedades").html(div_show);    
    });

    ///:: Selecciona las filas a editar :::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", "tr",".tabla_novedad_regular tbody", function(){		
        let ot_id = "inicio", componente = "inicio";
        novedad_id="";
        tipo_operacion="";
        bus_tipo = "";
        tipo_novedad = "";
        if(tabla_novedades.rows('.selected').data().length===1){
            fila_novedades = $(this).closest("tr");	        
            novedad_id     = fila_novedades.find('td:eq(0)').text();
            tipo_novedad   = fila_novedades.find('td:eq(3)').text();
            tipo_operacion = fila_novedades.find('td:eq(7)').text();
            componente     = fila_novedades.find('td:eq(9)').text();
            ot_id          = fila_novedades.find('td:eq(13)').text();
        }
        if(tipo_operacion=="TRONCAL"){
            bus_tipo = "ARTICULADO";
        }
        if(tipo_operacion=="ALIMENTADOR"){
            bus_tipo = "ALIMENTADOR";
        }
        div_show = f_MostrarDiv("form_seleccion_novedades", "btn_seleccion_novedades", ot_id, componente);
        $("#div_btn_seleccion_novedades").html(div_show);
    });

    ///:: BOTONES DE NOVEDADES MANTENIMIENTO :::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON BUSCAR NOVEDADES MANTENIMIENTO :::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_buscar_novedades", function(){
        fecha_inicio_novedades = $("#fecha_inicio_novedades").val();
        fecha_termino_novedades = $("#fecha_termino_novedades").val();

        div_tabla = f_CreacionTabla("tabla_novedades","");
        $("#div_tabla_novedades").html(div_tabla);
        columnastabla = f_ColumnasTabla("tabla_novedades","");
    
        $("#tabla_novedades").dataTable().fnDestroy();
        $('#tabla_novedades').show();

        // Setup - add a text input to each footer cell
        $('#tabla_novedades thead tr')
            .clone(true)
            .addClass('filters_novedades')
            .appendTo('#tabla_novedades thead');

        Accion = 'leer_novedades';
        tabla_novedades = $('#tabla_novedades').DataTable({
            //Filtros por columnas
            processing  : true,
            orderCellsTop: true,
            fixedHeader: true,
            initComplete: function (){
                var api = this.api();
                // For each column
                api.columns().eq(0).each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters_novedades th').eq($(api.column(colIdx).header()).index());
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
                    // On every keypress in this input
                    $('input',$('.filters_novedades th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
            deferRender     : true,
            scrollY         : 800,
            scrollCollapse  : true,
            scroller        : true,
            scrollX         : true,
            select          : {style: 'os'},
            fixedColumns:{
                left: 1
            },
            fixedHeader:{
                header : false
            },
            pageLength  : 50,
            
            language    : idiomaEspanol, 
            responsive  : "true",
            dom         : 'Blfrtip', 
            buttons:[
                {
                    extend      : 'excelHtml5',
                    text        : '<i class="fas fa-file-excel"></i> ',
                    titleAttr   : 'Exportar a Excel',
                    className   : 'btn btn-success',
                    title       : 'NOVEDADES',
                },
            ],
            "ajax":{            
                "url": "Ajax.php", 
                "method": 'POST', //usamos el metodo POST
                "data": {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,fecha_inicio:fecha_inicio_novedades,fecha_termino:fecha_termino_novedades},
                "dataSrc":""
            },
            "columns": columnastabla,
            "columnDefs": [
                {
                    //"targets"   : [8],
                    //"orderable" : false
                }
            ],
            "order": [[1, 'desc']]
        });     
    });  
    ///:: FIN BOTON BUSCAR NOVEDADES MANTENIMIENTO ::::::::::::::::::::::::::::::::::::::::///

    ///:: TERMINO DE BOTONES NOVEDADES MANTENIMIENTO ::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO DE JS DOM NOVEDADES MANTENIMIENTO :::::::::::::::::::::::::::::::::::::::::::///



///:: FUNCIONES DE NOVEDADES MANTENIMEINTO ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE NOVEDADES MANTENIMEINTO :::::::::::::::::::::::::::::::::::::::///