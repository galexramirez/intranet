$(document).ready(function(){
    // Setup - add a text input to each footer cell
    $('#tablaTipoTablaComportamiento thead tr')
        .clone(true)
        .addClass('filtersTipoTablaComportamiento')
        .appendTo('#tablaTipoTablaComportamiento thead');

    Accion='LeerTipoTablaComportamiento';
    tablaTipoTablaComportamiento = $('#tablaTipoTablaComportamiento').DataTable({
        //Filtros por columnas
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filtersTipoTablaComportamiento th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filtersTipoTablaComportamiento th').eq($(api.column(colIdx).header()).index()) )
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
        "columns":[
            {"data": "TtablaComportamiento_Id"},
            {"data": "TtablaComportamiento_Tipo"},
            {"data": "TtablaComportamiento_Operacion"},
            {"data": "TtablaComportamiento_Detalle"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarTipoTablaComportamiento'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btnBorrarTipoTablaComportamiento'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>"}
        ]
    });     

    ///::::::::: EVENTO DEL BOTON NUEVO ::::::::::::::///
    $("#btnNuevoTipoTablaComportamiento").click(function(){
        opcionTablaComportamiento = 1; // Alta 
        LimpiaMsTablaComportamiento();
        $("#TtablaComportamiento_Id").prop('disabled', true);
        $("#formTipoTablaComportamiento").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Tabla Comportamiento");
        $('#modalCRUDTipoTablaComportamiento').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarTipoTablaComportamiento", function(){
        opcionTablaComportamiento = 2;// Editar
        LimpiaMsTablaComportamiento();
        $("#TtablaComportamiento_Id").prop('disabled', true);
        fila = $(this).closest("tr");	        
        TtablaComportamiento_Id = fila.find('td:eq(0)').text();
        TtablaComportamiento_Tipo = fila.find('td:eq(1)').text();
        TtablaComportamiento_Operacion = fila.find('td:eq(2)').text();
        TtablaComportamiento_Detalle = fila.find('td:eq(3)').text();

        $("#TtablaComportamiento_Id").val(TtablaComportamiento_Id);
        $("#TtablaComportamiento_Tipo").val(TtablaComportamiento_Tipo);
        $("#TtablaComportamiento_Operacion").val(TtablaComportamiento_Operacion);
        $("#TtablaComportamiento_Detalle").val(TtablaComportamiento_Detalle);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Tabla Comportamiento");		
    
        $('#modalCRUDTipoTablaComportamiento').modal('show');		   
    });


    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formTipoTablaComportamiento').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

        TtablaComportamiento_Id = $.trim($('#TtablaComportamiento_Id').val());    
        TtablaComportamiento_Tipo = $.trim($('#TtablaComportamiento_Tipo').val());
        TtablaComportamiento_Operacion = $.trim($('#TtablaComportamiento_Operacion').val());    
        TtablaComportamiento_Detalle = $.trim($('#TtablaComportamiento_Detalle').val());
    
        validacionTablaComportamiento=validarTablaComportamiento(TtablaComportamiento_Id,TtablaComportamiento_Tipo,TtablaComportamiento_Operacion,TtablaComportamiento_Detalle);

        /// CREAR
        if(opcionTablaComportamiento == 1) {
            if(validacionTablaComportamiento!="invalido") {   
                Accion='CrearTipoTablaComportamiento';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TtablaComportamiento_Id:TtablaComportamiento_Id,TtablaComportamiento_Tipo:TtablaComportamiento_Tipo,TtablaComportamiento_Operacion:TtablaComportamiento_Operacion,TtablaComportamiento_Detalle:TtablaComportamiento_Detalle },    
                    success: function(data) {
                        tablaTipoTablaComportamiento.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDTipoTablaComportamiento').modal('hide');
            } 
        }

        /// EDITAR
        if(opcionTablaComportamiento == 2) {
            if(validacionTablaComportamiento!="invalido") {   
                Accion='EditarTipoTablaComportamiento';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TtablaComportamiento_Id:TtablaComportamiento_Id,TtablaComportamiento_Tipo:TtablaComportamiento_Tipo,TtablaComportamiento_Operacion:TtablaComportamiento_Operacion,TtablaComportamiento_Detalle:TtablaComportamiento_Detalle },    
                    success: function(data) {
                        tablaTipoTablaComportamiento.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDTipoTablaComportamiento').modal('hide');
            } 
        }
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btnBorrarTipoTablaComportamiento", function(){
        fila = $(this);           
        TtablaComportamiento_Id = $(this).closest('tr').find('td:eq(0)').text();     
        respuestaTablaComportamiento = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminará el registro "+TtablaComportamiento_Id+"!",
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
                respuestaTablaComportamiento = 1;
                Accion='BorrarTipoTablaComportamiento';
                if (respuestaTablaComportamiento == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TtablaComportamiento_Id:TtablaComportamiento_Id },   
                        success: function(data) {
                            tablaTipoTablaComportamiento.row(fila.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });

});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function validarTablaComportamiento(TtablaComportamiento_Id,TtablaComportamiento_Tipo,TtablaComportamiento_Operacion,TtablaComportamiento_Detalle){
    LimpiaMsTablaComportamiento();

    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    var respuestaComportamiento="";    

    return respuestaComportamiento; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function LimpiaMsTablaComportamiento(){
    $("#MsTtablaComportamiento_Id").css("display", "none" );
    $("#MsTtablaComportamiento_Tipo").css("display", "none" );
    $("#MsTtablaComportamiento_Operacion").css("display", "none" );
    $("#MsTtablaComportamiento_Detalle").css("display", "none" );
}