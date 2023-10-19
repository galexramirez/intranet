///:::::::::::::::::: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::///
var cod_rep,rep_desc,rep_unida,rep_precio,rep_ingreso,rep_asociado;
var tablaRepuestos, opcionTablaRepuestos, filaTablaRepuestos;

///::::::::::::: DOM Tipo Tabla OTPtreventivas ::::::::::::::::::::::::::::///
$(document).ready(function(){
    // Cargamos Asociados
    Accion='AsociadoVales';
    $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",
        async: false,
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
        success: function(data){
            $("#rep_asociado").html(data);
        }
    });

    // COMBOS DE TABLA TIPO VALES
    Operacion='VALES';
    Tipo='UNIDAD';
    selectHtmlVales="";
    selectHtmlVales = f_TipoTabla(Operacion,Tipo);
    $("#rep_unida").html(selectHtmlVales);

    div_tabla = f_CreacionTabla("tablaRepuestos","");
    $("#div_tablaRepuestos").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaRepuestos","");

    // Setup - add a text input to each footer cell
    $('#tablaRepuestos thead tr')
        .clone(true)
        .addClass('filtersRepuestos')
        .appendTo('#tablaRepuestos thead');

    Accion='LeerRepuestos';
    tablaRepuestos = $('#tablaRepuestos').DataTable({
        //Filtros por columnas
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filtersRepuestos th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filtersRepuestos th').eq($(api.column(colIdx).header()).index()) )
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
        "columns": columnastabla,
        "columnDefs"    :[
            {
                "targets"   : [5],
                "orderable" : false
            },
        ],
        "order"         : [[0, 'asc']]
    });     

    ///::::::::: EVENTO DEL BOTON NUEVO ::::::::::::::///
    $("#btnNuevoRepuestos").click(function(){
        opcionTablaRepuestos = 1; // Alta 
        LimpiaMsTablaRepuestos();
        $("#cod_rep").prop('disabled', false);
        $("#formRepuestos").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Repuestos");
        $('#modalCRUDRepuestos').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarRepuestos", function(){
        opcionTablaRepuestos = 2;// Editar
        LimpiaMsTablaRepuestos();
        $("#cod_rep").prop('disabled', true);
        filaTablaRepuestos = $(this).closest("tr");	        
        cod_rep = filaTablaRepuestos.find('td:eq(0)').text();
        rep_desc = filaTablaRepuestos.find('td:eq(1)').text();
        rep_unida = filaTablaRepuestos.find('td:eq(2)').text();
        rep_precio = filaTablaRepuestos.find('td:eq(3)').text();
        rep_asociado = filaTablaRepuestos.find('td:eq(4)').text();

        $("#cod_rep").val(cod_rep);
        $("#rep_desc").val(rep_desc);
        $("#rep_unida").val(rep_unida);
        $("#rep_precio").val(rep_precio);
        $("#rep_asociado").val(rep_asociado);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Repuestos");		
    
        $('#modalCRUDRepuestos').modal('show');		   
    });


    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formRepuestos').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

        cod_rep = $.trim($('#cod_rep').val());    
        rep_desc = $.trim($('#rep_desc').val());
        rep_unida = $.trim($('#rep_unida').val());
        rep_precio = $.trim($('#rep_precio').val());
        rep_ingreso = "mod_repuesto";
        rep_asociado = $.trim($('#rep_asociado').val());
    
        validacionTablaRepuestos=validarTablaRepuestos(cod_rep, rep_desc, rep_unida, rep_precio, rep_asociado);

        /// CREAR
        if(opcionTablaRepuestos == 1) {
            if(validacionTablaRepuestos!="invalido") {   
                // Nombre
                Accion='CrearRepuestos';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_rep:cod_rep,rep_desc:rep_desc,rep_unida:rep_unida,rep_precio:rep_precio,rep_ingreso:rep_ingreso,rep_asociado:rep_asociado },    
                    success: function(data) {
                        tablaRepuestos.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDRepuestos').modal('hide');
            } 
        }

        /// EDITAR
        if(opcionTablaRepuestos == 2) {
            if(validacionTablaRepuestos!="invalido") {   
                // Nombre
                Accion='EditarRepuestos';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_rep:cod_rep,rep_desc:rep_desc,rep_unida:rep_unida,rep_precio:rep_precio,rep_ingreso:rep_ingreso,rep_asociado:rep_asociado },    
                    success: function(data) {
                        tablaRepuestos.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDRepuestos').modal('hide');
            } 
        }
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btnBorrarRepuestos", function(){
        fila = $(this);           
        cod_rep = $(this).closest('tr').find('td:eq(0)').text();     
        respuestaTablaRepuestos = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminará el registro "+cod_rep+"!",
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
                respuestaTablaRepuestos = 1;
                // Nombre
                Accion='BorrarRepuestos';
                if (respuestaTablaRepuestos == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_rep:cod_rep },   
                        success: function(data) {
                            tablaRepuestos.row(fila.parents('tr')).remove().draw();
                        }
                    });
                }
            }rp
        });
    });

});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function validarTablaRepuestos(pcod_rep, prep_desc, prep_unida, prep_precio, prep_asociado){
    LimpiaMsTablaRepuestos();
    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    var rpta_Repuestos="";    

    if(pcod_rep==""){
        $("#rep_cod").addClass("color-error");
        rpta_Repuestos="invalido";
    }

    if(prep_desc==""){
        $("#rep_desc").addClass("color-error");
        rpta_Repuestos="invalido";
    }

    if(prep_unida==""){
        $("#rep_unida").addClass("color-error");
        rpta_Repuestos="invalido";
    }

    if(prep_precio==""){
        //$("#rep_precio").addClass("color-error");
        //rpta_Repuestos="invalido";
    }

    if(prep_asociado==""){
        //$("#rep_asociado").addClass("color-error");
        //rpta_Repuestos="invalido";
    }

    return rpta_Repuestos; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function LimpiaMsTablaRepuestos(){
    $("#cod_rep").removeClass("color-error");
    $("#rep_desc").removeClass("color-error");
    $("#rep_unida").removeClass("color-error");
    $("#rep_precio").removeClass("color-error");
    $("#rep_asociado").removeClass("color-error");

}