///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::::: TC_ALMACEN v 1.0 10-01-2023 :::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::: CREAR, EDITAR, ELIMINAR TIPO DE CATEGORIAS PARA ALMACEN ::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::: DECLARACION DE VARIABLES :::::::::::::::::::::::::::::::::::///
var tc_inventario_id,tcin_tipo,tcin_operacion,tcin_detalle;
var tabla_tc_inventario, opcion_tabla_tc_inventario, fila_tabla_tc_inventario;
///:::::::::::::::::::::::: TERMINO DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::///

///::::::::::::::::::: DOM JS TIPO CATEGORIA PARA ALMACEN :::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tabla = f_CreacionTabla("tabla_tc_inventario","");
    $("#div_tabla_tc_inventario").html(div_tabla);
    columnastabla = f_ColumnasTabla("tabla_tc_inventario","");

    // Setup - add a text input to each footer cell
    $('#tabla_tc_inventario thead tr')
        .clone(true)
        .addClass('filters_tc_inventario')
        .appendTo('#tabla_tc_inventario thead');

    Accion='leer_tc_inventario';
    tabla_tc_inventario = $('#tabla_tc_inventario').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filters_tc_inventario th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filters_tc_inventario th').eq($(api.column(colIdx).header()).index()) )
                .off('keyup change').on('keyup change', function (e) {e.stopPropagation();
                    // Get the search value
                    $(this).attr('title', $(this).val());
                    var regexr = '({search})'; //$(this).parents('th').find('select').val();
                    var cursorPosition = this.selectionStart;
                    // Search the column for that value
                    api.column(colIdx).search(this.value != '' ? regexr.replace('{search}', '(((' + this.value + ')))'): '',this.value != '',this.value == '').draw();
                    $(this).focus()[0].setSelectionRange(cursorPosition, cursorPosition);
                });
            });
        },
        
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
            "data":{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns": columnastabla
    });     

    ///::::::::: EVENTO DEL BOTON NUEVO ::::::::::::::///
    $("#btn_nuevo_tc_inventario").click(function(){
        opcion_tabla_tc_inventario = 1; // Alta 
        f_limpia_tabla_tc_inventario();
        $("#tc_inventario_id").prop('disabled', true);
        $("#form_tc_inventario").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Tabla Pedidos");
        $('#modal_crud_tc_inventario').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btn_editar_tc_inventario", function(){
        opcion_tabla_tc_inventario = 2;// Editar
        f_limpia_tabla_tc_inventario();
        $("#tc_inventario_id").prop('disabled', true);
        fila_tabla_tc_inventario = $(this).closest("tr");	        
        tc_inventario_id = fila_tabla_tc_inventario.find('td:eq(0)').text();
        tcin_operacion = fila_tabla_tc_inventario.find('td:eq(1)').text();
        tcin_tipo = fila_tabla_tc_inventario.find('td:eq(2)').text();
        tcin_detalle = fila_tabla_tc_inventario.find('td:eq(3)').text();

        $("#tc_inventario_id").val(tc_inventario_id);
        $("#tcin_tipo").val(tcin_tipo);
        $("#tcin_operacion").val(tcin_operacion);
        $("#tcin_detalle").val(tcin_detalle);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Tabla Pedidos");		
    
        $('#modal_crud_tc_inventario').modal('show');		   
    });


    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#form_tc_inventario').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

        tc_inventario_id = $.trim($('#tc_inventario_id').val());    
        tcin_tipo = $.trim($('#tcin_tipo').val());
        tcin_operacion = $.trim($('#tcin_operacion').val());    
        tcin_detalle = $.trim($('#tcin_detalle').val());
    
        validar_tabla_tc_inventario = f_validar_tabla_tc_inventario(tc_inventario_id,tcin_tipo,tcin_operacion,tcin_detalle);

        /// CREAR
        if(opcion_tabla_tc_inventario == 1) {
            if(validar_tabla_tc_inventario!="invalido") {   
                // Nombre
                Accion='crear_tc_inventario';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, tc_inventario_id:tc_inventario_id, tcin_tipo:tcin_tipo, tcin_operacion:tcin_operacion, tcin_detalle:tcin_detalle },    
                    success: function(data) {
                        tabla_tc_inventario.ajax.reload(null, false);
                    }
                });
                $('#modal_crud_tc_inventario').modal('hide');
            } 
        }

        /// EDITAR
        if(opcion_tabla_tc_inventario == 2) {
            if(validar_tabla_tc_inventario!="invalido") {   
                // Nombre
                Accion='editar_tc_inventario';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, tc_inventario_id:tc_inventario_id, tcin_tipo:tcin_tipo, tcin_operacion:tcin_operacion, tcin_detalle:tcin_detalle },    
                    success: function(data) {
                        tabla_tc_inventario.ajax.reload(null, false);
                    }
                });
                $('#modal_crud_tc_inventario').modal('hide');
            } 
        }
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btn_borrar_tc_inventario", function(){
        let fila_tc_inventario = $(this);           
        tc_inventario_id = $(this).closest('tr').find('td:eq(0)').text();     
        rpta_tabla_tc_inventario = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminará el registro "+tc_inventario_id+"!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Eliminado!',
                    'El registro se ha sido eliminado.',
                    'success'
                )
                rpta_tabla_tc_inventario = 1;
                // Nombre
                Accion='borrar_tc_inventario';
                if (rpta_tabla_tc_inventario == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,tc_inventario_id:tc_inventario_id },   
                        success: function(data) {
                            tabla_tc_inventario.row(fila_tc_inventario.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });

});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_validar_tabla_tc_inventario(tc_inventario_id,tcin_tipo,tcin_operacion,tcin_detalle){
    f_limpia_tabla_tc_inventario();

    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    var rpta_validar_tc_inventario="";    

    if(tcin_tipo==""){
        $("#tcin_tipo").addClass("color-error");
        rpta_validar_tc_inventario="invalido";
    }

    if(tcin_operacion==""){
        $("#tcin_operacion").addClass("color-error");
        rpta_validar_tc_inventario="invalido";
    }

    if(tcin_detalle==""){
        $("#tcin_detalle").addClass("color-error");
        rpta_validar_tc_inventario="invalido";
    }

    return rpta_validar_tc_inventario; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_limpia_tabla_tc_inventario(){
    $("#tcin_tipo").removeClass("color-error");
    $("#tcin_operacion").removeClass("color-error");
    $("#tcin_detale").removeClass("color-error");
}