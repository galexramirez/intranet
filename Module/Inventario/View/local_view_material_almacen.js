///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: MATERIALES POR ALMACEN v 1.0 FECHA: 25-01-2023 :::::::::::::::::::::::::::::::::::///
//::: CREAR, EDITAR, ELIMINAR TABLA DE MATERIALES POR ALMACEN ::::::::::::::::::::::::::///
///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::::::::///
var malm_select_almacen, alm_fecha_creacion, alm_descripcion, alm_ubicacion, alm_dimensiones, alm_nombre_responsable, alm_estado, alm_log;
var tabla_material_almacen, opcion_material_almacen, fila_almacen, validar_almacen;
///:::::::::::::::::::FIN Declaracion de Variables :::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::.:::::: INICIO JS DOM ALMACEN :::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_boton = f_BotonesFormulario("form_seleccion_material_almacen","btn_seleccion_material_almacen")
    $("#div_btn_seleccion_material_almacen").html(div_boton);
    f_combos_material_almacen();

    ///:::::::: Si hay cambios en tipo de movimiento :::::::::::::::::::::::::::::::::::::///
    $("#malm_select_almacen").on('change', function () {
        div_tabla = "";
        $("#div_tabla_material_almacen").html(div_tabla);        
    });

    ///::::::::::::::::::::::::: INICIO  BOTONES DE ALMACEN :::::::::::::::::::::::::::::::///

    ///::: BOTON BUSCAR MATERIALES POR ALMACEN ::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_buscar_material_almacen", function(){
        malm_select_almacen = $("#malm_select_almacen").val();
        div_tabla = f_CreacionTabla("tabla_material_almacen","");
        $("#div_tabla_material_almacen").html(div_tabla);
        columnastabla = f_ColumnasTabla("tabla_material_almacen","");
        
        $("#tabla_material_almacen").dataTable().fnDestroy();
        $('#tabla_material_almacen').show();
        
        // Setup - add a text input to each footer cell
        $('#tabla_material_almacen thead tr')
            .clone(true)
            .addClass('filters_material_almacen')
            .appendTo('#tabla_material_almacen thead');
        
        Accion='leer_material_almacen';
        tabla_material_almacen = $('#tabla_material_almacen').DataTable({
            //Filtros por columnas
            orderCellsTop: true,
            fixedHeader: true,
            initComplete: function (){
                var api = this.api();
                // For each column
                api.columns().eq(0).each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters_material_almacen th').eq($(api.column(colIdx).header()).index());
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
                    // On every keypress in this input
                    $('input',$('.filters_material_almacen th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
                    className:  'btn btn-success',
                    title:      'Materiales por '+malm_select_almacen
                },
            ],
            "ajax":{            
                "url": "Ajax.php", 
                "method": 'POST', //usamos el metodo POST
                "data": {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, malm_descripcion_almacen:malm_select_almacen},
                "dataSrc":""
            },
            "columns": columnastabla,
            "order": [[1, 'asc']]
        });     
        });
    ///:::::::::::::::::::::::::: TERMINO BOTON NUEVO ALMACEN :::::::::::::::::::::::::::::///

    ///:::::::::::::::::::::::::: BOTON NUEVO ALMACEN :::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_nuevo_material_almacen", function(){
        opcion_material_almacen = 1; // Alta 
        f_limpia_almacen();
        f_combos_almacen();
        $("#form_crud_material_almacen").trigger("reset");
        
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

    ///:: BOTON CREAR MATERIAL POR ALMACEN ::::::::::::::::::::::::::::::::::::::::::::::::///
    $('#form_crud_material_almacen').submit(function(e){                         
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
            if(opcion_material_almacen == 1) {
                if(validar_almacen!="invalido") {   
                    $("#btn_guardar_almacen").prop("disabled",true);
                    Accion='crear_almacen';
                    $.ajax({
                        url: "Ajax.php",
                        type: "POST",
                        datatype:"json",    
                        data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, almacen_id:almacen_id, alm_fecha_creacion:alm_fecha_creacion, alm_descripcion:alm_descripcion,  alm_ubicacion:alm_ubicacion, alm_dimensiones:alm_dimensiones, alm_nombre_responsable:alm_nombre_responsable, alm_estado:alm_estado },    
                        success: function(data) {
                            tabla_material_almacen.ajax.reload(null, false);
                        }
                    });
                    $("#btn_guardar_almacen").prop("disabled",false);
                    $('#modal_crud_almacen').modal('hide');
                } 
            }
            /// EDITAR
            if(opcion_material_almacen == 2) {
                if(validar_almacen!="invalido") {   
                    $("#btn_guardar_almacen").prop("disabled",true);
                    Accion='editar_almacen';
                    $.ajax({
                        url: "Ajax.php",
                        type: "POST",
                        datatype:"json",    
                        data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, almacen_id:almacen_id, alm_fecha_creacion:alm_fecha_creacion, alm_descripcion:alm_descripcion,  alm_ubicacion:alm_ubicacion, alm_dimensiones:alm_dimensiones, alm_nombre_responsable:alm_nombre_responsable, alm_estado:alm_estado },    
                        success: function(data) {
                            tabla_material_almacen.ajax.reload(null, false);
                        }
                    });
                    $("#btn_guardar_almacen").prop("disabled",false);
                    $('#modal_crud_almacen').modal('hide');
                } 
            }
        }
    });
    ///:::::::::::::::::::::: BOTON CREA Y EDITA ALMACEN ::::::::::::::::::::::::::::::::::///


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

///:::::::::::::::::: CARGA LOS COMBOS DE INVENTARIO :::::::::::::::::::::::::::::::::::///
function f_combos_material_almacen(){
    let rpta_select_material_almacen;
    
    Accion='select_almacen';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
      success: function(data){
        rpta_select_material_almacen = data;
      }
    });
    $("#malm_select_almacen").html(rpta_select_material_almacen);
  
  }
  ///:::::::::::::::::: FIN CARGA LOS COMBOS DE ALMACEN ::::::::::::::::::::::::::::::::::///
  
///::::::::::::::::::::::::::::: FIN FUNCIONES DE ALMACEN :::::::::::::::::::::::::::::::::///
