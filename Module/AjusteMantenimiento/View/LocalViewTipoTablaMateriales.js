///:::::::::::::::::: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::///
var ttablamateriales_id,ttablamateriales_tipo,ttablamateriales_operacion,ttablamateriales_detalle;
var tablaTipoTablaMateriales, opcionTablaMateriales, filaTablaMateriales;

///::::::::::::: DOM Tipo Tabla OTPtreventivas ::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tabla = f_CreacionTabla("tablaTipoTablaMateriales","");
    $("#div_tablaTipoTablaMateriales").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaTipoTablaMateriales","");

    // Setup - add a text input to each footer cell
    $('#tablaTipoTablaMateriales thead tr')
        .clone(true)
        .addClass('filtersTipoTablaMateriales')
        .appendTo('#tablaTipoTablaMateriales thead');

    Accion='LeerTipoTablaMateriales';
    tablaTipoTablaMateriales = $('#tablaTipoTablaMateriales').DataTable({
        //Filtros por columnas
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filtersTipoTablaMateriales th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filtersTipoTablaMateriales th').eq($(api.column(colIdx).header()).index()) )
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
    $("#btnNuevoTipoTablaMateriales").click(function(){
        opcionTablaMateriales = 1; // Alta 
        LimpiaMsTablaMateriales();
        $("#ttablamateriales_id").prop('disabled', true);
        $("#formTipoTablaMateriales").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Tabla Materiales");
        $('#modalCRUDTipoTablaMateriales').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarTipoTablaMateriales", function(){
        opcionTablaMateriales = 2;// Editar
        LimpiaMsTablaMateriales();
        $("#ttablamateriales_id").prop('disabled', true);
        filaTablaMateriales = $(this).closest("tr");	        
        ttablamateriales_id = filaTablaMateriales.find('td:eq(0)').text();
        ttablamateriales_operacion = filaTablaMateriales.find('td:eq(1)').text();
        ttablamateriales_tipo = filaTablaMateriales.find('td:eq(2)').text();
        ttablamateriales_detalle = filaTablaMateriales.find('td:eq(3)').text();

        $("#ttablamateriales_id").val(ttablamateriales_id);
        $("#ttablamateriales_tipo").val(ttablamateriales_tipo);
        $("#ttablamateriales_operacion").val(ttablamateriales_operacion);
        $("#ttablamateriales_detalle").val(ttablamateriales_detalle);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Tabla Materiales");		
    
        $('#modalCRUDTipoTablaMateriales').modal('show');		   
    });


    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formTipoTablaMateriales').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

        ttablamateriales_id = $.trim($('#ttablamateriales_id').val());    
        ttablamateriales_tipo = $.trim($('#ttablamateriales_tipo').val());
        ttablamateriales_operacion = $.trim($('#ttablamateriales_operacion').val());    
        ttablamateriales_detalle = $.trim($('#ttablamateriales_detalle').val());
    
        validacionTablaMateriales=validarTablaMateriales(ttablamateriales_id,ttablamateriales_tipo,ttablamateriales_operacion,ttablamateriales_detalle);

        /// CREAR
        if(opcionTablaMateriales == 1) {
            if(validacionTablaMateriales!="invalido") {   
                // Nombre
                Accion='CrearTipoTablaMateriales';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablamateriales_id:ttablamateriales_id,ttablamateriales_tipo:ttablamateriales_tipo,ttablamateriales_operacion:ttablamateriales_operacion,ttablamateriales_detalle:ttablamateriales_detalle },    
                    success: function(data) {
                        tablaTipoTablaMateriales.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDTipoTablaMateriales').modal('hide');
            } 
        }

        /// EDITAR
        if(opcionTablaMateriales == 2) {
            if(validacionTablaMateriales!="invalido") {   
                // Nombre
                Accion='EditarTipoTablaMateriales';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablamateriales_id:ttablamateriales_id,ttablamateriales_tipo:ttablamateriales_tipo,ttablamateriales_operacion:ttablamateriales_operacion,ttablamateriales_detalle:ttablamateriales_detalle },    
                    success: function(data) {
                        tablaTipoTablaMateriales.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDTipoTablaMateriales').modal('hide');
            } 
        }
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btnBorrarTipoTablaMateriales", function(){
        fila = $(this);           
        ttablamateriales_id = $(this).closest('tr').find('td:eq(0)').text();     
        respuestaTablaMateriales = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminará el registro "+ttablamateriales_id+"!",
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
                respuestaTablaMateriales = 1;
                // Nombre
                Accion='BorrarTipoTablaMateriales';
                if (respuestaTablaMateriales == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablamateriales_id:ttablamateriales_id },   
                        success: function(data) {
                            tablaTipoTablaMateriales.row(fila.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });

});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function validarTablaMateriales(ttablamateriales_id,ttablamateriales_tipo,ttablamateriales_operacion,ttablamateriales_detalle){
    LimpiaMsTablaMateriales();

    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    var respuestaMateriales="";    

    return respuestaMateriales; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function LimpiaMsTablaMateriales(){
    $("#Msttablamateriales_id").css("display", "none" );
    $("#Msttablamateriales_tipo").css("display", "none" );
    $("#Msttablamateriales_operacion").css("display", "none" );
    $("#Msttablamateriales_detalle").css("display", "none" );
}