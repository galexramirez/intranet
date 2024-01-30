///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: LISTADO NOVEDADES MANTENIMIENTO v 2.0 FECHA: 2023-11-28 :::::::::::::::::::::::::::::///
///:: BUSCAR NOVEDADES DE MANTENIMIENTO :::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_novedades, fecha_inicio_novedades, fecha_termino_novedades, fila_novedades, novedad_id, tipo_operacion, bus_tipo, tipo_novedad, origen_novedad, filas_seleccionadas, nro_bus, accion_ot, not_ot_id;
let select_novedades;
fecha_inicio_novedades   = "";
fecha_termino_novedades  = "";

///:: JS DOM NOVEDADES MANTENIMIENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    select_novedades = f_select_combo("manto_proveedores","NO", "prov_razonsocial", "", "`prov_estado`='ACTIVO'", "`prov_razonsocial` ASC");
    $("#nove_razon_social").html(select_novedades);

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
        let ot_estado = "";
        let componente = "";
        
        fila_novedades = $(this).closest("tr");
        filas_seleccionadas = [];
        novedad_id="";
        tipo_operacion="";
        bus_tipo = "";
        tipo_novedad = "";
        origen_novedad = "";
        nro_bus = "";
        not_ot_id = "";
        accion_ot = "";

        if(tabla_novedades.rows('.selected').data().length===1){
            novedad_id     = fila_novedades.find('td:eq(0)').text();
            origen_novedad = fila_novedades.find('td:eq(3)').text();
            tipo_novedad   = fila_novedades.find('td:eq(4)').text();
            tipo_operacion = fila_novedades.find('td:eq(5)').text();
            nro_bus        = fila_novedades.find('td:eq(6)').text();
            componente     = fila_novedades.find('td:eq(7)').text();
            accion_ot      = fila_novedades.find('td:eq(11)').text();
            not_ot_id      = fila_novedades.find('td:eq(12)').text();
            ot_estado      = fila_novedades.find('td:eq(13)').text();
        }
        filas_seleccionadas = tabla_novedades.rows('.selected').data().toArray();
        if(tabla_novedades.rows('.selected').data().length===0){
            componente = "inicio";
            not_ot_id = "inicio";
        }
        if(tabla_novedades.rows('.selected').data().length>1){
            componente = "seleccion";
            not_ot_id = "";
        }
        if(tipo_operacion=="TRONCAL"){
            bus_tipo = "ARTICULADO";
        }
        if(tipo_operacion=="ALIMENTADOR"){
            bus_tipo = "ALIMENTADOR";
        }

        div_show = f_MostrarDiv("form_seleccion_novedades", "btn_seleccion_novedades", componente, not_ot_id);
        $("#div_btn_seleccion_novedades").html(div_show);
    });

    ///:: BOTONES DE NOVEDADES MANTENIMIENTO :::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON BUSCAR NOVEDADES MANTENIMIENTO :::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_buscar_novedades", function(){
        fecha_inicio_novedades = $("#fecha_inicio_novedades").val();
        fecha_termino_novedades = $("#fecha_termino_novedades").val();
        nove_razon_social = $("#nove_razon_social").val();
        nove_prov_ruc = f_buscar_dato("manto_proveedores","prov_ruc","`prov_razonsocial`='"+nove_razon_social+"'");

        div_tabla = f_CreacionTabla("tabla_novedades","");
        $("#div_tabla_novedades").html(div_tabla);
        columnas_tabla = f_ColumnasTabla("tabla_novedades","");
    
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
            
            language    : idioma_espanol, 
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
                "url"       : "Ajax.php", 
                "method"    : 'POST', 
                "data"      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, prov_ruc:nove_prov_ruc, fecha_inicio:fecha_inicio_novedades, fecha_termino:fecha_termino_novedades},
                "dataSrc"   : ""
            },
            "columns"       : columnas_tabla,
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

    ///:: BOTON NOVEDAD NO GENERA OT ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_no_genera_ot", function(){
        Swal.fire({
            title               : '¿Está seguro?',
            text                : "NO se genera OT !!!",
            icon                : 'warning',
            showCancelButton    : true,
            confirmButtonColor  : '#3085d6',
            cancelButtonColor   : '#d33',
            confirmButtonText   : 'No, generar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Accion = 'no_genera_ot';
                $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",    
                    data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, not_origen_novedad:origen_novedad, not_tipo_novedad:tipo_novedad, not_novedad_id:novedad_id,not_operacion:tipo_operacion, not_bus:nro_bus },   
                    success: function() {
                        tabla_novedades.ajax.reload(null, false);
                        Swal.fire(
                            'Novedad!',
                            'El registro ha sido desestimado.',
                            'success'
                        )
                        div_show = f_MostrarDiv("form_seleccion_novedades", "btn_seleccion_novedades", "inicio", "inicio");
                        $("#div_btn_seleccion_novedades").html(div_show);    
                    }
                });
            }
        });
    });
    ///:: FIN BOTON NOVEDAD NO GENERA OT ::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON NOVEDAD NO GENERA OT ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_desvincular_ot", function(){
        let validar_desvincular_ot = "";
        validar_desvincular_ot = validar_novedades_desvincular_ot();
        if(validar_desvincular_ot===""){
            Swal.fire({
                title               : '¿Está seguro?',
                text                : "Se desvinculara OT !!!",
                icon                : 'warning',
                showCancelButton    : true,
                confirmButtonColor  : '#3085d6',
                cancelButtonColor   : '#d33',
                confirmButtonText   : 'Si, desvincular!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Accion = 'desvincular_orden_trabajo';
                    let a_data = [];
                    a_data = JSON.stringify(filas_seleccionadas);
                    $.ajax({
                        url         : "Ajax.php",
                        type        : "POST",
                        datatype    : "json",    
                        data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, a_data:a_data },   
                        success: function(data) {
                            tabla_novedades.ajax.reload(null, false);
                            if(data==="se desvinculo"){
                                Swal.fire(
                                    'Novedad!',
                                    'El registro ha sido desvinculado.',
                                    'success'
                                )
                            }
                            div_show = f_MostrarDiv("form_seleccion_novedades", "btn_seleccion_novedades", "inicio", "inicio");
                            $("#div_btn_seleccion_novedades").html(div_show);    
                        }
                    });
                }
            });
        }else{
            Swal.fire({
                position            : 'center',
                icon                : 'error',
                title               : validar_desvincular_ot+' !!!',
                showConfirmButton   : false,
                timer               : 1500
            })
        }
        
    });
    ///:: FIN BOTON NOVEDAD NO GENERA OT ::::::::::::::::::::::::::::::::::::::::::::::::::///
    
    ///:: EVENTO DEL BOTON IMPRIMIR NOVEDAD ORDEN DE TRABAJO ::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_novedad_imprimir_ot", function(){
        let nro_ot = not_ot_id.substring(2);
        nro_ot = parseInt(nro_ot);
        if(not_ot_id!==""){
            f_imprimir_ot(nro_ot,"div_imprimir_novedad_ot");
        }else{
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: "No existe N° OT : "+not_ot_id+" !!!",
                showConfirmButton: false,
                timer: 1500
            })
        }
    });
    ///:: FIN DE EVENTO DEL BOTON IMPRIMIR NOVEDAD ORDEN DE TRABAJO :::::::::::::::::::::::///

    ///:: TERMINO DE BOTONES NOVEDADES MANTENIMIENTO ::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO DE JS DOM NOVEDADES MANTENIMIENTO :::::::::::::::::::::::::::::::::::::::::::///



///:: FUNCIONES DE NOVEDADES MANTENIMEINTO ::::::::::::::::::::::::::::::::::::::::::::::::///
function validar_novedades_desvincular_ot(){
    let rpta_validar_desvincular_ot = "";
    let a_data = [];
    a_data = JSON.stringify(filas_seleccionadas);
    Accion = 'validar_novedades_desvincular_ot';
    $.ajax({
        url     : "Ajax.php",
        type    : "POST",
        datatype: "json",
        async   : false,
        data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, a_data:a_data},    
        success : function(data){
            rpta_validar_desvincular_ot = data;
        }
    });
    return rpta_validar_desvincular_ot;
}

///:: TERMINO FUNCIONES DE NOVEDADES MANTENIMEINTO ::::::::::::::::::::::::::::::::::::::::///