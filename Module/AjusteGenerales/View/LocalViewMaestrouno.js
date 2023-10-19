///:::::::::::::::::: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::///
var ttablamaestrouno_id,ttablamaestrouno_tipo,ttablamaestrouno_operacion,ttablamaestrouno_detalle;
var tablaMaestrouno, opcionMaestrouno, filaMaestrouno;

///::::::::: ACTIVA LOS TABS ::::::::::::: ///
$(document).ready(function()
{
    div_tabla = f_CreacionTabla("tablaMaestrouno","");
    $("#div_tablaMaestrouno").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaMaestrouno","");

    Accion='LeerMaestrouno';
    tablaMaestrouno = $('#tablaMaestrouno').DataTable({
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
    $("#btnNuevoMaestrouno").click(function(){
        opcionMaestrouno = 1; // Alta 
        f_LimpiaMsMaestrouno();
        $("#ttablamaestrouno_id").prop('disabled', true);
        $("#formMaestrouno").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Maestro Uno");
        $('#modalCRUDMaestrouno').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarMaestrouno", function(){
        opcionMaestrouno = 2;// Editar
        f_LimpiaMsMaestrouno();
        $("#ttablamaestrouno_id").prop('disabled', true);
        filaMaestrouno = $(this).closest("tr");	        
        ttablamaestrouno_id = filaMaestrouno.find('td:eq(0)').text();
        ttablamaestrouno_operacion = filaMaestrouno.find('td:eq(1)').text();
        ttablamaestrouno_tipo = filaMaestrouno.find('td:eq(2)').text();
        ttablamaestrouno_detalle = filaMaestrouno.find('td:eq(3)').text();

        $("#ttablamaestrouno_id").val(ttablamaestrouno_id);
        $("#ttablamaestrouno_tipo").val(ttablamaestrouno_tipo);
        $("#ttablamaestrouno_operacion").val(ttablamaestrouno_operacion);
        $("#ttablamaestrouno_detalle").val(ttablamaestrouno_detalle);
        
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Maestro Uno");		
    
        $('#modalCRUDMaestrouno').modal('show');		   
    });

    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formMaestrouno').submit(function(e){                         
        let validacionMaestrouno;
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        ttablamaestrouno_id = $.trim($('#ttablamaestrouno_id').val());
        ttablamaestrouno_operacion = $.trim($('#ttablamaestrouno_operacion').val());
        ttablamaestrouno_tipo = $.trim($('#ttablamaestrouno_tipo').val());
        ttablamaestrouno_detalle = $.trim($('#ttablamaestrouno_detalle').val());

        validacionMaestrouno = f_validarMaestrouno(ttablamaestrouno_tipo,ttablamaestrouno_operacion,ttablamaestrouno_detalle);
        
        if(validacionMaestrouno == "invalido"){
            Swal.fire({
              position: 'center',
              icon: 'error',
              title: '*Falta Completar Información!!!',
              showConfirmButton: false,
              timer: 1500
            })
        }else{
            /// CREAR
            if(opcionMaestrouno == 1) {   
                $("#btnGuardarMaestrouno").prop("disabled",true);
                Accion='CrearMaestrouno';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablamaestrouno_id:ttablamaestrouno_id,ttablamaestrouno_tipo:ttablamaestrouno_tipo,ttablamaestrouno_operacion:ttablamaestrouno_operacion,ttablamaestrouno_detalle:ttablamaestrouno_detalle},    
                    success: function(data) {
                        tablaMaestrouno.ajax.reload(null, false);
                        $("#btnGuardarMaestrouno").prop("disabled",false);
                    }
                });
                $('#modalCRUDMaestrouno').modal('hide');
            } 
            /// EDITAR
            if(opcionMaestrouno == 2) {   
                $("#btnGuardarMaestrouno").prop("disabled",true);
                Accion='EditarMaestrouno';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablamaestrouno_id:ttablamaestrouno_id,ttablamaestrouno_tipo:ttablamaestrouno_tipo,ttablamaestrouno_operacion:ttablamaestrouno_operacion,ttablamaestrouno_detalle:ttablamaestrouno_detalle},    
                    success: function(data) {
                        tablaMaestrouno.ajax.reload(null, false);
                        $("#btnGuardarMaestrouno").prop("disabled",false);
                    }
                });
                $('#modalCRUDMaestrouno').modal('hide');
            } 
        }
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btnBorrarMaestrouno", function(){
        filaMaestrouno = $(this);           
        ttablamaestrouno_id = filaMaestrouno.closest('tr').find('td:eq(0)').text();     
        let respuestaMaestrouno = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminará el registro "+ttablamaestrouno_id+"!",
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
                respuestaMaestrouno = 1;
                // Nombre
                Accion='BorrarMaestrouno';
                if (respuestaMaestrouno == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablamaestrouno_id:ttablamaestrouno_id },   
                        success: function(data) {
                            tablaMaestrouno.row(filaMaestrouno.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });
});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_validarMaestrouno(pttablamaestrouno_tipo,pttablamaestrouno_operacion,pttablamaestrouno_detalle){
    f_LimpiaMsMaestrouno();
    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    let rptaMaestrouno="";

    if(pttablamaestrouno_tipo==""){
        $("#ttablamaestrouno_tipo").addClass("color-error");
        rptaMaestrouno="invalido";
    }
    if(pttablamaestrouno_operacion==""){
        $("#ttablamaestrouno_tipo").addClass("color-error");
        rptaMaestrouno="invalido";
    }
    if(pttablamaestrouno_detalle==""){
        $("#ttablamaestrouno_tipo").addClass("color-error");
        rptaMaestrouno="invalido";
    }
    return rptaMaestrouno;
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_LimpiaMsMaestrouno(){
    $("#ttablamaestrouno_id").removeClass("color-error");
    $("#ttablamaestrouno_tipo").removeClass("color-error");
    $("#ttablamaestrouno_operacion").removeClass("color-error");
    $("#ttablamaestrouno_detalle").removeClass("color-error");
}