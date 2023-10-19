///:::::::::::::::::: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::///
var ttablavales_id,ttablavales_tipo,ttablavales_operacion,ttablavales_detalle;
var tablaTipoTablaVales, opcionTablaVales, filaTablaVales;

///::::::::::::: DOM Tipo Tabla OTPtreventivas ::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tabla = f_CreacionTabla("tablaTipoTablaVales","");
    $("#div_tablaTipoTablaVales").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaTipoTablaVales","");

    // Setup - add a text input to each footer cell
    $('#tablaTipoTablaVales thead tr')
        .clone(true)
        .addClass('filtersTipoTablaVales')
        .appendTo('#tablaTipoTablaVales thead');

    Accion='LeerTipoTablaVales';
    tablaTipoTablaVales = $('#tablaTipoTablaVales').DataTable({
        //Filtros por columnas
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filtersTipoTablaVales th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filtersTipoTablaVales th').eq($(api.column(colIdx).header()).index()) )
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
    $("#btnNuevoTipoTablaVales").click(function(){
        opcionTablaVales = 1; // Alta 
        LimpiaMsTablaVales();
        $("#ttablavales_id").prop('disabled', true);
        $("#formTipoTablaVales").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Tabla Vales");
        $('#modalCRUDTipoTablaVales').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarTipoTablaVales", function(){
        opcionTablaVales = 2;// Editar
        LimpiaMsTablaVales();
        $("#ttablavales_id").prop('disabled', true);
        filaTablaVales = $(this).closest("tr");	        
        ttablavales_id = filaTablaVales.find('td:eq(0)').text();
        ttablavales_operacion = filaTablaVales.find('td:eq(1)').text();
        ttablavales_tipo = filaTablaVales.find('td:eq(2)').text();
        ttablavales_detalle = filaTablaVales.find('td:eq(3)').text();

        $("#ttablavales_id").val(ttablavales_id);
        $("#ttablavales_tipo").val(ttablavales_tipo);
        $("#ttablavales_operacion").val(ttablavales_operacion);
        $("#ttablavales_detalle").val(ttablavales_detalle);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Tabla Vales");		
    
        $('#modalCRUDTipoTablaVales').modal('show');		   
    });


    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formTipoTablaVales').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

        ttablavales_id = $.trim($('#ttablavales_id').val());    
        ttablavales_tipo = $.trim($('#ttablavales_tipo').val());
        ttablavales_operacion = $.trim($('#ttablavales_operacion').val());    
        ttablavales_detalle = $.trim($('#ttablavales_detalle').val());
    
        validacionTablaVales=validarTablaVales(ttablavales_id,ttablavales_tipo,ttablavales_operacion,ttablavales_detalle);

        /// CREAR
        if(opcionTablaVales == 1) {
            if(validacionTablaVales!="invalido") {   
                // Nombre
                Accion='CrearTipoTablaVales';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablavales_id:ttablavales_id,ttablavales_tipo:ttablavales_tipo,ttablavales_operacion:ttablavales_operacion,ttablavales_detalle:ttablavales_detalle },    
                    success: function(data) {
                        tablaTipoTablaVales.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDTipoTablaVales').modal('hide');
            } 
        }

        /// EDITAR
        if(opcionTablaVales == 2) {
            if(validacionTablaVales!="invalido") {   
                // Nombre
                Accion='EditarTipoTablaVales';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablavales_id:ttablavales_id,ttablavales_tipo:ttablavales_tipo,ttablavales_operacion:ttablavales_operacion,ttablavales_detalle:ttablavales_detalle },    
                    success: function(data) {
                        tablaTipoTablaVales.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDTipoTablaVales').modal('hide');
            } 
        }
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btnBorrarTipoTablaVales", function(){
        fila = $(this);           
        ttablavales_id = $(this).closest('tr').find('td:eq(0)').text();     
        respuestaTablaVales = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminará el registro "+ttablavales_id+"!",
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
                respuestaTablaVales = 1;
                // Nombre
                Accion='BorrarTipoTablaVales';
                if (respuestaTablaVales == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablavales_id:ttablavales_id },   
                        success: function(data) {
                            tablaTipoTablaVales.row(fila.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });

});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function validarTablaVales(ttablavales_id,ttablavales_tipo,ttablavales_operacion,ttablavales_detalle){
    LimpiaMsTablaVales();

    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    var respuestaVales="";    

    return respuestaVales; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function LimpiaMsTablaVales(){
    $("#Msttablavales_id").css("display", "none" );
    $("#Msttablavales_tipo").css("display", "none" );
    $("#Msttablavales_operacion").css("display", "none" );
    $("#Msttablavales_detalle").css("display", "none" );
}