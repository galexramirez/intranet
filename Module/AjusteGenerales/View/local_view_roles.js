///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: ROLES DE USUARIO v 3.0  FECHA: 2023-05-12 :::::::::::::::::::::::::::::::::::::::::::///
///:: CRUD ROLES DE USUARIO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_roles, roles_id, roles_dni, roles_apellidosnombres, roles_nombrecorto, roles_perfil, fila_roles, opcion_roles;

///:: JS DOM ROLES DE USUARIO :;;;;;:::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    let a_data = [];
    div_tabla       = f_CreacionTabla("tabla_roles","");
    $("#div_tabla_roles").html(div_tabla);
    columnastabla   = f_ColumnasTabla("tabla_roles","");

    Accion = 'leer_roles';
    tabla_roles = $('#tabla_roles').removeAttr('width').DataTable({
        language        : idiomaEspanol,
        responsive      : "true",
        dom             : 'Blfrtip',
        buttons:[
            {
                extend      : 'excelHtml5',
                text        : '<i class="fas fa-file-excel"></i> ',
                titleAttr   : 'Exportar a Excel',
                className   : 'btn btn-success',
                title       : 'ROLES DE USUARIO'
            }
        ],
        "ajax":{            
                "url"       : "Ajax.php", 
                "method"    : 'POST',
                "data"      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion},
                "dataSrc"   : ""
                },
        "columns": columnastabla,
        "columnDefs"    : [
            {   width       : 200, targets: [3, 4, 5] }
        ],
        fixedColumns        : true
    });     

    ///:: SI SE ACTUALIZA roles_apellidosnombres entonces se busca el nombre corto ::///
    $("#roles_dni").on('change', function () {
        roles_dni               = $("#roles_dni").val();
        roles_apellidosnombres  = "";
        roles_nombrecorto       = ""; 
        a_data = f_BuscarDataBD('colaborador','Colaborador_id',roles_dni);
        $.each(a_data, function(idx, obj){
            roles_apellidosnombres  = obj.Colab_ApellidosNombres;
            roles_nombrecorto       = obj.Colab_nombre_corto;
        });
        $("#roles_apellidosnombres").val(roles_apellidosnombres);
        $("#roles_nombrecorto").val(roles_nombrecorto);
    });

    ///:: EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_nuevo_roles", function(){
        roles_dni       = "";
        opcion_roles    = "CREAR"; 
        f_limpia_roles();
        $("#form_roles").trigger("reset");
        $("#roles_dni").prop('disabled', false);
        $("#roles_dni").val(roles_dni); 

        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Roles de Usuarios");
        $('#modal_crud_roles').modal('show');	    
    });
    ///:: FIN EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON EDITAR ROLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_editar_roles", function(){
        opcion_roles = "EDITAR";
        f_limpia_roles();
        $("#form_roles").trigger("reset");

        $("#roles_dni").prop('disabled', true);
        fila_roles              = $(this).closest("tr");	        
        roles_id                = fila_roles.find('td:eq(0)').text();
        roles_dni               = fila_roles.find('td:eq(1)').text();
        roles_apellidosnombres  = fila_roles.find('td:eq(2)').text();
        roles_nombrecorto       = fila_roles.find('td:eq(3)').text();
        roles_perfil            = fila_roles.find('td:eq(4)').text();

        $("#roles_id").val(roles_id);
        $("#roles_dni").val(roles_dni);
        $("#roles_apellidosnombres").val(roles_apellidosnombres);
        $("#roles_nombrecorto").val(roles_nombrecorto);
        $("#roles_perfil").val(roles_perfil);
       
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Roles de Usuarios");		
    
        $('#modal_crud_roles').modal('show');
    });
    ///:: FIN BOTON EDITAR ROLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON CREA Y EDITA ROLES DE USUARIOS ::::::::::::::::::::::::::::::::::::::::::::///
    $('#form_roles').submit(function(e){
        let validacion_roles    = "";
        let t_msg               = "";
        e.preventDefault();
        roles_id                = $.trim($('#roles_id').val());    
        roles_dni               = $.trim($('#roles_dni').val());
        roles_apellidosnombres  = $.trim($('#roles_apellidosnombres').val());    
        roles_nombrecorto       = $.trim($('#roles_nombrecorto').val());
        roles_perfil            = $.trim($('#roles_perfil').val());
   
        validacion_roles = f_validar_roles(roles_dni, roles_apellidosnombres, roles_nombrecorto, roles_perfil);

        if(roles_dni!=""){
            a_data = f_BuscarDataBD('colaborador','Colaborador_id',roles_dni);
            if(a_data.length==0){
                t_msg               = "<br>Número DNI NO EXISTE!!!";
                validacion_roles    = "invalido";
                $("#roles_dni").addClass("color-error");
            }
        }
        
        if(validacion_roles=="invalido"){
            Swal.fire({
                position            : 'center',
                icon                : 'error',
                title               : '*Falta Completar Información!!!'+t_msg,
                showConfirmButton   : false,
                timer               : 1500
              })              
        }else{
            $("#btn_guardar_roles").prop("disabled",true);
            if(opcion_roles == "CREAR"){
                Accion = 'crear_roles';
                $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",
                    data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, roles_dni:roles_dni, roles_apellidosnombres:roles_apellidosnombres, roles_nombrecorto:roles_nombrecorto, roles_perfil:roles_perfil},
                    success     : function(data) {
                        tabla_roles.ajax.reload(null, false);
                    }
                });
            }
            if(opcion_roles == "EDITAR"){
                Accion = 'editar_roles';
                $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",    
                    data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, roles_id:roles_id, roles_dni:roles_dni, roles_apellidosnombres:roles_apellidosnombres, roles_nombrecorto:roles_nombrecorto, roles_perfil:roles_perfil},    
                    success     : function(data) {
                        tabla_roles.ajax.reload(null, false);
                    }
                });
            }
            $('#modal_crud_roles').modal('hide');
            $("#btn_guardar_roles").prop("disabled",false);
        }
    });
    ///:: FIN BOTON CREA Y EDITA ROLES DE USUARIOS ::::::::::::::::::::::::::::::::::::::::///
    
    ///:: BOTON BORRAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_borrar_roles", function(){
        let rpta_borrar_roles = "";
        fila_roles  = $(this);           
        roles_id    = $(this).closest('tr').find('td:eq(0)').text();     

        Swal.fire({
            title               : '¿Está seguro?',
            text                : "Se eliminara el registro "+roles_id+"!",
            icon                : 'warning',
            showCancelButton    : true,
            confirmButtonColor  : '#3085d6',
            cancelButtonColor   : '#d33',
            confirmButtonText   : 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                rpta_borrar_roles = "BORRAR";
                Accion = 'borrar_roles';
                if (rpta_borrar_roles == "BORRAR") {            
                    $.ajax({
                        url         : "Ajax.php",
                        type        : "POST",
                        datatype    : "json",    
                        data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, roles_id:roles_id },   
                        success     : function() {
                            tabla_roles.ajax.reload(null, false);
                            Swal.fire(
                                'Eliminado!',
                                'El registro ha sido eliminado.',
                                'success'
                            )            
                        }
                    });
                }
            }
        });
    });
    ///:: FIN BOTON BORRAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM ROLES DE USUARIO :;;;;;:::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES ROLES DE USUARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validar_roles(p_roles_dni, p_roles_apellidosnombres, p_roles_nombrecorto, p_roles_perfil){
    f_limpia_roles();
    let rpta_validar_roles = "";

    if(p_roles_dni==""){
        $("#roles_dni").addClass("color-error");
        rpta_validar_roles = "invalido";
    }

    if(p_roles_apellidosnombres==""){
        $("#roles_apellidosnombres").addClass("color-error");
        rpta_validar_roles = "invalido";
    }

    if(p_roles_nombrecorto==""){
        $("#roles_nombrecorto").addClass("color-error");
        rpta_validar_roles = "invalido";
    }

    if(p_roles_perfil==""){
        $("#roles_perfil").addClass("color-error");
        rpta_validar_roles = "invalido";
    }

    return rpta_validar_roles; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: FUNCION LIMPIA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::/// 
function f_limpia_roles(){
    $("#roles_dni").removeClass("color-error");
    $("#roles_apellidosnombres").removeClass("color-error");
    $("#roles_nombrecorto").removeClass("color-error");
    $("#roles_perfil").removeClass("color-error");
}
///:: FIN FUNCION LIMPIA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::/// 

///:: TERMINO FUNCIONES ROLES DE USUARIO ::::::::::::::::::::::::::::::::::::::::::::::::::///