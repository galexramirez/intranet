$(document).ready(function(){
    // Setup - add a text input to each footer cell
    $('#tablaTipoTablaAccidentes thead tr')
        .clone(true)
        .addClass('filtersTipoTablaAccidentes')
        .appendTo('#tablaTipoTablaAccidentes thead');

    Accion='LeerTipoTablaAccidentes';
    tablaTipoTablaAccidentes = $('#tablaTipoTablaAccidentes').DataTable({
        //Filtros por columnas
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filtersTipoTablaAccidentes th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filtersTipoTablaAccidentes th').eq($(api.column(colIdx).header()).index()) )
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
            {"data": "TtablaAccidentes_Id"},
            {"data": "TtablaAccidentes_Tipo"},
            {"data": "TtablaAccidentes_Operacion"},
            {"data": "TtablaAccidentes_Detalle"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarTipoTablaAccidentes'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btnBorrarTipoTablaAccidentes'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>"}
        ]
    });     

    ///::::::::: EVENTO DEL BOTON NUEVO ::::::::::::::///
    $("#btnNuevoTipoTablaAccidentes").click(function(){
        opcionTablaAccidentes = 1; // Alta 
        LimpiaMsTablaAccidentes();
        $("#TtablaAccidentes_Id").prop('disabled', true);
        $("#formTipoTablaAccidentes").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Tabla Accidentes");
        $('#modalCRUDTipoTablaAccidentes').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarTipoTablaAccidentes", function(){
        opcionTablaAccidentes = 2;// Editar
        LimpiaMsTablaAccidentes();
        $("#TtablaAccidentes_Id").prop('disabled', true);
        fila = $(this).closest("tr");	        
        TtablaAccidentes_Id = fila.find('td:eq(0)').text();
        TtablaAccidentes_Tipo = fila.find('td:eq(1)').text();
        TtablaAccidentes_Operacion = fila.find('td:eq(2)').text();
        TtablaAccidentes_Detalle = fila.find('td:eq(3)').text();

        $("#TtablaAccidentes_Id").val(TtablaAccidentes_Id);
        $("#TtablaAccidentes_Tipo").val(TtablaAccidentes_Tipo);
        $("#TtablaAccidentes_Operacion").val(TtablaAccidentes_Operacion);
        $("#TtablaAccidentes_Detalle").val(TtablaAccidentes_Detalle);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Tabla Accidentes");		
    
        $('#modalCRUDTipoTablaAccidentes').modal('show');		   
    });


    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formTipoTablaAccidentes').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

        TtablaAccidentes_Id = $.trim($('#TtablaAccidentes_Id').val());    
        TtablaAccidentes_Tipo = $.trim($('#TtablaAccidentes_Tipo').val());
        TtablaAccidentes_Operacion = $.trim($('#TtablaAccidentes_Operacion').val());    
        TtablaAccidentes_Detalle = $.trim($('#TtablaAccidentes_Detalle').val());
    
        validacionTablaAccidentes=validarTablaAccidentes(TtablaAccidentes_Id,TtablaAccidentes_Tipo,TtablaAccidentes_Operacion,TtablaAccidentes_Detalle);
  
        /// CREAR
        if(opcionTablaAccidentes == 1) {
            if(validacionTablaAccidentes!="invalido") {   
                Accion='CrearTipoTablaAccidentes';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TtablaAccidentes_Id:TtablaAccidentes_Id,TtablaAccidentes_Tipo:TtablaAccidentes_Tipo,TtablaAccidentes_Operacion:TtablaAccidentes_Operacion,TtablaAccidentes_Detalle:TtablaAccidentes_Detalle },    
                    success: function(data) {
                        tablaTipoTablaAccidentes.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDTipoTablaAccidentes').modal('hide');
            } 
        }

        /// EDITAR
        if(opcionTablaAccidentes == 2) {
            if(validacionTablaAccidentes!="invalido") {   
                Accion='EditarTipoTablaAccidentes';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TtablaAccidentes_Id:TtablaAccidentes_Id,TtablaAccidentes_Tipo:TtablaAccidentes_Tipo,TtablaAccidentes_Operacion:TtablaAccidentes_Operacion,TtablaAccidentes_Detalle:TtablaAccidentes_Detalle },    
                    success: function(data) {
                        tablaTipoTablaAccidentes.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDTipoTablaAccidentes').modal('hide');
            } 
        }
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btnBorrarTipoTablaAccidentes", function(){
        fila = $(this);           
        TtablaAccidentes_Id = $(this).closest('tr').find('td:eq(0)').text();     
        respuestaTablaAccidentes = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminará el registro "+TtablaAccidentes_Id+"!",
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
                respuestaTablaAccidentes = 1;
                Accion='BorrarTipoTablaAccidentes';
                if (respuestaTablaAccidentes == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TtablaAccidentes_Id:TtablaAccidentes_Id },   
                        success: function(data) {
                            tablaTipoTablaAccidentes.row(fila.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });
});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function validarTablaAccidentes(TtablaAccidentes_Id,TtablaAccidentes_Tipo,TtablaAccidentes_Operacion,TtablaAccidentes_Detalle){
    LimpiaMsTablaAccidentes();

    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    var respuesta="";    

    return respuesta; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function LimpiaMsTablaAccidentes(){
    $("#MsTtablaAccidentes_Id").css("display", "none" );
    $("#MsTtablaAccidentes_Tipo").css("display", "none" );
    $("#MsTtablaAccidentes_Operacion").css("display", "none" );
    $("#MsTtablaAccidentes_Detalle").css("display", "none" );
}