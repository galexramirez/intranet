///:::::::::::::::::: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::///
var ttablausuario_id,ttablausuario_tipo,ttablausuario_operacion,ttablausuario_detalle;
var tablaUsuario, opcionUsuario, filaUsuario;

///::::::::: ACTIVA LOS TABS ::::::::::::: ///
$(document).ready(function()
{
    div_tabla = f_CreacionTabla("tablaUsuario","");
    $("#div_tablaUsuario").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaUsuario","");

    Accion='LeerUsuario';
    tablaUsuario = $('#tablaUsuario').DataTable({
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
    $("#btnNuevoUsuario").click(function(){
        opcionUsuario = 1; // Alta 
        f_LimpiaMsUsuario();
        $("#ttablausuario_id").prop('disabled', true);
        $("#formUsuario").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Usuario");
        $('#modalCRUDUsuario').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarUsuario", function(){
        opcionUsuario = 2;// Editar
        f_LimpiaMsUsuario();
        $("#ttablausuario_id").prop('disabled', true);
        filaUsuario = $(this).closest("tr");	        
        ttablausuario_id = filaUsuario.find('td:eq(0)').text();
        ttablausuario_operacion = filaUsuario.find('td:eq(1)').text();
        ttablausuario_tipo = filaUsuario.find('td:eq(2)').text();
        ttablausuario_detalle = filaUsuario.find('td:eq(3)').text();

        $("#ttablausuario_id").val(ttablausuario_id);
        $("#ttablausuario_tipo").val(ttablausuario_tipo);
        $("#ttablausuario_operacion").val(ttablausuario_operacion);
        $("#ttablausuario_detalle").val(ttablausuario_detalle);
        
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Usuario");		
    
        $('#modalCRUDUsuario').modal('show');		   
    });

    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formUsuario').submit(function(e){                         
        let validacionUsuario = '';
        let t_msg = '';
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        ttablausuario_id = $.trim($('#ttablausuario_id').val());
        ttablausuario_operacion = $.trim($('#ttablausuario_operacion').val());
        ttablausuario_tipo = $.trim($('#ttablausuario_tipo').val());
        ttablausuario_detalle = $.trim($('#ttablausuario_detalle').val());

        validacionUsuario = f_validarUsuario(ttablausuario_tipo,ttablausuario_operacion,ttablausuario_detalle);

        if(validacionUsuario===''){
            let a_data = [];
            a_data = f_BuscarDataBD("glo_tipotablausuario","ttablausuario_tipo",ttablausuario_tipo);
            $.each(a_data, function(idx, obj){ 
                if(obj.ttablausuario_operacion===ttablausuario_operacion.toUpperCase() && obj.ttablausuario_tipo===ttablausuario_tipo.toUpperCase() && obj.ttablausuario_detalle===ttablausuario_detalle.toUpperCase()){
                    validacionUsuario = "invalido";
                    t_msg = "<br> Registro ya existe !!!";
                }
            });
        }
        
        if(validacionUsuario == "invalido"){
            Swal.fire({
              position          : 'center',
              icon              : 'error',
              title             : '*Falta Completar Información!!!'+t_msg,
              showConfirmButton : false,
              timer             : 1500
            })
        }else{
            /// CREAR
            if(opcionUsuario == 1) {   
                $("#btnGuardarUsuario").prop("disabled",true);
                Accion='CrearUsuario';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablausuario_id:ttablausuario_id,ttablausuario_tipo:ttablausuario_tipo,ttablausuario_operacion:ttablausuario_operacion,ttablausuario_detalle:ttablausuario_detalle},    
                    success: function(data) {
                        tablaUsuario.ajax.reload(null, false);
                        $("#btnGuardarUsuario").prop("disabled",false);
                    }
                });
                $('#modalCRUDUsuario').modal('hide');
            } 
            /// EDITAR
            if(opcionUsuario == 2) {   
                $("#btnGuardarUsuario").prop("disabled",true);
                Accion='EditarUsuario';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablausuario_id:ttablausuario_id,ttablausuario_tipo:ttablausuario_tipo,ttablausuario_operacion:ttablausuario_operacion,ttablausuario_detalle:ttablausuario_detalle},    
                    success: function(data) {
                        tablaUsuario.ajax.reload(null, false);
                        $("#btnGuardarUsuario").prop("disabled",false);
                    }
                });
                $('#modalCRUDUsuario').modal('hide');
            } 
        }
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btnBorrarUsuario", function(){
        filaUsuario = $(this);           
        ttablausuario_id = filaUsuario.closest('tr').find('td:eq(0)').text();     
        let respuestaUsuario = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminará el registro "+ttablausuario_id+"!",
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
                respuestaUsuario = 1;
                // Nombre
                Accion='BorrarUsuario';
                if (respuestaUsuario == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablausuario_id:ttablausuario_id },   
                        success: function(data) {
                            tablaUsuario.row(filaUsuario.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });
});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_validarUsuario(pttablausuario_tipo,pttablausuario_operacion,pttablausuario_detalle){
    f_LimpiaMsUsuario();
    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    let rptaUsuario="";

    if(pttablausuario_tipo==""){
        $("#ttablausuario_tipo").addClass("color-error");
        rptaUsuario="invalido";
    }
    if(pttablausuario_operacion==""){
        $("#ttablausuario_operacion").addClass("color-error");
        rptaUsuario="invalido";
    }
    if(pttablausuario_detalle==""){
        $("#ttablausuario_detalle").addClass("color-error");
        rptaUsuario="invalido";
    }
    return rptaUsuario;
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_LimpiaMsUsuario(){
    $("#ttablausuario_id").removeClass("color-error");
    $("#ttablausuario_tipo").removeClass("color-error");
    $("#ttablausuario_operacion").removeClass("color-error");
    $("#ttablausuario_detalle").removeClass("color-error");
}