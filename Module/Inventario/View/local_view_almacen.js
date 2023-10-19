///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::: ALMACEN v 1.0 FECHA: 25-01-2023 :::::::::::::::::::::::::::::::///
//:::::::::::::: CREAR, EDITAR, ELIMINAR TABLA DE ALMACEN ::::::::::::::::::::::::::::::///
///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::::::::///
var almacen_id, alm_fecha_creacion, alm_descripcion, alm_ubicacion, alm_dimensiones, alm_nombre_responsable, alm_estado, alm_log;
var tabla_almacen, opcion_almacen, fila_almacen, validar_almacen;
///:::::::::::::::::::FIN Declaracion de Variables :::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::.:::::: INICIO JS DOM ALMACEN :::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_show = f_MostrarDiv("form_seleccion_almacen","btn_seleccion_almacen","nuevo","")
    $("#div_btn_seleccion_almacen").html(div_show);

    div_tabla = f_CreacionTabla("tabla_almacen","");
    $("#div_tabla_almacen").html(div_tabla);
    columnastabla = f_ColumnasTabla("tabla_almacen","");
    
    $("#tabla_almacen").dataTable().fnDestroy();
    $('#tabla_almacen').show();
    
    // Setup - add a text input to each footer cell
    $('#tabla_almacen thead tr')
        .clone(true)
        .addClass('filters_almacen')
        .appendTo('#tabla_almacen thead');
    
    Accion='leer_almacen';
    tabla_almacen = $('#tabla_almacen').DataTable({
        //Filtros por columnas
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function (){
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filters_almacen th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filters_almacen th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
        //Para mostrar 50 registros popr página 
        pageLength: 50,
        //Para cambiar el lenguaje a español
        language: idiomaEspanol, 
        //Para usar los botones
        responsive: "true",
        dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
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
            "method": 'POST', //usamos el metodo POST
            "data": {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},
            "dataSrc":""
        },
        "columns": columnastabla,
        "order": [[1, 'desc']]
    });     

    ///::::::::::::::::::::::::: INICIO  BOTONES DE ALMACEN :::::::::::::::::::::::::::::::///

    ///:::::::::::::::::::::::::: BOTON NUEVO ALMACEN :::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_nuevo_almacen", function(){
        opcion_almacen = 1; // Alta 
        //div_show = f_DivFormulario("modal_crud_almacen","modal_crud_almacen");
        //$("#modal_crud_almacen").html(div_show);
        f_limpia_almacen();
        f_combos_almacen();
        $("#form_crud_almacen").trigger("reset");
        
        almacen_id = "";
        alm_fecha_creacion = f_CalculoFecha("hoy","0");
        alm_descripcion = "";
        alm_ubicacion = "";
        alm_dimensiones = "";
        alm_nombre_responsable = f_nombre_responsable();
        alm_estado = "";
        alm_log = "";

        $("#almacen_id").val(almacen_id);
        $("#alm_fecha_creacion").val(alm_fecha_creacion);
        $("#alm_descripcion").val(alm_descripcion);
        $("#alm_ubicacion").val(alm_ubicacion);
        $("#alm_dimensiones").val(alm_dimensiones);
        $("#alm_nombre_responsable").val(alm_nombre_responsable);
        $("#alm_estado").val(alm_estado);
        $("#div_alm_log").html(alm_log);

        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Alamcen");
        $('#modal_crud_almacen').modal('show');
    });
    ///:::::::::::::::::::::::::: TERMINO BOTON NUEVO ALMACEN :::::::::::::::::::::::::::::///

    ///::::::::::::::::::::::::::::::::::: BOTON EDITAR ALMACEN :::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_editar_almacen", function(){
        let a_data;
        opcion_almacen = 2;// Editar
        f_limpia_almacen();
        f_combos_almacen();
        fila_almacen = $(this).closest("tr");	        
        almacen_id = fila_almacen.find('td:eq(1)').text();
        alm_fecha_creacion = fila_almacen.find('td:eq(2)').text();
        alm_descripcion = fila_almacen.find('td:eq(3)').text();
        alm_ubicacion = fila_almacen.find('td:eq(4)').text();
        alm_dimensiones = fila_almacen.find('td:eq(5)').text();
        alm_nombre_responsable = fila_almacen.find('td:eq(6)').text();
        alm_estado = fila_almacen.find('td:eq(10)').text();
        
        a_data = f_BuscarDataBD("manto_almacen","almacen_id",almacen_id);
        $.each(a_data, function(idx, obj){ 
            alm_log = obj.alm_log;
        });

        $("#almacen_id").val(almacen_id);
        $("#alm_fecha_creacion").val(alm_fecha_creacion);
        $("#alm_descripcion").val(alm_descripcion);
        $("#alm_ubicacion").val(alm_ubicacion);
        $("#alm_dimensiones").val(alm_dimensiones);
        $("#alm_nombre_responsable").val(alm_nombre_responsable);
        $("#alm_estado").val(alm_estado);
        $("#div_alm_log").html(alm_log);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Tabla Almacen");		
    
        $('#modal_crud_almacen').modal('show');		   
    });
    ///:::::::::::::::::::::::::::::::: FIN BOTON EDITAR ALMACEN ::::::::::::::::::::::::::///       

    ///:::::::::::::::::::::: BOTON CREA Y EDITA ALMACEN ::::::::::::::::::::::::::::::::::///
    $('#form_crud_almacen').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        almacen_id = $.trim($('#almacen_id').val());    
        alm_fecha_creacion = $.trim($('#alm_fecha_creacion').val());
        alm_descripcion = $.trim($('#alm_descripcion').val());
        alm_ubicacion = $.trim($('#alm_ubicacion').val());
        alm_dimensiones = $.trim($('#alm_dimensiones').val());
        alm_nombre_responsable = $.trim($('#alm_nombre_responsable').val());
        alm_estado = $.trim($('#alm_estado').val());
        validar_almacen = f_validar_almacen(alm_fecha_creacion, alm_descripcion, alm_ubicacion, alm_dimensiones, alm_nombre_responsable, alm_estado);

        if(validar_almacen=="invalido"){
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: '*Falta Completar Información!!!',
                showConfirmButton: false,
                timer: 1500
            })
        }else{
            /// CREAR
            if(opcion_almacen == 1) {
                if(validar_almacen!="invalido") {   
                    $("#btn_guardar_almacen").prop("disabled",true);
                    Accion='crear_almacen';
                    $.ajax({
                        url: "Ajax.php",
                        type: "POST",
                        datatype:"json",    
                        data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, almacen_id:almacen_id, alm_fecha_creacion:alm_fecha_creacion, alm_descripcion:alm_descripcion,  alm_ubicacion:alm_ubicacion, alm_dimensiones:alm_dimensiones, alm_nombre_responsable:alm_nombre_responsable, alm_estado:alm_estado },    
                        success: function(data) {
                            tabla_almacen.ajax.reload(null, false);
                        }
                    });
                    $("#btn_guardar_almacen").prop("disabled",false);
                    $('#modal_crud_almacen').modal('hide');
                } 
            }
            /// EDITAR
            if(opcion_almacen == 2) {
                if(validar_almacen!="invalido") {   
                    $("#btn_guardar_almacen").prop("disabled",true);
                    Accion='editar_almacen';
                    $.ajax({
                        url: "Ajax.php",
                        type: "POST",
                        datatype:"json",    
                        data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, almacen_id:almacen_id, alm_fecha_creacion:alm_fecha_creacion, alm_descripcion:alm_descripcion,  alm_ubicacion:alm_ubicacion, alm_dimensiones:alm_dimensiones, alm_nombre_responsable:alm_nombre_responsable, alm_estado:alm_estado },    
                        success: function(data) {
                            tabla_almacen.ajax.reload(null, false);
                        }
                    });
                    $("#btn_guardar_almacen").prop("disabled",false);
                    $('#modal_crud_almacen').modal('hide');
                } 
            }
        }
    });
    ///:::::::::::::::::::::: BOTON CREA Y EDITA ALMACEN ::::::::::::::::::::::::::::::::::///

    ///::::::::::::::::::::::::::::::::::: BOTON VER ALMACEN :::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_ver_almacen", function(){
        let a_data;
        fila_almacen = $(this).closest("tr");	        
        almacen_id = fila_almacen.find('td:eq(1)').text();
        alm_fecha_creacion = fila_almacen.find('td:eq(2)').text();
        alm_descripcion = fila_almacen.find('td:eq(3)').text();
        alm_ubicacion = fila_almacen.find('td:eq(4)').text();
        alm_dimensiones = fila_almacen.find('td:eq(5)').text();
        alm_nombre_responsable = fila_almacen.find('td:eq(6)').text();
        alm_estado = fila_almacen.find('td:eq(10)').text();
        
        a_data = f_BuscarDataBD("manto_almacen","almacen_id",almacen_id);
        $.each(a_data, function(idx, obj){ 
            alm_log = obj.alm_log;
        });

        $("#t_almacen_id").val(almacen_id);
        $("#t_alm_fecha_creacion").val(alm_fecha_creacion);
        $("#t_alm_descripcion").val(alm_descripcion);
        $("#t_alm_ubicacion").val(alm_ubicacion);
        $("#t_alm_dimensiones").val(alm_dimensiones);
        $("#t_alm_nombre_responsable").val(alm_nombre_responsable);
        $("#t_alm_estado").val(alm_estado);
        $("#div_t_alm_log").html(alm_log);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Ver Tabla Almacen");		
    
        $('#modal_crud_ver_almacen').modal('show');		   
    });
    ///:::::::::::::::::::::::::::::::: FIN BOTON EDITAR ALMACEN ::::::::::::::::::::::::::///       

    ///::::::::::::::::::::::: FIN BOTONES ALMACEN ::::::::::::::::::::::::::::::::::::::::///

});    
///:::::::::::::::::::::::::: FIN JS DOM ALMACEN ::::::::::::::::::::::::::::::::::::::::::///


///:::::::::::::::::::::::::: INICIO FUNCIONES DE ALMACEN :::::::::::::::::::::::::::::::::///

///::::::: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO ::::::::::::::::::::::::///
function f_validar_almacen(p_alm_fecha_creacion, p_alm_descripcion, p_alm_ubicacion, p_alm_dimensiones, p_alm_nombre_responsable, p_alm_estado){
    f_limpia_almacen();
    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    let rpta_almacen="";    

    if(p_alm_fecha_creacion == ""){
        $("#alm_fecha_creacion").addClass("color-error");
        rpta_almacen="invalido";
    }

    if(p_alm_descripcion == ""){
        $("#alm_descripcion").addClass("color-error");
        rpta_almacen="invalido";
    }

    if(p_alm_ubicacion == ""){
        $("#alm_ubicacion").addClass("color-error");
        rpta_almacen="invalido";
    }

    if(p_alm_dimensiones == ""){
        $("#alm_dimensiones").addClass("color-error");
        rpta_almacen="invalido";
    }

    if(p_alm_nombre_responsable == ""){
        $("#alm_nombre_responsable").addClass("color-error");
        rpta_almacen="invalido";
    }

    if(p_alm_estado==""){
        $("#alm_estado").addClass("color-error");
        rpta_almacen="invalido";
    }

    return rpta_almacen; 
}
///::::::: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO ::::::::::::::::::::///

///::::::::::::::::::::: LIMPIA LOS CAMPOS DEL FORMULARIO CAMBIA COLOR ::::::::::::::::::::/// 
function f_limpia_almacen(){
    $("#alm_fecha_creacion").removeClass("color-error");
    $("#alm_descripcion").removeClass("color-error");
    $("#alm_ubicacion").removeClass("color-error");
    $("#alm_dimensiones").removeClass("color-error");
    $("#alm_estado").removeClass("color-error");
}
///:::::::::::::::::: FIN LIMPIA LOS CAMPOS DEL FORMULARIO CAMBIA COLOR ::::::::::::::::::/// 

///:::::::::::::::::: CARGA LOS COMBOS DE ALMACEN ::::::::::::::::::::::::::::::::::::::::///
function f_combos_almacen(){
    let select_html="";
    select_html = f_TipoTabla("ALMACEN","ESTADO");
    $("#alm_estado").html(select_html);    
}
///:::::::::::::::::: FIN CARGA LOS COMBOS DE ALMACEN ::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::: FIN FUNCIONES DE ALMACEN :::::::::::::::::::::::::::::::::///
