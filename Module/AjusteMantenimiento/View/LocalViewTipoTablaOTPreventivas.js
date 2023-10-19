///:::::::::::::::::: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::///
var TtablaOTPreventivas_Id,TtablaOTPreventivas_Tipo,TtablaOTPreventivas_Operacion,TtablaOTPreventivas_Detalle;
var tablaTipoTablaOTPreventivas, opcionTablaOTPreventivas, filaTablaOTPreventivas;

///::::::::::::: DOM Tipo Tabla OTPtreventivas ::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tabla = f_CreacionTabla("tablaTipoTablaOTPreventivas","");
    $("#div_tablaTipoTablaOTPreventivas").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaTipoTablaOTPreventivas","");

    // Setup - add a text input to each footer cell
    $('#tablaTipoTablaOTPreventivas thead tr')
        .clone(true)
        .addClass('filtersTipoTablaOTPreventivas')
        .appendTo('#tablaTipoTablaOTPreventivas thead');

    Accion='LeerTipoTablaOTPreventivas';
    tablaTipoTablaOTPreventivas = $('#tablaTipoTablaOTPreventivas').DataTable({
        //Filtros por columnas
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filtersTipoTablaOTPreventivas th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filtersTipoTablaOTPreventivas th').eq($(api.column(colIdx).header()).index()) )
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

        language: idiomaEspanol,
        responsive: "true",
        dom: 'Blfrtip', 
        buttons:[
            {
                extend      : 'excelHtml5',
                text        : '<i class="fas fa-file-excel"></i> ',
                titleAttr   : 'Exportar a Excel',
                className   : 'btn btn-success',
                title       : 'TC OT PREVENTIVAS'
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
    $("#btnNuevoTipoTablaOTPreventivas").click(function(){
        opcionTablaOTPreventivas = 1; // Alta 
        LimpiaMsTablaOTPreventivas();
        $("#TtablaOTPreventivas_Id").prop('disabled', true);
        $("#formTipoTablaOTPreventivas").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Tabla OTs Preventivas");
        $('#modalCRUDTipoTablaOTPreventivas').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarTipoTablaOTPreventivas", function(){
        opcionTablaOTPreventivas = 2;// Editar
        LimpiaMsTablaOTPreventivas();
        $("#TtablaOTPreventivas_Id").prop('disabled', true);
        filaTablaOTPreventivas = $(this).closest("tr");	        
        TtablaOTPreventivas_Id = filaTablaOTPreventivas.find('td:eq(0)').text();
        TtablaOTPreventivas_Operacion = filaTablaOTPreventivas.find('td:eq(1)').text();
        TtablaOTPreventivas_Tipo = filaTablaOTPreventivas.find('td:eq(2)').text();
        TtablaOTPreventivas_Detalle = filaTablaOTPreventivas.find('td:eq(3)').text();

        $("#TtablaOTPreventivas_Id").val(TtablaOTPreventivas_Id);
        $("#TtablaOTPreventivas_Tipo").val(TtablaOTPreventivas_Tipo);
        $("#TtablaOTPreventivas_Operacion").val(TtablaOTPreventivas_Operacion);
        $("#TtablaOTPreventivas_Detalle").val(TtablaOTPreventivas_Detalle);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Tabla OTs PReventivas");		
    
        $('#modalCRUDTipoTablaOTPreventivas').modal('show');		   
    });


    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formTipoTablaOTPreventivas').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

        TtablaOTPreventivas_Id = $.trim($('#TtablaOTPreventivas_Id').val());    
        TtablaOTPreventivas_Tipo = $.trim($('#TtablaOTPreventivas_Tipo').val());
        TtablaOTPreventivas_Operacion = $.trim($('#TtablaOTPreventivas_Operacion').val());    
        TtablaOTPreventivas_Detalle = $.trim($('#TtablaOTPreventivas_Detalle').val());
    
        validacionTablaOTPreventivas=validarTablaOTPreventivas(TtablaOTPreventivas_Id,TtablaOTPreventivas_Tipo,TtablaOTPreventivas_Operacion,TtablaOTPreventivas_Detalle);

        /// CREAR
        if(opcionTablaOTPreventivas == 1) {
            if(validacionTablaOTPreventivas!="invalido") {   
                // Nombre
                Accion='CrearTipoTablaOTPreventivas';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TtablaOTPreventivas_Id:TtablaOTPreventivas_Id,TtablaOTPreventivas_Tipo:TtablaOTPreventivas_Tipo,TtablaOTPreventivas_Operacion:TtablaOTPreventivas_Operacion,TtablaOTPreventivas_Detalle:TtablaOTPreventivas_Detalle },    
                    success: function(data) {
                        tablaTipoTablaOTPreventivas.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDTipoTablaOTPreventivas').modal('hide');
            } 
        }

        /// EDITAR
        if(opcionTablaOTPreventivas == 2) {
            if(validacionTablaOTPreventivas!="invalido") {   
                // Nombre
                Accion='EditarTipoTablaOTPreventivas';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TtablaOTPreventivas_Id:TtablaOTPreventivas_Id,TtablaOTPreventivas_Tipo:TtablaOTPreventivas_Tipo,TtablaOTPreventivas_Operacion:TtablaOTPreventivas_Operacion,TtablaOTPreventivas_Detalle:TtablaOTPreventivas_Detalle },    
                    success: function(data) {
                        tablaTipoTablaOTPreventivas.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDTipoTablaOTPreventivas').modal('hide');
            } 
        }
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btnBorrarTipoTablaOTPreventivas", function(){
        fila = $(this);           
        TtablaOTPreventivas_Id = $(this).closest('tr').find('td:eq(0)').text();     
        respuestaTablaOTPreventivas = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminará el registro "+TtablaOTPreventivas_Id+"!",
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
                respuestaTablaOTPreventivas = 1;

                Accion='BorrarTipoTablaOTPreventivas';
                if (respuestaTablaOTPreventivas == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TtablaOTPreventivas_Id:TtablaOTPreventivas_Id },   
                        success: function(data) {
                            tablaTipoTablaOTPreventivas.row(fila.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });

});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function validarTablaOTPreventivas(TtablaOTPreventivas_Id,TtablaOTPreventivas_Tipo,TtablaOTPreventivas_Operacion,TtablaOTPreventivas_Detalle){
    LimpiaMsTablaOTPreventivas();

    var respuestaOTPreventivas="";    

    if(TtablaOTPreventivas_Tipo===""){
        $("#TtablaOTPreventivas_Tipo").addClass("color-error");
        respuestaOTPreventivas="invalido";
    }
    if(TtablaOTPreventivas_Operacion===""){
        $("#TtablaOTPreventivas_Operacion").addClass("color-error");
        respuestaOTPreventivas="invalido";
    }
    if(TtablaOTPreventivas_Detalle===""){
        $("#TtablaOTPreventivas_Detalle").addClass("color-error");
        respuestaOTPreventivas="invalido";
    }

    return respuestaOTPreventivas; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function LimpiaMsTablaOTPreventivas(){
    $("#TtablaOTPreventivas_Id").removeClass("color-error");
    $("#TtablaOTPreventivas_Tipo").removeClass("color-error");
    $("#TtablaOTPreventivas_Operacion").removeClass("color-error");
    $("#TtablaOTPreventivas_Detalle").removeClass("color-error");
}