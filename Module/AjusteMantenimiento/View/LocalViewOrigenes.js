///:::::::::::::::::: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::///
var cod_origen,or_nombre;
var tablaOrigenes, opcionTablaOrigenes, filaTablaOrigenes;

///::::::::::::: DOM Tipo Tabla OTPtreventivas ::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tabla = f_CreacionTabla("tablaOrigenes","");
    $("#div_tablaOrigenes").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaOrigenes","");

    // Setup - add a text input to each footer cell
    $('#tablaOrigenes thead tr')
        .clone(true)
        .addClass('filtersOrigenes')
        .appendTo('#tablaOrigenes thead');

    Accion='LeerOrigenes';
    tablaOrigenes = $('#tablaOrigenes').DataTable({
        //Filtros por columnas
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filtersOrigenes th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filtersOrigenes th').eq($(api.column(colIdx).header()).index()) )
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
    $("#btnNuevoOrigenes").click(function(){
        opcionTablaOrigenes = 1; // Alta 
        LimpiaMsTablaOrigenes();
        $("#cod_origen").prop('disabled', true);
        $("#formOrigenes").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Tabla Origenes");
        $('#modalCRUDOrigenes').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarOrigenes", function(){
        opcionTablaOrigenes = 2;// Editar
        LimpiaMsTablaOrigenes();
        $("#cod_origen").prop('disabled', true);
        filaTablaOrigenes = $(this).closest("tr");	        
        cod_origen = filaTablaOrigenes.find('td:eq(0)').text();
        or_nombre = filaTablaOrigenes.find('td:eq(1)').text();

        $("#cod_origen").val(cod_origen);
        $("#or_nombre").val(or_nombre);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Tabla Origenes");		
    
        $('#modalCRUDOrigenes').modal('show');		   
    });


    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formOrigenes').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

        cod_origen = $.trim($('#cod_origen').val());    
        or_nombre = $.trim($('#or_nombre').val());
    
        validacionTablaOrigenes=validarTablaOrigenes(cod_origen,or_nombre);

        /// CREAR
        if(opcionTablaOrigenes == 1) {
            if(validacionTablaOrigenes!="invalido") {   
                // Nombre
                Accion='CrearOrigenes';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_origen:cod_origen,or_nombre:or_nombre },    
                    success: function(data) {
                        tablaOrigenes.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDOrigenes').modal('hide');
            } 
        }

        /// EDITAR
        if(opcionTablaOrigenes == 2) {
            if(validacionTablaOrigenes!="invalido") {   
                // Nombre
                Accion='EditarOrigenes';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_origen:cod_origen,or_nombre:or_nombre },    
                    success: function(data) {
                        tablaOrigenes.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDOrigenes').modal('hide');
            } 
        }
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btnBorrarOrigenes", function(){
        fila = $(this);           
        cod_origen = $(this).closest('tr').find('td:eq(0)').text();
        respuestaTablaOrigenes = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminará el registro "+cod_origen+"!",
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
                respuestaTablaOrigenes = 1;
                // Nombre
                Accion='BorrarOrigenes';
                if (respuestaTablaOrigenes == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_origen:cod_origen },   
                        success: function(data) {
                            tablaOrigenes.row(fila.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });

});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function validarTablaOrigenes(cod_resasoc,ra_nombres,ra_asociado){
    LimpiaMsTablaOrigenes();

    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    var respuestaOrigenes="";    

    return respuestaOrigenes; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function LimpiaMsTablaOrigenes(){
}