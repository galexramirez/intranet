///:::::::::::::::::: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::///
var ttablaotcorrectivas_id,ttablaotcorrectivas_tipo,ttablaotcorrectivas_operacion,ttablaotcorrectivas_detalle;
var tablaTipoTablaOTCorrectivas, opcionTablaOTCorrectivas, filaTablaOTCorrectivas;

///::::::::::::: DOM Tipo Tabla OTPtreventivas ::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tabla = f_CreacionTabla("tablaTipoTablaOTCorrectivas","");
    $("#div_tablaTipoTablaOTCorrectivas").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaTipoTablaOTCorrectivas","");

    // Setup - add a text input to each footer cell
    $('#tablaTipoTablaOTCorrectivas thead tr')
        .clone(true)
        .addClass('filtersTipoTablaOTCorrectivas')
        .appendTo('#tablaTipoTablaOTCorrectivas thead');

    Accion='LeerTipoTablaOTCorrectivas';
    tablaTipoTablaOTCorrectivas = $('#tablaTipoTablaOTCorrectivas').DataTable({
        //Filtros por columnas
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filtersTipoTablaOTCorrectivas th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filtersTipoTablaOTCorrectivas th').eq($(api.column(colIdx).header()).index()) )
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
            {
                extend:     'pdfHtml5',
                text:       '<i class="fas fa-file-pdf"></i> ',
                titleAttr:  'Exportar a PDF',
                className:  'btn btn-danger'
            },
            {
                extend:     'print',
                text:       '<i class="fa fa-print"></i> ',
                titleAttr:  'Imprimir',
                className:  'btn btn-info'
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
    $("#btnNuevoTipoTablaOTCorrectivas").click(function(){
        opcionTablaOTCorrectivas = 1; // Alta 
        LimpiaMsTablaOTCorrectivas();
        $("#ttablaotcorrectivas_id").prop('disabled', true);
        $("#formTipoTablaOTCorrectivas").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Tabla OTs Correctivas");
        $('#modalCRUDTipoTablaOTCorrectivas').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarTipoTablaOTCorrectivas", function(){
        opcionTablaOTCorrectivas = 2;// Editar
        LimpiaMsTablaOTCorrectivas();
        $("#ttablaotcorrectivas_id").prop('disabled', true);
        filaTablaOTCorrectivas = $(this).closest("tr");	        
        ttablaotcorrectivas_id = filaTablaOTCorrectivas.find('td:eq(0)').text();
        ttablaotcorrectivas_operacion = filaTablaOTCorrectivas.find('td:eq(1)').text();
        ttablaotcorrectivas_tipo = filaTablaOTCorrectivas.find('td:eq(2)').text();
        ttablaotcorrectivas_detalle = filaTablaOTCorrectivas.find('td:eq(3)').text();

        $("#ttablaotcorrectivas_id").val(ttablaotcorrectivas_id);
        $("#ttablaotcorrectivas_tipo").val(ttablaotcorrectivas_tipo);
        $("#ttablaotcorrectivas_operacion").val(ttablaotcorrectivas_operacion);
        $("#ttablaotcorrectivas_detalle").val(ttablaotcorrectivas_detalle);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Tabla OTs Correctivas");		
    
        $('#modalCRUDTipoTablaOTCorrectivas').modal('show');		   
    });


    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formTipoTablaOTCorrectivas').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

        ttablaotcorrectivas_id = $.trim($('#ttablaotcorrectivas_id').val());    
        ttablaotcorrectivas_tipo = $.trim($('#ttablaotcorrectivas_tipo').val());
        ttablaotcorrectivas_operacion = $.trim($('#ttablaotcorrectivas_operacion').val());    
        ttablaotcorrectivas_detalle = $.trim($('#ttablaotcorrectivas_detalle').val());
    
        validacionTablaOTCorrectivas=validarTablaOTCorrectivas(ttablaotcorrectivas_id,ttablaotcorrectivas_tipo,ttablaotcorrectivas_operacion,ttablaotcorrectivas_detalle);

        /// CREAR
        if(opcionTablaOTCorrectivas == 1) {
            if(validacionTablaOTCorrectivas!="invalido") {   
                // Nombre
                Accion='CrearTipoTablaOTCorrectivas';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablaotcorrectivas_id:ttablaotcorrectivas_id,ttablaotcorrectivas_tipo:ttablaotcorrectivas_tipo,ttablaotcorrectivas_operacion:ttablaotcorrectivas_operacion,ttablaotcorrectivas_detalle:ttablaotcorrectivas_detalle },    
                    success: function(data) {
                        tablaTipoTablaOTCorrectivas.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDTipoTablaOTCorrectivas').modal('hide');
            } 
        }

        /// EDITAR
        if(opcionTablaOTCorrectivas == 2) {
            if(validacionTablaOTCorrectivas!="invalido") {   
                // Nombre
                Accion='EditarTipoTablaOTCorrectivas';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablaotcorrectivas_id:ttablaotcorrectivas_id,ttablaotcorrectivas_tipo:ttablaotcorrectivas_tipo,ttablaotcorrectivas_operacion:ttablaotcorrectivas_operacion,ttablaotcorrectivas_detalle:ttablaotcorrectivas_detalle },    
                    success: function(data) {
                        tablaTipoTablaOTCorrectivas.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDTipoTablaOTCorrectivas').modal('hide');
            } 
        }
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btnBorrarTipoTablaOTCorrectivas", function(){
        fila = $(this);           
        ttablaotcorrectivas_id = $(this).closest('tr').find('td:eq(0)').text();     
        respuestaTablaOTCorrectivas = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminará el registro "+ttablaotcorrectivas_id+"!",
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
                respuestaTablaOTCorrectivas = 1;
                // Nombre
                Accion='BorrarTipoTablaOTCorrectivas';
                if (respuestaTablaOTCorrectivas == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablaotcorrectivas_id:ttablaotcorrectivas_id },   
                        success: function(data) {
                            tablaTipoTablaOTCorrectivas.row(fila.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });

});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function validarTablaOTCorrectivas(ttablaotcorrectivas_id,ttablaotcorrectivas_tipo,ttablaotcorrectivas_operacion,ttablaotcorrectivas_detalle){
    LimpiaMsTablaOTCorrectivas();

    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    var respuestaOTCorrectivas="";    

    return respuestaOTCorrectivas; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function LimpiaMsTablaOTCorrectivas(){
    $("#Msttablaotcorrectivas_id").css("display", "none" );
    $("#Msttablaotcorrectivas_tipo").css("display", "none" );
    $("#Msttablaotcorrectivas_operacion").css("display", "none" );
    $("#Msttablaotcorrectivas_detalle").css("display", "none" );
}