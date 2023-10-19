///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var unidad_medida,um_descripcion;
var tabla_unidad_medida, opcion_unidad_medida, fila_unidad_medida;

///:: DOM UNIDAD MEDIDA :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tabla = f_CreacionTabla("tabla_unidad_medida","");
    $("#div_tabla_unidad_medida").html(div_tabla);
    columnastabla = f_ColumnasTabla("tabla_unidad_medida","");

    Accion='leer_unidad_medida';
    tabla_unidad_medida = $('#tabla_unidad_medida').DataTable({
        orderCellsTop       : true,
        fixedHeader         : true,
        language            : idiomaEspanol,
        responsive          : "true",
        dom                 : 'Blfrtip',
        buttons:[
            {
                extend      : 'excelHtml5',
                text        : '<i class="fas fa-file-excel"></i> ',
                titleAttr   : 'Exportar a Excel',
                className   : 'btn btn-success'
            },
        ],
        "ajax":{            
            "url"           : "Ajax.php", 
            "method"        : 'POST', //usamos el metodo POST
            "data"          : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc"       : ""
        },
        "columns"           : columnastabla,
        "columnDefs"        : [
            {
                "targets"   : [2],
                "orderable" : false
            },
            {
                "className" : "text-center",
                "targets"   : [0,1] 
            }
        ],
        "order"             : [[0, "asc"]]
    });     

    ///::::::::: EVENTO DEL BOTON NUEVO ::::::::::::::///
    $("#btn_nuevo_unidad_medida").click(function(){
        opcion_unidad_medida = 1; // Alta 
        f_limpia_unidad_medida();
        $("#unidad_medida").prop('disabled', false);
        $("#form_unidad_medida").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta Unidad Medida");
        $('#modal_crud_unidad_medida').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btn_editar_unidad_medida", function(){
        opcion_unidad_medida = 2;// Editar
        f_limpia_unidad_medida();
        $("#unidad_medida").prop('disabled', true);
        fila_unidad_medida  = $(this).closest("tr");	        
        unidad_medida       = fila_unidad_medida.find('td:eq(0)').text();
        um_descripcion      = fila_unidad_medida.find('td:eq(1)').text();

        $("#unidad_medida").val(unidad_medida);
        $("#um_descripcion").val(um_descripcion);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Unidad Medida");		
    
        $('#modal_crud_unidad_medida').modal('show');		   
    });


    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#form_unidad_medida').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

        unidad_medida   = $.trim($('#unidad_medida').val());    
        um_descripcion  = $.trim($('#um_descripcion').val());
    
        validar_unidad_medida = f_validar_unidad_medida(unidad_medida,um_descripcion);

        /// CREAR
        if(opcion_unidad_medida == 1) {
            if(validar_unidad_medida!="invalido") {   
                // Nombre
                Accion='crear_unidad_medida';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,unidad_medida:unidad_medida,um_descripcion:um_descripcion },    
                    success: function(data) {
                        tabla_unidad_medida.ajax.reload(null, false);
                    }
                });
                $('#modal_crud_unidad_medida').modal('hide');
            } 
        }

        /// EDITAR
        if(opcion_unidad_medida == 2) {
            if(validar_unidad_medida!="invalido") {   
                // Nombre
                Accion='editar_unidad_medida';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,unidad_medida:unidad_medida,um_descripcion:um_descripcion },    
                    success: function(data) {
                        tabla_unidad_medida.ajax.reload(null, false);
                    }
                });
                $('#modal_crud_unidad_medida').modal('hide');
            } 
        }
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btn_borrar_unidad_medida", function(){
        fila = $(this);           
        unidad_medida = $(this).closest('tr').find('td:eq(0)').text();
        rpta_unidad_medida = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminará el registro "+unidad_medida+"!",
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
                rpta_unidad_medida = 1;
                // Nombre
                Accion='borrar_unidad_medida';
                if (rpta_unidad_medida == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,unidad_medida:unidad_medida },   
                        success: function(data) {
                            tabla_unidad_medida.row(fila.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });

});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_validar_unidad_medida(p_unidad_medida,p_um_descripcion){
    f_limpia_unidad_medida();

    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    var rpta_validae_unidad_medida="";

    if(p_unidad_medida==""){
        $("#unidad_medida").addClass("color-error");    
        rpta_validae_unidad_medida = "invalido";
    }
    if(p_um_descripcion==""){
        $("#um_descripcion").addClass("color-error");    
        rpta_validae_unidad_medida = "invalido";
    }

    return rpta_validae_unidad_medida; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_limpia_unidad_medida(){
    $("#unidad_medida").removeClass("color-error");
    $("#um_descripcion").removeClass("color-error");
}